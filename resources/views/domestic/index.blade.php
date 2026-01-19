@extends('layouts.app')

@section('title', 'Professional Cleaning Services - CleanyCo')
@section('meta_description', 'Professional cleaning services for homes, offices, and commercial spaces. Deep cleaning, recurring cleaning, move-in/out cleaning, and more. Get your free quote today!')
@section('meta_keywords', 'cleaning services, house cleaning, office cleaning, deep cleaning, apartment cleaning, commercial cleaning, professional cleaners')

@section('content')
    <article id="post-17" class="full post-17 page type-page status-publish hentry">
        <div class="page-content clearfix the-content-parent">
            <div data-elementor-type="wp-page" data-elementor-id="17" class="elementor elementor-17"
                data-elementor-post-type="page">
                @include('domestic.main-section')
                <!--- START .elementor-section-wrap -->
                {{-- @include('home.hero') --}}
                {{-- @include('home.howitswork')
                @include('home.whoweare') --}}

                {{-- @include('home.testimonial')
                @include('home.getquote')
                @include('home.faq')
                @include('home.fromourblog') --}}
                @if(!empty($selectedCity))
                    @include('domestic.cleanners-list')
                @endif
                @include('domestic.services')
                @include('domestic.cleanner-near-me')
            </div>
        </div>
    </article>

@endsection

@push('styles')

@endpush
@push('scripts')

@endpush

@push('styles')
    <link rel='stylesheet' id='elementor-post-2989-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-2989.css") }}?ver=1752678329' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-142-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-142.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-1007-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-1007.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-3145-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-3145.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-156-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-156.css") }}?ver=1752677977' type='text/css' media='all'>
@endpush