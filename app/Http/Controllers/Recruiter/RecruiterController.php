<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\JobListing;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        $stats = [
            'total_services' => Service::where('user_id', $userId)->count(),
            'active_services' => Service::where('user_id', $userId)->active()->count(),
            'featured_services' => Service::where('user_id', $userId)->featured()->count(),
            'inactive_services' => Service::where('user_id', $userId)->where('is_active', false)->count(),
            'total_jobs' => JobListing::where('user_id', $userId)->where('jobtoggle', 'recruiter')->count(),
            'active_jobs' => JobListing::where('user_id', $userId)->where('jobtoggle', 'recruiter')->active()->count(),
            'featured_jobs' => JobListing::where('user_id', $userId)->where('jobtoggle', 'recruiter')->featured()->count(),
            'inactive_jobs' => JobListing::where('user_id', $userId)->where('jobtoggle', 'recruiter')->where('is_active', false)->count(),
        ];

        // Get recent jobs for display
        $recentJobs = JobListing::where('user_id', $userId)
            ->where('jobtoggle', 'recruiter')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('recruiter.dashboard', compact('stats', 'recentJobs'));
    }
}
