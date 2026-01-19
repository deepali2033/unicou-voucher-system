@extends('admin.layouts.app')

@section('title', 'Plan Details')
@section('page-title', 'Plan Details: ' . $plan->name)

@section('page-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.plans.edit', $plan) }}" class="btn btn-t-g">
            <i class="fas fa-edit me-2"></i>Edit Plan
        </a>
        <a href="{{ route('admin.plans.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Plans
        </a>
    </div>
@endsection

@push('styles')
    <style>
        .plan-image {
            max-width: 300px;
            max-height: 300px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .detail-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        .detail-value {
            font-size: 1.1rem;
            color: #212529;
            margin-bottom: 1.5rem;
        }
        .price-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: #3ca200;
        }
        .original-price {
            font-size: 1.5rem;
            color: #6c757d;
            text-decoration: line-through;
        }
        .discount-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        .plan-description {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid #3ca200;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <!-- Plan Image -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h5 class="mb-0 text-dark">Plan Image</h5>
                </div>
                <div class="card-body text-center">
                    @if($plan->image)
                        @php
                            $imagePath = asset('storage/' . $plan->image);
                            $publicImagePath = public_path('storage/' . $plan->image);
                            $imageExists = file_exists($publicImagePath);
                        @endphp
                        @if($imageExists)
                            <img src="{{ $imagePath }}"
                                 alt="{{ $plan->name }}"
                                 class="plan-image img-fluid"
                                 onerror="this.parentElement.innerHTML='<div class=\'d-flex align-items-center justify-content-center\' style=\'height: 200px; background-color: #f8f9fa; border-radius: 12px;\'><div class=\'text-center\'><i class=\'fas fa-exclamation-triangle fa-3x text-warning mb-3\'></i><p class=\'text-muted\'>Image not found</p><p class=\'small text-muted\'>{{ basename($plan->image) }}</p></div></div>'">
                        @else
                            <div class="d-flex align-items-center justify-content-center" style="height: 200px; background-color: #fff3cd; border-radius: 12px; border: 1px solid #ffeaa7;">
                                <div class="text-center">
                                    <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                    <p class="text-muted mb-1">Image file missing</p>
                                    <p class="small text-muted">{{ basename($plan->image) }}</p>
                                    <p class="small text-muted mt-2">Expected path: storage/{{ $plan->image }}</p>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="d-flex align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa; border-radius: 12px;">
                            <div class="text-center">
                                <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No image uploaded</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Plan Details -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header" style="background-color: #f8f9fa;">
                    <h5 class="mb-0 text-dark">Plan Information</h5>
                </div>
                <div class="card-body p-4">
                    <!-- Plan Name & Status -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="detail-label">Plan Name</div>
                            <div class="detail-value">{{ $plan->name }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="detail-label">Status</div>
                            <div class="detail-value">
                                @if($plan->is_active)
                                    <span class="badge koa-badge-green">Active</span>
                                @else
                                    <span class="badge koa-badge-yellow">Inactive</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="detail-label">Pricing</div>
                            <div class="d-flex align-items-center gap-3">
                                @if($plan->hasDiscount())
                                    <span class="original-price">${{ number_format($plan->price, 2) }}</span>
                                    <span class="price-display">${{ number_format($plan->discounted_price, 2) }}</span>
                                    <span class="badge discount-badge" style="background-color: #ff6b6b; color: white;">
                                        @if($plan->discount_type === 'percentage')
                                            {{ $plan->discount_value }}% OFF
                                        @else
                                            ${{ number_format($plan->discount_value, 2) }} OFF
                                        @endif
                                    </span>
                                @else
                                    <span class="price-display">${{ number_format($plan->price, 2) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Discount Details (if applicable) -->
                    @if($plan->hasDiscount())
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="detail-label">Discount Type</div>
                                <div class="detail-value">
                                    @if($plan->discount_type === 'percentage')
                                        <span class="badge bg-info">Percentage Discount</span>
                                    @else
                                        <span class="badge bg-warning">Fixed Amount Discount</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-label">Discount Value</div>
                                <div class="detail-value">
                                    @if($plan->discount_type === 'percentage')
                                        {{ $plan->discount_value }}%
                                    @else
                                        ${{ number_format($plan->discount_value, 2) }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="mb-4">
                        <div class="detail-label">Description</div>
                        <div class="plan-description">
                            {!! nl2br(e($plan->description)) !!}
                        </div>
                    </div>

                    <!-- Points-->
                    <div class="mb-4">
                        <div class="detail-label">Points</div>
                        <div class="plan-description">
                            {!! nl2br(e($plan->points)) !!}
                        </div>
                    </div>

                    <!-- Timestamps -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-label">Created</div>
                            <div class="detail-value text-muted">
                                <i class="fas fa-calendar-alt me-2"></i>
                                {{ $plan->created_at->format('M d, Y \a\t g:i A') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-label">Last Updated</div>
                            <div class="detail-value text-muted">
                                <i class="fas fa-clock me-2"></i>
                                {{ $plan->updated_at->format('M d, Y \a\t g:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Plan Actions</h5>
                            <p class="text-muted mb-0">Manage this plan's settings and status</p>
                        </div>
                        <div class="d-flex gap-2">
                            <!-- Toggle Status -->
                            <form action="{{ route('admin.plans.toggle-status', $plan) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                @if($plan->is_active)
                                    <button type="submit" class="btn btn-outline-warning"
                                            onclick="return confirm('Are you sure you want to deactivate this plan?')">
                                        <i class="fas fa-pause me-2"></i>Deactivate
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-outline-success"
                                            onclick="return confirm('Are you sure you want to activate this plan?')">
                                        <i class="fas fa-play me-2"></i>Activate
                                    </button>
                                @endif
                            </form>

                            <!-- Edit Button -->
                            <a href="{{ route('admin.plans.edit', $plan) }}" class="btn btn-t-g">
                                <i class="fas fa-edit me-2"></i>Edit Plan
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this plan? This action cannot be undone.')">
                                    <i class="fas fa-trash me-2"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
