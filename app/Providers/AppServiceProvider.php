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
        View::composer(['admin.pages.clinics.create', 'admin.pages.clinics.edit'], function ($view): void {
            $errors = $view->getFactory()->shared('errors') ?? new \Illuminate\Support\MessageBag();
            $view->with('inputClass', fn (string $field, string $extra = '') => trim('w-full px-3 py-2 rounded-lg border outline-none transition text-sm ' . ($errors->has($field) ? 'border-red-400 focus:border-red-500 focus:ring-2 focus:ring-red-100' : 'border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20') . ' ' . $extra));
            $view->with('selectClass', fn (string $field, string $extra = '') => trim('w-full px-3 py-2 rounded-lg border bg-white text-sm outline-none transition ' . ($errors->has($field) ? 'border-red-400 text-red-700 focus:border-red-500 focus:ring-2 focus:ring-red-100' : 'border-gray-200 text-gray-700 focus:border-primary focus:ring-2 focus:ring-primary/20') . ' ' . $extra));
        });
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
