<footer class="bg-[#0F2A4A] w-full text-[#94a3b8] relative mt-[50px] pt-12">
    <div class="max-w-[1200px] mx-auto px-4 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10 border-b border-white/10 pb-10">
            <!-- Brand -->
            <div class="col-span-1 md:col-span-4 pr-8">
                <a href="{{ url('/') }}" class="logo text-white mb-4">
                    <svg viewBox="0 0 48 48" aria-hidden="true" class="w-10 h-10">
                        <defs>
                            <linearGradient id="rtmGradF" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0" stop-color="#3f86ff"></stop>
                                <stop offset="1" stop-color="#1668dc"></stop>
                            </linearGradient>
                        </defs>
                        <path d="M24 5 C13.5 5 5 12.3 5 21.5 C5 30.7 13.5 38 24 38 c1.6 0 3.2-.2 4.7-.5 L36.5 42 l-1.2-7.4 C40.3 31.4 43 26.8 43 21.5 43 12.3 34.5 5 24 5 Z" fill="url(#rtmGradF)"></path>
                        <polygon points="24,12.5 26.2,18.4 32.6,18.7 27.6,22.7 29.3,28.8 24,25.3 18.7,28.8 20.4,22.7 15.4,18.7 21.8,18.4" fill="#fff"></polygon>
                        <path d="M39 1 l1.5 3.9 3.9 1.5 -3.9 1.5 -1.5 3.9 -1.5 -3.9 -3.9 -1.5 3.9 -1.5 Z" fill="#ff7a00"></path>
                    </svg>
                    <span>Review</span>
                    <span class="text-[#3f86ff]">Thẩm Mỹ</span>
                </a>
                <p class="text-[14px] leading-relaxed text-[#94a3b8]">
                    Đánh giá khách quan, xếp hạng minh bạch các cơ sở thẩm mỹ.
                </p>
            </div>

            <!-- Về chúng tôi -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-white font-bold text-[15px] mb-4">Về chúng tôi</h3>
                <ul class="space-y-3 text-[14px]">
                    <li><a href="{{ url('/ve-chung-toi#gioi-thieu') }}" class="hover:text-white transition-colors">Giới thiệu</a></li>
                    <li><a href="{{ url('/ve-chung-toi#lien-he') }}" class="hover:text-white transition-colors">Liên hệ</a></li>
                    <li><a href="{{ url('/ve-chung-toi#hop-tac') }}" class="hover:text-white transition-colors">Hợp tác</a></li>
                </ul>
            </div>

            <!-- Danh mục -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-white font-bold text-[15px] mb-4">Danh mục</h3>
                <ul class="space-y-3 text-[14px]">
                    <li><a href="{{ url('/bai-viet?type=main&cat=phau-thuat-tham-my') }}" class="hover:text-white transition-colors">Phẫu thuật thẩm mỹ</a></li>
                    <li><a href="{{ url('/bai-viet?type=main&cat=cham-soc-da') }}" class="hover:text-white transition-colors">Chăm sóc da</a></li>
                    <li><a href="{{ url('/bai-viet?type=main&cat=rang-ham-mat') }}" class="hover:text-white transition-colors">Răng - Hàm - Mặt</a></li>
                    <li><a href="{{ url('/tinh-thanh') }}" class="hover:text-white transition-colors">Bài viết theo tỉnh thành</a></li>
                </ul>
            </div>

            <!-- Chính sách -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-white font-bold text-[15px] mb-4">Chính sách</h3>
                <ul class="space-y-3 text-[14px]">
                    <li><a href="{{ url('/chinh-sach#dieu-khoan-su-dung') }}" class="hover:text-white transition-colors">Điều khoản sử dụng</a></li>
                    <li><a href="{{ url('/chinh-sach#chinh-sach-bao-mat') }}" class="hover:text-white transition-colors">Chính sách bảo mật</a></li>
                    <li><a href="{{ url('/chinh-sach#tieu-chi-danh-gia') }}" class="hover:text-white transition-colors">Tiêu chí đánh giá</a></li>
                </ul>
            </div>

            <!-- Kết nối -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-white font-bold text-[15px] mb-4">Kết nối</h3>
                <div class="flex gap-4">
                    <a href="#" class="text-[#94a3b8] hover:text-white transition-colors" title="Facebook"><i class="pi pi-facebook text-xl"></i></a>
                    <a href="#" class="text-[#94a3b8] hover:text-white transition-colors" title="Zalo"><i class="pi pi-comment text-xl"></i></a>
                    <a href="#" class="text-[#94a3b8] hover:text-white transition-colors" title="YouTube"><i class="pi pi-youtube text-xl"></i></a>
                </div>
            </div>
        </div>

        <div class="pt-6 text-[13px] text-center md:text-left text-[#64748b]">
            &copy; 2026 Review Thẩm Mỹ &mdash; Hệ thống đánh giá & xếp hạng cơ sở thẩm mỹ.
        </div>
    </div>
</footer>
