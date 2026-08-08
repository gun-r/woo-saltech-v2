<?php
/*
 * Template Name: My Account Page
 */

// Check if logged in
if (!is_user_logged_in()) {
    wp_redirect(home_url('/authentication'));
    exit;
}

$current_user = wp_get_current_user();

// Load user addresses
$user_addresses = get_user_meta($current_user->ID, 'user_addresses', true);
if (!is_array($user_addresses)) {
    $user_addresses = [];
}

get_header();
?>

<div class="bg-gray-50 py-8 sm:py-12 lg:py-16 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        <!-- Page Title (My Account) -->
        <div class="mb-8 sm:mb-10">
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 text-center">Min konto</h1>
        </div>

        <!-- Account Links -->
        <div class="space-y-3 sm:space-y-4">

            <?php if (empty($user_addresses)): ?>
                <!-- Show only if user has no saved addresses -->
                <a href="/address"
                    class="flex items-center justify-between p-4 sm:p-5 bg-gradient-to-r from-red-50 to-red-100 rounded-xl sm:rounded-2xl border border-red-200 hover:shadow-md transition-all group">
                    <span class="flex items-center gap-2.5 sm:gap-3 text-red-800 font-medium text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <!-- <span class="leading-tight">ADD MY FIRST ADDRESS</span> -->
                        <span class="leading-tight">Tilføj min første adresse
                        </span>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-red-600 group-hover:translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            <?php endif; ?>

            <a href="/order-history"
                class="flex items-center justify-between p-4 sm:p-5 bg-white rounded-xl sm:rounded-2xl border border-gray-200 hover:shadow-md hover:border-gray-300 transition-all group">
                <span class="flex items-center gap-2.5 sm:gap-3 text-gray-800 font-medium text-sm sm:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 text-gray-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <!-- <span class="leading-tight">ORDER HISTORY AND DETAILS</span> -->
                    <span class="leading-tight">Ordrehistorik & detaljer
                    </span>

                </span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="/order-slip"
                class="flex items-center justify-between p-4 sm:p-5 bg-white rounded-xl sm:rounded-2xl border border-gray-200 hover:shadow-md hover:border-gray-300 transition-all group">
                <span class="flex items-center gap-2.5 sm:gap-3 text-gray-800 font-medium text-sm sm:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 text-gray-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <!-- <span class="leading-tight">CREDIT SLIPS & REFUNDS</span> -->
                    <span class="leading-tight">Kreditnota & refunderinger
                    </span>

                </span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="/addresses"
                class="flex items-center justify-between p-4 sm:p-5 bg-white rounded-xl sm:rounded-2xl border border-gray-200 hover:shadow-md hover:border-gray-300 transition-all group">
                <span class="flex items-center gap-2.5 sm:gap-3 text-gray-800 font-medium text-sm sm:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 text-gray-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <!-- <span class="leading-tight">ADDRESS BOOK</span> -->
                    <span class="leading-tight">Adressebog
                    </span>

                </span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="/identity"
                class="flex items-center justify-between p-4 sm:p-5 bg-white rounded-xl sm:rounded-2xl border border-gray-200 hover:shadow-md hover:border-gray-300 transition-all group">
                <span class="flex items-center gap-2.5 sm:gap-3 text-gray-800 font-medium text-sm sm:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 text-gray-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <!-- <span class="leading-tight">PERSONAL INFORMATION</span> -->
                    <span class="leading-tight">Personlig information
                    </span>

                </span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="/discount"
                class="flex items-center justify-between p-4 sm:p-5 bg-white rounded-xl sm:rounded-2xl border border-gray-200 hover:shadow-md hover:border-gray-300 transition-all group">
                <span class="flex items-center gap-2.5 sm:gap-3 text-gray-800 font-medium text-sm sm:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 text-gray-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <!-- <span class="leading-tight">VOUCHERS</span> -->
                    <span class="leading-tight">Kuponer</span>

                </span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <hr class="my-6 sm:my-8 border-gray-200">

        <!-- Home Button -->
        <div class="flex justify-center sm:justify-center">
            <a href="<?= esc_url(home_url('/')) ?>"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-gray-300 rounded-full bg-white hover:bg-gray-50 transition-colors text-gray-700 font-medium text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Home
            </a>
        </div>

    </div>
</div>

<?php get_footer(); ?>