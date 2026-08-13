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

        /* ---- Mobile top row: hamburger / logo / cart ---- */
        .mobile-top-row {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
        }

        .mobile-top-row .justify-self-start {
            justify-self: start;
        }

        .mobile-top-row .justify-self-center {
            justify-self: center;
        }

        .mobile-top-row .justify-self-end {
            justify-self: end;
        }

        .mobile-lang-switcher,
        .mobile-currency-switcher,
        .desktop-lang-switcher,
        .desktop-currency-switcher {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .mobile-lang-switcher select,
        .mobile-lang-switcher button,
        .mobile-lang-switcher a,
        .mobile-currency-switcher select,
        .mobile-currency-switcher button,
        .mobile-currency-switcher a,
        .desktop-lang-switcher select,
        .desktop-lang-switcher button,
        .desktop-lang-switcher a,
        .desktop-currency-switcher select,
        .desktop-currency-switcher button,
        .desktop-currency-switcher a {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.25rem;
            background-color: #f3f4f6 !important;
            /* bg-gray-100 */
            color: #374151 !important;
            /* text-gray-700 */
            border: none !important;
            border-radius: 9999px !important;
            font-size: 0.75rem !important;
            font-weight: 500;
            padding: 0.375rem 0.75rem !important;
            white-space: nowrap;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .mobile-lang-switcher select:hover,
        .mobile-lang-switcher button:hover,
        .mobile-lang-switcher a:hover,
        .mobile-currency-switcher select:hover,
        .mobile-currency-switcher button:hover,
        .mobile-currency-switcher a:hover,
        .desktop-lang-switcher select:hover,
        .desktop-lang-switcher button:hover,
        .desktop-lang-switcher a:hover,
        .desktop-currency-switcher select:hover,
        .desktop-currency-switcher button:hover,
        .desktop-currency-switcher a:hover {
            background-color: #e5e7eb !important;
            /* bg-gray-200 */
        }

        .desktop-lang-switcher select,
        .desktop-lang-switcher button,
        .desktop-lang-switcher a,
        .desktop-currency-switcher select,
        .desktop-currency-switcher button,
        .desktop-currency-switcher a {
            font-size: 0.875rem !important;
            padding: 0.5rem 1rem !important;
        }

        .mobile-lang-switcher img,
        .desktop-lang-switcher img {
            width: 1rem !important;
            height: auto !important;
        }

        .mobile-lang-switcher svg,
        .desktop-lang-switcher svg {
            width: 0.875rem !important;
            height: 0.875rem !important;
        }

        .mobile-lang-switcher [class*="dropdown"],
        .mobile-lang-switcher [class*="menu"],
        .mobile-lang-switcher [class*="panel"],
        .mobile-currency-switcher [class*="dropdown"],
        .mobile-currency-switcher [class*="menu"],
        .mobile-currency-switcher [class*="panel"] {
            right: 0 !important;
            left: auto !important;
            z-index: 60;
            border-radius: 0.75rem !important;
            overflow: hidden;
            margin-top: 0.5rem !important;
        }

        /* Mobile hamburger button + the panel it toggles */
        #mobile-menu-toggle-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        #mobile-menu-toggle-btn svg {
            width: 1.5rem;
            height: 1.5rem;
        }

        .mega-menu-wrap {
            display: none;
        }

        .mega-menu-wrap.mobile-menu-open {
            display: block;
        }

        @media (min-width: 1024px) {
            .mega-menu-wrap {
                display: block !important;
            }
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

    <!-- Mobile menu toggle -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var btn = document.getElementById('mobile-menu-toggle-btn');
            var panel = document.querySelector('.mega-menu-wrap');
            if (!btn || !panel) return;

            btn.addEventListener('click', function () {
                var isOpen = panel.classList.toggle('mobile-menu-open');
                btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                btn.querySelector('.icon-open').classList.toggle('hidden', isOpen);
                btn.querySelector('.icon-close').classList.toggle('hidden', !isOpen);
            });
        });
    </script>
</head>

<body <?php body_class('bg-gray-50 text-gray-900 min-h-screen flex flex-col'); ?>>
    <?php wp_body_open(); ?>
    <?php get_template_part('components/preloader'); ?>
    <div class="bg-white">

        <header class="relative">
            <!-- Top Bar (Desktop Only) -- unchanged -->
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
                            <?php echo do_shortcode('[wc_currency_switcher]'); ?>
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

                    <?php
                    // Computed once, reused by both the mobile and desktop logo blocks below.
                    $mlt_logo_url = function_exists('mlt_get_current_language_logo_url') ? mlt_get_current_language_logo_url() : '';
                    $logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($logo_id, 'h-14 w-auto');
                    ?>

                    <!-- MOBILE ROW 1: hamburger / logo (centered) / cart -->
                    <div class="mobile-top-row py-3 lg:hidden">
                        <div class="justify-self-start">
                            <button id="mobile-menu-toggle-btn" type="button" aria-expanded="false"
                                aria-controls="mobile-nav-panel" aria-label="Toggle menu">
                                <svg class="icon-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <svg class="icon-close hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="justify-self-center">
                            <?php if ($mlt_logo_url): ?>
                                <a href="<?= esc_url(home_url('/')) ?>">
                                    <img src="<?= esc_url($mlt_logo_url) ?>" alt="<?= esc_attr(get_bloginfo('name')) ?>"
                                        class="h-10 w-auto" id="headerLogoMobile">
                                </a>
                            <?php elseif ($logo): ?>
                                <a href="<?= esc_url(home_url('/')) ?>">
                                    <img src="<?= esc_url($logo[0]) ?>" alt="<?= esc_attr(get_bloginfo('name')) ?>"
                                        class="h-10 w-auto" id="headerLogoMobile">
                                </a>
                            <?php else: ?>
                                <a href="<?= esc_url(home_url('/')) ?>" class="text-lg font-bold text-gray-900">
                                    <?= esc_html(get_bloginfo('name')) ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="justify-self-end">
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
                    </div>

                    <!-- MOBILE ROW 2: currency / language / search -->
                    <div class="flex items-center gap-2 pb-4 lg:hidden">
                        <div class="mobile-currency-switcher">
                            <?php echo do_shortcode('[wc_currency_switcher]'); ?>
                        </div>
                        <div class="mobile-lang-switcher">
                            <?php echo do_shortcode('[mlt_language_switcher]'); ?>
                        </div>
                        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"
                            class="relative flex-1 min-w-0">
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

                    <!-- DESKTOP ROW -->
                    <div class="hidden lg:flex h-20 items-center justify-between lg:h-24">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                            <?php if ($mlt_logo_url): ?>
                                <a href="<?= esc_url(home_url('/')) ?>">
                                    <img src="<?= esc_url($mlt_logo_url) ?>" alt="<?= esc_attr(get_bloginfo('name')) ?>"
                                        class="h-12 w-auto lg:h-14" id="headerLogo">
                                </a>
                            <?php elseif ($logo): ?>
                                <a href="<?= esc_url(home_url('/')) ?>">
                                    <img src="<?= esc_url($logo[0]) ?>" alt="<?= esc_attr(get_bloginfo('name')) ?>"
                                        class="h-12 w-auto lg:h-14" id="headerLogo">
                                </a>
                            <?php else: ?>
                                <a href="<?= esc_url(home_url('/')) ?>" class="text-xl font-bold text-gray-900 lg:text-2xl">
                                    <?= esc_html(get_bloginfo('name')) ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <!-- Desktop Search + Cart + Language -->
                        <div class="flex items-center space-x-6">
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
                </div>
            </div>

            <div id="mobile-nav-panel" class="bg-white mega-menu-wrap">
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

    <main class="flex-1 bg-gray-50"></main>
</body>

</html>