/**
 * Cleaning Company Laravel - Main JavaScript
 * Converted from WordPress VAMTAM theme functionality
 */

(function() {
    'use strict';

    // Global VAMTAM object for Laravel version
    window.VAMTAM = window.VAMTAM || {};

    // Utility functions
    VAMTAM.debounce = function(func, wait = 300, immediate = false) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    VAMTAM.offset = function(el) {
        var rect = el.getBoundingClientRect();
        var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        return {
            top: rect.top + scrollTop,
            left: rect.left + scrollLeft
        };
    };

    // Scroll handling
    VAMTAM.scroll_handlers = [];
    VAMTAM.latestKnownScrollY = 0;
    var ticking = false;

    VAMTAM.addScrollHandler = function(handler) {
        requestAnimationFrame(function() {
            handler.init();
            VAMTAM.scroll_handlers.push(handler);
            handler.measure(VAMTAM.latestKnownScrollY);
            handler.mutate(VAMTAM.latestKnownScrollY);
        });
    };

    VAMTAM.onScroll = function() {
        VAMTAM.latestKnownScrollY = window.pageYOffset;
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(function() {
                for (var i = 0; i < VAMTAM.scroll_handlers.length; i++) {
                    VAMTAM.scroll_handlers[i].measure(VAMTAM.latestKnownScrollY);
                }
                for (var i = 0; i < VAMTAM.scroll_handlers.length; i++) {
                    VAMTAM.scroll_handlers[i].mutate(VAMTAM.latestKnownScrollY);
                }
                ticking = false;
            });
        }
    };

    window.addEventListener('scroll', VAMTAM.onScroll, { passive: true });

    // Dynamic script and style loading
    VAMTAM.load_script = function(src, callback) {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.src = src;
        if (callback) {
            script.onload = callback;
        }
        document.getElementsByTagName('script')[0].before(script);
    };

    VAMTAM.load_style = function(href, media, callback, insertAfter) {
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.type = 'text/css';
        link.media = media;
        link.href = href;
        if (callback) {
            link.onload = callback;
        }
        if (insertAfter) {
            insertAfter.after(link);
        } else {
            document.getElementsByTagName('link')[0].before(link);
        }
    };

    // Device width detection
    VAMTAM.isBelowMaxDeviceWidth = function() {
        return !window.matchMedia('(min-width: 1280px)').matches;
    };

    VAMTAM.isMaxDeviceWidth = function() {
        return window.matchMedia('(min-width: 1280px)').matches;
    };

    VAMTAM.isMediumDeviceOrWider = function() {
        return window.matchMedia('(min-width: 768px)').matches;
    };

    // Mobile browser detection
    VAMTAM.isMobileBrowser = /Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone/.test(navigator.userAgent) ||
        (/Macintosh/.test(navigator.userAgent) && navigator.maxTouchPoints && navigator.maxTouchPoints > 2);

    // Scrollbar width calculation
    VAMTAM.getScrollbarWidth = function() {
        return window.innerWidth - document.documentElement.clientWidth;
    };

    // Page load handling
    var isLoaded = false;
    VAMTAM.waitForLoad = function(callback) {
        if (isLoaded) {
            callback();
        } else {
            window.addEventListener('load', callback);
        }
    };

    window.addEventListener('load', function() {
        isLoaded = true;
    });

    // Smooth scrolling for anchor links
    VAMTAM.initSmoothScroll = function() {
        var stickyHeader = document.querySelector('header.main-header .header-contents');
        var adminBarHeight = document.body.classList.contains('admin-bar') ? 32 : 0;
        var scrollCallback;
        var scrollTimeout;

        function smoothScrollTo(target, callback) {
            requestAnimationFrame(function() {
                var targetOffset = VAMTAM.offset(target).top;
                VAMTAM.blockStickyHeaderAnimation = true;
                var headerHeight = stickyHeader ? stickyHeader.offsetHeight || 0 : 0;
                var scrollToPosition = targetOffset - adminBarHeight - headerHeight;
                
                scrollCallback = callback;
                window.addEventListener('scroll', onScrollEnd, { passive: true });
                window.scroll({
                    left: 0,
                    top: scrollToPosition,
                    behavior: 'smooth'
                });

                if (target.getAttribute('id')) {
                    if (history.pushState) {
                        history.pushState(null, null, '#' + target.getAttribute('id'));
                    } else {
                        window.location.hash = target.getAttribute('id');
                    }
                }
            });
        }

        function onScrollEnd() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                window.removeEventListener('scroll', onScrollEnd, { passive: true });
                VAMTAM.blockStickyHeaderAnimation = false;
                if (scrollCallback) scrollCallback();
            }, 200);
        }

        document.addEventListener('click', function(e) {
            var link = e.target.closest('[href]');
            if (!link) return;

            var href = link.getAttribute('href');
            if (!href || !href.includes('#')) return;

            var targetId = href.split('#')[1];
            var target = document.getElementById(targetId);
            if (!target) return;

            var linkUrl = document.createElement('a');
            linkUrl.href = href;
            
            if (linkUrl.pathname === window.location.pathname) {
                e.preventDefault();
                smoothScrollTo(target);
            }
        });

        // Handle initial hash on page load
        if (window.location.hash) {
            var initialTarget = document.querySelector(window.location.hash);
            if (initialTarget) {
                document.documentElement.scrollTop = 0;
                document.body.scrollTop = 0;
                setTimeout(function() {
                    smoothScrollTo(initialTarget);
                }, 400);
            }
        }
    };

    // Mobile menu functionality
    VAMTAM.initMobileMenu = function() {
        var menuToggle = document.querySelector('.mobile-menu-toggle');
        var mainNav = document.querySelector('.main-nav');
        
        if (!menuToggle || !mainNav) return;

        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            mainNav.classList.toggle('active');
            menuToggle.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mainNav.contains(e.target) && !menuToggle.contains(e.target)) {
                mainNav.classList.remove('active');
                menuToggle.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });
    };

    // Sticky header functionality
    VAMTAM.initStickyHeader = function() {
        var stickyHeader = document.querySelector('.vamtam-sticky-header');
        if (!stickyHeader) return;

        var headerHeight = stickyHeader.offsetHeight;
        var scrollDirection = '';
        var lastScrollY = window.scrollY;
        var isTransparent = stickyHeader.classList.contains('vamtam-sticky-header--transparent-header');

        function showHeader() {
            stickyHeader.classList.remove('vamtam-sticky-header--fixed-hidden');
            stickyHeader.classList.add('vamtam-sticky-header--fixed-shown');
        }

        function hideHeader() {
            stickyHeader.classList.remove('vamtam-sticky-header--fixed-shown');
            stickyHeader.classList.add('vamtam-sticky-header--fixed-hidden');
        }

        function resetHeader() {
            stickyHeader.classList.remove('vamtam-sticky-header--fixed-shown');
            stickyHeader.classList.remove('vamtam-sticky-header--fixed-hidden');
        }

        var scrollHandler = VAMTAM.debounce(function() {
            var currentScrollY = window.scrollY;
            var scrollDifference = Math.abs(currentScrollY - lastScrollY);

            if (currentScrollY > headerHeight && scrollDifference < 20) return;

            if (currentScrollY > lastScrollY) {
                scrollDirection = 'down';
            } else {
                scrollDirection = 'up';
            }

            if (scrollDirection === 'up') {
                if (currentScrollY >= 10) {
                    showHeader();
                } else {
                    resetHeader();
                }
            } else if (scrollDirection === 'down') {
                if (currentScrollY >= 10 || isTransparent) {
                    hideHeader();
                }
            }

            lastScrollY = currentScrollY;
        }, 25);

        if (VAMTAM.isMaxDeviceWidth()) {
            window.addEventListener('scroll', scrollHandler, { passive: true });
        } else {
            resetHeader();
        }
    };

    // Form handling
    VAMTAM.initForms = function() {
        var forms = document.querySelectorAll('form');
        
        forms.forEach(function(form) {
            // Add loading state to submit buttons
            form.addEventListener('submit', function() {
                var submitBtn = form.querySelector('[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Sending...';
                }
            });

            // Enhanced form validation
            var inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(function(input) {
                input.addEventListener('blur', function() {
                    validateField(input);
                });
            });
        });

        function validateField(field) {
            var isValid = field.checkValidity();
            var errorMsg = field.parentNode.querySelector('.error-message');
            
            if (!isValid) {
                field.classList.add('error');
                if (!errorMsg) {
                    errorMsg = document.createElement('span');
                    errorMsg.className = 'error-message';
                    errorMsg.style.color = 'var(--e-global-color-vamtam_accent_2)';
                    errorMsg.style.fontSize = '12px';
                    errorMsg.style.marginTop = '5px';
                    errorMsg.style.display = 'block';
                    field.parentNode.appendChild(errorMsg);
                }
                errorMsg.textContent = field.validationMessage;
            } else {
                field.classList.remove('error');
                if (errorMsg) {
                    errorMsg.remove();
                }
            }
        }
    };

    // Animation on scroll
    VAMTAM.initScrollAnimations = function() {
        var animatedElements = document.querySelectorAll('.fade-in, .slide-up');
        
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.style.animationDelay = '0s';
                    entry.target.style.animationFillMode = 'both';
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '50px'
        });

        animatedElements.forEach(function(el) {
            observer.observe(el);
        });
    };

    // Video resizing (for responsive videos)
    VAMTAM.resizeElements = function() {
        var videos = document.querySelectorAll('.media-inner iframe, .media-inner object, .media-inner embed, .media-inner video');
        
        videos.forEach(function(video) {
            setTimeout(function() {
                requestAnimationFrame(function() {
                    var width = video.offsetWidth;
                    video.style.width = '100%';
                    
                    if (video.width === '0' && video.height === '0') {
                        video.style.height = (width * 9 / 16) + 'px';
                    } else {
                        video.style.height = (video.height * width / video.width) + 'px';
                    }
                });
            }, 50);
        });
    };

    // Initialize everything when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Set admin bar height
        VAMTAM.adminBarHeight = document.body.classList.contains('admin-bar') ? 32 : 0;

        // Add iOS Safari detection
        if (/iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream) {
            requestAnimationFrame(function() {
                document.documentElement.classList.add('ios-safari');
            });
        }

        // Add Safari detection
        if (navigator.userAgent.includes('Safari') && !navigator.userAgent.includes('Chrome')) {
            requestAnimationFrame(function() {
                document.documentElement.classList.add('safari');
            });
        }

        // Disable hover during scroll
        var scrollTimer;
        window.addEventListener('scroll', function() {
            clearTimeout(scrollTimer);
            requestAnimationFrame(function() {
                document.body.classList.add('disable-hover');
                scrollTimer = setTimeout(function() {
                    document.body.classList.remove('disable-hover');
                }, 300);
            });
        }, { passive: true });

        // Print functionality
        document.addEventListener('click', function(e) {
            if (e.target.closest('.vamtam-trigger-print')) {
                window.print();
                e.preventDefault();
            }
        });

        // Initialize all modules
        VAMTAM.initSmoothScroll();
        VAMTAM.initMobileMenu();
        VAMTAM.initStickyHeader();
        VAMTAM.initForms();
        VAMTAM.initScrollAnimations();
        VAMTAM.resizeElements();

        // Set scrollbar width CSS variable
        document.documentElement.style.setProperty('--vamtam-scrollbar-width', VAMTAM.getScrollbarWidth() + 'px');

        // Resize handler
        window.addEventListener('resize', VAMTAM.debounce(VAMTAM.resizeElements, 100), false);
    });

})();

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = window.VAMTAM;
}