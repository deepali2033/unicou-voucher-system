<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceivedApplicationController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Get applications for jobs created by this recruiter
        $query = JobApplication::with(['freelancer', 'jobListing', 'candidate'])
            ->where('recruiter_id', $userId);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('freelancer', function($fq) use ($search) {
                    $fq->where('name', 'like', "%{$search}%")
                       ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('jobListing', function($jq) use ($search) {
                    $jq->where('title', 'like', "%{$search}%");
                })
                ->orWhereHas('candidate', function($cq) use ($search) {
                    $cq->where('first_name', 'like', "%{$search}%")
                       ->orWhere('last_name', 'like', "%{$search}%")
                       ->orWhere('email', 'like', "%{$search}%");
                });
            });
        }

        $applications = $query->latest()->paginate(15);
        $statuses = JobApplication::getStatuses();

        return view('recruiter.applications.index', compact('applications', 'statuses'));
    }

    public function show(JobApplication $application)
    {
        // Ensure the recruiter can only view applications for their jobs
        if ($application->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        $application->load(['freelancer', 'jobListing', 'candidate']);

        return view('recruiter.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        // Ensure the recruiter can only update applications for their jobs
        if ($application->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        $request->validate([
            'status' => 'required|in:pending,under_review,interview_scheduled,selected,rejected'
        ]);

        // Update application status
        $application->update([
            'status' => $request->status
        ]);

        // Also update the candidate status to keep them in sync
        if ($application->candidate) {
            $application->candidate->update([
                'status' => $request->status
            ]);
        }

        return redirect()->back()
                       ->with('success', 'Application status updated successfully!');
    }

    public function destroy(JobApplication $application)
    {
        // Ensure the recruiter can only delete applications for their jobs
        if ($application->recruiter_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        $application->delete();

        return redirect()->route('recruiter.applications.index')
                       ->with('success', 'Application deleted successfully!');
    }
}
