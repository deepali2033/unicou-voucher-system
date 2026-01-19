<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobListing;

class JobController extends Controller
{
    public function index()
    {
        // Fetch jobs with employment type 'Full Time' and 'Part Time'
        $jobs = JobListing::active()
            ->approved()
            ->whereIn('employment_type', ['full-time', 'part-time'])
            ->ordered()
            ->paginate(12);

        // Return the view with the jobs
        return view('freelancer.jobs', compact('jobs'));
    }
}
