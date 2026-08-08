<?php
/*
 * Template Name: Discount Page
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

            <div class="lg:col-span-3">

                <!-- Page Header -->
                <div class="mb-8 text-center lg:text-left">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                        <!-- My Vouchers -->
                        Mine kuponer
                    </h1>
                    <p class="text-sm sm:text-base text-gray-600">
                        <!-- Your available discounts and promotional codes -->
                        Dine tilgængelige rabatkoder og tilbud
                    </p>
                </div>

                <?php
                if (class_exists('WooCommerce')) {

                    // Get all published coupons
                    $coupon_posts = get_posts([
                        'post_type' => 'shop_coupon',
                        'post_status' => 'publish',
                        'numberposts' => -1,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ]);

                    $current_user = wp_get_current_user();
                    $user_email = strtolower($current_user->user_email);
                    $available = [];

                    foreach ($coupon_posts as $post) {
                        $coupon = new WC_Coupon($post->post_name);
                        $emails = array_map('strtolower', $coupon->get_email_restrictions());

                        if (empty($emails) || in_array($user_email, $emails)) {
                            $available[] = $coupon;
                        }
                    }

                    if (!empty($available)) {
                        echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-8">';

                        foreach ($available as $coupon) {
                            $code = $coupon->get_code();
                            $amount = $coupon->get_amount();
                            $type = $coupon->get_discount_type();
                            $desc = $coupon->get_description();
                            $usage_limit = $coupon->get_usage_limit();
                            $usage_count = $coupon->get_usage_count();
                            $expiry = $coupon->get_date_expires();
                            $email_restrictions = $coupon->get_email_restrictions();
                            $individual_use = $coupon->get_individual_use();
                            $min_spend = $coupon->get_minimum_amount();
                            $max_spend = $coupon->get_maximum_amount();

                            $type_label = match ($type) {
                                // 'percent' => 'Percentage Discount',
                                // 'fixed_cart' => 'Fixed Cart Discount',
                                // 'fixed_product' => 'Fixed Product Discount',
                                'percent' => 'Procentvis rabat',
                                'fixed_cart' => 'Fast rabat på kurv',
                                'fixed_product' => 'Fast produkt-rabat',
                                default => ucfirst($type),
                            };

                            // $expiry_text = $expiry ? $expiry->date('F j, Y') : 'No Expiration';
                            $expiry_text = $expiry ? $expiry->date('F j, Y') : 'Ingen udløbsdato';
                            $is_expired = $expiry && $expiry->getTimestamp() < time();
                            ?>

                            <!-- Voucher Card -->
                            <div
                                class="bg-white rounded-xl shadow-sm border-2 <?php echo $is_expired ? 'border-gray-300 opacity-60' : 'border-red-200'; ?> overflow-hidden hover:shadow-md transition-shadow">

                                <!-- Header -->
                                <div
                                    class="bg-gradient-to-r <?php echo $is_expired ? 'from-gray-100 to-gray-200' : 'from-red-50 to-orange-50'; ?> p-4 sm:p-5 border-b-2 border-dashed <?php echo $is_expired ? 'border-gray-300' : 'border-red-200'; ?>">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-2">
                                                <svg class="w-5 h-5 <?php echo $is_expired ? 'text-gray-400' : 'text-red-600'; ?>"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span
                                                    class="text-xs font-semibold uppercase tracking-wide <?php echo $is_expired ? 'text-gray-500' : 'text-red-600'; ?>">
                                                    <?php echo esc_html($type_label); ?>
                                                </span>
                                            </div>
                                            <h2
                                                class="text-xl sm:text-2xl font-bold uppercase tracking-wider font-mono <?php echo $is_expired ? 'text-gray-600' : 'text-gray-900'; ?>">
                                                <?php echo esc_html($code); ?>
                                            </h2>
                                        </div>

                                        <div class="text-right">
                                            <div
                                                class="text-2xl sm:text-3xl font-bold <?php echo $is_expired ? 'text-gray-500' : 'text-red-600'; ?>">
                                                <?php echo $type === 'percent' ? esc_html($amount) . '%' : '₱' . esc_html($amount); ?>
                                            </div>
                                            <!-- OFF -->
                                            <div
                                                class="text-xs <?php echo $is_expired ? 'text-gray-400' : 'text-gray-600'; ?> mt-1">
                                                RABAT
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Details -->
                                <div class="p-4 sm:p-5">

                                    <?php if ($is_expired): ?>
                                        <div class="mb-4 p-3 bg-gray-100 border border-gray-300 rounded-lg flex items-center gap-2">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <!-- This voucher has expired -->
                                            <span class="text-sm font-medium text-gray-700">Denne voucher er udløbet</span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="space-y-2 text-sm">
                                        <!-- Expiry Date -->
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-gray-700">
                                                <!-- Expires: -->
                                                <span class="font-medium">Udløber:</span>
                                                <span class="<?php echo $is_expired ? 'text-red-600 font-medium' : ''; ?>">
                                                    <?php echo esc_html($expiry_text); ?>
                                                </span>
                                            </span>
                                        </div>

                                        <?php if ($usage_limit): ?>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                                <span class="text-gray-700">
                                                    <!-- Usage: -->
                                                    <span class="font-medium">Anvendelse:</span>
                                                    <?php echo esc_html($usage_count); ?> / <?php echo esc_html($usage_limit); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($min_spend): ?>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                                <span class="text-gray-700">
                                                    <!-- Min. spend: -->
                                                    <span class="font-medium">Min. køb:</span> ₱<?php echo esc_html($min_spend); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($max_spend): ?>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                                <span class="text-gray-700">
                                                    <!-- Max. spend: -->
                                                    <span class="font-medium">Maks. køb:</span> ₱<?php echo esc_html($max_spend); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($individual_use): ?>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                                <!-- Individual use only -->
                                                <span class="text-gray-700 font-medium">Kun til individuel brug</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($desc)): ?>
                                        <div class="mt-4 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                            <p class="text-xs sm:text-sm text-gray-700 leading-relaxed">
                                                <?php echo esc_html($desc); ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($email_restrictions)): ?>
                                        <div class="mt-3 text-xs text-gray-500 italic">
                                            <!-- Restricted to: -->
                                            Begrænset til:
                                            <?php echo esc_html(implode(', ', array_slice($email_restrictions, 0, 2))); ?>
                                            <?php if (count($email_restrictions) > 2): ?>
                                                <!-- and ... more -->
                                                og <?php echo count($email_restrictions) - 2; ?> mere
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!$is_expired): ?>
                                        <button onclick="copyCode('<?php echo esc_js($code); ?>', this)"
                                            class="mt-4 w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                            <!-- Copy Code -->
                                            <span>Kopiér kode</span>
                                        </button>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <?php
                        }

                        echo '</div>';
                    } else {
                        ?>
                        <div class="bg-white rounded-xl border-2 border-dashed border-gray-300 p-8 sm:p-12 text-center mb-8">
                            <div class="max-w-sm mx-auto">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    <!-- No vouchers available -->
                                    Ingen kuponer tilgængelige
                                </h3>
                                <p class="text-sm text-gray-600 mb-6">
                                    <!-- You currently have no available vouchers or discounts. Check back later for special offers! -->
                                    Du har i øjeblikket ingen kuponer eller rabatkoder. Kig tilbage senere for specielle tilbud!
                                </p>
                                <a href="<?php echo esc_url(home_url('/shop')); ?>"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 00 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <!-- Continue Shopping -->
                                    Fortsæt med at handle
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
                        <!-- WooCommerce is not available -->
                        <p class="text-red-800 font-medium">WooCommerce er ikke tilgængelig</p>
                        <!-- Please contact support if this issue persists. -->
                        <p class="text-sm text-red-600 mt-1">Kontakt venligst support, hvis problemet fortsætter.</p>
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

<script>
    function copyCode(code, button) {
        navigator.clipboard.writeText(code).then(function () {
            const originalText = button.innerHTML;
            // Copied!
            button.innerHTML = '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg><span>Kopieret!</span>';
            button.classList.add('bg-green-600');
            button.classList.remove('bg-red-600', 'hover:bg-red-700');

            setTimeout(function () {
                button.innerHTML = originalText;
                button.classList.remove('bg-green-600');
                button.classList.add('bg-red-600', 'hover:bg-red-700');
            }, 2000);
        });
    }
</script>

<?php get_footer(); ?>