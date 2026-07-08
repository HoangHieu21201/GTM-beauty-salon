@props(['title', 'subtitle' => null])

<div class="flex flex-col md:flex-row justify-between items-start mb-6 gap-4">
    <div>
        <h1 class="text-[24px] font-bold text-[#1F2733] mb-1">{!! $title !!}</h1>
        @if($subtitle)
            <p class="text-[15px] text-[#6B7785] mt-1">{{ $subtitle }}</p>
        @endif
    </div>
    <div class="flex gap-3">
        {{ $slot }}
    </div>
</div>
