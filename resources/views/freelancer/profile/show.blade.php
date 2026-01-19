@extends('freelancer.layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('page-actions')
<a href="{{ route('freelancer.dashboard') }}" class="btn btn-t-g">
    <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
</a>
@endsection
<style>
    #change-profile-photo-btn{
        background: #3ca200 !important;
        border: #3ca200 !important;
        width: 32px;
        height: 32px;
        justify-content: center;
        display: flex;
        align-items: center;
        margin-bottom: 5px;
        margin-right: 5px;
        cursor: pointer;
    }
</style>
@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
            <div class="card-header border-0 koa-card-header">
                <h5 class="card-title">Profile Information</h5>
            </div>
            <div class="card-body p-4 koa-tb-cnt">
                <form method="POST" action="{{ route('freelancer.profile.update') }}" enctype="multipart/form-data">
                    @csrf
<input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', $freelancer->latitude) }}">
<input type="hidden" id="longitude" name="longitude" value="{{ old('longitude', $freelancer->longitude) }}">
                    <!-- Profile Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $freelancer->name) }}" readonly>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $freelancer->email) }}" readonly>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', $freelancer->phone) }}" required>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Profile Photo -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                                <div class="card-header border-0 koa-card-header">
                                    <h5 class="card-title">Profile Photo</h5>
                                </div>
                                <div class="card-body p-4 koa-tb-cnt">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="profile_photo" class="form-label">Profile Photo</label>
                                            <div class="text-center mb-3">
                                                <div class="position-relative d-inline-block">
                                                    @if($freelancer->profile_photo)
                                                        <img id="profile-photo-preview" src="{{ asset('storage/' . $freelancer->profile_photo) }}"
                                                             alt="Profile Photo" class="img-fluid rounded-circle border border-2"
                                                             style="width: 120px; height: 120px; object-fit: cover;">
                                                    @else
                                                        <div id="profile-photo-placeholder" class="bg-light rounded-circle border border-2 d-flex align-items-center justify-content-center"
                                                             style="width: 120px; height: 120px;">
                                                            <i class="fas fa-user text-secondary fa-3x"></i>
                                                        </div>
                                                    @endif
                                                    <button type="button" id="change-profile-photo-btn" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle p-1">
                                                        <i class="fas fa-camera"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="file" class="form-control @error('profile_photo') is-invalid @enderror"
                                                id="profile_photo" name="profile_photo" accept="image/*" style="display: none;">
                                            <small class="form-text text-muted d-block mt-2 text-center">Accepted formats: JPG, PNG, WebP (Max: 3MB)</small>
                                            @error('profile_photo')
                                            <div class="invalid-feedback d-block text-center">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3 d-flex align-items-center">
                                            <div class="w-100">
                                                <h6 class="mb-3">Photo Guidelines</h6>
                                                <ul class="list-unstyled small text-muted">
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Upload a clear, professional photo</li>
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Use JPG, PNG, or WebP format</li>
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Maximum file size: 3MB</li>
                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Square or circular crop recommended</li>
                                                </ul>
                                                <div class="mt-3 p-3 bg-light rounded">
                                                    <small class="text-muted">
                                                        <strong>Tip:</strong> Your profile photo helps employers recognize you and makes your applications more personal.
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                                <div class="card-header border-0 koa-card-header">
                                    <h5 class="card-title">Address Information</h5>
                                </div>
                                <div class="card-body p-4 koa-tb-cnt">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="address" class="form-label">Street Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror"
                                                id="address" name="address" rows="2">{{ old('address', $freelancer->address) }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                                                id="city" name="city" value="{{ old('city', $freelancer->city) }}">
                                            @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="state" class="form-label">State</label>
                                            <input type="text" class="form-control @error('state') is-invalid @enderror"
                                                id="state" name="state" value="{{ old('state', $freelancer->state) }}">
                                            @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="zip_code" class="form-label">ZIP Code</label>
                                            <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                                id="zip_code" name="zip_code" value="{{ old('zip_code', $freelancer->zip_code) }}">
                                            @error('zip_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Experience & Education -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                                <div class="card-header border-0 koa-card-header">
                                    <h5 class="card-title">Experience & Education</h5>
                                </div>
                                <div class="card-body p-4 koa-tb-cnt">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="work_experience" class="form-label">Work Experience</label>
                                            <textarea class="form-control @error('work_experience') is-invalid @enderror"
                                                id="work_experience" name="work_experience" rows="4"
                                                placeholder="Please describe your relevant work experience...">{{ old('work_experience', $freelancer->work_experience) }}</textarea>
                                            @error('work_experience')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="education" class="form-label">Education</label>
                                            <textarea class="form-control @error('education') is-invalid @enderror"
                                                id="education" name="education" rows="3"
                                                placeholder="Please describe your educational background...">{{ old('education', $freelancer->education) }}</textarea>
                                            @error('education')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="Skills" class="form-label">Skills</label>
                                            <textarea class="form-control @error('Skills') is-invalid @enderror"
                                                id="Skills" name="Skills" rows="3"
                                                placeholder="Please add your skills">{{ old('Skills', $freelancer->Skills) }}</textarea>
                                            @error('Skills')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="certifications" class="form-label">Certifications</label>
                                            <textarea class="form-control @error('certifications') is-invalid @enderror"
                                                id="certifications" name="certifications" rows="2"
                                                placeholder="List any relevant certifications...">{{ old('certifications', $freelancer->certifications) }}</textarea>
                                            @error('certifications')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                                <div class="card-header border-0 koa-card-header">
                                    <h5 class="card-title">Documents</h5>
                                </div>
                                <div class="card-body p-4 koa-tb-cnt">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="resume" class="form-label">Resume/CV</label>
                                            <input type="file" class="form-control @error('resume') is-invalid @enderror"
                                                id="resume" name="resume" accept=".pdf,.doc,.docx">
                                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</small>
                                            @if($freelancer->resume)
                                            <div class="mt-2">
                                                <small class="text-success">
                                                    <i class="fas fa-file me-1"></i>Current: {{ basename($freelancer->resume) }}
                                                </small>
                                            </div>
                                            @endif
                                            @error('resume')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cover_letter" class="form-label">Cover Letter</label>
                                            <input type="file" class="form-control @error('cover_letter') is-invalid @enderror"
                                                id="cover_letter" name="cover_letter" accept=".pdf,.doc,.docx">
                                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</small>
                                            @if($freelancer->cover_letter)
                                            <div class="mt-2">
                                                <small class="text-success">
                                                    <i class="fas fa-file me-1"></i>Current: {{ basename($freelancer->cover_letter) }}
                                                </small>
                                            </div>
                                            @endif
                                            @error('cover_letter')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents For KYC -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card shadow-sm border-0 koa-tb-card" style="background-color: #f4f6f0;">
                                <div class="card-header border-0 koa-card-header">
                                    <h5 class="card-title">Documents for KYC</h5>
                                </div>
                                <div class="card-body p-4 koa-tb-cnt">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="aadhar_card" class="form-label">Aadhar Card</label>
                                            <input type="file" class="form-control @error('aadhar_card') is-invalid @enderror"
                                                id="aadhar_card" name="aadhar_card" accept=".png,.jpg,.jpeg">
                                            <small class="form-text text-muted">Accepted formats: JPG, PNG (Max: 5MB)</small>
                                            @if($freelancer->aadhar_card)
                                            <div class="mt-2">
                                                <small class="text-success">
                                                    <i class="fas fa-image me-1"></i>Current: {{ basename($freelancer->aadhar_card) }}
                                                </small>
                                            </div>
                                            @endif
                                            @error('aadhar_card')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="pan_card" class="form-label">Pan Card</label>
                                            <input type="file" class="form-control @error('pan_card') is-invalid @enderror"
                                                id="pan_card" name="pan_card" accept=".png,.jpg,.jpeg">
                                            <small class="form-text text-muted">Accepted formats: JPG, PNG (Max: 5MB)</small>
                                            @if($freelancer->pan_card)
                                            <div class="mt-2">
                                                <small class="text-success">
                                                    <i class="fas fa-image me-1"></i>Current: {{ basename($freelancer->pan_card) }}
                                                </small>
                                            </div>
                                            @endif
                                            @error('pan_card')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-between gap-3 mt-4">
                        <a href="{{ route('freelancer.dashboard') }}" class="btn koa-badge-green-outline fw-medium px-4 py-2">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn koa-badge-green fw-medium px-4 py-2">
                            <i class="fas fa-save me-2"></i>Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profilePhotoInput = document.getElementById('profile_photo');
    const changePhotoBtn = document.getElementById('change-profile-photo-btn');
    const photoPreview = document.getElementById('profile-photo-preview');
    const photoPlaceholder = document.getElementById('profile-photo-placeholder');

    // Trigger file input when button is clicked
    changePhotoBtn.addEventListener('click', function() {
        profilePhotoInput.click();
    });

    // Handle file selection and preview
    profilePhotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file type
            if (!file.type.match('image.*')) {
                alert('Please select a valid image file.');
                profilePhotoInput.value = '';
                return;
            }

            // Validate file size (3MB max)
            if (file.size > 3 * 1024 * 1024) {
                alert('File size must be less than 3MB.');
                profilePhotoInput.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                if (photoPreview) {
                    photoPreview.src = e.target.result;
                } else if (photoPlaceholder) {
                    // Replace placeholder with image
                    const container = photoPlaceholder.parentElement;
                    container.innerHTML = `
                        <img id="profile-photo-preview" src="${e.target.result}" alt="Profile Photo"
                             class="img-fluid rounded-circle border border-2"
                             style="width: 120px; height: 120px; object-fit: cover;">
                        <button type="button" id="change-profile-photo-btn" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle p-1">
                            <i class="fas fa-camera"></i>
                        </button>
                    `;
                    // Reattach event listener to new button
                    document.getElementById('change-profile-photo-btn').addEventListener('click', function() {
                        profilePhotoInput.click();
                    });
                }
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addressFields = ['address', 'city', 'state', 'zip_code'];

    async function getCoordinates() {
        const address = addressFields.map(f => document.getElementById(f).value).join(', ');
        if (!address.trim()) return;

        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`);
            const data = await response.json();
            if (data && data.length > 0) {
                const lat = data[0].lat;
                const lon = data[0].lon;
                console.log('Latitude:', lat, 'Longitude:', lon); // use these values as needed
                return { lat, lon };
            } else {
                console.warn('No coordinates found for this address');
            }
        } catch (error) {
            console.error('Geocoding error:', error);
        }
    }

    // Optional: Get coordinates before form submission
    const profileForm = document.querySelector('form');
    profileForm.addEventListener('submit', async function(e) {
        const coords = await getCoordinates();
        if (coords) {
            // If you want to send it to backend without DB, you can add hidden inputs dynamically
            let latInput = document.getElementById('latitude-temp');
            let lonInput = document.getElementById('longitude-temp');

            if (!latInput) {
                latInput = document.createElement('input');
                latInput.type = 'hidden';
                latInput.name = 'latitude-temp';
                latInput.id = 'latitude-temp';
                profileForm.appendChild(latInput);
            }
            if (!lonInput) {
                lonInput = document.createElement('input');
                lonInput.type = 'hidden';
                lonInput.name = 'longitude-temp';
                lonInput.id = 'longitude-temp';
                profileForm.appendChild(lonInput);
            }

            latInput.value = coords.lat;
            lonInput.value = coords.lon;
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addressFields = ['address', 'city', 'state', 'zip_code'];

    async function geocodeAddress() {
        const address = addressFields.map(f => document.getElementById(f).value).join(', ');
        if (!address.trim()) return;

        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`);
            const data = await response.json();
            if (data && data.length > 0) {
                document.getElementById('latitude').value = data[0].lat;
                document.getElementById('longitude').value = data[0].lon;
            } else {
                console.warn('No coordinates found for this address');
            }
        } catch (error) {
            console.error('Geocoding error:', error);
        }
    }

    // Generate coordinates before form submission
    const profileForm = document.querySelector('form');
    profileForm.addEventListener('submit', async function(e) {
        await geocodeAddress();
    });

    // Optional: Update coordinates when user leaves an address field
    addressFields.forEach(field => {
        document.getElementById(field).addEventListener('blur', geocodeAddress);
    });
});
</script>

@endsection
