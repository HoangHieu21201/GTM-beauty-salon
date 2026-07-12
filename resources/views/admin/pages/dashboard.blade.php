@extends('layouts.admin')

@section('title', 'Dashboard - Review Thẩm Mỹ Admin')

@php
    $chartLabels = $totalPosts > 0 ? ['Đã đăng', 'Nháp', 'Khác'] : ['Chưa có bài viết'];
    $chartData = $totalPosts > 0 ? [$publishedPosts, $draftPosts, $otherPosts] : [1];
    $chartColors = $totalPosts > 0 ? ['#4D8AFF', '#e5e7eb', '#f59e0b'] : ['#e5e7eb'];

    $statusMeta = [
        'published' => ['label' => 'Đã đăng', 'class' => 'bg-green-100 text-green-700'],
        'draft' => ['label' => 'Nháp', 'class' => 'bg-gray-100 text-gray-600'],
    ];
@endphp

@section('content')
    <x-admin.page-header title="Xin chào, Quản trị viên 👋" subtitle="Tổng quan website &middot; {{ now()->translatedFormat('l, d/m/Y') }}">
        <a href="{{ route('admin.posts.create') }}" class="px-4 py-2 font-semibold text-sm bg-primary border border-transparent text-white rounded-lg hover:bg-primary-dark transition-colors flex items-center gap-2 shadow-sm">
            <i class="pi pi-plus"></i> Viết bài mới
        </a>
        <a href="{{ route('admin.clinics.create') }}" class="px-4 py-2 font-semibold text-sm bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-2 shadow-sm">
            <i class="pi pi-plus"></i> Thêm cơ sở
        </a>
    </x-admin.page-header>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
        <x-admin.stat-card color="#4D8AFF" icon="pi pi-file" :value="$totalPosts" label="Bài viết" :href="route('admin.posts.index')" hasArrow="true" />
        <x-admin.stat-card color="#10b981" icon="pi pi-check-circle" :value="$publishedPosts" label="Đã đăng" :href="route('admin.posts.index', ['status' => 'published'])" hasArrow="true" />
        <x-admin.stat-card color="#f59e0b" icon="pi pi-building" :value="$totalSalons" label="Cơ sở thẩm mỹ" :href="route('admin.clinics.index')" hasArrow="true" />
        <x-admin.stat-card color="#8b5cf6" icon="pi pi-tags" :value="$totalCategories" label="Danh mục" :href="route('admin.categories.index')" hasArrow="true" />
        <x-admin.stat-card color="#ec4899" icon="pi pi-comments" :value="$pendingComments" label="Bình luận chờ duyệt" :href="url('/admin/comments')" hasArrow="true" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg text-gray-800">Bài viết gần đây</h3>
                <a href="{{ route('admin.posts.index') }}" class="text-sm font-semibold text-primary hover:text-primary-dark">Tất cả &rarr;</a>
            </div>

            <div class="space-y-0">
                @forelse($recentPosts as $post)
                    @php
                        $meta = $statusMeta[$post->status] ?? ['label' => ucfirst((string) $post->status), 'class' => 'bg-orange-100 text-orange-700'];
                        $date = optional($post->updated_at ?? $post->created_at)->format('d/m');
                    @endphp
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="flex justify-between items-center gap-4 py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors px-2 -mx-2 rounded-lg">
                        <span class="font-bold text-sm text-gray-700 min-w-0">
                            {{ \Illuminate\Support\Str::limit($post->title, 90) }}
                        </span>
                        <div class="flex items-center gap-4 flex-shrink-0">
                            <span class="text-[11px] uppercase tracking-wider font-bold px-2 py-1 rounded {{ $meta['class'] }}">{{ $meta['label'] }}</span>
                            <span class="text-xs text-gray-400 font-medium">{{ $date ?: '--/--' }}</span>
                        </div>
                    </a>
                @empty
                    <div class="py-12 text-center text-sm text-gray-500">
                        Chưa có bài viết nào. Hãy tạo bài viết đầu tiên để dashboard bắt đầu có dữ liệu.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
            <h3 class="font-bold text-lg mb-8 text-gray-800">Tỉ lệ bài viết</h3>
            <div class="flex-grow flex flex-col items-center justify-center">
                <div class="relative w-64 h-64">
                    <canvas id="postsChart"></canvas>
                </div>
                <div class="mt-8 text-sm flex flex-wrap justify-center gap-6 font-semibold text-gray-600">
                    <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-primary"></span> Đã đăng: {{ $publishedPosts }}</span>
                    <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-gray-200"></span> Nháp: {{ $draftPosts }}</span>
                    @if($otherPosts > 0)
                        <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-[#f59e0b]"></span> Khác: {{ $otherPosts }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-lg text-gray-800 flex items-center gap-3">
                <i class="pi pi-trophy text-[#f59e0b]"></i>
                Top cơ sở theo điểm xếp hạng
            </h3>
            <a href="{{ route('admin.clinics.index') }}" class="text-sm font-semibold text-primary hover:text-primary-dark">Quản lý &rarr;</a>
        </div>

        <div class="space-y-0">
            @forelse($topSalons as $salon)
                <a href="{{ route('admin.clinics.edit', $salon->id) }}" class="flex items-center justify-between gap-4 py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-colors">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-6 h-6 rounded {{ $loop->first ? 'bg-[#f59e0b] text-white' : 'bg-gray-200 text-gray-600' }} flex items-center justify-center text-xs font-bold">{{ $loop->iteration }}</div>
                        <span class="font-medium text-[14px] text-gray-800 truncate">{{ $salon->name }}</span>
                        @if($salon->category)
                            <span class="hidden sm:inline text-[12px] text-gray-400 truncate">{{ $salon->category->name }}</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-6 flex-shrink-0">
                        <span class="text-[13px] text-gray-500 font-medium">{{ number_format((float) $salon->rating, 1) }} <i class="pi pi-star-fill text-[#f59e0b] text-[10px] ml-0.5"></i></span>
                        <span class="font-bold text-primary text-[14px] min-w-[60px] text-right">{{ (int) $salon->score }} điểm</span>
                    </div>
                </a>
            @empty
                <div class="py-10 text-center text-sm text-gray-500">
                    Chưa có cơ sở thẩm mỹ nào để xếp hạng.
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('postsChart');

        if (!canvas || typeof Chart === 'undefined') {
            return;
        }

        const totalPosts = @json($totalPosts);

        new Chart(canvas.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    data: @json($chartData),
                    backgroundColor: @json($chartColors),
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                layout: {
                    padding: 20
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = totalPosts > 0 ? context.raw : 0;
                                return ' ' + context.label + ': ' + value + ' bài';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
