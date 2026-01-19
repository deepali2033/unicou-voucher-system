@extends('layouts.app')

@section('title', 'Professional Cleaning Services - KOA Service')
@section('meta_description', 'Comprehensive cleaning services including house cleaning, office cleaning, deep cleaning, apartment cleaning, and commercial cleaning. Professional, reliable, and affordable.')

@section('content')
    <article id="post-21" class="full post-21 page type-page status-publish hentry">
        <div data-elementor-type="single-page" data-elementor-id="3575"
            class="elementor elementor-3575 elementor-location-single post-21 page type-page status-publish hentry"
            data-elementor-post-type="elementor_library">
            <div class="elementor-element elementor-element-505758b e-con-full e-flex margin-set e-con e-parent"
                data-id="505758b" data-element_type="container">
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
                                            <!-- <span>
                                                    Services </span> -->
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
                                @if($selectedCategory)
                                    {{ $selectedCategory->name }} Services
                                @else
                                    Services We Provide
                                @endif
                            </div>
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
                                    @if($selectedCategory)
                                        <!-- Category Filter Indicator -->
                                        <!-- <div class="category-filter-indicator" style="margin-bottom: 30px; padding: 15px 20px; background: #f8f9fa; border-left: 4px solid #e8ea66ff; border-radius: 5px;">
                                                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                                                        <div>
                                                            <strong style="color: #333;">Filtering by: {{ $selectedCategory->name }}</strong>
                                                            <span style="color: #666; margin-left: 10px;">({{ $services->count() }} {{ $services->count() === 1 ? 'service' : 'services' }} found)</span>
                                                        </div>
                                                        <a href="{{ route('services.index') }}" style="color: #666; text-decoration: none; font-size: 14px; padding: 5px 10px; border: 1px solid #ddd; border-radius: 3px; transition: all 0.3s ease;">
                                                            ✕ Clear Filter
                                                        </a>
                                                    </div>
                                                </div> -->
                                    @endif

                                    <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-5b8f072 elementor-grid-tablet-2 elementor-grid-3 elementor-grid-mobile-1 elementor-widget elementor-widget-loop-grid"
                                        data-id="5b8f072" data-element_type="widget"
                                        data-settings="{&quot;template_id&quot;:&quot;3363&quot;,&quot;columns_tablet&quot;:2,&quot;row_gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:20,&quot;sizes&quot;:[]},&quot;_skin&quot;:&quot;post&quot;,&quot;columns&quot;:&quot;3&quot;,&quot;columns_mobile&quot;:&quot;1&quot;,&quot;edit_handle_selector&quot;:&quot;[data-elementor-type=\&quot;loop-item\&quot;]&quot;,&quot;row_gap_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;row_gap_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
                                        data-widget_type="loop-grid.post">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-loop-container elementor-grid" role="list">
                                                @if($services && $services->count() > 0)
                                                    @foreach($services as $index => $service)
                                                        <style id="loop-dynamic-{{ $service->id }}">
                                                            .e-loop-item-{{ $service->id }} .elementor-element.elementor-element-e6f5759:not(.elementor-motion-effects-element-type-background),
                                                            .e-loop-item-{{ $service->id }} .elementor-element.elementor-element-e6f5759>.elementor-motion-effects-container>.elementor-motion-effects-layer {
                                                                @if($service->image && file_exists(public_path('storage/' . $service->image)))
                                                                    background-image: url("{{ asset('storage/' . $service->image) }}");
                                                                @else background-image: url("{{ asset('wp-content/uploads/2025/01/GettyImages-1456829834.jpg') }}");
                                                                @endif
                                                            }
                                                        </style>
                                                        <div data-elementor-type="loop-item" data-elementor-id="3363"
                                                            class="elementor elementor-3363 e-loop-item e-loop-item-{{ $service->id }} post-{{ $service->id }} page type-page status-publish has-post-thumbnail hentry"
                                                            data-elementor-post-type="elementor_library"
                                                            data-custom-edit-handle="1">
                                                            <div class="elementor-element elementor-element-badd977 e-con-full animated-fast e-flex elementor-invisible e-con e-child"
                                                                data-id="badd977" data-element_type="container"
                                                                data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation_delay&quot;:{{ 450 + ($index * 50) }},&quot;animation&quot;:&quot;fadeIn&quot;}">
                                                                <a class="elementor-element elementor-element-2b35ac8 e-con-full e-flex e-con e-child"
                                                                    data-id="2b35ac8" data-element_type="container"
                                                                    href="{{ route('services.show', $service->slug) }}">
                                                                    <div class="elementor-element elementor-element-e6f5759 e-con-full mask-bottom vamtam-has-theme-cp vamtam-cp-bottom-right e-flex e-con e-child"
                                                                        data-id="e6f5759" data-element_type="container"
                                                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                                    </div>
                                                                    <div class="elementor-element elementor-element-e9e3423 elementor-widget elementor-widget-theme-post-title elementor-page-title elementor-widget-heading"
                                                                        data-id="e9e3423" data-element_type="widget"
                                                                        data-widget_type="theme-post-title.default">
                                                                        <div class="elementor-widget-container">
                                                                            <h4
                                                                                class="elementor-heading-title elementor-size-default">
                                                                                <a
                                                                                    href="{{ route('services.show', $service->slug) }}">{{ $service->name }}</a>
                                                                            </h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="elementor-element elementor-element-0e2d19f elementor-widget elementor-widget-theme-post-excerpt"
                                                                        data-id="0e2d19f" data-element_type="widget"
                                                                        data-widget_type="theme-post-excerpt.default">
                                                                        <div class="elementor-widget-container">
                                                                            {{ $service->short_description }}
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
                                                                                    href="{{ route('services.show', $service->slug) }}">
                                                                                    <span class="elementor-button-content-wrapper">
                                                                                        <span class="elementor-button-icon">
                                                                                            <i aria-hidden="true"
                                                                                                class="vamtamtheme- vamtam-theme-arrow-right"></i>
                                                                                        </span>
                                                                                        <span class="elementor-button-text">Learn
                                                                                            more</span>
                                                                                    </span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <!-- Fallback message if no services exist -->
                                                    <div class="no-services-message"
                                                        style="text-align: center; padding: 60px 20px; color: #666; grid-column: 1 / -1;">
                                                        @if($selectedCategory)
                                                            <h4 style="color: #333; margin-bottom: 10px;">No services found for
                                                                {{ $selectedCategory->name }}</h4>
                                                            <p style="margin-bottom: 20px;">Sorry, we don't currently have any
                                                                services available in the {{ $selectedCategory->name }} category.
                                                            </p>
                                                            <a href="{{ route('services.index') }}" class="btn-view-all-services"
                                                                style="display: inline-block; padding: 12px 24px; background: #e8ea66ff; color: #333; text-decoration: none; border-radius: 5px; font-weight: 600; transition: all 0.3s ease;">
                                                                View All Services
                                                            </a>
                                                        @else
                                                            <h4 style="color: #333; margin-bottom: 10px;">No services available</h4>
                                                            <p>No services are currently available. Please check back later.</p>
                                                        @endif
                                                    </div>
                                                @endif

                                                <style id="loop-3363">
                                                    .elementor-3363 .elementor-element.elementor-element-badd977 {
                                                        --display: flex;
                                                        --flex-direction: column;
                                                        --container-widget-width: 100%;
                                                        --container-widget-height: initial;
                                                        --container-widget-flex-grow: 0;
                                                        --container-widget-align-self: initial;
                                                        --flex-wrap-mobile: wrap;
                                                        --justify-content: space-between;
                                                        --gap: 20px 0px;
                                                        --row-gap: 20px;
                                                        --column-gap: 0px;
                                                        --border-radius: 32px 32px 32px 32px;
                                                        --padding-top: 40px;
                                                        --padding-bottom: 40px;
                                                        --padding-left: 40px;
                                                        --padding-right: 40px;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-badd977:not(.elementor-motion-effects-element-type-background),
                                                    .elementor-3363 .elementor-element.elementor-element-badd977>.elementor-motion-effects-container>.elementor-motion-effects-layer {
                                                        background-color: var(--e-global-color-vamtam_accent_4);
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-2b35ac8 {
                                                        --display: flex;
                                                        --justify-content: flex-start;
                                                        --gap: 0px 0px;
                                                        --row-gap: 0px;
                                                        --column-gap: 0px;
                                                        --margin-top: 0;
                                                        --margin-bottom: 0;
                                                        --margin-left: 0;
                                                        --margin-right: 0;
                                                        --padding-top: 0px;
                                                        --padding-bottom: 0px;
                                                        --padding-left: 0px;
                                                        --padding-right: 0px;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-e6f5759 {
                                                        --display: flex;
                                                        --min-height: 215px;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-e6f5759:not(.elementor-motion-effects-element-type-background),
                                                    .elementor-3363 .elementor-element.elementor-element-e6f5759>.elementor-motion-effects-container>.elementor-motion-effects-layer {
                                                        background-position: center center;
                                                        background-repeat: no-repeat;
                                                        background-size: cover;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-e9e3423>.elementor-widget-container {
                                                        margin: 10px 0px 0px 0px;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-e9e3423 .elementor-heading-title a:hover,
                                                    .elementor-3363 .elementor-element.elementor-element-e9e3423 .elementor-heading-title a:focus {
                                                        color: var(--e-global-color-vamtam_accent_2);
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-0e2d19f>.elementor-widget-container {
                                                        margin: 0px 0px 0px 0px;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-d65d175 {
                                                        --display: flex;
                                                        --gap: 10px 0px;
                                                        --row-gap: 10px;
                                                        --column-gap: 0px;
                                                        --margin-top: 0;
                                                        --margin-bottom: 0;
                                                        --margin-left: 0;
                                                        --margin-right: 0;
                                                        --padding-top: 0px;
                                                        --padding-bottom: 0px;
                                                        --padding-left: 0px;
                                                        --padding-right: 0px;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-6ed9e09 {
                                                        width: var(--container-widget-width, 90%);
                                                        max-width: 90%;
                                                        --container-widget-width: 90%;
                                                        --container-widget-flex-grow: 0;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-6ed9e09>.elementor-widget-container {
                                                        margin: 0% 0% 0% 0%;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-6ed9e09 .elementor-button-content-wrapper {
                                                        flex-direction: row-reverse;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-6ed9e09 .elementor-button .elementor-button-content-wrapper {
                                                        justify-content: space-between;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-6ed9e09 .elementor-button {
                                                        padding: 8px 9px 8px 20px;
                                                    }

                                                    .elementor-3363 .elementor-element.elementor-element-6ed9e09.vamtam-has-icon-styles .elementor-button-icon :is(svg, i) {
                                                        font-size: 8px;
                                                        fill: var(--e-global-color-vamtam_accent_2);
                                                        color: var(--e-global-color-vamtam_accent_2);
                                                        background-color: var(--e-global-color-vamtam_accent_5);
                                                        border-radius: 100px 100px 100px 100px;
                                                        padding: 8px 8px 8px 8px;
                                                    }
                                                </style>

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

                                                <!-- <div class="elementor-icon-box-icon">
                                                        <span class="elementor-icon">
                                                            <i aria-hidden="true"
                                                                class="vamtamtheme- vamtam-theme-title-dec"></i> </span>
                                                    </div> -->

                                                <!-- <div class="elementor-icon-box-content">

                                                        <h6 class="elementor-icon-box-title">
                                                            <span>
                                                                Add-on services </span>
                                                        </h6>


                                                    </div> -->

                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="elementor-element elementor-element-49c6d9d animated-fast elementor-invisible elementor-widget elementor-widget-heading"
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
                                        </div> -->
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
    <link rel='stylesheet' id='elementor-post-21-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-21.css") }}?ver=1752678329' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-142-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-142.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-1007-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-1007.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-3575-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-3575.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-156-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-156.css") }}?ver=1752677977' type='text/css' media='all'>
@endpush