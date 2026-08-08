<?php
/**
 * Template Name: 404 Page Not Found
 */

get_header();
?>

<div
  class="bg-gradient-to-b from-gray-50 to-white min-h-[70vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-2xl w-full text-center">

    <div class="mb-8">
      <h1 class="text-9xl sm:text-[12rem] font-bold text-gray-200 leading-none select-none">
        404
      </h1>
    </div>

    <div class="flex justify-center mb-6">
      <div class="relative">
        <div class="absolute inset-0 bg-red-100 rounded-full blur-xl opacity-50"></div>
        <div class="relative bg-white rounded-full p-6 shadow-lg border border-gray-200">
          <svg class="w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
        </div>
      </div>
    </div>

    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3">
      This page is not available
    </h2>

    <p class="text-base sm:text-lg text-gray-600 mb-10 max-w-lg mx-auto">
      We're sorry, but the Web address you've entered is no longer available.
    </p>

    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
      <a href="<?php echo home_url(); ?>"
        class="inline-flex items-center gap-2 px-8 py-3 bg-red-700 text-white font-semibold rounded-lg hover:bg-red-800 transition-colors shadow-sm hover:shadow-md min-w-[200px] justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Go Home
      </a>

      <button onclick="history.back()"
        class="inline-flex items-center gap-2 px-8 py-3 bg-white text-gray-700 font-semibold rounded-lg border-2 border-gray-300 hover:border-gray-400 hover:bg-gray-50 transition-colors shadow-sm min-w-[200px] justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Go Back
      </button>
    </div>

    <div class="mt-12 pt-8 border-t border-gray-200">
      <p class="text-sm text-gray-500 mb-4">Here are some helpful links instead:</p>
      <div class="flex flex-wrap justify-center gap-4 text-sm">
        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"
          class="text-red-700 hover:text-red-800 font-medium transition-colors">
          Shop
        </a>
        <span class="text-gray-300">|</span>
        <a href="/about-us" class="text-red-700 hover:text-red-800 font-medium transition-colors">
          About Us
        </a>
        <span class="text-gray-300">|</span>
        <a href="/contact" class="text-red-700 hover:text-red-800 font-medium transition-colors">
          Contact
        </a>
        <span class="text-gray-300">|</span>
        <a href="/sitemap" class="text-red-700 hover:text-red-800 font-medium transition-colors">
          Sitemap
        </a>
      </div>
    </div>

  </div>
</div>

<?php get_footer(); ?>