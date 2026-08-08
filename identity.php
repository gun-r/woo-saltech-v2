<?php
/*
 * Template Name: Identity Page
 */

// ===== DEBUG: PHP Error Reporting =====
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 1);

// ===== reCAPTCHA Configuration =====
$keys = mytheme_get_recaptcha_keys();
$recaptcha_site_key = $keys['site_key'];
$recaptcha_secret_key = $keys['secret_key'];

// Redirect non-logged-in users to authentication
if (!is_user_logged_in()) {
    wp_redirect(home_url('/authentication'));
    exit;
}

$current_user = wp_get_current_user();
$success = '';
$error = '';

// ===== reCAPTCHA Validation Function =====
function validate_recaptcha_identity($token)
{
    global $recaptcha_secret_key;

    if (empty($token)) {
        // ===== DEBUG: reCAPTCHA token missing logging =====
        // error_log('reCAPTCHA Identity: No token provided');
        return ['success' => false, 'error-codes' => ['missing-input-response']];
    }

    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $recaptcha_secret_key,
        'response' => $token,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    $res = json_decode($response, true);

    if ($res === null) {
        $res = ['success' => false, 'error-codes' => ['json-decode-error']];
    }

    return $res;

    // ===== DEBUG: reCAPTCHA validation logging =====
    /*
    $debug_log = WP_CONTENT_DIR . '/debug-recaptcha-identity.log';
    $log_message = "=== reCAPTCHA Identity Validation " . date('Y-m-d H:i:s') . " ===\n";
    $log_message .= "Token length: " . strlen($token) . "\n";
    $log_message .= "HTTP Code: " . $http_code . "\n";

    if ($error) {
        $log_message .= "cURL Error: " . $error . "\n";
    }

    if ($res === null) {
        $log_message .= "JSON Error: " . json_last_error_msg() . "\n";
        $log_message .= "Raw response: " . $response . "\n";
    } else {
        $log_message .= "Success: " . ($res['success'] ? 'YES' : 'NO') . "\n";
        if (isset($res['score'])) {
            $log_message .= "Score: " . $res['score'] . "\n";
        }
        if (isset($res['error-codes'])) {
            $log_message .= "Errors: " . implode(', ', $res['error-codes']) . "\n";
        }
        if (isset($res['hostname'])) {
            $log_message .= "Hostname: " . $res['hostname'] . "\n";
        }
    }

    $log_message .= "User ID: " . (isset($GLOBALS['current_user']) ? $GLOBALS['current_user']->ID : 'unknown') . "\n";
    $log_message .= "User Email: " . (isset($GLOBALS['current_user']) ? $GLOBALS['current_user']->user_email : 'unknown') . "\n";

    file_put_contents($debug_log, $log_message, FILE_APPEND);
    */
}

//Add or update Mailchimp member
function mailchimp_upsert_member_full($email, $first_name, $last_name, $newsletter, $offers)
{
    $mailchimp = mytheme_get_mailchimp_config();
    $api_key = $mailchimp['api_key']; //mailchimp api key
    $list_id = $mailchimp['audience_id']; //mailchimp audience id

    if (empty($api_key) || empty($list_id)) {
        // ===== DEBUG: Mailchimp configuration error =====
        // error_log('Mailchimp not configured properly.');
        return false;
    }

    $dc = substr($api_key, strpos($api_key, '-') + 1);
    $member_id = md5(strtolower($email));
    $url = "https://{$dc}.api.mailchimp.com/3.0/lists/{$list_id}/members/{$member_id}";

    $subscribe_status = ($newsletter || $offers) ? 'subscribed' : 'unsubscribed';

    $payload = [
        'email_address' => $email,
        'status_if_new' => $subscribe_status,
        'status' => $subscribe_status,
        'merge_fields' => [
            'FNAME' => $first_name,
            'LNAME' => $last_name,
        ],
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, wp_json_encode($payload));
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);

    if ($info['http_code'] >= 400) {
        // ===== DEBUG: Mailchimp API error =====
        // error_log('Mailchimp upsert failed.');
        return false;
    }

    // Handle tags (Newsletter / Special Offers)
    $tags_url = "https://{$dc}.api.mailchimp.com/3.0/lists/{$list_id}/members/{$member_id}/tags";
    $tags_payload = [
        'tags' => [
            ['name' => 'Newsletter', 'status' => $newsletter ? 'active' : 'inactive'],
            ['name' => 'Special Offers', 'status' => $offers ? 'active' : 'inactive'],
        ]
    ];

    $ch = curl_init($tags_url);
    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, wp_json_encode($tags_payload));
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch);
    curl_close($ch);

    return true;
}

//Fetch Mailchimp tags for an email
function mailchimp_get_tags($email)
{
    $mailchimp = mytheme_get_mailchimp_config();
    $api_key = $mailchimp['api_key']; //mailchimp api key
    $list_id = $mailchimp['audience_id']; //mailchimp audience id
    $dc = substr($api_key, strpos($api_key, '-') + 1);
    $member_id = md5(strtolower($email));
    $url = "https://{$dc}.api.mailchimp.com/3.0/lists/{$list_id}/members/{$member_id}/tags";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    $tags = [];

    if (!empty($data['tags'])) {
        foreach ($data['tags'] as $tag) {
            $tags[] = $tag['name'];
        }
    }

    return $tags;
}

//Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ===== DEBUG: Form submission logging =====
    /*
    $debug_log = WP_CONTENT_DIR . '/debug-recaptcha-identity.log';
    $log_message = "=== Identity Page Submission " . date('Y-m-d H:i:s') . " ===\n";
    $log_message .= "Site Key: " . substr($recaptcha_site_key, 0, 10) . "...\n";
    $log_message .= "Secret Key: " . substr($recaptcha_secret_key, 0, 10) . "...\n";
    $log_message .= "Token: " . (isset($_POST['token']) ? substr($_POST['token'], 0, 50) . '...' : 'NOT SET') . "\n";
    $log_message .= "User ID: " . $current_user->ID . "\n";
    $log_message .= "User Email: " . $current_user->user_email . "\n";
    $log_message .= "POST Data: " . print_r([
        'first_name' => isset($_POST['first_name']) ? 'SET' : 'NOT SET',
        'last_name' => isset($_POST['last_name']) ? 'SET' : 'NOT SET',
        'email' => isset($_POST['email']) ? 'SET' : 'NOT SET',
        'has_current_pass' => isset($_POST['current_password']) ? 'YES' : 'NO',
        'has_new_pass' => isset($_POST['new_password']) ? 'YES' : 'NO',
        'newsletter' => isset($_POST['mc4wp-subscribe']) ? 'YES' : 'NO',
        'offers' => isset($_POST['offers']) ? 'YES' : 'NO',
    ], true) . "\n";

    file_put_contents($debug_log, $log_message, FILE_APPEND);
    */

    check_admin_referer('update_identity_form', 'identity_nonce');

    // Validate reCAPTCHA first
    $token = $_POST['token'] ?? '';
    $recaptcha_response = validate_recaptcha_identity($token);

    if ($recaptcha_response['success'] == true) {
        $score = $recaptcha_response['score'] ?? 1.0;

        // ===== DEBUG: reCAPTCHA score logging =====
        // error_log('Identity reCAPTCHA Score: ' . $score);

        if ($score >= 0.7) {
            $first_name = sanitize_text_field($_POST['first_name']);
            $last_name = sanitize_text_field($_POST['last_name']);
            $email = sanitize_email($_POST['email']);
            $current_pass = $_POST['current_password'];
            $new_pass = sanitize_text_field($_POST['new_password']);
            $confirm_pass = sanitize_text_field($_POST['confirm_password']);
            $newsletter = isset($_POST['mc4wp-subscribe']) ? 1 : 0;
            $offers = isset($_POST['offers']) ? 1 : 0;

            if (!wp_check_password($current_pass, $current_user->user_pass, $current_user->ID)) {
                $error = 'Current password is incorrect.';
            } else {
                if (empty($first_name) || empty($last_name) || empty($email)) {
                    $error = 'Please fill out all required fields.';
                } else {
                    $userdata = [
                        'ID' => $current_user->ID,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'user_email' => $email,
                        'display_name' => $first_name . ' ' . $last_name,
                    ];

                    if (!empty($new_pass)) {
                        if ($new_pass === $confirm_pass) {
                            $userdata['user_pass'] = $new_pass;
                        } else {
                            $error = 'New password and confirmation do not match.';
                        }
                    }

                    if (empty($error)) {
                        $update = wp_update_user($userdata);

                        if (is_wp_error($update)) {
                            $error = 'Error updating account information.';
                        } else {
                            update_user_meta($current_user->ID, 'newsletter', $newsletter);
                            update_user_meta($current_user->ID, 'special_offers', $offers);

                            // Sync with Mailchimp
                            mailchimp_upsert_member_full($email, $first_name, $last_name, $newsletter, $offers);

                            wp_redirect(add_query_arg('updated', 'true', home_url('/identity')));
                            exit;
                        }
                    }
                }
            }
        } else {
            $error = "Security verification failed (score: " . number_format($score, 2) . "). Please try again.";
        }
    } else {
        $error = "Security verification failed. Please try again.";
        if (isset($recaptcha_response['error-codes'])) {
            $error .= " Error: " . implode(', ', $recaptcha_response['error-codes']);
        }
    }
}

// Fetch Mailchimp tags to pre-check the boxes
$mailchimp_tags = mailchimp_get_tags($current_user->user_email);
$newsletter_checked = in_array('Newsletter', $mailchimp_tags) ? 1 : get_user_meta($current_user->ID, 'newsletter', true);
$offers_checked = in_array('Special Offers', $mailchimp_tags) ? 1 : get_user_meta($current_user->ID, 'special_offers', true);

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
                        <!-- Personal Information -->
                        Personlig information
                    </h1>
                    <p class="text-sm text-gray-600">
                        <!-- Update your account details and preferences -->
                        Update your account details and preferences
                    </p>
                    <p class="text-xs text-red-600 mt-2">
                        <span class="inline-flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <!-- Fields marked with * are required -->
                            Felter markeret med * er obligatorisk
                        </span>
                    </p>
                </div>

                <!-- Success/Error Messages -->
                <?php if (isset($_GET['updated']) && $_GET['updated'] === 'true'): ?>
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <!-- <p class="text-sm font-medium text-green-800">Success!</p>
                            <p class="text-sm text-green-700">Your account information has been updated successfully.</p> -->
                            <p class="text-sm font-medium text-green-800">Opdatering gennemført!
                            </p>
                            <p class="text-sm text-green-700">Dine kontooplysninger er blevet opdateret.</p>
                        </div>
                    </div>
                <?php elseif (!empty($error)): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-red-800">Fejl</p>
                            <p class="text-sm text-red-700"><?php echo esc_html($error); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Form Container -->
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <form method="post" class="p-4 sm:p-6 lg:p-8" id="identity-form">
                        <?php wp_nonce_field('update_identity_form', 'identity_nonce'); ?>

                        <!-- Hidden reCAPTCHA token -->
                        <input type="hidden" id="token-identity" name="token">

                        <div class="space-y-5 sm:space-y-6">

                            <!-- Personal Details Section -->
                            <div>
                                <h2
                                    class="text-base sm:text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                    Personlige detaljer
                                </h2>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                                    <!-- First Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Fornavn <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="first_name"
                                            value="<?php echo esc_attr($current_user->first_name); ?>" required
                                            class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                            placeholder="John">
                                    </div>

                                    <!-- Last Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Efternavn <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="last_name"
                                            value="<?php echo esc_attr($current_user->last_name); ?>" required
                                            class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                            placeholder="Doe">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="mt-4 sm:mt-5">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        E-mailadresse <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <input type="email" name="email"
                                            value="<?php echo esc_attr($current_user->user_email); ?>" required
                                            class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                            placeholder="john@example.com">
                                    </div>
                                </div>
                            </div>

                            <!-- Password Section -->
                            <div>
                                <h2
                                    class="text-base sm:text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                    Adgangskode & sikkerhed </h2>

                                <!-- Current Password -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nuværende adgangskode <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <input type="password" name="current_password" required
                                            class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                            placeholder="Indtast nuværende adgangskode">
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Påkrævet for at bekræfte din identitet</p>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 mt-4 sm:mt-5">
                                    <!-- New Password -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Ny adgangskode <span class="text-xs text-gray-500">(valgfrit)</span>
                                        </label>
                                        <input type="password" name="new_password"
                                            class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                            placeholder="Efterlad blank for at beholde nuværende">
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Bekræft ny adgangskode
                                        </label>
                                        <input type="password" name="confirm_password"
                                            class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base"
                                            placeholder="Bekræft ny adgangskode">
                                    </div>
                                </div>
                            </div>

                            <!-- Preferences Section -->
                            <div>
                                <h2
                                    class="text-base sm:text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                                    <!-- Email Preferences -->
                                    E-mail præferencer
                                </h2>

                                <div class="space-y-3 bg-gray-50 p-4 rounded-lg">
                                    <label class="flex items-start gap-3 cursor-pointer group">
                                        <input type="checkbox" name="mc4wp-subscribe" <?php checked($newsletter_checked, 1); ?>
                                            class="mt-0.5 h-5 w-5 text-red-600 border-gray-300 rounded focus:ring-red-500 cursor-pointer">
                                        <div class="flex-1">
                                            <span
                                                class="text-sm font-medium text-gray-900 group-hover:text-red-600 transition-colors">
                                                <!-- Subscribe to newsletter -->
                                                Tilmeld nyhedsbrev
                                            </span>
                                            <p class="text-xs text-gray-600 mt-1">
                                                <!-- Get the latest updates, news, and exclusive content -->
                                                Få seneste opdateringer, nyheder og eksklusivt indhold
                                            </p>
                                        </div>
                                    </label>

                                    <label class="flex items-start gap-3 cursor-pointer group">
                                        <input type="checkbox" name="offers" <?php checked($offers_checked, 1); ?>
                                            class="mt-0.5 h-5 w-5 text-red-600 border-gray-300 rounded focus:ring-red-500 cursor-pointer">
                                        <div class="flex-1">
                                            <span
                                                class="text-sm font-medium text-gray-900 group-hover:text-red-600 transition-colors">
                                                <!-- Receive special offers -->
                                                Modtag specielle tilbud
                                            </span>
                                            <p class="text-xs text-gray-600 mt-1">
                                                <!-- Get exclusive deals and promotions from our partners -->
                                                Modtag eksklusive deals og tilbud fra vores partnere
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div
                            class="flex flex-col-reverse sm:flex-row justify-center gap-3 mt-6 sm:mt-8 pt-6 border-t border-gray-200">
                            <a href="<?= esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"
                                class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-6 py-3 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors text-gray-700 font-medium text-sm sm:text-base">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <!-- Cancel -->
                                Annuller
                            </a>
                            <button type="submit"
                                class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 bg-red-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-red-700 transition-colors shadow-sm text-sm sm:text-base">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <!-- Save Changes -->
                                Behold ændringer
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Bottom Navigation -->
                <div class="flex flex-col sm:flex-row justify-center gap-3 mt-6 sm:mt-8">
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

<!-- reCAPTCHA script -->
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr($recaptcha_site_key); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Identity Page: DOM loaded, initializing reCAPTCHA...');

        // Initialize reCAPTCHA
        grecaptcha.ready(function () {
            console.log('Identity Page: reCAPTCHA ready');

            // Function to generate fresh token for identity form
            function refreshIdentityToken() {
                if (!document.getElementById('token-identity')) return;

                grecaptcha.execute('<?php echo esc_js($recaptcha_site_key); ?>', {
                    action: 'identity_update'
                }).then(function (token) {
                    console.log('Identity Page: Token refreshed');
                    document.getElementById('token-identity').value = token;
                }).catch(function (error) {
                    console.error('Identity Page: Error refreshing token:', error);
                });
            }

            // Generate initial token
            refreshIdentityToken();

            // Refresh token every 30 seconds
            setInterval(function () {
                console.log('Identity Page: Refreshing reCAPTCHA token...');
                refreshIdentityToken();
            }, 30000);

            // Also refresh token before form submission (just in case)
            document.getElementById('identity-form').addEventListener('submit', function () {
                refreshIdentityToken();
            });
        });
    });
</script>

<?php get_footer(); ?>