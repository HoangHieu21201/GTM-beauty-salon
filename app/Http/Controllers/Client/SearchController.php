<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Province;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $query = (string) $request->query('q', '');
        $queryText = trim($query);
        
        $posts = collect();
        $salons = collect();
        $categories = collect();
        $provinces = collect();

        if (!empty($queryText)) {
            $posts = Post::with(['category', 'user', 'provinces'])
                ->where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%")
                      ->orWhere('short_description', 'like', "%{$query}%");
                })
                ->latest()
                ->limit(10)
                ->get()
                ->map(function ($post) {
                    return [
                        'category' => mb_strtoupper($post->category?->name ?? 'Tin tức'),
                        'title' => $post->title,
                        'excerpt' => $post->short_description ?? strip_tags(\Illuminate\Support\Str::limit($post->content, 100)),
                        'date' => $post->created_at->format('d/m/Y'),
                        'views' => 120, // Dummy view count or use a column if it exists
                        'image' => $post->thumbnail ? (\Illuminate\Support\Str::startsWith($post->thumbnail, ['http://', 'https://']) ? $post->thumbnail : asset($post->thumbnail)) : 'https://picsum.photos/seed/post-' . $post->id . '/400/250',
                        'url' => url('/bai-viet/chi-tiet/' . $post->slug)
                    ];
                });

            $salons = Salon::with('category')
                ->where('status', 'active')
                ->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                      ->orWhere('address', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                })
                ->orderByDesc('score')
                ->limit(10)
                ->get()
                ->map(function ($salon, $index) {
                    $rawImages = [];
                    if ($salon->image) {
                        $decoded = json_decode($salon->image, true);
                        $rawImages = is_array($decoded) ? $decoded : [$salon->image];
                    }
                    if (count($rawImages) === 0) {
                        $rawImages = ['https://picsum.photos/seed/clinic-' . $salon->id . '/800/500'];
                    }
                    $image = \Illuminate\Support\Str::startsWith($rawImages[0], ['http://', 'https://']) ? $rawImages[0] : asset($rawImages[0]);

                    return [
                        'id' => $salon->id,
                        'rank' => $index + 1,
                        'slug' => \Illuminate\Support\Str::slug($salon->name),
                        'category' => $salon->category?->name ?? 'Tham my',
                        'name' => $salon->name,
                        'rating' => (float) $salon->rating,
                        'votes' => $salon->review_count,
                        'address' => $salon->address,
                        'score' => $salon->score,
                        'image' => $image,
                        'featured' => $salon->is_featured,
                    ];
                });

            $categories = Category::where('name', 'like', "%{$query}%")
                ->limit(5)
                ->get();

            $provinces = Province::where('name', 'like', "%{$query}%")
                ->limit(5)
                ->get();
        }

        $breadcrumb = [
            ['label' => 'Trang chủ', 'url' => url('/')],
            ['label' => 'Tìm kiếm']
        ];

        return view('client.pages.search', compact('query', 'posts', 'salons', 'categories', 'provinces', 'breadcrumb'));
    }
}
