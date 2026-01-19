@extends('layouts.app')

@section('title', 'Get a Free Quote - KOA Services')
@section('meta_description', 'Request a free, no-obligation quote for your cleaning service needs.')

@section('content')

    <link href="{{ asset('/css/quote.css') }}" rel="stylesheet">

    <article id="post-140" class="full post-140 page type-page status-publish hentry">
        <div data-elementor-type="single-page" data-elementor-id="3145"
            class="elementor elementor-3145 elementor-location-single margin-set post-140 page type-page status-publish hentry"
            data-elementor-post-type="elementor_library">

            <div class="elementor-element elementor-element-b6b8c0c e-con-full e-flex e-con e-parent" data-id="b6b8c0c"
                data-element_type="container">
                <div class="elementor-element elementor-element-1cde2c4 elementor-widget elementor-widget-theme-post-content"
                    data-id="1cde2c4" data-element_type="widget" data-widget_type="theme-post-content.default">
                    <div class="elementor-widget-container">
                        <div data-elementor-type="wp-page" data-elementor-id="140" class="elementor elementor-140"
                            data-elementor-post-type="page">
                            <div class="elementor-element elementor-element-b984a64 e-flex e-con-boxed e-con e-parent"
                                data-id="b984a64" data-element_type="container">
                                <div class="e-con-inner">
                                    <div class="elementor-element elementor-element-bf3f4a9 animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                                        data-id="bf3f4a9" data-element_type="widget"
                                        data-settings='{"_animation":"fadeIn","_animation_delay":250}'
                                        data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h3 class="elementor-heading-title elementor-size-default">
                                                We're Excited to Help you With All your House
                                                Cleaning Needs
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-81cd6de animated-fast e-flex e-con-boxed e-con e-parent"
                                data-id="81cd6de" data-element_type="container" data-settings='{"animation":"none"}'>
                                <div class="e-con-inner">
                                    <div class="elementor-element elementor-element-8cc531c e-con-full e-flex e-con e-child"
                                        data-id="8cc531c" data-element_type="container"
                                        data-settings='{"background_background":"classic"}'>
                                        <div class="elementor-element elementor-element-e9dbd67 elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                                            data-id="e9dbd67" data-element_type="widget" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                {{-- <h3 class="elementor-heading-title elementor-size-default">
                                                    Get Your Estimate &amp; Book Now
                                                </h3> --}}
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-10f4e2e e-con-full e-flex e-con e-child"
                                            data-id="10f4e2e" data-element_type="container">
                                            @if(empty($showSuccess))
                                                <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-33d2c75 elementor-button-align-start elementor-widget__width-inherit vamtam-has-btn-hover-anim animated-fast elementor-invisible elementor-widget elementor-widget-form"
                                                    data-id="33d2c75" data-element_type="widget"
                                                    data-settings='{"step_next_label":"Continue","step_previous_label":"Back","step_type":"number","_animation":"fadeIn","_animation_delay":150,"step_icon_shape":"circle"}'
                                                    data-widget_type="form.default">
                                                    <div class="elementor-widget-container">
                                                        <form class="elementor-form" method="post"
                                                            action="{{ route('book-services.store') }}"
                                                            name="Free Quote Booking Form "
                                                            aria-label="Free Quote Booking Form " id="bookingWizard">
                                                            @csrf
                                                            <input type="hidden" name="post_id" value="140" />
                                                            <input type="hidden" name="form_id" value="33d2c75" />
                                                            <input type="hidden" name="referer_title" value="Free Quote" />
                                                            <input type="hidden" name="queried_id" value="140" />
                                                            <input type="hidden" id="currentStep" name="currentStep"
                                                                value="1" />

                                                            <!-- Customer Contact Information Fields (Hidden) -->
                                                            <input type="hidden" name="form_fields[name_booking_form]" value="">
                                                            <input type="hidden" name="form_fields[email_booking_form]"
                                                                value="">
                                                            <input type="hidden" name="form_fields[tel_booking_form]" value="">
                                                            <input type="hidden" id="calculated_price_field"
                                                                name="form_fields[calculated_price_booking_form]" value="">


                                                            <div class="wizard-form">
                                                                <div class="form-main">
                                                                    <!-- STEP 1: ADDRESS -->
                                                                    <div class="step {{ ($currentStep ?? 1) == 1 ? 'active' : '' }}"
                                                                        data-step="1">
                                                                        <h3>Property Address</h3>
                                                                        <label for="address">Enter your property
                                                                            address:</label>
                                                                        <div style="position: relative;">
                                                                            <input type="text" id="address"
                                                                                name="form_fields[street_booking_form]"
                                                                                placeholder="Address here..."
                                                                                autocomplete="off" required>
                                                                            <div id="addressSuggestions"
                                                                                style="position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #ddd; border-top: none; max-height: 250px; overflow-y: auto; display: none; z-index: 1000; border-radius: 0 0 4px 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- STEP 2: CATEGORY SELECTION -->
                                                                    <div class="step {{ ($currentStep ?? 1) == 2 ? 'active' : '' }}"
                                                                        data-step="2">
                                                                        <h3 class="mb-2">Select Category</h3>

                                                                        <!-- Category Cards -->
                                                                        <div class="service-cards-container"
                                                                            id="categoriesContainer">
                                                                            @if($categories && count($categories) > 0)
                                                                                @foreach($categories as $category)
                                                                                    <div class="service-card"
                                                                                        data-category-id="{{ $category->id }}"
                                                                                        onclick="selectCategory(this, '{{ $category->id }}', '{{ $category->name }}')">
                                                                                        <h4>{{ $category->name }}</h4>
                                                                                        <div class="description">
                                                                                            {{ $category->description }}
                                                                                        </div>
                                                                                        <input type="radio"
                                                                                            name="form_fields[category_booking_form]"
                                                                                            value="{{ $category->name }}"
                                                                                            style="display: none;" required>
                                                                                    </div>
                                                                                @endforeach
                                                                            @else
                                                                                <p
                                                                                    style="color: #666; font-size: 16px; text-align: center; padding: 40px; width: 100%;">
                                                                                    No categories available at the moment. Please
                                                                                    check back later.</p>
                                                                            @endif
                                                                        </div>

                                                                        <!-- Selected Category Display -->
                                                                        <div class="selected-service-card"
                                                                            id="selectedCategoryDisplay">
                                                                            <h4>✓ Selected Category</h4>
                                                                            <p><strong>Category:</strong> <span
                                                                                    id="selectedCategoryName"></span></p>
                                                                            <p><span id="selectedCategoryDesc"></span></p>
                                                                        </div>
                                                                    </div>

                                                                    <!-- STEP 3: SERVICE SELECTION -->
                                                                    <div class="step {{ ($currentStep ?? 1) == 3 ? 'active' : '' }}"
                                                                        data-step="3">
                                                                        <h3>Select Service</h3>

                                                                        <!-- Service Cards -->
                                                                        <div class="service-cards-container"
                                                                            id="servicesContainer">
                                                                        </div>

                                                                        <!-- Selected Service Display -->
                                                                        <div class="selected-service-card"
                                                                            id="selectedServiceDisplay">
                                                                            <h4>✓ Selected Service</h4>
                                                                            <p><strong>Service:</strong> <span
                                                                                    id="selectedServiceName"></span></p>
                                                                            <p><strong>Price Range:</strong> <span
                                                                                    id="selectedServicePrice"></span></p>
                                                                            {{-- <p><strong>Duration:</strong> <span
                                                                                    id="selectedServiceDuration"></span></p>
                                                                            --}}
                                                                            <p><span id="selectedServiceDesc"></span></p>
                                                                        </div>
                                                                    </div>

                                                                    <!-- STEP 4: FREQUENCY (Only for Regular Cleaning) -->
                                                                    <div class="step {{ ($currentStep ?? 1) == 4 ? 'active' : '' }}"
                                                                        data-step="4" id="frequencyStep" style="display: none;">
                                                                        <h3>Cleaning Frequency</h3>
                                                                        <div class="option-cards-container">
                                                                            <div class="option-card"
                                                                                onclick="selectOption(this, 'frequency_booking_form', 'Once a week'); showStep(4);">
                                                                                <h5>Weekly</h5>
                                                                                <p>Once a week</p>
                                                                                <input type="radio"
                                                                                    name="form_fields[frequency_booking_form]"
                                                                                    value="Once a week" style="display: none;">
                                                                            </div>
                                                                            <div class="option-card"
                                                                                onclick="selectOption(this, 'frequency_booking_form', 'Once a fortnight'); showStep(4);">
                                                                                <h5>Bi-Weekly</h5>
                                                                                <p>Once a fortnight</p>
                                                                                <input type="radio"
                                                                                    name="form_fields[frequency_booking_form]"
                                                                                    value="Once a fortnight"
                                                                                    style="display: none;">
                                                                            </div>
                                                                            <div class="option-card"
                                                                                onclick="selectOption(this, 'frequency_booking_form', 'Once a month'); showStep(4);">
                                                                                <h5>Monthly</h5>
                                                                                <p>Once a month</p>
                                                                                <input type="radio"
                                                                                    name="form_fields[frequency_booking_form]"
                                                                                    value="Once a month" style="display: none;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- STEP 5: DURATION -->
                                                                    <div class="step {{ ($currentStep ?? 1) == 5 ? 'active' : '' }}"
                                                                        data-step="5">
                                                                        <h3>Service Duration (hours)</h3>
                                                                        <div class="option-cards-container">
                                                                            <div class="option-card"
                                                                                onclick="selectOption(this, 'duration_booking_form', '3 hours'); showStep(5);">
                                                                                <h5>3 Hours</h5>
                                                                                <p>Quick clean</p>
                                                                                <input type="radio"
                                                                                    name="form_fields[duration_booking_form]"
                                                                                    value="3 hours" style="display: none;">
                                                                            </div>
                                                                            <div class="option-card"
                                                                                onclick="selectOption(this, 'duration_booking_form', '4sdfsdf hours'); showStep(5);">
                                                                                <h5>4 Hours</h5>
                                                                                <p>Standard</p>
                                                                                <input type="radio"
                                                                                    name="form_fields[duration_booking_form]"
                                                                                    value="4 hours" style="display: none;">
                                                                            </div>
                                                                            <div class="option-card"
                                                                                onclick="selectOption(this, 'duration_booking_form', '5 hours'); showStep(5);">
                                                                                <h5>5 Hours</h5>
                                                                                <p>Extended</p>
                                                                                <input type="radio"
                                                                                    name="form_fields[duration_booking_form]"
                                                                                    value="5 hours" style="display: none;">
                                                                            </div>
                                                                            <div class="option-card"
                                                                                onclick="selectOption(this, 'duration_booking_form', '6 hours'); showStep(5);">
                                                                                <h5>6 Hours</h5>
                                                                                <p>Thorough</p>
                                                                                <input type="radio"
                                                                                    name="form_fields[duration_booking_form]"
                                                                                    value="6 hours" style="display: none;">
                                                                            </div>
                                                                            <div class="option-card"
                                                                                onclick="selectOption(this, 'duration_booking_form', '7 hours'); showStep(5);">
                                                                                <h5>7 Hours</h5>
                                                                                <p>Complete</p>
                                                                                <input type="radio"
                                                                                    name="form_fields[duration_booking_form]"
                                                                                    value="7 hours" style="display: none;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- STEP 6: EXTRAS -->
                                                                    <div class="step {{ ($currentStep ?? 1) == 6 ? 'active' : '' }}"
                                                                        data-step="6">
                                                                        <h3>Extra Services (Optional)</h3>
                                                                        <p style="color: #666; margin-bottom: 20px;">Select any
                                                                            additional services you'd like:</p>
                                                                        <div class="option-cards-container">
                                                                            <div class="option-card"
                                                                                onclick="toggleOption(this, 'extras_booking_form', 'Ironing')">
                                                                                <h5> Ironing</h5>
                                                                                <p>Iron clothes & linens</p>
                                                                                <input type="checkbox"
                                                                                    name="form_fields[extras_booking_form]"
                                                                                    value="Ironing" style="display: none;">
                                                                            </div>
                                                                            <div class="option-card"
                                                                                onclick="toggleOption(this, 'extras_booking_form', 'Cleaning materials')">
                                                                                <h5> Materials</h5>
                                                                                <p>Provide cleaning materials</p>
                                                                                <input type="checkbox"
                                                                                    name="form_fields[extras_booking_form]"
                                                                                    value="Cleaning materials"
                                                                                    style="display: none;">
                                                                            </div>
                                                                            <div class="option-card"
                                                                                onclick="toggleOption(this, 'extras_booking_form', 'Cleaning equipment')">
                                                                                <h5> Equipment</h5>
                                                                                <p>Provide equipment & tools</p>
                                                                                <input type="checkbox"
                                                                                    name="form_fields[extras_booking_form]"
                                                                                    value="Cleaning equipment"
                                                                                    style="display: none;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- STEP 7: PETS -->
                                                                    <div class="step {{ ($currentStep ?? 1) == 7 ? 'active' : '' }}"
                                                                        data-step="7">
                                                                        <h3>Do you have pets?</h3>
                                                                        <div class="option-cards-container"
                                                                            style="max-width: 300px;">
                                                                            <div class="option-card"
                                                                                onclick="selectOption(this, 'pets_booking_form', 'Yes'); showStep(7);">
                                                                                <h5><i class="fa-solid fa-paw step-icon"></i>
                                                                                    Yes</h5>
                                                                                <p>I have pets</p>
                                                                                <input type="radio"
                                                                                    name="form_fields[pets_booking_form]"
                                                                                    value="Yes" style="display: none;">
                                                                            </div>
                                                                            <div class="option-card"
                                                                                onclick="selectOption(this, 'pets_booking_form', 'No'); showStep(7);">
                                                                                <h5>✓ No</h5>
                                                                                <p>No pets</p>
                                                                                <input type="radio"
                                                                                    name="form_fields[pets_booking_form]"
                                                                                    value="No" style="display: none;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- STEP 8: APPOINTMENT DATE -->
                                                                    <div class="step {{ ($currentStep ?? 1) == 8 ? 'active' : '' }}"
                                                                        data-step="8">
                                                                        <h3>First Appointment Date</h3>
                                                                        <div class="calendar-container">
                                                                            <div class="calendar-header">
                                                                                <button type="button"
                                                                                    onclick="previousMonth()">←
                                                                                    Prev</button>
                                                                                <h4 id="calendarMonth"></h4>
                                                                                <button type="button" onclick="nextMonth()">Next
                                                                                    →</button>
                                                                            </div>
                                                                            <div class="calendar-weekdays">
                                                                                <div class="calendar-weekday">Sun</div>
                                                                                <div class="calendar-weekday">Mon</div>
                                                                                <div class="calendar-weekday">Tue</div>
                                                                                <div class="calendar-weekday">Wed</div>
                                                                                <div class="calendar-weekday">Thu</div>
                                                                                <div class="calendar-weekday">Fri</div>
                                                                                <div class="calendar-weekday">Sat</div>
                                                                            </div>
                                                                            <div class="calendar-grid" id="calendarDays"></div>
                                                                        </div>
                                                                        <input type="hidden" id="appointmentDate"
                                                                            name="form_fields[appointment_date_booking_form]"
                                                                            required>
                                                                        <p id="selectedDateDisplay"
                                                                            style="text-align: center; color: #3ca200; font-weight: 600; margin-top: 15px;">
                                                                        </p>
                                                                    </div>

                                                                    <!-- STEP 9: TIME -->
                                                                    <div class="step {{ ($currentStep ?? 1) == 9 ? 'active' : '' }}"
                                                                        data-step="9">
                                                                        <h3>Preferred Time</h3>
                                                                        <p style="color: #666; margin-bottom: 20px;">Select your
                                                                            preferred service time:</p>
                                                                        <div class="time-slots-container" id="timeSlots"></div>
                                                                        <input type="hidden" id="appointmentTime"
                                                                            name="form_fields[time_booking_form]"
                                                                            required>
                                                                        <p id="selectedTimeDisplay"
                                                                            style="text-align: center; color: #3ca200; font-weight: 600; margin-top: 15px;">
                                                                        </p>
                                                                    </div>

                                                                    <!-- BUTTONS -->
                                                                    <div class="btn-group book-service-btn">
                                                                        <button type="button" id="prevBtn"
                                                                            class="elementor-button elementor-button-link elementor-size-sm"
                                                                            onclick="changeStep(-1)" style="display: none;">←
                                                                            Back</button>
                                                                        <button type="button" id="nextBtn" disabled
                                                                            onclick="changeStep(1)" style=""
                                                                            class="elementor-button elementor-button-link elementor-size-sm">Continue
                                                                            →</button>
                                                                        <button type="button" id="submitBtn"
                                                                            onclick="submitBookingForm()" style="display: none;"
                                                                            class="elementor-button elementor-button-link elementor-size-sm">Submit</button>



                                                                    </div>

                                                                </div><!-- end form-main -->

                                                                <!-- SIDEBAR ACCORDION -->
                                                                <div class="form-sidebar">
                                                                    <h4>My basket</h4>
                                                                    <div id="bookingBasket"></div>
                                                                </div>
                                                            </div><!-- end wizard-form -->

                                                        </form>
                                                    </div>
                                                </div>
                                                {{-- @else
                                                <!-- Show form again after successful submission -->
                                                <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-33d2c75 elementor-button-align-start elementor-widget__width-inherit vamtam-has-btn-hover-anim animated-fast elementor-invisible elementor-widget elementor-widget-form"
                                                    data-id="33d2c75" data-element_type="widget"
                                                    data-settings='{"step_next_label":"Continue","step_previous_label":"Back","step_type":"number","_animation":"fadeIn","_animation_delay":150,"step_icon_shape":"circle"}'
                                                    data-widget_type="form.default">
                                                    <div class="elementor-widget-container">
                                                        <form class="elementor-form" method="post"
                                                            action="{{ route('book-services.store') }}"
                                                            name="Free Quote Booking Form "
                                                            aria-label="Free Quote Booking Form ">
                                                            @csrf
                                                            <input type="hidden" name="post_id" value="140" />
                                                            <input type="hidden" name="form_id" value="33d2c75" />
                                                            <input type="hidden" name="referer_title" value="Free Quote" />
                                                            <input type="hidden" name="queried_id" value="140" />

                                                            <div class="elementor-form-fields-wrapper elementor-labels-above">
                                                                <div
                                                                    class="elementor-field-type-step elementor-field-group elementor-column elementor-field-group-field_bdd417d elementor-col-100">
                                                                    <div class="e-field-step elementor-hidden"
                                                                        data-label="Step 1" data-previousbutton=""
                                                                        data-nextbutton="" data-iconurl=""
                                                                        data-iconlibrary="fas fa-star"
                                                                        data-icon='&lt;svg class="e-font-icon-svg e-fas-star" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"&gt;&lt;path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"&gt;&lt;/path&gt;&lt;/svg&gt;'>
                                                                    </div>
                                                                </div>
                                                                <!-- Repeat all form fields here - I'll add the key ones for brevity -->
                                                                <div
                                                                    class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_fef8009 elementor-col-100">
                                                                    Your Booking Details
                                                                </div>
                                                                <!-- Add all the form fields from the original form here -->
                                                                <div
                                                                    class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                                                                    <button class="elementor-button elementor-size-sm"
                                                                        type="submit">
                                                                        <span class="elementor-button-content-wrapper">
                                                                            <span class="elementor-button-text">Complete</span>
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div> --}}
                                            @endif
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
    <script>
        window.freeQuoteState = {
            currentStep: {{ $currentStep ?? 1 }},
            selectedCategoryId: {{ $selectedCategoryId ?? 'null' }},
            formData: {!! json_encode($formData ?? []) !!},
            baseUrl: '{{ route('book-services.index') }}',
            nextStepUrl: '{{ route('book-services.next-step') }}',
            csrfToken: '{{ csrf_token() }}',
            user: @json(auth()->check() ? auth()->user() : null)
        };
    </script>
    <script src="/js/bookscript.js"></script>
    <script>
        let currentStep = {{ $currentStep ?? 1 }};
        const totalSteps = 9;
        let selectedCategoryId = null;
        const formData = {!! json_encode($formData ?? []) !!};
        let continueRequestInFlight = false;
        const freeQuoteBaseUrl = '{{ route('book-services.index') }}';
        const freeQuoteNextStepUrl = '{{ route('book-services.next-step') }}';
        const stepSlugMap = {
            1: '',
            2: 'category',
            3: 'services',
            4: 'frequency',
            5: 'duration',
            6: 'extras',
            7: 'pets',
            8: 'date',
            9: 'time',
        };

        function getBookingWizardForm() {
            return document.querySelector('#bookingWizard') || document.querySelector('form.elementor-form');
        }

        function getStepFromUrl(pathname) {
            if (!pathname) {
                return 1;
            }

            const segments = pathname.replace(/\/$/, '').split('/');
            const lastSegment = segments[segments.length - 1];

            const matchedEntry = Object.entries(stepSlugMap).find(([, slug]) => slug === lastSegment);
            if (matchedEntry) {
                return parseInt(matchedEntry[0], 10);
            }

            return 1;
        }

        function setLoadingState(isLoading) {
            const nextButton = document.getElementById('nextBtn');
            const prevButton = document.getElementById('prevBtn');

            if (nextButton) {
                nextButton.dataset.originalDisabled = nextButton.dataset.originalDisabled || nextButton.disabled;
                nextButton.classList.toggle('is-loading', isLoading);
                nextButton.disabled = isLoading || nextButton.dataset.originalDisabled === 'true';
            }

            if (prevButton) {
                prevButton.dataset.originalDisabled = prevButton.dataset.originalDisabled || prevButton.disabled;
                prevButton.classList.toggle('is-loading', isLoading);
                prevButton.disabled = isLoading;
            }
        }

        function resetButtonState() {
            const nextButton = document.getElementById('nextBtn');
            const prevButton = document.getElementById('prevBtn');

            if (nextButton) {
                const shouldRemainDisabled = nextButton.dataset.originalDisabled === 'true';
                nextButton.disabled = shouldRemainDisabled;
                nextButton.classList.remove('is-loading');
                delete nextButton.dataset.originalDisabled;
            }

            if (prevButton) {
                prevButton.disabled = false;
                prevButton.classList.remove('is-loading');
                delete prevButton.dataset.originalDisabled;
            }
        }

        function persistStepProgress(stepNumber, additionalData = {}) {
            const wizardForm = getBookingWizardForm();
            if (!wizardForm) {
                return Promise.resolve();
            }

            const formFields = wizardForm.querySelectorAll('[name^="form_fields["]');
            const multiValueFields = {};
            const payload = {};

            formFields.forEach(field => {
                const isArrayField = field.name.includes('[]');
                const rawName = field.name.replace('form_fields[', '').replace(']', '').replace('[]', '');
                const normalizedName = rawName.replace('_booking_form', '');

                if (isArrayField) {
                    if (!Array.isArray(multiValueFields[normalizedName])) {
                        multiValueFields[normalizedName] = [];
                    }

                    if (field.checked || field.type !== 'checkbox') {
                        multiValueFields[normalizedName].push(field.value);
                    }

                    return;
                }

                if (field.type === 'radio') {
                    if (field.checked) {
                        payload[normalizedName] = field.value;
                    }
                    return;
                }

                if (field.type === 'checkbox') {
                    if (!Array.isArray(multiValueFields[normalizedName])) {
                        multiValueFields[normalizedName] = [];
                    }

                    if (field.checked) {
                        multiValueFields[normalizedName].push(field.value);
                    }

                    return;
                }

                payload[normalizedName] = field.value;
            });

            Object.entries(multiValueFields).forEach(([key, values]) => {
                payload[key] = values;
            });

            payload.current_step = stepNumber;

            const requestBody = {
                current_step: stepNumber,
                form_data: { ...payload, ...additionalData }
            };

            return fetch(freeQuoteNextStepUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(requestBody)
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Failed to save progress');
                }

                return response.json();
            });
        }

        function goToSpecificStep(stepNumber, pushState = true) {
            document.getElementById('currentStep').value = stepNumber;
            currentStep = stepNumber;
            showStep(currentStep);
        }

        // Auto-populate logged-in user's data if available
        function autoPopulateUserData() {
            const userData = @json(auth()->check() ? auth()->user() : null);

            if (userData) {
                console.log('👤 Auto-populating form with logged-in user data...');

                const nameField = document.querySelector('input[name="form_fields[name_booking_form]"]');
                const emailField = document.querySelector('input[name="form_fields[email_booking_form]"]');
                const phoneField = document.querySelector('input[name="form_fields[tel_booking_form]"]');

                if (nameField && userData.name) {
                    nameField.value = userData.name;
                    console.log('✅ Name auto-populated:', userData.name);
                }

                if (emailField && userData.email) {
                    emailField.value = userData.email;
                    console.log('✅ Email auto-populated:', userData.email);
                }

                if (phoneField && userData.phone) {
                    phoneField.value = userData.phone;
                    console.log('✅ Phone auto-populated:', userData.phone);
                }
            } else {
                console.log('ℹ️ No user logged in - form will request contact information');
            }
        }

        function initAddressAutocomplete() {
            const addressInput = document.getElementById('address');
            const suggestionsDiv = document.getElementById('addressSuggestions');

            if (!addressInput || !suggestionsDiv) {
                console.warn('Address autocomplete elements not found');
                return;
            }

            let searchTimeout;

            addressInput.addEventListener('input', function () {
                clearTimeout(searchTimeout);
                const query = this.value.trim();

                console.log('Address input:', query);

                if (query.length < 3) {
                    suggestionsDiv.style.display = 'none';
                    suggestionsDiv.innerHTML = '';
                    return;
                }

                suggestionsDiv.innerHTML = '<div style="padding: 10px 15px; color: #666;">🔍 Searching...</div>';
                suggestionsDiv.style.display = 'block';

                searchTimeout = setTimeout(() => {
                    const apiUrl = `{{ route('api.address-suggestions') }}?q=${encodeURIComponent(query)}`;
                    console.log('Fetching from:', apiUrl);

                    fetch(apiUrl)
                        .then(response => {
                            console.log('Response status:', response.status);
                            return response.json();
                        })
                        .then(data => {
                            console.log('API Response:', data);
                            suggestionsDiv.innerHTML = '';

                            if (data.status === 'success' && data.suggestions && data.suggestions.length > 0) {
                                data.suggestions.forEach(suggestion => {
                                    const div = document.createElement('div');
                                    div.className = 'address-suggestion-item';
                                    div.style.cssText = `
                                                padding: 12px 15px;
                                                border-bottom: 1px solid #eee;
                                                cursor: pointer;
                                                transition: background-color 0.2s;
                                                background-color: white;
                                            `;
                                    div.innerHTML = `
                                                <div style="font-weight: 500; color: #333;">${suggestion.address}</div>
                                                <div style="font-size: 12px; color: #999;">${suggestion.city}, ${suggestion.postal_code}</div>
                                            `;

                                    div.addEventListener('mouseover', function () {
                                        this.style.backgroundColor = '#f5f5f5';
                                    });

                                    div.addEventListener('mouseout', function () {
                                        this.style.backgroundColor = 'white';
                                    });

                                    div.addEventListener('click', function () {
                                        addressInput.value = suggestion.address;
                                        suggestionsDiv.style.display = 'none';
                                        suggestionsDiv.innerHTML = '';
                                        console.log('Selected address:', suggestion.address);
                                        addressInput.dispatchEvent(new Event('change', { bubbles: true }));
                                        updateAccordion();
                                        saveFormDataToSession();
                                        showStep(1);
                                    });

                                    suggestionsDiv.appendChild(div);
                                });

                                suggestionsDiv.style.display = 'block';
                                console.log('Showing ' + data.suggestions.length + ' suggestions');
                            } else if (data.status === 'error') {
                                suggestionsDiv.innerHTML = `<div style="padding: 10px 15px; color: #d32f2f;">⚠️ ${data.message || 'Error fetching suggestions'}</div>`;
                                suggestionsDiv.style.display = 'block';
                                console.error('API Error:', data.message);
                            } else {
                                suggestionsDiv.innerHTML = '<div style="padding: 10px 15px; color: #999;">No addresses found</div>';
                                suggestionsDiv.style.display = 'block';
                            }
                        })
                        .catch(error => {
                            console.error('Address suggestion error:', error);
                            suggestionsDiv.innerHTML = '<div style="padding: 10px 15px; color: #d32f2f;">❌ Error fetching suggestions</div>';
                            suggestionsDiv.style.display = 'block';
                        });
                }, 300);
            });

            document.addEventListener('click', function (event) {
                if (event.target !== addressInput && !suggestionsDiv.contains(event.target)) {
                    suggestionsDiv.style.display = 'none';
                }
            });

            addressInput.addEventListener('focus', function () {
                if (this.value.length >= 3 && suggestionsDiv.innerHTML) {
                    suggestionsDiv.style.display = 'block';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            console.log('📋 Initializing form with saved data:', formData);
            console.log('📍 Current step:', currentStep);

            autoPopulateUserData();
            initAddressAutocomplete();

            if (formData && Object.keys(formData).length > 0) {
                if (formData.street_address) {
                    const addressField = document.querySelector('input[name="form_fields[street_booking_form]"]');
                    if (addressField) addressField.value = formData.street_address;
                }

                if (formData.category_name) {
                    const categoryRadio = document.querySelector(`input[name="form_fields[category_booking_form]"][value="${formData.category_name}"]`);
                    if (categoryRadio) {
                        categoryRadio.checked = true;
                        const categoryCard = categoryRadio.closest('.service-card');
                        if (categoryCard) categoryCard.click();
                    }
                }

                if (formData.service_name) {
                    const serviceRadio = document.querySelector(`input[name="form_fields[service_booking_form]"][value="${formData.service_name}"]`);
                    if (serviceRadio) {
                        serviceRadio.checked = true;
                        const serviceCard = serviceRadio.closest('.service-card');
                        if (serviceCard) serviceCard.click();
                    }
                }

                if (formData.frequency) {
                    const freqRadio = document.querySelector(`input[name="form_fields[frequency_booking_form]"][value="${formData.frequency}"]`);
                    if (freqRadio) freqRadio.checked = true;
                }

                if (formData.duration) {
                    const durationRadio = document.querySelector(`input[name="form_fields[duration_booking_form]"][value="${formData.duration}"]`);
                    if (durationRadio) durationRadio.checked = true;
                }

                if (formData.pets) {
                    const petsRadio = document.querySelector(`input[name="form_fields[pets_booking_form]"][value="${formData.pets}"]`);
                    if (petsRadio) petsRadio.checked = true;
                }

                if (formData.customer_name) {
                    const nameField = document.querySelector('input[name="form_fields[name_booking_form]"]');
                    if (nameField) nameField.value = formData.customer_name;
                }

                if (formData.phone) {
                    const phoneField = document.querySelector('input[name="form_fields[tel_booking_form]"]');
                    if (phoneField) phoneField.value = formData.phone;
                }

                if (formData.email) {
                    const emailField = document.querySelector('input[name="form_fields[email_booking_form]"]');
                    if (emailField) emailField.value = formData.email;
                }

                if (formData.booking_date) {
                    const dateField = document.getElementById('appointmentDate');
                    if (dateField) {
                        dateField.value = formData.booking_date;
                        const date = new Date(formData.booking_date + 'T00:00:00');
                        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                        document.getElementById('selectedDateDisplay').textContent =
                            '✓ Selected: ' + date.toLocaleDateString('en-US', options);
                    }
                }

                if (formData.booking_time) {
                    const timeField = document.getElementById('appointmentTime');
                    if (timeField) timeField.value = formData.booking_time;
                }
            }

            setTimeout(() => {
                showStep(currentStep);
                renderCalendar();
                generateTimeSlots();
                updateAccordion();

                restoreFormDataFromSession();
                updateAccordion();
                checkAndAutoSubmitBooking();
            }, 100);

            window.addEventListener('popstate', event => {
                const stepFromState = event.state?.step;
                const targetStep = stepFromState || getStepFromUrl(window.location.pathname);
                if (targetStep) {
                    goToSpecificStep(targetStep, false);
                }
            });
        });

        function selectCategory(cardElement, categoryId, categoryName) {
            document.querySelectorAll('#categoriesContainer .service-card').forEach(card => {
                card.classList.remove('selected');
            });

            cardElement.classList.add('selected');

            const radios = document.querySelectorAll('input[name="form_fields[category_booking_form]"]');
            radios.forEach(radio => {
                radio.checked = radio.value === categoryName;
            });

            selectedCategoryId = categoryId;
            document.getElementById('selectedCategoryName').textContent = categoryName;

            document.getElementById('selectedCategoryDisplay').classList.add('active');

            loadServicesByCategory(categoryId);

            updateAccordion();
            saveFormDataToSession();

            // Persist progress for current step
            persistStepProgress(2);

            const shouldSkipFrequency = cardElement.dataset.skipFrequency === 'true';

            showStep(shouldSkipFrequency ? 5 : 2);

            setTimeout(() => {
                document.getElementById('selectedCategoryDisplay').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        }

        // Load Services by Selected Category
        function loadServicesByCategory(categoryId) {
            fetch('{{ route("api.services-by-category") }}?category_id=' + categoryId)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('servicesContainer');
                    container.innerHTML = '';

                    if (data.success && data.data.length > 0) {
                        data.data.forEach(service => {
                            const card = document.createElement('div');
                            card.className = 'service-card';
                            card.dataset.skipFrequency = service.skip_frequency ? 'true' : 'false';
                            card.onclick = function () {
                                selectService(
                                    this,
                                    service.id,
                                    service.name,
                                    service.price_from,
                                    service.price_to,
                                    service.short_description,
                                    !!service.skip_frequency
                                );
                            };

                            let priceDisplay = 'Contact for pricing';
                            if(service.price_to){
                                priceDisplay = '€' +  Math.floor(service.price_to);
                            } else
                            if (service.price_from && service.price_to) {
                                priceDisplay = '€' +  Math.floor(service.price_to);
                            } else if (service.price_from) {
                                priceDisplay = 'From €' + Math.floor(service.price_from);
                            }

                            card.innerHTML = `
                                                <h4>${service.name}</h4>
                                                <div class="price">${priceDisplay}</div>
                                                <div class="description">${service.short_description}</div>
                                                <input type="radio" name="form_fields[service_booking_form]" value="${service.name}" data-price="${service.price_to || 0}" style="display: none;" required>
                                            `;
                            container.appendChild(card);
                        });

                        // After services are loaded, restore service selection from session
                        const sessionData = @json(session('booking_form_data', []));
                        if (sessionData.service_name) {
                            const savedServiceRadio = document.querySelector(`input[name="form_fields[service_booking_form]"][value="${sessionData.service_name}"]`);
                            if (savedServiceRadio) {
                                savedServiceRadio.checked = true;
                                // Also update the visual display
                                const serviceCard = savedServiceRadio.closest('.service-card');
                                if (serviceCard) {
                                    serviceCard.classList.add('selected');
                                    const serviceName = savedServiceRadio.value;
                                    document.getElementById('selectedServiceName').textContent = serviceName;
                                    console.log('✅ Service restored from session:', serviceName);
                                }
                            }
                        }
                    } else {
                        container.innerHTML = '<p>No services available in this category</p>';
                    }
                })
                .catch(err => {
                    console.error('Error loading services:', err);
                    document.getElementById('servicesContainer').innerHTML = '<p>Error loading services. Please try again.</p>';
                });
        }

        // Service Card Selection Function
        function selectService(cardElement, serviceId, serviceName, priceFrom, priceTo, description, skipFrequency = false) {
            document.querySelectorAll('.service-card').forEach(card => {
                card.classList.remove('selected');
            });

            cardElement.classList.add('selected');

            const radios = document.querySelectorAll('input[name="form_fields[service_booking_form]"]');
            radios.forEach(radio => {
                radio.checked = radio.value === serviceName;
            });

            const displayCard = document.getElementById('selectedServiceDisplay');
            document.getElementById('selectedServiceName').textContent = serviceName;

            let priceDisplay = 'Contact for pricing';
            if(priceTo){
                priceDisplay = '€' +  Math.floor(priceTo);
                console.log("hellocheckitagain",priceDisplay);
            } else
            if (priceFrom && priceTo) {
                priceDisplay = '€' +  Math.floor(priceTo);
            } else if (priceFrom) {
                priceDisplay = '€' + Math.floor(priceFrom);
            }
            document.getElementById('selectedServicePrice').textContent = priceDisplay;
            document.getElementById('selectedServiceDesc').textContent = description;
            document.getElementById('selectedServiceDisplay').dataset.skipFrequency = skipFrequency ? 'true' : 'false';

            const frequencyStep = document.getElementById('frequencyStep');
            if (frequencyStep) {
                frequencyStep.style.display = skipFrequency ? 'none' : 'block';
            }

            // Persist step before fetching extra data
            persistStepProgress(skipFrequency ? 5 : 3);

            fetch('{{ route("api.service-details") }}?service_id=' + serviceId)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data.duration) {
                        document.getElementById('selectedServiceDuration').textContent = data.data.duration;
                    }
                })
                .catch(err => console.log('Duration fetch error'));

            displayCard.classList.add('active');

            updateAccordion();
            saveFormDataToSession();

            // Update button state after service selection
            showStep(3);

            setTimeout(() => {
                displayCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        }

        function showStep(step) {
            const frequencyStep = document.getElementById('frequencyStep');
            const selectedCategory = document.querySelector('input[name="form_fields[category_booking_form]"]:checked');
            const selectedService = document.querySelector('input[name="form_fields[service_booking_form]"]:checked');

            frequencyStep.style.display = 'block';

            document.querySelectorAll('.step').forEach(el => el.classList.remove('active'));
            const activeStep = document.querySelector(`.step[data-step="${step}"]`);
            if (activeStep) {
                activeStep.classList.add('active');
                document.getElementById('currentStep').value = step;

                // Re-render calendar when step 8 becomes active
                if (step === 8) {
                    setTimeout(() => renderCalendar(), 50);
                }
            }

            // Update button visibility
            document.getElementById('prevBtn').style.display = step > 1 ? 'inline-block' : 'none';
            document.getElementById('nextBtn').style.display = step < totalSteps ? 'inline-block' : 'none';
            document.getElementById('submitBtn').style.display = step === totalSteps ? 'inline-block' : 'none';

            // Manage button state based on step and selections
            let shouldDisable = false;

            // Step 1: Address Validation (must have address)
            if (step === 1) {
                const addressField = document.querySelector('input[name="form_fields[street_booking_form]"]');
                const addressValue = addressField ? addressField.value.trim() : '';
                // shouldDisable = addressValue.length < 5; // Just check if address is filled
                shouldDisable = addressValue.length === 0;
            }
            // Step 2: Category Selection
            else if (step === 2) {
                shouldDisable = !selectedCategory;
            }
            // Step 3: Service Selection
            else if (step === 3) {
                shouldDisable = !selectedService;
            }
            // Step 4: Frequency (only if shown)
            else if (step === 4 && frequencyStep.style.display !== 'none') {
                const selectedFreq = document.querySelector('input[name="form_fields[frequency_booking_form]"]:checked');
                shouldDisable = !selectedFreq;
            }
            // Step 5: Duration
            else if (step === 5) {
                const selectedDuration = document.querySelector('input[name="form_fields[duration_booking_form]"]:checked');
                shouldDisable = !selectedDuration;
            }
            // Step 6: Bedrooms/Bathrooms (no validation needed)
            else if (step === 6) {
                shouldDisable = false; // Allow to continue
            }
            // Step 7: Pets
            else if (step === 7) {
                const selectedPets = document.querySelector('input[name="form_fields[pets_booking_form]"]:checked');
                shouldDisable = !selectedPets;
            }
            // Step 8: Date
            else if (step === 8) {
                const selectedDate = document.getElementById('appointmentDate').value;
                shouldDisable = !selectedDate;
            }
            // Step 9: Time
            else if (step === 9) {
                const selectedTime = document.getElementById('appointmentTime').value;
                shouldDisable = !selectedTime;
            }

            if (step < totalSteps) {
                document.getElementById('nextBtn').disabled = shouldDisable;
            }

            // Update accordion display
            updateAccordion();
        }

        function collectFormData() {
            const appointmentTimeValue = document.getElementById('appointmentTime')?.value || '';
            const firstTime = appointmentTimeValue.split(',')[0].trim();
            
            return {
                category_name: document.querySelector('input[name="form_fields[category_booking_form]"]:checked')?.value || '',
                service_name: document.querySelector('input[name="form_fields[service_booking_form]"]:checked')?.value || '',
                bedrooms: parseInt(document.querySelector('input[name="form_fields[bedrooms_booking_form]"]:checked')?.value || '0'),
                bathrooms: parseInt(document.querySelector('input[name="form_fields[bathrooms_booking_form]"]:checked')?.value || '0'),
                extras: Array.from(document.querySelectorAll('input[name="form_fields[extras_booking_form]"]:checked')).map(cb => cb.value),
                frequency: document.querySelector('input[name="form_fields[frequency_booking_form]"]:checked')?.value || '',
                duration: document.querySelector('input[name="form_fields[duration_booking_form]"]:checked')?.value || '',
                area: document.querySelector('input[name="form_fields[area_booking_form]"]:checked')?.value || '',
                booking_date: document.getElementById('appointmentDate')?.value || '',
                booking_time: firstTime,
                customer_name: document.querySelector('input[name="form_fields[name_booking_form]"]')?.value || '',
                phone: document.querySelector('input[name="form_fields[tel_booking_form]"]')?.value || '',
                email: document.querySelector('input[name="form_fields[email_booking_form]"]')?.value || '',
                street_address: document.querySelector('input[name="form_fields[street_booking_form]"]')?.value || '',
                city: document.querySelector('input[name="form_fields[city_booking_form]"]')?.value || '',
                state: document.querySelector('input[name="form_fields[states_booking_form]"]')?.value || '',
                zip_code: document.querySelector('input[name="form_fields[zip_code_booking_form]"]')?.value || '',
                parking_info: document.querySelector('input[name="form_fields[where_to_park_booking_form]"]:checked')?.value || '',
                flexible_time: document.querySelector('input[name="form_fields[flexible_time_booking_form]"]:checked')?.value || '',
                entrance_info: document.querySelector('input[name="form_fields[entrance_info_booking_form]"]:checked')?.value || '',
                pets: document.querySelector('input[name="form_fields[pets_booking_form]"]:checked')?.value || '',
                special_instructions: document.querySelector('textarea[name="form_fields[message_booking_form]"]')?.value || '',
                calculated_price: document.getElementById('calculated_price_field')?.value || ''
            };
        }

        function saveFormDataToSession() {
            const formData = collectFormData();
            fetch('{{ route("book-services.save-session") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ form_data: formData })
            }).catch(err => console.log('Session save attempted'));
        }

        // Update accordion with current selections
        function updateAccordion() {
            const basketContainer = document.getElementById('bookingBasket');

            const address = document.querySelector('input[name="form_fields[street_booking_form]"]')?.value || '';
            const service = document.querySelector('input[name="form_fields[service_booking_form]"]:checked')?.value || '';
            const duration = document.querySelector('input[name="form_fields[duration_booking_form]"]:checked')?.value || '';
            const extraServices = Array.from(document.querySelectorAll('input[name="form_fields[extras_booking_form]"]:checked')).map(cb => cb.value);
            const pets = document.querySelector('input[name="form_fields[pets_booking_form]"]:checked')?.value || '';
            const appointmentDate = document.getElementById('appointmentDate')?.value || '';
            const appointmentTime = document.getElementById('appointmentTime')?.value || '';

            const serviceRadio = document.querySelector('input[name="form_fields[service_booking_form]"]:checked');
            const durationInput = document.querySelector('input[name="form_fields[duration_booking_form]"]:checked');
            const selectedExtras = Array.from(document.querySelectorAll('input[name="form_fields[extras_booking_form]"]:checked'));

            let calculatedPrice = null;
            let servicePrice = 0;
            let durationHours = 0;

            console.log(servicePrice, "according updateaccordin");


            if (serviceRadio && durationInput) {
                servicePrice = parseFloat(serviceRadio.getAttribute('data-price')) || 0;
                const durationMatch = durationInput.value.match(/\d+/);
                durationHours = durationMatch ? parseInt(durationMatch[0]) : 0;

                if (servicePrice > 0 && durationHours > 0) {
                    calculatedPrice = servicePrice * durationHours;

                    let extraCostPerHour = 0;
                    const materialsSelected = selectedExtras.some(extra => extra.value === 'Cleaning materials');
                    if (materialsSelected) {
                        extraCostPerHour += 2;
                    }

                    const equipmentSelected = selectedExtras.some(extra => extra.value === 'Cleaning equipment');
                    if (equipmentSelected) {
                        extraCostPerHour += 2;
                    }

                    calculatedPrice += extraCostPerHour * durationHours;
                    calculatedPrice = Math.round(calculatedPrice * 100) / 100;
                }
                console.log(servicePrice);

            }

            function formatDate(dateValue) {
                if (!dateValue) return '';
                try {
                    const date = new Date(dateValue + 'T00:00:00');
                    const options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
                    return date.toLocaleDateString('en-US', options);
                } catch (e) {
                    return dateValue;
                }
            }

            let html = '';

            if (address) {
                html += `
                    <div class="basket-accordion-item">
                        <div class="basket-accordion-header" onclick="this.nextElementSibling.classList.toggle('active'); this.classList.toggle('active')">
                            <span class="basket-icon basket-icon-location">
                                <i class="fa-solid fa-location-dot"></i>
                            </span>
                            <span class="basket-title">${address}</span>
                            <span class="basket-toggle">▲</span>
                        </div>
                        <div class="basket-accordion-content active">
                            <p>No additional info</p>
                        </div>
                    </div>
                `;
            }

            if (service) {
                html += `
                    <div class="basket-accordion-item basket-service-item">
                        <div class="basket-accordion-header basket-service-header" onclick="this.nextElementSibling.classList.toggle('active'); this.classList.toggle('active')">
                            <div class="basket-service-header-left">
                                <span class="basket-icon basket-icon-service">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </span>
                                <span class="basket-title">${service}</span>
                            </div>
                            <span class="basket-toggle">▲</span>
                        </div>
                        <div class="basket-accordion-content active">
                            <ul class="basket-items-list">
                `;

                html += `<li><span class="item-name"><strong>${service}</strong></span> <span class="item-price">€${(servicePrice).toFixed(2)}/h</span></li>`;

                if (duration) {
                    html += `<li><span class="item-name">${duration}</span></li>`;
                }

                if (pets) {
                    html += `<li><span class="item-name">Presence of pets: ${pets}</span></li>`;
                }

                extraServices.forEach(extra => {
                    if (extra === 'Cleaning materials' || extra === 'Cleaning equipment') {
                        html += `<li><span class="item-name">${extra}</span> <span class="item-price">€${(2).toFixed(2)}/h</span></li>`;
                    } else {
                        html += `<li><span class="item-name">${extra}</span></li>`;
                    }
                });

                html += `
                            </ul>
                        </div>
                    </div>
                `;
            }

            if (calculatedPrice !== null) {
                html += `
                    <div class="basket-total-section">
                        <div class="basket-total-row">
                            <span>Total</span>
                            <span class="basket-total-price">€${calculatedPrice.toFixed(2)}/session</span>
                        </div>
                        <p class="basket-total-note">Service fee included</p>
                    </div>
                `;
            }

            if (appointmentDate || appointmentTime) {
                const formattedDate = formatDate(appointmentDate);
                const totalTimeSlots = 31;
                const selectedTimes = appointmentTime ? appointmentTime.split(',').map(t => t.trim()).filter(t => t) : [];
                const selectedTimesCount = selectedTimes.length;
                const otherAvailabilities = Math.max(0, totalTimeSlots - selectedTimesCount);
                const timeDisplay = selectedTimes.length > 0 ? selectedTimes[0] : '--:--';
                html += `
                    <div class="basket-accordion-item">
                        <div class="basket-accordion-header" onclick="this.nextElementSibling.classList.toggle('active'); this.classList.toggle('active')">
                            <span class="basket-icon basket-icon-time">
                                <i class="fa-solid fa-clock"></i>
                            </span>
                            <span class="basket-title">${formattedDate} at ${timeDisplay}</span>
                            <span class="basket-toggle">▲</span>
                        </div>
                        <div class="basket-accordion-content active">
                            ${selectedTimes.length > 0 ? `<p><strong>Selected times:</strong> ${selectedTimes.join(', ')}</p>` : ''}
                            <p class="availability">${otherAvailabilities} other ${otherAvailabilities === 1 ? 'availability' : 'availabilities'}</p>
                        </div>
                    </div>
                `;
            }

            if (!address && !service && !appointmentDate) {
                html = `<p style="color: #999; font-size: 13px; text-align: center; padding: 20px 0;">Your selections will appear here</p>`;
            }

            basketContainer.innerHTML = html;
        }


        // Generic option card selection for radio buttons
        function selectOption(cardElement, fieldName, value, buttonId = null) {
            const container = cardElement.parentElement;
            container.querySelectorAll('.option-card').forEach(card => {
                card.classList.remove('selected');
            });

            cardElement.classList.add('selected');

            const radio = cardElement.querySelector('input[type="radio"]');
            if (radio) {
                radio.checked = true;
            }

            // Button control is now handled by showStep() calls in onclick handlers

            // Update accordion and save to session
            updateAccordion();
            saveFormDataToSession();
        }

        // Generic option card toggle for checkboxes
        function toggleOption(cardElement, fieldName, value) {
            const checkbox = cardElement.querySelector('input[type="checkbox"]');
            if (checkbox) {
                checkbox.checked = !checkbox.checked;
                if (checkbox.checked) {
                    cardElement.classList.add('selected');
                } else {
                    cardElement.classList.remove('selected');
                }
            }

            // Update accordion and save to session
            updateAccordion();
            saveFormDataToSession();
        }

        // Calendar variables
        let currentCalendarDate = new Date();

        // Render calendar
        function renderCalendar() {
            const year = currentCalendarDate.getFullYear();
            const month = currentCalendarDate.getMonth();
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const daysInMonth = lastDay.getDate();
            const startingDayOfWeek = firstDay.getDay();

            document.getElementById('calendarMonth').textContent =
                currentCalendarDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });

            const calendarDays = document.getElementById('calendarDays');
            calendarDays.innerHTML = '';

            // Get selected date if one exists
            const selectedDateValue = document.getElementById('appointmentDate').value;
            let selectedDate = null;
            if (selectedDateValue) {
                // Parse date string (YYYY-MM-DD) without timezone conversion
                const [year, month, day] = selectedDateValue.split('-').map(Number);
                selectedDate = new Date(year, month - 1, day);
            }

            // Previous month's days
            const prevMonth = new Date(year, month, 0);
            const daysInPrevMonth = prevMonth.getDate();
            for (let i = startingDayOfWeek - 1; i >= 0; i--) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'calendar-day other-month';
                dayDiv.textContent = daysInPrevMonth - i;
                calendarDays.appendChild(dayDiv);
            }

            // Current month's days
            const today = new Date();
            for (let day = 1; day <= daysInMonth; day++) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'calendar-day';
                dayDiv.textContent = day;

                const fullDate = new Date(year, month, day);

                // Disable past dates
                if (fullDate < new Date(today.getFullYear(), today.getMonth(), today.getDate())) {
                    dayDiv.classList.add('other-month');
                    dayDiv.onclick = null;
                } else {
                    // Highlight today
                    if (fullDate.toDateString() === today.toDateString()) {
                        dayDiv.classList.add('today');
                    }

                    // Highlight selected date if it matches this calendar day
                    if (selectedDate && fullDate.toDateString() === selectedDate.toDateString()) {
                        dayDiv.classList.add('selected');
                    }

                    dayDiv.onclick = function () {
                        selectDate(fullDate);
                    };
                }
                calendarDays.appendChild(dayDiv);
            }

            // Next month's days
            let nextDay = 1;
            const totalCells = calendarDays.children.length;
            for (let i = totalCells; i < 42; i++) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'calendar-day other-month';
                dayDiv.textContent = nextDay;
                calendarDays.appendChild(dayDiv);
                nextDay++;
            }
        }

        function previousMonth() {
            currentCalendarDate.setMonth(currentCalendarDate.getMonth() - 1);
            renderCalendar();
        }
        function nextMonth() {
            currentCalendarDate.setMonth(currentCalendarDate.getMonth() + 1);
            renderCalendar();
        }

        function selectDate(date) {
            // Convert to local YYYY-MM-DD format (not UTC)
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const dateString = `${year}-${month}-${day}`;
            document.getElementById('appointmentDate').value = dateString;

            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('selectedDateDisplay').textContent =
                '✓ Selected: ' + date.toLocaleDateString('en-US', options);

            // Update calendar display
            document.querySelectorAll('.calendar-day').forEach(day => {
                day.classList.remove('selected');
            });
            // Use closest to find the clicked element's parent calendar-day (in case of nested elements)
            const clickedDay = event.target.closest('.calendar-day');
            if (clickedDay) {
                clickedDay.classList.add('selected');
            }

            // Enable time selection by generating time slots
            generateTimeSlots();

            // Update accordion and save to session
            updateAccordion();
            saveFormDataToSession();

            // Update button state after date selection
            showStep(8);

            // Re-render calendar to ensure it's displayed correctly
            setTimeout(() => renderCalendar(), 100);
            setTimeout(() => showStep(8), 150);
        }

        // Generate time slots
        function generateTimeSlots() {
            const timeSlots = document.getElementById('timeSlots');
            timeSlots.innerHTML = '';

            const times = [
                '07:00', '07:30', '08:00', '08:30', '09:00', '09:30',
                '10:00', '10:30', '11:00', '11:30', '12:00', '12:30',
                '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
                '16:00', '16:30', '17:00', '17:30', '18:00', '18:30',
                '19:00', '19:30', '20:00', '20:30', '21:00', '21:30',
                '22:00'
            ];

            const selectedTimes = (document.getElementById('appointmentTime')?.value || '').split(',').map(t => t.trim()).filter(t => t);

            times.forEach(time => {
                const slot = document.createElement('div');
                slot.className = 'time-slot';
                slot.textContent = time;

                if (selectedTimes.includes(time)) {
                    slot.classList.add('selected');
                    if (time === selectedTimes[0]) {
                        slot.classList.add('selected-primary');
                    }
                }

                slot.onclick = function () {
                    selectTime(this, time);
                };
                timeSlots.appendChild(slot);
            });
        }

        function selectTime(element, time) {
            element.classList.toggle('selected');

            const selectedSlots = Array.from(document.querySelectorAll('.time-slot.selected'))
                .map(slot => slot.textContent)
                .join(', ');

            if (selectedSlots) {
                document.getElementById('appointmentTime').value = selectedSlots;
                document.getElementById('selectedTimeDisplay').textContent = '✓ Selected: ' + selectedSlots;
            } else {
                document.getElementById('appointmentTime').value = '';
                document.getElementById('selectedTimeDisplay').textContent = '';
            }

            // Update accordion and save to session
            updateAccordion();
            saveFormDataToSession();

            // Update button state after time selection
            showStep(9);
            setTimeout(() => showStep(9), 100);
        }

        function submitBookingForm() {
            // Validate all required fields first
            const formData = collectFormData();

            // Check for empty fields
            const requiredFields = ['category_name', 'service_name', 'street_address', 'booking_date', 'booking_time'];
            const emptyFields = requiredFields.filter(field => !formData[field]);

            if (emptyFields.length > 0) {
                alert('❌ Please fill in all required fields:\n' + emptyFields.join('\n'));
                console.warn('⚠️ Empty required fields:', emptyFields);
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // Add current step to form data for post-login redirect
            const submitData = {
                ...formData,
                current_step: currentStep
            };

            console.log('📤 Submitting booking with data:', submitData);

            fetch('{{ route("book-services.submit") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(submitData)
            })
                .then(response => {
                    console.log('📨 Response received:', response.status, response.statusText);
                    return response.json().then(data => ({
                        status: response.status,
                        body: data
                    }));
                })
                .then(({ status, body }) => {
                    console.log('📦 Response data:', body);

                    if (body.status === 401) {
                        console.log('🔐 Redirecting to login...');
                        window.location.href = body.redirect;
                    } else if (body.status === 200) {
                        console.log('✅ Booking successful!');
                        alert('✅ ' + (body.message || 'Your service has been booked successfully!'));
                        setTimeout(() => {
                            window.location.href = body.redirect;
                        }, 1500);
                    } else {
                        console.error('❌ Error:', body);
                        alert('❌ ' + (body.message || 'An error occurred. Please try again.'));
                    }
                })
                .catch(error => {
                    console.error('❌ Network error:', error);
                    alert('❌ An error occurred while submitting your booking. Please try again.\n\nDetails: ' + error.message);
                });
        }

        function changeStep(direction) {
            const activeStep = document.querySelector('.step.active');
            if (!activeStep) return;

            currentStep = parseInt(activeStep.getAttribute('data-step'));

            // If going back, just show previous step (no redirects)
            if (direction < 0) {
                currentStep += direction;
                if (currentStep >= 1 && currentStep <= totalSteps) {
                    showStep(currentStep);
                }
                return;
            }

            if (direction > 0) {
                // Step validations before proceeding
                if (currentStep === 1) {
                    const addressField = document.querySelector('input[name="form_fields[street_booking_form]"]');
                    const addressValue = addressField ? addressField.value.toLowerCase().trim() : '';
                    const netherlandsVariations = ['netherlands', 'netherland', 'nederland', 'holland'];
                    const isValidAddress = netherlandsVariations.some(variation => addressValue.includes(variation));
                    if (!addressValue) {
                        alert('Please enter  property address  to continue');
                        return;
                    }
                } else if (currentStep === 2) {
                    const selectedCategory = document.querySelector('input[name="form_fields[category_booking_form]"]:checked');
                    if (!selectedCategory) {
                        alert('Please select a category to continue');
                        return;
                    }
                } else if (currentStep === 3) {
                    const selectedService = document.querySelector('input[name="form_fields[service_booking_form]"]:checked');
                    if (!selectedService) {
                        alert('Please select a cleaning service to continue');
                        return;
                    }
                } else if (currentStep === 4) {
                    const frequencyStep = document.getElementById('frequencyStep');
                    if (frequencyStep.style.display !== 'none') {
                        const selectedFreq = document.querySelector('input[name="form_fields[frequency_booking_form]"]:checked');
                        if (!selectedFreq) {
                            alert('Please select a cleaning frequency to continue');
                            return;
                        }
                    }
                } else if (currentStep === 5) {
                    const selectedDuration = document.querySelector('input[name="form_fields[duration_booking_form]"]:checked');
                    if (!selectedDuration) {
                        alert('Please select a service duration to continue');
                        return;
                    }
                } else if (currentStep === 6) {
                    // Optional extras step
                } else if (currentStep === 7) {
                    // Optional bedrooms/bathrooms step
                } else if (currentStep === 8) {
                    const selectedPets = document.querySelector('input[name="form_fields[pets_booking_form]"]:checked');
                    if (!selectedPets) {
                        alert('Please select whether you have pets to continue');
                        return;
                    }
                } else if (currentStep === 9) {
                    const selectedDate = document.getElementById('appointmentDate').value;
                    if (!selectedDate) {
                        alert('Please select an appointment date to continue');
                        return;
                    }
                } else if (currentStep === 10) {
                    const selectedTime = document.getElementById('appointmentTime').value;
                    if (!selectedTime) {
                        alert('Please select an appointment time to continue');
                        return;
                    }
                }

                // Persist step progress via AJAX
                setLoadingState(true);
                persistStepProgress(currentStep)
                    .then(response => {
                        if (!response.success) {
                            throw new Error(response.message || 'Failed to store progress');
                        }
                        goToSpecificStep(Math.min(currentStep + 1, totalSteps));
                    })
                    .catch(error => {
                        console.error('Error storing progress:', error);
                        alert('An error occurred while saving your progress. Please try again.');
                    })
                    .finally(() => {
                        setLoadingState(false);
                    });
            }
        }

        // Address Autocomplete with API Integration
        let addressSearchTimeout;
        const addressField = document.querySelector('input[name="form_fields[street_booking_form]"]');

        if (addressField) {
            addressField.addEventListener('input', function () {
                updateAccordion();
                saveFormDataToSession();
                persistStepProgress(1);

                const value = this.value.trim();
                const suggestionsDiv = document.getElementById('addressSuggestions');

                // Clear previous timeout
                clearTimeout(addressSearchTimeout);

                if (value.length < 3) {
                    suggestionsDiv.style.display = 'none';
                    return;
                }

                // Show loading indicator
                suggestionsDiv.innerHTML = '<div style="padding: 12px; text-align: center; color: #666; font-size: 14px;">Searching addresses...</div>';
                suggestionsDiv.style.display = 'block';

                // Debounce API calls - wait 300ms after user stops typing
                addressSearchTimeout = setTimeout(() => {
                    fetchAddressSuggestions(value, suggestionsDiv);
                }, 300);

                // Update continue button state
                showStep(1);
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function (e) {
                if (!addressField.contains(e.target) && !document.getElementById('addressSuggestions').contains(e.target)) {
                    document.getElementById('addressSuggestions').style.display = 'none';
                }
            });
        }

        // Fetch address suggestions from API
        function fetchAddressSuggestions(query, suggestionsDiv) {
            fetch(`{{ route('api.address-suggestions') }}?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsDiv.innerHTML = '';

                    if (data.status === 'success' && data.suggestions.length > 0) {
                        console.log(data);

                        data.suggestions.forEach((suggestion, index) => {
                            const suggestionDiv = document.createElement('div');
                            suggestionDiv.className = 'address-suggestion';
                            suggestionDiv.innerHTML = `
                                            <div style="font-weight: 500; color: #333;">${suggestion.address}</div>
                                            <div style="font-size: 12px; color: #999;">${suggestion.postal_code} ${suggestion.city}</div>
                                        `;
                            suggestionDiv.style.padding = '10px 12px';
                            suggestionDiv.style.cursor = 'pointer';
                            suggestionDiv.style.borderBottom = '1px solid #eee';
                            suggestionDiv.style.backgroundColor = '#fff';
                            suggestionDiv.style.transition = 'background-color 0.2s ease';

                            suggestionDiv.addEventListener('mouseover', function () {
                                this.style.backgroundColor = '#f0f8ff';
                            });
                            suggestionDiv.addEventListener('mouseout', function () {
                                this.style.backgroundColor = '#fff';
                            });
                            suggestionDiv.addEventListener('click', function () {
                                addressField.value = suggestion.address;
                                suggestionsDiv.style.display = 'none';
                                // Trigger validation update
                                showStep(1);
                                updateAccordion();
                                saveFormDataToSession();
                            });
                            suggestionsDiv.appendChild(suggestionDiv);
                        });
                        suggestionsDiv.style.display = 'block';
                    } else {
                        suggestionsDiv.innerHTML = '<div style="padding: 12px; text-align: center; color: #999; font-size: 14px;">No addresses found</div>';
                        suggestionsDiv.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error fetching address suggestions:', error);
                    suggestionsDiv.innerHTML = '<div style="padding: 12px; text-align: center; color: #d32f2f; font-size: 14px;">Error fetching addresses</div>';
                    suggestionsDiv.style.display = 'block';
                });
        }

        const nameField = document.querySelector('input[name="form_fields[name_booking_form]"]');
        if (nameField) {
            nameField.addEventListener('input', function () {
                updateAccordion();
                saveFormDataToSession();
            });
        }

        const emailField = document.querySelector('input[name="form_fields[email_booking_form]"]');
        if (emailField) {
            emailField.addEventListener('input', function () {
                updateAccordion();
                saveFormDataToSession();
            });
        }

        const phoneField = document.querySelector('input[name="form_fields[phone_booking_form]"]');
        if (phoneField) {
            phoneField.addEventListener('input', function () {
                updateAccordion();
                saveFormDataToSession();
            });
        }

        // Real-time validation for form fields - update button state
        document.querySelectorAll('input[name="form_fields[category_booking_form]"]').forEach(radio => {
            radio.addEventListener('change', function () {
                if (currentStep === 2) showStep(2);
            });
        });

        document.querySelectorAll('input[name="form_fields[service_booking_form]"]').forEach(radio => {
            radio.addEventListener('change', function () {
                if (currentStep === 3) showStep(3);
            });
        });

        document.querySelectorAll('input[name="form_fields[duration_booking_form]"]').forEach(radio => {
            radio.addEventListener('change', function () {
                if (currentStep === 5) showStep(5);
            });
        });

        document.querySelectorAll('input[name="form_fields[frequency_booking_form]"]').forEach(radio => {
            radio.addEventListener('change', function () {
                if (currentStep === 4) showStep(4);
            });
        });

        document.querySelectorAll('input[name="form_fields[pets_booking_form]"]').forEach(radio => {
            radio.addEventListener('change', function () {
                if (currentStep === 7) showStep(7);
            });
        });

        // ========== POST-LOGIN FLOW ==========
        // Restore form data from session after user logs in
        function restoreFormDataFromSession() {
            const sessionData = @json(session('booking_form_data', []));
            const userData = @json(auth()->check() ? auth()->user() : null);

            if (Object.keys(sessionData).length === 0) return;

            // NOTE: Contact information (name, email, phone) is NOT restored from session
            // if user is logged in, because their actual profile data takes precedence.
            // The autoPopulateUserData() function already set their current details.

            // If user is not logged in, restore contact info from session
            if (!userData) {
                if (sessionData.customer_name) {
                    const nameField = document.querySelector('input[name="form_fields[name_booking_form]"]');
                    if (nameField) nameField.value = sessionData.customer_name;
                }
                if (sessionData.email) {
                    const emailField = document.querySelector('input[name="form_fields[email_booking_form]"]');
                    if (emailField) emailField.value = sessionData.email;
                }
                if (sessionData.phone) {
                    const phoneField = document.querySelector('input[name="form_fields[phone_booking_form]"]');
                    if (phoneField) phoneField.value = sessionData.phone;
                }
            } else {
                console.log('👤 Logged-in user: skipping contact info restoration from session');
            }
            if (sessionData.street_address) {
                const addressField = document.querySelector('input[name="form_fields[street_booking_form]"]');
                if (addressField) addressField.value = sessionData.street_address;
            }
            if (sessionData.city) {
                const cityField = document.querySelector('input[name="form_fields[city_booking_form]"]');
                if (cityField) cityField.value = sessionData.city;
            }
            if (sessionData.state) {
                const stateField = document.querySelector('input[name="form_fields[states_booking_form]"]');
                if (stateField) stateField.value = sessionData.state;
            }
            if (sessionData.zip_code) {
                const zipField = document.querySelector('input[name="form_fields[zip_code_booking_form]"]');
                if (zipField) zipField.value = sessionData.zip_code;
            }
            if (sessionData.special_instructions) {
                const messageField = document.querySelector('textarea[name="form_fields[message_booking_form]"]');
                if (messageField) messageField.value = sessionData.special_instructions;
            }

            // Restore radio button selections
            if (sessionData.category_name) {
                const categoryRadio = document.querySelector(`input[name="form_fields[category_booking_form]"][value="${sessionData.category_name}"]`);
                if (categoryRadio) {
                    categoryRadio.checked = true;
                    // Find category card and mark as selected
                    const categoryCard = categoryRadio.closest('[data-category-id]');
                    if (categoryCard) {
                        categoryCard.classList.add('selected');
                        console.log('✅ Category restored from session:', sessionData.category_name);

                        // Get category ID from data attribute
                        const categoryId = categoryCard.getAttribute('data-category-id');
                        if (categoryId) {
                            loadServicesByCategory(categoryId);
                            console.log('📦 Loading services for category ID:', categoryId);
                        }
                    }
                }
            }
            if (sessionData.service_name) {
                const serviceRadio = document.querySelector(`input[name="form_fields[service_booking_form]"][value="${sessionData.service_name}"]`);
                if (serviceRadio) {
                    serviceRadio.checked = true;
                    // Also update visual display
                    const serviceCard = serviceRadio.closest('.service-card');
                    if (serviceCard) {
                        serviceCard.classList.add('selected');
                        console.log('✅ Service restored from session:', sessionData.service_name);
                    }
                }
            }
            if (sessionData.bedrooms) {
                const bedroomsRadio = document.querySelector(`input[name="form_fields[bedrooms_booking_form]"][value="${sessionData.bedrooms}"]`);
                if (bedroomsRadio) bedroomsRadio.checked = true;
            }
            if (sessionData.bathrooms) {
                const bathroomsRadio = document.querySelector(`input[name="form_fields[bathrooms_booking_form]"][value="${sessionData.bathrooms}"]`);
                if (bathroomsRadio) bathroomsRadio.checked = true;
            }
            if (sessionData.frequency) {
                const frequencyRadio = document.querySelector(`input[name="form_fields[frequency_booking_form]"][value="${sessionData.frequency}"]`);
                if (frequencyRadio) frequencyRadio.checked = true;
            }
            if (sessionData.extras) {
                // Handle extras as array or single value
                const extrasArray = Array.isArray(sessionData.extras) ? sessionData.extras : [sessionData.extras];
                extrasArray.forEach(extraValue => {
                    const extrasCheckbox = document.querySelector(`input[name="form_fields[extras_booking_form]"][value="${extraValue}"]`);
                    if (extrasCheckbox) {
                        extrasCheckbox.checked = true;
                        // Also update visual display
                        const extraCard = extrasCheckbox.closest('.option-card');
                        if (extraCard) {
                            extraCard.classList.add('selected');
                        }
                    }
                });
            }
            if (sessionData.pets) {
                const petsRadio = document.querySelector(`input[name="form_fields[pets_booking_form]"][value="${sessionData.pets}"]`);
                if (petsRadio) petsRadio.checked = true;
            }
            if (sessionData.booking_date) {
                document.getElementById('appointmentDate').value = sessionData.booking_date;
                document.getElementById('selectedDateDisplay').textContent = '✓ Selected: ' + sessionData.booking_date;
            }
            if (sessionData.booking_time) {
                const timeValue = sessionData.booking_time;
                const firstTime = typeof timeValue === 'string' && timeValue.includes(',') 
                    ? timeValue.split(',')[0].trim() 
                    : timeValue;
                document.getElementById('appointmentTime').value = firstTime;
                document.getElementById('selectedTimeDisplay').textContent = '✓ Selected: ' + firstTime;
            }
        }

        // Auto-submit after login if user was redirected from booking form
        function checkAndAutoSubmitBooking() {
            const shouldAutoSubmit = @json(session('booking_auto_submit', false));

            if (shouldAutoSubmit) {
                // Add a small delay to ensure form is fully rendered
                setTimeout(() => {
                    console.log('Auto-submitting booking after login...');
                    submitBookingForm();
                }, 800);
            }
        }
    </script>

@endsection

@push('styles')
    <link rel="stylesheet" id="elementor-post-140-css"
        href='{{ asset("wp-content/uploads/elementor/css/post-21.css") }}?ver=1752678329' type='text/css' media='all' />
    <link rel="stylesheet" id="elementor-post-140-css"
        href='{{ asset("wp-content/uploads/elementor/css/post-140.css") }}?ver=1752680768' type='text/css' media='all' />
    <link rel="stylesheet" id="elementor-post-1007-css"
        href='{{ asset("wp-content/uploads/elementor/css/post-1007.css") }}?ver=1752677976' type='text/css' media='all' />
    <link rel="stylesheet" id="elementor-post-3145-css"
        href='{{ asset("wp-content/uploads/elementor/css/post-3145.css") }}?ver=1752680430' type='text/css' media='all' />
    <link rel="stylesheet" id="elementor-post-156-css"
        href='{{ asset("wp-content/uploads/elementor/css/post-156.css") }}?ver=1752677977' type='text/css' media='all' />
    <link data-minify="1" rel="stylesheet" id="vamtam-front-all-css"
        href='{{ asset("wp-content/cache/min/1/wp-content/themes/clanyeco/vamtam/assets/css/dist/elementor/elementor-all.css") }}?ver=1752677977'
        type='text/css' media='all' />
@endpush

<script src="https://maps.googleapis.com/maps/api/AIzaSyCDOmxAMjhsOkxdvMGHhSvDr_Z3rRJqzdE"></script>
