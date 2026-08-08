<?php
/**
 * Template Name: Thank You Page
 */
get_header();

// Get order details from URL parameter
$order_id = isset($_GET['order_id']) ? absint($_GET['order_id']) : 0;
$order = $order_id ? wc_get_order($order_id) : null;
?>

<div class="bg-gradient-to-b from-green-50 via-white to-gray-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-4xl mx-auto">

    <!-- Success Icon & Animation -->
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center mb-6">
        <div class="relative">
          <!-- Animated rings -->
          <div class="absolute inset-0 bg-green-100 rounded-full animate-ping opacity-75"></div>
          <div class="absolute inset-0 bg-green-200 rounded-full animate-pulse"></div>

          <!-- Success checkmark -->
          <div class="relative bg-green-600 rounded-full p-6 shadow-2xl">
            <svg class="w-16 h-16 text-white animate-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
          </div>
        </div>
      </div>

      <!-- Thank You Message -->
      <!-- Thank You for Your Order! 🎉 -->
      <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-3">
        Tak for din ordre! 🎉
      </h1>
      <!-- Your order has been received and is now being processed. We've sent a confirmation email with your order details. -->
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Vi har modtaget din ordre og er nu i gang med at behandle den. Du har modtaget en ordrebekræftelse via e-mail
        med dine ordreoplysninger.
      </p>
    </div>

    <?php if ($order): ?>
      <!-- Order Details Card -->
      <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden mb-6">
        <!-- Order Header -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-5">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
              <!-- Order # -->
              <h2 class="text-xl font-semibold text-white mb-1">
                Ordrenr. <?php echo $order->get_order_number(); ?>
              </h2>
              <!-- Placed on -->
              <p class="text-green-100 text-sm">
                Bestilt den <?php echo $order->get_date_created()->format('F j, Y'); ?>
              </p>
            </div>
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-lg">
              <span class="w-2 h-2 bg-green-300 rounded-full animate-pulse"></span>
              <span class="text-white font-medium text-sm">
                <?php echo esc_html($order->get_status()); ?>
              </span>
            </div>
          </div>
        </div>

        <!-- Order Content -->
        <div class="p-6 space-y-6">

          <!-- Customer & Delivery Info Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Shipping Address -->
            <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
              <div class="flex items-start gap-3 mb-3">
                <div class="bg-green-100 rounded-lg p-2">
                  <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </div>
                <div>
                  <!-- Shipping Address -->
                  <h3 class="font-semibold text-gray-900 mb-1">Leveringsadresse</h3>
                  <div class="text-sm text-gray-600 space-y-0.5">
                    <p><?php echo $order->get_shipping_first_name() . ' ' . $order->get_shipping_last_name(); ?></p>
                    <p><?php echo $order->get_shipping_address_1(); ?></p>
                    <?php if ($order->get_shipping_address_2()): ?>
                      <p><?php echo $order->get_shipping_address_2(); ?></p>
                    <?php endif; ?>
                    <p>
                      <?php echo $order->get_shipping_city() . ', ' . $order->get_shipping_state() . ' ' . $order->get_shipping_postcode(); ?>
                    </p>
                    <p><?php echo $order->get_shipping_country(); ?></p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
              <div class="flex items-start gap-3 mb-3">
                <div class="bg-blue-100 rounded-lg p-2">
                  <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                </div>
                <div>
                  <!-- Contact Information -->
                  <h3 class="font-semibold text-gray-900 mb-1">Kontaktoplysninger</h3>
                  <div class="text-sm text-gray-600 space-y-1">
                    <p class="flex items-center gap-2">
                      <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                      </svg>
                      <?php echo $order->get_billing_email(); ?>
                    </p>
                    <?php if ($order->get_billing_phone()): ?>
                      <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <?php echo $order->get_billing_phone(); ?>
                      </p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Order Items -->
          <div>
            <!-- Order Items -->
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
              <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
              Ordrelinjer
            </h3>
            <div class="space-y-3">
              <?php foreach ($order->get_items() as $item_id => $item): ?>
                <div
                  class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg border border-gray-100 hover:border-gray-200 transition-colors">
                  <?php
                  $product = $item->get_product();
                  $thumbnail = $product ? $product->get_image('thumbnail', array('class' => 'rounded-lg')) : '';
                  ?>
                  <div class="w-16 h-16 flex-shrink-0 bg-white rounded-lg overflow-hidden border border-gray-200">
                    <?php echo $thumbnail; ?>
                  </div>
                  <div class="flex-1 min-w-0">
                    <h4 class="font-medium text-gray-900 text-sm"><?php echo $item->get_name(); ?></h4>
                    <!-- Quantity: -->
                    <p class="text-xs text-gray-500 mt-0.5">Antal: <?php echo $item->get_quantity(); ?></p>
                  </div>
                  <div class="text-right">
                    <p class="font-semibold text-gray-900"><?php echo $order->get_formatted_line_subtotal($item); ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Order Totals -->
          <div class="border-t border-gray-200 pt-6">
            <div class="space-y-3 max-w-sm ml-auto">
              <div class="flex justify-between text-sm">
                <!-- Subtotal -->
                <span class="text-gray-600">Subtotal</span>
                <span class="font-medium text-gray-900"><?php echo $order->get_subtotal_to_display(); ?></span>
              </div>
              <?php if ($order->get_shipping_total() > 0): ?>
                <div class="flex justify-between text-sm">
                  <!-- Shipping -->
                  <span class="text-gray-600">Fragt</span>
                  <span class="font-medium text-gray-900"><?php echo wc_price($order->get_shipping_total()); ?></span>
                </div>
              <?php endif; ?>
              <?php if ($order->get_total_tax() > 0): ?>
                <div class="flex justify-between text-sm">
                  <!-- Tax -->
                  <span class="text-gray-600">Moms</span>
                  <span class="font-medium text-gray-900"><?php echo wc_price($order->get_total_tax()); ?></span>
                </div>
              <?php endif; ?>
              <div class="flex justify-between text-lg font-bold pt-3 border-t border-gray-200">
                <!-- Total -->
                <span class="text-gray-900">Samlet beløb</span>
                <span class="text-green-700"><?php echo $order->get_formatted_order_total(); ?></span>
              </div>
            </div>
          </div>

        </div>
      </div>
    <?php endif; ?>

    <!-- What's Next Section -->
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 sm:p-8 mb-6 border border-blue-100">
      <!-- What happens next? -->
      <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Hvad sker der nu?
      </h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="flex items-start gap-3">
          <div
            class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
            1
          </div>
          <div>
            <!-- Order Confirmation -->
            <h4 class="font-semibold text-gray-900 text-sm mb-1">Ordrebekræftelse</h4>
            <!-- You'll receive an email confirmation shortly -->
            <p class="text-xs text-gray-600">Du modtager en ordrebekræftelse via e-mail inden for kort tid.</p>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <div
            class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
            2
          </div>
          <div>
            <!-- Processing -->
            <h4 class="font-semibold text-gray-900 text-sm mb-1">Behandling</h4>
            <!-- We'll prepare your order for shipment -->
            <p class="text-xs text-gray-600">Vi klargør din ordre til afsendelse.</p>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <div
            class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
            3
          </div>
          <div>
            <!-- Delivery -->
            <h4 class="font-semibold text-gray-900 text-sm mb-1">Levering</h4>
            <!-- Track your order and receive it soon -->
            <p class="text-xs text-gray-600">Følg din ordre, og modtag den snarest muligt.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"
        class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-red-700 text-white font-semibold rounded-lg hover:bg-red-800 transition-colors shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
        <!-- Continue Shopping -->
        Fortsæt med at handle
      </a>
      <?php if ($order): ?>
        <a href="<?php echo $order->get_view_order_url(); ?>"
          class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-white text-gray-700 font-semibold rounded-lg border-2 border-gray-300 hover:border-gray-400 hover:bg-gray-50 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <!-- View Order Details -->
          Se ordreoplysninger
        </a>
      <?php endif; ?>
    </div>

  </div>
</div>

<style>
  @keyframes check {
    0% {
      stroke-dasharray: 0 100;
    }

    100% {
      stroke-dasharray: 100 100;
    }
  }

  .animate-check {
    stroke-dasharray: 100;
    animation: check 0.6s ease-in-out 0.3s forwards;
  }
</style>

<?php get_footer(); ?>