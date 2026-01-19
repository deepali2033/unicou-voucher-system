@extends('recruiter.layouts.app')

@section('title', 'Add New Candidate')
@section('page-title', 'Add New Candidate')

@section('page-actions')
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('recruiter.candidates.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Candidate Information</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('recruiter.candidates.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Personal Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-user me-2"></i>Personal Information</h6>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                   id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                   id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                   id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-map-marker-alt me-2"></i>Address Information</h6>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="address" class="form-label">Street Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="2">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                   id="city" name="city" value="{{ old('city') }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                   id="state" name="state" value="{{ old('state') }}">
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="zip_code" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control @error('zip_code') is-invalid @enderror" 
                                   id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
                            @error('zip_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Job Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-briefcase me-2"></i>Job Information</h6>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="position_applied" class="form-label">Position Applied For</label>
                            <input type="text" class="form-control @error('position_applied') is-invalid @enderror" 
                                   id="position_applied" name="position_applied" value="{{ old('position_applied') }}">
                            @error('position_applied')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="job_listing_id" class="form-label">Related Job Listing</label>
                            <select class="form-select @error('job_listing_id') is-invalid @enderror" id="job_listing_id" name="job_listing_id">
                                <option value="">Select a job listing</option>
                                @foreach($jobListings as $job)
                                    <option value="{{ $job->id }}" {{ old('job_listing_id') == $job->id ? 'selected' : '' }}>
                                        {{ $job->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('job_listing_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="employment_type_preference" class="form-label">Employment Type Preference</label>
                            <select class="form-select @error('employment_type_preference') is-invalid @enderror" 
                                    id="employment_type_preference" name="employment_type_preference">
                                <option value="">Select preference</option>
                                @foreach(\App\Models\Candidate::getEmploymentTypePreferences() as $key => $label)
                                    <option value="{{ $key }}" {{ old('employment_type_preference') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employment_type_preference')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="available_start_date" class="form-label">Available Start Date</label>
                            <input type="date" class="form-control @error('available_start_date') is-invalid @enderror" 
                                   id="available_start_date" name="available_start_date" value="{{ old('available_start_date') }}">
                            @error('available_start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="under_review" {{ old('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                <option value="interviewed" {{ old('status') == 'interviewed' ? 'selected' : '' }}>Interviewed</option>
                                <option value="accepted" {{ old('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Salary Expectations -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-dollar-sign me-2"></i>Salary Expectations</h6>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="expected_salary_min" class="form-label">Minimum Expected Salary</label>
                            <input type="number" step="0.01" class="form-control @error('expected_salary_min') is-invalid @enderror" 
                                   id="expected_salary_min" name="expected_salary_min" value="{{ old('expected_salary_min') }}">
                            @error('expected_salary_min')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="expected_salary_max" class="form-label">Maximum Expected Salary</label>
                            <input type="number" step="0.01" class="form-control @error('expected_salary_max') is-invalid @enderror" 
                                   id="expected_salary_max" name="expected_salary_max" value="{{ old('expected_salary_max') }}">
                            @error('expected_salary_max')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="expected_salary_type" class="form-label">Salary Type</label>
                            <select class="form-select @error('expected_salary_type') is-invalid @enderror" 
                                    id="expected_salary_type" name="expected_salary_type">
                                @foreach(\App\Models\Candidate::getSalaryTypes() as $key => $label)
                                    <option value="{{ $key }}" {{ old('expected_salary_type', 'year') == $key ? 'selected' : '' }}>
                                        Per {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('expected_salary_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Experience & Education -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-graduation-cap me-2"></i>Experience & Education</h6>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="work_experience" class="form-label">Work Experience</label>
                            <textarea class="form-control @error('work_experience') is-invalid @enderror" 
                                      id="work_experience" name="work_experience" rows="4" 
                                      placeholder="Please describe relevant work experience...">{{ old('work_experience') }}</textarea>
                            @error('work_experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="education" class="form-label">Education</label>
                            <textarea class="form-control @error('education') is-invalid @enderror" 
                                      id="education" name="education" rows="3" 
                                      placeholder="Please describe educational background...">{{ old('education') }}</textarea>
                            @error('education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="certifications" class="form-label">Certifications</label>
                            <textarea class="form-control @error('certifications') is-invalid @enderror" 
                                      id="certifications" name="certifications" rows="2" 
                                      placeholder="List any relevant certifications...">{{ old('certifications') }}</textarea>
                            @error('certifications')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Documents -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-file me-2"></i>Documents</h6>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="resume" class="form-label">Resume/CV</label>
                            <input type="file" class="form-control @error('resume') is-invalid @enderror" 
                                   id="resume" name="resume" accept=".pdf,.doc,.docx">
                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</small>
                            @error('resume')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cover_letter" class="form-label">Cover Letter</label>
                            <input type="file" class="form-control @error('cover_letter') is-invalid @enderror" 
                                   id="cover_letter" name="cover_letter" accept=".pdf,.doc,.docx">
                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</small>
                            @error('cover_letter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-info-circle me-2"></i>Additional Information</h6>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="referral_source" class="form-label">How did they hear about us?</label>
                            <select class="form-select @error('referral_source') is-invalid @enderror" 
                                    id="referral_source" name="referral_source">
                                <option value="">Select source</option>
                                @foreach(\App\Models\Candidate::getReferralSources() as $key => $label)
                                    <option value="{{ $key }}" {{ old('referral_source') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('referral_source')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="additional_notes" class="form-label">Additional Notes</label>
                            <textarea class="form-control @error('additional_notes') is-invalid @enderror" 
                                      id="additional_notes" name="additional_notes" rows="3" 
                                      placeholder="Any additional information...">{{ old('additional_notes') }}</textarea>
                            @error('additional_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Preferences & Consent -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-check-square me-2"></i>Preferences & Consent</h6>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="willing_to_relocate" 
                                       name="willing_to_relocate" value="1" {{ old('willing_to_relocate') ? 'checked' : '' }}>
                                <label class="form-check-label" for="willing_to_relocate">
                                    Willing to relocate if necessary
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="has_transportation" 
                                       name="has_transportation" value="1" {{ old('has_transportation') ? 'checked' : '' }}>
                                <label class="form-check-label" for="has_transportation">
                                    Has reliable transportation
                                </label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="background_check_consent" 
                                       name="background_check_consent" value="1" {{ old('background_check_consent') ? 'checked' : '' }}>
                                <label class="form-check-label" for="background_check_consent">
                                    Consents to background check if required
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save me-1"></i> Create Candidate
                            </button>
                            <a href="{{ route('recruiter.candidates.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection