@extends('admin.layouts.app')

@section('title', 'Booking Details')
@section('page-title', 'Booking Details')

@section('page-actions')
    <a href="{{ route('admin.booked-plans.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to List
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h3 class="card-title mb-0 text-dark fs-4">Booking Information</h3>
                        @php
                            $statusClasses = [
                                'success' => 'koa-badge-green',
                                'pending' => 'koa-badge-yellow',
                                'failed' => 'koa-badge-red'
                            ];
                            $statusIcons = [
                                'success' => 'fa-check',
                                'pending' => 'fa-clock',
                                'failed' => 'fa-times'
                            ];
                        @endphp
                        <span class="btn btn-sm fw-medium rounded-pill px-3 {{ $statusClasses[$booking->status] }}">
                            <i class="fas {{ $statusIcons[$booking->status] }} me-1"></i>
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Booking ID</label>
                                <div class="p-2 bg-light rounded">
                                    <code class="text-primary">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</code>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Booking Date</label>
                                <div class="p-2 bg-light rounded">
                                    {{ $booking->formatted_booking_date }}
                                    <small class="text-muted d-block">{{ $booking->booking_date->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Amount Paid</label>
                                <div class="p-2 bg-light rounded">
                                    <span class="fw-bold text-success fs-5">{{ $booking->formatted_amount }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Payment Method</label>
                                <div class="p-2 bg-light rounded text-capitalize">
                                    {{ str_replace('_', ' ', $booking->payment_method) }}
                                </div>
                            </div>
                        </div>
                        @if($booking->transaction_id)
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">Transaction ID</label>
                                <div class="p-2 bg-light rounded">
                                    <code class="text-info">{{ $booking->transaction_id }}</code>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Status Update Actions (only for pending status) -->
            @if($booking->status === 'pending')
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header border-0">
                    <h3 class="card-title mb-0 text-dark fs-5 p-3">Update Status</h3>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <form action="{{ route('admin.booked-plans.update-status', $booking) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="success">
                                <button type="submit" class="btn koa-badge-green fw-medium w-100"
                                        onclick="return confirm('Mark this booking as successful?')">
                                    <i class="fas fa-check me-2"></i>Mark as Success
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('admin.booked-plans.update-status', $booking) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="failed">
                                <button type="submit" class="btn koa-badge-red-outline fw-medium w-100"
                                        onclick="return confirm('Mark this booking as failed?')">
                                    <i class="fas fa-times me-2"></i>Mark as Failed
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- User Information -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header border-0">
                    <h3 class="card-title mb-0 text-dark fs-5 p-3">Customer Information</h3>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                            style="width: 60px; height: 60px; background-color: #E8F5D3;">
                            <i class="fas fa-user fa-2x text-success"></i>
                        </div>
                        <h5 class="text-dark mb-1">{{ $booking->user->name }}</h5>
                        <p class="text-muted mb-0">{{ $booking->user->email }}</p>
                    </div>
                    <hr>
                    <div class="row g-2 text-sm">
                        <div class="col-6 text-muted">Member Since:</div>
                        <div class="col-6">{{ $booking->user->created_at->format('M Y') }}</div>
                        <div class="col-6 text-muted">Total Bookings:</div>
                        <div class="col-6">{{ $booking->user->bookedPlans()->count() }}</div>
                    </div>
                </div>
            </div>

            <!-- Plan Information -->
            <div class="card shadow-sm border-0">
                <div class="card-header border-0">
                    <h3 class="card-title mb-0 text-dark fs-5 p-3">Plan Details</h3>
                </div>
                <div class="card-body p-4">
                    @if($booking->plan->image)
                        <img src="{{ asset('storage/' . $booking->plan->image) }}" alt="{{ $booking->plan->name }}"
                            class="img-fluid rounded mb-3 w-100" style="height: 200px; object-fit: cover;">
                    @endif
                    <h5 class="text-dark mb-2">{{ $booking->plan->name }}</h5>
                    <p class="text-muted mb-3">{{ $booking->plan->description }}</p>

                    <hr>

                    <div class="row g-2 text-sm">
                        <div class="col-6 text-muted">Original Price:</div>
                        <div class="col-6">{{ $booking->plan->formatted_price }}</div>

                        @if($booking->plan->hasDiscount())
                        <div class="col-6 text-muted">Discount:</div>
                        <div class="col-6">
                            @if($booking->plan->discount_type === 'percentage')
                                {{ $booking->plan->discount_value }}%
                            @else
                                {{ $booking->plan->formatted_discount }}
                            @endif
                        </div>
                        <div class="col-6 text-muted">Final Price:</div>
                        <div class="col-6 fw-bold text-success">{{ $booking->plan->formatted_discounted_price }}</div>
                        @endif

                        <div class="col-6 text-muted">Plan Status:</div>
                        <div class="col-6">
                            <span class="badge {{ $booking->plan->is_active ? 'koa-badge-green' : 'koa-badge-red' }}">
                                {{ $booking->plan->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>

                    <div class="d-grid mt-3">
                        <a href="{{ route('admin.plans.show', $booking->plan) }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-external-link-alt me-1"></i>View Plan Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
