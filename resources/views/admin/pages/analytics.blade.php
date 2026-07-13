@extends('layouts.admin')

@section('title', 'Lượt truy cập - Review Thẩm Mỹ Admin')

@section('content')
    <x-admin.page-header title="Lượt truy cập" subtitle="Thống kê người truy cập website">
        <div class="bg-white rounded-full shadow-sm p-1 flex border border-gray-100">
            @foreach([7, 14, 30] as $period)
                <a
                    href="{{ route('admin.analytics.index', ['days' => $period]) }}"
                    class="px-4 py-1.5 text-[13px] font-bold rounded-full transition-colors {{ $days === $period ? 'bg-gray-100 text-gray-800' : 'text-gray-500 hover:text-gray-800' }}"
                >
                    {{ $period }} ngày
                </a>
            @endforeach
        </div>
    </x-admin.page-header>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <x-admin.stat-card color="#4D8AFF" icon="pi pi-eye" :value="number_format($totalViews)" label="Tổng lượt xem" :isButton="false" />
        <x-admin.stat-card color="#10b981" icon="pi pi-users" :value="number_format($uniqueVisitors)" label="Khách duy nhất" :isButton="false" />
        <x-admin.stat-card color="#f59e0b" icon="pi pi-calendar" :value="number_format($todayViews)" label="Lượt xem hôm nay" :isButton="false" />
        <x-admin.stat-card color="#ef4444" icon="pi pi-circle-fill" :value="number_format($onlineVisitors)" label="Đang online (5 phút)" :isButton="false" />
    </div>

    <div class="bg-white p-6 rounded-card shadow-sm border border-gray-100 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-base font-bold text-gray-800">Lượt truy cập {{ $days }} ngày gần đây</h2>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-2 rounded-full border-2 border-primary bg-primary/20"></div>
                    <span class="text-xs text-gray-600">Lượt xem</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-2 rounded-full border-2 border-orange-500 bg-orange-500/20"></div>
                    <span class="text-xs text-gray-600">Khách duy nhất</span>
                </div>
            </div>
        </div>

        <div class="relative w-full h-[300px]">
            <canvas id="analyticsChart"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-8">
        <div class="bg-white p-6 rounded-card shadow-sm border border-gray-100">
            <h2 class="text-sm font-bold text-gray-800 mb-4">Trang được xem nhiều nhất</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[13px] border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="py-3 font-bold text-gray-800 w-3/4">Đường dẫn</th>
                            <th class="py-3 font-bold text-gray-800 text-right">Lượt xem</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($topPages as $page)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="py-2.5">
                                    <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs font-mono break-all inline-block">{{ $page->path }}</span>
                                </td>
                                <td class="py-2.5 text-right font-bold text-gray-700">{{ number_format($page->views) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-8 text-center text-gray-500">Chưa có dữ liệu truy cập.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white p-6 rounded-card shadow-sm border border-gray-100">
            <h2 class="text-sm font-bold text-gray-800 mb-4">Truy cập gần đây</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[13px] border-collapse">
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentVisits as $visit)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="py-2.5 w-[50%]">
                                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded text-[13px] font-mono block w-full truncate">{{ $visit->path }}</span>
                                </td>
                                <td class="py-2.5 text-gray-500">
                                    {{ $visit->referrer ? parse_url($visit->referrer, PHP_URL_HOST) ?? 'Referral' : 'Trực tiếp' }}
                                </td>
                                <td class="py-2.5 text-right text-gray-400 text-xs">{{ $visit->visited_at?->format('H:i d/m') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-8 text-center text-gray-500">Chưa có lượt truy cập nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartElement = document.getElementById('analyticsChart');
        if (!chartElement) return;

        const ctx = chartElement.getContext('2d');
        const gradientBlue = ctx.createLinearGradient(0, 0, 0, 300);
        gradientBlue.addColorStop(0, 'rgba(59, 130, 246, 0.2)');
        gradientBlue.addColorStop(1, 'rgba(59, 130, 246, 0)');

        const gradientOrange = ctx.createLinearGradient(0, 0, 0, 300);
        gradientOrange.addColorStop(0, 'rgba(249, 115, 22, 0.2)');
        gradientOrange.addColorStop(1, 'rgba(249, 115, 22, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [
                    {
                        label: 'Lượt xem',
                        data: @json($viewsSeries),
                        borderColor: '#3b82f6',
                        backgroundColor: gradientBlue,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#3b82f6',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Khách duy nhất',
                        data: @json($visitorSeries),
                        borderColor: '#f97316',
                        backgroundColor: gradientOrange,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#f97316',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1F2733',
                        titleFont: { size: 13, family: 'sans-serif' },
                        bodyFont: { size: 13, family: 'sans-serif' },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: true,
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: @json($chartMax),
                        ticks: {
                            stepSize: Math.max(1, Math.ceil(@json($chartMax) / 10)),
                            color: '#9ca3af',
                            font: { size: 11 }
                        },
                        grid: {
                            color: '#f3f4f6',
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: true,
                            borderColor: '#e5e7eb'
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 12 }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });
    });
</script>
@endpush
