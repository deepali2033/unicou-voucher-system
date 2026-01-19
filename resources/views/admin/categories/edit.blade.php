@extends('admin.layouts.app')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category: ' . $category->name)

@section('page-actions')
<a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary fw-medium px-4">
    <i class="fas fa-arrow-left me-2"></i>Back to Categories
</a>
@endsection

@push('styles')
<style>
    .koa-edit-card {
        background: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .koa-edit-card:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    .koa-form-header {
        background: linear-gradient(135deg, #e8f5d3 0%, #f2f9e8 100%);
        border-bottom: 2px solid #3ca200;
        padding: 1.5rem 2rem;
    }

    .koa-form-body {
        padding: 2.5rem;
        background: #fafbfc;
    }

    .koa-form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .koa-form-label {
        font-weight: 600;
        color: #2c5530;
        margin-bottom: 0.75rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .koa-form-label i {
        color: #3ca200;
        font-size: 0.9rem;
    }

    .koa-form-control {
        border: 2px solid #e8f5d3;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        background-color: #ffffff;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .koa-form-control:focus {
        border-color: #3ca200;
        box-shadow: 0 0 0 4px rgba(60, 162, 0, 0.1);
        background-color: #ffffff;
        outline: none;
    }

    .koa-form-control:hover {
        border-color: #5db332;
        background-color: #fafbfc;
    }

    .koa-textarea {
        min-height: 150px;
        resize: vertical;
    }

    .koa-form-actions {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 2rem;
        border-top: 1px solid #e9ecef;
        display: flex;
        justify-content: end;
        gap: 1rem;
    }

    .koa-btn-cancel {
        background-color: #f8f9fa;
        color: #6c757d;
        border: 2px solid #dee2e6;
        border-radius: 10px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .koa-btn-cancel:hover {
        background-color: #e9ecef;
        color: #495057;
        border-color: #ced4da;
        transform: translateY(-1px);
    }

    .koa-btn-save {
        background: linear-gradient(135deg, #3ca200 0%, #4ab308 100%);
        color: #ffffff;
        border: 2px solid #3ca200;
        border-radius: 10px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(60, 162, 0, 0.2);
    }

    .koa-btn-save:hover {
        background: linear-gradient(135deg, #2d7c00 0%, #3c9100 100%);
        border-color: #2d7c00;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(60, 162, 0, 0.3);
    }

    .koa-btn-save i {
        margin-right: 0.5rem;
    }

    .koa-required {
        color: #dc3545;
        font-weight: bold;
    }

    .invalid-feedback {
        font-weight: 500;
        font-size: 0.9rem;
    }

    .is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1) !important;
    }

    @media (max-width: 768px) {
        .koa-form-body {
            padding: 1.5rem;
        }

        .koa-form-actions {
            padding: 1.5rem;
            flex-direction: column;
        }

        .koa-btn-cancel,
        .koa-btn-save {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="koa-edit-card">
            <div class="koa-form-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="mb-1 text-dark fw-bold">
                            <i class="fas fa-edit text-green me-2"></i>Edit Category
                        </h3>
                        <p class="mb-0 text-muted">Update category information and settings</p>
                    </div>
                    <div class="koa-badge-light-green px-3 py-2 rounded-pill">
                        <i class="fas fa-tag me-1"></i>
                        ID: {{ $category->id }}
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="koa-form-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="koa-form-group">
                                <label for="name" class="koa-form-label">
                                    <i class="fas fa-tag"></i>
                                    Category Name <span class="koa-required">*</span>
                                </label>
                                <input type="text"
                                    class="form-control koa-form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $category->name) }}"
                                    placeholder="e.g., Web Development, Design, Marketing"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="koa-form-group">
                                <label class="koa-form-label">
                                    <i class="fas fa-toggle-on"></i>
                                    Category Status
                                </label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}
                                           style="background-color: {{ old('is_active', $category->is_active ?? true) ? '#3ca200' : '' }}; border-color: #3ca200;">
                                    <label class="form-check-label" for="is_active">
                                        Active Category
                                    </label>
                                </div>
                                <small class="text-muted mt-2 d-block">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Inactive categories will not be visible to users
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="koa-form-group">
                                <label for="description" class="koa-form-label">
                                    <i class="fas fa-align-left"></i>
                                    Description
                                </label>
                                <textarea class="form-control koa-form-control koa-textarea @error('description') is-invalid @enderror"
                                    id="description"
                                    name="description"
                                    placeholder="Provide a brief description of this category to help users understand its purpose...">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted mt-2 d-block">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Optional: Add a description to help users understand this category better
                                </small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="koa-form-group">
                                <label for="image" class="koa-form-label">
                                    <i class="fas fa-image"></i>
                                    Category Image
                                </label>
                                @if($category->image)
                                    <div class="mb-3">
                                        <img src="{{ asset($category->image) }}" alt="Current category image"
                                             class="img-fluid rounded"
                                             style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #3ca200;">
                                        <div class="form-text text-success">Current image</div>
                                    </div>
                                @endif
                                <div id="image-preview-container" class="mb-2" style="display: none;">
                                    <img id="image-preview" src="" alt="Image Preview"
                                         class="img-fluid rounded"
                                         style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #3ca200;">
                                    <div class="form-text text-success">New image preview</div>
                                </div>
                                <input type="file" class="form-control koa-form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted mt-2 d-block">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Upload an image for this category (JPEG, PNG, JPG, GIF - Max: 2MB)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="koa-form-actions">
                    <a href="{{ route('admin.categories.index') }}" class="koa-btn-cancel">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                    <button type="submit" class="koa-btn-save">
                        <i class="fas fa-save"></i>Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const imagePreviewContainer = document.getElementById('image-preview-container');

    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreviewContainer.style.display = 'none';
            }
        });
    }
});
</script>
@endpush
