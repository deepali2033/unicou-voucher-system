@extends('admin.layouts.app')

@section('title', 'Categories Management')
@section('page-title', 'Categories Management')

@section('page-actions')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-t-g">
        <i class="fas fa-plus me-2"></i>Add New Category
    </a>
@endsection

@section('content')
    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">All Categories</h3>
                <div class="card-tools d-flex align-items-center gap-3">
                    <span class="badge koa-badge-green fw-bold px-3 py-2">
                        {{ $categories->total() }} Total Categories
                    </span>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="card-body border-bottom p-4" style="background-color: #f8f9fa;">
            <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text"
                               name="search"
                               class="form-control border-start-0"
                               placeholder="Search categories by name..."
                               value="{{ request('search') }}"
                               style="border-left: none !important;">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn koa-badge-green fw-medium px-3">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary fw-medium px-3">
                                <i class="fas fa-times me-1"></i>Clear
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-4 koa-tb-cnt">
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                            {{ $category->id }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($category->Image)
                                            <img src="{{ asset($category->Image) }}"
                                                 alt="{{ $category->name }}"
                                                 class="rounded"
                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light rounded"
                                                 style="width: 50px; height: 50px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <strong class="text-dark">{{ $category->name }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        @if($category->description)
                                            <span class="text-muted">{{ Str::limit($category->description, 60) }}</span>
                                        @else
                                            <span class="text-muted">No description</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge koa-badge-green fw-normal px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge koa-badge-red-outline fw-normal px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i>Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $category->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group" style="gap: 8px;">
                                            <a href="{{ route('admin.categories.show', $category) }}"
                                                class="btn btn-sm rounded-circle action-btns koa-badge-light-green" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                                class="btn btn-sm rounded-circle action-btns koa-badge-green" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    @if(request('search'))
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Categories Match Your Search</h4>
                        <p class="text-muted">
                            Try adjusting your search criteria or
                            <a href="{{ route('admin.categories.index') }}" class="text-decoration-none">clear all filters</a>
                        </p>
                    @else
                        <i class="fas fa-th-large fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Categories Found</h4>
                        <p class="text-muted">Get started by creating your first category.</p>
                        <a href="{{ route('admin.categories.create') }}" class="btn fw-medium px-4 py-2"
                            style="background-color: #3ca200; color: #fff;">
                            <i class="fas fa-plus me-2"></i>Add Your First Category
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
