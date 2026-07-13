<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageVisit;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'days' => ['nullable', 'integer', Rule::in([7, 14, 30])],
        ]);

        $days = (int) ($validated['days'] ?? 7);

        if (! Schema::hasTable('page_visits')) {
            return view('admin.pages.analytics', $this->emptyPayload($days));
        }

        $start = now()->startOfDay()->subDays($days - 1);
        $end = now()->endOfDay();

        $baseQuery = PageVisit::query()
            ->whereBetween('visited_at', [$start, $end])
            ->whereBetween('status_code', [200, 499]);

        $totalViews = (clone $baseQuery)->count();
        $uniqueVisitors = (clone $baseQuery)->distinct('visitor_id')->count('visitor_id');
        $todayViews = PageVisit::query()
            ->whereDate('visited_at', today())
            ->whereBetween('status_code', [200, 499])
            ->count();
        $onlineVisitors = PageVisit::query()
            ->where('visited_at', '>=', now()->subMinutes(5))
            ->whereBetween('status_code', [200, 499])
            ->distinct('visitor_id')
            ->count('visitor_id');

        $dailyRows = (clone $baseQuery)
            ->selectRaw('DATE(visited_at) as visit_date, COUNT(*) as views, COUNT(DISTINCT visitor_id) as visitors')
            ->groupBy('visit_date')
            ->orderBy('visit_date')
            ->get()
            ->keyBy(fn ($row) => Carbon::parse($row->visit_date)->toDateString());

        $labels = [];
        $viewsSeries = [];
        $visitorSeries = [];

        foreach (CarbonPeriod::create($start->copy()->startOfDay(), $end->copy()->startOfDay()) as $date) {
            $key = $date->toDateString();
            $row = $dailyRows->get($key);

            $labels[] = $date->format('m-d');
            $viewsSeries[] = (int) ($row->views ?? 0);
            $visitorSeries[] = (int) ($row->visitors ?? 0);
        }

        $topPages = (clone $baseQuery)
            ->selectRaw('path, COUNT(*) as views')
            ->groupBy('path')
            ->orderByDesc('views')
            ->limit(10)
            ->get();

        $recentVisits = PageVisit::query()
            ->whereBetween('status_code', [200, 499])
            ->latest('visited_at')
            ->limit(12)
            ->get();

        return view('admin.pages.analytics', [
            'days' => $days,
            'totalViews' => $totalViews,
            'uniqueVisitors' => $uniqueVisitors,
            'todayViews' => $todayViews,
            'onlineVisitors' => $onlineVisitors,
            'chartLabels' => $labels,
            'viewsSeries' => $viewsSeries,
            'visitorSeries' => $visitorSeries,
            'topPages' => $topPages,
            'recentVisits' => $recentVisits,
            'chartMax' => max(10, (int) ceil(max($viewsSeries ?: [0]) / 10) * 10),
        ]);
    }

    private function emptyPayload(int $days): array
    {
        $labels = [];

        foreach (CarbonPeriod::create(now()->startOfDay()->subDays($days - 1), now()->startOfDay()) as $date) {
            $labels[] = $date->format('m-d');
        }

        return [
            'days' => $days,
            'totalViews' => 0,
            'uniqueVisitors' => 0,
            'todayViews' => 0,
            'onlineVisitors' => 0,
            'chartLabels' => $labels,
            'viewsSeries' => array_fill(0, count($labels), 0),
            'visitorSeries' => array_fill(0, count($labels), 0),
            'topPages' => collect(),
            'recentVisits' => collect(),
            'chartMax' => 10,
        ];
    }
}
