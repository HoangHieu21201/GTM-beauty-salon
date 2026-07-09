@props(['items'])

<nav class="crumb h-[20px] mt-[18px] mb-[14px] flex items-center text-[#6B7785] text-[13px]">
    @foreach($items as $index => $item)
        @if($index > 0)
            <span class="mx-1.5 text-[11px]">&rsaquo;</span>
        @endif
        @if(isset($item['url']))
            <a href="{{ $item['url'] }}" class="text-[#1668DC] hover:underline transition-colors">{{ $item['label'] }}</a>
        @else
            <span>{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
