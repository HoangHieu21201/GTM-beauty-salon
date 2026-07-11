<aside class="w-[252px] bg-[#111c44] text-slate-300 flex flex-col h-screen flex-shrink-0">
    <!-- Logo Area: 20px padding -->
    <div class="p-[20px] border-b border-white/5 flex-shrink-0">
        <a href="{{ url('/admin') }}" class="block font-bold tracking-wide">
            <div class="text-white text-[20px] font-black tracking-tight leading-tight">
                Review <span style="color: #4D8AFF;">Thẩm Mỹ</span><br>
                Admin
            </div>
        </a>
    </div>

    <!-- Navigation Menu: 8px padding (to perfectly match 236px links in 252px container) -->
    <nav class="flex-1 overflow-y-auto py-[24px] px-[8px] space-y-[4px]">
        
        <!-- Dashboard -->
        <a href="{{ url('/admin') }}" class="flex items-center gap-[10px] px-[14px] py-[10px] rounded-lg font-medium transition-colors text-[14px] {{ request()->is('admin') ? 'bg-primary text-white' : 'text-[#cfd9e6] hover:bg-white/5 hover:text-white' }}">
            <i class="pi pi-chart-bar text-[18px]"></i>
            <span>Dashboard</span>
        </a>
        
        <!-- Lượt truy cập -->
        <a href="{{ url('/admin/analytics') }}" class="flex items-center gap-[10px] px-[14px] py-[10px] rounded-lg font-medium transition-colors text-[14px] {{ request()->is('admin/analytics') ? 'bg-primary text-white' : 'text-[#cfd9e6] hover:bg-white/5 hover:text-white' }}">
            <i class="pi pi-chart-line text-[18px]"></i>
            <span>Lượt truy cập</span>
        </a>

        <!-- Bài viết -->
        <a href="{{ url('/admin/posts') }}" class="flex items-center gap-[10px] px-[14px] py-[10px] rounded-lg font-medium transition-colors text-[14px] {{ request()->is('admin/posts*') ? 'bg-primary text-white' : 'text-[#cfd9e6] hover:bg-white/5 hover:text-white' }}">
            <i class="pi pi-file text-[18px]"></i>
            <span>Bài viết</span>
        </a>

        <!-- Cơ sở thẩm mỹ -->
        <a href="{{ url('/admin/clinics') }}" class="flex items-center gap-[10px] px-[14px] py-[10px] rounded-lg font-medium transition-colors text-[14px] {{ request()->is('admin/clinics*') ? 'bg-primary text-white' : 'text-[#cfd9e6] hover:bg-white/5 hover:text-white' }}">
            <i class="pi pi-building text-[18px]"></i>
            <span>Cơ sở thẩm mỹ</span>
        </a>

        <!-- Danh mục -->
        <a href="{{ url('/admin/categories') }}" class="flex items-center gap-[10px] px-[14px] py-[10px] rounded-lg font-medium transition-colors text-[14px] {{ request()->is('admin/categories*') ? 'bg-primary text-white' : 'text-[#cfd9e6] hover:bg-white/5 hover:text-white' }}">
            <i class="pi pi-tags text-[18px]"></i>
            <span>Danh mục</span>
        </a>

        <!-- Bình luận -->
        <a href="{{ url('/admin/comments') }}" class="flex items-center gap-[10px] px-[14px] py-[10px] rounded-lg font-medium transition-colors text-[14px] {{ request()->is('admin/comments*') ? 'bg-primary text-white' : 'text-[#cfd9e6] hover:bg-white/5 hover:text-white' }}">
            <i class="pi pi-comments text-[18px]"></i>
            <span>Bình luận</span>
        </a>

        <!-- SUPERADMIN Section -->
        <div class="mt-[24px] mb-[8px] px-[14px]">
            <span class="text-[11px] font-bold text-slate-500 uppercase tracking-widest">SUPERADMIN</span>
        </div>

        <!-- Người dùng -->
        <a href="{{ url('/admin/users') }}" class="flex items-center gap-[10px] px-[14px] py-[10px] rounded-lg font-medium transition-colors text-[14px] {{ request()->is('admin/users*') ? 'bg-primary text-white' : 'text-[#cfd9e6] hover:bg-white/5 hover:text-white' }}">
            <i class="pi pi-users text-[18px]"></i>
            <span>Người dùng</span>
        </a>

        <!-- Cấu hình Website -->
        <a href="{{ url('/admin/settings') }}" class="flex items-center gap-[10px] px-[14px] py-[10px] rounded-lg font-medium transition-colors text-[14px] {{ request()->is('admin/settings*') ? 'bg-primary text-white' : 'text-[#cfd9e6] hover:bg-white/5 hover:text-white' }}">
            <i class="pi pi-cog text-[18px]"></i>
            <span>Cấu hình Website</span>
        </a>

    </nav>

    <!-- User Profile & Logout -->
    <div class="p-4 border-t border-white/5 mt-auto">
        <div class="flex items-center justify-between px-2 py-2">
            <div class="flex flex-col min-w-0">
                <span class="text-[14px] font-bold text-white truncate">Quản trị viên</span>
                <span class="text-[12px] text-slate-500 truncate mt-0.5">superadmin</span>
            </div>
            <button class="text-slate-500 hover:text-white transition-colors p-1" title="Đăng xuất">
                <i class="pi pi-sign-out text-[16px]"></i>
            </button>
        </div>
    </div>
</aside>
