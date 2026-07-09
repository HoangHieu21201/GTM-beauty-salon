@extends('layouts.client')
@section('title', 'Về chúng tôi - Review Thẩm Mỹ')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 pb-12 pt-[18px]">
    <div class="mb-[16px]">
        <x-client.ui.breadcrumb :items="$breadcrumb" />
    </div>

    <div class="bg-white rounded-[12px] border border-[#e2e8f0] p-6 md:p-8 shadow-sm">
        <div class="text-[#334155] leading-relaxed">
            
            <h1 id="gioi-thieu" class="text-[28px] md:text-[32px] font-bold text-[#1F2733] mb-[6px] scroll-mt-[100px] relative pl-[16px] before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-[5px] before:h-[28px] before:bg-[#1668DC] before:rounded-full">Giới thiệu</h1>
            <div class="content text-[15px] mb-8">
                  <p class="mb-4"><strong>Review Thẩm Mỹ</strong> là hệ thống đánh giá và xếp hạng độc lập các cơ sở thẩm mỹ (bệnh viện thẩm mỹ, thẩm mỹ viện, phòng khám da liễu, nha khoa thẩm mỹ) tại Việt Nam. Chúng tôi ra đời với một mục tiêu đơn giản: giúp bạn <em>lựa chọn dịch vụ làm đẹp an toàn</em> giữa một thị trường có quá nhiều quảng cáo và quá ít thông tin kiểm chứng.</p>
                  
                  <h2 class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">Chúng tôi làm gì</h2>
                  <ul class="list-disc list-outside ml-5 space-y-2 mb-6">
                    <li><strong>Xếp hạng cơ sở thẩm mỹ</strong> dựa trên bộ tiêu chí công khai (xem <a href="{{ url('/chinh-sach#tieu-chi-danh-gia') }}" class="text-[#1668DC] hover:underline">Tiêu chí đánh giá</a>).</li>
                    <li><strong>Bài đánh giá chuyên sâu</strong> về từng dịch vụ: quy trình, chi phí tham khảo, rủi ro và lưu ý.</li>
                    <li><strong>Tổng hợp phản hồi thực tế</strong> từ khách hàng đã sử dụng dịch vụ, có kiểm duyệt.</li>
                  </ul>
                  
                  <h2 class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">Nguyên tắc hoạt động</h2>
                  <ul class="list-disc list-outside ml-5 space-y-2 mb-6">
                    <li><strong>Độc lập:</strong> thứ hạng không bán được bằng tiền. Nội dung hợp tác (nếu có) luôn được gắn nhãn rõ ràng.</li>
                    <li><strong>Khách quan:</strong> mọi nhận định dựa trên tiêu chí đo được và nguồn kiểm chứng được.</li>
                    <li><strong>An toàn trước tiên:</strong> chúng tôi ưu tiên yếu tố pháp lý, đội ngũ bác sĩ và quy trình y khoa hơn mọi yếu tố thương mại.</li>
                  </ul>
                  
                  <div class="bg-[#FFFBEB] border-l-4 border-[#F59E0B] p-4 rounded-r-[8px] my-6 text-[#92400E]">
                      <p class="m-0">⚠️ Nội dung trên website chỉ mang tính tham khảo, <strong>không thay thế tư vấn, chẩn đoán hoặc điều trị y khoa</strong>. Hãy tham khảo ý kiến bác sĩ chuyên khoa trước khi quyết định thực hiện bất kỳ dịch vụ thẩm mỹ nào.</p>
                  </div>
            </div>

            <div class="border-t border-[#e2e8f0] my-10"></div>

            <h1 id="lien-he" class="text-[28px] md:text-[32px] font-bold text-[#1F2733] mb-[6px] scroll-mt-[100px] relative pl-[16px] before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-[5px] before:h-[28px] before:bg-[#1668DC] before:rounded-full">Liên hệ</h1>
            <p class="text-[15px] mb-8">Bạn là chủ cơ sở thẩm mỹ muốn cập nhật thông tin, hoặc có góp ý về nội dung/xếp hạng? Liên hệ với chúng tôi qua email <a href="mailto:lienhe@reviewthammy.vn" class="text-[#1668DC] font-bold hover:underline">lienhe@reviewthammy.vn</a>. Chúng tôi phản hồi trong vòng 2 ngày làm việc.</p>

            <div class="border-t border-[#e2e8f0] my-10"></div>

            <h1 id="hop-tac" class="text-[28px] md:text-[32px] font-bold text-[#1F2733] mb-[6px] scroll-mt-[100px] relative pl-[16px] before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-[5px] before:h-[28px] before:bg-[#1668DC] before:rounded-full">Hợp tác</h1>
            <p class="text-[15px]">Trang Hợp tác đang được cập nhật. Vui lòng liên hệ với chúng tôi qua email <a href="mailto:lienhe@reviewthammy.vn" class="text-[#1668DC] font-bold hover:underline">lienhe@reviewthammy.vn</a> để biết thêm chi tiết.</p>

        </div>
    </div>
</div>
@endsection
