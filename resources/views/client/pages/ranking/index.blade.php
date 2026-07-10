@extends('layouts.client')
@section('title', 'Bảng xếp hạng cơ sở thẩm mỹ')

@section('content')
<div class="bg-white">
    <div class="max-w-[1200px] mx-auto px-4 pb-12">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <x-client.ui.breadcrumb :items="$breadcrumb" />
        </div>

        <x-client.ui.section-title title="BẢNG XẾP HẠNG CƠ SỞ THẨM MỸ" />
        <p class="text-[#6B7785] text-[15px] mb-8 -mt-2">Xếp theo điểm đánh giá tổng hợp. Cơ sở đứng đầu là lựa chọn được đánh giá cao nhất.</p>

        <!-- Ranking Component without internal title and spacing -->
        <x-client.home.clinics-ranking :hideTitle="true" :disableTopMargin="true" :clinics="$clinics" />
    </div>
</div>
@endsection
