@extends('admin.layouts.app')

@section('title', 'View Testimonial')
@section('page-title', 'Testimonial Details')

@section('page-actions')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-t-g">
            <i class="fas fa-edit me-2"></i>Edit Testimonial
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Testimonials
        </a>
    </div>
@endsection

@push('styles')
    <style>
        .testimonial-card {
            background: linear-gradient(135deg, #f8fdf4 0%, #e8f5d3 100%);
            border: 1px solid #d0e3cc;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .customer-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #3ca200;
            box-shadow: 0 4px 12px rgba(60, 162, 0, 0.2);
        }

        .rating-stars {
            color: #ffc107;
            font-size: 1.2rem;
        }

        .testimonial-content {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #3ca200;
            position: relative;
        }

        .testimonial-content:before {
            content: '"';
            font-size: 4rem;
            color: #3ca200;
            opacity: 0.2;
            position: absolute;
            top: 10px;
            left: 20px;
            font-family: Georgia, serif;
        }

        .testimonial-text {
            font-style: italic;
            color: #2c5530;
            line-height: 1.6;
            margin-left: 2rem;
        }

        .info-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #e8f5d3;
        }

        .info-label {
            font-weight: 600;
            color: #2c5530;
            margin-bottom: 0.5rem;
        }

        .info-value {
            color: #6c7570;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
        }

        .status-inactive {
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            color: white;
        }

        @media (max-width: 768px) {
            .testimonial-card {
                margin: 0 0.5rem;
            }

            .customer-image {
                width: 100px;
                height: 100px;
            }

            .testimonial-content {
                padding: 1.5rem;
            }

            .testimonial-text {
                margin-left: 1.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Testimonial Card -->
            <div class="card testimonial-card mb-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center mb-4 mb-md-0">
                            @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}"
                                    class="customer-image">
                            @else
                                <div
                                    class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle customer-image">
                                    <i class="fas fa-user fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <div class="testimonial-content">
                                <div class="testimonial-text">
                                    {{ $testimonial->content }}
                                </div>
                                <div class="mt-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5 class="mb-1 text-dark">{{ $testimonial->name }}</h5>
                                        @if($testimonial->position)
                                            <p class="mb-1 text-muted">{{ $testimonial->position }}</p>
                                        @endif
                                    </div>
                                    @if($testimonial->rating)
                                        <div class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                            <span class="ms-2 badge bg-light text-dark">{{ $testimonial->rating }}/5</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial Information -->
            <div class="row">
                <div class="col-md-8">
                    <div class="info-card mb-4">
                        <h5 class="mb-3 text-dark">
                            <i class="fas fa-info-circle me-2 text-primary"></i>Testimonial Information
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="info-label">Customer Name</div>
                                    <div class="info-value">{{ $testimonial->name }}</div>
                                </div>
                                <div class="mb-3">
                                    <div class="info-label">Position/Title</div>
                                    <div class="info-value">{{ $testimonial->position ?: 'Not specified' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="info-label">Rating</div>
                                    <div class="info-value">
                                        @if($testimonial->rating)
                                            {{ $testimonial->rating }} out of 5 stars
                                        @else
                                            No rating provided
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="info-label">Status</div>
                                    <div class="info-value">
                                        <span
                                            class="status-badge {{ $testimonial->is_active ? 'status-active' : 'status-inactive' }}">
                                            {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="info-label">Content</div>
                            <div class="info-value">{{ $testimonial->content }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card mb-4">
                        <h5 class="mb-3 text-dark">
                            <i class="fas fa-calendar me-2 text-primary"></i>Timestamps
                        </h5>
                        <div class="mb-3">
                            <div class="info-label">Created At</div>
                            <div class="info-value">{{ $testimonial->created_at->format('M d, Y \a\t g:i A') }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="info-label">Last Updated</div>
                            <div class="info-value">{{ $testimonial->updated_at->format('M d, Y \a\t g:i A') }}</div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="info-card">
                        <h5 class="mb-3 text-dark">
                            <i class="fas fa-bolt me-2 text-primary"></i>Quick Actions
                        </h5>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-t-g">
                                <i class="fas fa-edit me-2"></i>Edit Testimonial
                            </a>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="fas fa-trash me-2"></i>Delete Testimonial
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection