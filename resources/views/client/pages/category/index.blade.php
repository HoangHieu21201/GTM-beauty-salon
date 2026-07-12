@extends('layouts.client')

@section('title', $category['name'] . ' - Review Thẩm Mỹ')

@section('content')
<div class="max-w-[1200px] mx-auto pb-12">
    <!-- Breadcrumb -->
    <x-client.ui.breadcrumb :items="$breadcrumb" />

    @if($category['is_main'])
        <!-- Hub Head for Main Category -->
        <header class="hub-head mt-[6px] mb-[30px]">
            <h1 class="text-[32px] font-bold text-[#1F2733] mb-3">{{ $category['name'] }}</h1>
            <p class="hub-desc text-[15px] text-[#6B7785] mb-6 max-w-[800px] leading-relaxed">
                {{ $category['description'] }}
            </p>
            <div class="hub-chips flex flex-wrap gap-3">
                @foreach($category['children'] as $child)
                    <a href="{{ url('/bai-viet?type=sub&cat='.$child['slug']) }}" class="chip bg-[#E8F1FF] text-[#1668DC] hover:bg-[#1668DC] hover:text-white transition-colors px-[16px] py-[7px] rounded-full text-[13px] font-medium border border-transparent">
                        {{ $child['name'] }}
                    </a>
                @endforeach
            </div>
        </header>

        <!-- Top Clinics Section -->
        <div class="mb-12">
            <x-client.home.clinics-ranking :title="'TOP CƠ SỞ ' . mb_strtoupper($category['name'], 'UTF-8')" :icon="true" :clinics="$categoryClinics" />
        </div>
        
        <!-- Loop qua các danh mục con để hiển thị 1 dòng (4 bài) cho mỗi danh mục -->
        @foreach($category['children'] as $child)
            @php
                $childArticles = collect($articles)->filter(function($item) use ($child) {
                    return \Illuminate\Support\Str::slug($item['category']) === $child['slug'];
                })->all();
            @endphp
            @if(count($childArticles) > 0)
                <section class="mb-[34px]">
                    <x-client.ui.section-title :title="$child['name']" :link="url('/bai-viet?type=sub&cat='.$child['slug'])" />
                    <x-client.ui.posts-grid :articles="$childArticles" :limit="4" />
                </section>
            @endif
        @endforeach

    @else
        <!-- Section Title for Sub Category -->
        <x-client.ui.section-title :title="$category['name']" />

        <div class="mb-[34px]">
            <x-client.home.clinics-ranking :title="'TOP CƠ SỞ ' . mb_strtoupper($category['name'], 'UTF-8')" :icon="true" :clinics="$categoryClinics" :disableTopMargin="true" />
        </div>
        
        <!-- Hiển thị tất cả bài viết -->
        <div class="mb-[34px]">
            <x-client.ui.posts-grid :articles="$articles" />
        </div>

        <div class="flex justify-center mt-6">
            <button class="px-6 py-2 bg-white border border-[#1668DC] text-[#1668DC] text-[14px] font-medium rounded-[6px] hover:bg-[#1668DC] hover:text-white transition-colors">
                Xem thêm
            </button>
        </div>
    @endif
</div>
@endsection
