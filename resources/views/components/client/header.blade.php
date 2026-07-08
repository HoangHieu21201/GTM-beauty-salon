<header class="bg-white shadow-sm border-b border-border sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="text-2xl font-black flex items-center gap-2">
                    <span class="text-accent text-3xl">★</span> 
                    <span class="text-primary">SORA<span class="text-text">ThinkHub</span></span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ url('/') }}" class="text-primary font-bold border-b-2 border-primary py-7 px-1">Trang chủ</a>
                <a href="#" class="text-muted hover:text-primary font-medium border-b-2 border-transparent hover:border-primary-soft transition-colors py-7 px-1">Cơ sở thẩm mỹ</a>
                <a href="#" class="text-muted hover:text-primary font-medium border-b-2 border-transparent hover:border-primary-soft transition-colors py-7 px-1">Bài viết</a>
                <a href="#" class="text-muted hover:text-primary font-medium border-b-2 border-transparent hover:border-primary-soft transition-colors py-7 px-1">Danh mục</a>
            </nav>

            <!-- Right Actions -->
            <div class="hidden md:flex items-center space-x-4">
                <button class="text-muted hover:text-primary transition-colors p-2">
                    🔍
                </button>
                <a href="#" class="text-primary font-semibold hover:text-primary-dark px-3 py-2">Đăng nhập</a>
                <a href="#" class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-5 rounded-full shadow hover:shadow-hover transition-all">Đăng ký</a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button class="text-muted hover:text-text p-2 text-2xl">
                    ☰
                </button>
            </div>
        </div>
    </div>
</header>
