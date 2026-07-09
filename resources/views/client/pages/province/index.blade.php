@extends('layouts.client')

@section('title', 'Bài viết theo tỉnh thành - Review Thẩm Mỹ')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 pb-12">
    <!-- Breadcrumb -->
    <x-client.ui.breadcrumb :items="[['label' => 'Trang chủ', 'url' => url('/')], ['label' => 'Tỉnh thành']]" />

    <!-- Hub Head -->
    <header class="hub-head mt-[6px] mb-[30px]">
        <div class="flex items-center gap-1.5 text-[#1668DC] text-[13px] font-bold uppercase tracking-wider mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
            </svg>
            KHÁM PHÁ THEO KHU VỰC
        </div>
        <h1 class="text-[32px] font-bold text-[#1F2733] mb-3">Bài viết theo tỉnh thành</h1>
        <p class="hub-desc text-[15px] text-[#6B7785] max-w-[800px] leading-relaxed">
            Tổng hợp bài viết, đánh giá và xếp hạng cơ sở thẩm mỹ tại 34 tỉnh, thành phố trên cả nước — chọn khu vực của bạn để xem thông tin phù hợp nhất.
        </p>
    </header>

    <!-- Các Vùng Miền -->
    <style>
        .provinces-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(215px, 1fr));
            gap: 12px;
        }
    </style>
    @foreach($regions as $index => $region)
        <section class="{{ $index !== count($regions) - 1 ? 'mb-[34px]' : 'mb-8' }}">
            <div class="flex justify-between items-end mb-[14px]">
                <h2 class="text-[20px] font-bold text-[#1F2733]">{{ $region['name'] }}</h2>
                <span class="text-[#6B7785] text-[13.5px] font-medium">{{ $region['count'] }} tỉnh thành</span>
            </div>

            <div class="provinces-grid">
                @foreach($region['provinces'] as $province)
                    @php
                        $hasPosts = $province['posts'] > 0;
                        $iconBg = $hasPosts ? 'bg-[#f0f5ff]' : 'bg-[#f8fafc]';
                        $iconColor = $hasPosts ? 'text-[#1668DC]' : 'text-[#94a3b8]';
                        $titleColor = $hasPosts ? 'text-[#1F2733]' : 'text-[#64748b]';
                        $subtitleColor = $hasPosts ? 'text-[#1668DC]' : 'text-[#94a3b8]';
                        $arrowColor = $hasPosts ? 'text-[#cbd5e1] group-hover:text-[#1668DC]' : 'text-[#e2e8f0]';
                    @endphp
                    <a href="{{ $hasPosts ? url('/tinh-thanh/' . $province['slug']) : 'javascript:void(0)' }}" class="group bg-white rounded-[12px] border border-[#e6e9ee] p-3 flex items-center justify-between {{ $hasPosts ? 'hover:border-[#1668DC] hover:shadow-[0_4px_12px_rgba(0,0,0,0.08)] hover:-translate-y-1' : 'cursor-default' }} transition-all duration-150">
                        <div class="flex items-center gap-3">
                            <div class="w-[42px] h-[42px] rounded-[8px] flex items-center justify-center flex-shrink-0 {{ $iconBg }} {{ $iconColor }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-[18px] h-[18px]">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-[14.5px] font-bold {{ $titleColor }} leading-none">{{ $province['name'] }}</span>
                                <span class="text-[12.5px] font-medium {{ $subtitleColor }}">{{ $hasPosts ? $province['posts'] . ' bài viết' : 'Sắp có bài viết' }}</span>
                            </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 {{ $arrowColor }} transition-colors">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach
</div>
@endsection
