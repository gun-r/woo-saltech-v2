<?php
/*
 * Template Name: Refund Page
 */

// Redirect if user not logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/authentication'));
    exit;
}

get_header();
?>

<div class="bg-gray-50 py-8 sm:py-12 lg:py-16 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- SIDEBAR -->
            <aside class="hidden lg:block lg:col-span-1">
                <div class="lg:sticky lg:top-24">
                    <?php get_template_part('components/myaccount-sidebar'); ?>
                </div>
            </aside>

            <!-- MAIN CONTENT -->
            <div class="lg:col-span-3">

                <!-- Page Header -->
                <div class="mb-8 text-center lg:text-left">
                    <!-- <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Credit Slips & Refunds</h1>
                    <p class="text-sm sm:text-base text-gray-600">View your refund history and credit slips</p> -->
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Kredit notaer</h1>
                    <p class="text-sm sm:text-base text-gray-600">Se din refunderingshistorik og kredit notaer</p>
                </div>

                <?php
                if (class_exists('WooCommerce')) {
                    $user_id = get_current_user_id();

                    // Get all customer orders
                    $orders = wc_get_orders([
                        'customer_id' => $user_id,
                        'status' => array_keys(wc_get_order_statuses()),
                        'limit' => -1,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ]);

                    $refunds = [];

                    // Loop through orders and collect refunds
                    foreach ($orders as $order) {
                        foreach ($order->get_refunds() as $refund) {
                            $refunds[] = [
                                'id' => $refund->get_id(),
                                'order_id' => $order->get_id(),
                                'amount' => wc_price($refund->get_amount()),
                                'reason' => $refund->get_reason(),
                                'date_created' => $refund->get_date_created() ? $refund->get_date_created()->date_i18n('F j, Y') : '',
                                'order_url' => $order->get_view_order_url(),
                            ];
                        }
                    }

                    if (!empty($refunds)) {
                        echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-8">';

                        foreach ($refunds as $r) {
                            ?>
                            <div
                                class="bg-white rounded-xl shadow-sm border-2 border-green-200 overflow-hidden hover:shadow-md transition-shadow">
                                <!-- Refund Header -->
                                <div
                                    class="bg-gradient-to-r from-green-50 to-emerald-50 px-4 sm:px-6 py-4 border-b-2 border-dashed border-green-200">
                                    <div class="flex items-center justify-between gap-3">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h2 class="text-base sm:text-lg font-semibold text-gray-900">Refund
                                                    #<?php echo esc_html($r['id']); ?></h2>
                                                <p class="text-xs text-gray-600">Order #<?php echo esc_html($r['order_id']); ?></p>
                                            </div>
                                        </div>
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            Refunded
                                        </span>
                                    </div>
                                </div>

                                <!-- Refund Details -->
                                <div class="p-4 sm:p-6">
                                    <!-- Refund Amount -->
                                    <div class="mb-4 p-4 bg-green-50 rounded-lg border border-green-200">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-600">Refund Amount</p>
                                                    <p class="text-lg sm:text-xl font-bold text-green-600">
                                                        <?php echo $r['amount']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Refund Details -->
                                    <div class="space-y-3">
                                        <!-- Date -->
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-sm text-gray-700">
                                                <span class="font-medium">Refund Date:</span>
                                                <?php echo esc_html($r['date_created']); ?>
                                            </span>
                                        </div>

                                        <!-- Reason -->
                                        <?php if (!empty($r['reason'])): ?>
                                            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                                <div class="flex items-start gap-2">
                                                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <div>
                                                        <p class="text-xs font-medium text-gray-700 mb-1">Refund Reason:</p>
                                                        <p class="text-sm text-gray-600"><?php echo esc_html($r['reason']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                        echo '</div>';
                    } else {
                        // Empty State
                        ?>
                        <div class="bg-white rounded-xl border-2 border-dashed border-gray-300 p-8 sm:p-12 text-center mb-8">
                            <div class="max-w-sm mx-auto">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                                    </svg>
                                </div>
                                <!-- <h3 class="text-lg font-semibold text-gray-900 mb-2">No credit slips</h3>
                                <p class="text-sm text-gray-600 mb-6">
                                    You currently have no credit slips or refunds. All approved refunds will appear here.
                                </p> -->
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Ingen kreditnotaer
                                </h3>
                                <p class="text-sm text-gray-600 mb-6">
                                    YDu har i øjeblikket ingen kreditnotaer eller refunderinger. Alle godkendte refunderinger
                                    vil fremstå her.
                                </p>
                                <a href="<?php echo esc_url(home_url('/order-history')); ?>"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-lg font-medium hover:bg-gray-800 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <!-- View Order History -->
                                    Se ordrehistorik
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
                <div class="flex flex-col sm:flex-row justify-center gap-3 pt-6 border-t border-gray-200">
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

<?php get_footer(); ?>