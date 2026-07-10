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

        return view('admin.pages.clinics.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['image'] = $this->resolveImages($request);

        Salon::create($data);

        return redirect()
            ->route('admin.clinics.index')
            ->with('success', 'Da them co so thanh cong.');
    }

    public function edit(Salon $clinic): View
    {
        $categories = $this->ensureDefaultCategories();
        $clinic->load('category');

        return view('admin.pages.clinics.edit', compact('clinic', 'categories'));
    }

    public function update(Request $request, Salon $clinic): RedirectResponse
    {
        $data = $this->validatedData($request);
        $image = $this->resolveImages($request, $clinic->image);

        $data['image'] = $image;

        $clinic->update($data);

        return redirect()
            ->route('admin.clinics.index')
            ->with('success', 'Da cap nhat co so thanh cong.');
    }

    public function destroy(Salon $clinic): RedirectResponse
    {
        $clinic->delete();

        return redirect()
            ->route('admin.clinics.index')
            ->with('success', 'Da xoa co so thanh cong.');
    }

    public function updateImages(Request $request, Salon $clinic): JsonResponse
    {
        $data = $request->validate([
            'existing_images' => ['nullable', 'array', 'max:4'],
            'existing_images.*' => ['string', 'max:500'],
        ]);

        $images = array_values(array_unique(array_filter($data['existing_images'] ?? [])));
        $clinic->update([
            'image' => json_encode(array_slice($images, 0, 4), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ]);

        return response()->json([
            'images' => $images,
        ]);
    }

    private function validatedData(Request $request): array
    {
        $categories = $this->ensureDefaultCategories();

        if ($request->filled('rating')) {
            $request->merge([
                'rating' => str_replace(',', '.', $request->string('rating')->toString()),
            ]);
        }

        $data = $request->validate([
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
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
            'website.url' => 'Website phải là một đường dẫn hợp lệ.',
            'rating.numeric' => 'Rating phải là số từ 0 đến 5.',
            'rating.min' => 'Rating phải là số từ 0 đến 5.',
            'rating.max' => 'Rating phải là số từ 0 đến 5.',
            'image_file.mimes' => 'Ảnh cơ sở phải là file ảnh JPG, PNG, WEBP, GIF, SVG hoặc AVIF.',
            'image_file.max' => 'Ảnh cơ sở không được vượt quá 8MB.',
            'image_url.url' => 'URL ảnh phải là một đường dẫn hợp lệ.',
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
