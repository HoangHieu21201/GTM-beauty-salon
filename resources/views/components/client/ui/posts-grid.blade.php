@props(['articles', 'limit' => null, 'cols' => 4])

@php
    $items = $limit ? array_slice($articles, 0, $limit) : $articles;
    $gridClass = match((int)$cols) {
        2 => 'grid-cols-1 md:grid-cols-2',
        3 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3',
        4 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4',
        default => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<div class="grid {{ $gridClass }} gap-[18px]">
    @foreach($items as $item)
        <x-client.ui.post-card :item="$item" />
    @endforeach
</div>
