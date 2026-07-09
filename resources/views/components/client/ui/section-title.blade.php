@props(['title', 'link' => null])

<div class="section-title mb-[18px] flex items-center justify-between w-full">
    <div class="h-[26px] flex items-center">
        <h2 class="text-[20px] font-bold text-[#1F2733] pl-[14px] leading-[26px] uppercase relative before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-1 before:h-[20px] before:bg-[#1668DC] before:rounded-full">{{ $title }}</h2>
    </div>
    @if($link)
        <a href="{{ $link }}" class="text-[#1668DC] text-[13px] font-medium hover:underline flex items-center gap-1">
            Xem tất cả <span class="text-[16px]">&rarr;</span>
        </a>
    @endif
</div>
