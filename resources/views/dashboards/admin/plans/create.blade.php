@extends('admin.layouts.app')

@section('title', 'Create Plan')
@section('page-title', 'Create New Plan')

@section('page-actions')
<a href="{{ route('admin.plans.index') }}" class="btn btn-t-lg">
    <i class="fas fa-arrow-left me-2"></i>Back to Plans
</a>
@endsection

@push('styles')
<style>
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #2c5530;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 1px solid #d0d0d0;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #3ca200;
        box-shadow: 0 0 0 0.2rem rgba(60, 162, 0, 0.25);
        background-color: #fafffe;
    }

    .form-select {
        border: 1px solid #d0d0d0;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        border-color: #3ca200;
        box-shadow: 0 0 0 0.2rem rgba(60, 162, 0, 0.25);
        background-color: #fafffe;
    }

    .input-group-text {
        background-color: #e8f5d3;
        border-color: #d0d0d0;
        color: #2c5530;
        font-weight: 600;
    }

    .preview-image {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        margin-top: 10px;
        border: 2px solid #e8f5d3;
    }

    .form-check-input:checked {
        background-color: #3ca200;
        border-color: #3ca200;
    }

    .form-check-input:focus {
        border-color: #3ca200;
        box-shadow: 0 0 0 0.2rem rgba(60, 162, 0, 0.25);
    }

    .form-check-label {
        color: #2c5530;
        font-weight: 500;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
    }

    .plan-create-card {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .plan-create-header {
        background: linear-gradient(135deg, #e8f5d3 0%, #f2f8e6 100%);
        border-bottom: 2px solid #d4e8b8;
        padding: 1.5rem;
    }

    .plan-create-header h4 {
        color: #2c5530;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .plan-create-body {
        background: #ffffff;
        padding: 2rem;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card plan-create-card">
            <div class="plan-create-header">
                <h4>
                    <i class="fas fa-plus-circle" style="color: #3ca200;"></i>
                    Plan Information
                </h4>
            </div>
            <div class="plan-create-body">
                <form action="{{ route('admin.plans.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Plan Name *</label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="e.g., Basic Plan, Premium Plan"
                                    required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="price" class="form-label">Price *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number"
                                        class="form-control @error('price') is-invalid @enderror"
                                        id="price"
                                        name="price"
                                        value="{{ old('price') }}"
                                        placeholder="0.00"
                                        step="0.01"
                                        min="0"
                                        required>
                                    @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <div class="form-check" style="margin-top: 2.2rem;">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        id="is_active"
                                        name="is_active"
                                        value="1"
                                        {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active Plan (users can subscribe to this plan)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                    id="description"
                                    name="description"
                                    rows="4"
                                    placeholder="Describe what this plan includes and its benefits..."
                                    required>{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="points" class="form-label">Points *</label>
                                <textarea class="form-control @error('points') is-invalid @enderror"
                                    id="points"
                                    name="points"
                                    rows="4"
                                    placeholder="Points what this plan includes..."
                                    required>{{ old('points') }}</textarea>
                                @error('points')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label for="image" class="form-label">Plan Image</label>
                                <input type="file"
                                    class="form-control @error('image') is-invalid @enderror"
                                    id="image"
                                    name="image"
                                    accept="image/*"
                                    onchange="previewImage(this)">
                                <small class="form-text text-muted">Upload an image (JPEG, PNG, JPG, GIF). Max size: 2MB</small>
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="imagePreview" style="display: none;">
                                    <img id="preview" class="preview-image" alt="Image Preview">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="discount_type" class="form-label">Discount Type</label>
                                <select class="form-select @error('discount_type') is-invalid @enderror"
                                    id="discount_type"
                                    name="discount_type"
                                    onchange="toggleDiscountInput()">
                                    <option value="">No Discount</option>
                                    <option value="percentage" {{ old('discount_type') === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                    <option value="fixed" {{ old('discount_type') === 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                                </select>
                                @error('discount_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label for="discount_value" class="form-label">Discount Value</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="discount-symbol">%</span>
                                    <input type="number"
                                        class="form-control @error('discount_value') is-invalid @enderror"
                                        id="discount_value"
                                        name="discount_value"
                                        value="{{ old('discount_value') }}"
                                        placeholder="0"
                                        step="0.01"
                                        min="0"
                                        disabled>
                                    @error('discount_value')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted" id="discount-help">Select a discount type first</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-4 pt-3" style="border-top: 1px solid #e8f5d3;">
                        <a href="{{ route('admin.plans.index') }}" class="btn btn-outline-secondary px-4"
                           style="border-color: #d0d0d0; color: #6c757d;">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-t-g px-4" style="font-weight: 600;">
                            <i class="fas fa-save me-2"></i>Create Plan
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
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function toggleDiscountInput() {
        const discountType = document.getElementById('discount_type').value;
        const discountValue = document.getElementById('discount_value');
        const discountSymbol = document.getElementById('discount-symbol');
        const discountHelp = document.getElementById('discount-help');

        if (discountType === '') {
            discountValue.disabled = true;
            discountValue.value = '';
            discountSymbol.textContent = '%';
            discountHelp.textContent = 'Select a discount type first';
        } else {
            discountValue.disabled = false;
            if (discountType === 'percentage') {
                discountSymbol.textContent = '%';
                discountValue.max = '100';
                discountHelp.textContent = 'Enter percentage (0-100)';
            } else if (discountType === 'fixed') {
                discountSymbol.textContent = '$';
                discountValue.removeAttribute('max');
                discountHelp.textContent = 'Enter fixed discount amount';
            }
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleDiscountInput();
    });
</script>
@endpush
