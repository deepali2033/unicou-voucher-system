<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobCategory;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of user-created jobs for Household Jobs section
     */
    public function userCreatedJobs()
    {
        $jobs = JobListing::active()
            ->approved()
            ->byCategory('Household Jobs')
            ->ordered()
            ->paginate(12);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Display a listing of all jobs
     */
    public function index(Request $request)
    {
        $query = JobListing::active()->approved();

        // Search by term (zoekterm)
        if ($request->filled('zoekterm')) {
            $search = $request->get('zoekterm');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('description', 'LIKE', '%'.$search.'%')
                    ->orWhere('short_description', 'LIKE', '%'.$search.'%')
                    ->orWhere('category', 'LIKE', '%'.$search.'%');
            });
        }

        // Filter by location (locatie)
        if ($request->filled('locatie')) {
            $location = $request->get('locatie');
            $query->where('location', 'LIKE', '%'.$location.'%');
        }

        // Filter by distance (afstand) - placeholder for now
        // Distance filtering would require lat/lng coordinates
        if ($request->filled('afstand') && $request->afstand !== '5') {
            // For now, we'll skip distance filtering as it requires geolocation data
            // In a real implementation, you'd calculate distance from user's location
        }

        // Filter by field of work (vakgebied)
        if ($request->filled('vakgebied') && is_array($request->vakgebied)) {
            $vakgebieden = $request->vakgebied;
            $query->whereIn('category', $vakgebieden);
        }

        // Filter by education level (opleidingsniveau)
        if ($request->filled('opleidingsniveau') && is_array($request->opleidingsniveau)) {
            $opleidingen = $request->opleidingsniveau;
            $query->whereIn('education_level', $opleidingen);
        }

        // Filter by hours per week (uren_per_week)
        if ($request->filled('uren_per_week') && is_array($request->uren_per_week)) {
            $urenRanges = $request->uren_per_week;
            $query->where(function ($q) use ($urenRanges) {
                foreach ($urenRanges as $range) {
                    switch ($range) {
                        case '0-8':
                            $q->orWhereBetween('hours_per_week', [0, 8]);
                            break;
                        case '9-16':
                            $q->orWhereBetween('hours_per_week', [9, 16]);
                            break;
                        case '17-24':
                            $q->orWhereBetween('hours_per_week', [17, 24]);
                            break;
                        case '25-32':
                            $q->orWhereBetween('hours_per_week', [25, 32]);
                            break;
                        case '33-36':
                            $q->orWhereBetween('hours_per_week', [33, 36]);
                            break;
                        case '37-40+':
                            $q->orWhere('hours_per_week', '>=', 37);
                            break;
                    }
                }
            });
        }

        // Filter by employment type (soort_dienstverband)
        if ($request->filled('soort_dienstverband') && is_array($request->soort_dienstverband)) {
            $dienstverbanden = $request->soort_dienstverband;
            $query->whereIn('employment_type', $dienstverbanden);
        }

        $jobs = $query->ordered()->paginate(12);
        $alljobs = JobListing::active()->get();
        $categories = JobListing::getCategories();
        $featuredJobs = JobListing::active()->featured()->ordered()->take(3)->get();

        return view('jobs.index-2', compact('alljobs', 'jobs', 'categories', 'featuredJobs'));
    }

    public function joblisted()
    {
        $jobs = JobListing::where('is_active', true)
            ->where('jobtoggle', 'customer')
            ->get();

        return view('alljobs.index', compact('jobs'));
    }

    public function joblistedrecruiter()
    {
        $jobs = JobListing::active()
            ->ordered()
            ->where('jobtoggle', 'recruiter')
            ->get();  // <- Add get() to execute the query and get the results

        return view('alljobs.index', compact('jobs'));
    }

    /**
     * Display jobs filtered by category ID
     */
    public function jobsByCategory(Request $request)
    {
        $categoryId = $request->query('category');

        if (! $categoryId) {
            // If no category provided, show all jobs
            $jobs = JobListing::active()
                ->ordered()
                ->get();

            return view('alljobs.index', compact('jobs'));
        }

        // Find the category by ID
        $category = \App\Models\Category::find($categoryId);

        if (! $category) {
            // If category doesn't exist, show all jobs
            $jobs = JobListing::active()
                ->ordered()
                ->get();

            return view('alljobs.index', compact('jobs'));
        }

        // First, try to find jobs where the category name matches directly
        $jobs = JobListing::active()
            ->where('category', $category->name)
            ->ordered()
            ->get();

        // If no direct match found, try to find jobs using a flexible mapping
        if ($jobs->isEmpty()) {
            // Get all available job categories
            $availableJobCategories = JobListing::select('category')
                ->whereNotNull('category')
                ->groupBy('category')
                ->pluck('category')
                ->toArray();

            // Try to find a category that contains the category name (case insensitive)
            $matchingJobCategories = array_filter($availableJobCategories, function ($jobCategory) use ($category) {
                return stripos($jobCategory, $category->name) !== false ||
                       stripos($category->name, $jobCategory) !== false;
            });

            if (! empty($matchingJobCategories)) {
                $jobs = JobListing::active()
                    ->whereIn('category', $matchingJobCategories)
                    ->ordered()
                    ->get();
            }
        }

        // Pass the category name for potential use in the view
        $categoryName = $category->name;

        return view('alljobs.index', compact('jobs', 'categoryName'));
    }

    /**
     * Display jobs by category
     */
    public function category($slug)
    {// Find the JobCategory by slug
        $jobCategory = \App\Models\JobCategory::where('slug', $slug)->first();

        if (! $jobCategory) {
            abort(404);
        }

        $jobs = JobListing::where('category', $jobCategory->id)
            ->active()
            ->ordered()
            ->paginate(10);

        // dd($jobCategory, $jobs);

        return view('jobs.category', compact('jobs', 'jobCategory'));
    }

    public function show(JobListing $job)
    {
        // Check if job is active
        if (! $job->is_active) {
            abort(404);
        }

        // Get related jobs from the same category
        $relatedJobs = JobListing::active()
            ->approved()
            ->byCategory($job->category)
            ->where('id', '!=', $job->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('jobs.show', compact('job', 'relatedJobs'));
    }
}
