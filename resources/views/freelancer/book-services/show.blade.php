@extends('freelancer.layouts.app')

@section('title', 'Booking Details')
@section('page-title', 'Service Booking Details')

@section('page-actions')
<div class="btn-toolbar" role="toolbar">
    <div class="btn-group me-2" role="group">
        <a href="{{ route('freelancer.book-services.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Bookings
        </a>
        <a href="{{ route('freelancer.book-services.edit', $bookService) }}" class="btn btn-warning">
            <i class="fas fa-edit me-1"></i> Update Status/Price
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Service Details -->
        <div class="koa-tb-card bg-grey mb-4">
            <div class="koa-card-header">
                <h5 class="card-title mb-0">Service Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <strong class="text-muted me-2">Service:</strong>
                            <span>{{ $bookService->service_name }}</span>
                        </div>
                    </div>
                    @if($bookService->frequency)
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <strong class="text-muted me-2">Frequency:</strong>
                            <span>{{ ucfirst($bookService->frequency) }}</span>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <strong class="text-muted me-2">Bedrooms:</strong>
                            <span>{{ $bookService->bedrooms }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <strong class="text-muted me-2">Bathrooms:</strong>
                            <span>{{ $bookService->bathrooms }}</span>
                        </div>
                    </div>
                    @if($bookService->square_feet)
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <strong class="text-muted me-2">Square Feet:</strong>
                            <span>{{ $bookService->square_feet }}</span>
                        </div>
                    </div>
                    @endif
                    @if($bookService->extras)
                    <div class="col-12">
                        <div>
                            <strong class="text-muted me-2">Extras:</strong>
                            <span>{{ $bookService->extras }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Customer Details -->
        <div class="koa-tb-card bg-grey mb-4">
            <div class="koa-card-header">
                <h5 class="card-title mb-0">Customer Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <strong class="text-muted me-2">Name:</strong>
                            <span>{{ $bookService->customer_name }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <strong class="text-muted me-2">Email:</strong>
                            <a href="mailto:{{ $bookService->email }}" class="text-primary">{{ $bookService->email }}</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <strong class="text-muted me-2">Phone:</strong>
                            <a href="tel:{{ $bookService->phone }}" class="text-primary">{{ $bookService->phone }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Address Details -->
        <div class="koa-tb-card bg-grey mb-4">
            <div class="koa-card-header">
                <h5 class="card-title mb-0">Service Address</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div>
                            <strong class="text-muted d-block mb-1">Address:</strong>
                            <div>{{ $bookService->street_address }}</div>
                            <div>{{ $bookService->city }}, {{ $bookService->state }} {{ $bookService->zip_code }}</div>
                        </div>
                    </div>
                    @if($bookService->parking_info)
                    <div class="col-12">
                        <div>
                            <strong class="text-muted d-block mb-1">Parking Information:</strong>
                            <div>{{ $bookService->parking_info }}</div>
                        </div>
                    </div>
                    @endif
                    @if($bookService->entrance_info)
                    <div class="col-12">
                        <div>
                            <strong class="text-muted d-block mb-1">Entrance Information:</strong>
                            <div>{{ $bookService->entrance_info }}</div>
                        </div>
                    </div>
                    @endif
                    @if($bookService->pets)
                    <div class="col-12">
                        <div>
                            <strong class="text-muted d-block mb-1">Pets:</strong>
                            <div>{{ $bookService->pets }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Special Instructions -->
        @if($bookService->special_instructions)
        <div class="koa-tb-card bg-grey mb-4">
            <div class="koa-card-header">
                <h5 class="card-title mb-0">Special Instructions</h5>
            </div>
            <div class="card-body">
                <div class="text-muted">{{ $bookService->special_instructions }}</div>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <!-- Booking Status -->
        <div class="koa-tb-card bg-grey mb-4">
            <div class="koa-card-header">
                <h6 class="mb-0">Booking Status</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <span class="badge fw-medium px-4 py-3 fs-6 {{
                        $bookService->status == 'pending' ? 'koa-badge-yellow' :
                        ($bookService->status == 'confirmed' ? 'koa-badge-blue' :
                        ($bookService->status == 'in_progress' ? 'koa-badge-light-green' :
                        ($bookService->status == 'completed' ? 'koa-badge-green' :
                        'koa-badge-red')))
                    }}">
                        {{ ucfirst(str_replace('_', ' ', $bookService->status)) }}
                    </span>
                </div>
                <div class="d-grid">
                    <a href="{{ route('freelancer.book-services.edit', $bookService) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Update Status
                    </a>
                </div>
            </div>
        </div>

        <!-- Booking Summary -->
        <div class="koa-tb-card bg-grey mb-4">
            <div class="koa-card-header">
                <h6 class="mb-0">Booking Summary</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong class="text-muted d-block mb-1">Booking Date:</strong>
                    <span class="text-dark">{{ $bookService->booking_date->format('F d, Y') }}</span>
                    @if($bookService->booking_time)
                        <br><small class="text-muted">{{ \Carbon\Carbon::parse($bookService->booking_time)->format('g:i A') }}</small>
                    @endif
                </div>

                @if($bookService->flexible_time)
                <div class="mb-3">
                    <strong class="text-muted d-block mb-1">Time Flexibility:</strong>
                    <span class="text-dark">{{ $bookService->flexible_time }}</span>
                </div>
                @endif

                <div class="mb-3">
                    <strong class="text-muted d-block mb-1">Price:</strong>
                    @if($bookService->price)
                        <span class="text-success fw-bold fs-5">${{ number_format($bookService->price, 2) }}</span>
                    @else
                        <span class="text-muted">Not set yet</span>
                        <div class="mt-1">
                            <a href="{{ route('freelancer.book-services.edit', $bookService) }}" class="btn btn-sm btn-outline-warning">
                                Set Price
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <strong class="text-muted d-block mb-1">Created:</strong>
                    <span class="text-dark">{{ $bookService->created_at->format('M d, Y') }}</span><br>
                    <small class="text-muted">{{ $bookService->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="koa-tb-card bg-grey">
            <div class="koa-card-header">
                <h6 class="mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $bookService->email }}?subject=Regarding your service booking ({{ $bookService->service_name }})"
                       class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-envelope me-1"></i> Email Customer
                    </a>
                    <a href="tel:{{ $bookService->phone }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-phone me-1"></i> Call Customer
                    </a>
                    @if($bookService->service)
                    <a href="{{ route('freelancer.services.show', $bookService->service) }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-cog me-1"></i> View Service Details
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
