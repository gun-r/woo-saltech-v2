<?php
// index.php
get_header();
?>
<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen py-16 sm:py-24">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    <!-- Header Section -->
    <div class="text-center mb-16">
      <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900 mb-4">
        Articles, Cases & Guides
      </h1>
      <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">
        Learn how to grow your business with our expert advice
      </p>
    </div>

    <!-- Blog Grid -->
    <?php if (have_posts()): ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php while (have_posts()):
          the_post(); ?>
          <article
            class="group bg-white rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">

            <!-- Featured Image -->
            <div class="relative overflow-hidden bg-gray-100 aspect-video">
              <a href="<?php the_permalink(); ?>" class="block">
                <?php if (has_post_thumbnail()): ?>
                  <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-300']); ?>
                <?php else: ?>
                  <div class="w-full h-full flex items-center justify-center bg-gray-200">
                    <img src="/wp-content/uploads/2025/10/header-back-white.jpg" alt=""
                      class="aspect-video w-full bg-gray-100 object-cover sm:aspect-2/1 lg:aspect-3/2" />
                  </div>
                <?php endif; ?>
              </a>
            </div>

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

      <!-- Pagination -->
      <div class="mt-16">
        <nav class="flex items-center justify-center" aria-label="Pagination">
          <?php
          $pagination = paginate_links([
            'mid_size' => 2,
            'prev_text' => false,
            'next_text' => false,
            'type' => 'array',
          ]);

          if ($pagination) {
            $current_page = max(1, get_query_var('paged'));
            $total_pages = $GLOBALS['wp_query']->max_num_pages;

            echo '<div class="flex">';

            // Previous button
            if ($current_page > 1) {
              echo '<a href="' . get_pagenum_link($current_page - 1) . '" class="relative inline-flex items-center rounded-l-lg px-3 py-2 text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">';
              echo '<span class="sr-only">Previous</span>';
              echo '<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd"/></svg>';
              echo '</a>';
            }

            // Page numbers
            foreach ($pagination as $page) {
              if (strpos($page, 'current') !== false) {
                // Current page
                $number = strip_tags($page);
                echo '<span class="relative z-10 inline-flex items-center bg-gray-700 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700">' . $number . '</span>';
              } elseif (strpos($page, 'dots') !== false) {
                // Dots
                echo '<span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>';
              } else {
                // Regular page
                echo str_replace('class="', 'class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 ', $page);
              }
            }

            // Next button
            if ($current_page < $total_pages) {
              echo '<a href="' . get_pagenum_link($current_page + 1) . '" class="relative inline-flex items-center rounded-r-lg px-3 py-2 text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">';
              echo '<span class="sr-only">Next</span>';
              echo '<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"/></svg>';
              echo '</a>';
            }

            echo '</div>';
          }
          ?>
        </nav>
      </div>

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

<?php get_footer(); ?>