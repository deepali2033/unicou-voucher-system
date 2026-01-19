@extends('freelancer.layouts.app')

@section('title', 'Update Booking')
@section('page-title', 'Update Booking Status & Price')

@section('page-actions')
<div class="btn-toolbar" role="toolbar">
    <div class="btn-group me-2" role="group">
        <a href="{{ route('freelancer.book-services.show', $bookService) }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Details
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 koa-tb-card">
            <div class="card-header border-0 koa-card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit text-warning me-2"></i>
                    Update Booking Status & Price
                </h5>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                <form method="POST" action="{{ route('freelancer.book-services.update', $bookService) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label fw-medium">
                                <i class="fas fa-flag me-1 text-muted"></i>Booking Status
                                <span class="text-danger">*</span>
                            </label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">Select Status</option>
                                <option value="pending" {{ old('status', $bookService->status) == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="confirmed" {{ old('status', $bookService->status) == 'confirmed' ? 'selected' : '' }}>
                                    Confirmed
                                </option>
                                <option value="in_progress" {{ old('status', $bookService->status) == 'in_progress' ? 'selected' : '' }}>
                                    In Progress
                                </option>
                                <option value="completed" {{ old('status', $bookService->status) == 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>
                                <option value="cancelled" {{ old('status', $bookService->status) == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Update the status to keep the customer informed about their booking progress.
                            </small>
                        </div>

                        <!-- Price -->
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-medium">
                                <i class="fas fa-dollar-sign me-1 text-muted"></i>Service Price
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number"
                                       name="price"
                                       id="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', $bookService->price) }}"
                                       min="0"
                                       max="999999.99"
                                       step="0.01"
                                       placeholder="0.00">
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Set the final price for this service booking (optional).
                            </small>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('freelancer.book-services.show', $bookService) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Update Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Current Booking Info -->
        <div class="card shadow-sm border-0 koa-tb-card mb-4">
            <div class="card-header border-0 koa-card-header">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle text-info me-2"></i>
                    Current Booking Info
                </h6>
            </div>
            <div class="card-body p-3 koa-tb-cnt">
                <div class="mb-3">
                    <strong class="text-muted d-block mb-1">Customer:</strong>
                    <span class="text-dark">{{ $bookService->customer_name }}</span>
                </div>
                <div class="mb-3">
                    <strong class="text-muted d-block mb-1">Service:</strong>
                    <span class="text-dark">{{ $bookService->service_name }}</span>
                </div>
                <div class="mb-3">
                    <strong class="text-muted d-block mb-1">Booking Date:</strong>
                    <span class="text-dark">{{ $bookService->booking_date->format('F d, Y') }}</span>
                    @if($bookService->booking_time)
                        <br><small class="text-muted">{{ \Carbon\Carbon::parse($bookService->booking_time)->format('g:i A') }}</small>
                    @endif
                </div>
                <div class="mb-3">
                    <strong class="text-muted d-block mb-1">Current Status:</strong>
                    <span class="badge fw-medium px-3 py-2 {{
                        $bookService->status == 'pending' ? 'koa-badge-yellow' :
                        ($bookService->status == 'confirmed' ? 'koa-badge-blue' :
                        ($bookService->status == 'in_progress' ? 'koa-badge-light-green' :
                        ($bookService->status == 'completed' ? 'koa-badge-green' :
                        'koa-badge-red')))
                    }}">
                        {{ ucfirst(str_replace('_', ' ', $bookService->status)) }}
                    </span>
                </div>
                <div>
                    <strong class="text-muted d-block mb-1">Current Price:</strong>
                    @if($bookService->price)
                        <span class="text-success fw-bold">${{ number_format($bookService->price, 2) }}</span>
                    @else
                        <span class="text-muted">Not set</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Status Guide -->
        <div class="card shadow-sm border-0 koa-tb-card">
            <div class="card-header border-0 koa-card-header">
                <h6 class="mb-0">
                    <i class="fas fa-question-circle text-primary me-2"></i>
                    Status Guide
                </h6>
            </div>
            <div class="card-body p-3 koa-tb-cnt">
                <div class="mb-2">
                    <span class="badge koa-badge-yellow me-2">Pending</span>
                    <small class="text-muted">New booking, needs review</small>
                </div>
                <div class="mb-2">
                    <span class="badge koa-badge-blue me-2">Confirmed</span>
                    <small class="text-muted">Booking accepted and scheduled</small>
                </div>
                <div class="mb-2">
                    <span class="badge koa-badge-light-green me-2">In Progress</span>
                    <small class="text-muted">Service is being performed</small>
                </div>
                <div class="mb-2">
                    <span class="badge koa-badge-green me-2">Completed</span>
                    <small class="text-muted">Service successfully finished</small>
                </div>
                <div>
                    <span class="badge koa-badge-red me-2">Cancelled</span>
                    <small class="text-muted">Booking was cancelled</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
