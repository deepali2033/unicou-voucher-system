@extends('admin.layouts.app')

@section('title', 'Application Details - ' . $candidate->full_name)
@section('page-title', 'Application Details')

@section('page-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.applied-jobs.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Applications
        </a>
        @if($candidate->jobListing)
        <a href="{{ route('jobs.show', $candidate->jobListing->slug) }}" class="btn btn-t-g" target="_blank">
            <i class="fas fa-external-link-alt me-1"></i> View Job Listing
        </a>
        @endif
    </div>
@endsection

@section('content')
<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">

        <!-- Status Alert -->
        <div class="alert border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #E8F5D3 0%, #d4edda 100%);">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h5 class="alert-heading mb-1">
                        <i class="fas fa-info-circle text-green me-2"></i>
                        Application Status
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
                        <a href="{{ route('jobs.show', $candidate->jobListing->slug) }}" class="text-green" target="_blank">
                            {{ $candidate->jobListing->title }} <i class="fas fa-external-link-alt fa-xs"></i>
                        </a>
                    </div>
                    @endif
                    @if($candidate->expected_salary_min || $candidate->expected_salary_max)
                    <div class="col-12 mb-3">
                        <strong class="text-muted">Expected Salary:</strong><br>
                        <span class="text-dark fw-bold">
                            @if($candidate->expected_salary_min && $candidate->expected_salary_max)
                                ${{ number_format($candidate->expected_salary_min) }} - ${{ number_format($candidate->expected_salary_max) }}/{{ $candidate->expected_salary_type ?? 'hr' }}
                            @elseif($candidate->expected_salary_min)
                                From ${{ number_format($candidate->expected_salary_min) }}/{{ $candidate->expected_salary_type ?? 'hr' }}
                            @else
                                Up to ${{ number_format($candidate->expected_salary_max) }}/{{ $candidate->expected_salary_type ?? 'hr' }}
                            @endif
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

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
                    <a href="{{ asset('storage/' . $candidate->resume_path) }}" class="btn btn-t-g btn-sm" target="_blank">
                        <i class="fas fa-file-pdf me-1"></i> View Resume
                    </a>
                    @endif
                    @if($candidate->cover_letter_path)
                    <a href="{{ asset('storage/' . $candidate->cover_letter_path) }}" class="btn btn-t-g btn-sm" target="_blank">
                        <i class="fas fa-file-pdf me-1"></i> View Cover Letter
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endif

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
                <a href="{{ route('jobs.show', $candidate->jobListing->slug) }}" class="btn btn-t-g btn-sm w-100" target="_blank">
                    <i class="fas fa-external-link-alt me-1"></i> View Full Job Listing
                </a>
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
        background-color: #3ca200;
        color: white;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-t-g:hover {
        background-color: #2d7a00;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(60, 162, 0, 0.3);
    }

    .badge {
        border-radius: 6px;
        font-size: 0.875rem;
    }
</style>
@endpush
