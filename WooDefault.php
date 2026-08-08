<?php
/**
 * Template Name: Woo Default
 */

get_header(); ?>

<div class="bg-white">
  <div class="mx-auto max-w-7xl overflow-hidden sm:px-6 lg:px-8">
    <h2 class="sr-only"><?php the_title(); ?></h2>
    <div class="px-4 py-16 text-center sm:px-6 lg:px-8">
      <h1 class="text-4xl font-bold tracking-tight text-gray-900">
        <?php the_title(); ?>
      </h1>
    </div>
	<?php the_content(); ?>
  </div>
</div>

<?php get_footer(); ?>