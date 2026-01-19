<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppliedJobController extends Controller
{
    public function index(Request $request)
    {
        $freelancerId = Auth::id();

        // Get candidates for this freelancer only
        $query = Candidate::with(['jobListing', 'jobApplication'])
            ->where('user_id', $freelancerId);

        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter by position
        if ($request->filled('position')) {
            $query->byPosition($request->position);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('position_applied', 'like', "%{$search}%")
                    ->orWhereHas('jobListing', function ($jq) use ($search) {
                        $jq->where('title', 'like', "%{$search}%");
                    });
            });
        }

        $candidates = $query->recent()->paginate(15);
        $statuses = Candidate::getStatuses();
        $positions = Candidate::select('position_applied')
            ->where('user_id', $freelancerId)
            ->distinct()
            ->whereNotNull('position_applied')
            ->pluck('position_applied');

        return view('freelancer.apply_list.index', compact('candidates', 'statuses', 'positions'));
    }

    public function create(Request $request)
    {
        $selectedJob = null;
        if ($request->has('job')) {
            $selectedJob = JobListing::where('slug', $request->job)->firstOrFail();
        }

        $jobListings = JobListing::active()->get();

        return view('freelancer.applied-jobs.create', compact('jobListings', 'selectedJob'));
    }

    public function store(Request $request)
    {
        $freelancerId = Auth::id();

        // Check if job_listing_id is provided and validate duplicate application
        if ($request->filled('job_listing_id')) {
            $existingApplication = \App\Models\JobApplication::where('freelancer_id', $freelancerId)
                ->where('job_listing_id', $request->job_listing_id)
                ->first();

            if ($existingApplication) {
                return redirect()->back()
                    ->with('error', 'You have already applied for this job.')
                    ->withInput();
            }
        }

        // Validate the incoming request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'position_applied' => 'required|string|max:255',
            'job_listing_id' => 'nullable|exists:job_listings,id',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'work_experience' => 'nullable|string',
            'education' => 'nullable|string',
            'skills' => 'nullable|array',
            'expected_salary_min' => 'nullable|numeric|min:0',
            'expected_salary_max' => 'nullable|numeric|min:0',
            'expected_salary_type' => 'nullable|in:hourly,monthly,yearly',
            'additional_notes' => 'nullable|string',
        ]);

        // Handle file uploads
        if ($request->hasFile('resume')) {
            $validated['resume_path'] = $request->file('resume')->store('candidates/resumes', 'public');
        }

        if ($request->hasFile('cover_letter')) {
            $validated['cover_letter_path'] = $request->file('cover_letter')->store('candidates/cover-letters', 'public');
        }

        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo_path'] = $request->file('profile_photo')->store('candidates/profile_photos', 'public');
        }

        // Set user_id for the authenticated freelancer
        $validated['user_id'] = $freelancerId;
        $validated['status'] = 'pending';
        $validated['applied_at'] = now();

        // Create the candidate
        $candidate = Candidate::create($validated);

        // Create job application record if job_listing_id is provided
        if ($request->filled('job_listing_id')) {
            $jobListing = JobListing::find($request->job_listing_id);

            if ($jobListing) {
                $jobApplication = \App\Models\JobApplication::create([
                    'candidate_id' => $candidate->id,
                    'job_listing_id' => $jobListing->id,
                    'freelancer_id' => $freelancerId,
                    'recruiter_id' => $jobListing->user_id, // The user who created the job
                    'status' => 'pending',
                    'application_notes' => $request->additional_notes,
                ]);

                // Notify the job creator (recruiter/user)
                $jobApplication->notifyAll();
            }
        }

        return redirect()
            ->route('freelancer.applied-jobs.index')
            ->with('success', 'Your application has been submitted successfully!');
    }

    public function show(Candidate $candidate)
    {

        // dd($candidate);
        // Ensure the freelancer can only view their own applications
        if ($candidate->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        $candidate->load('jobListing', 'jobApplication');

        return view('freelancer.apply_list.show', compact('candidate'));
    }

    public function updatePhoto(Request $request, Candidate $candidate)
    {
        // Ensure the freelancer can only update their own applications
        if ($candidate->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($candidate->profile_photo_path) {
                \Storage::disk('public')->delete($candidate->profile_photo_path);
            }

            $path = $request->file('profile_photo')->store('candidates/profile_photos', 'public');
            $candidate->update(['profile_photo_path' => $path]);

            // Copy to public storage for immediate access (Windows workaround)
            $publicPath = public_path('storage/candidates/profile_photos');
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }
            copy(storage_path('app/public/' . $path), public_path('storage/' . $path));
        }

        return redirect()->back()->with('success', 'Profile photo updated successfully!');
    }
}
