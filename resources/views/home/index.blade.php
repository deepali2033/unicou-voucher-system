@extends('layouts.app')

@section('title', 'Professional Cleaning Services - CleanyCo')
@section('meta_description', 'Professional cleaning services for homes, offices, and commercial spaces. Deep cleaning, recurring cleaning, move-in/out cleaning, and more. Get your free quote today!')
@section('meta_keywords', 'cleaning services, house cleaning, office cleaning, deep cleaning, apartment cleaning, commercial cleaning, professional cleaners')

@section('content')
    <article id="post-17" class="full post-17 page type-page status-publish hentry">
        <div class="page-content clearfix the-content-parent">
            <div data-elementor-type="wp-page" data-elementor-id="17" class="elementor elementor-17" data-elementor-post-type="page">
                <!--- START .elementor-section-wrap -->
                @include('home.hero')
@include('home.ratings')
                @include('home.howitswork')
                @include('home.whoweare')
                @include('home.categories')
                @include('home.testimonial')
                @include('home.getquote')
                @include('home.faq')
                @include('home.fromourblog')
            </div>
        </div>
    </article>

@endsection

@push('styles')

@endpush
@push('scripts')

@endpush
