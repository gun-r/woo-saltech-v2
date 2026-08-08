<?php
/**
 * Template Name: Strapping Page
 *
 * Custom page template for the Sal-Tech "Strapping" page.
 *
 * @package SalTech
 */

defined('ABSPATH') || exit;

get_header();

$st_images = [

    /* ── MANUAL TOOLS ── */
    'h46_kronos' => ['src' => get_stylesheet_directory_uri() . '/assets/img/strapping/H-46.png', 'alt' => 'STEP H-46 Kronos batteridrevet omsnøringsværktøj'],
    'h45l_helios' => ['src' => get_stylesheet_directory_uri() . '/assets/img/strapping/H-45L.png', 'alt' => 'STEP H-45L Helios batteridrevet håndomsnøringsværktøj'],

    /* ── SEMI AUTOMATIC ── */
    'tp202' => ['src' => get_stylesheet_directory_uri() . '/assets/img/strapping/TP-202CE1.png', 'alt' => 'STEP TP-202CE1 semi automatisk omsnøringsmaskine'],

    /* ── AUTOMATIC ── */
    'tp6000' => ['src' => get_stylesheet_directory_uri() . '/assets/img/strapping/TP-600CE1.png', 'alt' => 'STEP TP-6000CE1 automatisk rammemaskine 850×600'],

    /* ── FULLY AUTOMATIC ── */
    'tp601a' => ['src' => get_stylesheet_directory_uri() . '/assets/img/strapping/TP-601A.png', 'alt' => 'STEP TP-601A fuld automatisk rammemaskine med rullerbane'],

    /* ── SPECIALIST / PROJECT ── */
    'tp702ns' => ['src' => get_stylesheet_directory_uri() . '/assets/img/strapping/TP-702NS.png', 'alt' => 'STEP TP-702NS fuld automatisk tryksager båndmaskine'],
    'tp702cq' => ['src' => get_stylesheet_directory_uri() . '/assets/img/strapping/TP-702CQ.png', 'alt' => 'STEP TP-702CQ kartonage 4-sider kvadratfunktion'],
    'tp702nil' => ['src' => get_stylesheet_directory_uri() . '/assets/img/strapping/TP-702NIL.png', 'alt' => 'STEP TP-702NIL in-line cross strapping'],
    'tp601b_corner' => ['src' => get_stylesheet_directory_uri() . '/assets/img/strapping/TP-601B.png', 'alt' => 'TP-601B hjørneskubber projektløsning'],

    /* ── ERGO TABLE ── */
    'ergo_table' => ['src' => get_stylesheet_directory_uri() . '/assets/img/strapping/ergo-strap.png', 'alt' => 'STEP Ergo Strap Table med justerbar højde og indbygget vægt'],

    /* ── PROCESS ILLUSTRATION ── */
    'process_overview' => ['src' => get_stylesheet_directory_uri() . '/assets/img/strapping/unnamed.png', 'alt' => 'Omsnøringsprocess illustration'],

];

function st_img($key, $extra_class = '')
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
        --sp-xl: 96px;
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

    .st-wrap {
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

    .st-ph--hero {
        min-height: 420px;
    }

    .st-ph--wide {
        min-height: 300px;
    }

    .st-ph--card {
        min-height: 180px;
    }

    .st-ph--square {
        min-height: 170px;
    }

    .st-ph--thumb {
        min-height: 130px;
    }

    /* ── SECTION LABEL ── */
    .st-label {
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

    .st-label::before {
        content: '';
        display: block;
        width: 18px;
        height: 2px;
        background: var(--red);
    }

    /* ── HEADINGS ── */
    h2.st-h2 {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -.02em;
        color: var(--text-dark);
        line-height: 1.2;
    }

    h3.st-h3 {
        font-size: 22px;
        font-weight: 700;
        letter-spacing: -.01em;
        color: var(--text-dark);
        margin-bottom: var(--sp-sm);
    }

    hr.st-rule {
        border: none;
        border-top: 1px solid var(--border);
        margin: 0;
    }

    /* ════════════════════════════════════════
   BREADCRUMB
════════════════════════════════════════ */
    .st-bc {
        background: var(--bg-light);
        border-bottom: 1px solid var(--border);
        padding: 10px 0;
        font-size: 13px;
        color: var(--text-mid);
    }

    .st-bc a {
        color: var(--text-mid);
    }

    .st-bc a:hover {
        color: var(--red);
        text-decoration: none;
    }

    .st-bc .sep {
        margin: 0 6px;
        color: var(--border);
    }

    /* ════════════════════════════════════════
   HERO  — light grey background
════════════════════════════════════════ */
    .st-hero {
        background: var(--bg-light);
        border-bottom: 1px solid var(--border);
        /* padding: var(--sp-lg) 0 0; */
        overflow: hidden;
    }

    .st-hero__grid {
        display: grid;
        gap: var(--sp-lg);
        align-items: end;
    }

    .st-hero__text {
        /* padding-bottom: var(--sp-lg); */
    }

    .st-hero__eyebrow {
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

    .st-hero__eyebrow::before {
        content: '';
        display: block;
        width: 18px;
        height: 2px;
        background: var(--red);
    }

    .st-hero h1 {
        font-size: clamp(36px, 5.5vw, 66px);
        font-weight: 900;
        letter-spacing: -.03em;
        line-height: 1.0;
        color: var(--text-dark);
        margin-bottom: var(--sp-sm);
    }

    .st-hero h1 em {
        font-style: normal;
        color: var(--red);
    }

    .st-hero__sub {
        font-size: 17px;
        color: var(--text-mid);
        line-height: 1.6;
        max-width: 480px;
        margin-bottom: var(--sp-md);
    }

    .st-hero__stats {
        display: flex;
        gap: var(--sp-md);
        flex-wrap: wrap;
    }

    .st-stat {
        display: flex;
        flex-direction: column;
    }

    .st-stat-num {
        font-size: 26px;
        font-weight: 900;
        color: var(--text-dark);
        letter-spacing: -.03em;
        line-height: 1;
    }

    .st-stat-lbl {
        font-size: 12px;
        color: var(--text-mid);
        margin-top: 2px;
    }

    /* hero image sits flush at bottom */
    .st-hero__img {
        align-self: end;
    }

    /* ════════════════════════════════════════
   INTRO
════════════════════════════════════════ */
    .st-intro {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .st-intro__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        align-items: start;
    }

    .st-intro__lead {
        font-size: 20px;
        line-height: 1.6;
        color: var(--text-dark);
    }

    .st-intro__lead strong {
        color: var(--red);
        font-weight: 700;
    }

    .st-intro__body {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
    }

    .st-intro__body+.st-intro__body {
        margin-top: var(--sp-sm);
    }

    .st-notice {
        display: flex;
        gap: var(--sp-sm);
        align-items: flex-start;
        padding: var(--sp-sm) var(--sp-md);
        background: var(--red-soft);
        border-left: 3px solid var(--red);
        border-radius: 0 var(--r) var(--r) 0;
        margin-top: var(--sp-md);
    }

    .st-notice svg {
        color: var(--red);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .st-notice p {
        font-size: 14px;
        color: var(--text-dark);
        line-height: 1.6;
    }

    /* ════════════════════════════════════════
   EQUIPMENT CARDS
════════════════════════════════════════ */
    .st-equipment {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .st-equip-intro {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: var(--sp-lg);
        align-items: end;
        margin-bottom: var(--sp-lg);
    }

    .st-type-legend {
        display: flex;
        gap: var(--sp-xs);
        flex-wrap: wrap;
    }

    .st-badge {
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

    .st-badge--manual {
        border-color: #6B7280;
        color: #374151;
    }

    .st-badge--semi {
        border-color: #2563EB;
        color: #1D4ED8;
        background: #EFF6FF;
    }

    .st-badge--auto {
        border-color: #D97706;
        color: #92400E;
        background: #FFFBEB;
    }

    .st-badge--full {
        border-color: var(--red);
        color: var(--red);
        background: var(--red-soft);
    }

    .st-equip-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: var(--sp-sm);
    }

    .st-equip-card {
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        background: var(--bg-white);
        transition: box-shadow .2s, border-color .2s, transform .2s;
    }

    .st-equip-card:hover {
        border-color: var(--red);
        box-shadow: 0 6px 24px rgba(220, 38, 38, .09);
        transform: translateY(-3px);
    }

    .st-equip-card__img {
        position: relative;
    }

    .st-equip-card__img::before {
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

    .st-equip-card__body {
        padding: var(--sp-sm);
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
    }

    .st-equip-card__name {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.3;
    }

    .st-equip-card__desc {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.5;
        flex: 1;
    }

    .st-equip-card__link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        font-weight: 600;
        color: var(--red);
        margin-top: var(--sp-xs);
    }

    .st-equip-card__link::after {
        content: '→';
    }

    .st-equip-card__link:hover {
        color: var(--red-hover);
        text-decoration: none;
    }

    /* ════════════════════════════════════════
   PROCESS TABS
════════════════════════════════════════ */
    .st-process {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .st-tabs {
        display: flex;
        border-bottom: 2px solid var(--border);
        margin-bottom: var(--sp-md);
        overflow-x: auto;
        scrollbar-width: none;
    }

    .st-tab {
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

    .st-tab:hover {
        color: var(--text-dark);
    }

    .st-tab.is-active {
        color: var(--red);
        border-bottom-color: var(--red);
    }

    .st-panel {
        display: none;
        animation: stFade .3s ease;
    }

    .st-panel.is-active {
        display: block;
    }

    @keyframes stFade {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .st-panel__grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: var(--sp-lg);
        align-items: start;
    }

    .st-panel__text h3 {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: var(--sp-sm);
        letter-spacing: -.01em;
    }

    .st-panel__text p {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
        margin-bottom: var(--sp-sm);
    }

    .st-panel__features {
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--r);
        padding: var(--sp-md);
    }

    .st-panel__features h4 {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--red);
        margin-bottom: var(--sp-sm);
    }

    .st-panel__features ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .st-panel__features li {
        font-size: 14px;
        color: var(--text-mid);
        padding-left: 20px;
        position: relative;
        line-height: 1.5;
    }

    .st-panel__features li::before {
        content: '→';
        position: absolute;
        left: 0;
        color: var(--red);
        font-weight: 700;
    }

    /* ════════════════════════════════════════
   SPECIALIST MACHINES
════════════════════════════════════════ */
    .st-specialist {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .st-spec-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--sp-sm);
        margin-top: var(--sp-md);
    }

    .st-spec-card {
        display: grid;
        grid-template-columns: 160px 1fr;
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        background: var(--bg-white);
        transition: border-color .2s, box-shadow .2s;
    }

    .st-spec-card:hover {
        border-color: var(--red);
        box-shadow: 0 4px 16px rgba(220, 38, 38, .07);
    }

    .st-spec-card__img {
        width: 160px;
    }

    .st-spec-card__img .st-placeholder {
        min-height: 100%;
        border: none;
        border-radius: 0;
    }

    .st-spec-card__body {
        padding: var(--sp-sm);
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .st-spec-card__industry {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--red);
    }

    .st-spec-card__name {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.3;
    }

    .st-spec-card__desc {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.5;
        flex: 1;
    }

    /* ════════════════════════════════════════
   ERGO TABLE  — pale warm grey bg
════════════════════════════════════════ */
    .st-ergo {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .st-ergo__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        align-items: center;
    }

    .st-ergo__text p {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
        margin-bottom: var(--sp-sm);
    }

    .st-ergo__feats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-sm);
        margin-top: var(--sp-md);
    }

    .st-feat {
        padding: var(--sp-sm);
        border: 1px solid var(--border);
        border-radius: var(--r);
        background: var(--bg-white);
    }

    .st-feat__icon {
        font-size: 18px;
        margin-bottom: 6px;
    }

    .st-feat__title {
        font-size: 13px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 4px;
    }

    .st-feat__desc {
        font-size: 12px;
        color: var(--text-mid);
        line-height: 1.5;
    }

    /* ════════════════════════════════════════
   STRAP TYPES
════════════════════════════════════════ */
    .st-straps {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .st-straps__grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--sp-sm);
        margin-top: var(--sp-md);
    }

    .st-strap-card {
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        background: var(--bg-white);
        transition: border-color .2s, box-shadow .2s, transform .2s;
    }

    .st-strap-card:hover {
        border-color: var(--red);
        box-shadow: 0 4px 16px rgba(220, 38, 38, .07);
        transform: translateY(-2px);
    }

    .st-strap-card__body {
        padding: var(--sp-sm);
    }

    .st-strap-card__name {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .st-strap-card__list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-bottom: var(--sp-sm);
    }

    .st-strap-card__list li {
        font-size: 13px;
        color: var(--text-mid);
        padding-left: 14px;
        position: relative;
    }

    .st-strap-card__list li::before {
        content: '—';
        position: absolute;
        left: 0;
        color: var(--border);
    }

    .st-strap-card__note {
        font-size: 12px;
        color: var(--text-mid);
        border-top: 1px solid var(--border);
        padding-top: 8px;
        margin-top: 8px;
        line-height: 1.5;
    }

    .st-spool-note {
        margin-top: var(--sp-md);
        padding: var(--sp-sm) var(--sp-md);
        border-left: 3px solid var(--red);
        background: var(--red-soft);
        border-radius: 0 var(--r) var(--r) 0;
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.7;
    }

    .st-spool-note strong {
        color: var(--text-dark);
    }

    /* ════════════════════════════════════════
   SPECIAL PROPERTIES
════════════════════════════════════════ */
    .st-props {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .st-props__grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: var(--sp-sm);
        margin-top: var(--sp-md);
    }

    .st-prop {
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--r);
        padding: var(--sp-md);
        border-top: 3px solid var(--red);
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .st-prop h4 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .st-prop p {
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.6;
        flex: 1;
    }

    /* ════════════════════════════════════════
   ENVIRONMENT
════════════════════════════════════════ */
    .st-env {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .st-env__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        margin-top: var(--sp-md);
    }

    .st-env__block h3 {
        font-size: 17px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .st-env__block p,
    .st-env__block li {
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.75;
    }

    .st-env__block ul {
        list-style: none;
    }

    .st-env__block li {
        padding-left: 16px;
        position: relative;
        margin-bottom: 5px;
    }

    .st-env__block li::before {
        content: '·';
        position: absolute;
        left: 0;
        color: var(--red);
        font-size: 18px;
        line-height: 1.2;
    }

    .st-env__block>*+* {
        margin-top: var(--sp-md);
    }

    .st-alert {
        background: var(--bg-light);
        border: 1px solid var(--border);
        border-left: 3px solid var(--red);
        border-radius: 0 var(--r) var(--r) 0;
        padding: var(--sp-sm) var(--sp-md);
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.7;
    }

    .st-alert strong {
        color: var(--text-dark);
    }

    .st-alert+.st-alert {
        margin-top: var(--sp-sm);
    }

    /* ════════════════════════════════════════
   AUTHOR
════════════════════════════════════════ */
    .st-author {
        padding: var(--sp-lg) 0;
        background: var(--bg-light);
        border-top: 1px solid var(--border);
    }

    .st-author__card {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 0;
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        max-width: 680px;
        background: var(--bg-white);
    }

    .st-author__accent {
        width: 5px;
        background: var(--red);
        flex-shrink: 0;
    }

    .st-author__body {
        padding: var(--sp-md);
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .st-author__meta-row {
        display: flex;
        align-items: center;
        gap: var(--sp-sm);
        flex-wrap: wrap;
    }

    .st-author__avatar-initials {
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

    .st-author__name {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -.01em;
    }

    .st-author__role {
        font-size: 13px;
        color: var(--text-mid);
    }

    .st-author__written-by {
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
        .st-spec-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 900px) {

        .st-hero__grid,
        .st-intro__grid,
        .st-panel__grid,
        .st-ergo__grid,
        .st-env__grid {
            grid-template-columns: 1fr;
        }

        .st-straps__grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .st-cta__inner {
            flex-direction: column;
            text-align: center;
        }

        .st-equip-intro {
            grid-template-columns: 1fr;
        }

        .st-spec-card {
            grid-template-columns: 120px 1fr;
        }

        .st-spec-card__img {
            width: 120px;
        }
    }

    @media (max-width: 600px) {
        :root {
            --sp-lg: 40px;
        }

        .st-straps__grid,
        .st-ergo__feats {
            grid-template-columns: 1fr;
        }

        .st-equip-grid {
            grid-template-columns: 1fr 1fr;
        }

        .st-spec-card {
            grid-template-columns: 1fr;
        }

        .st-spec-card__img {
            width: 100%;
        }

        h2.st-h2 {
            font-size: 22px;
        }

        .st-tab {
            padding: 10px 14px;
            font-size: 13px;
        }

        .st-author__card {
            grid-template-columns: 1fr;
        }

        .st-author__accent {
            width: 100%;
            height: 4px;
        }
    }
</style>

<!-- ═══ BREADCRUMB ═══════════════════════════════════════════ -->
<div class="st-bc">
    <div class="st-wrap">
        <?php if (function_exists('woocommerce_breadcrumb')) {
            woocommerce_breadcrumb();
        } else { ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">Forside</a>
            <span class="sep">/</span>
            <span>Strapping</span>
        <?php } ?>
    </div>
</div>

<!-- ═══ HERO ════════════════════════════════════════════════ -->
<section class="st-hero">
    <div class="st-wrap">
        <div class="st-hero__grid">

            <div class="st-hero__text">
                <div class="st-hero__eyebrow">Strapping</div>
                <h1>Omsnøring</h1>
                <p class="st-hero__sub">Hvordan du får det bedste ud af omsnøring.
                    Hvad det kan og ikke kan</p>
            </div>
        </div>
    </div>
</section>

<hr class="st-rule">

<!-- ═══ EQUIPMENT CARDS ══════════════════════════════════════ -->
<section class="st-equipment">
    <div class="st-wrap">

        <div class="st-equip-intro">
            <div>
                <!-- <div class="st-label">Udstyr oversigt</div> -->
                <h2 class="st-h2">Typisk udstyr til omsnøring</h2>
                <!-- <p style="font-size:15px; color:var(--text-mid); line-height:1.7; max-width:560px;">Fra batteridrevne
                    håndomsnøringsværktøjer til fuld automatiske inline-systemer.</p> -->
            </div>
            <div class="st-type-legend">
                <span class="st-badge st-badge--manual">Manuelt</span>
                <span class="st-badge st-badge--semi">Semi Automatisk</span>
                <span class="st-badge st-badge--auto">Automatisk</span>
                <span class="st-badge st-badge--full">Fuld Automatisk</span>
            </div>
        </div>

        <div class="st-equip-grid">

            <div class="st-equip-card">
                <div class="st-equip-card__img" data-type="Manuelt">
                    <?php st_img('h46_kronos', 'st-ph--card'); ?>
                </div>
                <div class="st-equip-card__body">
                    <div class="st-equip-card__name">STEP H-46 KRONOS</div>
                    <div class="st-equip-card__desc">strammer & SEALER batteridrevet</div>
                    <!-- <a href="#" class="st-equip-card__link">Se produkt</a> -->
                </div>
            </div>

            <div class="st-equip-card">
                <div class="st-equip-card__img" data-type="Manuelt">
                    <?php st_img('h45l_helios', 'st-ph--card'); ?>
                </div>
                <div class="st-equip-card__body">
                    <div class="st-equip-card__name">STEP H-45L HELIOS</div>
                    <div class="st-equip-card__desc">Batteridrevet HÅND omsnøringsværktøj</div>
                    <!-- <a href="#" class="st-equip-card__link">Se produkt</a> -->
                </div>
            </div>

            <div class="st-equip-card">
                <div class="st-equip-card__img" data-type="Semi Auto">
                    <?php st_img('tp202', 'st-ph--card'); ?>
                </div>
                <div class="st-equip-card__body">
                    <div class="st-equip-card__name">STEP TP-202CE1</div>
                    <div class="st-equip-card__desc">Semi automatisk pakkebord. Manuel båndføring med varmesvejsning
                    </div>
                    <!-- <a href="#" class="st-equip-card__link">Se produkt</a> -->
                </div>
            </div>

            <div class="st-equip-card">
                <div class="st-equip-card__img" data-type="Automatisk">
                    <?php st_img('tp6000', 'st-ph--card'); ?>
                </div>
                <div class="st-equip-card__body">
                    <div class="st-equip-card__name">STEP TP-6000CE1</div>
                    <div class="st-equip-card__desc">Automatisk rammemaskine med bue 850×600 mm til 12 mm PP-bånd</div>
                    <!-- <a href="#" class="st-equip-card__link">Se produkt</a> -->
                </div>
            </div>

            <div class="st-equip-card">
                <div class="st-equip-card__img" data-type="Fuld Auto">
                    <?php st_img('tp601a', 'st-ph--card'); ?>
                </div>
                <div class="st-equip-card__body">
                    <div class="st-equip-card__name">STEP TP-601A</div>
                    <div class="st-equip-card__desc">Fuld automatisk rammemaskine med rullerbane-infødning.</div>
                    <!-- <a href="#" class="st-equip-card__link">Se produkt</a> -->
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══ INTRO ══════════════════════════════════════════════ -->
<section class="st-intro">
    <div class="st-wrap">
        <div class="st-intro__grid">

            <div>
                <div class="st-label">Proces</div>
                <p class="st-intro__lead">Med omsnøring placer man et bånd omkring sit produkt. Dette bånd enten
                    svejses, lukkes med plombe eller geometrisk låsning, således det holder fast om produktet.
                </p>
                <br>
                <p class="st-intro__body">Med omsnøring kan man have manuelt, semi automatiske, automatiske og fuld
                    automatisk udstyr.</p>
                <p class="st-intro__body">Inden omsnøring skal produktet positioneres om der er tale om 1 stk. eller
                    flere, så skal den endelige position være til stede inden omsnøringen foretages og denne position
                    skal geometrisk stabil.</p>
                <p class="st-intro__body">(se artikel om geometrisk stabilitet ved emballering) For man kan foretage en
                    korrekt omsnøring skal produktet positioneres således det har en tilstrækkelig anlægsflade, der
                    sikre at bånd fortræk kontra pil højde vil tillade at båndet forbliver forspændt efter processen.
                    Man kan omsnører både hårde og bløde produkter, men med begrænsninger for begge typer af produkter.
                    Den generelle begrænsning er anlægsfladens størrelse, der skal typisk skal være større end 100mm og
                    plan.</p>

            </div>

            <div>
                <!-- PROCESS OVERVIEW IMAGE -->
                <div style="margin-top: var(--sp-md);">
                    <?php st_img('process_overview', 'st-ph--wide'); ?>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══ PROCESS TABS ════════════════════════════════════════ -->
<section class="st-process">
    <div class="st-wrap">
        <!-- <div class="st-label">Processer</div> -->
        <h2 class="st-h2">I forhold til de forskellige processer vil det udstyr der finder anvendelse</h2>
        <br>
        <div class="st-tabs" role="tablist">
            <button class="st-tab is-active" data-tab="manuel" role="tab" aria-selected="true">Manuelt</button>
            <button class="st-tab" data-tab="semi" role="tab" aria-selected="false">Semi Automatisk</button>
            <button class="st-tab" data-tab="auto" role="tab" aria-selected="false">Automatisk</button>
            <button class="st-tab" data-tab="fullauto" role="tab" aria-selected="false">Fuld Automatisk</button>
        </div>

        <!-- MANUEL -->
        <div class="st-panel is-active" data-panel="manuel" role="tabpanel">
            <div class="st-panel__grid">
                <div class="st-panel__text">
                    <h3>Manuelt</h3>
                    <p>Generelt: Batteridrevet omsnøringsværktøj. Med fleksible indstillinger, bredt spændingsområde og
                        mulighed for at rumme både PP- og PET -stropper.
                    </p>
                    <p><strong>STEP Kronos H-46A</strong> er velegnet til let og universel anvendelse, mens <strong>STEP
                            Kronos
                            H-46B</strong> er velegnet til tung industri applikationer, begge produkter er praktiske at
                        bruge i jern, tekstil, fødevarer, merchandise og andre relaterede produkter til omsnøring.</p>
                    <p><strong>STEP H-45L</strong> batteridrevet håndbåndsværktøj er en del af STEP H-serien af manuelle
                        håndbåndværktøjer. Det er uafhængigt af kablet strømforsyning, som gør det muligt at være
                        ultra-bærbar. Med friktionssvejsetætningsteknologi er den også uafhængig af at bruge
                        tredjepartsforseglinger.</p>
                </div>
                <!-- <div class="st-panel__features">
                    <h4>Kendetegn</h4>
                    <ul>
                        <li>Batteridrevet — ingen kabelføring</li>
                        <li>PP og PET bånd</li>
                        <li>Friktionssvejsning — ingen plomber</li>
                        <li>Let og tung industri</li>
                        <li>Jern, tekstil, fødevarer, merchandise</li>
                    </ul>
                </div> -->
            </div>
        </div>

        <!-- SEMI -->
        <div class="st-panel" data-panel="semi" role="tabpanel">
            <div class="st-panel__grid">
                <div class="st-panel__text">
                    <h3>Semi automatisk</h3>
                    <p>Generelt: Ringbinding er mulig. Der er ingen øvre pakke størrelse, ud over hvad der kan håndteres
                        på pakke arealet.</p>
                    <p><strong>Semi automatisk pakkebord TP-202</strong>, hvor man manuelt fører PP båndet omkring sit
                        produkt,
                        hvorefter der opstrammes og svejses med varme. Positioneringen af produktet foretages
                        manuelt i forhold til maskinen der står stille.</p>
                    <p>
                        <strong>Semi automatisk palle binder TP-202MV</strong>, hvor man manuelt fører PP/PET båndet
                        omkring sin
                        palle hvorefter der opstrammes og svejses med varme eller friktion. Typisk er det maskinen
                        der positioneres i forhold til produktet der står på gulvet.
                    </p>
                </div>
                <!-- <div class="st-panel__features">
                    <h4>Kendetegn</h4>
                    <ul>
                        <li>Ringbinding mulig</li>
                        <li>Ingen øvre pakkestørrelse</li>
                        <li>PP og PET bånd</li>
                        <li>Varme- eller friktionssvejsning</li>
                        <li>Manuel positionering</li>
                    </ul>
                </div> -->
            </div>
        </div>

        <!-- AUTO -->
        <div class="st-panel" data-panel="auto" role="tabpanel">
            <div class="st-panel__grid">
                <div class="st-panel__text">
                    <h3>Automatisk</h3>
                    <p>Generelt: Ringbinding er ikke mulig, sal-tech easy packaging har dog mulige løsninger hvor der
                        laves åbne/ lukke rammer, således dette er muligt. Pakke størrelse begrænses af ramme dimension
                        og produktets diagonal om det skal kunne drejes 90 grader inden i rammen.</p>
                    <p>
                        <strong>Automatisk ramme maskine TP-601D</strong>, hvor man manuelt fører PP båndet omkring sit
                        produkt,
                        hvorefter der opstrammes og svejses med varme. Positioneringen af produktet foretages
                        manuelt i forhold til maskinen der står stille.
                    </p>
                </div>
                <!-- <div class="st-panel__features">
                    <h4>Kendetegn</h4>
                    <ul>
                        <li>Automatisk båndføring via ramme</li>
                        <li>Varme-, friktions- og ultralydssvejsning</li>
                        <li>Manuel produktpositionering</li>
                        <li>Åbne/lukke rammer muligt</li>
                        <li>Pakke &lt; rammedimension</li>
                    </ul>
                </div> -->
            </div>
        </div>

        <!-- FULD AUTO -->
        <div class="st-panel" data-panel="fullauto" role="tabpanel">
            <div class="st-panel__grid">
                <div class="st-panel__text">
                    <h3>Fuld automatisk</h3>
                    <p>Generelt: Ringbinding er ikke mulig, sal-tech easy packaging har dog mulige løsninger hvor der
                        kan laves åbne/ lukke rammer, således dette er muligt. Pakke størrelse begrænses af ramme
                        dimension og produktets diagonal, om det skal kunne drejes 90 grader inden i rammen.</p>
                    <p>
                        <strong>Automatisk ramme maskine TP-601A</strong>, hvor den selv fører båndet rundt og
                        ved start trækker båndet ud af
                        rammen, og strammer det op omkring produktet. Båndet vil enten blive varme-, friktions-
                        eller ultralydssvejst. Positioneringen af produktet foretages automatisk med rullerbaner
                        TP-601A, bælter TP-601B, ind skubber system, hjørneskubber, ovenfra indfødning med fald og
                        efterfølgende udskub, denne type vil typisk blive lavet projekt tilpasset.
                    </p>
                </div>
                <!-- <div class="st-panel__features">
                    <h4>Kendetegn</h4>
                    <ul>
                        <li>Fuld automatisk positionering</li>
                        <li>Rullerbaner, bælter, skubbere</li>
                        <li>Ovenfra-infødning med fald</li>
                        <li>Projekttilpasset løsning</li>
                        <li>Åbne/lukke rammer muligt</li>
                    </ul>
                </div> -->
            </div>
        </div>

    </div>
</section>

<!-- ═══ SPECIALIST MACHINES ════════════════════════════════ -->
<section class="st-specialist">
    <div class="st-wrap">
        <!-- <div class="st-label">Projekt &amp; Special</div> -->
        <h2 class="st-h2">Projekt specificeret og mere avanceret omsnørings udstyr branche relateret</h2>
        <br>
        <div class="st-spec-grid">

            <div class="st-spec-card">
                <div class="st-spec-card__img">
                    <?php st_img('tp702ns', 'st-ph--square'); ?>
                </div>
                <div class="st-spec-card__body">
                    <div class="st-spec-card__industry">Grafisk industri · Tryksager · Brochure · Aviser mv</div>
                    <div class="st-spec-card__name">STEP TP-702NS — Fuld automatisk udskriftsmedier bånd maskine</div>
                    <!-- <div class="st-spec-card__desc">Høj hastighed. Fuld automatisk til enkelt- og parallelomsnøring,
                        integrérbar i produktionslinjer. Designet til aviser, blade, brochurer og tryksager.</div> -->
                    <!-- <a href="#" class="st-equip-card__link" style="margin-top:auto;">Se produkt</a> -->
                </div>
            </div>

            <div class="st-spec-card">
                <div class="st-spec-card__img">
                    <?php st_img('tp702cq', 'st-ph--square'); ?>
                </div>
                <div class="st-spec-card__body">
                    <div class="st-spec-card__industry">Kartonage industri</div>
                    <div class="st-spec-card__name">STEP TP-702CQ Corrugated båndstrammere med — 4-sider kvadrat
                        funktion
                    </div>
                    <!-- <div class="st-spec-card__desc">Automatisk omsnøringsmaskine med 4-sidet kvadratfunktion. Anbefales
                        til korrugeret industri med krav til præcis bundling af kasser og kartonage.</div> -->
                    <!-- <a href="#" class="st-equip-card__link" style="margin-top:auto;">Se produkt</a> -->
                </div>
            </div>

            <div class="st-spec-card">
                <div class="st-spec-card__img">
                    <?php st_img('tp702nil', 'st-ph--square'); ?>
                </div>
                <div class="st-spec-card__body">
                    <div class="st-spec-card__industry">Grafisk industri · Aviser &amp; Ugeblade</div>
                    <div class="st-spec-card__name">STEP TP-702NIL — Fuld automatisk bånd maskine til In-line Cross
                        Strapping</div>
                    <!-- <div class="st-spec-card__desc">Fuld automatisk til in-line krydsomsnøring. Kompakt design. Særligt
                        egnet til aviser og ugepublikationer med høj gennemstrømning.</div> -->
                    <!-- <a href="#" class="st-equip-card__link" style="margin-top:auto;">Se produkt</a> -->
                </div>
            </div>

            <div class="st-spec-card">
                <div class="st-spec-card__img">
                    <?php st_img('tp601b_corner', 'st-ph--square'); ?>
                </div>
                <div class="st-spec-card__body">
                    <div class="st-spec-card__industry">Distribution · Hardware · Kasser mv</div>
                    <div class="st-spec-card__name">TP-601B × 2 stk — Hjørneskubberbinding projektløsning</div>
                    <!-- <div class="st-spec-card__desc">To TP-601B maskiner med hjørneskubbersystem. Projekttilpasset
                        løsning til distribution af hardware og kasser med fuld automatisk positionering.</div> -->
                    <!-- <a href="#" class="st-equip-card__link" style="margin-top:auto;">Se produkt</a> -->
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══ ERGO TABLE ══════════════════════════════════════════ -->
<section class="st-ergo">
    <div class="st-wrap">
        <div class="st-ergo__grid">

            <!-- ERGO IMAGE — replace src in $st_images['ergo_table'] -->
            <div>
                <?php st_img('ergo_table', 'st-ph--square'); ?>
            </div>

            <div class="st-ergo__text">
                <!-- <div class="st-label">Ergonomi</div> -->
                <h2 class="st-h2">STEP ERGO STRAP TABLE</h2>
                <br>
                <p>Du kan også finde et kombineret system med fokus på ergonomiske spørgsmål og tidsbesparelse.</p>
                <p><strong>STEP ERGO STRAP TABLE MED INDBYGGET& JUSTERBAR HØJDE</strong>
                </p>
                <p>VÆGTTRIN/E3 Hallbrook Ergo Strap Table er et ergonomisk design, der bruges til vejning og ombinding
                    af kasser og andre produkter, der kræver spænding. Det er innovativt konstrueret til at give føreren
                    komfort med en justerbar bordhøjde og en indbygget vægt for at levere en mere effektiv proces med
                    hensyn til vejning og pakning.</p>

                <!-- <div class="st-ergo__feats">
                    <div class="st-feat">
                        <div class="st-feat__icon">↕</div>
                        <div class="st-feat__title">Justerbar højde</div>
                        <div class="st-feat__desc">Tilpasses operatørens arbejdshøjde.</div>
                    </div>
                    <div class="st-feat">
                        <div class="st-feat__icon">⚖</div>
                        <div class="st-feat__title">Indbygget vægt</div>
                        <div class="st-feat__desc">Vejning og omsnøring i én arbejdsgang.</div>
                    </div>
                    <div class="st-feat">
                        <div class="st-feat__icon">⏱</div>
                        <div class="st-feat__title">Tidsbesparelse</div>
                        <div class="st-feat__desc">Eliminerer unødvendige arbejdsgange.</div>
                    </div>
                    <div class="st-feat">
                        <div class="st-feat__icon">✓</div>
                        <div class="st-feat__title">Ergonomisk</div>
                        <div class="st-feat__desc">Reducerer helbredsrisici for pakkepersonale.</div>
                    </div>
                </div> -->
            </div>

        </div>
    </div>
</section>

<!-- ═══ STRAP TYPES ════════════════════════════════════════ -->
<section class="st-straps">
    <div class="st-wrap">
        <!-- <div class="st-label">Materialer</div> -->
        <h2 class="st-h2">Omsnøringsbånd typer</h2>
        <br>
        <div class="st-straps__grid">
            <div class="st-strap-card">
                <div class="st-strap-card__body">
                    <div class="st-strap-card__name">Plastbånd</div>
                    <ul class="st-strap-card__list">
                        <li>PP bånd — Polypropylen</li>
                        <li>PET bånd — Polyester</li>
                        <li>PA bånd — Polyamid</li>
                    </ul>
                    <!-- <div class="st-strap-card__note">PET erstatter stålbånd. PA hygroskopisk — egnet til tømmer.</div> -->
                </div>
            </div>

            <div class="st-strap-card">
                <div class="st-strap-card__body">
                    <div class="st-strap-card__name">Stålbånd</div>
                    <ul class="st-strap-card__list">
                        <li>Blank stålbånd</li>
                        <li>Blånede stålbånd</li>
                        <li>Sort lakeret stålbånd</li>
                        <li>Rustfast stålbånd</li>
                    </ul>
                    <!-- <div class="st-strap-card__note">Til krævende applikationer og korrosionsbestandighed.</div> -->
                </div>
            </div>

            <div class="st-strap-card">
                <div class="st-strap-card__body">
                    <div class="st-strap-card__name">Vævet bånd</div>
                    <ul class="st-strap-card__list">
                        <li>WG bånd — Flettet basis snor hotmelt limet Polyester</li>
                        <li>EG bånd — Fletter basis snor hotmelt limet polypropylen</li>
                        <li>Vævet bånd — Polyester eller Polypropylen</li>
                    </ul>
                    <!-- <div class="st-strap-card__note">Store trækstyrker. Fleksibelt om hjørner.</div> -->
                </div>
            </div>

        </div>

        <div class="st-spool-note">
            <strong>Oplægning</strong> Ved ordreafgivelse på omsnøringsbånd er oplægningen meget vigtigt at kende.
            Typisk
            leveres bånd på en indvendig kerne diameter på Ø60, Ø76, Ø150, Ø200, Ø230, Ø280 eller Ø406 og disse igen på
            et antal standard bredder typisk 110, 150, 190mm.
            Stålbånd leveres som enkelt ringe eller oscillerende spoler.
            Bånd bredder der produceres spænder fra 4mm til 38mm, og endda bredere for vævet bånd typer.
        </div>
    </div>
</section>

<!-- ═══ SPECIAL PROPERTIES ══════════════════════════════════ -->
<section class="st-props">
    <div class="st-wrap">
        <!-- <div class="st-label">Særlige egenskaber</div> -->
        <h2 class="st-h2">Vælg det rette bånd til opgaven</h2>
        <br>
        <div class="st-props__grid">
            <div class="st-prop">
                <h4>PET</h4>
                <p>PET det stive bånd der er velegnet til erstatte stålbånd da det let føres igennem paller og har store
                    strækstyrker.</p>
            </div>
            <div class="st-prop">
                <h4>PA</h4>
                <p>PA bånd der er hydroskopisk hvorved det kan arbejde med produkter der udvider sig når de bliver våde,
                    som f.eks. tømmer.</p>
            </div>
            <div class="st-prop">
                <h4>WG</h4>
                <p>WG bånd der har store trækstyrker og er meget fleksibelt omkring hjørner og som kan arbejde med
                    produktet.</p>
            </div>
            <div class="st-prop">
                <h4>PP</h4>
                <p>PP bånd der er vejegnet til decentralt placeret maskiner i tæt kontakt med operatøren, lettere
                    applikationer og pris billigt.</p>
            </div>
            <div class="st-prop">
                <h4>Rustfast stålbånd</h4>
                <p>Rustfast stålbånd når løsningen krævet det.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══ ENVIRONMENT ═══════════════════════════════════════ -->
<section class="st-env">
    <div class="st-wrap">
        <!-- <div class="st-label">Miljø &amp; Sikkerhed</div> -->
        <h2 class="st-h2">Miljø forhold</h2>
        <br>
        <div class="st-env__grid">

            <div class="st-env__block">
                <h3>PP materialets sammensætning, er af særlig interesse da dette ofte varmsvejses</h3>
                <ul>
                    <li>Polypropylene Homopolymere ca. 97 %</li>
                    <li>Kridt ca. 2–3 %</li>
                    <li>Farve pigment ikke giftigt ca. 1–2 %</li>
                </ul>

                <h3>Toksiske og reaktions egenskaber</h3>
                <ul>
                    <li>Polypropylene og Polyester er kemisk og biologisk inaktiv.</li>
                    <li>Polypropylene og Polyester kan
                        benyttes
                        direkte i forbindelse med fødevarer.</li>
                </ul>

                <h3>Brændbarhed</h3>
                <ul>
                    <li>Når polypropylen opvarmes i luft, vil materialet smelte ved ca. 165 – 170° og dekomposition
                        vil
                        begynde ved omkring 300 med frigivelse af lav molykylære hydrokulstoffer. Selvantændelse
                        sker ved
                        380°.</li>
                </ul>

                <h3>Forbrænding</h3>
                <p>Kontrolleret forbrænding anbefales. Når antændt vil materialet fortsætte med at brænde, selv
                    efter at
                    antændelseskilden er fjernet. Dekompositionsprodukterne fra forbrændinger er H₂O og CO₂.
                    Hvis
                    afbrændt ved lav tilstedeværelse af ilt vil forbrændingen også producere monooxide, hvilket
                    er
                    giftigt.</p>

            </div>

            <div class="st-env__block">
                <h3>Svejsning af PP materiale</h3>
                <p>Det anbefales af Arbejdstilsynet, at svejsedampe fra plastsvejsning ventileres til det fri, hvor det
                    er muligt. Ved svejsning ved en temperatur under 150° må røg og dampudvikling anses for at være
                    minimal, uden nogen fare. Det anbefales dog altid at sørge for passende udluftning af hensyn til det
                    almindelige velbefindende.</p>

                <div class="st-alert">
                    <strong>Det anbefales ikke at varmsvejse PET</strong> – Polyester uden reel af sugning og da alene
                    for automatiske
                    anlæg hvor betjenings personalet ikke befinder sig tæt på svejsezonen.
                </div>

                <div class="st-alert">
                    Både PP og PET kan friktions svejse og ultralyds svejses uden at der behøves etableret af sugning,
                    da alle svejse dampe ind kables i svejsezonen.
                </div>

                <h3>Fysisk kontakt</h3>
                <ul>
                    <li>Der er ingen risiko, udover den mekaniske.</li>
                </ul>

                <h3>Genbrug</h3>
                <ul>
                    <li>I henhold til tysk lovgivning, skal PP emballeringsmateriale være sort. Vi anbefaler, at denne
                        farve benyttes, hvor det er muligt og i modsat fald mærkes der fornødent.</li>
                    <li>For PET gælder det at farven skal være grøn. PET er særligt velegnet til genanvendelse.
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- ═══ AUTHOR — New style ══════════════════════════════════ -->
<section class="st-author">
    <div class="st-wrap">
        <div class="st-label">
            Forfatter til artiklen</div>
        <div class="st-author__card">
            <div class="st-author__accent"></div>
            <div class="st-author__body">
                <div class="st-author__meta-row">
                    <div>
                        <div class="st-author__name">Gunnar Salbæk</div>
                        <div class="st-author__role">CEO / Industrial Design med mere end 30 års erfaring i fagområdet.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    (function () {
        var tabs = document.querySelectorAll('.st-tab');
        var panels = document.querySelectorAll('.st-panel');
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