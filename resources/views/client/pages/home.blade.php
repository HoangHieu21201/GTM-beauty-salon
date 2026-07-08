@extends('layouts.client')

@section('title', 'Trang chủ - Review Thẩm Mỹ')

@section('content')
    <x-client.home.hero />
    
    <x-client.home.categories />

    <!-- Khối Đánh giá mới nhất -->
    <x-client.home.latest-reviews />

    <!-- Khối Xếp hạng Cơ sở Thẩm mỹ -->
    <x-client.home.clinics-ranking />

    <!-- Khối Kêu gọi hành động (CTA) -->
    <x-client.home.cta-band />

    <!-- Khối Bài viết hay nhất -->
    <x-client.home.best-articles />
@endsection
