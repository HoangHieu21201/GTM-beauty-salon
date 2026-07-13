<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Artisan;

try {
    // --force is required in production environment
    Artisan::call('migrate', ['--force' => true]);
    echo "<h1>Database Migrated Successfully!</h1>";
    echo "<p>Output: " . nl2br(Artisan::output()) . "</p>";
} catch (\Exception $e) {
    echo "<h1>Error migrating database:</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}

echo "<br><br><i>Lưu ý: Để bảo mật, hãy xoá cực kỳ gấp file này sau khi chạy thành công.</i>";
