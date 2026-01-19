<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\JobListing;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        $stats = [
            'total_services' => Service::where('user_id', $userId)->count(),
            'active_services' => Service::where('user_id', $userId)->active()->count(),
            'featured_services' => Service::where('user_id', $userId)->featured()->count(),
            'inactive_services' => Service::where('user_id', $userId)->where('is_active', false)->count(),
            'total_jobs' => JobListing::where('user_id', $userId)->count(),
            'active_jobs' => JobListing::where('user_id', $userId)->active()->count(),
            'featured_jobs' => JobListing::where('user_id', $userId)->featured()->count(),
            'inactive_jobs' => JobListing::where('user_id', $userId)->where('is_active', false)->count(),
        ];

        return view('user.dashboard', compact('stats'));
    }
}
