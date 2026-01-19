@extends('admin.layouts.app')

@section('title', 'Blogs Management')
@section('page-title', 'Blogs Management')

@section('page-actions')
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-t-g">
        <i class="fas fa-plus me-2"></i>Add New Blog
    </a>
@endsection

@section('content')
    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">All Blogs</h3>
                <div class="card-tools d-flex align-items-center gap-3">
                    <span class="badge koa-badge-green fw-bold px-3 py-2">
                        {{ $blogs->total() }} Total Blogs
                    </span>
                </div>
            </div>
        </div>

        <!-- Search & Filter Section -->
        <div class="card-body border-bottom p-4" style="background-color: #f8f9fa;">
            <form method="GET" action="{{ route('admin.blogs.index') }}" class="row g-3">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0"
                            placeholder="Search blogs by title, description..." value="{{ request('search') }}"
                            style="border-left: none !important;">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn koa-badge-green fw-medium px-3 w-100">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                        @if(request()->hasAny(['search', 'category', 'status']))
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary fw-medium px-3">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-4 koa-tb-cnt">
            @if($blogs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                {{-- <th>Short Description</th> --}}
                                <th>Status</th>
                                <th>Published</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                            {{ $blog->id }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($blog->featured_image)
                                            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" class="rounded"
                                                style="width: 80px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light rounded"
                                                style="width: 80px; height: 60px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="max-width: 250px;">
                                            <strong class="text-dark">{{ Str::limit($blog->title, 50) }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        @if($blog->category)
                                            <span class="badge bg-info text-white fw-normal px-3 py-2">
                                                {{ $blog->category->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">No category</span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <div style="max-width: 300px;">
                                            <span class="text-muted">{{ Str::limit($blog->short_description, 80) }}</span>
                                        </div>
                                    </td> --}}
                                    <td>
                                        @if($blog->is_active)
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
                                        @if($blog->published_at)
                                            <small class="text-muted">{{ $blog->published_at->format('M d, Y') }}</small>
                                        @else
                                            <small class="text-muted">Not published</small>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group" style="gap: 8px;">
                                            <a href="{{ route('admin.blogs.show', $blog) }}"
                                                class="btn btn-sm rounded-circle action-btns koa-badge-light-green" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.blogs.edit', $blog) }}"
                                                class="btn btn-sm rounded-circle action-btns koa-badge-green" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm rounded-circle action-btns koa-badge-red-outline"
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
                    {{ $blogs->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    @if(request()->hasAny(['search', 'category', 'status']))
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Blogs Match Your Search</h4>
                        <p class="text-muted">
                            Try adjusting your search criteria or
                            <a href="{{ route('admin.blogs.index') }}" class="text-decoration-none">clear all filters</a>
                        </p>
                    @else
                        <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Blogs Found</h4>
                        <p class="text-muted">Get started by creating your first blog post.</p>
                        <a href="{{ route('admin.blogs.create') }}" class="btn fw-medium px-4 py-2"
                            style="background-color: #3ca200; color: #fff;">
                            <i class="fas fa-plus me-2"></i>Add Your First Blog
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection