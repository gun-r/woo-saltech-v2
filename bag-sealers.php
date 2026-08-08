<?php
/**
 * Template Name: Bag Sealers Page
 *
 * Custom page template for the Sal-Tech "Bag Sealers" page.
 *
 * @package SalTech
 */


defined('ABSPATH') || exit;

get_header();

$bag_images = [

    /* ── PROCESS ── */
    'illustration' => ['src' => get_stylesheet_directory_uri() . '/assets/img/bagsealers/unnamed.png', 'alt' => 'Typisk udstyr til poseforsegling og plastforsegling'],
];

function bag_img($key, $extra_class = '')
{
    global $bag_images;
    $img = $bag_images[$key] ?? ['src' => '', 'alt' => $key];

    if (!empty($img['src'])) {
        echo '<img src="' . esc_url($img['src']) . '" alt="' . esc_attr($img['alt']) . '" class="bag-img ' . esc_attr($extra_class) . '" loading="lazy">';
    } else {
        echo '<div class="bag-placeholder ' . esc_attr($extra_class) . '" title="' . esc_attr('Billede: ' . $img['alt']) . '">'
            . '<div class="bag-placeholder__inner">'
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

    .bag-wrap {
        max-width: var(--max-w);
        margin: 0 auto;
        padding: 0 var(--sp-md);
    }

    /* ── IMAGES / PLACEHOLDERS ── */
    .bag-img {
        /* display: block;
        width: 100%;
        height: 100px;
        object-fit: contain;
        border-radius: var(--r); */
    }

    .bag-placeholder {
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

    .bag-placeholder:hover {
        border-color: var(--red);
    }

    .bag-placeholder__inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        padding: var(--sp-md);
        text-align: center;
    }

    .bag-placeholder__inner svg {
        opacity: .3;
    }

    .bag-placeholder__inner span {
        font-size: 11px;
        color: var(--text-mid);
        max-width: 160px;
        line-height: 1.4;
        opacity: .75;
    }

    .bag-ph--hero {
        min-height: 420px;
    }

    .bag-ph--wide {
        min-height: 300px;
    }

    .bag-ph--card {
        min-height: 190px;
    }

    .bag-ph--square {
        min-height: 240px;
    }

    .bag-ph--thumb {
        min-height: 130px;
    }

    /* ── SECTION LABEL ── */
    .bag-label {
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

    .bag-label::before {
        content: '';
        display: block;
        width: 18px;
        height: 2px;
        background: var(--red);
    }

    /* ── HEADINGS ── */
    h2.bag-h2 {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -.02em;
        color: var(--text-dark);
        line-height: 1.2;
        margin-bottom: var(--sp-md);
    }

    h3.bag-h3 {
        font-size: 20px;
        font-weight: 700;
        letter-spacing: -.01em;
        color: var(--text-dark);
        margin-bottom: var(--sp-sm);
    }

    hr.bag-rule {
        border: none;
        border-top: 1px solid var(--border);
        margin: 0;
    }

    /* ── NOTICE / ALERT ── */
    .bag-notice {
        display: flex;
        gap: var(--sp-sm);
        align-items: flex-start;
        padding: var(--sp-sm) var(--sp-md);
        background: var(--red-soft);
        border-left: 3px solid var(--red);
        border-radius: 0 var(--r) var(--r) 0;
        margin-top: var(--sp-md);
    }

    .bag-notice svg {
        color: var(--red);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .bag-notice p {
        font-size: 14px;
        color: var(--text-dark);
        line-height: 1.6;
    }

    .bag-alert {
        background: var(--bg-light);
        border: 1px solid var(--border);
        border-left: 3px solid var(--red);
        border-radius: 0 var(--r) var(--r) 0;
        padding: var(--sp-sm) var(--sp-md);
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.7;
    }

    .bag-alert strong {
        color: var(--text-dark);
    }

    .bag-alert+.bag-alert {
        margin-top: var(--sp-sm);
    }

    /* ════════════════════════════════════════
   BREADCRUMB
════════════════════════════════════════ */
    .bag-bc {
        background: var(--bg-light);
        border-bottom: 1px solid var(--border);
        padding: 10px 0;
        font-size: 13px;
        color: var(--text-mid);
    }

    .bag-bc a {
        color: var(--text-mid);
    }

    .bag-bc a:hover {
        color: var(--red);
        text-decoration: none;
    }

    .bag-bc .sep {
        margin: 0 6px;
        color: var(--border);
    }

    /* ════════════════════════════════════════
   HERO
════════════════════════════════════════ */
    .bag-hero {
        background: var(--bg-light);
        border-bottom: 1px solid var(--border);
        /* padding: var(--sp-lg) 0 0; */
        overflow: hidden;
    }

    .bag-hero__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        align-items: end;
    }

    .bag-hero__text {
        /* padding-bottom: var(--sp-lg); */
    }

    .bag-hero__eyebrow {
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

    .bag-hero__eyebrow::before {
        content: '';
        display: block;
        width: 18px;
        height: 2px;
        background: var(--red);
    }

    .bag-hero h1 {
        font-size: clamp(36px, 5.5vw, 66px);
        font-weight: 900;
        letter-spacing: -.03em;
        line-height: 1.0;
        color: var(--text-dark);
        margin-bottom: var(--sp-sm);
    }

    .bag-hero h1 em {
        font-style: normal;
        color: var(--red);
    }

    .bag-hero__sub {
        font-size: 17px;
        color: var(--text-mid);
        line-height: 1.6;
        max-width: 480px;
        margin-bottom: var(--sp-md);
    }

    .bag-hero__stats {
        display: flex;
        gap: var(--sp-md);
        flex-wrap: wrap;
    }

    .bag-stat {
        display: flex;
        flex-direction: column;
    }

    .bag-stat-num {
        font-size: 26px;
        font-weight: 900;
        color: var(--text-dark);
        letter-spacing: -.03em;
        line-height: 1;
    }

    .bag-stat-lbl {
        font-size: 12px;
        color: var(--text-mid);
        margin-top: 2px;
    }

    .bag-hero__img {
        align-self: end;
    }

    /* ════════════════════════════════════════
   INTRO
════════════════════════════════════════ */
    .bag-intro {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .bag-intro__grid {
        display: grid;
        gap: var(--sp-lg);
        align-items: start;
    }

    .bag-intro__lead {
        font-size: 20px;
        line-height: 1.6;
        color: var(--text-dark);
    }

    .bag-intro__lead strong {
        color: var(--red);
        font-weight: 700;
    }

    .bag-intro__body {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
    }

    .bag-intro__body+.bag-intro__body {
        margin-top: var(--sp-sm);
    }

    /* ════════════════════════════════════════
   PROCESS
════════════════════════════════════════ */
    .bag-process {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .bag-process__grid {
        display: grid;
        gap: var(--sp-lg);
        align-items: start;
        margin-top: var(--sp-md);
    }

    .bag-process__text p {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
        margin-bottom: var(--sp-sm);
    }

    /* temp range visual */
    .bag-temp-bar {
        margin-top: var(--sp-md);
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--r);
        padding: var(--sp-sm) var(--sp-md);
    }

    .bag-temp-bar__label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--text-mid);
        margin-bottom: var(--sp-xs);
    }

    .bag-temp-bar__range {
        height: 8px;
        border-radius: 100px;
        background: linear-gradient(90deg, #FEF3C7 0%, #FDE68A 30%, #F59E0B 60%, var(--red) 100%);
        margin-bottom: 6px;
    }

    .bag-temp-bar__ends {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        font-weight: 700;
        color: var(--text-dark);
    }

    /* weld wire types */
    .bag-wire-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--sp-xs);
        margin-top: var(--sp-md);
    }

    .bag-wire-card {
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--r);
        padding: var(--sp-sm);
        text-align: center;
    }

    .bag-wire-card__size {
        font-size: 22px;
        font-weight: 900;
        color: var(--text-dark);
        letter-spacing: -.03em;
        line-height: 1.1;
    }

    .bag-wire-card__label {
        font-size: 11px;
        color: var(--text-mid);
        margin-top: 3px;
    }

    .bag-wire-card__type {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--red);
        margin-top: 4px;
    }

    /* ════════════════════════════════════════
   EQUIPMENT — grouped by type
════════════════════════════════════════ */
    .bag-equipment {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    /* type section heading */
    .bag-type-heading {
        display: flex;
        align-items: center;
        gap: var(--sp-sm);
        font-size: 16px;
        font-weight: 800;
        color: var(--text-dark);
        padding-bottom: 10px;
        border-bottom: 2px solid var(--border);
        margin-bottom: var(--sp-sm);
        letter-spacing: -.01em;
    }

    .bag-type-heading span {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--red);
        background: var(--red-soft);
        padding: 3px 10px;
        border-radius: 100px;
        margin-left: auto;
    }

    .bag-type-section {
        margin-bottom: var(--sp-lg);
    }

    .bag-type-section:last-child {
        margin-bottom: 0;
    }

    .bag-equip-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: var(--sp-sm);
    }

    .bag-equip-card {
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        background: var(--bg-white);
        transition: box-shadow .2s, border-color .2s, transform .2s;
    }

    .bag-equip-card:hover {
        border-color: var(--red);
        box-shadow: 0 6px 24px rgba(220, 38, 38, .09);
        transform: translateY(-3px);
    }

    .bag-equip-card__img {
        position: relative;
    }

    .bag-equip-card__img::before {
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

    .bag-equip-card__body {
        padding: var(--sp-sm);
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
    }

    .bag-equip-card__name {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.3;
    }

    .bag-equip-card__specs {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .bag-equip-card__spec {
        display: flex;
        gap: 6px;
        align-items: flex-start;
        font-size: 12px;
    }

    .bag-equip-card__spec-key {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--text-mid);
        min-width: 48px;
        padding-top: 1px;
        flex-shrink: 0;
    }

    .bag-equip-card__spec-val {
        color: var(--text-dark);
        line-height: 1.4;
    }

    .bag-equip-card__desc {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.5;
        flex: 1;
    }

    .bag-equip-card__link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        font-weight: 600;
        color: var(--red);
        margin-top: var(--sp-xs);
    }

    .bag-equip-card__link::after {
        content: '→';
    }

    .bag-equip-card__link:hover {
        color: var(--red-hover);
        text-decoration: none;
    }

    /* OTHER TYPES — small chips */
    .bag-other-grid {
        display: flex;
        flex-wrap: wrap;
        gap: var(--sp-xs);
        margin-top: var(--sp-sm);
    }

    .bag-other-chip {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 8px var(--sp-sm);
        background: var(--bg-light);
        border: 1px solid var(--border);
        border-radius: var(--r);
        font-size: 13px;
        color: var(--text-mid);
        font-weight: 500;
        transition: border-color .15s, color .15s;
    }

    .bag-other-chip::before {
        content: '→';
        color: var(--red);
        font-weight: 700;
        font-size: 12px;
    }

    .bag-other-chip:hover {
        border-color: var(--red);
        color: var(--text-dark);
    }

    /* ════════════════════════════════════════
   FILM & BAG TYPES
════════════════════════════════════════ */
    .bag-materials {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .bag-materials__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        margin-top: var(--sp-md);
        align-items: start;
    }

    /* LDPE bag sizes */
    .bag-sizes {
        display: flex;
        flex-direction: column;
        gap: var(--sp-xs);
    }

    .bag-size-row {
        display: flex;
        align-items: center;
        gap: var(--sp-sm);
        padding: 12px var(--sp-sm);
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--r);
        transition: border-color .15s;
    }

    .bag-size-row:hover {
        border-color: var(--red);
    }

    .bag-size-row__thickness {
        font-size: 20px;
        font-weight: 900;
        color: var(--text-dark);
        letter-spacing: -.03em;
        line-height: 1;
        min-width: 52px;
    }

    .bag-size-row__unit {
        font-size: 11px;
        color: var(--text-mid);
        margin-top: 2px;
    }

    .bag-size-row__desc {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.4;
    }

    /* film geometry cards */
    .bag-geo-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-sm);
    }

    .bag-geo-card {
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        background: var(--bg-white);
        display: flex;
        flex-direction: column;
        transition: border-color .2s, transform .2s;
    }

    .bag-geo-card:hover {
        border-color: var(--red);
        transform: translateY(-2px);
    }

    .bag-geo-card__body {
        padding: var(--sp-sm);
    }

    .bag-geo-card__name {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 4px;
    }

    .bag-geo-card__desc {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.5;
    }

    /* film material types list */
    .bag-film-types {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6px;
        margin-top: var(--sp-sm);
    }

    .bag-film-type {
        font-size: 13px;
        color: var(--text-mid);
        padding: 8px var(--sp-sm);
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--r);
        line-height: 1.3;
        transition: border-color .15s;
    }

    .bag-film-type:hover {
        border-color: var(--red);
    }

    .bag-film-type strong {
        display: block;
        font-size: 12px;
        color: var(--text-dark);
        margin-bottom: 2px;
    }

    /* ════════════════════════════════════════
   APPLICATIONS
════════════════════════════════════════ */
    .bag-apps {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .bag-apps__grid {
        display: grid;
        gap: var(--sp-lg);
        align-items: center;
        margin-top: var(--sp-md);
    }

    .bag-apps__text p {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
        margin-bottom: var(--sp-sm);
    }

    .bag-apps__tags {
        display: flex;
        flex-wrap: wrap;
        gap: var(--sp-xs);
        margin-top: var(--sp-sm);
    }

    .bag-tag {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-mid);
        padding: 4px 12px;
        border: 1px solid var(--border);
        border-radius: 100px;
        background: var(--bg-light);
        transition: border-color .15s, color .15s;
    }

    .bag-tag:hover {
        border-color: var(--red);
        color: var(--red);
    }

    /* ════════════════════════════════════════
   SPARE PARTS
════════════════════════════════════════ */
    .bag-spares {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .bag-spares__grid {
        display: grid;
        gap: var(--sp-lg);
        align-items: start;
        margin-top: var(--sp-md);
    }

    .bag-spares__text p {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
        margin-bottom: var(--sp-sm);
    }

    .bag-teflon-card {
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--r);
        border-top: 3px solid var(--red);
        padding: var(--sp-md);
        display: flex;
        flex-direction: column;
        gap: var(--sp-sm);
    }

    .bag-teflon-card__title {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .bag-teflon-card__body {
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.75;
    }

    /* ════════════════════════════════════════
   RELATED
════════════════════════════════════════ */
    .bag-related {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .bag-related__grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: var(--sp-sm);
        margin-top: var(--sp-md);
        max-width: 480px;
    }

    .bag-related-card {
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

    .bag-related-card:hover {
        border-color: var(--red);
        box-shadow: 0 4px 16px rgba(220, 38, 38, .07);
        transform: translateY(-2px);
        text-decoration: none;
    }

    .bag-related-card__icon {
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

    .bag-related-card__icon svg {
        color: var(--red);
    }

    .bag-related-card__name {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 3px;
    }

    .bag-related-card__desc {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.4;
    }

    /* ════════════════════════════════════════
   AUTHOR — accent bar style
════════════════════════════════════════ */
    .bag-author {
        padding: var(--sp-lg) 0;
        background: var(--bg-light);
        border-top: 1px solid var(--border);
    }

    .bag-author__card {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 0;
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        max-width: 680px;
        background: var(--bg-white);
    }

    .bag-author__accent {
        width: 5px;
        background: var(--red);
    }

    .bag-author__body {
        padding: var(--sp-md);
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .bag-author__written-by {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .13em;
        text-transform: uppercase;
        color: var(--red);
        margin-bottom: 4px;
    }

    .bag-author__meta-row {
        display: flex;
        align-items: center;
        gap: var(--sp-sm);
        flex-wrap: wrap;
    }

    .bag-author__avatar {
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

    .bag-author__name {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -.01em;
    }

    .bag-author__role {
        font-size: 13px;
        color: var(--text-mid);
    }

    /* ════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════ */
    @media (max-width: 900px) {

        .bag-hero__grid,
        .bag-intro__grid,
        .bag-process__grid,
        .bag-materials__grid,
        .bag-apps__grid,
        .bag-spares__grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        :root {
            --sp-lg: 40px;
        }

        .bag-wire-grid {
            grid-template-columns: 1fr;
        }

        .bag-film-types,
        .bag-geo-grid {
            grid-template-columns: 1fr;
        }

        h2.bag-h2 {
            font-size: 22px;
        }

        .bag-author__card {
            grid-template-columns: 1fr;
        }

        .bag-author__accent {
            width: 100%;
            height: 4px;
        }
    }
</style>

<!-- ═══ BREADCRUMB ═══════════════════════════════════════════ -->
<div class="bag-bc">
    <div class="bag-wrap">
        <?php if (function_exists('woocommerce_breadcrumb')) {
            woocommerce_breadcrumb();
        } else { ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">Forside</a>
            <span class="sep">/</span>
            <span>Bag Sealers</span>
        <?php } ?>
    </div>
</div>

<!-- ═══ HERO ════════════════════════════════════════════════ -->
<section class="bag-hero">
    <div class="bag-wrap">
        <div class="bag-hero__grid">

            <div class="bag-hero__text">
                <div class="bag-hero__eyebrow">Bag Sealers</div>
                <h1>Pose­svejsning</h1>
                <p class="bag-hero__sub">Hvordan du får det bedste ud af posesvejsning
                    Hvad det kan og ikke kan.</p>
            </div>
        </div>
    </div>
</section>

<hr class="bag-rule">

<!-- ═══ INTRO ══════════════════════════════════════════════ -->
<section class="bag-intro">
    <div class="bag-wrap">
        <div class="bag-intro__grid">

            <div>
                <?php bag_img('illustration', 'Typisk udstyr til poseforsegling og plastforsegling'); ?>
            </div>

        </div>
    </div>
</section>

<!-- ═══ PROCESS ════════════════════════════════════════════ -->
<section class="bag-process">
    <div class="bag-wrap">
        <div class="bag-label">Proces</div>
        <div class="bag-process__grid">

            <div class="bag-process__text">
                <p>Det emne man ønsker at svejse eller lukke, anbringes mellem kæber, hvorefter processen startes og
                    materialet svejses, afkøles og evt. klippes af på ønsket længde afhængig af valgt posesvejser eller
                    plastsvejser.
                </p>

                <h3 class="bag-h3" style="font-size:16px; margin-top:var(--sp-md);">Posesvejsere virker ved varme enten
                    konstant eller ved impuls under aktivering.</h3>

                <p>Processen kaldes også plast svejsning, PE svejsere, poselukkere og de kan alle anvendes til svejse af
                    varmsvejsbare materialer </p>
            </div>

        </div>
    </div>
</section>

<!-- ═══ APPLICATIONS ════════════════════════════════════════ -->
<section class="bag-apps">
    <div class="bag-wrap">
        <h2 class="bag-h2">Hvad kan man pakke med en posesvejser?</h2>

        <div class="bag-apps__grid">

            <div class="bag-apps__text">
                <p>Alt fra magasiner, aviser, blade, bøger, frugt, grønsager, postkort, julepynt, skruer, beslag,
                    væsker, pulver, krydderier, slik, kaffe, te, ris, gryn, cremer, brød, kager mv.</p>
                <p>Det anbefales ikke at svejse materialer der ved afdampning er giftige eller medføre ubehag ved
                    indånding, uden at det udføres under korrekt ventilerede forhold.</p>
            </div>

        </div>
    </div>
</section>


<!-- ═══ FILM & BAG MATERIALS ════════════════════════════════ -->
<section class="bag-materials">
    <div class="bag-wrap">
        <div class="bag-label">Folie &amp; Poser</div>
        <h2 class="bag-h2">LDPE poser, Folie Materiale typer &amp; Folie geometri</h2>

        <div class="bag-materials__grid">

            <!-- LEFT: LDPE BAGS + GEOMETRY -->
            <div style="display:flex; flex-direction:column; gap:var(--sp-md);">

                <div>
                    <h3 class="bag-h3" style="font-size:16px;">LDPE Poser:</h3>
                    <div class="bag-sizes">
                        <div class="bag-size-row">
                            <div>
                                <div class="bag-size-row__thickness">25<span
                                        style="font-size:13px; font-weight:400;">my</span></div>
                                <!-- <div class="bag-size-row__unit">mikron</div> -->
                            </div>
                            <div class="bag-size-row__desc"><strong>Standard program</strong></div>
                        </div>
                        <div class="bag-size-row">
                            <div>
                                <div class="bag-size-row__thickness">50<span
                                        style="font-size:13px; font-weight:400;">my</span></div>
                                <!-- <div class="bag-size-row__unit">mikron</div> -->
                            </div>
                            <div class="bag-size-row__desc"><strong>Standard program</strong></div>
                        </div>
                        <div class="bag-size-row">
                            <div>
                                <div class="bag-size-row__thickness">70–90<span
                                        style="font-size:12px; font-weight:400;">my</span></div>
                                <!-- <div class="bag-size-row__unit">mikron</div> -->
                            </div>
                            <div class="bag-size-row__desc"><strong>De kraftige, standard til de specielle</strong>
                            </div>
                        </div>
                        <div class="bag-size-row" style="background:var(--red-soft); border-color:rgba(220,38,38,.2);">
                            <div>
                                <div class="bag-size-row__thickness" style="color:var(--red);">Custom</div>
                                <!-- <div class="bag-size-row__unit" style="color:var(--red);">dim.</div> -->
                            </div>
                            <div class="bag-size-row__desc">Og alle de specielle lavet på dimension, med tryk, tykkelse
                                mv.</div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="bag-h3" style="font-size:16px;">Folie geometri:</h3>
                    <div class="bag-geo-grid">
                        <div class="bag-geo-card">
                            <div class="bag-geo-card__body">
                                <div class="bag-geo-card__name">Rørfolie</div>
                                <div class="bag-geo-card__desc">i forskellige bredder og tykkelser</div>
                            </div>
                        </div>
                        <div class="bag-geo-card">
                            <div class="bag-geo-card__body">
                                <div class="bag-geo-card__name">Planfolie</div>
                                <div class="bag-geo-card__desc">centerfoldet i forskellige bredder og
                                    tykkelser</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT: FILM MATERIAL TYPES -->
            <div>
                <h3 class="bag-h3" style="font-size:16px; margin-bottom:var(--sp-sm);">Folie Materiale typer:</h3>
                <div class="bag-film-types" style="margin-top:var(--sp-sm);">
                    <?php
                    $films = [
                        'LDPE' => 'Low Density Polyethylene — med varianter',
                        'Polyethylene' => 'Pliofilm, P.V.A.',
                        'Polyurethane' => 'Kel-F, Tivac',
                        'PVC' => 'Polyvinylchlorid, Polyflex, Saran',
                        'Polypropylene' => 'Mylar, Nylon',
                        'Metal/Aluminium' => 'Poly coatede laminater',
                    ];
                    foreach ($films as $name => $variants) {
                        echo '<div class="bag-film-type"><strong>' . esc_html($name) . '</strong>' . esc_html($variants) . '</div>';
                    }
                    ?>
                    <div class="bag-film-type"
                        style="grid-column:1/-1; background:var(--red-soft); border-color:rgba(220,38,38,.2);">
                        <strong style="color:var(--red);">Og alle andre varmsvejsbare folietyper.</strong>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="bag-apps">
    <div class="bag-wrap">
        <div class="bag-apps__grid">

            <div class="bag-apps__text">
                <p>Posesvejsere, Impulssvejsere, Konstant temperatur svejsere, anvender svejsetråde til at foretage
                    opvarmningen. Disse findes i typiske bredder 2, 5 og 10 mm fladtråde samt rundtråde med forskellig
                    diameter. Rundtråd anvendes som skæretråd.</p>
                <p>Svejse temperaturen ligger i intervallet 180-280 grader</p>
            </div>

        </div>
    </div>
</section>

<!-- ═══ EQUIPMENT — GROUPED BY TYPE ════════════════════════ -->
<section class="bag-equipment">
    <div class="bag-wrap">
        <h2 class="bag-h2">Apparat typer – Følgende udstyr finder anvendelse:</h2>

        <!-- GROUP 1: HAND IMPULSE -->
        <div class="bag-type-section">
            <div class="bag-type-heading">
                Håndbetjente Impulssvejsere, Poselukkere, Posesvejsere
                <!-- <span>Manuel</span> -->
            </div>
            <p style="font-size:14px; color:var(--text-mid); margin-bottom:var(--sp-sm); line-height:1.7;">Emnet
                anbringes mellem kæber der lukkes manuelt omkring emnet, hvorefter svejsning udføres i det indstillede
                tidsinterval.</p>

            <div class="bag-equip-grid">

                <div class="bag-equip-card">
                    <div class="bag-equip-card__body">
                        <div class="bag-equip-card__name">STEP-N00HI</div>
                        <div class="bag-equip-card__desc">Svejse bredde 2 mm gange længde N = 100, 200, 300, 400, 600,
                            800 mm</div>
                        <!-- <a href="#" class="bag-equip-card__link">Se produkt</a> -->
                    </div>
                </div>

                <div class="bag-equip-card">
                    <div class="bag-equip-card__body">
                        <div class="bag-equip-card__name">STEP-N05HI</div>
                        <div class="bag-equip-card__desc">Svejse bredde 5 mm gange længde N = 100, 200, 300, 400</div>
                        <!-- <a href="#" class="bag-equip-card__link">Se produkt</a> -->
                    </div>
                </div>

                <div class="bag-equip-card">
                    <div class="bag-equip-card__body">
                        <div class="bag-equip-card__name">STEP-N02or05HC</div>
                        <div class="bag-equip-card__desc">som ovenfor men med “Cutter” kniv funktion</div>
                        <!-- <a href="#" class="bag-equip-card__link">Se produkt</a> -->
                    </div>
                </div>

                <div class="bag-equip-card">
                    <div class="bag-equip-card__body">
                        <div class="bag-equip-card__name">STEP-N02or05HCG</div>
                        <div class="bag-equip-card__desc">som overfor men med kniv og holdemagnet funktion. Her er der
                            styring for regulering af svejse- og køletiden.</div>
                        <!-- <a href="#" class="bag-equip-card__link">Se produkt</a> -->
                    </div>
                </div>

            </div>
        </div>

        <!-- GROUP 2: SEMI AUTO -->
        <div class="bag-type-section">
            <div class="bag-type-heading">
                Semi automatisk Impulssvejser, Poselukkere, Posesvejsere
                <!-- <span>Semi Auto</span> -->
            </div>
            <p style="font-size:14px; color:var(--text-mid); margin-bottom:var(--sp-sm); line-height:1.7;">Emnet
                anbringes mellem kæber der lukkes semi automatisk omkring emnet, hvorefter svejsning udføres i det
                indstillede tidsinterval med efter følgende køletid.</p>

            <div class="bag-equip-grid">

                <div class="bag-equip-card">
                    <div class="bag-equip-card__body">
                        <div class="bag-equip-card__name">STEP-NN0AI</div>
                        <div class="bag-equip-card__desc">Svejse bredde 2 mm gange længde NN = 350, 450, 600 mm</div>
                        <!-- <a href="#" class="bag-equip-card__link">Se produkt</a> -->
                    </div>
                </div>

                <div class="bag-equip-card">
                    <div class="bag-equip-card__body">
                        <div class="bag-equip-card__name">STEP-NN5AI</div>
                        <div class="bag-equip-card__desc">Svejse bredde 5 mm gange længde NN = 350, 450, 600 mm</div>
                        <!-- <a href="#" class="bag-equip-card__link">Se produkt</a> -->
                    </div>
                </div>

                <div class="bag-equip-card">
                    <div class="bag-equip-card__body">
                        <div class="bag-equip-card__name">STEP-NN5VA</div>
                        <div class="bag-equip-card__desc">Vakuum med Svejse bredde 5 mm gange NN = 450, 600 mm</div>
                        <!-- <a href="#" class="bag-equip-card__link">Se produkt</a> -->
                    </div>
                </div>

            </div>
        </div>

        <!-- GROUP 3: IP BAR + ROLLER -->
        <div class="bag-type-section">
            <div class="bag-type-heading">
                IP Bar svejser &amp; Rullesvejser
                <!-- <span>Specialtype</span> -->
            </div>

            <div class="bag-equip-grid">

                <div class="bag-equip-card">
                    <div class="bag-equip-card__body">
                        <div class="bag-equip-card__name">IP Bar svejser</div>
                        <div class="bag-equip-card__specs">
                            <div class="bag-equip-card__spec">
                                <!-- <span class="bag-equip-card__spec-key">Tråd</span> -->
                                <span class="bag-equgt-card__spec-val">Emnet anbringes mellem kæber der lukkes manuelt
                                    omkring emnet, hvorefter svejsning udføres i det indstillede tidsinterval samt af
                                    skæring af overskydende folie.</span>
                            </div>
                            <div class="bag-equip-card__spec">
                                <span class="bag-equip-card__spec-key">STEP-NN0IP</span>
                                <!-- <span class="bag-equip-card__spec-val">450, 600, 800 mm</span> -->
                            </div>
                        </div>
                        <div class="bag-equip-card__desc">Der svejses med rundtråd gange længde NN = 450, 600, 800 mm
                        </div>
                        <!-- <a href="#" class="bag-equip-card__link">Se produkt</a> -->
                    </div>
                </div>

                <div class="bag-equip-card">
                    <div class="bag-equip-card__body">
                        <div class="bag-equip-card__name">Rullesvejser</div>
                        <div class="bag-equip-card__specs">
                            <div class="bag-equip-card__spec">
                                <!-- <span class="bag-equip-card__spec-key">Bredder</span> -->
                                <span class="bag-equip-card__spec-val">Emnet anbringes på en plan flade, hvorefter
                                    svejsning kan udføres ved at rulle med svejseren henover den ønskede svejse søm. Der
                                    svejses med konstant varme.</span>
                            </div>
                            <div class="bag-equip-card__spec">
                                <span class="bag-equip-card__spec-key">STEP-80NHW</span>
                                <span class="bag-equip-card__spec-val">svejse bredde</span>
                            </div>
                        </div>
                        <div class="bag-equip-card__desc">N = 1 bredde: 5mm <br>
                            N = 2 bredde: 1mm <br>
                            N = 3 bredde: 10mm</div>
                        <!-- <a href="#" class="bag-equip-card__link">Se produkt</a> -->
                    </div>
                </div>

            </div>
        </div>

        <!-- GROUP 4: OTHER TYPES -->
        <div class="bag-type-section">
            <div class="bag-type-heading">
                Alle de andre typer og varianter <!-- <span>Se sortiment</span> -->
            </div>
            <div class="bag-other-grid">
                <div class="bag-other-chip">Fod betjente svejsere</div>
                <div class="bag-other-chip">Vertikale svejsere</div>
                <div class="bag-other-chip">Bånd svejsere</div>
                <div class="bag-other-chip">Vakuum svejsere</div>
            </div>
        </div>

    </div>
</section>

<!-- ═══ SPARE PARTS / TEFLON ════════════════════════════════ -->
<section class="bag-spares">
    <div class="bag-wrap">
        <h2 class="bag-h2">Reservedele</h2>
        <div class="bag-spares__grid">
            <div class="bag-spares__text">
                <p>En vigtig sliddel på en posesvejser er teflon beskyttelses folien. Teflon bruges til at beskytte
                    varmetråden for plasten således der ikke overføres plast partikler til svejse tråden hvorefter dette
                    vil brænde af og danne aske/slagger. Opbygninger af teflon beskyttelse er forskelligt fra maskine
                    type og de enkeltes manual kan studeres for at se den korrekte opbygning.</p>
                <p>Sal-Tech Easy Packaging lagerføre et bredt program af standard reservedels kit til posesvejsere,
                    check vores hjemmeside under: Reservedele til Mercier Impulssvejsere. Mane af disse reservedele
                    passer til andre typer solgt.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ═══ RELATED ══════════════════════════════════════════════ -->
<section class="bag-related">
    <div class="bag-wrap">
        <div class="bag-label">Beslægtede områder</div>
        <h2 class="bag-h2">Vertikal posemaskiner.</h2>
    </div>
</section>

<!-- ═══ AUTHOR ══════════════════════════════════════════════ -->
<section class="bag-author">
    <div class="bag-wrap">
        <div class="bag-label">Forfatter til artiklen</div>
        <div class="bag-author__card">
            <div class="bag-author__accent"></div>
            <div class="bag-author__body">
                <div class="bag-author__meta-row">
                    <div>
                        <div class="bag-author__name">Gunnar Salbæk</div>
                        <div class="bag-author__role">CEO / Industrielt Design &nbsp;·&nbsp; 35 års erfaring på området
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>