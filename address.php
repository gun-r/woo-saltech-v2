<?php
/*
 * Template Name: Address
 */

if (!is_user_logged_in()) {
    wp_redirect(home_url('/authentication'));
    exit;
}

get_header();
$current_user = wp_get_current_user();

// Check if editing an existing address
$is_editing = false;
$edit_id = null;
$address_data = array();

if (isset($_GET['edit'])) {
    $edit_id = sanitize_text_field($_GET['edit']);
    $user_addresses = get_user_meta($current_user->ID, 'user_addresses', true);

    if (is_array($user_addresses) && isset($user_addresses[$edit_id])) {
        $is_editing = true;
        $address_data = $user_addresses[$edit_id];
    } else {
        wp_redirect(home_url('/addresses'));
        exit;
    }
}
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
                        <?php //echo $is_editing ? 'Edit Address' : 'Add New Address'; ?>
                        <?php echo $is_editing ? 'Rediger adresse' : 'Tilføj ny adresse'; ?>
                    </h1>
                    <p class="text-sm text-gray-500">
                        <span class="inline-flex items-center gap-1">
                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <!-- Fields marked with * are required -->
                            Felter markeret med * er påkrævet
                        </span>
                    </p>
                </div>

                <!-- Address Form -->
                <form method="POST"
                    class="bg-white p-4 sm:p-6 lg:p-8 rounded-xl sm:rounded-2xl shadow-sm border border-gray-200">

                    <?php if ($is_editing): ?>
                        <input type="hidden" name="edit_id" value="<?php echo esc_attr($edit_id); ?>">
                    <?php endif; ?>

                    <div class="space-y-5 sm:space-y-6">

                        <!-- Name Fields (Side by Side on Desktop) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                            <!-- First Name -->
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Fornavn <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="first_name" name="first_name" required
                                    value="<?php echo esc_attr($address_data['first_name'] ?? ''); ?>"
                                    class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                    placeholder="John">
                            </div>

                            <!-- Last Name -->
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Efternavn <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="last_name" name="last_name" required
                                    value="<?php echo esc_attr($address_data['last_name'] ?? ''); ?>"
                                    class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                    placeholder="Doe">
                            </div>
                        </div>

                        <!-- Company -->
                        <div>
                            <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                                Firma <span class="text-xs text-gray-500">(valgfrit)</span>
                            </label>
                            <input type="text" id="company" name="company"
                                value="<?php echo esc_attr($address_data['company'] ?? ''); ?>"
                                class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                placeholder="Company Name">
                        </div>

                        <!-- Phone Numbers (Side by Side on Desktop) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                            <!-- Home Phone -->
                            <div>
                                <label for="billing_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Hjemmetelefon <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <input type="tel" id="billing_phone" name="billing_phone" required
                                        value="<?php echo esc_attr($address_data['phone'] ?? ''); ?>"
                                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                        placeholder="+1 234 567 8900">
                                </div>
                            </div>

                            <!-- Mobile Phone -->
                            <div>
                                <label for="billing_mobile" class="block text-sm font-medium text-gray-700 mb-2">
                                    Mobilnummer <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="tel" id="billing_mobile" name="billing_mobile" required
                                        value="<?php echo esc_attr($address_data['mobile'] ?? ''); ?>"
                                        class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                        placeholder="+1 234 567 8901">
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-5 sm:pt-6"></div>

                        <!-- Address Line 1 -->
                        <div>
                            <label for="address_1" class="block text-sm font-medium text-gray-700 mb-2">
                                Adresse <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="address_1" name="address_1" required
                                value="<?php echo esc_attr($address_data['address_1'] ?? ''); ?>"
                                class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                placeholder="123 Main Street">
                        </div>

                        <!-- Address Line 2 -->
                        <div>
                            <label for="address_2" class="block text-sm font-medium text-gray-700 mb-2">
                                <!-- Apartment, suite, etc. <span class="text-xs text-gray-500">(optional)</span> -->
                                Lejlighed, etage, dørnummer osv. <span class="text-xs text-gray-500">(Valgfrit)</span>
                            </label>
                            <input type="text" id="address_2" name="address_2"
                                value="<?php echo esc_attr($address_data['address_2'] ?? ''); ?>"
                                class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                placeholder="Apt 4B">
                        </div>

                        <!-- City, Postal Code, Country -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5">
                            <!-- City -->
                            <div class="sm:col-span-1">
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                    By <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="city" name="city" required
                                    value="<?php echo esc_attr($address_data['city'] ?? ''); ?>"
                                    class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                    placeholder="New York">
                            </div>

                            <!-- Zip / Postal Code -->
                            <div class="sm:col-span-1">
                                <label for="postcode" class="block text-sm font-medium text-gray-700 mb-2">
                                    Postnummer <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="postcode" name="postcode" required
                                    value="<?php echo esc_attr($address_data['postcode'] ?? ''); ?>"
                                    class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                    placeholder="10001">
                            </div>

                            <!-- Country -->
                            <div class="sm:col-span-1">
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                    Land <span class="text-red-500">*</span>
                                </label>
                                <select id="country" name="country" required
                                    class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base bg-white">
                                    <option value="">Vælg land</option>
                                    <?php
                                    $countries = WC()->countries->get_countries();
                                    $selected_country = $address_data['country'] ?? '';
                                    foreach ($countries as $code => $name) {
                                        $selected = ($code === $selected_country) ? 'selected' : '';
                                        echo '<option value="' . esc_attr($code) . '" ' . $selected . '>' . esc_html($name) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-5 sm:pt-6"></div>

                        <!-- Address Title -->
                        <div>
                            <label for="address_title" class="block text-sm font-medium text-gray-700 mb-2">
                                Adresseetiket <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="address_title" name="address_title" required
                                value="<?php echo esc_attr($address_data['address_title'] ?? ''); ?>"
                                placeholder="f.eks. Hjem, Arbejde, Forældre"
                                class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base">
                            <!-- <p class="mt-2 text-xs text-gray-500">Give this address a name for easy identification</p> -->
                            <p class="mt-2 text-xs text-gray-500">Navngiv denne adresse for nem identifikation</p>
                        </div>

                        <!-- Additional Information -->
                        <div>
                            <label for="biographical_info" class="block text-sm font-medium text-gray-700 mb-2">
                                Øvrig information <span class="text-xs text-gray-500">(valgfrit)</span>
                            </label>
                            <textarea id="biographical_info" name="biographical_info" rows="3"
                                class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base resize-none"
                                placeholder="Leveringsinstruktioner, gate kode osv."><?php echo esc_textarea($address_data['additional_info'] ?? ''); ?></textarea>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div
                        class="flex flex-col-reverse sm:flex-row justify-center gap-3 mt-6 sm:mt-8 pt-6 border-t border-gray-200">
                        <a href="<?php echo home_url('/addresses'); ?>"
                            class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-6 py-3 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors text-gray-700 font-medium text-sm sm:text-base">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel
                        </a>
                        <button type="submit" name="save_address"
                            class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 bg-red-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-red-700 transition-colors shadow-sm text-sm sm:text-base">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <?php //echo $is_editing ? 'Update Address' : 'Save Address'; ?>
                            <?php echo $is_editing ? 'Opdater adresse' : 'Gem adresse'; ?>
                        </button>
                    </div>
                </form>

                <!-- Bottom Navigation -->
                <div class="flex flex-col sm:flex-row justify-center gap-3 mt-6 sm:mt-8">
                    <a href="<?= esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-gray-300 rounded-full bg-white hover:bg-gray-50 transition-colors text-gray-700 font-medium text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Account
                    </a>

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
    </div>
</div>

<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_address'])) {

    if (empty($_POST['billing_phone']) || empty($_POST['billing_mobile'])) {
        echo "<script>alert('Please provide both home phone and mobile phone number.');</script>";
    } else {

        // Get existing addresses
        $addresses = get_user_meta($current_user->ID, 'user_addresses', true);
        if (!is_array($addresses)) {
            $addresses = array();
        }

        // Create address data
        $address_data = array(
            'first_name' => sanitize_text_field($_POST['first_name']),
            'last_name' => sanitize_text_field($_POST['last_name']),
            'company' => sanitize_text_field($_POST['company']),
            'phone' => sanitize_text_field($_POST['billing_phone']),
            'mobile' => sanitize_text_field($_POST['billing_mobile']),
            'address_1' => sanitize_text_field($_POST['address_1']),
            'address_2' => sanitize_text_field($_POST['address_2']),
            'postcode' => sanitize_text_field($_POST['postcode']),
            'city' => sanitize_text_field($_POST['city']),
            'country' => sanitize_text_field($_POST['country']),
            'additional_info' => sanitize_textarea_field($_POST['biographical_info']),
            'address_title' => sanitize_text_field($_POST['address_title'])
        );

        // Check if editing or creating new
        if (isset($_POST['edit_id']) && isset($addresses[$_POST['edit_id']])) {
            // Update existing address
            $edit_id = sanitize_text_field($_POST['edit_id']);
            $address_data['created_at'] = $addresses[$edit_id]['created_at']; // Keep original creation time
            $address_data['updated_at'] = current_time('mysql'); // Add update time
            $addresses[$edit_id] = $address_data;
            $message = 'Address updated successfully!';
        } else {
            // Create new address
            $address_id = uniqid('addr_');
            $address_data['created_at'] = current_time('mysql');
            $addresses[$address_id] = $address_data;
            $message = 'Address saved successfully!';
        }

        // Save all addresses
        update_user_meta($current_user->ID, 'user_addresses', $addresses);

        echo "<script>alert('" . $message . "'); window.location.href = '" . home_url('/addresses') . "';</script>";
    }
}

get_footer();
?>