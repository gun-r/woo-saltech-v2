<?php
/**
 * Template Name: String Tying Page
 *
 * Custom page template for the Sal-Tech "String Tying" page.
 *
 * @package SalTech
 */

defined('ABSPATH') || exit;

get_header();

$st_images = [

  /* ── MACHINES ── */
  'pak_tyer' => ['src' => get_stylesheet_directory_uri() . '/assets/img/stringtying/felinspack2006.png', 'alt' => 'Felins Pak Tyer 2000-6″ – automatisk snorbinder'],
  'coil_tyer' => ['src' => get_stylesheet_directory_uri() . '/assets/img/stringtying/felinscoil2006.png', 'alt' => 'Felins Coil Tyer 2000-6″ – automatisk coil snorbinder'],
  'felins_ats' => ['src' => get_stylesheet_directory_uri() . '/assets/img/stringtying/felinsATS.png', 'alt' => 'Felins ATS – fuld automatisk snorbinder'],
  'rotary_tyer' => ['src' => get_stylesheet_directory_uri() . '/assets/img/stringtying/felinsrotary.png', 'alt' => 'Felins Rotary Tyer – rotations snorbinder'],

  /* ── PROCESS ILLUSTRATION ── */
  'process_overview' => ['src' => get_stylesheet_directory_uri() . '/assets/img/stringtying/process.png', 'alt' => 'Snorbinding proces illustration'],

  /* ── STRING TYPES ── */
  'string_elastic' => ['src' => get_stylesheet_directory_uri() . '/assets/img/stringtying/elastic-string.png', 'alt' => 'Elastik snor til snorbinding'],

  /* ── PRODUCTS / APPLICATIONS ── */
  'fuld_automatisk' => ['src' => get_stylesheet_directory_uri() . '/assets/img/stringtying/randomitem-1.png', 'alt' => 'Fuld automatisk'],
  'products_overview' => ['src' => get_stylesheet_directory_uri() . '/assets/img/stringtying/showproducts.png', 'alt' => 'Typiske produkter der bindes med snor'],

];

function st_tying_img($key, $extra_class = '')
{
  global $st_images;
  $img = $st_images[$key] ?? ['src' => '', 'alt' => $key];

  if (!empty($img['src'])) {
    echo '<img src="' . esc_url($img['src']) . '" alt="' . esc_attr($img['alt']) . '" class="st-img ' . esc_attr($extra_class) . '" loading="lazy">';
  } else {
    echo '<div class="st-placeholder ' . esc_attr($extra_class) . '" title="' . esc_attr('Billede: ' . $img['alt']) . '">'
      . '<div class="st-placeholder__inner">'
      . '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>'
      . '<span>' . esc_html($img['alt']) . '</span>'
      . '</div>'
      . '</div>';
  }
}
?>

<style>
  *,
  *::before,
  *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  :root {
    --red: #DC2626;
    --red-hover: #B91C1C;
    --red-soft: rgba(220, 38, 38, .07);
    --text-dark: #111111;
    --text-mid: #4B5563;
    --border: #E5E7EB;
    --bg-white: #FFFFFF;
    --bg-light: #F9FAFB;
    --bg-mid: #F3F4F6;
    --font: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
    --sp-xs: 8px;
    --sp-sm: 16px;
    --sp-md: 32px;
    --sp-lg: 64px;
    --max-w: 1280px;
    --r: 3px;
  }

  html {
    scroll-behavior: smooth;
  }

  body {
    font-family: var(--font);
    background: var(--bg-white);
    color: var(--text-dark);
    font-size: 16px;
    line-height: 1.65;
    -webkit-font-smoothing: antialiased;
  }

  .sty-wrap {
    max-width: var(--max-w);
    margin: 0 auto;
    padding: 0 var(--sp-md);
  }

  /* ── IMAGES / PLACEHOLDERS ── */
  .st-img {
    display: block;
    width: 100%;
    height: 100px;
    object-fit: contain;
    border-radius: var(--r);
  }

  .st-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    min-height: 200px;
    background: var(--bg-mid);
    border: 2px dashed var(--border);
    border-radius: var(--r);
    color: var(--text-mid);
    transition: border-color .2s;
  }

  .st-placeholder:hover {
    border-color: var(--red);
  }

  .st-placeholder__inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: var(--sp-md);
    text-align: center;
  }

  .st-placeholder__inner svg {
    opacity: .3;
  }

  .st-placeholder__inner span {
    font-size: 11px;
    color: var(--text-mid);
    max-width: 160px;
    line-height: 1.4;
    opacity: .75;
  }

  .sty-ph--hero {
    min-height: 420px;
  }

  .sty-ph--wide {
    min-height: 300px;
  }

  .sty-ph--card {
    min-height: 200px;
  }

  .sty-ph--square {
    min-height: 240px;
  }

  .sty-ph--thumb {
    min-height: 130px;
  }

  /* ── SECTION LABEL ── */
  .sty-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .15em;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 10px;
  }

  .sty-label::before {
    content: '';
    display: block;
    width: 18px;
    height: 2px;
    background: var(--red);
  }

  /* ── HEADINGS ── */
  h2.sty-h2 {
    font-size: 28px;
    font-weight: 800;
    letter-spacing: -.02em;
    color: var(--text-dark);
    line-height: 1.2;
  }

  h3.sty-h3 {
    font-size: 22px;
    font-weight: 700;
    letter-spacing: -.01em;
    color: var(--text-dark);
    margin-bottom: var(--sp-sm);
  }

  hr.sty-rule {
    border: none;
    border-top: 1px solid var(--border);
    margin: 0;
  }

  /* ── NOTICE ── */
  .sty-notice {
    display: flex;
    gap: var(--sp-sm);
    align-items: flex-start;
    padding: var(--sp-sm) var(--sp-md);
    background: var(--red-soft);
    border-left: 3px solid var(--red);
    border-radius: 0 var(--r) var(--r) 0;
    margin-top: var(--sp-md);
  }

  .sty-notice svg {
    color: var(--red);
    flex-shrink: 0;
    margin-top: 2px;
  }

  .sty-notice p {
    font-size: 14px;
    color: var(--text-dark);
    line-height: 1.6;
  }

  /* ── ALERT ── */
  .sty-alert {
    background: var(--bg-light);
    border: 1px solid var(--border);
    border-left: 3px solid var(--red);
    border-radius: 0 var(--r) var(--r) 0;
    padding: var(--sp-sm) var(--sp-md);
    font-size: 14px;
    color: var(--text-mid);
    line-height: 1.7;
  }

  .sty-alert strong {
    color: var(--text-dark);
  }

  /* ════════════════════════════════════════
     BREADCRUMB
  ════════════════════════════════════════ */
  .sty-bc {
    background: var(--bg-light);
    border-bottom: 1px solid var(--border);
    padding: 10px 0;
    font-size: 13px;
    color: var(--text-mid);
  }

  .sty-bc a {
    color: var(--text-mid);
  }

  .sty-bc a:hover {
    color: var(--red);
    text-decoration: none;
  }

  .sty-bc .sep {
    margin: 0 6px;
    color: var(--border);
  }

  /* ════════════════════════════════════════
     HERO
  ════════════════════════════════════════ */
  .sty-hero {
    background: var(--bg-light);
    border-bottom: 1px solid var(--border);
    overflow: hidden;
  }

  .sty-hero__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-lg);
    align-items: end;
  }

  .sty-hero__eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .15em;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: var(--sp-sm);
  }

  .sty-hero__eyebrow::before {
    content: '';
    display: block;
    width: 18px;
    height: 2px;
    background: var(--red);
  }

  .sty-hero h1 {
    font-size: clamp(36px, 5.5vw, 66px);
    font-weight: 900;
    letter-spacing: -.03em;
    line-height: 1.0;
    color: var(--text-dark);
    margin-bottom: var(--sp-sm);
  }

  .sty-hero h1 em {
    font-style: normal;
    color: var(--red);
  }

  .sty-hero__sub {
    font-size: 17px;
    color: var(--text-mid);
    line-height: 1.6;
    max-width: 480px;
    margin-bottom: var(--sp-md);
  }

  .sty-hero__img {
    align-self: end;
  }

  /* ════════════════════════════════════════
     INTRO
  ════════════════════════════════════════ */
  .sty-intro {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-white);
  }

  .sty-intro__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-lg);
    align-items: start;
  }

  .sty-intro__lead {
    font-size: 20px;
    line-height: 1.6;
    color: var(--text-dark);
  }

  .sty-intro__lead strong {
    color: var(--red);
    font-weight: 700;
  }

  .sty-intro__body {
    font-size: 15px;
    color: var(--text-mid);
    line-height: 1.8;
  }

  .sty-intro__body+.sty-intro__body {
    margin-top: var(--sp-sm);
  }

  /* ════════════════════════════════════════
     MACHINE CARDS
  ════════════════════════════════════════ */
  .sty-machines {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-white);
  }

  .sty-machines__intro {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: var(--sp-lg);
    align-items: end;
    margin-bottom: var(--sp-lg);
  }

  .sty-badge {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 100px;
    border: 1px solid var(--border);
    color: var(--text-mid);
    background: var(--bg-light);
    white-space: nowrap;
  }

  .sty-badge--auto {
    border-color: #D97706;
    color: #92400E;
    background: #FFFBEB;
  }

  .sty-badge--full {
    border-color: var(--red);
    color: var(--red);
    background: var(--red-soft);
  }

  .sty-machines__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: var(--sp-sm);
  }

  .sty-machine-card {
    border: 1px solid var(--border);
    border-radius: var(--r);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    background: var(--bg-white);
    transition: box-shadow .2s, border-color .2s, transform .2s;
  }

  .sty-machine-card:hover {
    border-color: var(--red);
    box-shadow: 0 6px 24px rgba(220, 38, 38, .09);
    transform: translateY(-3px);
  }

  .sty-machine-card__img {
    position: relative;
  }

  .sty-machine-card__img::before {
    content: attr(data-type);
    position: absolute;
    top: 8px;
    left: 8px;
    z-index: 1;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 3px 8px;
    border-radius: 100px;
    background: var(--bg-white);
    border: 1px solid var(--border);
    color: var(--text-mid);
  }

  .sty-machine-card__body {
    padding: var(--sp-sm);
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
  }

  .sty-machine-card__name {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1.3;
  }

  /* ════════════════════════════════════════
     PROCESS TABS 
  ════════════════════════════════════════ */
  .sty-process {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-light);
  }

  .sty-tabs {
    display: flex;
    border-bottom: 2px solid var(--border);
    margin-bottom: var(--sp-md);
    overflow-x: auto;
    scrollbar-width: none;
  }

  .sty-tab {
    padding: 12px 22px;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-mid);
    cursor: pointer;
    border-bottom: 2px solid transparent;
    margin-bottom: -2px;
    white-space: nowrap;
    background: none;
    border-top: none;
    border-left: none;
    border-right: none;
    font-family: var(--font);
    transition: color .2s, border-color .2s;
  }

  .sty-tab:hover {
    color: var(--text-dark);
  }

  .sty-tab.is-active {
    color: var(--red);
    border-bottom-color: var(--red);
  }

  .sty-panel {
    display: none;
    animation: styFade .3s ease;
  }

  .sty-panel.is-active {
    display: block;
  }

  @keyframes styFade {
    from {
      opacity: 0;
      transform: translateY(8px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .sty-panel__grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--sp-lg);
    align-items: start;
  }

  .sty-panel__text h3 {
    font-size: 22px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: var(--sp-sm);
    letter-spacing: -.01em;
  }

  .sty-panel__text p {
    font-size: 15px;
    color: var(--text-mid);
    line-height: 1.8;
    margin-bottom: var(--sp-sm);
  }

  /* ════════════════════════════════════════
     PRODUCT APPLICATIONS
  ════════════════════════════════════════ */
  .sty-products {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-white);
  }

  /* ════════════════════════════════════════
     OPLÆGNING
  ════════════════════════════════════════ */
  .sty-oplaegning {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-light);
  }

  .sty-oplaegning__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-lg);
    align-items: center;
    margin-top: var(--sp-md);
  }

  .sty-oplaegning__text p {
    font-size: 15px;
    color: var(--text-mid);
    line-height: 1.8;
  }

  .sty-elastic-caption {
    font-size: 13px;
    color: var(--text-mid);
    text-align: center;
    margin-top: var(--sp-xs);
  }

  /* ════════════════════════════════════════
     RELATED FIELDS
  ════════════════════════════════════════ */
  .sty-related {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-white);
  }

  .sty-related__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-sm);
    margin-top: var(--sp-md);
  }

  .sty-related-card {
    display: flex;
    align-items: center;
    gap: var(--sp-md);
    padding: var(--sp-md);
    border: 1px solid var(--border);
    border-radius: var(--r);
    background: var(--bg-white);
    text-decoration: none;
    transition: border-color .2s, box-shadow .2s, transform .15s;
  }

  .sty-related-card:hover {
    border-color: var(--red);
    box-shadow: 0 4px 16px rgba(220, 38, 38, .07);
    transform: translateY(-2px);
    text-decoration: none;
  }

  .sty-related-card__icon {
    width: 44px;
    height: 44px;
    flex-shrink: 0;
    border-radius: var(--r);
    background: var(--red-soft);
    border: 1px solid rgba(220, 38, 38, .2);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .sty-related-card__icon svg {
    color: var(--red);
  }

  .sty-related-card__name {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 3px;
  }

  /* ════════════════════════════════════════
     AUTHOR 
  ════════════════════════════════════════ */
  .sty-author {
    padding: var(--sp-lg) 0;
    background: var(--bg-light);
    border-top: 1px solid var(--border);
  }

  .sty-author__card {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 0;
    border: 1px solid var(--border);
    border-radius: var(--r);
    overflow: hidden;
    max-width: 680px;
    background: var(--bg-white);
  }

  .sty-author__accent {
    width: 5px;
    background: var(--red);
  }

  .sty-author__body {
    padding: var(--sp-md);
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .sty-author__meta-row {
    display: flex;
    align-items: center;
    gap: var(--sp-sm);
    flex-wrap: wrap;
  }

  .sty-author__name {
    font-size: 16px;
    font-weight: 800;
    color: var(--text-dark);
    letter-spacing: -.01em;
  }

  .sty-author__role {
    font-size: 13px;
    color: var(--text-mid);
  }

  /* ════════════════════════════════════════
     RESPONSIVE
  ════════════════════════════════════════ */
  @media (max-width: 1024px) {
    .sty-machines__grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 900px) {

    .sty-hero__grid,
    .sty-intro__grid,
    .sty-oplaegning__grid,
    .sty-related__grid {
      grid-template-columns: 1fr;
    }

    .sty-machines__intro {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 600px) {
    :root {
      --sp-lg: 40px;
    }

    .sty-machines__grid {
      grid-template-columns: 1fr 1fr;
    }

    h2.sty-h2 {
      font-size: 22px;
    }

    .sty-tab {
      padding: 10px 14px;
      font-size: 13px;
    }

    .sty-author__card {
      grid-template-columns: 1fr;
    }

    .sty-author__accent {
      width: 100%;
      height: 4px;
    }
  }
</style>

<!-- ═══ BREADCRUMB ═══════════════════════════════════════════ -->
<div class="sty-bc">
  <div class="sty-wrap">
    <?php if (function_exists('woocommerce_breadcrumb')) {
      woocommerce_breadcrumb();
    } else { ?>
      <a href="<?php echo esc_url(home_url('/')); ?>">Forside</a>
      <span class="sep">/</span>
      <span>Snorbinding</span>
    <?php } ?>
  </div>
</div>

<!-- ═══ HERO ════════════════════════════════════════════════ -->
<section class="sty-hero">
  <div class="sty-wrap">
    <div class="sty-hero__grid">
      <div class="sty-hero__text">
        <div class="sty-hero__eyebrow">String Tying</div>
        <h1>Snorbinding</h1>
        <p class="sty-hero__sub">Få det bedste ud af snorbindings­processen. Hvad den kan og ikke kan.</p>
      </div>
    </div>
  </div>
</section>

<hr class="sty-rule">

<!-- ═══ MACHINE CARDS ═══════════════════════════════════════ -->
<section class="sty-machines">
  <div class="sty-wrap">

    <div class="sty-machines__intro">
      <div>
        <h2 class="sty-h2">Typisk udstyr for snorbinding</h2>
      </div>
      <div style="display:flex; gap:var(--sp-xs); flex-wrap:wrap;">
        <span class="sty-badge sty-badge--auto">Automatisk</span>
        <span class="sty-badge sty-badge--full">Fuld Automatisk</span>
      </div>
    </div>

    <div class="sty-machines__grid">

      <div class="sty-machine-card">
        <div class="sty-machine-card__img" data-type="Automatisk">
          <?php st_tying_img('pak_tyer', 'sty-ph--card'); ?>
        </div>
        <div class="sty-machine-card__body">
          <div class="sty-machine-card__name">Felins Pak Tyer 2000-6″</div>
        </div>
      </div>

      <div class="sty-machine-card">
        <div class="sty-machine-card__img" data-type="Automatisk">
          <?php st_tying_img('coil_tyer', 'sty-ph--card'); ?>
        </div>
        <div class="sty-machine-card__body">
          <div class="sty-machine-card__name">Felins Coil Tyer 2000-6″</div>
        </div>
      </div>

      <div class="sty-machine-card">
        <div class="sty-machine-card__img" data-type="Fuld Auto">
          <?php st_tying_img('felins_ats', 'sty-ph--card'); ?>
        </div>
        <div class="sty-machine-card__body">
          <div class="sty-machine-card__name">Felins ATS</div>
        </div>
      </div>

      <div class="sty-machine-card">
        <div class="sty-machine-card__img" data-type="Automatisk">
          <?php st_tying_img('rotary_tyer', 'sty-ph--card'); ?>
        </div>
        <div class="sty-machine-card__body">
          <div class="sty-machine-card__name">Felins Rotary Tyer</div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══ INTRO ══════════════════════════════════════════════ -->
<section class="sty-intro">
  <div class="sty-wrap">
    <div class="sty-intro__grid">

      <div>
        <div class="sty-label">Proces</div>
        <p class="sty-intro__body">Med snor bindings processen føres produktet igennem den stående snor, hvorved snoren
          spændes an og efter passage af start af taster punktet, føres snor ned i knytter hovedet, knuden knyttes og
          snoren klippes. En ny snor vil herefter stå klar for næste produkt præsentation. Typer af snor spænder over
          materialer som LDPE, PET, bomuld, elastomer, elastik, viskose og former som Poly Tape, Twisted Poly og Spiral
          Twist. Hårde produkter bindes med elastisk snor og bløde produkter bindes med fast sno.</p>
        <p class="sty-intro__body">Ved snor binding er der få begrænsning mht. anlægs fladen, da den ikke har direkte
          indflydelse på resultatet. Da snoren står spændt er det vigtigt at produktet har stivhed til at trække snoren
          ud og samtidigt sikre tilstrækkelig til spænding omkring produktet således det efterfølgende hænger sammen som
          et bundt. Mindste bundt typisk ned til 20-25 mm, men mindre kan være muligt. Højden under binder armen eller
          den omskrevne cirkel giver den ydre begrænsning.</p>
      </div>

      <div>
        <?php st_tying_img('process_overview', 'sty-ph--wide'); ?>
      </div>

    </div>
  </div>
</section>

<!-- ═══ PROCESS TABS ════════════════════════════════════════ -->
<section class="sty-process">
  <div class="sty-wrap">
    <h2 class="sty-h2">I forhold til de forskellige processer vil det udstyr der finder anvendelse</h2>
    <br>

    <div class="sty-tabs" role="tablist">
      <button class="sty-tab is-active" data-tab="manuel" role="tab" aria-selected="true">Manuelt</button>
      <button class="sty-tab" data-tab="semi" role="tab" aria-selected="false">Semi Automatisk</button>
      <button class="sty-tab" data-tab="auto" role="tab" aria-selected="false">Automatisk</button>
      <button class="sty-tab" data-tab="fullauto" role="tab" aria-selected="false">Fuld Automatisk</button>
    </div>

    <!-- MANUEL -->
    <div class="sty-panel is-active" data-panel="manuel" role="tabpanel">
      <div class="sty-panel__grid">
        <div class="sty-panel__text">
          <h3>Manuelt</h3>
          <p>Manual binding af produkter har eksisteret siden lianen, hertil kræves ingen maskiner eller udstyr.</p>
        </div>
      </div>
    </div>

    <!-- SEMI -->
    <div class="sty-panel" data-panel="semi" role="tabpanel">
      <div class="sty-panel__grid">
        <div class="sty-panel__text">
          <h3>Semi-automatisk</h3>
          <p>Til mit kendskab eksisterer der ikke udstyr for semi automatisk snorbinding.</p>
        </div>
      </div>
    </div>

    <!-- AUTO -->
    <div class="sty-panel" data-panel="auto" role="tabpanel">
      <div class="sty-panel__grid">
        <div class="sty-panel__text">
          <h3>Automatisk</h3>
          <p><strong>Snorbindere føre selv snor rundt. Der findes 2 hoved former</strong></p>
          <p>Snorer føres rundt om produktet og knyttes på undersiden, rotations typen, disse kaldes Rotary Tyers. Disse
            maskiner anvendes ofte i den grafiske industri, vaskerier mv.</p>
          <p>Snoren føres ned bag produktet efter det er blevet presset igennem den stående snor. Snoren føres ned i
            knytter hovedet der knytter og skærere snoren. Denne type kaldes knyttes arms bindere. Eksempler herpå er
            Pak Tyer 2000, Coil Tyer mv. Disse maskiner anvendes ofte i vaskerier, gartnerier, kable producenter
            (coil). Varianter som højre/venstre udgave samt tandem finder også anvendelse.</p>
          <p><strong>Typiske produkter der bindes med snor</strong></p>
          <div style="margin-top:var(--sp-md);">
            <?php st_tying_img('products_overview', 'sty-ph--square'); ?>
          </div>
        </div>
      </div>
    </div>

    <!-- FULD AUTO -->
    <div class="sty-panel" data-panel="fullauto" role="tabpanel">
      <div class="sty-panel__grid">
        <div class="sty-panel__text">
          <h3>Fuld automatisk</h3>
          <p>Til vaskeri, gartneri og industri sektoren mv., findes der en del forskellige fuld automatiske løsninger,
            hvor produktet ilægges en position givende transportbånd eller på åbne bånd, hvorefter det bindes.</p>
          <div style="margin-top:var(--sp-md);">
            <?php st_tying_img('fuld_automatisk', 'sty-ph--square'); ?>
          </div>
        </div>
      </div>
    </div>

    <p style="font-size:15px; color:var(--text-mid); margin-top:var(--sp-md);">Projekt specificeret og mere avanceret
      snor binder udstyr, branche relateret kan laves i opgave.</p>

  </div>
</section>

<!-- ═══ OPLÆGNING ════════════════════════════════════════════ -->
<section class="sty-oplaegning">
  <div class="sty-wrap">
    <div class="sty-oplaegning__grid">
      <div class="sty-oplaegning__text">
        <h2 class="sty-h2">Oplægning</h2>
        <br>
        <br>
        <p>Snor leveres på kerne typisk Ø76, uden kerne, med pap kerne ø40-50, i plastik omslag, ofte tilpasset de
          enkelte maskintyper. Ved ordreafgivelse på snor er oplægningen og maskintype derfor meget vigtigt at kende.
          Antallet af meter per opspolning, afslutnings metoden, geometrisk låst eller tape er forhold man bør kende set
          i relation til den snor binder snoren skal benyttes.</p>
      </div>

      <div>
        <?php st_tying_img('string_elastic', 'sty-ph--square'); ?>
        <p class="sty-elastic-caption">Elastik Snor</p>
      </div>

    </div>
  </div>
</section>

<!-- ═══ RELATED FIELDS ══════════════════════════════════════ -->
<section class="sty-related">
  <div class="sty-wrap">
    <h2 class="sty-h2">Beslægtede områder</h2>
    <br>
    <div class="sty-related__grid">

      <div class="sty-related-card">
        <div class="sty-related-card__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            aria-hidden="true">
            <rect x="3" y="8" width="18" height="8" rx="1" />
            <path d="M7 8V6a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" />
          </svg>
        </div>
        <div>
          <div class="sty-related-card__name">Omsnøring med bånd, der anvender plast "bånd" der svejses</div>
        </div>
      </div>

      <div class="sty-related-card">
        <div class="sty-related-card__icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            aria-hidden="true">
            <path d="M4 6h16M4 10h16M4 14h16M4 18h16" />
          </svg>
        </div>
        <div>
          <div class="sty-related-card__name">Banderolering med bånd, der anvender plast eller papir "bånd" der svejses.
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══ AUTHOR ══════════════════════════════════════════════ -->
<section class="sty-author">
  <div class="sty-wrap">
    <div class="sty-label">Forfatter til artiklen</div>
    <div class="sty-author__card">
      <div class="sty-author__accent"></div>
      <div class="sty-author__body">
        <div class="sty-author__meta-row">
          <div>
            <div class="sty-author__name">Gunnar Salbæk</div>
            <div class="sty-author__role">CEO / Industrial Design &nbsp;·&nbsp; 20 års erfaring i fagområdet</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  (function () {
    var tabs = document.querySelectorAll('.sty-tab');
    var panels = document.querySelectorAll('.sty-panel');

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        var target = this.getAttribute('data-tab');

        tabs.forEach(function (t) {
          t.classList.remove('is-active');
          t.setAttribute('aria-selected', 'false');
        });
        panels.forEach(function (p) {
          p.classList.remove('is-active');
        });

        this.classList.add('is-active');
        this.setAttribute('aria-selected', 'true');

        var panel = document.querySelector('[data-panel="' + target + '"]');
        if (panel) panel.classList.add('is-active');
      }.bind(tab));
    });
  })();
</script>

<?php get_footer(); ?>