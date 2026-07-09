@extends('layouts.client')

@section('title', 'Thẩm mỹ tại ' . $province['name'] . ' - Review Thẩm Mỹ')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 pb-12">
    <!-- Breadcrumb -->
    <x-client.ui.breadcrumb :items="$breadcrumb" />

    <!-- Hub Head -->
    <header class="hub-head mt-[6px] mb-[30px]">
        <div class="flex items-center gap-1.5 text-[#1668DC] text-[13px] font-bold uppercase tracking-wider mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
            </svg>
            {{ $province['region'] }}
        </div>
        <h1 class="text-[32px] font-bold text-[#1F2733] mb-3">Thẩm mỹ tại {{ $province['name'] }}</h1>
        <p class="hub-desc text-[15px] text-[#6B7785] mb-6 max-w-[800px] leading-relaxed">
            Tổng hợp bài viết, đánh giá và xếp hạng các cơ sở thẩm mỹ uy tín tại {{ $province['name'] }} — thông tin khách quan, minh bạch, cập nhật liên tục.
        </p>
        <div class="hub-chips flex flex-wrap gap-3">
            @if($province['name'] === 'Hà Nội')
                <a href="{{ url('/tinh-thanh/hai-phong') }}" class="chip bg-[#E8F1FF] text-[#1668DC] hover:bg-[#1668DC] hover:text-white transition-colors px-[16px] py-[7px] rounded-full text-[13px] font-medium border border-transparent">
                    Hải Phòng
                </a>
            @elseif($province['name'] === 'Hải Phòng')
                <a href="{{ url('/tinh-thanh/ha-noi') }}" class="chip bg-[#E8F1FF] text-[#1668DC] hover:bg-[#1668DC] hover:text-white transition-colors px-[16px] py-[7px] rounded-full text-[13px] font-medium border border-transparent">
                    Hà Nội
                </a>
            @endif
            <a href="{{ url('/tinh-thanh') }}" class="chip ghost text-[#6B7785] hover:text-[#1668DC] transition-colors px-[16px] py-[7px] text-[13px] font-medium flex items-center gap-1">
                Tất cả tỉnh thành &rarr;
            </a>
        </div>
    </header>

    <!-- Articles Grid Component -->
    <div class="mb-[34px]">
        <x-client.ui.posts-grid :articles="$articles" />
    </div>

    <!-- Pagination / View More -->
    <div class="flex justify-center mt-6">
        <!-- TODO: Wire up pagination or load-more logic -->
        <button class="px-6 py-2 bg-white border border-[#1668DC] text-[#1668DC] text-[14px] font-medium rounded-[6px] hover:bg-[#1668DC] hover:text-white transition-colors">
            Xem thêm
        </button>
    </div>
</div>
@endsection
