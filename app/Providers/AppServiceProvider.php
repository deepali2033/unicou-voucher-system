<?php

namespace App\Providers;

use App\Models\JobCategory;
use App\Models\Service;
use Illuminate\Support\Facades\View;
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
        if (! app()->runningInConsole()) {
            app()->setLocale(session('app_locale', config('app.locale')));
        }

        View::composer('*', function ($view) {
            $headerServices = Service::active()->ordered()->limit(10)->get();
            $JobCategory = JobCategory::active()->ordered()->get();
            $view->with('headerServices', $headerServices)
                ->with('JobCategory', $JobCategory);
        });
    }
}
