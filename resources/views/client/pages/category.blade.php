@extends('layouts.client')

@section('title', $category['name'] . ' - Review Thẩm Mỹ')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 pb-12">
    <!-- Breadcrumb -->
    <x-client.breadcrumb :items="$breadcrumb" />

    @if($category['is_main'])
        <!-- Hub Head for Main Category -->
        <header class="hub-head mt-2 mb-10">
            <h1 class="text-[32px] font-bold text-[#1F2733] mb-3">{{ $category['name'] }}</h1>
            <p class="hub-desc text-[15px] text-[#6B7785] mb-6 max-w-[800px] leading-relaxed">
                {{ $category['description'] }}
            </p>
            <div class="hub-chips flex flex-wrap gap-3">
                @foreach($category['children'] as $child)
                    <a href="{{ url('/bai-viet?type=sub&cat='.$child['slug']) }}" class="chip bg-[#F0F5FF] text-[#1668DC] hover:bg-[#1668DC] hover:text-white transition-colors px-5 py-2.5 rounded-full text-[14px] font-medium border border-transparent hover:border-[#1668DC]/20">
                        {{ $child['name'] }}
                    </a>
                @endforeach
            </div>
        </header>

        <!-- Top Clinics Section -->
        <div class="mb-12">
            <x-client.home.clinics-ranking :title="'TOP CƠ SỞ ' . mb_strtoupper($category['name'], 'UTF-8')" :icon="true" />
        </div>
        
        <!-- Loop qua các danh mục con để hiển thị 1 dòng (4 bài) cho mỗi danh mục -->
        @foreach($category['children'] as $child)
            <section class="mb-[34px]">
                <x-client.section-title :title="$child['name']" :link="url('/bai-viet?type=sub&cat='.$child['slug'])" />
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-[18px]">
                    @foreach(array_slice($articles, 0, 4) as $item)
                        <x-client.article-card :item="$item" />
                    @endforeach
                </div>
            </section>
        @endforeach

    @else
        <!-- Section Title for Sub Category -->
        <x-client.section-title :title="$category['name']" />
        
        <!-- Hiển thị tất cả bài viết (ví dụ 8 bài = 2 dòng) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-[18px] mb-[34px]">
            @foreach($articles as $item)
                <x-client.article-card :item="$item" />
            @endforeach
        </div>

        <div class="flex justify-center mt-6">
            <button class="px-6 py-2 bg-white border border-[#1668DC] text-[#1668DC] text-[14px] font-medium rounded-[6px] hover:bg-[#1668DC] hover:text-white transition-colors">
                Xem thêm
            </button>
        </div>
    @endif
</div>
@endsection
