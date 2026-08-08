<?php
/**
 * Template Name: Banding Page
 *
 * Custom page template for the Sal-Tech "Banding" page.
 *
 * @package SalTech
 */

defined('ABSPATH') || exit;

get_header();

$bd_images = [

    /* ── MACHINES ── */
    'band800' => ['src' => get_stylesheet_directory_uri() . '/assets/img/band/band800.png', 'alt' => 'STEP Band 800 – automatisk banderolerings­maskine'],
    'band1000' => ['src' => get_stylesheet_directory_uri() . '/assets/img/band/band1000.png', 'alt' => 'STEP Band 1000 – automatisk banderolerings­maskine'],
    'band1100' => ['src' => get_stylesheet_directory_uri() . '/assets/img/band/band1100.png', 'alt' => 'STEP Band 1100 – automatisk banderolerings­maskine'],
    'band1200' => ['src' => get_stylesheet_directory_uri() . '/assets/img/band/band1200.png', 'alt' => 'STEP Band 1200 – automatisk banderolerings­maskine'],

    /* ── PROCESS ILLUSTRATION ── */
    'process_overview' => ['src' => get_stylesheet_directory_uri() . '/assets/img/band/process.png', 'alt' => 'Banderole proces illustration'],
    'banded_products' => ['src' => get_stylesheet_directory_uri() . '/assets/img/band/showproducts.png', 'alt' => 'Typiske produkter til banderolering – Sal-Tech Easy Packaging'],

    /* ── CASE STUDIES ── */
    'case_tajco' => ['src' => get_stylesheet_directory_uri() . '/assets/img/band/randomitem-1.png', 'alt' => 'Tajco løsning – udstødnings­rør binding'],
    'case_novo' => ['src' => get_stylesheet_directory_uri() . '/assets/img/band/randomitem-2.png', 'alt' => 'Novo Nordisk løsning – insulin penne'],
    'case_paper' => ['src' => get_stylesheet_directory_uri() . '/assets/img/band/randomitem-3a.png', 'alt' => 'Grafisk produkt – A4 papir banderolering'],

    /* ── TAPE TYPES ── */
    'tape' => ['src' => get_stylesheet_directory_uri() . '/assets/img/band/band-guide.png', 'alt' => 'tape'],

];

function bd_img($key, $extra_class = '')
{
    global $bd_images;
    $img = $bd_images[$key] ?? ['src' => '', 'alt' => $key];

    if (!empty($img['src'])) {
        echo '<img src="' . esc_url($img['src']) . '" alt="' . esc_attr($img['alt']) . '" class="bd-img ' . esc_attr($extra_class) . '" loading="lazy">';
    } else {
        echo '<div class="bd-placeholder ' . esc_attr($extra_class) . '" title="' . esc_attr('Billede: ' . $img['alt']) . '">'
            . '<div class="bd-placeholder__inner">'
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

    .bd-wrap {
        max-width: var(--max-w);
        margin: 0 auto;
        padding: 0 var(--sp-md);
    }

    /* ── IMAGES / PLACEHOLDERS ── */
    .bd-img {
        display: block;
        width: 100%;
        height: 100px;
        /* fixed: was 100px */
        object-fit: contain;
        border-radius: var(--r);
    }

    .bd-placeholder {
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

    .bd-placeholder:hover {
        border-color: var(--red);
    }

    .bd-placeholder__inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        padding: var(--sp-md);
        text-align: center;
    }

    .bd-placeholder__inner svg {
        opacity: .3;
    }

    .bd-placeholder__inner span {
        font-size: 11px;
        color: var(--text-mid);
        max-width: 160px;
        line-height: 1.4;
        opacity: .75;
    }

    .bd-ph--hero {
        min-height: 420px;
    }

    .bd-ph--wide {
        min-height: 300px;
    }

    .bd-ph--card {
        min-height: 200px;
    }

    .bd-ph--square {
        min-height: 240px;
    }

    .bd-ph--thumb {
        min-height: 130px;
    }

    .bd-ph--side {
        min-height: 100%;
        border-radius: 0;
        border: none;
    }

    /* ── SECTION LABEL ── */
    .bd-label {
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

    .bd-label::before {
        content: '';
        display: block;
        width: 18px;
        height: 2px;
        background: var(--red);
    }

    /* ── HEADINGS ── */
    h2.bd-h2 {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -.02em;
        color: var(--text-dark);
        line-height: 1.2;
    }

    h3.bd-h3 {
        font-size: 22px;
        font-weight: 700;
        letter-spacing: -.01em;
        color: var(--text-dark);
        margin-bottom: var(--sp-sm);
    }

    hr.bd-rule {
        border: none;
        border-top: 1px solid var(--border);
        margin: 0;
    }

    /* ── NOTICE ── */
    .bd-notice {
        display: flex;
        gap: var(--sp-sm);
        align-items: flex-start;
        padding: var(--sp-sm) var(--sp-md);
        background: var(--red-soft);
        border-left: 3px solid var(--red);
        border-radius: 0 var(--r) var(--r) 0;
        margin-top: var(--sp-md);
    }

    .bd-notice svg {
        color: var(--red);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .bd-notice p {
        font-size: 14px;
        color: var(--text-dark);
        line-height: 1.6;
    }

    /* ── ALERT ── */
    .bd-alert {
        background: var(--bg-light);
        border: 1px solid var(--border);
        border-left: 3px solid var(--red);
        border-radius: 0 var(--r) var(--r) 0;
        padding: var(--sp-sm) var(--sp-md);
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.7;
    }

    .bd-alert strong {
        color: var(--text-dark);
    }

    .bd-alert+.bd-alert {
        margin-top: var(--sp-sm);
    }

    /* ════════════════════════════════════════
       BREADCRUMB
    ════════════════════════════════════════ */
    .bd-bc {
        background: var(--bg-light);
        border-bottom: 1px solid var(--border);
        padding: 10px 0;
        font-size: 13px;
        color: var(--text-mid);
    }

    .bd-bc a {
        color: var(--text-mid);
    }

    .bd-bc a:hover {
        color: var(--red);
        text-decoration: none;
    }

    .bd-bc .sep {
        margin: 0 6px;
        color: var(--border);
    }

    /* ════════════════════════════════════════
       HERO
    ════════════════════════════════════════ */
    .bd-hero {
        background: var(--bg-light);
        border-bottom: 1px solid var(--border);
        overflow: hidden;
    }

    .bd-hero__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        align-items: end;
    }

    .bd-hero__eyebrow {
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

    .bd-hero__eyebrow::before {
        content: '';
        display: block;
        width: 18px;
        height: 2px;
        background: var(--red);
    }

    .bd-hero h1 {
        font-size: clamp(36px, 5.5vw, 66px);
        font-weight: 900;
        letter-spacing: -.03em;
        line-height: 1.0;
        color: var(--text-dark);
        margin-bottom: var(--sp-sm);
    }

    .bd-hero h1 em {
        font-style: normal;
        color: var(--red);
    }

    .bd-hero__sub {
        font-size: 17px;
        color: var(--text-mid);
        line-height: 1.6;
        max-width: 480px;
        margin-bottom: var(--sp-md);
    }

    .bd-hero__img {
        align-self: end;
    }

    /* ════════════════════════════════════════
       INTRO
    ════════════════════════════════════════ */
    .bd-intro {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .bd-intro__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        align-items: start;
    }

    .bd-intro__lead {
        font-size: 20px;
        line-height: 1.6;
        color: var(--text-dark);
    }

    .bd-intro__lead strong {
        color: var(--red);
        font-weight: 700;
    }

    .bd-intro__body {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
    }

    .bd-intro__body+.bd-intro__body {
        margin-top: var(--sp-sm);
    }

    /* ════════════════════════════════════════
       MACHINE CARDS
    ════════════════════════════════════════ */
    .bd-machines {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .bd-machines__intro {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: var(--sp-lg);
        align-items: end;
        margin-bottom: var(--sp-lg);
    }

    .bd-badge {
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

    .bd-badge--auto {
        border-color: var(--red);
        color: var(--red);
        background: var(--red-soft);
    }

    .bd-machines__grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--sp-sm);
    }

    .bd-machine-card {
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        background: var(--bg-white);
        transition: box-shadow .2s, border-color .2s, transform .2s;
    }

    .bd-machine-card:hover {
        border-color: var(--red);
        box-shadow: 0 6px 24px rgba(220, 38, 38, .09);
        transform: translateY(-3px);
    }

    .bd-machine-card__img {
        position: relative;
    }

    .bd-machine-card__img::before {
        content: 'Automatisk';
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

    .bd-machine-card__body {
        padding: var(--sp-sm);
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
    }

    .bd-machine-card__name {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.3;
    }

    .bd-machine-card__desc {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.5;
        flex: 1;
    }

    .bd-machine-card__link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        font-weight: 600;
        color: var(--red);
        margin-top: var(--sp-xs);
    }

    .bd-machine-card__link::after {
        content: '→';
    }

    .bd-machine-card__link:hover {
        color: var(--red-hover);
        text-decoration: none;
    }

    /* ════════════════════════════════════════
       PROCESS TABS  — .bd- prefixed
    ════════════════════════════════════════ */
    .bd-process-tabs {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .bd-tabs {
        display: flex;
        border-bottom: 2px solid var(--border);
        margin-bottom: var(--sp-md);
        overflow-x: auto;
        scrollbar-width: none;
    }

    .bd-tab {
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

    .bd-tab:hover {
        color: var(--text-dark);
    }

    .bd-tab.is-active {
        color: var(--red);
        border-bottom-color: var(--red);
    }

    .bd-panel {
        display: none;
        animation: bdFade .3s ease;
    }

    .bd-panel.is-active {
        display: block;
    }

    @keyframes bdFade {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .bd-panel__text h3 {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: var(--sp-sm);
        letter-spacing: -.01em;
    }

    .bd-panel__text p {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
        margin-bottom: var(--sp-sm);
    }

    .bd-panel__text ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: var(--sp-sm);
    }

    .bd-panel__text li {
        font-size: 14px;
        color: var(--text-mid);
        padding-left: 20px;
        position: relative;
        line-height: 1.6;
    }

    .bd-panel__text li::before {
        content: '→';
        position: absolute;
        left: 0;
        color: var(--red);
        font-weight: 700;
    }

    /* nested list indent */
    .bd-panel__text ul ul {
        margin-top: 8px;
        padding-left: var(--sp-sm);
    }

    .bd-panel__text ul ul li::before {
        content: '–';
        color: var(--text-mid);
    }

    /* ════════════════════════════════════════
       BANDED PRODUCTS
    ════════════════════════════════════════ */
    .bd-products {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .bd-products__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        align-items: center;
        margin-top: var(--sp-md);
    }

    .bd-products__text p {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
        margin-bottom: var(--sp-sm);
    }

    .bd-products__tags {
        display: flex;
        flex-wrap: wrap;
        gap: var(--sp-xs);
        margin-top: var(--sp-sm);
    }

    .bd-tag {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-mid);
        padding: 4px 12px;
        border: 1px solid var(--border);
        border-radius: 100px;
        background: var(--bg-white);
        transition: border-color .15s, color .15s;
    }

    .bd-tag:hover {
        border-color: var(--red);
        color: var(--red);
    }

    /* ════════════════════════════════════════
       CASE STUDIES
    ════════════════════════════════════════ */
    .bd-cases {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .bd-cases__grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--sp-sm);
        margin-top: var(--sp-md);
    }

    .bd-case-card {
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: border-color .2s, box-shadow .2s;
    }

    .bd-case-card:hover {
        border-color: var(--red);
        box-shadow: 0 4px 16px rgba(220, 38, 38, .07);
    }

    .bd-case-card__img {
        width: 100%;
    }

    .bd-case-card__body {
        padding: var(--sp-sm);
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
    }

    .bd-case-card__client {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--red);
    }

    .bd-case-card__problem {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-mid);
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-top: 2px;
    }

    .bd-case-card__title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.3;
    }

    .bd-case-card__solution {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.55;
        flex: 1;
        border-top: 1px solid var(--border);
        padding-top: 8px;
        margin-top: 4px;
    }

    .bd-case-card__solution strong {
        color: var(--text-dark);
    }

    /* ════════════════════════════════════════
       TAPE TYPES
    ════════════════════════════════════════ */
    .bd-tape {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .bd-tape__grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: var(--sp-sm);
        margin-top: var(--sp-md);
    }

    .bd-tape-card {
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        background: var(--bg-white);
        display: flex;
        flex-direction: column;
        transition: border-color .2s, box-shadow .2s, transform .2s;
    }

    .bd-tape-card:hover {
        border-color: var(--red);
        box-shadow: 0 4px 16px rgba(220, 38, 38, .07);
        transform: translateY(-2px);
    }

    .bd-tape-card__img {
        width: 100%;
    }

    .bd-tape-card__body {
        padding: var(--sp-sm);
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
    }

    .bd-tape-card__type {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--red);
        background: var(--red-soft);
        padding: 2px 8px;
        border-radius: 100px;
        width: fit-content;
    }

    .bd-tape-card__weld {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-mid);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .bd-tape-card__weld span {
        background: var(--bg-mid);
        border: 1px solid var(--border);
        padding: 2px 7px;
        border-radius: 100px;
        font-size: 10px;
    }

    .bd-tape-card__name {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.2;
    }

    .bd-tape-card__material {
        font-size: 12px;
        color: var(--text-mid);
        font-style: italic;
    }

    .bd-tape-card__specs {
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-top: 4px;
        border-top: 1px solid var(--border);
        padding-top: 8px;
    }

    .bd-tape-card__spec {
        display: flex;
        gap: 6px;
        align-items: flex-start;
    }

    .bd-tape-card__spec-key {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--text-mid);
        min-width: 60px;
        padding-top: 1px;
        flex-shrink: 0;
    }

    .bd-tape-card__spec-val {
        font-size: 12px;
        color: var(--text-dark);
        line-height: 1.4;
    }

    .bd-tape__spool-note {
        margin-top: var(--sp-md);
        padding: var(--sp-sm) var(--sp-md);
        border-left: 3px solid var(--red);
        background: var(--red-soft);
        border-radius: 0 var(--r) var(--r) 0;
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.7;
    }

    .bd-tape__spool-note strong {
        color: var(--text-dark);
    }

    /* ════════════════════════════════════════
       ENVIRONMENT
    ════════════════════════════════════════ */
    .bd-env {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .bd-env__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        margin-top: var(--sp-md);
    }

    .bd-env__block h3 {
        font-size: 17px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .bd-env__block p,
    .bd-env__block li {
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.75;
    }

    .bd-env__block ul {
        list-style: none;
    }

    .bd-env__block li {
        padding-left: 16px;
        position: relative;
        margin-bottom: 5px;
    }

    .bd-env__block li::before {
        content: '·';
        position: absolute;
        left: 0;
        color: var(--red);
        font-size: 18px;
        line-height: 1.2;
    }

    .bd-env__block>*+* {
        margin-top: var(--sp-md);
    }

    /* ════════════════════════════════════════
       RELATED
    ════════════════════════════════════════ */
    .bd-related {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .bd-related__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-sm);
        margin-top: var(--sp-md);
    }

    .bd-related-card {
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

    .bd-related-card:hover {
        border-color: var(--red);
        box-shadow: 0 4px 16px rgba(220, 38, 38, .07);
        transform: translateY(-2px);
        text-decoration: none;
    }

    .bd-related-card__icon {
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

    .bd-related-card__icon svg {
        color: var(--red);
    }

    .bd-related-card__name {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 3px;
    }

    .bd-related-card__desc {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.4;
    }

    /* ════════════════════════════════════════
       AUTHOR
    ════════════════════════════════════════ */
    .bd-author {
        padding: var(--sp-lg) 0;
        background: var(--bg-white);
        border-top: 1px solid var(--border);
    }

    .bd-author__card {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 0;
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        max-width: 680px;
        background: var(--bg-white);
    }

    .bd-author__accent {
        width: 5px;
        background: var(--red);
    }

    .bd-author__body {
        padding: var(--sp-md);
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .bd-author__written-by {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .13em;
        text-transform: uppercase;
        color: var(--red);
        margin-bottom: 4px;
    }

    .bd-author__meta-row {
        display: flex;
        align-items: center;
        gap: var(--sp-sm);
        flex-wrap: wrap;
    }

    .bd-author__avatar {
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

    .bd-author__name {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -.01em;
    }

    .bd-author__role {
        font-size: 13px;
        color: var(--text-mid);
    }

    /* ════════════════════════════════════════
       RESPONSIVE
    ════════════════════════════════════════ */
    @media (max-width: 1024px) {
        .bd-machines__grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .bd-cases__grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 900px) {

        .bd-hero__grid,
        .bd-intro__grid,
        .bd-process__grid,
        .bd-products__grid,
        .bd-env__grid,
        .bd-related__grid {
            grid-template-columns: 1fr;
        }

        .bd-machines__intro {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        :root {
            --sp-lg: 40px;
        }

        .bd-machines__grid,
        .bd-cases__grid {
            grid-template-columns: 1fr;
        }

        .bd-tape__grid {
            grid-template-columns: 1fr 1fr;
        }

        h2.bd-h2 {
            font-size: 22px;
        }

        .bd-tab {
            padding: 10px 14px;
            font-size: 13px;
        }

        .bd-author__card {
            grid-template-columns: 1fr;
        }

        .bd-author__accent {
            width: 100%;
            height: 4px;
        }
    }
</style>

<!-- ═══ BREADCRUMB ═══════════════════════════════════════════ -->
<div class="bd-bc">
    <div class="bd-wrap">
        <?php if (function_exists('woocommerce_breadcrumb')) {
            woocommerce_breadcrumb();
        } else { ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">Forside</a>
            <span class="sep">/</span>
            <span>Banderolering</span>
        <?php } ?>
    </div>
</div>

<!-- ═══ HERO ════════════════════════════════════════════════ -->
<section class="bd-hero">
    <div class="bd-wrap">
        <div class="bd-hero__grid">
            <div class="bd-hero__text">
                <div class="bd-hero__eyebrow">Equipment for Banding</div>
                <h1>Banderolering</h1>
                <p class="bd-hero__sub">Få det bedste ud af banderole­processen. Hvad den kan og ikke kan.</p>
            </div>
        </div>
    </div>
</section>

<hr class="bd-rule">

<!-- ═══ MACHINE CARDS ═══════════════════════════════════════ -->
<section class="bd-machines">
    <div class="bd-wrap">

        <div class="bd-machines__intro">
            <div>
                <h2 class="bd-h2">Typisk udstyr for banderolering</h2>
            </div>
            <div>
                <span class="bd-badge bd-badge--auto">Automatisk</span>
            </div>
        </div>

        <div class="bd-machines__grid">

            <div class="bd-machine-card">
                <div class="bd-machine-card__img">
                    <?php bd_img('band800', 'bd-ph--card'); ?>
                </div>
                <div class="bd-machine-card__body">
                    <div class="bd-machine-card__name">STEP Band 800</div>
                </div>
            </div>

            <div class="bd-machine-card">
                <div class="bd-machine-card__img">
                    <?php bd_img('band1000', 'bd-ph--card'); ?>
                </div>
                <div class="bd-machine-card__body">
                    <div class="bd-machine-card__name">STEP Band 1000</div>
                </div>
            </div>

            <div class="bd-machine-card">
                <div class="bd-machine-card__img">
                    <?php bd_img('band1100', 'bd-ph--card'); ?>
                </div>
                <div class="bd-machine-card__body">
                    <div class="bd-machine-card__name">STEP Band 1100</div>
                </div>
            </div>

            <div class="bd-machine-card">
                <div class="bd-machine-card__img">
                    <?php bd_img('band1200', 'bd-ph--card'); ?>
                </div>
                <div class="bd-machine-card__body">
                    <div class="bd-machine-card__name">STEP Band 1200</div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══ INTRO ══════════════════════════════════════════════ -->
<section class="bd-intro">
    <div class="bd-wrap">
        <div class="bd-label">Proces</div>

        <div class="bd-intro__grid">

            <div>
                <p class="bd-intro__lead">Med banderolering placer man et papir/foliebånd også kaldet tape, omkring sit
                    produkt. Denne tape enten svejses med varme eller med ultra sonic således den holder fast om
                    produktet.</p>
                <br>
                <p class="bd-intro__body">Banderolering kan kun udføres automatisk eller fuld automatisk. Inden
                    banderolering skal produktet positioneres om der er tale om 1 stk. eller flere, så skal den endelige
                    position være til stede inden banderoleringen gennemføres og denne position skal være geometrisk
                    stabil.</p>
                <p class="bd-intro__body">(se artikel om geometrisk stabilitet ved emballering) For man kan foretage en
                    korrekt banderolering skal produktet være positioneret med tilstrækkelig anlægsflade, der sikre at
                    tape forstræk kontra pil højde vil tillade at tapen forbliver forspændt efter at modtryksplade
                    fjernes.</p>
            </div>

            <div>
                <p class="bd-intro__body">Man kan banderolere både hårde og bløde produkter, men med begrænsninger for
                    begge typer af produkter. Den generelle begrænsning er anlægsfladens størrelse, der skal typisk skal
                    være større end 50mm og plan.</p>
                <p class="bd-intro__body">Banderolering er velegnet til produkter der yder ringe modstand for
                    opstramning da man med banderole processen kan opstramme stort set neutralt.</p>
                <div style="margin-top: var(--sp-md);">
                    <?php bd_img('process_overview', 'bd-ph--wide'); ?>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══ PROCESS TABS ════════════════════════════════════════ -->
<section class="bd-process-tabs">
    <div class="bd-wrap">
        <h2 class="bd-h2">I forhold til de forskellige processer vil det udstyr der finder anvendelse</h2>
        <br>

        <div class="bd-tabs" role="tablist">
            <button class="bd-tab is-active" data-tab="manuel" role="tab" aria-selected="true">Manuelt</button>
            <button class="bd-tab" data-tab="semi" role="tab" aria-selected="false">Semi Automatisk</button>
            <button class="bd-tab" data-tab="auto" role="tab" aria-selected="false">Automatisk</button>
            <button class="bd-tab" data-tab="fullauto" role="tab" aria-selected="false">Fuld Automatisk</button>
        </div>

        <!-- MANUEL -->
        <div class="bd-panel is-active" data-panel="manuel" role="tabpanel">
            <div class="bd-panel__text">
                <h3>Manuelt</h3>
                <p>Papir omslag der lukkes med tape, hertil kræves ingen maskiner eller udstyr.</p>
            </div>
        </div>

        <!-- SEMI -->
        <div class="bd-panel" data-panel="semi" role="tabpanel">
            <div class="bd-panel__text">
                <h3>Semi Automatisk</h3>
                <p>Til mit kendskab eksisterer der ikke udstyr for semi automatisk banderolering, udover hjælpe udstyr
                    bygget ind i linjer for banderole af udfald fra produktion.</p>
            </div>
        </div>

        <!-- AUTOMATISK -->
        <div class="bd-panel" data-panel="auto" role="tabpanel">
            <div class="bd-panel__text">
                <h3>Automatisk</h3>
                <p>Generelt: Ringbinding er ikke mulig, sal-tech easy packaging har dog mulige løsninger hvor der laves
                    åbne/lukke rammer, således dette er muligt. Produkt størrelse begrænses af ramme dimension og
                    produktets diagonal om det skal kunne drejes 90 grader inden i rammen.</p>
                <p>Banderole maskiner fører selv tapen frem. Der findes 2 hoved former:</p>
                <ul>
                    <li>Tapen bakkes op i en loop form og står klar for næste banderole. Intet produkt kan være i
                        maskine mens denne proces udføres. Ved aktivering trækkes tapen til og opstrammes fra få kg/gram
                        op til omkring 20 kg max. Et eksempel herpå er <strong>STEP Band 800</strong>.</li>
                    <li>Banderole maskiner der skyder tapen rundt i rammen og ved aktivering trækkes tapen ind om
                        produktet og tapen svejses. Et eksempel herpå er <strong>STEP Band 1000, 1100 og 1200</strong>.
                    </li>
                </ul>
                <br>
                <h2 class="bd-h2">Typiske produkter til banderolering</h2>
                <br>
                <div style="display: flex; justify-self: flex-start;">
                    <?php bd_img('banded_products', 'bd-ph--square'); ?>
                </div>
            </div>
        </div>

        <!-- FULD AUTOMATISK -->
        <div class="bd-panel" data-panel="fullauto" role="tabpanel">
            <div class="bd-panel__text">
                <h3>Fuld Automatisk</h3>
                <p>Generelt: Ringbinding er ikke mulig, sal-tech easy packaging har dog mulige løsninger hvor der kan
                    laves åbne/lukke rammer, således dette er muligt. Pakke størrelse begrænses af ramme dimension og
                    emnets diagonal, om det skal kunne drejes 90 grader inden i rammen.</p>
                <ul>
                    <li><strong>Tajco løsninger:</strong> Udstødnings rør haler bundet til bag plade med syning af
                        banderolen. Fuld automatisk løsning med kapacitet på omkring 16–20 per minut.</li>
                    <?php bd_img('case_tajco', 'bd-ph--thumb'); ?>

                    <li><strong>Novo Nordisk:</strong> Problem lille grundflade på produkt der kommer opret stående i
                        Møller &amp; Davidcon automatisk anlæg for pakning af insulin penne. Løsning: Sidevendt maskine.
                    </li>
                    <?php bd_img('case_novo', 'bd-ph--thumb'); ?>
                    <li><strong>Problem:</strong> Problem — grafisk produkt der består af helt ned til 2 stk. A4
                        papir der ønskes banderoleret. Løsning: Stram til over modholdsplader der er justerbare i
                        forhold til produktet, herved knækkes banderolen over kanten og efterfølgende holdes det tynde
                        sæt af papirer sammen.</li>
                    <?php bd_img('case_paper', 'bd-ph--thumb'); ?>
                </ul>
            </div>

        </div>
        <p style="margin-top:var(--sp-sm);">Projekt specificeret og mere avanceret banderoleudstyr, branche
            relateret kan laves i opgave.</p>
    </div>
</section>

<!-- ═══ TAPE TYPES ══════════════════════════════════════════ -->
<section class="bd-tape">
    <div class="bd-wrap">
        <h2 class="bd-h2">Tape Typer</h2>
        <br>
        <div class="bd-tape__grid">

            <div class="bd-tape-card">
                <div class="bd-tape-card__body">
                    <div class="bd-tape-card__type">Papir tape</div>
                    <div class="bd-tape-card__name">PW / PB Papir tape</div>
                    <div class="bd-tape-card__material">PW “Paper White” papir hvidt eller PB “Paper Brown” papir brunt,
                        70, 80 eller 90 gram/m2 med polypropylen coating 1 eller 2 sider, typisk omkring 20my, bredde
                        20, 30, 40, 50mm</div>
                </div>
            </div>

            <div class="bd-tape-card">
                <div class="bd-tape-card__body">
                    <div class="bd-tape-card__type">Folie tape</div>
                    <div class="bd-tape-card__name">FTN Folie tape</div>
                    <div class="bd-tape-card__material">FTN typer beregnet for Ultra Sonic svejsning, PolyProplylen,
                        125-135my mælket klar eller indfarvet, velegnet for trykning af 1 til 8 farver, bredde 15, 20,
                        30, 40, 50mm</div>
                </div>
            </div>

            <div class="bd-tape-card">
                <div class="bd-tape-card__body">
                    <div class="bd-tape-card__type">Folie tape</div>
                    <div class="bd-tape-card__name">PEHD Folie tape</div>
                    <div class="bd-tape-card__material">PEHD typer beregnet for Ultra Sonic svejsning, Low Density
                        PolyEthyen 80-85my meget klar, bredde 15, 20, 30, 50mm</div>
                </div>
            </div>

            <div class="bd-tape-card">
                <div class="bd-tape-card__body">
                    <div class="bd-tape-card__type">Folie tape</div>
                    <div class="bd-tape-card__name">FTB Folie tape</div>
                    <div class="bd-tape-card__material">FTB typer beregnet for varmesvejsning, PolyProplylen, 90, 100,
                        110my, bredde 20, 30, 40mm</div>
                </div>
            </div>

            <div class="bd-tape-card">
                <div class="bd-tape-card__body">
                    <div class="bd-tape-card__type">Folie tape</div>
                    <div class="bd-tape-card__name">FWG Folie tape</div>
                    <div class="bd-tape-card__material">FWG typer beregnet for Ultra Sonic svejsning, skummet
                        PolyProplylen, 120, 170, 210my, hvidt sølv udseende, velegnet for trykning af 1 til 8 farver,
                        bredde 15, 20, 30, 50mm</div>
                </div>
            </div>

        </div>

        <div class="bd-tape__spool-note">
            <strong>Oplægning</strong> Ved ordreafgivelse på banderolebånd er oplægningen meget vigtigt at kende. Typisk
            leveres bånd på en indvendig kerne diameter på Ø40, Ø50 eller Ø76. Antallet af meter per opspolning,
            afslutnings metoden, geometrisk låst eller tape er forhold man bør kende set i relation til det udstyr
            båndet skal anvendes.
        </div>
        <br>
        <?php bd_img('tape', 'bd-ph--thumb'); ?>

    </div>
</section>

<!-- ═══ ENVIRONMENT ═══════════════════════════════════════ -->
<section class="bd-env">
    <div class="bd-wrap">
        <h2 class="bd-h2">Miljø forhold</h2>
        <br>
        <div class="bd-env__grid">

            <div class="bd-env__block">
                <h3>PP og LDPE materialets sammensætning, er af særlig interesse da dette ofte varmsvejses</h3>
                <ul>
                    <li>PP eller LDPE Homopolymere ca. 97 %</li>
                    <li>Kridt ca. 2–3 %</li>
                    <li>Farve pigment ikke giftigt ca. 1–2 %</li>
                </ul>

                <h3>Toksiske og reaktions egenskaber</h3>
                <ul>
                    <li>Polypropylene/Polyethylen er kemisk og biologisk inaktiv.</li>
                    <li>Polypropylene/Polyethylen kan benyttes direkte i forbindelse med fødevarer. </li>
                </ul>

                <h3>Brændbarhed</h3>
                <ul>
                    <li>
                        Når polypropylen opvarmes i luft, vil materialet smelte ved ca. 165 – 170° og dekomposition
                        vil
                        begynde ved omkring 300° med frigivelse af lav molykylære hydrokulstoffer. Selvantændelse
                        sker
                        ved 380°.
                    </li>
                </ul>

                <h3>Forbrænding</h3>
                <p>Kontrolleret forbrænding anbefales. Når antændt vil materialet fortsætte med at brænde, selv
                    efter at
                    antændelseskilden er fjernet. Dekompositionsprodukterne fra forbrændinger er H20 og CO2 . Hvis
                    afbrændt ved lav tilstedeværelse af ilt vil forbrændingen også producere monooxide, hvilket er
                    giftigt. </p>
            </div>

            <div class="bd-env__block">
                <h3>Svejsning af PP/LDPE materiale</h3>

                <div class="bd-alert">
                    Det anbefales af Arbejdstilsynet, at svejsedampe fra plastsvejsning ventileres til det fri, hvor det
                    er muligt. Ved svejsning ved en temperatur under 150° må røg og dampudvikling anses for at være
                    minimal, uden nogen fare. Det anbefales dog altid at sørge for passende udluftning af hensyn til det
                    almindelige velbefindende.
                </div>

                <div class="bd-alert" style="margin-top: var(--sp-sm);">
                    Det anbefales ikke at varmsvejse PET – Polyester uden reel af sugning og da alene for automatiske
                    anlæg hvor betjeningspersonalet ikke befinder sig tæt på svejsezonen.
                    Både PP og LDPE kan ultralyds svejses uden at der behøves etableret af sugning, da alle svejse dampe
                    ind kables i svejsezonen.
                </div>

                <h3>Fysisk kontakt</h3>
                <ul>
                    <li>
                        <p>Der er ingen risiko, udover den mekaniske. </p>
                    </li>
                </ul>

                <h3>Genbrug</h3>
                <ul>
                    <li>Henholdsvis som papir og plast genbrug er mulig</li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- ═══ RELATED FIELDS ══════════════════════════════════════ -->
<section class="bd-related">
    <div class="bd-wrap">
        <h2 class="bd-h2">Beslægtede områder</h2>
        <br>
        <div class="bd-related__grid">

            <div class="bd-related-card">
                <div class="bd-related-card__icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <rect x="3" y="8" width="18" height="8" rx="1" />
                        <path d="M7 8V6a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" />
                    </svg>
                </div>
                <div>
                    <div class="bd-related-card__name">Omsnøring med bånd</div>
                    <div class="bd-related-card__desc">der anvender plast ”bånd” der svejses
                    </div>
                </div>
            </div>

            <div class="bd-related-card">
                <div class="bd-related-card__icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" />
                        <path d="M12 8v8M8 12h8" />
                    </svg>
                </div>
                <div>
                    <div class="bd-related-card__name">Snorbinding</div>
                    <div class="bd-related-card__desc">der anvender plast, gummi, viskose mv. til at binde omkring
                        produktet.
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══ AUTHOR ══════════════════════════════════════════════ -->
<section class="bd-author">
    <div class="bd-wrap">
        <div class="bd-label">Forfatter til artiklen</div>
        <div class="bd-author__card">
            <div class="bd-author__accent"></div>
            <div class="bd-author__body">
                <div class="bd-author__meta-row">
                    <div>
                        <div class="bd-author__name">Gunnar Salbæk</div>
                        <div class="bd-author__role">CEO / Industrial Design &nbsp;·&nbsp; 20 års erfaring i fagområdet
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    (function () {
        var tabs = document.querySelectorAll('.bd-tab');
        var panels = document.querySelectorAll('.bd-panel');

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