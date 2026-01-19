@extends('user.layouts.app')

@section('title', 'Edit Service')
@section('page-title', 'Edit Service: ' . $service->name)

@section('page-actions')
    <a href="{{ route('user.services.index') }}" class="btn btn-t-g">
        <i class="fas fa-arrow-left me-2"></i>Back to Services
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('user.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                <div class="card-header border-0 koa-card-header">
                    <h3 class="card-title mb-0 text-dark fs-4 py-2">Service Information</h3>
                </div>
                <div class="card-body p-4 koa-tb-cnt">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Serviceseddjfmnkj Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $service->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">URL Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                       id="slug" name="slug" value="{{ old('slug', $service->slug) }}">
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">Used in the URL. Leave empty to auto-generate from name.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-control @error('category_id') is-invalid @enderror"
                                        id="category_id" name="category_id">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">Choose a category for your service.</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror"
                                  id="short_description" name="short_description" rows="2" required>{{ old('short_description', $service->short_description) }}</textarea>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-muted">Brief description shown in service listings (max 500 characters).</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Full Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="6" required>{{ old('description', $service->description) }}</textarea>
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
                                       id="price_from" name="price_from" value="{{ old('price_from', $service->price_from) }}"
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
                                       id="price_to" name="price_to" value="{{ old('price_to', $service->price_to) }}"
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
                                       id="duration" name="duration" value="{{ old('duration', $service->duration) }}"
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
                                       id="icon" name="icon" value="{{ old('icon', $service->icon) }}"
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
                                <div id="image-preview-container" class="mb-2"{{ $service->image ? '' : ' style="display: none;"' }}>
                                    <img id="image-preview"
                                         src="{{ $service->image ? asset('storage/' . $service->image) : '' }}"
                                         alt="{{ $service->name }}"
                                         class="img-fluid rounded-circle koa-tb-img"
                                         style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #3ca200;">
                                    <div class="form-text" id="image-status">
                                        @if($service->image)
                                            <span class="text-muted">Current image</span>
                                        @else
                                            <span class="text-success">Image preview</span>
                                        @endif
                                    </div>
                                </div>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">Upload a new image to replace the current one (JPEG, PNG, JPG, GIF - Max: 2MB).</div>
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
                            @if($service->features && count($service->features) > 0)
                                @foreach($service->features as $feature)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="features[]" value="{{ $feature }}">
                                        <button type="button" class="btn koa-badge-red-outline remove-feature">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="features[]" placeholder="Enter a feature">
                                    <button type="button" class="btn koa-badge-red-outline remove-feature" style="display: none;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm koa-badge-yellow" id="add-feature">
                            <i class="fas fa-plus me-1"></i>Add Feature
                        </button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">What's Included</label>
                        <div id="includes-container">
                            @if($service->includes && count($service->includes) > 0)
                                @foreach($service->includes as $include)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="includes[]" value="{{ $include }}">
                                        <button type="button" class="btn koa-badge-red-outline remove-include">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="includes[]" placeholder="Enter what's included">
                                    <button type="button" class="btn koa-badge-red-outline remove-include" style="display: none;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endif
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
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" min="0">
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
                                           {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
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
                                           {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}>
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
                                       id="meta_title" name="meta_title" value="{{ old('meta_title', $service->meta_title) }}">
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
                                          id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $service->meta_description) }}</textarea>
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
                        <a href="{{ route('user.services.index') }}" class="btn koa-badge-green-outline fw-medium px-4 py-2">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn koa-badge-green fw-medium px-4 py-2">
                            <i class="fas fa-save me-2"></i>Update Service
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
    // Dynamic features and includes functionality
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
    const imageStatus = document.getElementById('image-status');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Check if file is an image
            if (!file.type.match('image.*')) {
                alert('Please select a valid image file');
                imageInput.value = '';
                return;
            }

            // Check file size (max 2MB)
            if (file.size > 2048 * 1024) {
                alert('File size must be less than 2MB');
                imageInput.value = '';
                return;
            }

            // Display preview
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreviewContainer.style.display = 'block';
                imageStatus.innerHTML = '<span class="text-success">New image preview (will replace current image on save)</span>';
            };
            reader.readAsDataURL(file);
        }
    });

    // Initialize remove buttons
    updateRemoveButtons('features');
    updateRemoveButtons('includes');
});
</script>
@endpush
