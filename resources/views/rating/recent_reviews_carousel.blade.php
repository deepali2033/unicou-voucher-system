<!-- Recent Reviews Carousel Component -->
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<section class="container my-5">
    <h4 class="fw-bold mb-4">⭐ Recent Reviews</h4>

    @if($recentReviews->count() > 0)
        <div style="position: relative;">
            <!-- Carousel Container -->
            <div id="reviewCarousel"
                style="display: flex; gap: 24px; overflow-x: auto; scroll-behavior: smooth; padding-bottom: 20px; margin-bottom: -20px; overflow-y: hidden; scrollbar-width: none;">
                @foreach($recentReviews as $review)
                    <div class="review-carousel-card" style="flex: 0 0 calc(33.333% - 16px); min-width: 300px;">
                        <div class="card h-100" style="border: 1px solid #e0e0e0; border-radius: 10px; overflow: hidden;">
                            <div class="card-body" style="padding: 20px; display: flex; flex-direction: column;">
                                <!-- User Header -->
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar"
                                        style="width: 45px; height: 45px; border-radius: 50%; background: #3CA200; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 16px; flex-shrink: 0;">
                                        {{ substr($review->rater->name ?? 'User', 0, 1) }}{{ substr(explode(' ', $review->rater->name ?? 'User')[1] ?? '', 0, 1) }}
                                    </div>
                                    <div class="ms-3" style="flex: 1;">
                                        <div class="fw-bold small" style="color: #333; font-size: 14px;">
                                            {{ $review->rater->name ?? 'Anonymous' }}
                                        </div>
                                        <div class="text-muted small" style="font-size: 12px;">
                                            {{ $review->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Star Rating -->
                                <div class="mb-2" style="font-size: 18px; letter-spacing: 2px; color: #ffc107;">
                                    @for($i = 0; $i < $review->stars; $i++)
                                        ★
                                    @endfor
                                    @for($i = $review->stars; $i < 5; $i++)
                                        ☆
                                    @endfor
                                </div>

                                <!-- Review Title -->
                                @if($review->review_title)
                                    <div class="fw-bold mb-2" style="font-size: 14px; color: #333;">{{ $review->review_title }}
                                    </div>
                                @endif

                                <!-- Review Text (Truncated) -->
                                <p class="text-muted mb-auto" style="font-size: 13px; line-height: 1.5; flex-grow: 1;">
                                    {{ Str::limit($review->review_text, 100, '...') }}
                                </p>

                                <!-- Date Footer -->
                                <div class="text-muted small mt-3"
                                    style="font-size: 11px; padding-top: 12px; border-top: 1px solid #f0f0f0;">
                                    {{ $review->experience_date ? $review->experience_date->format('M d, Y') : $review->created_at->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Buttons -->
            <button id="prevBtn"
                style="position:  absolute; padding: 0 !important; left: -14px; top: 50%; transform: translateY(-50%); background: #ffdb00; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: all 0.3s ease; font-size: 14px; font-weight: bold; color: #333; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="nextBtn"
                style="position: absolute; right: -21px; top: 50%; transform: translateY(-50%); background: #ffdb00; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10; transition: all 0.3s ease;padding:0 !important; font-size: 14px; font-weight: bold; color: #333; box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <style>
            #reviewCarousel {
                scroll-behavior: smooth;
                cursor: grab;
                user-select: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
            }

            #reviewCarousel.grabbing {
                cursor: grabbing;
            }

            #reviewCarousel::-webkit-scrollbar {
                height: 6px;
            }

            #reviewCarousel::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            #reviewCarousel::-webkit-scrollbar-thumb {
                background: #ffdb00;
                border-radius: 10px;
            }

            #reviewCarousel::-webkit-scrollbar-thumb:hover {
                background: #ffc800;
            }

            .review-carousel-card {
                animation: fadeIn 0.5s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            #prevBtn:hover,
            #nextBtn:hover {
                background: #ffc800;
                box-shadow: 0 4px 12px rgba(255, 219, 0, 0.4);
                transform: translateY(-50%) scale(1.1);
            }

            /* Responsive: 2 columns on tablet */
            @media (max-width: 992px) {
                .review-carousel-card {
                    flex: 0 0 calc(50% - 12px) !important;
                    min-width: 250px !important;
                }
            }

            /* Responsive: 1 column on mobile */
            @media (max-width: 576px) {
                .review-carousel-card {
                    flex: 0 0 100% !important;
                    min-width: 100% !important;
                }

                button[onclick*="scrollCarousel"] {
                    display: none !important;
                }

                #reviewCarousel {
                    gap: 16px;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const carousel = document.getElementById('reviewCarousel');
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');

                // Button click handlers
                prevBtn.addEventListener('click', function () {
                    carousel.scrollBy({
                        left: -350,
                        behavior: 'smooth'
                    });
                });

                nextBtn.addEventListener('click', function () {
                    carousel.scrollBy({
                        left: 350,
                        behavior: 'smooth'
                    });
                });

                // Mouse drag functionality
                let isDown = false;
                let startX;
                let scrollLeft;

                carousel.addEventListener('mousedown', function (e) {
                    isDown = true;
                    startX = e.pageX - carousel.offsetLeft;
                    scrollLeft = carousel.scrollLeft;
                    carousel.style.cursor = 'grabbing';
                });

                carousel.addEventListener('mouseleave', function () {
                    isDown = false;
                    carousel.style.cursor = 'grab';
                });

                carousel.addEventListener('mouseup', function () {
                    isDown = false;
                    carousel.style.cursor = 'grab';
                });

                carousel.addEventListener('mousemove', function (e) {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - carousel.offsetLeft;
                    const walk = (x - startX) * 1.5;
                    carousel.scrollLeft = scrollLeft - walk;
                });

                // Touch swipe functionality
                let touchStartX = 0;
                let touchScrollLeft = 0;

                carousel.addEventListener('touchstart', function (e) {
                    touchStartX = e.touches[0].clientX;
                    touchScrollLeft = carousel.scrollLeft;
                }, false);

                carousel.addEventListener('touchmove', function (e) {
                    if (!touchStartX) return;
                    const touchX = e.touches[0].clientX;
                    const walk = (touchStartX - touchX) * 1.5;
                    carousel.scrollLeft = touchScrollLeft + walk;
                }, false);

                carousel.addEventListener('touchend', function () {
                    touchStartX = 0;
                }, false);
            });
        </script>
    @else
        <div style="text-align: center; padding: 60px 20px; background: #f9fafb; border-radius: 10px;">
            <p style="font-size: 16px; color: #999; margin: 0;">
                Be the first to write a review! 🌟
            </p>
        </div>
    @endif
</section>