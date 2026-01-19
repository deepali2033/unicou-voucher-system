@extends('user.layouts.app')

@section('title', 'Application Details')
@section('page-title', 'Application Details')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('user.applications.index') }}" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Back to Applications
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Application Information</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <span class="badge {{ $application->status_badge }} ms-2">
                                {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <strong>Applied Date:</strong> {{ $application->created_at->format('M d, Y h:i A') }}
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">Job Details</h5>
                    <div class="mb-3">
                        <strong>Job Title:</strong> {{ $application->jobListing->title }}
                    </div>
                    <div class="mb-3">
                        <strong>Employment Type:</strong> {{ ucfirst(str_replace('-', ' ', $application->jobListing->employment_type)) }}
                    </div>

                    <hr>

                    @if($application->candidate)
                        <h5 class="mb-3">Candidate Information</h5>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Name:</strong> {{ $application->candidate->full_name }}
                            </div>
                            <div class="col-md-6">
                                <strong>Email:</strong> {{ $application->candidate->email }}
                            </div>
                        </div>
                        @if($application->candidate->phone)
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Phone:</strong> {{ $application->candidate->phone }}
                                </div>
                            </div>
                        @endif

                        @if($application->candidate->position_applied)
                            <div class="mb-2">
                                <strong>Position Applied:</strong> {{ $application->candidate->position_applied }}
                            </div>
                        @endif

                        @if($application->candidate->work_experience)
                            <div class="mb-3">
                                <strong>Work Experience:</strong>
                                <p class="mt-2">{{ $application->candidate->work_experience }}</p>
                            </div>
                        @endif

                        @if($application->candidate->education)
                            <div class="mb-3">
                                <strong>Education:</strong>
                                <p class="mt-2">{{ $application->candidate->education }}</p>
                            </div>
                        @endif

                        @if($application->candidate->resume_path)
                            <div class="mb-2">
                                <a href="{{ route('candidates.download-resume', $application->candidate) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-download"></i> Download Resume
                                </a>
                            </div>
                        @endif

                        @if($application->candidate->cover_letter_path)
                            <div class="mb-2">
                                <a href="{{ route('candidates.download-cover-letter', $application->candidate) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-download"></i> Download Cover Letter
                                </a>
                            </div>
                        @endif
                    @endif

                    @if($application->application_notes)
                        <hr>
                        <h5 class="mb-3">Additional Notes</h5>
                        <p>{{ $application->application_notes }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.applications.update-status', $application) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="status" class="form-label">Update Application Status</label>
                            <select name="status" id="status" class="form-select" required>
                                @foreach(\App\Models\JobApplication::getStatuses() as $key => $label)
                                    <option value="{{ $key }}" {{ $application->status == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-save"></i> Update Status
                        </button>
                    </form>

                    <hr>

                    <form method="POST" action="{{ route('user.applications.destroy', $application) }}"
                          onsubmit="return confirm('Are you sure you want to delete this application?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash"></i> Delete Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
