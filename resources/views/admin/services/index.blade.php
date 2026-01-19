@extends('admin.layouts.app')

@section('title', 'Services Management')
@section('page-title', 'Services Management')

@section('page-actions')
    <!-- <a href="{{ route('admin.services.create') }}" class="btn btn-t-y">
        <i class="fas fa-plus me-2"></i>Add New Service
    </a> -->
@endsection

@section('content')
    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">All Services</h3>
                <div class="card-tools d-flex align-items-center gap-3">
                    <!-- <a href="{{ route('admin.analytics') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-chart-bar me-1"></i>
                        Reports & Analytics
                    </a> -->
                    <span class="badge koa-badge-green fw-bold px-3 py-2">
                        {{ $services->total() }} Total Services
                    </span>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="card-body border-bottom p-4" style="background-color: #f8f9fa;">
            <form method="GET" action="{{ route('admin.services.index') }}" class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text"
                               name="search"
                               class="form-control border-start-0"
                               placeholder="Search services by name..."
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
                            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary fw-medium px-3">
                                <i class="fas fa-times me-1"></i>Clear
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-4 koa-tb-cnt">
            @if($services->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Image</th>
                                <th>Name</th>
                                <th>Price Range</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Sort Order</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td class="ps-4">
                                        @if($service->image)
                                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}"
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
                                            <strong class="text-dark">{{ $service->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($service->short_description, 50) }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                            {{ $service->price_range }}
                                        </span>
                                    </td>
                                    <td class="text-muted">
                                        {{ $service->duration ?? 'N/A' }}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.services.toggle-status', $service) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm fw-medium rounded-pill text-nowrap px-3 {{ $service->is_active ? 'koa-badge-green' : 'koa-badge-green-outline' }}">
                                                <i class="fas {{ $service->is_active ? 'fa-check' : 'fa-times' }} me-1"></i>
                                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.services.toggle-featured', $service) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm fw-medium rounded-pill text-nowrap px-3 {{ $service->is_featured ? 'koa-badge-yellow' : 'koa-badge-yellow-outline' }}">
                                                <i class="fas fa-star me-1"></i>
                                                {{ $service->is_featured ? 'Featured' : 'Not Featured' }}
                                            </button>

                                        </form>
                                    </td>
                                    <td>
                                        <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                            {{ $service->sort_order }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group" style="gap: 8px;">
                                            <a href="{{ route('admin.services.show', $service) }}"
                                                class="btn btn-sm rounded-circle action-btns koa-badge-light-green" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <!-- <a href="{{ route('admin.services.edit', $service) }}"
                                                class="btn btn-sm rounded-circle action-btns koa-badge-green" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a> -->
                                            <!-- <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this service?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm rounded-circle action-btns koa-badge-red-outline"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form> -->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $services->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    @if(request()->hasAny(['search', 'status']))
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Services Match Your Search</h4>
                        <p class="text-muted">
                            Try adjusting your search criteria or
                            <a href="{{ route('admin.services.index') }}" class="text-decoration-none">clear all filters</a>
                        </p>
                    @else
                        <i class="fas fa-broom fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Services Found</h4>
                        <p class="text-muted">Get started by creating your first service.</p>
                        <a href="{{ route('admin.services.create') }}" class="btn fw-medium px-4 py-2"
                            style="background-color: #3ca200; color: #fff;">
                            <i class="fas fa-plus me-2"></i>Add Your First Service
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <!-- <div class="card">
                <div class="card-header">
                   <div class="d-flex justify-content-between align-items-center">
                   <h3 class="card-title mb-0">All Services</h3>
                    <div class="card-tools">
                        <span class="badge bg-green">{{ $services->total() }} Total Services</span>
                    </div>
                   </div>
                </div>
                <div class="card-body">
                    @if($services->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price Range</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Sort Order</th>
                                        <th class="table-actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                        <tr>
                                            <td>
                                                @if($service->image)
                                                    <img src="{{ asset('storage/' . $service->image) }}"
                                                         alt="{{ $service->name }}"
                                                         class="img-thumbnail"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $service->name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($service->short_description, 50) }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $service->price_range }}</span>
                                            </td>
                                            <td>
                                                {{ $service->duration ?? 'N/A' }}
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.services.toggle-status', $service) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm {{ $service->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                        <i class="fas {{ $service->is_active ? 'fa-check' : 'fa-times' }}"></i>
                                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.services.toggle-featured', $service) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm {{ $service->is_featured ? 'btn-warning' : 'btn-outline-warning' }}">
                                                        <i class="fas fa-star"></i>
                                                        {{ $service->is_featured ? 'Featured' : 'Not Featured' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $service->sort_order }}</span>
                                            </td>
                                            <td class="table-actions">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.services.show', $service) }}"
                                                       class="btn btn-sm btn-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.services.edit', $service) }}"
                                                       class="btn btn-sm btn-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.services.destroy', $service) }}"
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this service?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
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

                        <div class="d-flex justify-content-center">
                            {{ $services->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-broom fa-3x text-muted mb-3"></i>
                            <h4>No Services Found</h4>
                            <p class="text-muted">Get started by creating your first service.</p>
                            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add Your First Service
                            </a>
                        </div>
                    @endif
                </div>
            </div> -->
@endsection
