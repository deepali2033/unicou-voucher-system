<style>
    .review-section {
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
        display: flex;
        gap: 15px;
        align-items: flex-start;
    }

    .swiper-button-prev i,
    .swiper-button-next i {
        font-size: 10px !important;
    }

    .review-left {
        flex: 0 0 28%;
    }

    .review-right {
        flex: 1;
        position: relative;
    }

    .review-header {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .review-header h2 {
        font-size: 1.8rem;
        margin: 0;
        color: #333;
        font-weight: 700;
    }

    .review-subtext {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.6;
        margin: 0;
    }

    .trustpilot {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .stars {
        display: flex;
        gap: 4px;
    }

    .star {
        width: 22px;
        height: 22px;
        background: #ffdb00;
        clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
    }

    .star.gray {
        background: #ddd;
    }

    .trustpilot span {
        font-size: 0.9rem;
        color: #666;
    }

    .trustpilot a {
        color: #252524ff;
        text-decoration: underline;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .swiper-button-prev,
    .swiper-button-next {
        width: 25px !important;
        height: 25px !important;
    }

    .trustpilot a:hover {
        color: #585858ff;
    }

    /* Swiper Styles */
    .review-swiper-wrapper {
        position: relative;
    }

    .swiper {
        width: 100%;
        padding: 0;
    }

    .swiper-wrapper {
        margin: 0;
        display: flex;
    }

    .swiper-slide {
        background: #f9f9f9;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: auto;
        flex-shrink: 0 !important;
        width: calc(33.333% - 14px) !important;
    }

    /* Responsive slide widths */
    @media (max-width: 1024px) {
        .swiper-slide {
            width: calc(50% - 10px) !important;
        }
    }

    @media (max-width: 500px) {
        .swiper-slide {
            width: calc(100% - 5px) !important;
        }
    }

    .swiper-slide:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .review-title {
        font-weight: bold;
        font-size: 1rem;
        margin-bottom: 10px;
        color: #333;
    }

    .review-text {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 12px;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
    }

    .review-footer {
        font-size: 0.75rem;
        color: #999;
        margin-bottom: 10px;
    }

    .review-stars {
        display: flex;
        gap: 3px;
    }

    .review-stars span {
        color: #ffdb00;
        font-size: 13px;
    }

    /* Navigation Buttons - Styled Circles */
    .swiper-button-prev,
    .swiper-button-next {
        width: 45px;
        height: 45px;
        background: #ffdb00;
        border-radius: 50%;
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 100 !important;
        border: none;
        padding: 0;
        font-size: 20px;
        font-weight: bold;
        box-shadow: 0 4px 12px rgba(255, 219, 0, 0.3);
    }

    .swiper-button-prev:hover,
    .swiper-button-next:hover {
        background: #ffed4e;
        box-shadow: 0 6px 16px rgba(255, 219, 0, 0.5);
        transform: translateY(-50%) scale(1.15);
    }

    .swiper-button-prev {
        left: 15px;
    }

    .swiper-button-next {
        right: 15px;
    }

    .swiper-button-prev::after,
    .swiper-button-next::after {
        content: '';
    }

    .swiper-button-prev i,
    .swiper-button-next i {
        font-size: 20px;
        font-weight: bold;
    }

    /* Pagination Dots - Array Style */
    .swiper-pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 25px;
        padding: 0;
    }

    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: #ddd;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 1;
        margin: 0;
    }

    .swiper-pagination-bullet-active {
        background: #ffdb00;
        width: 28px;
        border-radius: 5px;
        box-shadow: 0 2px 6px rgba(206, 192, 5, 0.3);
    }

    /* Responsive Design */
    @media (max-width: 1199px) {
        .review-section {
            gap: 40px;
        }

        .swiper-button-prev {
            left: 12px;
        }

        .swiper-button-next {
            right: 12px;
        }
    }

    @media (max-width: 1024px) {
        .review-section {
            gap: 30px;
        }

        .review-left {
            flex: 0 0 30%;
        }

        .swiper-button-prev,
        .swiper-button-next {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .swiper-slide {
            padding: 18px;
        }

        .swiper-button-prev {
            left: 10px;
        }

        .swiper-button-next {
            right: 10px;
        }
    }

    @media (max-width: 768px) {
        .review-section {
            flex-direction: column;
            gap: 30px;
            align-items: center;
        }

        .stars {
            justify-content: center !important;
        }

        .review-left {
            flex: 1;
            width: 40%;
            text-align: center;
        }

        .review-header {
            gap: 0 !important;
        }

        .review-right {
            width: 100%;
        }

        .review-header h2 {
            font-size: 1.6rem;
        }

        .review-subtext {
            font-size: 0.9rem;
        }

        .swiper {
            padding: 0;
        }

        .swiper-slide {
            padding: 15px;
            width: calc(50% - 10px) !important;
        }

        .swiper-button-prev,
        .swiper-button-next {
            width: 38px;
            height: 38px;
            font-size: 16px;
        }

        .swiper-button-prev {
            left: 8px;
        }

        .swiper-button-next {
            right: 8px;
        }

        .review-title {
            font-size: 0.95rem;
        }

        .review-text {
            font-size: 0.85rem;
        }

        .review-footer {
            font-size: 0.7rem;
        }
    }

    @media (max-width: 576px) {
        .review-section {
            padding: 15px;
        }

        .review-header h2 {
            font-size: 1.4rem;
        }

        .swiper {
            padding: 0;
        }

        .swiper-slide {
            padding: 12px;
            width: calc(100% - 5px) !important;
        }

        .swiper-button-prev,
        .swiper-button-next {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .swiper-button-prev {
            left: 6px;
        }

        .swiper-button-next {
            right: 6px;
        }

        .review-title {
            font-size: 0.9rem;
        }

        .review-left {
            width: 90% !important;
        }

        .swiper-pagination-bullet-active {
            width: 24px;
        }
    }
</style>

<section class="review-section">
    <!-- Left Section - Fixed Info -->
    <div class="review-left">
        <div class="review-header">
            <div>
                <h2>
                    @if ($averageRating >= 4)
                        Excellent
                    @elseif ($averageRating >= 3)
                        Good
                    @else
                        Average
                    @endif
                </h2>
                <p class="review-subtext">
                    Our customers love our reliable, friendly, and professional service. Here's what they have to say
                    about their experience with us.
                </p>
            </div>

            <div class="trustpilot">
                <div class="stars">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($averageRating))
                            <div class="star"></div>
                        @elseif ($i - 1 < $averageRating && $averageRating < $i)
                            <div class="star"
                                style="clip-path: polygon(50% 0%, {{ (($averageRating - floor($averageRating)) * 39 + 61) }}% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);">
                            </div>
                        @else
                            <div class="star gray"></div>
                        @endif
                    @endfor
                </div>
                <span><a href="{{ route('rating.index') }}">Based on {{ number_format($totalRatings) }}
                        reviews</a></span>
            </div>
        </div>
    </div>

    <!-- Right Section - Carousel -->
    <div class="review-right">
        <div class="review-swiper-wrapper">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @forelse ($recentReviews as $review)
                        <div class="swiper-slide">
                            <div class="review-title">{{ $review->review_title }}</div>
                            <div class="review-text">
                                {{ Str::limit($review->review_text, 150) }}
                            </div>
                            <div class="review-footer">
                                {{ $review->rater->name ?? 'Customer' }}, {{ $review->created_at->diffForHumans() }}
                            </div>
                            <div class="review-stars">
                                @for ($i = 0; $i < $review->stars; $i++)
                                    <span>★</span>
                                @endfor
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="review-title">No reviews yet</div>
                            <div class="review-text">
                                Be the first to share your experience!
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button class="swiper-button-prev p-0" style="left: -12px;">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="swiper-button-next p-0" style="    right: -12px;">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Pagination -->
            {{-- <div class="swiper-pagination"></div> --}}
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    // Import Mousewheel module for horizontal scroll
    Swiper.use([]);

    const swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            0: { slidesPerView: 1, spaceBetween: 15 },
            500: { slidesPerView: 2, spaceBetween: 18 },
            1024: { slidesPerView: 3, spaceBetween: 20 }
        },
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        mousewheel: {
            forceToAxis: true,
            sensitivity: 0.6
        },
        freeMode: false
    });
</script>