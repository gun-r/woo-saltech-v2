<?php
/**
 * Product tabs template override for TailwindCSS
 *
 * Copy this file to yourtheme/woocommerce/single-product/tabs/tabs.php
 */

if (!defined('ABSPATH')) {
  exit;
}

global $product;

$tabs = apply_filters('woocommerce_product_tabs', []);

if (!empty($tabs)): ?>
  <div class="w-full" x-data="{ activeTab: '<?php echo key($tabs); ?>' }">

    <!-- Tab Buttons -->
    <div class="flex flex-wrap border-b border-gray-200 -mb-px">
      <?php foreach ($tabs as $key => $tab): ?>
        <button @click="activeTab = '<?php echo esc_attr($key); ?>'" :class="activeTab === '<?php echo esc_attr($key); ?>'
            ? 'border-red-700 text-red-700'
            : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300 '"
          class="whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm transition-all">
          <?php echo apply_filters('woocommerce_product_' . $key . '_tab_title', esc_html($tab['title']), $key); ?>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- Tab Content -->
    <div class="p-4">
      <?php foreach ($tabs as $key => $tab): ?>
        <div x-show="activeTab === '<?php echo esc_attr($key); ?>'" x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak
          class="tab-content-wrapper">
          <?php if (isset($tab['callback'])) {
            call_user_func($tab['callback'], $key, $tab);
          } ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <style>
    [x-cloak] {
      display: none !important;
    }

    /* Tab Content Typography */
    .tab-content-wrapper {
      color: #374151;
      font-size: 0.875rem;
      line-height: 1.75;
    }

    .tab-content-wrapper h2 {
      margin-top: 2rem;
      margin-bottom: 1rem;
      font-size: 1.5rem;
      font-weight: 700;
      color: #111827;
    }

    .tab-content-wrapper h3 {
      margin-top: 1.5rem;
      margin-bottom: 0.75rem;
      font-size: 1.25rem;
      font-weight: 600;
      color: #111827;
    }

    .tab-content-wrapper h4 {
      margin-top: 1.25rem;
      margin-bottom: 0.5rem;
      font-size: 1.125rem;
      font-weight: 600;
      color: #111827;
    }

    .tab-content-wrapper p {
      margin-top: 0.75rem;
      margin-bottom: 0.75rem;
      line-height: 1.75;
    }

    .tab-content-wrapper a {
      color: #B91C1C;
      text-decoration: none;
    }

    .tab-content-wrapper a:hover {
      text-decoration: underline;
    }

    .tab-content-wrapper strong,
    .tab-content-wrapper b {
      font-weight: 600;
      color: #111827;
    }

    /* Lists */
    .tab-content-wrapper ul,
    .tab-content-wrapper ol {
      margin-top: 1rem;
      margin-bottom: 1rem;
      padding-left: 1.5rem;
    }

    .tab-content-wrapper ul {
      list-style-type: disc;
    }

    .tab-content-wrapper ol {
      list-style-type: decimal;
    }

    .tab-content-wrapper li {
      margin-top: 0.5rem;
      margin-bottom: 0.5rem;
    }

    /* Tables */
    .tab-content-wrapper table {
      width: 100%;
      margin: 1.5rem 0;
      border-collapse: collapse;
      border: 1px solid #E5E7EB;
    }

    .tab-content-wrapper table th {
      background-color: #F9FAFB;
      font-weight: 600;
      padding: 0.75rem;
      text-align: left;
      border: 1px solid #E5E7EB;
      color: #111827;
    }

    .tab-content-wrapper table td {
      padding: 0.75rem;
      border: 1px solid #E5E7EB;
    }

    .tab-content-wrapper table tr:nth-child(even) {
      background-color: #F9FAFB;
    }

    /* Images */
    .tab-content-wrapper img {
      max-width: 100%;
      height: auto;
      border-radius: 0.5rem;
      margin: 1.5rem 0;
    }

    /* WooCommerce Specific - Reviews */
    .tab-content-wrapper .woocommerce-Reviews .comment_container {
      margin-bottom: 1.5rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid #E5E7EB;
    }

    .tab-content-wrapper .woocommerce-Reviews .comment_container:last-child {
      border-bottom: none;
    }

    .tab-content-wrapper .star-rating {
      color: #FCD34D;
    }

    .tab-content-wrapper .star-rating span {
      color: #FCD34D;
    }

    /* WooCommerce Review Form */
    .tab-content-wrapper .comment-form-rating label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #374151;
    }

    .tab-content-wrapper .comment-form input[type="text"],
    .tab-content-wrapper .comment-form input[type="email"],
    .tab-content-wrapper .comment-form textarea {
      width: 100%;
      padding: 0.5rem 0.75rem;
      border: 1px solid #D1D5DB;
      border-radius: 0.375rem;
      font-size: 0.875rem;
    }

    .tab-content-wrapper .comment-form input[type="text"]:focus,
    .tab-content-wrapper .comment-form input[type="email"]:focus,
    .tab-content-wrapper .comment-form textarea:focus {
      outline: none;
      border-color: #B91C1C;
      ring: 2px;
      ring-color: rgba(185, 28, 28, 0.2);
    }

    .tab-content-wrapper .comment-form button[type="submit"],
    .tab-content-wrapper .comment-form input[type="submit"] {
      background-color: #B91C1C;
      color: white;
      padding: 0.5rem 1.5rem;
      border-radius: 0.375rem;
      font-weight: 500;
      border: none;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .tab-content-wrapper .comment-form button[type="submit"]:hover,
    .tab-content-wrapper .comment-form input[type="submit"]:hover {
      background-color: #991B1B;
    }

    /* Additional Information Table (Attributes) */
    .tab-content-wrapper .woocommerce-product-attributes {
      border: 1px solid #E5E7EB;
    }

    .tab-content-wrapper .woocommerce-product-attributes tr {
      border-bottom: 1px solid #E5E7EB;
    }

    .tab-content-wrapper .woocommerce-product-attributes tr:last-child {
      border-bottom: none;
    }

    .tab-content-wrapper .woocommerce-product-attributes th {
      background-color: #F9FAFB;
      font-weight: 600;
      padding: 0.75rem;
      text-align: left;
      width: 35%;
      color: #111827;
    }

    .tab-content-wrapper .woocommerce-product-attributes td {
      padding: 0.75rem;
    }
  </style>
<?php endif; ?>