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
    <style>
        /* Drawer Animation Styles */
        .drawer-overlay {
            transition: opacity 0.3s ease-in-out;
        }

        .drawer-menu {
            transition: transform 0.3s ease-in-out;
        }

        .drawer-menu.open {
            transform: translateX(0);
        }

        .drawer-menu.closed {
            transform: translateX(100%);
        }
    </style>
</head>

<body <?php body_class('bg-gray-50 text-gray-900 min-h-screen flex flex-col'); ?>>
    <?php wp_body_open(); ?>
    <?php get_template_part('components/preloader'); ?>
    <div class="bg-white">
        <!-- Mobile Drawer Menu -->
        <div x-data="{ mobileMenuOpen: false }" @keydown.escape.window="mobileMenuOpen = false">
            <!-- Overlay -->
            <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false"
                class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden" style="display: none;">
            </div>

            <!-- Drawer Panel -->
            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="fixed inset-y-0 right-0 w-4/5 bg-white shadow-xl z-50 overflow-y-auto lg:hidden"
                style="display: none;">

                <!-- Drawer Header -->
                <div class="flex items-center justify-between p-4 border-b border-gray-200 sticky top-0 bg-white z-10">
                    <h2 class="text-lg font-semibold text-gray-900">Menu</h2>
                    <button @click="mobileMenuOpen = false"
                        class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Drawer Content -->
                <div class="p-4">

                    <a href="<?php echo esc_url(home_url('/products-a-z')); ?>"
                        class="px-3 text-base font-medium text-gray-900 hover:text-red-600 transition-colors">
                        Produkter A-Å
                    </a>

                    <!-- Dynamic Menu Content -->
                    <div class="border-t border-gray-200 mt-4 mb-6">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'fallback_cb' => false,
                        ));
                        ?>
                    </div>

                    <!-- Additional Navigation -->
                    <div class="border-t border-gray-200 pt-6">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-4">Quick Links</p>
                        <ul class="space-y-3">
                            <li>
                                <a href="/strapping"
                                    class="flex items-center text-gray-700 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Omsnøring
                                </a>
                            </li>
                            <li>
                                <a href="/wrapping"
                                    class="flex items-center text-gray-700 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Omvikling
                                </a>
                            </li>
                            <li>
                                <a href="/equipment-for-banding"
                                    class="flex items-center text-gray-700 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Båndingsudstyr
                                </a>
                            </li>
                            <li>
                                <a href="/string-tying"
                                    class="flex items-center text-gray-700 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Bindning med snor
                                </a>
                            </li>
                            <li>
                                <a href="/shrink-packaging"
                                    class="flex items-center text-gray-700 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Krympemballage
                                </a>
                            </li>
                            <li>
                                <a href="/bag-sealers"
                                    class="flex items-center text-gray-700 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Forseglere til poser
                                </a>
                            </li>
                            <li>
                                <a href="/downloads"
                                    class="flex items-center text-gray-700 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Downloads
                                </a>
                            </li>
                            <li>
                                <a href="/events"
                                    class="flex items-center text-gray-700 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Events
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Account Section -->
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <?php if (is_user_logged_in()): ?>
                            <a href="<?= esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"
                                class="flex items-center justify-center w-full px-4 py-3 bg-slate-800 text-white rounded-lg hover:bg-slate-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Min konto
                            </a>
                            <a href="<?= esc_url(wp_logout_url(home_url())) ?>"
                                class="flex items-center justify-center w-full px-4 py-3 mt-3 bg-gray-200 text-slate-800 rounded-lg hover:bg-gray-300 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Log ud
                            </a>
                        <?php else: ?>
                            <a href="<?= esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"
                                class="flex items-center justify-center w-full px-4 py-3 bg-slate-800 text-white rounded-lg hover:bg-slate-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Log ind
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Contact Info -->
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-3">Kontakt os</p>
                        <div class="space-y-2">
                            <?php echo do_shortcode('[mlt_language_switcher]'); ?>
                            <a href="mailto:support@sal-tech.com"
                                class="flex items-center text-sm text-gray-600 hover:text-red-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                support@sal-tech.com
                            </a>
                            <a href="tel:+4570272220"
                                class="flex items-center text-sm text-gray-600 hover:text-red-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                +45 70272220
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <header class="relative">
                <!-- Top Bar (Desktop Only) -->
                <div class="hidden sm:block bg-slate-800" :class="{ 'sm:hidden': mobileMenuOpen }">
                    <div class="mx-auto px-4 sm:px-6 lg:px-4">
                        <div class="flex h-10 items-center justify-between">
                            <ul class="flex items-center space-x-5 text-xs text-white">
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
                                <?php //echo do_shortcode('[gtranslate]'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logo + Search/Cart Row -->
                <div class="bg-white border-b border-gray-200">
                    <div class="mx-auto  px-4">
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
                                        <a href="<?= esc_url(home_url('/')) ?>"
                                            class="text-xl font-bold text-gray-900 lg:text-2xl">
                                            <?= esc_html(get_bloginfo('name')) ?>
                                        </a>
                                    <?php endif;
                                endif; ?>
                            </div>

                            <!-- Mobile Cart + Menu Button -->
                            <div class="flex items-center space-x-3 lg:hidden">
                                <a href="<?= esc_url(home_url('/cart/')) ?>"
                                    class="relative flex items-center text-gray-700 hover:text-brand">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                    <span
                                        class="ml-1 text-sm font-medium"><?= WC()->cart->get_cart_contents_count() ?></span>
                                </a>
                                <button @click="mobileMenuOpen = true"
                                    class="p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 rounded-md transition-colors">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </button>
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
                                    <button type="submit"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
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

                <!-- Desktop Mega Menu -->
                <div class="hidden lg:block bg-white">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'flex items-center space-x-4 h-16 overflow-x-auto flex-nowrap',
                        'fallback_cb' => false,
                    ));
                    ?>
                </div>

            </header>
        </div>
    </div>

    <main class="flex-1 bg-gray-50">