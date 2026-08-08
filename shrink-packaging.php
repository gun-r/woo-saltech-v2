<?php
/**
 * Template Name: Shrink Packaging Page
 *
 * Custom page template for the Sal-Tech "Shrink Packaging" page.
 *
 * @package SalTech
 */

defined('ABSPATH') || exit;

get_header();

$shk_images = [

    /* ── MACHINES ── */
    'nf500' => ['src' => get_stylesheet_directory_uri() . '/assets/img/shrinkpackaging/step-nf500-1500-banding-and-shrinking-machine.jpg', 'alt' => 'STEP NF500-1500 Banding and Shrinking Machine'],
    'dm782' => ['src' => get_stylesheet_directory_uri() . '/assets/img/shrinkpackaging/step-dm782-ps.jpg', 'alt' => 'STEP DM782-PS shrink packaging machine'],
    'uw1736' => ['src' => get_stylesheet_directory_uri() . '/assets/img/shrinkpackaging/step-uw-1736-shrink-torch.jpg', 'alt' => 'STEP UW-1736 Shrink Torch – varmepistol'],

    /* ── PROCESS / MATERIALS ── */
    'process_overview' => ['src' => get_stylesheet_directory_uri() . '/assets/img/shrinkpackaging/step-bzn-shrink-film.jpg', 'alt' => 'Krympeemballage proces illustration'],

];

function shk_img($key, $extra_class = '')
{
    global $shk_images;
    $img = $shk_images[$key] ?? ['src' => '', 'alt' => $key];

    if (!empty($img['src'])) {
        echo '<img src="' . esc_url($img['src']) . '" alt="' . esc_attr($img['alt']) . '" class="shk-img ' . esc_attr($extra_class) . '" loading="lazy">';
    } else {
        echo '<div class="shk-placeholder ' . esc_attr($extra_class) . '" title="' . esc_attr('Billede: ' . $img['alt']) . '">'
            . '<div class="shk-placeholder__inner">'
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

    .shk-wrap {
        max-width: var(--max-w);
        margin: 0 auto;
        padding: 0 var(--sp-md);
    }

    /* ── IMAGES / PLACEHOLDERS ── */
    .shk-img {
        display: block;
        width: 100%;
        height: 100px;
        object-fit: contain;
        border-radius: var(--r);
    }

    .shk-placeholder {
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

    .shk-placeholder:hover {
        border-color: var(--red);
    }

    .shk-placeholder__inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        padding: var(--sp-md);
        text-align: center;
    }

    .shk-placeholder__inner svg {
        opacity: .3;
    }

    .shk-placeholder__inner span {
        font-size: 11px;
        color: var(--text-mid);
        max-width: 160px;
        line-height: 1.4;
        opacity: .75;
    }

    .shk-ph--hero {
        min-height: 420px;
    }

    .shk-ph--wide {
        min-height: 300px;
    }

    .shk-ph--card {
        min-height: 200px;
    }

    .shk-ph--square {
        min-height: 240px;
    }

    .shk-ph--thumb {
        min-height: 140px;
    }

    /* ── SECTION LABEL ── */
    .shk-label {
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

    .shk-label::before {
        content: '';
        display: block;
        width: 18px;
        height: 2px;
        background: var(--red);
    }

    /* ── HEADINGS ── */
    h2.shk-h2 {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -.02em;
        color: var(--text-dark);
        line-height: 1.2;
        margin-bottom: var(--sp-md);
    }

    h3.shk-h3 {
        font-size: 20px;
        font-weight: 700;
        letter-spacing: -.01em;
        color: var(--text-dark);
        margin-bottom: var(--sp-sm);
    }

    hr.shk-rule {
        border: none;
        border-top: 1px solid var(--border);
        margin: 0;
    }

    /* ── NOTICE ── */
    .shk-notice {
        display: flex;
        gap: var(--sp-sm);
        align-items: flex-start;
        padding: var(--sp-sm) var(--sp-md);
        background: var(--red-soft);
        border-left: 3px solid var(--red);
        border-radius: 0 var(--r) var(--r) 0;
        margin-top: var(--sp-md);
    }

    .shk-notice svg {
        color: var(--red);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .shk-notice p {
        font-size: 14px;
        color: var(--text-dark);
        line-height: 1.6;
    }

    /* ── ALERT ── */
    .shk-alert {
        background: var(--bg-light);
        border: 1px solid var(--border);
        border-left: 3px solid var(--red);
        border-radius: 0 var(--r) var(--r) 0;
        padding: var(--sp-sm) var(--sp-md);
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.7;
    }

    .shk-alert strong {
        color: var(--text-dark);
    }

    .shk-alert+.shk-alert {
        margin-top: var(--sp-sm);
    }

    /* ════════════════════════════════════════
   BREADCRUMB
════════════════════════════════════════ */
    .shk-bc {
        background: var(--bg-light);
        border-bottom: 1px solid var(--border);
        padding: 10px 0;
        font-size: 13px;
        color: var(--text-mid);
    }

    .shk-bc a {
        color: var(--text-mid);
    }

    .shk-bc a:hover {
        color: var(--red);
        text-decoration: none;
    }

    .shk-bc .sep {
        margin: 0 6px;
        color: var(--border);
    }

    /* ════════════════════════════════════════
   HERO
════════════════════════════════════════ */
    .shk-hero {
        background: var(--bg-light);
        border-bottom: 1px solid var(--border);
        /* padding: var(--sp-lg) 0 0; */
        overflow: hidden;
    }

    .shk-hero__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        align-items: end;
    }

    .shk-hero__text {
        /* padding-bottom: var(--sp-lg); */
    }

    .shk-hero__eyebrow {
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

    .shk-hero__eyebrow::before {
        content: '';
        display: block;
        width: 18px;
        height: 2px;
        background: var(--red);
    }

    .shk-hero h1 {
        font-size: clamp(36px, 5.5vw, 66px);
        font-weight: 900;
        letter-spacing: -.03em;
        line-height: 1.0;
        color: var(--text-dark);
        margin-bottom: var(--sp-sm);
    }

    .shk-hero h1 em {
        font-style: normal;
        color: var(--red);
    }

    .shk-hero__sub {
        font-size: 17px;
        color: var(--text-mid);
        line-height: 1.6;
        max-width: 480px;
        margin-bottom: var(--sp-md);
    }

    .shk-hero__stats {
        display: flex;
        gap: var(--sp-md);
        flex-wrap: wrap;
    }

    .shk-stat {
        display: flex;
        flex-direction: column;
    }

    .shk-stat-num {
        font-size: 26px;
        font-weight: 900;
        color: var(--text-dark);
        letter-spacing: -.03em;
        line-height: 1;
    }

    .shk-stat-lbl {
        font-size: 12px;
        color: var(--text-mid);
        margin-top: 2px;
    }

    .shk-hero__img {
        align-self: end;
    }

    /* ════════════════════════════════════════
   INTRO — what is shrink packaging
════════════════════════════════════════ */
    .shk-intro {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .shk-intro__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        align-items: start;
    }

    .shk-intro__lead {
        font-size: 20px;
        line-height: 1.6;
        color: var(--text-dark);
    }

    .shk-intro__lead strong {
        color: var(--red);
        font-weight: 700;
    }

    .shk-intro__body {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
    }

    .shk-intro__body+.shk-intro__body {
        margin-top: var(--sp-sm);
    }

    /* ════════════════════════════════════════
   FILM TYPES
════════════════════════════════════════ */
    .shk-films {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .shk-films__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-sm);
        margin-top: var(--sp-md);
    }

    .shk-film-card {
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: border-color .2s, box-shadow .2s;
    }

    .shk-film-card:hover {
        border-color: var(--red);
        box-shadow: 0 4px 16px rgba(220, 38, 38, .07);
    }

    .shk-film-card__head {
        padding: var(--sp-sm) var(--sp-md);
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
        display: flex;
        align-items: center;
        gap: var(--sp-sm);
    }

    .shk-film-card__badge {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        padding: 3px 8px;
        border-radius: 100px;
    }

    .shk-film-card__badge--legacy {
        background: var(--bg-mid);
        color: var(--text-mid);
        border: 1px solid var(--border);
    }

    .shk-film-card__badge--modern {
        background: var(--red-soft);
        color: var(--red);
        border: 1px solid rgba(220, 38, 38, .2);
    }

    .shk-film-card__head-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -.01em;
    }

    .shk-film-card__head-sub {
        font-size: 12px;
        color: var(--text-mid);
        margin-top: 1px;
    }

    .shk-film-card__img {
        width: 100%;
    }

    .shk-film-card__body {
        padding: var(--sp-md);
        display: flex;
        flex-direction: column;
        gap: var(--sp-sm);
        flex: 1;
    }

    .shk-film-card__body p {
        font-size: 14px;
        color: var(--text-mid);
        line-height: 1.75;
    }

    .shk-film-card__pros,
    .shk-film-card__cons {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .shk-film-card__pros li,
    .shk-film-card__cons li {
        font-size: 13px;
        color: var(--text-mid);
        padding-left: 20px;
        position: relative;
        line-height: 1.5;
    }

    .shk-film-card__pros li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #16A34A;
        font-weight: 700;
    }

    .shk-film-card__cons li::before {
        content: '✕';
        position: absolute;
        left: 0;
        color: #DC2626;
        font-weight: 700;
    }

    .shk-film-card__section-head {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--text-mid);
        margin-bottom: 8px;
        margin-top: 4px;
    }

    /* ════════════════════════════════════════
   MACHINE CARDS
════════════════════════════════════════ */
    .shk-machines {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .shk-machines__intro {
        display: grid;
        /* grid-template-columns: 1fr auto; */
        gap: var(--sp-sm);
        align-items: end;
        margin-bottom: var(--sp-lg);
    }

    .shk-badge {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 100px;
        border: 1px solid var(--border);
        background: var(--bg-light);
        color: var(--text-mid);
        white-space: nowrap;
    }

    .shk-badge--semi {
        border-color: #2563EB;
        color: #1D4ED8;
        background: #EFF6FF;
    }

    .shk-badge--auto {
        border-color: #D97706;
        color: #92400E;
        background: #FFFBEB;
    }

    .shk-machines__grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--sp-sm);
    }

    .shk-machine-card {
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        background: var(--bg-white);
        transition: box-shadow .2s, border-color .2s, transform .2s;
    }

    .shk-machine-card:hover {
        border-color: var(--red);
        box-shadow: 0 6px 24px rgba(220, 38, 38, .09);
        transform: translateY(-3px);
    }

    .shk-machine-card__img {
        position: relative;
    }

    .shk-machine-card__img::before {
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

    .shk-machine-card__body {
        padding: var(--sp-sm);
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
    }

    .shk-machine-card__name {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.3;
    }

    .shk-machine-card__desc {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.55;
        flex: 1;
    }

    .shk-machine-card__link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        font-weight: 600;
        color: var(--red);
        margin-top: var(--sp-xs);
    }

    .shk-machine-card__link::after {
        content: '→';
    }

    .shk-machine-card__link:hover {
        color: var(--red-hover);
        text-decoration: none;
    }

    /* ════════════════════════════════════════
   PROCESS
════════════════════════════════════════ */
    .shk-process {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .shk-process__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--sp-lg);
        align-items: start;
        margin-top: var(--sp-md);
    }

    .shk-process__text p {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
        margin-bottom: var(--sp-sm);
    }

    /* Heat application options */
    .shk-heat-options {
        display: flex;
        flex-direction: column;
        gap: var(--sp-xs);
        margin-top: var(--sp-sm);
    }

    .shk-heat-opt {
        display: flex;
        align-items: center;
        gap: var(--sp-sm);
        padding: 12px var(--sp-sm);
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--r);
        transition: border-color .15s;
    }

    .shk-heat-opt:hover {
        border-color: var(--red);
    }

    .shk-heat-opt__icon {
        width: 36px;
        height: 36px;
        border-radius: var(--r);
        flex-shrink: 0;
        background: var(--red-soft);
        border: 1px solid rgba(220, 38, 38, .2);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .shk-heat-opt__icon svg {
        color: var(--red);
    }

    .shk-heat-opt__title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .shk-heat-opt__desc {
        font-size: 12px;
        color: var(--text-mid);
        margin-top: 2px;
        line-height: 1.4;
    }

    /* ════════════════════════════════════════ */
    .shk-skinpack {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-white);
    }

    .shk-skinpack__grid {
        display: grid;
        /* grid-template-columns: 1fr 1fr; */
        gap: var(--sp-lg);
        align-items: center;
        margin-top: var(--sp-md);
    }

    .shk-skinpack__text p {
        font-size: 15px;
        color: var(--text-mid);
        line-height: 1.8;
        margin-bottom: var(--sp-sm);
    }

    .shk-skinpack__steps {
        display: flex;
        flex-direction: column;
        gap: var(--sp-xs);
        margin-top: var(--sp-sm);
    }

    .shk-skinpack__step {
        display: flex;
        align-items: flex-start;
        gap: var(--sp-sm);
        padding: 12px var(--sp-sm);
        background: var(--bg-light);
        border: 1px solid var(--border);
        border-radius: var(--r);
    }

    .shk-skinpack__step-num {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        flex-shrink: 0;
        background: var(--red-soft);
        border: 1.5px solid var(--red);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 800;
        color: var(--red);
    }

    .shk-skinpack__step-text {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.5;
        padding-top: 3px;
    }

    .shk-skinpack__step-text strong {
        color: var(--text-dark);
    }

    /* ════════════════════════════════════════ */
    .shk-protection {
        padding: var(--sp-lg) 0;
        border-bottom: 1px solid var(--border);
        background: var(--bg-light);
    }

    .shk-protection__grid {
        display: grid;
        /* grid-template-columns: repeat(3, 1fr); */
        gap: var(--sp-sm);
        margin-top: var(--sp-md);
    }

    .shk-prot-card {
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: var(--r);
        padding: var(--sp-md);
        border-top: 3px solid var(--red);
        display: flex;
        flex-direction: column;
        gap: 8px;
        transition: box-shadow .2s, transform .2s;
    }

    .shk-prot-card:hover {
        box-shadow: 0 4px 16px rgba(220, 38, 38, .07);
        transform: translateY(-2px);
    }

    .shk-prot-card__icon {
        font-size: 22px;
        line-height: 1;
    }

    .shk-prot-card__title {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .shk-prot-card__desc {
        font-size: 13px;
        color: var(--text-mid);
        line-height: 1.6;
        flex: 1;
    }

    /* ════════════════════════════════════════
   AUTHOR
════════════════════════════════════════ */
    .shk-author {
        padding: var(--sp-lg) 0;
        background: var(--bg-light);
        border-top: 1px solid var(--border);
    }

    .shk-author__card {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 0;
        border: 1px solid var(--border);
        border-radius: var(--r);
        overflow: hidden;
        max-width: 680px;
        background: var(--bg-white);
    }

    .shk-author__accent {
        width: 5px;
        background: var(--red);
    }

    .shk-author__body {
        padding: var(--sp-md);
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .shk-author__written-by {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .13em;
        text-transform: uppercase;
        color: var(--red);
        margin-bottom: 4px;
    }

    .shk-author__meta-row {
        display: flex;
        align-items: center;
        gap: var(--sp-sm);
        flex-wrap: wrap;
    }

    .shk-author__avatar {
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

    .shk-author__name {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -.01em;
    }

    .shk-author__role {
        font-size: 13px;
        color: var(--text-mid);
    }

    /* ════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════ */
    @media (max-width: 1024px) {
        .shk-protection__grid {
            /* grid-template-columns: repeat(2, 1fr); */
        }

        .shk-apps__grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 900px) {

        .shk-hero__grid,
        .shk-intro__grid,
        .shk-films__grid,
        .shk-process__grid,
        .shk-skinpack__grid {
            grid-template-columns: 1fr;
        }

        .shk-machines__intro {
            /* grid-template-columns: 1fr; */
        }

        .shk-machines__grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {
        :root {
            --sp-lg: 40px;
        }

        .shk-machines__grid {
            grid-template-columns: 1fr;
        }

        .shk-protection__grid,
        .shk-apps__grid {
            /* grid-template-columns: 1fr; */
        }

        h2.shk-h2 {
            font-size: 22px;
        }

        .shk-author__card {
            grid-template-columns: 1fr;
        }

        .shk-author__accent {
            width: 100%;
            height: 4px;
        }
    }
</style>

<!-- ═══ BREADCRUMB ═══════════════════════════════════════════ -->
<div class="shk-bc">
    <div class="shk-wrap">
        <?php if (function_exists('woocommerce_breadcrumb')) {
            woocommerce_breadcrumb();
        } else { ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">Forside</a>
            <span class="sep">/</span>
            <span>Shrink Packaging</span>
        <?php } ?>
    </div>
</div>

<!-- ═══ HERO ════════════════════════════════════════════════ -->
<section class="shk-hero">
    <div class="shk-wrap">
        <div class="shk-hero__grid">

            <div class="shk-hero__text">
                <div class="shk-hero__eyebrow">Shrink Packaging</div>
                <h1>Om krympeemballage</h1>
                <p class="shk-hero__sub">En gennemgang i shrink packaging — forstå det grundlæggende.</p>
            </div>
        </div>
    </div>
</section>

<hr class="shk-rule">

<!-- ═══ INTRO ══════════════════════════════════════════════ -->
<section class="shk-intro">
    <div class="shk-wrap">
        <div class="shk-intro__grid">

            <div>
                <!-- PROCESS OVERVIEW IMAGE -->
                <div>
                    <?php shk_img('process_overview', 'shk-ph--wide'); ?>
                </div>
            </div>

            <div>
                <p class="shk-intro__body">I et supermarked er der en masse produkter pakket i plast. De fleste af dem
                    er simpelthen i en plastikpose, nogle er i en hård plastbeholder.</p>
                <p class="shk-intro__body">Næsten alle er pakket i en slags plast eller plastlignende materialer. Men
                    der er denne særlige form for plastemballage, der synes at blive anvendt på næsten dem alle.</p>
                <p class="shk-intro__body">En plast indpakket tæt på produktets emballage, og den passer nøjagtigt som
                    om en skrædder havde lavet den. Så hvad er det egentlig? </p>
            </div>

        </div>
    </div>
</section>

<!-- ═══ FILM TYPES ══════════════════════════════════════════ -->
<section class="shk-films">
    <div class="shk-wrap">
        <h2 class="shk-h2">PVC og polyolefin</h2>

        <div class="shk-films__grid">

            <!-- PVC -->
            <div class="shk-film-card">
                <div class="shk-film-card__body">
                    <p>PVC står for Polyvinylchlorid; det er også den tredje mest producerede plast i verden. Det var
                        også den mest almindeligt anvendte form for krympefilm, indtil den blev erstattet af polyolefin
                        -krympefilm på grund af dens mange ulemper. Opbevaringsproblemer opstår, når PVC hærder under
                        kolde forhold og blødgør under varme temperaturer, hvilket i høj grad kompromitterer dets styrke
                        og holdbarhed.
                    </p>
                </div>
            </div>

            <!-- POLYOLEFIN -->
            <div class="shk-film-card">
                <div class="shk-film-card__body">
                    <p>
                        I dag er den mest almindelige krympefilm Polyolefin på grund af dens styrke og fleksibilitet.
                        Det bruges meget til emballering af både spiselige og ikke-spiselige produkter. Det er det
                        foretrukne valg til emballering af mad, fordi det producerer mindre lugt i forhold til PVC, og
                        det har fleksible opbevaringsmuligheder. Dengang er det dyrt at implementere og anvende
                        polyolefinfilm til krympning af emballage på grund af dets høje priser og krympemaskiner
                        inkompatibilitet. Nu er billigere men højere kvalitet polyolefinfilm tilgængelige på markedet.
                        Moderne krympemaskiner er designet til at rumme polyolefinfilm som en standard, hvilket gør det
                        meget omkostningseffektivt.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══ MACHINE CARDS ═══════════════════════════════════════ -->
<section class="shk-machines">
    <div class="shk-wrap">

        <div class="shk-machines__intro">
            <div>
                <h2 class="shk-h2">Krymp indpakning</h2>
                <p style="font-size:15px; color:var(--text-mid); line-height:1.7;">The packaging
                    process is more commonly known as Shrink Wrapping. The process uses a Polyolefin or PVC plastic
                    films which can stand the heat and more importantly, shrink. Heat can be applied using heat guns or
                    by a shrink tunnel or ovens. But sometimes, a heat gun is not enough to do the job, but a shrink
                    tunnel can be a bit too big for a small factory. Semi-automatic and automatic shrink machines solve
                    this problem. Semi-automatic shrink machines come in various sizes for products with various
                    dimensions. Automatic shrink machines can be integrated with production lines for easier packaging
                    solutions. Shrink wraps are commonly used as overwraps on various types of packaging. Most notable
                    examples of these are on boxes, beverage cans, printed materials and CD/DVD/Blu-ray boxes. With the
                    right equipment, one can shrink package virtually any product.</p>
            </div>

            <div style="display:flex; gap:var(--sp-xs); justify-content: flex-end;">
                <span class="shk-badge shk-badge--semi">Semi Automatisk</span>
                <span class="shk-badge shk-badge--auto">Automatisk</span>
            </div>
        </div>

        <div class="shk-machines__grid">

            <div class="shk-machine-card">
                <div class="shk-machine-card__img" data-type="Semi Auto">
                    <?php shk_img('nf500', 'shk-ph--card'); ?>
                </div>
                <div class="shk-machine-card__body">
                    <div class="shk-machine-card__name">STEP NF500-1500</div>
                    <div class="shk-machine-card__desc">BANDING AND SHRINKING MACHINE</div>
                    <!-- <a href="#" class="shk-machine-card__link">Se produkt</a> -->
                </div>
            </div>

            <div class="shk-machine-card">
                <div class="shk-machine-card__img" data-type="Automatisk">
                    <?php shk_img('dm782', 'shk-ph--card'); ?>
                </div>
                <div class="shk-machine-card__body">
                    <div class="shk-machine-card__name">STEP DM782-PS</div>
                    <!-- <div class="shk-machine-card__desc">Automatisk shrink packaging maskine. Kan integreres med
                        produktions­linjer for lette emballage­løsninger. Understøtter polyolefin- og PVC-film.</div> -->
                    <!-- <a href="#" class="shk-machine-card__link">Se produkt</a> -->
                </div>
            </div>

            <div class="shk-machine-card">
                <div class="shk-machine-card__img" data-type="Manuel">
                    <?php shk_img('uw1736', 'shk-ph--card'); ?>
                </div>
                <div class="shk-machine-card__body">
                    <div class="shk-machine-card__name">STEP UW-1736 Shrink Torch</div>
                    <!-- <div class="shk-machine-card__desc">Professionel varme­pistol til manuel krympning. Ideel til
                        enkelt­produkter, reparationer og steder hvor en krympetunnel er for stor en løsning.</div>
                    <!-- <a href="#" class="shk-machine-card__link">Se produkt</a> -->
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ═══ PROCESS — HEAT METHODS ══════════════════════════════ -->
<section class="shk-process">
    <div class="shk-wrap">
        <div class="shk-process__grid">
            <div class="shk-process__text">
                <p>We have also, STEP Skinpack Packaging Machines that are available in two (2) models. Both are
                    suitable for packing products of small to medium sizes.</p>
                <p>STEP SKINPACK machine makes a skin pack, where you have a sheet of cardboard. Then you place the
                    products and the machine sucks the air inside film around the product while laminating the said
                    film.</p>
            </div>

            <!-- TUNNEL IMAGE -->
            <div style="display:flex; flex-direction:column; gap:var(--sp-sm);">
                <?php shk_img('', 'shk-ph--wide'); ?>
            </div>

        </div>
    </div>
</section>

<section class="shk-skinpack">
    <div class="shk-wrap">
        <h2 class="shk-h2">Beskyttelse med krympning</h2>

        <div class="shk-skinpack__grid">

            <div class="shk-skinpack__text">
                <p>Krympeformeringsfilm findes i en lang række egenskaber som tykkelse, opacitet, styrker og
                    krympeforhold. Forskellige egenskaber tjener forskellige formål, f.eks. Lys- eller varmefølsomme
                    produkter bruger mørkere film til at beskytte det mod sollys. En tykkere film bruges til tungere
                    produkter, og en tyndere, svagere film bruges til sikkerhedsformål.</p>
                <p>
                    Filmen holder også produkterne sammen, hvilket gør det lettere at transportere. Det giver også
                    produktet et indbydende udseende og en følelse af sikkerhed. Krympepakken forhindrer et produkt i at
                    åbne ved et uheld og angiver manipulation.</p>
            </div>

        </div>
    </div>
</section>

<section class="shk-protection">
    <div class="shk-wrap">
        <h2 class="shk-h2">Endelige tanker</h2>
        <p style="font-size:15px; color:var(--text-mid); line-height:1.7;">Betydningen af ​​at krympe
            indpakningen af ​​et produkt er uden tvivl enorm. Disse ting bliver næppe bemærket af den daglige forbruger.
            De er enkle og overkommelige; det beskytter vores produkters integritet mod de hårde elementer samt
            ondsindede hensigter.</p>
    </div>
</section>

<!-- ═══ AUTHOR ══════════════════════════════════════════════ -->
<section class="shk-author">
    <div class="shk-wrap">
        <div class="shk-label">Forfatter til artiklen</div>
        <div class="shk-author__card">
            <div class="shk-author__accent"></div>
            <div class="shk-author__body">
                <div class="shk-author__meta-row">
                    <div>
                        <div class="shk-author__name">Gunnar Salbæk</div>
                        <div class="shk-author__role">CEO / Industrial Design &nbsp;·&nbsp; 20 års erfaring i fagområdet
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>