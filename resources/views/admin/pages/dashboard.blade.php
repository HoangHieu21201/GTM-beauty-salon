@extends('layouts.admin')

@section('title', 'Dashboard - Review Thẩm Mỹ Admin')

@section('content')
    <!-- Top Area -->
    <x-admin.page-header title="Xin chào, Quản trị viên 👋" subtitle="Tổng quan website &middot; {{ \Carbon\Carbon::now()->format('l, d/m/Y') }}">
        <x-admin.button variant="primary" icon="+">Viết bài mới</x-admin.button>
        <a href="{{ url('/admin/clinics/create') }}" class="px-4 py-2 font-semibold text-sm bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-2 shadow-sm">
            <i class="pi pi-plus"></i> Thêm cơ sở
        </a>
    </x-admin.page-header>

    <!-- Stats Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">
        <x-admin.stat-card color="#4D8AFF" icon="pi pi-file" value="5" label="Bài viết" hasArrow="true" />
        <x-admin.stat-card color="#10b981" icon="pi pi-check-circle" value="5" label="Đã đăng" hasArrow="true" />
        <x-admin.stat-card color="#f59e0b" icon="pi pi-building" value="6" label="Cơ sở thẩm mỹ" hasArrow="true" />
        <x-admin.stat-card color="#8b5cf6" icon="pi pi-tags" value="12" label="Danh mục" hasArrow="true" />
        <x-admin.stat-card color="#ec4899" icon="pi pi-comments" value="0" label="Bình luận chờ duyệt" hasArrow="true" />
    </div>

    <!-- Main Content Area: 2 Cols -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Recent Posts -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg text-gray-800">Bài viết gần đây</h3>
                <a href="#" class="text-sm font-semibold text-primary hover:text-primary-dark">Tất cả &rarr;</a>
            </div>
            
            <div class="space-y-0">
                <div class="flex justify-between items-center py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors px-2 -mx-2 rounded-lg">
                    <span class="font-bold text-sm text-gray-700">Bọc răng sứ giá bao nhiêu? Bảng giá 2026 và 5 điều phải hỏi trước khi làm...</span>
                    <div class="flex items-center gap-4">
                        <span class="text-[11px] uppercase tracking-wider font-bold px-2 py-1 rounded bg-green-100 text-green-700">Đã đăng</span>
                        <span class="text-xs text-gray-400 font-medium">05/07</span>
                    </div>
                </div>
                <div class="flex justify-between items-center py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors px-2 -mx-2 rounded-lg">
                    <span class="font-bold text-sm text-gray-700">Niềng răng trong suốt hay mắc cài: Chọn loại nào năm 2026?</span>
                    <div class="flex items-center gap-4">
                        <span class="text-[11px] uppercase tracking-wider font-bold px-2 py-1 rounded bg-green-100 text-green-700">Đã đăng</span>
                        <span class="text-xs text-gray-400 font-medium">05/07</span>
                    </div>
                </div>
                <div class="flex justify-between items-center py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors px-2 -mx-2 rounded-lg">
                    <span class="font-bold text-sm text-gray-700">Trị mụn chuẩn y khoa: lộ trình 3 tháng sạch mụn, hạn chế tái phát</span>
                    <div class="flex items-center gap-4">
                        <span class="text-[11px] uppercase tracking-wider font-bold px-2 py-1 rounded bg-green-100 text-green-700">Đã đăng</span>
                        <span class="text-xs text-gray-400 font-medium">05/07</span>
                    </div>
                </div>
                <div class="flex justify-between items-center py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors px-2 -mx-2 rounded-lg">
                    <span class="font-bold text-sm text-gray-700">Trẻ hóa da công nghệ cao: so sánh HIFU, RF và Laser chi tiết 2026</span>
                    <div class="flex items-center gap-4">
                        <span class="text-[11px] uppercase tracking-wider font-bold px-2 py-1 rounded bg-green-100 text-green-700">Đã đăng</span>
                        <span class="text-xs text-gray-400 font-medium">05/07</span>
                    </div>
                </div>
                <div class="flex justify-between items-center py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors px-2 -mx-2 rounded-lg">
                    <span class="font-bold text-sm text-gray-700">Hút mỡ bụng 2026: chi phí, công nghệ và những sự thật ít ai nói</span>
                    <div class="flex items-center gap-4">
                        <span class="text-[11px] uppercase tracking-wider font-bold px-2 py-1 rounded bg-green-100 text-green-700">Đã đăng</span>
                        <span class="text-xs text-gray-400 font-medium">05/07</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Chart -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
            <h3 class="font-bold text-lg mb-8 text-gray-800">Tỉ lệ bài viết</h3>
            <div class="flex-grow flex flex-col items-center justify-center">
                <!-- Donut Chart UI (Chart.js) -->
                <div class="relative w-64 h-64">
                    <canvas id="postsChart"></canvas>
                </div>
                <!-- Legend -->
                <div class="mt-8 text-sm flex gap-6 font-semibold text-gray-600">
                    <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-primary"></span> Đã đăng: 5</span>
                    <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-gray-200"></span> Nháp: 5</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Ranking -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-lg text-gray-800 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
                Top cơ sở theo điểm xếp hạng
            </h3>
            <a href="#" class="text-sm font-semibold text-primary hover:text-primary-dark">Quản lý &rarr;</a>
        </div>

        <div class="space-y-0">
            <!-- Row 1 -->
            <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded bg-[#f59e0b] text-white flex items-center justify-center text-xs font-bold">1</div>
                    <span class="font-medium text-[14px] text-gray-800">Bệnh viện Thẩm mỹ Kim Cương</span>
                </div>
                <div class="flex items-center gap-6">
                    <span class="text-[13px] text-gray-500 font-medium">5.0 <i class="pi pi-star-fill text-[#f59e0b] text-[10px] ml-0.5"></i></span>
                    <span class="font-bold text-primary text-[14px] min-w-[60px] text-right">60 điểm</span>
                </div>
            </div>
            
            <!-- Row 2 -->
            <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded bg-gray-200 text-gray-600 flex items-center justify-center text-xs font-bold">2</div>
                    <span class="font-medium text-[14px] text-gray-800">Thẩm mỹ viện Ngọc Dung</span>
                </div>
                <div class="flex items-center gap-6">
                    <span class="text-[13px] text-gray-500 font-medium">4.7 <i class="pi pi-star-fill text-[#f59e0b] text-[10px] ml-0.5"></i></span>
                    <span class="font-bold text-primary text-[14px] min-w-[60px] text-right">50 điểm</span>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded bg-gray-200 text-gray-600 flex items-center justify-center text-xs font-bold">3</div>
                    <span class="font-medium text-[14px] text-gray-800">Bệnh viện Thẩm mỹ Á Âu</span>
                </div>
                <div class="flex items-center gap-6">
                    <span class="text-[13px] text-gray-500 font-medium">4.4 <i class="pi pi-star-fill text-[#f59e0b] text-[10px] ml-0.5"></i></span>
                    <span class="font-bold text-primary text-[14px] min-w-[60px] text-right">40 điểm</span>
                </div>
            </div>

            <!-- Row 4 -->
            <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded bg-gray-200 text-gray-600 flex items-center justify-center text-xs font-bold">4</div>
                    <span class="font-medium text-[14px] text-gray-800">Thẩm mỹ viện Đông Á</span>
                </div>
                <div class="flex items-center gap-6">
                    <span class="text-[13px] text-gray-500 font-medium">4.1 <i class="pi pi-star-fill text-[#f59e0b] text-[10px] ml-0.5"></i></span>
                    <span class="font-bold text-primary text-[14px] min-w-[60px] text-right">30 điểm</span>
                </div>
            </div>

            <!-- Row 5 -->
            <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded bg-gray-200 text-gray-600 flex items-center justify-center text-xs font-bold">5</div>
                    <span class="font-medium text-[14px] text-gray-800">Bệnh viện Thẩm mỹ Hoàn Mỹ</span>
                </div>
                <div class="flex items-center gap-6">
                    <span class="text-[13px] text-gray-500 font-medium">3.8 <i class="pi pi-star-fill text-[#f59e0b] text-[10px] ml-0.5"></i></span>
                    <span class="font-bold text-primary text-[14px] min-w-[60px] text-right">20 điểm</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('postsChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Đã đăng', 'Nháp'],
                datasets: [{
                    data: [5, 5],
                    backgroundColor: [
                        '#4D8AFF', // Primary color
                        '#e5e7eb'  // Gray-200
                    ],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%', // Creates the donut hole, lower = thicker
                layout: {
                    padding: 20 // Prevents clipping on hover
                },
                plugins: {
                    legend: {
                        display: false // Hide default legend as we built a custom one
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.label + ': ' + context.raw + ' bài';
                            }
                        }
                    }
                }
            }
        });
        
    });
</script>
@endpush
