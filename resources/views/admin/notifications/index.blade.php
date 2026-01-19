@extends('admin.layouts.app')

@section('title', 'Notifications')
@section('page-title', 'Notifications')

@section('page-actions')
    <div class="d-flex gap-2">
        @if($unreadCount > 0)
            <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-t-g">
                    <i class="fas fa-check-double me-2"></i>Mark All as Read
                </button>
            </form>
        @endif
        @if($readCount > 0)
            <form action="{{ route('admin.notifications.delete-all-read') }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Are you sure you want to delete all read notifications?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-trash me-2"></i>Delete All Read
                </button>
            </form>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .notification-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        .notification-card:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .notification-card.unread {
            background-color: #f8f9fa;
            border-left-color: #3ca200;
        }
        .notification-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.2rem;
        }
        .stats-card {
            border-radius: 12px;
            transition: transform 0.2s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endpush

@section('content')
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 stats-card">
                <div class="card-body d-flex align-items-center">
                    <div class="notification-icon" style="background-color: #e3f2fd;">
                        <i class="fas fa-bell text-primary"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-muted">Total Notifications</h6>
                        <h3 class="mb-0 fw-bold">{{ $totalCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 stats-card">
                <div class="card-body d-flex align-items-center">
                    <div class="notification-icon" style="background-color: #e8f5e9;">
                        <i class="fas fa-envelope text-success"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-muted">Unread</h6>
                        <h3 class="mb-0 fw-bold">{{ $unreadCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 stats-card">
                <div class="card-body d-flex align-items-center">
                    <div class="notification-icon" style="background-color: #f3e5f5;">
                        <i class="fas fa-envelope-open text-secondary"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-muted">Read</h6>
                        <h3 class="mb-0 fw-bold">{{ $readCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">All Notifications</h3>
                <span class="badge koa-badge-green fw-bold px-3 py-2">
                    {{ $notifications->total() }} {{ Str::plural('Notification', $notifications->total()) }}
                </span>
            </div>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('admin.notifications.index') }}" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text"
                                   name="search"
                                   class="form-control border-0 bg-light"
                                   placeholder="Search notifications..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select border-0 bg-light">
                            <option value="">All Status</option>
                            <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="type" class="form-select border-0 bg-light">
                            <option value="">All Types</option>
                            <option value="user" {{ request('type') == 'user' ? 'selected' : '' }}>Users</option>
                            <option value="service" {{ request('type') == 'service' ? 'selected' : '' }}>Services</option>
                            <option value="job" {{ request('type') == 'job' ? 'selected' : '' }}>Jobs</option>
                            <option value="plan" {{ request('type') == 'plan' ? 'selected' : '' }}>Plans</option>
                            <option value="subscription" {{ request('type') == 'subscription' ? 'selected' : '' }}>Subscriptions</option>
                            <option value="quote" {{ request('type') == 'quote' ? 'selected' : '' }}>Quotes</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn koa-badge-green fw-medium px-3">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            @if(request()->hasAny(['search', 'status', 'type']))
                                <a href="{{ route('admin.notifications.index') }}" class="btn btn-outline-secondary px-3" title="Clear filters">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

            @if($notifications->isEmpty())
                <div class="text-center py-5">
                    <div class="notification-icon mx-auto mb-3" style="background-color: #f8f9fa; width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-bell-slash text-muted"></i>
                    </div>
                    <h5 class="text-muted">No notifications found</h5>
                    <p class="text-muted">System notifications will appear here when actions occur.</p>
                </div>
            @else
                <!-- Notifications List -->
                <div class="notifications-list">
                    @foreach($notifications as $notification)
                        <div class="card notification-card mb-3 {{ !$notification->is_read ? 'unread' : '' }}">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="notification-icon {{ $notification->badge_color }} bg-opacity-10">
                                            <i class="{{ $notification->icon }} {{ str_replace('bg-', 'text-', $notification->badge_color) }}"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1 fw-bold">
                                                    {{ $notification->title }}
                                                    @if(!$notification->is_read)
                                                        <span class="badge koa-badge-green ms-2">New</span>
                                                    @endif
                                                </h6>
                                                <p class="mb-1 text-muted">{{ $notification->description }}</p>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $notification->created_at->diffForHumans() }}
                                                    <span class="mx-2">•</span>
                                                    {{ $notification->created_at->format('M d, Y \a\t g:i A') }}
                                                </small>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    @if(!$notification->is_read)
                                                        <li>
                                                            <form action="{{ route('admin.notifications.mark-read', $notification) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="fas fa-check me-2"></i>Mark as Read
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endif
                                                    {{-- <li>
                                                        <a class="dropdown-item" href="{{ route('admin.notifications.edit', $notification) }}">
                                                            <i class="fas fa-edit me-2"></i>Edit
                                                        </a>
                                                    </li> --}}
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form action="{{ route('admin.notifications.destroy', $notification) }}" method="POST"
                                                              onsubmit="return confirm('Are you sure you want to delete this notification?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fas fa-trash me-2"></i>Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
