@extends('layouts.client')

@section('title', 'Tìm kiếm: ' . $query . ' - Review Thẩm Mỹ')

@section('content')
<div class="max-w-[1200px] mx-auto pb-12 mt-6">
    <!-- Breadcrumb -->
    <x-client.ui.breadcrumb :items="$breadcrumb" />

    <header class="hub-head mt-[6px] mb-[30px]">
        <h1 class="text-[32px] font-bold text-[#1F2733] mb-3">Kết quả tìm kiếm cho: "{{ $query }}"</h1>
        <p class="hub-desc text-[15px] text-[#6B7785] mb-6 max-w-[800px] leading-relaxed">
            @if(empty(trim($query)))
                Vui lòng nhập từ khóa để tìm kiếm.
            @elseif($posts->isEmpty() && $salons->isEmpty() && $categories->isEmpty() && $provinces->isEmpty())
                Rất tiếc, không tìm thấy kết quả nào phù hợp với từ khóa của bạn.
            @else
                Tìm thấy nhiều kết quả phù hợp trên hệ thống.
            @endif
        </p>
    </header>

    @if(!empty(trim($query)))
        @if($salons->isNotEmpty())
            <!-- Top Clinics Section -->
            <div class="mb-[34px]">
                <x-client.home.clinics-ranking :title="'Cơ sở thẩm mỹ phù hợp'" :icon="true" :clinics="$salons" :hideTitle="false" :disableTopMargin="true" />
            </div>
        @endif

        @if($posts->isNotEmpty())
            <!-- Posts Section -->
            <section class="mb-[34px]">
                <x-client.ui.section-title :title="'Bài viết liên quan'" />
                <x-client.ui.posts-grid :articles="$posts" />
            </section>
        @endif

        @if($categories->isNotEmpty() || $provinces->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-[34px]">
                @if($categories->isNotEmpty())
                    <section class="bg-white rounded-[12px] border border-[#e6e9ee] p-6 shadow-sm">
                        <h3 class="text-[18px] font-bold text-[#1F2733] mb-4 border-b pb-2">Danh mục</h3>
                        <div class="flex flex-col gap-3">
                            @foreach($categories as $category)
                                <a href="{{ url('/bai-viet?type=sub&cat=' . Str::slug($category->name)) }}" class="text-[#1668DC] hover:underline font-medium text-[15px] flex items-center">
                                    <i class="pi pi-folder-open mr-2 text-[#6B7785]"></i> {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                @if($provinces->isNotEmpty())
                    <section class="bg-white rounded-[12px] border border-[#e6e9ee] p-6 shadow-sm">
                        <h3 class="text-[18px] font-bold text-[#1F2733] mb-4 border-b pb-2">Địa điểm / Tỉnh thành</h3>
                        <div class="flex flex-col gap-3">
                            @foreach($provinces as $province)
                                <a href="{{ url('/tinh-thanh/' . Str::slug($province->name)) }}" class="text-[#1668DC] hover:underline font-medium text-[15px] flex items-center">
                                    <i class="pi pi-map-marker mr-2 text-[#6B7785]"></i> {{ $province->name }}
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif
            </div>
        @endif
    @endif
</div>
@endsection
