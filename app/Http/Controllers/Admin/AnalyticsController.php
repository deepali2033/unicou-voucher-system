<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Basic totals
        $totalUsers = User::count();
        $totalServices = Service::count();
        $totalJobs = JobListing::count();

        // Total stats array expected by the view
        $totalStats = [
            'users' => $totalUsers,
            'services' => $totalServices,
            'jobs' => $totalJobs,
        ];

        // User statistics with safe column checks
        $userStats = [
            'total' => $totalUsers,
            'candidates' => User::where('account_type', 'candidate')->count(),
            'recruiters' => User::where('account_type', 'recruiter')->count(),
            'freelancers' => User::where('account_type', 'freelancer')->count(),
            'verified' => User::whereNotNull('email_verified_at')->count(),
            'unverified' => User::whereNull('email_verified_at')->count(),
            'recent' => User::where('created_at', '>=', Carbon::now()->subDays(30))->count(),
            // Additional stats needed by the view
            'verified_freelancers' => User::where('account_type', 'freelancer')
                ->whereNotNull('email_verified_at')
                ->count(),
            'pending_verifications' => User::whereNull('email_verified_at')->count(),
            'recent_registrations' => User::where('created_at', '>=', Carbon::now()->subDays(30))->count(),
            // For charts
            'by_type' => [
                'candidate' => User::where('account_type', 'candidate')->count(),
                'recruiter' => User::where('account_type', 'recruiter')->count(),
                'freelancer' => User::where('account_type', 'freelancer')->count(),
            ],
        ];

        // Service statistics
        $serviceStats = [
            'total' => $totalServices,
            'active' => Service::where('is_active', true)->count(),
            'inactive' => Service::where('is_active', false)->count(),
            'featured' => Service::where('is_featured', true)->count(),
            'recent' => Service::where('created_at', '>=', Carbon::now()->subDays(30))->count(),
            // Additional stats needed by the view
            'pending_approval' => Service::where('is_active', false)->count(), // Assuming inactive means pending approval
        ];

        // Job statistics
        $jobStats = [
            'total' => $totalJobs,
            'active' => JobListing::where('is_active', true)->count(),
            'inactive' => JobListing::where('is_active', false)->count(),
            'featured' => JobListing::where('is_featured', true)->count(),
            'recent' => JobListing::where('created_at', '>=', Carbon::now()->subDays(30))->count(),
            // Additional stats needed by the view
            'recent_posts' => JobListing::where('created_at', '>=', Carbon::now()->subDays(30))->count(),
            // For charts - using actual employment types from JobListing model
            'by_employment_type' => [
                'full-time' => JobListing::where('employment_type', 'full-time')->count(),
                'part-time' => JobListing::where('employment_type', 'part-time')->count(),
                'contract' => JobListing::where('employment_type', 'contract')->count(),
                'temporary' => JobListing::where('employment_type', 'temporary')->count(),
            ],
        ];

        // Growth trends for the last 6 months
        $growthData = $this->getGrowthTrends();

        // Data distributions for charts
        $distributions = [
            'user_verification' => [
                'verified' => User::whereNotNull('email_verified_at')->count(),
                'pending' => 0, // Assuming no pending verification status
                'rejected' => 0, // Assuming no rejected verification status
                'unverified' => User::whereNull('email_verified_at')->count(),
            ],
            'service_status' => [
                'active' => Service::where('is_active', true)->count(),
                'inactive' => Service::where('is_active', false)->count(),
            ],
            'service_approval' => [
                'approved' => Service::where('is_active', true)->count(), // Assuming active means approved
                'pending' => Service::where('is_active', false)->count(), // Assuming inactive means pending
                'rejected' => 0, // Assuming no rejected status in current schema
            ],
            'job_status' => [
                'active' => JobListing::where('is_active', true)->count(),
                'inactive' => JobListing::where('is_active', false)->count(),
            ],
        ];

        // Fix the variable name for the JavaScript (growthTrends instead of growthData)
        $growthTrends = $growthData;

        return view('admin.analytics.index', compact(
            'totalStats',
            'userStats',
            'serviceStats',
            'jobStats',
            'growthData',
            'growthTrends',
            'distributions'
        ));
    }

    private function getGrowthTrends()
    {
        $months = [];
        $userGrowth = [];
        $serviceGrowth = [];
        $jobGrowth = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M Y');

            // Count records created in this month
            $userGrowth[] = User::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $serviceGrowth[] = Service::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $jobGrowth[] = JobListing::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'months' => $months,
            'users' => $userGrowth,
            'services' => $serviceGrowth,
            'jobs' => $jobGrowth,
        ];
    }
}
