<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {

        $rootCategories = Category::with([
            'children' => fn ($query) => $query->orderBy('name'),
        ])
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        $categories = $rootCategories
            ->flatMap(fn (Category $category) => collect([$category])->merge($category->children))
            ->values();

        return view('admin.pages.categories.index', compact('categories', 'rootCategories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Đã thêm danh mục thành công.');
    }

    public function update(Request $request, Category $category): JsonResponse|RedirectResponse
    {
        $data = $this->validatedData($request, $category);

        $category->update($data);

        $payload = [
            'message' => 'Đã lưu thay đổi.',
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => Str::slug($category->name),
                'parent_id' => $category->parent_id,
            ],
        ];

        if ($request->expectsJson()) {
            return response()->json($payload);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', $payload['message']);
    }

    public function destroy(Request $request, Category $category): JsonResponse|RedirectResponse
    {
        $category->loadCount(['children', 'salons']);

        if ($category->children_count > 0) {
            return $this->validationResponse($request, 'Không thể xóa danh mục đang có danh mục con.');
        }

        if ($category->salons_count > 0) {
            return $this->validationResponse($request, 'Không thể xóa danh mục đang được cơ sở thẩm mỹ sử dụng.');
        }

        $category->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Đã xóa danh mục thành công.',
            ]);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Đã xóa danh mục thành công.');
    }

    private function validatedData(Request $request, ?Category $category = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', Rule::exists('categories', 'id')->whereNull('deleted_at')],
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
        ]);

        $name = trim($data['name']);
        $parentId = $data['parent_id'] ?? null;
        $parentId = $parentId ? (int) $parentId : null;

        if ($name === '') {
            throw ValidationException::withMessages([
                'name' => 'Vui lòng nhập tên danh mục.',
            ]);
        }

        if ($category && $parentId === $category->id) {
            throw ValidationException::withMessages([
                'parent_id' => 'Danh mục cha không được là chính nó.',
            ]);
        }

        if ($parentId) {
            $parent = Category::find($parentId);

            if (! $parent) {
                throw ValidationException::withMessages([
                    'parent_id' => 'Danh mục cha không hợp lệ.',
                ]);
            }

            if ($parent->parent_id) {
                throw ValidationException::withMessages([
                    'parent_id' => 'Chỉ hỗ trợ danh mục tối đa 2 cấp.',
                ]);
            }
        }

        if ($category && $parentId && $category->children()->exists()) {
            throw ValidationException::withMessages([
                'parent_id' => 'Danh mục đang có danh mục con nên không thể chuyển thành danh mục con.',
            ]);
        }

        $this->ensureUniqueNameAndSlug($name, $category?->id);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'parent_id' => $parentId,
        ];
    }

    private function ensureUniqueNameAndSlug(string $name, ?int $ignoreId = null): void
    {
        $slug = Str::slug($name);
        $normalizedName = Str::lower($name);

        $duplicate = Category::query()
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->get(['id', 'name'])
            ->first(function (Category $category) use ($slug, $normalizedName): bool {
                return Str::lower($category->name) === $normalizedName
                    || Str::slug($category->name) === $slug;
            });

        if ($duplicate) {
            throw ValidationException::withMessages([
                'name' => 'Tên hoặc slug danh mục đã tồn tại, vui lòng kiểm tra lại.',
            ]);
        }
    }

    private function validationResponse(Request $request, string $message): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
            ], 422);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('error', $message);
    }
}
