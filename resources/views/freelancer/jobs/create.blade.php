@extends('freelancer.layouts.app')

@section('title', 'Create Job Listing')
@section('page-title', 'Create Job Listing')

@section('page-actions')
    <a href="{{ route('freelancer.jobs.index') }}" class="btn btn-t-g">
        <i class="fas fa-arrow-left me-1"></i> Back to Jobs
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
            <div class="card-header border-0 koa-card-header">
                <h5 class="card-title">Job Information</h5>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                <form action="{{ route('freelancer.jobs.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label">Job Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}" {{ old('category') == $category->name ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror"
                                  id="short_description" name="short_description" rows="2" maxlength="500" required>{{ old('short_description') }}</textarea>
                        <div class="form-text text-muted">Maximum 500 characters</div>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Full Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="8" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                       id="location" name="location" value="{{ old('location') }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="employment_type" class="form-label">Employment Type <span class="text-danger">*</span></label>
                                <select class="form-select @error('employment_type') is-invalid @enderror" id="employment_type" name="employment_type" required>
                                    @foreach(App\Models\JobListing::getEmploymentTypes() as $key => $type)
                                        <option value="{{ $key }}" {{ old('employment_type') == $key ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employment_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="salary_min" class="form-label">Minimum Salary</label>
                                <input type="number" step="0.01" class="form-control @error('salary_min') is-invalid @enderror"
                                       id="salary_min" name="salary_min" value="{{ old('salary_min') }}">
                                @error('salary_min')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="salary_max" class="form-label">Maximum Salary</label>
                                <input type="number" step="0.01" class="form-control @error('salary_max') is-invalid @enderror"
                                       id="salary_max" name="salary_max" value="{{ old('salary_max') }}">
                                @error('salary_max')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="salary_type" class="form-label">Salary Type <span class="text-danger">*</span></label>
                                <select class="form-select @error('salary_type') is-invalid @enderror" id="salary_type" name="salary_type" required>
                                    @foreach(App\Models\JobListing::getSalaryTypes() as $key => $type)
                                        <option value="{{ $key }}" {{ old('salary_type', 'hourly') == $key ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('salary_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Requirements</label>
                        <div id="requirements-container">
                            @if(old('requirements'))
                                @foreach(old('requirements') as $index => $requirement)
                                    <div class="input-group mb-2 requirement-item">
                                        <input type="text" class="form-control" name="requirements[]" value="{{ $requirement }}">
                                        <button type="button" class="btn koa-badge-red-outline remove-requirement">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2 requirement-item">
                                    <input type="text" class="form-control" name="requirements[]" placeholder="Enter a requirement">
                                    <button type="button" class="btn koa-badge-red-outline remove-requirement">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm koa-badge-green" id="add-requirement">
                            <i class="fas fa-plus me-1"></i>Add Requirement
                        </button>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Benefits</label>
                        <div id="benefits-container">
                            @if(old('benefits'))
                                @foreach(old('benefits') as $index => $benefit)
                                    <div class="input-group mb-2 benefit-item">
                                        <input type="text" class="form-control" name="benefits[]" value="{{ $benefit }}">
                                        <button type="button" class="btn koa-badge-red-outline remove-benefit">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2 benefit-item">
                                    <input type="text" class="form-control" name="benefits[]" placeholder="Enter a benefit">
                                    <button type="button" class="btn koa-badge-red-outline remove-benefit">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm koa-badge-green" id="add-benefit">
                            <i class="fas fa-plus me-1"></i>Add Benefit
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contact_email" class="form-label">Contact Email</label>
                                <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                                       id="contact_email" name="contact_email" value="{{ old('contact_email') }}">
                                @error('contact_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contact_phone" class="form-label">Contact Phone</label>
                                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror"
                                       id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}">
                                @error('contact_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="application_deadline" class="form-label">Application Deadline</label>
                                <input type="date" class="form-control @error('application_deadline') is-invalid @enderror"
                                       id="application_deadline" name="application_deadline" value="{{ old('application_deadline') }}">
                                @error('application_deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">Lower numbers appear first.</div>
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
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_featured" value="0">
                                    <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">Featured</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                  id="meta_description" name="meta_description" rows="3" maxlength="500">{{ old('meta_description') }}</textarea>
                        <div class="form-text text-muted">Maximum 500 characters</div>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between gap-3">
                        <a href="{{ route('freelancer.jobs.index') }}" class="btn koa-badge-green-outline fw-medium px-4 py-2">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn koa-badge-green fw-medium px-4 py-2">
                            <i class="fas fa-save me-2"></i>Create Job Listing
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
document.addEventListener('DOMContentLoaded', function() {
    // Add requirement functionality
    document.getElementById('add-requirement').addEventListener('click', function() {
        const container = document.getElementById('requirements-container');
        const newItem = document.createElement('div');
        newItem.className = 'input-group mb-2 requirement-item';
        newItem.innerHTML = `
            <input type="text" class="form-control" name="requirements[]" placeholder="Enter a requirement">
            <button type="button" class="btn koa-badge-red-outline remove-requirement">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(newItem);
        updateRemoveButtons('requirements');
    });

    // Remove requirement functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-requirement')) {
            const item = e.target.closest('.requirement-item');
            const container = document.getElementById('requirements-container');
            if (container.children.length > 1) {
                item.remove();
                updateRemoveButtons('requirements');
            }
        }
    });

    // Add benefit functionality
    document.getElementById('add-benefit').addEventListener('click', function() {
        const container = document.getElementById('benefits-container');
        const newItem = document.createElement('div');
        newItem.className = 'input-group mb-2 benefit-item';
        newItem.innerHTML = `
            <input type="text" class="form-control" name="benefits[]" placeholder="Enter a benefit">
            <button type="button" class="btn koa-badge-red-outline remove-benefit">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(newItem);
        updateRemoveButtons('benefits');
    });

    // Remove benefit functionality
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-benefit')) {
            const item = e.target.closest('.benefit-item');
            const container = document.getElementById('benefits-container');
            if (container.children.length > 1) {
                item.remove();
                updateRemoveButtons('benefits');
            }
        }
    });

    // Update remove buttons visibility
    function updateRemoveButtons(type) {
        const container = document.getElementById(type + '-container');
        const buttons = container.querySelectorAll('.remove-' + type.slice(0, -1));
        buttons.forEach((button, index) => {
            button.style.display = buttons.length > 1 ? 'block' : 'none';
        });
    }

    // Initialize remove buttons
    updateRemoveButtons('requirements');
    updateRemoveButtons('benefits');
});
</script>
@endpush
