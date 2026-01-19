@extends('admin.layouts.app')

@section('title', 'Create Category')
@section('page-title', 'Create New Category')

@section('page-actions')
    <a href="{{ route('admin.job-categories.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Categories
    </a>
@endsection

@push('styles')
    <style>
        /* Enhanced form styling with improved color scheme */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #2c5530;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label .text-danger {
            font-size: 0.9em;
        }

        /* Enhanced form controls with better focus states */
        .form-control {
            border: 1px solid #d0e3cc;
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #3ca200;
            box-shadow: 0 0 0 0.2rem rgba(60, 162, 0, 0.15);
            background-color: #fafbfa;
        }

        .form-control:hover:not(:focus) {
            border-color: #3ca200;
        }

        .form-select {
            border: 1px solid #d0e3cc;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            border-color: #3ca200;
            box-shadow: 0 0 0 0.2rem rgba(60, 162, 0, 0.15);
        }

        /* Enhanced checkbox styling */
        .form-check-input {
            border: 2px solid #d0e3cc;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: #3ca200;
            border-color: #3ca200;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e");
        }

        .form-check-input:focus {
            border-color: #3ca200;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(60, 162, 0, 0.15);
        }

        .form-check-label {
            color: #2c5530;
            font-weight: 500;
            cursor: pointer;
        }

        /* Enhanced image preview */
        .image-preview-enhanced {
            border: 3px solid #e8f5d3;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: #f8fdf4;
            padding: 8px;
        }

        .image-preview-enhanced:hover {
            border-color: #3ca200;
            box-shadow: 0 4px 12px rgba(60, 162, 0, 0.15);
        }

        /* Enhanced file input */
        .form-control[type="file"] {
            padding: 0.5rem 0.75rem;
            background-color: #f8fdf4;
            border: 2px dashed #d0e3cc;
            transition: all 0.3s ease;
        }

        .form-control[type="file"]:focus,
        .form-control[type="file"]:hover {
            background-color: #f0f7ea;
            border-color: #3ca200;
            border-style: dashed;
        }

        /* Enhanced helper text */
        .form-text {
            color: #6c7570;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .form-text.text-success {
            color: #3ca200 !important;
            font-weight: 500;
        }

        /* Enhanced validation feedback */
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
        }

        /* Enhanced button styling */
        .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
            transform: translateY(-1px);
        }

        .btn-t-g {
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(60, 162, 0, 0.2);
        }

        .btn-t-g:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(60, 162, 0, 0.3);
        }

        /* Enhanced card styling for full-width */
        .card.shadow-sm {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
            border: 1px solid #e8f5d3;
            transition: all 0.3s ease;
            max-width: 100%;
            width: 100%;
        }

        .card.shadow-sm:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #f8fdf4 0%, #e8f5d3 100%) !important;
            border-bottom: 1px solid #d0e3cc !important;
            border-radius: 12px 12px 0 0 !important;
            padding: 1.25rem 1.5rem;
        }

        .card-header h4 {
            color: #2c5530 !important;
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-header h4:before {
            content: "📝";
            font-size: 1.2em;
        }

        .card-body {
            background-color: #fefffe;
            border-radius: 0 0 12px 12px;
            padding: 2rem;
        }

        /* Full-width form enhancements */
        .full-width-form {
            width: 100%;
            max-width: none;
        }

        .full-width-form .row {
            margin: 0 -15px;
        }

        .full-width-form .col-md-6 {
            padding: 0 15px;
        }

        /* Animation for form elements */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Responsive improvements for full-width form */
        @media (max-width: 992px) {
            .card-body {
                padding: 1.5rem;
            }

            .row .col-md-6 {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem 1rem;
            }

            .form-label {
                font-size: 0.9rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .d-flex.justify-content-end.gap-2 {
                flex-direction: column-reverse;
                gap: 0.5rem !important;
            }

            .row .col-md-6 {
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .card {
                margin: 0 0.5rem;
            }

            .card-body {
                padding: 1rem;
            }

            .card-header {
                padding: 1rem;
            }

            .form-control,
            .form-select {
                font-size: 0.9rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h4 class="mb-0">Job Category Information</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.job-categories.store') }}" method="POST" enctype="multipart/form-data"
                        class="full-width-form">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Categorysds Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name') }}" placeholder="e.g., Web Development, Design"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-label">Category Image</label>
                                    <div id="image-preview-container" class="mb-2" style="display: none;">
                                        <img id="image-preview" src="" alt="Image Preview"
                                            class="img-fluid rounded image-preview-enhanced"
                                            style="width: 120px; height: 120px; object-fit: cover;">
                                        <div class="form-text text-success">
                                            <i class="fas fa-check-circle me-1"></i>Image preview
                                        </div>
                                    </div>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                        name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Upload an image for this category (JPEG, PNG,
                                        JPG, GIF - Max: 2MB)
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" rows="4"
                                placeholder="Brief description of the category (optional)...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                            value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active Category
                                        </label>
                                    </div>
                                    <div class="form-text text-muted">
                                        <i class="fas fa-eye-slash me-1"></i>Inactive categories will not be visible to
                                        users
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.job-categories.index') }}"
                                class="btn btn-outline-secondary px-4">Cancel</a>
                            <button type="submit" class="btn btn-t-g px-4">
                                <i class="fas fa-save me-2"></i>Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Image preview functionality
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');
            const imagePreviewContainer = document.getElementById('image-preview-container');

            if (imageInput) {
                imageInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
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