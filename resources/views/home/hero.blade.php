<div class="elementor-element margin-set elementor-element-e3cf8ef margin-t e-flex e-con-boxed e-con e-parent"
    data-id="e3cf8ef" data-element_type="container">
    <div class="e-con-inner">
        <div class="elementor-element elementor-element-9e6f089 e-flex e-con-boxed e-con e-child" data-id="9e6f089"
            data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <style>
                /* Override existing Elementor background and add slider without changing layout */
                .elementor-17 .elementor-element.elementor-element-9e6f089:not(.elementor-motion-effects-element-type-background),
                .elementor-17 .elementor-element.elementor-element-9e6f089>.elementor-motion-effects-container>.elementor-motion-effects-layer {
                    background-image: none !important;
                }

                .elementor-element.elementor-element-9e6f089 {
                    position: relative;
                    overflow: hidden;
                }

                .elementor-element.elementor-element-9e6f089>.e-con-inner {
                    position: relative;
                    z-index: 1;
                }

                .hero-bg-slider {
                    position: absolute;
                    inset: 0;
                    z-index: 0;
                    border-radius: inherit;
                    pointer-events: none;
                }

                .hero-bg-slider .slide {
                    position: absolute;
                    inset: 0;
                    background-size: cover;
                    background-position: center right;
                    opacity: 0;
                    transition: opacity 800ms ease-in-out;
                }

                .hero-bg-slider .slide.active {
                    opacity: 1;
                }

                /* Navigation dots (overlay, minimal, non-intrusive) */
                .hero-bg-dots {
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                    bottom: 16px;
                    display: flex;
                    gap: 8px;
                    z-index: 2;
                    pointer-events: none;
                }

                .hero-bg-dots .dot {
                    width: 8px;
                    height: 8px;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.6);
                    border: 0;
                    padding: 0;
                    cursor: pointer;
                    pointer-events: auto;
                }

                .hero-bg-dots .dot.active {
                    background: var(--e-global-color-vamtam_accent_2, #000);
                }

                .reting-container,
                .elementor-spacer-inner {
                    max-width: 100px !important;
                    position: absolute !important;
                    top: 63px !important;
                    gap: 0 !important;
                    display: none !important;
                }

                @media(max-width:430px) {
                    .hero-rating-div {
                        max-width: 140px !important;
                    }

                    .wp-image-284,
                    .wp-image-286,
                    .wp-image-285 {
                        max-width: 35px !important;
                    }



                    .btn-center {
                        justify-content: center !important;
                    }

                    .elementor-size-sm {
                        padding: 10px 11px !important;
                    }


                    /* .elementor-button-text {
                        font-size: 12px !important;
                    } */
                    .hero-bg-dots {
                        bottom: 7px !important;
                    }

                    .rating-images-div {
                        justify-content: end !important;
                        margin-right: 15px !important;
                    }
                }
            </style>
            <style>
                /* Navigation arrows (overlay, minimal) */
                .hero-bg-nav {
                    position: absolute;
                    inset: 0;
                    z-index: 2;
                    pointer-events: none;
                }

                .hero-bg-nav .hero-nav-btn {
                    pointer-events: auto;
                    position: absolute;
                    top: 50%;
                    transform: translateY(-50%);
                    width: 36px;
                    height: 36px;
                    border-radius: 50%;
                    border: 1px solid var(--e-global-color-vamtam_accent_2, #ffffff);
                    background: rgba(0, 0, 0, 0.25);
                    color: #ffffff;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 18px;
                    line-height: 1;
                    padding: 0px 20px;
                }

                .hero-bg-nav .hero-nav-btn.prev {
                    left: 12px;
                }

                .hero-bg-nav .hero-nav-btn.next {
                    right: 12px;
                }


                /* Extra Small Devices (Phones, <576px) */
                @media (max-width: 767.98px) {
                    .hero-bg-nav .hero-nav-btn {
                        display: none;
                    }
                }


                /* Medium Devices (Tablets, ≥768px) */
                @media (min-width: 768px) and (max-width: 991.98px) {
                    .hero-bg-nav .hero-nav-btn {
                        display: none;
                    }
                }

                /* Large Devices (Desktops, ≥992px) */
                @media (min-width: 992px) and (max-width: 1199.98px) {
                    /* Your styles for laptops/desktops */
                }

                /* Extra Large Devices (Large Desktops, ≥1200px) */
                @media (min-width: 1200px) and (max-width: 1399.98px) {
                    /* Your styles for large desktops */
                }

                /* Extra Extra Large Devices (≥1400px) */
                @media (min-width: 1400px) {
                    /* Your styles for very large screens */
                }
            </style>
            <div class="hero-bg-slider" aria-hidden="true">
                <div class="slide" style="background-image:url('/images/herobg/1.jpg')"></div>
                <div class="slide" style="background-image:url('/images/herobg/2.jpg')">
                </div>
                <div class="slide" style="background-image:url('/images/herobg/3.jpg')"></div>
                <div class="slide" style="background-image:url('/images/herobg/4.jpg')">
                </div>
            </div>
            <div class="hero-bg-nav" aria-hidden="false">
                <button class="hero-nav-btn prev" type="button" aria-label="Previous slide">&#10094;</button>
                <button class="hero-nav-btn next" type="button" aria-label="Next slide">&#10095;</button>
            </div>
            <div class="hero-bg-dots" role="tablist" aria-label="Hero background navigation"></div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const container = document.querySelector('[data-id="9e6f089"]');
                    const slider = container?.querySelector('.hero-bg-slider');
                    const dotsWrap = container?.querySelector('.hero-bg-dots');
                    const nav = container?.querySelector('.hero-bg-nav');
                    if (!slider || !dotsWrap || !nav) return;
                    const slides = slider.querySelectorAll('.slide');
                    if (slides.length === 0) return;
                    let i = 0;
                    let timer = null;

                    // Build dots
                    dotsWrap.innerHTML = '';
                    const dots = Array.from(slides).map((_, idx) => {
                        const b = document.createElement('button');
                        b.type = 'button';
                        b.className = 'dot';
                        b.setAttribute('role', 'tab');
                        b.setAttribute('aria-label', `Go to slide ${idx + 1}`);
                        b.addEventListener('click', () => { show(idx); resetTimer(); });
                        dotsWrap.appendChild(b);
                        return b;
                    });

                    const setDot = () => {
                        dots.forEach((d, idx) => d.classList.toggle('active', idx === i));
                    };

                    const show = (idx) => {
                        slides[i].classList.remove('active');
                        i = (idx + slides.length) % slides.length;
                        slides[i].classList.add('active');
                        setDot();
                    };
                    const next = () => show(i + 1);
                    const prev = () => show(i - 1);

                    slides[0].classList.add('active');
                    setDot();
                    if (slides.length > 1) {
                        timer = setInterval(next, 5000);
                    }

                    function resetTimer() {
                        if (!timer) return;
                        clearInterval(timer);
                        timer = setInterval(next, 5000);
                    }

                    // Buttons
                    nav.querySelector('.prev')?.addEventListener('click', () => { prev(); resetTimer(); });
                    nav.querySelector('.next')?.addEventListener('click', () => { next(); resetTimer(); });

                    // Keyboard navigation (scoped to hero to avoid global conflicts)
                    container.addEventListener('keydown', (e) => {
                        if (e.key === 'ArrowRight') { next(); resetTimer(); }
                        else if (e.key === 'ArrowLeft') { prev(); resetTimer(); }
                    });
                    // Ensure container can receive keyboard events
                    container.setAttribute('tabindex', container.getAttribute('tabindex') || '0');

                    // Touch swipe navigation (no visible UI change)
                    let touchStartX = null, touchStartY = null;
                    container.addEventListener('touchstart', (e) => {
                        const t = e.changedTouches[0];
                        touchStartX = t.clientX; touchStartY = t.clientY;
                    }, { passive: true });
                    container.addEventListener('touchmove', (e) => {
                        // Prevent vertical scroll only when horizontal intent is clear
                        // No heavy UI change; keeps page usable
                    }, { passive: true });
                    container.addEventListener('touchend', (e) => {
                        if (touchStartX === null) return;
                        const t = e.changedTouches[0];
                        const dx = t.clientX - touchStartX;
                        const dy = t.clientY - touchStartY;
                        if (Math.abs(dx) > 40 && Math.abs(dx) > Math.abs(dy)) {
                            if (dx < 0) next(); else prev();
                            resetTimer();
                        }
                        touchStartX = touchStartY = null;
                    }, { passive: true });

                    // Mouse drag support
                    let isDown = false, startX = 0, lastX = 0;
                    container.addEventListener('mousedown', (e) => { isDown = true; startX = lastX = e.clientX; });
                    container.addEventListener('mousemove', (e) => { if (isDown) lastX = e.clientX; });
                    container.addEventListener('mouseup', () => {
                        if (!isDown) return; const dx = lastX - startX; isDown = false;
                        if (Math.abs(dx) > 40) { if (dx < 0) next(); else prev(); resetTimer(); }
                    });
                    container.addEventListener('mouseleave', () => { isDown = false; });
                });
            </script>
            <div class="e-con-inner">
                <div class="elementor-element elementor-element-20e3754 e-con-full vamtam-has-theme-cp vamtam-cp-top-left e-flex e-con e-child"
                    data-id="20e3754" data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-element elementor-element-a7f0206 elementor-widget-mobile__width-inherit animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                        data-id="a7f0206" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}"
                        data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h1 class="elementor-heading-title elementor-size-default">Time is precious.<br>
                                Let us handle the rest.</h1>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-03b3466 elementor-widget-mobile__width-inherit animated-fast elementor-invisible elementor-widget elementor-widget-text-editor"
                        data-id="03b3466" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:150}"
                        data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            <p>Book vetted cleaners, ironing pros, or temporary staff in minutes—all with Dutch legal
                                guarantees</p>
                        </div>
                    </div>
                    <div class="elementor-element btn-center elementor-element-7a5f5f2 e-con-full animated-fast e-flex elementor-invisible e-con e-child"
                        data-id="7a5f5f2" data-element_type="container"
                        data-settings="{&quot;animation&quot;:&quot;fadeInDown&quot;,&quot;animation_delay&quot;:300}">
                        <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-c34e4c2 vamtam-has-hover-anim elementor-widget elementor-widget-button"
                            data-id="c34e4c2" data-element_type="widget" data-widget_type="button.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-button-wrapper">
                                    <a class="elementor-button elementor-button-link elementor-size-sm"
                                        href="{{ route('book-services.index') }}">
                                        <span class="elementor-button-content-wrapper">
                                            <span class="elementor-button-text">Book a Service</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-cd67bad vamtam-has-hover-anim elementor-widget elementor-widget-button"
                            data-id="cd67bad" data-element_type="widget" data-widget_type="button.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-button-wrapper">
                                    <a class="elementor-button elementor-button-link elementor-size-sm"
                                        href="{{ route('jobs.index') }}">
                                        <span class="elementor-button-content-wrapper">
                                            <span class="elementor-button-text">Find a Job</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="elementor-element elementor-element-e4a1b14 e-con-full e-flex e-con e-child"
                    data-id="e4a1b14" data-element_type="container">
                    <div class="elementor-element elementor-element-f88ee40 elementor-invisible elementor-widget elementor-widget-image"
                        data-id="f88ee40" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200,&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_effect&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_direction&quot;:&quot;negative&quot;,&quot;motion_fx_translateY_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;motion_fx_devices&quot;:[&quot;desktop&quot;],&quot;motion_fx_translateY_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:0,&quot;end&quot;:80}}}"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img decoding="async" width="61" height="100"
                                src="wp-content/uploads/2025/01/growth-close-up-environmental-lush-natural-copy-2.png"
                                class="attachment-medium size-medium wp-image-234" alt="">
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-95934f1 e-transform elementor-invisible elementor-widget elementor-widget-image"
                        data-id="95934f1" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInLeft&quot;,&quot;_animation_delay&quot;:100,&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_effect&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_direction&quot;:&quot;negative&quot;,&quot;motion_fx_translateY_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;motion_fx_devices&quot;:[&quot;desktop&quot;],&quot;motion_fx_rotateZ_effect&quot;:&quot;yes&quot;,&quot;motion_fx_rotateZ_direction&quot;:&quot;negative&quot;,&quot;motion_fx_translateY_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:35,&quot;end&quot;:80}},&quot;motion_fx_rotateZ_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:0,&quot;end&quot;:80}},&quot;_transform_rotateZ_effect&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:-25,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_tablet&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:-15,&quot;sizes&quot;:[]},&quot;motion_fx_rotateZ_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;_transform_rotateZ_effect_mobile&quot;:{&quot;unit&quot;:&quot;deg&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img decoding="async" width="174" height="155"
                                src="wp-content/uploads/2025/01/growth-close-up-environmental-lush-natural.png"
                                class="attachment-medium size-medium wp-image-235" alt="">
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-96c541f elementor-invisible elementor-widget elementor-widget-image"
                        data-id="96c541f" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:250,&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_effect&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_direction&quot;:&quot;negative&quot;,&quot;motion_fx_translateY_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;motion_fx_devices&quot;:[&quot;desktop&quot;],&quot;motion_fx_translateY_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:0,&quot;end&quot;:80}}}"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img loading="lazy" decoding="async" width="116" height="104"
                                src="wp-content/uploads/2025/01/growth-close-up-environmental-lush-natural-copy.png"
                                class="attachment-medium size-medium wp-image-233" alt="">
                        </div>
                    </div>
                </div>
                {{-- <div class="elementor-element elementor-element-f1d2620 e-con-full e-flex e-con e-child"
                    data-id="f1d2620" data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;position&quot;:&quot;absolute&quot;}">
                    <a class="elementor-element elementor-element-c538118 reting-container e-con-full e-flex elementor-invisible e-con e-child"
                        data-id="c538118" data-element_type="container"
                        data-settings="{&quot;position&quot;:&quot;absolute&quot;,&quot;animation&quot;:&quot;fadeIn&quot;,&quot;animation_delay&quot;:100}"
                        href="https://www.google.com/maps/place/Joy+of+Cleaning/@27.7729308,-82.6415103,1219m/data=!3m2!1e3!5s0x88e7db236641dcc7:0xd3be73b915d68970!4m8!3m7!1s0x88c2e1e99ef55a9b:0xb16a7d07765addf8!8m2!3d27.7729261!4d-82.63893!9m1!1b1!16s%2Fg%2F11j7kg2bq4?entry=ttu&g_ep=EgoyMDI1MDExNS4wIKXMDSoASAFQAw%3D%3D"
                        target="_blank">
                        <div class="elementor-element elementor-element-f2cd068 elementor-widget__width-auto elementor-view-default elementor-widget elementor-widget-icon"
                            data-id="f2cd068" data-element_type="widget" data-widget_type="icon.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-icon-wrapper">
                                    <div class="elementor-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="31"
                                            viewbox="0 0 32 31">
                                            <g fill-rule="nonzero" fill="none">
                                                <path
                                                    d="m11 9.76-8.82 1.27-.15.03a1.38 1.38 0 0 0-.61 2.33l6.38 6.22-1.5 8.77-.02.16a1.38 1.38 0 0 0 2.02 1.3l7.88-4.14 7.87 4.14.14.06a1.38 1.38 0 0 0 1.86-1.52l-1.5-8.77 6.39-6.22.1-.12a1.38 1.38 0 0 0-.87-2.24l-8.81-1.27-3.94-7.99a1.38 1.38 0 0 0-2.48 0L11 9.76Z"
                                                    stroke="#000" fill="#E8F5D3"></path>
                                                <path
                                                    d="m21.2 10.35 1.23 6.52A.22.22 0 1 1 22 17l-1.23-6.5a.2.2 0 0 1 .17-.27c.1-.02.2.03.25.12ZM15.88 23.79l-3.58.45a.2.2 0 0 1-.24-.2.22.22 0 0 1 .2-.24l3.55-.46c.13-.01.24.07.26.2a.22.22 0 0 1-.2.25Z"
                                                    fill="#000"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-e9ffe7b e-con-full e-flex e-con e-child"
                            data-id="e9ffe7b" data-element_type="container">
                            <div class="elementor-element elementor-element-8983cf2 elementor-widget__width-auto elementor-widget elementor-widget-heading"
                                data-id="8983cf2" data-element_type="widget" data-widget_type="heading.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-heading-title elementor-size-default">4.8</div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-146988e elementor-widget__width-auto elementor-view-default elementor-widget elementor-widget-icon"
                                data-id="146988e" data-element_type="widget" data-widget_type="icon.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-icon-wrapper">
                                        <div class="elementor-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px"
                                                viewbox="0 0 16 16">
                                                <title>Google__G__logo</title>
                                                <g id="Pages" stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <g id="Home-1--new" transform="translate(-1347, -692)"
                                                        fill-rule="nonzero">
                                                        <g id="Group-15" transform="translate(1275, 690)">
                                                            <g id="Group-81" transform="translate(44, 2)">
                                                                <g id="Google__G__logo" transform="translate(28, 0)">
                                                                    <path
                                                                        d="M16,8.17777097 C16,7.52 15.9455365,7.04 15.8276679,6.54222903 L8.16326531,6.54222903 L8.16326531,9.51108388 L12.6620968,9.51108388 C12.5714286,10.2488855 12.0816327,11.36 10.9931764,12.1066258 L10.9779192,12.2060207 L13.4012615,14.0458062 L13.569154,14.062229 C15.1110764,12.6666565 16,10.6133129 16,8.17777097"
                                                                        id="Path" fill="#4285F4"></path>
                                                                    <path
                                                                        d="M8.16326531,16 C10.3673157,16 12.217635,15.2888548 13.569154,14.062229 L10.9931764,12.1066258 C10.3038479,12.5777403 9.37865702,12.9066258 8.16326531,12.9066258 C6.00454904,12.9066258 4.17236339,11.5111145 3.51923964,9.58222903 L3.42350651,9.59019533 L0.90368066,11.5013098 L0.870727456,11.5910839 C2.21311719,14.2043968 4.97049375,16 8.16326531,16"
                                                                        id="Path" fill="#34A853"></path>
                                                                    <path
                                                                        d="M3.51923964,9.58222903 C3.34690751,9.08445806 3.24717248,8.55108388 3.24717248,8 C3.24717248,7.44885484 3.34690751,6.91554194 3.51017282,6.41777097 L3.50560814,6.31175795 L0.954204738,4.36994255 L0.870727456,4.40885484 C0.317463791,5.49331291 0,6.71111452 0,8 C0,9.28888548 0.317463791,10.5066258 0.870727456,11.5910839 L3.51923964,9.58222903"
                                                                        id="Path" fill="#FBBC05"></path>
                                                                    <path
                                                                        d="M8.16326531,3.09331291 C9.69612081,3.09331291 10.7301136,3.74219839 11.319707,4.28445806 L13.623555,2.08 C12.2086307,0.791114516 10.3673157,0 8.16326531,0 C4.97049375,0 2.21311719,1.79554194 0.870727456,4.40885484 L3.51017282,6.41777097 C4.17236339,4.48888548 6.00454904,3.09331291 8.16326531,3.09331291"
                                                                        id="Path" fill="#EB4335"></path>
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
                            <div class="elementor-element elementor-element-ce45c4a elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                                data-id="ce45c4a" data-element_type="widget" data-widget_type="heading.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-heading-title elementor-size-default">480 Reviews</div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-80109eb rating-images-div e-con-full e-flex e-con e-child"
                            data-id="80109eb" data-element_type="container">
                            <div class="elementor-element elementor-element-38171ae elementor-widget__width-auto elementor-widget elementor-widget-image"
                                data-id="38171ae" data-element_type="widget" data-widget_type="image.default">
                                <div class="elementor-widget-container">
                                    <img loading="lazy" decoding="async" width="606" height="606"
                                        src="wp-content/uploads/2025/01/pexels-shkrabaanthony-7345413.jpg"
                                        class="attachment-large size-large wp-image-284" alt=""
                                        srcset="wp-content/uploads/2025/01/pexels-shkrabaanthony-7345413.jpg 606w, wp-content/uploads/2025/01/pexels-shkrabaanthony-7345413-300x300.jpg 300w, wp-content/uploads/2025/01/pexels-shkrabaanthony-7345413-150x150.jpg 150w"
                                        sizes="(max-width: 606px) 100vw, 606px">
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-8b04766 elementor-widget__width-auto elementor-widget elementor-widget-image"
                                data-id="8b04766" data-element_type="widget" data-widget_type="image.default">
                                <div class="elementor-widget-container">
                                    <img loading="lazy" decoding="async" width="606" height="606"
                                        src="wp-content/uploads/2025/01/pexels-tima-miroshnichenko-6196237.jpg"
                                        class="attachment-large size-large wp-image-285" alt=""
                                        srcset="wp-content/uploads/2025/01/pexels-tima-miroshnichenko-6196237.jpg 606w, wp-content/uploads/2025/01/pexels-tima-miroshnichenko-6196237-300x300.jpg 300w, wp-content/uploads/2025/01/pexels-tima-miroshnichenko-6196237-150x150.jpg 150w"
                                        sizes="(max-width: 606px) 100vw, 606px">
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-9d997a5 elementor-widget__width-auto elementor-widget elementor-widget-image"
                                data-id="9d997a5" data-element_type="widget" data-widget_type="image.default">
                                <div class="elementor-widget-container">
                                    <img loading="lazy" decoding="async" width="606" height="606"
                                        src="wp-content/uploads/2025/01/pexels-tima-miroshnichenko-6195130.jpg"
                                        class="attachment-large size-large wp-image-286" alt=""
                                        srcset="wp-content/uploads/2025/01/pexels-tima-miroshnichenko-6195130.jpg 606w, wp-content/uploads/2025/01/pexels-tima-miroshnichenko-6195130-300x300.jpg 300w, wp-content/uploads/2025/01/pexels-tima-miroshnichenko-6195130-150x150.jpg 150w"
                                        sizes="(max-width: 606px) 100vw, 606px">
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="elementor-element hero-rating-div elementor-element-779ae77 elementor-widget__width-initial elementor-absolute animated-fast elementor-widget elementor-widget-spacer"
                        data-id="779ae77" data-element_type="widget"
                        data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;none&quot;}"
                        data-widget_type="spacer.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-spacer">
                                <div class="elementor-spacer-inner"></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>