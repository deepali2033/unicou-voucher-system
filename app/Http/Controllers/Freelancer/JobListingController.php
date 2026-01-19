<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only current freelancer's jobs
        $jobs = JobListing::where('user_id', auth()->id())
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('freelancer.jobs.index', compact('jobs'));
    }

    /**
     * Display all job listings from the database for freelancers to browse
     */
    public function browse()
    {
        // Get all active and approved job listings
        $jobs = JobListing::active()
            ->approved()
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('freelancer.jobs.browse', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('freelancer.jobs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'required|in:full-time,part-time,contract,temporary',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'salary_type' => 'required|in:hourly,monthly,yearly',
            'requirements' => 'nullable|array',
            'requirements.*' => 'string|max:255',
            'benefits' => 'nullable|array',
            'benefits.*' => 'string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'application_deadline' => 'nullable|date|after:today',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500'
        ]);

        // Filter out empty requirements and benefits
        if (isset($validated['requirements'])) {
            $validated['requirements'] = array_filter($validated['requirements'], function($item) {
                return !empty(trim($item));
            });
        }

        if (isset($validated['benefits'])) {
            $validated['benefits'] = array_filter($validated['benefits'], function($item) {
                return !empty(trim($item));
            });
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']);

        // Attach ownership and auto-approve jobs
        $validated['user_id'] = $request->user()->id;
        $validated['is_approved'] = true;

        JobListing::create($validated);

        return redirect()->route('freelancer.jobs.index')
            ->with('success', 'Job listing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $job)
    {
        return view('freelancer.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }
        $categories = Category::orderBy('name')->get();
        return view('freelancer.jobs.edit', compact('job', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobListing $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'required|in:full-time,part-time,contract,temporary',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'salary_type' => 'required|in:hourly,monthly,yearly',
            'requirements' => 'nullable|array',
            'requirements.*' => 'string|max:255',
            'benefits' => 'nullable|array',
            'benefits.*' => 'string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'application_deadline' => 'nullable|date|after:today',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500'
        ]);

        // Filter out empty requirements and benefits
        if (isset($validated['requirements'])) {
            $validated['requirements'] = array_filter($validated['requirements'], function($item) {
                return !empty(trim($item));
            });
        }

        if (isset($validated['benefits'])) {
            $validated['benefits'] = array_filter($validated['benefits'], function($item) {
                return !empty(trim($item));
            });
        }

        // Update slug if title changed
        if ($job->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $job->update($validated);

        return redirect()->route('freelancer.jobs.index')
            ->with('success', 'Job listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $job)
    {
        $job->delete();

        return redirect()->route('freelancer.jobs.index')
            ->with('success', 'Job listing deleted successfully.');
    }

    /**
     * Toggle job status
     */
    public function toggleStatus(JobListing $job)
    {
        $job->update(['is_active' => !$job->is_active]);

        $status = $job->is_active ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Job listing {$status} successfully.");
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(JobListing $job)
    {
        $job->update(['is_featured' => !$job->is_featured]);

        $status = $job->is_featured ? 'marked as featured' : 'unmarked as featured';
        return redirect()->back()
            ->with('success', "Job listing {$status} successfully.");
    }
}
