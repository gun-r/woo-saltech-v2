<?php
defined( 'ABSPATH' ) || exit;
global $product;
?>
<ul>
<li <?php wc_product_class('p-4 border rounded-lg bg-white shadow hover:shadow-lg transition', $product); ?>>
  <a href="<?php the_permalink(); ?>" class="block">
    <?php woocommerce_show_product_loop_sale_flash(); ?>
    <?php woocommerce_template_loop_product_thumbnail(); ?>
    <h2 class="mt-3 text-lg font-semibold text-brand"><?php the_title(); ?></h2>
    <?php woocommerce_template_loop_price(); ?>
  </a>
  <?php woocommerce_template_loop_add_to_cart(); ?>
</li>
</ul>