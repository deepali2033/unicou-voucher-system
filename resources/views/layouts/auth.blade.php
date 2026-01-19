<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="elementor-kit-4">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Professional Cleaning Services - KOAServices')</title>
    <meta name="description" content="@yield('meta_description', 'Professional cleaning services for homes, offices, and commercial spaces. Deep cleaning, recurring cleaning, move-in/out cleaning, and more. Get your free quote today!')">
    <meta name="keywords" content="@yield('meta_keywords', 'cleaning services, house cleaning, office cleaning, deep cleaning, apartment cleaning, commercial cleaning')">

    @include('layouts.head')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('styles')
</head>
<body class="elementor-kit-4 home wp-singular page-template-default page page-id-17 wp-custom-logo wp-embed-responsive wp-theme-clanyeco full header-layout-logo-menu has-page-header no-middle-header responsive-layout vamtam-is-elementor elementor-active elementor-pro-active vamtam-wc-cart-empty wc-product-gallery-slider-active vamtam-font-smoothing layout-full elementor-default elementor-kit-4 elementor-page elementor-page-17">
    <div id="top"></div>
    <div id="page" class="site">
        <!-- Header -->
        <div id="page" class="main-container">
            <div id="main-content">
                <div id="sub-header" class="layout-full elementor-page-title">
                    <div class="meta-header">
                        <!-- Elementor `page-title` location -->
                    </div>
                </div>
                <div class="page-wrapper">
                    <div id="main" role="main" class="vamtam-main layout-full">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @include('layouts.script')
    @include('partials.auth-popup')
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Loading indicator -->
    <div id="loading" style="display: none;">
        <img src="{{ asset('images/loader-ring.gif') }}" alt="Loading...">
    </div>

    @if(session('success'))
        <div class="toast toast-success" role="alert">
            <div class="toast-body">
                {{ session('success') }}
                <button type="button" class="toast-close" aria-label="Close">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="toast toast-error" role="alert">
            <div class="toast-body">
                {{ session('error') }}
                <button type="button" class="toast-close" aria-label="Close">&times;</button>
            </div>
        </div>
    @endif
</body>
</html>