<?php
/**
 * Template Name: Wrapping Page
 *
 * Custom page template for the Sal-Tech "Wrapping" page.
 *
 * @package SalTech
 */

defined('ABSPATH') || exit;

get_header();

$wr_images = [

  /* ── MANUAL ── */
  'hand_film_set' => ['src' => get_stylesheet_directory_uri() . '/assets/img/wrapping/handfilm.png', 'alt' => 'Håndfilms dispenser sæt 450/500 mm'],

  /* ── SEMI AUTOMATIC ── */
  'e3wrap2100' => ['src' => get_stylesheet_directory_uri() . '/assets/img/wrapping/e3wrap2100.png', 'alt' => 'E3 Wrap 2100 semi automatisk pallevikler'],

  /* ── AUTOMATIC ── */
  'exp501' => ['src' => get_stylesheet_directory_uri() . '/assets/img/wrapping/exp501.png', 'alt' => 'EXP-501 automatisk pallevikler'],

  /* ── FULLY AUTOMATIC ── */
  'exp702' => ['src' => get_stylesheet_directory_uri() . '/assets/img/wrapping/exp702.png', 'alt' => 'EXP-702 fuld automatisk pallevikler'],

  /* ── SPECIALIST / OTHER ── */
  'exr401' => ['src' => get_stylesheet_directory_uri() . '/assets/img/wrapping/exr401.png', 'alt' => 'EXR-401 horisontal vikling'],
  'roll_wrapping' => ['src' => get_stylesheet_directory_uri() . '/assets/img/wrapping/rullewrap.png', 'alt' => 'Rulle vikling maskine'],
  'data_exchange' => ['src' => get_stylesheet_directory_uri() . '/assets/img/wrapping/datacapture.png', 'alt' => 'STEP Data Exchange System – dataindfangst pakkeløsning'],
  'topfilm_tf1500' => ['src' => get_stylesheet_directory_uri() . '/assets/img/wrapping/tf1500.png', 'alt' => 'Top film stativ STEP TF 1500'],

];

function wr_img($key, $extra_class = '')
{
  global $wr_images;
  $img = $wr_images[$key] ?? ['src' => '', 'alt' => $key];

  if (!empty($img['src'])) {
    echo '<img src="' . esc_url($img['src']) . '" alt="' . esc_attr($img['alt']) . '" class="wr-img ' . esc_attr($extra_class) . '" loading="lazy">';
  } else {
    echo '<div class="wr-placeholder ' . esc_attr($extra_class) . '" title="' . esc_attr('Billede: ' . $img['alt']) . '">'
      . '<div class="wr-placeholder__inner">'
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

  .wr-wrap {
    max-width: var(--max-w);
    margin: 0 auto;
    padding: 0 var(--sp-md);
  }

  /* a {
    color: var(--red);
    text-decoration: none;
  }

  a:hover {
    color: var(--red-hover);
    text-decoration: underline;
  } */

  /* ── IMAGES / PLACEHOLDERS ── */
  .wr-img {
    display: block;
    width: 100%;
    height: 100px;
    object-fit: contain;
    border-radius: var(--r);
  }

  .wr-placeholder {
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

  .wr-placeholder:hover {
    border-color: var(--red);
  }

  .wr-placeholder__inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    padding: var(--sp-md);
    text-align: center;
  }

  .wr-placeholder__inner svg {
    opacity: .3;
  }

  .wr-placeholder__inner span {
    font-size: 11px;
    color: var(--text-mid);
    max-width: 160px;
    line-height: 1.4;
    opacity: .75;
  }

  .wr-ph--hero {
    min-height: 420px;
  }

  .wr-ph--wide {
    min-height: 300px;
  }

  .wr-ph--card {
    min-height: 180px;
  }

  .wr-ph--square {
    min-height: 220px;
  }

  .wr-ph--thumb {
    min-height: 130px;
  }

  .wr-ph--side {
    min-height: 100%;
    border-radius: 0;
    border: none;
  }

  /* ── SECTION LABEL ── */
  .wr-label {
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

  .wr-label::before {
    content: '';
    display: block;
    width: 18px;
    height: 2px;
    background: var(--red);
  }

  /* ── HEADINGS ── */
  h2.wr-h2 {
    font-size: 28px;
    font-weight: 800;
    letter-spacing: -.02em;
    color: var(--text-dark);
    line-height: 1.2;
  }

  h3.wr-h3 {
    font-size: 22px;
    font-weight: 700;
    letter-spacing: -.01em;
    color: var(--text-dark);
    margin-bottom: var(--sp-sm);
  }

  hr.wr-rule {
    border: none;
    border-top: 1px solid var(--border);
    margin: 0;
  }

  /* ── NOTICE / ALERT ── */
  .wr-notice {
    display: flex;
    gap: var(--sp-sm);
    align-items: flex-start;
    padding: var(--sp-sm) var(--sp-md);
    background: var(--red-soft);
    border-left: 3px solid var(--red);
    border-radius: 0 var(--r) var(--r) 0;
    margin-top: var(--sp-md);
  }

  .wr-notice svg {
    color: var(--red);
    flex-shrink: 0;
    margin-top: 2px;
  }

  .wr-notice p {
    font-size: 14px;
    color: var(--text-dark);
    line-height: 1.6;
  }

  .wr-alert {
    background: var(--bg-light);
    border: 1px solid var(--border);
    border-left: 3px solid var(--red);
    border-radius: 0 var(--r) var(--r) 0;
    padding: var(--sp-sm) var(--sp-md);
    font-size: 14px;
    color: var(--text-mid);
    line-height: 1.7;
  }

  .wr-alert strong {
    color: var(--text-dark);
  }

  .wr-alert+.wr-alert {
    margin-top: var(--sp-sm);
  }

  /* ════════════════════════════════════════
   BREADCRUMB
════════════════════════════════════════ */
  .wr-bc {
    background: var(--bg-light);
    border-bottom: 1px solid var(--border);
    padding: 10px 0;
    font-size: 13px;
    color: var(--text-mid);
  }

  .wr-bc a {
    color: var(--text-mid);
  }

  .wr-bc a:hover {
    color: var(--red);
    text-decoration: none;
  }

  .wr-bc .sep {
    margin: 0 6px;
    color: var(--border);
  }

  /* ════════════════════════════════════════
   HERO
════════════════════════════════════════ */
  .wr-hero {
    background: var(--bg-light);
    border-bottom: 1px solid var(--border);
    /* padding: var(--sp-lg) 0 0; */
    overflow: hidden;
  }

  .wr-hero__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-lg);
    align-items: end;
  }

  .wr-hero__text {
    /* padding-bottom: var(--sp-lg); */
  }

  .wr-hero__eyebrow {
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

  .wr-hero__eyebrow::before {
    content: '';
    display: block;
    width: 18px;
    height: 2px;
    background: var(--red);
  }

  .wr-hero h1 {
    font-size: clamp(36px, 5.5vw, 66px);
    font-weight: 900;
    letter-spacing: -.03em;
    line-height: 1.0;
    color: var(--text-dark);
    margin-bottom: var(--sp-sm);
  }

  .wr-hero h1 em {
    font-style: normal;
    color: var(--red);
  }

  .wr-hero__sub {
    font-size: 17px;
    color: var(--text-mid);
    line-height: 1.6;
    max-width: 480px;
    margin-bottom: var(--sp-md);
  }

  .wr-hero__stats {
    display: flex;
    gap: var(--sp-md);
    flex-wrap: wrap;
  }

  .wr-stat {
    display: flex;
    flex-direction: column;
  }

  .wr-stat-num {
    font-size: 26px;
    font-weight: 900;
    color: var(--text-dark);
    letter-spacing: -.03em;
    line-height: 1;
  }

  .wr-stat-lbl {
    font-size: 12px;
    color: var(--text-mid);
    margin-top: 2px;
  }

  .wr-hero__img {
    align-self: end;
  }

  /* ════════════════════════════════════════
   INTRO
════════════════════════════════════════ */
  .wr-intro {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-light);
  }

  .wr-intro__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-lg);
    align-items: start;
  }

  .wr-intro__lead {
    font-size: 20px;
    line-height: 1.6;
    color: var(--text-dark);
  }

  .wr-intro__lead strong {
    color: var(--red);
    font-weight: 700;
  }

  .wr-intro__body {
    font-size: 15px;
    color: var(--text-mid);
    line-height: 1.8;
  }

  .wr-intro__body+.wr-intro__body {
    margin-top: var(--sp-sm);
  }

  /* ════════════════════════════════════════
   PRETREATMENT / FILM TREATMENT
════════════════════════════════════════ */
  .wr-pretreat {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-white);
  }

  .wr-pretreat__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-lg);
    margin-top: var(--sp-md);
  }

  .wr-pretreat__col h3 {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: var(--sp-sm);
  }

  .wr-pretreat__list {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .wr-pretreat__list li {
    font-size: 14px;
    color: var(--text-mid);
    padding-left: 20px;
    position: relative;
    line-height: 1.6;
    border-bottom: 1px solid var(--border);
    padding-bottom: 10px;
  }

  .wr-pretreat__list li:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }

  .wr-pretreat__list li::before {
    content: '→';
    position: absolute;
    left: 0;
    color: var(--red);
    font-weight: 700;
  }

  .wr-pretreat__list li strong {
    color: var(--text-dark);
    display: block;
    font-size: 13px;
  }

  /* ════════════════════════════════════════
   EQUIPMENT CARDS
════════════════════════════════════════ */
  .wr-equipment {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-white);
  }

  .wr-equip-intro {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: var(--sp-lg);
    align-items: end;
    margin-bottom: var(--sp-lg);
  }

  .wr-type-legend {
    display: flex;
    gap: var(--sp-xs);
    flex-wrap: wrap;
  }

  .wr-badge {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 100px;
    border: 1px solid var(--border);
    color: var(--text-mid);
    background: var(--bg-light);
  }

  .wr-badge--manual {
    border-color: #6B7280;
    color: #374151;
  }

  .wr-badge--semi {
    border-color: #2563EB;
    color: #1D4ED8;
    background: #EFF6FF;
  }

  .wr-badge--auto {
    border-color: #D97706;
    color: #92400E;
    background: #FFFBEB;
  }

  .wr-badge--full {
    border-color: var(--red);
    color: var(--red);
    background: var(--red-soft);
  }

  .wr-equip-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: var(--sp-sm);
  }

  .wr-equip-card {
    border: 1px solid var(--border);
    border-radius: var(--r);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    background: var(--bg-white);
    transition: box-shadow .2s, border-color .2s, transform .2s;
  }

  .wr-equip-card:hover {
    border-color: var(--red);
    box-shadow: 0 6px 24px rgba(220, 38, 38, .09);
    transform: translateY(-3px);
  }

  .wr-equip-card__img {
    position: relative;
  }

  .wr-equip-card__img::before {
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

  .wr-equip-card__body {
    padding: var(--sp-sm);
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
  }

  .wr-equip-card__name {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1.3;
  }

  .wr-equip-card__desc {
    font-size: 13px;
    color: var(--text-mid);
    line-height: 1.5;
    flex: 1;
  }

  .wr-equip-card__link {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 13px;
    font-weight: 600;
    color: var(--red);
    margin-top: var(--sp-xs);
  }

  .wr-equip-card__link::after {
    content: '→';
  }

  .wr-equip-card__link:hover {
    color: var(--red-hover);
    text-decoration: none;
  }

  /* ════════════════════════════════════════
   PROCESS TABS
════════════════════════════════════════ */
  .wr-process {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-white);
  }

  .wr-tabs {
    display: flex;
    border-bottom: 2px solid var(--border);
    margin-bottom: var(--sp-md);
    overflow-x: auto;
    scrollbar-width: none;
  }

  .wr-tab {
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

  .wr-tab:hover {
    color: var(--text-dark);
  }

  .wr-tab.is-active {
    color: var(--red);
    border-bottom-color: var(--red);
  }

  .wr-panel {
    display: none;
    animation: wrFade .3s ease;
  }

  .wr-panel.is-active {
    display: block;
  }

  @keyframes wrFade {
    from {
      opacity: 0;
      transform: translateY(8px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .wr-panel__grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--sp-lg);
    align-items: start;
  }

  .wr-panel__text h3 {
    font-size: 22px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: var(--sp-sm);
    letter-spacing: -.01em;
  }

  .wr-panel__text p {
    font-size: 15px;
    color: var(--text-mid);
    line-height: 1.8;
    margin-bottom: var(--sp-sm);
  }

  .wr-panel__features {
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-radius: var(--r);
    padding: var(--sp-md);
  }

  .wr-panel__features h4 {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: var(--sp-sm);
  }

  .wr-panel__features ul {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .wr-panel__features li {
    font-size: 14px;
    color: var(--text-mid);
    padding-left: 20px;
    position: relative;
    line-height: 1.5;
  }

  .wr-panel__features li::before {
    content: '→';
    position: absolute;
    left: 0;
    color: var(--red);
    font-weight: 700;
  }

  /* ════════════════════════════════════════
   PROCESS CYCLES
════════════════════════════════════════ */
  .wr-cycles {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-light);
  }

  .wr-cycles__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-lg);
    margin-top: var(--sp-md);
    align-items: start;
  }

  .wr-cycle-list {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: var(--sp-sm);
    margin-top: var(--sp-sm);
  }

  .wr-cycle-list li {
    display: flex;
    align-items: center;
    gap: var(--sp-sm);
    padding: 12px var(--sp-sm);
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-radius: var(--r);
    font-size: 14px;
    color: var(--text-mid);
    line-height: 1.4;
    transition: border-color .2s;
  }

  .wr-cycle-list li:hover {
    border-color: var(--red);
  }

  .wr-cycle-num {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: var(--red-soft);
    border: 1px solid var(--red);
    font-size: 11px;
    font-weight: 700;
    color: var(--red);
    flex-shrink: 0;
  }

  /* ════════════════════════════════════════
   SPEEDS TABLE
════════════════════════════════════════ */
  .wr-speeds {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-light);
  }

  .wr-speeds__grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: var(--sp-sm);
    margin-top: var(--sp-md);
  }

  .wr-speed-card {
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-radius: var(--r);
    padding: var(--sp-md);
    border-top: 3px solid var(--red);
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .wr-speed-card__type {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--red);
  }

  .wr-speed-card__rate {
    font-size: 28px;
    font-weight: 900;
    color: var(--text-dark);
    letter-spacing: -.03em;
    line-height: 1.1;
  }

  .wr-speed-card__unit {
    font-size: 12px;
    color: var(--text-mid);
  }

  .wr-speed-card__note {
    font-size: 12px;
    color: var(--text-mid);
    line-height: 1.5;
    border-top: 1px solid var(--border);
    padding-top: 8px;
    margin-top: 4px;
  }

  /* ════════════════════════════════════════
   SPECIALIST / OTHER EQUIPMENT
════════════════════════════════════════ */
  .wr-specialist {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-white);
  }

  .wr-spec-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--sp-sm);
    margin-top: var(--sp-md);
  }

  .wr-spec-card {
    display: grid;
    grid-template-columns: 160px 1fr;
    border: 1px solid var(--border);
    border-radius: var(--r);
    overflow: hidden;
    background: var(--bg-white);
    transition: border-color .2s, box-shadow .2s;
  }

  .wr-spec-card:hover {
    border-color: var(--red);
    box-shadow: 0 4px 16px rgba(220, 38, 38, .07);
  }

  .wr-spec-card__img {
    width: 160px;
  }

  .wr-spec-card__img .wr-placeholder {
    min-height: 100%;
    border: none;
    border-radius: 0;
  }

  .wr-spec-card__body {
    padding: var(--sp-sm);
    display: flex;
    justify-content: center;
    flex-direction: column;
    gap: 6px;
  }

  .wr-spec-card__cat {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--red);
  }

  .wr-spec-card__name {
    font-size: 14px;
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1.3;
  }

  .wr-spec-card__desc {
    font-size: 13px;
    color: var(--text-mid);
    line-height: 1.5;
    flex: 1;
  }

  /* ════════════════════════════════════════
   FILM TYPES
════════════════════════════════════════ */
  .wr-film {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-light);
  }

  .wr-film__intro-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-lg);
    margin-top: var(--sp-md);
    align-items: start;
  }

  .wr-film__callout {
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-top: 3px solid var(--red);
    border-radius: var(--r);
    padding: var(--sp-md);
  }

  .wr-film__callout p {
    font-size: 15px;
    color: var(--text-mid);
    line-height: 1.8;
  }

  .wr-film__callout p strong {
    color: var(--red);
  }

  /* HAND FILM */
  .wr-film__section-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--text-dark);
    margin: var(--sp-lg) 0 var(--sp-md);
    padding-bottom: 10px;
    border-bottom: 2px solid var(--border);
    display: flex;
    align-items: center;
    gap: var(--sp-sm);
  }

  .wr-film__section-title span {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--red);
    background: var(--red-soft);
    padding: 3px 10px;
    border-radius: 100px;
  }

  .wr-film__hand-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-lg);
    align-items: start;
  }

  .wr-film__specs {
    display: flex;
    flex-direction: column;
    gap: var(--sp-sm);
  }

  .wr-film__spec {
    display: flex;
    gap: var(--sp-sm);
    align-items: flex-start;
  }

  .wr-film__spec-key {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: var(--text-mid);
    min-width: 150px;
    padding-top: 2px;
    flex-shrink: 0;
  }

  .wr-film__spec-val {
    font-size: 14px;
    color: var(--text-dark);
    line-height: 1.5;
  }

  /* MACHINE FILM GRADES */
  .wr-film__grades {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--sp-sm);
    margin-top: var(--sp-md);
  }

  .wr-grade-card {
    background: var(--bg-white);
    border: 1px solid var(--border);
    border-radius: var(--r);
    overflow: hidden;
    transition: border-color .2s, box-shadow .2s, transform .2s;
  }

  .wr-grade-card:hover {
    border-color: var(--red);
    box-shadow: 0 4px 16px rgba(220, 38, 38, .07);
    transform: translateY(-2px);
  }

  .wr-grade-card__img {
    width: 100%;
  }

  .wr-grade-card__body {
    padding: var(--sp-sm);
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .wr-grade-card__tier {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--red);
  }

  .wr-grade-card__name {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1.2;
  }

  .wr-grade-card__tech {
    font-size: 12px;
    color: var(--text-mid);
    font-style: italic;
  }

  .wr-grade-card__desc {
    font-size: 13px;
    color: var(--text-mid);
    line-height: 1.5;
    border-top: 1px solid var(--border);
    padding-top: 8px;
    margin-top: 4px;
  }

  /* FILM MACHINE SPECS */
  .wr-film__machine-specs {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-lg);
    align-items: start;
  }

  .wr-film__note {
    margin-top: var(--sp-md);
    padding: var(--sp-sm) var(--sp-md);
    border-left: 3px solid var(--red);
    background: var(--red-soft);
    border-radius: 0 var(--r) var(--r) 0;
    font-size: 14px;
    color: var(--text-mid);
    line-height: 1.7;
  }

  .wr-film__note strong {
    color: var(--text-dark);
  }

  /* ════════════════════════════════════════
   ENVIRONMENT
════════════════════════════════════════ */
  .wr-env {
    padding: var(--sp-lg) 0;
    border-bottom: 1px solid var(--border);
    background: var(--bg-white);
  }

  .wr-env__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--sp-lg);
    margin-top: var(--sp-md);
  }

  .wr-env__block h3 {
    font-size: 17px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 8px;
  }

  .wr-env__block p,
  .wr-env__block li {
    font-size: 14px;
    color: var(--text-mid);
    line-height: 1.75;
  }

  .wr-env__block ul {
    list-style: none;
  }

  .wr-env__block li {
    padding-left: 16px;
    position: relative;
    margin-bottom: 5px;
  }

  .wr-env__block li::before {
    content: '·';
    position: absolute;
    left: 0;
    color: var(--red);
    font-size: 18px;
    line-height: 1.2;
  }

  .wr-env__block>*+* {
    margin-top: var(--sp-md);
  }

  /* ════════════════════════════════════════
   AUTHOR
════════════════════════════════════════ */
  .wr-author {
    padding: var(--sp-lg) 0;
    background: var(--bg-light);
    border-top: 1px solid var(--border);
  }

  .wr-author__card {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 0;
    border: 1px solid var(--border);
    border-radius: var(--r);
    overflow: hidden;
    max-width: 680px;
    background: var(--bg-white);
  }

  .wr-author__accent {
    width: 5px;
    background: var(--red);
    flex-shrink: 0;
  }

  .wr-author__body {
    padding: var(--sp-md);
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .wr-author__meta-row {
    display: flex;
    align-items: center;
    gap: var(--sp-sm);
    flex-wrap: wrap;
  }

  .wr-author__avatar-initials {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--bg-mid);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 800;
    color: var(--red);
    letter-spacing: -.03em;
    flex-shrink: 0;
    border: 1.5px solid var(--border);
  }

  .wr-author__name {
    font-size: 16px;
    font-weight: 800;
    color: var(--text-dark);
    letter-spacing: -.01em;
  }

  .wr-author__role {
    font-size: 13px;
    color: var(--text-mid);
  }

  .wr-author__written-by {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .13em;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 4px;
  }

  /* ════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════ */
  @media (max-width: 1024px) {
    .wr-spec-grid {
      grid-template-columns: 1fr;
    }

    .wr-speeds__grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 900px) {

    .wr-hero__grid,
    .wr-intro__grid,
    .wr-panel__grid,
    .wr-pretreat__grid,
    .wr-cycles__grid,
    .wr-env__grid,
    .wr-film__intro-grid,
    .wr-film__hand-grid,
    .wr-film__machine-specs {
      grid-template-columns: 1fr;
    }

    .wr-film__grades {
      grid-template-columns: 1fr 1fr;
    }

    .wr-equip-intro {
      grid-template-columns: 1fr;
    }

    .wr-spec-card {
      grid-template-columns: 120px 1fr;
    }

    .wr-spec-card__img {
      width: 120px;
    }
  }

  @media (max-width: 600px) {
    :root {
      --sp-lg: 40px;
    }

    .wr-equip-grid {
      grid-template-columns: 1fr 1fr;
    }

    .wr-speeds__grid,
    .wr-film__grades {
      grid-template-columns: 1fr;
    }

    .wr-spec-card {
      grid-template-columns: 1fr;
    }

    .wr-spec-card__img {
      width: 100%;
    }

    h2.wr-h2 {
      font-size: 22px;
    }

    .wr-tab {
      padding: 10px 14px;
      font-size: 13px;
    }

    .wr-author__card {
      grid-template-columns: 1fr;
    }

    .wr-author__accent {
      width: 100%;
      height: 4px;
    }
  }
</style>

<!-- ═══ BREADCRUMB ═══════════════════════════════════════════ -->
<div class="wr-bc">
  <div class="wr-wrap">
    <?php if (function_exists('woocommerce_breadcrumb')) {
      woocommerce_breadcrumb();
    } else { ?>
      <a href="<?php echo esc_url(home_url('/')); ?>">Forside</a>
      <span class="sep">/</span>
      <span>Wrapping</span>
    <?php } ?>
  </div>
</div>

<!-- ═══ HERO ════════════════════════════════════════════════ -->
<section class="wr-hero">
  <div class="wr-wrap">
    <div class="wr-hero__grid">

      <div class="wr-hero__text">
        <div class="wr-hero__eyebrow">Wrapping</div>
        <h1>Pallevikling</em></h1>
        <p class="wr-hero__sub">Lær alt om palleomvikling. Hvordan du får det bedste ud af vikling.
          Hvad det kan og ikke kan</p>
      </div>
    </div>
  </div>
</section>

<hr class="wr-rule">

<!-- ═══ EQUIPMENT CARDS ══════════════════════════════════════ -->
<section class="wr-equipment">
  <div class="wr-wrap">

    <div class="wr-equip-intro">
      <div>
        <h2 class="wr-h2">Typisk udstyr til pallevikling</h2>
      </div>
      <div class="wr-type-legend">
        <span class="wr-badge wr-badge--manual">Manuelt</span>
        <span class="wr-badge wr-badge--semi">Semi Automatisk</span>
        <span class="wr-badge wr-badge--auto">Automatisk</span>
        <span class="wr-badge wr-badge--full">Fuld Automatisk</span>
      </div>
    </div>

    <div class="wr-equip-grid">

      <div class="wr-equip-card">
        <div class="wr-equip-card__img" data-type="Manuelt">
          <?php wr_img('hand_film_set', 'wr-ph--card'); ?>
        </div>
        <div class="wr-equip-card__body">
          <div class="wr-equip-card__name">Håndfilms dispenser</div>
          <!-- <div class="wr-equip-card__desc">Til håndfilm 450/500 mm bredde. Ergonomisk vikling ved lave volumer. Inkl.
            kerne­bremse.</div>
          <a href="#" class="wr-equip-card__link">Se produkt</a> -->
        </div>
      </div>

      <div class="wr-equip-card">
        <div class="wr-equip-card__img" data-type="Semi Auto">
          <?php wr_img('e3wrap2100', 'wr-ph--card'); ?>
        </div>
        <div class="wr-equip-card__body">
          <div class="wr-equip-card__name">E3 Wrap 2100</div>
          <!-- <div class="wr-equip-card__desc">Semi automatisk pallevikler. Tårn­type med drejeskive. Manuelt påsætning og
            afskæring af folie.</div>
          <a href="#" class="wr-equip-card__link">Se produkt</a> -->
        </div>
      </div>

      <div class="wr-equip-card">
        <div class="wr-equip-card__img" data-type="Automatisk">
          <?php wr_img('exp501', 'wr-ph--card'); ?>
        </div>
        <div class="wr-equip-card__body">
          <div class="wr-equip-card__name">EXP-501</div>
          <!-- <div class="wr-equip-card__desc">Automatisk pallevikler. Holder selv folien efter afskæring og starter selv
            processen. Pallen håndteres manuelt.</div>
          <a href="#" class="wr-equip-card__link">Se produkt</a> -->
        </div>
      </div>

      <div class="wr-equip-card">
        <div class="wr-equip-card__img" data-type="Fuld Auto">
          <?php wr_img('exp702', 'wr-ph--card'); ?>
        </div>
        <div class="wr-equip-card__body">
          <div class="wr-equip-card__name">EXP-702</div>
          <!-- <div class="wr-equip-card__desc">Fuld automatisk pallevikler. Håndterer og vikler pallen uden menneskelig
            indblanding via rullerbaner.</div>
          <a href="#" class="wr-equip-card__link">Se produkt</a> -->
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══ INTRO ══════════════════════════════════════════════ -->
<section class="wr-intro">
  <div class="wr-wrap">
    <div class="wr-intro__grid">

      <div>
        <div class="wr-label">Proces</div>
      </div>
    </div>

    <div>
      <p class="wr-intro__body">Med vikling tilfører man en folie omkring et eller flere produkter med det formål at
        stabilisere, beskytte, tyveri sikre godset. Der er to hoved grene af processen.</p>
      <p class="wr-intro__body">Vertikal vikling kendt som pallevikling og horisontal vikling kendt ved samme navn. I
        forbindelse med at man tilfører folie kan man ved den forspændning og forlængelse man tilfører folien, tilfører
        folien sekundære egenskaber pga. af dens stræk og krympeforhold.</p>
      <p class="wr-intro__body">Alle produkter der kan modstå trækket fra folien kan principielt vikles. Det er således
        vigtigt at det produkt der skal vikles kan stabileres og fastholdes før og under, at processen gennemføres.
      </p>
    </div>

  </div>
  </div>
</section>

<!-- ═══ FILM PRETREATMENT ═══════════════════════════════════ -->
<section class="wr-pretreat">
  <div class="wr-wrap">
    <!-- <div class="wr-label">Folie­forbehandling</div> -->
    <h2 class="wr-h2">Forbehandling af folien ved vikling</h2>

    <div class="wr-pretreat__grid">

      <div class="wr-pretreat__col">
        <ul class="wr-pretreat__list">
          <li>
            <strong>Bremse forstræk direkte fra rullen, kernen bremses, produktet/pallen trækker folien af
              rullen.</strong>
          </li>
          <li>
            <strong>Bremse forstræk via rullesystem, rullerne bremses, produktet/pallen trækker folien igennem rullerne.
            </strong>
            Mekanisk justerbar bremse forstræk
            <br>
            Magnetisk/elektrisk justerbar bremse forstræk
          </li>
        </ul>
      </div>

      <div class="wr-pretreat__col">
        <ul class="wr-pretreat__list">
          <li>
            <strong>Motoriseret forstræk via rullesystem, rullerne reguleres, produktet filmes med små
              angrebskræfter.</strong>
            Fast for stræks grad
            <br>
            Variable for stræks grad
          </li>
          <li>
            <strong>Forbehandlet folie, der benyttes i forbindelse med overnævnte processer.</strong>
            Fortrukket folie
            <br>
            Perforeret folie
          </li>
        </ul>
      </div>

    </div>
  </div>
</section>



<!-- ═══ PROCESS CYCLES ══════════════════════════════════════ -->
<section class="wr-cycles">
  <div class="wr-wrap">
    <!-- <div class="wr-label">Vikle­cyklus</div> -->
    <h2 class="wr-h2">
      Begreber ved pallevikling – Vertikal vikling</h2>

    <div class="wr-cycles__grid">

      <div>
        <!-- <h3 class="wr-h3" style="font-size:18px; margin-bottom:var(--sp-sm);">Pallevikling begreber</h3> -->
        <div style="display:flex; flex-direction:column; gap:var(--sp-sm);">

          <div
            style="padding:var(--sp-sm); border:1px solid var(--border); border-radius:var(--r); background:var(--bg-white);">
            <div style="font-size:13px; font-weight:700; color:var(--text-dark); margin-bottom:4px;">Pallevikling
              almindelig: Pallen vikles for stabilitet under transport i dag til dag distribution.</div>
            <div style="font-size:13px; color:var(--text-mid); line-height:1.5;">Alm. Klar folie for den almindelige
              distribution</div>
          </div>

          <div
            style="padding:var(--sp-sm); border:1px solid var(--border); border-radius:var(--r); background:var(--bg-white);">
            <div style="font-size:13px; font-weight:700; color:var(--text-dark); margin-bottom:4px;">Pallevikling
              almindelig og opbevaring: Pallen vikles for stabilitet og beskyttelse af produktet over længere tid,
              herunder</div>
            <div style="font-size:13px; color:var(--text-mid); line-height:1.5;">Støvtæt pallevikling, top film anvendes
              <br>
              Vandtæt pallevikling, top film anvendes
              <br>
              UV lys beskyttelse af produktet
              <br>
              Sort folie for at tyveri sikre “dyre” produkter, der om de var synlig let kunne stjæles i
              distributionsledet mv.
              <br>
              Folie med særlige
              egenskaber som f.eks. rustbeskyttelse mv.
              <br>
              Forsegling af produktet
            </div>
          </div>

          <div
            style="padding:var(--sp-sm); border:1px solid var(--border); border-radius:var(--r); background:var(--bg-white);">
            <div style="font-size:13px; font-weight:700; color:var(--text-dark); margin-bottom:4px;">Andre variable i
              vikle processen</div>
            <div style="font-size:13px; color:var(--text-mid); line-height:1.5;">Antal top og bund viklinger. Dette
              reguleres enten på tid eller på antal. Antal er den bedste løsning.</div>
          </div>
        </div>
      </div>
      <div>
        <h3 class="wr-h3" style="font-size:18px; margin-bottom:var(--sp-sm);">Proces cyklus:</h3>
        <ul class="wr-cycle-list">
          <li><span class="wr-cycle-num">1</span>Bund – Top – Bund</li>
          <li><span class="wr-cycle-num">2</span>Bund med høj hastighed til – Top – Bund</li>
          <li><span class="wr-cycle-num">3</span>Top – Bund</li>
          <li><span class="wr-cycle-num">4</span>Bund – Mavebælte – Top – Bund</li>
          <li><span class="wr-cycle-num">5</span>Bund – Top – Niveau nedeunder topfolie – Pause – Top – Bund</li>
          <li><span class="wr-cycle-num">6</span>Single niveau</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ═══ PROCESS TABS ════════════════════════════════════════ -->
<section class="wr-process">
  <div class="wr-wrap">
    <!-- <div class="wr-label">Processer</div> -->
    <h2 class="wr-h2">
      I forhold til de forskellige processer vil det udstyr der finder anvendelse</h2>
    <br>
    <div class="wr-tabs" role="tablist">
      <button class="wr-tab is-active" data-tab="manuel" role="tab" aria-selected="true">Manuelt</button>
      <button class="wr-tab" data-tab="semi" role="tab" aria-selected="false">Semi Automatisk</button>
      <button class="wr-tab" data-tab="auto" role="tab" aria-selected="false">Automatisk</button>
      <button class="wr-tab" data-tab="fullauto" role="tab" aria-selected="false">Fuld Automatisk</button>
      <button class="wr-tab" data-tab="other" role="tab" aria-selected="false">Andet</button>

    </div>

    <!-- MANUEL -->
    <div class="wr-panel is-active" data-panel="manuel" role="tabpanel">
      <div class="wr-panel__grid">
        <div class="wr-panel__text">
          <h3>Manuelt</h3>
          <p>Generelt: Den fysiske dimension som f.eks. højde og håndterings vægt sætter begrænsninger for manuel
            håndvikling.</p>
          <p>
            <strong>Håndfilms dispenser for hånd film 450 eller 500mm bredde.</strong><br>
            <strong>Håndfilms håndtag for miniruller 100 til 125mm bredde.</strong><br>
            <strong>Fortrukken håndfilm for direkte
              vikling uden
              sekundære værktøj.</strong>
          </p>

        </div>

      </div>
    </div>

    <!-- SEMI -->
    <div class="wr-panel" data-panel="semi" role="tabpanel">
      <div class="wr-panel__grid">
        <div class="wr-panel__text">
          <h3>Semi-automatisk</h3>
          <p>Generelt: Den fysiske dimension som f.eks. højde, diameter og håndterings vægt sætter begrænsninger for
            hvad hver enkelt maskine kan udfører. Hver maskine serie vil typisk have et antal optioner der muliggør øget
            dimension, vægt og diameter, dette gælder for alle maskiner semi automatisk, automatiske og fuld
            automatiske.
          </p>
          <p><strong>Grundlæggende maskine koncepter er:</strong> Tårn type med drejeskive, pallen drejer <br>
            Satalite type hvor folie aggregatet føres rundt om pallen. <br>
            Tårn type med drejeskive med horisontal ruller hvor produkt rulle drejes <br> Kombination af drejeskive,
            satalite førte aggregater for ekstrem proces hastigheder.</p>
          <p><strong>Semi automatisk pallevikler EXP-408, hvor man manuelt påsætter folien på pallen inden processen
              startes og tilsvarende skærer folien når processen er afsluttet. Simple løsning.</strong>
          </p>
          <p><strong>Semi automatisk pallevikler EXP-108, hvor man manuelt påsætter folien på pallen inden processen
              startes, men hvor maskinen selv skærer folien når processen er afsluttet. Avanceret løsning.</strong>
          </p>
          <p><strong>Top film med manuel proces, hvor vikleren har pause funktion</strong>
          </p>
        </div>

      </div>
    </div>

    <!-- AUTO -->
    <div class="wr-panel" data-panel="auto" role="tabpanel">
      <div class="wr-panel__grid">
        <div class="wr-panel__text">
          <h3>Automatisk</h3>
          <p><strong>Automatisk pallevikler EXP-501 som selv holder folien efter afskæring og selv kan starte processen,
              så eneste bidrag er pallen der håndteres manuelt med truck, stabler eller pallevogn.</strong></p>
          <p>
            <strong>Top film med manuel proces eller med automatisk integreret løsning STEP HB 800</strong>
          </p>

        </div>

      </div>
    </div>

    <!-- FULD AUTO -->
    <div class="wr-panel" data-panel="fullauto" role="tabpanel">
      <div class="wr-panel__grid">
        <div class="wr-panel__text">
          <h3>Fuld automatisk</h3>
          <p>
            <strong>Fuld automatisk paller vikler EXP-202A vikler og håndtere pallen uden menneskelig indblanding.
              Pallen transporteres ind på rullebaner, vikles og transporteres ud efterfølgende. Det er vigtigt at pallen
              har den nødvendige stabilitet for denne interne transport.</strong>
          </p>
          <p>
            <strong>Top film som fuld automatisk integreret løsning.</strong>
          </p>

        </div>

      </div>
    </div>
    <!-- OTHER -->
    <div class="wr-panel" data-panel="other" role="tabpanel">
      <div class="wr-panel__grid">
        <div class="wr-panel__text">
          <h3>Andet udstyr der med fordel kan integreres omkring vikle processen</h3>
          <p>
            <strong>Vejning af pallen med indbygget vægt i vikleren.</strong>
          </p>
          <p>
            <strong>Data opsamling omkring den pakkede palle. De indsamlede data indsamles og lagres op imod ERP
              system ved hjælp af STEP Data Exchange System.</strong>
            Scanning af palle registrerings nr. <br>
            Vægtfunktion. <br>
            Opmåling ad dimensioner <br>
            Billede af pallen <br>
            Video af pallen 360° rotation
          </p>
          <p>
            <strong>Top films dispenser.</strong>
          </p>
          <p>
            <strong>Top plade for stabilisering af pallen under vikling.</strong>
          </p>
          <p>
            <strong>Rulle baner på drejeskive og til/afgang for manuel eller automatisk palle skift.</strong>
          </p>
          <p>
            <strong>Labelopmærkning af pallen.</strong>
          </p>
        </div>

      </div>
    </div>
</section>

<!-- ═══ SPEEDS ══════════════════════════════════════════════ -->
<section class="wr-speeds">
  <div class="wr-wrap">
    <!-- <div class="wr-label">Kapacitet</div> -->
    <h2 class="wr-h2">Typiske proceshastigheder ved valg af maskine type/proces, dog afhængig af sum funktion, palle
      dimensioner, produkt, film valg mv.</h2>
    <br>
    <!-- <p style="font-size:15px; color:var(--text-mid); max-width:640px; line-height:1.7;">Afhænger af sum­funktion,
      palledimensioner, produkt­type, filmvalg mv. Tallene er vejledende.</p> -->

    <div class="wr-speeds__grid">

      <div class="wr-speed-card">
        <div class="wr-speed-card__type">Manuelt</div>
        <div class="wr-speed-card__rate">5–10</div>
        <div class="wr-speed-card__unit">paller dagen</div>
        <div class="wr-speed-card__note">En person vil formentlig kunne vikle flere paller per dag men det kan bestemt
          ikke anbefales som en varig løsning pga. det negative arbejdsmiljømæssige input herfra.</div>
      </div>

      <div class="wr-speed-card">
        <div class="wr-speed-card__type">Semi Automatisk</div>
        <div class="wr-speed-card__rate">5–100</div>
        <div class="wr-speed-card__unit">paller om dagen</div>
        <div class="wr-speed-card__note"></div>
      </div>

      <div class="wr-speed-card">
        <div class="wr-speed-card__type">Automatisk</div>
        <div class="wr-speed-card__rate">5–30</div>
        <div class="wr-speed-card__unit">paller i timen</div>
        <div class="wr-speed-card__note"></div>
      </div>

      <div class="wr-speed-card">
        <div class="wr-speed-card__type">Fuld Automatisk</div>
        <div class="wr-speed-card__rate">5–45</div>
        <div class="wr-speed-card__unit">paller i timen</div>
        <div class="wr-speed-card__note"></div>
      </div>
    </div>
    <br>
    <p>
      <strong>Fuld automatisk, projekteret fuldoptimale løsninger, op til 70-100 paller i timen</strong><br> viklings og
      pakke linjer med indarbejdning af mange proces typer kan sammensættes i projekt specificeret løsnings koncepter
      og linjer. Der kan i mange tilfælde anvendes flere teknologier, der sikre hvert element udnyttes optimalt,
      hvorved materiale og energi forbrug minimeres, samt at der indsamles og behandles data, der sikre højre kvalitet
      og informations niveauer.
    </p>

  </div>
  </div>
</section>

<!-- ═══ SPECIALIST / OTHER EQUIPMENT ═══════════════════════ -->
<section class="wr-specialist">
  <div class="wr-wrap">
    <!-- <div class="wr-label">Tilbehør &amp; Specialudstyr</div> -->
    <h2 class="wr-h2">Andre maskine­typer &amp; integrationer</h2>
    <br>
    <div class="wr-spec-grid">

      <div class="wr-spec-card">
        <div class="wr-spec-card__img">
          <?php wr_img('exr401', 'wr-ph--square'); ?>
        </div>
        <div class="wr-spec-card__body">
          <div class="wr-spec-card__cat">Horisontal vikling</div>
          <div class="wr-spec-card__name">EXR-401</div>
          <!-- <div class="wr-spec-card__desc">Horisontal vikling af paller. Ergonomisk løsning til horizontale
            strappings­krav — kan flyttes uden at løfte pallen.</div>
          <a href="#" class="wr-equip-card__link" style="margin-top:auto;">Se produkt</a> -->
        </div>
      </div>

      <div class="wr-spec-card">
        <div class="wr-spec-card__img">
          <?php wr_img('roll_wrapping', 'wr-ph--square'); ?>
        </div>
        <div class="wr-spec-card__body">
          <div class="wr-spec-card__cat">Rulle vikling</div>
          <!-- <div class="wr-spec-card__name">Rulle viklings­maskine</div> -->
          <!-- <div class="wr-spec-card__desc">Tårn­type med drejeskive og horisontal ruller. Produktrullen drejes inde på
            drejeskiven under vikling.</div>
          <a href="#" class="wr-equip-card__link" style="margin-top:auto;">Se produkt</a> -->
        </div>
      </div>

      <div class="wr-spec-card">
        <div class="wr-spec-card__img">
          <?php wr_img('data_exchange', 'wr-ph--square'); ?>
        </div>
        <div class="wr-spec-card__body">
          <div class="wr-spec-card__cat">Data capture pakke</div>
          <div class="wr-spec-card__name">STEP Data Exchange System</div>
          <!-- <div class="wr-spec-card__desc">Dataindfangst­pakke til den pakkede palle. Data indsamles og lagres op mod
            ERP-system. Inkl. scanning, vejning, dimensionsmåling, billede og 360° video.</div>
          <a href="#" class="wr-equip-card__link" style="margin-top:auto;">Se produkt</a> -->
        </div>
      </div>

      <div class="wr-spec-card">
        <div class="wr-spec-card__img">
          <?php wr_img('topfilm_tf1500', 'wr-ph--square'); ?>
        </div>
        <div class="wr-spec-card__body">
          <div class="wr-spec-card__cat">Top film stativ</div>
          <div class="wr-spec-card__name">STEP TF 1500</div>
          <!-- <div class="wr-spec-card__desc">Top­film stativ til manuel eller automatisk integreret top­film­påsætning.
            Sikrer støv- og vandtæt topforsegling af pallen.</div>
          <a href="#" class="wr-equip-card__link" style="margin-top:auto;">Se produkt</a> -->
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ═══ FILM TYPES ══════════════════════════════════════════ -->
<section class="wr-film">
  <div class="wr-wrap">
    <!-- <div class="wr-label">Folie typer</div> -->
    <h2 class="wr-h2">Folie Typer</h2>
    <br>
    <div class="wr-film__intro-grid">
      <div class="wr-film__callout">
        <p>Overordnet betragtning og realitet: <strong> <br>
            Der er dyrt at bruge en billig film</strong> </p>
      </div>
      <div>
        <p style="font-size:15px; color:var(--text-mid); line-height:1.8;">Der er yderst vigtigt at den rigtige film
          anvendes til det rigtige formål, således det sikres man få en pris optimal vikling af sit produkt. Dette valg,
          starter ved valg af maskine, aggregat type, proces punkt i relation til ens produktions flow, materiale valg
          og sekundære processer der har indflydelse på hele emballerings processen, blandet stabilitet ved intern
          flytning fra proces punkt til vikler. </p>
      </div>
    </div>

    <!-- HÅNDFILM -->
    <div class="wr-film__section-title">Håndfilm</div>
    <div class="wr-film__hand-grid">
      <div class="wr-film__specs">
        <div class="wr-film__spec">
          <span class="wr-film__spec-key">Type</span>
          <span class="wr-film__spec-val">LDPE cast eller blæst, klar, hvidt, sort, andre farver</span>
        </div>
        <div class="wr-film__spec">
          <span class="wr-film__spec-key">Tillægsegenskaber</span>
          <span class="wr-film__spec-val">UV, rust beskyttelse</span>
        </div>
        <div class="wr-film__spec">
          <span class="wr-film__spec-key">Thickness</span>
          <span class="wr-film__spec-val">9 to 35my</span>
        </div>
        <div class="wr-film__spec">
          <span class="wr-film__spec-key">Width</span>
          <span class="wr-film__spec-val"> 450-500mm for håndfilm på kerne ø50 – ø76 samt kerneløse typer. Håndruller 75
            til 150mm på kerne ø76.</span>
        </div>
        <div class="wr-film__spec">
          <span class="wr-film__spec-key">Forstræksgrad</span>
          <span class="wr-film__spec-val">almindelig, forstrukken</span>
        </div>

      </div>
    </div>

    <!-- MASKINFILM GRADES -->
    <div class="wr-film__section-title">Maskinfilm — Kvalitets­grader </div>

    <!-- MASKINFILM SPECS -->
    <div class="wr-film__machine-specs">
      <div>
        <div style="font-size:16px; font-weight:700; color:var(--text-dark); margin-bottom:var(--sp-sm);">LDPE cast
          eller blæst, klar, hvidt, sort, andre farver</div>
        <div style="display:flex; flex-direction:column; gap:8px;">
          <?php
          $features = [
            'Butene/Hektene typer med korte kæder.' => 'LDPE Lav Densitet med begrænset egenskaber omkring styrke og forlængelse. STEP Basic stretch.',
            'Oktene typer længere og forgrenet kæder.' => 'LLDPE Octene Liniær Lav Densitet med gode generelle egenskaber som styrke og forlængelse. STEP Advanced stretch.',
            'Metallocene typer med mange og vidt forgrenet kæder.' => 'Metallocene er en katalysator ikke en monomer som ethylene, men folie produceret hermed giver specielt gode styrke, rive og forlængelses egenskaber. STEP ultimate stretch.',
          ];
          foreach ($features as $title => $desc) {
            echo '<div style="padding:10px var(--sp-sm); background:var(--bg-white); border:1px solid var(--border); border-radius:var(--r);">'
              . '<div style="font-size:13px; font-weight:700; color:var(--text-dark);">' . esc_html($title) . '</div>'
              . '<div style="font-size:12px; color:var(--text-mid); margin-top:3px; line-height:1.5;">' . esc_html($desc) . '</div>'
              . '</div>';
          }
          ?>
        </div>
        <br>

      </div>
      <div class="wr-film__specs">
        <div class="wr-film__spec">
          <span class="wr-film__spec-key">Tillægsegenskaber</span>
          <span class="wr-film__spec-val">UV bestandig, UV, rust beskyttelse, perforeret, huller, tilført lim
            mv.</span>
        </div>
        <div class="wr-film__spec">
          <span class="wr-film__spec-key">Tykkelse</span>
          <span class="wr-film__spec-val">9 to 35my</span>
        </div>
        <div class="wr-film__spec">
          <span class="wr-film__spec-key">Bredde</span>
          <span class="wr-film__spec-val">500mm på kerne ø76mm og yder diameter op til 250mm, almindelig Europæisk
            oplægning. Jumbo ruller bredde 750mm med ydrediameter op til ø450mm.</span>
        </div>
        <div class="wr-film__spec">
          <span class="wr-film__spec-key">Forstræksgrad</span>
          <span class="wr-film__spec-val">100% til 400%, forstrukken. Typiske handelsvarer I Danmark er 150%, 280% og
            300% forstræksgrad.</span>
        </div>
        <div class="wr-film__spec">
          <span class="wr-film__spec-key">Klæb</span>
          <span class="wr-film__spec-val">Indvendig eller udvendig klæb.</span>
        </div>
        <div class="wr-film__spec">
          <span class="wr-film__spec-key">Afregning</span>
          <span class="wr-film__spec-val">Afregning brutto for netto DKK/kg eller brutto for netto DKK/rulle med et
            antal meter i given tykkelse</span>
        </div>
      </div>

    </div>

    <div class="wr-film__note">
      <strong>Oplægning:</strong> Maskinfolie pakkes på paller typisk i 2 eller 3 lag opretstående. Folieruller må ikke
      ligge ned af hensyn til balance, anslåning og krybbe forhold under opbevaring. Hvert lag pakkes typisk med enten
      15 (inden for en Euro palle uden udhæng) eller 22 ruller hvor folien pakkes med udhæng på pallen. Andre varianter
      eksisterer.
    </div>

  </div>
</section>

<!-- ═══ ENVIRONMENT ═══════════════════════════════════════ -->
<section class="wr-env">
  <div class="wr-wrap">
    <!-- <div class="wr-label">Miljø &amp; Sikkerhed</div> -->
    <h2 class="wr-h2">Miljø forhold</h2>
    <br>
    <div class="wr-env__grid">

      <div class="wr-env__block">
        <h3>PE materialets sammensætning, er af særlig interesse da dette ofte varmsvejses</h3>
        <ul>
          <li>Polyethylene ca. 98 %</li>
          <li>Farve pigment ikke giftigt ca. 1–2 %</li>
        </ul>

        <h3>Toksiske og reaktions egenskaber</h3>
        <ul>
          <li>Polyethylene er kemisk og biologisk inaktiv.</li>
          <li>Polyethylene kan benyttes direkte i forbindelse med
            fødevarer.</li>
        </ul>

        <h3>Brændbarhed</h3>
        <ul>
          <li>Når polyethylen opvarmes i luft, vil materialet smelte ved ca. 109-125.</li>
        </ul>

        <h3>Forbrænding</h3>
        <p>Kontrolleret forbrænding anbefales. Når antændt vil materialet fortsætte med at brænde, selv efter at
          antændelseskilden er fjernet. Dekompositionsprodukterne fra forbrændinger er H20 og CO2 . Hvis afbrændt ved
          lav tilstedeværelse af ilt vil forbrændingen også producere monooxide, hvilket er giftigt. </p>

      </div>

      <div class="wr-env__block">
        <h3>Svejsning, limning og trykning af PE materiale</h3>
        <p>Det anbefales af Arbejdstilsynet, at svejsedampe fra plastsvejsning ventileres til det fri, hvor det er
          muligt. Ved svejsning ved en temperatur under 150 må røg og dampudvikling anses for at være minimal, uden
          nogen fare. Det anbefales dog altid at sørge for passende udluftning af hensyn til det almindelige
          velbefindende. </p>

        <div class="wr-alert">
          PE kan friktions svejse og ultralyds svejses uden at der behøves etableret af sugning, da alle svejse dampe
          ind kables i svejsezonen.
        </div>

        <div class="wr-alert" style="margin-top:var(--sp-sm);">
          PE har en lav overfladespænding og kan derfor kun limes og påtrykkes tekst efter behandling af overfladen.
        </div>

        <h3>Fysisk kontakt</h3>
        <ul>
          <li>Der er ingen risiko, udover den mekaniske.</li>
        </ul>

        <h3>Genbrug</h3>
        <ul>
          <li>
            PE materialer er velegnet til genbrug.
          </li>
        </ul>
      </div>

    </div>
  </div>
</section>

<!-- ═══ AUTHOR ══════════════════════════════════ -->
<section class="wr-author">
  <div class="wr-wrap">
    <div class="wr-label">
      Forfatter til artiklen</div>
    <div class="wr-author__card">
      <div class="wr-author__accent"></div>
      <div class="wr-author__body">
        <div class="wr-author__meta-row">
          <div>
            <div class="wr-author__name">Gunnar Salbæk</div>
            <div class="wr-author__role">CEO / Industrial Design med mere end 30 års erfaring i fagområdet.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  (function () {
    var tabs = document.querySelectorAll('.wr-tab');
    var panels = document.querySelectorAll('.wr-panel');
    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        var target = this.getAttribute('data-tab');
        tabs.forEach(function (t) { t.classList.remove('is-active'); t.setAttribute('aria-selected', 'false'); });
        panels.forEach(function (p) { p.classList.remove('is-active'); });
        this.classList.add('is-active');
        this.setAttribute('aria-selected', 'true');
        var panel = document.querySelector('[data-panel="' + target + '"]');
        if (panel) panel.classList.add('is-active');
      }.bind(tab));
    });
  })();
</script>

<?php get_footer(); ?>