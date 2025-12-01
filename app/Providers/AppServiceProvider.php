<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $settings = cache()->remember('app_settings', 3600, function () {
                return \App\Models\Setting::pluck('value', 'key')->toArray();
            });

            $navCategories = cache()->remember('nav_categories', 3600, function () {
                return Category::query()
                    ->orderBy('nombre')
                    ->get(['nombre', 'slug']);
            });

            $view->with('appSettings', $settings);
            $view->with('navCategories', $navCategories);
        });
    }
}
