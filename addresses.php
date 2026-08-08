<?php
/*
 * Template Name: Addresses
 */

if (!is_user_logged_in()) {
    wp_redirect(home_url('/authentication'));
    exit;
}

$current_user = wp_get_current_user();

// Load user addresses
$user_addresses = get_user_meta($current_user->ID, 'user_addresses', true);
if (!is_array($user_addresses))
    $user_addresses = [];

// Handle Delete Address
if (isset($_GET['delete_address']) && isset($user_addresses[$_GET['delete_address']])) {
    $del_id = sanitize_text_field($_GET['delete_address']);
    unset($user_addresses[$del_id]);
    update_user_meta($current_user->ID, 'user_addresses', $user_addresses);
    wp_safe_redirect(home_url('/addresses'));
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
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                        <!-- My Addresses -->
                        Mine adresser
                    </h1>

                    <div class="space-y-3">
                        <p class="text-sm sm:text-base text-gray-600">
                            <!-- Please configure your default billing and delivery addresses when placing an order. You may
                            also add
                            additional addresses, which can be useful for sending gifts or receiving orders at your
                            office. -->
                            Angiv venligst dine standard fakturerings- og leveringsadresser, når du afgiver en ordre. Du
                            kan også tilføje ekstra adresser, som kan bruges til at sende gaver eller modtage ordrer på
                            din arbejdsplads.
                        </p>
                        <p class="text-sm sm:text-base font-medium text-gray-900">
                            <!-- Your addresses are listed below. -->
                            Dine adresser vises nedenfor.
                        </p>
                        <p class="text-xs sm:text-sm text-gray-500">
                            <!-- Be sure to update your personal information if it has changed. -->
                            Sørg for at opdatere dine personlige oplysninger, hvis de har ændret sig.
                        </p>
                    </div>
                </div>

                <?php if ($user_addresses): ?>
                    <!-- Address Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-8 sm:mb-10">
                        <?php foreach ($user_addresses as $index => $addr): ?>
                            <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                <!-- Address Header -->
                                <div class="p-4 sm:p-6 border-b border-gray-100">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <h2 class="text-base sm:text-lg font-semibold text-gray-900 uppercase">
                                                <?php echo esc_html($addr['address_title']); ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address Details -->
                                <div class="p-4 sm:p-6">
                                    <div class="space-y-2 text-sm sm:text-base">
                                        <p class="font-medium text-gray-900">
                                            <?php echo esc_html($addr['first_name'] . ' ' . $addr['last_name']); ?>
                                        </p>

                                        <?php if (!empty($addr['company'])): ?>
                                            <p class="text-gray-600"><?php echo esc_html($addr['company']); ?></p>
                                        <?php endif; ?>

                                        <div class="pt-2 border-t border-gray-100">
                                            <p class="text-gray-700"><?php echo esc_html($addr['address_1']); ?></p>
                                            <?php if (!empty($addr['address_2'])): ?>
                                                <p class="text-gray-700"><?php echo esc_html($addr['address_2']); ?></p>
                                            <?php endif; ?>
                                            <p class="text-gray-700">
                                                <?php echo esc_html($addr['city'] . ', ' . $addr['postcode']); ?>
                                            </p>
                                            <p class="text-gray-700"><?php echo esc_html($addr['country']); ?></p>
                                        </div>

                                        <?php if (!empty($addr['phone']) || !empty($addr['mobile'])): ?>
                                            <div class="pt-2 border-t border-gray-100 space-y-1">
                                                <?php if (!empty($addr['phone'])): ?>
                                                    <div class="flex items-center gap-2 text-gray-600">
                                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        </svg>
                                                        <span><?php echo esc_html($addr['phone']); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($addr['mobile'])): ?>
                                                    <div class="flex items-center gap-2 text-gray-600">
                                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                        </svg>
                                                        <span><?php echo esc_html($addr['mobile']); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($addr['additional_info'])): ?>
                                            <div class="pt-2 border-t border-gray-100">
                                                <p class="text-xs text-gray-500 italic">
                                                    <?php echo esc_html($addr['additional_info']); ?>
                                                </p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="p-4 sm:p-6 pt-0 flex flex-col sm:flex-row gap-2 sm:gap-3">
                                    <a href="<?php echo home_url('/address?edit=' . $index); ?>"
                                        class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 hover:border-gray-400 transition-all text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <!-- Edit -->
                                        Rediger
                                    </a>
                                    <a href="<?php echo home_url('/addresses?delete_address=' . $index); ?>"
                                        onclick="return confirm('Are you sure you want to delete this address?');"
                                        class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-red-300 rounded-lg text-red-600 font-medium hover:bg-red-50 hover:border-red-400 transition-all text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <!-- Delete -->
                                        Slet
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <!-- Empty State -->
                    <div class="bg-white rounded-xl border-2 border-dashed border-gray-300 p-8 sm:p-12 text-center mb-8">
                        <div class="max-w-sm mx-auto">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                <!-- No addresses yet -->
                                Ingen adresser endnu
                            </h3>
                            <p class="text-sm text-gray-600 mb-6">
                                <!-- Add your first address to make checkout faster and easier. -->
                                Tilføj din første adresse for at gøre checkout hurtigere og nemmere.
                            </p>
                            <a href="<?php echo home_url('/address'); ?>"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                <!-- Add Your First Address -->
                                Tilføj din første adresse
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Add New Address Button (shown when addresses exist) -->
                <?php if ($user_addresses): ?>
                    <div class="flex justify-center mb-8 sm:mb-10">
                        <a href="<?php echo home_url('/address'); ?>"
                            class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-6 py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors shadow-sm text-sm sm:text-base">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <!-- Add New Address -->
                            Tilføj ny adresse
                        </a>
                    </div>
                <?php endif; ?>

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