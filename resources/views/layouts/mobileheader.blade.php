<div class="elementor-element elementor-element-a11d4f7 elementor-hidden-desktop e-flex e-con-boxed e-con e-parent"
    data-id="a11d4f7" data-element_type="container"
    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;sticky&quot;:&quot;top&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;sticky_offset&quot;:0,&quot;sticky_effects_offset&quot;:0,&quot;sticky_anchor_link_offset&quot;:0}">
    <div class="e-con-inner">
        <div class="elementor-element elementor-element-35e03c3 e-con-full e-flex e-con e-child" data-id="35e03c3"
            data-element_type="container">
            <div class="elementor-element elementor-element-870dcb4 elementor-widget-mobile__width-initial elementor-widget elementor-widget-theme-site-logo elementor-widget-image"
                data-id="870dcb4" data-element_type="widget" data-widget_type="theme-site-logo.default">
                <div class="elementor-widget-container">
                    <a href="{{ route('home') }}">
                        <img width="134" height="33" src="/images/company_logo.png"
                            class="attachment-medium size-medium wp-image-46" alt=""> </a>
                </div>
            </div>
        </div>
        <div class="elementor-element elementor-element-c52777e e-con-full e-flex e-con e-child" data-id="c52777e"
            data-element_type="container">
                      {{--   <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-159d592 elementor-hidden-mobile vamtam-has-hover-anim elementor-widget elementor-widget-button"
                data-id="159d592" data-element_type="widget" data-widget_type="button.default">
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <a class="elementor-button elementor-button-link elementor-size-sm" href="free-quote/index.htm">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-text">Book Now</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div> --}}
            {{-- <div
                class="vamtam-has-theme-widget-styles elementor-element elementor-element-34efb7a elementor-widget elementor-widget-button"
                data-id="34efb7a" data-element_type="widget" data-widget_type="button.default">
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <a class="elementor-button elementor-button-link elementor-size-sm"
                            href="#elementor-action%3Aaction%3Dpopup%3Aopen%26settings%3DeyJpZCI6IjE1NiIsInRvZ2dsZSI6dHJ1ZSwiYWxpZ25fd2l0aF9wYXJlbnQiOiIifQ%3D%3D">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-icon">
                                    <i aria-hidden="true" class="vamtamtheme- vamtam-theme-search"></i> </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div> --}}
            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-a63e488 elementor-widget elementor-widget-button"
                data-id="a63e488" data-element_type="widget" data-widget_type="button.default">
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <a class="elementor-button elementor-button-link elementor-size-sm" href="tel:+31685863638">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-icon">
                                    <i aria-hidden="true" class="vamtamtheme- vamtam-theme-phone"></i> </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @php
                $user = auth()->user();
                $avatarPath = $user?->avatar ?? $user?->profile_photo_path ?? null;
                $avatarUrl = $avatarPath
                    ? (filter_var($avatarPath, FILTER_VALIDATE_URL) ? $avatarPath : asset('storage/' . $avatarPath))
                    : asset('images/login.png');
            @endphp
            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-a63e488 elementor-widget elementor-widget-button"
                data-id="a63e488" data-element_type="widget" data-widget_type="button.default">
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        @auth
                            <div class="user-dropdown" style="position:relative;">
                                <div style="list-style:none;cursor:pointer;" onclick="toggleDropdown(this)">
                                    <span class="elementor-button-content-wrapper"
                                        style="display:flex;align-items:center;gap:8px;">
                                        <img src="{{ $avatarUrl }}" alt="Profile" width="26" height="26"
                                            style="border-radius:50%;object-fit:cover;">
                                        <span class="elementor-button-text"
                                            style="font-size:14px;max-width:40px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $user->name ?? 'My Account' }}</span>
                                    </span>
                                </div>
                                <div class="dropdown-menu"
                                    style="display:none;position:absolute;right:0;margin-top:8px;background:#fff;border:1px solid #e5e7eb;border-radius:6px;min-width:160px;box-shadow:0 8px 20px rgba(0,0,0,0.08);z-index:1000;">
                                    <a href="@php
                                        if ($user->isAdmin()) {
                                            echo route('admin.dashboard');
                                        } elseif ($user->isRecruiter()) {
                                            echo route('recruiter.dashboard');
                                        } elseif ($user->isFreelancer()) {
                                            echo route('freelancer.dashboard');
                                        } else {
                                            echo route('user.dashboard');
                                        }
                                    @endphp" class="dropdown-item"
                                        style="display:block;padding:10px 12px;color:#111;text-decoration:none;">My
                                        Account</a>
                                    <form method="POST" action="{{ route('auth.logout') }}" style="margin:0;">
                                        @csrf
                                        <button type="submit" class="dropdown-item"
                                            style="display:block;width:100%;text-align:left;padding:10px 12px;background:none;border:none;cursor:pointer;color:#b91c1c;">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="login-dropdown" style="position:relative;">
                                <div style="list-style:none;cursor:pointer;display:flex;align-items:center;justify-content:center;" onclick="toggleDropdown(this)">
                                    <span class="elementor-button-content-wrapper">
                                        <span class="elementor-button-icon">
                                            <img src="/images/login.png" alt="Login/Register Icon" width="18px"> </span>
                                    </span>
                                </div>
                                <div class="login-dropdown-menu"
                                    style="display:none;position:absolute;right:0;margin-top:8px;background:#fff;border:1px solid #e5e7eb;border-radius:6px;min-width:180px;box-shadow:0 8px 20px rgba(0,0,0,0.08);z-index:1000;">
                                    <a href="{{ route('login') }}" class="dropdown-item"
                                        style="display:block;padding:12px 14px;color:#111;text-decoration:none;border-bottom:1px solid #f0f0f0;">Login / Register</a>
                                    <a href="{{ route('login', ['role' => 'job_seeker']) }}" class="dropdown-item"
                                        style="display:block;padding:12px 14px;color:#111;text-decoration:none;">Register with Job Seeker</a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-4f31cf7 elementor-nav-menu--stretch elementor-nav-menu--dropdown-tablet elementor-nav-menu__text-align-aside elementor-nav-menu--toggle elementor-nav-menu--burger elementor-widget elementor-widget-nav-menu"
                data-id="4f31cf7" data-element_type="widget"
                data-settings="{&quot;submenu_icon&quot;:{&quot;value&quot;:&quot;&lt;svg class=\&quot;fa-svg-chevron-down e-font-icon-svg e-fas-chevron-down\&quot; viewBox=\&quot;0 0 448 512\&quot; xmlns=\&quot;http:\/\/www.w3.org\/2000\/svg\&quot;&gt;&lt;path d=\&quot;M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z\&quot;&gt;&lt;\/path&gt;&lt;\/svg&gt;&quot;,&quot;library&quot;:&quot;fa-solid&quot;},&quot;full_width&quot;:&quot;stretch&quot;,&quot;layout&quot;:&quot;horizontal&quot;,&quot;toggle&quot;:&quot;burger&quot;}"
                data-widget_type="nav-menu.default">
                <div class="elementor-widget-container">
                    <nav aria-label="Menu"
                        class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-none">
                        <ul id="menu-1-4f31cf7" class="elementor-nav-menu">
                            <li
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-17 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-138">
                                <a href="/" aria-current="page" class="elementor-item elementor-item-active">Home</a>

                            </li>
                            <li
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-128">
                                <a href="services/index.htm" class="elementor-item">Services</a>

                                <ul class="sub-menu elementor-nav-menu--dropdown">
                                   @if(isset($headerServices) && $headerServices->count() > 0)
										@foreach($headerServices as $service)
											<li class="sub-menu elementor-nav-menu--dropdown">
												<a href="{{ route('services.show', $service->slug) }}"
													class="elementor-sub-item {{ request()->routeIs('services.show') && request()->route('slug') == $service->slug ? 'elementor-sub-item-active' : '' }}">{{ $service->name }}</a>
											</li>
										@endforeach
									@endif
                                </ul>
                            </li>
                            <li
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-7537">
                                <a href="service-areas/index.htm" class="elementor-item">Service areas</a>
                                <ul class="sub-menu elementor-nav-menu--dropdown">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7400">
                                        <a href="service-areas/atlanta/index.htm" class="elementor-sub-item">Atlanta</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7401">
                                        <a href="service-areas/boston/index.htm" class="elementor-sub-item">Boston</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7402">
                                        <a href="service-areas/chicago/index.htm" class="elementor-sub-item">Chicago</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7403">
                                        <a href="service-areas/new-york-city/index.htm" class="elementor-sub-item">New
                                            York City</a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-119">
                                <a href="about-us/index.htm" class="elementor-item">About us</a>
                                <ul class="sub-menu elementor-nav-menu--dropdown">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-139">
                                        <a href="about-us/index.htm" class="elementor-sub-item">Who we are</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-120">
                                        <a href="about-us/cleaning-process/index.htm"
                                            class="elementor-sub-item">Cleaning process</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-122">
                                        <a href="about-us/faq/index.htm" class="elementor-sub-item">FAQ</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-121">
                                        <a href="about-us/customer-reviews/index.htm"
                                            class="elementor-sub-item">Customer reviews</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-146"><a
                                    href="contact-us/index.htm" class="elementor-item">Contact us</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-124"><a
                                    href="blog/index.htm" class="elementor-item">Blog</a></li>
                        </ul>
                    </nav>
                    <div class="elementor-menu-toggle" role="button" tabindex="0" aria-label="Menu Toggle"
                        aria-expanded="false">
                        <i aria-hidden="true" role="presentation"
                            class="elementor-menu-toggle__icon--open vamtamtheme- vamtam-theme-burger-nav"></i><i
                            aria-hidden="true" role="presentation"
                            class="elementor-menu-toggle__icon--close vamtamtheme- vamtam-theme-close"></i>
                    </div>
                    <nav class="elementor-nav-menu--dropdown elementor-nav-menu__container" aria-hidden="true">
                        <ul id="menu-2-4f31cf7" class="elementor-nav-menu">
                            <li
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-17 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-138">
                                <a href="/" aria-current="page" class="elementor-item "
                                    tabindex="-1">Home</a>
                            </li>
                            <li
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-119">
                                <a href="{{ route('about.index') }}" class="elementor-item">About us</a>
                                <ul class="sub-menu elementor-nav-menu--dropdown">
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-139">
                                        <a href="/about-us" class="elementor-sub-item">Who we are</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-122">
                                        <a href="{{ route('about.faq') }}" class="elementor-sub-item">FAQ</a>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-121">
                                        <a href="{{ route('about.customer-reviews') }}"
                                            class="elementor-sub-item">Customer reviews</a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-128">
                                <a href="{{ route('services.index') }}" class="elementor-item"
                                    tabindex="-1">Services</a>
                                <ul class="sub-menu elementor-nav-menu--dropdown">
                                    @if(isset($headerServices) && $headerServices->count() > 0)
                                        @foreach($headerServices as $service)
                                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-132">
                                                <a href="{{ route('services.show', $service->slug) }}"
                                                    class="elementor-sub-item">{{ $service->name }}</a>
                                            </li>
                                        @endforeach

                                    @endif
                                </ul>
                            </li>
                            {{-- <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-124"><a
                                    href="{{ route('pricing.index') }}" class="elementor-item">Pricing</a></li> --}}
                            <li
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-jobs">
                                <a href="{{ route('jobs.index') }}" class="elementor-item">Jobs
                                </a>
                                <ul class="sub-menu elementor-nav-menu--dropdown">
                                   @if(isset($JobCategory) && $JobCategory->count() > 0)
											@foreach($JobCategory as $JobCate)
												<li class="menu-item menu-item-type-post_type menu-item-object-page">
													<a href="{{ route('jobs.category', $JobCate->slug) }}"
														class="elementor-sub-item {{ request()->routeIs('jobs.category') && request()->route('slug') == $JobCate->slug ? 'elementor-sub-item-active' : '' }}">
														{{ $JobCate->name }}
													</a>
												</li>
											@endforeach
										@endif

                                </ul>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-146"><a
                                    href="{{ route('contact.index') }}" class="elementor-item">Contact us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
<script>
function toggleDropdown(element) {
    const dropdown = element.nextElementSibling;
    dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' : 'none';
}
</script>
</div>
