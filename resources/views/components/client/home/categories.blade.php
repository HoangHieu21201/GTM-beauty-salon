<div class="max-w-[1200px] mx-auto px-4 mt-12 mb-8">
    <div class="flex items-center gap-2.5 mb-8">
        <div class="w-1.5 h-6 bg-[#1668DC] rounded-full"></div>
        <h2 class="text-[18px] font-bold text-[#0F2A4A] uppercase tracking-wide">Khám phá danh mục</h2>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @php
            $iconMapping = [
                'phau-thuat-tham-my' => '<path d="m18 2 4 4"></path><path d="m17 7 3-3"></path><path d="M19 9 8.7 19.3c-1 1-2.5 1-3.4 0l-.6-.6c-1-1-1-2.5 0-3.4L15 5"></path><path d="m9 11 4 4"></path><path d="m5 19-3 3"></path><path d="m14 4 6 6"></path>',
                'nang-mui' => '<path d="M13 4.5c.3 3.8-2.8 6.6-2.8 9.7 0 1.6 1.2 2.8 2.8 2.8.8 0 1.5-.3 2-.9"></path><path d="M9.6 16.4c-.6.5-1 1.2-1 2"></path><path d="M18.5 4.5v3.4"></path><path d="M16.8 6.2h3.4"></path>',
                'tre-hoa-da' => '<path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path>',
                'nieng-rang' => '<path d="M12 6c-1.6-1.8-4-2.3-5.8-1.1C4.3 6.1 3.6 8.4 4.3 11c.8 3 1.7 8 3.4 8 1.4 0 1.3-3.2 2.3-5.7.4-1 1.6-1 2 0 1 2.5.9 5.7 2.3 5.7 1.7 0 2.6-5 3.4-8 .7-2.6 0-4.9-1.9-6.1C16 3.7 13.6 4.2 12 6Z"></path><path d="M5 11.2h14"></path><path d="M9.3 10v2.4"></path><path d="M14.7 10v2.4"></path>',
                'nang-nguc' => '<path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.51 4.04 3 5.5l7 7Z"></path>',
                'cham-soc-da' => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path>',
                'tri-mun' => '<circle cx="11" cy="11" r="7.5"></circle><path d="m21.5 21.5-4.2-4.2"></path><path d="M8.5 9h.01"></path><path d="M13 10.5h.01"></path><path d="M10 13h.01"></path>',
                'boc-rang-su' => '<path d="M11.5 7c-1.5-1.7-3.7-2.1-5.3-1C4.5 7 3.8 9.2 4.4 11.6c.7 2.8 1.6 7.4 3.2 7.4 1.3 0 1.2-2.9 2.1-5.2.4-1 1.5-1 1.9 0 1 2.3.8 5.2 2.1 5.2 1.6 0 2.5-4.6 3.2-7.4.6-2.4-.1-4.6-1.8-5.6-1.6-1.1-3.8-.7-5.6 1Z"></path><path d="M19 2.5v3.4"></path><path d="M17.3 4.2h3.4"></path>',
                'cat-mi' => '<path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path><circle cx="12" cy="12" r="3"></circle>',
                'tam-trang' => '<path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"></path><path d="M9.2 15a2.8 2.8 0 0 0 2.2 2.7"></path>',
                'rang-ham-mat' => '<path d="M12 6c-1.6-1.8-4-2.3-5.8-1.1C4.3 6.1 3.6 8.4 4.3 11c.8 3 1.7 8 3.4 8 1.4 0 1.3-3.2 2.3-5.7.4-1 1.6-1 2 0 1 2.5.9 5.7 2.3 5.7 1.7 0 2.6-5 3.4-8 .7-2.6 0-4.9-1.9-6.1C16 3.7 13.6 4.2 12 6Z"></path>',
                'hut-mo' => '<path d="M8.5 3C8.5 7 6 8.5 6 12s2.5 5 2.5 9"></path><path d="M15.5 3c0 4 2.5 5.5 2.5 9s-2.5 5-2.5 9"></path>',
            ];
            
            $defaultIcon = '<path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v4"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="m3 15 2 2 4-4"></path>';

            // Load categories from Database
            $dbCategories = \App\Models\Category::take(12)->get();
        @endphp

        @foreach($dbCategories as $cat)
        @php
            $icon = $iconMapping[$cat->slug] ?? $defaultIcon;
            $type = is_null($cat->parent_id) ? 'main' : 'sub';
            $url = url('/bai-viet?type=' . $type . '&cat=' . ($cat->slug ?: \Illuminate\Support\Str::slug($cat->name)));
        @endphp
        <a href="{{ $url }}" class="cat-item group bg-white border border-[#e6e9ee] rounded-[10px] flex flex-col items-center justify-center hover:border-transparent card-hover" style="padding: 22px 10px;">
            <div class="w-[56px] h-[56px] rounded-[18px] grid place-items-center text-[#1668dc] border border-[#e3edfc] bg-gradient-to-br from-[#e9f1fe] to-[#f4f8ff] group-hover:from-[#1668dc] group-hover:to-[#1668dc] group-hover:text-white group-hover:border-[#1668dc] transition-all duration-200 mb-[10px]">
                <svg class="w-[54px] h-[54px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                    {!! $icon !!}
                </svg>
            </div>
            <span class="nm text-[13px] font-medium text-[#1F2733] text-center">{{ $cat->name }}</span>
        </a>
        @endforeach
    </div>
</div>
