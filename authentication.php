<?php
/*
 * Template Name: Authentication
 */

// ===== DEBUG: PHP Error Reporting =====
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 1);

// ===== Mailchimp Configuration =====
$mailchimp = mytheme_get_mailchimp_config();
$mailchimp_api_key = $mailchimp['api_key'];
$mailchimp_list_id = $mailchimp['audience_id'];

// Mailchimp function to add user with tags
function add_user_to_mailchimp_with_tags($email, $first_name, $last_name, $api_key, $list_id, $tags = [])
{
    if (empty($tags) || empty($api_key) || $api_key === 'replace this') {
        return;
    }

    try {
        $data_center = substr($api_key, strpos($api_key, '-') + 1);
        $subscriber_hash = md5(strtolower($email));
        $url = "https://{$data_center}.api.mailchimp.com/3.0/lists/{$list_id}/members/{$subscriber_hash}";

        $memberData = [
            'email_address' => $email,
            'status_if_new' => 'subscribed',
            'status' => 'subscribed',
            'merge_fields' => [
                'FNAME' => $first_name,
                'LNAME' => $last_name
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($memberData));
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code >= 200 && $http_code < 300) {
            $tagsUrl = "https://{$data_center}.api.mailchimp.com/3.0/lists/{$list_id}/members/{$subscriber_hash}/tags";
            $tagData = ['tags' => []];

            foreach ($tags as $tag) {
                $tagData['tags'][] = ['name' => $tag, 'status' => 'active'];
            }

            $ch = curl_init($tagsUrl);
            curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($tagData));
            curl_exec($ch);
            curl_close($ch);
        }
    } catch (Exception $e) {
        // Handle exception if needed
    }
}

// ===== Age Validation Function =====
function is_user_18_or_older($birth_day, $birth_month, $birth_year)
{
    $birthdate = new DateTime("$birth_year-$birth_month-$birth_day");
    $today = new DateTime();
    $age = $today->diff($birthdate)->y;

    return $age >= 18;
}

// ===== Form Processing =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Determine which form was submitted
    $is_create_account = isset($_POST['user_email']) && !isset($_POST['user_password']);
    $is_complete_registration = isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_firstname']);
    $is_login = isset($_POST['log']) && isset($_POST['pwd']);

    if ($is_create_account) {
        // STEP 1: Email submission
        $email = sanitize_email($_POST['user_email']);

        if (email_exists($email)) {
            $register_message = "Denne e-mailadresse er allerede registreret.";
        } else {
            wp_redirect(add_query_arg('email', urlencode($email), get_permalink()) . '#complete-registration');
            exit;
        }
    } elseif ($is_complete_registration) {
        // STEP 2: Full registration
        $email = sanitize_email($_POST['user_email']);
        $password = sanitize_text_field($_POST['user_password']);
        $first_name = sanitize_text_field($_POST['user_firstname']);
        $last_name = sanitize_text_field($_POST['user_lastname']);

        $birth_day = sanitize_text_field($_POST['birth_day']);
        $birth_month = sanitize_text_field($_POST['birth_month']);
        $birth_year = sanitize_text_field($_POST['birth_year']);
        $birthdate = "$birth_year-$birth_month-$birth_day";

        if (!checkdate($birth_month, $birth_day, $birth_year)) {
            $register_message = "Indtast venligst en gyldig fødselsdato.";
        } elseif (!is_user_18_or_older($birth_day, $birth_month, $birth_year)) {
            $register_message = "Du skal være mindst 18 år for at oprette en konto.";
        } elseif (email_exists($email)) {
            $register_message = "Denne e-mailadresse er allerede registreret.";
        } else {
            $user_id = wp_create_user($email, $password, $email);

            if (!is_wp_error($user_id)) {
                update_user_meta($user_id, 'first_name', $first_name);
                update_user_meta($user_id, 'last_name', $last_name);
                update_user_meta($user_id, 'birthdate', $birthdate);

                if (!empty($_POST['user_title'])) {
                    update_user_meta($user_id, 'title', sanitize_text_field($_POST['user_title']));
                }

                $newsletter = isset($_POST['mc4wp-subscribe-newsletter']) ? 1 : 0;
                $offers = isset($_POST['mc4wp-subscribe-offers']) ? 1 : 0;
                update_user_meta($user_id, 'newsletter', $newsletter);
                update_user_meta($user_id, 'special_offers', $offers);

                wp_update_user([
                    'ID' => $user_id,
                    'display_name' => $first_name . ' ' . $last_name
                ]);

                // ===== MAILCHIMP INTEGRATION =====
                $mailchimp_tags = [];
                if ($newsletter === 1) {
                    $mailchimp_tags[] = 'Newsletter';
                }
                if ($offers === 1) {
                    $mailchimp_tags[] = 'Special Offers';
                }

                if (!empty($mailchimp_tags)) {
                    add_user_to_mailchimp_with_tags($email, $first_name, $last_name, $mailchimp_api_key, $mailchimp_list_id, $mailchimp_tags);
                }

                // ===== EMAIL VERIFICATION SETUP =====
                $verification_token = wp_generate_password(32, false);
                $expiry = time() + (24 * 60 * 60); // 24 hours

                update_user_meta($user_id, 'email_verification_token', $verification_token);
                update_user_meta($user_id, 'email_verification_expiry', $expiry);
                update_user_meta($user_id, 'email_verified', '0');

                $verification_url = add_query_arg([
                    'action' => 'verify_email',
                    'token' => $verification_token,
                    'user' => $user_id
                ], site_url());

                $subject = 'Bekræft din e-mailadresse - ' . get_bloginfo('name');

                $message = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bekræft din e-mailadresse</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff;">
                    <tr>
                        <td style="padding: 40px 40px 20px; text-align: center; border-bottom: 3px solid #3b82f6; background-color: #ffffff;">
                            <h1 style="margin: 0; color: #1f2937; font-size: 28px; font-weight: 600;">Velkommen til ' . get_bloginfo('name') . '!</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px; background-color: #ffffff;">
                            <p style="margin: 0 0 20px 0; color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Hej <strong style="font-weight: bold;">' . esc_html($first_name) . '</strong>,
                            </p>
                            <p style="margin: 0 0 20px 0; color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Tak for registreringen på ' . get_bloginfo('name') . '! For at færdiggøre din registrering og begynde at handle, skal du bekræfte din e-mailadresse.
                            </p>
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <table cellpadding="0" cellspacing="0" style="background-color: #3b82f6;">
                                            <tr>
                                                <td style="padding: 16px 40px; text-align: center;">
                                                    <a href="' . esc_url($verification_url) . '" style="color: #ffffff; text-decoration: none; font-weight: 600; font-size: 16px; display: block;">
                                                        Bekræft min e-mailadresse
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <p style="margin: 20px 0 0 0; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Eller kopiér og indsæt dette link i din browser:
                            </p>
                            <p style="margin: 12px 0 20px 0; padding: 12px; background-color: #f9fafb; border: 1px solid #e5e7eb; font-size: 13px; color: #3b82f6; word-wrap: break-word; overflow-wrap: break-word;">
                                ' . esc_url($verification_url) . '
                            </p>
                            <p style="margin: 20px 0 0 0; color: #9ca3af; font-size: 14px; line-height: 1.6;">
                                <strong style="font-weight: bold;">Bemærk:</strong> Dette link udløber om 24 timer.
                            </p>
                            <p style="margin: 20px 0 0 0; color: #9ca3af; font-size: 14px; line-height: 1.6;">
                                Hvis du ikke har oprettet en konto, kan du se bort fra denne e-mail.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px 40px; background-color: #f9fafb; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0; color: #6b7280; font-size: 14px; text-align: center; line-height: 1.6;">
                                Med venlig hilsen,<br>
                                <strong style="font-weight: bold; display: block; margin-top: 8px;">' . get_bloginfo('name') . '</strong>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';

                $headers = [
                    'Content-Type: text/html; charset=UTF-8',
                    'From: ' . get_bloginfo('name') . ' <noreply@' . wp_parse_url(home_url(), PHP_URL_HOST) . '>'
                ];

                wp_mail($email, $subject, $message, $headers);

                wp_redirect(add_query_arg('registered', '1', site_url('/resend-verification')));
                exit;
            } else {
                $register_message = "Der opstod en fejl ved oprettelse af kontoen. Prøv venligst igen.";
            }
        }
    } elseif ($is_login) {
        // LOGIN
        $login_email = sanitize_email($_POST['log']);
        $login_password = $_POST['pwd'];

        $user_exists = get_user_by('email', $login_email);

        if (!$user_exists) {
            $login_message = "Der blev ikke fundet nogen konto med denne e-mailadresse.";
        } else {
            if (!wp_check_password($login_password, $user_exists->user_pass, $user_exists->ID)) {
                $login_message = "Ugyldig adgangskode. Prøv venligst igen.";
            } else {
                $is_verified = get_user_meta($user_exists->ID, 'email_verified', true);

                if ($is_verified !== '1') {
                    setcookie('unverified_email', $user_exists->user_email, time() + 300, '/');
                    $login_message = "__EMAIL_NOT_VERIFIED__";
                } else {
                    wp_set_current_user($user_exists->ID);
                    wp_set_auth_cookie($user_exists->ID, true);

                    do_action('wp_login', $user_exists->user_login, $user_exists);

                    setcookie('user_just_logged_in', '1', time() + 10, '/', '', false, false);

                    if (in_array('administrator', (array) $user_exists->roles)) {
                        wp_redirect(admin_url());
                    } else {
                        wp_redirect(home_url('/'));
                    }
                    exit;
                }
            }
        }
    }
}

get_header();
$email_prefill = isset($_GET['email']) ? sanitize_email($_GET['email']) : '';
?>

<div class="bg-gray-50 py-8 sm:py-12 lg:py-16 min-h-screen">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <?php if (empty($_GET['email'])): ?>
            <!-- Step 1: Login & Create Account -->
            <div class="text-center mb-8 sm:mb-10">
                <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-2">
                    Velkommen
                </h1>
                <p class="text-sm sm:text-base text-gray-600">
                    Log ind på din konto eller opret en ny.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 max-w-5xl mx-auto">

                <!-- Create Account -->
                <div class="bg-white p-6 sm:p-8 lg:p-10 rounded-xl sm:rounded-2xl shadow-sm border border-gray-200" id="create-account">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">
                                Opret konto
                            </h2>
                            <p class="text-xs sm:text-sm text-gray-600">
                                Indtast din e-mailadresse for at komme i gang
                            </p>
                        </div>
                    </div>

                    <?php if (!empty($register_message)): ?>
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg flex items-start gap-2">
                            <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm text-red-700 font-medium">Fejl</p>
                                <p class="text-xs text-red-600 mt-1"><?php echo esc_html($register_message); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="post" action="" class="space-y-5" id="create-account-form">
                        <input type="hidden" name="form_type" value="create_account">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                E-mailadresse <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="email" name="user_email" required class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base" placeholder="your@email.com">
                            </div>
                        </div>

                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-red-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-700 transition-colors shadow-sm">
                            <span>Fortsæt</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Login -->
                <div class="bg-white p-6 sm:p-8 lg:p-10 rounded-xl sm:rounded-2xl shadow-sm border border-gray-200">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Log ind</h2>
                            <p class="text-xs sm:text-sm text-gray-600">Velkommen tilbage!</p>
                        </div>
                    </div>

                    <?php if (!empty($login_message)): ?>
                        <?php if ($login_message === '__EMAIL_NOT_VERIFIED__'): ?>
                            <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="flex-1">
                                        <h3 class="text-yellow-800 font-semibold text-sm mb-1">E-mail ikke bekræftet</h3>
                                        <p class="text-yellow-700 text-sm">Bekræft venligst din e-mailadresse, før du logger ind.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-sm text-red-700 font-medium">Fejl</p>
                                    <p class="text-xs text-red-600 mt-1"><?php echo esc_html($login_message); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <form method="post" action="" class="space-y-5" id="login-form">
                        <input type="hidden" name="form_type" value="login">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                E-mailadresse <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="log" required class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base" placeholder="your@email.com">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Adgangskode <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="pwd" required class="w-full px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-transparent transition-all text-sm sm:text-base">
                        </div>

                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-gray-900 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-800 transition-colors shadow-sm">
                            <span>Log ind</span>
                        </button>
                    </form>
                </div>

            </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>