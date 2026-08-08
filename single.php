<?php
// single.php
get_header();
?>

<?php if (have_posts()):
  while (have_posts()):
    the_post(); ?>
    <div class="bg-white py-8 sm:py-12 lg:py-16">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

          <!-- POST CONTENT -->
          <div class="lg:col-span-2 order-2 lg:order-1">
            <article class="bg-white shadow-sm">

              <!-- Article Header -->
              <header class="px-6 sm:px-8 lg:px-10 py-8 border-b">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                  <?php the_title(); ?>
                </h1>
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                  <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <?php echo get_estimated_reading_time(); ?> min read
                  </span>
                </div>
              </header>

              <!-- Featured Image -->
              <?php if (has_post_thumbnail()): ?>
                <div class="relative aspect-video sm:aspect-[21/9] overflow-hidden">
                  <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title_attribute(); ?>"
                    class="w-full h-full object-cover" />
                </div>
              <?php endif; ?>

              <!-- Article Content -->
              <div class="px-6 sm:px-8 lg:px-10 py-8 lg:py-12">
                <div
                  class="prose prose-sm sm:prose-base lg:prose-lg max-w-none prose-headings:text-gray-900 prose-headings:font-bold prose-p:text-gray-700 prose-p:leading-relaxed prose-a:text-red-800 prose-a:font-medium prose-a:no-underline hover:prose-a:underline prose-strong:text-gray-900 prose-strong:font-semibold prose-img:w-full">
                  <?php the_content(); ?>
                </div>

                <!-- Tags -->
                <?php if (has_tag()): ?>
                  <div class="mt-10 pt-6 border-t">
                    <div class="flex flex-wrap items-center gap-2">
                      <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                      </svg>
                      <span class="text-sm font-medium text-gray-600">Tags:</span>
                      <?php
                      $tags = get_the_tags();
                      if ($tags):
                        foreach ($tags as $tag): ?>
                          <a href="<?php echo get_tag_link($tag->term_id); ?>"
                            class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 transition-colors">
                            <?php echo esc_html($tag->name); ?>
                          </a>
                        <?php endforeach;
                      endif; ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>

              <!-- Author Info -->
              <footer class="px-6 sm:px-8 lg:px-10 py-6 border-t bg-gray-50">
                <div class="flex items-start gap-4">
                  <div class="flex-shrink-0">
                    <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['class' => 'w-14 h-14 sm:w-16 sm:h-16']); ?>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-xs uppercase tracking-wide text-gray-500 mb-1 font-semibold">Written by</p>
                    <p class="text-base sm:text-lg font-bold text-gray-900"><?php the_author(); ?></p>
                    <?php if (get_the_author_meta('description')): ?>
                      <p class="text-sm text-gray-600 mt-2 leading-relaxed"><?php the_author_meta('description'); ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              </footer>
            </article>

            <!-- Navigation -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
              <?php
              $prev_post = get_previous_post();
              $next_post = get_next_post();
              ?>

              <?php if ($prev_post): ?>
                <a href="<?php echo get_permalink($prev_post); ?>"
                  class="group bg-white border-l-4 border-gray-300 hover:border-red-800 shadow-sm p-5 transition-all">
                  <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-800 flex-shrink-0" fill="none"
                      stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <div class="flex-1 min-w-0">
                      <p class="text-xs uppercase tracking-wide text-gray-500 mb-1 font-semibold">Previous</p>
                      <p class="text-sm font-medium text-gray-900 line-clamp-2 group-hover:text-red-800">
                        <?php echo get_the_title($prev_post); ?>
                      </p>
                    </div>
                  </div>
                </a>
              <?php endif; ?>

              <?php if ($next_post): ?>
                <a href="<?php echo get_permalink($next_post); ?>"
                  class="group bg-white border-r-4 border-gray-300 hover:border-red-800 shadow-sm p-5 transition-all">
                  <div class="flex items-center gap-3">
                    <div class="flex-1 min-w-0 text-right">
                      <p class="text-xs uppercase tracking-wide text-gray-500 mb-1 font-semibold">Next</p>
                      <p class="text-sm font-medium text-gray-900 line-clamp-2 group-hover:text-red-800">
                        <?php echo get_the_title($next_post); ?>
                      </p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-800 flex-shrink-0" fill="none"
                      stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                  </div>
                </a>
              <?php endif; ?>
            </div>
          </div>

          <!-- SIDEBAR -->
          <aside class="lg:col-span-1 order-1 lg:order-2">
            <div class="lg:sticky lg:top-24 space-y-6">

              <!-- Mobile Categories Dropdown -->
              <div class="lg:hidden bg-white shadow-sm border-l-3 border-red-800">
                <button id="mobileCategoriesToggle"
                  class="w-full flex items-center justify-between px-5 py-4 bg-gray-900 text-white hover:bg-gray-800 transition-colors">
                  <span class="font-bold text-sm uppercase tracking-wide">Kategorier</span>
                  <svg class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>
                <div id="mobileCategoriesContent" class="hidden p-4">
                  <ul class="space-y-1">
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category):
                      $posts_in_category = get_posts([
                        'category' => $category->term_id,
                        'numberposts' => -1,
                      ]);
                      ?>
                      <li class="group">
                        <button type="button"
                          class="w-full flex justify-between items-center px-3 py-3 text-gray-700 hover:bg-gray-50 transition-all duration-200 text-sm category-toggle group-hover:text-red-800 border-l-2 border-transparent hover:border-red-800">
                          <span class="font-medium"><?php echo esc_html($category->name); ?></span>
                          <div class="flex items-center gap-2">
                            <span
                              class="text-xs font-bold text-gray-400 bg-gray-100 px-2 py-0.5"><?php echo count($posts_in_category); ?></span>
                            <svg class="w-4 h-4 transition-transform duration-200 text-gray-400" fill="none"
                              stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                          </div>
                        </button>

                        <ul class="mt-1 ml-4 space-y-1 hidden category-posts">
                          <?php foreach ($posts_in_category as $post_item): ?>
                            <li class="border-l-2 border-gray-200 hover:border-red-800 transition-colors">
                              <a href="<?php echo get_permalink($post_item->ID); ?>"
                                class="block py-2 px-3 text-xs text-gray-600 hover:text-red-800 hover:bg-gray-50 transition-colors">
                                <?php echo esc_html($post_item->post_title); ?>
                              </a>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>

              <!-- Desktop Categories -->
              <div class="hidden lg:block bg-white shadow-sm">
                <div class="bg-gray-900 px-6 py-4">
                  <h3 class="text-sm font-bold text-white uppercase tracking-wide flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                      <path
                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                    </svg>
                    Kategorier
                  </h3>
                </div>

                <div class="p-4 max-h-[calc(100vh-250px)] overflow-y-auto">
                  <ul class="space-y-1">
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category):
                      $posts_in_category = get_posts([
                        'category' => $category->term_id,
                        'numberposts' => -1,
                      ]);
                      ?>
                      <li class="group">
                        <button type="button"
                          class="w-full flex justify-between items-center px-3 py-3 text-gray-700 hover:bg-gray-50 transition-all duration-200 font-medium text-sm category-toggle group-hover:text-red-800 border-l-2 border-transparent hover:border-red-800">
                          <span><?php echo esc_html($category->name); ?></span>
                          <div class="flex items-center gap-2">
                            <span
                              class="text-xs font-bold text-gray-400 bg-gray-100 px-2 py-1"><?php echo count($posts_in_category); ?></span>
                            <svg class="w-4 h-4 transition-transform duration-200 text-gray-400" fill="none"
                              stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                          </div>
                        </button>

                        <ul class="mt-1 ml-4 hidden category-posts">
                          <?php foreach ($posts_in_category as $post_item): ?>
                            <li class="border-l-2 border-gray-200 hover:border-red-800 transition-colors">
                              <a href="<?php echo get_permalink($post_item->ID); ?>"
                                class="block py-2 px-3 text-sm text-gray-600 hover:text-red-800 hover:bg-gray-50 transition-colors">
                                <?php echo esc_html($post_item->post_title); ?>
                              </a>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>

              <!-- Follow Us -->
              <div class="bg-blue-800 shadow-lg">
                <div class="p-6 text-white">
                  <div class="flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                      <path
                        d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                    </svg>
                    <h3 class="text-sm font-bold uppercase tracking-wide">Follow Us</h3>
                  </div>

                  <p class="text-blue-100 text-sm mb-4 leading-relaxed">
                    Stay connected for updates and news
                  </p>

                  <a href="https://web.facebook.com/SalTechEasyPackaging?_rdc=1&_rdr#" target="_blank"
                    class="inline-flex items-center justify-center gap-3 bg-white text-blue-800 px-4 py-3 hover:bg-gray-100 transition-all duration-200 font-bold shadow-md hover:shadow-lg w-full text-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                      <path
                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 5.006 3.657 9.128 8.438 9.878v-6.988h-2.54v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.462h-1.26c-1.243 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33V21.878C18.343 21.128 22 17.006 22 12z" />
                    </svg>
                    <span>Sal-Tech Easy Packaging</span>
                  </a>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  <?php endwhile;
endif; ?>

<style>
  .line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Custom scrollbar */
  .overflow-y-auto::-webkit-scrollbar {
    width: 4px;
  }

  .overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  .overflow-y-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
  }

  .overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Category toggle functionality
    const toggles = document.querySelectorAll('.category-toggle');
    toggles.forEach(btn => {
      btn.addEventListener('click', () => {
        const postsList = btn.nextElementSibling;
        postsList.classList.toggle('hidden');
        const arrow = btn.querySelector('svg:last-child');
        arrow.classList.toggle('rotate-180');
      });
    });

    // Mobile categories toggle
    const mobileCategoriesToggle = document.getElementById('mobileCategoriesToggle');
    const mobileCategoriesContent = document.getElementById('mobileCategoriesContent');

    if (mobileCategoriesToggle && mobileCategoriesContent) {
      mobileCategoriesToggle.addEventListener('click', () => {
        mobileCategoriesContent.classList.toggle('hidden');
        const arrow = mobileCategoriesToggle.querySelector('svg');
        arrow.classList.toggle('rotate-180');
      });
    }
  });
</script>

<?php
// Helper function for reading time
function get_estimated_reading_time()
{
  $post = get_post();
  $words = str_word_count(strip_tags($post->post_content));
  $minutes = ceil($words / 200);
  return $minutes;
}
?>

<?php get_footer(); ?>