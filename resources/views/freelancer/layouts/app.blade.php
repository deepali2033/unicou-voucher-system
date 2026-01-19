<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Freelancer Panel') - KOA Services</title>
    <link rel="icon" href="{{ asset('/wp-content/uploads/2024/12/fav-icon-150x150.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('/wp-content/uploads/2024/12/fav-icon.png') }}" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('/wp-content/uploads/2024/12/fav-icon.png') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom Admin CSS -->
    <link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet">
    @stack('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row koa-sidebar-wrapper flex-lg-nowrap">
            <!-- Overlay -->
            <div id="overlay" class="overlay"></div>

            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-3 sidebar sidebar-hidden">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4 d-flex justify-content-between align-items-center px-3">
                        <a class="text-start" href="/">
                            <img src="/images/company_logo.png" class="dashboard-logo" alt=""> </a>
                        <button id="close-sidebar" class="btn btn-link text-dark d-lg-none">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>


                    <ul class="nav flex-column gap-2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('freelancer.dashboard') ? 'active' : '' }}"
                                href="{{ route('freelancer.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <!-- <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}"> -->
                            <a class="nav-link {{ request()->routeIs('freelancer.profile.show') ? 'active' : '' }}"
                                href="{{ route('freelancer.profile.show') }}">
                                <i class="fas fa-user me-2"></i>
                                My Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('freelancer.applied-jobs.*') ? 'active' : '' }}"
                                href="{{ route('freelancer.applied-jobs.index') }}">
                                <i class="fas fa-briefcase me-2"></i>
                                Apply-list
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('freelancer.notifications.*') ? 'active' : '' }}"
                                href="{{ route('freelancer.notifications.index') }}">
                                <i class="fas fa-bell me-2"></i>
                                Notifications
                            </a>
                        </li>


                    </ul>

                    <hr class="my-3" style="border-color: #495057;">

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>
                                View Website
                            </a>
                        </li>
                        <form method="POST" action="{{ route('auth.logout') }}" style="margin:0;">
                            @csrf
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">
                                    <i class="fas fa-external-link-alt me-2"></i>
                                    <button type="submit" style="all:unset;">Logout</button>
                                </a>
                            </li>
                        </form>
                    </ul>
                </div>
            </nav>
            <style>
                .mobile-logo {
                    max-width: 75px;
                }

                .mobile-header {
                    display: flex;
                    justify-content: space-between;
                }
            </style>
            <div class="mobile-header text-end d-lg-none">
                <a class="text-start" href="/">
                    <img src="/images/company_logo.png" class="mobile-logo" alt=""> </a>
                <button id="open-sidebar" class="btn navbtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4 main-content">

                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

                    <h1 class="h2">@yield('page-title', 'Dashboard')</h1>

                    @yield('page-actions')
                </div>

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const openSidebarBtn = document.getElementById('open-sidebar');
        const closeSidebarBtn = document.getElementById('close-sidebar');
        const overlay = document.getElementById('overlay');

        openSidebarBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.remove('sidebar-hidden');
            overlay.classList.add('overlay-active');
        });

        closeSidebarBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.add('sidebar-hidden');
            overlay.classList.remove('overlay-active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('sidebar-hidden');
            overlay.classList.remove('overlay-active');
        });

        // Close sidebar when clicking outside on mobile/tablet
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 992 && !sidebar.contains(e.target) && !openSidebarBtn.contains(e.target)) {
                sidebar.classList.add('sidebar-hidden');
                overlay.classList.remove('overlay-active');
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    <!-- Quick Profile Photo Upload Modal -->
    <div class="modal fade" id="quickUploadModal" tabindex="-1" aria-labelledby="quickUploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quickUploadModalLabel">Update Profile Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="quick-photo-form" action="{{ route('freelancer.profile.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body text-center">
                        <input type="file" id="quick-profile-photo-input" name="profile_photo" accept="image/*"
                            style="display: none;">
                        <div class="mb-3">
                            <div id="photo-preview-container">
                                @if(auth()->user()->profile_photo)
                                    <img id="quick-photo-preview"
                                        src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Current Photo"
                                        class="img-fluid rounded-circle" style="max-width: 150px; max-height: 150px;">
                                @else
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                        style="width: 150px; height: 150px;">
                                        <i class="fas fa-user text-secondary fa-3x"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <button type="button" id="select-photo-btn" class="btn btn-outline-primary">
                            <i class="fas fa-camera me-2"></i>Choose New Photo
                        </button>
                        <div class="mt-2">
                            <small class="text-muted">Accepted formats: JPG, PNG, WebP (Max: 3MB)</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="upload-photo-btn">
                            <i class="fas fa-upload me-2"></i>Update Photo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Quick upload functionality
        document.addEventListener('DOMContentLoaded', function () {
            const quickUploadBtn = document.getElementById('quick-upload-btn');
            const quickUploadModal = new bootstrap.Modal(document.getElementById('quickUploadModal'));
            const selectPhotoBtn = document.getElementById('select-photo-btn');
            const quickPhotoInput = document.getElementById('quick-profile-photo-input');
            const quickPhotoPreview = document.getElementById('quick-photo-preview');
            const photoPreviewContainer = document.getElementById('photo-preview-container');
            const uploadPhotoBtn = document.getElementById('upload-photo-btn');

            // Open modal when quick upload button is clicked
            quickUploadBtn.addEventListener('click', function () {
                quickUploadModal.show();
            });

            // Trigger file input when select photo button is clicked
            selectPhotoBtn.addEventListener('click', function () {
                quickPhotoInput.click();
            });

            // Handle file selection and preview
            quickPhotoInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    // Validate file type
                    if (!file.type.match('image.*')) {
                        alert('Please select a valid image file.');
                        return;
                    }

                    // Validate file size (3MB max)
                    if (file.size > 3 * 1024 * 1024) {
                        alert('File size must be less than 3MB.');
                        return;
                    }

                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        if (quickPhotoPreview) {
                            quickPhotoPreview.src = e.target.result;
                        } else {
                            // Replace placeholder with image
                            photoPreviewContainer.innerHTML = `<img id="quick-photo-preview" src="${e.target.result}" alt="New Photo" class="img-fluid rounded-circle" style="max-width: 150px; max-height: 150px;">`;
                        }
                    };
                    reader.readAsDataURL(file);

                    // Enable upload button
                    uploadPhotoBtn.disabled = false;
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>