<!-- Navigation Bar (CatNav) - Độc lập, nổi khi cuộn (Sticky) -->
<nav class="bg-[#1668DC] w-full text-white hidden md:block sticky top-0 z-50 shadow-md">
    <div class="max-w-[1200px] mx-auto px-4 flex items-center h-[46px] text-[13px] font-bold uppercase tracking-wide">
        <!-- Active item has white border bottom -->
        <a href="{{ url('/') }}" class="h-full flex items-center px-4 border-b-2 border-white text-white">Trang chủ</a>
        
        <div class="relative group h-full flex items-center">
            <a href="{{ url('/bai-viet?type=main&cat=phau-thuat-tham-my') }}" class="h-full flex items-center px-4 hover:bg-white/10 transition-colors gap-1 text-white hover:text-white">
                Phẫu thuật thẩm mỹ
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-[11px] h-[11px] ml-1 transition-transform duration-300 group-hover:-rotate-180">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
            <!-- Dropdown -->
            <div class="absolute top-full left-0 bg-white shadow-xl rounded-[8px] py-2 min-w-[200px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-100 mt-1">
                <a href="{{ url('/bai-viet?type=sub&cat=nang-mui') }}" class="block px-5 py-2.5 text-[14px] font-medium text-gray-700 hover:bg-blue-50 hover:text-[#1668DC] normal-case">Nâng mũi</a>
                <a href="{{ url('/bai-viet?type=sub&cat=nang-nguc') }}" class="block px-5 py-2.5 text-[14px] font-medium text-gray-700 hover:bg-blue-50 hover:text-[#1668DC] normal-case">Nâng ngực</a>
                <a href="{{ url('/bai-viet?type=sub&cat=cat-mi') }}" class="block px-5 py-2.5 text-[14px] font-medium text-gray-700 hover:bg-blue-50 hover:text-[#1668DC] normal-case">Cắt mí</a>
                <a href="{{ url('/bai-viet?type=sub&cat=hut-mo') }}" class="block px-5 py-2.5 text-[14px] font-medium text-gray-700 hover:bg-blue-50 hover:text-[#1668DC] normal-case">Hút mỡ</a>
            </div>
        </div>

        <div class="relative group h-full flex items-center">
            <a href="{{ url('/bai-viet?type=main&cat=cham-soc-da') }}" class="h-full flex items-center px-4 hover:bg-white/10 transition-colors gap-1 text-white hover:text-white">
                Chăm sóc da
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-[11px] h-[11px] ml-1 transition-transform duration-300 group-hover:-rotate-180">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
            <!-- Dropdown -->
            <div class="absolute top-full left-0 bg-white shadow-xl rounded-[8px] py-2 min-w-[200px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-100 mt-1">
                <a href="{{ url('/bai-viet?type=sub&cat=tre-hoa-da') }}" class="block px-5 py-2.5 text-[14px] font-medium text-gray-700 hover:bg-blue-50 hover:text-[#1668DC] normal-case">Trẻ hóa da</a>
                <a href="{{ url('/bai-viet?type=sub&cat=tri-mun') }}" class="block px-5 py-2.5 text-[14px] font-medium text-gray-700 hover:bg-blue-50 hover:text-[#1668DC] normal-case">Trị mụn</a>
                <a href="{{ url('/bai-viet?type=sub&cat=tam-trang') }}" class="block px-5 py-2.5 text-[14px] font-medium text-gray-700 hover:bg-blue-50 hover:text-[#1668DC] normal-case">Tắm trắng</a>
            </div>
        </div>

        <div class="relative group h-full flex items-center">
            <a href="{{ url('/bai-viet?type=main&cat=rang-ham-mat') }}" class="h-full flex items-center px-4 hover:bg-white/10 transition-colors gap-1 text-white hover:text-white">
                Răng - Hàm - Mặt
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-[11px] h-[11px] ml-1 transition-transform duration-300 group-hover:-rotate-180">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
            <!-- Dropdown -->
            <div class="absolute top-full left-0 bg-white shadow-xl rounded-[8px] py-2 min-w-[200px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-100 mt-1">
                <a href="{{ url('/bai-viet?type=sub&cat=nieng-rang') }}" class="block px-5 py-2.5 text-[14px] font-medium text-gray-700 hover:bg-blue-50 hover:text-[#1668DC] normal-case">Niềng răng</a>
                <a href="{{ url('/bai-viet?type=sub&cat=boc-rang-su') }}" class="block px-5 py-2.5 text-[14px] font-medium text-gray-700 hover:bg-blue-50 hover:text-[#1668DC] normal-case">Bọc răng sứ</a>
            </div>
        </div>

        <div class="group h-full flex items-center">
            <a href="#" class="h-full flex items-center px-4 hover:bg-white/10 transition-colors gap-1 text-white hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 mr-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg> Tỉnh thành
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-[11px] h-[11px] ml-1 transition-transform duration-300 group-hover:-rotate-180">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
            <!-- Mega Menu -->
            <div class="absolute top-full left-1/2 -translate-x-1/2 w-[calc(100vw-2rem)] max-w-[1500px] bg-white shadow-[0_10px_40px_rgba(0,0,0,0.15)] rounded-b-[12px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-100 p-6 cursor-default">
                <div class="flex justify-between items-center mb-5 border-b border-gray-100 pb-3">
                    <div class="text-[#0F2A4A] font-bold text-[15px] flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-[#1668DC]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                        </svg> KHÁM PHÁ THEO TỈNH THÀNH
                    </div>
                    <a href="#" class="text-[#1668DC] text-[13px] font-medium hover:underline normal-case">Xem tất cả 34 tỉnh thành &rarr;</a>
                </div>
                
                <div class="space-y-5">
                    <!-- Miền Bắc -->
                    <div class="flex items-start gap-6 border-b border-gray-50 pb-5 border-dashed">
                        <div class="text-[13px] font-bold text-gray-400 w-[90px] flex-shrink-0 flex items-center gap-1.5 pt-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#3b82f6]"></span> MIỀN BẮC
                        </div>
                        <div class="flex flex-wrap gap-2.5 normal-case font-medium">
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors flex items-center gap-1.5 shadow-sm border border-gray-100">Hà Nội <span class="bg-blue-100 text-[#1668DC] text-[10px] px-1.5 py-0.5 rounded-full font-bold leading-none">1</span></a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors flex items-center gap-1.5 shadow-sm border border-gray-100">Hải Phòng <span class="bg-blue-100 text-[#1668DC] text-[10px] px-1.5 py-0.5 rounded-full font-bold leading-none">1</span></a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Quảng Ninh</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Bắc Ninh</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Hưng Yên</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Ninh Bình</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Phú Thọ</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Thái Nguyên</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Tuyên Quang</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Lào Cai</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Lai Châu</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Điện Biên</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Sơn La</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Lạng Sơn</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Cao Bằng</a>
                        </div>
                    </div>
                    <!-- Miền Trung -->
                    <div class="flex items-start gap-6 border-b border-gray-50 pb-5 border-dashed">
                        <div class="text-[13px] font-bold text-gray-400 w-[90px] flex-shrink-0 flex items-center gap-1.5 pt-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#3b82f6]"></span> MIỀN TRUNG
                        </div>
                        <div class="flex flex-wrap gap-2.5 normal-case font-medium">
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Đà Nẵng</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Huế</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Thanh Hóa</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Nghệ An</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Hà Tĩnh</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Quảng Trị</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Quảng Ngãi</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Gia Lai</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Đắk Lắk</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Khánh Hòa</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Lâm Đồng</a>
                        </div>
                    </div>
                    <!-- Miền Nam -->
                    <div class="flex items-start gap-6">
                        <div class="text-[13px] font-bold text-gray-400 w-[90px] flex-shrink-0 flex items-center gap-1.5 pt-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#3b82f6]"></span> MIỀN NAM
                        </div>
                        <div class="flex flex-wrap gap-2.5 normal-case font-medium">
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">TP. Hồ Chí Minh</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Đồng Nai</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Tây Ninh</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Cần Thơ</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Vĩnh Long</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Đồng Tháp</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">An Giang</a>
                            <a href="#" class="px-3.5 py-1.5 bg-[#f8fafc] hover:bg-[#1668DC] hover:text-white text-gray-700 text-[13px] rounded-full transition-colors shadow-sm border border-gray-100">Cà Mau</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="h-full flex items-center px-4 hover:bg-white/10 transition-colors text-white hover:text-white">
            Xếp hạng
        </a>
    </div>
</nav>
