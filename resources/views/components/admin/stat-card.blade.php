@props(['color', 'icon', 'value', 'label', 'hasArrow' => false, 'href' => '#', 'isButton' => true])

@if($isButton)
<a href="{{ $href }}" class="bg-white p-4 lg:p-[18px] rounded-card shadow-sm border border-gray-100 flex items-center gap-3 relative group transition-all duration-300 hover:border-gray-200 hover:shadow-md hover:-translate-y-1 cursor-pointer overflow-hidden block w-full">
@else
<div class="bg-white p-4 lg:p-[18px] rounded-card shadow-sm border border-gray-100 flex items-center gap-3 relative overflow-hidden block w-full">
@endif
    <div class="w-[50px] h-[50px] flex-shrink-0 rounded-xl text-white flex items-center justify-center shadow-inner" style="background-color: {{ $color }}">
        <i class="{{ $icon }} text-[15px]"></i>
    </div>
    <div class="min-w-0 pr-4">
        <div class="text-[20px] font-black text-gray-800 leading-none mb-1">{{ $value }}</div>
        <div class="text-[12.5px] font-semibold text-gray-500 whitespace-nowrap">{{ $label }}</div>
    </div>
    @if($hasArrow)
    <svg class="absolute top-4 right-4 text-gray-300 group-hover:text-gray-500 transition-colors" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
    @endif
@if($isButton)
</a>
@else
</div>
@endif
