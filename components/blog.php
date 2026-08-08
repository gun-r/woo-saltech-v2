<div class="bg-gradient-to-b from-white to-gray-50 py-16 sm:py-24">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-12 pb-2 border-b border-[#A8CB05]">
      <div>
        <h2 class="text-3xl sm:text-4xl mb-2 tracking-tight text-[#003D82]">
          Artikler, Cases og Vejledninger
        </h2>
        <p class="text-base sm:text-lg text-gray-600">
          Lær at vokse din virksomhed med vores ekspertrådgivning
        </p>
      </div>
      <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>"
        class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-[#A8CB05]">
        Se alle blogindlæg
        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
        </svg>
      </a>
    </div>

    <!-- Blog Grid -->
    <?php
    $args = ['post_type' => 'post', 'posts_per_page' => 3];
    $query = new WP_Query($args);
    if ($query->have_posts()): ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php while ($query->have_posts()):
          $query->the_post(); ?>
          <article
            class="group bg-white rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">

            <!-- Content -->
            <div class="flex flex-col flex-1 p-6">

              <!-- Title -->
              <h3 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2 group-hover:text-red-700 transition-colors">
                <a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a>
              </h3>

              <!-- Excerpt -->
              <p class="text-sm text-gray-600 line-clamp-3 mb-4 flex-1">
                <?php echo get_the_excerpt(); ?>
              </p>

              <!-- Author Info -->
              <div class="flex items-center gap-3 pt-4 border-t border-gray-100 mt-auto">
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="flex-shrink-0">
                  <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', ['class' => 'w-10 h-10 rounded-full ring-2 ring-gray-100']); ?>
                </a>
                <div class="flex-1 min-w-0">
                  <p class="text-sm font-semibold text-gray-900 truncate">
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"
                      class="hover:text-red-700 transition-colors">
                      <?php the_author(); ?>
                    </a>
                  </p>
                  <p class="text-xs text-gray-500 truncate">
                    <?php echo get_the_author_meta('description') ?: 'Author'; ?>
                  </p>
                </div>
                <a href="<?php the_permalink(); ?>" class="text-red-700 hover:text-red-800 transition-colors">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                  </svg>
                </a>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
      </div>

      <!-- Mobile View All Link -->
      <div class="mt-8 text-center sm:hidden">
        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>"
          class="inline-flex items-center gap-2 text-sm font-semibold text-red-700 hover:text-red-800 transition-colors group">
          View All
          <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
        </a>
      </div>

      <?php wp_reset_postdata(); ?>
    <?php else: ?>
      <!-- Empty State -->
      <div class="text-center py-16">
        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No posts found</h3>
        <p class="mt-2 text-sm text-gray-500">Check back soon for new articles and guides.</p>
      </div>
    <?php endif; ?>

  </div>
</div>

<style>
  /* Line clamp utilities */
  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
</style>