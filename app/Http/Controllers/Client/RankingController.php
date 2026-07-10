<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RankingController extends Controller
{
    public function index(Request $request): View
    {
        $categorySlug = $request->query('cat');
        $category = $categorySlug ? $this->findCategoryBySlug($categorySlug) : null;

        $breadcrumb = [
            ['label' => 'Trang chủ', 'url' => url('/')],
            ['label' => $category ? 'Xếp hạng ' . $category->name : 'Bảng xếp hạng'],
        ];

        $clinics = $this->rankedClinics(null, $categorySlug);

        return view('client.pages.ranking.index', compact('breadcrumb', 'clinics'));
    }

    public function show(string $slug): View
    {
        $clinic = $this->rankedClinics()
            ->first(fn (array $clinic): bool => $clinic['slug'] === $slug);

        abort_if(! $clinic, 404);

        $breadcrumb = [
            ['label' => 'Trang chủ', 'url' => url('/')],
            ['label' => 'Xếp hạng', 'url' => url('/bang-xep-hang')],
            ['label' => $clinic['name']],
        ];

        return view('client.pages.ranking.detail', compact('clinic', 'breadcrumb'));
    }

    public static function rankedClinics(int $limit = null, string|array|null $categorySlug = null)
    {
        $clinics = Salon::with('category')
            ->where('status', 'active')
            ->orderByDesc('score')
            ->orderByDesc('is_featured')
            ->orderByDesc('rating')
            ->latest()
            ->get();

        if ($categorySlug !== null) {
            $categorySlugs = collect((array) $categorySlug)->filter()->values();

            $clinics = $clinics->filter(function (Salon $salon) use ($categorySlugs): bool {
                return $salon->category
                    && $categorySlugs->contains(Str::slug($salon->category->name));
            });
        }

        if ($limit !== null) {
            $clinics = $clinics->take($limit);
        }

        return $clinics->values()->map(function (Salon $salon, int $index): array {
            $images = self::imagesForSalon($salon);
            $image = $images[0];

            return [
                'id' => $salon->id,
                'rank' => $index + 1,
                'slug' => Str::slug($salon->name),
                'category_slug' => $salon->category ? Str::slug($salon->category->name) : null,
                'category' => $salon->category?->name ?? 'Tham my',
                'name' => $salon->name,
                'rating' => (float) $salon->rating,
                'votes' => $salon->review_count,
                'address' => $salon->address,
                'phone' => $salon->phone,
                'website' => $salon->website,
                'description' => $salon->description,
                'score' => $salon->score,
                'image' => $image,
                'images' => $images,
                'featured' => $salon->is_featured,
            ];
        });
    }

    private static function imagesForSalon(Salon $salon): array
    {
        $rawImages = [];

        if ($salon->image) {
            $decodedImages = json_decode($salon->image, true);
            $rawImages = is_array($decodedImages) ? $decodedImages : [$salon->image];
        }

        if (count($rawImages) === 0) {
            $rawImages = ['https://picsum.photos/seed/clinic-' . $salon->id . '/800/500'];
        }

        return collect($rawImages)
            ->filter()
            ->map(fn (string $image): string => Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image))
            ->values()
            ->all();
    }

    private function findCategoryBySlug(string $slug): ?Category
    {
        return Category::with('children')
            ->get()
            ->first(fn (Category $category): bool => Str::slug($category->name) === $slug);
    }
}
