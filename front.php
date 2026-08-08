<?php
/**
 * Template Name: Homepage
 */

get_header(); ?>

<section>
  <?php get_template_part('components/slider'); ?>
  <?php get_template_part('components/products'); ?>
  <?php get_template_part('components/partners'); ?>
  <?php get_template_part('components/about'); ?>
  <?php //get_template_part('components/suppliers'); ?>
  <?php get_template_part('components/blog'); ?>
</section>

<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<?php get_footer(); ?>