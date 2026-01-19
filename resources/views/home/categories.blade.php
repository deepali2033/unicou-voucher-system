<div class="elementor-element elementor-element-481d486 e-flex e-con-boxed e-con e-parent" data-id="481d486"
    data-element_type="container">
    <div class="e-con-inner"
        style="display: flex; flex-direction: column; align-items: center; text-align: center; gap: 10px; width: 100%;">

        <!-- Icon + Categories services -->
        <div class="elementor-element elementor-element-a10134b elementor-widget elementor-widget-icon-box"
            data-id="a10134b">
            <div class="elementor-widget-container"
                style="display: flex; flex-direction: column; align-items: center; text-align: center; width: 100%;">

                <div class="elementor-icon-box-wrapper"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">

                    <div class="elementor-icon-box-icon" style="display: inline-block;">
                        <!-- <span class="elementor-icon">
                            <i aria-hidden="true" class="vamtamtheme- vamtam-theme-title-dec"></i>
                        </span> -->
                    </div>

                    <div class="elementor-icon-box-content" style="display: inline-block;">
                        <!-- <h5 class="elementor-icon-box-title" style="margin: 0; white-space: nowrap;">
                            Categories services
                        </h5> -->
                    </div>

                </div>
            </div>
        </div>

        <!-- Main Heading -->
        <div class="elementor-element elementor-element-5eeb0f6 elementor-widget elementor-widget-heading"
            data-id="5eeb0f6">
            <div class="elementor-widget-container">
                <span class="elementor-icon" style="font-size: 30px;">
                    <i aria-hidden="true" class="vamtamtheme- vamtam-theme-title-dec"></i>
                </span>
                <h6 style="margin: 0; font-weight: 500;">Categories services</h6>

                <!-- Main heading -->
                <!-- <h4 style="margin: 5px 0 0 0; font-weight: 600;">Services for Simplifying Daily Life</h4> -->
                <h2 class="elementor-heading-title elementor-size-default">Services for Simplifying Daily Life</h2>
            </div>
        </div>

    </div>
</div>





<div class="elementor-element elementor-element-509c5dc e-flex e-con-boxed e-con e-parent" data-id="509c5dc"
    data-element_type="container">
    <div class="e-con-inner">
        @if($categories->count() > 0)
            <div class="categories-scroll-container">
                <button class="scroll-arrow scroll-left" onclick="scrollCategories('left')" style="display: none;">
                    <span>&#8249;</span>
                </button>
                <div class="categories-wrapper" id="categoriesWrapper">
                    @foreach($categories as $index => $category)
                        <div class="services-two elementor-element elementor-element-category-{{ $category->id }} e-con-full animated-fast e-flex elementor-invisible e-con e-child"
                            data-id="category-{{ $category->id }}" data-element_type="container"
                            onclick="window.location='{{ route('domestic-cleaning', ) }}'"
                            data-settings="{&quot;background_background&quot;:&quot;gradient&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;animation_delay&quot;:{{ 200 + ($index * 100) }}}">
                            <div class="elementor-element elementor-element-img-{{ $category->id }} e-con-full vamtam-has-theme-cp vamtam-cp-bottom-right e-flex e-con e-child category-clickable"
                                data-id="img-{{ $category->id }}" data-element_type="container"
                                data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}"
                                data-category-image="{{ $category->Image ? asset($category->Image) : '/images/service/2.png' }}"
                                onclick="openCategoryModal(this)" style="cursor: pointer;">
                                <div class="elementor-element elementor-element-image-{{ $category->id }} animated-fast elementor-widget elementor-widget-image"
                                    data-id="image-{{ $category->id }}" data-element_type="widget"
                                    data-settings="{&quot;_animation&quot;:&quot;none&quot;,&quot;_animation_delay&quot;:{{ 200 + ($index * 100) }}}"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        @if($category->Image)
                                            <img loading="lazy" decoding="async" height="300" src="{{ asset($category->Image) }}"
                                                class="attachment-large size-large category-image" alt="{{ $category->name }}"
                                                style="object-fit: cover;">
                                        @else
                                            <img loading="lazy" decoding="async" height="300" src="/images/service/2.png"
                                                class="attachment-large size-large category-image" alt="{{ $category->name }}"
                                                style="object-fit: cover;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-content-{{ $category->id }} e-con-full e-flex e-con e-child"
                                data-id="content-{{ $category->id }}" data-element_type="container">
                                <div class="elementor-element elementor-element-title-{{ $category->id }} elementor-widget__width-initial elementor-widget-tablet__width-inherit elementor-widget elementor-widget-heading"
                                    data-id="title-{{ $category->id }}" data-element_type="widget"
                                    data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h4 class="elementor-heading-title elementor-size-default">
                                            <span class="category-clickable" data-category-id="{{ $category->id }}"
                                                data-category-name="{{ $category->name }}"
                                                data-category-image="{{ $category->Image ? asset($category->Image) : '/images/service/2.png' }}"
                                                onclick="openCategoryModal(this)"
                                                style="cursor: pointer;">{{ $category->name }}</span>
                                        </h4>
                                        @if($category->description)
                                            <p class="category-description text-muted" style="font-size: 14px; margin-top: 8px;">
                                                {{ Str::limit($category->description, 100) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-78c3ef9 elementor-align-justify vamtam-has-icon-styles vamtam-has-hover-anim elementor-widget elementor-widget-button"
                                    data-id="78c3ef9" data-element_type="widget" data-widget_type="button.default">
                                    <div class="elementor-widget-container">
                                        <!-- <div class="elementor-button-wrapper">
                                                                            <a class="elementor-button elementor-button-link elementor-size-sm" href="/services/householdservices">
                                                                                <span class="elementor-button-content-wrapper">
                                                                                    <span class="elementor-button-icon">
                                                                                        <i aria-hidden="true" class="vamtamtheme- vamtam-theme-arrow-right"></i> </span>
                                                                                    <span class="elementor-button-text">Learn more</span>
                                                                                </span>
                                                                            </a>
                                                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="scroll-arrow scroll-right" onclick="scrollCategories('right')">
                    <span>&#8250;</span>
                </button>
            </div>
        @else
            <!-- Fallback content if no categories exist -->
            <div class="services-two elementor-element elementor-element-dd7ff67 e-con-full animated-fast e-flex elementor-invisible e-con e-child"
                data-id="dd7ff67" data-element_type="container"
                data-settings="{&quot;background_background&quot;:&quot;gradient&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;animation_delay&quot;:200}">
                <a class="elementor-element elementor-element-f0c1d8f e-con-full vamtam-has-theme-cp vamtam-cp-bottom-right e-flex e-con e-child"
                    data-id="f0c1d8f" data-element_type="container" href="/services/householdservices">
                    <div class="elementor-element elementor-element-a4cc9f1 animated-fast elementor-widget elementor-widget-image"
                        data-id="a4cc9f1" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;none&quot;,&quot;_animation_delay&quot;:200}"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img loading="lazy" decoding="async" height="480" src="/images/service/2.png"
                                class="attachment-large size-large wp-image-716" alt="">
                        </div>
                    </div>
                </a>
                <div class="elementor-element elementor-element-b65bc19 e-con-full e-flex e-con e-child" data-id="b65bc19"
                    data-element_type="container">
                    <div class="elementor-element elementor-element-073aead elementor-widget__width-initial elementor-widget-tablet__width-inherit elementor-widget elementor-widget-heading"
                        data-id="073aead" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h4 class="elementor-heading-title elementor-size-default"><a
                                    href="/services/householdservices">Household Services</a></h4>
                        </div>
                    </div>
                    <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-78c3ef9 elementor-align-justify vamtam-has-icon-styles vamtam-has-hover-anim elementor-widget elementor-widget-button"
                        data-id="78c3ef9" data-element_type="widget" data-widget_type="button.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-button-wrapper">
                                <a class="elementor-button elementor-button-link elementor-size-sm"
                                    href="/services/householdservices">
                                    <span class="elementor-button-content-wrapper">
                                        <span class="elementor-button-icon">
                                            <i aria-hidden="true" class="vamtamtheme- vamtam-theme-arrow-right"></i> </span>
                                        <span class="elementor-button-text">Learn more</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-two elementor-element elementor-element-2f2f72a e-con-full animated-fast e-flex elementor-invisible e-con e-child"
                data-id="2f2f72a" data-element_type="container"
                data-settings="{&quot;background_background&quot;:&quot;gradient&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;animation_delay&quot;:300}">
                <a class="elementor-element elementor-element-c27dbf2 e-con-full vamtam-has-theme-cp vamtam-cp-bottom-right e-flex e-con e-child"
                    data-id="c27dbf2" data-element_type="container" href="/services/agencysevices">
                    <div class="elementor-element elementor-element-081dc9c elementor-widget elementor-widget-image"
                        data-id="081dc9c" data-element_type="widget" data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img loading="lazy" decoding="async" width="556" height="480" src="/images/service/1.png"
                                class="attachment-large size-large wp-image-637" alt=""
                                sizes="(max-width: 556px) 100vw, 556px">
                        </div>
                    </div>
                </a>
                <div class="elementor-element elementor-element-52e9fa1 e-con-full e-flex e-con e-child" data-id="52e9fa1"
                    data-element_type="container">
                    <div class="elementor-element elementor-element-3f8f4e7 elementor-widget__width-initial elementor-widget-tablet__width-inherit elementor-widget elementor-widget-heading"
                        data-id="3f8f4e7" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h4 class="elementor-heading-title elementor-size-default"><a href="/services">Job Agency
                                    Services</a></h4>
                        </div>
                    </div>
                    <div class="vamtam-has-theme-widget-styles elementor-element elementor-element-f11eb53 elementor-align-justify vamtam-has-icon-styles vamtam-has-hover-anim elementor-widget elementor-widget-button"
                        data-id="f11eb53" data-element_type="widget" data-widget_type="button.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-button-wrapper">
                                <a class="elementor-button elementor-button-link elementor-size-sm"
                                    href="/services/agencysevices">
                                    <span class="elementor-button-content-wrapper">
                                        <span class="elementor-button-icon">
                                            <i aria-hidden="true" class="vamtamtheme- vamtam-theme-arrow-right"></i> </span>
                                        <span class="elementor-button-text">Learn more</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- <!-- Category Selection Modal -->
<div id="categoryModal" class="category-modal" style="display: none;">
    <div class="category-modal-overlay" onclick="closeCategoryModal()"></div>
    <div class="category-modal-content">
        <div class="category-modal-header">
            <button class="category-modal-close" onclick="closeCategoryModal()">
                <span>&times;</span>
            </button>
        </div>
        <div class="category-modal-body">
            <div class="category-modal-image">
                <img id="modalCategoryImage" src="" alt="" />
            </div>
            <div class="category-modal-info">
                <h3 id="modalCategoryName">Category Name</h3>
                <p class="category-modal-description">Explore opportunities in this category</p>

                <div class="category-modal-buttons">
                    <a id="modalJobsLink" href="" class="category-modal-btn jobs-btn">
                        <span class="btn-icon">💼</span>
                        <span class="btn-text">Find a Job</span>
                    </a>
                    <a id="modalServicesLink" href="" class="category-modal-btn services-btn">
                        <span class="btn-icon">🧹</span>
                        <span class="btn-text">Find a Service</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<style>
    /* Categories horizontal scroll container */
    .categories-scroll-container {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
        padding: 0 40px;
    }

    .categories-wrapper {
        display: flex;
        gap: 15px;
        overflow-x: auto;
        scroll-behavior: smooth;
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE and Edge */
        padding: 10px 0;
        flex: 1;
    }

    .categories-wrapper::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Opera */
    }

    /* Desktop - 5 categories visible, each smaller in size */
    @media (min-width: 992px) {
        .elementor-element-509c5dc .services-two {
            flex: 0 0 280px !important;
            /* Fixed width for 5 per view */
            max-width: 280px !important;
            margin: 0 !important;
            min-height: 350px !important;
        }

        .categories-scroll-container {
            padding: 0 50px;
        }
    }

    /* Tablet - 3 categories visible */
    @media (max-width: 991px) and (min-width: 768px) {
        .elementor-element-509c5dc .services-two {
            flex: 0 0 250px !important;
            max-width: 250px !important;
            margin: 0 !important;
            min-height: 320px !important;
        }

        .categories-scroll-container {
            padding: 0 40px;
        }
    }

    /* Mobile - 1.5 categories visible for scroll indication */
    @media (max-width: 767px) {
        .elementor-element-509c5dc .services-two {
            flex: 0 0 260px !important;
            max-width: 260px !important;
            margin: 0 !important;
            min-height: 300px !important;
        }

        .categories-scroll-container {
            padding: 0 35px;
        }
    }

    /* Scroll arrows styling */
    .scroll-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #ddd;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .scroll-arrow:hover {
        background: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transform: translateY(-50%) scale(1.1);
    }

    .scroll-left {
        left: 5px;
    }

    .scroll-right {
        right: 5px;
    }

    .scroll-arrow span {
        font-size: 18px;
        color: #333;
        font-weight: bold;
        line-height: 1;
    }

    /* Ensure proper image sizing - smaller for compact layout */
    .category-image {
        width: 100% !important;
        height: 200px !important;
        /* Reduced height */
        object-fit: cover !important;
    }

    /* Make sure background gradients are visible */
    .services-two[data-settings*="background_background"] {
        background-color: transparent;
        background-image: linear-gradient(142deg, var(--e-global-color-vamtam_accent_1) 0%, var(--e-global-color-vamtam_accent_3) 70%);
    }

    /* Ensure proper block styling to match ourservices */
    .elementor-element-509c5dc .services-two {
        border-radius: 8px !important;
        overflow: hidden !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease !important;
    }

    .elementor-element-509c5dc .services-two:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    /* Adjust content spacing for compact layout */
    .elementor-element-509c5dc .services-two .elementor-widget-container h4 {
        font-size: 16px !important;
        line-height: 1.3 !important;
        margin-bottom: 8px !important;
    }

    .category-description {
        font-size: 13px !important;
        line-height: 1.4 !important;
        margin-top: 6px !important;
    }

    /* Responsive scroll arrow adjustments */
    @media (max-width: 767px) {
        .scroll-arrow {
            width: 35px;
            height: 35px;
        }

        .scroll-arrow span {
            font-size: 16px;
        }

        .category-image {
            height: 180px !important;
        }
    }

    /* Category Modal Styles */
    .category-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .category-modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
    }

    .category-modal-content {
        position: relative;
        background: white;
        border-radius: 15px;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .category-modal-header {
        position: relative;
        padding: 15px 20px 10px;
        display: flex;
        justify-content: flex-end;
    }

    .category-modal-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #999;
        padding: 5px;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .category-modal-close:hover {
        background: #f5f5f5;
        color: #333;
    }

    .category-modal-body {
        padding: 0 30px 30px;
    }

    .category-modal-image {
        text-align: center;
        margin-bottom: 20px;
    }

    .category-modal-image img {
        width: 100%;
        max-width: 200px;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .category-modal-info h3 {
        text-align: center;
        margin: 0 0 25px 0;
        font-size: 22px;
        font-weight: 600;
        color: #333;
    }

    .category-modal-buttons {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .category-modal-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        gap: 10px;
    }

    .category-modal-btn .btn-icon {
        font-size: 18px;
    }

    .category-modal-btn.jobs-btn {
        background: linear-gradient(135deg, #e8ea66ff 0%, #9ea436ff 100%);
        color: white;
    }

    .category-modal-btn.jobs-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .category-modal-btn.services-btn {
        background: linear-gradient(135deg, #e8ea66ff 0%, #9ea436ff 100%);
        color: white;
    }

    .category-modal-btn.services-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 87, 108, 0.4);
    }

    /* Mobile responsiveness for modal */
    @media (max-width: 480px) {
        .category-modal-content {
            width: 95%;
            margin: 20px;
        }

        .category-modal-body {
            padding: 0 20px 20px;
        }

        .category-modal-info h3 {
            font-size: 20px;
        }

        .category-modal-btn {
            padding: 12px 15px;
            font-size: 15px;
        }

        .category-modal-image img {
            max-width: 150px;
            height: 120px;
        }
    }

    /* Services Section Styles */
    .category-services-section {
        margin: 20px 0;
        border-top: 1px solid #eee;
        padding-top: 20px;
    }

    .services-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
        text-align: center;
    }

    /* Category modal description */
    .category-modal-description {
        text-align: center;
        color: #666;
        margin-bottom: 25px;
        font-size: 16px;
    }
</style>

<script>
    function scrollCategories(direction) {
        const wrapper = document.getElementById('categoriesWrapper');
        const scrollAmount = 300; // Adjust scroll distance

        if (direction === 'left') {
            wrapper.scrollLeft -= scrollAmount;
        } else {
            wrapper.scrollLeft += scrollAmount;
        }

        // Update arrow visibility
        setTimeout(updateArrowVisibility, 100);
    }

    function updateArrowVisibility() {
        const wrapper = document.getElementById('categoriesWrapper');
        const leftArrow = document.querySelector('.scroll-left');
        const rightArrow = document.querySelector('.scroll-right');

        if (!wrapper || !leftArrow || !rightArrow) return;

        const maxScrollLeft = wrapper.scrollWidth - wrapper.clientWidth;

        // Show/hide left arrow
        if (wrapper.scrollLeft <= 0) {
            leftArrow.style.display = 'none';
        } else {
            leftArrow.style.display = 'flex';
        }

        // Show/hide right arrow
        if (wrapper.scrollLeft >= maxScrollLeft - 1) {
            rightArrow.style.display = 'none';
        } else {
            rightArrow.style.display = 'flex';
        }
    }

    // Initialize arrow visibility on page load
    document.addEventListener('DOMContentLoaded', function () {
        // Wait for content to load
        setTimeout(function () {
            updateArrowVisibility();

            // Add scroll event listener
            const wrapper = document.getElementById('categoriesWrapper');
            if (wrapper) {
                wrapper.addEventListener('scroll', updateArrowVisibility);
            }
        }, 500);
    });

    // Update visibility on window resize
    window.addEventListener('resize', function () {
        setTimeout(updateArrowVisibility, 100);
    });

    // Category Modal Functions
    function openCategoryModal(element) {
        const categoryId = element.getAttribute('data-category-id');
        const categoryName = element.getAttribute('data-category-name');
        const categoryImage = element.getAttribute('data-category-image');

        // Update modal content
        document.getElementById('modalCategoryImage').src = categoryImage;
        document.getElementById('modalCategoryImage').alt = categoryName;
        document.getElementById('modalCategoryName').textContent = categoryName;

        // Update links
        document.getElementById('modalJobsLink').href = `/jobs?category=${categoryId}`;
        document.getElementById('modalServicesLink').href = `/services?category=${categoryId}`;

        // Show modal
        const modal = document.getElementById('categoryModal');
        modal.style.display = 'flex';

        // Prevent body scroll
        document.body.style.overflow = 'hidden';

        // Animation
        setTimeout(() => {
            modal.querySelector('.category-modal-content').style.opacity = '1';
            modal.querySelector('.category-modal-content').style.transform = 'scale(1)';
        }, 10);
    }

    function closeCategoryModal() {
        const modal = document.getElementById('categoryModal');
        const modalContent = modal.querySelector('.category-modal-content');

        // Animation out
        modalContent.style.opacity = '0';
        modalContent.style.transform = 'scale(0.9)';

        setTimeout(() => {
            modal.style.display = 'none';
            // Restore body scroll
            document.body.style.overflow = '';
        }, 300);
    }

    // Close modal when clicking outside or pressing escape
    document.addEventListener('DOMContentLoaded', function () {
        // Escape key handler
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeCategoryModal();
            }
        });
    });
</script>