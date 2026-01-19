@extends('layouts.app')

@section('title', $job->meta_title ?: $job->title . ' - KOA Service')
@section('meta_description', $job->meta_description ?: $job->short_description)

@section('content')
    <article id="post-5832" class="full post-5832 page type-page status-publish hentry">
        <div data-elementor-type="single-page" data-elementor-id="6790"
            class="elementor elementor-6790 elementor-location-single post-5832 page type-page status-publish hentry"
            data-elementor-post-type="elementor_library">
            <div class="elementor-element elementor-element-6b37ea9 e-con-full e-flex e-con e-parent" data-id="6b37ea9"
                data-element_type="container">
                <div class="elementor-element elementor-element-eb67e7a e-flex e-con-boxed e-con e-child" data-id="eb67e7a"
                    data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-ed83420 elementor-widget__width-inherit animated-fast elementor-invisible elementor-widget elementor-widget-theme-post-title elementor-page-title elementor-widget-heading"
                            data-id="ed83420" data-element_type="widget"
                            data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                            data-widget_type="theme-post-title.default">
                            <div class="elementor-widget-container">
                                <h1 class="elementor-heading-title elementor-size-default">{{ $job->title }}</h1>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-e5c0dc0 elementor-widget__width-auto animated-fast elementor-invisible elementor-widget elementor-widget-text-editor"
                            data-id="e5c0dc0" data-element_type="widget"
                            data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:200}"
                            data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                Job Location: {{ $job->location ?: 'Location flexible' }} </div>
                        </div>
                        <div class="elementor-element elementor-element-0d106e3 elementor-widget__width-auto animated-fast elementor-invisible elementor-widget elementor-widget-text-editor"
                            data-id="0d106e3" data-element_type="widget"
                            data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:250}"
                            data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                Job Category: {{ $job->category }} </div>
                        </div>
                        <div class="elementor-element elementor-element-aea21ab elementor-widget__width-auto animated-fast elementor-invisible elementor-widget elementor-widget-text-editor"
                            data-id="aea21ab" data-element_type="widget"
                            data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:300}"
                            data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                Job Type: {{ ucfirst(str_replace('-', ' ', $job->employment_type)) }} </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="elementor-element elementor-element-172b4a5 e-con-full e-flex e-con e-parent" data-id="172b4a5"
                data-element_type="container">
                <div class="elementor-element elementor-element-4ce3c18 elementor-widget elementor-widget-theme-post-content"
                    data-id="4ce3c18" data-element_type="widget" data-widget_type="theme-post-content.default">
                    <div class="elementor-widget-container">
                        <div data-elementor-type="wp-page" data-elementor-id="5832" class="elementor elementor-5832"
                            data-elementor-post-type="page">
                            <div class="elementor-element elementor-element-30c4a91c e-flex e-con-boxed e-con e-parent"
                                data-id="30c4a91c" data-element_type="container">
                                <div class="e-con-inner">
                                    <div class="elementor-element elementor-element-6d349528 animated-fast elementor-invisible elementor-widget elementor-widget-text-editor"
                                        data-id="6d349528" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:100}"
                                        data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container">
                                            <p>{{ $job->short_description }}</p>
                                            @if($job->description)
                                                <div style="margin-top: 20px;">
                                                    {!! nl2br(e($job->description)) !!}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-5b754393 elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                                        data-id="5b754393" data-element_type="widget" data-widget_type="divider.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-divider">
                                                <span class="elementor-divider-separator">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-1ab9b221 animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                                        data-id="1ab9b221" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:100}"
                                        data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h3 class="elementor-heading-title elementor-size-default">Requirements:</h3>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-5e17fcd elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                                        data-id="5e17fcd" data-element_type="widget" data-widget_type="icon-list.default">
                                        <div class="elementor-widget-container">
                                            <ul class="elementor-icon-list-items">
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span
                                                        class="elementor-icon-list-text">{{ $job->requirements[0] ?? 'No specific requirements listed' }}</span>
                                                </li>
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span
                                                        class="elementor-icon-list-text">{{ $job->requirements[1] ?? '' }}</span>
                                                </li>
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span
                                                        class="elementor-icon-list-text">{{ $job->requirements[2] ?? '' }}</span>
                                                </li>
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span
                                                        class="elementor-icon-list-text">{{ $job->requirements[3] ?? '' }}</span>
                                                </li>
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span
                                                        class="elementor-icon-list-text">{{ $job->requirements[4] ?? '' }}</span>
                                                </li>
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span
                                                        class="elementor-icon-list-text">{{ $job->requirements[5] ?? '' }}</span>
                                                </li>
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span class="elementor-icon-list-text">Reports all discrepancies found
                                                        on the night auditor’s room report. Reports all incidents or strange
                                                        occurrences that could be an indication of misdemeanors. Ensures
                                                        that all key cards are returned to the secure designated area or
                                                        front desk.</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-3accabe6 elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                                        data-id="3accabe6" data-element_type="widget" data-widget_type="divider.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-divider">
                                                <span class="elementor-divider-separator">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-65b2fcf7 animated-fast elementor-invisible elementor-widget elementor-widget-heading"
                                        data-id="65b2fcf7" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:100}"
                                        data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h3 class="elementor-heading-title elementor-size-default">Benefits:</h3>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-5949e742 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                                        data-id="5949e742" data-element_type="widget" data-widget_type="icon-list.default">
                                        <div class="elementor-widget-container">
                                            <ul class="elementor-icon-list-items">
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span class="elementor-icon-list-text">Have a valid driver’s license and
                                                        dependable transportation available.</span>
                                                </li>
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span class="elementor-icon-list-text">Must be able to communicate
                                                        effectively by writing, telephone and personal meeting
                                                        situations.</span>
                                                </li>
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span class="elementor-icon-list-text"> Must be organized, honest, and
                                                        work well with others, and have an outgoing personality.</span>
                                                </li>
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span class="elementor-icon-list-text">Must be able to bend, reach,
                                                        kneel, push, and stretch and lift and/or carry up to 25
                                                        pounds.</span>
                                                </li>
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span class="elementor-icon-list-text">Must have eyesight enabling
                                                        vision both near and far.</span>
                                                </li>
                                                <li class="elementor-icon-list-item">
                                                    <span class="elementor-icon-list-icon">
                                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-circle"
                                                            viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                            </path>
                                                        </svg> </span>
                                                    <span class="elementor-icon-list-text">Must speak in a clear,
                                                        understandable voice and hear at a basic level, and understand
                                                        English.</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Apply Now Button Section -->
            <div class="elementor-element elementor-element-apply-now e-flex e-con-boxed e-con e-parent" data-id="apply-now"
                data-element_type="container">
                <div class="e-con-inner">
                    <div class="elementor-element elementor-element-apply-btn animated-fast elementor-invisible elementor-widget elementor-widget-text-editor"
                        data-id="apply-btn" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:100}"
                        data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            <div class="text-center py-4">
                                <h3 class="mb-4">Ready to Join Our Team?</h3>
                                <p class="mb-4">Apply now for this position and become part of the KOA Services family!</p>
                                @if (Auth::check()) @php $user = Auth::user(); @endphp
                                    @if ($user->isUser() || $user->isRecruiter() || $user->isAdmin())
                                        <a href="javascript:void(0);" onclick="alert('You are not allowed to apply for a job');"
                                            class="btn btn-primary btn-lg px-5 py-3"
                                            style="background: linear-gradient(135deg, #50C878  100%); border: none; border-radius: 50px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); transition: all 0.3s ease;">
                                           <i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i>Apply Now
                                        </a>
                                    @else
                                        <a href="{{ route('freelancer.applied-jobs.create', ['job' => $job->slug]) }}"
                                            class="btn btn-primary btn-lg px-5 py-3"
                                            style="background: linear-gradient(135deg, #50C878   100%); border: none; border-radius: 50px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); transition: all 0.3s ease;">
                                            <i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i>Apply Now
                                        </a>
                                    @endif
                                    <!-- @if ($user->account_type == 'recruiter')
                                               <a href="{{ route('recruiter.dashboard') }}"class="btn btn-primary btn-lg px-5 py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 50px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); transition: all 0.3s ease;">
                                                    <i class="fas fa-paper-plane me-2"></i>Apply Now
                                                </a>
                                            @elseif ($user->account_type == 'user')
                                                <a href="{{ route('user.dashboard') }}"class="btn btn-primary btn-lg px-5 py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 50px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); transition: all 0.3s ease;">
                                                    <i class="fas fa-paper-plane me-2"></i>Apply Now
                                                </a>
                                            @endif -->

                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3"
                                        style="background: linear-gradient(135deg, #50C878  100%); border: none; border-radius: 50px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); transition: all 0.3s ease;">
                                        <i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i>Apply Now
                                    </a>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- <div class="elementor-element elementor-element-8d7869f animated-fast e-flex e-con-boxed elementor-invisible e-con e-parent" data-id="8d7869f" data-element_type="container" data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-64b76c4 e-con-full animated-fast vamtam-has-theme-cp vamtam-cp-top-left e-flex e-con e-child" data-id="64b76c4" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;,&quot;animation&quot;:&quot;none&quot;}">
                            <div class="elementor-element elementor-element-480cf34 elementor-position-right elementor-widget__width-auto elementor-mobile-position-right elementor-vertical-align-top animated-fast elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="480cf34" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;none&quot;,&quot;_animation_delay&quot;:50}" data-widget_type="icon-box.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-icon-box-wrapper">

                                        <div class="elementor-icon-box-icon">
                                            <span class="elementor-icon">
                                                <i aria-hidden="true" class="vamtamtheme- vamtam-theme-title-dec"></i> </span>
                                        </div>

                                        <div class="elementor-icon-box-content">

                                            <h6 class="elementor-icon-box-title">
                                                <span>
                                                    Apply Form </span>
                                            </h6>


                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-c1d567d elementor-widget__width-initial animated-fast elementor-widget elementor-widget-heading" data-id="c1d567d" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;none&quot;,&quot;_animation_delay&quot;:100}" data-widget_type="heading.default">
                                <div class="elementor-widget-container">
                                    <h2 class="elementor-heading-title elementor-size-default">Join the Crew</h2>
                                </div>
                            </div>
                            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-2190815 elementor-button-align-start vamtam-has-btn-hover-anim elementor-widget elementor-widget-form" data-id="2190815" data-element_type="widget" data-settings="{&quot;step_next_label&quot;:&quot;Next&quot;,&quot;step_previous_label&quot;:&quot;Previous&quot;,&quot;button_width&quot;:&quot;100&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}" data-widget_type="form.default">
                                <div class="elementor-widget-container">
                                    <form class="elementor-form" method="post" name="Join the Crew Form" aria-label="Join the Crew Form">
                                        <input type="hidden" name="post_id" value="6790">
                                        <input type="hidden" name="form_id" value="2190815">
                                        <input type="hidden" name="referer_title" value="Team Leader">

                                        <input type="hidden" name="queried_id" value="5832">

                                        <div class="elementor-form-fields-wrapper elementor-labels-above">
                                            <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-first_name_jobs_form elementor-col-50 elementor-field-required">
                                                <label for="form-field-first_name_jobs_form" class="elementor-field-label">
                                                    First name </label>
                                                <input size="1" type="text" name="form_fields[first_name_jobs_form]" id="form-field-first_name_jobs_form" class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="e.g. John" required="required">
                                            </div>
                                            <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-last_name_jobs_form elementor-col-50 elementor-field-required">
                                                <label for="form-field-last_name_jobs_form" class="elementor-field-label">
                                                    Last name </label>
                                                <input size="1" type="text" name="form_fields[last_name_jobs_form]" id="form-field-last_name_jobs_form" class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="e.g. Smith" required="required">
                                            </div>
                                            <div class="elementor-field-type-tel elementor-field-group elementor-column elementor-field-group-phone_jobs_form elementor-col-50 elementor-field-required">
                                                <label for="form-field-phone_jobs_form" class="elementor-field-label">
                                                    Phone </label>
                                                <input size="1" type="tel" name="form_fields[phone_jobs_form]" id="form-field-phone_jobs_form" class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="e.g. (1) 23 4567 891" required="required" pattern="[0-9()#&amp;+*-=.]+" title="Only numbers and phone characters (#, -, *, etc) are accepted.">

                                            </div>
                                            <div class="elementor-field-type-email elementor-field-group elementor-column elementor-field-group-email_jobs_form elementor-col-50 elementor-field-required">
                                                <label for="form-field-email_jobs_form" class="elementor-field-label">
                                                    Email </label>
                                                <input size="1" type="email" name="form_fields[email_jobs_form]" id="form-field-email_jobs_form" class="elementor-field elementor-size-sm  elementor-field-textual" placeholder="e.g. john@youremail.com" required="required">
                                            </div>
                                            <div class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-cover_letter_jobs_form elementor-col-100 elementor-field-required">
                                                <label for="form-field-cover_letter_jobs_form" class="elementor-field-label">
                                                    Cover letter </label>
                                                <textarea class="elementor-field-textual elementor-field  elementor-size-sm" name="form_fields[cover_letter_jobs_form]" id="form-field-cover_letter_jobs_form" rows="3" placeholder="Type here" required="required"></textarea>
                                            </div>
                                            <div class="elementor-field-type-upload elementor-field-group elementor-column elementor-field-group-field_02ddb69 elementor-col-100 elementor-field-required">
                                                <label for="form-field-field_02ddb69" class="elementor-field-label">
                                                    Upload CV (pdf, .doc, .docx) </label>
                                                <input type="file" name="form_fields[field_02ddb69][]" id="form-field-field_02ddb69" class="elementor-field elementor-size-sm  elementor-upload-field" required="required" multiple="multiple" data-maxsize="5" data-maxsize-message="This file exceeds the maximum allowed size.">

                                            </div>
                                            <div class="elementor-field-type-hidden elementor-field-group elementor-column elementor-field-group-field_54aa274 elementor-col-100">
                                                <input size="1" type="hidden" name="form_fields[field_54aa274]" id="form-field-field_54aa274" class="elementor-field elementor-size-sm  elementor-field-textual">
                                            </div>
                                            <div class="elementor-field-type-text">
                                                <input size="1" type="text" name="form_fields[field_40c0e23]" id="form-field-field_40c0e23" class="elementor-field elementor-size-sm " style="display:none !important;">
                                            </div>
                                            <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                                                <button class="elementor-button elementor-size-sm" type="submit">
                                                    <span class="elementor-button-content-wrapper">
                                                        <span class="elementor-button-text">Submit</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-7c9b113 e-con-full e-flex e-con e-child" data-id="7c9b113" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                        </div>
                    </div>
                </div> -->
        </div>
    </article>
@endsection

@push('styles')
    <link rel='stylesheet' id='elementor-post-5832-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-5832.css") }}?ver=1752678329' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-142-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-142.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-1007-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-1007.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-6790-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-6790.css") }}?ver=1752677976' type='text/css' media='all'>
    <link rel='stylesheet' id='elementor-post-156-css'
        href='{{ asset("wp-content/uploads/elementor/css/post-156.css") }}?ver=1752677977' type='text/css' media='all'>
@endpush
