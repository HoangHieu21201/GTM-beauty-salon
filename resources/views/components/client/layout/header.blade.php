<header class="bg-white w-full shadow-sm">
    <!-- Top Bar -->
    <div class="max-w-[1200px] mx-auto px-4 py-4">
        <div class="flex items-center justify-between gap-8">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="logo flex-shrink-0 text-[var(--text)]">
                @php $siteLogo = setting('site_logo'); @endphp
                @if($siteLogo)
                    <img src="{{ asset($siteLogo) }}" alt="Review Thẩm Mỹ" class="h-10 object-contain" onerror="this.outerHTML='<svg viewBox=\'0 0 48 48\' aria-hidden=\'true\' class=\'w-10 h-10\'><defs><linearGradient id=\'rtmGradH\' x1=\'0\' y1=\'0\' x2=\'1\' y2=\'1\'><stop offset=\'0\' stop-color=\'#3f86ff\'></stop><stop offset=\'1\' stop-color=\'#1668dc\'></stop></linearGradient></defs><path d=\'M24 5 C13.5 5 5 12.3 5 21.5 C5 30.7 13.5 38 24 38 c1.6 0 3.2-.2 4.7-.5 L36.5 42 l-1.2-7.4 C40.3 31.4 43 26.8 43 21.5 43 12.3 34.5 5 24 5 Z\' fill=\'url(#rtmGradH)\'></path><polygon points=\'24,12.5 26.2,18.4 32.6,18.7 27.6,22.7 29.3,28.8 24,25.3 18.7,28.8 20.4,22.7 15.4,18.7 21.8,18.4\' fill=\'#fff\'></polygon><path d=\'M39 1 l1.5 3.9 3.9 1.5 -3.9 1.5 -1.5 3.9 -1.5 -3.9 -3.9 -1.5 3.9 -1.5 Z\' fill=\'#ff7a00\'></path></svg><span>Review</span><span class=\'text-[var(--primary)]\'>Thẩm Mỹ</span>'">
                @else
                    <svg viewBox="0 0 48 48" aria-hidden="true" class="w-10 h-10">
                        <defs>
                            <linearGradient id="rtmGradH" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0" stop-color="#3f86ff"></stop>
                                <stop offset="1" stop-color="#1668dc"></stop>
                            </linearGradient>
                        </defs>
                        <path d="M24 5 C13.5 5 5 12.3 5 21.5 C5 30.7 13.5 38 24 38 c1.6 0 3.2-.2 4.7-.5 L36.5 42 l-1.2-7.4 C40.3 31.4 43 26.8 43 21.5 43 12.3 34.5 5 24 5 Z" fill="url(#rtmGradH)"></path>
                        <polygon points="24,12.5 26.2,18.4 32.6,18.7 27.6,22.7 29.3,28.8 24,25.3 18.7,28.8 20.4,22.7 15.4,18.7 21.8,18.4" fill="#fff"></polygon>
                        <path d="M39 1 l1.5 3.9 3.9 1.5 -3.9 1.5 -1.5 3.9 -1.5 -3.9 -3.9 -1.5 3.9 -1.5 Z" fill="#ff7a00"></path>
                    </svg>
                    <span>Review</span>
                    <span class="text-[var(--primary)]">Thẩm Mỹ</span>
                @endif
            </a>

            <!-- Search Bar -->
            <div class="flex-1 max-w-2xl mx-auto relative hidden md:block">
                <form action="{{ route('search') }}" method="GET" class="flex items-center bg-[#F3F4F6] rounded-full p-1">
                    <div class="pl-4 pr-2 text-gray-400">
                        <i class="pi pi-search"></i>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm kiếm cơ sở, bài viết, danh mục, tỉnh thành..." class="flex-1 bg-transparent border-none focus:ring-0 text-[14px] text-gray-700 placeholder-gray-400 py-2 outline-none" required>
                    <button type="submit" class="bg-[#4D8AFF] hover:bg-blue-600 text-white px-6 py-2 rounded-full font-medium text-[14px] transition-colors flex items-center gap-2">
                        <i class="pi pi-search text-[12px]"></i> Tìm kiếm
                    </button>
                </form>
                <div class="mt-2 px-2 text-[13px] flex items-center gap-3">
                    <span class="text-gray-500">Gợi ý:</span>
                    <a href="{{ route('search', ['q' => 'Nâng mũi']) }}" class="text-[#4D8AFF] font-medium hover:underline">Nâng mũi</a>
                    <a href="{{ route('search', ['q' => 'Cắt mí']) }}" class="text-[#4D8AFF] font-medium hover:underline">Cắt mí</a>
                    <a href="{{ route('search', ['q' => 'Hà Nội']) }}" class="text-[#4D8AFF] font-medium hover:underline">Hà Nội</a>
                </div>
            </div>

            <!-- CTA -->
            <div class="flex-shrink-0 hidden md:flex items-center">
                <a href="{{ url('/bang-xep-hang') }}" class="btn-client btn-client-accent" style="border-radius: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-[18px] h-[18px]">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                    </svg>
                    Bảng xếp hạng
                </a>
            </div>
            
            <!-- Mobile Menu Toggle -->
            <div class="md:hidden flex items-center">
                <button class="text-gray-600 text-2xl">
                    <i class="pi pi-bars"></i>
                </button>
            </div>
        </div>
    </div>

</header>
