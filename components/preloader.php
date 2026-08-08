<?php

/**
 * Page Load Preloader
 */
?>
<style>
    #page-preloader {
        position: fixed;
        inset: 0;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        transition: opacity 0.35s ease, visibility 0.35s ease;
    }

    #page-preloader.is-hidden {
        opacity: 0;
        visibility: hidden;
    }

    #page-preloader img {
        width: 60px;
        /* size */
        height: 60px;
        transform-style: preserve-3d;
        animation: spin3d 1.5s linear infinite;
    }

    /* animation */
    @keyframes spin3d {
        0% {
            transform: rotateX(0deg) rotateY(0deg);
        }

        25% {
            transform: rotateX(180deg) rotateY(0deg);
        }

        50% {
            transform: rotateX(180deg) rotateY(180deg);
        }

        75% {
            transform: rotateX(0deg) rotateY(180deg);
        }

        100% {
            transform: rotateX(0deg) rotateY(0deg);
        }
    }
</style>

<div id="page-preloader" aria-hidden="true">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/icon/icon.png" alt="Loading...">
</div>

<script>
    window.addEventListener('load', function() {
        var preloader = document.getElementById('page-preloader');
        if (preloader) {
            preloader.classList.add('is-hidden');
        }
    });
</script>