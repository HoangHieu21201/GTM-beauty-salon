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

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        if (! $this->consumeSubmissionToken($request)) {
            return redirect()
                ->route('admin.clinics.index')
                ->with('warning', 'Yêu cầu này đã được xử lý, vui lòng không gửi lại form.');
        }

        $data['image'] = $this->resolveImages($request);

        Salon::create($data);

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

    public function update(Request $request, Salon $clinic): RedirectResponse
    {
        $data = $this->validatedData($request, $clinic);

        if (! $this->consumeSubmissionToken($request)) {
            return redirect()
                ->route('admin.clinics.index')
                ->with('warning', 'Yêu cầu này đã được xử lý, vui lòng không gửi lại form.');
        }

        $oldImages = $this->decodeImages($clinic->image);
        $image = $this->resolveImages($request, $clinic->image);
        $newImages = $this->decodeImages($image);

        $this->cleanupImages($oldImages, $newImages);

        $data['image'] = $image;

        $clinic->update($data);

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

    private function validatedData(Request $request, ?Salon $clinic = null): array
    {
        $categories = $this->ensureDefaultCategories();

        if ($request->filled('rating')) {
            $request->merge([
                'rating' => str_replace(',', '.', $request->string('rating')->toString()),
            ]);
        }

        $data = $request->validate([
            'form_token' => ['required', 'string', 'size:36'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('salons', 'name')->ignore($clinic?->id)->whereNull('deleted_at'),
            ],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('salons', 'phone')->ignore($clinic?->id)->whereNull('deleted_at'),
            ],
            'website' => [
                'nullable',
                'url',
                'max:255',
                Rule::unique('salons', 'website')->ignore($clinic?->id)->whereNull('deleted_at'),
            ],
            'description' => ['nullable', 'string'],
            'score' => ['nullable', 'integer', 'min:0'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'review_count' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['nullable', 'in:active,inactive'],
            'images_synced' => ['nullable', 'boolean'],
            'image_files' => ['nullable', 'array', 'max:4'],
            'image_files.*' => ['file', 'mimes:jpg,jpeg,jfif,png,webp,gif,svg,avif', 'max:8192'],
            'existing_images' => ['nullable', 'array', 'max:4'],
            'existing_images.*' => ['string', 'max:500'],
            'image_url' => ['nullable', 'url', 'max:500'],
        ], [
            'name.required' => 'Vui lòng nhập tên cơ sở.',
            'name.unique' => 'Tên cơ sở này đã tồn tại, vui lòng kiểm tra lại.',
            'phone.unique' => 'Số điện thoại này đã được sử dụng cho cơ sở khác.',
            'website.unique' => 'Website này đã được sử dụng cho cơ sở khác.',
            'website.url' => 'Website phải là một đường dẫn hợp lệ.',
            'rating.numeric' => 'Rating phải là số từ 0 đến 5.',
            'rating.min' => 'Rating phải là số từ 0 đến 5.',
            'rating.max' => 'Rating phải là số từ 0 đến 5.',
            'image_files.*.mimes' => 'Ảnh cơ sở phải là file ảnh JPG, PNG, WEBP, GIF, SVG hoặc AVIF.',
            'image_files.*.max' => 'Ảnh cơ sở không được vượt quá 8MB.',
            'image_url.url' => 'URL ảnh phải là một đường dẫn hợp lệ.',
            'form_token.required' => 'Phiên làm việc đã hết hạn, vui lòng tải lại trang.',
            'form_token.size' => 'Phiên làm việc không hợp lệ, vui lòng tải lại trang.',
        ]);

        return [
            'category_id' => $data['category_id'] ?? $categories->first()->id,
            'name' => $data['name'],
            'address' => $data['address'] ?? '',
            'phone' => $data['phone'] ?? '',
            'website' => $data['website'] ?? null,
            'description' => $data['description'] ?? null,
            'score' => $data['score'] ?? 0,
            'rating' => $data['rating'] ?? 5.0,
            'review_count' => $data['review_count'] ?? 0,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $data['status'] ?? 'active',
        ];
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
