@extends('admin.layouts.app')

@section('title', 'Reports & Analytics')
@section('page-title', 'Reports & Analytics')

@push('styles')
    <style>
        .stats-card {
            transition: transform 0.2s;
        }
        .stats-card:hover {
            transform: translateY(-2px);
        }
        .chart-container {
            position: relative;
            height: 400px;
            margin: 20px 0;
        }
        .small-chart {
            height: 300px !important;
        }
        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        .metric-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #3ca200;
        }
        .metric-label {
            font-size: 0.9rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .trend-up {
            color: #28a745;
        }
        .trend-down {
            color: #dc3545;
        }
        .section-header {
            border-left: 4px solid #3ca200;
            padding-left: 15px;
            margin: 30px 0 20px 0;
        }
        .koa-analytics-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: none;
        }
    </style>
@endpush

@section('content')
    <!-- Overview Statistics -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="section-header">
                <h3 class="mb-1">Overview</h3>
                <p class="text-muted mb-0">Key platform metrics at a glance</p>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card koa-analytics-card stats-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-users fa-3x mb-3" style="color: #3ca200;"></i>
                    <div class="metric-value">{{ number_format($totalStats['users']) }}</div>
                    <div class="metric-label">Total Users</div>
                    <!-- <small class="text-muted">+{{ $userStats['recent_registrations'] }} this month</small> -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card koa-analytics-card stats-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-broom fa-3x mb-3" style="color: #007bff;"></i>
                    <div class="metric-value">{{ number_format($totalStats['services']) }}</div>
                    <div class="metric-label">Total Services</div>
                    <small class="text-muted">{{ $serviceStats['active'] }} active</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card koa-analytics-card stats-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-briefcase fa-3x mb-3" style="color: #ffc107;"></i>
                    <div class="metric-value">{{ number_format($totalStats['jobs']) }}</div>
                    <div class="metric-label">Total Jobs</div>
                    <small class="text-muted">{{ $jobStats['recent_posts'] }} posted this month</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Growth Trends Chart -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="section-header">
                <h3 class="mb-1">Growth Trends</h3>
                <p class="text-muted mb-0">6-month growth overview</p>
            </div>
        </div>
        <div class="col-12">
            <div class="card koa-analytics-card">
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="growthChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Grid -->
    <div class="row mb-5">
        <!-- User Analytics -->
        <div class="col-lg-6 mb-4">
            <div class="section-header">
                <h3 class="mb-1">User Analytics</h3>
                <p class="text-muted mb-0">User distribution and verification status</p>
            </div>

            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card koa-analytics-card">
                        <div class="card-header">
                            <h5 class="mb-0">User Types Distribution</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container small-chart">
                                <canvas id="userTypesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card koa-analytics-card">
                        <div class="card-header">
                            <h5 class="mb-0">Verification Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container small-chart">
                                <canvas id="userVerificationChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Stats Summary -->
            <div class="card koa-analytics-card mt-3">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="h4 mb-0 text-primary">{{ $userStats['verified_freelancers'] }}</div>
                            <small class="text-muted">Verified Freelancers</small>
                        </div>
                        <div class="col-4">
                            <div class="h4 mb-0 text-warning">{{ $userStats['pending_verifications'] }}</div>
                            <small class="text-muted">Pending Verification</small>
                        </div>
                        <div class="col-4">
                            <div class="h4 mb-0 text-success">{{ $userStats['recent_registrations'] }}</div>
                            <small class="text-muted">New This Month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services Analytics -->
        <div class="col-lg-6 mb-4">
            <div class="section-header">
                <h3 class="mb-1">Services Analytics</h3>
                <p class="text-muted mb-0">Service status and approval analytics</p>
            </div>

            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card koa-analytics-card">
                        <div class="card-header">
                            <h5 class="mb-0">Service Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container small-chart">
                                <canvas id="serviceStatusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card koa-analytics-card">
                        <div class="card-header">
                            <h5 class="mb-0">Approval Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container small-chart">
                                <canvas id="serviceApprovalChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Stats Summary -->
            <div class="card koa-analytics-card mt-3">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="h4 mb-0 text-success">{{ $serviceStats['active'] }}</div>
                            <small class="text-muted">Active Services</small>
                        </div>
                        <div class="col-4">
                            <div class="h4 mb-0 text-warning">{{ $serviceStats['featured'] }}</div>
                            <small class="text-muted">Featured Services</small>
                        </div>
                        <div class="col-4">
                            <div class="h4 mb-0 text-info">{{ $serviceStats['pending_approval'] }}</div>
                            <small class="text-muted">Pending Approval</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jobs Analytics -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="section-header">
                <h3 class="mb-1">Jobs Analytics</h3>
                <p class="text-muted mb-0">Job postings and employment type distribution</p>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card koa-analytics-card">
                <div class="card-header">
                    <h5 class="mb-0">Job Status Distribution</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container small-chart">
                        <canvas id="jobStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card koa-analytics-card">
                <div class="card-header">
                    <h5 class="mb-0">Employment Types</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container small-chart">
                        <canvas id="employmentTypesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Stats Summary -->
        <div class="col-12 mt-3">
            <div class="card koa-analytics-card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-3">
                            <div class="h4 mb-0 text-success">{{ $jobStats['active'] }}</div>
                            <small class="text-muted">Active Jobs</small>
                        </div>
                        <div class="col-3">
                            <div class="h4 mb-0 text-warning">{{ $jobStats['featured'] }}</div>
                            <small class="text-muted">Featured Jobs</small>
                        </div>
                        <div class="col-3">
                            <div class="h4 mb-0 text-info">{{ $jobStats['recent_posts'] }}</div>
                            <small class="text-muted">Posted This Month</small>
                        </div>
                        <div class="col-3">
                            <div class="h4 mb-0 text-secondary">{{ $jobStats['inactive'] }}</div>
                            <small class="text-muted">Inactive Jobs</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="section-header">
                <h3 class="mb-1">Quick Actions</h3>
                <p class="text-muted mb-0">Navigate to management sections</p>
            </div>
        </div>
        <div class="col-12">
            <div class="card koa-analytics-card">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-lg w-100 mb-2">
                                <i class="fas fa-users fa-2x d-block mb-2"></i>
                                Manage Users
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-info btn-lg w-100 mb-2">
                                <i class="fas fa-broom fa-2x d-block mb-2"></i>
                                Manage Services
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-warning btn-lg w-100 mb-2">
                                <i class="fas fa-briefcase fa-2x d-block mb-2"></i>
                                Manage Jobs
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-success btn-lg w-100 mb-2">
                                <i class="fas fa-tachometer-alt fa-2x d-block mb-2"></i>
                                Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Chart configuration
        const chartColors = {
            primary: '#3ca200',
            secondary: '#007bff',
            warning: '#ffc107',
            danger: '#dc3545',
            success: '#28a745',
            info: '#17a2b8',
            light: '#f8f9fa',
            dark: '#343a40'
        };

        // Growth Trends Line Chart
        const growthCtx = document.getElementById('growthChart').getContext('2d');
        new Chart(growthCtx, {
            type: 'line',
            data: {
                labels: @json($growthTrends['months']),
                datasets: [
                    {
                        label: 'Users',
                        data: @json($growthTrends['users']),
                        borderColor: chartColors.primary,
                        backgroundColor: chartColors.primary + '20',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Services',
                        data: @json($growthTrends['services']),
                        borderColor: chartColors.secondary,
                        backgroundColor: chartColors.secondary + '20',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Jobs',
                        data: @json($growthTrends['jobs']),
                        borderColor: chartColors.warning,
                        backgroundColor: chartColors.warning + '20',
                        tension: 0.4,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Platform Growth (Last 6 Months)'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // User Types Pie Chart
        const userTypesCtx = document.getElementById('userTypesChart').getContext('2d');
        const userTypesData = @json($userStats['by_type']);
        new Chart(userTypesCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(userTypesData).map(type => type.charAt(0).toUpperCase() + type.slice(1)),
                datasets: [{
                    data: Object.values(userTypesData),
                    backgroundColor: [
                        chartColors.primary,
                        chartColors.secondary,
                        chartColors.warning,
                        chartColors.info,
                        chartColors.success
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // User Verification Pie Chart
        const userVerificationCtx = document.getElementById('userVerificationChart').getContext('2d');
        const verificationData = @json($distributions['user_verification']);
        new Chart(userVerificationCtx, {
            type: 'doughnut',
            data: {
                labels: ['Verified', 'Pending', 'Rejected', 'Unverified'],
                datasets: [{
                    data: [
                        verificationData.verified,
                        verificationData.pending,
                        verificationData.rejected,
                        verificationData.unverified
                    ],
                    backgroundColor: [
                        chartColors.success,
                        chartColors.warning,
                        chartColors.danger,
                        '#6c757d'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Service Status Pie Chart
        const serviceStatusCtx = document.getElementById('serviceStatusChart').getContext('2d');
        const serviceStatusData = @json($distributions['service_status']);
        new Chart(serviceStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Inactive'],
                datasets: [{
                    data: [serviceStatusData.active, serviceStatusData.inactive],
                    backgroundColor: [chartColors.success, '#6c757d'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Service Approval Pie Chart
        const serviceApprovalCtx = document.getElementById('serviceApprovalChart').getContext('2d');
        const approvalData = @json($distributions['service_approval']);
        new Chart(serviceApprovalCtx, {
            type: 'doughnut',
            data: {
                labels: ['Approved', 'Pending', 'Rejected'],
                datasets: [{
                    data: [approvalData.approved, approvalData.pending, approvalData.rejected],
                    backgroundColor: [chartColors.success, chartColors.warning, chartColors.danger],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Job Status Pie Chart
        const jobStatusCtx = document.getElementById('jobStatusChart').getContext('2d');
        const jobStatusData = @json($distributions['job_status']);
        new Chart(jobStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Inactive'],
                datasets: [{
                    data: [jobStatusData.active, jobStatusData.inactive],
                    backgroundColor: [chartColors.success, '#6c757d'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Employment Types Chart
        const employmentTypesCtx = document.getElementById('employmentTypesChart').getContext('2d');
        const employmentData = @json($jobStats['by_employment_type']);
        new Chart(employmentTypesCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(employmentData).map(type =>
                    type.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ')
                ),
                datasets: [{
                    label: 'Count',
                    data: Object.values(employmentData),
                    backgroundColor: [
                        chartColors.primary,
                        chartColors.secondary,
                        chartColors.warning,
                        chartColors.info,
                        chartColors.success
                    ].slice(0, Object.keys(employmentData).length),
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
@endpush
