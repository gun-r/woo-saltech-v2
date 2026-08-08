<?php
/**
 * Template Name: Products A-Z
 */

get_header();

// Get all products alphabetically
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'post_status' => 'publish'
);

$products = new WP_Query($args);
$grouped_products = array();

if ($products->have_posts()) {
    while ($products->have_posts()) {
        $products->the_post();
        $letter = strtoupper(substr(get_the_title(), 0, 1));
        $grouped_products[$letter][] = get_post();
    }
    wp_reset_postdata();
    ksort($grouped_products);
}
?>

<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen py-8 sm:py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="text-center mb-8">
            <!-- All Products A-Z -->
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-2">
                Alle produkter A-Z
            </h1>
            <!-- Browse all our products alphabetically -->
            <p class="text-sm sm:text-base text-gray-600">
                Gennemse alle vores produkter i alfabetisk rækkefølge
            </p>
        </div>

        <!-- Desktop Alphabet Navigation -->
        <div class="hidden lg:block mb-8 sticky top-0 z-20">
            <div class="border-y border-gray-200 p-4 bg-white/40 backdrop-blur-sm">
                <div class="flex gap-1 justify-center items-center">
                    <?php 
                    $alphabet = range('A', 'Z');
                    foreach ($alphabet as $letter): 
                        $has_products = isset($grouped_products[$letter]);
                        $link_class = $has_products 
                            ? 'alphabet-link flex items-center justify-center w-8 h-8 xl:w-9 xl:h-9 rounded-md font-bold text-xs xl:text-sm text-gray-700 hover:bg-red-600 hover:text-white hover:scale-110 transition-all duration-200 cursor-pointer border border-gray-300 hover:border-red-600 flex-shrink-0'
                            : 'flex items-center justify-center w-8 h-8 xl:w-9 xl:h-9 rounded-md font-medium text-xs xl:text-sm text-gray-300 cursor-not-allowed border border-gray-200 flex-shrink-0';
                    ?>
                        <a href="<?php echo $has_products ? '#letter-' . $letter : 'javascript:void(0)'; ?>" 
                           class="<?php echo $link_class; ?>"
                           data-letter="<?php echo $letter; ?>"
                           <?php echo !$has_products ? 'onclick="return false;"' : ''; ?>>
                            <?php echo $letter; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Layout Container -->
        <div class="flex gap-6 relative">
            
            <!-- Main Content Area -->
            <div class="flex-1 min-w-0">
                
                <!-- Products List -->
                <?php if (!empty($grouped_products)): ?>
                    <?php foreach ($grouped_products as $letter => $letter_products): ?>
                        <div class="mb-12" id="letter-<?php echo $letter; ?>">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center shadow-md">
                                    <span class="text-2xl font-bold text-white"><?php echo $letter; ?></span>
                                </div>
                                <div class="flex-1 h-px bg-gradient-to-r from-gray-300 to-transparent"></div>
                                <!-- products -->
                                <span class="text-sm text-gray-500 font-medium"><?php echo count($letter_products); ?> produkter</span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <?php foreach ($letter_products as $product_post): 
                                    $product = wc_get_product($product_post->ID);
                                ?>
                                    <a href="<?php echo get_permalink($product_post->ID); ?>" 
                                       class="flex items-center gap-4 bg-white rounded-lg p-4 border border-gray-200 hover:-translate-y-1 hover:shadow-md transition-all group">
                                        <?php if (has_post_thumbnail($product_post->ID)): ?>
                                            <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
                                                <?php echo get_the_post_thumbnail($product_post->ID, 'thumbnail', array('class' => 'w-full h-full object-cover transition-transform duration-300')); ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-sm font-medium text-gray-900 line-clamp-2 transition-colors">
                                                <?php echo esc_html($product_post->post_title); ?>
                                            </h3>
                                            <?php if ($product): ?>
                                                <?php
                                                $product_price = $product->get_price();
                                                $is_zero_price = empty($product_price) || floatval($product_price) == 0;
                                                ?>

                                                <?php if (!$is_zero_price): ?>
                                                    <p class="text-sm font-semibold text-red-600 mt-1">
                                                        <?php echo $product->get_price_html(); ?>
                                                    </p>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-16 bg-white rounded-xl border border-gray-200">
                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <!-- No products found -->
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Ingen produkter fundet</h3>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Mobile Alphabet Navigation Sidebar -->
            <div class="lg:hidden fixed right-2 top-1/2 -translate-y-1/2 z-40">
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-2 max-h-[70vh] overflow-y-auto">
                    <div class="flex flex-col gap-0.5">
                        <?php 
                        $alphabet = range('A', 'Z');
                        foreach ($alphabet as $letter): 
                            $has_products = isset($grouped_products[$letter]);
                            $link_class = $has_products 
                                ? 'alphabet-link-mobile flex items-center justify-center w-9 h-9 rounded-md font-bold text-xs text-gray-700 hover:bg-red-600 hover:text-white hover:scale-110 transition-all duration-200 cursor-pointer border border-transparent'
                                : 'flex items-center justify-center w-9 h-9 rounded-md font-medium text-xs text-gray-300 cursor-not-allowed';
                        ?>
                            <a href="<?php echo $has_products ? '#letter-' . $letter : 'javascript:void(0)'; ?>" 
                               class="<?php echo $link_class; ?>"
                               <?php echo !$has_products ? 'onclick="return false;"' : ''; ?>>
                                <?php echo $letter; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    html {
        scroll-behavior: smooth;
    }

    /* Custom scrollbar for mobile sidebar */
    .overflow-y-auto::-webkit-scrollbar {
        width: 4px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 2px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 2px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Active state for alphabet links */
    .alphabet-link.active,
    .alphabet-link-mobile.active {
        background-color: #dc2626;
        color: white;
        border-color: #dc2626;
        transform: scale(1.1);
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.4);
    }

    .alphabet-link,
    .alphabet-link-mobile {
        position: relative;
        z-index: 1;
    }

    @media (max-width: 1023px) {
        .flex-1.min-w-0 {
            padding-right: 3rem;
        }
    }

    @media (min-width: 1024px) {
        .overflow-x-auto {
            white-space: nowrap;
        }
    }

    /* For smaller desktop screens */
    @media (min-width: 1024px) and (max-width: 1279px) {
        .alphabet-link {
            font-size: 0.75rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('[id^="letter-"]');
    const navLinks = document.querySelectorAll('.alphabet-link, .alphabet-link-mobile');

    // Smooth scroll with offset
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.getAttribute('href') !== 'javascript:void(0)') {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    const offset = window.innerWidth < 1024 ? 20 : 120;
                    const targetPosition = targetSection.offsetTop - offset;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    function highlightActiveSection() {
        let currentSection = '';
        const scrollPosition = window.scrollY + (window.innerWidth < 1024 ? 150 : 200);

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });

        // Remove active class from all links
        navLinks.forEach(link => {
            link.classList.remove('active');
            
            // Add active class to current section link
            if (currentSection && link.getAttribute('href') === '#' + currentSection) {
                link.classList.add('active');
            }
        });
    }

    // Throttle scroll event for performance
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (scrollTimeout) {
            window.cancelAnimationFrame(scrollTimeout);
        }
        scrollTimeout = window.requestAnimationFrame(highlightActiveSection);
    });

    // Initial check
    highlightActiveSection();
});
</script>

<?php get_footer(); ?>