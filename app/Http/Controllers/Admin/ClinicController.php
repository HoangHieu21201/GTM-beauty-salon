<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Salon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClinicController extends Controller
{
    public function index(): View
    {
        $this->ensureDefaultCategories();

        $clinics = Salon::with('category')
            ->orderByDesc('score')
            ->orderByDesc('is_featured')
            ->latest()
            ->get();

        return view('admin.pages.clinics.index', compact('clinics'));
    }

    public function create(): View
    {
        $categories = $this->ensureDefaultCategories();
        $formToken = $this->makeSubmissionToken(request());

        return view('admin.pages.clinics.create', compact('categories', 'formToken'));
    }

    public function store(\App\Http\Requests\Admin\StoreClinicRequest $request): RedirectResponse
    {
        $data = $request->validated();
        
        $categories = $this->ensureDefaultCategories();

        if (! $this->consumeSubmissionToken($request)) {
            return redirect()
                ->route('admin.clinics.index')
                ->with('warning', 'Yêu cầu này đã được xử lý, vui lòng không gửi lại form.');
        }

        $clinicData = [
            'category_id' => $data['category_id'] ?? $categories->first()->id,
            'name' => $data['name'],
            'address' => $data['address'] ?? '',
            'phone' => $data['phone'] ?? '',
            'website' => $data['website'] ?? null,
            'description' => $data['description'] ?? null,
            'score' => $data['score'] ?? 0,
            'rating' => isset($data['rating']) ? (float) str_replace(',', '.', $data['rating']) : 5.0,
            'review_count' => $data['review_count'] ?? 0,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $data['status'] ?? 'active',
        ];

        $clinicData['slug'] = Str::slug($clinicData['name']);
        $clinicData['image'] = $this->resolveImages($request);

        Salon::create($clinicData);

        return redirect()
            ->route('admin.clinics.index')
            ->with('success', 'Đã thêm cơ sở thành công.');
    }

    public function edit(Salon $clinic): View
    {
        $categories = $this->ensureDefaultCategories();
        $clinic->load('category');
        $formToken = $this->makeSubmissionToken(request());

        return view('admin.pages.clinics.edit', compact('clinic', 'categories', 'formToken'));
    }

    public function update(\App\Http\Requests\Admin\UpdateClinicRequest $request, Salon $clinic): RedirectResponse
    {
        $data = $request->validated();

        if (! $this->consumeSubmissionToken($request)) {
            return redirect()
                ->route('admin.clinics.index')
                ->with('warning', 'Yêu cầu này đã được xử lý, vui lòng không gửi lại form.');
        }

        $categories = $this->ensureDefaultCategories();

        $clinicData = [
            'category_id' => $data['category_id'] ?? $categories->first()->id,
            'name' => $data['name'],
            'address' => $data['address'] ?? '',
            'phone' => $data['phone'] ?? '',
            'website' => $data['website'] ?? null,
            'description' => $data['description'] ?? null,
            'score' => $data['score'] ?? 0,
            'rating' => isset($data['rating']) ? (float) str_replace(',', '.', $data['rating']) : 5.0,
            'review_count' => $data['review_count'] ?? 0,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $data['status'] ?? 'active',
        ];

        $clinicData['slug'] = Str::slug($clinicData['name']);
        
        $oldImages = $this->decodeImages($clinic->image);
        $image = $this->resolveImages($request, $clinic->image);
        $newImages = $this->decodeImages($image);

        $this->cleanupImages($oldImages, $newImages);

        $clinicData['image'] = $image;

        $clinic->update($clinicData);

        return redirect()
            ->route('admin.clinics.index')
            ->with('success', 'Đã cập nhật cơ sở thành công.');
    }

    public function destroy(Salon $clinic): RedirectResponse
    {
        $oldImages = $this->decodeImages($clinic->image);
        $this->cleanupImages($oldImages, []);

        $clinic->delete();

        return redirect()
            ->route('admin.clinics.index')
            ->with('success', 'Đã xóa cơ sở thành công.');
    }

    public function updateImages(Request $request, Salon $clinic): JsonResponse
    {
        $data = $request->validate([
            'existing_images' => ['nullable', 'array', 'max:4'],
            'existing_images.*' => ['string', 'max:500'],
        ]);

        $oldImages = $this->decodeImages($clinic->image);
        $images = array_values(array_unique(array_filter($data['existing_images'] ?? [])));
        $newImages = array_slice($images, 0, 4);
        
        $this->cleanupImages($oldImages, $newImages);

        $clinic->update([
            'image' => json_encode($newImages, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ]);

        return response()->json([
            'images' => $images,
        ]);
    }

    public function reorder(Request $request): JsonResponse
    {
        $data = $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['integer', 'exists:salons,id'],
        ]);

        $ids = $data['order'];
        $baseScore = count($ids) * 10;

        foreach ($ids as $index => $id) {
            Salon::where('id', $id)->update(['score' => $baseScore - ($index * 10)]);
        }

        return response()->json(['success' => true]);
    }

    private function resolveImages(Request $request, ?string $currentImage = null): ?string
    {
        $images = ($request->boolean('images_synced') || $request->has('existing_images'))
            ? array_values(array_filter($request->input('existing_images', [])))
            : $this->decodeImages($currentImage);

        if ($request->filled('image_url')) {
            $images[] = $request->string('image_url')->toString();
        }

        if ($request->hasFile('image_files')) {
            $directory = public_path('uploads/salons');
            File::ensureDirectoryExists($directory);

            foreach ($request->file('image_files') as $file) {
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move($directory, $filename);
                $images[] = 'uploads/salons/' . $filename;
            }
        }

        $images = array_values(array_unique(array_filter($images)));

        return json_encode(array_slice($images, 0, 4), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    private function decodeImages(?string $image): array
    {
        if (! $image) {
            return [];
        }

        $decoded = json_decode($image, true);

        if (is_array($decoded)) {
            return array_values(array_filter($decoded));
        }

        return [$image];
    }

    private function cleanupImages(array $oldImages, array $newImages): void
    {
        $imagesToDelete = array_diff($oldImages, $newImages);

        foreach ($imagesToDelete as $imagePath) {
            if (is_string($imagePath) && strpos($imagePath, 'uploads/salons/') === 0) {
                $fullPath = realpath(public_path($imagePath));
                $basePath = realpath(public_path('uploads/salons'));

                if ($fullPath && $basePath && strpos($fullPath, $basePath) === 0 && File::exists($fullPath)) {
                    File::delete($fullPath);
                }
            }
        }
    }

    private function makeSubmissionToken(Request $request): string
    {
        $token = (string) Str::uuid();
        $tokens = $request->session()->get('clinic_form_tokens', []);
        $tokens[$token] = true;

        $request->session()->put('clinic_form_tokens', array_slice($tokens, -10, null, true));

        return $token;
    }

    private function consumeSubmissionToken(Request $request): bool
    {
        $token = $request->string('form_token')->toString();
        $tokens = $request->session()->get('clinic_form_tokens', []);

        if (! isset($tokens[$token])) {
            return false;
        }

        unset($tokens[$token]);
        $request->session()->put('clinic_form_tokens', $tokens);

        return true;
    }

    private function ensureDefaultCategories()
    {
        if (Category::query()->exists()) {
            return Category::orderBy('parent_id')->orderBy('name')->get();
        }

        $parent = Category::create(['name' => 'Phẫu thuật thẩm mỹ']);

        collect(['Nâng mũi', 'Nâng ngực', 'Cắt mí', 'Hút mỡ'])->each(
            fn (string $name) => Category::create([
                'parent_id' => $parent->id,
                'name' => $name,
            ])
        );

        return Category::orderBy('parent_id')->orderBy('name')->get();
    }
}
