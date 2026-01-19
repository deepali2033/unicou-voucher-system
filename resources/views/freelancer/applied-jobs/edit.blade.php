@extends('layouts.app')

@section('title', 'Edit Application - ' . $candidate->full_name . ' - KOA Service')
@section('meta_description', 'Edit your job application at KOA Service.')

@section('content')
<article id="post-edit-application" class="full post-edit-application page type-page status-publish has-post-thumbnail hentry">
    <div data-elementor-type="single-page" data-elementor-id="edit-application" class="elementor elementor-edit-application elementor-location-single post-edit-application page type-page status-publish has-post-thumbnail hentry" data-elementor-post-type="elementor_library">
        <div class="elementor-element elementor-element-ce49e7c e-con-full e-flex e-con e-parent" data-id="ce49e7c" data-element_type="container">
            <div class="elementor-element elementor-element-c34158d e-flex e-con-boxed e-con e-child" data-id="c34158d" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                <div data-rocket-location-hash="0bb8abef3c1cf4f2f6dc378583b295e5" class="e-con-inner">
                    <div class="elementor-element elementor-element-138b985 elementor-position-right elementor-widget__width-auto elementor-mobile-position-right elementor-vertical-align-top animated-fast elementor-view-default elementor-vertical-align-top elementor-invisible elementor-widget elementor-widget-icon-box" data-id="138b985" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:50}" data-widget_type="icon-box.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-icon-box-wrapper">
                                <div class="elementor-icon-box-icon">
                                    <span class="elementor-icon">
                                        <i aria-hidden="true" class="vamtamtheme- vamtam-theme-title-dec"></i>
                                    </span>
                                </div>
                                <div class="elementor-icon-box-content">
                                    <h6 class="elementor-icon-box-title">
                                        <span>Edit Application</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-6ac1097 animated-fast elementor-invisible elementor-widget elementor-widget-theme-post-excerpt" data-id="6ac1097" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:100}" data-widget_type="theme-post-excerpt.default">
                        <div class="elementor-widget-container">
                            Update Your Application Information
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="elementor-element elementor-element-b6b8c0c e-con-full e-flex e-con e-parent" data-id="b6b8c0c" data-element_type="container">
            <div class="elementor-element elementor-element-1cde2c4 elementor-widget elementor-widget-theme-post-content" data-id="1cde2c4" data-element_type="widget" data-widget_type="theme-post-content.default">
                <div class="elementor-widget-container">
                    <div data-elementor-type="wp-page" data-elementor-id="edit-application" class="elementor elementor-edit-application" data-elementor-post-type="page">
                        <div class="elementor-element elementor-element-a1134ac e-flex e-con-boxed e-con e-parent" data-id="a1134ac" data-element_type="container">
                            <div class="e-con-inner">
                                <div class="elementor-element elementor-element-form animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="form" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:100}" data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container">
                                        <!-- Current Status Alert -->
                                        <div class="alert alert-info mb-4">
                                            <h5 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Current Application Status</h5>
                                            <p class="mb-2">
                                                <strong>Status:</strong>
                                                <span class="badge {{ $candidate->status_badge }} fw-bold">{{ ucfirst($candidate->status) }}</span>
                                            </p>
                                            <p class="mb-0">
                                                <strong>Applied:</strong> {{ $candidate->applied_at->format('F d, Y') }}
                                                ({{ $candidate->applied_at->diffForHumans() }})
                                            </p>
                                        </div>

                                        <form method="POST" action="{{ route('candidates.update', $candidate) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <!-- Personal Information -->
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <h4 class="text-primary mb-3"><i class="fas fa-user me-2"></i>Personal Information</h4>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                                           id="first_name" name="first_name" value="{{ old('first_name', $candidate->first_name) }}" required>
                                                    @error('first_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                                           id="last_name" name="last_name" value="{{ old('last_name', $candidate->last_name) }}" required>
                                                    @error('last_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                           id="email" name="email" value="{{ old('email', $candidate->email) }}" required>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="phone" class="form-label">Phone Number</label>
                                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                                           id="phone" name="phone" value="{{ old('phone', $candidate->phone) }}">
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Address Information -->
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <h4 class="text-primary mb-3"><i class="fas fa-map-marker-alt me-2"></i>Address Information</h4>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="address" class="form-label">Street Address</label>
                                                    <textarea class="form-control @error('address') is-invalid @enderror"
                                                              id="address" name="address" rows="2">{{ old('address', $candidate->address) }}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="city" class="form-label">City</label>
                                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                                           id="city" name="city" value="{{ old('city', $candidate->city) }}">
                                                    @error('city')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="state" class="form-label">State</label>
                                                    <input type="text" class="form-control @error('state') is-invalid @enderror"
                                                           id="state" name="state" value="{{ old('state', $candidate->state) }}">
                                                    @error('state')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="zip_code" class="form-label">ZIP Code</label>
                                                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                                           id="zip_code" name="zip_code" value="{{ old('zip_code', $candidate->zip_code) }}">
                                                    @error('zip_code')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Job Information -->
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <h4 class="text-primary mb-3"><i class="fas fa-briefcase me-2"></i>Job Information</h4>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="position_applied" class="form-label">Position You're Applying For</label>
                                                    <input type="text" class="form-control @error('position_applied') is-invalid @enderror"
                                                           id="position_applied" name="position_applied" value="{{ old('position_applied', $candidate->position_applied) }}">
                                                    @error('position_applied')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="job_listing_id" class="form-label">Related Job Listing (Optional)</label>
                                                    <select class="form-select @error('job_listing_id') is-invalid @enderror" id="job_listing_id" name="job_listing_id">
                                                        <option value="">Select a job listing</option>
                                                        @foreach($jobListings as $job)
                                                            <option value="{{ $job->id }}" {{ old('job_listing_id', $candidate->job_listing_id) == $job->id ? 'selected' : '' }}>
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
                                                            <option value="{{ $key }}" {{ old('employment_type_preference', $candidate->employment_type_preference) == $key ? 'selected' : '' }}>
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
                                                           id="available_start_date" name="available_start_date" value="{{ old('available_start_date', $candidate->available_start_date?->format('Y-m-d')) }}">
                                                    @error('available_start_date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Salary Expectations -->
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <h4 class="text-primary mb-3"><i class="fas fa-dollar-sign me-2"></i>Salary Expectations (Optional)</h4>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="expected_salary_min" class="form-label">Minimum Expected Salary</label>
                                                    <input type="number" step="0.01" class="form-control @error('expected_salary_min') is-invalid @enderror"
                                                           id="expected_salary_min" name="expected_salary_min" value="{{ old('expected_salary_min', $candidate->expected_salary_min) }}">
                                                    @error('expected_salary_min')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="expected_salary_max" class="form-label">Maximum Expected Salary</label>
                                                    <input type="number" step="0.01" class="form-control @error('expected_salary_max') is-invalid @enderror"
                                                           id="expected_salary_max" name="expected_salary_max" value="{{ old('expected_salary_max', $candidate->expected_salary_max) }}">
                                                    @error('expected_salary_max')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="expected_salary_type" class="form-label">Salary Type</label>
                                                    <select class="form-select @error('expected_salary_type') is-invalid @enderror"
                                                            id="expected_salary_type" name="expected_salary_type">
                                                        @foreach(\App\Models\Candidate::getSalaryTypes() as $key => $label)
                                                            <option value="{{ $key }}" {{ old('expected_salary_type', $candidate->expected_salary_type) == $key ? 'selected' : '' }}>
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
                                                    <h4 class="text-primary mb-3"><i class="fas fa-graduation-cap me-2"></i>Experience & Education</h4>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="work_experience" class="form-label">Work Experience</label>
                                                    <textarea class="form-control @error('work_experience') is-invalid @enderror"
                                                              id="work_experience" name="work_experience" rows="4"
                                                              placeholder="Please describe your relevant work experience...">{{ old('work_experience', $candidate->work_experience) }}</textarea>
                                                    @error('work_experience')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="education" class="form-label">Education</label>
                                                    <textarea class="form-control @error('education') is-invalid @enderror"
                                                              id="education" name="education" rows="3"
                                                              placeholder="Please describe your educational background...">{{ old('education', $candidate->education) }}</textarea>
                                                    @error('education')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="certifications" class="form-label">Certifications</label>
                                                    <textarea class="form-control @error('certifications') is-invalid @enderror"
                                                              id="certifications" name="certifications" rows="2"
                                                              placeholder="List any relevant certifications...">{{ old('certifications', $candidate->certifications) }}</textarea>
                                                    @error('certifications')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Documents -->
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <h4 class="text-primary mb-3"><i class="fas fa-file me-2"></i>Documents</h4>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="resume" class="form-label">Resume/CV</label>
                                                    @if($candidate->resume_path)
                                                        <div class="mb-2">
                                                            <small class="text-muted">Current: </small>
                                                            <a href="{{ route('candidates.download-resume', $candidate) }}" class="text-primary">
                                                                <i class="fas fa-download me-1"></i>Download Current Resume
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <input type="file" class="form-control @error('resume') is-invalid @enderror"
                                                           id="resume" name="resume" accept=".pdf,.doc,.docx">
                                                    <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</small>
                                                    @error('resume')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="cover_letter" class="form-label">Cover Letter</label>
                                                    @if($candidate->cover_letter_path)
                                                        <div class="mb-2">
                                                            <small class="text-muted">Current: </small>
                                                            <a href="{{ route('candidates.download-cover-letter', $candidate) }}" class="text-primary">
                                                                <i class="fas fa-download me-1"></i>Download Current Cover Letter
                                                            </a>
                                                        </div>
                                                    @endif
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
                                                    <h4 class="text-primary mb-3"><i class="fas fa-info-circle me-2"></i>Additional Information</h4>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="referral_source" class="form-label">How did you hear about us?</label>
                                                    <select class="form-select @error('referral_source') is-invalid @enderror"
                                                            id="referral_source" name="referral_source">
                                                        <option value="">Select source</option>
                                                        @foreach(\App\Models\Candidate::getReferralSources() as $key => $label)
                                                            <option value="{{ $key }}" {{ old('referral_source', $candidate->referral_source) == $key ? 'selected' : '' }}>
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
                                                              placeholder="Any additional information you'd like to share...">{{ old('additional_notes', $candidate->additional_notes) }}</textarea>
                                                    @error('additional_notes')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Preferences & Consent -->
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <h4 class="text-primary mb-3"><i class="fas fa-check-square me-2"></i>Preferences & Consent</h4>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="willing_to_relocate"
                                                               name="willing_to_relocate" value="1" {{ old('willing_to_relocate', $candidate->willing_to_relocate) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="willing_to_relocate">
                                                            I am willing to relocate if necessary
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="has_transportation"
                                                               name="has_transportation" value="1" {{ old('has_transportation', $candidate->has_transportation) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="has_transportation">
                                                            I have reliable transportation
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="background_check_consent"
                                                               name="background_check_consent" value="1" {{ old('background_check_consent', $candidate->background_check_consent) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="background_check_consent">
                                                            I consent to a background check if required for this position
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-3 me-3">
                                                        <i class="fas fa-save me-2"></i> Update Application
                                                    </button>
                                                    <a href="{{ route('candidates.show', $candidate) }}" class="btn btn-outline-secondary btn-lg px-5 py-3">
                                                        <i class="fas fa-times me-2"></i> Cancel
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
@endsection
