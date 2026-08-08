<?php /* Template Name: Route */ ?>
<?php get_header(); ?>

<div class="bg-gray-50 py-8 sm:py-12 lg:py-16 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        <!-- Page Header -->
        <div class="text-center mb-8 sm:mb-10">
            <!-- Our Location -->
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-2">Vores adresse</h1>
            <!-- Visit us or get in touch with our team -->
            <p class="text-sm sm:text-base text-gray-600">Besøg os, eller kontakt vores team</p>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            <!-- Map Section -->
            <div class="relative w-full h-64 sm:h-96 lg:h-[500px] bg-gray-200">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2293.6568800171913!2d9.198306176689782!3d54.90894437278352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b3589d1a59e501%3A0xb79a94ecf186c3c9!2sSal-Tech%20Easy%20Packaging!5e0!3m2!1sen!2sph!4v1762361560492!5m2!1sen!2sph"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    class="absolute inset-0 w-full h-full border-0">
                </iframe>
            </div>

            <!-- Store Information -->
            <div class="p-6 sm:p-8 lg:p-10">

                <!-- Contact Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">

                    <!-- Address Card -->
                    <div class="p-5 bg-gradient-to-br from-red-50 to-orange-50 rounded-xl border border-red-200">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25a7.75 7.75 0 00-7.75 7.75c0 4.106 3.193 8.086 6.106 10.708a2.25 2.25 0 003.288 0C16.557 18.086 19.75 14.106 19.75 10A7.75 7.75 0 0012 2.25zm0 10.25a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <!-- Address -->
                                <p class="text-xs font-semibold text-red-600 uppercase tracking-wide mb-2">Adresse</p>
                                <div class="text-sm text-gray-900 leading-relaxed">
                                    Eggebækvej 10<br>
                                    6360 Tinglev<br>
                                    Denmark
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="p-5 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M1.5 8.67v8.58A2.25 2.25 0 003.75 19.5h16.5a2.25 2.25 0 002.25-2.25V8.67l-9.38 5.56a2.25 2.25 0 01-2.24 0L1.5 8.67z" />
                                    <path
                                        d="M22.5 6.75v-.33A2.25 2.25 0 0020.25 4.5H3.75A2.25 2.25 0 001.5 6.42v.33l9.38 5.56a.75.75 0 00.74 0L22.5 6.75z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <!-- Email -->
                                <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-2">E-mail</p>
                                <a href="mailto:support@sal-tech.com"
                                    class="text-sm text-gray-900 hover:text-blue-600 transition-colors break-all">
                                    support@sal-tech.com
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Card -->
                    <div
                        class="p-5 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-200 sm:col-span-2 lg:col-span-1">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2.25 4.5A2.25 2.25 0 014.5 2.25h2.25a1.5 1.5 0 011.5 1.5v3a1.5 1.5 0 01-.879 1.374l-1.13.503a12.75 12.75 0 006.682 6.682l.503-1.13A1.5 1.5 0 0115.75 13.5h3a1.5 1.5 0 011.5 1.5v2.25a2.25 2.25 0 01-2.25 2.25h-.75C9.042 19.5 4.5 14.958 4.5 9.75v-.75a2.25 2.25 0 01-2.25-2.25V4.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <!-- Phone -->
                                <p class="text-xs font-semibold text-green-600 uppercase tracking-wide mb-2">Telefon</p>
                                <a href="tel:+4570272220"
                                    class="text-sm text-gray-900 hover:text-green-600 transition-colors">
                                    +45 70272220
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                    <a href="https://www.google.com/maps/dir//Sal-Tech+Easy+Packaging/@54.908944,9.198306,15z"
                        target="_blank" rel="noopener noreferrer"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium text-sm sm:text-base shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 2.25a.75.75 0 01.53.22l9 9a.75.75 0 010 1.06l-9 9a.75.75 0 01-1.06 0l-9-9a.75.75 0 010-1.06l9-9a.75.75 0 01.53-.22zm-1.72 9.78a.75.75 0 000 1.06l2.69 2.69a.75.75 0 101.06-1.06L12.06 12l1.97-1.97a.75.75 0 10-1.06-1.06l-2.69 2.69z"
                                clip-rule="evenodd" />
                        </svg>
                        <!-- Get Directions -->
                        Få rutevejledning
                    </a>

                    <a href="/contact"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium text-sm sm:text-base shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <!-- Contact Us -->
                        Kontakt os
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>