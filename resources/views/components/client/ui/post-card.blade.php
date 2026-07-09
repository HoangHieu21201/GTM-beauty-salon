@props(['item'])

<div class="bg-white rounded-[12px] border border-[#e6e9ee] overflow-hidden card-hover flex flex-col h-full">
    <a href="{{ $item['url'] }}" class="relative block w-full h-[180px] group overflow-hidden flex-shrink-0">
        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        <span class="absolute bottom-3 left-3 bg-[#e9f1fe]/90 backdrop-blur-sm text-[#1668DC] text-[11px] font-bold px-[7.5px] py-[3.75px] rounded-[4px] uppercase shadow-sm">
            {{ $item['category'] }}
        </span>
    </a>
    <div class="p-[16px] flex flex-col flex-grow">
        <h3 class="text-[16px] font-bold text-[#1F2733] mb-2 line-clamp-2 hover:text-[#1668DC] transition-colors leading-[1.4]">
            <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
        </h3>
        <p class="text-[#6B7280] text-[13.5px] leading-[1.6] line-clamp-2 mb-4 flex-grow">
            {{ $item['excerpt'] }}
        </p>
        <div class="flex items-center justify-between text-[#6B7280] text-[13px] pt-1">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-[15px] h-[15px]">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    {{ $item['date'] }}
                </div>
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-[15px] h-[15px]">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    {{ $item['views'] }}
                </div>
            </div>
        </div>
    </div>
</div>
