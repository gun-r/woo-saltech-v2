<?php
/**
 * Template Name: History
 *
 * Custom page template for the Sal-Tech Easy Packaging "History" page.
 *
 * @package SalTech
 */

get_header(); ?>

<style>
    /* ─── Design System ─── */
    :root {
        --st-black: #111111;
        --st-gray: #4B5563;
        --st-border: #E5E7EB;
        --st-red: #DC2626;
        --st-red-h: #B91C1C;
        --st-white: #FFFFFF;
        --st-light: #F9FAFB;
        --st-radius: 10px;
        --st-max: 1160px;
        --st-gap: clamp(3rem, 6vw, 5.5rem);
        --ff: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
    }

    .sh-page {
        font-family: var(--ff);
        color: var(--st-black);
        background: var(--st-white);
        line-height: 1.7;
        overflow-x: hidden;
        font-size: 16px;
    }

    .sh-page *,
    .sh-page *::before,
    .sh-page *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .sh-page img {
        max-width: 100%;
        display: block;
    }

    .sh-page a {
        color: var(--st-red);
        text-decoration: none;
    }

    .sh-page a:hover {
        color: var(--st-red-h);
    }

    .sh-wrap {
        max-width: var(--st-max);
        margin: 0 auto;
        padding: 0 clamp(1.25rem, 4vw, 2.5rem);
    }

    /* ─── HERO ─── */
    .sh-hero {
        background: var(--st-light);
        color: var(--st-blck);
        padding: clamp(2rem, 8vw, 1rem) 0 clamp(1.5rem, 6vw, 2rem);
        border-bottom: 3px solid var(--st-red);
    }

    .sh-hero__eyebrow {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .75rem;
    }

    .sh-hero__title {
        font-size: clamp(28px, 5vw, 48px);
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 1rem;
        color: var(--st-black);
    }

    .sh-hero__title em {
        font-style: normal;
        color: var(--st-red);
    }

    .sh-hero__sub {
        font-size: clamp(15px, 2vw, 17px);
        color: #9CA3AF;
        max-width: 560px;
        font-weight: 400;
    }

    /* ─── TIMELINE ─── */
    .sh-timeline {
        padding: var(--st-gap) 0;
        background: var(--st-white);
    }

    .sh-timeline__head {
        margin-bottom: 3rem;
    }

    .sh-timeline__eyebrow {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .5rem;
    }

    .sh-timeline__title {
        font-size: clamp(22px, 3vw, 28px);
        font-weight: 700;
        color: var(--st-black);
    }

    .sh-tl {
        position: relative;
        padding-left: 2.5rem;
    }

    /* vertical line */
    .sh-tl::before {
        content: '';
        position: absolute;
        top: 8px;
        left: 9px;
        bottom: 0;
        width: 2px;
        background: var(--st-border);
    }

    .sh-tl-item {
        position: relative;
        padding-bottom: 2.5rem;
        padding-left: 1.5rem;
    }

    .sh-tl-item:last-child {
        padding-bottom: 0;
    }

    /* dot */
    .sh-tl-item::before {
        content: '';
        position: absolute;
        left: -2.5rem;
        top: 6px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: var(--st-red);
        border: 3px solid var(--st-white);
        box-shadow: 0 0 0 2px var(--st-red);
        z-index: 1;
    }

    .sh-tl-item--muted::before {
        background: var(--st-border);
        box-shadow: 0 0 0 2px var(--st-border);
    }

    .sh-tl-year {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .3rem;
    }

    .sh-tl-item--muted .sh-tl-year {
        color: var(--st-gray);
    }

    .sh-tl-heading {
        font-size: 18px;
        font-weight: 700;
        color: var(--st-black);
        margin-bottom: .4rem;
        line-height: 1.25;
    }

    .sh-tl-body {
        font-size: 15px;
        color: var(--st-gray);
        line-height: 1.7;
        max-width: 640px;
    }

    /* ─── HOW WE HELP ─── */
    .sh-help {
        padding: var(--st-gap) 0;
        background: var(--st-light);
        border-top: 1px solid var(--st-border);
        border-bottom: 1px solid var(--st-border);
    }

    .sh-help__inner {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3.5rem;
        align-items: start;
    }

    .sh-help__eyebrow {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .6rem;
    }

    .sh-help__heading {
        font-size: clamp(22px, 3vw, 28px);
        font-weight: 700;
        color: var(--st-black);
        margin-bottom: 1.25rem;
        line-height: 1.2;
    }

    .sh-help__body {
        font-size: 16px;
        color: var(--st-gray);
        margin-bottom: 1.1rem;
    }

    .sh-help__body:last-child {
        margin-bottom: 0;
    }

    /* Goals list */
    .sh-goals {
        background: var(--st-white);
        border: 1px solid var(--st-border);
        border-radius: var(--st-radius);
        overflow: hidden;
    }

    .sh-goals__head {
        padding: 1rem 1.5rem;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: var(--st-black);
        background: var(--st-white);
        border-bottom: 1px solid var(--st-border);
    }

    .sh-goal {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: .9rem 1.5rem;
        border-bottom: 1px solid var(--st-border);
        font-size: 15px;
        color: var(--st-black);
        font-weight: 500;
    }

    .sh-goal:last-child {
        border-bottom: none;
    }

    .sh-goal__check {
        width: 22px;
        height: 22px;
        background: #FEE2E2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sh-goal__check svg {
        width: 12px;
        height: 12px;
        stroke: var(--st-red);
        fill: none;
        stroke-width: 2.5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    /* ─── COVERAGE ─── */
    .sh-coverage {
        padding: var(--st-gap) 0;
        background: var(--st-white);
    }

    .sh-coverage__head {
        margin-bottom: 2.5rem;
    }

    .sh-coverage__eyebrow {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .5rem;
    }

    .sh-coverage__title {
        font-size: clamp(22px, 3vw, 28px);
        font-weight: 700;
        color: var(--st-black);
        margin-bottom: .75rem;
    }

    .sh-coverage__sub {
        font-size: 16px;
        color: var(--st-gray);
        max-width: 600px;
    }

    .sh-regions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        gap: 1rem;
        margin-top: 2rem;
    }

    .sh-region {
        background: var(--st-light);
        border: 1px solid var(--st-border);
        border-radius: var(--st-radius);
        padding: 1.25rem 1rem;
        text-align: center;
        transition: border-color .2s, box-shadow .2s;
    }

    .sh-region:hover {
        border-color: var(--st-red);
        box-shadow: 0 4px 14px rgba(220, 38, 38, .07);
    }

    .sh-region__icon {
        font-size: 1.75rem;
        margin-bottom: .5rem;
        line-height: 1;
    }

    .sh-region__name {
        font-size: 14px;
        font-weight: 600;
        color: var(--st-black);
    }

    /* ─── CTA ─── */
    .sh-cta {
        padding: var(--st-gap) 0;
        background: var(--st-white);
        text-align: center;
        border-top: 3px solid var(--st-red);
    }

    .sh-cta__title {
        font-size: clamp(22px, 3vw, 32px);
        font-weight: 700;
        color: var(--st-black);
        margin-bottom: .6rem;
    }

    .sh-cta__sub {
        font-size: 16px;
        color: #9CA3AF;
        margin: 0 auto 2rem;
        max-width: 440px;
    }

    .sh-cta__btns {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .sh-btn {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-family: var(--ff);
        font-size: 15px;
        font-weight: 600;
        padding: .75rem 1.6rem;
        border-radius: 7px;
        text-decoration: none;
        cursor: pointer;
        border: 2px solid transparent;
        white-space: nowrap;
        line-height: 1;
        transition: background .2s, color .2s, border-color .2s, transform .15s;
    }

    .sh-btn svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
    }

    .sh-btn--primary {
        background: var(--st-red);
        color: var(--st-white) !important;
        border-color: var(--st-red);
    }

    .sh-btn--primary:hover {
        background: var(--st-red-h);
        border-color: var(--st-red-h);
        color: var(--st-white);
        transform: translateY(-1px);
    }

    .sh-btn--ghost {
        background: transparent;
        color: var(--st-black);
        border-color: var(--st-border);
    }

    .sh-btn--ghost:hover {
        border-color: var(--st-gray);
        color: var(--st-black);
        transform: translateY(-1px);
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 860px) {
        .sh-help__inner {
            grid-template-columns: 1fr;
        }

        .sh-stat {
            border-right: none;
            border-bottom: 1px solid var(--st-border);
        }

        .sh-stat:last-child {
            border-bottom: none;
        }
    }

    @media (max-width: 540px) {
        .sh-regions {
            grid-template-columns: repeat(2, 1fr);
        }

        .sh-stats__grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .sh-stat:nth-child(2) {
            border-right: none;
        }
    }
</style>

<main class="sh-page">

    <!-- ══ HERO ══ -->
    <section class="sh-hero">
        <div class="sh-wrap">
            <p class="sh-hero__eyebrow">Our Story</p>
            <h1 class="sh-hero__title">Sal-Tech Easy Packaging's <em>History</em></h1>
            <p class="sh-hero__sub">From a Danish foundation in 1992 to a global packaging partner — over 30 years of
                expertise and more than 2,500 machines in operation.</p>
        </div>
    </section>

    <!-- ══ TIMELINE ══ -->
    <section class="sh-timeline">
        <div class="sh-wrap">
            <div class="sh-timeline__head">
                <p class="sh-timeline__eyebrow">Our Journey</p>
                <h2 class="sh-timeline__title">How It All Started</h2>
            </div>

            <div class="sh-tl">

                <div class="sh-tl-item">
                    <div class="sh-tl-year">1992</div>
                    <h3 class="sh-tl-heading">The Foundation Is Laid</h3>
                    <p class="sh-tl-body">
                        Sal-Tech's grundlag blev skabt i Danmark — establishing the roots and vision that would shape
                        the company for decades to come.
                    </p>
                </div>

                <div class="sh-tl-item">
                    <div class="sh-tl-year">1995</div>
                    <h3 class="sh-tl-heading">Sal-Tech Emballering Established</h3>
                    <p class="sh-tl-body">
                        Sal-Tech Emballering blev etableret og er i dag specialiseret inden for emballeringsmaskiner
                        inden for bundtning, foliering, vikling og positionering af produkter.
                    </p>
                </div>

                <div class="sh-tl-item">
                    <div class="sh-tl-year">Today</div>
                    <h3 class="sh-tl-heading">2,500+ Machines in Operation</h3>
                    <p class="sh-tl-body">
                        Med mere end 2.500 maskiner i drift — hvoraf en del er tilpasset eller opbygget fra bunden af
                        STEP selv — har vi i dag et stort erfaringsgrundlag at tilbyde vores kunder.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ══ HOW WE HELP ══ -->
    <section class="sh-help">
        <div class="sh-wrap">
            <div class="sh-help__inner">

                <div>
                    <p class="sh-help__eyebrow">Sådan kan vi hjælpe</p>
                    <h2 class="sh-help__heading">How We Can Help You</h2>
                    <p class="sh-help__body">
                        Søg på vores webshop, bestil det som I har brug for, kig på brochure eller video — eller træk
                        den ønskede brochure fra vores store download-menu.
                    </p>
                    <p class="sh-help__body">
                        Ring til os, hvis I har brug for at vi kigger forbi og ser jeres konkrete ønsker og
                        produktionsbehov.
                    </p>
                    <p class="sh-help__body">
                        Har I brug for service, større driftssikkerhed eller kostoptimering af emballeringsprocessen —
                        vi giver jer det input, der gør I kommer videre.
                    </p>
                </div>

                <div>
                    <div class="sh-goals">
                        <div class="sh-goals__head">Vi har klare mål</div>

                        <div class="sh-goal">
                            <div class="sh-goal__check">
                                <svg viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </div>
                            Kundens rådgiver
                        </div>
                        <div class="sh-goal">
                            <div class="sh-goal__check">
                                <svg viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </div>
                            Projektorienteret
                        </div>
                        <div class="sh-goal">
                            <div class="sh-goal__check">
                                <svg viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </div>
                            Jeres Emballeringsteam
                        </div>
                        <div class="sh-goal">
                            <div class="sh-goal__check">
                                <svg viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </div>
                            Priser bedre end 95% marginal
                        </div>
                        <div class="sh-goal">
                            <div class="sh-goal__check">
                                <svg viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </div>
                            På duberne — altid klar til jer
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ══ GLOBAL COVERAGE ══ -->
    <section class="sh-coverage">
        <div class="sh-wrap">
            <div class="sh-coverage__head">
                <p class="sh-coverage__eyebrow">Global Reach</p>
                <h2 class="sh-coverage__title">Vi dækker hele verden</h2>
                <p class="sh-coverage__sub">
                    Sal-Tech Easy Packaging er et dansk ejet selskab, der leverer løsninger i hele Skandinavien, Europa,
                    Nord- og Sydamerika, Asien, Afrika og Australien.
                </p>
            </div>

            <div class="sh-regions">
                <div class="sh-region">
                    <div class="sh-region__icon">🇩🇰</div>
                    <div class="sh-region__name">Skandinavien</div>
                </div>
                <div class="sh-region">
                    <div class="sh-region__icon">🌍</div>
                    <div class="sh-region__name">Europa</div>
                </div>
                <div class="sh-region">
                    <div class="sh-region__icon">🌎</div>
                    <div class="sh-region__name">Nord &amp; Sydamerika</div>
                </div>
                <div class="sh-region">
                    <div class="sh-region__icon">🌏</div>
                    <div class="sh-region__name">Asien</div>
                </div>
                <div class="sh-region">
                    <div class="sh-region__icon">🌍</div>
                    <div class="sh-region__name">Afrika</div>
                </div>
                <div class="sh-region">
                    <div class="sh-region__icon">🦘</div>
                    <div class="sh-region__name">Australien</div>
                </div>
            </div>

        </div>
    </section>

    <!-- ══ CTA ══ -->
    <section class="sh-cta">
        <div class="sh-wrap">
            <!-- <h2 class="sh-cta__title">Ready to work with us?</h2>
            <p class="sh-cta__sub">Let us help you find the right packaging solution for your needs.</p> -->
            <h2 class="sh-cta__title">Klar til at samarbejde med os?</h2>
            <p class="sh-cta__sub">Lad os hjælpe dig med at finde den rigtige emballeringsløsning til dine behov.</p>
            <div class="sh-cta__btns">

                <!-- Update href to your WP contact page slug if different -->
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="sh-btn sh-btn--primary">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                    <!-- Contact Us -->
                    Kontakt os
                </a>

                <!-- Link to shop / products page -->
                <a href="<?php echo esc_url(home_url('/shop')); ?>" class="sh-btn sh-btn--ghost">
                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="21" r="1" />
                        <circle cx="20" cy="21" r="1" />
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                    </svg>
                    <!-- Browse Our Shop -->
                    Udforsk vores webshop
                </a>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>