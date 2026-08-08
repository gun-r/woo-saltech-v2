<?php
/*
Template Name: Reset Password
*/

// ===== reCAPTCHA Configuration =====
$keys = mytheme_get_recaptcha_keys();
$recaptcha_site_key = $keys['site_key'];
$recaptcha_secret_key = $keys['secret_key'];

$login = $_GET['login'] ?? '';
$key   = $_GET['key']   ?? '';

$errors = [];
$success = false;
$error = '';

// ===== reCAPTCHA Validation Function =====
function validate_recaptcha_reset_password($token)
{
    global $recaptcha_secret_key;

    if (empty($token)) {
        // ===== DEBUG: reCAPTCHA token missing logging =====
        // error_log('reCAPTCHA Reset Password: No token provided');
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
    $debug_log = WP_CONTENT_DIR . '/debug-recaptcha-reset-password.log';
    $log_message = "=== reCAPTCHA Reset Password Validation " . date('Y-m-d H:i:s') . " ===\n";
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

// Validate reset link parameters first
if (empty($login) || empty($key)) {
    $errors[] = "Invalid reset link. Please make sure you're using the complete link from your email.";
}

// handle submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ===== DEBUG: Form submission logging =====
    /*
    $debug_log = WP_CONTENT_DIR . '/debug-recaptcha-reset-password.log';
    $log_message = "=== Reset Password Submission " . date('Y-m-d H:i:s') . " ===\n";
    $log_message .= "Site Key: " . substr($recaptcha_site_key, 0, 10) . "...\n";
    $log_message .= "Secret Key: " . substr($recaptcha_secret_key, 0, 10) . "...\n";
    $log_message .= "Token: " . (isset($_POST['token']) ? substr($_POST['token'], 0, 50) . '...' : 'NOT SET') . "\n";
    $log_message .= "Login: " . $login . "\n";
    $log_message .= "Key: " . substr($key, 0, 20) . "...\n";
    file_put_contents($debug_log, $log_message, FILE_APPEND);
    */

    // Validate reCAPTCHA first
    $token = $_POST['token'] ?? '';
    $recaptcha_response = validate_recaptcha_reset_password($token);

    if ($recaptcha_response['success'] == true) {
        $score = $recaptcha_response['score'] ?? 1.0;

        // ===== DEBUG: reCAPTCHA score logging =====
        // error_log('Reset Password reCAPTCHA Score: ' . $score);

        if ($score >= 0.7) {
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];

            if (!$pass1 || !$pass2) {
                $errors[] = "Please fill out both password fields.";
            } elseif ($pass1 !== $pass2) {
                $errors[] = "Passwords do not match.";
            } elseif (strlen($pass1) < 5) {
                $errors[] = "Password must be at least 5 characters long.";
            } else {
                $user = check_password_reset_key($key, $login);

                if (is_wp_error($user)) {
                    $errors[] = "The reset link is invalid or expired. Please request a new password reset.";
                } else {
                    reset_password($user, $pass1);
                    $success = true;

                    // Clear any session data
                    wp_clear_auth_cookie();
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
                <?php if ($success): ?>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Password Updated!</h1>
                    <p class="text-sm text-gray-600">
                        Your password has been successfully reset. You may now login with your new password.
                    </p>
                <?php else: ?>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Reset Your Password</h1>
                    <p class="text-sm text-gray-600">
                        Create a new password for your account
                    </p>
                    <p class="text-xs text-red-600 mt-2">
                        <span class="inline-flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Password must be at least 5 characters long
                        </span>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Success/Error Messages -->
            <?php if (!empty($error)): ?>
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

            <?php if (!empty($errors) && !$success): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-red-800">Error</p>
                        <div class="text-sm text-red-700 space-y-1">
                            <?php foreach ($errors as $err): ?>
                                <p><?php echo esc_html($err); ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <!-- Success Content -->
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-green-200 overflow-hidden">
                    <div class="p-8 text-center">
                        <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Password Successfully Reset</h3>
                        <p class="text-gray-600 mb-8">
                            Your password has been updated. You can now log in with your new credentials.
                        </p>

                        <div class="space-y-4">
                            <a href="<?= esc_url(home_url('/authentication')) ?>"
                                class="inline-flex items-center justify-center w-full gap-2 bg-red-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-700 transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Go to Login
                            </a>

                            <a href="<?= esc_url(home_url('/')) ?>"
                                class="inline-flex items-center justify-center w-full gap-2 px-6 py-3 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors text-gray-700 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Return Home
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Reset Password Form -->
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <form method="post" class="p-6 sm:p-8" id="reset-password-form">
                        <!-- Hidden reCAPTCHA token -->
                        <input type="hidden" id="token-reset-password" name="token">

                        <!-- Hidden reset parameters -->
                        <input type="hidden" name="login" value="<?php echo esc_attr($login); ?>">
                        <input type="hidden" name="key" value="<?php echo esc_attr($key); ?>">

                        <div class="space-y-6">

                            <!-- New Password -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    New Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input type="password" name="pass1" required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all text-base"
                                        placeholder="Enter new password"
                                        minlength="5">
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    Must be at least 5 characters long
                                </p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Confirm New Password <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input type="password" name="pass2" required
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all text-base"
                                        placeholder="Confirm new password"
                                        minlength="5">
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    Re-enter your new password to confirm
                                </p>
                            </div>

                            <!-- Password Strength Indicator -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-900 mb-2">Password Requirements</h4>
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        At least 5 characters
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Use a combination of letters and numbers
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Avoid common passwords
                                    </li>
                                </ul>
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
                                    Update Password
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
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- reCAPTCHA script -->
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr($recaptcha_site_key); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Reset Password Page: DOM loaded, initializing reCAPTCHA...');

        // Only initialize if form exists
        if (document.getElementById('reset-password-form')) {
            // Initialize reCAPTCHA
            grecaptcha.ready(function() {
                console.log('Reset Password Page: reCAPTCHA ready');

                // Function to generate fresh token
                function refreshResetPasswordToken() {
                    if (!document.getElementById('token-reset-password')) return;

                    grecaptcha.execute('<?php echo esc_js($recaptcha_site_key); ?>', {
                        action: 'reset_password'
                    }).then(function(token) {
                        console.log('Reset Password Page: Token refreshed');
                        document.getElementById('token-reset-password').value = token;
                    }).catch(function(error) {
                        console.error('Reset Password Page: Error refreshing token:', error);
                    });
                }

                // Generate initial token
                refreshResetPasswordToken();

                // Refresh token every 30 seconds
                setInterval(function() {
                    console.log('Reset Password Page: Refreshing reCAPTCHA token...');
                    refreshResetPasswordToken();
                }, 30000);

                // Refresh token before form submission (just in case)
                document.getElementById('reset-password-form').addEventListener('submit', function() {
                    refreshResetPasswordToken();
                });
            });
        }
    });
</script>

<?php get_footer(); ?>