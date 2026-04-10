<style>
    .site-shell .layout-header {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        z-index: 60 !important;
        background: transparent !important;
        backdrop-filter: none !important;
        border-bottom-color: transparent !important;
        box-shadow: none !important;
    }

    .site-shell .layout-header.is-scrolled {
        background: rgba(255, 255, 255, 0.96) !important;
        backdrop-filter: blur(8px) !important;
        border-bottom: 1px solid rgba(15, 23, 42, 0.08) !important;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08) !important;
    }

    .site-shell .layout-header.is-at-top {
        background: transparent !important;
        backdrop-filter: none !important;
        border-bottom-color: transparent !important;
        box-shadow: none !important;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var header = document.querySelector('.layout-header');
        if (!header) {
            return;
        }

        var syncHeaderState = function () {
            var isScrolled = window.scrollY > 8;
            header.classList.toggle('is-scrolled', isScrolled);
            header.classList.toggle('is-at-top', !isScrolled);
        };

        syncHeaderState();
        window.addEventListener('scroll', syncHeaderState, { passive: true });
    });
</script>