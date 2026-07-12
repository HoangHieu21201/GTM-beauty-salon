@php
$dbPosts = \App\Models\Post::with('category')->where('status', 'published')->latest()->take(3)->get();

if ($dbPosts->count() > 0) {
    $articles = $dbPosts->map(function($post) {
        return [
            'category' => $post->category ? mb_strtoupper($post->category->name) : 'TIN TỨC',
            'title' => $post->title,
            'excerpt' => $post->short_description ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 100),
            'date' => $post->created_at->format('d/m/Y'),
            'views' => 100,
            'image' => $post->thumbnail ?? 'https://picsum.photos/seed/article1/400/250',
            'url' => url('/bai-viet/chi-tiet/' . $post->slug)
        ];
    });
} else {
    $articles = [
        [
            'category' => 'HÚT MỠ',
            'title' => 'Hút mỡ bụng 2026: chi phí, công nghệ và những sự thật ít ai nói',
            'excerpt' => 'Hút mỡ bụng không phải phương pháp giảm cân. Bài viết so sánh 3 công nghệ phổ biến, chi phí thực tế từng hạng mục...',
            'date' => '05/07/2026',
            'views' => 1022,
            'image' => 'https://picsum.photos/seed/article1/400/250',
            'url' => '#'
        ],
        [
            'category' => 'TRẺ HÓA DA',
            'title' => 'Trẻ hóa da công nghệ cao: so sánh HIFU, RF và Laser chi tiết 2026',
            'excerpt' => 'HIFU, RF hay Laser — mỗi công nghệ trẻ hóa da giải quyết một tầng lão hóa khác nhau. Hiểu đúng cơ chế để không c...',
            'date' => '04/07/2026',
            'views' => 914,
            'image' => 'https://picsum.photos/seed/article2/400/250',
            'url' => '#'
        ],
        [
            'category' => 'TRỊ MỤN',
            'title' => 'Trị mụn chuẩn y khoa: lộ trình 3 tháng sạch mụn, hạn chế tái phát',
            'excerpt' => 'Mụn không thể hết sau một buổi lấy nhân. Đây là lộ trình trị mụn 3 tháng theo phác đồ da liễu — kiểm soát viêm, xử lý...',
            'date' => '03/07/2026',
            'views' => 802,
            'image' => 'https://picsum.photos/seed/article3/400/250',
            'url' => '#'
        ]
    ];
}
@endphp

<section class="max-w-[1200px] mx-auto px-4 mt-12 mb-0 pb-0">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-2.5">
            <div class="w-1.5 h-6 bg-[#1668DC] rounded-full"></div>
            <h2 class="text-[20px] md:text-[22px] font-bold text-[#1F2733] uppercase">Bài viết hay nhất</h2>
        </div>
        <a href="#" class="text-[#1668DC] text-[14px] font-medium hover:underline flex items-center gap-1">
            Xem tất cả 
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
        </a>
    </div>

    <!-- Grid: 3 columns, gap 18px -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-[18px]">
        @foreach($articles as $item)
        <div class="bg-white rounded-[12px] border border-[#e6e9ee] overflow-hidden card-hover flex flex-col">
            <!-- Thumbnail & Overlay Tag -->
            <a href="{{ $item['url'] }}" class="relative block w-full h-[235px] group overflow-hidden flex-shrink-0">
                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <span class="absolute bottom-3 left-3 bg-[#e9f1fe]/90 backdrop-blur-sm text-[#1668DC] text-[11px] font-bold px-[7.5px] py-[3.75px] rounded-[4px] uppercase shadow-sm">
                    {{ $item['category'] }}
                </span>
            </a>
            
            <!-- Content block -->
            <div class="p-[16px] flex flex-col flex-grow">
                <h3 class="text-[17px] font-bold text-[#1F2733] mb-2 line-clamp-2 hover:text-[#1668DC] transition-colors leading-[1.4]">
                    <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                </h3>
                <p class="text-[#6B7280] text-[13.5px] leading-[1.6] line-clamp-2 mb-4 flex-grow">
                    {{ $item['excerpt'] }}
                </p>
                
                <!-- Footer stats -->
                <div class="flex items-center justify-between text-[#6B7280] text-[13px] pt-1">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-[15px] h-[15px]">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            {{ $item['date'] }}
                        </div>
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-[15px] h-[15px]">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            {{ $item['views'] }}
                        </div>
                    </div>
                    <a href="{{ $item['url'] }}" class="text-[#1668DC] font-medium flex items-center gap-1 hover:underline">
                        Chi tiết <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
