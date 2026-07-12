<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Province;
use App\Models\Salon;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     */
    public function index()
    {
        $posts = Post::with('category')->latest()->get();
        return view('admin.pages.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $categories = Category::all();
        $provinces = Province::all();
        $salons = Salon::all();
        
        return view('admin.pages.posts.create', compact('categories', 'provinces', 'salons'));
    }

    /**
     * Store a newly created post in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'status' => 'required|string|in:draft,published',
            'category_id' => 'nullable|exists:categories,id',
            'keyword' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'provinces' => 'nullable|array',
            'provinces.*' => 'exists:provinces,id',
            'salons' => 'nullable|array',
            'salons.*' => 'exists:salons,id',
        ]);

        $title = $validated['title'] ?? ('Bài viết nháp ' . date('d/m/Y H:i'));
        $slug = $validated['slug'] ?? null;
        if (!$slug) {
            $slug = \Illuminate\Support\Str::slug($title) . '-' . time();
        }

        $categoryId = $validated['category_id'] ?? null;
        if (!$categoryId) {
            $defaultCat = Category::firstOrCreate(['name' => 'Chưa phân loại']);
            $categoryId = $defaultCat->id;
        }

        $thumbnailPath = $validated['thumbnail'] ?? null;
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('posts', 'public');
            $thumbnailPath = '/storage/' . $path;
        }

        $sanitizedContent = $validated['content'] ? clean($validated['content']) : null;

        $post = Post::create([
            'user_id' => auth()->id() ?? User::first()->id,
            'category_id' => $categoryId,
            'title' => $title,
            'slug' => $slug,
            'short_description' => $validated['short_description'],
            'content' => $sanitizedContent,
            'thumbnail' => $thumbnailPath,
            'status' => $validated['status'],
            'keyword' => $validated['keyword'],
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
        ]);

        // Sync pivots
        if ($request->has('provinces')) {
            $provinces = array_filter((array)$request->input('provinces'), function($val) {
                return $val !== null && $val !== '';
            });
            $post->provinces()->sync($provinces);
        }
        if ($request->has('salons')) {
            $salons = array_filter((array)$request->input('salons'), function($val) {
                return $val !== null && $val !== '';
            });
            $post->salons()->sync($salons);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Thêm bài viết mới thành công!');
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit($id)
    {
        $post = Post::with(['provinces', 'salons'])->findOrFail($id);
        
        $categories = Category::all();
        $provinces = Province::all();
        $salons = Salon::all();

        return view('admin.pages.posts.edit', compact('post', 'categories', 'provinces', 'salons'));
    }

    /**
     * Update the specified post in database.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'status' => 'required|string|in:draft,published',
            'category_id' => 'nullable|exists:categories,id',
            'keyword' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'provinces' => 'nullable|array',
            'provinces.*' => 'exists:provinces,id',
            'salons' => 'nullable|array',
            'salons.*' => 'exists:salons,id',
        ]);

        $title = $validated['title'] ?? $post->title;
        $slug = $validated['slug'] ?? $post->slug;
        if (!$title) {
            $title = 'Bài viết nháp ' . date('d/m/Y H:i');
        }
        if (!$slug) {
            $slug = \Illuminate\Support\Str::slug($title) . '-' . time();
        }

        $categoryId = $validated['category_id'] ?? null;
        if (!$categoryId) {
            $defaultCat = Category::firstOrCreate(['name' => 'Chưa phân loại']);
            $categoryId = $defaultCat->id;
        }

        $thumbnailPath = $validated['thumbnail'] ?? $post->thumbnail;
        if ($request->has('remove_thumbnail') && $request->input('remove_thumbnail') == '1') {
            $thumbnailPath = null;
        }
        if ($request->hasFile('thumbnail_file')) {
            $path = $request->file('thumbnail_file')->store('posts', 'public');
            $thumbnailPath = '/storage/' . $path;
        }

        $sanitizedContent = $validated['content'] ? clean($validated['content']) : $post->content;

        $post->update([
            'title' => $title,
            'slug' => $slug,
            'short_description' => $validated['short_description'] ?? $post->short_description,
            'content' => $sanitizedContent,
            'thumbnail' => $thumbnailPath,
            'status' => $validated['status'],
            'category_id' => $categoryId,
            'keyword' => $validated['keyword'] ?? $post->keyword,
            'meta_title' => $validated['meta_title'] ?? $post->meta_title,
            'meta_description' => $validated['meta_description'] ?? $post->meta_description,
        ]);

        if ($request->has('provinces')) {
            $provinces = array_filter((array)$request->input('provinces', []), function($val) {
                return $val !== null && $val !== '';
            });
            $post->provinces()->sync($provinces);
        }

        if ($request->has('salons')) {
            $salons = array_filter((array)$request->input('salons', []), function($val) {
                return $val !== null && $val !== '';
            });
            $post->salons()->sync($salons);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts/content', 'public');
            return response()->json(['url' => '/storage/' . $path]);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }

    /**
     * Remove the specified post from database.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Clean up thumbnail
        if ($post->thumbnail) {
            $thumbnailPath = str_replace('/storage/', '', $post->thumbnail);
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($thumbnailPath)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($thumbnailPath);
            }
        }
        
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Xóa bài viết thành công!');
    }
}
