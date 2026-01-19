import "./bootstrap";

// Mobile Header Menu Toggle Functionality
document.addEventListener("DOMContentLoaded", function () {
    // Handle hamburger menu toggle
    const menuToggle = document.querySelector(".elementor-menu-toggle");
    const navDropdown = document.querySelector(".elementor-nav-menu--dropdown");
    const userDropdown = document.querySelector(".user-dropdown");
    const loginDropdown = document.querySelector(".login-dropdown");

    if (menuToggle && navDropdown) {
        menuToggle.addEventListener("click", function () {
            const isExpanded =
                menuToggle.getAttribute("aria-expanded") === "true";
            menuToggle.setAttribute("aria-expanded", !isExpanded);
            navDropdown.setAttribute("aria-hidden", isExpanded);

            if (!isExpanded) {
                navDropdown.style.display = "block";
                // Close user/login dropdowns when menu opens
                if (userDropdown) userDropdown.removeAttribute("open");
                if (loginDropdown) loginDropdown.removeAttribute("open");
            } else {
                navDropdown.style.display = "none";
            }
        });
    }

    // Close dropdown when clicking on a menu item
    const navItems = document.querySelectorAll(
        ".elementor-nav-menu--dropdown a"
    );
    navItems.forEach((item) => {
        item.addEventListener("click", function () {
            if (menuToggle) {
                menuToggle.setAttribute("aria-expanded", "false");
                if (navDropdown) {
                    navDropdown.setAttribute("aria-hidden", "true");
                    navDropdown.style.display = "none";
                }
            }
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function (event) {
        if (menuToggle && navDropdown) {
            const isClickInside =
                menuToggle.contains(event.target) ||
                navDropdown.contains(event.target) ||
                (userDropdown && userDropdown.contains(event.target)) ||
                (loginDropdown && loginDropdown.contains(event.target));
            if (
                !isClickInside &&
                menuToggle.getAttribute("aria-expanded") === "true"
            ) {
                menuToggle.setAttribute("aria-expanded", "false");
                navDropdown.setAttribute("aria-hidden", "true");
                navDropdown.style.display = "none";
            }
        }
    });
});
