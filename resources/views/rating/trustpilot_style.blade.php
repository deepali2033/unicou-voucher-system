@extends('layouts.app')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@section('content')
    <style>
        .logo-box {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: linear-gradient(135deg, #ff7eb3, #ffb74d);
            display: table;
            text-align: center;
        }

        .logo-box span {
            display: table-cell;
            vertical-align: middle;
            font-weight: bold;
            color: white;
            font-size: 20px;
        }


        .star-bar {
            height: 6px;
            background: #e2e2e2;
            border-radius: 4px;
        }

        .star-fill {
            height: 6px;
            border-radius: 4px;
            background: #3CA200;
        }


        .review-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            background: white;
        }


        .info-box {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #e1e1e1;
        }

        .logo-box {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: linear-gradient(135deg, #ff7eb3, #ffb74d);
            display: table;
            text-align: center;
        }

        .logo-box span {
            display: table-cell;
            vertical-align: middle;
            font-weight: bold;
            color: white;
            font-size: 20px;
        }


        .star-bar {
            height: 6px;
            background: #e2e2e2;
            border-radius: 4px;
        }

        .star-fill {
            height: 6px;
            border-radius: 4px;
            background: #3CA200;
        }


        .review-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            background: white;
        }


        .info-box {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #e1e1e1;
        }

        .reviews-section {
            /* max-width: 600px; */
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            padding: 20px;
            font-family: "Inter", Arial, sans-serif;
            color: #222;
            display: flex;
            flex-direction: column;
        }

        /* Search Box Styling */
        .search-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #e1e1e1;
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        /* Character Count Styling */
        textarea,
        input[type="text"] {
            margin-bottom: 5px !important;
        }

        .char-count {
            display: block;
            font-size: 13px;
            margin-bottom: 15px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .char-count.not-met {
            color: #d9534f;
        }

        .char-count.met {
            color: #3CA200;
        }

        .char-count strong {
            font-weight: 600;
        }

        .search-box input:focus {
            outline: none;
            border-color: #3CA200;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(60, 162, 0, 0.1);
        }

        .search-box input::placeholder {
            color: #999;
        }

        /* No Results Message */
        .no-results {
            text-align: center;
            padding: 30px 15px;
            color: #999;
            font-size: 14px;
        }

        .no-results strong {
            color: #666;
            display: block;
            margin-bottom: 5px;
        }

        /* Character counter styling */
        small[style*="color: #666"] {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            transition: color 0.3s ease;
        }

        .removed {
            background-color: #fff5f5;
            color: #d9534f;
            border-left: 4px solid #d9534f;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 4px;
            font-size: 14px;
        }

        .removed .link {
            color: #d9534f;
            text-decoration: underline;
        }

        .review-card {
            border-bottom: 1px solid #eee;
            padding: 20px;
            margin-bottom: 10px;
            order: 0;
            transition: opacity 0.3s ease, transform 0.2s ease;
        }

        .review-card:hover {
            background-color: #f9f9f9;
            transform: translateX(2px);
        }

        .review-card:last-child {
            border-bottom: none;
        }

        .review-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3CA200;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #ffffffff;
        }

        .user-name {
            font-weight: 600;
        }

        .review-meta {
            font-size: 12px;
            color: #888;
        }

        .stars {
            color: #3CA200;
            font-size: 18px;
        }

        .review-title {
            font-weight: 600;
            margin: 5px 0;
        }

        .review-text {
            font-size: 14px;
            color: #444;
            margin-bottom: 8px;
        }

        .review-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #777;
        }

        .review-actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            background: none;
            border: none;
            color: #3CA200;
            cursor: pointer;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .btn:hover {
            color: #008f60;
        }


        /* Button to open popup */
        .open-popup-btn {
            display: block;
            margin: 100px auto;
            background-color: #3CA200;
            color: #fff;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .open-popup-btn:hover {
            background-color: #009b68;
        }

        /* Popup background */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        /* Fix for dropdown clipping in Elementor header */
        .elementor-element-4136286,
        .elementor-element-a11d4f7 {
            overflow: visible !important;
        }

        /* Header dropdown - don't touch, let it work normally */

        /* Popup box */
        .popup-box {
            background: #fff;
            padding: 25px 30px;
            border-radius: 8px;
            width: 400px;
            max-width: 95%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .popup-box h3 {
            margin-top: 0;
            color: #222;
            font-size: 18px;
        }

        .close-btn {
            position: absolute;
            top: 12px;
            right: 15px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #888;
        }

        .stars {
            display: flex;
            gap: 5px;
            margin-bottom: 15px;
        }

        .star {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star.active {
            color: #3CA200;
        }

        textarea,
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-family: inherit;
            font-size: 14px;
        }

        textarea {
            height: 90px;
            resize: none;
        }

        .submit-btn {
            width: 100%;
            background-color: #0052cc;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .submit-btn:hover {
            background-color: #003d99;
        }

        .info {
            font-size: 12px;
            color: #666;
            line-height: 1.4;
        }

        .info a {
            color: #0052cc;
        }

        .review-summary {
            background: #f9fafb;
            border: 1px solid #e3e6e9;
            border-radius: 8px;
            padding: 20px;
            /* max-width: 700px; */
            margin: 30px auto;
            font-family: "Inter", Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .review-summary h2 {
            font-size: 20px;
            margin-bottom: 8px;
            color: #111;
        }

        .review-summary .ai-note {
            color: #666;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .review-summary p {
            margin-bottom: 12px;
        }

        .review-summary strong {
            color: #3CA200;
        }

        .container {
            margin-top: 6rem !important;
        }

        .review-summary .see-more {
            color: #0052cc;
            font-size: 13px;
            text-decoration: none;
        }

        .review-summary .see-more:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }

            .col-md-8,
            .col-md-4 {
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }

            .container {
                margin-top: 2rem !important;
                padding: 15px !important;
            }

            .review-card {
                padding: 12px !important;
                margin-bottom: 15px !important;
            }

            /* Make sticky card unscrollable on mobile for better UX */
            div[style*="position: sticky"] {
                position: relative !important;
                top: 0 !important;
            }

            .review-summary {
                margin: 20px auto !important;
            }

            h2 {
                font-size: 1.5rem;
            }

            .avatar {
                width: 40px !important;
                height: 40px !important;
                font-size: 14px !important;
            }

            .stars {
                font-size: 16px;
            }

            .review-text {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {


            .d-flex {
                flex-wrap: wrap;
            }

            .col-md-4 {
                flex-basis: 100%;
                margin-bottom: 15px;
            }

            .review-card {
                padding: 10px !important;
            }

            .p-3 {
                padding: 15px !important;
            }

            .star-bar {
                margin: 5px 0;
            }

            h4 {
                font-size: 16px;
            }

            .fw-bold {
                font-size: 14px;
            }

            .review-summary {
                padding: 15px !important;
            }
        }
    </style>


    <div class="container my-4 p-4 bg-white rounded shadow">


        <!-- Grid 2 Column Layout -->
        <div class="row g-4">


            <!-- Left Section -->
            <div class="col-lg-8">


                <div class="row g-3">
                    {{-- <div class="col-auto">
                        <div class="logo-box"><span><img src="/images/company_logo.png"></span></div>
                    </div> --}}
                    <div class="col">
                        <h2 class="fw-bold m-0">KOA Service</h2>
                        <small>House cleaning service</small>
                        <div class="mt-2">
                            <span class="text-muted"><a href="#all-reviews">Reviews
                                    {{ number_format($totalRatings) }}</a> </span>
                            @for($i = 0; $i < floor($averageRating); $i++)
                                ⭐
                            @endfor
                            @if($averageRating - floor($averageRating) >= 0.5)
                                ⭐
                                @for($i = ceil($averageRating); $i < 5; $i++)
                                    ☆
                                @endfor
                            @else
                                @for($i = floor($averageRating); $i < 5; $i++)
                                    ☆
                                @endfor
                            @endif
                            <strong>{{ number_format($averageRating, 1) }}</strong>
                        </div>

                        <div class="elementor-element btn-center elementor-element-7a5f5f2 e-con-full animated-fast e-flex e-con e-child animated fadeInDown"
                            data-id="7a5f5f2" data-element_type="container"
                            data-settings="{&quot;animation&quot;:&quot;fadeInDown&quot;,&quot;animation_delay&quot;:300}"
                            style="display: flex;
                                                            flex-direction: row;
                                                            padding: 0;
                                                            margin-top: 15px;">
                            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-c34e4c2 vamtam-has-hover-anim elementor-widget elementor-widget-button"
                                data-id="c34e4c2" data-element_type="widget" data-widget_type="button.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm"
                                            href="javascript:void(0)" onclick="openReviewPopup()">
                                            <span class="elementor-button-content-wrapper">

                                                <span class="vamtam-btn-text-wrap"><span
                                                        class="elementor-button-text vamtam-btn-text">Write a
                                                        review</span><span
                                                        class="elementor-button-text vamtam-btn-text-abs">Write a
                                                        review</span></span></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-cd67bad vamtam-has-hover-anim elementor-widget elementor-widget-button"
                                data-id="cd67bad" data-element_type="widget" data-widget_type="button.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-button-wrapper">
                                        <a class="elementor-button elementor-button-link elementor-size-sm"
                                            href="{{ route('home') }}">
                                            <span class="elementor-button-content-wrapper">

                                                <span class="vamtam-btn-text-wrap"><span
                                                        class="elementor-button-text vamtam-btn-text">Visit
                                                        Website</span><span
                                                        class="elementor-button-text vamtam-btn-text-abs">Visit
                                                        Website</span></span></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="review-summary">
                    <h2>⭐ Review Summary</h2>
                    <p class="ai-note">Based on customer feedback.</p>

                    <p>
                        Customers frequently praise <strong>KOA Services</strong> for its professionalism,
                        reliability, and exceptional quality of work. Many highlight the easy booking
                        process and clear communication throughout each project.
                    </p>

                    <p>
                        Reviewers often mention the <strong>efficiency and attention to detail</strong> of
                        the KOA team, noting how flexible scheduling and friendly support make every
                        experience stress-free. Overall, feedback remains highly positive due to the
                        company’s excellent customer service and dedication to satisfaction.
                    </p>

                    {{-- <a href="#" class="see-more">See less</a> --}}
                </section>
                <!-- Include Carousel Component -->
                @include('rating.recent_reviews_carousel')




                <section class="reviews-section" id="all-reviews">
                    <div class="mb-4">
                        <div class="search-box">
                            <input type="text" id="searchReviews" placeholder="Search by reviewer name..."
                                oninput="filterReviewsByName()" />
                        </div>
                    </div>
                    <!-- Dynamic Reviews from Database -->
                    @if($reviews->count() > 0)
                        @foreach($reviews as $review)
                            <div class="review-card" data-reviewer-name="{{ strtolower($review->rater->name ?? 'anonymous') }}">
                                <div class="review-header">
                                    <div class="user-info">
                                        <div class="avatar">
                                            {{ substr($review->rater->name ?? 'User', 0, 1) }}{{ substr(explode(' ', $review->rater->name ?? 'User')[1] ?? '', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="user-name">{{ $review->rater->name ?? 'Anonymous' }}</div>
                                            <div class="review-meta">{{ $review->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <div class="stars">
                                        @for($i = 0; $i < $review->stars; $i++)
                                            ★
                                        @endfor
                                        @for($i = $review->stars; $i < 5; $i++)
                                            ☆
                                        @endfor
                                    </div>
                                </div>
                                @if($review->review_title)
                                    <div class="review-title">{{ $review->review_title }}</div>
                                @endif
                                <div class="review-text">{{ $review->review_text }}</div>
                                <div class="review-footer">
                                    <span>{{ $review->experience_date ? $review->experience_date->format('d F Y') : $review->created_at->format('d F Y') }}
                                        • Unprompted review</span>
                                    @auth
                                        @if(Auth::id() === $review->rater_id)
                                            <button class="btn" onclick="deleteReview({{ $review->id }})">Delete</button>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="text-align: center; padding: 40px; color: #999;">
                            <p>No reviews yet. Be the first to write a review!</p>
                        </div>
                    @endif

                    <!-- Pagination Controls -->
                    @if($reviews->hasPages())
                        <div
                            style="display: flex; justify-content: center; gap: 10px; margin-top: 30px; padding: 20px 0; flex-wrap: wrap;">
                            <!-- Previous Button -->
                            @if($reviews->onFirstPage())
                                <span style="padding: 8px 12px; color: #999;">← Previous</span>
                            @else
                                <a href="{{ $reviews->previousPageUrl() }}"
                                    style="padding: 8px 12px; background: #f0f0f0; border-radius: 4px; text-decoration: none; color: #333;">←
                                    Previous</a>
                            @endif

                            <!-- Page Numbers -->
                            @for($i = 1; $i <= $reviews->lastPage(); $i++)
                                @if($i == $reviews->currentPage())
                                    <span
                                        style="padding: 8px 12px; background: #3CA200; color: white; border-radius: 4px; font-weight: bold;">{{ $i }}</span>
                                @else
                                    <a href="{{ $reviews->url($i) }}"
                                        style="padding: 8px 12px; background: #f0f0f0; border-radius: 4px; text-decoration: none; color: #333; transition: all 0.2s ease;"
                                        onmouseover="this.style.background='#e0e0e0'"
                                        onmouseout="this.style.background='#f0f0f0'">{{ $i }}</a>
                                @endif
                            @endfor

                            <!-- Next Button -->
                            @if($reviews->hasMorePages())
                                <a href="{{ $reviews->nextPageUrl() }}"
                                    style="padding: 8px 12px; background: #f0f0f0; border-radius: 4px; text-decoration: none; color: #333;">Next
                                    →</a>
                            @else
                                <span style="padding: 8px 12px; color: #999;">Next →</span>
                            @endif
                        </div>
                    @endif

                </section>


            </div>


            <!-- Right Side Card - Sticky -->
            <div class="col-lg-4">
                <div class="p-3 border rounded bg-light d-flex  gap-3"
                    style="position: sticky; top: 100px; max-height: fit-content;">
                    <div class="col-4">
                        <h2 class="fw-bold">{{ number_format($averageRating, 1) }}</h2>
                        <strong>
                            @if($averageRating >= 4.5)
                                Excellent
                            @elseif($averageRating >= 3.5)
                                Great
                            @elseif($averageRating >= 2.5)
                                Good
                            @else
                                Fair
                            @endif
                        </strong><br>
                        <p>
                            @for($i = 0; $i < floor($averageRating); $i++)
                                ⭐
                            @endfor
                            @if($averageRating - floor($averageRating) >= 0.5)
                                ⭐
                                @for($i = ceil($averageRating); $i < 5; $i++)
                                    ☆
                                @endfor
                            @else
                                @for($i = floor($averageRating); $i < 5; $i++)
                                    ☆
                                @endfor
                            @endif
                        </p>
                        <span>{{ number_format($totalRatings) }} {{ $totalRatings === 1 ? 'review' : 'reviews' }}</span>
                    </div>

                    <!-- Dynamic Star Percentage Bars -->
                    <div class="mt-2 col-7">
                        <div class="mb-2">5 ★<div class="star-bar">
                                <div class="star-fill" style="width: {{ $starPercentages[5] ?? 0 }}%"></div>
                            </div>
                            {{-- <small class="text-muted">{{ $starPercentages[5] ?? 0 }}%</small> --}}
                        </div>
                        <div class="mb-2">4 ★<div class="star-bar">
                                <div class="star-fill" style="width: {{ $starPercentages[4] ?? 0 }}%"></div>
                            </div>
                            {{-- <small class="text-muted">{{ $starPercentages[4] ?? 0 }}%</small> --}}
                        </div>
                        <div class="mb-2">3 ★<div class="star-bar">
                                <div class="star-fill" style="width: {{ $starPercentages[3] ?? 0 }}%"></div>
                            </div>
                            {{-- <small class="text-muted">{{ $starPercentages[3] ?? 0 }}%</small> --}}
                        </div>
                        <div class="mb-2">2 ★<div class="star-bar">
                                <div class="star-fill" style="width: {{ $starPercentages[2] ?? 0 }}%"></div>
                            </div>
                            {{-- <small class="text-muted">{{ $starPercentages[2] ?? 0 }}%</small> --}}
                        </div>
                        <div class="mb-2">1 ★<div class="star-bar">
                                <div class="star-fill" style="width: {{ $starPercentages[1] ?? 0 }}%"></div>
                            </div>
                            {{-- <small class="text-muted">{{ $starPercentages[1] ?? 0 }}%</small> --}}
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

    <!-- Review Popup -->
    <div id="reviewPopup" class="popup-overlay">
        <div class="popup-box">
            <button class="close-btn" onclick="closeReviewPopup()">×</button>
            <h3>Rate your recent experience</h3>

            <div class="stars" id="starRating">
                <span class="star" onclick="setRating(1)">★</span>
                <span class="star" onclick="setRating(2)">★</span>
                <span class="star" onclick="setRating(3)">★</span>
                <span class="star" onclick="setRating(4)">★</span>
                <span class="star" onclick="setRating(5)">★</span>
            </div>

            <label style="display: block; margin-bottom: 10px; font-weight: 500;">Tell us more about your
                experience</label>
            <textarea id="reviewText" placeholder="Tell us more about your experience..."
                oninput="updateCharCount('reviewText', 'textCount')"></textarea>
            <small class="char-count not-met" id="textCountLabel">
                ✎ Minimum <strong>10 characters</strong> required • <span id="textCount">0</span>/<strong>10</strong>
            </small>

            <label style="display: block; margin-bottom: 10px; font-weight: 500;">Date of experience</label>
            <input type="date" id="experienceDate" />

            <label style="display: block; margin-bottom: 10px; font-weight: 500;">Give your review a title</label>
            <input type="text" id="reviewTitle" placeholder="Share your experience in a few words"
                oninput="updateCharCount('reviewTitle', 'titleCount')" />
            <small class="char-count not-met" id="titleCountLabel">
                ✎ Minimum <strong>5 characters</strong> required • <span id="titleCount">0</span>/<strong>5</strong>
            </small>

            <button class="submit-btn" onclick="submitReview()">Submit updated review</button>

            <div class="info" style="margin-top: 15px;">
                <a href="#">Read our Guidelines for Reviewers</a><br>
                <span>How to write a useful review</span>
            </div>
        </div>
    </div>

    <script>
        let currentRating = 0;
        const isAuthenticated = @json(auth()->check());
        let editingReviewId = null;

        // Update character count display
        function updateCharCount(fieldId, countId) {
            const field = document.getElementById(fieldId);
            const countSpan = document.getElementById(countId);
            const labelId = fieldId === 'reviewText' ? 'textCountLabel' : 'titleCountLabel';
            const label = document.getElementById(labelId);
            const length = field.value.length;
            const minLength = fieldId === 'reviewText' ? 10 : 5;

            // Show character count
            countSpan.textContent = length;

            // Update CSS class based on requirements
            if (length >= minLength) {
                label.classList.remove('not-met');
                label.classList.add('met');
            } else {
                label.classList.remove('met');
                label.classList.add('not-met');
            }
        }

        // Filter reviews by reviewer name
        function filterReviewsByName() {
            const searchInput = document.getElementById('searchReviews').value.toLowerCase().trim();
            const reviewCards = document.querySelectorAll('.review-card[data-reviewer-name]');
            const reviewsSection = document.querySelector('.reviews-section');

            // Remove any existing "no results" message
            const existingNoResults = document.querySelector('.no-results');
            if (existingNoResults) {
                existingNoResults.remove();
            }

            if (!searchInput) {
                // Show all reviews if search is empty
                reviewCards.forEach(card => {
                    card.style.display = '';
                    card.style.order = '';
                });
                return;
            }

            // Create array to sort matching reviews
            const matchingReviews = [];
            const nonMatchingReviews = [];

            reviewCards.forEach(card => {
                const reviewerName = card.getAttribute('data-reviewer-name');

                if (reviewerName.includes(searchInput)) {
                    matchingReviews.push({
                        name: reviewerName,
                        element: card,
                        matchIndex: reviewerName.indexOf(searchInput)
                    });
                } else {
                    nonMatchingReviews.push(card);
                }
            });

            // Sort matching reviews - first by match position, then alphabetically
            matchingReviews.sort((a, b) => {
                if (a.matchIndex !== b.matchIndex) {
                    return a.matchIndex - b.matchIndex;
                }
                return a.name.localeCompare(b.name);
            });

            // Show matching reviews first, hide others
            let order = 0;
            matchingReviews.forEach(item => {
                item.element.style.display = '';
                item.element.style.order = order++;
            });

            nonMatchingReviews.forEach(card => {
                card.style.display = 'none';
            });

            // Show "no results" message if nothing matched
            if (matchingReviews.length === 0 && reviewsSection) {
                const noResultsDiv = document.createElement('div');
                noResultsDiv.className = 'no-results';
                noResultsDiv.innerHTML = `<strong>No reviews found</strong><br>Try searching for a different name`;
                reviewsSection.appendChild(noResultsDiv);
            }
        }

        function openReviewPopup() {
            // Check if user is authenticated
            if (!isAuthenticated) {
                // Redirect to login with return URL
                const currentUrl = window.location.href;
                const loginUrl = "{{ route('login') }}?redirect=" + encodeURIComponent(currentUrl);
                window.location.href = loginUrl;
                return;
            }

            // Check if user already has a review
            fetch('/reviews/user-review', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.review) {
                        // Load existing review for editing
                        editingReviewId = data.review.id;
                        document.getElementById('reviewTitle').value = data.review.review_title || '';
                        document.getElementById('reviewText').value = data.review.review_text || '';
                        document.getElementById('experienceDate').value = data.review.experience_date ? data.review.experience_date.split(' ')[0] : '';

                        // Set the rating
                        setRating(data.review.stars);
                        updateCharCount('reviewText', 'textCount');
                        updateCharCount('reviewTitle', 'titleCount');

                        // Update button text
                        const submitBtn = document.querySelector('.submit-btn');
                        submitBtn.textContent = 'Update Review';
                    } else {
                        // New review
                        editingReviewId = null;
                        resetForm();
                        const submitBtn = document.querySelector('.submit-btn');
                        submitBtn.textContent = 'Submit Review';
                    }
                    document.getElementById('reviewPopup').style.display = 'flex';
                })
                .catch(error => {
                    console.error('Error checking review:', error);
                    // On error, treat as new review
                    editingReviewId = null;
                    resetForm();
                    document.getElementById('reviewPopup').style.display = 'flex';
                });
        }

        function closeReviewPopup() {
            document.getElementById('reviewPopup').style.display = 'none';
            resetForm();
        }

        function setRating(rating) {
            currentRating = rating;
            const stars = document.querySelectorAll('#starRating .star');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        function submitReview() {
            const text = document.getElementById('reviewText').value;
            const date = document.getElementById('experienceDate').value;
            const title = document.getElementById('reviewTitle').value;

            if (!text || !date || !title || currentRating === 0) {
                toastr.error('Please fill in all fields and select a rating');
                return;
            }

            // Disable submit button
            const submitBtn = document.querySelector('.submit-btn');
            submitBtn.disabled = true;
            const originalText = submitBtn.textContent;
            submitBtn.textContent = editingReviewId ? 'Updating...' : 'Submitting...';

            // Prepare the endpoint and method
            const endpoint = editingReviewId ? `/reviews/${editingReviewId}` : '/reviews/submit';
            const method = editingReviewId ? 'PUT' : 'POST';

            // Send to backend via AJAX
            fetch(endpoint, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    stars: currentRating,
                    review_text: text,
                    review_title: title,
                    experience_date: date
                })
            })
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json().then(data => {
                        console.log('Response data:', data);
                        return { status: response.status, data: data };
                    }).catch(err => {
                        console.error('Failed to parse JSON:', err);
                        throw new Error('Invalid JSON response');
                    });
                })
                .then(({ status, data }) => {
                    if (data.success) {
                        const message = editingReviewId ? 'Review updated successfully!' : 'Review submitted successfully!';
                        toastr.success(message);
                        closeReviewPopup();
                        // Reload page after 1 second to show updated review
                        setTimeout(() => location.reload(), 1000);
                    } else if (data.requires_login) {
                        // Redirect to login page
                        toastr.error('Please log in to submit a review');
                        window.location.href = data.redirect_url + '?redirect=' + encodeURIComponent(window.location.href);
                    } else if (data.errors) {
                        // Show validation errors as toast
                        for (let field in data.errors) {
                            toastr.error(data.errors[field][0]);
                        }
                    } else {
                        toastr.error(data.message || 'Unknown error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('Error submitting review: ' + error.message);
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                });
        }

        function resetForm() {
            document.getElementById('reviewText').value = '';
            document.getElementById('experienceDate').value = '';
            document.getElementById('reviewTitle').value = '';
            currentRating = 0;
            document.querySelectorAll('#starRating .star').forEach(star => {
                star.classList.remove('active');
            });
        }

        // Close popup when clicking outside
        document.getElementById('reviewPopup').addEventListener('click', function (event) {
            if (event.target === this) {
                closeReviewPopup();
            }
        });

        // Delete review function
        function deleteReview(reviewId) {
            if (confirm('Are you sure you want to delete this review?')) {
                performDelete(reviewId);
            }
        }

        function performDelete(reviewId) {
            fetch(`/reviews/${reviewId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success('Review deleted successfully');
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        toastr.error(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('Error deleting review. Please try again.');
                });
        }

        // Reload page after successful review submission to show new review
        window.addEventListener('popstate', function () {
            location.reload();
        });
    </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Initialize Bootstrap dropdowns for header
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownToggle = document.querySelector('.dropdown-toggle');
            if (dropdownToggle) {
                new bootstrap.Dropdown(dropdownToggle);
            }
        });
    </script>
@endsection

