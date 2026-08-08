<?php
/**
 * Template Name: Sitemap
 */

get_header();
?>

<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen py-8 sm:py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-2">
                <?php esc_html_e('Sitemap', 'woocommerce'); ?>
            </h1>
            <p class="text-sm sm:text-base text-gray-600">
                <?php esc_html_e('Find all pages, products, and categories on our website', 'woocommerce'); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left & Center Columns -->
            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Main Pages Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                        <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <h2 class="text-xl font-semibold text-gray-900">
                            <?php esc_html_e('Main Pages', 'woocommerce'); ?>
                        </h2>
                    </div>
                    <ul class="space-y-3 max-h-96 overflow-y-auto">
                        <?php
                        $main_pages = get_pages(array(
                            'parent' => 0,
                            'sort_column' => 'menu_order',
                            'post_status' => 'publish'
                        ));

                        foreach ($main_pages as $page): ?>
                            <li>
                                <a href="<?php echo get_permalink($page->ID); ?>"
                                    class="text-gray-700 hover:text-red-700 transition-colors flex items-center gap-2 group">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-red-700" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    <?php echo esc_html($page->post_title); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Recent Products Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                        <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <h2 class="text-xl font-semibold text-gray-900">
                            <?php esc_html_e('Recent Products', 'woocommerce'); ?>
                        </h2>
                    </div>
                    <ul class="space-y-3 max-h-96 overflow-y-auto">
                        <?php
                        $recent_products = wc_get_products(array(
                            'limit' => 15,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'status' => 'publish'
                        ));

                        foreach ($recent_products as $product): ?>
                            <li>
                                <a href="<?php echo get_permalink($product->get_id()); ?>"
                                    class="text-gray-700 hover:text-red-700 transition-colors flex items-center gap-2 group">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-red-700" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    <span class="line-clamp-1"><?php echo esc_html($product->get_name()); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Blog Posts Section -->
                <?php
                $blog_posts = get_posts(array(
                    'post_type' => 'post',
                    'posts_per_page' => 15,
                    'post_status' => 'publish'
                ));

                if (!empty($blog_posts)): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                            <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            <h2 class="text-xl font-semibold text-gray-900">
                                <?php esc_html_e('Blog Posts', 'woocommerce'); ?>
                            </h2>
                        </div>
                        <ul class="space-y-3 max-h-96 overflow-y-auto">
                            <?php foreach ($blog_posts as $post): ?>
                                <li>
                                    <a href="<?php echo get_permalink($post->ID); ?>"
                                        class="text-gray-700 hover:text-red-700 transition-colors flex items-center gap-2 group">
                                        <svg class="w-4 h-4 text-gray-400 group-hover:text-red-700" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                        <?php echo esc_html($post->post_title); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Important Links Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                        <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        <h2 class="text-xl font-semibold text-gray-900">
                            <?php esc_html_e('Important Links', 'woocommerce'); ?>
                        </h2>
                    </div>
                    <ul class="space-y-3 max-h-96 overflow-y-auto">
                        <li>
                            <a href="<?php echo wc_get_page_permalink('shop'); ?>"
                                class="text-gray-700 hover:text-red-700 transition-colors flex items-center gap-2 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-red-700" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <?php esc_html_e('Shop', 'woocommerce'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo wc_get_page_permalink('cart'); ?>"
                                class="text-gray-700 hover:text-red-700 transition-colors flex items-center gap-2 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-red-700" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <?php esc_html_e('Cart', 'woocommerce'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo wc_get_page_permalink('myaccount'); ?>"
                                class="text-gray-700 hover:text-red-700 transition-colors flex items-center gap-2 group">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-red-700" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <?php esc_html_e('My Account', 'woocommerce'); ?>
                            </a>
                        </li>
                        <?php
                        // Add custom important pages here
                        $important_pages = array(
                            'contact' => __('Contact Us', 'woocommerce'),
                            'about' => __('About Us', 'woocommerce'),
                        );

                        foreach ($important_pages as $slug => $title):
                            $page = get_page_by_path($slug);
                            if ($page): ?>
                                <li>
                                    <a href="<?php echo get_permalink($page->ID); ?>"
                                        class="text-gray-700 hover:text-red-700 transition-colors flex items-center gap-2 group">
                                        <svg class="w-4 h-4 text-gray-400 group-hover:text-red-700" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                        <?php echo esc_html($title); ?>
                                    </a>
                                </li>
                            <?php endif;
                        endforeach; ?>
                    </ul>
                </div>

            </div>

            <!-- Right Column: Product Categories Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 lg:row-span-2">
                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-200">
                    <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <h2 class="text-xl font-semibold text-gray-900">
                        <?php esc_html_e('Product Categories', 'woocommerce'); ?>
                    </h2>
                </div>

                <!-- Search Box -->
                <div class="mb-4">
                    <input type="text" id="categorySearch" placeholder="Search categories..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-gray-500 focus:border-transparent text-sm">
                </div>

                <!-- Categories List -->
                <div id="categoriesList" class="max-h-[900px] overflow-y-auto">
                    <ul class="space-y-3">
                        <?php
                        $product_categories = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => true,
                            'parent' => 0,
                            'orderby' => 'name',
                            'order' => 'ASC'
                        ));

                        foreach ($product_categories as $category):
                            if ($category->slug === 'uncategorized')
                                continue;
                            ?>
                            <li class="category-item"
                                data-category-name="<?php echo esc_attr(strtolower($category->name)); ?>">
                                <a href="<?php echo get_term_link($category); ?>"
                                    class="text-gray-700 hover:text-red-700 transition-colors flex items-center justify-between group">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400 group-hover:text-red-700" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                        <?php echo esc_html($category->name); ?>
                                    </span>
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                        <?php echo $category->count; ?>
                                    </span>
                                </a>

                                <?php
                                // Get subcategories
                                $subcategories = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'parent' => $category->term_id,
                                    'orderby' => 'name',
                                    'order' => 'ASC'
                                ));

                                if (!empty($subcategories)): ?>
                                    <ul class="ml-6 mt-2 space-y-2">
                                        <?php foreach ($subcategories as $subcat): ?>
                                            <li>
                                                <a href="<?php echo get_term_link($subcat); ?>"
                                                    class="text-sm text-gray-600 hover:text-red-700 transition-colors flex items-center justify-between group">
                                                    <span class="flex items-center gap-2">
                                                        <svg class="w-3 h-3 text-gray-400 group-hover:text-red-700" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M9 5l7 7-7 7" />
                                                        </svg>
                                                        <?php echo esc_html($subcat->name); ?>
                                                    </span>
                                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                                        <?php echo $subcat->count; ?>
                                                    </span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- No Results Message -->
                    <p id="noResultsMessage" class="text-center text-gray-500 py-4 hidden">
                        <?php esc_html_e('No categories found', 'woocommerce'); ?>
                    </p>
                </div>
            </div>

        </div>

    </div>
</div>

<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Smooth transitions */
    .category-item {
        transition: opacity 0.3s ease-in-out;
        opacity: 1;
    }

    .category-item[style*="display: none"] {
        opacity: 0;
    }

    /* Custom scrollbar */
    .max-h-96::-webkit-scrollbar,
    #categoriesList::-webkit-scrollbar {
        width: 6px;
    }

    .max-h-96::-webkit-scrollbar-track,
    #categoriesList::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .max-h-96::-webkit-scrollbar-thumb,
    #categoriesList::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .max-h-96::-webkit-scrollbar-thumb:hover,
    #categoriesList::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('categorySearch');
        const noResultsMsg = document.getElementById('noResultsMessage');

        // Search functionality
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const searchTerm = this.value.toLowerCase().trim();
                const allItems = document.querySelectorAll('.category-item');
                let visibleCount = 0;

                allItems.forEach(item => {
                    const categoryName = item.getAttribute('data-category-name');

                    if (searchTerm === '' || categoryName.includes(searchTerm)) {
                        item.style.display = '';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Show "no results" message
                if (visibleCount === 0 && searchTerm !== '') {
                    noResultsMsg.classList.remove('hidden');
                } else {
                    noResultsMsg.classList.add('hidden');
                }
            });
        }
    });
</script>

<?php get_footer(); ?>