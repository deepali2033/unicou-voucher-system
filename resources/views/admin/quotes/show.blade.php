@extends('admin.layouts.app')

@section('title', 'Quote Details')
@section('page-title', 'Quote Details')

@section('page-actions')
<div class="btn-toolbar">
    <a href="{{ route('admin.quotes.index') }}" class="btn btn-outline-secondary me-2 fw-medium px-3">
        <i class="fas fa-arrow-left me-1"></i> Back to Quotes
    </a>
    <form action="{{ route('admin.quotes.destroy', $quote) }}"
          method="POST"
          class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this quote?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn koa-badge-red-outline fw-medium px-3">
            <i class="fas fa-trash me-1"></i> Delete Quote
        </button>
    </form>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 koa-tb-card">
            <div class="card-header border-0">
                <div class="p-3">
                    <h3 class="card-title mb-0 text-dark fs-4">Quote Information</h3>
                </div>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="fw-bold text-dark mb-2">Name:</label>
                        <p class="text-dark">{{ $quote->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-dark mb-2">Email:</label>
                        <p>
                            <a href="mailto:{{ $quote->email }}" class="text-decoration-none">
                                <span class="badge koa-badge-blue fw-normal px-3 py-2">
                                    {{ $quote->email }}
                                </span>
                            </a>
                        </p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="fw-bold text-dark mb-2">Phone:</label>
                        <p>
                            <a href="tel:{{ $quote->phone }}" class="text-decoration-none">
                                <span class="badge koa-badge-green fw-normal px-3 py-2">
                                    {{ $quote->phone }}
                                </span>
                            </a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-dark mb-2">Total Square Footage:</label>
                        <p>
                            <span class="badge koa-badge-yellow fw-normal px-3 py-2">
                                {{ $quote->total_square_footage }} sq ft
                            </span>
                        </p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <label class="fw-bold text-dark mb-2">Service Requested:</label>
                        <p>
                            @if($quote->service)
                                <span class="badge koa-badge-light-green fw-normal px-3 py-2">{{ $quote->service }}</span>
                            @else
                                <span class="text-muted">Not specified</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="fw-bold text-dark mb-2">Submitted Date:</label>
                        <p class="text-dark">{{ $quote->created_at->format('F d, Y h:i A') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-dark mb-2">Last Updated:</label>
                        <p class="text-dark">{{ $quote->updated_at->format('F d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 koa-tb-card">
            <div class="card-header border-0">
                <div class="p-3">
                    <h3 class="card-title mb-0 text-dark fs-4">User Information</h3>
                </div>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                @if($quote->user)
                    <div class="mb-3">
                        <label class="fw-bold text-dark mb-2">User ID:</label>
                        <p>
                            <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                #{{ $quote->user_id }}
                            </span>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-dark mb-2">User Name:</label>
                        <p class="text-dark">{{ $quote->user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-dark mb-2">User Email:</label>
                        <p>
                            <a href="mailto:{{ $quote->user->email }}" class="text-decoration-none">
                                <span class="badge koa-badge-blue fw-normal px-3 py-2">
                                    {{ $quote->user->email }}
                                </span>
                            </a>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-dark mb-2">Account Type:</label>
                        <p>
                            <span class="badge koa-badge-green fw-normal px-3 py-2">{{ ucfirst($quote->user->account_type) }}</span>
                        </p>
                    </div>
                    <a href="{{ route('admin.users.show', $quote->user) }}" class="btn btn-sm koa-badge-green fw-medium w-100 py-2">
                        <i class="fas fa-user me-1"></i> View User Profile
                    </a>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-user-slash fa-2x text-muted mb-3"></i>
                        <h5 class="text-dark mb-2">No User Account</h5>
                        <p class="text-muted mb-0">Quote submitted as guest</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
