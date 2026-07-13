<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Helpers/SettingsHelper.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.client.layout.catnav', function ($view): void {
            $view->with('clientNavCategories', Category::with([
                'children' => fn ($query) => $query->orderBy('name'),
            ])
                ->whereNull('parent_id')
                ->orderBy('name')
                ->get());
        });
    }
}
