<div class="elementor-element elementor-element-0a56cd2 animated-fast e-flex e-con-boxed e-con e-parent"
    data-id="0a56cd2" data-element_type="container" data-settings="{&quot;animation&quot;:&quot;none&quot;}">
    <div class="e-con-inner">
        <div class="elementor-element elementor-element-ca04b14 e-con-full animated-fast vamtam-has-theme-cp vamtam-cp-top-left e-flex e-con e-child"
            data-id="ca04b14" data-element_type="container"
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
                                    Get your free estimate </span>
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
                    <h2 class="elementor-heading-title elementor-size-default">Get a Quote</h2>
                </div>
            </div>
            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-e2fcc7c elementor-button-align-start animated-fast vamtam-has-btn-hover-anim elementor-invisible elementor-widget elementor-widget-form"
                data-id="e2fcc7c" data-element_type="widget"
                data-settings="{&quot;step_next_label&quot;:&quot;Next&quot;,&quot;step_previous_label&quot;:&quot;Previous&quot;,&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200,&quot;button_width&quot;:&quot;100&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}"
                data-widget_type="form.default">
                <div class="elementor-widget-container">
                    <form class="elementor-form" id="quote-form" method="post" action="{{ route('quote.submit') }}"
                        name="Get a Quote Form" aria-label="Get a Quote Form">
                        @csrf
                        <div class="elementor-form-fields-wrapper elementor-labels-above">
                            <div
                                class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-name elementor-col-50 elementor-field-required">
                                <label for="form-field-name" class="elementor-field-label">
                                    Your name </label>
                                <input size="1" type="text" name="name" id="form-field-name"
                                    class="elementor-field elementor-size-sm  elementor-field-textual"
                                    placeholder="John Smith " required="required" value="{{ old('name') }}">
                            </div>
                            <div
                                class="elementor-field-type-email elementor-field-group elementor-column elementor-field-group-email elementor-col-50 elementor-field-required">
                                <label for="form-field-email" class="elementor-field-label">
                                    Email </label>
                                <input size="1" type="email" name="email" id="form-field-email"
                                    class="elementor-field elementor-size-sm  elementor-field-textual"
                                    placeholder="e.g. john@youremail.com" required="required"
                                    value="{{ old('email') }}">
                            </div>
                            <div
                                class="elementor-field-type-tel elementor-field-group elementor-column elementor-field-group-field_0d36151 elementor-col-50 elementor-field-required">
                                <label for="form-field-field_0d36151" class="elementor-field-label">
                                    Phone </label>
                                <input size="1" type="tel" name="phone" id="form-field-field_0d36151"
                                    class="elementor-field elementor-size-sm  elementor-field-textual" required
                                    oninput="this.value = this.value.replace(/\D/g, '')"
                                    placeholder="e.g. (1) 23 4567 891" required="required" pattern="[0-9()#&amp;+*-=.]+"
                                    title="Only numbers and phone characters (#, -, *, etc) are accepted."
                                    value="{{ old('phone') }}">

                            </div>
                            <div
                                class="elementor-field-type-number elementor-field-group elementor-column elementor-field-group-field_8f579e9 elementor-col-50 elementor-field-required">
                                <label for="form-field-field_8f579e9" class="elementor-field-label">
                                    Total square footage </label>
                                <input type="text" name="total_square_footage" id="form-field-field_8f579e9"
                                    class="elementor-field elementor-size-sm  elementor-field-textual"
                                    placeholder="e.g. 120" required="required"
                                    value="{{ old('total_square_footage') }}">
                            </div>
                            <div
                                class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-message elementor-col-100 elementor-field-required">
                                <label for="form-field-message" class="elementor-field-label">
                                    Choose a service </label>
                                <div class="elementor-field elementor-select-wrapper remove-before ">
                                    <div class="select-caret-down-wrapper">
                                        <svg aria-hidden="true" class="e-font-icon-svg e-eicon-caret-down"
                                            viewbox="0 0 571.4 571.4" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M571 393Q571 407 561 418L311 668Q300 679 286 679T261 668L11 418Q0 407 0 393T11 368 36 357H536Q550 357 561 368T571 393Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <select name="service" id="form-field-message"
                                        class="elementor-field-textual elementor-size-sm" required="required">
                                        <option value="">Select </option>
                                        @if(isset($services) && $services->count() > 0)
                                            @foreach($services as $service)
                                                <option value="{{ $service->name }}" {{ old('service') == $service->name ? 'selected' : '' }}>{{ $service->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="House cleaning" {{ old('service') == 'House cleaning' ? 'selected' : '' }}>House cleaning</option>
                                            <option value="Office cleaning" {{ old('service') == 'Office cleaning' ? 'selected' : '' }}>Office cleaning</option>
                                            <option value="Deep cleaning" {{ old('service') == 'Deep cleaning' ? 'selected' : '' }}>Deep cleaning</option>
                                            <option value="Move in out cleaning" {{ old('service') == 'Move in out cleaning' ? 'selected' : '' }}>Move in out cleaning</option>
                                            <option value="Post Construction Cleaning" {{ old('service') == 'Post Construction Cleaning' ? 'selected' : '' }}>Post Construction Cleaning</option>
                                            <option value="Recurring Cleaning" {{ old('service') == 'Recurring Cleaning' ? 'selected' : '' }}>Recurring Cleaning</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div
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
                            </div>
                            <div class="elementor-field-type-text">
                                <input size="1" type="text" name="honeypot" id="form-field-field_40c0e23"
                                    class="elementor-field elementor-size-sm " style="display:none !important;"
                                    tabindex="-1" autocomplete="off">
                            </div>
                            <div
                                class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                                <button class="elementor-button elementor-size-sm" type="submit" id="quote-submit-btn">
                                    <span class="elementor-button-content-wrapper">
                                        <span class="elementor-button-text">I'd Like a Quote</span>
                                    </span>
                                </button>
                            </div>
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