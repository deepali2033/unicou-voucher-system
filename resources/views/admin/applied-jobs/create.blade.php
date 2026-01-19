@extends('admin.layouts.app')

@section('title', 'Apply for Job')
@section('page-title', 'Apply for Job')

@section('page-actions')
    <a href="{{ route('admin.applied-jobs.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Applications
    </a>
@endsection

@section('content')
    @if($selectedJob)
    <div class="alert alert-info mb-4">
        <h5 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Applying for Position</h5>
        <p class="mb-2"><strong>{{ $selectedJob->title }}</strong></p>
        <p class="mb-0">{{ $selectedJob->short_description }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <strong>Error:</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <strong>Success:</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>Please fix the following errors:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @php
        $alreadyApplied = false;
        if($selectedJob && Auth::check()) {
            $alreadyApplied = \App\Models\Candidate::where('user_id', Auth::id())
                ->where('job_listing_id', $selectedJob->id)
                ->exists();
        }
    @endphp

    @if($alreadyApplied)
    <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <strong>Already Applied!</strong> You have already applied for this job position.
        <a href="{{ route('admin.applied-jobs.index') }}" class="alert-link">View your applications</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.applied-jobs.store') }}" enctype="multipart/form-data" @if($alreadyApplied) onsubmit="event.preventDefault(); alert('You have already applied for this job!'); return false;" @endif>
        @csrf

        @if($selectedJob)
        <input type="hidden" name="job_listing_id" value="{{ $selectedJob->id }}">
        <input type="hidden" name="position_applied" value="{{ $selectedJob->title }}">
        @endif

        <div class="row">
            <!-- PERSONAL INFORMATION -->
            <div class="col-12">
                <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title">Personal Information</h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    id="first_name" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" required>
                                @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    id="last_name" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" required>
                                @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                <label for="profile_photo" class="form-label">Profile Photo <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" id="profile_photo" name="profile_photo" accept="image/*" required>
                                <small class="form-text text-muted">Accepted formats: JPG, PNG, WEBP (Max: 3MB)</small>
                                @error('profile_photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- ADDRESS INFORMATION -->
            <div class="col-12 mt-4">
                <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title">Address Information</h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">Street Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" rows="2">{{ old('address') }}</textarea>
                                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    id="city" name="city" value="{{ old('city') }}">
                                @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror"
                                    id="state" name="state" value="{{ old('state') }}">
                                @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zip_code" class="form-label">ZIP Code</label>
                                <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                    id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
                                @error('zip_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- JOB DETAILS -->
            <div class="col-12 mt-4">
                <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title">Job Details</h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="row">
                            @if(!$selectedJob)
                            <div class="col-md-6 mb-3">
                                <label for="position_applied" class="form-label">Position You're Applying For <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('position_applied') is-invalid @enderror"
                                    id="position_applied" name="position_applied" value="{{ old('position_applied') }}" required>
                                @error('position_applied') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="job_listing_id" class="form-label">Related Job Listing (Optional)</label>
                                <select class="form-select @error('job_listing_id') is-invalid @enderror" id="job_listing_id" name="job_listing_id">
                                    <option value="">Select a job listing</option>
                                    @foreach($jobListings as $job)
                                    <option value="{{ $job->id }}" {{ old('job_listing_id') == $job->id ? 'selected' : '' }}>{{ $job->title }}</option>
                                    @endforeach
                                </select>
                                @error('job_listing_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            @else
                            <div class="col-12 mb-3">
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle me-2"></i>
                                    You are applying for: <strong>{{ $selectedJob->title }}</strong>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- SALARY EXPECTATIONS -->
            <div class="col-12 mt-4">
                <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title">Salary Expectations</h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="expected_salary_min" class="form-label">Minimum Expected Salary</label>
                                <input type="number" step="0.01" class="form-control @error('expected_salary_min') is-invalid @enderror"
                                    id="expected_salary_min" name="expected_salary_min" value="{{ old('expected_salary_min') }}">
                                @error('expected_salary_min') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expected_salary_max" class="form-label">Maximum Expected Salary</label>
                                <input type="number" step="0.01" class="form-control @error('expected_salary_max') is-invalid @enderror"
                                    id="expected_salary_max" name="expected_salary_max" value="{{ old('expected_salary_max') }}">
                                @error('expected_salary_max') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expected_salary_type" class="form-label">Salary Type</label>
                                <select class="form-select @error('expected_salary_type') is-invalid @enderror"
                                    id="expected_salary_type" name="expected_salary_type">
                                    <option value="hourly" {{ old('expected_salary_type', 'hourly') == 'hourly' ? 'selected' : '' }}>Per Hour</option>
                                    <option value="monthly" {{ old('expected_salary_type') == 'monthly' ? 'selected' : '' }}>Per Month</option>
                                    <option value="yearly" {{ old('expected_salary_type') == 'yearly' ? 'selected' : '' }}>Per Year</option>
                                </select>
                                @error('expected_salary_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- EXPERIENCE & EDUCATION -->
            <div class="col-12 mt-4">
                <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title">Experience & Education</h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="work_experience" class="form-label">Work Experience</label>
                                <textarea class="form-control @error('work_experience') is-invalid @enderror"
                                    id="work_experience" name="work_experience" rows="4"
                                    placeholder="Please describe your relevant work experience...">{{ old('work_experience') }}</textarea>
                                @error('work_experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="education" class="form-label">Education</label>
                                <textarea class="form-control @error('education') is-invalid @enderror"
                                    id="education" name="education" rows="3"
                                    placeholder="Please describe your educational background...">{{ old('education') }}</textarea>
                                @error('education') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DOCUMENTS -->
            <div class="col-12 mt-4">
                <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title">Documents</h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="resume" class="form-label">Resume/CV</label>
                                <input type="file" class="form-control @error('resume') is-invalid @enderror"
                                    id="resume" name="resume" accept=".pdf,.doc,.docx">
                                <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</small>
                                @error('resume') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cover_letter" class="form-label">Cover Letter</label>
                                <input type="file" class="form-control @error('cover_letter') is-invalid @enderror"
                                    id="cover_letter" name="cover_letter" accept=".pdf,.doc,.docx">
                                <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</small>
                                @error('cover_letter') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ADDITIONAL INFORMATION -->
            <div class="col-12 mt-4">
                <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title">Additional Information</h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="additional_notes" class="form-label">Additional Notes</label>
                                <textarea class="form-control @error('additional_notes') is-invalid @enderror"
                                    id="additional_notes" name="additional_notes" rows="3"
                                    placeholder="Any additional information you would like to provide...">{{ old('additional_notes') }}</textarea>
                                @error('additional_notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <div class="col-12 mt-4 text-center">
                @if($alreadyApplied)
                    <button type="button" class="btn btn-secondary btn-lg" disabled>
                        <i class="fas fa-check-circle me-2"></i>Already Applied
                    </button>
                    <div class="mt-2">
                        <a href="{{ route('admin.applied-jobs.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>View My Applications
                        </a>
                    </div>
                @else
                    <button type="submit" class="btn btn-t-g btn-lg">
                        <i class="fas fa-paper-plane me-2"></i>Submit Application
                    </button>
                @endif
            </div>
        </div>
    </form>
@endsection
