@props(['title' => 'Xếp hạng cơ sở thẩm mỹ', 'icon' => false, 'hideTitle' => false, 'disableTopMargin' => false, 'clinics' => null])

<div class="{{ $disableTopMargin ? '' : 'max-w-[1200px] mx-auto px-4 mt-12 mb-8' }}">
    @if(!$hideTitle)
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-2.5">
            <div class="w-1.5 h-6 bg-[#1668DC] rounded-full"></div>
            <h2 class="text-[18px] font-bold text-[#0F2A4A] uppercase tracking-wide flex items-center gap-2">
                @if($icon) <span class="text-[20px]">🏆</span> @endif
                {{ $title }}
            </h2>
        </div>
        <a href="{{ request('cat') ? url('/bang-xep-hang?cat=' . request('cat')) : url('/bang-xep-hang') }}" class="text-[#1668DC] text-[14px] font-medium hover:underline flex items-center gap-1">
            Xem tất cả <span class="text-[16px]">&rarr;</span>
        </a>
    </div>
    @endif

    <div class="flex flex-col gap-[12px]">
        @php
    $clinics = collect($clinics ?? \App\Http\Controllers\Client\RankingController::rankedClinics(6))->values();
    $perPage = 8;
    $totalPages = max(1, (int) ceil($clinics->count() / $perPage));
    $currentPage = max(1, min((int) request('clinic_page', 1), $totalPages));
    $visibleClinics = $clinics->slice(($currentPage - 1) * $perPage, $perPage)->values();
    $pageUrl = fn (int $page) => request()->fullUrlWithQuery(['clinic_page' => $page]);
    $rankColor = function ($rank) {
        if ($rank == 1) return 'bg-gradient-to-br from-[#ff9d00] to-[#ff6a00]';
        if ($rank == 2) return 'bg-gradient-to-br from-[#7f93a8] to-[#5b6f86]';
        if ($rank == 3) return 'bg-gradient-to-br from-[#cd7f32] to-[#a9621f]';
        return 'bg-[#4B5563]';
    };
@endphp

        @forelse($visibleClinics as $clinic)
        <div class="bg-white rounded-[12px] p-4 flex flex-col md:flex-row items-center gap-4 border border-[#e6e9ee] card-hover">
            
            <!-- Rank Badge -->
            <div class="flex-shrink-0 w-full md:w-[80px] flex justify-center md:justify-start pl-2">
                <span class="{{ $rankColor($clinic['rank']) }} text-white text-[13px] font-bold px-3 py-1.5 rounded-[6px] shadow-sm tracking-wide">
                    TOP {{ $clinic['rank'] }}
                </span>
            </div>

            <!-- Thumbnail -->
            <a href="{{ url('/bang-xep-hang/chi-tiet/' . Str::slug($clinic['name'])) }}" class="w-full md:w-[150px] h-[100px] flex-shrink-0 rounded-[8px] overflow-hidden group relative">
                @if($clinic['featured'])
                    <div class="absolute top-1.5 left-1.5 z-10 bg-white/90 backdrop-blur-sm text-[#D9534F] text-[11px] font-bold px-2 py-0.5 rounded-[4px] shadow-sm">
                        Nổi bật
                    </div>
                @endif
                <img src="{{ $clinic['image'] }}" alt="{{ $clinic['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </a>
            
            <!-- Info -->
            <div class="flex flex-col flex-grow w-full gap-1.5 py-1">
                <div class="text-[#1668DC] text-[11px] font-bold uppercase tracking-wide">
                    {{ $clinic['category'] }}
                </div>
                
                <h3 class="text-[17px] font-bold text-[#1F2733] hover:text-[#1668DC] transition-colors leading-tight">
                    <a href="{{ url('/bang-xep-hang/chi-tiet/' . Str::slug($clinic['name'])) }}">{{ $clinic['name'] }}</a>
                </h3>
                
                <div class="flex items-center gap-1.5 text-[13px] mt-0.5">
                    <div class="flex text-[#F59E0B] gap-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        @if($clinic['rating'] == 5.0)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4V6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/></svg>
                        @endif
                    </div>
                    <span class="font-bold text-[#1F2733] ml-0.5">{{ number_format($clinic['rating'], 1) }}/5</span>
                    <span class="text-gray-500 text-[13px]">&middot; {{ $clinic['votes'] }} bình chọn</span>
                </div>
                
                <div class="flex items-center text-[#6B7280] text-[13px] mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-[14px] h-[14px] mr-1.5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    {{ $clinic['address'] }}
                </div>
            </div>

            <!-- Score & Action -->
            <div class="flex flex-col items-center justify-center flex-shrink-0 w-full md:w-[130px] md:border-l md:border-dashed border-[#e6e9ee] py-1">
                <div class="text-center mb-2">
                    <div class="text-[26px] font-bold text-[#1668DC] leading-none">{{ $clinic['score'] }}</div>
                    <div class="text-[12px] text-[#6B7280] mt-1">điểm</div>
                </div>
                
                <a href="{{ url('/bang-xep-hang/chi-tiet/' . Str::slug($clinic['name'])) }}" class="px-3.5 py-1.5 border border-[#cbe0fb] text-[#1668DC] text-[13px] font-medium rounded-[6px] flex items-center justify-center gap-1.5 hover:bg-[#e9f1fe] transition-colors w-full md:w-auto">
                    Chi tiết <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>
            
        </div>
        @empty
        <div class="bg-white rounded-[12px] p-6 border border-[#e6e9ee] text-center text-[#6B7280] text-[14px]">
            Chưa có cơ sở thẩm mỹ nào.
        </div>
        @endforelse
    </div>

    @if($totalPages > 1)
        <nav class="mt-6 flex items-center justify-center gap-2" aria-label="Phân trang cơ sở">
            @if($currentPage > 1)
                <a href="{{ $pageUrl($currentPage - 1) }}" class="min-w-[84px] h-10 px-4 rounded-[8px] border border-[#cbe0fb] bg-white text-[#1668DC] text-[14px] font-bold flex items-center justify-center hover:bg-[#e9f1fe] transition-colors">
                    Trước
                </a>
            @else
                <span class="min-w-[84px] h-10 px-4 rounded-[8px] border border-gray-200 bg-gray-100 text-gray-400 text-[14px] font-bold flex items-center justify-center cursor-not-allowed">
                    Trước
                </span>
            @endif

            <span class="min-w-[72px] h-10 px-4 rounded-[8px] border border-[#1668DC] bg-[#1668DC] text-white text-[14px] font-bold flex items-center justify-center shadow-sm">
                {{ $currentPage }} / {{ $totalPages }}
            </span>

            @if($currentPage < $totalPages)
                <a href="{{ $pageUrl($currentPage + 1) }}" class="min-w-[84px] h-10 px-4 rounded-[8px] border border-[#cbe0fb] bg-white text-[#1668DC] text-[14px] font-bold flex items-center justify-center hover:bg-[#e9f1fe] transition-colors">
                    Sau
                </a>
            @else
                <span class="min-w-[84px] h-10 px-4 rounded-[8px] border border-gray-200 bg-gray-100 text-gray-400 text-[14px] font-bold flex items-center justify-center cursor-not-allowed">
                    Sau
                </span>
            @endif
        </nav>
    @endif
</div>
