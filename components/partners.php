<section class="bg-white py-4">
  <div class="mx-auto max-w-7xl px-4 lg:px-8 text-center">

    <div class="logo-grid flex flex-wrap items-center justify-center">

      <div class="logo-item flex-none px-6 py-4 opacity-45 hover:opacity-75 transition-opacity">
        <img src="/wp-content/themes/chris-tailwind-woo/assets/img/salbaek.jpg"
          class="h-10 w-auto object-contain grayscale" alt="Salbaek" />
      </div>

      <div class="logo-item flex-none px-6 py-4 opacity-45 hover:opacity-75 transition-opacity">
        <img src="/wp-content/themes/chris-tailwind-woo/assets/img/step-de.png"
          class="h-10 w-auto object-contain grayscale" alt="Step DE" />
      </div>

      <div class="logo-item flex-none px-6 py-4 opacity-45 hover:opacity-75 transition-opacity">
        <img src="/wp-content/themes/chris-tailwind-woo/assets/img/step-dk.png"
          class="h-10 w-auto object-contain grayscale" alt="Step DK" />
      </div>

      <div class="logo-item flex-none px-6 py-4 opacity-45 hover:opacity-75 transition-opacity">
        <img src="/wp-content/themes/chris-tailwind-woo/assets/img/step-es.jpg"
          class="h-10 w-auto object-contain grayscale" alt="Step ES" />
      </div>

      <div class="logo-item flex-none px-6 py-4 opacity-45 hover:opacity-75 transition-opacity">
        <img src="/wp-content/themes/chris-tailwind-woo/assets/img/step.png"
          class="h-10 w-auto object-contain grayscale" alt="Step" />
      </div>

    </div>

    <div class="mx-auto w-10 h-px bg-gray-200"></div>

  </div>
</section>

<style>
  /* Desktop: vertical dividers between logos */
  .logo-item {
    border-right: 1px solid #e5e7eb;
  }

  .logo-item:last-child {
    border-right: none;
  }

  /* Mobile: 2-column grid with cell borders */
  @media (max-width: 640px) {
    .logo-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      overflow: hidden;
      gap: 0;
    }

    .logo-item {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem 1rem;
      border-right: 1px solid #e5e7eb;
      border-bottom: 1px solid #e5e7eb;
      border-top: none;
    }

    /* remove right border on even items (right column) */
    .logo-item:nth-child(2n) {
      border-right: none;
    }

    /* remove bottom border on last two items */
    .logo-item:nth-last-child(-n+2) {
      border-bottom: none;
    }

    /* if 5 logos: last item sits alone in left column, spans both */
    .logo-item:last-child:nth-child(odd) {
      grid-column: span 2;
      border-right: none;
    }
  }
</style>