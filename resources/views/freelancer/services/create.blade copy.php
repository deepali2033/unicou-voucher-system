@extends('freelancer.layouts.app')

@section('title', 'Create Service')
@section('page-title', 'Create New Service')

@section('page-actions')
    <a href="{{ route('freelancer.services.index') }}" class="btn btn-t-g">
        <i class="fas fa-arrow-left me-2"></i>Back to Candidates
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('freelancer.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                    <div class="card-header border-0 koa-card-header">
                        <h3 class="card-title mb-0 text-dark fs-4 py-2">Candidate Information</h3>
                    </div>
                    <div class="card-body p-4 koa-tb-cnt">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name <span
                                            class="text-danger">*</span></label>
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
                                    <label for="applied_position" class="form-label">Applied Position <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="applied_position" name="applied_position" required>
                                        <option value="">-- Select Position --</option>
                                        <option value="software_engineer">Software Engineer</option>
                                        <option value="ui_ux_designer">UI/UX Designer</option>
                                        <option value="project_manager">Project Manager</option>
                                        <option value="data_analyst">Data Analyst</option>
                                        <option value="hr_executive">HR Executive</option>
                                        <!-- Later: auto-populate this list dynamically from Job Management -->
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="experience" class="form-label">Years of Experience</label>
                                    <input type="number" class="form-control" id="experience" name="experience" min="0"
                                        step="1">
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
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3" maxlength="500"></textarea>
                            <div class="form-text text-muted">Maximum 500 characters</div>
                        </div>
        
                        <div class="mb-3">
                            <label for="resume" class="form-label">Resume / CV</label>
                            <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx">
                            <div class="form-text text-muted">Upload PDF or Word file (Max: 5MB).</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Skills</label>
                            <div id="skills-container">
                                <div class="input-group mb-2 skill-item">
                                    <input type="text" class="form-control" name="skills[]" placeholder="Enter a skill">
                                    <button type="button" class="btn koa-badge-red-outline remove-skill">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm koa-badge-green" id="add-skill">
                                <i class="fas fa-plus me-1"></i>Add Skill
                            </button>
                        </div>

                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="resume" class="form-label">Resume</label>
                                    <input type="file" class="form-control" id="resume" name="resume"
                                        accept=".pdf,.doc,.docx">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Application Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between gap-3">
                            <a href="#" class="btn koa-badge-green-outline fw-medium px-4 py-2">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn koa-badge-green fw-medium px-4 py-2">
                                <i class="fas fa-save me-2"></i>Save Candidate
                            </button>
                        </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add skill functionality
            document.getElementById('add-skill').addEventListener('click', function () {
                const container = document.getElementById('skills-container');
                const newItem = document.createElement('div');
                newItem.className = 'input-group mb-2 skill-item';
                newItem.innerHTML = `
                            <input type="text" class="form-control" name="skills[]" placeholder="Enter a skill">
                            <button type="button" class="btn koa-badge-red-outline remove-skill">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                container.appendChild(newItem);
                updateRemoveButtons('skills');
            });

            // Remove skill functionality
            document.addEventListener('click', function (e) {
                if (e.target.closest('.remove-skill')) {
                    const item = e.target.closest('.skill-item');
                    const container = document.getElementById('skills-container');
                    if (container.children.length > 1) {
                        item.remove();
                        updateRemoveButtons('skills');
                    }
                }
            });

            // Add experience functionality
           

            // Remove experience functionality
          

            // Add education functionality
          
            // Remove education functionality
          

            // Update remove buttons visibility
            function updateRemoveButtons(type) {
                const container = document.getElementById(type + '-container');
                const buttons = container.querySelectorAll('.remove-' + type);
                buttons.forEach((button, index) => {
                    button.style.display = buttons.length > 1 ? 'block' : 'none';
                });
            }

            // Initialize remove buttons
            updateRemoveButtons('skills');
            updateRemoveButtons('experience');
            updateRemoveButtons('education');
        });
    </script>
@endpush