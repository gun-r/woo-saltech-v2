<?php /* Template Name: Cart */ ?>
<?php get_header(); ?>

<div class="bg-white">
  <div class="mx-auto max-w-2xl px-4 pt-16 pb-24 sm:px-6 lg:max-w-7xl lg:px-8">
    <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Shopping Cart</h1>

    <?php if (WC()->cart->get_cart_contents_count() > 0): ?>
      <form class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16" method="post">
        <section aria-labelledby="cart-heading" class="lg:col-span-7">
          <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>
          <ul role="list" class="divide-y divide-gray-200 border-t border-b border-gray-200">
            <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
              $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
              $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
              if ($_product && $_product->exists() && $cart_item['quantity'] > 0):
                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail'), $cart_item, $cart_item_key);
                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                ?>
                <li class="flex py-6 sm:py-10">
                  <div class="shrink-0">
                    <?php echo str_replace('class="', 'class="size-24 rounded-md object-cover sm:size-48 ', $thumbnail); ?>
                  </div>
                  <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                    <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                      <div>
                        <div class="flex justify-between">
                          <h3 class="text-sm">
                            <?php if ($product_permalink): ?>
                              <a href="<?php echo esc_url($product_permalink); ?>"
                                class="font-medium text-gray-700 hover:text-gray-800"><?php echo wp_kses_post($_product->get_name()); ?></a>
                            <?php else: ?>
                              <span class="font-medium text-gray-700"><?php echo wp_kses_post($_product->get_name()); ?></span>
                            <?php endif; ?>
                          </h3>
                        </div>
                        <div class="mt-1 flex text-sm">
                          <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                        </div>
                        <p class="mt-1 text-sm font-medium text-gray-900">
                          <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); ?>
                        </p>
                      </div>
                      <div class="mt-4 sm:mt-0 sm:pr-9">
                        <div class="cart-quantity-wrapper">
                          <?php
                          $qty_args = [
                            'input_name' => "cart[{$cart_item_key}][qty]",
                            'input_value' => $cart_item['quantity'],
                            'max_value' => $_product->get_max_purchase_quantity(),
                            'min_value' => '0',
                            'step' => '1',
                          ];
                          woocommerce_quantity_input($qty_args, $_product, false);
                          ?>
                        </div>
                        <div class="absolute top-0 right-0">
                          <a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>"
                            class="-m-2 inline-flex p-2 text-gray-400 hover:text-gray-500 remove"
                            aria-label="<?php esc_attr_e('Remove this item', 'woocommerce'); ?>"
                            data-product_id="<?php echo esc_attr($product_id); ?>"
                            data-cart_item_key="<?php echo esc_attr($cart_item_key); ?>"
                            data-product_sku="<?php echo esc_attr($_product->get_sku()); ?>">
                            <span class="sr-only">Remove</span>
                            <svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
                              <path
                                d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                            </svg>
                          </a>
                        </div>
                      </div>
                    </div>
                    <p class="mt-4 flex space-x-2 text-sm text-gray-700">
                      <?php if ($_product->is_in_stock()): ?>
                        <svg class="size-5 shrink-0 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd"
                            d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                            clip-rule="evenodd" />
                        </svg>
                        <span>In stock</span>
                      <?php else: ?>
                        <svg class="size-5 shrink-0 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd"
                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z"
                            clip-rule="evenodd" />
                        </svg>
                        <span>Ships in 3–4 weeks</span>
                      <?php endif; ?>
                    </p>
                  </div>
                </li>
              <?php endif;
            endforeach; ?>
          </ul>

          <!-- Update Cart Button -->
          <div class="mt-6 flex justify-end">
            <button type="submit" name="update_cart" value="Update cart"
              class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
              </svg>
              <span>Refresh</span>
            </button>
          </div>

          <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
        </section>

        <!-- Order summary -->
        <section aria-labelledby="summary-heading"
          class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
          <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>
          <dl class="mt-6 space-y-4">
            <div class="flex items-center justify-between">
              <dt class="text-sm text-gray-600">Subtotal</dt>
              <dd class="text-sm font-medium text-gray-900"><?php wc_cart_totals_subtotal_html(); ?></dd>
            </div>
            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
              <dt class="flex items-center text-sm text-gray-600">
                <span>Shipping estimate</span>
                <a href="#" class="ml-2 shrink-0 text-gray-400 hover:text-gray-500">
                  <span class="sr-only">Learn more</span>
                  <svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM8.94 6.94a.75.75 0 1 1-1.061-1.061 3 3 0 1 1 2.871 5.026v.345a.75.75 0 0 1-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 1 0 8.94 6.94ZM10 15a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                      clip-rule="evenodd" />
                  </svg>
                </a>
              </dt>
              <dd class="text-sm font-medium text-gray-900"><?php wc_cart_totals_shipping_html(); ?></dd>
            </div>
            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
              <dt class="flex text-sm text-gray-600">
                <span>Tax estimate</span>
                <a href="#" class="ml-2 shrink-0 text-gray-400 hover:text-gray-500">
                  <span class="sr-only">Learn more</span>
                  <svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM8.94 6.94a.75.75 0 1 1-1.061-1.061 3 3 0 1 1 2.871 5.026v.345a.75.75 0 0 1-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 1 0 8.94 6.94ZM10 15a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                      clip-rule="evenodd" />
                  </svg>
                </a>
              </dt>
              <dd class="text-sm font-medium text-gray-900"><?php wc_cart_totals_taxes_total_html(); ?></dd>
            </div>
            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
              <dt class="text-base font-medium text-gray-900">Order total</dt>
              <dd class="text-base font-medium text-gray-900"><?php wc_cart_totals_order_total_html(); ?></dd>
            </div>
          </dl>

          <!-- Notice -->
          <div class="mt-6 bg-blue-50 border border-blue-200 rounded-md p-4">
            <div class="flex items-start">
              <svg class="h-5 w-5 text-blue-500 flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                  clip-rule="evenodd" />
              </svg>
              <div class="ml-3">
                <h3 class="text-sm font-semibold text-blue-800 mb-1">Please Note</h3>
                <p class="text-sm text-blue-700 leading-relaxed">
                  The total amount shown above (including tax) is <strong>not your final price</strong>. Shipping costs
                  will be calculated based on your location and added to this total. Our team will contact you with the
                  complete final amount before processing your payment.
                </p>
              </div>
            </div>
          </div>

          <div class="mt-6">
            <a href="<?php echo wc_get_checkout_url(); ?>"
              class="block w-full rounded-md bg-green-600 px-4 py-3 text-center text-base font-medium text-white shadow-xs hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-50 transition-colors">
              Checkout
            </a>
          </div>
        </section>
      </form>
    <?php else: ?>
      <div class="mt-12 text-center">
        <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">Your cart is empty</h3>
        <p class="mt-2 text-sm text-gray-500">Start shopping to add items to your cart.</p>
        <div class="mt-6">
          <a href="/shop"
            class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <span>Continue Shopping</span>
          </a>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<style>
  /* Cart Quantity Input Styling */
  .cart-quantity-wrapper {
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 8rem;
  }

  .cart-quantity-wrapper .quantity {
    display: flex;
    align-items: center;
    width: 100%;
  }

  .cart-quantity-wrapper .quantity label {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
  }

  .cart-quantity-wrapper .quantity input.qty {
    width: 100%;
    padding: 0.5rem;
    text-align: center;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #111827;
    background: white;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  .cart-quantity-wrapper .quantity input.qty:focus {
    outline: none;
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
  }

  /* Remove number input arrows */
  .cart-quantity-wrapper .quantity input[type="number"]::-webkit-inner-spin-button,
  .cart-quantity-wrapper .quantity input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  .cart-quantity-wrapper .quantity input[type="number"] {
    -moz-appearance: textfield;
  }

  /* Mobile responsive adjustments */
  @media (max-width: 639px) {
    .cart-quantity-wrapper {
      max-width: 6rem;
    }

    .cart-quantity-wrapper .quantity input.qty {
      padding: 0.375rem;
      font-size: 0.8125rem;
    }
  }
</style>

<script type="text/javascript">
  jQuery(document).ready(function ($) {
    // Auto-update cart when quantity changes
    let updateTimer;

    $('.cart-quantity-wrapper input.qty').on('change', function () {
      clearTimeout(updateTimer);
      const $form = $(this).closest('form');

      updateTimer = setTimeout(function () {
        $('[name="update_cart"]').prop('disabled', true).text('Updating...');
        $form.submit();
      }, 800);
    });

    // Confirm remove item
    $('.remove').on('click', function (e) {
      if (!confirm('Are you sure you want to remove this item from your cart?')) {
        e.preventDefault();
      }
    });
  });
</script>

<?php get_footer(); ?>