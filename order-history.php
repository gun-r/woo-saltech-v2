<?php
/*
 * Template Name: Order History Page
 */

// Redirect if user not logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/authentication'));
    exit;
}

get_header();

// Get filter from URL
$filter_status = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : 'all';
?>

<div class="bg-gray-50 py-8 sm:py-12 lg:py-16 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- SIDEBAR - Hidden on Mobile -->
            <aside class="hidden lg:block lg:col-span-1">
                <div class="lg:sticky lg:top-24">
                    <?php get_template_part('components/myaccount-sidebar'); ?>
                </div>
            </aside>

            <!-- MAIN CONTENT -->
            <div class="lg:col-span-3">

                <!-- Page Header -->
                <div class="mb-6 text-center lg:text-left">
                    <!-- <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Order History</h1>
                    <p class="text-sm sm:text-base text-gray-600">View and track your past orders</p> -->
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Ordrehistorik</h1>
                    <p class="text-sm sm:text-base text-gray-600">Se & track dine forrige ordrer</p>
                </div>

                <!-- Status Filter Navigation -->
                <div class="mb-6 bg-white rounded-xl shadow-sm border border-gray-200 p-3 sm:p-4">
                    <div class="flex items-center gap-2 overflow-x-auto scrollbar-hide">
                        <?php
                        $statuses = array(
                            'all' => array('label' => 'Alt', 'icon' => 'M4 6h16M4 10h16M4 14h16M4 18h16'),
                            'pending' => array('label' => 'Afventende ordre', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'),
                            'processing' => array('label' => 'Under behandling', 'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'),
                            'on-hold' => array('label' => 'Sat på pause', 'icon' => 'M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z'),
                            'completed' => array('label' => 'Fuldført', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'),
                            'cancelled' => array('label' => 'Annulleret', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'),
                            'refunded' => array('label' => 'Refunderet', 'icon' => 'M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6'),
                        );

                        foreach ($statuses as $status_key => $status_info):
                            $is_active = ($filter_status === $status_key);
                            $active_class = $is_active
                                ? 'bg-red-700 text-white border-red-700'
                                : 'bg-white text-gray-700 border-gray-200 hover:border-red-700 hover:bg-red-50 hover:text-red-700';

                            $current_url = add_query_arg('status', $status_key, strtok($_SERVER["REQUEST_URI"], '?'));
                            ?>
                            <a href="<?php echo esc_url($current_url); ?>"
                                class="flex-shrink-0 inline-flex items-center gap-2 px-3 sm:px-4 py-2 rounded-lg border font-medium text-sm transition-all <?php echo $active_class; ?>">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="<?php echo $status_info['icon']; ?>" />
                                </svg>
                                <span><?php echo $status_info['label']; ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <?php
                if (class_exists('WooCommerce')) {
                    $user_id = get_current_user_id();

                    // Build query args based on filter
                    $query_args = [
                        'customer_id' => $user_id,
                        'limit' => -1,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ];

                    // Add status filter if not 'all'
                    if ($filter_status !== 'all') {
                        $query_args['status'] = $filter_status;
                    }

                    // Get orders
                    $orders = wc_get_orders($query_args);

                    if (!empty($orders)) {
                        echo '<div class="space-y-6">';

                        foreach ($orders as $order) {
                            $order_id = $order->get_id();
                            $date = $order->get_date_created() ? $order->get_date_created()->date_i18n('F j, Y') : '';
                            $status = $order->get_status();
                            $status_name = wc_get_order_status_name($status);
                            $total = $order->get_formatted_order_total();
                            $payment = $order->get_payment_method_title();
                            $items = $order->get_items();
                            $shipping = $order->get_formatted_shipping_address();

                            // Status badge colors
                            $status_classes = match ($status) {
                                'completed' => 'bg-green-100 text-green-800 border-green-200',
                                'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                'on-hold' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'pending' => 'bg-orange-100 text-orange-800 border-orange-200',
                                'cancelled', 'refunded', 'failed' => 'bg-red-100 text-red-800 border-red-200',
                                default => 'bg-gray-100 text-gray-800 border-gray-200'
                            };

                            // Generate invoice URL
                            $invoice_url = '';
                            if (function_exists('wcpdf_get_invoice')) {
                                $invoice = wcpdf_get_invoice($order);
                                if ($invoice && $invoice->exists()) {
                                    $invoice_url = wp_nonce_url(
                                        admin_url('admin-ajax.php?action=generate_wpo_wcpdf&document_type=invoice&order_ids=' . $order_id . '&my-account'),
                                        'generate_wpo_wcpdf'
                                    );
                                }
                            }
                            ?>

                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <!-- Order Header -->
                                <div class="order-header bg-gradient-to-r from-blue-50 to-indigo-50 px-4 sm:px-6 py-4 border-b border-gray-200 cursor-pointer sm:cursor-default"
                                    data-order-toggle>
                                    <div class="flex items-center justify-between gap-3">
                                        <div class="flex items-center gap-3 flex-1 min-w-0">
                                            <div
                                                class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h2 class="text-base sm:text-lg font-semibold text-gray-900 truncate">
                                                    Order #<?php echo esc_html($order_id); ?>
                                                </h2>
                                                <p class="text-xs sm:text-sm text-gray-600"><?php echo esc_html($date); ?></p>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 flex-shrink-0">
                                            <span
                                                class="inline-flex items-center px-2.5 sm:px-3 py-1 rounded-full text-xs font-medium border <?php echo esc_attr($status_classes); ?>">
                                                <?php echo esc_html($status_name); ?>
                                            </span>

                                            <!-- Mobile Dropdown Arrow -->
                                            <button
                                                class="sm:hidden w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-blue-100 rounded-lg transition-colors"
                                                data-dropdown-toggle aria-label="Toggle order details">
                                                <svg class="w-5 h-5 transition-transform duration-200" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Details -->
                                <div class="order-details hidden sm:block p-4 sm:p-6">
                                    <!-- Summary Info & Download Invoice -->
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                            <div
                                                class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-600">Total Amount</p>
                                                <p class="text-base font-semibold text-gray-900"><?php echo wp_kses_post($total); ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                            <div
                                                class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-600">Payment Method</p>
                                                <p class="text-base font-semibold text-gray-900">
                                                    <?php echo esc_html($payment ?: 'N/A'); ?>
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Download Invoice Button -->
                                        <?php if ($invoice_url): ?>
                                            <a href="<?php echo esc_url($invoice_url); ?>" target="_blank"
                                                class="flex items-center justify-center gap-2 p-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg transition-all shadow-sm hover:shadow-md">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span class="text-sm font-semibold">Download Invoice</span>
                                            </a>
                                        <?php else: ?>
                                            <div
                                                class="flex items-center justify-center gap-2 p-3 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span class="text-sm font-medium">Invoice Unavailable</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Order Items -->
                                    <div class="border-t border-gray-200 pt-5">
                                        <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                            Order Items
                                        </h3>
                                        <div class="space-y-3">
                                            <?php foreach ($items as $item):
                                                $product_name = $item->get_name();
                                                $quantity = $item->get_quantity();
                                                $subtotal = $item->get_total();
                                                ?>
                                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-gray-900 truncate">
                                                            <?php echo esc_html($product_name); ?>
                                                        </p>
                                                        <p class="text-xs text-gray-600 mt-1">Quantity:
                                                            <?php echo esc_html($quantity); ?>
                                                        </p>
                                                    </div>
                                                    <div class="text-right ml-3 flex-shrink-0">
                                                        <p class="text-sm font-semibold text-gray-900">
                                                            DKK <?php echo esc_html(number_format($subtotal, 2)); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <!-- Shipping Address -->
                                    <?php if ($shipping): ?>
                                        <div class="border-t border-gray-200 mt-5 pt-5">
                                            <h3 class="text-base font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                Shipping Address
                                            </h3>
                                            <div class="p-4 bg-gray-50 rounded-lg">
                                                <div class="text-sm text-gray-700 leading-relaxed">
                                                    <?php echo wp_kses_post(nl2br($shipping)); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php
                        }

                        echo '</div>';
                    } else {
                        // Empty State
                        // $status_label = $filter_status !== 'all' ? wc_get_order_status_name($filter_status) : 'any status';
                        $status_label = $filter_status !== 'alt' ? wc_get_order_status_name($filter_status) : 'nogen status';
                        ?>
                        <div class="bg-white rounded-xl border-2 border-dashed border-gray-300 p-8 sm:p-12 text-center mb-8">
                            <div class="max-w-sm mx-auto">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <!-- <h3 class="text-lg font-semibold text-gray-900 mb-2">No orders found</h3> -->
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Ingen ordrer fundet</h3>
                                <p class="text-sm text-gray-600 mb-6">
                                    <!-- You don't have any orders with -->
                                    Du har ingen ordrer med <?php echo esc_html($status_label); ?>.
                                </p>
                                <a href="<?php echo esc_url(remove_query_arg('status')); ?>"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                    <!-- View All Orders -->
                                    Se alle ordrer
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-6 text-center mb-8">
                        <svg class="w-12 h-12 text-red-600 mx-auto mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-red-800 font-medium">WooCommerce is not available</p>
                        <p class="text-sm text-red-600 mt-1">Please contact support if this issue persists.</p>
                    </div>
                    <?php
                }
                ?>

                <!-- Bottom Navigation -->
                <div class="flex flex-col sm:flex-row justify-center gap-3 mt-8 pt-6 border-t border-gray-200">
                    <a href="<?= esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-gray-300 rounded-full bg-white hover:bg-gray-50 transition-colors text-gray-700 font-medium text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <!-- Back to Account -->
                        Tilbage til profil
                    </a>

                    <a href="<?= esc_url(home_url('/')) ?>"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-gray-300 rounded-full bg-white hover:bg-gray-50 transition-colors text-gray-700 font-medium text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <!-- Home -->
                        Hjem
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Hide scrollbar for filter navigation */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* Smooth rotation for dropdown arrow */
    [data-dropdown-toggle] svg {
        transition: transform 0.2s ease-in-out;
    }

    [data-dropdown-toggle].active svg {
        transform: rotate(180deg);
    }

    /* Mobile: Smooth expand/collapse animation */
    @media (max-width: 639px) {
        .order-details {
            transition: max-height 0.3s ease-in-out, opacity 0.2s ease-in-out, padding 0.3s ease-in-out;
            overflow: hidden;
        }

        .order-details.hidden {
            max-height: 0 !important;
            opacity: 0;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        .order-details:not(.hidden) {
            max-height: 3000px;
            opacity: 1;
        }
    }

    /* Desktop: Always show details */
    @media (min-width: 640px) {
        .order-details {
            display: block !important;
            max-height: none !important;
            opacity: 1 !important;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll("[data-order-toggle]").forEach(header => {
            const details = header.nextElementSibling;
            const dropdownToggle = header.querySelector("[data-dropdown-toggle]");

            header.addEventListener("click", (e) => {
                if (e.target.closest("[data-dropdown-toggle]")) {
                    return;
                }
                if (window.innerWidth >= 640) return;
                if (!details) return;

                details.classList.toggle("hidden");
                if (dropdownToggle) {
                    dropdownToggle.classList.toggle("active");
                }
            });

            dropdownToggle?.addEventListener("click", (e) => {
                e.stopPropagation();
                if (!details) return;

                details.classList.toggle("hidden");
                dropdownToggle.classList.toggle("active");
            });
        });
    });
</script>

<?php get_footer(); ?>