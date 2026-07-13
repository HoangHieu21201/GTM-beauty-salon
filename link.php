<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Artisan;

try {
    Artisan::call('storage:link');
    echo "<h1>Storage Linked Successfully!</h1>";
    echo "<p>Output: " . nl2br(Artisan::output()) . "</p>";
} catch (\Exception $e) {
    echo "<h1>Error linking storage:</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}

echo "<br><br><i>Lưu ý: Để bảo mật, hãy xoá file này sau khi chạy thành công.</i>";
