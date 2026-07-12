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

    public function store(\App\Http\Requests\Admin\StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Đã thêm danh mục thành công.');
    }

    public function update(\App\Http\Requests\Admin\UpdateCategoryRequest $request, Category $category): JsonResponse|RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        $payload = [
            'message' => 'Đã lưu thay đổi.',
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'parent_id' => $category->parent_id,
            ],
        ];

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($payload);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Đã lưu thay đổi.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->children()->exists()) {
            return back()->with('error', 'Không thể xóa vì danh mục này đang có danh mục con.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Đã xóa danh mục thành công.');
    }


}
