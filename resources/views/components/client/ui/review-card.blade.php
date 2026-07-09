@props(['item'])

<div class="bg-white rounded-[12px] p-[14px] flex flex-col md:flex-row gap-4 border border-[#e6e9ee] card-hover">
    <!-- Thumbnail -->
    <a href="{{ $item['url'] ?? '#' }}" class="w-full md:w-[210px] h-[140px] flex-shrink-0 rounded-[8px] overflow-hidden group">
        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
    </a>
    
    <!-- Content -->
    <div class="flex flex-col gap-[6px] flex-grow">
        <!-- Tag -->
        <div class="mb-0.5">
            <span class="inline-block bg-[#D9E7FF] text-[#1668DC] text-[11px] font-bold px-[7.5px] py-[3.75px] rounded-[4px] uppercase">
                {{ $item['category'] }}
            </span>
        </div>
        
        <!-- Title -->
        <a href="{{ $item['url'] ?? '#' }}" class="text-[#1F2733] text-[17px] font-bold hover:text-[#1668DC] transition-colors leading-[1.4]">
            {{ $item['title'] }}
        </a>
        
        <!-- Rating -->
        <div class="flex items-center gap-1.5 text-[13px]">
            @if(isset($item['rating']) && $item['rating'] > 0)
                <div class="flex text-[#F59E0B] gap-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    @if($item['rating'] == 5.0)
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[15px] h-[15px]"><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4V6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/></svg>
                    @endif
                </div>
                <span class="font-bold text-[#1F2733] ml-0.5">{{ $item['rating'] }}/5</span>
                <span class="text-gray-500 text-[13px]">&middot; {{ $item['votes'] }} bình chọn</span>
            @else
                <span class="text-[#6B7280] font-medium text-[13px]">Chưa có đánh giá</span>
            @endif
        </div>
        
        <!-- Excerpt -->
        <p class="text-[#6B7280] text-[13px] leading-[1.6] line-clamp-2 mt-0.5 pr-4">
            {{ $item['excerpt'] }}
        </p>
        
        <!-- Footer -->
        <div class="flex items-center text-[#6B7280] text-[13px] mt-1 pt-1">
            <div class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-[15px] h-[15px]">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                {{ $item['date'] }}
            </div>
            <a href="{{ $item['url'] ?? '#' }}" class="text-[#1668DC] font-medium flex items-center gap-1 hover:underline ml-4">
                Chi tiết <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
            </a>
        </div>
    </div>
</div>
