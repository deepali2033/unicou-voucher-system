<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\JobListing;
use App\Models\Candidate;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        $stats = [
            'active_jobs' => JobListing::active()->count(),
            'total_applications' => Candidate::count(),
            'pending_applications' => Candidate::where('status', 'pending')->count(),
            'accepted_applications' => Candidate::where('status', 'accepted')->count(),
            'active_services' => Service::where('user_id', $userId)->active()->count(),
            'featured_services' => Service::where('user_id', $userId)->featured()->count(),
            'inactive_services' => Service::where('user_id', $userId)->where('is_active', false)->count(),
            'applied_jobs_count' => Candidate::where('user_id', $userId)->count(),
        ];

        // Get latest 10 applied jobs for the authenticated freelancer
        $latestAppliedJobs = Candidate::with(['jobListing'])
            ->where('user_id', $userId)
            ->orderBy('applied_at', 'desc')
            ->limit(10)
            ->get();

        return view('freelancer.dashboard', compact('stats', 'latestAppliedJobs'));
    }
}
