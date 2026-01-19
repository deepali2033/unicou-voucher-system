<style>
    .border-style {
        border-bottom: 1px solid #c0c0c0;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }
</style>
<div class="elementor-element elementor-element-0a56cd2 animated-fast e-flex e-con-boxed e-con e-parent"
    data-id="0a56cd2" data-element_type="container" data-settings="{&quot;animation&quot;:&quot;none&quot;}">
    <div class="e-con-inner">
        <div class="elementor-element elementor-element-ca04b14 e-con-full animated-fast vamtam-has-theme-cp vamtam-cp-top-left e-flex e-con e-child"
            style="background: #f4f6f0;" data-id="ca04b14" data-element_type="container"
            data-settings="{&quot;background_background&quot;:&quot;gradient&quot;,&quot;animation&quot;:&quot;none&quot;}">
            <div class="elementor-element elementor-element-449cd03 elementor-position-right elementor-widget__width-auto elementor-mobile-position-right elementor-vertical-align-top animated-fast elementor-view-default elementor-vertical-align-top elementor-invisible elementor-widget elementor-widget-icon-box"
                data-id="449cd03" data-element_type="widget"
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
                                    Domestic Cleaners in Your Area </span>
                            </h6>


                        </div>

                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-008292f elementor-widget__width-initial animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                data-id="008292f" data-element_type="widget"
                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                data-widget_type="heading.default">
                <div class="elementor-widget-container">
                    <h2 class="elementor-heading-title elementor-size-default"> Find Trusted Domestic Cleaners Near You
                    </h2>
                </div>
                <p class="text-gray-600 text-sm">
                    Here are the available domestic cleaners in your area. Choose your city below to find reliable
                    cleaning professionals near you.
                </p>

            </div>
            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-e2fcc7c elementor-button-align-start animated-fast vamtam-has-btn-hover-anim elementor-invisible elementor-widget elementor-widget-form"
                data-id="e2fcc7c" data-element_type="widget"
                data-settings="{&quot;step_next_label&quot;:&quot;Next&quot;,&quot;step_previous_label&quot;:&quot;Previous&quot;,&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200,&quot;button_width&quot;:&quot;100&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}"
                data-widget_type="form.default">
                <div class="elementor-widget-container">
                    <form class="elementor-form" id="quote-form" method="post" action="{{ route('quote.submit') }}"
                        name="Get a Quote Form" aria-label="Get a Quote Form">
                        @csrf
                        <div class="">

                            @if(isset($freelancerCities) && $freelancerCities->count() > 0)
                            <div id="city-wrapper"
                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 border-style">
                                @foreach($freelancerCities as $city)
                                @php($citySlug = 'city-' . \Illuminate\Support\Str::slug($city))
                                        {{-- <a
                                            class="btn{{ isset($selectedCity) && $selectedCity === $city ? ' btn-active' : '' }}"
                                            href="{{ route('domestic-cleaning.places.show', $citySlug) }}">
                                            {{ $city }}
                                        </a> --}}

                                        <a class="elementor-button elementor-button-link elementor-size-sm"
                                            href="{{ route('domestic-cleaning.places.show', $citySlug) }}">
                                            <span class="elementor-button-content-wrapper">

                                                <span class="vamtam-btn-text-wrap"><span
                                                        class="elementor-button-text vamtam-btn-text">{{ $city }}</span><span
                                                        class="elementor-button-text vamtam-btn-text-abs">{{ $city }}</span></span></span>
                                        </a>


                                        @endforeach

                                    </div>
                                @else
                            <a class="elementor-button elementor-button-link elementor-size-sm" href="...">
                                <span class="elementor-button-text vamtam-btn-text">CityName</span>
                                ...
                            </a>
                            <p class="text-gray-600 text-sm"> No domestic cleaners are currently available in your area.
                                Please check back soon or contact us for assistance.</p>
                            @endif

                            {{-- <div
                                class="elementor-field-type-acceptance elementor-field-group elementor-column elementor-field-group-field_d067baa elementor-col-100">
                                <div class="elementor-field-subgroup">
                                    <span class="elementor-field-option">
                                        <input type="checkbox" name="acceptance" id="form-field-field_d067baa"
                                            class="elementor-field elementor-size-sm  elementor-acceptance-field"
                                            checked="checked">
                                        <label for="form-field-field_d067baa">By submitting this form, you agree to the
                                            processing of your personal data in accordance with the General Data
                                            Protection Regulation and our Privacy Policy.</label> </span>
                                </div>
                            </div> --}}
                            {{-- <div class="elementor-field-type-text">
                                <input size="1" type="text" name="honeypot" id="form-field-field_40c0e23"
                                    class="elementor-field elementor-size-sm " style="display:none !important;"
                                    tabindex="-1" autocomplete="off">
                            </div> --}}

                        </div>
                        <div class="">
                            <button class="elementor-button elementor-size-sm" type="submit" id="quote-submit-btn">
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-text">Share my address</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>



            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.getElementById('quote-form');
                    const submitBtn = document.getElementById('quote-submit-btn');

                    if (form) {
                        form.addEventListener('submit', function (e) {
                            e.preventDefault();

                            // Disable submit button
                            submitBtn.disabled = true;
                            const originalText = submitBtn.querySelector('.elementor-button-text').textContent;
                            submitBtn.querySelector('.elementor-button-text').textContent = 'Submitting...';

                            // Get form data
                            const formData = new FormData(form);

                            // Submit via AJAX
                            fetch('{{ route('quote.submit') }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'application/json'
                                }
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // Show success modal
                                        document.getElementById('quote-success-modal').style.display = 'block';

                                        // Reset form
                                        form.reset();
                                    } else {
                                        alert(data.message || 'An error occurred. Please try again.');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('An error occurred. Please try again.');
                                })
                                .finally(() => {
                                    // Re-enable submit button
                                    submitBtn.disabled = false;
                                    submitBtn.querySelector('.elementor-button-text').textContent = originalText;
                                });
                        });
                    }
                });
            </script>
        </div>
        <div class="elementor-element elementor-element-64d06d2 e-con-full animated-fast e-flex e-con e-child"
            data-id="64d06d2" data-element_type="container" data-settings="{&quot;animation&quot;:&quot;none&quot;}">
            <div class="elementor-element elementor-element-229b976 e-con-full e-flex e-con e-child" data-id="229b976"
                data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            </div>
            <div class="elementor-element elementor-element-a8be4fe e-con-full animated-fast e-flex e-con e-child"
                data-id="a8be4fe" data-element_type="container"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;none&quot;,&quot;animation_delay&quot;:100}">
                <div class="elementor-element elementor-element-c481974 elementor-widget__width-auto elementor-view-default elementor-widget elementor-widget-icon"
                    data-id="c481974" data-element_type="widget" data-widget_type="icon.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-icon-wrapper">
                            <div class="elementor-icon">
                                <i aria-hidden="true" class="vamtamtheme- vamtam-theme-check-round"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" elementor-element elementor-element-4f9d9e4 e-con-full e-flex e-con e-child"
                    data-id="4f9d9e4" data-element_type="container">
                    <div class="elementor-element elementor-element-2928c5b elementor-widget__width-initial elementor-widget-tablet__width-inherit elementor-widget-mobile__width-inherit elementor-widget elementor-widget-heading"
                        data-id="2928c5b" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-heading-title elementor-size-default">100% Satisfaction Guarantee
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-a3738d9 elementor-widget__width-initial elementor-widget-tablet__width-initial elementor-widget-mobile__width-inherit elementor-widget elementor-widget-text-editor"
                        data-id="a3738d9" data-element_type="widget" data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            <p>Your satisfaction is our top priority! We proudly offer a 100% Happiness Guarantee on all
                                our cleanings.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Success Message -->
        <div id="quote-success-modal"
            style="display: none; position: fixed; z-index:99999 ; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
            <div
                style="background-color: #fefefe; margin: 10% auto; padding: 30px; border-radius: 10px; width: 90%; max-width: 500px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                <div style="margin-bottom: 20px;">
                    <svg style="width: 70px; height: 70px; color: #3ca200;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 style="color: #3ca200; margin-bottom: 15px; font-size: 24px; ">Submitted Successfully</h2>
                <p style="color: #666; margin-bottom: 25px; font-size: 16px; line-height: 1.5;">Thank you for your quote
                    request! We will contact you within 24 hours with a personalized estimate.</p>
                <button onclick="document.getElementById('quote-success-modal').style.display='none'"
                    style="background-color: #3ca200; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: 500;">OK</button>
            </div>
        </div>
    </div>
</div>
<script>
    // ====== 1) Put city coords here (update/expand as needed) ======
    const cityCoords = {
        // key = lowercase city name (trimmed)
        "ujjain": { name: "Ujjain", slug: "ujjain", lat: 23.1765, lng: 75.7885 },
        "dewas": { name: "Dewas", slug: "dewas", lat: 22.9676, lng: 76.0534 },
        "indore": { name: "Indore", slug: "indore", lat: 22.7196, lng: 75.8577 },
        "mumbai": { name: "Mumbai", lat: 19.0760, lng: 72.8777, slug: "mumbai" },
        "bengaluru": { name: "Bengaluru", lat: 12.9716, lng: 77.5946, slug: "bengaluru" },
        "pune": { name: "Pune", lat: 18.5204, lng: 73.8567, slug: "pune" },
        // add more cities here: "cityname": { name: "CityName", lat: 00.0000, lng: 00.0000, slug:"city-slug" }
    };

    // ====== 2) Haversine distance ======
    function getDistanceKm(lat1, lon1, lat2, lon2) {
        const R = 6371; // km
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat / 2) ** 2 +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) ** 2;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    // ====== 3) Main logic: find anchors, match with cityCoords, compute distance, show/hide/sort ======
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('city-wrapper'); // adjust if needed
        if (!container) return;

        // collect all city anchor elements inside container
        const anchors = Array.from(container.querySelectorAll('a.elementor-button'));

        // Normalize function to compare names
        const normalize = s => (s || '').toString().trim().toLowerCase();

        // Extract displayed city name for each anchor
        const items = anchors.map(a => {
            // try span text first, fallback to anchor text
            let nameSpan = a.querySelector('.elementor-button-text') || a;
            const displayName = nameSpan.textContent.trim();
            return {
                el: a,
                displayName,
                key: normalize(displayName),
                distance: Infinity,
                matched: !!cityCoords[normalize(displayName)]
            };
        });

        // Fill missing matches: sometimes displayName may be "City City" or have extra text.
        // Try alternative: use first word only (optional)
        items.forEach(it => {
            if (!it.matched) {
                const first = it.key.split(/\s+/)[0];
                if (cityCoords[first]) {
                    it.key = first;
                    it.matched = true;
                }
            }
        });

        // If no geolocation or user denies, just optionally highlight nearest by nothing -> show all
        function fallbackShowAll() {
            items.forEach(it => {
                it.el.style.display = ''; // visible
                // remove any previous distance label
                const existing = it.el.querySelector('.distance-badge-js');
                if (existing) existing.remove();
            });
        }

        // On success: compute distances, filter by radius (optional), sort and show results
        function onPosition(lat, lng) {
            // compute distances for matched items
            items.forEach(it => {
                if (it.matched) {
                    const c = cityCoords[it.key];
                    it.distance = getDistanceKm(lat, lng, c.lat, c.lng);
                } else {
                    it.distance = Infinity;
                }
            });

            // Choose radius (km) - adjust as you like
            const RADIUS_KM = 60; // show only cities within 60 km. Set large number if you want more.
            // Filter and sort
            const within = items.filter(i => i.distance <= RADIUS_KM).sort((a, b) => a.distance - b.distance);

            // If none within radius, fallback: show nearest 3 (even if far)
            let toShow = within;
            if (toShow.length === 0) {
                toShow = items
                    .filter(i => i.distance < Infinity)
                    .sort((a, b) => a.distance - b.distance)
                    .slice(0, 3);
            }

            // Hide all first
            items.forEach(it => it.el.style.display = 'none');

            // Insert distance badges and show selected
            toShow.forEach(it => {
                it.el.style.display = '';
                // remove old badge if exists
                const old = it.el.querySelector('.distance-badge-js');
                if (old) old.remove();

                // create a tiny distance label (e.g. "3.2 km")
                const badge = document.createElement('span');
                badge.className = 'distance-badge-js';
                badge.style.display = 'inline-block';
                badge.style.marginLeft = '8px';
                badge.style.fontSize = '12px';
                badge.style.color = '#555';
                badge.textContent = (it.distance === Infinity) ? '' : `(${it.distance.toFixed(1)} km)`;

                // append to button text wrapper if exists
                const textWrap = it.el.querySelector('.elementor-button-content-wrapper') || it.el;
                textWrap.appendChild(badge);
            });

            // OPTIONAL: Auto-scroll to first shown city
            if (toShow.length > 0) {
                toShow[0].el.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        // Ask for geolocation
        if (!navigator.geolocation) {
            console.warn('Geolocation not supported — showing all cities.');
            fallbackShowAll();
        } else {
            navigator.geolocation.getCurrentPosition(function (pos) {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;
                onPosition(lat, lng);
            }, function (err) {
                console.warn('Geolocation denied or failed:', err);
                // optionally try approximate location via IP (not included) — fallback: show all
                fallbackShowAll();
            }, {
                enableHighAccuracy: false,
                timeout: 8000
            });
        }
    });
</script>