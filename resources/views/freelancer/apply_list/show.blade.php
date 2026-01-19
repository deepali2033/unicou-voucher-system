@extends('freelancer.layouts.app')

@section('title', 'Application Details - ' . $candidate->full_name)
@section('page-title', 'Application Details')

@section('page-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('freelancer.applied-jobs.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Applications
        </a>
        @if($candidate->jobListing)
            <!-- <a href="{{ route('jobs.show', $candidate->jobListing->slug) }}" class="btn btn-t-g" target="_blank">
                                            <i class="fas fa-external-link-alt me-1"></i> View Job Listing
                                        </a> -->
        @endif
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">

            <!-- Status Alert -->
            <div class="alert border-0 shadow-sm mb-4"
                style="background: linear-gradient(135deg, #E8F5D3 0%, #d4edda 100%);">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h5 class="alert-heading mb-1">
                            <i class="fas fa-info-circle text-green me-2"></i>
                            Applicsdfvdgdfgation Status
                        </h5>
                        <p class="mb-0">
                            <strong>Current Status:</strong>
                            <span class="badge fw-medium px-3 py-2 ms-2 {{
        $candidate->status == 'pending' ? 'koa-badge-yellow' :
        ($candidate->status == 'under_review' ? 'koa-badge-blue' :
            ($candidate->status == 'interview_scheduled' ? 'koa-badge-light-green' :
                ($candidate->status == 'selected' ? 'koa-badge-green' :
                    ($candidate->status == 'rejected' ? 'koa-badge-red' : 'koa-badge-light-green'))))
                                        }}">
                                {{ ucwords(str_replace('_', ' ', $candidate->status)) }}
                            </span>
                        </p>
                    </div>
                    <div class="text-end">
                        <small class="text-muted">Applied on</small><br>
                        <strong>{{ $candidate->applied_at->format('M d, Y') }}</strong><br>
                        <small class="text-muted">{{ $candidate->applied_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="card shadow-sm border-0 koa-tb-card mb-4">
                <div class="card-header border-0 koa-card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user text-green me-2"></i>
                        Personal Information
                    </h5>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted">Full Name:</strong><br>
                            <span class="text-dark">{{ $candidate->full_name }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted">Email:</strong><br>
                            <a href="mailto:{{ $candidate->email }}" class="text-green">{{ $candidate->email }}</a>
                        </div>
                        @if($candidate->phone)
                            <div class="col-md-6 mb-3">
                                <strong class="text-muted">Phone:</strong><br>
                                <a href="tel:{{ $candidate->phone }}" class="text-green">{{ $candidate->phone }}</a>
                            </div>
                        @endif
                        @if($candidate->date_of_birth)
                            <div class="col-md-6 mb-3">
                                <strong class="text-muted">Date of Birth:</strong><br>
                                <span class="text-dark">{{ $candidate->date_of_birth->format('F d, Y') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            @if($candidate->address || $candidate->city || $candidate->state || $candidate->zip_code)
                <div class="card shadow-sm border-0 koa-tb-card mb-4">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-map-marker-alt text-green me-2"></i>
                            Address Information
                        </h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
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
            <div class="card shadow-sm border-0 koa-tb-card mb-4">
                <div class="card-header border-0 koa-card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-briefcase text-green me-2"></i>
                        Job Information
                    </h5>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted">Position Applied:</strong><br>
                            <span class="text-dark">{{ $candidate->position_applied ?: 'Not specified' }}</span>
                        </div>
                        @if($candidate->jobListing)
                            <div class="col-md-6 mb-3">
                                <strong class="text-muted">Related Job Listing:</strong><br>
                                <a href="{{ route('jobs.show', $candidate->jobListing->slug) }}" class="text-green"
                                    target="_blank">
                                    {{ $candidate->jobListing->title }} <i class="fas fa-external-link-alt fa-xs"></i>
                                </a>
                            </div>
                        @endif
                        @if($candidate->employment_type_preference)
                            <div class="col-md-6 mb-3">
                                <strong class="text-muted">Employment Type Preference:</strong><br>
                                <span
                                    class="text-dark">{{ ucwords(str_replace('_', ' ', $candidate->employment_type_preference)) }}</span>
                            </div>
                        @endif
                        @if($candidate->available_start_date)
                            <div class="col-md-6 mb-3">
                                <strong class="text-muted">Available Start Date:</strong><br>
                                <span class="text-dark">{{ $candidate->available_start_date->format('F d, Y') }}</span>
                            </div>
                        @endif
                        @if($candidate->expected_salary_min || $candidate->expected_salary_max)
                            <div class="col-12 mb-3">
                                <strong class="text-muted">Expected Salary:</strong><br>
                                <span class="text-dark fw-bold">{{ $candidate->expected_salary_range }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Skills -->
            @if($candidate->skills)
                <div class="card shadow-sm border-0 koa-tb-card mb-4">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-lightbulb text-green me-2"></i>
                            Skills
                        </h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="d-flex flex-wrap gap-2">
                            @foreach((array) $candidate->skills as $skill)
                                <span class="badge koa-badge-light-green fw-normal px-3 py-2">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Work Experience -->
            @if($candidate->work_experience)
                <div class="card shadow-sm border-0 koa-tb-card mb-4">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-briefcase text-green me-2"></i>
                            Work Experience
                        </h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="p-3 rounded" style="background-color: #fff;">
                            {!! nl2br(e($candidate->work_experience)) !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Education -->
            @if($candidate->education)
                <div class="card shadow-sm border-0 koa-tb-card mb-4">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-graduation-cap text-green me-2"></i>
                            Education
                        </h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="p-3 rounded" style="background-color: #fff;">
                            {!! nl2br(e($candidate->education)) !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Certifications -->
            @if($candidate->certifications)
                <div class="card shadow-sm border-0 koa-tb-card mb-4">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-certificate text-green me-2"></i>
                            Certifications
                        </h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="p-3 rounded" style="background-color: #fff;">
                            {!! nl2br(e($candidate->certifications)) !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Additional Notes -->
            @if($candidate->additional_notes)
                <div class="card shadow-sm border-0 koa-tb-card mb-4">
                    <div class="card-header border-0 koa-card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-sticky-note text-green me-2"></i>
                            Additional Notes
                        </h5>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="p-3 rounded" style="background-color: #fff;">
                            {!! nl2br(e($candidate->additional_notes)) !!}
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">

            <!-- Profile Photo -->
            {{-- @if($candidate->profile_photo_path)
            <div class="card shadow-sm border-0 koa-tb-card mb-4">
                <div class="card-header border-0 koa-card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-user text-green me-2"></i>
                        Profile Photo
                    </h6>
                </div>
                <div class="card-body p-3 koa-tb-cnt text-center">
                    <form id="photo-update-form" action="{{ route('freelancer.applied-jobs.update-photo', $candidate) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <img id="profile-photo-preview" src="{{ asset('storage/' . $candidate->profile_photo_path) }}"
                            alt="Profile Photo" class="img-fluid rounded-circle"
                            style="max-width: 150px; max-height: 150px;">
                        <input type="file" id="profile-photo-input" name="profile_photo" accept="image/*"
                            style="display: none;">
                        <div class="mt-2">
                            <button type="button" id="change-photo-btn" class="btn btn-sm btn-outline-primary me-2"
                                title="Change Photo">
                                <i class="fas fa-camera fa-sm"></i> Change
                            </button>
                            <button type="submit" id="update-photo-btn" class="btn btn-sm btn-success"
                                style="display: none;" title="Update Photo">
                                <i class="fas fa-save fa-sm"></i> Update
                            </button>
                            <button type="button" id="cancel-photo-btn" class="btn btn-sm btn-secondary"
                                style="display: none;" title="Cancel">
                                <i class="fas fa-times fa-sm"></i> Cancel
                            </button>
                            <a href="/freelancer/profile" class="btn btn-sm btn-outline-secondary ms-2"
                                title="Edit Full Profile">
                                <i class="fas fa-edit fa-sm"></i> Edit Profile
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            @endif --}}

            <!-- Quick Info -->
            <div class="card shadow-sm border-0 koa-tb-card mb-4">
                <div class="card-header border-0 koa-card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle text-green me-2"></i>
                        Application Info
                    </h6>
                </div>
                <div class="card-body p-3 koa-tb-cnt">
                    <div class="mb-3">
                        <strong class="text-muted d-block mb-1">Current Status:</strong>
                        <span class="badge fw-medium px-3 py-2 {{
        $candidate->status == 'pending' ? 'koa-badge-yellow' :
        ($candidate->status == 'under_review' ? 'koa-badge-blue' :
            ($candidate->status == 'interview_scheduled' ? 'koa-badge-light-green' :
                ($candidate->status == 'selected' ? 'koa-badge-green' :
                    ($candidate->status == 'rejected' ? 'koa-badge-red' : 'koa-badge-light-green'))))
                                    }}">
                            {{ ucwords(str_replace('_', ' ', $candidate->status)) }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <strong class="text-muted d-block mb-1">Applied Date:</strong>
                        <span class="text-dark">{{ $candidate->applied_at->format('M d, Y') }}</span><br>
                        <small class="text-muted">{{ $candidate->applied_at->diffForHumans() }}</small>
                    </div>
                    @if($candidate->referral_source)
                        <div class="mb-3">
                            <strong class="text-muted d-block mb-1">How you heard about us:</strong>
                            <span class="text-dark">{{ ucwords(str_replace('_', ' ', $candidate->referral_source)) }}</span>
                        </div>
                    @endif
                    @if($candidate->additional_comments)
                        <div>
                            <strong class="text-muted d-block mb-1">Additional Comments:</strong>
                            <div class="p-2 rounded" style="background-color: #fff;">
                                <small>{{ $candidate->additional_comments }}</small>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Documents -->
            @if($candidate->resume_path || $candidate->cover_letter_path)
                <div class="card shadow-sm border-0 koa-tb-card mb-4">
                    <div class="card-header border-0 koa-card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-file-alt text-green me-2"></i>
                            Your Documents
                        </h6>
                    </div>
                    <div class="card-body p-3 koa-tb-cnt">
                        <div class="d-grid gap-2">
                            @if($candidate->resume_path)
                                <a href="{{ asset('storage/' . $candidate->resume_path) }}" class="btn btn-t-g btn-sm"
                                    target="_blank">
                                    <i class="fas fa-file-pdf me-1"></i> View Resume
                                </a>
                            @endif
                            @if($candidate->cover_letter_path)
                                <a href="{{ asset('storage/' . $candidate->cover_letter_path) }}" class="btn btn-t-g btn-sm"
                                    target="_blank">
                                    <i class="fas fa-file-pdf me-1"></i> View Cover Letter
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Preferences -->
            <div class="card shadow-sm border-0 koa-tb-card mb-4">
                <div class="card-header border-0 koa-card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-check-square text-green me-2"></i>
                        Your Preferences
                    </h6>
                </div>
                <div class="card-body p-3 koa-tb-cnt">
                    <div class="mb-2">
                        <i
                            class="fas fa-{{ $candidate->willing_to_relocate ? 'check text-green' : 'times text-muted' }} me-2"></i>
                        <span>Willing to relocate</span>
                    </div>
                    <div class="mb-2">
                        <i
                            class="fas fa-{{ $candidate->has_transportation ? 'check text-green' : 'times text-muted' }} me-2"></i>
                        <span>Has reliable transportation</span>
                    </div>
                    <div>
                        <i
                            class="fas fa-{{ $candidate->background_check_consent ? 'check text-green' : 'times text-muted' }} me-2"></i>
                        <span>Background check consent</span>
                    </div>
                </div>
            </div>

            @if($candidate->jobListing)
                <!-- Job Listing Info -->
                <div class="card shadow-sm border-0 koa-tb-card mb-4">
                    <div class="card-header border-0 koa-card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-briefcase text-green me-2"></i>
                            Job Listing Details
                        </h6>
                    </div>
                    <div class="card-body p-3 koa-tb-cnt">
                        <h6 class="text-dark mb-2">{{ $candidate->jobListing->title }}</h6>
                        @if($candidate->jobListing->location)
                            <p class="text-muted mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $candidate->jobListing->location }}
                            </p>
                        @endif
                        @if($candidate->jobListing->salary_range)
                            <p class="text-muted mb-2">
                                <i class="fas fa-dollar-sign me-1"></i>
                                {{ $candidate->jobListing->salary_range }}
                            </p>
                        @endif
                        <!-- <a href="{{ route('jobs.show', $candidate->jobListing->slug) }}" class="btn btn-t-g btn-sm w-100" target="_blank">
                                                    <i class="fas fa-external-link-alt me-1"></i> View Full Job Listing
                                                </a> -->
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .koa-tb-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        .koa-card-header {
            background: linear-gradient(135deg, #E8F5D3 0%, #d4edda 100%);
            padding: 1rem 1.5rem;
        }

        .koa-tb-cnt {
            background: #f8f9fa;
        }

        .text-green {
            color: #3ca200 !important;
        }

        .text-red {
            color: #dc3545 !important;
        }

        .koa-badge-green {
            background-color: #3ca200;
            color: #fff;
        }

        .koa-badge-blue {
            background-color: #007bff;
            color: #fff;
        }

        .koa-badge-yellow {
            background-color: #ffc107;
            color: #000;
        }

        .koa-badge-red {
            background-color: #dc3545;
            color: #fff;
        }

        .koa-badge-light-green {
            background-color: #E8F5D3;
            color: #3ca200;
        }

        .btn-t-g {
            background: linear-gradient(135deg, #0ef265ff 0%, #5FAD56 100%);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-t-g:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(60, 162, 0, 0.4);
            color: white;
        }

        .badge {
            border-radius: 6px;
            font-size: 0.875rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const changePhotoBtn = document.getElementById('change-photo-btn');
            const updatePhotoBtn = document.getElementById('update-photo-btn');
            const cancelPhotoBtn = document.getElementById('cancel-photo-btn');
            const photoInput = document.getElementById('profile-photo-input');
            const photoPreview = document.getElementById('profile-photo-preview');
            const originalSrc = photoPreview.src;

            // Change photo button click
            changePhotoBtn.addEventListener('click', function () {
                photoInput.click();
            });

            // File input change
            photoInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    // Validate file type
                    if (!file.type.match('image.*')) {
                        alert('Please select a valid image file.');
                        return;
                    }

                    // Validate file size (3MB max)
                    if (file.size > 3 * 1024 * 1024) {
                        alert('File size must be less than 3MB.');
                        return;
                    }

                    // Preview image
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        photoPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);

                    // Show update and cancel buttons
                    updatePhotoBtn.style.display = 'inline-block';
                    cancelPhotoBtn.style.display = 'inline-block';
                    changePhotoBtn.style.display = 'none';
                }
            });

            // Cancel button click
            cancelPhotoBtn.addEventListener('click', function () {
                // Reset to original image
                photoPreview.src = originalSrc;
                photoInput.value = '';

                // Reset buttons
                updatePhotoBtn.style.display = 'none';
                cancelPhotoBtn.style.display = 'none';
                changePhotoBtn.style.display = 'inline-block';
            });
        });
    </script>
@endpush