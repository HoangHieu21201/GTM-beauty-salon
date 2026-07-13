<?php

use App\Http\Controllers\Admin\ClinicController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Client\RankingController;
use App\Models\Category;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;

// Auth Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Client Routes
Route::get('/', function () {
    return view('client.pages.home.index');
});

Route::get('/bang-xep-hang', [RankingController::class, 'index'])->name('ranking.index');
Route::get('/bang-xep-hang/chi-tiet/{slug}', [RankingController::class, 'show'])->name('ranking.show');

Route::get('/tim-kiem', [\App\Http\Controllers\Client\SearchController::class, 'index'])->name('search');

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

    $dbCategories = Category::with('children')->get();
    $currentDbCategory = $dbCategories->first(
        fn (Category $item): bool => \Illuminate\Support\Str::slug($item->name) === $cat
    );

    if ($type === 'main') {
        $clinicCategorySlugs = $currentDbCategory
            ? $currentDbCategory->children
                ->map(fn (Category $child): string => \Illuminate\Support\Str::slug($child->name))
                ->push(\Illuminate\Support\Str::slug($currentDbCategory->name))
                ->all()
            : collect($category['children'] ?? [])
                ->pluck('slug')
                ->push($cat)
                ->all();
    } else {
        $clinicCategorySlugs = [$cat];
    }

    $categoryClinics = RankingController::rankedClinics(null, $clinicCategorySlugs);

    if ($type === 'main') {
        $postCategoryIds = $currentDbCategory
            ? $currentDbCategory->children->pluck('id')->push($currentDbCategory->id)->all()
            : [];
    } else {
        $postCategoryIds = $currentDbCategory ? [$currentDbCategory->id] : [];
    }

    $articles = \App\Models\Post::with('category')
        ->when(!empty($postCategoryIds), function ($query) use ($postCategoryIds) {
            $query->whereIn('category_id', $postCategoryIds);
        })
        ->where('status', 'published')
        ->latest('id')
        ->paginate(12)
        ->appends(request()->query());

    $articles->getCollection()->transform(function ($post) {
        return [
            'category' => mb_strtoupper($post->category->name ?? 'CHUNG'),
            'title' => $post->title,
            'excerpt' => $post->short_description,
            'date' => $post->created_at->format('d/m/Y'),
            'views' => random_int(100, 2000),
            'image' => str_starts_with($post->thumbnail, 'http') ? $post->thumbnail : asset($post->thumbnail),
            'url' => url('/bai-viet/chi-tiet/' . $post->slug)
        ];
    });



    return view('client.pages.category.index', compact('category', 'articles', 'breadcrumb', 'categoryClinics'));
});

Route::get('/bai-viet/chi-tiet/{slug}', function ($slug) {
    $post = \App\Models\Post::with(['category', 'provinces', 'salons', 'user'])
        ->where('status', 'published')
        ->where('slug', $slug)
        ->first();

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
            ['label' => $post->category?->name ?? 'Tin tức', 'url' => url('/bai-viet?type=sub&cat=' . \Illuminate\Support\Str::slug($post->category?->name ?? 'tin-tuc'))],
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
Route::prefix('admin')->middleware([\App\Http\Middleware\BypassAdminLogin::class, 'auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('admin.analytics.index');

    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::post('/posts/upload-image', [PostController::class, 'uploadEditorImage'])->name('admin.posts.uploadImage');

    Route::patch('/clinics/reorder', [ClinicController::class, 'reorder'])->name('admin.clinics.reorder');
    Route::patch('/clinics/{clinic}/images', [ClinicController::class, 'updateImages'])->name('admin.clinics.images');
    Route::resource('clinics', ClinicController::class)->except(['show'])->names('admin.clinics');

    Route::get('categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->only(['store', 'update', 'destroy'])->names('admin.categories')->middleware(\App\Http\Middleware\CheckSuperAdmin::class);

    Route::get('/comments', function () {
        return view('admin.pages.comments.index');
    });

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show', 'create', 'edit'])->names('admin.users');
    Route::post('/roles', [\App\Http\Controllers\Admin\RoleController::class, 'store'])->name('admin.roles.store');

    Route::middleware(['auth'])->group(function () {
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.index');

        Route::middleware([\App\Http\Middleware\CheckSuperAdmin::class])->group(function () {
            Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');
            Route::delete('/settings/logo', [\App\Http\Controllers\Admin\SettingController::class, 'deleteLogo'])->name('admin.settings.logo.delete');
        });
    });
});
