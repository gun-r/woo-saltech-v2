<div class="w-full lg:w-64 lg:flex-shrink-0">
    <?php if (!is_user_logged_in())
        return; ?>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden lg:sticky lg:top-24">

        <!-- Header -->
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-4 py-3 border-b border-gray-700">
            <h2 class="text-base font-semibold text-white flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Min konto
            </h2>
        </div>

        <!-- Menu Items -->
        <div class="p-3 space-y-1">

            <!-- ORDER HISTORY -->
            <a href="/order-history"
                class="group flex items-center gap-3 px-2 py-3 rounded-md hover:bg-gray-100 transition-all duration-200">
                <div class="flex-shrink-0 w-7 h-7 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Ordrehistorik</p>
                </div>
            </a>

            <!-- CREDIT SLIPS -->
            <a href="/order-slip"
                class="group flex items-center gap-3 px-2 py-3 rounded-md hover:bg-gray-100 transition-all duration-200">
                <div class="flex-shrink-0 w-7 h-7 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Kredit notaer</p>
                </div>
            </a>

            <!-- ADDRESSES -->
            <a href="/addresses"
                class="group flex items-center gap-3 px-2 py-3 rounded-md hover:bg-gray-100 transition-all duration-200">
                <div class="flex-shrink-0 w-7 h-7 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Adressebog</p>
                </div>
            </a>

            <!-- PERSONAL INFO -->
            <a href="/identity"
                class="group flex items-center gap-3 px-2 py-3 rounded-md hover:bg-gray-100 transition-all duration-200">
                <div class="flex-shrink-0 w-7 h-7 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Personlig information</p>
                </div>
            </a>

            <!-- VOUCHERS -->
            <a href="/discount"
                class="group flex items-center gap-3 px-2 py-3 rounded-md hover:bg-gray-100 transition-all duration-200">
                <div class="flex-shrink-0 w-7 h-7 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Kuponer</p>
                </div>
            </a>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-2"></div>

            <!-- LOGOUT -->
            <a href="<?php echo wp_logout_url(home_url()); ?>"
                class="group flex items-center gap-3 px-2 py-3 rounded-md hover:bg-gray-100 transition-all duration-200">
                <div class="flex-shrink-0 w-7 h-7 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Log ud</p>
                </div>
            </a>

        </div>
    </div>
</div>