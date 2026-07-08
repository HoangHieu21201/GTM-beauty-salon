@extends('client.layouts.app')

@section('title', 'Trang chủ - Review Thẩm Mỹ')

@section('content')
<div style="background-color: var(--primary); padding-bottom: 4rem;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 pt-16">
        <div class="space-y-6 text-white">
            <h1 class="text-4xl lg:text-5xl font-bold leading-tight">Tìm cơ sở thẩm mỹ uy tín, đánh giá khách quan</h1>
            <p class="text-lg text-blue-100 leading-relaxed max-w-lg">Chúng tôi thực hiện đánh giá và xếp hạng minh bạch các bệnh viện, thẩm mỹ viện — giúp bạn lựa chọn dịch vụ an toàn, chất lượng.</p>
            <button style="background-color: var(--card); color: var(--primary)" class="px-6 py-3 mt-4 rounded font-bold shadow-md hover:bg-gray-50 flex items-center gap-2 transition">
                Xem bảng xếp hạng &rarr;
            </button>
        </div>
        
        <div style="background-color: var(--card); border-radius: var(--radius); box-shadow: var(--shadow-hover)" class="p-6 text-black">
            <h3 class="font-bold text-lg mb-5 flex items-center gap-2 border-b pb-3">
                🏆 Đang dẫn đầu
            </h3>
            <div class="space-y-5">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <span style="background-color: var(--accent)" class="text-white text-xs px-2.5 py-1 rounded font-bold shadow-sm">TOP 1</span>
                        <span class="font-bold text-gray-800">Bệnh viện Thẩm mỹ Kim Cương</span>
                    </div>
                    <div class="flex items-center gap-1 text-sm font-bold" style="color: var(--star)">
                        ★★★★★ 5.0/5
                    </div>
                </div>
                
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <span style="background-color: var(--muted)" class="text-white text-xs px-2.5 py-1 rounded font-bold shadow-sm">TOP 2</span>
                        <span class="font-bold text-gray-800">Thẩm mỹ viện Ngọc Dung</span>
                    </div>
                    <div class="flex items-center gap-1 text-sm font-bold" style="color: var(--star)">
                        ★★★★★ 4.7/5
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <span style="background-color: #8B5CF6" class="text-white text-xs px-2.5 py-1 rounded font-bold shadow-sm">TOP 3</span>
                        <span class="font-bold text-gray-800">Bệnh viện Thẩm mỹ Á Âu</span>
                    </div>
                    <div class="flex items-center gap-1 text-sm font-bold" style="color: var(--star)">
                        ★★★★☆ 4.4/5
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Bài viết mới nhất</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Placeholder cho bài viết -->
        <div style="background-color: var(--card); border-radius: var(--radius); box-shadow: var(--shadow)" class="p-4">
            <div class="bg-gray-200 h-40 rounded-lg mb-4 w-full"></div>
            <h4 class="font-bold text-lg mb-2">Bọc răng sứ giá bao nhiêu?</h4>
            <p class="text-sm text-gray-500">Bảng giá 2026 và 5 điều phải hỏi trước khi làm...</p>
        </div>
    </div>
</div>
@endsection
