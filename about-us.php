<?php
/**
 * Template Name: About Us
 *
 * Custom page template for the Sal-Tech Easy Packaging "About Us" page.

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

    /* ─── Base ─── */
    .sa-page {
        font-family: var(--ff);
        color: var(--st-black);
        background: var(--st-white);
        line-height: 1.7;
        overflow-x: hidden;
        font-size: 16px;
    }

    .sa-page *,
    .sa-page *::before,
    .sa-page *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .sa-page img {
        max-width: 100%;
        display: block;
    }

    .sa-page a {
        color: var(--st-red);
        text-decoration: none;
    }

    .sa-page a:hover {
        color: var(--st-red-h);
    }

    .sa-wrap {
        max-width: var(--st-max);
        margin: 0 auto;
        padding: 0 clamp(1.25rem, 4vw, 2.5rem);
    }

    /* ─── HERO ─── */
    .sa-hero {
        background: var(--st-light);
        color: var(--st-black);
        padding: clamp(2rem, 8vw, 1rem) 0 clamp(1.5rem, 6vw, 2rem);
        border-bottom: 3px solid var(--st-red);
    }

    .sa-hero__eyebrow {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .75rem;
    }

    .sa-hero__title {
        font-size: clamp(28px, 5vw, 48px);
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 1rem;
        color: var(--st-black);
    }

    .sa-hero__title em {
        font-style: normal;
        color: var(--st-red);
    }

    .sa-hero__sub {
        font-size: clamp(15px, 2vw, 17px);
        color: #9CA3AF;
        max-width: 540px;
        font-weight: 400;
    }

    /* ─── CEO SECTION ─── */
    .sa-ceo {
        padding: var(--st-gap) 0;
        background: var(--st-white);
        border-bottom: 1px solid var(--st-border);
    }

    .sa-ceo__grid {
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 3.5rem;
        align-items: start;
    }

    .sa-ceo__img {
        width: 100%;
        aspect-ratio: 3/4;
        border-radius: var(--st-radius);
        object-fit: cover;
        border: 1px solid var(--st-border);
    }

    .sa-ceo__img-ph {
        width: 100%;
        aspect-ratio: 3/4;
        border-radius: var(--st-radius);
        background: var(--st-light);
        border: 2px dashed var(--st-border);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: .75rem;
        color: #9CA3AF;
    }

    .sa-ceo__img-ph svg {
        width: 48px;
        height: 48px;
        opacity: .5;
    }

    .sa-ceo__img-ph span {
        font-size: 13px;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .sa-ceo__label {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: 1rem;
    }

    .sa-ceo__quote {
        font-size: clamp(15px, 1.6vw, 17px);
        color: var(--st-black);
        font-style: italic;
        line-height: 1.8;
        border-left: 3px solid var(--st-red);
        padding-left: 1.25rem;
        margin-bottom: 1.75rem;
    }

    .sa-ceo__quote strong {
        font-style: normal;
        font-weight: 600;
    }

    .sa-ceo__sig {
        padding-top: 1.25rem;
        border-top: 1px solid var(--st-border);
    }

    .sa-ceo__sig-name {
        font-size: 15px;
        font-weight: 700;
        color: var(--st-black);
    }

    .sa-ceo__sig-role {
        font-size: 14px;
        color: var(--st-gray);
    }

    /* ─── COMPANY INFO ─── */
    .sa-info {
        padding: var(--st-gap) 0;
        background: var(--st-light);
    }

    .sa-info__grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3.5rem;
        align-items: start;
    }

    .sa-info__eyebrow {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .6rem;
    }

    .sa-info__heading {
        font-size: clamp(22px, 3vw, 28px);
        font-weight: 700;
        color: var(--st-black);
        margin-bottom: 1.25rem;
        line-height: 1.2;
    }

    .sa-info__body {
        font-size: 16px;
        color: var(--st-gray);
        margin-bottom: 1rem;
    }

    .sa-info__body:last-child {
        margin-bottom: 0;
    }

    .sa-facts {
        background: var(--st-light);
        border: 1px solid var(--st-border);
        border-radius: var(--st-radius);
        overflow: hidden;
    }

    .sa-facts__head {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--st-border);
        font-size: 13px;
        font-weight: 700;
        color: var(--st-black);
        background: var(--st-white);
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    .sa-fact {
        display: flex;
        gap: 1rem;
        padding: .85rem 1.5rem;
        border-bottom: 1px solid var(--st-border);
        align-items: baseline;
    }

    .sa-fact:last-child {
        border-bottom: none;
    }

    .sa-fact__label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--st-gray);
        min-width: 110px;
        flex-shrink: 0;
    }

    .sa-fact__value {
        font-size: 15px;
        color: var(--st-black);
        font-weight: 500;
    }

    .sa-fact__value a {
        color: var(--st-red);
        font-weight: 500;
    }

    .sa-fact__value a:hover {
        color: var(--st-red-h);
    }

    /* ─── SUPPLIER DOCS ─── */
    .sa-docs {
        padding: var(--st-gap) 0;
        background: var(--st-white);
        border-top: 1px solid var(--st-border);
        border-bottom: 1px solid var(--st-border);
    }

    .sa-docs__inner {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: start;
    }

    .sa-docs__eyebrow {
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .6rem;
    }

    .sa-docs__heading {
        font-size: clamp(20px, 2.5vw, 26px);
        font-weight: 700;
        color: var(--st-black);
        margin-bottom: .75rem;
        line-height: 1.2;
    }

    .sa-docs__body {
        font-size: 15px;
        color: var(--st-gray);
    }

    .sa-docs__links {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .sa-doc {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: var(--st-white);
        border: 1px solid var(--st-border);
        border-radius: var(--st-radius);
        padding: 1.1rem 1.25rem;
        text-decoration: none;
        color: var(--st-black);
        transition: border-color .2s, box-shadow .2s;
    }

    .sa-doc:hover {
        border-color: var(--st-red);
        box-shadow: 0 2px 12px rgba(220, 38, 38, .07);
        color: var(--st-black);
    }

    .sa-doc__icon {
        width: 38px;
        height: 38px;
        background: #FEE2E2;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sa-doc__icon svg {
        width: 18px;
        height: 18px;
        stroke: var(--st-red);
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .sa-doc__title {
        font-size: 14px;
        font-weight: 600;
        color: var(--st-black);
    }

    .sa-doc__sub {
        font-size: 13px;
        color: var(--st-gray);
        margin-top: .1rem;
    }

    .sa-doc__arr {
        margin-left: auto;
        flex-shrink: 0;
    }

    .sa-doc__arr svg {
        width: 16px;
        height: 16px;
        stroke: #9CA3AF;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        display: block;
        transition: stroke .2s, transform .2s;
    }

    .sa-doc:hover .sa-doc__arr svg {
        stroke: var(--st-red);
        transform: translateX(3px);
    }

    /* ─── CTA ─── */
    .sa-cta {
        padding: var(--st-gap) 0;
        background: var(--st-white);
        border-top: 3px solid var(--st-red);
        text-align: center;
    }

    .sa-cta__title {
        font-size: clamp(22px, 3vw, 32px);
        font-weight: 700;
        color: var(--st-black);
        margin-bottom: .6rem;
    }

    .sa-cta__sub {
        font-size: 16px;
        color: var(--st-gray);
        margin: 0 auto 2rem;
        max-width: 440px;
    }

    .sa-cta__btns {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Buttons */
    .sa-btn {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-family: var(--ff);
        font-size: 15px;
        font-weight: 600;
        padding: .75rem 1.6rem;
        border-radius: 7px;
        text-decoration: none;
        transition: background .2s, color .2s, border-color .2s, transform .15s;
        cursor: pointer;
        border: 2px solid transparent;
        white-space: nowrap;
        line-height: 1;
    }

    .sa-btn svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
    }

    .sa-btn--primary {
        background: var(--st-red);
        color: var(--st-white) !important;
        border-color: var(--st-red);
    }

    .sa-btn--primary:hover {
        background: var(--st-red-h);
        border-color: var(--st-red-h);
        color: var(--st-white);
        transform: translateY(-1px);
    }

    .sa-btn--outline {
        background: transparent;
        color: var(--st-black);
        border-color: var(--st-border);
    }

    .sa-btn--outline:hover {
        border-color: var(--st-gray);
        color: var(--st-black);
        transform: translateY(-1px);
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 860px) {
        .sa-ceo__grid {
            grid-template-columns: 1fr;
        }

        .sa-ceo__img,
        .sa-ceo__img-ph {
            max-width: 240px;
        }

        .sa-info__grid {
            grid-template-columns: 1fr;
        }

        .sa-docs__inner {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 540px) {
        .sa-pillars__grid {
            grid-template-columns: 1fr 1fr;
        }

        .sa-fact {
            flex-direction: column;
            gap: .2rem;
        }

        .sa-fact__label {
            min-width: unset;
        }
    }

    @media (max-width: 360px) {
        .sa-pillars__grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<main class="sa-page">

    <!-- ══ HERO ══ -->
    <section class="sa-hero">
        <div class="sa-wrap">
            <p class="sa-hero__eyebrow">Om Sal-Tech Easy Packaging</p>
            <h1 class="sa-hero__title">We keep things <em>together</em></h1>
            <p class="sa-hero__sub">Simple, ergonomic and sustainable packaging solutions — designed and built for your
                needs.</p>
        </div>
    </section>

    <!-- ══ CEO QUOTE ══ -->
    <section class="sa-ceo">
        <div class="sa-wrap">
            <div class="sa-ceo__grid">

                <div>
                    <img class="sa-ceo__img"
                        src="https://sal-tech.dk/wp-content/uploads/2025/10/gunnar_salbaek_saltecheasypackaging-e1760975500181.jpg"
                        alt="Gunnar Salbæk, CEO & Owner" />
                </div>

                <div>
                    <p class="sa-ceo__label">A word from our CEO</p>
                    <blockquote class="sa-ceo__quote">
                        "Vi mener, emballageløsninger til vores kunder skal være
                        <strong>enkel, let at bruge, ergonomisk og bæredygtige.</strong>
                        Vi tilbyder en bred vifte af emballage produkter og løsninger, og vi designer og konstruere
                        produktionslinjer specielt tilpasset jeres behov.
                        <br><br>
                        Vores motto er simpelt: <strong>Sal-Tech gør dit liv nemmere</strong> gennem teknik og godt
                        design. Vi holder ting sammen."
                    </blockquote>
                    <div class="sa-ceo__sig">
                        <div class="sa-ceo__sig-name">Gunnar Salbæk</div>
                        <div class="sa-ceo__sig-role">Owner &amp; CEO, Sal-Tech Easy Packaging</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ══ COMPANY INFO ══ -->
    <section class="sa-info">
        <div class="sa-wrap">
            <div class="sa-info__grid">

                <div>
                    <p class="sa-info__eyebrow">Hvem er vi</p>
                    <h2 class="sa-info__heading">Om Sal-Tech Easy Packaging</h2>
                    <p class="sa-info__body">
                        Sal-Tech Easy Packaging tilbyder et bredt udvalg af løsninger til enkel og driftsikker
                        emballering af jeres produkter.
                    </p>
                    <p class="sa-info__body">
                        Uanset om der er behov for standardløsninger eller mere specialiserede løsninger til jeres
                        opgave, bidrager vi med kreativt input og den rette løsning, der sikrer en optimal og sikker
                        emballeringsproces.
                    </p>
                    <p class="sa-info__body">
                        Vi er et team, der både arbejder fra vores kontor i Tinglev og som et virtuelt team, alt efter
                        opgaver og behov. Derfor beder vi om, at al kundekorrespondance sendes til: <a
                            href="mailto:support@sal-tech.com.">support@sal-tech.com.</a>.
                    </p>
                </div>

                <div>
                    <div class="sa-facts">
                        <div class="sa-facts__head">Company Details</div>

                        <div class="sa-fact">
                            <span class="sa-fact__label">Ownership</span>
                            <span class="sa-fact__value">100% owned by Gunnar Salbæk</span>
                        </div>

                        <div class="sa-fact">
                            <span class="sa-fact__label">Legal Name</span>
                            <span class="sa-fact__value">Salbæk Easy Packaging v/Gunnar Bjørn
                                Salbæk</span>
                        </div>

                        <div class="sa-fact">
                            <span class="sa-fact__label">CVR No.</span>
                            <span class="sa-fact__value">DK18429098</span>
                        </div>

                        <div class="sa-fact">
                            <span class="sa-fact__label">Invoices</span>
                            <span class="sa-fact__value"><a
                                    href="mailto:invoice@sal-tech.com">invoice@sal-tech.com</a></span>
                        </div>

                        <div class="sa-fact">
                            <span class="sa-fact__label">Bank</span>
                            <span class="sa-fact__value">Nordea Denmark</span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ══ SUPPLIER DOCS ══ -->
    <section class="sa-docs">
        <div class="sa-wrap">
            <div class="sa-docs__inner">

                <div>
                    <p class="sa-docs__eyebrow">Samarbejd med os</p>
                    <h2 class="sa-docs__heading">Leverandørvilkår & handelsbetingelser</h2>
                    <p class="sa-docs__body">Download vores indkøbsbetingelser for at forstå, hvordan vi arbejder sammen
                        med vores samarbejdspartnere.</p>
                </div>

                <div class="sa-docs__links">

                    <a class="sa-doc"
                        href="https://sal-tech.dk/wp-content/uploads/2026/05/STG-Supplier-Purchasing-Conditions.pdf"
                        target="_blank" rel="noopener noreferrer">
                        <div class="sa-doc__icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                                <line x1="16" y1="13" x2="8" y2="13" />
                                <line x1="16" y1="17" x2="8" y2="17" />
                            </svg>
                        </div>
                        <div>
                            <div class="sa-doc__title">STG Supplier Purchasing Conditions</div>
                            <div class="sa-doc__sub">PDF Document</div>
                        </div>
                        <div class="sa-doc__arr"><svg viewBox="0 0 24 24">
                                <line x1="5" y1="12" x2="19" y2="12" />
                                <polyline points="12 5 19 12 12 19" />
                            </svg></div>
                    </a>

                    <a class="sa-doc"
                        href="https://sal-tech.dk/wp-content/uploads/2026/05/STEP-Purchasing-Conditions-2013-edition.pdf"
                        target="_blank" rel="noopener noreferrer">
                        <div class="sa-doc__icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                                <line x1="16" y1="13" x2="8" y2="13" />
                                <line x1="16" y1="17" x2="8" y2="17" />
                            </svg>
                        </div>
                        <div>
                            <div class="sa-doc__title">STEP Purchasing Conditions 2013</div>
                            <div class="sa-doc__sub">PDF Document</div>
                        </div>
                        <div class="sa-doc__arr"><svg viewBox="0 0 24 24">
                                <line x1="5" y1="12" x2="19" y2="12" />
                                <polyline points="12 5 19 12 12 19" />
                            </svg></div>
                    </a>

                </div>
            </div>
        </div>
    </section>

    <!-- ══ CTA ══ -->
    <section class="sa-cta">
        <div class="sa-wrap">
            <h2 class="sa-cta__title">Kontakt os</h2>
            <p class="sa-cta__sub">Har du et spørgsmål eller ønsker du at besøge os? Vi hører meget gerne fra dig.</p>
            <div class="sa-cta__btns">

                <!-- Update href to your WP contact page slug if different -->
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="sa-btn sa-btn--primary">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                        <polyline points="22,6 12,13 2,6" />
                    </svg>
                    Kontakt os
                </a>

                <!-- Update href to your location/map page if different -->
                <a href="https://location.sal-tech.com/" target="_blank" rel="noopener noreferrer"
                    class="sa-btn sa-btn--outline">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    Sådan finder du os
                </a>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>