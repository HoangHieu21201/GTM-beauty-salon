@extends('layouts.client')
@section('title', 'Chính sách & Điều khoản - Review Thẩm Mỹ')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 pb-12 pt-[18px]">
    <div class="mb-[16px]">
        <x-client.ui.breadcrumb :items="$breadcrumb" />
    </div>

    <div class="bg-white rounded-[12px] border border-[#e2e8f0] p-6 md:p-8 shadow-sm">
        <div class="text-[#334155] leading-relaxed">
            
            <h1 id="dieu-khoan-su-dung" class="text-[28px] md:text-[32px] font-bold text-[#1F2733] mb-[6px] scroll-mt-[100px] relative pl-[16px] before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-[5px] before:h-[28px] before:bg-[#1668DC] before:rounded-full">Điều khoản sử dụng</h1>
            <p class="text-[15px] mb-8">Nội dung Điều khoản sử dụng đang được cập nhật...</p>

            <div class="border-t border-[#e2e8f0] my-10"></div>

            <h1 id="chinh-sach-bao-mat" class="text-[28px] md:text-[32px] font-bold text-[#1F2733] mb-[6px] scroll-mt-[100px] relative pl-[16px] before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-[5px] before:h-[28px] before:bg-[#1668DC] before:rounded-full">Chính sách bảo mật</h1>
            <p class="text-[#64748b] text-[14px] italic mt-1 mb-6">Cập nhật lần cuối: 01/06/2026</p>
            <div class="content text-[15px] mb-8">
                  <h2 class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">1. Dữ liệu chúng tôi thu thập</h2>
                  <ul class="list-disc list-outside ml-5 space-y-2 mb-6">
                    <li><strong>Dữ liệu bạn cung cấp:</strong> họ tên và email (không bắt buộc) khi bình luận hoặc đánh giá.</li>
                    <li><strong>Dữ liệu tự động:</strong> số liệu truy cập ẩn danh (trang xem, nguồn truy cập, định danh ngẫu nhiên lưu trên trình duyệt) phục vụ thống kê.</li>
                  </ul>
                  
                  <h2 class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">2. Mục đích sử dụng</h2>
                  <ul class="list-disc list-outside ml-5 space-y-2 mb-6">
                    <li>Hiển thị bình luận/đánh giá sau kiểm duyệt.</li>
                    <li>Chống spam và thao túng đánh giá (mỗi lượt chấm sao được khớp với định danh ẩn danh + địa chỉ IP đã băm).</li>
                    <li>Thống kê lượt truy cập để cải thiện nội dung.</li>
                  </ul>
                  
                  <h2 class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">3. Chia sẻ dữ liệu</h2>
                  <p class="mb-4">Chúng tôi <strong>không bán, không chia sẻ</strong> dữ liệu cá nhân của bạn cho bên thứ ba, trừ khi có yêu cầu hợp pháp từ cơ quan chức năng.</p>
                  
                  <h2 class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">4. Lưu trữ &amp; bảo vệ</h2>
                  <p class="mb-4">Dữ liệu được lưu trên máy chủ có kiểm soát truy cập. Email người bình luận không hiển thị công khai.</p>
                  
                  <h2 class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">5. Quyền của bạn</h2>
                  <p class="mb-4">Bạn có quyền yêu cầu xem, sửa hoặc xóa dữ liệu cá nhân của mình bằng cách email tới <a href="mailto:lienhe@reviewthammy.vn" class="text-[#1668DC] hover:underline">lienhe@reviewthammy.vn</a>.</p>
                  
                  <h2 class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">6. Cookie &amp; lưu trữ cục bộ</h2>
                  <p class="mb-4">Website dùng localStorage cho các chức năng: ghi nhớ đã chấm sao bài viết và định danh khách truy cập ẩn danh. Bạn có thể xóa chúng bất kỳ lúc nào trong cài đặt trình duyệt.</p>
            </div>

            <div class="border-t border-[#e2e8f0] my-10"></div>

            <h1 id="tieu-chi-danh-gia" class="text-[28px] md:text-[32px] font-bold text-[#1F2733] mb-[6px] scroll-mt-[100px] relative pl-[16px] before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-[5px] before:h-[28px] before:bg-[#1668DC] before:rounded-full">Tiêu chí đánh giá</h1>
            <p class="text-[15px]">Nội dung Tiêu chí đánh giá đang được cập nhật...</p>

        </div>
    </div>
</div>
@endsection
