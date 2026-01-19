<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\JobCategory;
use App\Models\JobListing;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only current user's jobs
        $jobs = JobListing::where('user_id', auth()->id())
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('user.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $categories = JobCategory::all();
        $categories = JobCategory::orderBy('name')->get();
        $jobsQuery = JobListing::approved()->active();

        // Apply search filters
        if ($request->filled('title')) {
            $jobsQuery->where('title', 'like', '%'.$request->title.'%');
        }

        if ($request->filled('location')) {
            $jobsQuery->where('location', 'like', '%'.$request->location.'%');
        }

        if ($request->filled('employment_type')) {
            $jobsQuery->where('employment_type', $request->employment_type);
        }

        $jobs = $jobsQuery->orderBy('created_at', 'desc')->paginate(10);

        return view('user.jobs.create', compact('categories', 'jobs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|exists:job_categories,id',
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
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Filter out empty requirements and benefits
        if (isset($validated['requirements'])) {
            $validated['requirements'] = array_filter($validated['requirements'], function ($item) {
                return ! empty(trim($item));
            });
        }

        if (isset($validated['benefits'])) {
            $validated['benefits'] = array_filter($validated['benefits'], function ($item) {
                return ! empty(trim($item));
            });
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['title']);
        $validated['jobtoggle'] = 'customer';

        // Attach ownership
        $validated['user_id'] = $request->user()->id;

        // Mark job as pending approval
        $validated['is_approved'] = false;

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $job = JobListing::create($validated);
        \Log::info('Job created:', $job->toArray());

        // Create notification
        NotificationService::jobCreated($job);

        return redirect()->route('user.jobs.index')
            ->with('success', 'Job listing created successfully and is pending admin approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobListing $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }
        $categories = JobCategory::orderBy('name')->get();
 
        return view('user.jobs.edit', compact('job', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobListing $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|exists:job_categories,id',
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
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Filter out empty requirements and benefits
        if (isset($validated['requirements'])) {
            $validated['requirements'] = array_filter($validated['requirements'], function ($item) {
                return ! empty(trim($item));
            });
        }

        if (isset($validated['benefits'])) {
            $validated['benefits'] = array_filter($validated['benefits'], function ($item) {
                return ! empty(trim($item));
            });
        }

        // Update slug if title changed
        if ($job->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($job->image) {
                \Storage::disk('public')->delete($job->image);
            }
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $job->update($validated);

        // Create notification
        NotificationService::jobUpdated($job);

        return redirect()->route('user.jobs.index')
            ->with('success', 'Job listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobListing $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete image if exists
        if ($job->image) {
            \Storage::disk('public')->delete($job->image);
        }

        $job->delete();

        return redirect()->route('user.jobs.index')
            ->with('success', 'Job listing deleted successfully.');
    }

    /**
     * Toggle job status
     */
    public function toggleStatus(JobListing $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }
        $job->update(['is_active' => ! $job->is_active]);

        // Create notification
        if ($job->is_active) {
            NotificationService::jobActivated($job);
        } else {
            NotificationService::jobDeactivated($job);
        }

        $status = $job->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Job listing {$status} successfully.");
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(JobListing $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }
        $job->update(['is_featured' => ! $job->is_featured]);

        $status = $job->is_featured ? 'marked as featured' : 'unmarked as featured';

        // Create notification
        if ($job->is_featured) {
            NotificationService::jobFeatured($job);
        } else {
            NotificationService::jobUnfeatured($job);
        }

        return redirect()->back()
            ->with('success', "Job listing {$status} successfully.");
    }

    /**
     * Handle category selection via AJAX
     */
    public function selectCategory(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
        ]);

        $category = $validated['category'];

        // Verify category exists (optional - you can remove this if not needed)
        $categoryExists = JobCategory::where('name', $category)->exists();

        if (! $categoryExists) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ], 404);
        }

        // Log category selection or perform any other backend operations
        \Log::info("User {$request->user()->id} selected category: {$category}");

        // Return success response
        return response()->json([
            'success' => true,
            'message' => "Category '{$category}' selected successfully.",
            'category' => $category,
        ], 200);
    }
}
