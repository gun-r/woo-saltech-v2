<?php
/* Default Template for Shop */
defined('ABSPATH') || exit;
get_header('shop');

// Get current page
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Get category filter
$selected_category = isset($_GET['product_cat']) ? sanitize_text_field($_GET['product_cat']) : '';

// Get search term
$search_term = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

// Build query args
$args = [
  'post_type' => 'product',
  'posts_per_page' => 16,
  'post_status' => 'publish',
  'paged' => $paged,
];

// Add category filter
if ($selected_category) {
  $args['tax_query'] = [
    [
      'taxonomy' => 'product_cat',
      'field' => 'slug',
      'terms' => $selected_category,
    ]
  ];
}

// Add search filter (ONLY show matching products)
if (!empty($search_term)) {
  $search_product_ids = get_search_filtered_product_ids($search_term);

  if (!empty($search_product_ids)) {
    // Only include matching products
    $args['post__in'] = $search_product_ids;

    // Add custom ordering by relevance
    $args['orderby'] = 'post__in';
  } else {
    // No matches found - show nothing
    $args['post__in'] = array(0);
  }
}

$loop = new WP_Query($args);

// Function to get shop page URL
function get_shop_page_url()
{
  $shop_page_id = wc_get_page_id('shop');
  return get_permalink($shop_page_id);
}

// Function to get category filter URL (without paged parameter)
function get_category_url($category_slug)
{
  $shop_url = get_shop_page_url();
  return add_query_arg('product_cat', $category_slug, $shop_url);
}

// Build breadcrumb array (with search support)
function build_product_breadcrumb($selected_category_slug = '', $search_term = '')
{
  $breadcrumbs = array();

  // Always add home
  $breadcrumbs[] = array(
    'url' => home_url('/'),
    'title' => 'Home',
    'is_home' => true
  );

  // Add shop
  $shop_page_id = wc_get_page_id('shop');
  $breadcrumbs[] = array(
    'url' => get_permalink($shop_page_id),
    'title' => 'Shop',
    'is_current' => empty($selected_category_slug) && empty($search_term)
  );

  // If search is active
  if (!empty($search_term)) {
    $breadcrumbs[] = array(
      'url' => '#',
      'title' => 'Search: "' . esc_html($search_term) . '"',
      'is_current' => true
    );
    return $breadcrumbs;
  }

  // If category is selected
  if (!empty($selected_category_slug)) {
    $current_category = get_term_by('slug', $selected_category_slug, 'product_cat');

    if ($current_category && !is_wp_error($current_category)) {
      $hierarchy = array();
      $term = $current_category;

      while ($term && $term->parent != 0) {
        array_unshift($hierarchy, $term);
        $term = get_term($term->parent, 'product_cat');
      }

      if ($term && $term->term_id != $current_category->term_id) {
        array_unshift($hierarchy, $term);
      }

      if (empty($hierarchy) || end($hierarchy)->term_id != $current_category->term_id) {
        $hierarchy[] = $current_category;
      }

      $hierarchy = array_slice($hierarchy, -4);

      foreach ($hierarchy as $index => $cat) {
        $is_last = ($index === count($hierarchy) - 1);
        $breadcrumbs[] = array(
          'url' => get_category_url($cat->slug),
          'title' => $cat->name,
          'is_current' => $is_last
        );
      }
    }
  }

  return $breadcrumbs;
}

$breadcrumbs = build_product_breadcrumb($selected_category, $search_term);
?>

<div class="bg-white">
  <div class="mx-auto container overflow-hidden sm:px-6 lg:px-8">
    <!-- Hero Header -->
    <div class="py-10 sm:py-15 lg:py-15">
      <div class="text-center">
        <?php if (!empty($search_term)): ?>
          <!-- Search Results Header (NEW) -->
          <h1 class="text-3xl sm:text-4xl lg:text-4xl font-bold tracking-tight text-gray-900">
            Search results for: "<?php echo esc_html($search_term); ?>""
          </h1>
        <?php elseif ($selected_category):
          $current_cat = get_term_by('slug', $selected_category, 'product_cat');
          if ($current_cat):
            ?>
            <!-- Category Selected Header -->
            <h1 class="text-3xl sm:text-4xl lg:text-4xl tracking-tight text-[#003D82] mb-2">
              <?php echo esc_html($current_cat->name); ?>
            </h1>
            <?php
          endif;
        else:
          ?>
          <!-- Default Shop Header -->
          <h1 class="text-3xl sm:text-4xl lg:text-4xl font-bold tracking-tight text-gray-900 mb-4">
            <?php woocommerce_page_title(); ?>
          </h1>
        <?php endif; ?>
      </div>
    </div>

    <!-- Search Results Banner -->
    <?php if (!empty($search_term)): ?>
      <div class="px-4 sm:px-6 lg:px-8">
        <?php display_search_results_header($search_term, $loop->found_posts); ?>
      </div>
    <?php endif; ?>

    <div class="mb-8 px-4 sm:px-6 lg:px-8">
      <!-- Breadcrumbs Bar -->
      <section aria-labelledby="filter-heading" class="mb-8">
        <h2 id="filter-heading" class="sr-only">Filters</h2>
        <div
          class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4 py-4 border-t border-b border-[#A8CB05] bg-white">

          <!-- Breadcrumbs -->
          <nav aria-label="Breadcrumb" class="order-1">
            <ol class="flex items-center flex-wrap gap-2 text-sm">
              <?php foreach ($breadcrumbs as $index => $crumb): ?>
                <li class="flex items-center gap-2">
                  <?php if ($index > 0): ?>
                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                  <?php endif; ?>

                  <?php if (!empty($crumb['is_current'])): ?>
                    <span class="font-semibold text-[#003D82]" aria-current="page">
                      <?php echo esc_html($crumb['title']); ?>
                    </span>
                  <?php else: ?>
                    <a href="<?php echo esc_url($crumb['url']); ?>"
                      class="inline-flex items-center gap-1 text-gray-600 hover:text-red-800 transition-colors">
                      <?php if (!empty($crumb['is_home'])): ?>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                      <?php endif; ?>
                      <?php echo esc_html($crumb['title']); ?>
                    </a>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ol>
          </nav>

          <!-- Result Count -->
          <div class="woocommerce-result-count text-sm text-gray-600 order-2" style="margin:0 !important;">
            <?php
            $total = $loop->found_posts;
            $per_page = $args['posts_per_page'];
            $from = (($paged - 1) * $per_page) + 1;
            $to = min($paged * $per_page, $total);

            if ($total > 0) {
              printf(
                esc_html(_n('Showing %1$s–%2$s of %3$s result', 'Showing %1$s–%2$s of %3$s results', $total, 'woocommerce')),
                '<strong>' . number_format_i18n($from) . '</strong>',
                '<strong>' . number_format_i18n($to) . '</strong>',
                '<strong>' . number_format_i18n($total) . '</strong>'
              );
            } else {
              esc_html_e('No products found', 'woocommerce');
            }
            ?>
          </div>
        </div>
      </section>

      <div class="lg:hidden mb-6">
        <!-- Mobile Navigation Tabs -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-1 flex gap-1">
          <button data-tab="products"
            class="mobile-tab flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-md text-sm font-medium transition-colors bg-gray-700 text-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            Products
          </button>
          <button data-tab="categories"
            class="mobile-tab flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-md text-sm font-medium transition-colors text-gray-700 hover:bg-gray-50">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path
                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
            </svg>
            Categories
          </button>
        </div>

        <!-- Categories View (Mobile) -->
        <div id="mobile-categories"
          class="hidden mt-4 bg-white rounded-lg shadow-lg border border-gray-100 overflow-hidden">
          <?php if ($selected_category):
            $cat = get_term_by('slug', $selected_category, 'product_cat');
            ?>
            <!-- Back Button when category is selected -->
            <div class="p-4 border-b border-gray-200 bg-gray-50">
              <a href="<?php echo esc_url(get_shop_page_url()); ?>"
                class="inline-flex items-center gap-2 text-sm font-semibold text-red-700 hover:text-red-800 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Categories
              </a>
              <p class="mt-2 text-xs text-gray-600 flex items-center gap-1">
                <span class="font-normal">Filtering by:</span>
                <strong class="text-red-700"><?php echo esc_html($cat->name); ?></strong>
              </p>
            </div>
          <?php else: ?>
            <!-- Categories List -->
            <div class="p-4">
              <h3 class="text-sm font-semibold text-gray-900 mb-4 flex items-center gap-2 pb-3 border-b border-gray-200">
                <svg class="w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                </svg>
                Browse Categories
              </h3>
              <div class="max-h-96 overflow-y-auto category-sidebar-scroll space-y-1">
                <?php
                $categories = get_terms([
                  'taxonomy' => 'product_cat',
                  'hide_empty' => true,
                  'parent' => 0,
                ]);

                function display_mobile_category($category, $level = 0)
                {
                  if ($level > 3)
                    return;

                  $indent = $level * 0.75;
                  $has_children = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'parent' => $category->term_id,
                  ]);

                  $cat_id = 'mobile-cat-' . $category->term_id;

                  echo '<div class="mb-1" style="padding-left: ' . $indent . 'rem;">';

                  if (!empty($has_children)) {
                    echo '<div class="flex items-center justify-between group rounded-lg hover:bg-gray-50 transition-all duration-200">';
                    echo '<a href="' . esc_url(get_category_url($category->slug)) . '" 
                       class="flex items-center gap-2 text-sm flex-1 py-3 px-3 transition-colors font-medium text-gray-900 hover:text-red-700">';
                    echo '<span class="flex-1">' . esc_html($category->name) . '</span>';
                    echo '<span class="text-xs bg-gray-100 group-hover:bg-gray-200 px-2 py-1 rounded-full font-semibold text-gray-600 transition-colors">' . $category->count . '</span>';
                    echo '</a>';
                    echo '<button class="mobile-category-toggle p-2 mr-1 hover:bg-gray-100 rounded-md transition-all duration-200" data-target="' . $cat_id . '" aria-expanded="false">';
                    echo '<svg class="w-4 h-4 text-gray-400 mobile-toggle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>';
                    echo '</button>';
                    echo '</div>';

                    // Children container
                    echo '<div id="' . $cat_id . '" class="mobile-category-children mt-1">';
                    foreach ($has_children as $child) {
                      display_mobile_category($child, $level + 1);
                    }
                    echo '</div>';
                  } else {
                    echo '<a href="' . esc_url(get_category_url($category->slug)) . '" 
                       class="flex items-center justify-between py-3 px-3 text-sm hover:bg-gray-50 rounded-lg transition-all duration-200 border border-transparent hover:border-gray-200 group">';
                    echo '<span class="flex items-center gap-2 font-medium text-gray-900 group-hover:text-red-700">';
                    echo esc_html($category->name);
                    echo '</span>';
                    echo '<span class="text-xs bg-gray-100 group-hover:bg-gray-200 px-2 py-1 rounded-full font-semibold text-gray-600 transition-colors">' . $category->count . '</span>';
                    echo '</a>';
                  }

                  echo '</div>';
                }

                if (!empty($categories)) {
                  foreach ($categories as $category) {
                    if ($category->slug === 'uncategorized')
                      continue;
                    display_mobile_category($category, 0);
                  }
                }
                ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const tabs = document.querySelectorAll('.mobile-tab');
          const categoriesView = document.getElementById('mobile-categories');
          const suppliersView = document.getElementById('mobile-suppliers');

          // Check if a category is selected
          const hasSelectedCategory = <?php echo $selected_category ? 'true' : 'false'; ?>;

          // Set initial state based on URL
          if (hasSelectedCategory && window.innerWidth < 1024) {
            // If category is selected, show products view
            setActiveTab('products');
          }

          tabs.forEach(tab => {
            tab.addEventListener('click', function () {
              const tabName = this.getAttribute('data-tab');
              setActiveTab(tabName);
            });
          });

          function setActiveTab(tabName) {
            // Update tab styles
            tabs.forEach(t => {
              if (t.getAttribute('data-tab') === tabName) {
                t.classList.add('bg-gray-700', 'text-white');
                t.classList.remove('text-gray-700', 'hover:bg-gray-50');
              } else {
                t.classList.remove('bg-gray-700', 'text-white');
                t.classList.add('text-gray-700', 'hover:bg-gray-50');
              }
            });

            // Show/hide views
            if (tabName === 'products') {
              categoriesView.classList.add('hidden');
              suppliersView.classList.add('hidden');
              window.scrollTo({ top: 0, behavior: 'smooth' });
            } else if (tabName === 'categories') {
              categoriesView.classList.remove('hidden');
              suppliersView.classList.add('hidden');
            } else if (tabName === 'suppliers') {
              categoriesView.classList.add('hidden');
              suppliersView.classList.remove('hidden');
            }
          }
        });
      </script>

      <style>
        /* Mobile tab active state */
        .mobile-tab {
          position: relative;
        }

        .mobile-tab.active {
          background-color: #B91C1C;
          color: white;
        }

        /* Smooth scrolling */
        html {
          scroll-behavior: smooth;
        }

        /* Custom scrollbar for mobile views */
        #mobile-categories .overflow-y-auto::-webkit-scrollbar,
        #mobile-suppliers .overflow-y-auto::-webkit-scrollbar {
          width: 4px;
        }

        #mobile-categories .overflow-y-auto::-webkit-scrollbar-track,
        #mobile-suppliers .overflow-y-auto::-webkit-scrollbar-track {
          background: #f1f1f1;
          border-radius: 10px;
        }

        #mobile-categories .overflow-y-auto::-webkit-scrollbar-thumb,
        #mobile-suppliers .overflow-y-auto::-webkit-scrollbar-thumb {
          background: #cbd5e1;
          border-radius: 10px;
        }

        #mobile-categories .overflow-y-auto::-webkit-scrollbar-thumb:hover,
        #mobile-suppliers .overflow-y-auto::-webkit-scrollbar-thumb:hover {
          background: #94a3b8;
        }

        /* Category dropdown styles */
        .category-children {
          display: none;
          overflow: hidden;
          transition: all 0.3s ease;
        }

        .category-children.expanded {
          display: block;
          animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
          from {
            opacity: 0;
            transform: translateY(-10px);
          }

          to {
            opacity: 1;
            transform: translateY(0);
          }
        }

        .category-toggle {
          cursor: pointer;
          user-select: none;
          transition: all 0.2s ease;
        }

        .category-toggle:hover {
          background-color: #f3f4f6;
        }

        .category-toggle .toggle-icon {
          transition: transform 0.3s ease, color 0.2s ease;
        }

        .category-toggle.expanded .toggle-icon {
          transform: rotate(90deg);
          color: #B91C1C;
        }

        .category-toggle:hover .toggle-icon {
          color: #B91C1C;
        }

        /* Mobile category dropdown styles */
        .mobile-category-children {
          display: none;
          overflow: hidden;
          transition: all 0.3s ease;
        }

        .mobile-category-children.expanded {
          display: block;
          animation: slideDown 0.3s ease-out;
        }

        .mobile-category-toggle {
          cursor: pointer;
          user-select: none;
          transition: all 0.2s ease;
        }

        .mobile-category-toggle:hover {
          background-color: #f3f4f6;
        }

        .mobile-category-toggle .mobile-toggle-icon {
          transition: transform 0.3s ease, color 0.2s ease;
        }

        .mobile-category-toggle.expanded .mobile-toggle-icon {
          transform: rotate(90deg);
          color: #B91C1C;
        }

        .mobile-category-toggle:hover .mobile-toggle-icon {
          color: #B91C1C;
        }
      </style>

      <div class="flex gap-8">

        <!-- FILTER SIDEBAR -->
        <aside class="hidden lg:block w-64 flex-shrink-0">
          <div class="sticky top-24 space-y-6">

            <!-- Categories Filter -->
            <div class="bg-white overflow-hidden border-t-2 border-gray-100">
              <div class="bg-gray-200 px-5 py-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wide flex items-center gap-2">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                  </svg>
                  Categories
                </h3>
              </div>

              <div class="py-2 overflow-y-auto category-sidebar-scroll">
                <?php
                // Get all product categories
                $categories = get_terms([
                  'taxonomy' => 'product_cat',
                  'hide_empty' => true,
                  'parent' => 0,
                ]);

                function category_tree_contains_selected($category, $selected_cat)
                {
                  $children = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'parent' => $category->term_id,
                  ]);

                  foreach ($children as $child) {
                    if ($selected_cat === $child->slug) {
                      return true;
                    }
                    if (category_tree_contains_selected($child, $selected_cat)) {
                      return true;
                    }
                  }

                  return false;
                }

                function display_category_tree($category, $selected_cat, $level = 0)
                {
                  if ($level > 3) {
                    return; // Limit to 4 levels (0-3)
                  }

                  $indent = $level * 0.75;
                  $is_selected = ($selected_cat === $category->slug);
                  $has_selected_descendant = category_tree_contains_selected($category, $selected_cat);
                  $has_children = get_terms([
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'parent' => $category->term_id,
                  ]);

                  $cat_id = 'cat-' . $category->term_id;
                  $active_classes = $is_selected ? 'bg-red-600 text-white shadow-sm' : ($has_selected_descendant ? 'bg-red-50 text-red-800 font-semibold' : 'text-slate-900 hover:bg-gray-50 hover:text-red-700');

                  echo '<div class="category-item border-b border-gray-200" style="padding-left: ' . esc_attr($indent) . 'rem;">';

                  if (!empty($has_children)) {
                    echo '<div class="flex items-center justify-between group transition-all duration-200 ' . ($is_selected ? 'bg-red-600 text-white' : 'hover:bg-gray-50') . '">';
                    echo '<a href="' . esc_url(get_category_url($category->slug)) . '" class="flex items-center gap-2 text-sm flex-1 py-2.5 px-1 transition-colors ' . ($is_selected ? 'text-white font-semibold' : 'text-slate-900 hover:text-slate-700') . '">';
                    echo '<span class="flex-1">' . esc_html($category->name) . '</span>';
                    echo '</a>';
                    echo '<button class="category-toggle p-2 mr-1 hover:bg-gray-100 rounded-md transition-all duration-200" data-target="' . esc_attr($cat_id) . '" aria-expanded="false">';
                    echo '<svg class="w-4 h-4 text-gray-400 toggle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>';
                    echo '</button>';
                    echo '</div>';

                    echo '<div id="' . esc_attr($cat_id) . '" class="category-children' . ($has_selected_descendant ? ' expanded' : '') . ' mt-1">';
                    foreach ($has_children as $child) {
                      display_category_tree($child, $selected_cat, $level + 1);
                    }
                    echo '</div>';
                  } else {
                    echo '<a href="' . esc_url(get_category_url($category->slug)) . '" class="flex items-center justify-between py-2.5 px-1 text-sm rounded-lg transition-all duration-200 ' . $active_classes . '">';
                    echo '<span class="flex items-center gap-2">';
                    if ($is_selected) {
                      echo '<span class="inline-flex h-2.5 w-2.5 rounded-full bg-white"></span>';
                    }
                    echo esc_html($category->name);
                    echo '</span>';
                    echo '</a>';
                  }

                  echo '</div>';
                }

                if (!empty($categories)) {
                  foreach ($categories as $category) {
                    if ($category->slug === 'uncategorized')
                      continue;
                    display_category_tree($category, 0, $selected_category);
                  }
                }
                ?>
              </div>

              <?php if ($selected_category): ?>
                <div class="p-4 border-t bg-gray-50">
                  <a href="<?php echo esc_url(get_shop_page_url()); ?>"
                    class="inline-flex items-center gap-2 text-sm text-red-700 hover:text-red-800 font-semibold transition-colors group">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Clear Filter
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </aside>

        <!-- PRODUCTS GRID -->
        <div class="flex-1 min-w-0">
          <?php if ($loop->have_posts()): ?>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
              <?php while ($loop->have_posts()):
                $loop->the_post();
                global $product; ?>
                <div
                  class="relative bg-white border border-gray-200 hover:border-gray-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">

                  <!-- Product Image -->
                  <a href="<?php the_permalink(); ?>" class="block relative overflow-hidden bg-gray-100 aspect-square">
                    <?php
                    if (has_post_thumbnail()) {
                      echo get_the_post_thumbnail($product->get_id(), 'woocommerce_thumbnail', [
                        'class' => 'w-full h-full object-cover'
                      ]);
                    } else {
                      echo '<div class="w-full h-full flex items-center justify-center bg-gray-200">';
                      echo '<svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                      echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>';
                      echo '</div>';
                    }
                    ?>

                    <!-- Sale Badge -->
                    <?php if ($product->is_on_sale()): ?>
                      <span
                        class="absolute top-2 right-2 px-2 py-1 bg-red-700 text-white text-xs font-bold rounded-md shadow-md">
                        SALE
                      </span>
                    <?php endif; ?>

                    <!-- Stock Badge -->
                    <?php if (!$product->is_in_stock()): ?>
                      <span
                        class="absolute top-2 left-2 px-2 py-1 bg-gray-900 text-white text-xs font-bold rounded-md shadow-md">
                        OUT OF STOCK
                      </span>
                    <?php endif; ?>
                  </a>

                  <!-- Product Info -->
                  <div class="p-3 sm:p-4 flex flex-col flex-grow">
                    <!-- Product Title -->
                    <h3 class="text-sm font-medium text-gray-900 mb-2 line-clamp-2 min-h-[40px]">
                      <a href="<?php the_permalink(); ?>" class="hover:text-red-600 transition-colors">
                        <?php the_title(); ?>
                      </a>
                    </h3>

                    <!-- Rating -->
                    <?php if (wc_review_ratings_enabled() && $product->get_rating_count()): ?>
                      <div class="flex items-center mb-2">
                        <div class="flex items-center text-yellow-400">
                          <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                        </div>
                        <span class="ml-1 text-xs text-gray-500">(<?php echo $product->get_rating_count(); ?>)</span>
                      </div>
                    <?php endif; ?>

                    <!-- Price -->
                    <?php
                    $product_price = $product->get_price();
                    $is_zero_price = empty($product_price) || floatval($product_price) == 0;
                    ?>

                    <?php if (!$is_zero_price): ?>
                      <div class="mb-3 text-base sm:text-md font-bold text-[#003D82]">
                        <?php echo $product->get_price_html(); ?>
                      </div>
                    <?php endif; ?>

                    <!-- Add to Cart Button -->
                    <div class="mt-auto pt-2">
                      <?php
                      $product_price = $product->get_price();

                      // Check if price is 0 or empty
                      if (empty($product_price) || $product_price == 0):
                        ?>
                        <!-- Request Price Button -->
                        <a href="mailto:support@sal-tech.com?subject=Price Request for <?php echo urlencode(get_the_title()); ?>&body=I would like to request pricing information for: <?php echo urlencode(get_the_title()); ?> (Product ID: <?php echo $product->get_id(); ?>)"
                          class="request-btn gap-2">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                          </svg>
                          Request Price
                        </a>
                      <?php else: ?>
                        <!-- Regular Add to Cart -->
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>

            <style>
              /* Rating stars */
              .star-rating {
                display: inline-flex;
              }

              .star-rating span {
                color: #FCD34D;
              }

              /* Line clamp for product titles */
              .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
              }

              /* Price styling */
              .price {
                color: inherit;
              }

              .price del {
                opacity: 0.5;
                font-size: 0.875em;
              }

              .price ins {
                text-decoration: none;
                color: #B91C1C;
              }

              /* Add to cart button base styles */
              a.request-btn,
              a.button.add_to_cart_button,
              a.button.product_type_simple,
              a.button.product_type_variable,
              a.button.product_type_grouped,
              a.button.product_type_external {
                width: 100% !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                padding: 0.5rem 0.75rem !important;
                font-size: 0.875rem !important;
                font-weight: 500 !important;
                border-radius: 0.375rem !important;
                transition: all 0.2s !important;
                border: none !important;
                cursor: pointer !important;
                background-color: #4CAF50 !important;
                color: white !important;
                text-decoration: none !important;
              }

              a.request-btn:hover,
              a.button.add_to_cart_button:hover,
              a.button.product_type_simple:hover,
              a.button.product_type_variable:hover,
              a.button.product_type_grouped:hover,
              a.button.product_type_external:hover {
                background-color: #409142 !important;
                color: white !important;
              }

              /* Add to cart button icons */
              a.add_to_cart_button:before,
              a.product_type_simple:before,
              a.product_type_variable:before {
                content: '';
                display: inline-block;
                width: 16px;
                height: 16px;
                margin-right: 6px;
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
              }

              a.add_to_cart_button:before,
              a.product_type_simple:before {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'/%3E%3C/svg%3E");
              }

              a.product_type_variable:before {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 12a3 3 0 11-6 0 3 3 0 016 0z'/%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'/%3E%3C/svg%3E");
              }

              /* Out of stock button */
              a.button.add_to_cart_button[disabled],
              a.button.add_to_cart_button.disabled,
              a.button.out-of-stock {
                background-color: #D1D5DB !important;
                color: #6B7280 !important;
                cursor: not-allowed !important;
                opacity: 0.6 !important;
                pointer-events: none !important;
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

              /* Enhanced scrollbar for category sidebar */
              .category-sidebar-scroll::-webkit-scrollbar {
                width: 6px;
              }

              .category-sidebar-scroll::-webkit-scrollbar-track {
                background: #f9fafb;
                border-radius: 10px;
              }

              .category-sidebar-scroll::-webkit-scrollbar-thumb {
                background: linear-gradient(to bottom, #9ca3af, #6b7280);
                border-radius: 10px;
                border: 1px solid #e5e7eb;
              }

              .category-sidebar-scroll::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(to bottom, #6b7280, #4b5563);
              }
            </style>

            <!-- Pagination -->
            <?php if ($loop->max_num_pages > 1): ?>
              <div class="mt-10 flex justify-center">
                <nav class="isolate inline-flex -space-x-px rounded-lg shadow-sm" aria-label="Pagination">
                  <?php
                  $add_args = [];
                  if ($selected_category)
                    $add_args['product_cat'] = $selected_category;
                  if ($search_term)
                    $add_args['s'] = $search_term;

                  // Get pagination array
                  $pagination = paginate_links([
                    'total' => $loop->max_num_pages,
                    'current' => $paged,
                    'prev_text' => false,
                    'next_text' => false,
                    'type' => 'array',
                    'mid_size' => 2,
                    'add_args' => $add_args,
                  ]);
                  if ($pagination) {
                    // Previous button
                    if ($paged > 1) {
                      echo '<a href="' . get_pagenum_link($paged - 1) . ($selected_category ? '&product_cat=' . $selected_category : '') . '" class="relative inline-flex items-center rounded-l-lg px-3 py-2 text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">';
                      echo '<span class="sr-only">Previous</span>';
                      echo '<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd"/></svg>';
                      echo '</a>';
                    }

                    // Page numbers
                    foreach ($pagination as $page) {
                      if (strpos($page, 'current') !== false) {
                        // Current page
                        $number = strip_tags($page);
                        echo '<span aria-current="page" class="relative z-10 inline-flex items-center bg-gray-700 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700">' . $number . '</span>';
                      } elseif (strpos($page, 'dots') !== false) {
                        // Dots
                        echo '<span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>';
                      } else {
                        // Regular page
                        echo str_replace('class="', 'class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 ', $page);
                      }
                    }

                    // Next button
                    if ($paged < $loop->max_num_pages) {
                      echo '<a href="' . get_pagenum_link($paged + 1) . ($selected_category ? '&product_cat=' . $selected_category : '') . '" class="relative inline-flex items-center rounded-r-lg px-3 py-2 text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">';
                      echo '<span class="sr-only">Next</span>';
                      echo '<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd"/></svg>';
                      echo '</a>';
                    }
                  }
                  ?>
                </nav>
              </div>
            <?php endif; ?>

          <?php else: ?>
            <div class="text-center py-16">
              <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
              </svg>
              <h3 class="mt-4 text-lg font-medium text-gray-900"><?php esc_html_e('No products found', 'woocommerce'); ?>
              </h3>
              <p class="mt-2 text-sm text-gray-500">
                <?php esc_html_e('Try adjusting your filters or check back later.', 'woocommerce'); ?>
              </p>
              <?php if ($selected_category): ?>
                <a href="<?php echo esc_url(get_shop_page_url()); ?>"
                  class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-red-800 text-white font-semibold hover:bg-red-900">
                  Clear Filters
                </a>
              <?php endif; ?>
            </div>
          <?php endif;

          wp_reset_postdata();
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Desktop category dropdown toggle functionality
    const categoryToggles = document.querySelectorAll('.category-toggle');

    categoryToggles.forEach(toggle => {
      toggle.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const targetId = this.getAttribute('data-target');
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          // Toggle expanded class
          targetElement.classList.toggle('expanded');
          this.classList.toggle('expanded');

          // Update aria-expanded
          const isExpanded = targetElement.classList.contains('expanded');
          this.setAttribute('aria-expanded', isExpanded);
        }
      });
    });

    // Mobile category dropdown toggle functionality
    const mobileToggles = document.querySelectorAll('.mobile-category-toggle');

    mobileToggles.forEach(toggle => {
      toggle.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const targetId = this.getAttribute('data-target');
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          // Toggle expanded class
          targetElement.classList.toggle('expanded');
          this.classList.toggle('expanded');

          // Update aria-expanded
          const isExpanded = targetElement.classList.contains('expanded');
          this.setAttribute('aria-expanded', isExpanded);
        }
      });
    });
  });
</script>

<?php get_footer(); ?>