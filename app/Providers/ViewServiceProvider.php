<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\JobListing;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share services data with header view
        View::composer('layouts.header', function ($view) {
            $headerServices = Service::active()->ordered()->limit(10)->get();

            // Get total job count and jobs for header menu
            $totalJobs = JobListing::active()->count();
            $headerJobs = JobListing::active()->ordered()->limit(8)->get();

            $view->with([
                'headerServices' => $headerServices,
                'totalJobs' => $totalJobs,
                'headerJobs' => $headerJobs
            ]);
        });

        // Share latest jobs data with footer view
        View::composer('layouts.footer', function ($view) {
            $latestJobs = JobListing::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(['id', 'title', 'slug', 'category', 'location']);

            // Get latest 5 active services for footer
            $latestServices = Service::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(['id', 'name', 'slug']);

            $view->with([
                'latestJobs' => $latestJobs,
                'latestServices' => $latestServices
            ]);
        });
    }
}
