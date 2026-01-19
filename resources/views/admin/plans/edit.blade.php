@extends('admin.layouts.app')

@section('title', 'Edit Plan')
@section('page-title', 'Edit Plan: ' . $plan->name)

@section('page-actions')
    <a href="{{ route('admin.plans.index') }}" class="btn btn-outline-secondary">
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
            color: #495057;
            margin-bottom: 0.5rem;
        }
        .form-control:focus {
            border-color: #3ca200;
            box-shadow: 0 0 0 0.2rem rgba(60, 162, 0, 0.25);
        }
        .form-select:focus {
            border-color: #3ca200;
            box-shadow: 0 0 0 0.2rem rgba(60, 162, 0, 0.25);
        }
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 10px;
        }
        .current-image {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            border: 2px solid #3ca200;
        }
    </style>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e9ecef;">
                    <h4 class="mb-0 text-dark">Edit Plan Information</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.plans.update', $plan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Plan Name *</label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name', $plan->name) }}"
                                           placeholder="e.g., Basic Plan, Premium Plan"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price" class="form-label">Price (EUR - NL) *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">€</span>
                                        <input type="number"
                                               class="form-control @error('price') is-invalid @enderror"
                                               id="price"
                                               name="price"
                                               value="{{ old('price', $plan->price) }}"
                                               placeholder="0.00"
                                               step="0.01"
                                               min="0"
                                               required>
                                        <span class="input-group-text">EUR</span>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="4"
                                      placeholder="Describe what this plan includes and its benefits..."
                                      required>{{ old('description', $plan->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="points" class="form-label">Points*</label>
                            <textarea class="form-control @error('points') is-invalid @enderror"
                                      id="points"
                                      name="points"
                                      rows="4"
                                      placeholder="Points what this plan includes and its benefits..."
                                      required>{{ old('points', $plan->points) }}</textarea>
                            @error('points')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Plan Image</label>

                            @if($plan->image)
                                <div class="mb-3">
                                    <label class="form-label">Current Image:</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $plan->image) }}" alt="{{ $plan->name }}" class="current-image">
                                    </div>
                                </div>
                            @endif

                            <input type="file"
                                   class="form-control @error('image') is-invalid @enderror"
                                   id="image"
                                   name="image"
                                   accept="image/*"
                                   onchange="previewImage(this)">
                            <small class="form-text text-muted">Upload a new image to replace the current one (JPEG, PNG, JPG, GIF). Max size: 2MB</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="imagePreview" style="display: none;">
                                <label class="form-label">New Image Preview:</label>
                                <div>
                                    <img id="preview" class="preview-image" alt="Image Preview">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_type" class="form-label">Discount Type</label>
                                    <select class="form-select @error('discount_type') is-invalid @enderror"
                                            id="discount_type"
                                            name="discount_type"
                                            onchange="toggleDiscountInput()">
                                        <option value="">No Discount</option>
                                        <option value="percentage" {{ old('discount_type', $plan->discount_type) === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                        <option value="fixed" {{ old('discount_type', $plan->discount_type) === 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                                    </select>
                                    @error('discount_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_value" class="form-label">Discount Value (EUR)</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="discount-symbol">%</span>
                                        <input type="number"
                                               class="form-control @error('discount_value') is-invalid @enderror"
                                               id="discount_value"
                                               name="discount_value"
                                               value="{{ old('discount_value', $plan->discount_value) }}"
                                               placeholder="0"
                                               step="0.01"
                                               min="0">
                                        @error('discount_value')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted" id="discount-help">Select a discount type first</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="is_active"
                                       name="is_active"
                                       value="1"
                                       {{ old('is_active', $plan->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active Plan (users can subscribe to this plan)
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.plans.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                            <button type="submit" class="btn btn-t-g px-4">
                                <i class="fas fa-save me-2"></i>Update Plan
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
                    discountSymbol.textContent = '€';
                    discountValue.removeAttribute('max');
                    discountHelp.textContent = 'Enter fixed discount amount in EUR';
                }
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleDiscountInput();
        });
    </script>
@endpush
