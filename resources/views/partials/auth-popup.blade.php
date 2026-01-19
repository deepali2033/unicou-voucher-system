<div data-elementor-type="popup" data-elementor-id="600" class="elementor elementor-600 elementor-location-popup" data-elementor-settings='{"entrance_animation":"fadeIn","exit_animation":"fadeIn","prevent_scroll":"yes","avoid_multiple_popups":"yes","classes":"vamtam-header-mega-menu vamtam-popup","a11y_navigation":"yes","triggers":[],"timing":[]}' data-elementor-post-type="elementor_library">
    <div class="elementor-element e-flex e-con-boxed e-con e-parent" data-element_type="container">
        <div class="e-con-inner">
            <div class="elementor-element e-con-full e-flex e-con e-child" data-element_type="container" data-settings='{"background_background":"classic"}'>
                <div class="elementor-widget-container" style="width:100%">
                    <div class="e-search" role="dialog" aria-modal="true" aria-labelledby="auth-popup-title">
                        <div class="e-search-form" style="display:flex; gap:24px; flex-wrap:wrap">
                            <div style="flex:1 1 320px; min-width:280px">
                                <h3 id="auth-popup-title" class="elementor-heading-title elementor-size-default" style="margin:0 0 12px">Login</h3>
                                <form method="POST" action="{{ route('auth.login') }}">
                                    @csrf
                                    <div class="e-search-input-wrapper" style="margin-bottom:10px">
                                        <input class="e-search-input" type="email" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="e-search-input-wrapper" style="margin-bottom:10px">
                                        <input class="e-search-input" type="password" name="password" placeholder="Password" required>
                                    </div>
                                    <label style="display:flex; align-items:center; gap:6px; font-size:12px; opacity:.9; margin-bottom:10px">
                                        <input type="checkbox" name="remember" value="1"> Remember me
                                    </label>
                                    <button class="elementor-button elementor-button-link elementor-size-sm" type="submit">
                                        <span class="elementor-button-content-wrapper">
                                            <span class="elementor-button-icon"><i aria-hidden="true" class="vamtamtheme- vamtam-theme-arrow-right"></i></span>
                                            <span class="elementor-button-text">Sign in</span>
                                        </span>
                                    </button>
                                </form>
                            </div>
                            <div style="flex:1 1 320px; min-width:280px">
                                <h3 class="elementor-heading-title elementor-size-default" style="margin:0 0 12px">Register</h3>
                                <form method="POST" action="{{ route('auth.register') }}">
                                    @csrf
                                    <div class="e-search-input-wrapper" style="margin-bottom:10px">
                                        <input class="e-search-input" type="text" name="name" placeholder="Full name" required>
                                    </div>
                                    <div class="e-search-input-wrapper" style="margin-bottom:10px">
                                        <input class="e-search-input" type="email" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="e-search-input-wrapper" style="margin-bottom:10px">
                                        <input class="e-search-input" type="password" name="password" placeholder="Password (min 8)" required>
                                    </div>
                                    <div class="e-search-input-wrapper" style="margin-bottom:10px">
                                        <input class="e-search-input" type="password" name="password_confirmation" placeholder="Confirm password" required>
                                    </div>
                                    <button class="elementor-button elementor-button-link elementor-size-sm" type="submit">
                                        <span class="elementor-button-content-wrapper">
                                            <span class="elementor-button-icon"><i aria-hidden="true" class="vamtamtheme- vamtam-theme-arrow-right"></i></span>
                                            <span class="elementor-button-text">Create account</span>
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @if($errors->any())
                            <div class="elementor-alert elementor-alert-warning" role="alert" style="margin-top:16px">
                                <span class="elementor-alert-title">Please fix the following:</span>
                                <ul style="margin:8px 0 0 16px">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-widget elementor-widget-button" data-element_type="widget" data-widget_type="button.default">
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <a class="elementor-button elementor-button-link elementor-size-sm" href="#elementor-action%3Aaction%3Dpopup%3Aclose%26settings%3DeyJkb19ub3Rfc2hvd19hZ2FpbiI6IiJ9">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-icon"><i aria-hidden="true" class="vamtamtheme- vamtam-theme-close"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>