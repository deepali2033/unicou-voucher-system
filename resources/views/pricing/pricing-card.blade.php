@php
    // Determine card styling based on index
    $isGradient = $index == 1 || $index == 3;
    $animationDelay = 450 + ($index * 50);
    $hasLeafIcon = $index == 1;
@endphp

@if($index == 0 || $index == 2)
    <div class="elementor-element elementor-element-085989e e-con-full vamtam-has-theme-cp vamtam-cp-top-left animated-fast e-flex elementor-invisible e-con e-child"
        data-id="085989e" data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;animation_delay&quot;:{{ $animationDelay }}}">
        <div class="elementor-element elementor-element-abbb006 e-con-full e-flex e-con e-child" data-id="abbb006"
            data-element_type="container">
            <div class="elementor-element elementor-element-e9e64fa elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                data-id="e9e64fa" data-element_type="widget" data-widget_type="heading.default">
                <div class="elementor-widget-container">
                    <div class="elementor-heading-title elementor-size-default">{{ $plan->name }}</div>
                </div>
            </div>
            <div class="elementor-element elementor-element-7de0402 elementor-widget__width-auto elementor-widget elementor-widget-heading"
                data-id="7de0402" data-element_type="widget" data-widget_type="heading.default">
                <div class="elementor-widget-container">
                    <div class="elementor-heading-title elementor-size-default">€{{ number_format($plan->price, 0) }}</div>
                </div>
            </div>
            <div class="elementor-element elementor-element-711de71 elementor-widget__width-auto elementor-widget elementor-widget-heading"
                data-id="711de71" data-element_type="widget" data-widget_type="heading.default">
                <div class="elementor-widget-container">
                    <div class="elementor-heading-title elementor-size-default">/hour</div>
                </div>
            </div>
            <div class="elementor-element elementor-element-6ad5dde elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                data-id="6ad5dde" data-element_type="widget" data-widget_type="divider.default">
                <div class="elementor-widget-container">
                    <div class="elementor-divider">
                        <span class="elementor-divider-separator">
                        </span>
                    </div>
                </div>
            </div>
            @foreach($plan->parsed_descriptions as $description)
                <div class="elementor-element elementor-element-93c3717 elementor-widget__width-inherit elementor-widget elementor-widget-text-editor"
                    data-id="93c3717" data-element_type="widget" data-widget_type="text-editor.default">
                    <div class="elementor-widget-container">
                        <p>{{ $description }}</p>
                    </div>
                </div>
            @endforeach
            <div class="elementor-element elementor-element-396e4b2 elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                data-id="396e4b2" data-element_type="widget" data-widget_type="divider.default">
                <div class="elementor-widget-container">
                    <div class="elementor-divider">
                        <span class="elementor-divider-separator">
                        </span>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-d799117 elementor-widget__width-inherit elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                data-id="d799117" data-element_type="widget" data-widget_type="icon-list.default">
                <div class="elementor-widget-container">
                    <ul class="elementor-icon-list-items">
                        @foreach($plan->parsed_features as $feature)
                            <li class="elementor-icon-list-item">
                                <span class="elementor-icon-list-icon">
                                    <i aria-hidden="true" class="vamtamtheme- vamtam-theme-check"></i>
                                </span>
                                <span class="elementor-icon-list-text">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="elementor-element elementor-element-43f55b1 e-con-full e-flex e-con e-child" data-id="43f55b1"
            data-element_type="container">
            <div class="elementor-element elementor-element-2096ccb elementor-widget__width-initial elementor-widget elementor-widget-spacer"
                data-id="2096ccb" data-element_type="widget" data-widget_type="spacer.default">
                <div class="elementor-widget-container">
                    <div class="elementor-spacer">
                        <div class="elementor-spacer-inner"></div>
                    </div>
                </div>
            </div>
            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-d5501b6 elementor-align-center elementor-widget__width-initial vamtam-has-hover-anim elementor-widget elementor-widget-button"
                data-id="d5501b6" data-element_type="widget" data-widget_type="button.default">
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <button class="elementor-button elementor-button-link elementor-size-sm payment-btn"
                            data-plan-id="{{ $plan->id }}" data-plan-name="{{ $plan->name }}"
                            data-plan-price="{{ $plan->price }}">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-text">Pay Now</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-8b869ef elementor-widget__width-initial elementor-widget elementor-widget-spacer"
                data-id="8b869ef" data-element_type="widget" data-widget_type="spacer.default">
                <div class="elementor-widget-container">
                    <div class="elementor-spacer">
                        <div class="elementor-spacer-inner"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @else
            <div class="elementor-element elementor-element-bacfd4a e-con-full animated-fast e-flex elementor-invisible e-con e-child"
                data-id="bacfd4a" data-element_type="container"
                data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;animation_delay&quot;:{{ $animationDelay }}}">
                @if($hasLeafIcon)
                    <div class="elementor-element elementor-element-8fc925a elementor-absolute elementor-view-default elementor-widget elementor-widget-icon"
                        data-id="8fc925a" data-element_type="widget"
                        data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;motion_fx_rotateZ_effect&quot;:&quot;yes&quot;,&quot;motion_fx_rotateZ_direction&quot;:&quot;negative&quot;,&quot;motion_fx_rotateZ_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:35,&quot;end&quot;:81}},&quot;motion_fx_devices&quot;:[&quot;desktop&quot;],&quot;motion_fx_rotateZ_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]}}"
                        data-widget_type="icon.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-icon-wrapper">
                                <div class="elementor-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="51px"
                                        height="41px" viewbox="0 0 51 41">
                                        <title>leaf-group-1</title>
                                        <g id="Pages" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Home-1--new" transform="translate(-245, -1076)" fill="#3CA200">
                                                <g id="Group-95" transform="translate(141, 923)">
                                                    <g id="Group-94" transform="translate(0, 153.3361)">
                                                        <g id="Group-35" transform="translate(49, 0)">
                                                            <g id="leaf-group-1" transform="translate(55.9628, 0)">
                                                                <path
                                                                    d="M34.5123108,28.3699086 C31.4031313,26.0763831 28.7144148,25.1005491 24.0769793,24.8219308 L28.8330262,20.9892212 C32.7016852,20.6879243 36.2773512,21.0925605 39.7985736,21.8281439 C36.1764343,20.4075528 33.1756925,20.2130838 29.3884685,20.2627892 L36.2959338,13.736286 C38.2145474,14.2006583 39.850353,14.1845251 41.8428809,13.9333721 C40.0211934,14.0040091 38.5743725,13.9564817 36.8274762,13.1720621 L43.2998756,7.29698989 L33.5744589,15.2602206 C32.9552794,13.6089779 32.5954554,12.1190563 32.7875383,10.1098306 C32.16349,12.2006028 32.6025366,13.8610047 32.882252,15.9190719 L25.8951278,21.8543267 C26.2491983,19.1287031 26.0774742,16.1863603 24.2779161,13.5396584 C24.8541645,14.975068 26.5572428,20.0020695 24.8612468,22.6073503 L17.7130175,28.5173093 C14.3953827,7.95546465 28.8648965,9.3743058 44.0371977,6.6638773 C41.3267959,23.8495645 43.0480149,36.6305423 18.9982837,30.4498173 L15.3314473,33.4933096 C14.7419212,33.9825357 13.0530086,32.3849168 14.8242421,32.4049773 L23.3245809,25.7559494 C27.8726121,25.788603 31.1751942,26.6785417 34.5123108,28.3699086 Z"
                                                                    id="Path"
                                                                    transform="translate(29.0372, 20.1252) rotate(-45) translate(-29.0372, -20.1252)">
                                                                </path>
                                                                <path
                                                                    d="M11.2747543,28.516893 C9.72016453,27.3701302 8.37580625,26.8822132 6.0570885,26.7429041 L8.43511196,24.8265493 C10.3694415,24.6759008 12.1572745,24.8782189 13.9178857,25.2460106 C12.106816,24.5357151 10.6064451,24.4384805 8.7128331,24.4633332 L12.1665658,21.2000817 C13.1258726,21.4322678 13.9437754,21.4242012 14.9400393,21.2986247 C14.0291956,21.3339432 13.3057851,21.3101795 12.432337,20.9179697 L15.6685367,17.9804336 L10.8058283,21.962049 C10.4962386,21.1364276 10.3163266,20.3914668 10.412368,19.3868539 C10.1003439,20.4322401 10.3198672,21.262441 10.4597249,22.2914746 L6.96616278,25.259102 C7.14319799,23.8962902 7.05733596,22.4251188 6.1575569,21.1017678 C6.44568113,21.8194727 7.29722028,24.3329734 6.44922228,25.6356138 L2.87510761,28.5905933 C1.21629024,18.309671 8.4510471,19.0190915 16.0371977,17.6638773 C14.6819968,26.2567209 15.5426063,32.6472098 3.5177407,29.5568473 L1.6843225,31.0785935 C1.38955947,31.3232065 0.545103176,30.524397 1.43071992,30.5344273 L5.6808893,27.2099133 C7.9549049,27.2262401 9.60619595,27.6712095 11.2747543,28.516893 Z"
                                                                    id="Path-Copy-5"
                                                                    transform="translate(8.5372, 24.3945) rotate(-74) translate(-8.5372, -24.3945)">
                                                                </path>
                                                            </g>
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
                @endif
                <div class="elementor-element elementor-element-9c5ac15 e-con-full vamtam-has-theme-cp {{ $index == 3 ? 'vamtam-cp-top-right' : 'vamtam-cp-top-right' }} e-flex e-con e-child"
                    data-id="9c5ac15" data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;{{ $index == 1 ? 'gradient' : 'classic' }}&quot;}">
                    <div class="elementor-element elementor-element-f70c024 e-con-full e-flex e-con e-child" data-id="f70c024"
                        data-element_type="container">
                        <div class="elementor-element elementor-element-3f57d50 elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                            data-id="3f57d50" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-heading-title elementor-size-default">{{ $plan->name }}</div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-47d5b11 elementor-widget__width-auto elementor-widget elementor-widget-heading"
                            data-id="47d5b11" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-heading-title elementor-size-default">€{{ number_format($plan->price, 0) }}
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-25a130b elementor-widget__width-auto elementor-widget elementor-widget-heading"
                            data-id="25a130b" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-heading-title elementor-size-default">/per hour</div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-adc0199 elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                            data-id="adc0199" data-element_type="widget" data-widget_type="divider.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-divider">
                                    <span class="elementor-divider-separator">
                                    </span>
                                </div>
                            </div>
                        </div>
                        @foreach($plan->parsed_descriptions as $description)
                            <div class="elementor-element elementor-element-b32ca96 elementor-widget__width-inherit elementor-widget elementor-widget-text-editor"
                                data-id="b32ca96" data-element_type="widget" data-widget_type="text-editor.default">
                                <div class="elementor-widget-container">
                                    <p>{{ $description }}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="elementor-element elementor-element-07443c3 elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                            data-id="07443c3" data-element_type="widget" data-widget_type="divider.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-divider">
                                    <span class="elementor-divider-separator">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-bb4aba1 elementor-widget__width-inherit elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                            data-id="bb4aba1" data-element_type="widget" data-widget_type="icon-list.default">
                            <div class="elementor-widget-container">
                                <ul class="elementor-icon-list-items">
                                    @foreach($plan->parsed_features as $feature)
                                        <li class="elementor-icon-list-item">
                                            <span class="elementor-icon-list-icon">
                                                <i aria-hidden="true" class="vamtamtheme- vamtam-theme-check"></i> </span>
                                            <span class="elementor-icon-list-text">{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-43f55b1 e-con-full e-flex e-con e-child" data-id="43f55b1"
                        data-element_type="container">
                        <div class="elementor-element elementor-element-2096ccb elementor-widget__width-initial elementor-widget elementor-widget-spacer"
                            data-id="2096ccb" data-element_type="widget" data-widget_type="spacer.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-spacer">
                                    <div class="elementor-spacer-inner"></div>
                                </div>
                            </div>
                        </div>
                        @php Auth::user() && Auth::user()->is_admin ? $admin = true : $admin = false @endphp
                        <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-d5501b6 elementor-align-center elementor-widget__width-initial vamtam-has-hover-anim elementor-widget elementor-widget-button"
                            data-id="d5501b6" data-element_type="widget" data-widget_type="button.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-button-wrapper">
                                    @if (Auth::user())
                                        <button class="elementor-button elementor-button-link elementor-size-sm payment-btn"
                                            data-plan-id="{{ $plan->id }}" data-plan-name="{{ $plan->name }}"
                                            data-plan-price="{{ $plan->price }}" data-plan-check="yes">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">Pay Now</span>
                                            </span>
                                        </button>
                                    @else
                                        <a class="elementor-button elementor-button-link elementor-size-sm" href="/login">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">Pay Now</span>
                                            </span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-8b869ef elementor-widget__width-initial elementor-widget elementor-widget-spacer"
                            data-id="8b869ef" data-element_type="widget" data-widget_type="spacer.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-spacer">
                                    <div class="elementor-spacer-inner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
