<!-- Navigation Bar (CatNav) - Độc lập, nổi khi cuộn (Sticky) -->
<nav class="bg-[#1668DC] w-full text-white hidden md:block sticky top-0 z-50 shadow-md">
    <div class="max-w-[1200px] mx-auto px-4 relative flex items-center h-[46px] text-[13px] font-bold uppercase tracking-wide">
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
            <a href="{{ url('/tinh-thanh') }}" class="h-full flex items-center px-4 hover:bg-white/10 transition-colors gap-1 text-white hover:text-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 mr-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg> Tỉnh thành
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-[11px] h-[11px] ml-1 transition-transform duration-300 group-hover:-rotate-180">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
            
            <!-- Mega Menu Dropdown -->
            <div class="dropdown mega absolute top-full left-4 right-4 bg-white shadow-xl rounded-b-[12px] pt-[16px] px-[24px] pb-[20px] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-100 cursor-default text-gray-800">
                <div class="flex justify-between items-center border-b border-[#e6e9ee] pb-3">
                    <div class="flex items-center gap-2 text-[#1668DC] text-[13px] font-bold uppercase tracking-wider">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                        KHÁM PHÁ THEO TỈNH THÀNH
                    </div>
                    <a href="{{ url('/tinh-thanh') }}" class="text-[#1668DC] text-[13px] font-medium hover:underline normal-case">Xem tất cả 34 tỉnh thành &rarr;</a>
                </div>

                @php
                $megaRegions = [
                    'MIỀN BẮC' => [
                        ['n' => 'Hà Nội', 'p' => 1], ['n' => 'Hải Phòng', 'p' => 1], ['n' => 'Quảng Ninh', 'p' => 0], ['n' => 'Bắc Ninh', 'p' => 0], ['n' => 'Hưng Yên', 'p' => 0], ['n' => 'Ninh Bình', 'p' => 0], ['n' => 'Phú Thọ', 'p' => 0], ['n' => 'Thái Nguyên', 'p' => 0], ['n' => 'Tuyên Quang', 'p' => 0], ['n' => 'Lào Cai', 'p' => 0], ['n' => 'Lai Châu', 'p' => 0], ['n' => 'Điện Biên', 'p' => 0], ['n' => 'Sơn La', 'p' => 0], ['n' => 'Lạng Sơn', 'p' => 0], ['n' => 'Cao Bằng', 'p' => 0]
                    ],
                    'MIỀN TRUNG' => [
                        ['n' => 'Đà Nẵng', 'p' => 0], ['n' => 'Huế', 'p' => 0], ['n' => 'Thanh Hóa', 'p' => 0], ['n' => 'Nghệ An', 'p' => 0], ['n' => 'Hà Tĩnh', 'p' => 0], ['n' => 'Quảng Trị', 'p' => 0], ['n' => 'Quảng Ngãi', 'p' => 0], ['n' => 'Gia Lai', 'p' => 0], ['n' => 'Đắk Lắk', 'p' => 0], ['n' => 'Khánh Hòa', 'p' => 0], ['n' => 'Lâm Đồng', 'p' => 0]
                    ],
                    'MIỀN NAM' => [
                        ['n' => 'TP. Hồ Chí Minh', 'p' => 0], ['n' => 'Đồng Nai', 'p' => 0], ['n' => 'Tây Ninh', 'p' => 0], ['n' => 'Cần Thơ', 'p' => 0], ['n' => 'Vĩnh Long', 'p' => 0], ['n' => 'Đồng Tháp', 'p' => 0], ['n' => 'An Giang', 'p' => 0], ['n' => 'Cà Mau', 'p' => 0]
                    ]
                ];
                @endphp

                <style>
                    .mega-province-active { background-color: #f1f5f9; color: #1F2733; }
                    .mega-province-inactive { background-color: #f8fafc; color: #64748b; }
                    .mega-province:hover { background-color: #1668DC !important; color: #ffffff !important; }
                    .mega-badge { background-color: #dbeafe; color: #1668DC; }
                    .mega-province:hover .mega-badge { background-color: rgba(255, 255, 255, 0.25); color: #ffffff; }
                </style>
                <div class="flex flex-col">
                    @foreach($megaRegions as $regionName => $megaProvinces)
                        <div class="mega-region py-[13px] flex items-start border-b border-dashed border-[#cbd5e1] last:border-0">
                            <div class="w-[140px] flex-shrink-0 flex items-center gap-2 text-[#64748b] text-[12px] font-bold uppercase tracking-wider mt-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#1668DC]"></span> {{ $regionName }}
                            </div>
                            <div class="flex flex-wrap gap-2.5">
                                @foreach($megaProvinces as $mp)
                                    <a href="{{ $mp['p'] > 0 ? url('/tinh-thanh/' . Str::slug($mp['n'])) : 'javascript:void(0)' }}" class="mega-province px-[13px] py-[6px] rounded-full text-[13px] font-medium transition-colors flex items-center gap-1.5 normal-case {{ $mp['p'] > 0 ? 'mega-province-active' : 'mega-province-inactive' }}">
                                        {{ $mp['n'] }}
                                        @if($mp['p'] > 0)
                                            <span class="mega-badge text-[10.5px] font-bold px-1.5 py-0.5 rounded-full min-w-[20px] text-center leading-none transition-colors">{{ $mp['p'] }}</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <a href="{{ url('/bang-xep-hang') }}" class="h-full flex items-center px-4 hover:bg-white/10 transition-colors text-white hover:text-white">
            Xếp hạng
        </a>
    </div>
</nav>
