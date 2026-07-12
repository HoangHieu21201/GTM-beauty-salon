<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Salon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $postQuery = $this->postQuery();
        $salonQuery = $this->salonQuery();
        $categoryQuery = $this->categoryQuery();

        $totalPosts = (clone $postQuery)->count();
        $publishedPosts = (clone $postQuery)->where('status', 'published')->count();
        $draftPosts = (clone $postQuery)->where('status', 'draft')->count();
        $otherPosts = max(0, $totalPosts - $publishedPosts - $draftPosts);

        return view('admin.pages.dashboard', [
            'totalPosts' => $totalPosts,
            'publishedPosts' => $publishedPosts,
            'draftPosts' => $draftPosts,
            'otherPosts' => $otherPosts,
            'totalSalons' => (clone $salonQuery)->count(),
            'totalCategories' => (clone $categoryQuery)->count(),
            'pendingComments' => $this->pendingCommentsCount(),
            'recentPosts' => $this->recentPosts(clone $postQuery),
            'topSalons' => $this->topSalons(clone $salonQuery),
        ]);
    }

    private function postQuery()
    {
        $query = Post::query();

        if (Schema::hasColumn('posts', 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        return $query;
    }

    private function salonQuery()
    {
        $query = Salon::query();

        if (Schema::hasColumn('salons', 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        return $query;
    }

    private function categoryQuery()
    {
        $query = Category::query();

        if (Schema::hasColumn('categories', 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        return $query;
    }

    private function pendingCommentsCount(): int
    {
        if (! Schema::hasTable('comments')) {
            return 0;
        }

        $query = DB::table('comments')->where('status', 0);

        if (Schema::hasColumn('comments', 'deleted_at')) {
            $query->whereNull('deleted_at');
        }

        return $query->count();
    }

    private function recentPosts($baseQuery): Collection
    {
        return $baseQuery
            ->with('category')
            ->latest('updated_at')
            ->latest('id')
            ->limit(5)
            ->get();
    }

    private function topSalons($baseQuery): Collection
    {
        return $baseQuery
            ->with('category')
            ->orderByDesc('score')
            ->orderByDesc('rating')
            ->orderByDesc('review_count')
            ->limit(5)
            ->get();
    }
}
