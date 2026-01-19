<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - KOA Services</title>
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
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                                href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users me-2"></i>
                                Users Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}"
                                href="{{ route('admin.jobs.index') }}">
                                <i class="fas fa-briefcase me-2"></i>
                                Job Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                                href="{{ route('admin.services.index') }}">
                                <i class="fas fa-broom me-2"></i>
                                Services
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}"
                                href="{{ route('admin.plans.index') }}">
                                <i class="fas fa-wallet me-2"></i>
                                Plans
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.quotes.*') ? 'active' : '' }}"
                                href="{{ route('admin.quotes.index') }}">
                                <i class="fas fa-comment-alt me-2"></i>
                                Quotes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.book-services.*') ? 'active' : '' }}"
                                href="{{ route('admin.book-services.index') }}">
                                <i class="fas fa-calendar-check me-2"></i>
                                Booked Services
                            </a>
                        </li>
 <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.booked-plans.*') ? 'active' : '' }}"
                                href="{{ route('admin.testimonials.index') }}">
                                <i class="fas fa-comments me-2"></i>
                                Testimonials
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.booked-plans.*') ? 'active' : '' }}"
                                href="{{ route('admin.booked-plans.index') }}">
                                <i class="fas fa-tasks me-2"></i>
                                Book Plans
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.subscriptions.*') ? 'active' : '' }}"
                                href="{{ route('admin.subscriptions.index') }}">
                                <i class="fas fa-envelope me-2"></i>
                                Subscribers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.contact-us.*') ? 'active' : '' }}"
                                href="{{ route('admin.contact-us.index') }}">
                                <i class="fas fa-phone me-2"></i>
                                Contact-Us
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}"
                                href="{{ route('admin.notifications.index') }}">
                                <i class="fas fa-bell me-2"></i>
                                Notifications
                                @php
                                    $unreadCount = \App\Models\Notification::where('user_id', auth()->id())->unread()->count();
                                @endphp
                                @if($unreadCount > 0)
                                    <span class="badge bg-danger rounded-pill ms-1">{{ $unreadCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                                href="{{ route('admin.categories.index') }}">
                                <i class="fas fa-th-large me-2"></i>
                                Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.job-categories.*') ? 'active' : '' }}"
                                href="{{ route('admin.job-categories.index') }}">
                                <i class="fas fa-list me-2"></i>
                                Job Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}"
                                href="{{ route('admin.analytics') }}">
                                <i class="fas fa-chart-bar me-2"></i>
                                Reports & Analytics
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
    @stack('scripts')
</body>

</html>