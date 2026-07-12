<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;

// Client Routes
Route::get('/', function () {
    return view('client.pages.home.index');
});

Route::get('/bang-xep-hang', function () {
    $breadcrumb = [
        ['label' => 'Trang chủ', 'url' => url('/')],
        ['label' => 'Bảng xếp hạng']
    ];
    return view('client.pages.ranking.index', compact('breadcrumb'));
});

Route::get('/bang-xep-hang/chi-tiet/{slug}', function ($slug) {
    // Giả lập data cơ sở
    $clinic = [
        'name' => 'Bệnh viện Thẩm mỹ Kim Cương',
        'category' => 'NÂNG MŨI · NÂNG NGỰC',
        'rating' => 5.0,
        'votes' => 500,
        'score' => 60,
        'address' => '100 Đường Thẩm Mỹ, Hà Nội',
        'phone' => '19000000',
        'website' => 'example.com',
        'description' => 'Cơ sở thẩm mỹ uy tín với đội ngũ bác sĩ giàu kinh nghiệm, trang thiết bị hiện đại, được khách hàng đánh giá cao.',
        'images' => [
            'https://picsum.photos/seed/clinic-0-a/800/500',
            'https://picsum.photos/seed/clinic-0-b/800/500'
        ]
    ];

    $breadcrumb = [
        ['label' => 'Trang chủ', 'url' => url('/')],
        ['label' => 'Xếp hạng', 'url' => url('/bang-xep-hang')],
        ['label' => $clinic['name']]
    ];

    return view('client.pages.ranking.detail', compact('clinic', 'breadcrumb'));
});

Route::get('/bai-viet', function (\Illuminate\Http\Request $request) {
    $type = $request->query('type', 'sub');
    $cat = $request->query('cat', 'phau-thuat-tham-my');

    if ($type === 'main') {
        if ($cat === 'cham-soc-da') {
            $category = [
                'name' => 'Chăm sóc da',
                'is_main' => true,
                'description' => 'Tổng hợp bài viết, đánh giá và xếp hạng các cơ sở uy tín về chăm sóc da — cập nhật liên tục, khách quan và minh bạch.',
                'children' => [
                    ['name' => 'Trẻ hóa da', 'slug' => 'tre-hoa-da'],
                    ['name' => 'Trị mụn', 'slug' => 'tri-mun'],
                    ['name' => 'Tắm trắng', 'slug' => 'tam-trang'],
                ]
            ];
            $breadcrumb = [
                ['label' => 'Trang chủ', 'url' => url('/')],
                ['label' => 'Chăm sóc da']
            ];
        } elseif ($cat === 'rang-ham-mat') {
            $category = [
                'name' => 'Răng - Hàm - Mặt',
                'is_main' => true,
                'description' => 'Tổng hợp bài viết, đánh giá và xếp hạng các nha khoa uy tín — cập nhật liên tục, khách quan và minh bạch.',
                'children' => [
                    ['name' => 'Niềng răng', 'slug' => 'nieng-rang'],
                    ['name' => 'Bọc răng sứ', 'slug' => 'boc-rang-su'],
                ]
            ];
            $breadcrumb = [
                ['label' => 'Trang chủ', 'url' => url('/')],
                ['label' => 'Răng - Hàm - Mặt']
            ];
        } else {
            $category = [
                'name' => 'Phẫu thuật thẩm mỹ',
                'is_main' => true,
                'description' => 'Tổng hợp bài viết, đánh giá và xếp hạng các cơ sở uy tín về phẫu thuật thẩm mỹ — cập nhật liên tục, khách quan và minh bạch.',
                'children' => [
                    ['name' => 'Nâng mũi', 'slug' => 'nang-mui'],
                    ['name' => 'Nâng ngực', 'slug' => 'nang-nguc'],
                    ['name' => 'Cắt mí', 'slug' => 'cat-mi'],
                    ['name' => 'Hút mỡ', 'slug' => 'hut-mo'],
                ]
            ];
            $breadcrumb = [
                ['label' => 'Trang chủ', 'url' => url('/')],
                ['label' => 'Phẫu thuật thẩm mỹ']
            ];
        }
    } else {
        if ($cat === 'nieng-rang' || $cat === 'boc-rang-su') {
            $parentName = 'Răng - Hàm - Mặt';
            $parentCat = 'rang-ham-mat';
            $name = $cat === 'nieng-rang' ? 'Niềng răng' : 'Bọc răng sứ';
        } elseif ($cat === 'tre-hoa-da' || $cat === 'tri-mun' || $cat === 'tam-trang') {
            $parentName = 'Chăm sóc da';
            $parentCat = 'cham-soc-da';
            $name = match($cat) {
                'tre-hoa-da' => 'Trẻ hóa da',
                'tri-mun' => 'Trị mụn',
                default => 'Tắm trắng',
            };
        } else {
            $parentName = 'Phẫu thuật thẩm mỹ';
            $parentCat = 'phau-thuat-tham-my';
            $name = match($cat) {
                'nang-mui' => 'Nâng mũi',
                'nang-nguc' => 'Nâng ngực',
                'cat-mi' => 'Cắt mí',
                default => 'Hút mỡ'
            };
        }

        $category = [
            'name' => $name,
            'is_main' => false,
        ];
        $breadcrumb = [
            ['label' => 'Trang chủ', 'url' => url('/')],
            ['label' => $parentName, 'url' => url("/bai-viet?type=main&cat={$parentCat}")],
            ['label' => $name]
        ];
    }

    $articles = [
        [
            'category' => 'HÚT MỠ',
            'title' => 'Hút mỡ bụng 2026: chi phí, công nghệ và những sự thật ít ai nói',
            'excerpt' => 'Hút mỡ bụng không phải phương pháp giảm cân. Bài viết so sánh 3 công nghệ phổ biến, chi phí thực tế từng hạng mục...',
            'date' => '05/07/2026',
            'views' => 1022,
            'image' => 'https://picsum.photos/seed/article1/400/250',
            'url' => url('/bai-viet/chi-tiet/hut-mo-bung-2026-chi-phi-cong-nghe-va-nhung-su-that')
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Cập nhật bảng giá hút mỡ toàn thân mới nhất 2026',
            'excerpt' => 'Bảng giá hút mỡ toàn thân, đùi, bắp tay tại các bệnh viện lớn. Các yếu tố ảnh hưởng đến chi phí bạn cần biết...',
            'date' => '02/07/2026',
            'views' => 856,
            'image' => 'https://picsum.photos/seed/article4/400/250',
            'url' => url('/bai-viet/chi-tiet/cap-nhat-bang-gia-hut-mo')
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Hút mỡ đùi có đau không? Review thực tế từ hội chị em',
            'excerpt' => 'Trải nghiệm hút mỡ đùi thực tế: mức độ đau, thời gian nghỉ dưỡng và kết quả sau 1 tháng, 3 tháng...',
            'date' => '28/06/2026',
            'views' => 1205,
            'image' => 'https://picsum.photos/seed/article5/400/250',
            'url' => url('/bai-viet/chi-tiet/hut-mo-dui-co-dau-khong')
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Biến chứng hút mỡ và cách phòng tránh hiệu quả',
            'excerpt' => 'Nhận biết sớm các dấu hiệu bất thường sau khi hút mỡ. Lời khuyên từ chuyên gia phẫu thuật tạo hình...',
            'date' => '25/06/2026',
            'views' => 310,
            'image' => 'https://picsum.photos/seed/article6/400/250',
            'url' => url('/bai-viet/chi-tiet/bien-chung-hut-mo')
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Nên hút mỡ hay tiêm tan mỡ? Đâu là giải pháp tối ưu',
            'excerpt' => 'So sánh chi tiết ưu nhược điểm của hút mỡ và tiêm tan mỡ. Đối tượng phù hợp cho từng phương pháp...',
            'date' => '20/06/2026',
            'views' => 450,
            'image' => 'https://picsum.photos/seed/article7/400/250',
            'url' => url('/bai-viet/chi-tiet/nen-hut-mo-hay-tiem-tan-mo')
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Top 5 bệnh viện hút mỡ uy tín nhất tại TP.HCM',
            'excerpt' => 'Danh sách các bệnh viện thẩm mỹ được cấp phép, có đội ngũ bác sĩ tay nghề cao và trang thiết bị hiện đại...',
            'date' => '15/06/2026',
            'views' => 2050,
            'image' => 'https://picsum.photos/seed/article8/400/250',
            'url' => url('/bai-viet/chi-tiet/top-5-benh-vien-hut-mo')
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Kinh nghiệm chăm sóc sau hút mỡ bụng giúp eo thon gọn nhanh chóng',
            'excerpt' => 'Hướng dẫn chi tiết cách vệ sinh, ăn uống và vận động sau khi hút mỡ bụng để đạt kết quả tốt nhất...',
            'date' => '10/06/2026',
            'views' => 1500,
            'image' => 'https://picsum.photos/seed/article9/400/250',
            'url' => url('/bai-viet/chi-tiet/kinh-nghiem-cham-soc-sau-hut-mo')
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Hút mỡ bắp tay: Những điều cần biết trước khi thực hiện',
            'excerpt' => 'Hút mỡ bắp tay có để lại sẹo không? Thời gian phục hồi bao lâu? Cùng chuyên gia giải đáp các thắc mắc phổ biến...',
            'date' => '05/06/2026',
            'views' => 800,
            'image' => 'https://picsum.photos/seed/article10/400/250',
            'url' => url('/bai-viet/chi-tiet/hut-mo-bap-tay')
        ]
    ];

    return view('client.pages.category.index', compact('category', 'articles', 'breadcrumb'));
});

Route::get('/bai-viet/chi-tiet/{slug}', function ($slug) {
    $post = \App\Models\Post::with(['category', 'provinces', 'salons', 'user'])->where('slug', $slug)->first();

    if ($post) {
        $article = [
            'title' => $post->title,
            'category' => $post->category ? mb_strtoupper($post->category->name) : 'TIN TỨC',
            'date' => $post->created_at->format('d/m/Y'),
            'author' => $post->user->name ?? 'Quản trị viên',
            'locations' => $post->provinces->pluck('name')->implode(', ') ?: 'Toàn quốc',
            'views' => 608,
            'read_time' => 2,
            'image' => $post->thumbnail ?? 'https://picsum.photos/seed/article-4/800/500',
            'content' => $post->content,
        ];

        $breadcrumb = [
            ['label' => 'Trang chủ', 'url' => url('/')],
            ['label' => $post->category->name ?? 'Tin tức', 'url' => url('/bai-viet?type=sub&cat=' . \Illuminate\Support\Str::slug($post->category->name ?? 'tin-tuc'))],
            ['label' => $post->title]
        ];
    } else {
        $article = [
            'title' => 'Bọc răng sứ giá bao nhiêu? Bảng giá 2026 và 5 điều phải hỏi trước khi làm',
            'category' => 'BỌC RĂNG SỨ',
            'date' => '09/07/2026',
            'author' => 'Quản trị viên',
            'locations' => 'Hà Nội, Hải Phòng',
            'views' => 608,
            'read_time' => 2,
            'image' => 'https://picsum.photos/seed/article-4/800/500',
            'content' => null,
        ];

        $breadcrumb = [
            ['label' => 'Trang chủ', 'url' => url('/')],
            ['label' => 'Bọc răng sứ', 'url' => url('/bai-viet?type=sub&cat=boc-rang-su')],
            ['label' => 'Bọc răng sứ giá bao nhiêu? Bảng giá 2026 và 5 điều phải hỏi trước khi làm']
        ];
    }

    $relatedArticles = [
        [
            'category' => 'NIỀNG RĂNG',
            'title' => 'Niềng răng trong suốt hay mắc cài: chọn loại nào năm 2026?',
            'excerpt' => 'Niềng răng trong suốt đắt gấp đôi mắc cài — có đáng không? So sánh thẳng hiệu quả, thời gian...',
            'date' => '02/07/2026',
            'views' => 707,
            'image' => 'https://picsum.photos/seed/n1/400/250',
            'url' => url('/bai-viet/chi-tiet/nieng-rang-trong-suot-hay-mac-cai')
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Hút mỡ bụng 2026: chi phí, công nghệ và những sự thật ít ai nói',
            'excerpt' => 'Hút mỡ bụng không phải phương pháp giảm cân. Bài viết so sánh 3 công nghệ phổ biến, chi phí...',
            'date' => '05/07/2026',
            'views' => 1022,
            'image' => 'https://picsum.photos/seed/n2/400/250',
            'url' => url('/bai-viet/chi-tiet/hut-mo-bung-2026-chi-phi-cong-nghe-va-nhung-su-that')
        ],
        [
            'category' => 'TRẺ HÓA DA',
            'title' => 'Trẻ hóa da công nghệ cao: so sánh HIFU, RF và Laser chi tiết 2026',
            'excerpt' => 'HIFU, RF hay Laser — mỗi công nghệ trẻ hóa da giải quyết một tầng lão hóa khác nhau. Hiểu đúng cơ chế...',
            'date' => '04/07/2026',
            'views' => 914,
            'image' => 'https://picsum.photos/seed/n3/400/250',
            'url' => url('/bai-viet/chi-tiet/tre-hoa-da-cong-nghe-cao')
        ],
        [
            'category' => 'TRỊ MỤN',
            'title' => 'Trị mụn chuẩn y khoa: lộ trình 3 tháng sạch mụn, hạn chế tái phát',
            'excerpt' => 'Mụn không thể hết sau một buổi lấy nhân. Đây là lộ trình trị mụn 3 tháng theo phác đồ da liễu...',
            'date' => '03/07/2026',
            'views' => 802,
            'image' => 'https://picsum.photos/seed/n4/400/250',
            'url' => url('/bai-viet/chi-tiet/tri-mun-chuan-y-khoa')
        ]
    ];

    $recentArticles = $relatedArticles; // Reusing for sidebar

    return view('client.pages.post.detail', compact('article', 'breadcrumb', 'relatedArticles', 'recentArticles'));
});

Route::get('/tinh-thanh', function () {
    $regions = [
        [
            'name' => 'Miền Bắc',
            'count' => 15,
            'provinces' => [
                ['name' => 'Hà Nội', 'posts' => 1, 'slug' => 'ha-noi'],
                ['name' => 'Hải Phòng', 'posts' => 1, 'slug' => 'hai-phong'],
                ['name' => 'Quảng Ninh', 'posts' => 0, 'slug' => 'quang-ninh'],
                ['name' => 'Bắc Ninh', 'posts' => 0, 'slug' => 'bac-ninh'],
                ['name' => 'Hưng Yên', 'posts' => 0, 'slug' => 'hung-yen'],
                ['name' => 'Ninh Bình', 'posts' => 0, 'slug' => 'ninh-binh'],
                ['name' => 'Phú Thọ', 'posts' => 0, 'slug' => 'phu-tho'],
                ['name' => 'Thái Nguyên', 'posts' => 0, 'slug' => 'thai-nguyen'],
                ['name' => 'Tuyên Quang', 'posts' => 0, 'slug' => 'tuyen-quang'],
                ['name' => 'Lào Cai', 'posts' => 0, 'slug' => 'lao-cai'],
                ['name' => 'Lai Châu', 'posts' => 0, 'slug' => 'lai-chau'],
                ['name' => 'Điện Biên', 'posts' => 0, 'slug' => 'dien-bien'],
                ['name' => 'Sơn La', 'posts' => 0, 'slug' => 'son-la'],
                ['name' => 'Lạng Sơn', 'posts' => 0, 'slug' => 'lang-son'],
                ['name' => 'Cao Bằng', 'posts' => 0, 'slug' => 'cao-bang'],
            ]
        ],
        [
            'name' => 'Miền Trung',
            'count' => 11,
            'provinces' => [
                ['name' => 'Đà Nẵng', 'posts' => 0, 'slug' => 'da-nang'],
                ['name' => 'Huế', 'posts' => 0, 'slug' => 'hue'],
                ['name' => 'Thanh Hóa', 'posts' => 0, 'slug' => 'thanh-hoa'],
                ['name' => 'Nghệ An', 'posts' => 0, 'slug' => 'nghe-an'],
                ['name' => 'Hà Tĩnh', 'posts' => 0, 'slug' => 'ha-tinh'],
                ['name' => 'Quảng Trị', 'posts' => 0, 'slug' => 'quang-tri'],
                ['name' => 'Quảng Ngãi', 'posts' => 0, 'slug' => 'quang-ngai'],
                ['name' => 'Gia Lai', 'posts' => 0, 'slug' => 'gia-lai'],
                ['name' => 'Đắk Lắk', 'posts' => 0, 'slug' => 'dak-lak'],
                ['name' => 'Khánh Hòa', 'posts' => 0, 'slug' => 'khanh-hoa'],
                ['name' => 'Lâm Đồng', 'posts' => 0, 'slug' => 'lam-dong'],
            ]
        ],
        [
            'name' => 'Miền Nam',
            'count' => 8,
            'provinces' => [
                ['name' => 'TP. Hồ Chí Minh', 'posts' => 0, 'slug' => 'ho-chi-minh'],
                ['name' => 'Đồng Nai', 'posts' => 0, 'slug' => 'dong-nai'],
                ['name' => 'Tây Ninh', 'posts' => 0, 'slug' => 'tay-ninh'],
                ['name' => 'Cần Thơ', 'posts' => 0, 'slug' => 'can-tho'],
                ['name' => 'Vĩnh Long', 'posts' => 0, 'slug' => 'vinh-long'],
                ['name' => 'Đồng Tháp', 'posts' => 0, 'slug' => 'dong-thap'],
                ['name' => 'An Giang', 'posts' => 0, 'slug' => 'an-giang'],
                ['name' => 'Cà Mau', 'posts' => 0, 'slug' => 'ca-mau'],
            ]
        ]
    ];

    return view('client.pages.province.index', compact('regions'));
});

Route::get('/tinh-thanh/{slug}', function ($slug) {
    // Giả lập data tỉnh thành
    $provinces = [
        'ha-noi' => ['name' => 'Hà Nội', 'region' => 'Miền Bắc'],
        'hai-phong' => ['name' => 'Hải Phòng', 'region' => 'Miền Bắc'],
    ];
    
    $province = $provinces[$slug] ?? ['name' => ucwords(str_replace('-', ' ', $slug)), 'region' => 'Miền Bắc'];

    $breadcrumb = [
        ['label' => 'Trang chủ', 'url' => url('/')],
        ['label' => 'Tỉnh thành', 'url' => url('/tinh-thanh')],
        ['label' => $province['name']]
    ];

    // Dummy data
    $articles = [
        [
            'category' => 'BỌC RĂNG SỨ',
            'title' => 'Bọc răng sứ giá bao nhiêu? Bảng giá 2026 và 5 điều phải hỏi trước...',
            'excerpt' => 'Giá bọc răng sứ chênh từ 1 đến 15 triệu mỗi răng — vì sao? Phân tích từng dòng sứ...',
            'date' => '01/07/2026',
            'views' => 607,
            'image' => 'https://picsum.photos/seed/hanoi1/400/250',
            'url' => url('/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu')
        ],
        [
            'category' => 'NÂNG MŨI',
            'title' => 'Top 3 bác sĩ nâng mũi uy tín nhất tại ' . $province['name'],
            'excerpt' => 'Đánh giá chi tiết tay nghề, kinh nghiệm và chi phí nâng mũi tại các cơ sở hàng đầu...',
            'date' => '28/06/2026',
            'views' => 450,
            'image' => 'https://picsum.photos/seed/hanoi2/400/250',
            'url' => url('/bai-viet/chi-tiet/top-3-bac-si-nang-mui-uy-tin-nhat')
        ]
    ];

    return view('client.pages.province.detail', compact('province', 'articles', 'breadcrumb'));
});

Route::get('/ve-chung-toi', function () {
    $breadcrumb = [
        ['label' => 'Trang chủ', 'url' => url('/')],
        ['label' => 'Về chúng tôi']
    ];
    return view('client.pages.about', compact('breadcrumb'));
});

Route::get('/chinh-sach', function () {
    $breadcrumb = [
        ['label' => 'Trang chủ', 'url' => url('/')],
        ['label' => 'Chính sách & Điều khoản']
    ];
    return view('client.pages.policy', compact('breadcrumb'));
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.pages.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.pages.dashboard');
    });

    Route::get('/analytics', function () {
        return view('admin.pages.analytics');
    });

    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');

    Route::get('/clinics', function () {
        return view('admin.pages.clinics.index');
    });

    Route::get('/clinics/create', function () {
        return view('admin.pages.clinics.create');
    });

    Route::get('/clinics/{id}/edit', function () {
        return view('admin.pages.clinics.edit');
    });

    Route::get('/categories', function () {
        return view('admin.pages.categories.index');
    });

    Route::get('/comments', function () {
        return view('admin.pages.comments.index');
    });

    Route::get('/users', function () {
        return view('admin.pages.users.index');
    });
});
