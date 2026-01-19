@extends('freelancer.layouts.app')

@section('title', 'Service Bookings')
@section('page-title', 'Service Bookings')

@section('content')
    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">Bookings for My Services</h3>
                <div class="card-tools d-flex align-items-center gap-3">
                    <span class="badge koa-badge-green fw-bold px-3 py-2">
                        {{ $bookServices->total() }} Total bookings
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('freelancer.book-services.index') }}" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text"
                                   name="search"
                                   class="form-control border-0 bg-light"
                                   placeholder="Search by customer name or email..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select border-0 bg-light">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn koa-badge-green fw-medium px-3">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            @if(request()->hasAny(['search', 'status']))
                                <a href="{{ route('freelancer.book-services.index') }}" class="btn btn-outline-secondary px-3" title="Clear filters">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

            @if(request()->hasAny(['search', 'status']))
                <div class="alert alert-info d-flex align-items-center mb-3" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>
                        Showing filtered results
                        @if(request('search'))
                            for "<strong>{{ request('search') }}</strong>"
                        @endif
                        @if(request('status'))
                            with status "<strong>{{ ucfirst(request('status')) }}</strong>"
                        @endif
                        ({{ $bookServices->total() }} {{ Str::plural('result', $bookServices->total()) }} found)
                    </div>
                </div>
            @endif

            @if($bookServices->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Customer</th>
                                <th>Service</th>
                                <th>Booking Date</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookServices as $booking)
                                <tr class="border-bottom">
                                    <td>
                                        <div>
                                            <div class="fw-bold text-dark mb-1">{{ $booking->customer_name }}</div>
                                            <small class="text-muted">
                                                <i class="fas fa-envelope me-1"></i>{{ $booking->email }}
                                            </small>
                                            @if($booking->phone)
                                                <br><small class="text-muted">
                                                    <i class="fas fa-phone me-1"></i>{{ $booking->phone }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-dark fw-medium">{{ $booking->service_name }}</div>
                                        @if($booking->service)
                                            <small class="text-muted">ID: {{ $booking->service->id }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-dark fw-medium">{{ $booking->booking_date->format('M d, Y') }}</div>
                                        @if($booking->booking_time)
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->price)
                                            <span class="text-success fw-bold">${{ number_format($booking->price, 2) }}</span>
                                        @else
                                            <span class="text-muted">Not set</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge fw-medium px-3 py-2 {{
                                            $booking->status == 'pending' ? 'koa-badge-yellow' :
                                            ($booking->status == 'confirmed' ? 'koa-badge-blue' :
                                            ($booking->status == 'in_progress' ? 'koa-badge-light-green' :
                                            ($booking->status == 'completed' ? 'koa-badge-green' :
                                            'koa-badge-red')))
                                        }}">
                                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-dark">{{ $booking->created_at->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $booking->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog me-1"></i>Actions
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('freelancer.book-services.show', $booking->id) }}">
                                                        <i class="fas fa-eye me-2 text-info"></i>View Details
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('freelancer.book-services.edit', $booking->id) }}">
                                                        <i class="fas fa-edit me-2 text-warning"></i>Update Status/Price
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $bookServices->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                    <h4 class="text-muted mb-3">No Service Bookings Yet</h4>
                    <p class="text-muted mb-4">
                        @if(request()->hasAny(['search', 'status']))
                            No bookings found matching your search criteria.<br>
                            Try adjusting your filters or search terms.
                        @else
                            You haven't received any bookings for your services yet.<br>
                            Make sure your services are active and properly configured.
                        @endif
                    </p>
                    @if(!request()->hasAny(['search', 'status']))
                        <a href="{{ route('freelancer.services.index') }}" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Manage My Services
                        </a>
                    @else
                        <a href="{{ route('freelancer.book-services.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Clear Filters
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
