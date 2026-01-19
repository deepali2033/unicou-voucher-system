@extends('admin.layouts.app')

@section('title', 'Testimonials Management')
@section('page-title', 'Testimonials Management')

@section('page-actions')
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-t-g">
        <i class="fas fa-plus me-2"></i>Add New Testimonial
    </a>
@endsection

@section('content')
    <div class="card shadow-sm border-0 koa-tb-card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center p-3">
                <h3 class="card-title mb-0 text-dark fs-4">All Testimonials</h3>
                <div class="card-tools d-flex align-items-center gap-3">
                    <span class="badge koa-badge-green fw-bold px-3 py-2">
                        {{ $testimonials->total() }} Total Testimonials
                    </span>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="card-body border-bottom p-4" style="background-color: #f8f9fa;">
            <form method="GET" action="{{ route('admin.testimonials.index') }}" class="row g-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text"
                               name="search"
                               class="form-control border-start-0"
                               placeholder="Search testimonials by name, content, or position..."
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
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary fw-medium px-3">
                                <i class="fas fa-times me-1"></i>Clear
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body p-4 koa-tb-cnt">
            @if($testimonials->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-borderless align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Customer</th>
                                <th>Content</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testimonials as $testimonial)
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                            {{ $testimonial->id }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($testimonial->image)
                                                <img src="{{ asset('storage/' . $testimonial->image) }}"
                                                     alt="{{ $testimonial->name }}"
                                                     class="rounded-circle me-3"
                                                     style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center bg-light rounded-circle me-3"
                                                     style="width: 40px; height: 40px;">
                                                    <i class="fas fa-user text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <strong class="text-dark">{{ $testimonial->name }}</strong>
                                                @if($testimonial->position)
                                                    <br><small class="text-muted">{{ $testimonial->position }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ Str::limit($testimonial->content, 80) }}</span>
                                    </td>
                                    <td>
                                        @if($testimonial->rating)
                                            <div class="d-flex align-items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                                <span class="ms-2 badge bg-light text-dark">{{ $testimonial->rating }}/5</span>
                                            </div>
                                        @else
                                            <span class="text-muted">No rating</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($testimonial->is_active)
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
                                        <small class="text-muted">{{ $testimonial->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group" style="gap: 8px;">
                                            <a href="{{ route('admin.testimonials.show', $testimonial) }}"
                                                class="btn btn-sm rounded-circle action-btns koa-badge-light-green" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                                class="btn btn-sm rounded-circle action-btns koa-badge-green" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
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
                    {{ $testimonials->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    @if(request('search'))
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Testimonials Match Your Search</h4>
                        <p class="text-muted">
                            Try adjusting your search criteria or
                            <a href="{{ route('admin.testimonials.index') }}" class="text-decoration-none">clear all filters</a>
                        </p>
                    @else
                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                        <h4 class="text-dark">No Testimonials Found</h4>
                        <p class="text-muted">Get started by creating your first testimonial.</p>
                        <a href="{{ route('admin.testimonials.create') }}" class="btn fw-medium px-4 py-2"
                            style="background-color: #3ca200; color: #fff;">
                            <i class="fas fa-plus me-2"></i>Add Your First Testimonial
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection