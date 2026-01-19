<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\JobListing;
use App\Models\User;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_services' => Service::count(),
            'active_services' => Service::active()->count(),
            'featured_services' => Service::featured()->count(),
            'inactive_services' => Service::where('is_active', false)->count(),
            'total_jobs' => JobListing::count(),
            'active_jobs' => JobListing::active()->count(),
            'featured_jobs' => JobListing::featured()->count(),
            'inactive_jobs' => JobListing::where('is_active', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
