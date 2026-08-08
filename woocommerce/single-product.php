<?php
defined('ABSPATH') || exit;

get_header('shop');

while (have_posts()):
  the_post();
  global $product; ?>

  <div class="bg-gray-50 py-8 sm:py-12 lg:py-6 min-h-screen">
    <div class="mx-auto container px-4 sm:px-6 lg:px-8">

      <!-- Breadcrumbs -->
      <div class="mb-6">
        <?php woocommerce_breadcrumb(['wrap_before' => '<nav class="flex text-sm text-gray-600">', 'wrap_after' => '</nav>', 'delimiter' => '<span class="mx-2">/</span>']); ?>
      </div>

      <!-- Main Product Section -->
      <div class="bg-white shadow-sm border border-gray-200 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 p-6 sm:p-8 lg:p-10">

          <!-- Product Gallery -->
          <div class="order-1">
            <!-- Main Gallery Slider -->
            <div class="swiper mySwiper2 mb-4 overflow-hidden bg-gray-100">
              <div class="swiper-wrapper" id="main-swiper-wrapper">
                <?php
                $main_image_id = $product->get_image_id();
                if ($main_image_id) {
                  echo '<div class="swiper-slide aspect-square sm:h-[500px] w-full flex items-center justify-center" data-original="true">'
                    . wp_get_attachment_image($main_image_id, 'stpp-gallery', false, ['class' => 'w-full h-full object-contain'])
                    . '</div>';
                } else {
                  echo '<div class="swiper-slide aspect-square sm:h-[500px] w-full flex items-center justify-center bg-gray-200" data-original="true">'
                    . '<svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>'
                    . '</div>';
                }

                $gallery_ids = $product->get_gallery_image_ids();
                if ($gallery_ids) {
                  foreach ($gallery_ids as $image_id) {
                    echo '<div class="swiper-slide aspect-square sm:h-[500px] w-full flex items-center justify-center" data-original="true">'
                      . wp_get_attachment_image($image_id, 'stpp-gallery', false, ['class' => 'w-full h-full object-contain'])
                      . '</div>';
                  }
                }
                ?>
              </div>
              <div class="swiper-button-next !text-red-600 after:!text-2xl"></div>
              <div class="swiper-button-prev !text-red-600 after:!text-2xl"></div>
            </div>

            <!-- Thumbnails Slider -->
            <?php if ($main_image_id || !empty($gallery_ids)): ?>
              <div class="swiper mySwiperThumbs">
                <div class="swiper-wrapper gap-2" id="thumb-swiper-wrapper">
                  <?php
                  if ($main_image_id) {
                    echo '<div class="swiper-slide !w-20 !h-20 sm:!w-24 sm:!h-24 flex items-center justify-center bg-gray-100 cursor-pointer rounded-lg border-2 border-transparent hover:border-red-600 transition-all" data-original="true">'
                      . wp_get_attachment_image($main_image_id, 'thumbnail', false, ['class' => 'w-full h-full object-cover rounded-lg'])
                      . '</div>';
                  }
                  if ($gallery_ids) {
                    foreach ($gallery_ids as $image_id) {
                      echo '<div class="swiper-slide !w-20 !h-20 sm:!w-24 sm:!h-24 flex items-center justify-center bg-gray-100 cursor-pointer rounded-lg border-2 border-transparent hover:border-red-600 transition-all" data-original="true">'
                        . wp_get_attachment_image($image_id, 'thumbnail', false, ['class' => 'w-full h-full object-cover rounded-lg'])
                        . '</div>';
                    }
                  }
                  ?>
                </div>
              </div>
            <?php endif; ?>
          </div>

          <!-- Product Info -->
          <div class="order-2 lg:sticky lg:top-8 lg:self-start">

            <!-- Product Title -->
            <h1 class="text-2xl sm:text-2xl font-semibold text-gray-900 mb-4"><?php the_title(); ?></h1>

            <!-- Rating & Stock -->
            <div class="flex items-center gap-4 mb-4">
              <?php if ($product->get_rating_count()): ?>
                <div class="flex items-center">
                  <?php woocommerce_template_loop_rating(); ?>
                  <span class="ml-2 text-sm text-gray-600">(<?php echo $product->get_rating_count(); ?> reviews)</span>
                </div>
              <?php endif; ?>

              <?php if ($product->is_in_stock()): ?>
                <span
                  class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                  <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd" />
                  </svg>
                  In Stock
                </span>
              <?php else: ?>
                <span
                  class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                  Out of Stock
                </span>
              <?php endif; ?>
            </div>

            <!-- Price -->
            <?php
            $product_price = $product->get_price();
            $is_zero_price = empty($product_price) || floatval($product_price) == 0;
            ?>
            <?php if (!$is_zero_price): ?>
              <div class="mb-6 py-4" id="stpp-price-wrapper">
                <div class="text-2xl font-bold text-green-900" id="stpp-price-display">
                  <?php woocommerce_template_single_price(); ?>
                </div>
                <!-- Tier badge: shown when a tier is active -->
                <!--div id="stpp-tier-badge" style="display:none;" class="mt-2 inline-flex items-center gap-1 text-xs font-medium bg-green-100 text-green-800 border border-green-200 px-3 py-1 rounded-full">
                  <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                  </svg>
                  <span id="stpp-tier-badge-text"></span>
              </div-->
              </div>
            <?php endif; ?>

            <!-- Short Description -->
            <div class="mb-6 prose prose-sm max-w-none text-gray-700">
              <?php woocommerce_template_single_excerpt(); ?>
            </div>

            <!-- Add to Cart or Request Price -->
            <div class="mb-6 py-4">
              <?php if ($is_zero_price): ?>
                <a href="mailto:support@sal-tech.com?subject=Price Request for <?php echo urlencode(get_the_title()); ?>&body=I would like to request pricing information for: <?php echo urlencode(get_the_title()); ?> (Product ID: <?php echo $product->get_id(); ?>)"
                  class="w-full inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors text-base">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                  <span>
                    <!-- Request Price -->
                    Forespørg pris
                  </span>
                </a>
                <p class="mt-3 text-sm text-gray-600 text-center">
                  <svg class="w-4 h-4 inline text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Contact us for pricing information
                </p>
              <?php else: ?>
                <?php woocommerce_template_single_add_to_cart(); ?>
              <?php endif; ?>
            </div>

            <!-- Quantity Discount Table -->
            <?php
            if (function_exists('stpp_display_tier_table')) {
              stpp_display_tier_table();
            }
            ?>

            <!-- Product Meta -->
            <div class="border-t border-gray-200 pt-6 space-y-3">
              <?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))): ?>
                <div class="flex items-start gap-2 text-sm">
                  <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                  </svg>
                  <div>
                    <span class="font-medium text-gray-700">Varenummer:</span>
                    <span
                      class="text-gray-600 ml-2 sku"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></span>
                  </div>
                </div>
              <?php endif; ?>

              <?php $categories = wc_get_product_category_list($product->get_id(), ', ');
              if ($categories): ?>
                <div class="flex items-start gap-2 text-sm">
                  <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                  </svg>
                  <div>
                    <span class="font-medium text-gray-700">Categories:</span>
                    <span class="text-gray-600 ml-2"><?php echo $categories; ?></span>
                  </div>
                </div>
              <?php endif; ?>

              <?php $tags = wc_get_product_tag_list($product->get_id(), ', ');
              if ($tags): ?>
                <div class="flex items-start gap-2 text-sm">
                  <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                  </svg>
                  <div>
                    <span class="font-medium text-gray-700">Tags:</span>
                    <span class="text-gray-600 ml-2"><?php echo $tags; ?></span>
                  </div>
                </div>
              <?php endif; ?>
            </div>

          </div><!-- /.order-2 -->
        </div>
      </div>

      <!-- Product Tabs -->
      <div class="mt-8 bg-white shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 sm:p-8">
          <?php woocommerce_output_product_data_tabs(); ?>
        </div>
      </div>

      <!-- Accessories -->
      <?php echo do_shortcode('[wc_accessories]'); ?>

      <!-- Related Products -->
      <div class="mt-8">
        <?php woocommerce_output_related_products(); ?>
      </div>

    </div>
  </div>

  <style>
    .mySwiper2 .swiper-button-next,
    .mySwiper2 .swiper-button-prev {
      background: rgba(255, 255, 255, 0.9);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .mySwiperThumbs .swiper-slide-thumb-active {
      border-color: #DC2626 !important;
    }

    .mySwiper2 .swiper-slide img {
      transition: opacity 0.25s ease;
    }

    .single_add_to_cart_button {
      @apply w-full inline-flex items-center justify-center gap-2 bg-red-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-700 transition-colors text-base;
    }

    .quantity input {
      @apply w-20 px-3 py-2 border border-gray-300 rounded-lg text-center;
    }

    .variations select {
      @apply w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500;
    }

    .variations label {
      @apply block text-sm font-medium text-gray-700 mb-2;
    }

    .variations .reset_variations {
      @apply text-sm text-red-600 hover:text-red-700 underline;
    }

    .woocommerce-tabs .tabs {
      @apply flex flex-wrap gap-2 border-b border-gray-200 mb-6;
    }

    .woocommerce-tabs .tabs li {
      @apply -mb-px;
    }

    .woocommerce-tabs .tabs li a {
      @apply block px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-b-2 hover:border-red-600 transition-colors;
    }

    .woocommerce-tabs .tabs li.active a {
      @apply text-red-600 border-b-2 border-red-600;
    }

    .woocommerce-tabs .panel {
      @apply prose prose-sm max-w-none;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {

      // ── Swiper initialisation ──────────────────────────────────────────────
      var thumbsSwiper = new Swiper('.mySwiperThumbs', {
        spaceBetween: 8,
        slidesPerView: 'auto',
        freeMode: true,
        watchSlidesProgress: true,
      });

      var mainSwiper = new Swiper('.mySwiper2', {
        spaceBetween: 10,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        thumbs: { swiper: thumbsSwiper },
      });

      // ── Variation image swap ───────────────────────────────────────────────
      var $form = jQuery('form.variations_form');
      var variationSlideInjected = false;

      function buildMainSlide(src, alt) {
        return '<div class="swiper-slide aspect-square sm:h-[500px] w-full flex items-center justify-center" data-variation="true">'
          + '<img src="' + (alt = alt || '', src) + '" alt="' + alt + '" class="w-full h-full object-contain" /></div>';
      }

      function buildThumbSlide(src, alt) {
        alt = alt || '';
        return '<div class="swiper-slide !w-20 !h-20 sm:!w-24 sm:!h-24 flex items-center justify-center bg-gray-100 cursor-pointer rounded-lg border-2 border-transparent hover:border-red-600 transition-all" data-variation="true">'
          + '<img src="' + src + '" alt="' + alt + '" class="w-full h-full object-cover rounded-lg" /></div>';
      }

      function removeVariationSlides() {
        if (!variationSlideInjected) return;
        if (mainSwiper.slides.length && mainSwiper.slides[0].dataset.variation === 'true') mainSwiper.removeSlide(0);
        if (thumbsSwiper.slides.length && thumbsSwiper.slides[0].dataset.variation === 'true') thumbsSwiper.removeSlide(0);
        variationSlideInjected = false;
      }

      function injectVariationSlide(imgSrc, imgSrcset, imgAlt, thumbSrc) {
        removeVariationSlides();
        mainSwiper.prependSlide(buildMainSlide(imgSrc, imgAlt));
        if (imgSrcset) {
          var newImg = mainSwiper.slides[0].querySelector('img');
          if (newImg) newImg.setAttribute('srcset', imgSrcset);
        }
        thumbsSwiper.prependSlide(buildThumbSlide(thumbSrc || imgSrc, imgAlt));
        variationSlideInjected = true;
        mainSwiper.slideTo(0, 300);
        thumbsSwiper.slideTo(0, 300);
        mainSwiper.update();
        thumbsSwiper.update();
      }

      // ── Tier pricing data (PHP → JS) ───────────────────────────────────────
      var stppTiers = <?php
      $stpp_id = $product->get_parent_id() ?: $product->get_id();
      $stpp_tiers = get_post_meta($stpp_id, '_stpp_tiers', true);
      echo json_encode(is_array($stpp_tiers) ? $stpp_tiers : []);
      ?>;
      var stppBasePrice = <?php echo json_encode((float) $product->get_price()); ?>;
      var stppCurrentBase = stppBasePrice; // updated on variation change

      var stppPriceEl = document.querySelector('#stpp-price-display .woocommerce-Price-amount bdi');
      var stppBadge = document.getElementById('stpp-tier-badge');
      var stppBadgeTxt = document.getElementById('stpp-tier-badge-text');

      function stppGetSymbol() {
        var el = document.querySelector('.woocommerce-Price-currencySymbol');
        return el ? el.textContent : 'kr.';
      }

      function stppFormat(price) {
        return price.toLocaleString('da-DK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      }

      function stppGetTierPrice(qty) {
        var matched = null;
        stppTiers.forEach(function (tier) {
          if (qty >= parseInt(tier.qty) && (matched === null || parseInt(tier.qty) > parseInt(matched.qty))) {
            matched = tier;
          }
        });
        return matched ? parseFloat(matched.price) : null;
      }

      function stppHighlightRow(activeQty) {
        // highlight matching row in the tier table
        var rows = document.querySelectorAll('.stpp-frontend-table tbody tr');
        rows.forEach(function (row) {
          var qtyCell = row.querySelector('td:nth-child(2)');
          if (!qtyCell) return;
          var rowQty = parseInt(qtyCell.textContent.trim());
          row.style.background = (activeQty >= rowQty) ? '#f0fdf4' : '';
        });
      }

      function stppUpdatePrice(qty) {
        if (!stppPriceEl) return;
        var tierPrice = stppGetTierPrice(qty);
        var price = tierPrice !== null ? tierPrice : stppCurrentBase;
        var symbol = stppGetSymbol();

        stppPriceEl.innerHTML = '<span class="woocommerce-Price-currencySymbol">' + symbol + '</span>' + stppFormat(price);

        if (tierPrice !== null && stppBadge && stppBadgeTxt) {
          stppBadgeTxt.textContent = 'Tier price: ' + symbol + stppFormat(tierPrice);
          stppBadge.style.display = 'inline-flex';
        } else if (stppBadge) {
          stppBadge.style.display = 'none';
        }

        stppHighlightRow(qty);
      }

      function stppGetQty() {
        var input = document.querySelector('input.qty');
        return input ? Math.max(1, parseInt(input.value) || 1) : 1;
      }

      // Watch native qty input changes
      document.addEventListener('change', function (e) {
        if (e.target && e.target.classList.contains('qty')) {
          stppUpdatePrice(stppGetQty());
        }
      });

      // Watch +/- custom buttons (WooCommerce quantity plus/minus)
      document.addEventListener('click', function (e) {
        if (e.target.closest('.quantity .plus, .quantity .minus, [data-quantity]')) {
          setTimeout(function () { stppUpdatePrice(stppGetQty()); }, 50);
        }
      });

      // Also observe qty input directly for any programmatic changes
      var qtyInput = document.querySelector('input.qty');
      if (qtyInput) {
        qtyInput.addEventListener('input', function () {
          setTimeout(function () { stppUpdatePrice(stppGetQty()); }, 50);
        });
      }

      // ── SKU update ─────────────────────────────────────────────────────────
      var skuEl = document.querySelector('.sku');
      var parentSku = skuEl ? skuEl.textContent.trim() : '<?php echo esc_js($product->get_sku() ?: __('N/A', 'woocommerce')); ?>';

      // ── Variation events ───────────────────────────────────────────────────
      if ($form.length) {

        $form.on('found_variation', function (event, variation) {
          // Swap image
          var img = variation && variation.image;
          if (img && img.src && img.src.trim() !== '') {
            injectVariationSlide(img.src, img.srcset || '', img.alt || '', img.thumb_src || img.src);
          }

          // Update SKU
          if (skuEl) {
            skuEl.textContent = (variation.sku && variation.sku.trim() !== '') ? variation.sku : parentSku;
          }

          // Update base price for this variation, then apply tier
          stppCurrentBase = parseFloat(variation.display_price) || stppBasePrice;
          stppUpdatePrice(stppGetQty());
        });

        $form.on('reset_data', function () {
          // Reset image
          removeVariationSlides();
          mainSwiper.slideTo(0, 300);
          thumbsSwiper.slideTo(0, 300);

          // Reset SKU
          if (skuEl) skuEl.textContent = parentSku;

          // Reset price back to base
          stppCurrentBase = stppBasePrice;
          stppUpdatePrice(stppGetQty());
        });

      }

      // Initial highlight on load (qty = 1, likely no tier active, but rows rendered correctly)
      if (stppTiers.length) stppUpdatePrice(stppGetQty());

    });
  </script>

<?php endwhile;
get_footer('shop'); ?>