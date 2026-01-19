@extends('admin.layouts.app')

@section('title', 'View Blog')
@section('page-title', 'View Blog')

@section('page-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Blogs
        </a>
        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-t-g">
            <i class="fas fa-edit me-2"></i>Edit Blog
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <!-- Blog Content Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <!-- Featured Image -->
                    @if($blog->featured_image)
                        <div class="mb-4">
                            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}"
                                class="img-fluid rounded w-100" style="max-height: 500px; object-fit: cover;">
                        </div>
                    @endif

                    <!-- Title -->
                    <h1 class="mb-3">{{ $blog->title }}</h1>

                    <!-- Meta Info -->
                    <div class="d-flex flex-wrap gap-3 mb-4 pb-3 border-bottom">
                        <div class="text-muted">
                            <i class="fas fa-calendar-alt me-2"></i>
                            {{ $blog->published_at ? $blog->published_at->format('F d, Y') : 'Not published' }}
                        </div>
                        <div class="text-muted">
                            <i class="fas fa-clock me-2"></i>
                            {{ $blog->reading_time }} min read
                        </div>
                        @if($blog->category)
                            <div>
                                <span class="badge bg-info text-white px-3 py-2">
                                    <i class="fas fa-folder me-1"></i>{{ $blog->category->name }}
                                </span>
                            </div>
                        @endif
                        <div>
                            @if($blog->is_active)
                                <span class="badge koa-badge-green px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i>Active
                                </span>
                            @else
                                <span class="badge koa-badge-red-outline px-3 py-2">
                                    <i class="fas fa-times-circle me-1"></i>Inactive
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Short Description -->
                    @if($blog->short_description)
                        <div class="alert alert-light border mb-4">
                            <p class="mb-0 lead">{{ $blog->short_description }}</p>
                        </div>
                    @endif

                    <!-- Blog Content -->
                    <div class="blog-content">
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Blog Details Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Blog Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small mb-1">Blog ID</label>
                        <div class="fw-bold">#{{ $blog->id }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small mb-1">Slug</label>
                        <div class="fw-bold">{{ $blog->slug }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small mb-1">Category</label>
                        <div>
                            @if($blog->category)
                                <span class="badge bg-info text-white">{{ $blog->category->name }}</span>
                            @else
                                <span class="text-muted">No category</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small mb-1">Status</label>
                        <div>
                            @if($blog->is_active)
                                <span class="badge koa-badge-green">
                                    <i class="fas fa-check-circle me-1"></i>Active
                                </span>
                            @else
                                <span class="badge koa-badge-red-outline">
                                    <i class="fas fa-times-circle me-1"></i>Inactive
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small mb-1">Published Date</label>
                        <div class="fw-bold">
                            {{ $blog->published_at ? $blog->published_at->format('M d, Y h:i A') : 'Not published' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small mb-1">Created At</label>
                        <div class="fw-bold">{{ $blog->created_at->format('M d, Y h:i A') }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small mb-1">Last Updated</label>
                        <div class="fw-bold">{{ $blog->updated_at->format('M d, Y h:i A') }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small mb-1">Reading Time</label>
                        <div class="fw-bold">{{ $blog->reading_time }} minutes</div>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-t-g">
                            <i class="fas fa-edit me-2"></i>Edit Blog
                        </a>

                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this blog? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>Delete Blog
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .blog-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.375rem;
            margin: 1rem 0;
        }

        .blog-content h1,
        .blog-content h2,
        .blog-content h3 {
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .blog-content p {
            margin-bottom: 1rem;
        }

        .blog-content ul,
        .blog-content ol {
            margin-bottom: 1rem;
            padding-left: 2rem;
        }

        .blog-content blockquote {
            border-left: 4px solid #3ca200;
            padding-left: 1rem;
            margin: 1.5rem 0;
            font-style: italic;
            color: #6c757d;
        }
    </style>
@endsection