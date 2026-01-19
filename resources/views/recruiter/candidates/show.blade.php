@extends('recruiter.layouts.app')

@section('title', 'Candidate Details - ' . $candidate->full_name)
@section('page-title', 'Candidate Details')

@section('page-actions')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('recruiter.candidates.edit', $candidate) }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            @if($candidate->resume_path)
                <a href="{{ route('recruiter.candidates.download-resume', $candidate) }}" class="btn btn-sm btn-outline-info">
                    <i class="fas fa-download"></i> Resume
                </a>
            @endif
            @if($candidate->cover_letter_path)
                <a href="{{ route('recruiter.candidates.download-cover-letter', $candidate) }}" class="btn btn-sm btn-outline-info">
                    <i class="fas fa-download"></i> Cover Letter
                </a>
            @endif
            <a href="{{ route('recruiter.candidates.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <!-- Personal Information -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Personal Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Full Name:</strong><br>
                        <span class="text-dark">{{ $candidate->full_name }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Email:</strong><br>
                        <a href="mailto:{{ $candidate->email }}">{{ $candidate->email }}</a>
                    </div>
                    @if($candidate->phone)
                        <div class="col-md-6 mb-3">
                            <strong>Phone:</strong><br>
                            <a href="tel:{{ $candidate->phone }}">{{ $candidate->phone }}</a>
                        </div>
                    @endif
                    @if($candidate->date_of_birth)
                        <div class="col-md-6 mb-3">
                            <strong>Date of Birth:</strong><br>
                            <span class="text-dark">{{ $candidate->date_of_birth->format('F d, Y') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Address Information -->
        @if($candidate->address || $candidate->city || $candidate->state || $candidate->zip_code)
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Address</h5>
                </div>
                <div class="card-body">
                    @if($candidate->address)
                        <div class="mb-2">{{ $candidate->address }}</div>
                    @endif
                    @if($candidate->city || $candidate->state || $candidate->zip_code)
                        <div>
                            {{ $candidate->city }}{{ $candidate->city && ($candidate->state || $candidate->zip_code) ? ', ' : '' }}
                            {{ $candidate->state }} {{ $candidate->zip_code }}
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Job Information -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Job Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Position Applied:</strong><br>
                        <span class="text-dark">{{ $candidate->position_applied ?: 'Not specified' }}</span>
                    </div>
                    @if($candidate->jobListing)
                        <div class="col-md-6 mb-3">
                            <strong>Related Job Listing:</strong><br>
                            <a href="{{ route('recruiter.jobs.show', $candidate->jobListing) }}" class="text-primary">
                                {{ $candidate->jobListing->title }}
                            </a>
                        </div>
                    @endif
                    @if($candidate->employment_type_preference)
                        <div class="col-md-6 mb-3">
                            <strong>Employment Type Preference:</strong><br>
                            <span class="text-dark">{{ \App\Models\Candidate::getEmploymentTypePreferences()[$candidate->employment_type_preference] }}</span>
                        </div>
                    @endif
                    @if($candidate->available_start_date)
                        <div class="col-md-6 mb-3">
                            <strong>Available Start Date:</strong><br>
                            <span class="text-dark">{{ $candidate->available_start_date->format('F d, Y') }}</span>
                        </div>
                    @endif
                    @if($candidate->expected_salary_min || $candidate->expected_salary_max)
                        <div class="col-12 mb-3">
                            <strong>Expected Salary:</strong><br>
                            <span class="text-dark">{{ $candidate->expected_salary_range }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Experience & Education -->
        @if($candidate->work_experience)
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Work Experience</h5>
                </div>
                <div class="card-body">
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($candidate->work_experience)) !!}
                    </div>
                </div>
            </div>
        @endif

        @if($candidate->education)
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Education</h5>
                </div>
                <div class="card-body">
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($candidate->education)) !!}
                    </div>
                </div>
            </div>
        @endif

        @if($candidate->certifications)
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fas fa-certificate me-2"></i>Certifications</h5>
                </div>
                <div class="card-body">
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($candidate->certifications)) !!}
                    </div>
                </div>
            </div>
        @endif

        @if($candidate->additional_notes)
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-dark"><i class="fas fa-sticky-note me-2"></i>Additional Notes</h5>
                </div>
                <div class="card-body">
                    <div class="bg-light p-3 rounded">
                        {!! nl2br(e($candidate->additional_notes)) !!}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Status Management -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0">Application Status</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('recruiter.candidates.update-status', $candidate) }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="status" class="form-label">Current Status:</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending" {{ $candidate->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="under_review" {{ $candidate->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                            <option value="interviewed" {{ $candidate->status == 'interviewed' ? 'selected' : '' }}>Interviewed</option>
                            <option value="accepted" {{ $candidate->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ $candidate->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-save me-1"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Application Info -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0">Application Info</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Applied Date:</strong><br>
                    <span class="text-muted">{{ $candidate->applied_at->format('M d, Y') }}</span><br>
                    <small class="text-muted">{{ $candidate->applied_at->diffForHumans() }}</small>
                </div>
                @if($candidate->referral_source)
                    <div class="mb-3">
                        <strong>How they heard about us:</strong><br>
                        <span class="text-muted">{{ \App\Models\Candidate::getReferralSources()[$candidate->referral_source] ?? $candidate->referral_source }}</span>
                    </div>
                @endif
                <div class="mb-3">
                    <strong>Application ID:</strong><br>
                    <code>{{ $candidate->id }}</code>
                </div>
            </div>
        </div>

        <!-- Documents -->
        @if($candidate->resume_path || $candidate->cover_letter_path)
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">Documents</h6>
                </div>
                <div class="card-body">
                    @if($candidate->resume_path)
                        <div class="mb-2">
                            <a href="{{ route('recruiter.candidates.download-resume', $candidate) }}" 
                               class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-download me-1"></i> Download Resume
                            </a>
                        </div>
                    @endif
                    @if($candidate->cover_letter_path)
                        <div class="mb-2">
                            <a href="{{ route('recruiter.candidates.download-cover-letter', $candidate) }}" 
                               class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-download me-1"></i> Download Cover Letter
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Preferences -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h6 class="mb-0">Preferences</h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <i class="fas fa-{{ $candidate->willing_to_relocate ? 'check text-success' : 'times text-danger' }} me-2"></i>
                    Willing to relocate
                </div>
                <div class="mb-2">
                    <i class="fas fa-{{ $candidate->has_transportation ? 'check text-success' : 'times text-danger' }} me-2"></i>
                    Has reliable transportation
                </div>
                <div class="mb-2">
                    <i class="fas fa-{{ $candidate->background_check_consent ? 'check text-success' : 'times text-danger' }} me-2"></i>
                    Background check consent
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h6 class="mb-0">Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $candidate->email }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-envelope me-1"></i> Send Email
                    </a>
                    @if($candidate->phone)
                        <a href="tel:{{ $candidate->phone }}" class="btn btn-success btn-sm">
                            <i class="fas fa-phone me-1"></i> Call Candidate
                        </a>
                    @endif
                    <a href="{{ route('recruiter.candidates.edit', $candidate) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit me-1"></i> Edit Application
                    </a>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete()">
                        <i class="fas fa-trash me-1"></i> Delete Application
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this candidate application? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ route('recruiter.candidates.destroy', $candidate) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete() {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush