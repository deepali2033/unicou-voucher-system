@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

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
                                <h5 class="card-title mb-0 text-black text-muted ">Total Services</h5>
                            </div>
                            <div class="col-3 text-center">
                                <span class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['total_services'] }}</span>
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
                                <h5 class="card-title mb-0 text-black text-muted ">Active Services</h5>
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
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h5 class="card-title mb-0 text-black text-muted ">Featured Services</h5>
                            </div>
                            <div class="col-3 text-center">
                                <span class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['featured_services'] }}</span>
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
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h5 class="card-title mb-0 text-black text-muted ">Inactive Services</h5>
                            </div>
                            <div class="col-3 text-center">
                                <span class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['inactive_services'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Jobs Statistics Row -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stats card-stats-r text-white">
                    <div class="card-body">
                        <div class="row pb-3">
                            <div class="icon icon-shape dash-icon-bg">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h5 class="card-title mb-0 text-black text-muted ">Total Jobs</h5>
                            </div>
                            <div class="col-3 text-center">
                                <span class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['total_jobs'] }}</span>
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
                                <h5 class="card-title mb-0 text-black text-muted ">Active Jobs</h5>
                            </div>
                            <div class="col-3 text-center">
                                <span class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['active_jobs'] }}</span>
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
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h5 class="card-title mb-0 text-black text-muted ">Featured Jobs</h5>
                            </div>
                            <div class="col-3 text-center">
                                <span class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['featured_jobs'] }}</span>
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
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h5 class="card-title mb-0 text-black text-muted ">Inactive Jobs</h5>
                            </div>
                            <div class="col-3 text-center">
                                <span class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['inactive_jobs'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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