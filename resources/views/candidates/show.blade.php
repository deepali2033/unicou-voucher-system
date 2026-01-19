@extends('layouts.app')

@section('title', 'Application Details - ' . $candidate->full_name . ' - KOA Service')
@section('meta_description', 'View your job application details at KOA Service.')

@section('content')
<article id="post-application" class="full post-application page type-page status-publish has-post-thumbnail hentry">
    <div data-elementor-type="single-page" data-elementor-id="application" class="elementor elementor-application elementor-location-single post-application page type-page status-publish has-post-thumbnail hentry" data-elementor-post-type="elementor_library">
        <div class="elementor-element elementor-element-6b37ea9 e-con-full e-flex e-con e-parent" data-id="6b37ea9" data-element_type="container">
            <div class="elementor-element elementor-element-eb67e7a e-flex e-con-boxed e-con e-child" data-id="eb67e7a" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                <div class="e-con-inner">
                    <div class="elementor-element elementor-element-ed83420 elementor-widget__width-inherit animated-fast elementor-invisible elementor-widget elementor-widget-theme-post-title elementor-page-title elementor-widget-heading" data-id="ed83420" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}" data-widget_type="theme-post-title.default">
                        <div class="elementor-widget-container">
                            <h1 class="elementor-heading-title elementor-size-default">Application Details</h1>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-e5c0dc0 elementor-widget__width-auto animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="e5c0dc0" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200}" data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            Applicant: {{ $candidate->full_name }}
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-0d106e3 elementor-widget__width-auto animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="0d106e3" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:250}" data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            Status: <span class="badge {{ $candidate->status_badge }} fw-bold">{{ ucfirst($candidate->status) }}</span>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-aea21ab elementor-widget__width-auto animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="aea21ab" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:300}" data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            Applied: {{ $candidate->applied_at->format('F d, Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="elementor-element elementor-element-172b4a5 e-con-full e-flex e-con e-parent" data-id="172b4a5" data-element_type="container">
            <div class="elementor-element elementor-element-4ce3c18 elementor-widget elementor-widget-theme-post-content" data-id="4ce3c18" data-element_type="widget" data-widget_type="theme-post-content.default">
                <div class="elementor-widget-container">
                    <div data-elementor-type="wp-page" data-elementor-id="application" class="elementor elementor-application" data-elementor-post-type="page">
                        <div class="elementor-element elementor-element-30c4a91c e-flex e-con-boxed e-con e-parent" data-id="30c4a91c" data-element_type="container">
                            <div class="e-con-inner">
                                <div class="row">
                                    <!-- Main Content -->
                                    <div class="col-lg-8">
                                        <div class="elementor-element elementor-element-main animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="main" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:100}" data-widget_type="text-editor.default">
                                            <div class="elementor-widget-container">
                                                <!-- Personal Information -->
                                                <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                                                    <div class="card-header bg-primary text-white">
                                                        <h5 class="mb-0"><i class="fas fa-user me-2"></i>Personal Information</h5>
                                                    </div>
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <strong>dffFull Name:</strong><br>
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
                                                    <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                                                        <div class="card-header bg-info text-white">
                                                            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Address</h5>
                                                        </div>
                                                        <div class="card-body p-4">
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
                                                <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                                                    <div class="card-header bg-success text-white">
                                                        <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Job Information</h5>
                                                    </div>
                                                    <div class="card-body p-4">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <strong>Position Applied:</strong><br>
                                                                <span class="text-dark">{{ $candidate->position_applied ?: 'Not specified' }}</span>
                                                            </div>
                                                            @if($candidate->jobListing)
                                                                <div class="col-md-6 mb-3">
                                                                    <strong>Related Job Listing:</strong><br>
                                                                    <a href="{{ route('jobs.show', $candidate->jobListing->slug) }}" class="text-primary">
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
                                                    <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                                                        <div class="card-header bg-warning text-dark">
                                                            <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Work Experience</h5>
                                                        </div>
                                                        <div class="card-body p-4">
                                                            <div class="bg-light p-3 rounded">
                                                                {!! nl2br(e($candidate->work_experience)) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($candidate->education)
                                                    <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                                                        <div class="card-header bg-secondary text-white">
                                                            <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Education</h5>
                                                        </div>
                                                        <div class="card-body p-4">
                                                            <div class="bg-light p-3 rounded">
                                                                {!! nl2br(e($candidate->education)) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($candidate->certifications)
                                                    <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                                                        <div class="card-header bg-dark text-white">
                                                            <h5 class="mb-0"><i class="fas fa-certificate me-2"></i>Certifications</h5>
                                                        </div>
                                                        <div class="card-body p-4">
                                                            <div class="bg-light p-3 rounded">
                                                                {!! nl2br(e($candidate->certifications)) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($candidate->additional_notes)
                                                    <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                                                        <div class="card-header bg-light">
                                                            <h5 class="mb-0 text-dark"><i class="fas fa-sticky-note me-2"></i>Additional Notes</h5>
                                                        </div>
                                                        <div class="card-body p-4">
                                                            <div class="bg-light p-3 rounded">
                                                                {!! nl2br(e($candidate->additional_notes)) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sidebar -->
                                    <div class="col-lg-4">
                                        <div class="elementor-element elementor-element-sidebar animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="sidebar" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200}" data-widget_type="text-editor.default">
                                            <div class="elementor-widget-container">
                                                <!-- Quick Info -->
                                                <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                                                    <div class="card-header bg-primary text-white">
                                                        <h6 class="mb-0">Application Status</h6>
                                                    </div>
                                                    <div class="card-body p-3">
                                                        <div class="mb-3">
                                                            <strong>Current Status:</strong><br>
                                                            <span class="badge {{ $candidate->status_badge }} fw-bold">{{ ucfirst($candidate->status) }}</span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Applied Date:</strong><br>
                                                            <span class="text-muted">{{ $candidate->applied_at->format('M d, Y') }}</span><br>
                                                            <small class="text-muted">{{ $candidate->applied_at->diffForHumans() }}</small>
                                                        </div>
                                                        @if($candidate->referral_source)
                                                            <div class="mb-3">
                                                                <strong>How you heard about us:</strong><br>
                                                                <span class="text-muted">{{ \App\Models\Candidate::getReferralSources()[$candidate->referral_source] ?? $candidate->referral_source }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Documents -->
                                                @if($candidate->resume_path || $candidate->cover_letter_path)
                                                    <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                                                        <div class="card-header bg-info text-white">
                                                            <h6 class="mb-0">Your Documents</h6>
                                                        </div>
                                                        <div class="card-body p-3">
                                                            @if($candidate->resume_path)
                                                                <div class="mb-2">
                                                                    <a href="{{ route('candidates.download-resume', $candidate) }}"
                                                                       class="btn btn-outline-primary btn-sm w-100">
                                                                        <i class="fas fa-download me-1"></i> Download Resume
                                                                    </a>
                                                                </div>
                                                            @endif
                                                            @if($candidate->cover_letter_path)
                                                                <div class="mb-2">
                                                                    <a href="{{ route('candidates.download-cover-letter', $candidate) }}"
                                                                       class="btn btn-outline-primary btn-sm w-100">
                                                                        <i class="fas fa-download me-1"></i> Download Cover Letter
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Preferences -->
                                                <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                                                    <div class="card-header bg-success text-white">
                                                        <h6 class="mb-0">Your Preferences</h6>
                                                    </div>
                                                    <div class="card-body p-3">
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
                                                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                                                    <div class="card-header bg-warning text-dark">
                                                        <h6 class="mb-0">Actions</h6>
                                                    </div>
                                                    <div class="card-body p-3">
                                                        <div class="d-grid gap-2">
                                                            <a href="{{ route('candidates.edit', $candidate) }}" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit me-1"></i> Edit Application
                                                            </a>
                                                            <a href="{{ route('candidates.index') }}" class="btn btn-outline-secondary btn-sm">
                                                                <i class="fas fa-list me-1"></i> View All Applications
                                                            </a>
                                                            <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary btn-sm">
                                                                <i class="fas fa-briefcase me-1"></i> Browse Jobs
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

<style>
.badge-warning {
    background-color: #ffc107 !important;
    color: #000 !important;
}

.badge-info {
    background-color: #17a2b8 !important;
}

.badge-primary {
    background-color: #007bff !important;
}

.badge-success {
    background-color: #28a745 !important;
}

.badge-danger {
    background-color: #dc3545 !important;
}

.badge-secondary {
    background-color: #6c757d !important;
}
</style>
@endsection
