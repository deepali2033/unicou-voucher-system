<style>
    .elementor-grid-3 .elementor-grid {
        grid-template-columns: repeat(4, 1fr) !important;
    }
@media(max-width:1024px) {
        .elementor-grid-3 .elementor-grid {
            grid-template-columns: repeat(3, 1fr) !important;
        }

    }

    @media(max-width:768px) {
        .elementor-grid-3 .elementor-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }

    }

    @media(max-width:430px) {
        .elementor-grid-3 .elementor-grid {
            grid-template-columns: repeat(1, 1fr) !important;
        }

    }
    .cleaner-card-shell {
        background: #ffffff;
        border-radius: 26px;
        box-shadow: 0 26px 60px rgba(18, 34, 84, 0.14);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .cleaner-card-shell:hover {
        transform: translateY(-8px);
        box-shadow: 0 34px 82px rgba(18, 34, 84, 0.18);
    }

    .cleaner-card-image {
        position: relative;
        display: block;
        width: 100%;
        padding-top: 74%;
        overflow: hidden;
        background: #eef2fb;
    }

    .cleaner-card-image img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cleaner-card-placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 58px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .cleaner-card-body {
        padding: 24px 24px 22px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .cleaner-card-header {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cleaner-card-name {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #1b2b4d;
    }

    .cleaner-card-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: rgba(60, 162, 0, 0.14);
        color: var(--e-global-color-vamtam_accent_2, #3CA200);
    }

    .cleaner-card-role {
        margin: 0;
        font-size: 14px;
        color: #5e6a80;
    }

    .cleaner-card-location {
        display: flex;
        /* align-items: center; */
        gap: 8px;
    }

    .cleaner-card-location-icon {
        display: inline-flex;
        align-items: start;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        /* background: rgba(60, 162, 0, 0.1); */
        color: var(--e-global-color-vamtam_accent_2, #3CA200);
    }

    .cleaner-card-location-text {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .cleaner-card-location-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #9aa6bb;
    }

    .cleaner-card-location-value {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* show only 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.4em;
        max-height: 2.8em;
        /* 2 lines × line-height */
        font-size: 14px;
        color: #1a1919ff;
    }

    .cleaner-card-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 16px;
        background: #edf3ff;
        color: #274684;
        border-color: #4dc008;
        background-color: var(--e-global-color-vamtam_accent_3);
        color: black;
        border-width: 1px 1px 1px 1px;
        border: 1px solid #4dc008;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s ease, transform 0.2s ease;


    }

    .cleaner-card-btn:hover {
        background: #dbe6ff;
        transform: translateY(-1px);
    }

    /* Hidden cleaner cards */
    .hidden-cleaner-card {
        display: none;
    }

    /* Show More Button Styling */
    .show-more-cleaners-btn {
        display: inline-block;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .show-more-cleaners-btn:hover {
        background-color: #0056b3;
        text-decoration: none;
        color: white;
    }

    .show-more-cleaners-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    }
</style>
<div class="elementor-element elementor-element-b90e2ae e-con-full e-flex e-con e-parent" data-id="b90e2ae"
    data-element_type="container">
    <div class="elementor-element elementor-element-b9a1620 e-flex e-con-boxed e-con e-child" data-id="b9a1620"
        data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
        <div class="e-con-inner">
            <div class="elementor-element elementor-element-2dea089 elementor-position-right elementor-widget__width-auto elementor-mobile-position-right animated-fast elementor-view-default elementor-vertical-align-top elementor-invisible elementor-widget elementor-widget-icon-box"
                data-id="2dea089" data-element_type="widget"
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
                                    from our blog </span>
                            </h6>
                        </div>

                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-cb9e1fe elementor-widget__width-initial animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                data-id="cb9e1fe" data-element_type="widget"
                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                data-widget_type="heading.default">
                <div class="elementor-widget-container">
                    <h2 class="elementor-heading-title elementor-size-default">Cleaning Tips From Pros</h2>
                </div>
            </div>
            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-433f61c elementor-grid-tablet-3 elementor-grid-3 elementor-grid-mobile-1 elementor-widget elementor-widget-loop-grid"
                data-id="433f61c" data-element_type="widget"
                data-settings="{&quot;template_id&quot;:958,&quot;row_gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:20,&quot;sizes&quot;:[]},&quot;columns_tablet&quot;:3,&quot;row_gap_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:30,&quot;sizes&quot;:[]},&quot;_skin&quot;:&quot;post&quot;,&quot;columns&quot;:&quot;3&quot;,&quot;columns_mobile&quot;:&quot;1&quot;,&quot;edit_handle_selector&quot;:&quot;[data-elementor-type=\&quot;loop-item\&quot;]&quot;,&quot;row_gap_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
                data-widget_type="loop-grid.post">
                <div class="elementor-widget-container">
                    <div class="elementor-loop-container elementor-grid" role="list">
                        <style id="loop-958">
                            .elementor-958 .elementor-element.elementor-element-4f1e9c1 {
                                --display: flex;
                                --gap: 5px 0px;
                                --row-gap: 5px;
                                --column-gap: 0px;
                                --padding-top: 0px;
                                --padding-bottom: 0px;
                                --padding-left: 0px;
                                --padding-right: 0px;
                            }

                            .elementor-958 .elementor-element.elementor-element-06448ff>.elementor-widget-container {
                                margin: 0px 0px 10px 0px;
                            }

                            .elementor-958 .elementor-element.elementor-element-06448ff img {
                                border-radius: 32px 32px 32px 32px;
                            }

                            .elementor-958 .elementor-element.elementor-element-3f74ba9 .elementor-icon-list-icon {
                                width: 14px;
                            }

                            .elementor-958 .elementor-element.elementor-element-3f74ba9 .elementor-icon-list-icon i {
                                font-size: 14px;
                            }

                            .elementor-958 .elementor-element.elementor-element-3f74ba9 .elementor-icon-list-icon svg {
                                --e-icon-list-icon-size: 14px;
                            }

                            .elementor-958 .elementor-element.elementor-element-3f74ba9 .elementor-icon-list-text,
                            .elementor-958 .elementor-element.elementor-element-3f74ba9 .elementor-icon-list-text a {
                                color: var(--e-global-color-vamtam_accent_2);
                            }

                            .elementor-958 .elementor-element.elementor-element-3f74ba9 .elementor-icon-list-item {
                                font-family: var(--e-global-typography-vamtam_h6-font-family), Sans-serif;
                                font-size: var(--e-global-typography-vamtam_h6-font-size);
                                font-weight: var(--e-global-typography-vamtam_h6-font-weight);
                                text-transform: var(--e-global-typography-vamtam_h6-text-transform);
                                font-style: var(--e-global-typography-vamtam_h6-font-style);
                                text-decoration: var(--e-global-typography-vamtam_h6-text-decoration);
                                line-height: var(--e-global-typography-vamtam_h6-line-height);
                                letter-spacing: var(--e-global-typography-vamtam_h6-letter-spacing);
                                word-spacing: var(--e-global-typography-vamtam_h6-word-spacing);
                            }

                            .elementor-958 .elementor-element.elementor-element-45cb3ce>.elementor-widget-container {
                                padding: 0px 30px 0px 0px;
                            }

                            .elementor-958 .elementor-element.elementor-element-45cb3ce .elementor-heading-title a:hover,
                            .elementor-958 .elementor-element.elementor-element-45cb3ce .elementor-heading-title a:focus {
                                color: var(--e-global-color-vamtam_accent_2);
                            }

                            @media(max-width:1024px) {
                                .elementor-958 .elementor-element.elementor-element-3f74ba9 .elementor-icon-list-item {
                                    font-size: var(--e-global-typography-vamtam_h6-font-size);
                                    line-height: var(--e-global-typography-vamtam_h6-line-height);
                                    letter-spacing: var(--e-global-typography-vamtam_h6-letter-spacing);
                                    word-spacing: var(--e-global-typography-vamtam_h6-word-spacing);
                                }
                            }

                            @media(max-width:767px) {
                                .elementor-958 .elementor-element.elementor-element-3f74ba9 .elementor-icon-list-item {
                                    font-size: var(--e-global-typography-vamtam_h6-font-size);
                                    line-height: var(--e-global-typography-vamtam_h6-line-height);
                                    letter-spacing: var(--e-global-typography-vamtam_h6-letter-spacing);
                                    word-spacing: var(--e-global-typography-vamtam_h6-word-spacing);
                                }
                            }
                        </style>
                        @php
                            $placeholder = asset('images/beauty-charisma.webp'); // default placeholder
                        @endphp

                        @foreach(($selectedCity ? $cityFreelancers : collect()) as $freelancer)
                            <div data-elementor-type="loop-item" data-elementor-id="958"
                                data-elementor-post-type="elementor_library" data-custom-edit-handle="1"
                                class="cleaner-card @if($loop->index >= 4) hidden-cleaner-card @endif">

                                <div class="cleaner-card-shell">
                                    @php
                                        $citySlugValue = $freelancer->city ? 'city-' . \Illuminate\Support\Str::slug($freelancer->city) : null;
                                        $freelancerUrl = $citySlugValue ? route('domestic-cleaning.places.cleaners.show', [
                                            'citySlug' => $citySlugValue,
                                            'freelancerSlug' => $freelancer->cleanerProfileSlug(),
                                        ]) : '#';

                                        $profilePhotoPath = $freelancer->profile_photo ? 'storage/' . $freelancer->profile_photo : null;
                                        $hasProfilePhoto = $profilePhotoPath && file_exists(public_path($profilePhotoPath));
                                        $firstLetter = strtoupper(substr($freelancer->name ?? 'U', 0, 1));
                                        $locationParts = array_filter([$freelancer->city, $freelancer->state]);
                                        $displayAddress = $freelancer->address ?: (count($locationParts) ? implode(', ', $locationParts) : 'Address shared after booking');
                                        $jobSummary = $freelancer->job_role ?: 'Domestic cleaner focused on spotless spaces.';
                                    @endphp

                                    <a class="cleaner-card-image" href="{{ $freelancerUrl }}">
                                        @if($hasProfilePhoto)
                                            <img loading="lazy" decoding="async" src="{{ asset($profilePhotoPath) }}"
                                                alt="{{ $freelancer->name ?? 'Freelancer' }}">
                                        @elseif(!empty($freelancer->image) && file_exists(public_path($freelancer->image)))
                                            <img loading="lazy" decoding="async" src="{{ asset($freelancer->image) }}"
                                                alt="{{ $freelancer->name ?? 'Freelancer' }}">
                                        @else
                                            <div class="cleaner-card-placeholder"
                                                style="background:#{{ substr(md5($freelancer->name ?? 'U'), 0, 6) }};">
                                                {{ $firstLetter }}
                                            </div>
                                        @endif
                                    </a>

                                    <div class="cleaner-card-body">
                                        <div class="cleaner-card-header">
                                            <h4 class="cleaner-card-name">
                                                <a href="{{ $freelancerUrl }}" style="color:inherit; text-decoration:none;">
                                                    {{ $freelancer->name ?? 'Unnamed Freelancer' }}
                                                </a>
                                            </h4>
                                            @if($freelancer->profile_verification_status === 'verified')
                                                <span class="cleaner-card-badge">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="2" />
                                                        <path d="M9 12.5L11 14.5L15 10.5" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- <p class="cleaner-card-role">{{ $jobSummary }}</p> --}}

                                        <div class="cleaner-card-location">
                                            <span class="cleaner-card-location-icon">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 21C12 21 5 14.75 5 10C5 6.68629 7.68629 4 11 4C14.3137 4 17 6.68629 17 10C17 14.75 12 21 12 21Z"
                                                        stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <circle cx="12" cy="10" r="2.5" stroke="currentColor"
                                                        stroke-width="1.6" />
                                                </svg>
                                            </span>
                                            <div class="cleaner-card-location-text">
                                                {{-- <span class="cleaner-card-location-label">Address</span> --}}
                                                <span class="cleaner-card-location-value">{{ $displayAddress }}</span>
                                            </div>
                                        </div>

                                        <a class="cleaner-card-btn" href="{{ $freelancerUrl }}">
                                            <span>View profile</span>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 5L16 12L8 19" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if($selectedCity && count($cityFreelancers) > 4)
                            <div style="text-align: center; margin: 20px 0;">
                                <button class="show-more-cleaners-btn" id="show-more-cleaners">Show More Cleaners</button>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const showMoreBtn = document.getElementById('show-more-cleaners');
        if (showMoreBtn) {
            showMoreBtn.addEventListener('click', function () {
                const hiddenCards = document.querySelectorAll('.hidden-cleaner-card');
                hiddenCards.forEach(card => {
                    card.style.display = 'block';
                });
                // Hide the button after showing all cards
                this.style.display = 'none';
            });
        }
    });
</script>