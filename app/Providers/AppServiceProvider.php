<?php

namespace App\Providers;

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

            $view->with('appSettings', $settings);
        });
    }
}
