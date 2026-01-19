<!DOCTYPE html>
@php
    $availableLocales = ['en', 'nl'];
    $activeLocale = session('app_locale', app()->getLocale());
    if (!in_array($activeLocale, $availableLocales, true)) {
        $activeLocale = 'en';
    }
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="elementor-kit-4"
    data-active-locale="{{ $activeLocale }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Professional Cleaning Services - KOAServices')</title>
    <meta name="description"
        content="@yield('meta_description', 'Professional cleaning services for homes, offices, and commercial spaces. Deep cleaning, recurring cleaning, move-in/out cleaning, and more. Get your free quote today!')">
    <meta name="keywords"
        content="@yield('meta_keywords', 'cleaning services, house cleaning, office cleaning, deep cleaning, apartment cleaning, commercial cleaning')">
    <link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @include('layouts.head')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('styles')
</head>
<style>
    .margin-set {
        margin-top: 7rem !important;

    }

    @media(max-width: 1024px) {
        .margin-set {
            margin-top: 3rem !important;

        }
    }

    @media (max-width: 435px) {
        .elementor-142 .elementor-element.elementor-element-870dcb4 img {
            max-width: 80px !important;
        }

        .width-set {
            max-width: 200px !important;

        }

        .margin-set {
            margin-top: 1rem !important;
        }

        .book-service-btn {
            width: 100% !important;
        }

        #job-distance-filter {
            padding: 10px 19px !important;
        }

        .scroll-left,
        .scroll-right,
        .swiper-button-prev,
        .swiper-button-next {
            display: none !important;
        }

        .footer-social-icons {
            background: white;
            padding: 5px 10px;
            border-radius: 30px;
            width: 176px !important;
            height: 39px !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }
    }
</style>

<body
    class="elementor-kit-4 home wp-singular page-template-default page page-id-17 wp-custom-logo wp-embed-responsive wp-theme-clanyeco full header-layout-logo-menu has-page-header no-middle-header responsive-layout vamtam-is-elementor elementor-active elementor-pro-active vamtam-wc-cart-empty wc-product-gallery-slider-active vamtam-font-smoothing layout-full elementor-default elementor-kit-4 elementor-page elementor-page-17">
    <div id="top"></div>
    <div id="page" class="site">
        <!-- Header -->
        @include('layouts.header')
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
            @include('layouts.footer')
        </div>
    </div>

    <!-- Scripts -->
    @include('layouts.script')
    <div id="google_translate_element" style="display:none;"></div>
    <style>
        body>.skiptranslate {
            display: none;
        }

        body {
            top: 0 !important;
        }
    </style>
    <script>
        (function () {
            var pendingCode = document.documentElement.dataset.activeLocale || 'en';
            function restore() {
                var combo = document.querySelector('#google_translate_element select');
                if (!combo) {
                    setTimeout(restore, 100);
                    return;
                }
                combo.value = 'en';
                combo.dispatchEvent(new Event('change'));
            }
            function applyLocale(code) {
                var combo = document.querySelector('#google_translate_element select');
                if (!combo) {
                    setTimeout(function () { applyLocale(code); }, 100);
                    return;
                }
                if (combo.value !== code) {
                    combo.value = code;
                }
                combo.dispatchEvent(new Event('change'));
            }
            window.initGoogleTranslate = function () {
                new google.translate.TranslateElement({ pageLanguage: 'en', includedLanguages: 'en,nl', autoDisplay: false }, 'google_translate_element');
                if (pendingCode === 'en') {
                    setTimeout(restore, 200);
                } else {
                    setTimeout(function () { applyLocale(pendingCode); }, 200);
                }
            };
            window.applyGoogleTranslate = function (code) {
                pendingCode = code || 'en';
                if (pendingCode === 'en') {
                    restore();
                } else {
                    applyLocale(pendingCode);
                }
            };
            document.addEventListener('click', function (event) {
                var item = event.target.closest('.language-switcher [data-locale]');
                if (!item) {
                    return;
                }
                var selected = item.getAttribute('data-locale') || 'en';
                document.documentElement.dataset.activeLocale = selected;
                window.applyGoogleTranslate(selected);
            });
        })();
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=initGoogleTranslate"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('partials.auth-popup')
    @stack('scripts')

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


    @push('styles')
        <link rel="stylesheet" id="elementor-post-140-css"
            href='{{ asset("wp-content/uploads/elementor/css/post-21.css") }}?ver=1752678329' type='text/css' media='all' />
        <link rel="stylesheet" id="elementor-post-140-css"
            href='{{ asset("wp-content/uploads/elementor/css/post-140.css") }}?ver=1752680768' type='text/css'
            media='all' />
        <link rel="stylesheet" id="elementor-post-1007-css"
            href='{{ asset("wp-content/uploads/elementor/css/post-1007.css") }}?ver=1752677976' type='text/css'
            media='all' />
        <link rel="stylesheet" id="elementor-post-3145-css"
            href='{{ asset("wp-content/uploads/elementor/css/post-3145.css") }}?ver=1752680430' type='text/css'
            media='all' />
        <link rel="stylesheet" id="elementor-post-156-css"
            href='{{ asset("wp-content/uploads/elementor/css/post-156.css") }}?ver=1752677977' type='text/css'
            media='all' />
        <link data-minify="1" rel="stylesheet" id="vamtam-front-all-css"
            href='{{ asset("wp-content/cache/min/1/wp-content/themes/clanyeco/vamtam/assets/css/dist/elementor/elementor-all.css") }}?ver=1752677977'
            type='text/css' media='all' />
    @endpush
    <script>     $(document).ready(function () {
            // Initialize any required JS components here
            console.log('Register page loaded');
        });</script>
</body>

</html>