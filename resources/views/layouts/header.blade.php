<div data-elementor-type="header" data-elementor-id="142" class="elementor elementor-142 elementor-location-header"
	data-elementor-post-type="elementor_library">
	<div class="elementor-element elementor-element-4136286 vamtam-sticky-header elementor-hidden-tablet elementor-hidden-mobile e-flex e-con-boxed e-con e-parent"
		data-id="4136286" data-element_type="container"
		data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
		<div class="e-con-inner">
			<div class="elementor-element elementor-element-a565695 elementor-widget elementor-widget-theme-site-logo elementor-widget-image"
				data-id="a565695" data-element_type="widget" data-widget_type="theme-site-logo.default">
				<div class="elementor-widget-container">
					<a href="{{ route('home') }}">
						<img src="/images/company_logo.png" class="attachment-medium size-medium wp-image-46" alt="">
					</a>
				</div>
			</div>
			<style>
				.vamtam-btn-text {
					max-width: 160px;
					display: inline-block;
					white-space: nowrap;
					overflow: hidden;
					text-overflow: ellipsis;
					vertical-align: middle;
				}
				
			
			</style>
			<!-- Main Navigation Menu -->
			<div class="vamtam-has-theme-widget-styles elementor-element elementor-element-8a07f41 elementor-nav-menu__align-center elementor-nav-menu--dropdown-tablet elementor-nav-menu__text-align-aside elementor-nav-menu--toggle elementor-nav-menu--burger elementor-widget elementor-widget-nav-menu"
				data-id="8a07f41" data-element_type="widget"
				data-settings="{&quot;submenu_icon&quot;:{&quot;value&quot;:&quot;&lt;svg class=\&quot;fa-svg-chevron-down e-font-icon-svg e-fas-chevron-down\&quot; viewBox=\&quot;0 0 448 512\&quot; xmlns=\&quot;http:\/\/www.w3.org\/2000\/svg\&quot;&gt;&lt;path d=\&quot;M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z\&quot;&gt;&lt;\/path&gt;&lt;\/svg&gt;&quot;,&quot;library&quot;:&quot;fa-solid&quot;},&quot;layout&quot;:&quot;horizontal&quot;,&quot;toggle&quot;:&quot;burger&quot;}"
				data-widget_type="nav-menu.default">
				<div class="elementor-widget-container">

					<!-- NAV START -->
					<nav aria-label="Menu"
						class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-none">
						<ul id="menu-1-8a07f41" class="elementor-nav-menu">

							<!-- Home -->
							<li class="menu-item">
								<a href="{{ route('home') }}"
									class="elementor-item {{ request()->routeIs('home') ? 'elementor-item-active' : '' }}">Home</a>
							</li>

							<!-- About Us -->
							<li class="menu-item menu-item-has-children">
								<a href="{{ route('about.index') }}"
									class="elementor-item {{ request()->routeIs('about.*') ? 'elementor-item-active' : '' }}">About
									Us</a>
								<ul class="sub-menu elementor-nav-menu--dropdown">
									<li class="menu-item"><a href="{{ route('about.index') }}"
											class="elementor-sub-item {{ request()->routeIs('about.index') ? 'elementor-sub-item-active' : '' }}">Who
											we are</a></li>
									<li class="menu-item"><a href="{{ route('about.faq') }}"
											class="elementor-sub-item {{ request()->routeIs('about.faq') ? 'elementor-sub-item-active' : '' }}">FAQ</a>
									</li>
									<li class="menu-item"><a href="{{ route('about.customer-reviews') }}"
											class="elementor-sub-item {{ request()->routeIs('about.customer-reviews') ? 'elementor-sub-item-active' : '' }}">Customer
											reviews</a></li>
								</ul>
							</li>

							<!-- Services -->
							<li class="menu-item menu-item-has-children">
								<a href="{{ route('services.index') }}"
									class="elementor-item {{ request()->routeIs('services.*') ? 'elementor-item-active' : '' }}">Services</a>
								<ul class="sub-menu elementor-nav-menu--dropdown">
									@if(isset($headerServices) && $headerServices->count() > 0)
										@foreach($headerServices as $service)
											<li class="menu-item">
												<a href="{{ route('services.show', $service->slug) }}"
													class="elementor-sub-item {{ request()->routeIs('services.show') && request()->route('slug') == $service->slug ? 'elementor-sub-item-active' : '' }}">{{ $service->name }}</a>
											</li>
										@endforeach
									@endif
								</ul>
							</li>

							{{-- <!-- Pricing -->
							<li class="menu-item">
								<a href="{{ route('pricing.index') }}"
									class="elementor-item {{ request()->routeIs('pricing.*') ? 'elementor-item-active' : '' }}">Pricing</a>
							</li> --}}

							@php
								$user = auth()->user();
							@endphp


							<li class="menu-item menu-item-has-children">
								<a href="{{ route('jobs.index') }}"
									class="elementor-item {{ request()->routeIs('jobs.*') ? 'elementor-item-active' : '' }}">
									Listed Jobs
								</a>

								<ul class="sub-menu elementor-nav-menu--dropdown">
									@if(isset($JobCategory) && $JobCategory->count() > 0)
										@foreach($JobCategory as $JobCate)
											<li class="menu-item">
												<a href="{{ route('jobs.category', $JobCate->slug) }}"
													class="elementor-sub-item {{ request()->routeIs('jobs.category') && request()->route('slug') == $JobCate->slug ? 'elementor-sub-item-active' : '' }}">
													{{ $JobCate->name }}
												</a>
											</li>
										@endforeach
									@endif
								</ul>
							</li>


							<!-- Contact -->
							<li class="menu-item">
								<a href="{{ route('contact.index') }}"
									class="elementor-item {{ request()->routeIs('contact.*') ? 'elementor-item-active' : '' }}">Contact
								</a>
							</li>

						</ul>
					</nav>
					<!-- NAV END -->

					<div class="elementor-menu-toggle" role="button" tabindex="0" aria-label="Menu Toggle"
						aria-expanded="false">
						<svg aria-hidden="true" role="presentation"
							class="elementor-menu-toggle__icon--open e-font-icon-svg e-eicon-menu-bar"
							viewbox="0 0 1000 	1000" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M104 333H896C929 333 958 304 958 271S929 208 896 208H104C71 208 42 237 42 271S71 333 104 333ZM104 583H896C929 583 958 554 958 521S929 458 896 458H104C71 458 42 487 42 521S71 583 104 583ZM104 833H896C929 833 958 804 958 771S929 708 896 708H104C71 708 42 737 42 771S71 833 104 833Z">
							</path>
						</svg>
						<svg aria-hidden="true" role="presentation"
							class="elementor-menu-toggle__icon--close e-font-icon-svg e-eicon-close"
							viewbox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M742 167L500 408 258 167C246 154 233 150 217 150 196 150 179 158 167 167 154 179 150 196 150 212 150 229 154 242 171 254L408 500 167 742C138 771 138 800 167 829 196 858 225 858 254 829L496 587 738 829C750 842 767 846 783 846 800 846 817 842 829 829 842 817 846 804 846 783 846 767 842 750 829 737L588 500 833 258C863 229 863 200 833 171 804 137 775 137 742 167Z">
							</path>
						</svg>
					</div>
				</div>
			</div>

			<!-- User & Buttons -->
			<div class="elementor-element elementor-element-73a795f e-con-full e-flex e-con e-child" data-id="73a795f"
				data-element_type="container">
				@php
					$user = auth()->user();
					$avatarPath = $user?->avatar ?? $user?->profile_photo_path ?? null;
					$avatarUrl = $avatarPath
						? (filter_var($avatarPath, FILTER_VALIDATE_URL) ? $avatarPath : asset('storage/' . $avatarPath))
						: asset('images/login.png');
				@endphp
				<div class="vamtam-has-theme-widget-styles elementor-element elementor-element-ee1ad30 vamtam-has-icon-styles vamtam-has-hover-anim elementor-widget elementor-widget-button"
					data-id="ee1ad30" data-element_type="widget" data-widget_type="button.default">
					<div class="elementor-widget-container">
						<div class="elementor-button-wrapper">
							@auth
								{{-- <div class="dropdown">
									<a class="elementor-button elementor-button-link elementor-size-sm dropdown-toggle d-flex align-items-center"
										href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
										<span class="elementor-button-content-wrapper"
											style="display:flex;align-items:center;gap:8px;">
											<img src="{{ $avatarUrl }}" alt="Profile" width="28" height="28"
												style="border-radius:50%;object-fit:cover;">
											<span class="elementor-button-text">{{ $user->name ?? 'My Account' }}</span>
										</span>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="@php
																																																				if ($user->isAdmin()) {
																																																					echo route('admin.dashboard');
																																																				} elseif ($user->isRecruiter()) {
																																																					echo route('recruiter.dashboard');
																																																				} elseif ($user->isFreelancer()) {
																																																					echo route('freelancer.dashboard');
																																																				} else {
																																																					echo route('user.dashboard');
																																																				}
																																																			@endphp">My Account</a></li>
										<form method="POST" action="{{ route('auth.logout') }}" style="margin:0;">
											@csrf
											<li class="dropdown-item"><button type="submit"
													style="all:unset;">Logout</button></li>
										</form>
									</ul>
								</div> --}}
							@else
								<a class="elementor-button elementor-button-link elementor-size-sm"
									href="{{ route('login') }}">
									<span class="elementor-button-content-wrapper">
										<span class="elementor-button-icon login-btn-d">
											<img src="/images/login.png" alt="Login/Register Icon" width="18px"> </span>
										<span class="elementor-button-text">Login/Register</span>
									</span>
								</a>
							@endauth

						</div>
					</div>
				</div>

				<div class="vamtam-has-theme-widget-styles elementor-element elementor-element-ee1ad30 vamtam-has-icon-styles vamtam-has-hover-anim elementor-widget elementor-widget-button"
					data-id="ee1ad30" data-element_type="widget" data-widget_type="button.default">
					<div class="elementor-widget-container">
						<div class="elementor-button-wrapper">
							@auth
								<div class="dropdown">
									<a class="elementor-button elementor-button-link elementor-size-sm dropdown-toggle d-flex align-items-center"
										href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
										<span class="elementor-button-content-wrapper"
											style="display:flex;align-items:center;gap:8px;">
											<img src="{{ $avatarUrl }}" alt="Profile" width="28" height="28"
												style="border-radius:50%;object-fit:cover;">
											<span class="elementor-button-text">{{ $user->name ?? 'My Account' }}</span>
										</span>
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="@php
											if ($user->isAdmin()) {
												echo route('admin.dashboard');
											} elseif ($user->isRecruiter()) {
												echo route('recruiter.dashboard');
											} elseif ($user->isFreelancer()) {
												echo route('freelancer.dashboard');
											} else {
												echo route('user.dashboard');
											}
										@endphp">My Account</a></li>
										<form method="POST" action="{{ route('auth.logout') }}" style="margin:0;">
											@csrf
											<li class="dropdown-item"><button type="submit"
													style="all:unset;">Logout</button></li>
										</form>
									</ul>
								</div>
							@else
								<a class="elementor-button elementor-button-link elementor-size-sm"
									href="{{ route('register-freelancer') }}" title="hghg">
									<span class="elementor-button-content-wrapper">
										<span class="elementor-button-icon login-btn-d">
											<img src="/images/login.png" alt="Login/Register Icon" width="18px"> </span>
										<span class="elementor-button-text">Register as Jobseeker</span>
									</span>
								</a>
							@endauth

						</div>
					</div>
				</div>

				@auth
					{{-- @if(auth()->user()->isFreelancer())
					<div class="vamtam-has-theme-widget-styles elementor-element elementor-element-3c69fb2 vamtam-has-hover-anim elementor-widget elementor-widget-button"
						data-id="3c69fb2" data-element_type="widget" data-widget_type="button.default">
						<div class="elementor-widget-container">
							<div class="elementor-button-wrapper">
								<a class="elementor-button elementor-button-link elementor-size-sm"
									href="{{ route('freelancer.browse-jobs') }}">
									<span class="elementor-button-content-wrapper">
										<span class="elementor-button-text">Browse Jobs</span>
									</span>
								</a>
							</div>
						</div>
					</div>
					@endif --}}
				@endauth

			</div>
		</div>
	</div>

	@include('layouts.mobileheader')
	<div class="elementor-section-wrap"></div>
</div>

{{-- @if(Auth::check() && Auth::user()->isFreelancer())
<li class="nav-item">
	<a class="nav-link" href="{{ route('freelancer.browse-jobs') }}">Browse Jobs</a>
</li>
@endif --}}