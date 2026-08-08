<?php
$product_ids = [9667, 8948, 8949, 8953, 12623, 8975, 12879, 9249, 9668, 8951];

$args = [
    'post_type'      => 'product',
    'posts_per_page' => 10,
    'post_status'    => 'publish',
    'post__in'       => $product_ids,
    'orderby'        => 'post__in' 
];

$loop = new WP_Query($args);
?>

<div class="bg-gray-100 py-12 sm:py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Section Header -->
    <div class="flex items-center justify-between mb-8 pb-2 border-b border-[#A8CB05]">
      <div class="flex items-center gap-3">
        <h2 class="text-3xl tracking-tight text-[#003D82]">
          Fremhævede produkter
        </h2>
      </div>
      <a href="/shop"
        class="hidden sm:inline-flex items-center gap-2 text-sm text-[#A8CB05] ">
        Se alle
        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
        </svg>
      </a>
    </div>

    <?php if ($loop->have_posts()): ?>
      <div id="featured-products-grid"
        class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
        <?php while ($loop->have_posts()):
          $loop->the_post();
          global $product; ?>
          <div
            class="relative bg-white border border-gray-200 hover:border-gray-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">

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
                <span class="absolute top-2 right-2 px-2 py-1 bg-red-700 text-white text-xs font-bold rounded-md shadow-md">
                  SALE
                </span>
              <?php endif; ?>

              <!-- Stock Badge -->
              <?php if (!$product->is_in_stock()): ?>
                <span class="absolute top-2 left-2 px-2 py-1 bg-gray-900 text-white text-xs font-bold rounded-md shadow-md">
                  OUT OF STOCK
                </span>
              <?php endif; ?>
            </a>

            <!-- Product Info -->
            <div class="p-3 sm:p-4 flex flex-col flex-grow">
              <!-- Product Title -->
              <h3 class="text-sm font-medium text-gray-900 mb-2 line-clamp-2 min-h-[40px]">
                <a href="<?php the_permalink(); ?>" class="hover:text-red-700 transition-colors">
                  <?php the_title(); ?>
                </a>
              </h3>

              <!-- Rating -->
              <?php if (wc_review_ratings_enabled() && $product->get_rating_count()): ?>
                <div class="flex items-center mb-2">
                  <div class="flex items-center text-yellow-400">
                    <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                  </div>
                  <span class="ml-1 text-xs text-gray-500">(<?php echo $product->get_rating_count(); ?>)</span>
                </div>
              <?php endif; ?>

              <!-- Price -->
              <?php
              $product_price = $product->get_price();
              $is_zero_price = empty($product_price) || floatval($product_price) == 0;
              ?>

              <?php if (!$is_zero_price): ?>
                <div class="mb-3 text-base sm:text-lg font-bold text-gray-900">
                  <?php echo $product->get_price_html(); ?>
                </div>
              <?php endif; ?>

              <!-- Add to Cart Button -->
              <div class="mt-auto pt-2">
                <?php
                $product_price = $product->get_price();

                // Check if price is 0 or empty
                if (empty($product_price) || $product_price == 0):
                  ?>
                  <!-- Request Price Button -->
                  <a href="mailto:support@sal-tech.com?subject=Price Request for <?php echo urlencode(get_the_title()); ?>&body=I would like to request pricing information for: <?php echo urlencode(get_the_title()); ?> (Product ID: <?php echo $product->get_id(); ?>)"
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
        <?php endwhile; ?>
      </div>

      <!-- Load More / View More Button -->
      <div class="mt-10 text-center">
        <button id="load-more-featured"
          class="inline-flex items-center gap-2 px-8 py-3 text-sm font-bold rounded-md bg-red-800 text-white hover:bg-red-900 transition-colors shadow-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
          <span>Udforsk</span>
        </button>
      </div>

      <style>
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
        .button.add_to_cart_button,
        .button.product_type_variable {
          width: 100%;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          padding: 0.5rem 0.75rem;
          font-size: 0.875rem;
          font-weight: 500;
          transition: all 0.2s;
          border: none;
          cursor: pointer;
          background-color: #4CAF50;
          color: white;
          text-decoration: none;
        }

        a.request-btn:hover,
        .button.add_to_cart_button:hover,
        .button.product_type_variable:hover {
          background-color: #409142;
        }

        /* Add to cart button icons */
        .add_to_cart_button:before,
        .product_type_variable:before {
          content: '';
          display: inline-block;
          width: 16px;
          height: 16px;
          margin-right: 6px;
          background-size: contain;
          background-repeat: no-repeat;
          background-position: center;
        }

        .add_to_cart_button:before {
          background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'/%3E%3C/svg%3E");
        }

        .product_type_variable:before {
          background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'/%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'/%3E%3C/svg%3E");
        }

        /* Out of stock button */
        .button.add_to_cart_button[disabled],
        .button.add_to_cart_button.disabled {
          background-color: #D1D5DB !important;
          color: #6B7280 !important;
          cursor: not-allowed;
          opacity: 0.6;
        }

        /* Explore button loading state */
        #load-more-featured.loading {
          opacity: 0.6;
          pointer-events: none;
        }

        #load-more-featured.loading svg {
          animation: spin 1s linear infinite;
        }

        @keyframes spin {
          from {
            transform: rotate(0deg);
          }

          to {
            transform: rotate(360deg);
          }
        }

        /* Button disabled state */
        #load-more-featured:disabled {
          background-color: #D1D5DB;
          color: #6B7280;
          cursor: not-allowed;
        }
      </style>

      <script>
        jQuery(document).ready(function ($) {
          let loadMoreClicked = false;

          $('#load-more-featured').on('click', function () {
            const button = $(this);
            const buttonText = button.find('span');
            const buttonIcon = button.find('svg');

            if (loadMoreClicked) {
              window.location.href = '/shop';
              return;
            }

            button.addClass('loading');
            buttonText.text('Loading...');

            $.ajax({
              url: '<?php echo admin_url('admin-ajax.php'); ?>',
              type: 'POST',
              data: {
                action: 'load_more_featured_products',
                offset: 10
              },
              success: function (response) {
                if (response.success) {
                  $('#featured-products-grid').append(response.data.html);
                  button.removeClass('loading');
                  buttonIcon.replaceWith('<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l2 12h11l2-8H6"/><circle cx="9" cy="19" r="1.5"/><circle cx="17" cy="19" r="1.5"/></svg>');
                  buttonText.text('Go to Shop');
                  loadMoreClicked = true;
                } else {
                  button.removeClass('loading').prop('disabled', true);
                  buttonText.text('No More Products');
                }
              },
              error: function () {
                button.removeClass('loading');
                buttonText.text('Error - Try Again');
              }
            });
          });
        });
      </script>

    <?php else: ?>
      <div class="text-center py-16">
        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900"><?php esc_html_e('No products found', 'woocommerce'); ?></h3>
        <p class="mt-2 text-sm text-gray-500"><?php esc_html_e('Check back soon for new products.', 'woocommerce'); ?></p>
      </div>
    <?php endif;

    wp_reset_postdata();
    ?>
  </div>
</div>
