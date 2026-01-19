@extends('user.layouts.app')

@section('title', 'My Bookings')
@section('page-title', 'Booked Services')

@section('page-actions')
    <!-- <a href="{{ route('user.book-services.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Book New Service
        </a> -->
@endsection

@section('content')
    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">My Service Bookings</h3>
                <div class="card-tools d-flex align-items-center gap-3">
                    <span class="badge koa-badge-green fw-bold px-3 py-2">
                        {{ $bookings->total() }} Total bookings
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('user.book-services.index') }}" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-0 bg-light"
                                placeholder="Search by customer name or email..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select border-0 bg-light">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed
                            </option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                            </option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn koa-badge-green fw-medium px-3">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            @if(request()->hasAny(['search', 'status']))
                                <a href="{{ route('user.book-services.index') }}" class="btn btn-outline-secondary px-3"
                                    title="Clear filters">
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
                        ({{ $bookings->total() }} {{ Str::plural('result', $bookings->total()) }} found)
                    </div>
                </div>
            @endif
            @if($bookings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Service</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Created</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>
                                        <div>
                                            <strong class="text-dark">{{ $booking->customer_name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $booking->email }}</small>
                                            @if($booking->phone)
                                                <br>
                                                <small class="badge koa-badge-light-green fw-normal px-2 py-1">
                                                    {{ $booking->phone }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong class="text-dark">{{ $booking->service_name }}</strong>
                                            <br>
                                            {{-- <small class="text-muted">
                                                {{ $booking->bedrooms }} beds, {{ $booking->bathrooms }} baths
                                                @if($booking->square_feet)
                                                • {{ $booking->square_feet }} sq ft
                                                @endif
                                            </small> --}}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong class="text-dark">
                                                {{ $booking->booking_date ? $booking->booking_date->format('M d, Y') : 'Not set' }}
                                            </strong>
                                            <br>
                                            <small class="text-muted">{{ $booking->booking_time ?? 'Flexible' }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge fw-normal px-3 py-2
                                                        @if(($booking->status ?? 'pending') === 'pending') koa-badge-light-green
                                                        @elseif($booking->status === 'confirmed') koa-badge-light-green
                                                        @elseif($booking->status === 'in_progress') koa-badge-light-green
                                                        @elseif($booking->status === 'completed') koa-badge-light-green
                                                        @elseif($booking->status === 'cancelled') koa-badge-light-green
                                                        @else koa-badge-light-green @endif">
                                            {{ ucfirst($booking->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($booking->price)
                                            <strong class="text-dark">€{{ number_format($booking->price, 2) }}</strong>
                                        @else
                                            <span class="text-muted">Not set</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $booking->created_at->format('M d, Y') }}
                                            <br>
                                            {{ $booking->created_at->format('H:i A') }}
                                        </small>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group" aria-label="Booking actions">
                                            <a href="{{ route('user.book-services.show', $booking) }}" class="btn btn-sm btn-info"
                                                title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($booking->status === 'pending')
                                                <!-- <a href="{{ route('user.book-services.edit', $booking) }}"
                                                               class="btn btn-sm btn-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a> -->
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $booking->id }}" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $booking->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this book service request from
                                                <strong>{{ $booking->customer_name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form method="POST" action="{{ route('user.book-services.destroy', $booking) }}"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $bookings->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    @if(request()->hasAny(['search', 'status']))
                        <h4 class="text-dark">No Bookings Found</h4>
                        <p class="text-muted">Try adjusting your search or filter criteria.</p>
                        <a href="{{ route('user.book-services.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Clear Filters
                        </a>
                    @else
                        <h4 class="text-dark">You haven't booked any services yet</h4>
                        <p class="text-muted">Click the button above to book your first service.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection