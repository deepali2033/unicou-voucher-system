@extends('layouts.app')

@section('title', $service->meta_title ?: $service->name . ' - KOA Service')
@section('meta_description', $service->meta_description ?: $service->short_description)

@section('content')
    <article id="post-39" class="full post-39 page type-page status-publish has-post-thumbnail hentry">
        <div data-elementor-type="single-page" data-elementor-id="3642"
            class="elementor elementor-3642 elementor-location-single post-39 page type-page status-publish has-post-thumbnail hentry"
            data-elementor-post-type="elementor_library">
            <div class="elementor-element elementor-element-e16be9f e-con-full e-flex e-con e-parent" data-id="e16be9f"
                data-element_type="container">
                <div class="elementor-element elementor-element-a5cd914 margin-set e-flex e-con-boxed e-con e-child"
                    data-id="a5cd914" data-element_type="container"
                    data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-1e29583 e-con-full e-flex e-con e-child"
                            data-id="1e29583" data-element_type="container">
                            <div class="elementor-element elementor-element-ecf10ca elementor-position-right elementor-widget__width-auto elementor-mobile-position-right elementor-vertical-align-top animated-fast elementor-view-default elementor-vertical-align-top elementor-invisible elementor-widget elementor-widget-icon-box"
                                data-id="ecf10ca" data-element_type="widget"
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
                                                <span>Services</span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-80febce elementor-widget__width-initial animated-fast elementor-invisible elementor-widget elementor-widget-theme-post-title elementor-page-title elementor-widget-heading"
                                data-id="80febce" data-element_type="widget"
                                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                                data-widget_type="theme-post-title.default">
                                <div class="elementor-widget-container">
                                    <h1 class="elementor-heading-title elementor-size-default">{{ $service->name }}</h1>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-a6e4839 elementor-widget__width-initial animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                                data-id="a6e4839" data-element_type="widget"
                                data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:150}"
                                data-widget_type="heading.default">
                                <div class="elementor-widget-container">
                                    <span
                                        class="elementor-heading-title elementor-size-default">{{ $service->short_description ?: 'Have you thought about hiring professional cleaners to keep your home spotless?' }}</span>
                                </div>
                            </div>
                            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-fa9ffdb vamtam-has-hover-anim animated-fast elementor-invisible elementor-widget elementor-widget-button"
                                data-id="fa9ffdb" data-element_type="widget"
                                data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200}"
                                data-widget_type="button.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm"
                                            href="{{ route('quote.index') }}">
                                            <span class="elementor-button-content-wrapper">
                                                <span class="elementor-button-text">Free Quote</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-6073707 elementor-widget elementor-widget-theme-post-content"
                                data-id="6073707" data-element_type="widget" data-widget_type="theme-post-content.default">
                                <div class="elementor-widget-container">
                                    <div data-elementor-type="wp-page" data-elementor-id="39" class="elementor elementor-39"
                                        data-elementor-post-type="page">
                                        <!-- Main Service Description Section -->
                                        <div class="elementor-element elementor-element-963fac5 e-flex e-con-boxed e-con e-parent p-0"
                                            data-id="963fac5" data-element_type="container">
                                            <div class="e-con-inner">
                                                <div class="elementor-element elementor-element-80bfaef animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                                                    data-id="80bfaef" data-element_type="widget"
                                                    data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:250}"
                                                    data-widget_type="heading.default">
                                                    <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-default">Save Time
                                                            and Stress with Professional {{ $service->name }}</h2>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-28f9727 animated-fast elementor-invisible elementor-widget elementor-widget-text-editor"
                                                    data-id="28f9727" data-element_type="widget"
                                                    data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:300}"
                                                    data-widget_type="text-editor.default">
                                                    <div class="elementor-widget-container">
                                                        <p>{{ $service->description ?: 'Our eco-friendly cleaning service goes above and beyond to ensure trust, safety, and exceptional quality. Each team member undergoes a thorough personal interview, rigorous screening, and extensive identity and background verification, providing you with peace of mind. Our staff is specially trained in eco-friendly cleaning methods, delivering top-tier results that align with your values.' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="elementor-element elementor-element-2d520831 e-flex e-con-boxed e-con e-parent"
                                            data-id="2d520831" data-element_type="container">
                                            <div class="e-con-inner">
                                                <div class="elementor-element elementor-element-69c6e163 animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                                                    data-id="69c6e163" data-element_type="widget"
                                                    data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:250}"
                                                    data-widget_type="heading.default">
                                                    <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-default">
                                                            {{ $service->name }}</h2>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-584c71fc animated-fast elementor-invisible elementor-widget elementor-widget-text-editor"
                                                    data-id="584c71fc" data-element_type="widget"
                                                    data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:300}"
                                                    data-widget_type="text-editor.default">
                                                    <div class="elementor-widget-container">
                                                        <p>{{ $service->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-50dae70 e-flex e-con-boxed e-con e-parent"
                                            data-id="50dae70" data-element_type="container"
                                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                            <div class="e-con-inner">
                                                <div class="elementor-element elementor-element-68323a4d e-con-full e-flex e-con e-child"
                                                    data-id="68323a4d" data-element_type="container">
                                                    <div class="elementor-element elementor-element-70b20aab elementor-widget__width-initial elementor-widget elementor-widget-spacer"
                                                        data-id="70b20aab" data-element_type="widget"
                                                        data-widget_type="spacer.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-spacer">
                                                                <div class="elementor-spacer-inner"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-618953ce e-con-full e-flex e-con e-child"
                                                        data-id="618953ce" data-element_type="container">
                                                        <div class="elementor-element elementor-element-7b9daff8 elementor-absolute elementor-view-default elementor-widget elementor-widget-icon"
                                                            data-id="7b9daff8" data-element_type="widget"
                                                            data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;motion_fx_rotateZ_effect&quot;:&quot;yes&quot;,&quot;motion_fx_rotateZ_direction&quot;:&quot;negative&quot;,&quot;motion_fx_rotateZ_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:35,&quot;end&quot;:81}},&quot;motion_fx_devices&quot;:[&quot;desktop&quot;],&quot;motion_fx_rotateZ_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]}}"
                                                            data-widget_type="icon.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="elementor-icon-wrapper">
                                                                    <div class="elementor-icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="51px" height="41px" viewbox="0 0 51 41">
                                                                            <title>leaf-group-1</title>
                                                                            <g id="Pages" stroke="none" stroke-width="1"
                                                                                fill="none" fill-rule="evenodd">
                                                                                <g id="Home-1--new"
                                                                                    transform="translate(-245, -1076)"
                                                                                    fill="#3CA200">
                                                                                    <g id="Group-95"
                                                                                        transform="translate(141, 923)">
                                                                                        <g id="Group-94"
                                                                                            transform="translate(0, 153.3361)">
                                                                                            <g id="Group-35"
                                                                                                transform="translate(49, 0)">
                                                                                                <g id="leaf-group-1"
                                                                                                    transform="translate(55.9628, 0)">
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
                                                        <div class="elementor-element elementor-element-e2684e8 elementor-view-default elementor-widget elementor-widget-icon"
                                                            data-id="e2684e8" data-element_type="widget"
                                                            data-widget_type="icon.default">
                                                            <div class="elementor-widget-container">
                                                                <div class="elementor-icon-wrapper">
                                                                    <div class="elementor-icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="32px" height="37px" viewbox="0 0 32 37">
                                                                            <title>house-cleaning</title>
                                                                            <g id="Exports" stroke="none" stroke-width="1"
                                                                                fill="none" fill-rule="evenodd">
                                                                                <g transform="translate(-274, -18)"
                                                                                    id="house-cleaning">
                                                                                    <g transform="translate(274, 18)">
                                                                                        <path
                                                                                            d="M3.55555556,12.6341463 C3.98521637,20.3288627 3.55555556,36.939394 3.55555556,36.939394 C3.55555556,36.939394 22.9426901,37 28.2715322,37 C28.4942222,33.5791284 27.9047485,20.95288 28.4444444,12.7082203 C20.8965614,12.7082203 9.96902924,12.6341463 3.55555556,12.6341463 Z"
                                                                                            id="Path" fill="#FFFFFF"></path>
                                                                                        <path
                                                                                            d="M4.12680108,36.5801827 L4.4001111,36.5810243 C4.57440642,36.5815569 4.71602137,36.5819897 4.83991291,36.5823679 L5.06849646,36.5830648 L5.12137363,36.5832257 L5.38092069,36.5840131 L5.43477064,36.5841759 L5.73657405,36.5850862 C5.9627862,36.5857674 6.25055895,36.586632 6.66913749,36.5878897 C9.04511916,36.5949919 11.5043629,36.6020941 13.9162202,36.6087228 C14.8295592,36.611233 15.7205926,36.6136317 16.585093,36.6159036 C20.6430836,36.6265681 23.919788,36.6339498 26.1761647,36.6371829 L26.7188638,36.6379043 C26.8057247,36.6381992 26.8907796,36.6381992 26.9740113,36.6381992 L27.9305556,36.6381992 L27.93369,36.5760211 C27.9517537,36.1872074 27.9619799,35.7412672 27.9647632,35.110801 L27.9649154,34.3588887 C27.9611915,33.1911084 27.9410386,31.5057706 27.9057891,28.8729028 C27.868159,26.0622207 27.8498666,24.174929 27.8483199,22.2997824 L27.8485198,21.595392 C27.8530891,18.2794274 27.9160874,15.4906302 28.0553624,13.1473758 L28.0595556,13.0691463 L27.8137513,13.0690431 L26.8361134,13.0682357 C24.3925878,13.0654062 21.5223812,13.0562683 17.5091976,13.040085 C16.5396783,13.0361479 16.5396783,13.0361479 15.5731034,13.0321559 C10.8282661,13.0125297 8.22334865,13.0025369 6.2185869,12.9981068 L5.83764916,12.9973177 L5.74446591,12.9971414 L5.28891858,12.9963802 C5.22920183,12.9962918 5.16985116,12.9962085 5.11081488,12.9961301 L3.93555556,12.9951463 L3.9515204,13.3110791 C4.05240621,15.4789767 4.10168,18.331944 4.10700934,21.722784 L4.10716874,22.8727834 C4.10343873,25.8872205 4.0682649,29.115641 4.0119568,32.3542456 C3.99105991,33.5561468 3.96867011,34.6750393 3.94627941,35.6813901 C3.94040119,35.9455867 3.93483759,36.187725 3.92966729,36.4062473 L3.92555556,36.5791463 L4.02123833,36.5798576 C4.05335512,36.5799565 4.08841474,36.5800645 4.12680108,36.5801827 Z M28.4444444,12.7082203 C28.0053698,19.41574 28.3136686,29.0233404 28.3239761,34.214744 L28.3236369,34.8401392 C28.3205731,35.7421427 28.3055018,36.4781721 28.2715322,37 L26.9960817,36.9991932 C26.915509,36.9991057 26.8334153,36.9990114 26.7498498,36.9989106 L26.2311875,36.9982279 C24.1782879,36.9953192 21.3987143,36.9891173 18.4896014,36.9817863 L17.7281565,36.9798497 C17.6008902,36.9795231 17.4734771,36.9791948 17.3459664,36.9788648 L15.8142919,36.9748401 C10.9690411,36.9619236 6.26627206,36.947723 4.39900439,36.9419982 L4.128129,36.9411661 C4.08704126,36.9410396 4.04801533,36.9409194 4.01110027,36.9408056 L3.81533309,36.9402008 C3.78705786,36.9401133 3.76099166,36.9400326 3.73718357,36.9399587 L3.55555556,36.939394 L3.55622109,36.9133695 C3.56805971,36.4477203 3.73401177,29.808843 3.74585039,23.1007044 L3.74581907,21.6113478 C3.73947695,18.2688942 3.68889857,15.0221618 3.55555556,12.6341463 L4.76962614,12.6349296 C10.8610656,12.6423417 20.0691104,12.7000249 27.036618,12.7074371 L28.0825556,12.7071463 L28.4444444,12.7082203 Z"
                                                                                            id="Path" fill="#000000"
                                                                                            fill-rule="nonzero"></path>
                                                                                        <path
                                                                                            d="M4.9382716,13.9878049 C5.32019233,20.8275528 4.9382716,35.5924695 4.9382716,35.5924695 C4.9382716,35.5924695 22.1712801,35.6463415 26.9080286,35.6463415 C27.1059753,32.6055667 26.5819987,21.3822348 27.0617284,14.0536484 C20.352499,14.0536484 10.6391371,13.9878049 4.9382716,13.9878049 Z"
                                                                                            id="Path" fill="#FFFFFF"></path>
                                                                                        <path
                                                                                            d="M26.1465133,14.233779 L25.5133814,14.23314 C23.367269,14.2304703 20.8443467,14.222384 17.3420751,14.2082609 C16.4802905,14.2047613 16.4802905,14.2047613 15.621117,14.2012129 C11.2546055,14.1831516 8.9268352,14.1742682 7.11904972,14.1705477 L6.76397575,14.1698712 L6.67705746,14.1697228 L6.08462656,14.1689028 C6.02927517,14.1688422 5.97416403,14.1687866 5.91923691,14.1687356 L5.1282716,14.1678049 L5.1362565,14.3123948 C5.24556668,16.4757695 5.29269302,19.4698103 5.28821514,23.0886419 C5.28490061,25.7672997 5.25364289,28.6362815 5.20360341,31.5143417 C5.18812767,32.4044412 5.17173065,33.2433087 5.15517983,34.0157495 L5.1401093,34.6993068 C5.13507998,34.9208545 5.13035367,35.1223341 5.12600029,35.3023611 C5.12514723,35.3371273 5.12441604,35.3669269 5.12378543,35.3926192 L5.1222716,35.4118049 L5.1858182,35.4127489 L5.2165335,35.4128436 L5.42879733,35.4134975 C5.47667378,35.4136449 5.53060133,35.413811 5.59160842,35.4139988 L5.84339638,35.4147705 C5.98841347,35.4152136 6.10575727,35.415572 6.21156316,35.4158945 L6.51050249,35.416803 L6.56039304,35.4169541 L6.83702668,35.417789 C7.04401968,35.4184125 7.30860396,35.4192075 7.70548037,35.4204 C9.81747462,35.4267131 12.00348,35.4330261 14.1473654,35.4389183 C14.9592278,35.4411496 15.7512632,35.4432819 16.5197138,35.4453014 C20.0396431,35.4545518 22.8982577,35.4610236 24.8981915,35.4640017 L25.4221901,35.4647268 L25.5464324,35.4648806 L26.5400637,35.4658303 L26.7298134,35.4658303 L26.7413968,35.4074838 C26.7935684,34.4304537 26.7861592,33.1514959 26.7279882,28.7725717 L26.7232905,28.4203758 C26.685669,25.6103386 26.6697988,23.8390298 26.6723969,21.95355 C26.6764369,19.0216813 26.7318986,16.5542448 26.8543544,14.4802827 L26.8692716,14.2338049 L26.4557308,14.2339778 C26.3533995,14.2339248 26.2503521,14.2338586 26.1465133,14.233779 Z M26.8802716,14.0528049 L27.0617284,14.0536484 C26.9075296,16.4092655 26.85703,19.1672733 26.8529235,21.926599 L26.8531944,22.8458729 L26.8564301,23.7619434 C26.8822753,28.9376979 27.0282105,33.8001568 26.9080286,35.6463415 L26.1184462,35.6459603 C26.0456258,35.6458979 25.9711246,35.645828 25.8949985,35.645751 L25.1675008,35.6448688 C23.2039402,35.6421456 20.4695735,35.6359368 17.6450332,35.6287091 L16.9065986,35.6268022 C16.7833344,35.626481 16.6600116,35.6261584 16.5366862,35.6258344 L15.7971497,35.6238763 C11.4882232,35.612381 7.31312032,35.5997681 5.67030552,35.59473 L5.41393374,35.5939422 C5.37548864,35.5938238 5.33922259,35.593712 5.30519153,35.5936069 L5.06076735,35.5928506 C5.04064975,35.5927882 5.02293496,35.5927331 5.00767893,35.5926857 L4.9382716,35.5924695 L4.9389698,35.5651398 C4.94976802,35.1397519 5.08250188,29.8139513 5.10483454,24.1888177 L5.10770119,23.1092023 L5.1075065,22.0294489 C5.10237817,19.0365896 5.05762183,16.1252261 4.9382716,13.9878049 L6.08988471,13.9885917 C11.4806537,13.995514 19.571841,14.0459393 25.7275395,14.0528616 L26.8802716,14.0528049 Z"
                                                                                            id="Path" fill="#000000"
                                                                                            fill-rule="nonzero"></path>
                                                                                        <rect id="Rectangle" fill="#FFFFFF"
                                                                                            x="12.4444444" y="27.0731707"
                                                                                            width="7.11111111"
                                                                                            height="9.92682927"></rect>
                                                                                        <path
                                                                                            d="M19.5555556,27.0731707 L19.5555556,37 L12.4444444,37 L12.4444444,27.0731707 L19.5555556,27.0731707 Z M19.1944444,27.4331707 L12.8044444,27.4331707 L12.8044444,36.6381707 L19.1944444,36.6381707 L19.1944444,27.4331707 Z"
                                                                                            id="Rectangle" fill="#000000"
                                                                                            fill-rule="nonzero"></path>
                                                                                        <rect id="Rectangle" fill="#FFFFFF"
                                                                                            x="7.44444444" y="17.0731707"
                                                                                            width="6" height="5"></rect>
                                                                                        <path
                                                                                            d="M13.4444444,17.0731707 L13.4444444,22.0731707 L7.44444444,22.0731707 L7.44444444,17.0731707 L13.4444444,17.0731707 Z M13.2634444,17.2531707 L7.62444444,17.2531707 L7.62444444,21.8921707 L13.2634444,21.8921707 L13.2634444,17.2531707 Z"
                                                                                            id="Rectangle" fill="#000000"
                                                                                            fill-rule="nonzero"></path>
                                                                                        <rect id="Rectangle" fill="#FFFFFF"
                                                                                            x="18.4444444" y="17.0731707"
                                                                                            width="6" height="5"></rect>
                                                                                        <path
                                                                                            d="M24.4444444,17.0731707 L24.4444444,22.0731707 L18.4444444,22.0731707 L18.4444444,17.0731707 L24.4444444,17.0731707 Z M24.2634444,17.2531707 L18.6244444,17.2531707 L18.6244444,21.8921707 L24.2634444,21.8921707 L24.2634444,17.2531707 Z"
                                                                                            id="Rectangle" fill="#000000"
                                                                                            fill-rule="nonzero"></path>
                                                                                        <path
                                                                                            d="M17.0331085,35 C17.0143359,34.9965657 16.999617,34.9247106 17.0000076,34.8384072 L17.0317293,30.152218 C17.0319071,30.1104723 17.035737,30.0708152 17.0423545,30.0421987 C17.048972,30.0135821 17.0578192,29.9984185 17.066899,30.0001307 C17.0855104,30.0051695 17.1000322,30.0760623 17.0999999,30.1617235 L17.066899,34.8384072 C17.0672748,34.8806702 17.0638813,34.921808 17.0575032,34.9523095 C17.051125,34.9828109 17.0423145,35 17.0331085,35 Z"
                                                                                            id="Path" fill="#000000"
                                                                                            fill-rule="nonzero"></path>
                                                                                        <path
                                                                                            d="M15.0424675,36 C15.0309715,35.9990601 15.0200389,35.9796713 15.0120759,35.946101 C15.0041129,35.9125308 14.9997722,35.8675304 15.0000092,35.8210046 L15.0132774,33.1718729 C15.0135096,33.1253466 15.0183004,33.0811005 15.0265951,33.048873 C15.0348899,33.0166455 15.0460089,32.9990781 15.0575048,33.0000373 C15.0690788,33 15.0801552,33.0190802 15.0881705,33.0528712 C15.0961859,33.0866622 15.1004453,33.1322317 15.0999631,33.1790327 L15.0866949,35.8281644 C15.0857448,35.924214 15.0662191,36.0000769 15.0424675,36 Z"
                                                                                            id="Path" fill="#000000"
                                                                                            fill-rule="nonzero"></path>
                                                                                        <polygon id="Rectangle"
                                                                                            fill="#3CA200"
                                                                                            points="16 -1.61745617e-13 32 15 15.9056604 15 0 15">
                                                                                        </polygon>
                                                                                        <path
                                                                                            d="M16,0 L32,15 L0,15 L16,0 Z M16,0.494 L0.912,14.639 L31.087,14.639 L16,0.494 Z"
                                                                                            id="Rectangle" fill="#000000"
                                                                                            fill-rule="nonzero"></path>
                                                                                    </g>
                                                                                </g>
                                                                            </g>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-2069fc11 elementor-widget__width-initial elementor-widget elementor-widget-spacer"
                                                        data-id="2069fc11" data-element_type="widget"
                                                        data-widget_type="spacer.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-spacer">
                                                                <div class="elementor-spacer-inner"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Combined Section: What's Included (Left) & Features (Right) -->
                                                @if(($service->includes && count($service->includes) > 0) || ($service->features && count($service->features) > 0))
                                                            <div class="elementor-element elementor-element-3ffb8e1 elementor-widget__width-initial animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                                                                data-id="3ffb8e1" data-element_type="widget"
                                                                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                                                                data-widget_type="heading.default">
                                                                <div class="elementor-widget-container">
                                                                    <h3 class="elementor-heading-title elementor-size-default">Service
                                                                        Details</h3>
                                                                </div>
                                                            </div>
                                                            <div class="elementor-element elementor-element-762be769 elementor-widget__width-initial animated-fast elementor-invisible elementor-widget elementor-widget-text-editor"
                                                                data-id="762be769" data-element_type="widget"
                                                                data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200}"
                                                                data-widget_type="text-editor.default">
                                                                <div class="elementor-widget-container">
                                                                    <p><span aria-hidden="true">Everything you need to know about our
                                                                            {{ strtolower($service->name) }} service:</span></p>
                                                                </div>
                                                            </div>



                                                            <div class="elementor-element elementor-element-4a55ddc e-con-full e-flex e-con e-child"
                                                                data-id="4a55ddc" data-element_type="container">
                                                                <!-- Left Column: What's Included -->
                                                                @if($service->includes && count($service->includes) > 0)
                                                                    <div class="elementor-element elementor-element-51b45317 e-con-full animated-fast vamtam-has-theme-cp vamtam-cp-top-left e-flex elementor-invisible e-con e-child"
                                                                        data-id="51b45317" data-element_type="container"
                                                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation_delay&quot;:450,&quot;animation&quot;:&quot;fadeInUp&quot;}">
                                                                        <div class="elementor-element elementor-element-includes-title-left elementor-widget__width-initial animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                                                                            data-id="includes-title-left" data-element_type="widget"
                                                                            data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:50}"
                                                                            data-widget_type="heading.default">
                                                                            <div class="elementor-widget-container">
                                                                                <h4 class="elementor-heading-title elementor-size-default">
                                                                                    What's Included</h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="elementor-element elementor-element-2cb7a10a elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                                                                            data-id="2cb7a10a" data-element_type="widget"
                                                                            data-widget_type="icon-list.default">
                                                                            <div class="elementor-widget-container">
                                                                                <ul class="elementor-icon-list-items">
                                                                                    @foreach($service->includes as $include)
                                                                                        <li class="elementor-icon-list-item">
                                                                                            <span class="elementor-icon-list-icon">
                                                                                                <i aria-hidden="true"
                                                                                                    class="vamtamtheme- vamtam-theme-check-round"></i>
                                                                                            </span>
                                                                                            <span
                                                                                                class="elementor-icon-list-text">{{ $include }}</span>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <!-- Right Column: Features -->
                                                                @if($service->features && count($service->features) > 0)
                                                                    <div class="elementor-element elementor-element-3adaa6cb e-con-full animated-fast vamtam-has-theme-cp vamtam-cp-top-right e-flex elementor-invisible e-con e-child"
                                                                        data-id="3adaa6cb" data-element_type="container"
                                                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation_delay&quot;:500,&quot;animation&quot;:&quot;fadeInUp&quot;}">
                                                                        <div class="elementor-element elementor-element-features-title-right elementor-widget__width-initial animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                                                                            data-id="features-title-right" data-element_type="widget"
                                                                            data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:50}"
                                                                            data-widget_type="heading.default">
                                                                            <div class="elementor-widget-container">
                                                                                <h4 class="elementor-heading-title elementor-size-default">
                                                                                    {{ $service->name }} Features</h4>
                                                                            </div>
                                                                        </div>
                                                                        <div class="elementor-element elementor-element-5fced08a elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                                                                            data-id="5fced08a" data-element_type="widget"
                                                                            data-widget_type="icon-list.default">
                                                                            <div class="elementor-widget-container">
                                                                                <ul class="elementor-icon-list-items">
                                                                                    @foreach($service->features as $feature)
                                                                                        <li class="elementor-icon-list-item">
                                                                                            <span class="elementor-icon-list-icon">
                                                                                                <i aria-hidden="true"
                                                                                                    class="vamtamtheme- vamtam-theme-check-round"></i>
                                                                                            </span>
                                                                                            <span
                                                                                                class="elementor-icon-list-text">{{ $feature }}</span>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif



                                        <div class="elementor-element elementor-element-3288b701 e-flex e-con-boxed e-con e-child"
                                            data-id="3288b701" data-element_type="container"
                                            data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                                            <div class="e-con-inner">
                                                <div class="elementor-element elementor-element-4b27769 e-con-full e-flex e-con e-child"
                                                    data-id="4b27769" data-element_type="container"
                                                    data-settings="{&quot;position&quot;:&quot;absolute&quot;}">
                                                    <div class="elementor-element elementor-element-5833bd67 e-transform elementor-view-default elementor-invisible elementor-widget elementor-widget-icon"
                                                        data-id="5833bd67" data-element_type="widget"
                                                        data-settings="{&quot;motion_fx_rotateZ_effect&quot;:&quot;yes&quot;,&quot;motion_fx_devices&quot;:[&quot;desktop&quot;],&quot;_animation_delay&quot;:300,&quot;motion_fx_rotateZ_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:40,&quot;end&quot;:80}},&quot;_transform_flipX_effect&quot;:&quot;transform&quot;,&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;_animation&quot;:&quot;fadeInLeft&quot;,&quot;motion_fx_rotateZ_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]}}"
                                                        data-widget_type="icon.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-icon-wrapper">
                                                                <div class="elementor-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="60"
                                                                        height="54" viewbox="0 0 60 54">
                                                                        <path
                                                                            d="M40.95 43.54c-6.22-4.6-11.6-6.56-20.87-7.12l9.51-7.69c7.74-.6 14.89.21 21.93 1.69-7.24-2.85-13.24-3.24-20.82-3.14l13.82-13.1c3.83.94 7.1.9 11.1.4-3.65.14-6.55.05-10.04-1.53L58.53 1.27 39.07 17.24c-1.23-3.31-1.95-6.3-1.57-10.33-1.25 4.2-.37 7.53.19 11.65l-13.97 11.9c.7-5.46.36-11.36-3.24-16.67 1.15 2.88 4.56 12.96 1.17 18.19L7.35 43.83C.72 2.6 29.65 5.43 60 0c-5.42 34.47-1.98 60.1-50.08 47.7L2.6 53.82c-1.18.98-4.56-2.22-1.02-2.18l17-13.34c9.1.07 15.7 1.85 22.38 5.25Z"
                                                                            fill="#" fill-rule="evenodd"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-8306b12 elementor-view-default elementor-invisible elementor-widget elementor-widget-icon"
                                                        data-id="8306b12" data-element_type="widget"
                                                        data-settings="{&quot;motion_fx_rotateZ_effect&quot;:&quot;yes&quot;,&quot;motion_fx_devices&quot;:[&quot;desktop&quot;],&quot;_animation_delay&quot;:200,&quot;motion_fx_rotateZ_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:40,&quot;end&quot;:81}},&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;_animation&quot;:&quot;fadeInRight&quot;,&quot;motion_fx_rotateZ_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]}}"
                                                        data-widget_type="icon.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-icon-wrapper">
                                                                <div class="elementor-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="60"
                                                                        height="54" viewbox="0 0 60 54">
                                                                        <path
                                                                            d="M40.95 43.54c-6.22-4.6-11.6-6.56-20.87-7.12l9.51-7.69c7.74-.6 14.89.21 21.93 1.69-7.24-2.85-13.24-3.24-20.82-3.14l13.82-13.1c3.83.94 7.1.9 11.1.4-3.65.14-6.55.05-10.04-1.53L58.53 1.27 39.07 17.24c-1.23-3.31-1.95-6.3-1.57-10.33-1.25 4.2-.37 7.53.19 11.65l-13.97 11.9c.7-5.46.36-11.36-3.24-16.67 1.15 2.88 4.56 12.96 1.17 18.19L7.35 43.83C.72 2.6 29.65 5.43 60 0c-5.42 34.47-1.98 60.1-50.08 47.7L2.6 53.82c-1.18.98-4.56-2.22-1.02-2.18l17-13.34c9.1.07 15.7 1.85 22.38 5.25Z"
                                                                            fill="#" fill-rule="evenodd"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-b4fb11d elementor-widget__width-initial animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                                                    data-id="b4fb11d" data-element_type="widget"
                                                    data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                                                    data-widget_type="heading.default">
                                                    <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-default">The Right
                                                            {{ $service->name }} Products</h2>
                                                    </div>
                                                </div>
                                                <div class="elementor-element elementor-element-273848c1 animated-fast elementor-invisible elementor-widget elementor-widget-text-editor"
                                                    data-id="273848c1" data-element_type="widget"
                                                    data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200}"
                                                    data-widget_type="text-editor.default">
                                                    <div class="elementor-widget-container">
                                                        <p>At KOA Service, we prioritize your home’s health by using
                                                            {{ strtolower($service->name) }} products that are both
                                                            effective and safe. Our cleaners kill germs and remove dirt and
                                                            grime while improving air quality, and are carefully selected to
                                                            ensure they are safe for your family, pets, and the environment.
                                                            We often dilute conventional cleaners to make them gentler
                                                            without compromising on cleaning power, so you can have peace of
                                                            mind knowing that even the most sensitive members of your
                                                            household—such as children, the elderly, or pets—are protected
                                                            during the cleaning process.</p>
                                                        <p>For those looking to reduce their environmental impact, we also
                                                            offer green {{ strtolower($service->name) }} options. Our
                                                            eco-friendly solutions are free from harmful chemicals like
                                                            parabens, phosphates, chlorine, and artificial fragrances,
                                                            providing a cleaner, greener home while safeguarding both your
                                                            health and the planet. Ask us about our environmentally friendly
                                                            {{ strtolower($service->name) }} services today!</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-fbcdb4c e-con-full e-flex e-con e-child"
                            data-id="fbcdb4c" data-element_type="container">
                            <div class="elementor-element elementor-element-30fbd33 e-con-full e-flex e-con e-child"
                                data-id="30fbd33" data-element_type="container">
                                <div class="elementor-element elementor-element-154dc82 elementor-invisible elementor-widget elementor-widget-image"
                                    data-id="154dc82" data-element_type="widget"
                                    data-settings="{&quot;_animation_delay&quot;:300,&quot;_animation&quot;:&quot;fadeIn&quot;}"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img width="61" height="100"
                                            src="{{ asset('wp-content/uploads/2025/01/growth-close-up-environmental-lush-natural-copy-2.png') }}"
                                            class="attachment-medium size-medium wp-image-234" alt="{{ $service->name }}">
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-77275f3 elementor-invisible elementor-widget elementor-widget-image"
                                    data-id="77275f3" data-element_type="widget"
                                    data-settings="{&quot;_animation_delay&quot;:250,&quot;_animation&quot;:&quot;fadeIn&quot;}"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img width="174" height="155"
                                            src="{{ asset('wp-content/uploads/2025/01/growth-close-up-environmental-lush-natural.png') }}"
                                            class="attachment-medium size-medium wp-image-235" alt="{{ $service->name }}">
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-32e8e64 elementor-invisible elementor-widget elementor-widget-image"
                                    data-id="32e8e64" data-element_type="widget"
                                    data-settings="{&quot;_animation_delay&quot;:400,&quot;_animation&quot;:&quot;fadeIn&quot;}"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img loading="lazy" width="116" height="104"
                                            src="../../wp-content/uploads/2025/01/growth-close-up-environmental-lush-natural-copy.png"
                                            class="attachment-medium size-medium wp-image-233" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-e0d0d06 e-con-full mask-bottom vamtam-has-theme-cp vamtam-cp-top-right e-flex e-con e-child"
                                data-id="e0d0d06" data-element_type="container"
                                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                            </div>
                            <div class="elementor-element elementor-element-65d91db e-con-full e-flex e-con e-child"
                                data-id="65d91db" data-element_type="container"
                                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-element elementor-element-03c2f4f elementor-widget elementor-widget-heading"
                                    data-id="03c2f4f" data-element_type="widget" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h4 class="elementor-heading-title elementor-size-default">Choose
                                            {{ $service->name }}</h4>
                                    </div>
                                </div>
                                @php
                                    $otherServices = App\Models\Service::active()
                                        ->where('id', '!=', $service->id)
                                        ->ordered()
                                        ->limit(3)
                                        ->get();
                                @endphp

                                @foreach($otherServices as $otherService)
                                    <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-721f7ff elementor-align-justify vamtam-has-hover-anim vamtam-has-icon-styles elementor-widget elementor-widget-button"
                                        data-id="721f7ff" data-element_type="widget" data-widget_type="button.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-button-wrapper">
                                                <a class="elementor-button elementor-button-link elementor-size-sm"
                                                    href="{{ route('services.show', $otherService->slug) }}">
                                                    <span class="elementor-button-content-wrapper">
                                                        <span class="elementor-button-icon">
                                                            <i aria-hidden="true"
                                                                class="vamtamtheme- vamtam-theme-arrow-right"></i> </span>
                                                        <span class="elementor-button-text">{{ $otherService->name }}</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if($otherServices->count() < 3)
                                    @for($i = $otherServices->count(); $i < 3; $i++)
                                        <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-39abd24 elementor-align-justify vamtam-has-hover-anim vamtam-has-icon-styles elementor-widget elementor-widget-button"
                                            data-id="39abd24" data-element_type="widget" data-widget_type="button.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-button-wrapper">
                                                    <a class="elementor-button elementor-button-link elementor-size-sm"
                                                        href="{{ route('services.index') }}">
                                                        <span class="elementor-button-content-wrapper">
                                                            <span class="elementor-button-icon">
                                                                <i aria-hidden="true"
                                                                    class="vamtamtheme- vamtam-theme-arrow-right"></i> </span>
                                                            <span class="elementor-button-text">View All Services</span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                    @endfor
                                @endif

                            </div>
                            <div class="elementor-element elementor-element-80214ee e-con-full animated-fast e-flex elementor-invisible e-con e-child"
                                data-id="80214ee" data-element_type="container"
                                data-settings="{&quot;background_background&quot;:&quot;gradient&quot;,&quot;animation&quot;:&quot;fadeIn&quot;,&quot;animation_delay&quot;:200}">
                                <div class="elementor-element elementor-element-4edeecb elementor-widget elementor-widget-text-editor"
                                    data-id="4edeecb" data-element_type="widget" data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container">
                                        <p>Looking for {{ strtolower($service->name) }} service<br>Contact us now!</p>
                                    </div>
                                </div>
                                <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-3c0dd47 vamtam-has-icon-styles vamtam-has-hover-anim elementor-widget elementor-widget-button"
                                    data-id="3c0dd47" data-element_type="widget" data-widget_type="button.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <a class="elementor-button elementor-button-link elementor-size-sm"
                                                href="tel:+31685863638">
                                                <span class="elementor-button-content-wrapper">
                                                    <span class="elementor-button-icon">
                                                        <i aria-hidden="true" class="vamtamtheme- vamtam-theme-phone"></i>
                                                    </span>
                                                    <span class="elementor-button-text">+31 685863638</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-53c5fe2 e-con-full e-flex e-con e-child"
                                data-id="53c5fe2" data-element_type="container"
                                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                <div class="elementor-element elementor-element-268bd1b elementor-widget elementor-widget-image"
                                    data-id="268bd1b" data-element_type="widget" data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        @if($service->image && file_exists(public_path('storage/' . $service->image)))
                                            <img fetchpriority="high" loading="lazy" width="392" height="418"
                                                src="{{ asset('storage/' . $service->image) }}"
                                                class="attachment-large size-large wp-image-3678" alt="{{ $service->name }}"
                                                sizes="(max-width: 392px) 100vw, 392px"
                                                onerror="this.src='{{ asset('wp-content/uploads/2025/01/pexels-jonathanborba-28576639.png') }}'">
                                        @else
                                            <img fetchpriority="high" loading="lazy" width="392" height="418"
                                                src="{{ asset('wp-content/uploads/2025/01/pexels-jonathanborba-28576639.png') }}"
                                                class="attachment-large size-large wp-image-3678" alt="{{ $service->name }}"
                                                srcset="{{ asset('wp-content/uploads/2025/01/pexels-jonathanborba-28576639.png') }} 392w, {{ asset('wp-content/uploads/2025/01/pexels-jonathanborba-28576639-281x300.png') }} 281w"
                                                sizes="(max-width: 392px) 100vw, 392px">
                                        @endif
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-a12a884 elementor-widget elementor-widget-text-editor"
                                    data-id="a12a884" data-element_type="widget" data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container">
                                        <p>Check out our FAQ for all the {{ strtolower($service->name) }} details and
                                            answers you need!</p>
                                    </div>
                                </div>
                                <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-87fea98 elementor-align-center vamtam-has-hover-anim elementor-widget elementor-widget-button"
                                    data-id="87fea98" data-element_type="widget" data-widget_type="button.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-button-wrapper">
                                            <a class="elementor-button elementor-button-link elementor-size-sm"
                                                href="{{ route('about.faq') }}">
                                                <span class="elementor-button-content-wrapper">
                                                    <span class="elementor-button-text">Read Our FAQ</span>
                                                </span>
                                            </a>
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
@endsection

@push('styles')
    <!-- Service-specific Elementor styles -->
    <link rel='stylesheet' id='elementor-post-39-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-39.css") }}?ver=1752678329' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-142-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-142.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-1007-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-1007.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-3642-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-3642.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-156-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-156.css") }}?ver=1752677977' type='text/css' media='all'>

    <!-- Dynamic background image for service hero section -->
    @if($service->image && file_exists(public_path('storage/' . $service->image)))
        <style id="service-{{ $service->id }}-dynamic-styles">
            .elementor-3642 .elementor-element.elementor-element-e0d0d06:not(.elementor-motion-effects-element-type-background),
            .elementor-3642 .elementor-element.elementor-element-e0d0d06>.elementor-motion-effects-container>.elementor-motion-effects-layer {
                background-image: url("{{ asset('storage/' . $service->image) }}");
            }
        </style>
    @endif
@endpush