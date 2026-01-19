<style>
    <style>ul li i.fa-check {
        color: #ff5722;
        /* orange */
    }
</style>
</style>
<div class="elementor-element margin-set elementor-element-a200a52 e-flex e-con-boxed e-con e-parent" data-id="a200a52"
    data-element_type="container">
    <div class="e-con-inner">
        <div class="elementor-element elementor-element-464984f e-con-full e-flex e-con e-child" data-id="464984f"
            data-element_type="container"
            data-settings="{&quot;sticky&quot;:&quot;top&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;],&quot;sticky_offset&quot;:100,&quot;sticky_parent&quot;:&quot;yes&quot;,&quot;sticky_effects_offset&quot;:0,&quot;sticky_anchor_link_offset&quot;:0}">
            <div class="elementor-element elementor-element-a39ae8c elementor-position-right elementor-widget__width-auto elementor-mobile-position-right elementor-vertical-align-top animated-fast elementor-view-default elementor-vertical-align-top elementor-invisible elementor-widget elementor-widget-icon-box"
                data-id="a39ae8c" data-element_type="widget"
                data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:50}"
                data-widget_type="icon-box.default">
                <div class="elementor-widget-container">
                    <div class="elementor-icon-box-wrapper">
                        <div class="elementor-icon-box-icon">
                            <span class="elementor-icon">
                                <i aria-hidden="true" class="vamtamtheme- vamtam-theme-title-dec"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="elementor-element elementor-element-c2a9694 elementor-widget__width-initial animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                data-id="c2a9694" data-element_type="widget"
                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                data-widget_type="heading.default">
                <div class="elementor-widget-container">
                    <h2 class="elementor-heading-title elementor-size-default">
                        @if(!empty($selectedCity))
                            Cleaners in {{ $selectedCity }}{{ !empty($selectedState) ? ' ' . $selectedState : '' }}
                        @else
                            Domestic Cleaners Near Me
                        @endif
                    </h2>
                </div>
            </div>

            <div class="elementor-element elementor-element-31058db e-con-full animated-fast e-flex elementor-invisible e-con e-child"
                data-id="31058db" data-element_type="container"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeIn&quot;,&quot;animation_delay&quot;:200}">
                <div class="elementor-element elementor-element-175ca19 elementor-widget elementor-widget-heading"
                    data-id="175ca19" data-element_type="widget" data-widget_type="heading.default">
                    <div class="elementor-widget-container">
                        <p style="margin-bottom: 10px;">
                            Our professional cleaners are available near you for daily, weekly, or one-off home
                            cleaning. We ensure spotless results and peace of mind.
                        </p>
                        <ul style="list-style-type: none; padding: 0; margin: 0;">
                            <li><i class="fa-solid fa-check" style="color: #28a745; margin-right: 6px;"></i>
                                Background-checked & trained professionals</li>
                            <li><i class="fa-solid fa-check" style="color: #28a745; margin-right: 6px;"></i>
                                Eco-friendly cleaning supplies</li>
                            <li><i class="fa-solid fa-check" style="color: #28a745; margin-right: 6px;"></i> Affordable
                                hourly pricing</li>
                        </ul>
                    </div>
                </div>

                <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-1aef33a vamtam-has-icon-styles vamtam-has-hover-anim elementor-widget elementor-widget-button"
                    data-id="1aef33a" data-element_type="widget" data-widget_type="button.default">
                    <div class="elementor-widget-container">

                        <div class="elementor-button-wrapper">
                            <a class="elementor-button elementor-button-link elementor-size-sm "
                                href="{{ route('book-services.index') }}">
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-icon">
                                        <i aria-hidden="true" class="vamtamtheme- vamtam-theme-phone"></i>
                                    </span>

                                    <span class="elementor-button-text">Book my cleaning</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- IMAGE + SIDE CONTENT SECTION -->
        <div class="elementor-element elementor-element-81fcf2c e-con-full animated-fast e-flex elementor-invisible e-con e-child"
            data-id="81fcf2c" data-element_type="container"
            data-settings="{&quot;animation&quot;:&quot;fadeIn&quot;,&quot;animation_delay&quot;:300}">
            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-1d50356 animated-fast vamtam-has-icon-theme-styles elementor-invisible elementor-widget elementor-widget-n-accordion"
                data-id="1d50356" data-element_type="widget"
                data-settings="{&quot;max_items_expended&quot;:&quot;multiple&quot;,&quot;default_state&quot;:&quot;all_collapsed&quot;,&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:250,&quot;n_accordion_animation_duration&quot;:{&quot;unit&quot;:&quot;ms&quot;,&quot;size&quot;:400,&quot;sizes&quot;:[]}}"
                data-widget_type="nested-accordion.default">

                <div class="elementor-widget-container">
                    <div class="e-n-accordion"
                        aria-label="Accordion. Open links with Enter or Space, close with Escape, and navigate with Arrow Keys"
                        style="display: flex; align-items: center; gap: 30px; flex-wrap: wrap; justify-content: center;">

                        <!-- IMAGE -->
                        <img src="{{ asset('images/project.jpg') }}" alt="Freelancer Image"
                            style=" border-radius: 15px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>