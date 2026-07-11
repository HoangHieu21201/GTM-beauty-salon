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
                    {{ setting('footer_brand_desc', 'Đánh giá khách quan, xếp hạng minh bạch các cơ sở thẩm mỹ.') }}
                </p>
            </div>

            <!-- Dynamic Columns -->
            @php
                $defaultColumns = [
                    ['title' => 'Về chúng tôi', 'links' => [['text' => 'Giới thiệu', 'url' => '/ve-chung-toi#gioi-thieu'], ['text' => 'Liên hệ', 'url' => '/ve-chung-toi#lien-he'], ['text' => 'Hợp tác', 'url' => '/ve-chung-toi#hop-tac']]],
                    ['title' => 'Danh mục', 'links' => [['text' => 'Phẫu thuật thẩm mỹ', 'url' => '/bai-viet?type=main&cat=phau-thuat-tham-my'], ['text' => 'Chăm sóc da', 'url' => '/bai-viet?type=main&cat=cham-soc-da'], ['text' => 'Răng - Hàm - Mặt', 'url' => '/bai-viet?type=main&cat=rang-ham-mat'], ['text' => 'Bài viết theo tỉnh thành', 'url' => '/tinh-thanh']]],
                    ['title' => 'Chính sách', 'links' => [['text' => 'Điều khoản sử dụng', 'url' => '/chinh-sach#dieu-khoan-su-dung'], ['text' => 'Chính sách bảo mật', 'url' => '/chinh-sach#chinh-sach-bao-mat'], ['text' => 'Tiêu chí đánh giá', 'url' => '/chinh-sach#tieu-chi-danh-gia']]]
                ];
                $columnsData = json_decode(setting('footer_columns'), true);
                if (!$columnsData) {
                    $columnsData = $defaultColumns;
                }
            @endphp

            @foreach($columnsData as $column)
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-white font-bold text-[15px] mb-4">{{ $column['title'] ?? '' }}</h3>
                <ul class="space-y-3 text-[14px]">
                    @if(isset($column['links']) && is_array($column['links']))
                        @foreach($column['links'] as $link)
                        <li><a href="{{ url($link['url'] ?? '#') }}" class="hover:text-white transition-colors">{{ $link['text'] ?? '' }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            @endforeach

            <!-- Kết nối -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-white font-bold text-[15px] mb-4">Kết nối</h3>
                <div class="flex gap-4">
                    @php
                        $defaultSocials = [
                            ['icon' => 'pi-facebook', 'url' => '#', 'title' => 'Facebook'],
                            ['icon' => 'pi-comment', 'url' => '#', 'title' => 'Zalo'],
                            ['icon' => 'pi-youtube', 'url' => '#', 'title' => 'YouTube']
                        ];
                        $socialsData = json_decode(setting('footer_socials'), true);
                        if (!$socialsData) {
                            $socialsData = $defaultSocials;
                        }
                    @endphp
                    @foreach($socialsData as $social)
                        @php
                            $socialUrl = '#';
                            if (!empty($social['url'])) {
                                $scheme = parse_url($social['url'], PHP_URL_SCHEME);
                                if (in_array(strtolower($scheme), ['http', 'https'])) {
                                    $socialUrl = $social['url'];
                                }
                            }
                        @endphp
                        <a href="{{ $socialUrl }}" class="text-[#94a3b8] hover:text-white transition-colors" title="{{ $social['title'] ?? '' }}"><i class="pi {{ $social['icon'] ?? '' }} text-xl"></i></a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="pt-6 text-[13px] text-center md:text-left text-[#64748b]">
            {{ setting('footer_copyright', '© 2026 Review Thẩm Mỹ — Hệ thống đánh giá & xếp hạng cơ sở thẩm mỹ.') }}
        </div>
    </div>
</footer>
