@extends('admin.layouts.app')

@section('title', 'Subscribers')
@section('page-title', 'Subscribers Management')

@section('content')
    <!-- Statistics Cards -->
    <!-- <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Total Subscribers</h6>
                                    <h3 class="mb-0 fw-bold text-dark">{{ $totalCount }}</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-users fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Active Subscribers</h6>
                                    <h3 class="mb-0 fw-bold text-success">{{ $activeCount }}</h3>
                                </div>
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-user-check fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Inactive Subscribers</h6>
                                    <h3 class="mb-0 fw-bold text-danger">{{ $inactiveCount }}</h3>
                                </div>
                                <div class="bg-danger bg-opacity-10 p-3 rounded">
                                    <i class="fas fa-user-times fa-2x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0 koa-bg-light-green">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">All Newsletter Subscribers</h3>
                <div class="card-tools d-flex align-items-center gap-3">
                    <a href="{{ route('admin.subscriptions.export', request()->query()) }}"
                        class="btn koa-badge-light-green btn-sm">
                        <i class="fas fa-download me-2"></i>Export to CSV
                    </a>
                    <!-- <span class="badge koa-badge-green fw-bold px-3 py-2">
                                <i class="fas fa-download me-2"></i>Export to CSV
                            </span> -->
                </div>
            </div>
        </div>

        <div class="card-body p-4 koa-tb-cnt">
            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('admin.subscriptions.index') }}" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0"
                                placeholder="Search by email..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn koa-badge-green w-100">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                    </div>
                </div>
            </form>

            @if($subscriptions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Email Address</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Subscribed Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscriptions as $subscription)
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                            #{{ $subscription->id }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-envelope text-muted me-2"></i>
                                            <a href="mailto:{{ $subscription->email }}" class="text-decoration-none text-dark">
                                                <strong>{{ $subscription->email }}</strong>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        @if($subscription->user)
                                            <a href="{{ route('admin.users.show', $subscription->user) }}" class="text-decoration-none">
                                                <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                                    <i class="fas fa-user me-1"></i>{{ $subscription->user->name }}
                                                </span>
                                            </a>
                                        @else
                                            <span class="badge bg-secondary fw-normal px-3 py-2">
                                                <i class="fas fa-user-slash me-1"></i>Guest
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscription->is_active)
                                            <span class="badge bg-success px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i>Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="far fa-calendar me-1"></i>{{ $subscription->created_at->format('M d, Y') }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="far fa-clock me-1"></i>{{ $subscription->created_at->format('h:i A') }}
                                        </small>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group" style="gap: 8px;">
                                            <form action="{{ route('admin.subscriptions.toggle-status', $subscription) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn btn-sm rounded-circle action-btns {{ $subscription->is_active ? 'koa-badge-yellow' : 'koa-badge-green' }}"
                                                    title="{{ $subscription->is_active ? 'Deactivate' : 'Activate' }}">
                                                    <i class="fas fa-{{ $subscription->is_active ? 'ban' : 'check' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.subscriptions.destroy', $subscription) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this subscription?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm rounded-circle action-btns koa-badge-red-outline"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $subscriptions->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-envelope-open-text fa-3x text-muted mb-3"></i>
                    <h4 class="text-dark">No Subscribers Yet</h4>
                    <p class="text-muted">Newsletter subscriptions will appear here once users subscribe.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .koa-tb-card {
            border-radius: 12px;
            overflow: hidden;
        }

        .koa-tb-card .card-header {
            background: #3ca200;
            color: white;
        }

        @media(max-width:430px) {
            .card-header div {
                flex-direction: column;
                gap: 20px;
            }

        }

        .koa-tb-card .card-title {
            color: white;
        }

        .koa-tb-cnt {
            background-color: #fafafa;
        }

        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 15px 10px;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody tr {
            background-color: white;
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .table tbody td {
            padding: 15px 10px;
            vertical-align: middle;
        }

        .action-btns {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            transition: all 0.3s ease;
        }

        .action-btns:hover {
            transform: scale(1.1);
        }

        .koa-badge-green {
            background-color: #3ca200;
            color: white;
            border: none;
        }

        .koa-badge-green:hover {
            background-color: #2d7a00;
            color: white;
        }

        .koa-badge-light-green {
            background-color: #e8f5d3;
            color: #2d7a00;
        }

        .koa-badge-yellow {
            background-color: #ffc107;
            color: white;
        }

        .koa-badge-yellow:hover {
            background-color: #e0a800;
        }

        .koa-badge-red-outline {
            background-color: white;
            color: #dc3545;
            border: 2px solid #dc3545;
        }

        .koa-badge-red-outline:hover {
            background-color: #dc3545;
            color: white;
        }

        .input-group-text {
            border: 1px solid #ced4da;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #3ca200;
            box-shadow: 0 0 0 0.2rem rgba(60, 162, 0, 0.25);
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Auto-submit form when status filter changes
        document.querySelector('select[name="status"]').addEventListener('change', function () {
            this.closest('form').submit();
        });
    </script>
@endpush