@extends('layouts.app')

@section('title', 'Professional Cleaning Services - KOA Service')
@section('meta_description', 'Comprehensive cleaning services including house cleaning, office cleaning, deep cleaning, apartment cleaning, and commercial cleaning. Professional, reliable, and affordable.')

@section('content')
    <article id="post-21" class="full post-21 page type-page status-publish hentry">
        <div data-elementor-type="single-page" data-elementor-id="3575"
            class="elementor elementor-3575 elementor-location-single post-21 page type-page status-publish hentry"
            data-elementor-post-type="elementor_library">
            <div class="elementor-element elementor-element-505758b e-con-full e-flex e-con e-parent" data-id="505758b"
                data-element_type="container">
                <div class="elementor-element elementor-element-cf2b2b6 e-flex e-con-boxed e-con e-child" data-id="cf2b2b6"
                    data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-b4174a5 elementor-position-right elementor-widget__width-auto elementor-mobile-position-right elementor-vertical-align-top animated-fast elementor-view-default elementor-vertical-align-top elementor-invisible elementor-widget elementor-widget-icon-box"
                            data-id="b4174a5" data-element_type="widget"
                            data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:50}"
                            data-widget_type="icon-box.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-icon-box-wrapper">

                                    <div class="elementor-icon-box-icon">
                                        <span class="elementor-icon">
                                            <i aria-hidden="true" class="vamtamtheme- vamtam-theme-title-dec"></i> </span>
                                    </div>

                                    <div class="elementor-icon-box-content">

                                        <h6 class="elementor-icon-box-title">
                                            <span>
                                                Services </span>
                                        </h6>


                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-c171e0c animated-fast elementor-invisible elementor-widget elementor-widget-theme-post-excerpt"
                            data-id="c171e0c" data-element_type="widget"
                            data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                            data-widget_type="theme-post-excerpt.default">
                            <div class="elementor-widget-container">
                              Jobs We Provide </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-a9d4ba4 e-con-full e-flex e-con e-parent" data-id="a9d4ba4"
                data-element_type="container">
                <div class="elementor-element elementor-element-c6feda8 elementor-widget elementor-widget-theme-post-content"
                    data-id="c6feda8" data-element_type="widget" data-widget_type="theme-post-content.default">
                    <div class="elementor-widget-container">
                        <div data-elementor-type="wp-page" data-elementor-id="21" class="elementor elementor-21"
                            data-elementor-post-type="page">
                            <div class="elementor-element elementor-element-0e6a1db e-flex e-con-boxed e-con e-parent"
                                data-id="0e6a1db" data-element_type="container">
                                <div class="e-con-inner">
                                    <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-5b8f072 elementor-grid-tablet-2 elementor-grid-3 elementor-grid-mobile-1 elementor-widget elementor-widget-loop-grid"
                                        data-id="5b8f072" data-element_type="widget"
                                        data-settings="{&quot;template_id&quot;:&quot;3363&quot;,&quot;columns_tablet&quot;:2,&quot;row_gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:20,&quot;sizes&quot;:[]},&quot;_skin&quot;:&quot;post&quot;,&quot;columns&quot;:&quot;3&quot;,&quot;columns_mobile&quot;:&quot;1&quot;,&quot;edit_handle_selector&quot;:&quot;[data-elementor-type=\&quot;loop-item\&quot;]&quot;,&quot;row_gap_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;row_gap_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
                                        data-widget_type="loop-grid.post">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-loop-container elementor-grid" role="list">
                                                @if($jobs && $jobs->count() > 0)
                                                    @foreach($jobs as $index => $job)
                                                        @if($job->jobtoggle == request()->routeIs('jobs.house-jobs') ? 'customer' : 'recruiter')
                                                        <style id="loop-dynamic-{{ $job->id }}">
                                                            .e-loop-item-{{ $job->id }} .elementor-element.elementor-element-e6f5759:not(.elementor-motion-effects-element-type-background),
                                                            .e-loop-item-{{ $job->id }} .elementor-element.elementor-element-e6f5759>.elementor-motion-effects-container>.elementor-motion-effects-layer {
                                                                @if($job->image)
                                                                    background-image: url("{{ asset('storage/' . $job->image) }}");
                                                                @else
                                                                    background-image: url("../wp-content/uploads/2025/01/GettyImages-1456829834.jpg");
                                                                @endif
                                                            }
                                                        </style>
                                                        <div data-elementor-type="loop-item" data-elementor-id="3363"
                                                            class="elementor elementor-3363 e-loop-item e-loop-item-{{ $job->id }} post-{{ $job->id }} page type-page status-publish has-post-thumbnail hentry"
                                                            data-elementor-post-type="elementor_library"
                                                            data-custom-edit-handle="1">
                                                            <div class="elementor-element elementor-element-badd977 e-con-full animated-fast e-flex elementor-invisible e-con e-child"
                                                                data-id="badd977" data-element_type="container"
                                                                data-settings="{"background_background":"classic","animation_delay":{{ 450 + ($index * 50) }},"animation":"fadeIn"}">
                                                                <a class="elementor-element elementor-element-2b35ac8 e-con-full e-flex e-con e-child"
                                                                    data-id="2b35ac8" data-element_type="container"
                                                                    href="">
                                                                    <div class="elementor-element elementor-element-e6f5759 e-con-full mask-bottom vamtam-has-theme-cp vamtam-cp-bottom-right e-flex e-con e-child"
                                                                        data-id="e6f5759" data-element_type="container"
                                                                        data-settings="{"background_background":"classic"}">
                                                                    </div>
                                                                    <div class="elementor-element elementor-element-e9e3423 elementor-widget elementor-widget-theme-post-title elementor-page-title elementor-widget-heading"
                                                                        data-id="e9e3423" data-element_type="widget"
                                                                        data-widget_type="theme-post-title.default">
                                                                        <div class="elementor-widget-container">
                                                                            <h4 class="elementor-heading-title elementor-size-default">
                                                                                <a href="">{{ $job->title }}</a>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="elementor-element elementor-element-0e2d19f elementor-widget elementor-widget-theme-post-excerpt"
                                                                        data-id="0e2d19f" data-element_type="widget"
                                                                        data-widget_type="theme-post-excerpt.default">
                                                                        <div class="elementor-widget-container">
                                                                            {{ $job->short_description }}
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <a class="elementor-element elementor-element-d65d175 e-con-full e-flex e-con e-child"
                                                                    data-id="d65d175" data-element_type="container">
                                                                    <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-6ed9e09 elementor-align-justify elementor-widget__width-initial vamtam-has-hover-anim vamtam-has-icon-styles elementor-widget elementor-widget-button"
                                                                        data-id="6ed9e09" data-element_type="widget"
                                                                        data-widget_type="button.default">
                                                                        <div class="elementor-widget-container">
                                                                            <div class="elementor-button-wrapper">
                                                                                <a class="elementor-button elementor-button-link elementor-size-sm"
                                                                                    href="">
                                                                                    <span class="elementor-button-content-wrapper">
                                                                                        <span class="elementor-button-icon">
                                                                                            <i aria-hidden="true" class="vamtamtheme- vamtam-theme-arrow-right"></i>
                                                                                        </span>
                                                                                        <span class="elementor-button-text">Learn more</span>
                                                                                    </span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <!-- Fallback message if no services exist -->
                                                    <div class="no-services-message">
                                                        <p>No services are currently available. Please check back later.</p>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Add-on Services Section -->
                            <div class="elementor-element elementor-element-819ca19 e-flex e-con-boxed e-con e-parent"
                                data-id="819ca19" data-element_type="container">
                                <div class="e-con-inner">
                                    <div class="elementor-element elementor-element-25cb05a elementor-position-right elementor-widget__width-auto elementor-mobile-position-right elementor-vertical-align-top animated-fast elementor-view-default elementor-vertical-align-top elementor-invisible elementor-widget elementor-widget-icon-box"
                                        data-id="25cb05a" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:50}"
                                        data-widget_type="icon-box.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-icon-box-wrapper">

                                                <div class="elementor-icon-box-icon">
                                                    <span class="elementor-icon">
                                                        <i aria-hidden="true"
                                                            class="vamtamtheme- vamtam-theme-title-dec"></i> </span>
                                                </div>

                                                <div class="elementor-icon-box-content">

                                                    <h6 class="elementor-icon-box-title">
                                                        <span>
                                                           Jobs </span>
                                                    </h6>


                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-49c6d9d animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                                        data-id="49c6d9d" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                                        data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">Add-on Services for a
                                                Deeper Clean</h2>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-d260e12 animated-fast elementor-invisible elementor-widget elementor-widget-text-editor"
                                        data-id="d260e12" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200}"
                                        data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container">
                                            <p>Our services go beyond a basic cleaning. Before each visit, you can choose
                                                the add-ons that will make your life simpler.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@push('styles')
  <link rel='stylesheet' id='elementor-post-21-css' href='{{ asset("wp-content/uploads/elementor/css/post-21.css") }}?ver=1752678329' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-142-css' href='{{ asset("wp-content/uploads/elementor/css/post-142.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-1007-css' href='{{ asset("wp-content/uploads/elementor/css/post-1007.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-3575-css' href='{{ asset("wp-content/uploads/elementor/css/post-3575.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-156-css' href='{{ asset("wp-content/uploads/elementor/css/post-156.css") }}?ver=1752677977' type='text/css' media='all'>
@endpush
