@extends('admin.layouts.app')

@section('title', 'Book Service Details')
@section('page-title', 'Book Service Details')

@section('page-actions')
<div class="btn-toolbar" role="toolbar">
    <div class="btn-group me-2" role="group">
        <a href="{{ route('admin.book-services.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to List
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
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <strong class="text-muted me-2">Extras:</strong>
                            <span>{{ $bookService->extras }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Customer Information -->
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
                    <div class="col-md-6">
                        <div class="d-flex flex-column">
                            <strong class="text-muted mb-1">Address:</strong>
                            <span>{{ $bookService->street_address }}</span>
                            <span>{{ $bookService->city }}, {{ $bookService->state }} {{ $bookService->zip_code }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Details -->
        <div class="koa-tb-card bg-grey mb-4">
            <div class="koa-card-header">
                <h5 class="card-title mb-0">Booking Details</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @if($bookService->booking_date)
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <strong class="text-muted me-2">Preferred Date:</strong>
                            <span>{{ $bookService->booking_date->format('F d, Y') }}</span>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <strong class="text-muted me-2">Preferred Time:</strong>
                                <span>{{ $bookService->booking_time ?? 'Flexible' }}</span>
                            </div>
                            @if($bookService->flexible_time)
                                <small class="text-muted mt-1">(Flexible timing requested)</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Special Requirements -->
        <div class="koa-tb-card bg-grey mb-4">
            <div class="koa-card-header">
                <h5 class="card-title mb-0">Special Requirements</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @if($bookService->parking_info)
                    <div class="col-md-6">
                        <div class="d-flex flex-column">
                            <strong class="text-muted mb-1">Parking Info:</strong>
                            <span>{{ $bookService->parking_info }}</span>
                        </div>
                    </div>
                    @endif
                    @if($bookService->entrance_info)
                    <div class="col-md-6">
                        <div class="d-flex flex-column">
                            <strong class="text-muted mb-1">Entrance Info:</strong>
                            <span>{{ $bookService->entrance_info }}</span>
                        </div>
                    </div>
                    @endif
                    @if($bookService->pets)
                    <div class="col-md-12">
                        <div class="d-flex flex-column">
                            <strong class="text-muted mb-1">Pets:</strong>
                            <span>{{ $bookService->pets }}</span>
                        </div>
                    </div>
                    @endif
                    @if($bookService->special_instructions)
                    <div class="col-md-12">
                        <div class="d-flex flex-column">
                            <strong class="text-muted mb-1">Special Instructions:</strong>
                            <span>{{ $bookService->special_instructions }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                @if(!$bookService->parking_info && !$bookService->entrance_info && !$bookService->pets && !$bookService->special_instructions)
                    <p class="text-muted mb-0">No special requirements specified</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Status Management -->
        <div class="koa-tb-card bg-grey mb-4">
            <div class="koa-card-header">
                <h5 class="card-title mb-0">Status Management</h5>
            </div>
            <div class="card-body">
                <!-- Current Status Display -->
                <div class="mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <strong class="text-muted">Current Status:</strong>
                        @php
                            $status = $bookService->status ?? 'pending';
                            $badgeClass = match($status) {
                                'confirmed' => 'koa-badge-green',
                                'in_progress' => 'koa-badge-yellow',
                                'completed' => 'koa-badge-blue',
                                'cancelled' => 'koa-badge-red',
                                default => 'koa-badge-grey'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                    </div>
                </div>

                <form action="{{ route('admin.book-services.update-status', $bookService) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="status" class="form-label">Update Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending" {{ ($bookService->status ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ ($bookService->status ?? 'pending') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="in_progress" {{ ($bookService->status ?? 'pending') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ ($bookService->status ?? 'pending') === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ ($bookService->status ?? 'pending') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-t-g w-100">
                        <i class="fas fa-save me-1"></i>Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Pricing Information -->
        <div class="koa-tb-card bg-grey mb-4">
            <div class="koa-card-header">
                <h5 class="card-title mb-0">Pricing</h5>
            </div>
            <div class="card-body text-center">
                @if($bookService->price)
                    <h4 class="text-success mb-0">${{ number_format($bookService->price, 2) }}</h4>
                    <small class="text-muted">Service Price</small>
                @else
                    <p class="text-muted mb-0">
                        <i class="fas fa-dollar-sign text-muted me-1"></i>
                        Price not set
                    </p>
                @endif
            </div>
        </div>

        <!-- Request Timeline -->
        <div class="koa-tb-card bg-grey">
            <div class="koa-card-header">
                <h5 class="card-title mb-0">Timeline</h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-plus-circle text-primary me-2"></i>
                            <strong class="text-dark">Request Submitted</strong>
                        </div>
                        <small class="text-muted ms-4">{{ $bookService->created_at->format('F d, Y \a\t H:i A') }}</small>
                    </div>

                    @if($bookService->updated_at != $bookService->created_at)
                    <div class="d-flex flex-column mt-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-edit text-info me-2"></i>
                            <strong class="text-dark">Last Updated</strong>
                        </div>
                        <small class="text-muted ms-4">{{ $bookService->updated_at->format('F d, Y \a\t H:i A') }}</small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
