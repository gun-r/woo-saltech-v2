<?php /* Template Name: Checkout */ ?>
<?php get_header(); ?>

<div class="bg-white py-16">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>
    <?php echo do_shortcode('[woocommerce_checkout]'); ?>
  </div>
</div>

<?php get_footer(); ?>