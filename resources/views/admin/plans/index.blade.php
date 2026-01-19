@extends('admin.layouts.app')

@section('title', 'Plans Management')
@section('page-title', 'Plans Management')

@section('page-actions')
    <a href="{{ route('admin.plans.create') }}" class="btn btn-t-y">
        <i class="fas fa-plus me-2"></i>Add New Plan
    </a>
@endsection

@section('content')
    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">All Plans</h3>
                <div class="card-tools d-flex align-items-center gap-3">
                    <span class="badge koa-badge-green fw-bold px-3 py-2">
                        {{ $plans->total() }} Total Plans
                    </span>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="card-body border-bottom p-4" style="background-color: #f8f9fa;">
            <form method="GET" action="{{ route('admin.plans.index') }}" class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text"
                               name="search"
                               class="form-control border-start-0"
                               placeholder="Search plans by name..."
                               value="{{ request('search') }}"
                               style="border-left: none !important;">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn koa-badge-green fw-medium px-3">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.plans.index') }}" class="btn btn-outline-secondary fw-medium px-3">
                                <i class="fas fa-times me-1"></i>Clear
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-4 koa-tb-cnt">
            @if($plans->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Final Price</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($plans as $plan)
                                <tr>
                                    <td class="ps-4">
                                        @if($plan->image)
                                            <img src="{{ asset('storage/' . $plan->image) }}" alt="{{ $plan->name }}"
                                                class="img-thumbnail rounded-circle koa-tb-img"
                                                style="width: 48px; height: 48px; object-fit: cover; border: 2px solid #3ca200;">
                                        @else
                                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 48px; height: 48px; background-color: #fff; border: 2px solid #E8F5D3;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <strong class="text-dark">{{ $plan->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($plan->description, 50) }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                            {{ $plan->formatted_price }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($plan->hasDiscount())
                                            <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                                @if($plan->discount_type === 'percentage')
                                                    {{ $plan->discount_value }}%
                                                @else
                                                    €{{ number_format($plan->discount_value, 2) }} EUR
                                                @endif
                                            </span>
                                        @else
                                            <span class="text-muted">No Discount</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($plan->hasDiscount())
                                            <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                                {{ $plan->formatted_discounted_price }}
                                            </span>
                                        @else
                                            <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                                {{ $plan->formatted_price }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.plans.toggle-status', $plan) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm fw-medium rounded-pill text-nowrap px-3 {{ $plan->is_active ? 'koa-badge-green' : 'koa-badge-green-outline' }}">
                                                <i class="fas {{ $plan->is_active ? 'fa-check' : 'fa-times' }} me-1"></i>
                                                {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group" style="gap: 8px;">
                                            <a href="{{ route('admin.plans.show', $plan) }}"
                                                class="btn btn-sm rounded-circle action-btns koa-badge-light-green" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.plans.edit', $plan) }}"
                                                class="btn btn-sm rounded-circle action-btns koa-badge-green" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this plan?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm rounded-circle action-btns koa-badge-red-outline"
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
                    {{ $plans->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    @if(request()->hasAny(['search', 'status']))
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Plans Match Your Search</h4>
                        <p class="text-muted">
                            Try adjusting your search criteria or
                            <a href="{{ route('admin.plans.index') }}" class="text-decoration-none">clear all filters</a>
                        </p>
                    @else
                        <i class="fas fa-wallet fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Plans Found</h4>
                        <p class="text-muted">Get started by creating your first plan.</p>
                        <a href="{{ route('admin.plans.create') }}" class="btn fw-medium px-4 py-2"
                            style="background-color: #3ca200; color: #fff;">
                            <i class="fas fa-plus me-2"></i>Add Your First Plan
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
