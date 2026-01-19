@extends('freelancer.layouts.app')

@section('title', 'My Job Applications')
@section('page-title', 'My Job Applications')

@section('page-actions')
    <a href="{{ route('freelancer.applied-jobs.create') }}" class="btn btn-t-y">
        <i class="fas fa-plus me-2"></i>Apply for New Job
    </a>
@endsection

@section('content')
    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                <h3 class="card-title mb-0 text-dark fs-4">All Job Applications</h3>
                <div class="card-tools">
                    <span class="badge koa-badge-green fw-bold px-3 py-2">
                        {{ $candidates->total() }} Total Applications
                    </span>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="p-3 pt-0">
                <form method="GET" action="{{ route('freelancer.applied-jobs.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search by position or job title..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            @foreach($statuses as $key => $value)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="position" class="form-select">
                            <option value="">All Positions</option>
                            @foreach($positions as $position)
                                <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>
                                    {{ $position }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-t-g w-100">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                    </div>
                    @if(request()->hasAny(['search', 'status', 'position']))
                        <div class="col-12">
                            <a href="{{ route('freelancer.applied-jobs.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Clear Filters
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="card-body p-4 koa-tb-cnt">
            @if($candidates->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Position</th>
                                <th>Job Title</th>
                                <th>Applied Date</th>
                                <th>Expected Salary</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidates as $candidate)
                                <tr>
                                    <td class="ps-4">
                                        <div>
                                            <strong class="text-dark">{{ $candidate->position_applied ?: 'Not Specified' }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-user me-1"></i>{{ $candidate->full_name }}
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        @if($candidate->jobListing)
                                            <div>
                                                <strong class="text-dark">{{ $candidate->jobListing->title }}</strong>
                                                <br>
                                                <small class="text-muted">
                                                    <i class="fas fa-map-marker-alt me-1"></i>
                                                    {{ $candidate->jobListing->location }}
                                                </small>
                                            </div>
                                        @else
                                            <span class="text-muted">General Application</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <strong class="text-dark">{{ $candidate->applied_at->format('M d, Y') }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $candidate->applied_at->diffForHumans() }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if($candidate->expected_salary_min || $candidate->expected_salary_max)
                                            <span class="badge koa-badge-blue fw-normal px-3 py-2">
                                                {{ $candidate->expected_salary_range }}
                                            </span>
                                        @else
                                            <span class="text-muted">Not specified</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge fw-medium px-3 py-2 {{
                                            $candidate->status == 'pending' ? 'koa-badge-yellow' :
                                            ($candidate->status == 'under_review' ? 'koa-badge-blue' :
                                            ($candidate->status == 'interview_scheduled' ? 'koa-badge-light-green' :
                                            ($candidate->status == 'selected' ? 'koa-badge-green' :
                                            ($candidate->status == 'rejected' ? 'koa-badge-red' : 'koa-badge-light-green'))))
                                        }}">
                                            <i class="fas {{
                                                $candidate->status == 'pending' ? 'fa-clock' :
                                                ($candidate->status == 'under_review' ? 'fa-search' :
                                                ($candidate->status == 'interview_scheduled' ? 'fa-calendar-check' :
                                                ($candidate->status == 'selected' ? 'fa-check-circle' :
                                                ($candidate->status == 'rejected' ? 'fa-times-circle' : 'fa-circle'))))
                                            }} me-1"></i>
                                            {{ ucwords(str_replace('_', ' ', $candidate->status)) }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group" style="gap: 8px;">
                                            <a href="{{ route('freelancer.applied-jobs.show', $candidate) }}"
                                               class="btn btn-sm rounded-circle action-btns koa-badge-light-green"
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($candidate->jobListing)
                                                <a href="{{ route('jobs.show', $candidate->jobListing->slug) }}"
                                                   class="btn btn-sm rounded-circle action-btns koa-badge-blue"
                                                   title="View Job"
                                                   target="_blank">
                                                    <i class="fas fa-briefcase"></i>
                                                </a>
                                            @endif
                                            @if($candidate->resume_path)
                                                <a href="{{ asset('storage/' . $candidate->resume_path) }}"
                                                   class="btn btn-sm rounded-circle action-btns koa-badge-yellow"
                                                   title="View Resume"
                                                   target="_blank">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $candidates->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                    <h4 class="text-dark">No Applications Found</h4>
                    <p class="text-muted">
                        @if(request()->hasAny(['search', 'status', 'position']))
                            No applications match your current filters. Try adjusting your search criteria.
                        @else
                            You haven't submitted any job applications yet. Start your job search now!
                        @endif
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        @if(request()->hasAny(['search', 'status', 'position']))
                            <a href="{{ route('freelancer.applied-jobs.index') }}" class="btn btn-outline-secondary px-4 py-2">
                                <i class="fas fa-times me-2"></i>Clear Filters
                            </a>
                        @endif
                        <a href="{{ route('freelancer.applied-jobs.create') }}" class="btn fw-medium px-4 py-2"
                           style="background-color: #3ca200; color: #fff;">
                            <i class="fas fa-plus me-2"></i>Apply for Your First Job
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

    .koa-tb-cnt {
        background: #f8f9fa;
    }

    .table thead th {
        background-color: #fff;
        color: #495057;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
        padding: 1rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table tbody tr {
        background-color: #fff;
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f1f3f5;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .table tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
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

    .koa-badge-green-outline {
        background-color: transparent;
        color: #3ca200;
        border: 2px solid #3ca200;
    }

    .koa-badge-yellow-outline {
        background-color: transparent;
        color: #ffc107;
        border: 2px solid #ffc107;
    }

    .koa-badge-red-outline {
        background-color: transparent;
        color: #dc3545;
        border: 2px solid #dc3545;
    }

    .action-btns {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
    }

    .action-btns:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-t-y {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: #000;
        border: none;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-t-y:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4);
        color: #000;
    }

    .btn-t-g {
        background: linear-gradient(135deg, #0ef265ff 0%, #5FAD56 100%);
        color: white;
        border: none;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-t-g:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(60, 162, 0, 0.4);
        color: white;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        padding: 0.625rem 1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #3ca200;
        box-shadow: 0 0 0 0.2rem rgba(60, 162, 0, 0.25);
    }

    .badge {
        border-radius: 6px;
        font-size: 0.875rem;
    }
</style>
@endpush
