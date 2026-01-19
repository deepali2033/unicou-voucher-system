@extends('admin.layouts.app')

@section('title', 'View Category')
@section('page-title', 'Category: ' . $jobCategory->name)

@section('page-actions')
    <div class="btn-group" role="group" style="gap: 0.5rem;">
        <a href="{{ route('admin.job-categories.index') }}" class="btn btn-outline-secondary fw-medium px-4">
            <i class="fas fa-arrow-left me-2"></i>Back to Categories
        </a>
        <a href="{{ route('admin.job-categories.edit', $jobCategory) }}" class="btn btn-t-g fw-medium px-4">
            <i class="fas fa-edit me-2"></i>Edit Category
        </a>
    </div>
@endsection

@push('styles')
    <style>
        .koa-view-card {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .koa-view-card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .koa-view-header {
            background: linear-gradient(135deg, #e8f5d3 0%, #f2f9e8 100%);
            border-bottom: 2px solid #3ca200;
            padding: 2rem;
        }

        .koa-view-body {
            padding: 2.5rem;
            background: #fafbfc;
        }

        .koa-info-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: 2px solid #e8f5d3;
            border-radius: 16px;
            padding: 1.75rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .koa-info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, #3ca200 0%, #4ab308 100%);
        }

        .koa-info-card:hover {
            border-color: #3ca200;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(60, 162, 0, 0.15);
        }

        .koa-info-label {
            font-weight: 700;
            color: #2c5530;
            margin-bottom: 0.75rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .koa-info-label i {
            color: #3ca200;
            font-size: 1rem;
        }

        .koa-info-value {
            color: #212529;
            font-size: 1.1rem;
            font-weight: 500;
            line-height: 1.5;
        }

        .koa-info-value strong {
            color: #2c5530;
            font-weight: 700;
        }

        .koa-description-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border: 2px solid #e8f5d3;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
        }

        .koa-description-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3ca200 0%, #4ab308 100%);
            border-radius: 16px 16px 0 0;
        }

        .koa-view-actions {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 2rem;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: end;
            gap: 1rem;
        }

        .koa-btn-edit {
            background: linear-gradient(135deg, #3ca200 0%, #4ab308 100%);
            color: #ffffff;
            border: 2px solid #3ca200;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(60, 162, 0, 0.2);
            text-decoration: none;
        }

        .koa-btn-edit:hover {
            background: linear-gradient(135deg, #2d7c00 0%, #3c9100 100%);
            border-color: #2d7c00;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(60, 162, 0, 0.3);
        }

        .koa-btn-delete {
            background-color: #ffffff;
            color: #dc3545;
            border: 2px solid #dc3545;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .koa-btn-delete:hover {
            background-color: #dc3545;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        .koa-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .koa-meta-info {
            background: linear-gradient(135deg, #e8f5d3 0%, #f2f9e8 100%);
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .koa-view-body {
                padding: 1.5rem;
            }

            .koa-view-actions {
                padding: 1.5rem;
                flex-direction: column;
            }

            .koa-btn-edit,
            .koa-btn-delete {
                width: 100%;
                text-align: center;
            }

            .koa-info-card {
                padding: 1.25rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="koa-view-card">
                <div class="koa-view-header">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div>
                            <h2 class="mb-1 text-dark fw-bold">
                                <i class="fas fa-tag text-green me-2"></i>{{ $jobCategory->name }}
                            </h2>
                            <p class="mb-0 text-muted">Category details and information</p>
                        </div>
                        <div class="koa-badge-light-green px-3 py-2 rounded-pill">
                            <i class="fas fa-hashtag me-1"></i>
                            ID: {{ $jobCategory->id }}
                        </div>
                    </div>
                </div>

                <div class="koa-view-body">
                    <!-- Main Content Section -->
                    <div class="row">
                        <!-- Category Image Section -->
                        @if($jobCategory->image)
                            <div class="col-lg-4">
                                <div class="koa-info-card">
                                    <div class="koa-info-label">
                                        <i class="fas fa-image"></i>
                                        Category Image
                                    </div>
                                    <div class="koa-info-value">
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $jobCategory->image) }}" alt="{{ $jobCategory->name }}"
                                                class="img-fluid rounded shadow-sm"
                                                style="max-width: 100%; max-height: 300px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- jobCategory Details Section -->
                        <div class="{{ $jobCategory->Image ? 'col-lg-8' : 'col-lg-12' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="koa-info-card">
                                        <div class="koa-info-label">
                                            <i class="fas fa-tag"></i>
                                            Category Name
                                        </div>
                                        <div class="koa-info-value">
                                            <strong>{{ $jobCategory->name }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="koa-info-card">
                                        <div class="koa-info-label">
                                            <i class="fas fa-toggle-on"></i>
                                            Status
                                        </div>
                                        <div class="koa-info-value">
                                            @if($jobCategory->status)
                                                <div class="koa-status-badge koa-badge-green">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    Active
                                                </div>
                                            @else
                                                <div class="koa-status-badge"
                                                    style="background-color: #fff5f5; border: 1px solid #fecaca; color: #dc2626;">
                                                    <i class="fas fa-times-circle me-1"></i>
                                                    Inactive
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Description Section -->
                            <div class="koa-description-card">
                                <div class="koa-info-label">
                                    <i class="fas fa-align-left"></i>
                                    Description
                                </div>
                                <div class="koa-info-value">
                                    @if($jobCategory->description)
                                        <p class="mb-0 text-dark">{{ $jobCategory->description }}</p>
                                    @else
                                        <div class="d-flex align-items-center text-muted">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <span>No description provided for this category</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Metadata Section -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="koa-info-card">
                                <div class="koa-info-label">
                                    <i class="fas fa-calendar-plus"></i>
                                    Created Date
                                </div>
                                <div class="koa-info-value">
                                    <div class="koa-status-badge koa-badge-green">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $jobCategory->created_at->format('M d, Y') }}
                                    </div>
                                    <div class="koa-meta-info mt-2">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            {{ $jobCategory->created_at->format('l, F j, Y \a\t g:i A') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($jobCategory->updated_at && $jobCategory->updated_at != $jobCategory->created_at)
                            <div class="col-md-6">
                                <div class="koa-info-card">
                                    <div class="koa-info-label">
                                        <i class="fas fa-edit"></i>
                                        Last Updated
                                    </div>
                                    <div class="koa-info-value">
                                        <div class="koa-status-badge koa-badge-yellow">
                                            <i class="fas fa-sync-alt me-1"></i>
                                            {{ $jobCategory->updated_at->format('M d, Y') }}
                                        </div>
                                        <div class="koa-meta-info mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                {{ $jobCategory->updated_at->format('l, F j, Y \a\t g:i A') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-6">
                                <div class="koa-info-card">
                                    <div class="koa-info-label">
                                        <i class="fas fa-check-circle"></i>
                                        Status
                                    </div>
                                    <div class="koa-info-value">
                                        <div class="koa-status-badge koa-badge-light-green">
                                            <i class="fas fa-leaf me-1"></i>
                                            Recently Created
                                        </div>
                                        <div class="koa-meta-info mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                This category hasn't been modified since creation
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="koa-view-actions">
                        <a href="{{ route('admin.job-categories.edit', $jobCategory) }}" class="koa-btn-edit">
                            <i class="fas fa-edit me-2"></i>Edit Category
                        </a>
                        <form action="{{ route('admin.job-categories.destroy', $jobCategory) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="koa-btn-delete">
                                <i class="fas fa-trash me-2"></i>Delete Category
                            </button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection