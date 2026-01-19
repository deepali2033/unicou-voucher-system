@extends('admin.layouts.app')

@section('title', 'View Service')
@section('page-title', 'Service Details: ' . $service->name)

@section('page-actions')
    <div class="d-flex gap-2">
        <!-- <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-t-y">
            <i class="fas fa-edit me-2"></i>Edit Service
        </a> -->
        <a href="{{ route('admin.services.index') }}" class="btn btn-t-g">
            <i class="fas fa-arrow-left me-2"></i>Back to Services
        </a>
    </div>
@endsection

@section('content')
<div class="row">
<div class="col-md-8">
    <div class="card shadow-sm border-0 koa-tb-card bg-grey">
        <div class="card-header border-0 koa-card-header">
            <h3 class="card-title mb-0 text-dark fs-4 py-2">Service Information</h3>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            <div class="row mb-3">
                <div class="col-sm-3"><strong>Name:</strong></div>
                <div class="col-sm-9 text-dark">{{ $service->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3"><strong>Slug:</strong></div>
                <div class="col-sm-9">
                    <code>{{ $service->slug }}</code>
                    <small class="text-muted d-block">{{ url('/services/' . $service->slug) }}</small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3"><strong>Short Description:</strong></div>
                <div class="col-sm-9 text-dark">{{ $service->short_description }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3"><strong>Full Description:</strong></div>
                <div class="col-sm-9">
                    <div class="border p-3" style="background-color: #fff;">
                        {!! nl2br(e($service->description)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($service->features && count($service->features) > 0)
    <div class="card shadow-sm border-0 koa-tb-card mt-4 bg-grey">
        <div class="card-header border-0 koa-card-header">
            <h3 class="card-title mb-0 text-dark fs-4 py-2">Features</h3>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            <ul class="list-group list-group-flush">
                @foreach($service->features as $feature)
                    <li class="list-group-item bg-grey">
                        <i class="fas fa-check-double text-green me-2"></i>{{ $feature }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if($service->includes && count($service->includes) > 0)
    <div class="card shadow-sm border-0 koa-tb-card mt-4 bg-grey">
        <div class="card-header border-0 koa-card-header">
            <h3 class="card-title mb-0 text-dark fs-4 py-2">What's Included</h3>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            <ul class="list-group list-group-flush">
                @foreach($service->includes as $include)
                    <li class="list-group-item bg-grey">
                        <i class="fas fa-angles-right me-2 text-green"></i>{{ $include }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if($service->meta_title || $service->meta_description)
    <div class="card shadow-sm border-0 koa-tb-card mt-4 bg-grey">
        <div class="card-header border-0 koa-card-header">
            <h3 class="card-title mb-0 text-dark fs-4 py-2">SEO Information</h3>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            @if($service->meta_title)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Meta Title:</strong></div>
                    <div class="col-sm-9 text-dark">{{ $service->meta_title }}</div>
                </div>
            @endif
            @if($service->meta_description)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Meta Description:</strong></div>
                    <div class="col-sm-9 text-dark">{{ $service->meta_description }}</div>
                </div>
            @endif
        </div>
    </div>
    @endif
</div>

<div class="col-md-4">
    <div class="card shadow-sm border-0 koa-tb-card bg-grey">
        <div class="card-header border-0 koa-card-header">
            <h3 class="card-title mb-0 text-dark fs-4 py-2">Service Details</h3>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            @if($service->image)
                <div class="text-center mb-3">
                    <img src="{{ asset('storage/' . $service->image) }}"
                         alt="{{ $service->name }}"
                         class="img-fluid rounded-circle koa-tb-img"
                         style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #3ca200;">
                </div>
            @endif

            <div class="row mb-2">
                <div class="col-6"><strong>Price Range:</strong></div>
                <div class="col-6">
                    <span class="badge koa-badge-blue fw-normal px-3 py-2 text-nowrap">
                        {{ $service->price_range }}
                    </span>
                </div>
            </div>

            @if($service->duration)
            <div class="row mb-2">
                <div class="col-6"><strong>Duration:</strong></div>
                <div class="col-6 text-dark">{{ $service->duration }}</div>
            </div>
            @endif

            @if($service->icon)
            <div class="row mb-2">
                <div class="col-6"><strong>Icon:</strong></div>
                <div class="col-6">
                    <i class="{{ $service->icon }} me-2"></i>
                    <code>{{ $service->icon }}</code>
                </div>
            </div>
            @endif

            <div class="row mb-2">
                <div class="col-6"><strong>Status:</strong></div>
                <div class="col-6">
                    <span class="badge fw-normal px-3 py-2 text-nowrap {{ $service->is_active ? 'koa-badge-green' : 'koa-badge-green-outline' }}">
                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-6"><strong>Featured:</strong></div>
                <div class="col-6">
                    <span class="badge fw-normal px-3 py-2 text-nowrap {{ $service->is_featured ? 'koa-badge-yellow' : 'koa-badge-yellow-outline' }}">
                        {{ $service->is_featured ? 'Yes' : 'No' }}
                    </span>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-6"><strong>Sort Order:</strong></div>
                <div class="col-6 text-dark">{{ $service->sort_order }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-6"><strong>Created:</strong></div>
                <div class="col-6">
                    <small class="text-muted">{{ $service->created_at->format('M d, Y H:i') }}</small>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-6"><strong>Updated:</strong></div>
                <div class="col-6">
                    <small class="text-muted">{{ $service->updated_at->format('M d, Y H:i') }}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 koa-tb-card mt-4 bg-grey">
        <div class="card-header border-0 koa-card-header">
            <h3 class="card-title mb-0 text-dark fs-4 py-2">Quick Actions</h3>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            <div class="d-grid gap-2">
                <form action="{{ route('admin.services.toggle-status', $service) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn fw-medium px-4 py-2 {{ $service->is_active ? 'koa-badge-yellow' : 'koa-badge-green' }} w-100">
                        <i class="fas {{ $service->is_active ? 'fa-pause' : 'fa-play' }} me-2"></i>
                        {{ $service->is_active ? 'Deactivate' : 'Activate' }} Service
                    </button>
                </form>

                <form action="{{ route('admin.services.toggle-featured', $service) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn fw-medium px-4 py-2 {{ $service->is_featured ? 'koa-badge-yellow-outline' : 'koa-badge-yellow' }} w-100">
                        <i class="fas fa-star me-2"></i>
                        {{ $service->is_featured ? 'Remove from Featured' : 'Mark as Featured' }}
                    </button>
                </form>

                <!-- <a href="{{ route('admin.services.edit', $service) }}" class="btn fw-medium px-4 py-2 koa-badge-green w-100">
                    <i class="fas fa-edit me-2"></i>Edit Service
                </a> -->

                <!-- <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this service? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn fw-medium px-4 py-2 koa-badge-red-outline w-100">
                        <i class="fas fa-trash me-2"></i>Delete Service
                    </button>
                </form> -->
            </div>
        </div>
    </div>
</div>
</div>
@endsection
