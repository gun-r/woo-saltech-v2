<?php
/*
 * Template Name: Contact Us Page
 */

// ===== DEBUG: PHP Error Reporting =====
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 1);

// ===== reCAPTCHA Configuration =====
$keys = mytheme_get_recaptcha_keys();
$recaptcha_site_key = $keys['site_key'];
$recaptcha_secret_key = $keys['secret_key'];

get_header();
?>

<div class="bg-gray-50 py-8 sm:py-12 lg:py-16 min-h-screen">
    <div class="mx-auto max-w-4xl px-4 sm:px-6">

        <!-- Page Header -->
        <div class="text-center mb-8 sm:mb-10">
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-2">Kontakt os</h1>
            <p class="text-sm sm:text-base text-gray-600">
                <!-- Get in touch with our team -->
                Kom i kontakt med vores team
            </p>
        </div>

        <!-- Success/Error Messages -->
        <?php if (isset($_GET['sent'])): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start gap-3">
                <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-green-800">Success!</p>
                    <p class="text-sm text-green-700">Your message has been sent successfully! We'll get back to you soon.
                    </p>
                </div>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <?php
            $error_messages = [
                'nonce' => 'Security verification failed. Please try again.',
                'empty' => 'Please fill in all required fields.',
                'send' => 'There was a problem sending your message. Please try again later.',
                'email' => 'Please enter a valid email address.',
                'recaptcha' => 'Security verification failed. Please try again.',
                'attachment' => 'File upload failed. Please check file format and size.'
            ];
            $error_key = sanitize_text_field($_GET['error']);
            $error_msg = $error_messages[$error_key] ?? 'An error occurred.';
            ?>
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3">
                <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-red-800">Error</p>
                    <p class="text-sm text-red-700"><?php echo esc_html($error_msg); ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Contact Information Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <!-- Email -->
            <div class="bg-white rounded-lg p-4 border border-gray-200 text-center">
                <div class="inline-flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full mb-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">E-mail</h3>
                <a href="mailto:support@sal-tech.com"
                    class="text-xs text-blue-600 hover:text-blue-700">support@sal-tech.com</a>
            </div>

            <!-- Phone -->
            <div class="bg-white rounded-lg p-4 border border-gray-200 text-center">
                <div class="inline-flex items-center justify-center w-10 h-10 bg-green-100 rounded-full mb-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Telefon</h3>
                <a href="tel:+4570272220" class="text-xs text-green-600 hover:text-green-700">+45 70272220</a>
            </div>

            <!-- Location -->
            <div class="bg-white rounded-lg p-4 border border-gray-200 text-center">
                <div class="inline-flex items-center justify-center w-10 h-10 bg-purple-100 rounded-full mb-3">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Lokation</h3>
                <p class="text-xs text-purple-600">Tinglev, Denmark</p>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 sm:p-8 lg:p-10">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-200">
                    <!-- Send us a Message -->
                    Send os en besked
                </h2>

                <form method="post" enctype="multipart/form-data"
                    action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="space-y-5 sm:space-y-6"
                    id="contact-form">

                    <!-- WordPress Admin Post Handler -->
                    <input type="hidden" name="action" value="send_contact_form">
                    <?php wp_nonce_field('contact_form_nonce'); ?>

                    <!-- Hidden reCAPTCHA token -->
                    <input type="hidden" id="token-contact" name="token">

                    <!-- Subject & Name Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                        <!-- Subject Heading -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Emne <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <select name="subject" required
                                    class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all text-sm sm:text-base bg-white">
                                    <!-- <option value="">-- Choose a subject --</option> -->
                                    <option value="">-- Vælg et emne --</option>
                                    <option value="Become Distributor">Become Distributor</option>
                                    <option value="Customer Service">Customer Service</option>
                                    <option value="Webmaster">Webmaster</option>
                                    <option value="General Inquiry">General Inquiry</option>
                                </select>
                            </div>
                        </div>

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Dit navn <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="name" required
                                    class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all text-sm sm:text-base"
                                    placeholder="John Doe">
                            </div>
                        </div>
                    </div>

                    <!-- Email & Order Reference Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                E-mailadresse <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="email" name="email" required
                                    class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all text-sm sm:text-base"
                                    placeholder="john@example.com">
                            </div>
                        </div>

                        <!-- Order Reference -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ordrereference <span class="text-xs text-gray-500">(Valgfrit)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <input type="text" name="order_ref"
                                    class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all text-sm sm:text-base"
                                    placeholder="Order #12345">
                            </div>
                        </div>
                    </div>

                    <!-- Message -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Din besked <span class="text-red-500">*</span>
                        </label>
                        <!-- <textarea name="message" required rows="6"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all text-sm sm:text-base resize-none"
                            placeholder="Tell us how we can help you..."></textarea>
                        <p class="mt-2 text-xs text-gray-500">Please provide as much detail as possible</p> -->
                        <textarea name="message" required rows="6"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all text-sm sm:text-base resize-none"
                            placeholder="Fortæl os, hvordan vi kan hjælpe dig..."></textarea>
                        <p class="mt-2 text-xs text-gray-500">Angiv så mange detaljer som muligt</p>
                    </div>

                    <!-- File Attachment -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Vedhæft fil <span class="text-xs text-gray-500">(valgfrit)</span>
                        </label>
                        <div class="relative">
                            <input type="file" name="attachment" id="file-upload"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent transition-all text-sm sm:text-base bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <!-- <p class="mt-2 text-xs text-gray-500">Accepted formats: PDF, JPG, PNG (Max 5MB)</p> -->
                        <p class="mt-2 text-xs text-gray-500">Accepterede formater: PDF, JPG, PNG (Maks. 5MB)</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col-reverse sm:flex-row justify-center gap-3 pt-6 border-t border-gray-200">
                        <a href="<?= esc_url(home_url('/')) ?>"
                            class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-6 py-3 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors text-gray-700 font-medium text-sm sm:text-base">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Annuller
                        </a>
                        <button type="submit"
                            class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors shadow-sm text-sm sm:text-base">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Send besked
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- reCAPTCHA script -->
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr($recaptcha_site_key); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Contact Page: DOM loaded, initializing reCAPTCHA...');

        // Initialize reCAPTCHA
        grecaptcha.ready(function () {
            console.log('Contact Page: reCAPTCHA ready');

            // Function to generate fresh token
            function refreshContactToken() {
                if (!document.getElementById('token-contact')) return;

                grecaptcha.execute('<?php echo esc_js($recaptcha_site_key); ?>', {
                    action: 'contact_form'
                }).then(function (token) {
                    console.log('Contact Page: Token refreshed');
                    document.getElementById('token-contact').value = token;
                }).catch(function (error) {
                    console.error('Contact Page: Error refreshing token:', error);
                });
            }

            // Generate initial token
            refreshContactToken();

            // Refresh token every 30 seconds
            setInterval(function () {
                console.log('Contact Page: Refreshing reCAPTCHA token...');
                refreshContactToken();
            }, 30000);

            // Also refresh token before form submission (just in case)
            document.getElementById('contact-form').addEventListener('submit', function () {
                refreshContactToken();
            });
        });
    });
</script>

<?php get_footer(); ?>