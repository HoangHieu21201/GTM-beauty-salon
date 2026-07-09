<?php

use Illuminate\Support\Facades\Route;

// Client Routes
Route::get('/', function () {
    return view('client.pages.home');
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
            'url' => '#'
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Cập nhật bảng giá hút mỡ toàn thân mới nhất 2026',
            'excerpt' => 'Bảng giá hút mỡ toàn thân, đùi, bắp tay tại các bệnh viện lớn. Các yếu tố ảnh hưởng đến chi phí bạn cần biết...',
            'date' => '02/07/2026',
            'views' => 856,
            'image' => 'https://picsum.photos/seed/article4/400/250',
            'url' => '#'
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Hút mỡ đùi có đau không? Review thực tế từ hội chị em',
            'excerpt' => 'Trải nghiệm hút mỡ đùi thực tế: mức độ đau, thời gian nghỉ dưỡng và kết quả sau 1 tháng, 3 tháng...',
            'date' => '28/06/2026',
            'views' => 1205,
            'image' => 'https://picsum.photos/seed/article5/400/250',
            'url' => '#'
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Biến chứng hút mỡ và cách phòng tránh hiệu quả',
            'excerpt' => 'Nhận biết sớm các dấu hiệu bất thường sau khi hút mỡ. Lời khuyên từ chuyên gia phẫu thuật tạo hình...',
            'date' => '25/06/2026',
            'views' => 310,
            'image' => 'https://picsum.photos/seed/article6/400/250',
            'url' => '#'
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Nên hút mỡ hay tiêm tan mỡ? Đâu là giải pháp tối ưu',
            'excerpt' => 'So sánh chi tiết ưu nhược điểm của hút mỡ và tiêm tan mỡ. Đối tượng phù hợp cho từng phương pháp...',
            'date' => '20/06/2026',
            'views' => 450,
            'image' => 'https://picsum.photos/seed/article7/400/250',
            'url' => '#'
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Top 5 bệnh viện hút mỡ uy tín nhất tại TP.HCM',
            'excerpt' => 'Danh sách các bệnh viện thẩm mỹ được cấp phép, có đội ngũ bác sĩ tay nghề cao và trang thiết bị hiện đại...',
            'date' => '15/06/2026',
            'views' => 2050,
            'image' => 'https://picsum.photos/seed/article8/400/250',
            'url' => '#'
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Kinh nghiệm chăm sóc sau hút mỡ bụng giúp eo thon gọn nhanh chóng',
            'excerpt' => 'Hướng dẫn chi tiết cách vệ sinh, ăn uống và vận động sau khi hút mỡ bụng để đạt kết quả tốt nhất...',
            'date' => '10/06/2026',
            'views' => 1500,
            'image' => 'https://picsum.photos/seed/article9/400/250',
            'url' => '#'
        ],
        [
            'category' => 'HÚT MỠ',
            'title' => 'Hút mỡ bắp tay: Những điều cần biết trước khi thực hiện',
            'excerpt' => 'Hút mỡ bắp tay có để lại sẹo không? Thời gian phục hồi bao lâu? Cùng chuyên gia giải đáp các thắc mắc phổ biến...',
            'date' => '05/06/2026',
            'views' => 800,
            'image' => 'https://picsum.photos/seed/article10/400/250',
            'url' => '#'
        ]
    ];

    return view('client.pages.category', compact('category', 'breadcrumb', 'articles'));
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

    Route::get('/posts', function () {
        return view('admin.pages.posts.index');
    });

    Route::get('/posts/create', function () {
        return view('admin.pages.posts.create');
    });

    Route::get('/posts/{id}/edit', function () {
        return view('admin.pages.posts.edit');
    });

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
