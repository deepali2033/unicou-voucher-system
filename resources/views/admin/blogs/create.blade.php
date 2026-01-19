@extends('admin.layouts.app')

@section('title', 'Create New Blog')
@section('page-title', 'Create New Blog')

@section('page-actions')
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Blogs
    </a>
@endsection

@section('styles')
<style>
    .image-preview {
        max-width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 0.375rem;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
                @csrf

                <div class="row g-4">
                    <!-- Title -->
                    <div class="col-md-12">
                        <label for="title" class="form-label fw-bold">
                            Blog Title <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               placeholder="Enter descriptive blog title"
                               required
                               minlength="5"
                               maxlength="100"
                               onkeyup="generateSlug()">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="col-md-12">
                        <label for="slug" class="form-label fw-bold">
                            Slug <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control @error('slug') is-invalid @enderror"
                               id="slug"
                               name="slug"
                               value="{{ old('slug') }}"
                               placeholder="Auto-generated from title"
                               required
                               maxlength="255">
                        <small class="text-muted">Auto-generated from title. Edit if needed.</small>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-bold">
                            Category <span class="text-muted">(Optional)</span>
                        </label>
                        <select class="form-select @error('category_id') is-invalid @enderror"
                                id="category_id"
                                name="category_id">
                            <option value="">Select Category (Optional)</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="is_active" class="form-label fw-bold">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="is_active"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                <span class="badge koa-badge-green">Active</span>
                                <span class="text-muted ms-2">(Blog will be published immediately)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="col-md-12">
                        <label for="featured_image" class="form-label fw-bold">
                            Featured Image <span class="text-danger">*</span>
                        </label>
                        <input type="file"
                               class="form-control @error('featured_image') is-invalid @enderror"
                               id="featured_image"
                               name="featured_image"
                               accept="image/jpeg,image/jpg,image/png,image/webp"
                               required
                               onchange="previewImage(event)">
                        <small class="text-muted">Accepted formats: JPG, JPEG, PNG, WEBP (Max: 2MB)</small>
                        @error('featured_image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div id="imagePreview"></div>
                    </div>

                    <!-- Blog Content (Rich Text Editor) -->
                    <div class="col-md-12">
                        <label for="content" class="form-label fw-bold">
                            Blog Content <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('content') is-invalid @enderror"
                                  id="content"
                                  name="content"
                                  required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-md-12">
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-t-g px-4">
                                <i class="fas fa-save me-2"></i>Create Blog
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- TinyMCE (Free Rich Text Editor) - Using jsDelivr CDN -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js"></script>

<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | forecolor backcolor | ' +
            'link image media table | removeformat code fullscreen help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; }',
        branding: false,
        promotion: false,
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        images_upload_handler: function (blobInfo, success, failure) {
            // Convert image to base64 for inline embedding
            const reader = new FileReader();
            reader.onload = function() {
                success(reader.result);
            };
            reader.readAsDataURL(blobInfo.blob());
        },
        setup: function (editor) {
            // Remove required attribute from textarea when TinyMCE initializes
            editor.on('init', function () {
                document.getElementById('content').removeAttribute('required');
            });
        }
    });

    // Form submission validation for TinyMCE
    document.getElementById('blogForm').addEventListener('submit', function(e) {
        // Get TinyMCE content
        const content = tinymce.get('content').getContent();
        
        // Check if content is empty
        if (!content || content.trim() === '') {
            e.preventDefault();
            alert('Please enter blog content!');
            tinymce.get('content').focus();
            return false;
        }
    });

    // Generate slug from title
    function generateSlug() {
        const title = document.getElementById('title').value;
        let slug = title
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-'); // Replace multiple hyphens with single hyphen
        
        document.getElementById('slug').value = slug;
    }

    // Image preview function
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = 
                    `<img src="${e.target.result}" class="image-preview" alt="Preview">`;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection




