@extends('freelancer.layouts.app')

@section('sidebar')
    @parent
    <li class="nav-item">
        <a class="nav-link" href="{{ route('freelancer.applied-jobs.index') }}">
            <i class="fas fa-briefcase"></i>
            <span>Applied Jobs</span>
        </a>
    </li>
@endsection

@section('title', 'Freelancer Dashboard')
@section('page-title', 'Freelancer Dashboard')

@section('content')
    <div class="dash-card-bg">
        <div class="row">
            <!-- Stats Cards -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stats card-stats-r text-white">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="icon icon-shape dash-icon-bg">
                                <i class="fas fa-broom"></i>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h5 class="card-title mb-0 text-black text-muted ">Active Job Posts</h5>
                            </div>
                            <div class="col-3 text-center">
                                <span class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['active_jobs'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stats card-stats-r text-white">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="icon icon-shape dash-icon-bg">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h5 class="card-title mb-0 text-black text-muted ">Freelancers Hired</h5>
                            </div>
                            <div class="col-3 text-center">
                                <span class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['active_services'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stats card-stats-l text-white">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="icon icon-shape dash-icon-bg">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h5 class="card-title mb-0 text-black text-muted ">Applied Jobs</h5>
                            </div>
                            <div class="col-3 text-center">
                                <span class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['applied_jobs_count'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stats card-stats-l text-white">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="icon icon-shape dash-icon-bg">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h5 class="card-title mb-0 text-black text-muted ">Ongoing Contracts</h5>
                            </div>
                            <div class="col-3 text-center">
                                <span class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['inactive_services'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
    </div>

    <!-- Latest Applied Jobs Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 koa-tb-card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                        <h3 class="card-title mb-0 text-dark fs-4">Latest Applied Jobs</h3>
                        <div class="card-tools">
                            <a href="{{ route('freelancer.applied-jobs.index') }}"
                               class="btn btn-t-g">
                                <i class="fas fa-list me-2"></i>View All Applications
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 koa-tb-cnt">
                    @if($latestAppliedJobs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless align-middle">
                                <thead>
                                    <tr>
                                        <th class="ps-4">Position</th>
                                        <th>Job Title</th>
                                        <th>Applied Date</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestAppliedJobs as $appliedJob)
                                        <tr>
                                            <td class="ps-4">
                                                <div>
                                                    <strong class="text-dark">{{ $appliedJob->position_applied ?: 'Not Specified' }}</strong>
                                                </div>
                                            </td>
                                            <td>
                                                @if($appliedJob->jobListing)
                                                    <div>
                                                        <a href="{{ route('jobs.show', $appliedJob->jobListing->slug) }}"
                                                           class="text-decoration-none" target="_blank">
                                                            <strong class="text-dark">{{ $appliedJob->jobListing->title }}</strong>
                                                        </a>
                                                        @if($appliedJob->jobListing->location)
                                                            <br>
                                                            <small class="text-muted">
                                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                                {{ $appliedJob->jobListing->location }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-muted">General Application</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <strong class="text-dark">{{ $appliedJob->applied_at->format('M d, Y') }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $appliedJob->applied_at->diffForHumans() }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge fw-medium px-3 py-2 {{
                                                    $appliedJob->status == 'pending' ? 'koa-badge-yellow' :
                                                    ($appliedJob->status == 'under_review' ? 'koa-badge-blue' :
                                                    ($appliedJob->status == 'interview_scheduled' ? 'koa-badge-light-green' :
                                                    ($appliedJob->status == 'selected' ? 'koa-badge-green' :
                                                    ($appliedJob->status == 'rejected' ? 'koa-badge-red' : 'koa-badge-light-green'))))
                                                }}">
                                                    <i class="fas {{
                                                        $appliedJob->status == 'pending' ? 'fa-clock' :
                                                        ($appliedJob->status == 'under_review' ? 'fa-search' :
                                                        ($appliedJob->status == 'interview_scheduled' ? 'fa-calendar-check' :
                                                        ($appliedJob->status == 'selected' ? 'fa-check-circle' :
                                                        ($appliedJob->status == 'rejected' ? 'fa-times-circle' : 'fa-circle'))))
                                                    }} me-1"></i>
                                                    {{ ucwords(str_replace('_', ' ', $appliedJob->status)) }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group" role="group" style="gap: 8px;">
                                                    <a href="{{ route('freelancer.applied-jobs.show', $appliedJob->id) }}"
                                                       class="btn btn-sm rounded-circle action-btns koa-badge-light-green"
                                                       title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Footer with total count -->
                        <div class="text-center mt-3 py-2">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Showing {{ $latestAppliedJobs->count() }} of {{ $stats['applied_jobs_count'] }} total applications
                            </small>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                            <h4 class="text-dark">No Applications Found</h4>
                            <p class="text-muted mb-4">
                                You haven't submitted any job applications yet. Start your job search now!
                            </p>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('jobs.index') }}" class="btn btn-t-g px-4 py-2">
                                    <i class="fas fa-search me-2"></i>Browse Available Jobs
                                </a>
                                <a href="{{ route('freelancer.applied-jobs.create') }}"
                                   class="btn fw-medium px-4 py-2"
                                   style="background-color: #3ca200; color: #fff;">
                                    <i class="fas fa-plus me-2"></i>Apply for Your First Job
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

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

        .badge {
            border-radius: 6px;
            font-size: 0.875rem;
        }
    </style>

    <!-- <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="d-grid">
                                <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-plus me-2"></i>
                                    Add New Service
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-grid">
                                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary btn-lg">
                                    <i class="fas fa-list me-2"></i>
                                    Manage Services
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-grid">
                                <a href="{{ route('admin.jobs.create') }}" class="btn btn-success btn-lg">
                                    <i class="fas fa-plus me-2"></i>
                                    Add New Job
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-grid">
                                <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-success btn-lg">
                                    <i class="fas fa-briefcase me-2"></i>
                                    Manage Jobs
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-grid">
                                <a href="{{ route('services.index') }}" target="_blank"
                                    class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-external-link-alt me-2"></i>
                                    View Services Page
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-grid">
                                <a href="{{ route('jobs.index') }}" target="_blank" class="btn btn-outline-info btn-lg">
                                    <i class="fas fa-external-link-alt me-2"></i>
                                    View Jobs Page
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Welcome to KOA Services Admin Panel</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Welcome to your admin dashboard! Here you can manage all aspects of your cleaning services business.
                    </p>
                    <h5>Getting Started:</h5>
                    <ul>
                        <li><strong>Services Management:</strong> Add, edit, and manage your cleaning services</li>
                        <li><strong>Jobs Management:</strong> Create and manage job listings for recruitment</li>
                        <li><strong>Dynamic Content:</strong> All content is dynamically displayed on your website</li>
                        <li><strong>SEO Friendly:</strong> Each service and job has its own SEO settings</li>
                        <li><strong>Category Management:</strong> Organize jobs by categories for better navigation</li>
                    </ul>

                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Tip:</strong> Make sure to set appropriate sort orders for your services and jobs to control
                        how they appear on your website. Featured items will be highlighted prominently.
                    </div>
                </div>
            </div>
        </div>
    </div> -->
@endsection
