<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
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
        $query = Candidate::with('jobListing');

        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter by position
        if ($request->filled('position')) {
            $query->byPosition($request->position);
        }

        // Filter by active status
        if ($request->filled('active')) {
            if ($request->active === '1') {
                $query->active();
            } else {
                $query->where('is_active', false);
            }
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('position_applied', 'like', "%{$search}%");
            });
        }

        $candidates = $query->recent()->paginate(15);

        // Calculate statistics
        $stats = [
            'total' => Candidate::count(),
            'pending' => Candidate::where('status', 'pending')->count(),
            'under_review' => Candidate::where('status', 'under_review')->count(),
            'interview_scheduled' => Candidate::where('status', 'interview_scheduled')->count(),
            'selected' => Candidate::where('status', 'selected')->count(),
            'rejected' => Candidate::where('status', 'rejected')->count(),
        ];

$statuses = Candidate::getStatuses();
        $positions = Candidate::select('position_applied')
                              ->distinct()
                              ->whereNotNull('position_applied')
                              ->pluck('position_applied');

        return view('freelancer.candidates.index', compact('candidates', 'stats', 'statuses', 'positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobListings = JobListing::active()->ordered()->get();
        return view('freelancer.candidates.create', compact('jobListings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'position_applied' => 'nullable|string|max:255',
            'employment_type_preference' => 'nullable|in:full-time,part-time,contract,temporary',
            'expected_salary_min' => 'nullable|numeric|min:0',
            'expected_salary_max' => 'nullable|numeric|min:0|gte:expected_salary_min',
            'expected_salary_type' => 'nullable|in:hourly,monthly,yearly',
            'available_start_date' => 'nullable|date',
            'work_experience' => 'nullable|string',
            'additional_notes' => 'nullable|string',
            'status' => 'required|in:pending,under_review,interview_scheduled,selecduled,selected,rejected',
            'is_active' => 'boolean',
            'job_listing_id' => 'nullable|exists:job_listings,id',
            'referral_source' => 'nullable|string|max:255',
            'willing_to_relocate' => 'boolean',
            'has_transportation' => 'boolean',
            'background_check_consent' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        $data = $validator->validated();

        // Set applied_at timestamp
        $data['applied_at'] = now();

        $candidate = Candidate::create($data);

        return redirect()->route('freelancer.candidates.index')
                        ->with('success', 'Candidate created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        $candidate->load('jobListing');
        return view('freelancer.candidates.show', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        $jobListings = JobListing::active()->ordered()->get();
        return view('freelancer.candidates.edit', compact('candidate', 'jobListings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email,' . $candidate->id,
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
            'available_start_date' => 'nullable|date',
            'work_experience' => 'nullable|string',
            'education' => 'nullable|string',
            'skills' => 'nullable|array',
            'certifications' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'additional_notes' => 'nullable|string',
            'status' => 'required|in:pending,under_review,interview_scheduled,selecduled,selected,rejected',
            'is_active' => 'boolean',
            'job_listing_id' => 'nullable|exists:job_listings,id',
            'referral_source' => 'nullable|string|max:255',
            'willing_to_relocate' => 'boolean',
            'has_transportation' => 'boolean',
            'background_check_consent' => 'boolean'
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

        $candidate->update($data);

        return redirect()->route('freelancer.candidates.index')
                        ->with('success', 'Candidate updated successfully!');
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

        $candidate->delete();

        return redirect()->route('freelancer.candidates.index')
                        ->with('success', 'Candidate deleted successfully!');
    }

    /**
     * Toggle candidate status
     */
    public function toggleStatus(Candidate $candidate)
    {
        $candidate->update(['is_active' => !$candidate->is_active]);

        $status = $candidate->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Candidate {$status} successfully!");
    }

    /**
     * Update candidate status
     */
    public function updateStatus(Request $request, Candidate $candidate)
    {
        $request->validate([
            'status' => 'required|in:pending,under_review,interview_scheduled,selected,rejected'
        ]);

        $candidate->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Candidate status updated successfully!');
    }

    /**
     * Download resume file
     */
    public function downloadResume(Candidate $candidate)
    {
        if (!$candidate->resume_path) {
            abort(404, 'No resume file associated with this candidate');
        }

        if (!Storage::disk('public')->exists($candidate->resume_path)) {
            abort(404, 'Resume file not found in storage: ' . $candidate->resume_path);
        }

        try {
            // Get the original file extension
            $extension = pathinfo($candidate->resume_path, PATHINFO_EXTENSION);
            $filename = str_replace(' ', '_', $candidate->full_name) . '_Resume.' . $extension;

            return Storage::disk('public')->download($candidate->resume_path, $filename);
        } catch (\Exception $e) {
            abort(500, 'Error downloading resume: ' . $e->getMessage());
        }
    }

    /**
     * Download cover letter file
     */
    public function downloadCoverLetter(Candidate $candidate)
    {
        if (!$candidate->cover_letter_path) {
            abort(404, 'No cover letter file associated with this candidate');
        }

        if (!Storage::disk('public')->exists($candidate->cover_letter_path)) {
            abort(404, 'Cover letter file not found in storage: ' . $candidate->cover_letter_path);
        }

        try {
            // Get the original file extension
            $extension = pathinfo($candidate->cover_letter_path, PATHINFO_EXTENSION);
            $filename = str_replace(' ', '_', $candidate->full_name) . '_CoverLetter.' . $extension;

            return Storage::disk('public')->download($candidate->cover_letter_path, $filename);
        } catch (\Exception $e) {
            abort(500, 'Error downloading cover letter: ' . $e->getMessage());
        }
    }
}
