@extends('user.layouts.app')

@section('title', 'Customer Dashboard')
@section('page-title', 'Customer Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="welcome">
                <h2 id="hero-heading" class="greeting"><span class="wave">👋</span> Hi Sarah — welcome back!</h2>
                <p class="subtitle">Ready to book your next cleaner? Post a job and we’ll match verified freelancers nearby.
                </p>

                <div class="cta-row mb-4" role="group" aria-label="Primary actions">
                    <button id="openPostJob" class="btn btn-primary" aria-haspopup="dialog">＋ Post a Cleaning Job</button>
                    <button id="viewJobs" class="btn btn-secondary">View My Jobs</button>
                </div>
            </div> -->
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
                                        <h5 class="card-title mb-0 text-black text-muted ">Active Jobs</h5>
                                    </div>
                                    <div class="col-3 text-center">
                                        <span
                                            class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['active_jobs'] }}</span>
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
                                        <h5 class="card-title mb-0 text-black text-muted ">Services</h5>
                                    </div>
                                    <div class="col-3 text-center">
                                        <span
                                            class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['active_services'] }}</span>
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
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <h5 class="card-title mb-0 text-black text-muted ">Pending Applications</h5>
                                    </div>
                                    <div class="col-3 text-center">
                                        <span
                                            class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['featured_services'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
                                        <span
                                            class="h2 text-black mb-0 fs-3 font-weight-bold">{{ $stats['inactive_services'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>

@endsection
