<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <!-- Tailwind CSS -->
    <!--script src="https://cdn.tailwindcss.com"></script-->
    <script src="/wp-content/themes/chris-tailwind-woo-backup/tailwindcss.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#FF0100'
                    }
                }
            }
        }
    </script>

    <!-- Overflow safety net: prevents horizontal scrollbar caused by
         mega menu panels or other elements rendering wider than the viewport -->
    <style>
        html,
        body {
            overflow-x: hidden;
            max-width: 100vw;
        }

        .mega-menu-wrap,
        .mega-menu-wrap * {
            max-width: 100%;
            box-sizing: border-box;
        }

        /* Mobile Language Switcher ([mlt_language_switcher]) placed
           beside the cart on the logo row. The component already carries
           its own dark pill styling (flag + code + chevron), so we only
           need to: (1) shrink it to fit the compact mobile row, and
           (2) keep its dropdown panel from overflowing off the right
           edge of the screen.
           NOTE: adjust the selectors below if your actual markup uses
           different class names -- inspect the rendered <div> in
           DevTools and swap "mobile-lang-switcher *" targets accordingly. */
        .mobile-lang-switcher {
            display: flex;
            align-items: center;
        }

        .mobile-lang-switcher button,
        .mobile-lang-switcher a {
            font-size: 0.75rem !important;
            padding: 0.375rem 0.5rem !important;
        }

        .mobile-lang-switcher img {
            width: 1rem !important;
            height: auto !important;
        }

        .mobile-lang-switcher svg {
            width: 0.875rem !important;
            height: 0.875rem !important;
        }

        /* Dropdown panel: force it to open flush with the right edge of
           the button instead of the left, so it can't push the page
           wider than the viewport near the screen edge. */
        .mobile-lang-switcher [class*="dropdown"],
        .mobile-lang-switcher [class*="menu"],
        .mobile-lang-switcher [class*="panel"] {
            right: 0 !important;
            left: auto !important;
            z-index: 60;
        }
    </style>

    <!-- Auto-suggest -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.querySelector('input[name="s"]');
            const suggestionsBox = document.getElementById("search-suggestions");

            let timer;

            searchInput.addEventListener("input", function () {
                clearTimeout(timer);
                const query = this.value.trim();

                if (query.length < 3) {
                    suggestionsBox.classList.add("hidden");
                    return;
                }

                timer = setTimeout(() => {
                    fetch(`/wp-admin/admin-ajax.php?action=product_search_suggestions&query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length === 0) {
                                suggestionsBox.innerHTML = `<p class="p-3 text-sm text-gray-500">No products found</p>`;
                            } else {
                                suggestionsBox.innerHTML = data.map(item => `
                            <a href="${item.url}" class="flex items-center gap-3 p-3 hover:bg-gray-100 transition">
                                <img src="${item.image}" class="w-10 h-10 object-cover rounded" />
                                <span class="text-gray-700 text-sm">${item.name}</span>
                            </a>
                        `).join("");
                            }

                            suggestionsBox.classList.remove("hidden");
                        });
                }, 300);
            });
            document.addEventListener("click", (e) => {
                if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                    suggestionsBox.classList.add("hidden");
                }
            });
        });
    </script>
</head>

<body <?php body_class('bg-gray-50 text-gray-900 min-h-screen flex flex-col'); ?>>
    <?php wp_body_open(); ?>
    <?php get_template_part('components/preloader'); ?>
    <div class="bg-white">

        <header class="relative">
            <!-- Top Bar (Desktop Only) -->
            <div class="hidden sm:block bg-slate-800">
                <div class="mx-auto px-4 sm:px-6 lg:px-4">
                    <div class="flex h-10 items-center justify-between">
                        <ul class="flex items-center flex-wrap gap-x-5 gap-y-1 text-xs text-white">
                            <li><a href="/strapping" class="hover:text-gray-100">Strap</a></li>
                            <li><a href="/wrapping" class="hover:text-gray-100">Wrap</a></li>
                            <li><a href="/equipment-for-banding" class="hover:text-gray-100">Band</a></li>
                            <li><a href="/string-tying" class="hover:text-gray-100">Tie</a></li>
                            <li><a href="/shrink-packaging" class="hover:text-gray-100">Shrink</a></li>
                            <li><a href="/bag-sealers" class="hover:text-gray-100">Seal</a></li>
                            <li><a href="/downloads" class="hover:text-gray-100">Downloads</a></li>
                            <li><a href="/events" class="hover:text-gray-100">Events</a></li>
                            <li><a href="/about-us" class="hover:text-gray-100">Om os</a></li>
                        </ul>
                        <div class="flex items-center space-x-5">
                            <?php echo do_shortcode('[mlt_language_switcher]'); ?>
                            <a href="mailto:support@sal-tech.com"
                                class="text-sm text-white hover:text-gray-100">support@sal-tech.com</a>
                            <a href="tel:+4570272220" class="text-sm text-white hover:text-gray-100">+45
                                70272220</a>
                            <?php if (is_user_logged_in()): ?>
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" @click.away="open = false"
                                        class="text-white hover:text-gray-100 flex items-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </button>
                                    <div x-show="open" x-transition
                                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                        <a href="<?= esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Min
                                            konto</a>
                                        <a href="/order-history"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mine
                                            ordre</a>
                                        <a href="/order-slip"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mine
                                            kreditnotaer</a>
                                        <a href="/addresses"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mine
                                            adresser</a>
                                        <a href="/identity"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mine
                                            personlige oplysninger</a>
                                        <a href="/discount"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mine
                                            værdikuponer</a>
                                        <hr class="my-1">
                                        <a href="<?= esc_url(wp_logout_url(home_url())) ?>"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log ud</a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <a href="<?= esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"
                                    class="text-sm text-white hover:text-gray-100">Log ind</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo + Search/Cart Row -->
            <div class="bg-white border-b border-gray-200">
                <div class="mx-auto px-4">
                    <div class="flex h-20 items-center justify-between lg:h-24">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                            <?php
                            $mlt_logo_url = function_exists('mlt_get_current_language_logo_url') ? mlt_get_current_language_logo_url() : '';
                            if ($mlt_logo_url):
                                ?>
                                <a href="<?= esc_url(home_url('/')) ?>">
                                    <img src="<?= esc_url($mlt_logo_url) ?>" alt="<?= esc_attr(get_bloginfo('name')) ?>"
                                        class="h-12 w-auto lg:h-14" id="headerLogo">
                                </a>
                            <?php else:
                                $logo_id = get_theme_mod('custom_logo');
                                $logo = wp_get_attachment_image_src($logo_id, 'h-14 w-auto');
                                if ($logo): ?>
                                    <a href="<?= esc_url(home_url('/')) ?>">
                                        <img src="<?= esc_url($logo[0]) ?>" alt="<?= esc_attr(get_bloginfo('name')) ?>"
                                            class="h-12 w-auto lg:h-14" id="headerLogo">
                                    </a>
                                <?php else: ?>
                                    <a href="<?= esc_url(home_url('/')) ?>" class="text-xl font-bold text-gray-900 lg:text-2xl">
                                        <?= esc_html(get_bloginfo('name')) ?>
                                    </a>
                                <?php endif;
                            endif; ?>
                        </div>

                        <!-- Mobile Language Switcher + Menu Toggle + Cart -->
                        <div class="flex items-center space-x-3 lg:hidden">
                            <div class="mobile-lang-switcher flex items-center">
                                <?php echo do_shortcode('[mlt_language_switcher]'); ?>
                            </div>
                            <!-- The actual hamburger button is injected here by JS below --
                                 Max Mega Menu renders its own toggle inside .mega-menu-wrap
                                 further down the page; we relocate that exact element into
                                 this slot so there's only ever one toggle button on the page. -->
                            <div id="mobile-menu-toggle-slot" class="flex items-center"></div>
                            <a href="<?= esc_url(home_url('/cart/')) ?>"
                                class="relative flex items-center text-gray-700 hover:text-brand">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                <span
                                    class="ml-1 text-sm font-medium"><?= WC()->cart->get_cart_contents_count() ?></span>
                            </a>
                        </div>

                        <!-- Desktop Search + Cart + Language -->
                        <div class="hidden lg:flex items-center space-x-6">
                            <a href="<?php echo esc_url(home_url('/products-a-z')); ?>"
                                class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M3 3h6l12 12-6 6L3 9V3z" />
                                </svg>
                                Produkter A-Å
                            </a>
                            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"
                                class="relative">
                                <input type="search" name="s" placeholder="Find produkter..."
                                    class="w-52 md:w-64 px-4 py-2 pr-10 rounded-full bg-gray-100 text-sm text-gray-700 placeholder-gray-400 hover:bg-gray-200 focus:outline-none transition duration-200 ease-in-out"
                                    autocomplete="off" />
                                <div id="search-suggestions"
                                    class="absolute left-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-50">
                                </div>
                                <?php if (class_exists('WooCommerce')): ?>
                                    <input type="hidden" name="post_type" value="product" />
                                <?php endif; ?>
                                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </button>
                            </form>
                            <a href="<?= esc_url(home_url('/cart/')) ?>"
                                class="relative flex items-center text-gray-700 hover:text-brand">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                                <span class="ml-2 text-sm font-medium">
                                    <?= WC()->cart->get_cart_contents_count() ?>
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Mobile Search -->
                    <div class="pb-4 lg:hidden">
                        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"
                            class="relative w-full">
                            <input type="search" name="s" placeholder="Search products..."
                                class="w-full px-4 py-2.5 pr-12 rounded-full text-sm text-gray-700 placeholder-gray-400 bg-gray-100 focus:outline-none hover:bg-gray-200 transition duration-200 ease-in-out"
                                autocomplete="off" />
                            <?php if (class_exists('WooCommerce')): ?>
                                <input type="hidden" name="post_type" value="product" />
                            <?php endif; ?>
                            <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!--
                Mega Menu (Desktop + Mobile)
                Max Mega Menu is enabled for the "primary" location and handles
                BOTH breakpoints itself: a horizontal mega-dropdown nav on desktop,
                and its own off-canvas mobile drawer (with built-in toggle button)
                on smaller screens. Do NOT wrap this in "hidden lg:block" -- Max
                Mega Menu's own responsive JS/CSS controls which view shows based
                on its Menu Locations > Mobile settings breakpoint.

                Wrapped in .mega-menu-wrap so the overflow-safety CSS in <head>
                can clamp any dropdown panel that tries to render wider than
                the viewport.
            -->
            <div class="bg-white mega-menu-wrap">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex items-center flex-wrap space-x-8 py-2',
                    'fallback_cb' => false,
                ));
                ?>
            </div>
        </header>
    </div>

    <main class="flex-1 bg-gray-50">