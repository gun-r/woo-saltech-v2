<?php
defined( 'ABSPATH' ) || exit;
get_header('shop'); ?>

<div class="container mx-auto">
  <?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
  <div class="grid md:grid-cols-2 gap-8">
    <div>
      <h2 class="text-xl font-bold mb-4">Billing Details</h2>
      <?php do_action('woocommerce_checkout_billing'); ?>
    </div>
    <div>
      <h2 class="text-xl font-bold mb-4">Your Order</h2>
      <?php woocommerce_order_review(); ?>
    </div>
  </div>
</div>

<?php get_footer('shop'); ?>