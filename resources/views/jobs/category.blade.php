@extends('layouts.app')
<style>
    body {
        font-family: 'Roboto', Arial, sans-serif;
    }

    .wrapper {
        width: 100%;
        /* max-width: 31.25rem; */
        /* margin: 6rem auto; */
    }

    .label {
        font-size: .625rem;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: +1.3px;
        margin-bottom: 1rem;
    }

    .searchBar {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    #searchQueryInput {
        width: 100%;
        height: 2.8rem;
        background: #f5f5f5;
        outline: none;
        border: none;
        border-radius: 1.625rem;
        padding: 0 3.5rem 0 1.5rem;
        font-size: 1rem;
    }

    /* #job-title-search,
    #job-location-search,
    #job-distance-filter {
        border-radius: 26px !important;
    } */

    #searchQuerySubmit {
        width: 3.5rem;
        height: 2.8rem;
        margin-left: -3.5rem;
        background: none;
        border: none;
        outline: none;
        border-radius: 23px;
    }

    #searchQuerySubmit:hover {
        cursor: pointer;
    }

    .jobs-search-container {
        background: linear-gradient(135deg, #f8fafb 0%, #ffffff 100%);
        border-radius: 16px;
        padding: 28px;
        border: 2px solid #e8f4f8;
        box-shadow: 0 4px 16px rgba(40, 167, 69, 0.08);
        margin-bottom: 40px;
    }

    .search-inputs-row {
        display: grid;
        grid-template-columns: 1fr 1fr 150px auto;
        gap: 16px;
        align-items: end;
    }

    .search-input-group {
        position: relative;
    }

    .search-input-group label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--e-global-color-vamtam_accent_2);
        margin-bottom: 8px;
    }

    .search-input-group input,
    .search-input-group select {
        width: 100%;
        height: 44px;
        padding: 10px 14px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .search-input-group input:focus,
    .search-input-group select:focus {
        outline: none;
        border-color: var(--e-global-color-vamtam_accent_2);
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
    }

    .location-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #ddd;
        border-top: none;
        border-radius: 0 0 8px 8px;
        max-height: 280px;
        overflow-y: auto;
        z-index: 1000;
        display: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .location-suggestions.show {
        display: block;
    }

    .location-suggestion-item {
        padding: 10px 14px;
        cursor: pointer;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s;
        font-size: 14px;
        color: #333;
    }

    .location-suggestion-item:hover {
        background-color: #f5f5f5;
    }

    .location-suggestion-item:last-child {
        border-bottom: none;
    }

    .search-button {
        height: 44px;
        padding: 0 28px;
        background: linear-gradient(135deg, var(--e-global-color-vamtam_accent_2) 0%, #1e8e55 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
    }

    .search-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
    }

    @media (max-width: 1024px) {
        .search-inputs-row {
            grid-template-columns: 1fr 1fr;
        }

        .search-button {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 640px) {
        .search-inputs-row {
            grid-template-columns: 1fr;
        }

        .jobs-search-container {
            padding: 20px;
        }

        .search-button {
            grid-column: 1 / -1;
        }
    }

     #job-title-search,
    #job-location-search,
    #job-distance-filter {
        border-radius: 8px !important;
    }
</style>
@section('title', 'Job Opportunities - KOA Service')
@section('meta_description', 'Explore exciting job opportunities at KOA Service. Find your perfect career in production, kitchen assistance, cleaning, and more.')
@section('content')
    <article id="post-2989" class="full post-2989 page type-page status-publish has-post-thumbnail hentry">
        <div data-elementor-type="single-page" data-elementor-id="3145"
            class="elementor elementor-3145 elementor-location-single post-2989 page type-page status-publish has-post-thumbnail hentry"
            data-elementor-post-type="elementor_library">
            <div class="elementor-element elementor-element-ce49e7c e-con-full e-flex e-con e-parent" data-id="ce49e7c"
                data-element_type="container">
                <div class="elementor-element elementor-element-c34158d e-flex e-con-boxed e-con e-child" data-id="c34158d"
                    data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                    <div data-rocket-location-hash="0bb8abef3c1cf4f2f6dc378583b295e5" class="e-con-inner">
                        <div class="elementor-element elementor-element-138b985 elementor-position-right elementor-widget__width-auto elementor-mobile-position-right elementor-vertical-align-top animated-fast elementor-view-default elementor-vertical-align-top elementor-invisible elementor-widget elementor-widget-icon-box"
                            data-id="138b985" data-element_type="widget"
                            data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:50}"
                            data-widget_type="icon-box.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-icon-box-wrapper">

                                    <div class="elementor-icon-box-icon">
                                        <span class="elementor-icon">
                                            <i aria-hidden="true" class="vamtamtheme- vamtam-theme-title-dec"></i> </span>
                                    </div>

                                    <!-- <div class="elementor-icon-box-content">
                                                                                                                                                    <h6 class="elementor-icon-box-title">
                                                                                                                                                        <span>
                                                                                                                                                            Careers </span>
                                                                                                                                                    </h6>
                                                                                                                                                </div> -->

                                </div>
                            </div>
                        </div>

                        <div class="elementor-element text-center elementor-element-6ac1097 animated-fast elementor-invisible elementor-widget elementor-widget-theme-post-excerpt"
                            data-id="6ac1097" data-element_type="widget"
                            data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:100}"
                            data-widget_type="theme-post-excerpt.default">
                            <span
                                class="inline-flex text-center items-center px-4 py-1 rounded-full text-sm font-semibold bg-[#e7f6ed] text-[#2f9d5d]">
                                Discover Your Next Opportunity
                            </span>
                            <div class="elementor-widget-container">
                                Current Open Positions </div>
                            <p class="mt-3 text-gray-600 max-w-2xl mx-auto text-center">
                                Explore flexible roles across hospitality, cleaning, domestic services, and more. Tap or
                                click
                                on a card to view full details and apply instantly.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-bf6c96a e-flex e-con-boxed e-con e-parent" data-id="bf6c96a"
                data-element_type="container">
                <div class="e-con-inner">
                    <div class="elementor-element elementor-element-22b355d e-transform elementor-invisible elementor-widget elementor-widget-image"
                        data-id="22b355d" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:300,&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_effect&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_direction&quot;:&quot;negative&quot;,&quot;motion_fx_translateY_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;motion_fx_devices&quot;:[&quot;desktop&quot;],&quot;motion_fx_rotateZ_direction&quot;:&quot;negative&quot;,&quot;motion_fx_rotateZ_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:31,&quot;end&quot;:80}},&quot;_transform_rotateZ_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:30,&quot;sizes&quot;:[]},&quot;motion_fx_translateY_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:39,&quot;end&quot;:69}},&quot;motion_fx_rotateZ_effect&quot;:&quot;yes&quot;,&quot;motion_fx_rotateZ_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_tablet&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_mobile&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img width="61" height="100"
                                src="../wp-content/uploads/2025/01/growth-close-up-environmental-lush-natural-copy-2.png"
                                class="attachment-medium size-medium wp-image-234" alt="">
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-c1ec497 e-transform elementor-invisible elementor-widget elementor-widget-image"
                        data-id="c1ec497" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:250,&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_effect&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_direction&quot;:&quot;negative&quot;,&quot;motion_fx_translateY_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;motion_fx_devices&quot;:[&quot;desktop&quot;],&quot;motion_fx_rotateZ_effect&quot;:&quot;yes&quot;,&quot;motion_fx_rotateZ_direction&quot;:&quot;negative&quot;,&quot;motion_fx_translateY_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:0,&quot;end&quot;:84}},&quot;motion_fx_rotateZ_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:46,&quot;end&quot;:100}},&quot;_transform_rotateZ_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-12,&quot;sizes&quot;:[]},&quot;motion_fx_rotateZ_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_tablet&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_mobile&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img loading="lazy" width="174" height="155"
                                src="../wp-content/uploads/2025/01/growth-close-up-environmental-lush-natural.png"
                                class="attachment-medium size-medium wp-image-235" alt="">
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-e90b569 elementor-invisible elementor-widget elementor-widget-image"
                        data-id="e90b569" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:400,&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_effect&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_direction&quot;:&quot;negative&quot;,&quot;motion_fx_translateY_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;motion_fx_devices&quot;:[&quot;desktop&quot;],&quot;motion_fx_translateY_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:35,&quot;end&quot;:82}}}"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img loading="lazy" width="116" height="104"
                                src="../wp-content/uploads/2025/01/growth-close-up-environmental-lush-natural-copy.png"
                                class="attachment-medium size-medium wp-image-233" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-b6b8c0c e-con-full e-flex e-con e-parent" data-id="b6b8c0c"
                data-element_type="container">
                <div class="elementor-element elementor-element-1cde2c4 elementor-widget elementor-widget-theme-post-content"
                    data-id="1cde2c4" data-element_type="widget" data-widget_type="theme-post-content.default">
                    <div class="elementor-widget-container">
                        <div data-elementor-type="wp-page" data-elementor-id="2989" class="elementor elementor-2989"
                            data-elementor-post-type="page">
                            <div class="container mx-auto py-16">
                                {{-- <div class="text-center mb-12">
                                    <span
                                        class="inline-flex items-center px-4 py-1 rounded-full text-sm font-semibold bg-[#e7f6ed] text-[#2f9d5d]">
                                        Discover Your Next Opportunity
                                    </span>
                                    <h1 class="mt-4 text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">
                                        Current Open Positions
                                    </h1>
                                    <p class="mt-3 text-gray-600 max-w-2xl mx-auto">
                                        Explore flexible roles across hospitality, cleaning, domestic services, and more.
                                        Tap or click
                                        on a card to view full details and apply instantly.
                                    </p>
                                </div> --}}

                                <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
                                <div class="jobs-search-container">
                                    <div class="search-inputs-row">
                                        <div class="search-input-group">
                                            <label for="job-title-search">Job Title</label>
                                            <input id="job-title-search" type="text" name="title" class="rounded"
                                                placeholder="e.g. Cleaner, Kitchen Staff" autocomplete="off" />
                                        </div>

                                        <div class="search-input-group">
                                            <label for="job-location-search">Location</label>
                                            <input id="job-location-search" type="text" name="location"
                                                placeholder="e.g. Amsterdam, Rotterdam" autocomplete="off" class="rounded"/>
                                            <div class="location-suggestions" id="locationSuggestions"></div>
                                        </div>

                                        <div class="search-input-group">
                                            <label for="job-distance-filter">Distance (km)</label>
                                            <select id="job-distance-filter" class="p-2 rounded" name="distance">
                                                <option value="">Any</option>
                                                <option value="5">5 km</option>
                                                <option value="10">10 km</option>
                                                <option value="15">15 km</option>
                                                <option value="25">25 km</option>
                                                <option value="50">50 km</option>
                                            </select>
                                        </div>

                                        <button type="button" id="job-search-button" class="search-button">Search</button>
                                    </div>
                                </div>



                                <div class="jobs-grid">
                                    @forelse($jobs as $job)
                                        <article
                                            class="job-card group relative overflow-hidden rounded-3xl bg-white/90 backdrop-blur shadow-[0_24px_60px_rgba(31,86,52,0.08)] transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_32px_80px_rgba(31,86,52,0.14)]"
                                            data-bs-toggle="modal" data-bs-target="#jobModal{{ $job->id }}">
                                            <div class="job-card__ribbon">{{ ucfirst($job->employment_type) }}</div>
                                            <div class="job-card__glow"></div>
                                            <div class="job-card__content">
                                                <header class="flex items-center gap-4">
                                                    <div class="job-card__icon">
                                                        <img src="{{ $job->image ? asset('storage/' . $job->image) : asset('images/default-job.png') }}"
                                                            alt="{{ $job->title }}">
                                                    </div>
                                                    <div>
                                                        <h3 class="job-card__title">{{ $job->title }}</h3>
                                                        <p class="job-card__location">{{ $job->location }}</p>
                                                    </div>
                                                </header>

                                                <dl class="job-card__stats">
                                                    <div>
                                                        <dt>Salary</dt>
                                                        <dd>€{{ number_format($job->salary_min, 0) }} -
                                                            €{{ number_format($job->salary_max, 0) }}/{{ $job->salary_type }}
                                                        </dd>
                                                    </div>
                                                    <div>
                                                        <dt>Category</dt>
                                                        <dd>{{ $job->category ?? 'General' }}</dd>
                                                    </div>
                                                </dl>

                                                <p class="job-card__excerpt">
                                                    {{ \Illuminate\Support\Str::limit($job->short_description, 140) }}
                                                </p>

                                                <footer class="job-card__footer">
                                                    <span class="job-card__cta">View role</span>
                                                    <svg class="job-card__cta-icon" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M5 12h14"></path>
                                                        <path d="M12 5l7 7-7 7"></path>
                                                    </svg>
                                                </footer>
                                            </div>
                                        </article>

                                        <div class="modal fade" id="jobModal{{ $job->id }}" tabindex="-1"
                                            aria-labelledby="jobModalLabel{{ $job->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content job-modal">
                                                    <div class="modal-header border-0 pb-0">
                                                        <div>
                                                            <span
                                                                class="job-modal__badge">{{ ucfirst($job->employment_type) }}</span>
                                                            <h2 class="job-modal__title" id="jobModalLabel{{ $job->id }}">
                                                                {{ $job->title }}
                                                            </h2>
                                                            <p class="job-modal__location">{{ $job->location }}</p>
                                                        </div>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body pt-0">
                                                        <div class="job-modal__image">
                                                            <img src="{{ $job->image ? asset('storage/' . $job->image) : asset('images/default-job.png') }}"
                                                                alt="{{ $job->title }}">
                                                        </div>

                                                        <div class="job-modal__grid">
                                                            <div class="job-modal__meta">
                                                                <div>
                                                                    <h3>Salary</h3>
                                                                    <p>€{{ number_format($job->salary_min, 0) }} -
                                                                        €{{ number_format($job->salary_max, 0) }}/{{ $job->salary_type }}
                                                                    </p>
                                                                </div>
                                                                <div>
                                                                    <h3>Category</h3>
                                                                    <p>{{ $job->category ?? 'General' }}</p>
                                                                </div>
                                                                <div>
                                                                    <h3>Contact</h3>
                                                                    <p>{{ $job->contact_email ?? 'Not provided' }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="job-modal__description">
                                                                <h3>About this role</h3>
                                                                <p>{{ $job->description }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer job-modal__footer">
                                                        <a class="job-modal__apply"
                                                            href="{{ route('candidates.create', ['job' => $job->slug]) }}">
                                                            Apply now
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-span-full text-center py-12">
                                            <div class="text-6xl mb-4">😔</div>
                                            <h3 class="text-2xl font-bold text-gray-800 mb-2">No jobs found in this category
                                            </h3>
                                            <p class="text-gray-600 mb-6">Check back soon for new opportunities!</p>
                                            <a href="{{ route('jobs.index') }}"
                                                class="inline-block px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                                View All Jobs
                                            </a>
                                        </div>
                                    @endforelse
                                </div>

                                <!-- Pagination -->
                                <div class="mt-12 flex justify-center">
                                    {{ $jobs->links('pagination::bootstrap-5') }}
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
    <style>
        .jobs-grid {
            display: grid;
            gap: 40px;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        @media (min-width: 768px) {
            .jobs-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (min-width: 1024px) {
            .jobs-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .modal-header .btn-close {
            padding: 0.5rem .5rem !important;
            margin: -.5rem 0.5rem 7rem auto !important;
            background-color: #fffffe !important;
        }

        .job-card {
            position: relative;
            border: 1px solid rgba(58, 128, 77, 0.22);
            backdrop-filter: blur(6px);
            isolation: isolate;
            background: linear-gradient(180deg, #e8f5d3 0%, #ffffff 65%);
            height: 100%;
            border-radius: 30px;
        }

        .job-card__glow {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(120, 189, 141, 0.35), transparent 58%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
        }

        .job-card__content {
            position: relative;
            z-index: 1;
            padding: 30px;
            display: grid;
            gap: 22px;
        }

        .job-card__ribbon {
            position: absolute;
            top: 22px;
            right: -56px;
            transform: rotate(45deg);
            background: linear-gradient(135deg, #3ca200, #62de90);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 6px 68px;
            box-shadow: 0 18px 35px rgba(47, 157, 93, 0.28);
        }

        .job-card__icon {
            width: 68px;
            height: 68px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(94, 196, 134, 0.24), rgba(47, 157, 93, 0.28));
            display: grid;
            place-items: center;
            box-shadow: inset 0 0 0 1px rgba(47, 157, 93, 0.2);
        }

        .job-card__icon img {
            width: 46px;
            height: 46px;
            object-fit: cover;
            border-radius: 14px;
        }

        .job-card__title {
            font-size: 21px;
            font-weight: 700;
            color: #1f392b;
        }

        .job-card__location {
            margin-top: 6px;
            color: #5c6e64;
            font-weight: 500;
        }

        .job-card__stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .job-card__stats dt {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: #6f7a74;
        }

        .job-card__stats dd {
            margin-top: 6px;
            font-size: 16px;
            font-weight: 600;
            color: #2c4a38;
        }

        .job-card__excerpt {
            color: #46584d;
            line-height: 1.65;
            min-height: 72px;
        }

        .job-card__footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-top: auto;
            font-weight: 600;
            color: #2f9d5d;
        }

        .job-card__cta {
            position: relative;
        }

        .job-card__cta::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background: currentColor;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .job-card__cta-icon {
            width: 22px;
            height: 22px;
            transition: transform 0.3s ease;
        }

        .job-card:hover .job-card__glow {
            opacity: 1;
        }

        .job-card:hover .job-card__cta::after {
            transform: scaleX(1);
        }

        .job-card:hover .job-card__cta-icon {
            transform: translateX(4px);
        }

        .job-card__footer,
        .job-card__cta,
        .job-card__cta-icon {
            pointer-events: none;
        }

        .job-modal {
            border-radius: 26px;
            box-shadow: 0 28px 70px rgba(24, 74, 44, 0.18);
            border: 1px solid rgba(58, 128, 77, 0.2);
        }

        .job-modal__badge {
            display: inline-flex;
            padding: 6px 14px;
            border-radius: 999px;
            background: rgba(47, 157, 93, 0.18);
            color: #2f9d5d;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .job-modal__title {
            margin-top: 12px;
            font-size: 30px;
            font-weight: 700;
            color: #1e3529;
        }

        .job-modal__location {
            color: #607067;
            font-weight: 500;
            margin-top: 4px;
        }

        .job-modal__image {
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(24, 74, 44, 0.22);
            margin-bottom: 28px;
        }

        .job-modal__image img {
            width: 100%;
            height: 260px;
            object-fit: cover;
        }

        .job-modal__grid {
            display: grid;
            gap: 28px;
        }

        .job-modal__meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 18px;
        }

        .job-modal__meta h3 {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #738078;
            font-weight: 700;
        }

        .job-modal__meta p {
            margin-top: 6px;
            font-size: 16px;
            font-weight: 600;
            color: #2a4636;
        }

        .job-modal__description h3 {
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #738078;
            margin-bottom: 12px;
        }

        .job-modal__description p {
            color: #4d5c54;
            line-height: 1.7;
        }

        .job-modal__footer {
            border-top: none;
            padding: 24px 32px;
        }

        .job-modal__apply {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 28px;
            border-radius: 14px;
            background: linear-gradient(135deg, #2f9d5d, #6fd09b);
            color: #ffffff;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 18px 45px rgba(47, 157, 93, 0.26);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .job-modal__apply:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 55px rgba(47, 157, 93, 0.32);
        }

        @media (max-width: 1024px) {
            .job-card__stats {
                grid-template-columns: 1fr;
            }

            .job-card__excerpt {
                min-height: auto;
            }

            .job-modal__image img {
                height: 220px;
            }
        }

        @media (max-width: 640px) {
            .job-card__content {
                padding: 24px;
            }

            .job-card__ribbon {
                top: 20px;
                right: -40px;
            }

            .job-modal__title {
                font-size: 24px;
            }

            .job-modal__image img {
                height: 200px;
            }

            .job-modal__footer {
                padding: 20px 24px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const titleInput = document.getElementById('job-title-search');
            const locationInput = document.getElementById('job-location-search');
            const distanceFilter = document.getElementById('job-distance-filter');
            const searchButton = document.getElementById('job-search-button');
            const cards = Array.from(document.querySelectorAll('.jobs-grid .job-card'));
            const defaultLimit = 12;

            const netherlandsLocations = [
                { name: 'Amsterdam', postcode: '1000-1105' },
                { name: 'Rotterdam', postcode: '3000-3099' },
                { name: 'The Hague (Den Haag)', postcode: '2500-2599' },
                { name: 'Utrecht', postcode: '3500-3599' },
                { name: 'Eindhoven', postcode: '5600-5699' },
                { name: 'Groningen', postcode: '9700-9799' },
                { name: 'Tilburg', postcode: '5000-5099' },
                { name: 'Almere', postcode: '1300-1399' },
                { name: 'Breda', postcode: '4800-4899' },
                { name: 'Nijmegen', postcode: '6500-6599' },
                { name: 'Haarlem', postcode: '2000-2099' },
                { name: 'Amsersfoort', postcode: '3800-3899' },
                { name: 'Arnhem', postcode: '6800-6899' },
                { name: 'Zwolle', postcode: '8000-8099' },
                { name: 'Apeldoorn', postcode: '7300-7399' }
            ];

            const applyDefaultLimit = () => {
                cards.forEach((card, index) => {
                    card.style.display = index < defaultLimit ? '' : 'none';
                });
            };

            const applyFilter = () => {
                const titleTerm = titleInput.value.trim().toLowerCase();
                const locationTerm = locationInput.value.trim().toLowerCase();
                const distanceTerm = distanceFilter.value;
                const hasSearch = titleTerm.length > 0 || locationTerm.length > 0 || distanceTerm.length > 0;

                if (!hasSearch) {
                    applyDefaultLimit();
                    return;
                }

                cards.forEach((card) => {
                    const titleText = card.querySelector('.job-card__title')?.textContent.toLowerCase() || '';
                    const locationText = card.querySelector('.job-card__location')?.textContent.toLowerCase() || '';

                    const matchesTitle = !titleTerm || titleText.includes(titleTerm);
                    const matchesLocation = !locationTerm || locationText.includes(locationTerm);
                    const matchesDistance = !distanceTerm || true;

                    card.style.display = matchesTitle && matchesLocation && matchesDistance ? '' : 'none';
                });
            };

            locationInput.addEventListener('input', function () {
                const searchValue = this.value.toLowerCase().trim();
                const suggestionsDropdown = document.getElementById('locationSuggestions');

                if (searchValue.length < 2) {
                    suggestionsDropdown.classList.remove('show');
                    return;
                }

                const matches = netherlandsLocations.filter(location =>
                    location.name.toLowerCase().includes(searchValue)
                ).slice(0, 5);

                if (matches.length > 0) {
                    suggestionsDropdown.innerHTML = '';
                    matches.forEach(location => {
                        const item = document.createElement('div');
                        item.className = 'location-suggestion-item';
                        item.textContent = location.name;
                        item.onclick = function () {
                            locationInput.value = location.name;
                            suggestionsDropdown.classList.remove('show');
                            applyFilter();
                        };
                        suggestionsDropdown.appendChild(item);
                    });
                    suggestionsDropdown.classList.add('show');
                } else {
                    suggestionsDropdown.innerHTML = '';
                    suggestionsDropdown.classList.remove('show');
                }
            });

            document.addEventListener('click', function (e) {
                if (e.target.id !== 'job-location-search') {
                    document.getElementById('locationSuggestions').classList.remove('show');
                }
            });

            applyDefaultLimit();
            titleInput.addEventListener('input', applyFilter);
            locationInput.addEventListener('focus', function () {
                if (this.value.length >= 2) {
                    document.getElementById('locationSuggestions').classList.add('show');
                }
            });
            distanceFilter.addEventListener('change', applyFilter);
            searchButton.addEventListener('click', applyFilter);
        });
    </script>
@endpush
