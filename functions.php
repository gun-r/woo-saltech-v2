<?php

/**
 * Theme Functions and Definitions
 * 
 * @package Chris_Tailwind_Woo
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// ============================================
// CONFIGURATION CONSTANTS
// ============================================

// Mailchimp Configuration
define('MAILCHIMP_API_KEY', 'your-mailchimp-api-key-here');
define('MAILCHIMP_AUDIENCE_ID', 'your-mailchimp-audience-id-here');

// Google Recaptcha v3 Configuration
define('RECAPTCHA_SITE_KEY', '6Lf2ESYsAAAAAPXIUhN5lT3UzYu6lzOB9EKvBvfa');
define('RECAPTCHA_SECRET_KEY', '6Lf2ESYsAAAAAJWn1x2F7XwjUvRTF5W4J4oXlTUY');

// Helper functions for configuration
function mytheme_get_mailchimp_config()
{
    return [
        'api_key' => MAILCHIMP_API_KEY,
        'audience_id' => MAILCHIMP_AUDIENCE_ID,
    ];
}

function mytheme_get_recaptcha_keys()
{
    return [
        'site_key' => RECAPTCHA_SITE_KEY,
        'secret_key' => RECAPTCHA_SECRET_KEY,
    ];
}

// ============================================
// GOOGLE TAG MANAGER
// ============================================

/* GTM <head> script */
add_action('wp_head', function () {
    ?>
    <!-- Google Tag Manager (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3VSHEN8D1Y"></script>
    <script>   window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', 'G-3VSHEN8D1Y'); </script>
    <!-- End Google Tag Manager -->
    <?php
}, 0);

/* GTM <body> noscript */
add_action('wp_body_open', function () {
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KL28SB6F" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
});

// ============================================
// OVERRIDE CURRENCY SYMBOL FOR DKK
// ============================================

add_filter('woocommerce_currency_symbol', 'change_dkk_currency_symbol', 10, 2);

function change_dkk_currency_symbol($currency_symbol, $currency)
{
    if ($currency == 'DKK') {
        $currency_symbol = 'DKK';
    }
    return $currency_symbol;
}

// ============================================
// THEME SETUP
// ============================================

/**
 * Theme setup and supports
 */
function chris_tailwind_setup()
{
    // Theme supports
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');

    // Custom Logo support
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ));

    // Menus
    register_nav_menus(array(
        'primary' => __('Main', 'chris-tailwind-woo'),
    ));
}
add_action('after_setup_theme', 'chris_tailwind_setup');

/**
 * Enqueue theme styles
 */
function chris_tailwind_enqueue()
{
    wp_enqueue_style('chris-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'chris_tailwind_enqueue');

// ============================================
// SINGLE PRODUCT - SWIPER SLIDER
// ============================================

/**
 * Enqueue Swiper slider for single product pages
 */
function custom_enqueue_swiper()
{
    if (is_product()) {
        // Swiper CSS
        wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], null);

        // Swiper JS
        wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], null, true);

        // Init Script
        wp_add_inline_script('swiper-js', "
            document.addEventListener('DOMContentLoaded', function() {
                var swiperThumbs = new Swiper('.mySwiperThumbs', {
                    spaceBetween: 10,
                    slidesPerView: 5,
                    freeMode: true,
                    watchSlidesProgress: true,
                });

                var swiperMain = new Swiper('.mySwiper2', {
                    loop: true,
                    spaceBetween: 10,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    thumbs: {
                        swiper: swiperThumbs,
                    },
                });
            });
        ");
    }
}
add_action('wp_enqueue_scripts', 'custom_enqueue_swiper');

// ============================================
// ALPINE.JS - PRODUCT TABS
// ============================================

/**
 * Enqueue Alpine.js for product tabs
 */
function my_enqueue_alpine()
{
    wp_enqueue_script('alpine', 'https://unpkg.com/alpinejs@3.15.3/dist/cdn.min.js', [], null, true);
    wp_enqueue_script(
        'alpine-collapse',
        'https://unpkg.com/@alpinejs/collapse@3.15.3/dist/cdn.min.js',
        ['alpine'],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'my_enqueue_alpine');

add_filter('woocommerce_product_tabs', 'saltech_danish_product_tabs', 98);

function saltech_danish_product_tabs($tabs)
{
    if (isset($tabs['description'])) {
        $tabs['description']['title'] = 'Beskrivelse';
    }

    if (isset($tabs['additional_information'])) {
        $tabs['additional_information']['title'] = 'Yderligere information';
    }

    if (isset($tabs['reviews'])) {
        $tabs['reviews']['title'] = 'Anmeldelser';
    }

    if (isset($tabs['downloads'])) {
        $tabs['downloads']['title'] = 'Downloads';
    }

    if (isset($tabs['videos'])) {
        $tabs['videos']['title'] = 'Videoer';
    }

    return $tabs;
}

add_filter('woocommerce_product_description_heading', '__return_empty_string');
add_filter('woocommerce_product_additional_information_heading', '__return_empty_string');

// ============================================
// WOOCOMMERCE - VARIATIONS SCRIPT
// ============================================

/**
 * Load WooCommerce variation script on product pages
 */
function load_wc_variation_script_fix()
{
    if (is_product()) {
        wp_enqueue_script('wc-add-to-cart-variation');
    }
}
add_action('wp_enqueue_scripts', 'load_wc_variation_script_fix', 99);

// ============================================
// WOOCOMMERCE - CART COUNT AJAX UPDATE
// ============================================

/**
 * Update cart count in header via AJAX
 */
function update_cart_count_fragment($fragments)
{
    ob_start();
    ?>
    <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
    <?php
    $fragments['.flow-root a span.ml-2'] = ob_get_clean();
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'update_cart_count_fragment');

// ============================================
// WOOCOMMERCE - RELATED PRODUCTS
// ============================================

/**
 * Modify related products to show products from the same category
 */
function custom_related_products_same_category($related_posts, $product_id, $args)
{
    $product = wc_get_product($product_id);

    if (!$product) {
        return $related_posts;
    }

    // Get product categories
    $terms = wc_get_product_terms($product_id, 'product_cat', array('fields' => 'ids'));

    if (empty($terms)) {
        return $related_posts;
    }

    // Set default values if not provided
    $posts_per_page = isset($args['posts_per_page']) ? $args['posts_per_page'] : 4;
    $orderby = isset($args['orderby']) ? $args['orderby'] : 'rand';

    // Query arguments to get products from same categories
    $query_args = array(
        'post_type' => 'product',
        'posts_per_page' => $posts_per_page,
        'post__not_in' => array($product_id),
        'orderby' => $orderby,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $terms,
                'operator' => 'IN'
            )
        ),
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_stock_status',
                'value' => 'instock',
                'compare' => '='
            )
        )
    );

    $query = new WP_Query($query_args);

    if ($query->have_posts()) {
        $related_posts = wp_list_pluck($query->posts, 'ID');
    }

    wp_reset_postdata();

    return $related_posts;
}
add_filter('woocommerce_related_products', 'custom_related_products_same_category', 10, 3);

/**
 * Change the number of related products displayed
 */
function custom_related_products_args($args)
{
    $args['posts_per_page'] = 12;
    $args['columns'] = 4;
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'custom_related_products_args');

// ============================================
// FILE UPLOADS
// ============================================

/**
 * Allow DWG file uploads
 */
function allow_dwg_uploads($mimes)
{
    $mimes['dwg'] = 'image/vnd.dwg';
    return $mimes;
}
add_filter('upload_mimes', 'allow_dwg_uploads');

// ============================================
// PRODUCT SKU
// ============================================

/**
 * Enable duplicate SKU (remove unique SKU requirement)
 */
add_filter('wc_product_has_unique_sku', '__return_false');

// ============================================
// SEARCH SYSTEM
// ============================================

/**
 * Get filtered product IDs based on search term
 * This function is called by the shop template
 * 
 * @param string $search_term The search query
 * @return array Array of product IDs or empty array
 */
function get_search_filtered_product_ids($search_term)
{
    if (empty($search_term)) {
        return array();
    }

    global $wpdb;

    $search_clean = trim($search_term);
    $search_like = '%' . $wpdb->esc_like($search_clean) . '%';

    $matching_product_ids = array();

    // 1. Search by SKU (main products) - including partial matches
    $sku_products = $wpdb->get_col($wpdb->prepare(
        "
        SELECT DISTINCT p.ID 
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
        WHERE p.post_type = 'product'
        AND p.post_status = 'publish'
        AND pm.meta_key = '_sku'
        AND (
            pm.meta_value LIKE %s
            OR pm.meta_value LIKE %s
            OR pm.meta_value LIKE %s
        )
    ",
        $search_like,
        $wpdb->esc_like($search_clean) . '-%',
        '%-' . $wpdb->esc_like($search_clean) . '-%'
    ));

    if (!empty($sku_products)) {
        $matching_product_ids = array_merge($matching_product_ids, $sku_products);
    }

    // 2. Search in variation SKUs and get parent product IDs
    $variation_parents = $wpdb->get_col($wpdb->prepare(
        "
        SELECT DISTINCT p.post_parent 
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
        WHERE p.post_type = 'product_variation'
        AND p.post_status = 'publish'
        AND p.post_parent > 0
        AND pm.meta_key = '_sku'
        AND (
            pm.meta_value LIKE %s
            OR pm.meta_value LIKE %s
            OR pm.meta_value LIKE %s
        )
    ",
        $search_like,
        $wpdb->esc_like($search_clean) . '-%',
        '%-' . $wpdb->esc_like($search_clean) . '-%'
    ));

    if (!empty($variation_parents)) {
        $matching_product_ids = array_merge($matching_product_ids, $variation_parents);
    }

    // 3. Search by product title
    $title_products = $wpdb->get_col($wpdb->prepare("
        SELECT ID 
        FROM {$wpdb->posts}
        WHERE post_type = 'product'
        AND post_status = 'publish'
        AND post_title LIKE %s
    ", $search_like));

    if (!empty($title_products)) {
        $matching_product_ids = array_merge($matching_product_ids, $title_products);
    }

    // 4. Search by product description
    $content_products = $wpdb->get_col($wpdb->prepare("
        SELECT ID 
        FROM {$wpdb->posts}
        WHERE post_type = 'product'
        AND post_status = 'publish'
        AND post_content LIKE %s
    ", $search_like));

    if (!empty($content_products)) {
        $matching_product_ids = array_merge($matching_product_ids, $content_products);
    }

    // 5. Search by short description
    $excerpt_products = $wpdb->get_col($wpdb->prepare("
        SELECT ID 
        FROM {$wpdb->posts}
        WHERE post_type = 'product'
        AND post_status = 'publish'
        AND post_excerpt LIKE %s
    ", $search_like));

    if (!empty($excerpt_products)) {
        $matching_product_ids = array_merge($matching_product_ids, $excerpt_products);
    }

    // 6. Search in categories
    $category_products = $wpdb->get_col($wpdb->prepare("
        SELECT DISTINCT p.ID
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
        INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        INNER JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
        WHERE p.post_type = 'product'
        AND p.post_status = 'publish'
        AND tt.taxonomy = 'product_cat'
        AND t.name LIKE %s
    ", $search_like));

    if (!empty($category_products)) {
        $matching_product_ids = array_merge($matching_product_ids, $category_products);
    }

    // 7. Search in tags
    $tag_products = $wpdb->get_col($wpdb->prepare("
        SELECT DISTINCT p.ID
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
        INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        INNER JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
        WHERE p.post_type = 'product'
        AND p.post_status = 'publish'
        AND tt.taxonomy = 'product_tag'
        AND t.name LIKE %s
    ", $search_like));

    if (!empty($tag_products)) {
        $matching_product_ids = array_merge($matching_product_ids, $tag_products);
    }

    // Remove duplicates
    $matching_product_ids = array_unique($matching_product_ids);

    return $matching_product_ids;
}

/**
 * Display clear search button
 *
 * @param string $search_term The search query
 * @param int $total_results Number of results found
 */
function display_search_results_header($search_term, $total_results)
{
    if (empty($search_term)) {
        return;
    }
    ?>
    <div style="margin-bottom: 10px;">
        <div style="display: flex; align-items: center; justify-content: flex-end;">
            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"
                style="background: white; color: #1f2937; padding: 10px 15px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; border: 1px solid #1f2937; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;"
                onmouseover="this.style.background='#1f2937'; this.style.color='white';"
                onmouseout="this.style.background='white'; this.style.color='#1f2937';">
                <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Clear Search
            </a>
        </div>
    </div>
    <?php
}
/**
 * Enhanced AJAX product search suggestions
 */
function enhanced_product_search_suggestions()
{
    $query = isset($_GET['query']) ? sanitize_text_field($_GET['query']) : '';

    if (empty($query)) {
        wp_send_json([]);
        return;
    }

    global $wpdb;
    $search_like = '%' . $wpdb->esc_like($query) . '%';
    $results_data = [];

    // Search by SKU first (highest priority)
    $sku_products = $wpdb->get_results($wpdb->prepare("
        SELECT DISTINCT p.ID, p.post_title, pm.meta_value as sku
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
        WHERE p.post_type = 'product'
        AND p.post_status = 'publish'
        AND pm.meta_key = '_sku'
        AND (
            pm.meta_value LIKE %s
            OR pm.meta_value LIKE %s
        )
        LIMIT 3
    ", $search_like, $wpdb->esc_like($query) . '-%'));

    foreach ($sku_products as $prod) {
        $product = wc_get_product($prod->ID);
        if (!$product)
            continue;

        $results_data[] = [
            'id' => $prod->ID,
            'name' => $product->get_name(),
            'url' => get_permalink($prod->ID),
            'image' => get_the_post_thumbnail_url($prod->ID, 'thumbnail') ?: wc_placeholder_img_src(),
            'price' => $product->get_price_html(),
            'sku' => $prod->sku,
        ];
    }

    // Search by title if we need more results
    if (count($results_data) < 6) {
        $title_products = $wpdb->get_results($wpdb->prepare("
            SELECT ID, post_title
            FROM {$wpdb->posts}
            WHERE post_type = 'product'
            AND post_status = 'publish'
            AND post_title LIKE %s
            LIMIT %d
        ", $search_like, 6 - count($results_data)));

        foreach ($title_products as $prod) {
            if (in_array($prod->ID, array_column($results_data, 'id'))) {
                continue;
            }

            $product = wc_get_product($prod->ID);
            if (!$product)
                continue;

            $results_data[] = [
                'id' => $prod->ID,
                'name' => $product->get_name(),
                'url' => get_permalink($prod->ID),
                'image' => get_the_post_thumbnail_url($prod->ID, 'thumbnail') ?: wc_placeholder_img_src(),
                'price' => $product->get_price_html(),
                'sku' => $product->get_sku(),
            ];
        }
    }

    wp_send_json($results_data);
}

add_action('wp_ajax_product_search_suggestions', 'enhanced_product_search_suggestions');
add_action('wp_ajax_nopriv_product_search_suggestions', 'enhanced_product_search_suggestions');

// ============================================
// MAILCHIMP NEWSLETTER
// ============================================

/**
 * Customize Mailchimp form messages
 */
function custom_mc4wp_messages($messages)
{
    $messages[1] = "Thank you for subscribing! You'll receive the latest news, articles, and resources weekly.";
    $messages['subscribed'] = "Thank you for subscribing! You'll receive the latest news, articles, and resources weekly.";
    $messages['invalid_email'] = "Please enter a valid email address.";
    $messages['already_subscribed'] = "You're already subscribed to our newsletter!";
    $messages['error'] = "Something went wrong. Please try again later.";
    $messages['required_field_missing'] = "Please fill in all required fields.";
    return $messages;
}
add_filter('mc4wp_form_messages', 'custom_mc4wp_messages');

/**
 * Add custom CSS class to Mailchimp form
 */
function custom_mc4wp_css_classes($classes, $form)
{
    $classes[] = 'newsletter-footer-form';
    return $classes;
}
add_filter('mc4wp_form_css_classes', 'custom_mc4wp_css_classes', 10, 2);

// ============================================
// AJAX - LOAD MORE FEATURED PRODUCTS
// ============================================

/**
 * AJAX handler for loading more featured products
 */
function load_more_featured_products()
{
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;

    $args = [
        'post_type' => 'product',
        'posts_per_page' => 10,
        'offset' => $offset,
        'post_status' => 'publish',
        'orderby' => 'rand',
        'tax_query' => [
            [
                'taxonomy' => 'product_visibility',
                'field' => 'name',
                'terms' => 'featured',
                'operator' => 'IN',
            ]
        ]
    ];

    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
        ob_start();

        while ($loop->have_posts()) {
            $loop->the_post();
            global $product;
            ?>
            <div
                class="relative bg-white rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
                <!-- Product Image -->
                <a href="<?php the_permalink(); ?>" class="block relative overflow-hidden bg-gray-100 aspect-square">
                    <?php
                    if (has_post_thumbnail()) {
                        echo get_the_post_thumbnail($product->get_id(), 'woocommerce_thumbnail', [
                            'class' => 'w-full h-full object-cover'
                        ]);
                    } else {
                        echo '<div class="w-full h-full flex items-center justify-center bg-gray-200">';
                        echo '<svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                        echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>';
                        echo '</div>';
                    }
                    ?>

                    <!-- Sale Badge -->
                    <?php if ($product->is_on_sale()): ?>
                        <span
                            class="absolute top-2 right-2 px-2 py-1 bg-red-700 text-white text-xs font-bold rounded-md shadow-md">SALE</span>
                    <?php endif; ?>

                    <!-- Stock Badge -->
                    <?php if (!$product->is_in_stock()): ?>
                        <span class="absolute top-2 left-2 px-2 py-1 bg-gray-900 text-white text-xs font-bold rounded-md shadow-md">OUT
                            OF STOCK</span>
                    <?php endif; ?>
                </a>

                <!-- Product Info -->
                <div class="p-3 sm:p-4 flex flex-col flex-grow">
                    <h3 class="text-sm font-medium text-gray-900 mb-2 line-clamp-2 min-h-[40px]">
                        <a href="<?php the_permalink(); ?>" class="hover:text-red-700 transition-colors">
                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <?php if (wc_review_ratings_enabled() && $product->get_rating_count()): ?>
                        <div class="flex items-center mb-2">
                            <div class="flex items-center text-yellow-400">
                                <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                            </div>
                            <span class="ml-1 text-xs text-gray-500">(<?php echo $product->get_rating_count(); ?>)</span>
                        </div>
                    <?php endif; ?>

                    <?php
                    $product_price = $product->get_price();
                    $is_zero_price = empty($product_price) || floatval($product_price) == 0;
                    ?>

                    <?php if (!$is_zero_price): ?>
                        <div class="mb-3 text-base sm:text-lg font-bold text-gray-900">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                    <?php endif; ?>

                    <div class="mt-auto pt-2">
                        <?php if ($is_zero_price): ?>
                            <a href="mailto:support@sal-tech.com?subject=Price Request for <?php echo urlencode(get_the_title()); ?>&body=I would like to request pricing information for: <?php echo urlencode(get_the_title()); ?> (Product ID: <?php echo $product->get_id(); ?>)"
                                class="request-btn gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <!-- Request Price -->
                                Forespørg pris
                            </a>
                        <?php else: ?>
                            <?php woocommerce_template_loop_add_to_cart(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
        }

        $html = ob_get_clean();
        wp_reset_postdata();

        wp_send_json_success(['html' => $html]);
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_load_more_featured_products', 'load_more_featured_products');
add_action('wp_ajax_nopriv_load_more_featured_products', 'load_more_featured_products');

add_action('after_setup_theme', function () {
    add_image_size('stpp-gallery', 1200, 1200, false); // false = scale to fit, never crop
});

/**
 * Add shipping notice below order total
 */
/*
function add_notice_below_order_total_once()
{
    if (is_checkout() && !is_wc_endpoint_url('order-received')) {
        echo '<div class="fc-shipping-notice-below" style="background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 0.375rem; padding: 1rem; margin-top: 1.5rem;">
            <div style="display: flex; align-items: start;">
                <svg style="width: 1.25rem; height: 1.25rem; color: #3b82f6; flex-shrink: 0; margin-right: 0.75rem; margin-top: 2px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <div style="color: #1e40af;">
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: #1e3a8a; margin: 0 0 0.25rem 0;">Please Note</h3>
                    <p style="font-size: 0.875rem; color: #1e40af; margin: 0;">
                        The total amount shown (including tax) is <strong>not your final price</strong>. Shipping costs will be added based on your location. Our team will contact you with the final total before payment.
                    </p>
                </div>
            </div>
        </div>';
    }
}
add_action('woocommerce_after_checkout_form', 'add_notice_below_order_total_once');
*/

// 1. Render the checkbox above the Place Order button
add_action('woocommerce_review_order_before_submit', 'stg_b2b_checkout_checkbox');
function stg_b2b_checkout_checkbox()
{
    echo '<p class="form-row stg-b2b-checkbox" style="margin-top:12px;">
        <label style="display:flex;align-items:flex-start;gap:8px;font-size:13px;color:#111;cursor:pointer;">
            <input type="checkbox" name="stg_b2b_confirmation" id="stg_b2b_confirmation" style="margin-top:3px;" />
            <span>
                Jeg bekræfter, at jeg handler som virksomhed (B2B-kunde), og at forbrugerbeskyttelseslovgivning ikke finder anvendelse på dette køb.
                <!-- I confirm I am purchasing as a business (B2B customer) and that consumer protection law does not apply to this purchase. -->
            </span>
        </label>
    </p>';
}

// 2. Block order placement if it isn't ticked
add_action('woocommerce_checkout_process', 'stg_b2b_checkout_validate');
function stg_b2b_checkout_validate()
{
    if (empty($_POST['stg_b2b_confirmation'])) {
        wc_add_notice('Du skal bekræfte, at du handler som virksomhed (B2B), før du kan gennemføre købet.', 'error');
    }
}

/**
 * Modify cart total label to show it excludes shipping
 */
function modify_cart_total_label($value)
{
    return $value . ' <small style="font-weight: normal; color: #6B7280; font-size: 0.875rem;">(Ekskl. Fragt)</small>';
}
add_filter('woocommerce_cart_totals_order_total_html', 'modify_cart_total_label');

/**
 * Hide shipping CSS for cart and checkout
 */
function hide_shipping_css_fluid_checkout()
{
    if (is_cart() || is_checkout()) {
        echo '<style>
            .cart-subtotal + tr.shipping,
            tr.woocommerce-shipping-totals,
            tr.shipping,
            .shipping,
            #shipping_method,
            .woocommerce-shipping-calculator,
            .shipping-calculator-button,
            .shipping-calculator-form {
                display: none !important;
            }
        </style>';
    }
}
add_action('wp_head', 'hide_shipping_css_fluid_checkout');

/**
 * Add "(excl. shipping)" to order total row label
 */
function add_excl_shipping_to_total($total_rows, $order, $tax_display)
{
    if (isset($total_rows['order_total'])) {
        $total_rows['order_total']['label'] = __('Total', 'woocommerce') . ' <small style="font-weight: normal; color: #6B7280;">(excl. shipping)</small>';
    }
    return $total_rows;
}
add_filter('woocommerce_get_order_item_totals', 'add_excl_shipping_to_total', 10, 3);

/**
 * Add admin note to orders about shipping
 */
function add_shipping_note_to_order($order_id)
{
    $order = wc_get_order($order_id);
    if ($order) {
        $order->add_order_note('⚠️ REMINDER: Calculate and add shipping cost before contacting customer for payment.');
    }
}
add_action('woocommerce_order_status_pending', 'add_shipping_note_to_order');
add_action('woocommerce_order_status_processing', 'add_shipping_note_to_order');

// ============================================
// translate every checkout labels to danish
// ============================================

add_filter('gettext', 'saltech_checkout_danish_labels', 999, 3);

function saltech_checkout_danish_labels($translated, $text, $domain)
{
    $translations = array(
        'Edit cart' => 'Rediger indkøbskurv',
        'First name' => 'Fornavn',
        'Last name' => 'Efternavn',
        'Country / Region' => 'Land / Region',
        'Street address' => 'Adresse',
        'Postcode / ZIP' => 'Postnummer',
        'Town / City' => 'By',
        'Phone' => 'Telefonnr.',
        'Email address' => 'E-mailadresse',

        'Proceed to billing' => 'Fortsæt til fakturering',
        'Proceed to payment' => 'Fortsæt til betaling',

        'House number and street name' => 'Vejnavn og husnummer',
        'Order number and receipt will be sent to this email address.' => 'Ordrenummer og kvittering sendes til denne e-mailadresse.',
        'Apartment, unit, building, floor, etc.' => 'Lejlighed, etage, suite mv.',

        // Fluid Checkout
        'Additional notes' => 'Yderligere bemærkninger',
        'Order summary' => 'Ordreoversigt',

        'Card number' => 'Kortnummer',
        'MM / YY' => 'MM/ÅÅ',
        'CVV' => 'CVV',
        'Same as shipping address' => 'Samme som leveringsadresse',
        'Place order' => 'Bekræft ordre',
    );

    if (isset($translations[$text])) {
        return $translations[$text];
    }

    return $translated;
}

add_action('wp_footer', function () {
    if (!is_checkout()) {
        return;
    }
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.fc-step__substep-title--contact').forEach(function (el) {
                el.textContent = 'Kontakt';
            });
            document.querySelectorAll('.fc-step__substep-edit').forEach(function (el) {
                el.textContent = 'Ændre';
            });
            document.querySelectorAll('.fc-step__substep-title.fc-step__substep-title--billing_address').forEach(function (el) {
                el.textContent = 'Faktureringsadresse';
            });
            document.querySelectorAll('.fc-step__substep-title.fc-step__substep-title--shipping_address').forEach(function (el) {
                el.textContent = 'Leveringsadresse';
            });
            document.querySelectorAll('.fc-step__substep-title.fc-step__substep-title--shipping_method').forEach(function (el) {
                el.textContent = 'Leveringsmetode';
            });
            document.querySelectorAll('.fc-step__substep-title.fc-step__substep-title--payment').forEach(function (el) {
                el.textContent = 'Betalingsform';
            });
            document.querySelectorAll('.button alt ppcp-dcc-order-button button alt fc-place-order-button wp-element-button').forEach(function (el) {
                el.textContent = 'Bekræft ordre';
            });

            document.querySelectorAll('[data-step-count-text]').forEach(function (el) {

                let current = el.querySelector('[data-step-count-current]')?.textContent || '';
                let total = el.querySelector('[data-step-count-total]')?.textContent || '';

                el.innerHTML =
                    'Trin <span class="fc-progress-bar__current-step" data-step-count-current>' +
                    current +
                    '</span> af <span class="fc-progress-bar__total-steps" data-step-count-total>' +
                    total +
                    '</span>';

            });

            document.querySelectorAll('[data-step-save]').forEach(function (el) {
                el.textContent = 'Gem ændringer';
            });

        });
    </script>
    <?php
});

add_filter('gettext', function ($translated, $original, $domain) {
    if ($domain !== 'woocommerce')
        return $translated;

    $strings = [
        '“%s” has been added to your cart.' => '“%s” er blevet tilføjet til din kurv.',
        'View cart' => 'Se kurv',
    ];

    return $strings[$original] ?? $translated;
}, 10, 3);

add_filter('woocommerce_checkout_fields', function ($fields) {

    // Address 2
    if (isset($fields['billing']['billing_address_2'])) {

        $fields['billing']['billing_address_2']['label'] =
            'Lejlighed, etage, suite mv.';

        $fields['billing']['billing_address_2']['placeholder'] = '';
    }

    // Order comments
    if (isset($fields['order']['order_comments'])) {

        $fields['order']['order_comments']['label'] =
            'Bemærkninger til ordren';

        $fields['order']['order_comments']['placeholder'] = '';
    }

    return $fields;

}, 999);

add_filter('woocommerce_dropdown_variation_attribute_options_args', function ($args) {
    $args['show_option_none'] = 'Vælg mulighed';
    return $args;
});

add_action('wp_footer', function () { ?>
    <script>
        document.querySelectorAll('input[type="file"]').forEach(function (input) {
            input.addEventListener('change', function () {
                const label = this.nextElementSibling;
                if (label) {
                    label.textContent = this.files[0]
                        ? this.files[0].name
                        : 'Der er ikke valgt nogen fil';
                }
            });
        });
    </script>
<?php });

// ── Danish Order Statuses ─────────────────────────────
add_filter('wc_order_statuses', function ($statuses) {
    return [
        'wc-pending' => 'Afventer betaling',
        'wc-processing' => 'Behandles',
        'wc-on-hold' => 'På pause',
        'wc-completed' => 'Fuldført',
        'wc-cancelled' => 'Annulleret',
        'wc-refunded' => 'Refunderet',
        'wc-failed' => 'Mislykket',
        'wc-checkout-draft' => 'Kladde',
    ];
});

// ============================================
// CUSTOM THANK YOU PAGE - AUTO REDIRECT
// ============================================

/**
 * Auto-redirect from WooCommerce Order Received page to Custom Thank You page
 */
function custom_thankyou_redirect()
{
    if (is_order_received_page()) {
        global $wp;
        $order_id = isset($wp->query_vars['order-received']) ? absint($wp->query_vars['order-received']) : 0;

        if ($order_id) {
            $thank_you_page = home_url('/thank-you/?order_id=' . $order_id);
            ?>
            <script type="text/javascript">
                setTimeout(function () {
                    window.location.href = '<?php echo esc_url($thank_you_page); ?>';
                }, 4000);
            </script>
            <?php
        }
    }
}
add_action('wp_footer', 'custom_thankyou_redirect');

/**
 * Add a redirect notice to the default order received page
 */
function add_redirect_notice()
{
    if (is_order_received_page()) {
        ?>
        <style>
            .redirect-notice {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 16px 24px;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                font-size: 14px;
                font-weight: 500;
                z-index: 9999;
                animation: slideIn 0.5s ease-out;
                display: flex;
                align-items: center;
                gap: 12px;
            }

            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }

                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            .redirect-notice .spinner {
                width: 20px;
                height: 20px;
                border: 3px solid rgba(255, 255, 255, 0.3);
                border-top-color: white;
                border-radius: 50%;
                animation: spin 0.8s linear infinite;
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }
        </style>

        <div class="redirect-notice">
            <div class="spinner"></div>
            <span>Redirecting to your order confirmation...</span>
        </div>
        <?php
    }
}
add_action('wp_footer', 'add_redirect_notice');

// ============================================
// CONTACT FORM HANDLING
// ============================================

add_action('admin_post_nopriv_send_contact_form', 'handle_contact_form');
add_action('admin_post_send_contact_form', 'handle_contact_form');

function handle_contact_form()
{
    $redirect = wp_get_referer() ?: home_url('/contact-us');

    // ===== Security: Nonce =====
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'contact_form_nonce')) {
        wp_redirect(add_query_arg('error', 'nonce', $redirect));
        exit;
    }

    // ===== Sanitize inputs =====
    $subject = sanitize_text_field($_POST['subject'] ?? '');
    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($subject) || empty($name) || empty($email) || empty($message)) {
        wp_redirect(add_query_arg('error', 'empty', $redirect));
        exit;
    }

    if (!is_email($email)) {
        wp_redirect(add_query_arg('error', 'email', $redirect));
        exit;
    }

    // ===== Handle file attachment =====
    $attachments = [];

    if (!empty($_FILES['attachment']['name'])) {

        $allowed_types = [
            'image/jpeg',
            'image/png',
            'application/pdf'
        ];

        $max_size = 5 * 1024 * 1024; // 5MB

        if ($_FILES['attachment']['size'] > $max_size) {
            wp_redirect(add_query_arg('error', 'attachment', $redirect));
            exit;
        }

        if (!in_array($_FILES['attachment']['type'], $allowed_types, true)) {
            wp_redirect(add_query_arg('error', 'attachment', $redirect));
            exit;
        }

        // Upload using WordPress
        require_once ABSPATH . 'wp-admin/includes/file.php';

        $upload = wp_handle_upload($_FILES['attachment'], [
            'test_form' => false
        ]);

        if (isset($upload['file'])) {
            $attachments[] = $upload['file'];
        } else {
            wp_redirect(add_query_arg('error', 'attachment', $redirect));
            exit;
        }
    }

    // ===== Email =====
    $to = 'support@sal-tech.com';
    $mail_subject = "Contact Form: {$subject}";
    $body = "Name: {$name}\nEmail: {$email}\n\nMessage:\n{$message}";
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$name} <{$email}>"
    ];

    if (wp_mail($to, $mail_subject, $body, $headers, $attachments)) {
        wp_redirect(add_query_arg('sent', '1', $redirect));
    } else {
        wp_redirect(add_query_arg('error', 'send', $redirect));
    }

    exit;
}

// ============================================
// PASSWORD RECOVERY AND RESET
// ============================================

add_filter('lostpassword_url', function () {
    return site_url('/forgot-password');
});

add_filter('login_url', function ($url) {
    return site_url('/authentication');
});

add_filter('login_redirect', function () {
    return site_url('/authentication');
});

add_filter('retrieve_password_message', function ($message, $key, $user_login, $user_data) {

    $reset_url = site_url("/reset-password?key=$key&login=" . rawurlencode($user_login));

    $message = "Hello,\n\n";
    $message .= "Click the link below to reset your password:\n\n";
    $message .= "$reset_url\n\n";
    $message .= "If you did not request this change, you can ignore this message.\n\n";

    return $message;
}, 10, 4);

// ============================================
// EMAIL VERIFICATION AFTER REGISTRATION
// ============================================

/**
 * Prevent login if email is not verified
 */
function prevent_unverified_login($user, $username, $password)
{
    if (is_wp_error($user)) {
        return $user;
    }

    $is_verified = get_user_meta($user->ID, 'email_verified', true);

    if ($is_verified !== '1') {
        // Store the email for the resend page
        setcookie('unverified_email', $user->user_email, time() + 300, '/');

        return new WP_Error(
            'email_not_verified',
            '__EMAIL_NOT_VERIFIED__' // Special marker to detect in template
        );
    }

    return $user;
}
add_filter('authenticate', 'prevent_unverified_login', 30, 3);

/**
 * Handle email verification when user clicks the link
 */
function handle_email_verification()
{
    if (!isset($_GET['action']) || $_GET['action'] !== 'verify_email') {
        return;
    }

    if (!isset($_GET['token']) || !isset($_GET['user'])) {
        wp_die('Invalid verification link.');
    }

    $user_id = intval($_GET['user']);
    $token = sanitize_text_field($_GET['token']);

    // Get stored token and expiry
    $stored_token = get_user_meta($user_id, 'email_verification_token', true);
    $expiry = get_user_meta($user_id, 'email_verification_expiry', true);

    // Validate token
    if ($token !== $stored_token) {
        wp_die('Invalid verification token. Please request a new verification email.');
    }

    // Check if expired
    if (time() > $expiry) {
        wp_die('Verification link has expired. Please request a new verification email.');
    }

    // Mark email as verified
    update_user_meta($user_id, 'email_verified', '1');
    update_user_meta($user_id, 'email_verified_date', current_time('mysql'));
    delete_user_meta($user_id, 'email_verification_token');
    delete_user_meta($user_id, 'email_verification_expiry');

    // Log the user in automatically
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id, true);

    // Trigger login hook for other plugins
    do_action('wp_login', get_userdata($user_id)->user_login, get_userdata($user_id));

    // Set a cookie to notify other tabs
    setcookie('user_just_logged_in', '1', time() + 10, '/', '', false, false);

    // Get the redirect URL from cookie or default to homepage
    $redirect_to = isset($_COOKIE['verification_redirect']) ? $_COOKIE['verification_redirect'] : home_url('/');

    // Clear the cookie
    setcookie('verification_redirect', '', time() - 3600, '/');

    // Remove any other verification parameters
    $redirect_to = remove_query_arg(['alg_wc_ev_success_activation_message', 'alg_wc_ev_verify_email'], $redirect_to);

    // Redirect with success message to homepage
    $redirect_url = add_query_arg('verified', '1', home_url('/'));
    wp_redirect($redirect_url);
    exit;
}
add_action('template_redirect', 'handle_email_verification', 1);

/**
 * Display verification success message on homepage
 */
function display_verification_success_message()
{
    if (isset($_GET['verified']) && $_GET['verified'] === '1' && is_user_logged_in()) {
        $user = wp_get_current_user();
        ?>
        <div
            style="position: fixed; top: 20px; right: 20px; z-index: 9999; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 16px 24px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); max-width: 400px; animation: slideIn 0.5s ease-out;">
            <div style="display: flex; align-items: start; gap: 12px;">
                <svg style="width: 24px; height: 24px; flex-shrink: 0;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <div>
                    <h3 style="font-weight: 600; margin: 0 0 4px 0;">Welcome,
                        <?php echo esc_html($user->first_name ? $user->first_name : $user->display_name); ?>!
                    </h3>
                    <p style="font-size: 14px; margin: 0;">Your email has been verified successfully. You're now logged in and
                        can start shopping!</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()"
                    style="background: none; border: none; color: white; cursor: pointer; font-size: 20px; line-height: 1; padding: 0; margin-left: auto; opacity: 0.8; transition: opacity 0.2s;"
                    onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">×</button>
            </div>
        </div>

        <style>
            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }

                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        </style>

        <script>
            // Auto-hide after 8 seconds
            setTimeout(function () {
                const notice = document.querySelector("div[style*='position: fixed']");
                if (notice) {
                    notice.style.animation = 'slideOut 0.5s ease-out forwards';
                    setTimeout(() => notice.remove(), 500);
                }
            }, 8000);

            // Add slideOut animation
            const style = document.createElement('style');
            style.textContent = '@keyframes slideOut { to { transform: translateX(400px); opacity: 0; } }';
            document.head.appendChild(style);
        </script>
        <?php
    }
}
add_action('wp_footer', 'display_verification_success_message');

/**
 * Show floating verification reminder for unverified users
 */
function show_floating_verification_reminder()
{
    // Only show if user is logged in
    if (!is_user_logged_in()) {
        return;
    }

    $user_id = get_current_user_id();
    $is_verified = get_user_meta($user_id, 'email_verified', true);

    // Only show if NOT verified
    if ($is_verified === '1') {
        return;
    }

    $user = wp_get_current_user();
    ?>
    <style>
        .verify-email-float {
            position: fixed;
            left: 20px;
            bottom: 20px;
            z-index: 9998;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border-radius: 50px;
            padding: 16px 24px;
            box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            animation: pulse 2s infinite, slideInLeft 0.5s ease-out;
            max-width: 90vw;
        }

        .verify-email-float:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(239, 68, 68, 0.5);
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }

        .verify-email-float .icon-pulse {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            animation: iconPulse 1.5s ease-in-out infinite;
        }

        .verify-email-float .text-content {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .verify-email-float .title {
            font-weight: 600;
            font-size: 14px;
            line-height: 1.2;
        }

        .verify-email-float .subtitle {
            font-size: 12px;
            opacity: 0.9;
            line-height: 1.2;
        }

        .verify-email-float .close-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            padding: 0;
            margin-left: 8px;
            transition: background 0.2s;
            flex-shrink: 0;
        }

        .verify-email-float .close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
            }

            50% {
                box-shadow: 0 4px 30px rgba(239, 68, 68, 0.6);
            }
        }

        @keyframes iconPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-400px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutLeft {
            to {
                transform: translateX(-400px);
                opacity: 0;
            }
        }

        @media (max-width: 640px) {
            .verify-email-float {
                left: 10px;
                bottom: 10px;
                padding: 12px 16px;
                border-radius: 40px;
            }

            .verify-email-float .title {
                font-size: 13px;
            }

            .verify-email-float .subtitle {
                font-size: 11px;
            }

            .verify-email-float .icon-pulse {
                width: 20px;
                height: 20px;
            }
        }
    </style>

    <a href="<?php echo esc_url(site_url('/resend-verification')); ?>" class="verify-email-float" id="verify-email-float">
        <svg class="icon-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        <div class="text-content">
            <div class="title">Email Not Verified</div>
            <div class="subtitle">Click here to verify your account</div>
        </div>
        <button class="close-btn" onclick="event.preventDefault(); dismissVerificationReminder();"
            title="Dismiss">X</button>
    </a>

    <script>
        function dismissVerificationReminder() {
            const floatElem = document.getElementById('verify-email-float');
            if (floatElem) {
                floatElem.style.animation = 'slideOutLeft 0.3s ease-out forwards';
                setTimeout(() => floatElem.remove(), 300);

                // Store dismissal in session (will show again on next page load)
                sessionStorage.setItem('verifyReminderDismissed', 'true');
            }
        }

        // Check if reminder was dismissed in this session
        document.addEventListener('DOMContentLoaded', function () {
            if (sessionStorage.getItem('verifyReminderDismissed') === 'true') {
                const floatElem = document.getElementById('verify-email-float');
                if (floatElem) {
                    floatElem.style.display = 'none';
                }
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'show_floating_verification_reminder');

// ============================================
// PREVENT 403 AFTER LOGOUT
// ============================================

/**
 * Enhanced logout with security plugin compatibility
 * This bypasses Wordfence's rate limiting on logout
 */
function custom_secure_logout()
{
    // Clear all authentication cookies
    wp_clear_auth_cookie();

    // Clear WooCommerce session
    if (function_exists('WC')) {
        WC()->session->destroy_session();
        WC()->cart->empty_cart();
    }

    // Set a flag for cross-tab sync
    setcookie('user_logged_out', '1', time() + 10, '/', '', is_ssl(), false);

    // Redirect to home with logout flag
    wp_safe_redirect(add_query_arg('logged_out', '1', home_url('/')));
    exit;
}

// Replace the default logout action
remove_action('wp_logout', 'wp_logout');
add_action('wp_logout', 'custom_secure_logout');

/**
 * Whitelist logout URL in Wordfence (if you can't disable rate limiting)
 * Add this to tell Wordfence to ignore logout requests
 */
function wordfence_whitelist_logout($is_blocked, $ip, $reason)
{
    // Check if this is a logout request
    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        return false; // Don't block logout
    }
    return $is_blocked;
}
add_filter('wordfence_ip_is_blocked', 'wordfence_whitelist_logout', 10, 3);

/**
 * Alternative: Use session-based logout instead of cookie-based
 * This avoids triggering security plugins
 */
function session_based_logout_redirect($redirect_to, $requested_redirect_to, $user)
{
    // Store logout event in database option (temporary)
    $logout_key = 'user_logout_' . $user->ID . '_' . time();
    set_transient($logout_key, '1', 60); // 1 minute

    // Clear session
    if (isset($_SESSION)) {
        session_destroy();
    }

    return add_query_arg([
        'logged_out' => '1',
        'logout_key' => $logout_key
    ], home_url('/'));
}
add_filter('logout_redirect', 'session_based_logout_redirect', 10, 3);

// ============================================
// IMPROVED CROSS-TAB LOGOUT SYNC
// ============================================

/**
 * Enhanced cross-tab logout using multiple methods
 * Works even with strict security plugins
 */
function enhanced_cross_tab_sync()
{
    ?>
    <script>
        (function () {
            'use strict';

            // Method 1: localStorage (blocked by some security plugins)
            try {
                if (document.cookie.indexOf('user_logged_out=1') !== -1) {
                    localStorage.setItem('logout_event', Date.now().toString());
                    document.cookie = 'user_logged_out=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                }

                window.addEventListener('storage', function (e) {
                    if (e.key === 'logout_event' && e.newValue) {
                        window.location.href = '<?php echo esc_url(home_url('/')); ?>';
                    }
                });
            } catch (e) {
                console.log('localStorage blocked, using alternative method');
            }

            // Method 2: BroadcastChannel API (modern browsers)
            if ('BroadcastChannel' in window) {
                const logoutChannel = new BroadcastChannel('user_logout_channel');

                // Check if user just logged out
                if (document.cookie.indexOf('user_logged_out=1') !== -1) {
                    logoutChannel.postMessage({
                        action: 'logout',
                        timestamp: Date.now()
                    });
                    document.cookie = 'user_logged_out=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                }

                // Listen for logout messages
                logoutChannel.addEventListener('message', function (event) {
                    if (event.data.action === 'logout') {
                        window.location.href = '<?php echo esc_url(home_url('/')); ?>';
                    }
                });
            }

            // Method 3: Polling (fallback for strict security)
            // Check server every 5 seconds if user is still logged in
            <?php if (is_user_logged_in()): ?>
                setInterval(function () {
                    fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=check_login_status', {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.logged_in) {
                                window.location.href = '<?php echo esc_url(home_url('/')); ?>';
                            }
                        })
                        .catch(err => console.log('Status check failed'));
                }, 5000); // Check every 5 seconds
            <?php endif; ?>

            // Method 4: SharedWorker (if available)
            if ('SharedWorker' in window) {
                try {
                    const logoutWorker = new SharedWorker('data:text/javascript,' + encodeURIComponent(`
                    const connections = [];
                    self.onconnect = function(e) {
                        const port = e.ports[0];
                        connections.push(port);
                        
                        port.onmessage = function(event) {
                            if (event.data === 'logout') {
                                connections.forEach(p => p.postMessage('logout'));
                            }
                        };
                    };
                `));

                    logoutWorker.port.start();

                    if (document.cookie.indexOf('user_logged_out=1') !== -1) {
                        logoutWorker.port.postMessage('logout');
                    }

                    logoutWorker.port.onmessage = function (e) {
                        if (e.data === 'logout') {
                            window.location.href = '<?php echo esc_url(home_url('/')); ?>';
                        }
                    };
                } catch (e) {
                    console.log('SharedWorker not available');
                }
            }
        })();
    </script>
    <?php
}
add_action('wp_footer', 'enhanced_cross_tab_sync', 1);

/**
 * AJAX handler to check login status (for polling method)
 */
function check_user_login_status()
{
    wp_send_json([
        'logged_in' => is_user_logged_in(),
        'timestamp' => time()
    ]);
}
add_action('wp_ajax_check_login_status', 'check_user_login_status');
add_action('wp_ajax_nopriv_check_login_status', function () {
    wp_send_json(['logged_in' => false]);
});

/**
 * Block checkout if email is not verified
 */
function block_checkout_if_not_verified()
{
    if (!is_checkout()) {
        return;
    }

    // Only check for logged-in users
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $is_verified = get_user_meta($user_id, 'email_verified', true);

        if ($is_verified !== '1') {
            setcookie('verification_redirect', wc_get_checkout_url(), time() + 3600, '/');
            wc_add_notice(
                'Please verify your email address before proceeding to checkout. <a href="' . site_url('/resend-verification') . '" style="text-decoration: underline; font-weight: bold;">Click here to resend verification email</a>',
                'error'
            );
            wp_redirect(wc_get_cart_url());
            exit;
        }
    }
    // Guests can proceed to checkout - they'll verify during checkout
}
add_action('template_redirect', 'block_checkout_if_not_verified');

/**
 * Show verification notice in cart and checkout for unverified users
 */
function show_verification_notice_in_cart()
{
    // Only for logged-in users
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $is_verified = get_user_meta($user_id, 'email_verified', true);

        if ($is_verified !== '1') {
            // Store current page
            setcookie('verification_redirect', $_SERVER['REQUEST_URI'], time() + 3600, '/');

            echo '<div class="woocommerce-info" style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin-bottom: 20px;">';
            echo '<strong>⚠️ Email Verification Required</strong><br>';
            echo 'You need to verify your email address before you can complete your purchase. ';
            echo '<a href="' . site_url('/resend-verification') . '" style="text-decoration: underline; font-weight: bold; color: #856404;">Verify your account now</a>';
            echo '</div>';
        }
    }
    // Guests will see verification section during checkout
}
add_action('woocommerce_before_cart', 'show_verification_notice_in_cart');
add_action('woocommerce_before_checkout_form', 'show_verification_notice_in_cart');

/**
 * Handle resend verification email request
 */
add_action('admin_post_nopriv_resend_verification_email', 'handle_resend_verification');
add_action('admin_post_resend_verification_email', 'handle_resend_verification');

function handle_resend_verification()
{
    $redirect = site_url('/resend-verification');

    // Verify nonce
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'resend_verification_nonce')) {
        wp_redirect(add_query_arg('error', 'nonce', $redirect));
        exit;
    }

    $email = sanitize_email($_POST['email'] ?? '');

    if (empty($email) || !is_email($email)) {
        wp_redirect(add_query_arg('error', 'invalid_email', $redirect));
        exit;
    }

    $user = get_user_by('email', $email);

    if (!$user) {
        // Don't reveal if email exists or not for security
        wp_redirect(add_query_arg('resent', '1', $redirect));
        exit;
    }

    $is_verified = get_user_meta($user->ID, 'email_verified', true);

    if ($is_verified === '1') {
        wp_redirect(add_query_arg('error', 'already_verified', $redirect));
        exit;
    }

    // Generate new token
    $verification_token = wp_generate_password(32, false);
    $expiry = time() + (24 * 60 * 60);

    update_user_meta($user->ID, 'email_verification_token', $verification_token);
    update_user_meta($user->ID, 'email_verification_expiry', $expiry);

    // Create verification URL
    $verification_url = add_query_arg([
        'action' => 'verify_email',
        'token' => $verification_token,
        'user' => $user->ID
    ], site_url());

    // Send email
    $to = $user->user_email;
    $subject = 'Verify Your Email Address - ' . get_bloginfo('name');

    // HTML Email
    $message = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff;">
                    <!-- Header -->
                    <tr>
                        <td style="padding: 40px 40px 20px; text-align: center; border-bottom: 3px solid #3b82f6; background-color: #ffffff;">
                            <h1 style="margin: 0; Margin: 0; color: #1f2937; font-size: 28px; font-weight: 600;">Email Verification</h1>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px; background-color: #ffffff;">
                            <p style="margin: 0 0 20px 0; Margin: 0 0 20px 0; color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Hello <strong style="font-weight: bold;">' . esc_html($user->display_name) . '</strong>,
                            </p>
                            <p style="margin: 0 0 20px 0; Margin: 0 0 20px 0; color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Here is your new verification link. Click the button below to verify your email address.
                            </p>
                            
                            <!-- Button - OUTLOOK COMPATIBLE -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0; Margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <table cellpadding="0" cellspacing="0" style="background-color: #3b82f6; border-radius: 6px;">
                                            <tr>
                                                <td style="padding: 16px 40px; text-align: center;">
                                                    <a href="' . esc_url($verification_url) . '" style="color: #ffffff; text-decoration: none; font-weight: 600; font-size: 16px; display: block;">
                                                        Verify My Email Address
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="margin: 20px 0 0 0; Margin: 20px 0 0 0; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Or copy and paste this link into your browser:
                            </p>
                            <p style="margin: 12px 0 20px 0; Margin: 12px 0 20px 0; padding: 12px; background-color: #f9fafb; border: 1px solid #e5e7eb; font-size: 13px; color: #3b82f6; word-wrap: break-word; overflow-wrap: break-word;">
                                ' . esc_url($verification_url) . '
                            </p>
                            
                            <p style="margin: 20px 0 0 0; Margin: 20px 0 0 0; color: #9ca3af; font-size: 14px; line-height: 1.6;">
                                <strong style="font-weight: bold;">Note:</strong> This link will expire in 24 hours.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 30px 40px; background-color: #f9fafb; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0; Margin: 0; color: #6b7280; font-size: 14px; text-align: center; line-height: 1.6;">
                                Best regards,<br>
                                <strong style="font-weight: bold; display: block; margin-top: 8px; Margin-top: 8px;">' . get_bloginfo('name') . '</strong>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <noreply@' . wp_parse_url(home_url(), PHP_URL_HOST) . '>'
    ];

    wp_mail($to, $subject, $message, $headers);

    wp_redirect(add_query_arg('resent', '1', $redirect));
    exit;
}

/**
 * Automatically verify admin users (optional)
 */
function auto_verify_admin_users($user_id)
{
    $user = get_user_by('ID', $user_id);

    if ($user && in_array('administrator', $user->roles)) {
        update_user_meta($user_id, 'email_verified', '1');
    }
}
add_action('user_register', 'auto_verify_admin_users', 10, 1);

// ============================================
// ADMIN - VERIFICATION STATUS MANAGEMENT
// ============================================

/**
 * Add Email Verification column to Users table
 */
function add_email_verification_column($columns)
{
    $columns['email_verified'] = '✉️ Email Verified';
    return $columns;
}
add_filter('manage_users_columns', 'add_email_verification_column');

/**
 * Display verification status in the column
 */
function show_email_verification_status($value, $column_name, $user_id)
{
    if ($column_name === 'email_verified') {
        $is_verified = get_user_meta($user_id, 'email_verified', true);
        $verified_date = get_user_meta($user_id, 'email_verified_date', true);

        if ($is_verified === '1') {
            $tooltip = $verified_date ? 'Verified on: ' . date('M j, Y g:i A', strtotime($verified_date)) : 'Verified';
            return '<span style="color: #10b981; font-weight: bold;" title="' . esc_attr($tooltip) . '">✓ Verified</span>';
        } else {
            return '<span style="color: #ef4444; font-weight: bold;">✗ Not Verified</span>';
        }
    }
    return $value;
}
add_filter('manage_users_custom_column', 'show_email_verification_status', 10, 3);

/**
 * Make the verification column sortable
 */
function make_verification_column_sortable($columns)
{
    $columns['email_verified'] = 'email_verified';
    return $columns;
}
add_filter('manage_users_sortable_columns', 'make_verification_column_sortable');

/**
 * Handle sorting by verification status
 */
function sort_users_by_verification($query)
{
    if (!is_admin()) {
        return;
    }

    if ($query->get('orderby') === 'email_verified') {
        $query->set('meta_key', 'email_verified');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_users', 'sort_users_by_verification');

/**
 * Add filter dropdown to show only verified/unverified users
 */
function add_verification_filter_dropdown()
{
    global $pagenow;

    if ($pagenow !== 'users.php') {
        return;
    }

    $current = isset($_GET['email_verification_filter']) ? sanitize_text_field($_GET['email_verification_filter']) : '';
    ?>
    <select name="email_verification_filter" id="email_verification_filter" style="min-width: 200px;">
        <option value="">Filter Verification Status...</option>
        <option value="verified" <?php echo ($current === 'verified') ? 'selected="selected"' : ''; ?>>✓ Verified Only
        </option>
        <option value="unverified" <?php echo ($current === 'unverified') ? 'selected="selected"' : ''; ?>>✗ Unverified Only
        </option>
    </select>
    <?php
    submit_button(__('Filter'), '', 'filter_action', false, array('id' => 'user-verification-filter-submit'));
}
add_action('restrict_manage_users', 'add_verification_filter_dropdown');

/**
 * Apply the verification filter
 */
function filter_users_by_verification($query)
{
    global $pagenow, $wpdb;

    // Only run on users.php admin page
    if (!is_admin() || $pagenow !== 'users.php') {
        return;
    }

    // Get the filter value
    if (!isset($_GET['email_verification_filter']) || empty($_GET['email_verification_filter'])) {
        return;
    }

    $filter = sanitize_text_field($_GET['email_verification_filter']);

    // Apply verified filter
    if ($filter === 'verified') {
        $query->set('meta_query', [
            [
                'key' => 'email_verified',
                'value' => '1',
                'compare' => '='
            ]
        ]);
    }

    // Apply unverified filter - use direct SQL query for efficiency
    if ($filter === 'unverified') {
        // Use a direct database query to get unverified user IDs
        // This is much more efficient than loading all users into PHP
        $unverified_ids = $wpdb->get_col("
            SELECT u.ID 
            FROM {$wpdb->users} u
            LEFT JOIN {$wpdb->usermeta} um 
                ON u.ID = um.user_id 
                AND um.meta_key = 'email_verified' 
                AND um.meta_value = '1'
            WHERE um.user_id IS NULL
        ");

        if (!empty($unverified_ids)) {
            $query->set('include', $unverified_ids);
        } else {
            // If no unverified users found, show empty result
            $query->set('include', [0]);
        }
    }
}
add_action('pre_get_users', 'filter_users_by_verification', 10);

/**
 * Show filter notice in admin
 */
function show_verification_filter_notice()
{
    global $pagenow;

    if ($pagenow === 'users.php' && isset($_GET['email_verification_filter']) && !empty($_GET['email_verification_filter'])) {
        $filter_value = sanitize_text_field($_GET['email_verification_filter']);

        if ($filter_value === 'verified') {
            $filter_label = '✓ Verified Users';
            $count_query = new WP_User_Query([
                'meta_key' => 'email_verified',
                'meta_value' => '1',
                'count_total' => true,
            ]);
            $count = $count_query->get_total();
        } else {
            $filter_label = '✗ Unverified Users';
            $all_users = count_users();
            $verified_query = new WP_User_Query([
                'meta_key' => 'email_verified',
                'meta_value' => '1',
                'count_total' => true,
            ]);
            $count = $all_users['total_users'] - $verified_query->get_total();
        }

        echo '<div class="notice notice-info is-dismissible"><p>';
        echo '<strong>Active Filter:</strong> Showing ' . esc_html($filter_label) . ' (' . $count . ' users)';
        echo ' | <a href="' . admin_url('users.php') . '" style="text-decoration: none;">✕ Clear Filter</a>';
        echo '</p></div>';
    }
}
add_action('admin_notices', 'show_verification_filter_notice');

/**
 * Add custom CSS and JavaScript to fix the filter functionality
 */
function verification_filter_custom_css()
{
    global $pagenow;

    if ($pagenow === 'users.php') {
        ?>
        <style>
            .tablenav.top .actions:not(.bulkactions) {
                float: left;
                margin-right: 10px;
            }

            #email_verification_filter {
                float: none !important;
                display: inline-block;
                vertical-align: middle;
                min-width: 200px;
                margin: 0;
            }

            #user-verification-filter-submit {
                float: none !important;
                display: inline-block;
                vertical-align: middle;
                margin: 0 0 0 4px !important;
                height: 32px;
                line-height: 30px;
            }

            #email_verification_filter.active-filter {
                border-color: #2271b1 !important;
                background-color: #f0f6fc !important;
            }
        </style>

        <script>
            jQuery(document).ready(function ($) {
                var filterSelect = $('#email_verification_filter');
                var filterButton = $('#user-verification-filter-submit');
                var theForm = filterSelect.closest('form');

                console.log('=== DEBUG INFO ===');
                console.log('Filter dropdown found:', filterSelect.length > 0);
                console.log('Filter button found:', filterButton.length > 0);
                console.log('Form found:', theForm.length > 0);
                console.log('Initial filter value:', filterSelect.val());
                console.log('Filter dropdown HTML:', filterSelect.prop('outerHTML'));

                // Highlight if filter is active
                if (filterSelect.val() && filterSelect.val() !== '') {
                    filterSelect.addClass('active-filter');
                }

                // Monitor dropdown changes
                filterSelect.on('change', function () {
                    var selectedValue = $(this).val();
                    console.log('Dropdown changed to:', selectedValue);

                    if (selectedValue && selectedValue !== '') {
                        $(this).addClass('active-filter');
                    } else {
                        $(this).removeClass('active-filter');
                    }
                });

                // Handle filter button click
                filterButton.on('click', function (e) {
                    e.preventDefault();

                    var selectedValue = filterSelect.val();
                    console.log('Filter button clicked. Selected value:', selectedValue);

                    if (!selectedValue || selectedValue === '') {
                        alert('Please select either "Verified Only" or "Unverified Only" first.');
                        filterSelect.focus();
                        return false;
                    }

                    // Build the URL manually to ensure the parameter is included
                    var currentUrl = window.location.href.split('?')[0];
                    var newUrl = currentUrl + '?email_verification_filter=' + encodeURIComponent(selectedValue) + '&filter_action=Filter';

                    console.log('Redirecting to:', newUrl);
                    window.location.href = newUrl;

                    return false;
                });

                // Also handle form submission
                theForm.on('submit', function (e) {
                    console.log('Form submitted');
                    console.log('Filter value on submit:', filterSelect.val());
                });
            });
        </script>
        <?php
    }
}
add_action('admin_head', 'verification_filter_custom_css');

/**
 * Add bulk actions to verify/unverify users
 */
function add_verification_bulk_actions($bulk_actions)
{
    $bulk_actions['verify_users'] = '✓ Verify Email';
    $bulk_actions['unverify_users'] = '✗ Unverify Email';
    return $bulk_actions;
}
add_filter('bulk_actions-users', 'add_verification_bulk_actions');

/**
 * Handle bulk verification actions
 */
function handle_verification_bulk_actions($redirect_to, $action, $user_ids)
{
    if ($action === 'verify_users') {
        foreach ($user_ids as $user_id) {
            update_user_meta($user_id, 'email_verified', '1');
            update_user_meta($user_id, 'email_verified_date', current_time('mysql'));
            delete_user_meta($user_id, 'email_verification_token');
            delete_user_meta($user_id, 'email_verification_expiry');
        }
        $redirect_to = add_query_arg('verified_users', count($user_ids), $redirect_to);
    }

    if ($action === 'unverify_users') {
        foreach ($user_ids as $user_id) {
            update_user_meta($user_id, 'email_verified', '0');
            delete_user_meta($user_id, 'email_verified_date');
        }
        $redirect_to = add_query_arg('unverified_users', count($user_ids), $redirect_to);
    }

    return $redirect_to;
}
add_filter('handle_bulk_actions-users', 'handle_verification_bulk_actions', 10, 3);

/**
 * Show admin notice after bulk action
 */
function show_verification_bulk_notice()
{
    if (!empty($_REQUEST['verified_users'])) {
        $count = intval($_REQUEST['verified_users']);
        echo '<div class="notice notice-success is-dismissible"><p>';
        printf(_n('%s user verified.', '%s users verified.', $count), $count);
        echo '</p></div>';
    }

    if (!empty($_REQUEST['unverified_users'])) {
        $count = intval($_REQUEST['unverified_users']);
        echo '<div class="notice notice-success is-dismissible"><p>';
        printf(_n('%s user unverified.', '%s users unverified.', $count), $count);
        echo '</p></div>';
    }
}
add_action('admin_notices', 'show_verification_bulk_notice');

/**
 * Add verification info to user profile page
 */
function add_verification_to_user_profile($user)
{
    $is_verified = get_user_meta($user->ID, 'email_verified', true);
    $verified_date = get_user_meta($user->ID, 'email_verified_date', true);
    $token_expiry = get_user_meta($user->ID, 'email_verification_expiry', true);
    ?>
    <h3>Email Verification Status</h3>
    <table class="form-table">
        <tr>
            <th><label>Verification Status</label></th>
            <td>
                <?php if ($is_verified === '1'): ?>
                    <span style="color: #10b981; font-weight: bold; font-size: 16px;">✓ Verified</span>
                    <?php if ($verified_date): ?>
                        <p class="description">Verified on: <?php echo date('F j, Y g:i A', strtotime($verified_date)); ?></p>
                    <?php endif; ?>
                <?php else: ?>
                    <span style="color: #ef4444; font-weight: bold; font-size: 16px;">✗ Not Verified</span>
                    <?php if ($token_expiry): ?>
                        <p class="description">
                            Verification link expires: <?php echo date('F j, Y g:i A', $token_expiry); ?>
                            <?php if (time() > $token_expiry): ?>
                                <strong style="color: #ef4444;">(EXPIRED)</strong>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><label>Manual Verification</label></th>
            <td>
                <label>
                    <input type="checkbox" name="manually_verify_email" value="1" <?php checked($is_verified, '1'); ?>>
                    Mark this user's email as verified
                </label>
                <p class="description">Check this box to manually verify this user's email address.</p>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'add_verification_to_user_profile');
add_action('edit_user_profile', 'add_verification_to_user_profile');

/**
 * Save manual verification from user profile
 */
function save_manual_verification($user_id)
{
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    if (isset($_POST['manually_verify_email']) && $_POST['manually_verify_email'] == '1') {
        update_user_meta($user_id, 'email_verified', '1');
        update_user_meta($user_id, 'email_verified_date', current_time('mysql'));
        delete_user_meta($user_id, 'email_verification_token');
        delete_user_meta($user_id, 'email_verification_expiry');
    } else {
        // If unchecked, unverify
        if (get_user_meta($user_id, 'email_verified', true) === '1') {
            update_user_meta($user_id, 'email_verified', '0');
            delete_user_meta($user_id, 'email_verified_date');
        }
    }
}
add_action('personal_options_update', 'save_manual_verification');
add_action('edit_user_profile_update', 'save_manual_verification');

/**
 * Add a dashboard widget showing verification stats
 */
function add_verification_dashboard_widget()
{
    wp_add_dashboard_widget(
        'email_verification_stats',
        '✉️ Email Verification Statistics',
        'display_verification_dashboard_widget'
    );
}
add_action('wp_dashboard_setup', 'add_verification_dashboard_widget');

/**
 * Display verification statistics in dashboard
 */
function display_verification_dashboard_widget()
{
    $all_users = count_users();
    $total_users = $all_users['total_users'];

    // Count verified users
    $verified_users = new WP_User_Query([
        'meta_key' => 'email_verified',
        'meta_value' => '1',
        'count_total' => true,
    ]);
    $verified_count = $verified_users->get_total();

    $unverified_count = $total_users - $verified_count;
    $verified_percentage = $total_users > 0 ? round(($verified_count / $total_users) * 100, 1) : 0;

    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
        <div style="background: #f0fdf4; padding: 20px; border-radius: 8px; border-left: 4px solid #10b981;">
            <div style="font-size: 28px; font-weight: bold; color: #10b981;"><?php echo $verified_count; ?></div>
            <div style="color: #059669; font-size: 14px;">Verified Users</div>
        </div>
        <div style="background: #fef2f2; padding: 20px; border-radius: 8px; border-left: 4px solid #ef4444;">
            <div style="font-size: 28px; font-weight: bold; color: #ef4444;"><?php echo $unverified_count; ?></div>
            <div style="color: #dc2626; font-size: 14px;">Unverified Users</div>
        </div>
    </div>

    <div style="background: #f9fafb; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
            <span style="font-weight: 500;">Verification Rate</span>
            <span style="font-weight: bold; color: #10b981;"><?php echo $verified_percentage; ?>%</span>
        </div>
        <div style="background: #e5e7eb; height: 8px; border-radius: 4px; overflow: hidden;">
            <div
                style="background: #10b981; height: 100%; width: <?php echo $verified_percentage; ?>%; transition: width 0.3s;">
            </div>
        </div>
    </div>

    <div style="text-align: center;">
        <a href="<?php echo admin_url('users.php?email_verification_filter=unverified'); ?>" class="button button-primary">
            View Unverified Users
        </a>
    </div>
    <?php
}

// ============================================
// GUEST CHECKOUT - EMAIL VERIFICATION
// ============================================

/**
 * Add email verification field to checkout for guests
 */
function add_guest_verification_to_checkout($fields)
{
    // Only for guests
    if (!is_user_logged_in()) {
        // Add a custom field for verification code
        $fields['billing']['billing_verification_code'] = array(
            'type' => 'text',
            'label' => 'Verification Code',
            'placeholder' => 'Enter the code sent to your email',
            'required' => false,
            'class' => array('form-row-wide', 'guest-verification-field'),
            'priority' => 35, // After email field
        );
    }
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'add_guest_verification_to_checkout');

/**
 * Add custom verification section after billing email
 */
function add_guest_verification_section()
{
    if (!is_user_logged_in()) {
        ?>
        <div id="guest-verification-section"
            style="margin-top: 20px; padding: 20px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px;">
            <h3 style="margin-top: 0; color: #1f2937; font-size: 18px; display: flex; align-items: center; gap: 8px;">
                <svg style="width: 24px; height: 24px; color: #3b82f6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                E-mailbekræftelse påkrævet
            </h3>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 15px;">
                For at gennemføre din ordre skal du bekræfte din e-mailadresse. Klik på knappen nedenfor for at modtage en
                bekræftelseskode.
            </p>

            <div id="verification-status" style="margin-bottom: 15px;"></div>

            <button type="button" id="send-guest-verification" class="button"
                style="background: #3b82f6; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: 500;">
                Send bekræftelseskode
            </button>

            <div id="verification-code-input" style="display: none; margin-top: 15px;">
                <label style="display: block; margin-bottom: 5px; color: #374151; font-weight: 500;">Bekræftelseskode</label>
                <input type="text" id="guest_verification_code" name="guest_verification_code" class="input-text"
                    placeholder="Tilføj 6-cifret kode" maxlength="6"
                    style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                <input type="hidden" id="guest_verification_validated" name="guest_verification_validated" value="0">
                <p style="font-size: 12px; color: #6b7280; margin-top: 5px;">Tjek din e-mail for bekræftelseskoden.</p>
            </div>
        </div>

        <script>
            jQuery(document).ready(function ($) {
                var verificationSent = false;
                var emailVerified = false;

                // Send verification code
                $('#send-guest-verification').on('click', function () {
                    var email = $('#billing_email').val();

                    if (!email || !isValidEmail(email)) {
                        // Show error if email is invalid
                        showStatus('error', 'Indtast venligst først en gyldig e-mailadresse. ');
                        $('#billing_email').focus();
                        return;
                    }

                    var button = $(this);
                    // Disable button and show loading state
                    button.prop('disabled', true).text('Sender...');

                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: {
                            action: 'send_guest_verification',
                            email: email,
                            nonce: '<?php echo wp_create_nonce('guest_verification'); ?>'
                        },
                        success: function (response) {
                            if (response.success) {
                                // Handle successful response
                                showStatus('success', 'Bekræftelseskode sendt! Tjek din e-mail.');
                                $('#verification-code-input').slideDown();
                                verificationSent = true;
                                button.text('Gensend kode');
                            } else {
                                // Handle application errors
                                showStatus('error', response.data.message || 'Kunne ikke sende koden.');
                            }
                            button.prop('disabled', false);
                        },
                        error: function () {
                            // Handle network errors
                            showStatus('error', 'Netværksfejl. Prøv venligst igen.');
                            button.prop('disabled', false);
                        }
                    });
                });

                // Verify code on input
                $('#guest_verification_code').on('input', function () {
                    var code = $(this).val();
                    if (code.length === 6) {
                        verifyCode(code);
                    }
                });

                function verifyCode(code) {
                    var email = $('#billing_email').val();

                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'POST',
                        data: {
                            action: 'verify_guest_code',
                            email: email,
                            code: code,
                            nonce: '<?php echo wp_create_nonce('guest_verification'); ?>'
                        },
                        success: function (response) {
                            if (response.success) {
                                // Handle successful verification
                                showStatus('success', '✓ E-mailadressen er bekræftet.!');
                                $('#guest_verification_validated').val('1');
                                emailVerified = true;
                                $('#guest_verification_code').prop('readonly', true).css('border-color', '#10b981');
                            } else {
                                // Handle verification errors
                                showStatus('error', response.data.message || 'Ugyldig kode.');
                                $('#guest_verification_validated').val('0');
                            }
                        }
                    });
                }

                function showStatus(type, message) {
                    var bgColor = type === 'success' ? '#ecfdf5' : '#fef2f2';
                    var borderColor = type === 'success' ? '#10b981' : '#ef4444';
                    var textColor = type === 'success' ? '#065f46' : '#991b1b';

                    $('#verification-status').html(
                        '<div style="padding: 12px; background: ' + bgColor + '; border: 1px solid ' + borderColor + '; border-radius: 6px; color: ' + textColor + '; font-size: 14px;">' + message + '</div>'
                    );
                }

                function isValidEmail(email) {
                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                }

                // Block checkout if not verified
                $('form.checkout').on('checkout_place_order', function () {
                    if (!emailVerified && !verificationSent) {
                        // Show error and scroll to verification section
                        showStatus('error', 'Bekræft venligst din e-mailadresse, før du afgiver en ordre.');
                        $('html, body').animate({
                            scrollTop: $('#guest-verification-section').offset().top - 100
                        }, 500);
                        return false;
                    }

                    if (verificationSent && !emailVerified) {
                        // Show error if code was sent but not verified
                        showStatus('error', 'Indtast venligst bekræftelseskoden, der er sendt til din e-mailadresse.');
                        $('#guest_verification_code').focus();
                        return false;
                    }

                    return true;
                });
            });
        </script>

        <style>
            #send-guest-verification:hover {
                background: #2563eb !important;
            }

            #send-guest-verification:disabled {
                background: #9ca3af !important;
                cursor: not-allowed !important;
            }

            .guest-verification-field {
                display: none !important;
            }
        </style>
        <?php
    }
}
add_action('woocommerce_after_checkout_billing_form', 'add_guest_verification_section');

// ============================================
// CREATE VERIFICATION TABLE ON ACTIVATION
// ============================================

/**
 * Create verification codes table
 * Run this once to ensure table exists
 */
function create_guest_verification_table()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'guest_verification_codes';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        email VARCHAR(255) NOT NULL,
        code VARCHAR(6) NOT NULL,
        created_at DATETIME NOT NULL,
        expires_at DATETIME NOT NULL,
        PRIMARY KEY (id),
        KEY email_idx (email),
        KEY expires_idx (expires_at)
    ) {$charset_collate};";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // Verify table was created
    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'");

    if ($table_exists) {
        update_option('guest_verification_table_created', '1');
    }
}
add_action('after_setup_theme', 'create_guest_verification_table');

// Also create on plugin activation hook
register_activation_hook(__FILE__, 'create_guest_verification_table');

/**
 * Clean up expired codes daily
 */
function cleanup_expired_verification_codes()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'guest_verification_codes';

    $wpdb->query("DELETE FROM {$table_name} WHERE expires_at < NOW()");
}
add_action('wp_scheduled_delete', 'cleanup_expired_verification_codes');

// ============================================
// SEND VERIFICATION CODE
// ============================================

/**
 * Send verification code with proper error logging
 */
function fixed_send_guest_verification()
{
    // Verify nonce
    if (!check_ajax_referer('guest_verification', 'nonce', false)) {
        wp_send_json_error([
            'message' => 'Security check failed. Please refresh the page.',
            'debug' => 'Nonce verification failed'
        ]);
    }

    $email = sanitize_email($_POST['email'] ?? '');

    if (!is_email($email)) {
        wp_send_json_error([
            'message' => 'Invalid email address.',
            'debug' => 'Email validation failed'
        ]);
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'guest_verification_codes';

    // Check if table exists
    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'");
    if (!$table_exists) {
        create_guest_verification_table();
    }

    // Generate 6-digit code
    $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

    // Use WordPress timezone
    $current_time = current_time('mysql');
    $expires_time = date('Y-m-d H:i:s', strtotime($current_time) + (15 * 60));

    // Delete any existing codes for this email
    $deleted = $wpdb->delete($table_name, ['email' => $email]);

    // Insert new code
    $inserted = $wpdb->insert(
        $table_name,
        [
            'email' => $email,
            'code' => $code,
            'created_at' => $current_time,
            'expires_at' => $expires_time
        ],
        ['%s', '%s', '%s', '%s']
    );

    if ($inserted === false) {
        wp_send_json_error([
            'message' => 'Failed to generate code. Please try again.',
            'debug' => 'Database insert failed: ' . $wpdb->last_error
        ]);
    }

    // Verify it was inserted
    $verify = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM {$table_name} WHERE email = %s ORDER BY created_at DESC LIMIT 1",
        $email
    ));

    if (!$verify) {
        wp_send_json_error([
            'message' => 'Code generation failed. Please try again.',
            'debug' => 'Code not found after insert'
        ]);
    }

    // Send email
    $subject = 'Your Verification Code - ' . get_bloginfo('name');

    $message = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff;">
                    <!-- Header -->
                    <tr>
                        <td style="padding: 40px 40px 20px; text-align: center; border-bottom: 3px solid #10b981; background-color: #ffffff;">
                            <h1 style="margin: 0; Margin: 0; color: #1f2937; font-size: 28px; font-weight: 600;">Bekræftelseskode</h1>
                            <!-- Verification Code -->
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px; background-color: #ffffff;">
                            <p style="margin: 0 0 20px 0; Margin: 0 0 20px 0; color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Hej,
                                <!-- Hello, -->
                            </p>
                            <p style="margin: 0 0 30px 0; Margin: 0 0 30px 0; color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Tak for din ordre. Brug venligst bekræftelseskoden nedenfor for at gennemføre dit køb:
                                <!-- Thank you for shopping with us! Please use the verification code below to complete your checkout: -->
                            </p>
                            
                            <!-- Verification Code Box - OUTLOOK COMPATIBLE -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0; Margin: 30px 0;">
                                <tr>
                                    <td align="center" style="padding: 24px 48px; background-color: #10b981; border-radius: 12px;">
                                        <div style="color: #ffffff; font-size: 36px; font-weight: bold; letter-spacing: 8px; font-family: \'Courier New\', monospace; line-height: 1;">
                                            ' . esc_html($code) . '
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="margin: 30px 0 0 0; Margin: 30px 0 0 0; color: #6b7280; font-size: 14px; line-height: 1.6; text-align: center;">
                                Indtast denne kode på betalingssiden for at bekræfte din e-mailadresse.
                                <!-- Enter this code on the checkout page to verify your email address. -->
                            </p>
                            
                            <!-- Important Notice -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0 0 0; Margin: 30px 0 0 0;">
                                <tr>
                                    <td style="padding: 20px; background-color: #fef3c7; border: 1px solid #fbbf24; border-radius: 6px;">
                                        <p style="margin: 0; Margin: 0; color: #92400e; font-size: 14px; line-height: 1.6; text-align: center;">
                                            <strong style="font-weight: bold;">⚠️ Vigtigt:</strong> Denne kode udløber om 15 minutter.
                                            <!-- Important: This code will expire in 15 minutes. -->
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="margin: 20px 0 0 0; Margin: 20px 0 0 0; color: #9ca3af; font-size: 14px; line-height: 1.6;">
                                Hvis du ikke har anmodet om denne kode, kan du se bort fra denne e-mail.
                                <!-- If you did not request this code, please ignore this email. -->
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 30px 40px; background-color: #f9fafb; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0; Margin: 0; color: #6b7280; font-size: 14px; text-align: center; line-height: 1.6;">
                                Med venlig hilsen,
                                <!-- Best regards, -->
                                <br>
                                <strong style="font-weight: bold; display: block; margin-top: 8px; Margin-top: 8px;">' . get_bloginfo('name') . '</strong>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <noreply@' . wp_parse_url(home_url(), PHP_URL_HOST) . '>'
    ];

    $sent = wp_mail($email, $subject, $message, $headers);

    if ($sent) {
        wp_send_json_success([
            'message' => 'Verification code sent! Check your email.',
            'debug' => [
                'code_sent' => true,
                'expires_in' => '15 minutes',
                'created_at' => $current_time,
                'expires_at' => $expires_time
            ]
        ]);
    } else {
        // Even if email fails, code is in database
        wp_send_json_success([
            'message' => 'Code generated. Check your email (may take a minute).',
            'debug' => [
                'email_sent' => false,
                'code_in_db' => true,
                'test_code' => WP_DEBUG ? $code : 'hidden' // Only show in debug mode
            ]
        ]);
    }
}
add_action('wp_ajax_send_guest_verification', 'fixed_send_guest_verification');
add_action('wp_ajax_nopriv_send_guest_verification', 'fixed_send_guest_verification');

// ============================================
// VERIFY CODE
// ============================================

/**
 * Verify guest code with detailed debugging
 */
function fixed_verify_guest_code()
{
    if (!check_ajax_referer('guest_verification', 'nonce', false)) {
        wp_send_json_error([
            'message' => 'Security check failed.',
            'debug' => 'Nonce failed'
        ]);
    }

    $email = sanitize_email($_POST['email'] ?? '');
    $code = sanitize_text_field($_POST['code'] ?? '');

    if (!is_email($email)) {
        wp_send_json_error([
            'message' => 'Invalid email address.',
            'debug' => 'Email validation failed'
        ]);
    }

    if (strlen($code) !== 6) {
        wp_send_json_error([
            'message' => 'Invalid code format.',
            'debug' => 'Code must be 6 digits'
        ]);
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'guest_verification_codes';

    // Get current time in WordPress timezone
    $current_time = current_time('mysql');

    // Get the code from database
    $result = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM {$table_name} 
        WHERE email = %s 
        ORDER BY created_at DESC 
        LIMIT 1",
        $email
    ));

    // Debug: Check what we got
    if (!$result) {
        wp_send_json_error([
            'message' => 'No verification code found. Please request a new one.',
            'debug' => [
                'error' => 'No code in database',
                'email' => $email,
                'sql_error' => $wpdb->last_error
            ]
        ]);
    }

    // Check if expired using string comparison (more reliable)
    $is_expired = (strtotime($current_time) > strtotime($result->expires_at));

    if ($is_expired) {
        // Delete expired code
        $wpdb->delete($table_name, ['id' => $result->id]);

        wp_send_json_error([
            'message' => 'Code has expired. Please request a new one.',
            'debug' => [
                'current_time' => $current_time,
                'expires_at' => $result->expires_at,
                'created_at' => $result->created_at,
                'time_diff' => strtotime($current_time) - strtotime($result->created_at),
                'expired' => true
            ]
        ]);
    }

    // Verify code matches
    if ($result->code !== $code) {
        wp_send_json_error([
            'message' => 'Invalid verification code. Please check and try again.',
            'debug' => [
                'code_match' => false,
                'expected_length' => strlen($result->code),
                'provided_length' => strlen($code)
            ]
        ]);
    }

    // Code is valid! Store in session
    if (!WC()->session) {
        WC()->initialize_session();
    }

    WC()->session->set('guest_email_verified', $email);
    WC()->session->set('guest_email_verified_time', time());

    // Also store in cookie as backup
    setcookie('guest_email_verified', $email, time() + 3600, '/', '', is_ssl(), true);

    // Delete used code
    $wpdb->delete($table_name, ['id' => $result->id]);

    wp_send_json_success([
        'message' => 'Email verified successfully!',
        'debug' => [
            'verified' => true,
            'email' => $email,
            'session_set' => true,
            'cookie_set' => true
        ]
    ]);
}

add_action('wp_ajax_verify_guest_code', 'fixed_verify_guest_code');
add_action('wp_ajax_nopriv_verify_guest_code', 'fixed_verify_guest_code');

// ============================================
// VALIDATION ON CHECKOUT (FIXED)
// ============================================

/**
 * Validate guest verification before order is placed
 */
function fixed_validate_guest_checkout($data, $errors)
{
    if (is_user_logged_in()) {
        return;
    }

    $billing_email = $data['billing_email'];

    // Check session first
    if (WC()->session) {
        $verified_email = WC()->session->get('guest_email_verified');
    } else {
        $verified_email = null;
    }

    // Fallback to cookie
    if (!$verified_email && isset($_COOKIE['guest_email_verified'])) {
        $verified_email = sanitize_email($_COOKIE['guest_email_verified']);
    }

    if ($verified_email !== $billing_email) {
        $errors->add('verification', __('Please verify your email address before placing the order.', 'woocommerce'));
    }
}
add_action('woocommerce_after_checkout_validation', 'fixed_validate_guest_checkout', 10, 2);

// ============================================
// DEBUGGING TOOLS
// ============================================

/**
 * Add admin menu to view verification codes (for debugging)
 */
function add_verification_debug_menu()
{
    if (WP_DEBUG || current_user_can('administrator')) {
        add_submenu_page(
            'tools.php',
            'Verification Codes',
            'Verification Codes',
            'manage_options',
            'verification-codes',
            'display_verification_codes_page'
        );
    }
}
add_action('admin_menu', 'add_verification_debug_menu');

/**
 * Display verification codes page
 */
function display_verification_codes_page()
{
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'guest_verification_codes';

    $codes = $wpdb->get_results("SELECT * FROM {$table_name} ORDER BY created_at DESC LIMIT 50");
    $current_time = current_time('mysql');

    ?>
    <div class="wrap">
        <h1>Guest Verification Codes</h1>
        <p>Current server time: <strong><?php echo $current_time; ?></strong></p>

        <?php if (empty($codes)): ?>
            <p>No verification codes in database.</p>
        <?php else: ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Code</th>
                        <th>Created</th>
                        <th>Expires</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($codes as $code): ?>
                        <?php
                        $is_expired = strtotime($current_time) > strtotime($code->expires_at);
                        $time_left = strtotime($code->expires_at) - strtotime($current_time);
                        ?>
                        <tr>
                            <td><?php echo $code->id; ?></td>
                            <td><?php echo esc_html($code->email); ?></td>
                            <td><strong><?php echo esc_html($code->code); ?></strong></td>
                            <td><?php echo $code->created_at; ?></td>
                            <td><?php echo $code->expires_at; ?></td>
                            <td>
                                <?php if ($is_expired): ?>
                                    <span style="color: red;">❌ Expired</span>
                                <?php else: ?>
                                    <span style="color: green;">✓ Valid (<?php echo round($time_left / 60); ?> min left)</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <h2 style="margin-top: 40px;">Actions</h2>
        <a href="?page=verification-codes&action=cleanup" class="button">Clean Up Expired Codes</a>

        <?php if (isset($_GET['action']) && $_GET['action'] === 'cleanup'): ?>
            <?php
            $deleted = $wpdb->query("DELETE FROM {$table_name} WHERE expires_at < NOW()");
            echo '<div class="notice notice-success"><p>Deleted ' . $deleted . ' expired codes.</p></div>';
            ?>
        <?php endif; ?>
    </div>
    <?php
}

// ============================================
// INITIALIZE WC SESSION EARLY
// ============================================

/**
 * Ensure WooCommerce session is initialized for AJAX
 */
function ensure_wc_session_for_ajax()
{
    if (defined('DOING_AJAX') && DOING_AJAX) {
        if (function_exists('WC') && !WC()->session) {
            WC()->initialize_session();
            WC()->initialize_cart();
        }
    }
}
add_action('init', 'ensure_wc_session_for_ajax', 1);

/**
 * Clear guest verification after successful order
 */
function clear_guest_verification_after_order($order_id)
{
    if (!is_user_logged_in()) {
        WC()->session->__unset('guest_email_verified');
    }
}
add_action('woocommerce_thankyou', 'clear_guest_verification_after_order');

/**
 * Auto-expand Fluid Checkout billing section when verification error occurs
 */
function fluid_checkout_auto_expand_billing_on_error()
{
    if (!is_checkout() || is_user_logged_in()) {
        return;
    }
    ?>
    <script>
        jQuery(document).ready(function ($) {
            // Function to expand billing section by clicking "Change" button
            function expandBillingSection() {
                console.log('Attempting to expand billing section...');

                // Find and click the "Change" button in the billing section
                var changeButton = $('.fc-step[data-step-id="billing"] .fc-step__edit-button, ' +
                    '.fc-step[data-step-id="billing"] button.fc-step__edit, ' +
                    '.fc-step[data-step-id="billing"] .fc-step__edit, ' +
                    '.fc-step[data-step-id="billing"] a.fc-step__edit-link, ' +
                    '.fc-step--billing .fc-step__edit-button, ' +
                    '[data-step-id="billing"] button[class*="edit"], ' +
                    '[data-step-id="billing"] a[class*="edit"], ' +
                    '[data-step-id="billing"] .edit-step-link');

                if (changeButton.length) {
                    console.log('Found Change button, clicking it...');
                    changeButton.first()[0].click(); // Use native click

                    // Scroll after a short delay
                    setTimeout(scrollToVerification, 300);
                    return true;
                }

                // Alternative: Click the step header
                var billingHeader = $('.fc-step[data-step-id="billing"] .fc-step__title, ' +
                    '.fc-step--billing .fc-step__title, ' +
                    '[data-step-id="billing"] .fc-step__heading');

                if (billingHeader.length) {
                    console.log('Found billing header, clicking it...');
                    billingHeader.first()[0].click(); // Use native click

                    setTimeout(scrollToVerification, 300);
                    return true;
                }

                // Fallback: Try to remove collapsed state
                var billingSection = $('.fc-step[data-step-id="billing"], .fc-step--billing');
                if (billingSection.length) {
                    console.log('Using fallback: removing collapsed class...');
                    billingSection.removeClass('fc-step--collapsed fc-step--complete');
                    billingSection.addClass('fc-step--expanded fc-step--current');

                    // Also try to show the substep content
                    billingSection.find('.fc-step__substeps, .fc-step__content').show();

                    setTimeout(scrollToVerification, 300);
                    return true;
                }

                console.log('Could not find billing section to expand');
                return false;
            }

            // Function to scroll to verification section
            function scrollToVerification() {
                var verificationSection = $('#guest-verification-section');
                if (verificationSection.length) {
                    $('html, body').animate({
                        scrollTop: verificationSection.offset().top - 100
                    }, 500);
                }
            }

            // Watch for verification error messages
            var verificationObserver = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    if (mutation.addedNodes.length) {
                        mutation.addedNodes.forEach(function (node) {
                            if (node.nodeType === 1) { // Element node
                                var $node = $(node);

                                // Check if it's an error message in verification status
                                if ($node.closest('#verification-status').length ||
                                    $node.attr('id') === 'verification-status') {

                                    var hasError = $node.find('[style*="ef4444"]').length ||
                                        $node.text().toLowerCase().includes('verify') ||
                                        $node.text().toLowerCase().includes('code');

                                    if (hasError) {
                                        setTimeout(function () {
                                            expandBillingSection();
                                            scrollToVerification();
                                        }, 100);
                                    }
                                }
                            }
                        });
                    }
                });
            });

            // Start observing verification status
            var verificationStatus = document.getElementById('verification-status');
            if (verificationStatus) {
                verificationObserver.observe(verificationStatus, {
                    childList: true,
                    subtree: true
                });
            }

            // Also watch for WooCommerce error notices
            var noticeObserver = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    if (mutation.addedNodes.length) {
                        mutation.addedNodes.forEach(function (node) {
                            if (node.nodeType === 1) {
                                var $node = $(node);

                                // Check for WooCommerce error related to verification
                                if ($node.hasClass('woocommerce-error') ||
                                    $node.hasClass('woocommerce-message') ||
                                    $node.find('.woocommerce-error').length) {

                                    var errorText = $node.text().toLowerCase();
                                    if (errorText.includes('verify') ||
                                        errorText.includes('email') ||
                                        errorText.includes('code')) {

                                        setTimeout(function () {
                                            expandBillingSection();
                                            scrollToVerification();
                                        }, 100);
                                    }
                                }
                            }
                        });
                    }
                });
            });

            // Observe notices area
            var noticesArea = $('.woocommerce-notices-wrapper')[0] ||
                $('.woocommerce-NoticeGroup')[0] ||
                $('form.checkout')[0];

            if (noticesArea) {
                noticeObserver.observe(noticesArea, {
                    childList: true,
                    subtree: true
                });
            }

            // Hook into checkout place order event - AUTO EXPAND ON ERROR
            $('form.checkout').on('checkout_place_order', function () {
                var emailVerified = $('#guest_verification_validated').val() === '1';
                var verificationCodeVisible = $('#verification-code-input').is(':visible');
                var verificationCodeValue = $('#guest_verification_code').val();

                console.log('Checkout attempt - Verified:', emailVerified, 'Code visible:', verificationCodeVisible);

                // If not verified OR code field is visible but empty
                if (!emailVerified || (verificationCodeVisible && !verificationCodeValue)) {
                    console.log('Verification incomplete - expanding billing section');

                    setTimeout(function () {
                        var expanded = expandBillingSection();
                        if (expanded) {
                            console.log('Billing section expanded successfully');
                        }
                    }, 100);

                    return false; // Prevent checkout
                }
            });

            // Also expand on "Send Verification Code" button click
            $(document).on('click', '#send-guest-verification', function () {
                setTimeout(function () {
                    expandBillingSection();
                }, 100);
            });

            // Expand if verification section is visible on page load
            if ($('#guest-verification-section').length && !$('#guest_verification_validated').val()) {
                console.log('Verification section found on page load - will expand billing');
                setTimeout(function () {
                    expandBillingSection();
                }, 1000); // Wait for Fluid Checkout to initialize
            }

            // Debug: Log all possible change buttons on page
            setTimeout(function () {
                console.log('=== FLUID CHECKOUT DEBUG ===');
                console.log('All edit/change buttons:', $('button:contains("Change"), button:contains("Edit"), a:contains("Change"), a:contains("Edit")').length);
                console.log('Billing section:', $('.fc-step[data-step-id="billing"]').length);

                // Try to find the actual change button
                var allButtons = $('.fc-step[data-step-id="billing"]').find('button, a');
                console.log('Buttons in billing section:', allButtons.length);
                allButtons.each(function (i) {
                    console.log('Button ' + i + ':', $(this).attr('class'), $(this).text());
                });
            }, 2000);
        });
    </script>

    <style>
        /* Ensure billing section stays expanded when needed */
        .fc-step[data-step-id="billing"].fc-step--expanded {
            max-height: none !important;
        }

        /* Smooth transition for expansion */
        .fc-step[data-step-id="billing"] {
            transition: max-height 0.3s ease-in-out;
        }

        /* Highlight verification section when expanded */
        #guest-verification-section.highlight-error {
            animation: pulseError 1s ease-in-out;
        }

        @keyframes pulseError {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0.3);
            }
        }
    </style>
    <?php
}
add_action('wp_footer', 'fluid_checkout_auto_expand_billing_on_error', 999);

/**
 * Enhanced version of showStatus function with auto-expand
 */
function enhance_guest_verification_script()
{
    if (!is_checkout() || is_user_logged_in()) {
        return;
    }
    ?>
    <script>
        jQuery(document).ready(function ($) {
            // Override the original showStatus function
            window.showStatusWithExpand = function (type, message) {
                var bgColor = type === 'success' ? '#ecfdf5' : '#fef2f2';
                var borderColor = type === 'success' ? '#10b981' : '#ef4444';
                var textColor = type === 'success' ? '#065f46' : '#991b1b';

                $('#verification-status').html(
                    '<div style="padding: 12px; background: ' + bgColor + '; border: 1px solid ' + borderColor + '; border-radius: 6px; color: ' + textColor + '; font-size: 14px;">' + message + '</div>'
                );

                // Add highlight animation for errors
                if (type === 'error') {
                    $('#guest-verification-section').addClass('highlight-error');
                    setTimeout(function () {
                        $('#guest-verification-section').removeClass('highlight-error');
                    }, 1000);

                    // Expand billing section
                    expandFluidCheckoutBilling();
                }
            };

            // Global function to expand billing section
            window.expandFluidCheckoutBilling = function () {
                var billingSection = $('.fc-step[data-step-id="billing"]');
                var billingHeader = $('.fc-step__title[data-step-id="billing"]');

                if (billingHeader.length && !billingSection.hasClass('fc-step--expanded')) {
                    billingHeader.trigger('click');
                }

                billingSection.addClass('fc-step--expanded').removeClass('fc-step--collapsed');
                $(document.body).trigger('fc_expand_step', ['billing']);

                // Scroll to verification section
                setTimeout(function () {
                    if ($('#guest-verification-section').length) {
                        $('html, body').animate({
                            scrollTop: $('#guest-verification-section').offset().top - 100
                        }, 500);
                    }
                }, 300);
            };

            // Replace showStatus calls in existing code
            if (typeof showStatus !== 'undefined') {
                window.originalShowStatus = showStatus;
                window.showStatus = window.showStatusWithExpand;
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'enhance_guest_verification_script', 1000);

// ============================================
// PHONE NUMBER MANDATORY
// ============================================

/**
 * Make billing phone required on checkout
 */
function make_billing_phone_required($fields)
{
    $fields['billing']['billing_phone']['required'] = true;
    $fields['billing']['billing_phone']['class'] = array('form-row-wide');
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'make_billing_phone_required');

// ============================================
// LINK GUEST ORDERS TO USER ACCOUNT
// ============================================

/**
 * Link guest orders to user account after registration
 */
function link_guest_orders_to_new_user($customer_id)
{
    $user = get_user_by('ID', $customer_id);

    if (!$user) {
        return;
    }

    $email = $user->user_email;

    // Find all orders with this email where customer_id = 0 (guest orders)
    $args = array(
        'limit' => -1, // Get all orders
        'billing_email' => $email,
        'customer_id' => 0, // Only guest orders
        'return' => 'ids',
    );

    $guest_order_ids = wc_get_orders($args);

    if (!empty($guest_order_ids)) {
        foreach ($guest_order_ids as $order_id) {
            $order = wc_get_order($order_id);
            if ($order) {
                // Link order to user
                $order->set_customer_id($customer_id);
                $order->save();

                // Add order note
                $order->add_order_note(
                    sprintf(
                        'Order automatically linked to user account (ID: %d, Email: %s) after registration.',
                        $customer_id,
                        $email
                    )
                );
            }
        }

        // Store count in user meta for reference
        update_user_meta($customer_id, 'linked_guest_orders_count', count($guest_order_ids));
        update_user_meta($customer_id, 'linked_guest_orders_date', current_time('mysql'));
    }
}
add_action('user_register', 'link_guest_orders_to_new_user', 20, 1);

/**
 * Also link orders when user verifies email (in case linking failed during registration)
 */
function link_guest_orders_on_verification($user_id)
{
    // Check if orders were already linked
    $already_linked = get_user_meta($user_id, 'linked_guest_orders_count', true);

    if (!$already_linked) {
        link_guest_orders_to_new_user($user_id);
    }
}

/**
 * Change add to cart button text to Danish
 */
add_filter('woocommerce_product_add_to_cart_text', 'custom_add_to_cart_text');
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_text');

function custom_add_to_cart_text()
{
    return __('Tilføj til kurv', 'woocommerce');
}

add_action('template_redirect', function () {

    if (is_product_category() && !isset($_GET['product_cat'])) {

        $term = get_queried_object();

        if ($term && isset($term->slug)) {
            wp_redirect(home_url('/shop/?product_cat=' . $term->slug), 301);
            exit;
        }
    }
});

/**
 * Packaging Tax (Emballageafgift) - Danish orders only
 * Charged per unit × weight (kg) × rate/kg
 */
add_action('woocommerce_cart_calculate_fees', 'add_packaging_tax_fee');

function add_packaging_tax_fee(WC_Cart $cart)
{
    $country = WC()->customer->get_shipping_country() ?: WC()->customer->get_billing_country();
    if ($country !== 'DK')
        return;

    $total_tax = 0.0;

    foreach ($cart->get_cart() as $item) {
        $product = $item['data'];
        $qty = $item['quantity'];

        // Try rate on variation first, then fall back to parent
        $ptax_rate = (float) $product->get_meta('_ptax_rate');
        if ($ptax_rate <= 0 && $product->get_parent_id()) {
            $ptax_rate = (float) get_post_meta($product->get_parent_id(), '_ptax_rate', true);
        }
        if ($ptax_rate <= 0)
            continue;

        $weight_kg = (float) $product->get_weight();
        if ($weight_kg <= 0)
            continue;

        $total_tax += $qty * $weight_kg * $ptax_rate;
    }

    if ($total_tax > 0) {
        $cart->add_fee(__('Emballageafgift', 'your-textdomain'), $total_tax, false);
    }
}

// Add field to General tab (or wherever fits)
add_action('woocommerce_product_options_general_product_data', 'ptax_rate_field');
function ptax_rate_field()
{
    woocommerce_wp_text_input([
        'id' => '_ptax_rate',
        'label' => __('Packaging Tax Rate (DKK/kg)', 'your-textdomain'),
        'placeholder' => 'e.g. 2.87',
        'type' => 'number',
        'custom_attributes' => ['step' => '0.01', 'min' => '0'],
        'desc_tip' => true,
        'description' => __('Leave empty if product is not subject to packaging tax.', 'your-textdomain'),
    ]);
}

add_action('woocommerce_process_product_meta', 'ptax_rate_field_save');
function ptax_rate_field_save($post_id)
{
    $val = isset($_POST['_ptax_rate']) ? sanitize_text_field($_POST['_ptax_rate']) : '';
    update_post_meta($post_id, '_ptax_rate', $val);
}

// Make cart icon link go to checkout, not cart
add_filter('woocommerce_get_cart_url', 'stpp_cart_url_to_checkout');
function stpp_cart_url_to_checkout($url)
{
    return wc_get_checkout_url();
}

// BLOCK BOTS
add_action('init', function () {
    $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';

    // Block empty user agents
    if (empty(trim($ua))) {
        wp_die('Access denied.', 'Forbidden', ['response' => 403]);
    }

    // Known bad bots
    $blocked = ['AhrefsBot', 'SemrushBot', 'MJ12bot', 'DotBot', 'BLEXBot', 'Bytespider'];
    foreach ($blocked as $bot) {
        if (stripos($ua, $bot) !== false) {
            wp_die('Access denied.', 'Forbidden', ['response' => 403]);
        }
    }
}, 1); // priority 1 = very early
