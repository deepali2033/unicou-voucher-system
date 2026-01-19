<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Candidate::with('jobListing')->active();

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
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('position_applied', 'like', "%{$search}%");
            });
        }

        $candidates = $query->recent()->paginate(15);
        $statuses = Candidate::getStatuses();
        $positions = Candidate::select('position_applied')
            ->distinct()
            ->whereNotNull('position_applied')
            ->pluck('position_applied');

        return view('candidates.index', compact('candidates', 'statuses', 'positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Ensure only freelancers can access this form
        if (! auth()->check() || auth()->user()->account_type !== 'freelancer') {
            abort(403, 'Only freelancers can apply for jobs.');
        }

        $jobListings = JobListing::active()->ordered()->get();
        $selectedJob = null;

        if ($request->filled('job')) {
            $selectedJob = JobListing::where('slug', $request->job)->first();
        }

        return view('freelancer.applied-jobs.create', compact('jobListings', 'selectedJob'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $user = auth()->user();

        // Check if profile is verified
        if ($user->profile_verification_status !== 'verified') {
            return redirect()->back()
                ->with('error', 'Please complete all your profile details first. Once the admin verifies your profile, you will be able to apply for jobs.');
        }
        $validator = Validator::make($request->all(), [
            'position_applied' => 'nullable|string|max:255',
            'employment_type_preference' => 'nullable|in:full-time,part-time,contract,temporary',
            'expected_salary_min' => 'nullable|numeric|min:0',
            'expected_salary_max' => 'nullable|numeric|min:0|gte:expected_salary_min',
            'expected_salary_type' => 'nullable|in:hourly,monthly,yearly',
            'available_start_date' => 'nullable|date',
            'work_experience' => 'nullable|string',
            'additional_notes' => 'nullable|string',
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            // 'status' => 'required|in:pending,under_review,interview_scheduled,selecduled,selected,rejected',
            'is_active' => 'boolean',
            'job_listing_id' => 'nullable|exists:job_listings,id',
            'referral_source' => 'nullable|string|max:255',
            'willing_to_relocate' => 'boolean',
            'has_transportation' => 'boolean',
            'background_check_consent' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo_path'] = $request->file('profile_photo')->store('candidates/profile_photos', 'public');
        }

        // Set applied_at timestamp and user info
        $data['user_id'] = auth()->id();
        $data['first_name'] = auth()->user()->first_name;
        $data['last_name'] = auth()->user()->last_name;
        $data['email'] = auth()->user()->email;
        $data['phone'] = auth()->user()->phone;
        $data['applied_at'] = now();

        $candidate = Candidate::create($data);

        return redirect()->route('freelancer.applied-jobs.index')
            ->with('success', 'Candidate created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        $candidate->load('jobListing');

        return view('candidates.show', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        $jobListings = JobListing::active()->ordered()->get();

        return view('candidates.edit', compact('candidate', 'jobListings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email,'.$candidate->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other,prefer_not_to_say',
            'position_applied' => 'nullable|string|max:255',
            'employment_type_preference' => 'nullable|in:full-time,part-time,contract,temporary',
            'expected_salary_min' => 'nullable|numeric|min:0',
            'expected_salary_max' => 'nullable|numeric|min:0|gte:expected_salary_min',
            'expected_salary_type' => 'nullable|in:hourly,monthly,yearly',
            'available_start_date' => 'nullable|date|after_or_equal:today',
            'work_experience' => 'nullable|string',
            'education' => 'nullable|string',
            'skills' => 'nullable|array',
            'certifications' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'cover_letter' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'additional_notes' => 'nullable|string',
            'job_listing_id' => 'nullable|exists:job_listings,id',
            'referral_source' => 'nullable|string|max:255',
            'willing_to_relocate' => 'boolean',
            'has_transportation' => 'boolean',
            'background_check_consent' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        // Handle file uploads
        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            if ($candidate->resume_path) {
                Storage::disk('public')->delete($candidate->resume_path);
            }
            $data['resume_path'] = $request->file('resume')->store('candidates/resumes', 'public');
        }

        if ($request->hasFile('cover_letter')) {
            // Delete old cover letter if exists
            if ($candidate->cover_letter_path) {
                Storage::disk('public')->delete($candidate->cover_letter_path);
            }
            $data['cover_letter_path'] = $request->file('cover_letter')->store('candidates/cover_letters', 'public');
        }

        if ($request->hasFile('profile_photo')) {
            if ($candidate->profile_photo_path) {
                Storage::disk('public')->delete($candidate->profile_photo_path);
            }
            $data['profile_photo_path'] = $request->file('profile_photo')->store('candidates/profile_photos', 'public');
        }

        $candidate->update($data);

        return redirect()->route('candidates.show', $candidate)
            ->with('success', 'Candidate information updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        // Delete associated files
        if ($candidate->resume_path) {
            Storage::disk('public')->delete($candidate->resume_path);
        }
        if ($candidate->cover_letter_path) {
            Storage::disk('public')->delete($candidate->cover_letter_path);
        }
        if ($candidate->profile_photo_path) {
            Storage::disk('public')->delete($candidate->profile_photo_path);
        }

        $candidate->delete();

        return redirect()->route('candidates.index')
            ->with('success', 'Candidate deleted successfully!');
    }

    /**
     * Download resume file
     */
    public function downloadResume(Candidate $candidate)
    {
        if (! $candidate->resume_path) {
            abort(404, 'No resume file associated with this candidate');
        }

        if (! Storage::disk('public')->exists($candidate->resume_path)) {
            abort(404, 'Resume file not found in storage: '.$candidate->resume_path);
        }

        try {
            // Get the original file extension
            $extension = pathinfo($candidate->resume_path, PATHINFO_EXTENSION);
            $filename = str_replace(' ', '_', $candidate->full_name).'_Resume.'.$extension;

            return Storage::disk('public')->download($candidate->resume_path, $filename);
        } catch (\Exception $e) {
            abort(500, 'Error downloading resume: '.$e->getMessage());
        }
    }

    /**
     * Download cover letter file
     */
    public function downloadCoverLetter(Candidate $candidate)
    {
        if (! $candidate->cover_letter_path) {
            abort(404, 'No cover letter file associated with this candidate');
        }

        if (! Storage::disk('public')->exists($candidate->cover_letter_path)) {
            abort(404, 'Cover letter file not found in storage: '.$candidate->cover_letter_path);
        }

        try {
            // Get the original file extension
            $extension = pathinfo($candidate->cover_letter_path, PATHINFO_EXTENSION);
            $filename = str_replace(' ', '_', $candidate->full_name).'_CoverLetter.'.$extension;

            return Storage::disk('public')->download($candidate->cover_letter_path, $filename);
        } catch (\Exception $e) {
            abort(500, 'Error downloading cover letter: '.$e->getMessage());
        }
    }
}
