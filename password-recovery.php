<?php
/*
Template Name: Forgot Password
*/

// ===== reCAPTCHA Configuration =====
$keys = mytheme_get_recaptcha_keys();
$recaptcha_site_key = $keys['site_key'];
$recaptcha_secret_key = $keys['secret_key'];

$success = '';
$error = '';

// ===== reCAPTCHA Validation Function =====
function validate_recaptcha_forgot_password($token)
{
    global $recaptcha_secret_key;

    if (empty($token)) {
        // ===== DEBUG: reCAPTCHA token missing logging =====
        // error_log('reCAPTCHA Forgot Password: No token provided');
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
    $debug_log = WP_CONTENT_DIR . '/debug-recaptcha-forgot-password.log';
    $log_message = "=== reCAPTCHA Forgot Password Validation " . date('Y-m-d H:i:s') . " ===\n";
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

    file_put_contents($debug_log, $log_message, FILE_APPEND);
    */
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ===== DEBUG: Form submission logging =====
    /*
    $debug_log = WP_CONTENT_DIR . '/debug-recaptcha-forgot-password.log';
    $log_message = "=== Forgot Password Submission " . date('Y-m-d H:i:s') . " ===\n";
    $log_message .= "Site Key: " . substr($recaptcha_site_key, 0, 10) . "...\n";
    $log_message .= "Secret Key: " . substr($recaptcha_secret_key, 0, 10) . "...\n";
    $log_message .= "Token: " . (isset($_POST['token']) ? substr($_POST['token'], 0, 50) . '...' : 'NOT SET') . "\n";
    $log_message .= "Email: " . (isset($_POST['user_email']) ? $_POST['user_email'] : 'NOT SET') . "\n";
    file_put_contents($debug_log, $log_message, FILE_APPEND);
    */

    // Validate reCAPTCHA first
    $token = $_POST['token'] ?? '';
    $recaptcha_response = validate_recaptcha_forgot_password($token);

    if ($recaptcha_response['success'] == true) {
        $score = $recaptcha_response['score'] ?? 1.0;

        // ===== DEBUG: reCAPTCHA score logging =====
        // error_log('Forgot Password reCAPTCHA Score: ' . $score);

        if ($score >= 0.7) {
            $email = sanitize_email($_POST['user_email']);

            if (!is_email($email)) {
                $error = "Please enter a valid email address.";
            } else {
                $user = get_user_by('email', $email);

                // We will not reveal "email not found"
                if ($user) {
                    $reset_sent = retrieve_password($user->user_login);

                    if ($reset_sent) {
                        $success = "If that email exists, a reset link has been sent.";
                    } else {
                        $error = "Unable to process the request right now.";
                    }
                } else {
                    $success = "If that email exists, a reset link has been sent.";
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

get_header();
?>

<div class="bg-gray-50 py-8 sm:py-12 lg:py-16 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">

            <!-- Page Header -->
            <div class="mb-8 text-center">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Forgot Password</h1>
                <p class="text-sm text-gray-600">
                    Please enter the email address you used to register. We will send you a password reset link.
                </p>
            </div>

            <!-- Success/Error Messages -->
            <?php if (!empty($success)): ?>
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-green-800">Success!</p>
                        <p class="text-sm text-green-700"><?php echo esc_html($success); ?></p>
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
                        <p class="text-sm font-medium text-red-800">Error</p>
                        <p class="text-sm text-red-700"><?php echo esc_html($error); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Form Container -->
            <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <form method="post" class="p-6 sm:p-8" id="forgot-password-form">
                    <!-- Hidden reCAPTCHA token -->
                    <input type="hidden" id="token-forgot-password" name="token">

                    <div class="space-y-6">

                        <!-- Email Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email address <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="email" name="user_email" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all text-base"
                                    placeholder="john@example.com"
                                    value="<?php echo isset($_POST['user_email']) ? esc_attr($_POST['user_email']) : ''; ?>">
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                Enter the email address associated with your account.
                            </p>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col-reverse sm:flex-row justify-center gap-3 mt-8 pt-6 border-t border-gray-200">
                            <a href="<?= esc_url(home_url('/authentication')) ?>"
                                class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-6 py-3 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors text-gray-700 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </a>
                            <button type="submit"
                                class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 bg-red-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-red-700 transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Bottom Navigation -->
            <div class="flex flex-col sm:flex-row justify-center gap-3 mt-8">
                <a href="<?= esc_url(home_url('/authentication')) ?>"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-gray-300 rounded-full bg-white hover:bg-gray-50 transition-colors text-gray-700 font-medium text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Login
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

            <!-- Help Text -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">
                    Having trouble?
                    <a href="<?= esc_url(home_url('/contact')) ?>" class="text-red-600 hover:text-red-700 font-medium">
                        Contact our support team
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- reCAPTCHA script -->
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr($recaptcha_site_key); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Forgot Password Page: DOM loaded, initializing reCAPTCHA...');

        // Initialize reCAPTCHA
        grecaptcha.ready(function() {
            console.log('Forgot Password Page: reCAPTCHA ready');

            // Function to generate fresh token
            function refreshForgotPasswordToken() {
                if (!document.getElementById('token-forgot-password')) return;

                grecaptcha.execute('<?php echo esc_js($recaptcha_site_key); ?>', {
                    action: 'forgot_password'
                }).then(function(token) {
                    console.log('Forgot Password Page: Token refreshed');
                    document.getElementById('token-forgot-password').value = token;
                }).catch(function(error) {
                    console.error('Forgot Password Page: Error refreshing token:', error);
                });
            }

            // Generate initial token
            refreshForgotPasswordToken();

            // Refresh token every 30 seconds
            setInterval(function() {
                console.log('Forgot Password Page: Refreshing reCAPTCHA token...');
                refreshForgotPasswordToken();
            }, 30000);

            // Also refresh token before form submission (just in case)
            document.getElementById('forgot-password-form').addEventListener('submit', function() {
                refreshForgotPasswordToken();
            });
        });
    });
</script>

<?php get_footer(); ?>