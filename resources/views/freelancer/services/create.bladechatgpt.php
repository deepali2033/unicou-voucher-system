@extends('freelancer.layouts.app')

@section('title', 'Create Service')
@section('page-title', 'Create New Service')

@section('page-actions')
    <a href="{{ route('freelancer.services.index') }}" class="btn btn-t-g">
        <i class="fas fa-arrow-left me-2"></i>Back to Services
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
    <form action="#" method="POST" enctype="multipart/form-data">
    @csrf
    
    <!-- Candidate Information -->
    <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
        <div class="card-header border-0 koa-card-header">
            <h3 class="card-title mb-0 text-dark fs-4 py-2">Candidate Information</h3>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="applied_position" class="form-label">Applied Position <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="applied_position" name="applied_position" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Candidate Details -->
    <div class="card shadow-sm border-0 koa-tb-card mt-4" style="background-color: #f4f6f0;">
        <div class="card-header border-0 koa-card-header">
            <h3 class="card-title mb-0 text-dark fs-4 py-2">Candidate Details</h3>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="experience" class="form-label">Years of Experience</label>
                        <input type="number" class="form-control" id="experience" name="experience" min="0" step="1">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="location" class="form-label">Current Location</label>
                        <input type="text" class="form-control" id="location" name="location">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="skills" class="form-label">Skills</label>
                <input type="text" class="form-control" id="skills" name="skills" placeholder="e.g. Java, React, SQL">
                <div class="form-text text-muted">Separate multiple skills with commas.</div>
            </div>

            <div class="mb-3">
                <label for="education" class="form-label">Education</label>
                <textarea class="form-control" id="education" name="education" rows="2" placeholder="Enter candidate's education background"></textarea>
            </div>

            <div class="mb-3">
                <label for="resume" class="form-label">Resume / CV</label>
                <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx">
                <div class="form-text text-muted">Upload PDF or Word file (Max: 5MB).</div>
            </div>
        </div>
    </div>

    <!-- Candidate Status -->
    <div class="card shadow-sm border-0 koa-tb-card mt-4" style="background-color: #f4f6f0;">
        <div class="card-header border-0 koa-card-header">
            <h3 class="card-title mb-0 text-dark fs-4 py-2">Application Status</h3>
        </div>
        <div class="card-body p-4 koa-tb-cnt">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Current Stage</label>
                        <select class="form-select" id="status" name="status">
                            <option value="new">New Application</option>
                            <option value="shortlisted">Shortlisted</option>
                            <option value="interview_scheduled">Interview Scheduled</option>
                            <option value="interviewed">Interviewed</option>
                            <option value="offered">Offered</option>
                            <option value="hired">Hired</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="source" class="form-label">Source of Application</label>
                        <input type="text" class="form-control" id="source" name="source" placeholder="e.g. LinkedIn, Referral, Job Portal">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input type="text" class="form-control" id="tags" name="tags" placeholder="e.g. Top Talent, Needs Follow-up">
                <div class="form-text text-muted">Separate multiple tags with commas.</div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">freelancer Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Add any private notes here"></textarea>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="card shadow-sm border-0 koa-tb-card mt-4" style="background-color: #f4f6f0;">
        <div class="card-body p-4 koa-tb-cnt">
            <div class="d-flex justify-content-between gap-3">
                <a href="#" class="btn koa-badge-green-outline fw-medium px-4 py-2">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
                <button type="submit" class="btn koa-badge-green fw-medium px-4 py-2">
                    <i class="fas fa-save me-2"></i>Create Candidate
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

    // Initialize remove buttons
    updateRemoveButtons('features');
    updateRemoveButtons('includes');
});
</script>
@endpush