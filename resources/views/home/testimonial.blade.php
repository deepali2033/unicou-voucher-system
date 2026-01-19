@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $testimonialList = isset($testimonials) ? $testimonials : collect();
    $avatarColorPalette = [
        '#6C5CE7',
        '#0984E3',
        '#00B894',
        '#E17055',
        '#D63031',
        '#E84393',
        '#2D3436',
    ];
@endphp

<style>
    .home-testimonial-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--avatar-bg, #2A3F54);
        color: var(--avatar-color, #fff);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 700;
        text-transform: uppercase;
        overflow: hidden;
        margin-right: 18px;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
.testimonial-img{
    width: 45px !important;
    height: 45px !important;
    border-radius: 50% !important;
}
    .home-testimonial-avatar.has-image {
        background: transparent;
        color: transparent;
    }

    .home-testimonial-avatar.has-initials {
        letter-spacing: 1px;
    }

    .home-testimonial-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .home-testimonial-empty {
        text-align: center;
        padding: 40px 20px;
        font-size: 18px;
        color: #4A4A4A;
    }
</style>

<div class="elementor-element elementor-element-bef2482 e-flex e-con-boxed e-con e-parent" data-id="bef2482"
    data-element_type="container">
    <div class="e-con-inner">
        <div class="elementor-element elementor-element-2284658 e-con-full e-flex e-con e-child" data-id="2284658"
            data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="elementor-element elementor-element-d41d0ba elementor-position-right elementor-widget__width-auto elementor-mobile-position-right elementor-vertical-align-top animated-fast elementor-view-default elementor-vertical-align-top elementor-invisible elementor-widget elementor-widget-icon-box"
                data-id="d41d0ba" data-element_type="widget"
                data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:50}"
                data-widget_type="icon-box.default">
                <div class="elementor-widget-container">
                    <div class="elementor-icon-box-wrapper">

                        <div class="elementor-icon-box-icon">
                            <span class="elementor-icon">
                                <i aria-hidden="true" class="vamtamtheme- vamtam-theme-title-dec"></i>
                            </span>
                        </div>

                        <div class="elementor-icon-box-content">

                            <h6 class="elementor-icon-box-title">
                                <span>
                                    Testimonials
                                </span>
                            </h6>


                        </div>

                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-07afd19 elementor-widget__width-initial elementor-widget-mobile__width-inherit animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                data-id="07afd19" data-element_type="widget"
                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                data-widget_type="heading.default">
                <div class="elementor-widget-container">
                    <h2 class="elementor-heading-title elementor-size-default">Trusted by Families &amp; Businesses</h2>
                </div>
            </div>
            <div class="elementor-element elementor-element-8ffc2b4 elementor-arrows-position-outside elementor-pagination-type-bullets elementor-pagination-position-outside elementor-widget elementor-widget-n-carousel"
                data-id="8ffc2b4" data-element_type="widget"
                data-settings="{&quot;carousel_items&quot;:[{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;8c0235c&quot;},{&quot;slide_title&quot;:&quot;Slide #2&quot;,&quot;_id&quot;:&quot;d08609f&quot;},{&quot;slide_title&quot;:&quot;Slide #3&quot;,&quot;_id&quot;:&quot;e0afbcb&quot;},{&quot;slide_title&quot;:&quot;Slide #4&quot;,&quot;_id&quot;:&quot;d6d4477&quot;}],&quot;slides_to_show&quot;:&quot;2&quot;,&quot;slides_to_scroll&quot;:&quot;1&quot;,&quot;image_spacing_custom&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:20,&quot;sizes&quot;:[]},&quot;slides_to_show_tablet&quot;:&quot;2&quot;,&quot;slides_to_show_mobile&quot;:&quot;1&quot;,&quot;infinite&quot;:&quot;yes&quot;,&quot;speed&quot;:500,&quot;offset_sides&quot;:&quot;none&quot;,&quot;arrows&quot;:&quot;yes&quot;,&quot;pagination&quot;:&quot;bullets&quot;,&quot;image_spacing_custom_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;image_spacing_custom_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
                data-widget_type="nested-carousel.default">
                <div class="elementor-widget-container">
                    <div class="e-n-carousel swiper" role="region" aria-roledescription="carousel" aria-label="Carousel"
                        dir="ltr">
                        <div class="swiper-wrapper" aria-live="polite">
                            @forelse ($testimonialList as $index => $testimonial)
                                <div class="swiper-slide" data-slide="{{ $index + 1 }}" role="group"
                                    aria-roledescription="slide"
                                    aria-label="{{ $index + 1 }} of {{ $testimonialList->count() }}">
                                    <div class="elementor-element elementor-element-8bc0735 e-flex e-con-boxed e-con e-child"
                                        data-id="8bc0735" data-element_type="container"
                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                        <div class="e-con-inner">
                                            <div class="elementor-element elementor-element-df34f9a elementor-widget elementor-widget-heading"
                                                data-id="df34f9a" data-element_type="widget"
                                                data-widget_type="heading.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-heading-title elementor-size-default">“</div>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-a62bc33 elementor-widget elementor-widget-text-editor"
                                                data-id="a62bc33" data-element_type="widget"
                                                data-widget_type="text-editor.default">
                                                <div class="elementor-widget-container">
                                                    <p>{{ $testimonial->content }}</p>
                                                </div>
                                            </div>
                                            <div class="elementor-element elementor-element-c524d44 e-con-full e-flex e-con e-child"
                                                data-id="c524d44" data-element_type="container" style="gap:10px !important;">
                                                <div class=""  data-id="e06415e" data-element_type="container">

                                                    @php
                                                        $imagePath = $testimonial->image ? ltrim($testimonial->image, '/') : null;
                                                        $imageExists = $imagePath && Storage::disk('public')->exists($imagePath);
                                                        $initials = Str::upper(mb_substr($testimonial->name ?? '', 0, 1));
                                                        $colorIndex = $index % count($avatarColorPalette);
                                                        $avatarBg = $avatarColorPalette[$colorIndex];
                                                        $avatarTextColor = '#FFFFFF';
                                                    @endphp

                                                     @if ($imageExists)
                                                        <img src="{{ asset('storage/' . $imagePath) }}" class="testimonial-img"
                                                            alt="{{ $testimonial->name }}">
                                                    @else
                                                        <img src="{{ asset('images/avtar.jpg') }}"
                                                            class="testimonial-img" alt="{{ $testimonial->name }}">
                                                    @endif

                                                </div>
                                                <div class=""
                                                    data-id="b967917" data-element_type="container">
                                                    <div class="elementor-element elementor-element-c8368b2 elementor-widget elementor-widget-heading"
                                                        data-id="c8368b2" data-element_type="widget"
                                                        data-widget_type="heading.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-heading-title elementor-size-default">
                                                                {{ $testimonial->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-1203e80 elementor-widget elementor-widget-heading"
                                                        data-id="1203e80" data-element_type="widget"
                                                        data-widget_type="heading.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-heading-title elementor-size-default">
                                                                {{ $testimonial->position ?? 'Happy Customer' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="swiper-slide is-empty" role="group" aria-roledescription="slide">
                                    <div class="elementor-element elementor-element-8bc0735 e-flex e-con-boxed e-con e-child"
                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                        <div class="e-con-inner home-testimonial-empty">
                                            New testimonials will appear here soon.
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="elementor-swiper-button elementor-swiper-button-prev" role="button" tabindex="0"
                        aria-label="Previous">
                        <i aria-hidden="true" class="vamtamtheme- vamtam-theme-arrow-left"></i>
                    </div>
                    <div class="elementor-swiper-button elementor-swiper-button-next" role="button" tabindex="0"
                        aria-label="Next">
                        <i aria-hidden="true" class="vamtamtheme- vamtam-theme-arrow-right"></i>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="elementor-element elementor-element-989db41 e-con-full e-flex e-con e-child" data-id="989db41"
                data-element_type="container">
                <div class="elementor-element elementor-element-4098b69 elementor-widget__width-initial elementor-widget elementor-widget-spacer"
                    data-id="4098b69" data-element_type="widget" data-widget_type="spacer.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-spacer">
                            <div class="elementor-spacer-inner"></div>
                        </div>
                    </div>
                </div>
                <a class="elementor-element elementor-element-3a527b5 e-con-full e-flex e-con e-child" data-id="3a527b5"
                    data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}"
                    href="https://www.google.com/maps/place/Joy+of+Cleaning/@27.7729308,-82.6415103,1219m/data=!3m2!1e3!5s0x88e7db236641dcc7:0xd3be73b915d68970!4m8!3m7!1s0x88c2e1e99ef55a9b:0xb16a7d07765addf8!8m2!3d27.7729261!4d-82.63893!9m1!1b1!16s%2Fg%2F11j7kg2bq4?entry=ttu&g_ep=EgoyMDI1MDExNS4wIKXMDSoASAFQAw%3D%3D"
                    target="_blank">
                    <div class="elementor-element elementor-element-866f780 elementor-view-default elementor-widget elementor-widget-icon"
                        data-id="866f780" data-element_type="widget" data-widget_type="icon.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-icon-wrapper">
                                <div class="elementor-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="16px" height="16px" viewBox="0 0 16 16">
                                        <title>Google__G__logo</title>
                                        <g id="Pages" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Home-1--new" transform="translate(-1347, -692)" fill-rule="nonzero">
                                                <g id="Group-15" transform="translate(1275, 690)">
                                                    <g id="Group-81" transform="translate(44, 2)">
                                                        <g id="Google__G__logo" transform="translate(28, 0)">
                                                            <path
                                                                d="M16,8.17777097 C16,7.52 15.9455365,7.04 15.8276679,6.54222903 L8.16326531,6.54222903 L8.16326531,9.51108388 L12.6620968,9.51108388 C12.5714286,10.2488855 12.0816327,11.36 10.9931764,12.1066258 L10.9779192,12.2060207 L13.4012615,14.0458062 L13.569154,14.062229 C15.1110764,12.6666565 16,10.6133129 16,8.17777097"
                                                                id="Path" fill="#4285F4" />
                                                            <path
                                                                d="M8.16326531,16 C10.3673157,16 12.217635,15.2888548 13.569154,14.062229 L10.9931764,12.1066258 C10.3038479,12.5777403 9.37865702,12.9066258 8.16326531,12.9066258 C6.00454904,12.9066258 4.17236339,11.5111145 3.51923964,9.58222903 L3.42350651,9.59019533 L0.90368066,11.5013098 L0.870727456,11.5910839 C2.21311719,14.2043968 4.97049375,16 8.16326531,16"
                                                                id="Path" fill="#34A853" />
                                                            <path
                                                                d="M3.51923964,9.58222903 C3.34690751,9.08445806 3.24717248,8.55108388 3.24717248,8 C3.24717248,7.44885484 3.34690751,6.91554194 3.51017282,6.41777097 L3.50560814,6.31175795 L0.954204738,4.36994255 L0.870727456,4.40885484 C0.317463791,5.49331291 0,6.71111452 0,8 C0,9.28888548 0.317463791,10.5066258 0.870727456,11.5910839 L3.51923964,9.58222903"
                                                                id="Path" fill="#FBBC05" />
                                                            <path
                                                                d="M8.16326531,3.09331291 C9.69612081,3.09331291 10.7301136,3.74219839 11.319707,4.28445806 L13.623555,2.08 C12.2086307,0.791114516 10.3673157,0 8.16326531,0 C4.97049375,0 2.21311719,1.79554194 0.870727456,4.40885484 L3.51017282,6.41777097 C4.17236339,4.48888548 6.00454904,3.09331291 8.16326531,3.09331291"
                                                                id="Path" fill="#EB4335" />
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-016fef9 e-con-full e-flex e-con e-child"
                        data-id="016fef9" data-element_type="container">
                        <div class="elementor-element elementor-element-388195e elementor-widget__width-auto elementor-widget elementor-widget-heading"
                            data-id="388195e" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-heading-title elementor-size-default">4.8</div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-6954d71 elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                            data-id="6954d71" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-heading-title elementor-size-default">480 Google reviews</div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="elementor-element elementor-element-abad920 elementor-widget__width-initial elementor-widget elementor-widget-spacer"
                    data-id="abad920" data-element_type="widget" data-widget_type="spacer.default">
                    <div class="elementor-widget-container">
                        <div class="elementor-spacer">
                            <div class="elementor-spacer-inner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>