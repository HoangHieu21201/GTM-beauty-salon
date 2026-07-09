@extends('layouts.client')
@section('title', $article['title'])

@section('content')
<div class="max-w-[1200px] mx-auto px-4 pb-12">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <x-client.ui.breadcrumb :items="$breadcrumb" />
    </div>

    <!-- Main grid -->
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main content column -->
        <div class="flex-1 min-w-0">
            <article class="bg-white rounded-[12px] border border-[#e2e8f0] p-6 shadow-sm">
                <!-- Article Header Container -->
                <div class="mb-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-[#F0F5FF] text-[#1668DC] px-3 py-1 rounded-[4px] text-[13px] font-bold">{{ $article['category'] }}</span>
                    </div>

                    <div class="flex items-center gap-2 mb-3">
                        <div class="flex text-[#f59e0b] text-[12px]">
                            <i class="pi pi-star-fill"></i>
                            <i class="pi pi-star-fill"></i>
                            <i class="pi pi-star-fill"></i>
                            <i class="pi pi-star-fill"></i>
                            <i class="pi pi-star-fill"></i>
                        </div>
                        <span class="text-[#94a3b8] text-[13px]">Hãy là người đầu tiên đánh giá bài viết</span>
                    </div>

                    <h1 class="text-[28px] lg:text-[32px] font-bold text-[#1F2733] leading-[1.3] mb-4">
                        {{ $article['title'] }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-y-2 gap-x-6 text-[13px] mb-4">
                        <div class="flex flex-col">
                            <span class="text-[#94a3b8] mb-0.5">Cập nhật</span>
                            <strong class="text-[#1F2733]">{{ $article['date'] }}</strong>
                        </div>
                        <div class="w-[1px] h-8 bg-[#e2e8f0]"></div>
                        <div class="flex flex-col">
                            <span class="text-[#94a3b8] mb-0.5">Tác giả / Reviewer</span>
                            <b class="text-[#1668DC]">{{ $article['author'] }}</b>
                        </div>
                        <div class="w-[1px] h-8 bg-[#e2e8f0]"></div>
                        <div class="flex flex-col">
                            <span class="text-[#94a3b8] mb-0.5">Chuyên mục</span>
                            <a href="#" class="text-[#1668DC] font-bold hover:underline">{{ $article['category'] }}</a>
                        </div>
                        <div class="w-[1px] h-8 bg-[#e2e8f0]"></div>
                        <div class="flex flex-col">
                            <span class="text-[#94a3b8] mb-0.5">Địa điểm</span>
                            <div class="text-[#1668DC] font-bold">
                                {{ $article['locations'] }}
                            </div>
                        </div>
                    </div>

                    <style>
                        .btn-lift {
                            transition: all 0.2s ease;
                        }
                        .btn-lift:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                        }
                        .shb-fb:hover { background-color: #1877F2 !important; border-color: #1877F2 !important; color: white !important; }
                        .shb-x:hover { background-color: #000000 !important; border-color: #000000 !important; color: white !important; }
                        .shb-more:hover { background-color: #1877F2 !important; border-color: #1877F2 !important; color: white !important; }
                        .shb-copy:hover { border-color: #1668DC !important; color: #1668DC !important; background-color: white !important; }
                    </style>
                    <div class="flex flex-wrap items-center justify-between gap-4 py-3 border-y border-[#e2e8f0] mb-4">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="btn-lift inline-flex items-center gap-1 bg-[#E8F1FF] text-[#1668DC] px-3 py-1.5 rounded-full text-[12px] font-bold cursor-default">
                                <i class="pi pi-check-circle"></i> ĐÃ KIỂM DUYỆT
                            </span>
                            <a href="#binh-luan" class="btn-lift inline-flex items-center gap-1 bg-[#f1f5f9] text-[#475569] hover:bg-[#e2e8f0] transition-colors px-3 py-1.5 rounded-full text-[12px] font-bold">
                                BÌNH LUẬN ( 0 )
                            </a>
                            <a href="https://news.google.com/search?q=Review%20Th%E1%BA%A9m%20M%E1%BB%B9%20review&hl=vi&gl=VN" target="_blank" rel="noopener" class="btn-lift inline-flex items-center gap-1 bg-[#f1f5f9] hover:bg-[#e2e8f0] transition-colors px-3 py-1.5 rounded-full text-[13px] text-[#1F2733] font-semibold">
                                Review Thẩm Mỹ trên <span class="font-bold tracking-wide"><span class="text-[#4285F4]">G</span><span class="text-[#EA4335]">o</span><span class="text-[#FBBC05]">o</span><span class="text-[#4285F4]">g</span><span class="text-[#34A853]">l</span><span class="text-[#EA4335]">e</span></span>&nbsp;News
                            </a>
                        </div>
                        <div class="text-[#64748b] text-[13px] flex items-center gap-2">
                            <span><i class="pi pi-eye"></i> {{ $article['views'] }} lượt xem</span>
                            <span>•</span>
                            <span><i class="pi pi-clock"></i> {{ $article['read_time'] }} phút đọc</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-[#64748b] text-[13px] flex items-center gap-1">
                            <svg viewBox="0 0 448 512" width="14" height="14" fill="currentColor"><path d="M352 320c-22.6 0-43.3 8.3-59.3 22.2l-122.9-73.7c1.4-8.8 2.2-17.8 2.2-27.1s-.8-18.3-2.2-27.1l122.9-73.7c16 13.9 36.7 22.2 59.3 22.2 53 0 96-43 96-96s-43-96-96-96-96 43-96 96c0 9.3 .8 18.3 2.2 27.1l-122.9 73.7C121.3 156.3 100.6 148 78 148c-43.1 0-78 34.9-78 78s34.9 78 78 78c22.6 0 43.3-8.3 59.3-22.2l122.9 73.7c-1.4 8.8-2.2 17.8-2.2 27.1 0 53 43 96 96 96s96-43 96-96-43-96-96-96z"/></svg>
                            Chia sẻ:
                        </span>
                        <button type="button" title="Chia sẻ Facebook" class="btn-lift shb-fb w-8 h-8 rounded-full border border-[#e2e8f0] flex items-center justify-center text-[#1F2733] bg-white transition-all duration-200">
                            <svg viewBox="0 0 320 512" width="13" height="13" fill="currentColor"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
                        </button>
                        <button type="button" title="Chia sẻ X" class="btn-lift shb-x w-8 h-8 rounded-full border border-[#e2e8f0] flex items-center justify-center text-[#1F2733] bg-white transition-all duration-200">
                            <svg viewBox="0 0 512 512" width="12" height="12" fill="currentColor"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                        </button>
                        <button type="button" title="Thêm..." class="btn-lift shb-more w-8 h-8 rounded-full border border-[#e2e8f0] flex items-center justify-center text-[#1F2733] bg-white transition-all duration-200">
                            <svg viewBox="0 0 448 512" width="14" height="14" fill="currentColor"><path d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"/></svg>
                        </button>
                        <button type="button" title="Copy liên kết" class="btn-lift shb-copy h-8 px-3.5 rounded-full border border-[#e2e8f0] flex items-center justify-center gap-1.5 text-[#1F2733] bg-white text-[13px] font-semibold transition-all duration-200 ml-1">
                            <svg viewBox="0 0 640 512" width="13" height="13" fill="currentColor"><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.6 0 114.1L511.2 246c-31.5 31.5-82.6 31.5-114.1 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C295.5 162.5 302 241.3 352 291.3c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L128.8 266c31.5-31.5 82.6-31.5 114.1 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C344.5 349.5 338 270.7 288 220.7c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/></svg>
                            Sao chép link
                        </button>
                    </div>
                </div>

                <!-- Article Featured Image -->
                <div class="mb-6 rounded-[12px] overflow-hidden shadow-sm">
                    <img src="https://picsum.photos/seed/article-4/800/500" alt="Article Cover" class="w-full h-auto object-cover max-h-[500px]" />
                </div>

                <!-- Table of Contents -->
                <nav class="bg-[#F8FAFC] rounded-[8px] border border-[#e2e8f0] p-5 mb-8">
                    <div class="flex items-center gap-2 mb-3">
                        <strong class="text-[16px] text-[#1F2733]">Nội Dung Chính</strong>
                        <button class="text-[#1668DC] text-[13px] hover:underline">[Ẩn]</button>
                    </div>
                    <ol class="list-decimal list-inside space-y-2 text-[#1668DC] text-[15px]">
                        <li><a href="#muc-1" class="hover:underline">Bảng giá bọc răng sứ 2026</a></li>
                        <li><a href="#muc-2" class="hover:underline">5 câu phải hỏi trước khi đồng ý mài răng</a></li>
                        <li><a href="#muc-3" class="hover:underline">Bọc sứ giá rẻ — rủi ro nằm ở đâu?</a></li>
                        <li><a href="#muc-4" class="hover:underline">Kết luận</a></li>
                    </ol>
                </nav>

                <!-- Article Content -->
                <div class="prose max-w-none text-[#334155] leading-relaxed mb-8">
                    <p>"<strong>Bọc răng sứ giá</strong> bao nhiêu?" là câu hỏi có câu trả lời dao động gấp 15 lần giữa các phòng khám — từ 1 triệu đến 15 triệu mỗi răng. Chênh lệch này có lý do chính đáng, và cũng có cả bẫy. Bài viết giúp bạn phân biệt hai thứ đó.</p>
                    
                    <h2 id="muc-1" class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">Bảng giá bọc răng sứ 2026</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[600px]">
                            <thead>
                                <tr class="border-b-2 border-[#e2e8f0]">
                                    <th class="py-3 px-4 font-bold text-[#1F2733]">Dòng sứ</th>
                                    <th class="py-3 px-4 font-bold text-[#1F2733]">Giá/răng</th>
                                    <th class="py-3 px-4 font-bold text-[#1F2733]">Tuổi thọ</th>
                                    <th class="py-3 px-4 font-bold text-[#1F2733]">Đặc điểm</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e2e8f0]">
                                <tr>
                                    <td class="py-3 px-4">Sứ kim loại</td>
                                    <td class="py-3 px-4">1–2.5 triệu</td>
                                    <td class="py-3 px-4">5–8 năm</td>
                                    <td class="py-3 px-4">Rẻ, lâu ngày đen viền nướu, hợp răng hàm</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4">Sứ toàn phần (Zirconia)</td>
                                    <td class="py-3 px-4">3–8 triệu</td>
                                    <td class="py-3 px-4">10–15 năm</td>
                                    <td class="py-3 px-4">Trong tự nhiên, không đen viền — lựa chọn phổ biến nhất</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4">Sứ cao cấp (Ceramill, Lava, Emax)</td>
                                    <td class="py-3 px-4">8–15 triệu</td>
                                    <td class="py-3 px-4">15–20 năm</td>
                                    <td class="py-3 px-4">Độ trong như răng thật, hợp răng cửa, có thẻ bảo hành chính hãng</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <blockquote class="bg-[#FFFBEB] border-l-4 border-[#F59E0B] p-4 rounded-r-[8px] my-6 text-[#92400E]">
                        <strong>⚠️ Cảnh báo quan trọng:</strong> mài răng là thủ thuật <em>không thể hoàn tác</em>. Răng đã mài phải mang mão sứ suốt đời. Vì vậy đừng bao giờ quyết định trong buổi tư vấn đầu tiên, và tuyệt đối tránh các gói "bọc 20 răng giá sốc" — răng khỏe không có lý do gì phải mài đi 20 chiếc.
                    </blockquote>

                    <img src="https://picsum.photos/seed/article-rangsu-body/800/500" alt="Các mão răng sứ zirconia trên mẫu hàm tại labo nha khoa" class="w-full rounded-[8px] my-6">

                    <h2 id="muc-2" class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">5 câu phải hỏi trước khi đồng ý mài răng</h2>
                    <ol class="list-decimal list-outside ml-5 space-y-2">
                        <li><strong>"Răng tôi có thực sự cần bọc không, hay chỉ cần tẩy trắng/dán veneer?"</strong> — veneer chỉ mài 0.3–0.5mm, bảo tồn răng gấp nhiều lần.</li>
                        <li><strong>"Ai là người mài răng — bác sĩ hay phụ tá?"</strong> — chỉ bác sĩ có chứng chỉ hành nghề được làm.</li>
                        <li><strong>"Sứ này của hãng nào, có thẻ bảo hành chính hãng không?"</strong> — sứ xịn luôn có thẻ điện tử tra cứu được.</li>
                        <li><strong>"Có chụp phim kiểm tra tủy trước khi mài không?"</strong> — bỏ qua bước này là nguyên nhân số 1 gây đau tủy sau bọc.</li>
                        <li><strong>"Chính sách nếu mão sứ hở, cộm, lệch khớp cắn?"</strong> — phải có cam kết chỉnh sửa miễn phí bằng văn bản.</li>
                    </ol>

                    <h2 id="muc-3" class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">Bọc sứ giá rẻ — rủi ro nằm ở đâu?</h2>
                    <ul class="list-disc list-outside ml-5 space-y-2">
                        <li>Mài quá tay cho nhanh → xâm phạm tủy, đau kéo dài, phải điều trị tủy</li>
                        <li>Sứ không rõ nguồn gốc → đổi màu, sứt mẻ sau 1–2 năm</li>
                        <li>Mão không khít → giắt thức ăn, hôi miệng, sâu răng bên trong mão</li>
                    </ul>

                    <h2 id="muc-4" class="text-[22px] font-bold text-[#1F2733] mt-8 mb-4">Kết luận</h2>
                    <p>Mức hợp lý nhất 2026 cho răng cửa là <strong>sứ toàn phần 4–6 triệu/răng</strong> tại phòng khám có labo riêng. Nếu răng bạn lệch lạc nhiều, cân nhắc <a href="#" class="text-[#1668DC] hover:underline">niềng răng</a> trước thay vì bọc sứ cả hàm — chậm hơn nhưng giữ được răng thật. Xem điểm đánh giá các phòng khám nha tại <a href="#" class="text-[#1668DC] hover:underline">bảng xếp hạng</a>, nổi bật là <a href="#" class="text-[#1668DC] hover:underline">Bệnh viện Thẩm mỹ Hoàn Mỹ</a> và <a href="#" class="text-[#1668DC] hover:underline">Thẩm mỹ viện Sài Gòn Venus</a>.</p>
                </div>

                <hr class="border-t border-dashed border-[#e2e8f0] my-8" />

                <!-- Related Clinics -->
                <div class="mb-8">
                    <h3 class="text-[18px] font-bold text-[#1F2733] mb-4">Cơ sở liên quan</h3>
                    <div class="flex flex-col gap-3">
                        <a href="#" class="flex items-center justify-between p-3 rounded-[8px] border border-[#e2e8f0] hover:border-[#1668DC] transition-colors group">
                            <div class="flex items-center gap-3">
                                <img src="https://picsum.photos/seed/clinic-4-a/80/50" class="w-[60px] h-[40px] rounded-[4px] object-cover" alt="Clinic">
                                <span class="font-bold text-[#1F2733] text-[15px] group-hover:text-[#1668DC] transition-colors">Bệnh viện Thẩm mỹ Hoàn Mỹ</span>
                            </div>
                            <span class="text-[#1668DC] text-[13px] font-bold opacity-0 group-hover:opacity-100 transition-opacity">Chi tiết &rarr;</span>
                        </a>
                        <a href="#" class="flex items-center justify-between p-3 rounded-[8px] border border-[#e2e8f0] hover:border-[#1668DC] transition-colors group">
                            <div class="flex items-center gap-3">
                                <img src="https://picsum.photos/seed/clinic-5-a/80/50" class="w-[60px] h-[40px] rounded-[4px] object-cover" alt="Clinic">
                                <span class="font-bold text-[#1F2733] text-[15px] group-hover:text-[#1668DC] transition-colors">Thẩm mỹ viện Sài Gòn Venus</span>
                            </div>
                            <span class="text-[#1668DC] text-[13px] font-bold opacity-0 group-hover:opacity-100 transition-opacity">Chi tiết &rarr;</span>
                        </a>
                    </div>
                </div>

                <hr class="border-t border-dashed border-[#e2e8f0] my-8" />

                <!-- Related Articles -->
                <div class="mb-8">
                    <h3 class="text-[18px] font-bold text-[#1F2733] mb-4">Bài viết liên quan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach(array_slice($relatedArticles ?? [], 0, 4) as $ra)
                            <div class="bg-white rounded-[8px] border border-[#e2e8f0] overflow-hidden hover:shadow-md transition-shadow flex flex-col group">
                                <a href="{{ $ra['url'] ?? '#' }}" class="relative block overflow-hidden aspect-[16/10]">
                                    <img src="{{ $ra['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $ra['title'] }}">
                                    <span class="absolute top-2 left-2 bg-white/90 backdrop-blur text-[#1668DC] px-2 py-0.5 rounded-[4px] text-[11px] font-bold uppercase">{{ $ra['category'] ?? 'Nha Khoa' }}</span>
                                </a>
                                <div class="p-4 flex flex-col flex-1">
                                    <h4 class="font-bold text-[#1F2733] text-[15px] leading-snug line-clamp-2 mb-2 group-hover:text-[#1668DC] transition-colors">
                                        <a href="{{ $ra['url'] ?? '#' }}">{{ $ra['title'] }}</a>
                                    </h4>
                                    <div class="mt-auto flex items-center justify-between text-[#94a3b8] text-[12px]">
                                        <div class="flex items-center gap-3">
                                            <span class="flex items-center gap-1"><i class="pi pi-calendar"></i> {{ $ra['date'] }}</span>
                                            <span class="flex items-center gap-1"><i class="pi pi-eye"></i> {{ $ra['views'] ?? 0 }}</span>
                                        </div>
                                        <a href="{{ $ra['url'] ?? '#' }}" class="text-[#1668DC] font-bold hover:underline">Chi tiết &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr class="border-t border-dashed border-[#e2e8f0] my-8" />

                <!-- Comments Section -->
                <section id="binh-luan" class="comments mt-[36px] pt-[20px] border-t-4 border-[#E8F1FF]">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-[18px] font-bold text-[#1F2733]">Bình luận (0)</h3>
                        <span class="bg-[#e2ffe9] text-[#16a34a] px-2 py-1 rounded-[4px] text-[12px] font-bold flex items-center gap-1">
                            <i class="pi pi-check text-[10px]"></i> Đã kiểm duyệt
                        </span>
                    </div>
                    <p class="text-[#64748b] text-[14px] mb-6">Trở thành người đầu tiên bình luận cho bài viết này!</p>
                    
                    <form class="bg-[#f8fafc] border border-[#e2e8f0] rounded-[8px] p-5">
                        <h4 class="font-bold text-[#1F2733] mb-4">Viết bình luận</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <input type="text" placeholder="Họ tên *" class="w-full px-3 py-2 border border-[#cbd5e1] rounded-[6px] outline-none focus:border-[#1668DC]" required>
                            <input type="email" placeholder="Email (không bắt buộc)" class="w-full px-3 py-2 border border-[#cbd5e1] rounded-[6px] outline-none focus:border-[#1668DC]">
                        </div>
                        <div class="mb-4 relative">
                            <textarea placeholder="Nội dung bình luận *" rows="4" class="w-full px-3 py-2 border border-[#cbd5e1] rounded-[6px] outline-none focus:border-[#1668DC] resize-none" required></textarea>
                            <i class="pi pi-pencil absolute bottom-3 right-3 text-[#94a3b8]"></i>
                        </div>
                        <div class="flex items-center justify-between">
                            <small class="text-[#94a3b8]">Bình luận sẽ hiển thị sau khi được kiểm duyệt.</small>
                            <button type="submit" class="bg-[#1668DC] hover:bg-[#1254b0] text-white px-5 py-2.5 rounded-[6px] font-bold text-[14px] transition-colors">
                                Gửi bình luận
                            </button>
                        </div>
                    </form>
                </section>
            </article>
        </div>

        <!-- Sidebar Content -->
        <div class="w-full lg:w-[320px] flex-shrink-0 flex flex-col gap-6 sticky top-[80px] self-start">
            <!-- Sidebar Block 1: Cơ sở nổi bật -->
            <div class="bg-white rounded-[12px] border border-[#e2e8f0] px-[18px] py-[16px] shadow-sm">
                <h3 class="text-[16px] font-bold text-[#1F2733] mb-4 uppercase pb-3 border-b-2 border-[#1668DC]">Cơ sở nổi bật</h3>
                <div class="flex flex-col gap-0">
                    @php
                        $topClinics = [
                            ['name' => 'Bệnh viện Thẩm mỹ Kim Cương', 'rating' => '5/5', 'img' => 'seed/s1'],
                            ['name' => 'Bệnh viện Thẩm mỹ Á Âu', 'rating' => '4.4/5', 'img' => 'seed/s2'],
                            ['name' => 'Thẩm mỹ viện Ngọc Dung', 'rating' => '4.7/5', 'img' => 'seed/s3'],
                            ['name' => 'Thẩm mỹ viện Đông Á', 'rating' => '4.1/5', 'img' => 'seed/s4'],
                            ['name' => 'Bệnh viện Thẩm mỹ Hoàn Mỹ', 'rating' => '3.8/5', 'img' => 'seed/s5'],
                        ];
                    @endphp
                    @foreach($topClinics as $index => $clinic)
                        <div class="flex items-center gap-3 py-3 border-b border-dashed border-[#e2e8f0] last:border-0 last:pb-0">
                            <div class="w-6 h-6 rounded-[4px] flex items-center justify-center flex-shrink-0 text-[13px] font-bold {{ $index < 3 ? 'bg-[#1668DC] text-white' : 'bg-[#f1f5f9] text-[#64748b]' }}">
                                {{ $index + 1 }}
                            </div>
                            <img src="https://picsum.photos/{{ $clinic['img'] }}/50/36" class="w-[50px] h-[36px] rounded-[4px] object-cover border border-[#f1f5f9]" alt="Clinic" />
                            <div>
                                <div class="font-bold text-[#1F2733] text-[13px] leading-snug line-clamp-1 mb-1">{{ $clinic['name'] }}</div>
                                <div class="text-[#f59e0b] text-[12px] font-bold flex items-center gap-1">
                                    <i class="pi pi-star-fill text-[10px]"></i> {{ $clinic['rating'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Sidebar Block 2: Bài viết mới -->
            <div class="bg-white rounded-[12px] border border-[#e2e8f0] px-[18px] py-[16px] shadow-sm">
                <h3 class="text-[16px] font-bold text-[#1F2733] mb-4 uppercase pb-3 border-b-2 border-[#1668DC]">Bài viết mới</h3>
                <div class="flex flex-col gap-4">
                    @foreach(array_slice($recentArticles, 0, 4) as $ra)
                        <div class="flex gap-3">
                            <a href="{{ $ra['url'] }}" class="flex-shrink-0">
                                <img src="{{ $ra['image'] }}" class="w-[90px] h-[64px] rounded-[6px] object-cover border border-[#e2e8f0]" alt="{{ $ra['title'] }}" />
                            </a>
                            <div>
                                <h4 class="font-bold text-[#1F2733] text-[14px] leading-snug line-clamp-2 hover:text-[#1668DC] mb-1">
                                    <a href="{{ $ra['url'] }}">{{ $ra['title'] }}</a>
                                </h4>
                                <div class="text-[#94a3b8] text-[12px]">{{ $ra['date'] }}</div>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <div class="border-b border-dashed border-[#e2e8f0]"></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
