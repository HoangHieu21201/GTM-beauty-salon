<footer class="bg-slate-900 text-slate-300 py-12 border-t-4 border-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="col-span-1 md:col-span-2">
                <a href="{{ url('/') }}" class="text-2xl font-black flex items-center gap-2 mb-4">
                    <span class="text-accent text-3xl">★</span> 
                    <span class="text-white">SORA<span class="text-slate-400">ThinkHub</span></span>
                </a>
                <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                    Nền tảng đánh giá và review các cơ sở thẩm mỹ uy tín hàng đầu. Giúp bạn tìm kiếm nơi làm đẹp an toàn và chất lượng nhất.
                </p>
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">📘</a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">📸</a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-primary hover:text-white transition-colors">▶️</a>
                </div>
            </div>

            <!-- Links -->
            <div>
                <h3 class="text-white font-bold text-lg mb-4 uppercase tracking-wider text-sm">Khám phá</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:text-primary transition-colors">Cơ sở thẩm mỹ</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Bác sĩ chuyên khoa</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Kiến thức làm đẹp</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Bảng giá dịch vụ</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h3 class="text-white font-bold text-lg mb-4 uppercase tracking-wider text-sm">Hỗ trợ</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:text-primary transition-colors">Về chúng tôi</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Liên hệ</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Điều khoản sử dụng</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Chính sách bảo mật</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-slate-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-slate-500">
            <p>&copy; {{ date('Y') }} SORA ThinkHub. Mọi quyền được bảo lưu.</p>
            <p class="mt-2 md:mt-0">Thiết kế với ❤️ bởi SORA Team</p>
        </div>
    </div>
</footer>
