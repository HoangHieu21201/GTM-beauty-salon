<div class="max-w-[1200px] mx-auto px-4 mt-12 mb-8">
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-2.5">
            <div class="w-1.5 h-6 bg-[#1668DC] rounded-full"></div>
            <h2 class="text-[18px] font-bold text-[#0F2A4A] uppercase tracking-wide">Đánh giá mới nhất</h2>
        </div>
        <a href="#" class="text-[#1668DC] text-[14px] font-medium hover:underline flex items-center gap-1">
            Xem tất cả <span class="text-[16px]">&rarr;</span>
        </a>
    </div>

    <div class="flex flex-col gap-4">
        @php
            $reviews = [
                [
                    'category' => 'HÚT MỠ',
                    'title' => 'Hút mỡ bụng 2026: chi phí, công nghệ và những sự thật ít ai nói',
                    'rating' => 4.5,
                    'votes' => 2,
                    'excerpt' => 'Hút mỡ bụng không phải phương pháp giảm cân. Bài viết so sánh 3 công nghệ phổ biến, chi phí thực tế từng hạng mục và những sự thật quan trọng trước khi quyết định.',
                    'date' => '05/07/2026',
                    'image' => 'https://picsum.photos/seed/article-1/400/300'
                ],
                [
                    'category' => 'TRẺ HÓA DA',
                    'title' => 'Trẻ hóa da công nghệ cao: so sánh HIFU, RF và Laser chi tiết 2026',
                    'rating' => 5.0,
                    'votes' => 12,
                    'excerpt' => 'Phân tích ưu nhược điểm, chi phí và hiệu quả thực tế của các công nghệ trẻ hóa da hàng đầu hiện nay. Đâu là lựa chọn phù hợp nhất cho làn da của bạn?',
                    'date' => '04/07/2026',
                    'image' => 'https://picsum.photos/seed/article-2/400/300'
                ],
                [
                    'category' => 'NÂNG MŨI',
                    'title' => 'Nâng mũi cấu trúc và nâng mũi bọc sụn: Đâu là giải pháp an toàn?',
                    'rating' => 4.8,
                    'votes' => 45,
                    'excerpt' => 'Giải đáp thắc mắc thường gặp về hai phương pháp nâng mũi phổ biến nhất. So sánh độ bền, tính an toàn và chi phí để bạn có quyết định chính xác.',
                    'date' => '02/07/2026',
                    'image' => 'https://picsum.photos/seed/article-3/400/300'
                ],
                [
                    'category' => 'CẮT MÍ',
                    'title' => 'Kinh nghiệm cắt mí mắt: Quá trình hồi phục và cách chăm sóc',
                    'rating' => 4.9,
                    'votes' => 28,
                    'excerpt' => 'Cẩm nang chi tiết từ A-Z cho người lần đầu cắt mí. Hướng dẫn cách vệ sinh, ăn kiêng và những dấu hiệu cần liên hệ bác sĩ ngay.',
                    'date' => '01/07/2026',
                    'image' => 'https://picsum.photos/seed/article-4/400/300'
                ]
            ];
        @endphp

        @foreach($reviews as $item)
            <x-client.review-card :item="$item" />
        @endforeach
    </div>
</div>
