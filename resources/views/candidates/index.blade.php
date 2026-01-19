@extends('layouts.app')

@section('title', 'Job Applications - KOA Service')
@section('meta_description', 'View and manage your job applications at KOA Service.')

@section('content')
<article id="post-candidates" class="full post-candidates page type-page status-publish has-post-thumbnail hentry">
    <div data-elementor-type="single-page" data-elementor-id="candidates" class="elementor elementor-candidates elementor-location-single post-candidates page type-page status-publish has-post-thumbnail hentry" data-elementor-post-type="elementor_library">
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
                                        <span>Applications</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-6ac1097 animated-fast elementor-invisible elementor-widget elementor-widget-theme-post-excerpt" data-id="6ac1097" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:100}" data-widget_type="theme-post-excerpt.default">
                        <div class="elementor-widget-container">
                            Your Job Applications
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="elementor-element elementor-element-b6b8c0c e-con-full e-flex e-con e-parent" data-id="b6b8c0c" data-element_type="container">
            <div class="elementor-element elementor-element-1cde2c4 elementor-widget elementor-widget-theme-post-content" data-id="1cde2c4" data-element_type="widget" data-widget_type="theme-post-content.default">
                <div class="elementor-widget-container">
                    <div data-elementor-type="wp-page" data-elementor-id="candidates" class="elementor elementor-candidates" data-elementor-post-type="page">
                        <div class="elementor-element elementor-element-a1134ac e-flex e-con-boxed e-con e-parent" data-id="a1134ac" data-element_type="container">
                            <div class="e-con-inner">
                                <!-- Search and Filter Section -->
                                <div class="elementor-element elementor-element-search animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="search" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:100}" data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container">
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <div class="card shadow-sm border-0" style="background: #f8f9fa;">
                                                    <div class="card-body p-4">
                                                        <form method="GET" action="{{ route('candidates.index') }}" class="row g-3">
                                                            <div class="col-md-4">
                                                                <label for="search" class="form-label">Search Applications</label>
                                                                <input type="text" class="form-control" id="search" name="search" 
                                                                       value="{{ request('search') }}" placeholder="Search by name, email, position...">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-select" id="status" name="status">
                                                                    <option value="">All Statuses</option>
                                                                    @foreach($statuses as $key => $label)
                                                                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                                                            {{ $label }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="position" class="form-label">Position</label>
                                                                <select class="form-select" id="position" name="position">
                                                                    <option value="">All Positions</option>
                                                                    @foreach($positions as $position)
                                                                        <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>
                                                                            {{ $position }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2 d-flex align-items-end">
                                                                <button type="submit" class="btn btn-primary me-2">Filter</button>
                                                                <a href="{{ route('candidates.index') }}" class="btn btn-outline-secondary">Clear</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Applications List -->
                                <div class="elementor-element elementor-element-applications animated-fast elementor-invisible elementor-widget elementor-widget-text-editor" data-id="applications" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200}" data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container">
                                        @if($candidates->count() > 0)
                                            <div class="row">
                                                @foreach($candidates as $candidate)
                                                    <div class="col-lg-6 col-xl-4 mb-4">
                                                        <div class="card h-100 shadow-sm border-0" style="transition: transform 0.2s; border-radius: 15px;">
                                                            <div class="card-body p-4">
                                                                <div class="d-flex justify-content-between align-items-start mb-3">
                                                                    <h5 class="card-title mb-0 text-dark">{{ $candidate->full_name }}</h5>
                                                                    <span class="badge {{ $candidate->status_badge }} fw-bold">
                                                                        {{ ucfirst($candidate->status) }}
                                                                    </span>
                                                                </div>
                                                                
                                                                <div class="mb-3">
                                                                    <small class="text-muted d-block">
                                                                        <i class="fas fa-envelope me-1"></i> {{ $candidate->email }}
                                                                    </small>
                                                                    @if($candidate->phone)
                                                                        <small class="text-muted d-block">
                                                                            <i class="fas fa-phone me-1"></i> {{ $candidate->phone }}
                                                                        </small>
                                                                    @endif
                                                                </div>

                                                                <div class="mb-3">
                                                                    <strong class="text-primary">Position Applied:</strong><br>
                                                                    <span class="text-dark">{{ $candidate->position_applied ?: 'Not specified' }}</span>
                                                                    @if($candidate->jobListing)
                                                                        <br><small class="text-muted">{{ $candidate->jobListing->title }}</small>
                                                                    @endif
                                                                </div>

                                                                <div class="mb-3">
                                                                    <strong class="text-primary">Applied:</strong><br>
                                                                    <span class="text-dark">{{ $candidate->applied_at->format('M d, Y') }}</span>
                                                                    <small class="text-muted">({{ $candidate->applied_at->diffForHumans() }})</small>
                                                                </div>

                                                                @if($candidate->expected_salary_min || $candidate->expected_salary_max)
                                                                    <div class="mb-3">
                                                                        <strong class="text-primary">Expected Salary:</strong><br>
                                                                        <span class="text-dark">{{ $candidate->expected_salary_range }}</span>
                                                                    </div>
                                                                @endif

                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <a href="{{ route('candidates.show', $candidate) }}" class="btn btn-primary btn-sm">
                                                                        <i class="fas fa-eye me-1"></i> View Details
                                                                    </a>
                                                                    <a href="{{ route('candidates.edit', $candidate) }}" class="btn btn-outline-warning btn-sm">
                                                                        <i class="fas fa-edit me-1"></i> Edit
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Pagination -->
                                            <div class="row mt-4">
                                                <div class="col-12 d-flex justify-content-center">
                                                    {{ $candidates->withQueryString()->links() }}
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-center py-5">
                                                <div class="mb-4">
                                                    <i class="fas fa-clipboard-list fa-4x text-muted"></i>
                                                </div>
                                                <h4 class="text-muted mb-3">No Applications Found</h4>
                                                <p class="text-muted mb-4">
                                                    @if(request()->hasAny(['search', 'status', 'position']))
                                                        No applications match your current filters. Try adjusting your search criteria.
                                                    @else
                                                        You haven't submitted any job applications yet.
                                                    @endif
                                                </p>
                                                <div>
                                                    @if(request()->hasAny(['search', 'status', 'position']))
                                                        <a href="{{ route('candidates.index') }}" class="btn btn-outline-primary me-2">
                                                            <i class="fas fa-times me-1"></i> Clear Filters
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('candidates.create') }}" class="btn btn-primary">
                                                        <i class="fas fa-plus me-1"></i> Submit New Application
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
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
.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

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