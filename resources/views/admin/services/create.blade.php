@extends('admin.layouts.app')

@section('title', 'Create Service')
@section('page-title', 'Create New Service')

@section('page-actions')
    <a href="{{ route('admin.services.index') }}" class="btn btn-t-g">
        <i class="fas fa-arrow-left me-2"></i>Back to Services
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                <div class="card-header border-0 koa-card-header">
                    <h3 class="card-title mb-0 text-dark fs-4 py-2">Service Information</h3>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Service Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">URL Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                       id="slug" name="slug" value="{{ old('slug') }}"
                                       placeholder="Leave empty to auto-generate">
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">Used in the URL. Leave empty to auto-generate from name.</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror"
                                  id="short_description" name="short_description" rows="2" required>{{ old('short_description') }}</textarea>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-muted">Brief description shown in service listings (max 500 characters).</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Full Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="6" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-muted">Detailed description shown on the service page.</div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 koa-tb-card mt-4" style="background-color: #f4f6f0;">
                <div class="card-header border-0 koa-card-header">
                    <h3 class="card-title mb-0 text-dark fs-4 py-2">Pricing & Details</h3>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price_from" class="form-label">Price From (€)</label>
                                <input type="number" class="form-control @error('price_from') is-invalid @enderror"
                                       id="price_from" name="price_from" value="{{ old('price_from') }}"
                                       min="0" step="0.01">
                                @error('price_from')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price_to" class="form-label">Price To (€)</label>
                                <input type="number" class="form-control @error('price_to') is-invalid @enderror"
                                       id="price_to" name="price_to" value="{{ old('price_to') }}"
                                       min="0" step="0.01">
                                @error('price_to')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="duration" class="form-label">Duration</label>
                                <input type="text" class="form-control @error('duration') is-invalid @enderror"
                                       id="duration" name="duration" value="{{ old('duration') }}"
                                       placeholder="e.g., 2-3 hours">
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon Class</label>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                       id="icon" name="icon" value="{{ old('icon') }}"
                                       placeholder="e.g., fas fa-broom">
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">Font Awesome icon class for the service.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">Service Image</label>
                                <div id="image-preview-container" class="mb-2" style="display: none;">
                                    <img id="image-preview" src="" alt="Image Preview"
                                         class="img-fluid rounded-circle koa-tb-img"
                                         style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #3ca200;">
                                    <div class="form-text text-success">Image preview</div>
                                </div>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">Upload an image for this service (JPEG, PNG, JPG, GIF - Max: 2MB).</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 koa-tb-card mt-4" style="background-color: #f4f6f0;">
                <div class="card-header border-0 koa-card-header">
                    <h3 class="card-title mb-0 text-dark fs-4 py-2">Service Features</h3>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    <div class="mb-3">
                        <label class="form-label">Features</label>
                        <div id="features-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="features[]" placeholder="Enter a feature">
                                <button type="button" class="btn koa-badge-red-outline remove-feature" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm koa-badge-yellow" id="add-feature">
                            <i class="fas fa-plus me-1"></i>Add Feature
                        </button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">What's Included</label>
                        <div id="includes-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="includes[]" placeholder="Enter what's included">
                                <button type="button" class="btn koa-badge-red-outline remove-include" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm koa-badge-yellow" id="add-include">
                            <i class="fas fa-plus me-1"></i>Add Item
                        </button>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 koa-tb-card mt-4" style="background-color: #f4f6f0;">
                <div class="card-header border-0 koa-card-header">
                    <h3 class="card-title mb-0 text-dark fs-4 py-2">Settings & SEO</h3>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">Lower numbers appear first.</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active Service
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                                           {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Featured Service
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                       id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">SEO title for search engines.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                          id="meta_description" name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">SEO description for search engines (max 500 characters).</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 koa-tb-card mt-4" style="background-color: #f4f6f0;">
                <div class="card-body p-4 koa-tb-cnt">
                    <div class="d-flex justify-content-between gap-3">
                        <a href="{{ route('admin.services.index') }}" class="btn koa-badge-green-outline fw-medium px-4 py-2">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn koa-badge-green fw-medium px-4 py-2">
                            <i class="fas fa-save me-2"></i>Create Service
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.dataset.manual !== 'true') {
            slugInput.value = this.value.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
    });

    slugInput.addEventListener('input', function() {
        this.dataset.manual = 'true';
    });

    // Dynamic features
    document.getElementById('add-feature').addEventListener('click', function() {
        const container = document.getElementById('features-container');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="features[]" placeholder="Enter a feature">
            <button type="button" class="btn koa-badge-red-outline remove-feature">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
        updateRemoveButtons('features');
    });

    // Dynamic includes
    document.getElementById('add-include').addEventListener('click', function() {
        const container = document.getElementById('includes-container');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="includes[]" placeholder="Enter what's included">
            <button type="button" class="btn koa-badge-red-outline remove-include">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
        updateRemoveButtons('includes');
    });

    // Remove feature/include
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-feature')) {
            e.target.closest('.input-group').remove();
            updateRemoveButtons('features');
        }
        if (e.target.closest('.remove-include')) {
            e.target.closest('.input-group').remove();
            updateRemoveButtons('includes');
        }
    });

    function updateRemoveButtons(type) {
        const container = document.getElementById(type + '-container');
        const buttons = container.querySelectorAll('.remove-' + type.slice(0, -1));
        buttons.forEach((button, index) => {
            button.style.display = buttons.length > 1 ? 'block' : 'none';
        });
    }

    // Image preview functionality
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const imagePreviewContainer = document.getElementById('image-preview-container');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Check if file is an image
            if (!file.type.match('image.*')) {
                alert('Please select a valid image file');
                imageInput.value = '';
                imagePreviewContainer.style.display = 'none';
                return;
            }

            // Check file size (max 2MB)
            if (file.size > 2048 * 1024) {
                alert('File size must be less than 2MB');
                imageInput.value = '';
                imagePreviewContainer.style.display = 'none';
                return;
            }

            // Display preview
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

    // Initialize remove buttons
    updateRemoveButtons('features');
    updateRemoveButtons('includes');
});
</script>
@endpush
