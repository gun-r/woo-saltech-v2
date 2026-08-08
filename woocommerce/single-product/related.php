<?php
if ($related_products): ?>

  <div class="mt-8 sm:mt-12">
    <div class="bg-white shadow-sm border border-gray-200 overflow-hidden">

      <!-- Section Header -->
      <div class="px-6 sm:px-8 py-3 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">
              <?php esc_html_e('Relateret Produkter', 'woocommerce'); ?>
            </h2>
          </div>
          <span
            class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
            <?php echo count($related_products); ?> items
          </span>
        </div>
      </div>

      <!-- Products Grid -->
      <div class="p-4 sm:p-6">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6">
          <?php foreach ($related_products as $related_product):
            $post_object = get_post($related_product->get_id());
            setup_postdata($GLOBALS['post'] = &$post_object); ?>

            <div
              class="relative bg-white rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden">

              <!-- Product Image -->
              <a href="<?php the_permalink(); ?>" class="block relative overflow-hidden bg-gray-100 aspect-square">
                <?php
                if ($related_product->get_image_id()) {
                  echo $related_product->get_image('woocommerce_thumbnail', [
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
                <?php if ($related_product->is_on_sale()): ?>
                  <span class="absolute top-2 right-2 px-2 py-1 bg-red-700 text-white text-xs font-bold rounded-md shadow-md">
                    SALE
                  </span>
                <?php endif; ?>

                <!-- Stock Badge -->
                <?php if (!$related_product->is_in_stock()): ?>
                  <span class="absolute top-2 left-2 px-2 py-1 bg-gray-900 text-white text-xs font-bold rounded-md shadow-md">
                    OUT OF STOCK
                  </span>
                <?php endif; ?>
              </a>

              <!-- Product Info -->
              <div class="p-3 sm:p-4">
                <!-- Product Title -->
                <h3 class="text-sm font-medium text-gray-900 mb-2 line-clamp-2 min-h-[40px]">
                  <a href="<?php the_permalink(); ?>" class="hover:text-red-600 transition-colors">
                    <?php the_title(); ?>
                  </a>
                </h3>

                <!-- Rating -->
                <?php if (wc_review_ratings_enabled() && $related_product->get_rating_count()): ?>
                  <div class="flex items-center mb-2">
                    <div class="flex items-center text-yellow-400">
                      <?php echo wc_get_rating_html($related_product->get_average_rating()); ?>
                    </div>
                    <span class="ml-1 text-xs text-gray-500">(<?php echo $related_product->get_rating_count(); ?>)</span>
                  </div>
                <?php endif; ?>

                <!-- Price -->
                <?php
                $product_price = $related_product->get_price();
                $is_zero_price = empty($product_price) || floatval($product_price) == 0;
                ?>

                <?php if (!$is_zero_price): ?>
                  <div class="mb-3 text-base sm:text-lg font-bold text-gray-900">
                    <?php echo $related_product->get_price_html(); ?>
                  </div>
                <?php endif; ?>

                <!-- Add to Cart Button -->
                <div class="flex items-center justify-center">
                  <?php
                  $product_price = $related_product->get_price();

                  // Check if price is 0 or empty
                  if (empty($product_price) || $product_price == 0):
                    ?>
                    <!-- Request Price Button -->
                    <a href="mailto:support@sal-tech.com?subject=Price Request for <?php echo urlencode(get_the_title()); ?>&body=I would like to request pricing information for: <?php echo urlencode(get_the_title()); ?> (Product ID: <?php echo get_the_ID(); ?>)"
                      class="request-btn gap-2">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                      </svg>
                      Request Price
                    </a>
                  <?php else: ?>
                    <!-- Regular Add to Cart -->
                    <?php woocommerce_template_loop_add_to_cart(); ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <style>
    /* Rating stars */
    .star-rating {
      display: inline-flex;
    }

    .star-rating span {
      color: #FCD34D;
    }

    /* Line clamp for product titles */
    .line-clamp-2 {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    /* Price styling */
    .price {
      color: inherit;
    }

    .price del {
      opacity: 0.5;
      font-size: 0.875em;
    }

    .price ins {
      text-decoration: none;
      color: #B91C1C;
    }

    /* Add to cart button base styles */
    a.request-btn,
    a.button.add_to_cart_button,
    a.button.product_type_simple,
    a.button.product_type_variable,
    a.button.product_type_grouped,
    a.button.product_type_external {
      width: 100% !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      padding: 0.5rem 0.75rem !important;
      font-size: 0.875rem !important;
      font-weight: 500 !important;
      border-radius: 0.375rem !important;
      transition: all 0.2s !important;
      border: none !important;
      cursor: pointer !important;
      background-color: #4CAF50 !important;
      color: white !important;
      text-decoration: none !important;
    }

    a.request-btn:hover,
    a.button.add_to_cart_button:hover,
    a.button.product_type_simple:hover,
    a.button.product_type_variable:hover,
    a.button.product_type_grouped:hover,
    a.button.product_type_external:hover {
      background-color: #409142 !important;
      color: white !important;
    }

    /* Add to cart button icons */
    a.add_to_cart_button:before,
    a.product_type_simple:before,
    a.product_type_variable:before {
      content: '';
      display: inline-block;
      width: 16px;
      height: 16px;
      margin-right: 6px;
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
    }

    a.add_to_cart_button:before,
    a.product_type_simple:before {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'/%3E%3C/svg%3E");
    }

    a.product_type_variable:before {
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'/%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'/%3E%3C/svg%3E");
    }

    /* Out of stock button */
    a.button.add_to_cart_button[disabled],
    a.button.add_to_cart_button.disabled,
    a.button.out-of-stock {
      background-color: #D1D5DB !important;
      color: #6B7280 !important;
      cursor: not-allowed !important;
      opacity: 0.6 !important;
      pointer-events: none !important;
    }

    /* Custom scrollbar */
    .overflow-y-auto::-webkit-scrollbar {
      width: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
      background: #cbd5e1;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
  </style>

<?php endif;

wp_reset_postdata();
?>