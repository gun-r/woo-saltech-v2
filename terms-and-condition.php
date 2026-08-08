<?php
/**
 * Template Name: Terms & Conditions
 *
 * Custom page template for the Sal-Tech "Terms and Conditions" page.
 *
 * @package SalTech
 */

get_header(); ?>

<style>
    :root {
        --st-black: #111111;
        --st-gray: #4B5563;
        --st-border: #E5E7EB;
        --st-red: #DC2626;
        --st-red-h: #B91C1C;
        --st-white: #FFFFFF;
        --st-light: #F9FAFB;
        --st-radius: 8px;
        --st-max: 960px;
        --st-gap: clamp(2.5rem, 5vw, 4.5rem);
        --ff: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
    }

    .sc-page {
        font-family: var(--ff);
        color: var(--st-black);
        background: var(--st-white);
        line-height: 1.7;
        overflow-x: hidden;
        font-size: 16px;
    }

    .sc-page *,
    .sc-page *::before,
    .sc-page *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .sc-page a {
        color: var(--st-red);
        text-decoration: none;
    }

    .sc-page a:hover {
        color: var(--st-red-h);
        text-decoration: underline;
    }

    .sc-wrap {
        max-width: var(--st-max);
        margin: 0 auto;
        padding: 0 clamp(1.25rem, 4vw, 2.5rem);
    }

    /* HERO */
    .sc-hero {
        background: var(--st-light);
        color: var(--st-black);
        padding: clamp(2rem, 5vw, 3rem) 0;
        border-bottom: 3px solid var(--st-red);
    }

    .sc-hero__eyebrow {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .65rem;
    }

    .sc-hero__title {
        font-size: clamp(22px, 4vw, 34px);
        font-weight: 700;
        line-height: 1.15;
        color: var(--st-black);
        margin-bottom: .75rem;
    }

    .sc-hero__meta {
        font-size: 13px;
        color: var(--st-gray);
        display: flex;
        flex-wrap: wrap;
        gap: .4rem 1.5rem;
    }

    .sc-hero__meta strong {
        color: var(--st-black);
    }

    /* ENTITIES */
    .sc-entities {
        background: var(--st-white);
        border-bottom: 1px solid var(--st-border);
        padding: 2rem 0;
    }

    .sc-entities__head {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: var(--st-gray);
        margin-bottom: 1rem;
    }

    .sc-entities__grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: .75rem;
    }

    .sc-entity {
        background: var(--st-white);
        border: 1px solid var(--st-border);
        border-radius: var(--st-radius);
        padding: .85rem 1.1rem;
    }

    .sc-entity__flag {
        font-size: 11px;
        font-weight: 700;
        color: var(--st-red);
        letter-spacing: .08em;
        margin-bottom: .25rem;
    }

    .sc-entity__name {
        font-size: 13px;
        font-weight: 600;
        color: var(--st-black);
        margin-bottom: .15rem;
    }

    .sc-entity__detail {
        font-size: 12px;
        color: var(--st-gray);
    }

    /* B2B NOTICE */
    .sc-b2b {
        background: var(--st-light);
        color: var(--st-black);
        padding: clamp(1.75rem, 4vw, 2.5rem) 0;
        border-bottom: 3px solid var(--st-red);
    }

    .sc-b2b__title {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .65rem;
    }

    .sc-b2b__text {
        font-size: 14px;
        line-height: 1.75;
        color: var(--st-black);
        max-width: 780px;
    }

    /* ACK BANNER */
    .sc-ack {
        background: #FEF2F2;
        border-bottom: 1px solid #FECACA;
        padding: 1.25rem 0;
    }

    .sc-ack__inner {
        display: flex;
        align-items: baseline;
        gap: .75rem;
        font-size: 13px;
        color: #7F1D1D;
        line-height: 1.6;
    }

    .sc-ack__icon {
        font-size: 16px;
        flex-shrink: 0;
    }

    /* TOC */
    .sc-toc {
        padding: 2rem 0;
        background: var(--st-light);
        border-bottom: 1px solid var(--st-border);
    }

    .sc-toc__head {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: var(--st-gray);
        margin-bottom: 1rem;
    }

    .sc-toc__list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
        gap: .3rem .75rem;
        list-style: none;
    }

    .sc-toc__list li a {
        font-size: 13px;
        color: var(--st-gray);
        display: flex;
        align-items: baseline;
        gap: .45rem;
        padding: .22rem 0;
        transition: color .15s;
        text-decoration: none;
    }

    .sc-toc__list li a:hover {
        color: var(--st-red);
    }

    .sc-toc__list li a span {
        font-size: 11px;
        font-weight: 700;
        color: var(--st-red);
        flex-shrink: 0;
        min-width: 22px;
    }

    /* DOCUMENT BODY */
    .sc-content {
        padding: var(--st-gap) 0 clamp(4rem, 8vw, 7rem);
        background: var(--st-white);
    }

    .sc-section {
        padding-bottom: 2.75rem;
        margin-bottom: 2.75rem;
        border-bottom: 1px solid var(--st-border);
        scroll-margin-top: 1.5rem;
    }

    .sc-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .sc-section__header {
        display: flex;
        align-items: baseline;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }

    .sc-section__num {
        font-size: 12px;
        font-weight: 700;
        color: var(--st-red);
        letter-spacing: .1em;
        text-transform: uppercase;
        min-width: 36px;
        flex-shrink: 0;
    }

    .sc-section__title {
        font-size: 18px;
        font-weight: 700;
        color: var(--st-black);
        line-height: 1.2;
    }

    /* ── CLAUSES ── */
    .sc-clauses {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: .9rem;
    }

    .sc-clause {
        display: flex;
        gap: .75rem;
        align-items: baseline;
        font-size: 15px;
        color: var(--st-gray);
        line-height: 1.78;
    }

    .sc-clause__id {
        font-size: 13px;
        font-weight: 700;
        color: var(--st-black);
        flex-shrink: 0;
        min-width: 28px;
    }

    /* ── SUB-CLAUSES ── */
    .sc-subclauses {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: .7rem;
        margin-top: .85rem;
        padding-left: 1rem;
        border-left: 2px solid var(--st-border);
    }

    .sc-subclause {
        display: flex;
        gap: .75rem;
        align-items: baseline;
        font-size: 14px;
        color: var(--st-gray);
        line-height: 1.72;
    }

    .sc-subclause__id {
        font-size: 12px;
        font-weight: 700;
        color: var(--st-gray);
        flex-shrink: 0;
        min-width: 28px;
    }

    /* ── BULLETS ── */
    .sc-bullets {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: .55rem;
        margin-top: .65rem;
        padding-left: 1rem;
        border-left: 2px solid var(--st-border);
    }

    .sc-bullets li {
        display: flex;
        gap: .65rem;
        align-items: baseline;
        font-size: 14px;
        color: var(--st-gray);
        line-height: 1.68;
    }

    .sc-bullets li::before {
        content: '•';
        color: var(--st-red);
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }

    /* Info box */
    .sc-infobox {
        background: #FEF2F2;
        border: 1px solid #FECACA;
        border-left: 3px solid var(--st-red);
        border-radius: var(--st-radius);
        padding: 1rem 1.25rem;
        font-size: 14px;
        color: #7F1D1D;
        margin-top: 1rem;
        line-height: 1.65;
    }

    /* Contact cards */
    .sc-contacts {
        display: flex;
        flex-direction: column;
        gap: .65rem;
        margin-top: .85rem;
    }

    .sc-contact {
        display: flex;
        align-items: center;
        gap: .85rem;
        background: var(--st-light);
        border: 1px solid var(--st-border);
        border-radius: var(--st-radius);
        padding: .85rem 1.1rem;
    }

    .sc-contact__label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--st-gray);
        min-width: 100px;
        flex-shrink: 0;
    }

    .sc-contact__value {
        font-size: 14px;
        color: var(--st-black);
        font-weight: 500;
    }

    .sc-contact__value a {
        color: var(--st-red);
    }

    .sc-contact__value a:hover {
        color: var(--st-red-h);
    }

    /* Badges */
    .sc-badges {
        display: flex;
        flex-wrap: wrap;
        gap: .6rem;
        margin-top: .85rem;
    }

    .sc-badge {
        background: var(--st-light);
        border: 1px solid var(--st-border);
        border-radius: 6px;
        padding: .35rem .85rem;
        font-size: 13px;
        font-weight: 600;
        color: var(--st-black);
    }

    /* Closing */
    .sc-closing {
        background: var(--st-black);
        color: var(--st-white);
        border-radius: var(--st-radius);
        padding: 1.5rem 1.75rem;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.7;
        letter-spacing: .01em;
        text-transform: uppercase;
        text-align: center;
        margin-top: 2rem;
        border-left: 4px solid var(--st-red);
    }

    /* Footer */
    .sc-footnote {
        background: var(--st-white);
        border-top: 1px solid var(--st-border);
        padding: 2rem 0;
        text-align: center;
    }

    .sc-footnote p {
        font-size: 13px;
        color: var(--st-gray);
        max-width: 640px;
        margin: 0 auto .4rem;
    }

    .sc-footnote strong {
        color: var(--st-black);
    }

    /* Responsive */
    @media (max-width: 600px) {
        .sc-clause {
            font-size: 14px;
        }

        .sc-subclause {
            font-size: 13px;
        }

        .sc-section__title {
            font-size: 16px;
        }

        .sc-hero__meta {
            flex-direction: column;
            gap: .3rem;
        }

        .sc-contact {
            flex-direction: column;
            align-items: flex-start;
            gap: .3rem;
        }

        .sc-contact__label {
            min-width: unset;
        }
    }
</style>

<main class="sc-page">

    <!-- HERO -->
    <section class="sc-hero">
        <div class="sc-wrap">
            <p class="sc-hero__eyebrow">Legal Document — Supplier Agreement</p>
            <h1 class="sc-hero__title">Salbæk Technology Group<br>Terms and Conditions</h1>
            <div class="sc-hero__meta">
                <span><strong>Edition:</strong> September 2024</span>
                <span><strong>Reference:</strong> PME.07.02.2024.1.E</span>
                <span><strong>Language:</strong> English</span>
            </div>
        </div>
    </section>

    <!-- ENTITIES -->
    <div class="sc-entities">
        <div class="sc-wrap">
            <p class="sc-entities__head">Salbæk Technology Group — Covered Entities</p>
            <div class="sc-entities__grid">
                <div class="sc-entity">
                    <div class="sc-entity__flag">DK — Holding</div>
                    <div class="sc-entity__name">Salbæk Technology Holding ApS</div>
                    <div class="sc-entity__detail">CVR No. DK 44200384</div>
                </div>
                <div class="sc-entity">
                    <div class="sc-entity__flag">DK — Trading</div>
                    <div class="sc-entity__name">Sal-Tech Easy Packaging v/G. Salbæk</div>
                    <div class="sc-entity__detail">CVR No. DK 18429098</div>
                </div>
                <div class="sc-entity">
                    <div class="sc-entity__flag">DK — ApS</div>
                    <div class="sc-entity__name">Sal-Tech Easy Packaging DK ApS</div>
                    <div class="sc-entity__detail">CVR No. DK 44203642</div>
                </div>
                <div class="sc-entity">
                    <div class="sc-entity__flag">HK</div>
                    <div class="sc-entity__name">Sal-Tech HKG Limited</div>
                    <div class="sc-entity__detail">Registration No. HK 1553382</div>
                </div>
                <div class="sc-entity">
                    <div class="sc-entity__flag">ES</div>
                    <div class="sc-entity__name">Sal-Tech Embalaje SL</div>
                    <div class="sc-entity__detail">CIF No. B01970045</div>
                </div>
                <div class="sc-entity">
                    <div class="sc-entity__flag">USA</div>
                    <div class="sc-entity__name">Sal-Tech Easy Packaging LLC</div>
                    <div class="sc-entity__detail">Reg. no. 35-2776554</div>
                </div>
            </div>
        </div>
    </div>

    <!-- B2B NOTICE -->
    <section class="sc-b2b">
        <div class="sc-wrap">
            <p class="sc-b2b__title">
                Business Customers Only
                <!-- Kun for erhvervskunder -->
            </p>
            <p class="sc-b2b__text">Sal-Tech operates exclusively on a business-to-business (B2B) basis. All goods and
                services are supplied solely to suppliers, dealers and other business entities acting in the course of
                their trade, business or profession, and not to consumers. Accordingly, statutory consumer protection
                law — including, without limitation, consumer withdrawal and cancellation rights, consumer guarantee
                provisions and other consumer-specific legislation — does not apply to this Agreement or to any
                Purchase Order placed under it. By entering into a Purchase Order with Sal-Tech, the Supplier confirms
                that it is acting exclusively in a business capacity and not as a consumer.</p>
        </div>
    </section>

    <!-- ACK BANNER -->
    <div class="sc-ack">
        <div class="sc-wrap">
            <div class="sc-ack__inner">
                <span class="sc-ack__icon">⚖</span>
                <span>Supplier warrants that all products ordered by Sal-Tech comply with the purchasing conditions
                    stated herein. Placement of a Purchase Order constitutes full acceptance of these Terms and
                    Conditions by force of law.</span>
            </div>
        </div>
    </div>

    <!-- TOC -->
    <nav class="sc-toc" aria-label="Table of Contents">
        <div class="sc-wrap">
            <p class="sc-toc__head">Contents</p>
            <ul class="sc-toc__list">
                <li><a href="#sc-s1"><span>1.</span> General</a></li>
                <li><a href="#sc-s2"><span>2.</span> Cancellation Policy</a></li>
                <li><a href="#sc-s3"><span>3.</span> Product Specification</a></li>
                <li><a href="#sc-s4"><span>4.</span> Documentation Requirements</a></li>
                <li><a href="#sc-s5"><span>5.</span> Guarantee</a></li>
                <li><a href="#sc-s6"><span>6.</span> Price Lists</a></li>
                <li><a href="#sc-s7"><span>7.</span> Specifications, Drawings &amp; Tools</a></li>
                <li><a href="#sc-s8"><span>8.</span> Delivery and Acceptance</a></li>
                <li><a href="#sc-s9"><span>9.</span> Payment</a></li>
                <li><a href="#sc-s10"><span>10.</span> Time</a></li>
                <li><a href="#sc-s11"><span>11.</span> Product Liability</a></li>
                <li><a href="#sc-s12"><span>12.</span> Warranty and Defects</a></li>
                <li><a href="#sc-s13"><span>13.</span> Health, Safety &amp; Environment</a></li>
                <li><a href="#sc-s14"><span>14.</span> Termination</a></li>
                <li><a href="#sc-s15"><span>15.</span> Waiver</a></li>
                <li><a href="#sc-s16"><span>16.</span> Procedures &amp; Confidentiality</a></li>
                <li><a href="#sc-s17"><span>17.</span> Severability</a></li>
            </ul>
        </div>
    </nav>

    <!-- DOCUMENT BODY -->
    <div class="sc-content">
        <div class="sc-wrap">

            <section class="sc-section" id="sc-s1">
                <div class="sc-section__header"><span class="sc-section__num">§ 1</span>
                    <h2 class="sc-section__title">General</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>The company name "Sal-Tech" ("we",
                            "us") used in this Agreement covers all companies, subsidiaries or branches within Salbæk
                            Technology Group as listed above. Supplier ("You") warrants that the products ordered by
                            Sal-Tech comply with the purchasing conditions stated herein ("Agreement" or
                            "Conditions").</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s2">
                <div class="sc-section__header"><span class="sc-section__num">§ 2</span>
                    <h2 class="sc-section__title">Cancellation Policy</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>We reserve the right to cancel any
                            order before the supply has taken place.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">b)</span><span>Where wrong goods are delivered to
                            Sal-Tech contrary to what has been ordered, Sal-Tech reserves the right to reject the item
                            in whole, where the supplier agrees to deliver the correct goods to Sal-Tech at their own
                            monetary expense.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s3">
                <div class="sc-section__header"><span class="sc-section__num">§ 3</span>
                    <h2 class="sc-section__title">Product Specification</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span><strong>Marking:</strong> All items
                            must be marked with: Item number; Specification of product; Quantity; Serial number of
                            machines/tools and alike.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">b)</span><span><strong>Packaging:</strong> All
                            goods delivered must be securely packaged and labelled specifying the correct and accurate
                            details of what is being delivered to Sal-Tech. Supplier warrants that all products,
                            including packaging and their components, will be accurately labelled in accordance with
                            applicable laws and regulations, including but not limited to the EU Packaging Directive (EU
                            94/62/EC).</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">c)</span><span>All documents enclosed with packed
                            goods must include the following: JC No. from Sal-Tech (if missing in order email, supplier
                            must contact the relevant person to request this number) and Purchase Order No.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s4">
                <div class="sc-section__header"><span class="sc-section__num">§ 4</span>
                    <h2 class="sc-section__title">Documentation Requirements <span
                            style="font-weight:400;font-size:15px;color:var(--st-gray);">(Machines, tools and
                            equipment)</span></h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>Supplier is obligated to provide
                            the following before shipping to Sal-Tech:</span></li>
                </ul>
                <ul class="sc-subclauses">
                    <li class="sc-subclause"><span class="sc-subclause__id">i.</span><span>Preliminary electronic
                            documentation (manuals, spare parts list, quotation, layout etc.) communicated by email,
                            stating the correct product specification within 14 days of the order being placed but
                            before shipment. This specification must include the HS code of each item line when
                            exporting/importing.</span></li>
                    <li class="sc-subclause"><span class="sc-subclause__id">ii.</span><span>Mechanical drawing readable
                            by AutoCAD 2021 in the relevant file format for layout purposes, presenting the machine in
                            minimum front, side and top views.</span></li>
                    <li class="sc-subclause"><span class="sc-subclause__id">iii.</span><span>Technical service
                            documentation including, but not limited to: test instructions; test points; expected
                            measurements for key voltage points; repair advice for PCBs; electrical system
                            specifications; service advice relevant to the life-span of the equipment.</span></li>
                    <li class="sc-subclause"><span class="sc-subclause__id">iv.</span><span>For customised goods based
                            on Sal-Tech requirements by OEM/s, the following must be submitted and approved by Sal-Tech
                            before dispatch: (1a) a test report showing actual produced goods are aligned with the
                            agreed specifications; (2a) a video reference clearly showing the customised machine, tools
                            or equipment in motion completing at least 1 full cycle.</span></li>
                    <li class="sc-subclause"><span class="sc-subclause__id">v.</span><span>Images of goods as produced
                            and as packed ready for delivery must be submitted and approved by Sal-Tech before the
                            forwarder collects at the Supplier's specified address.</span></li>
                    <li class="sc-subclause"><span class="sc-subclause__id">vi.</span><span>With every machine type
                            there must be four full sets of documentation in manual form: one to follow the machine for
                            the end user, and three within each machine type designated for Sal-Tech's records. The
                            latter must be packaged separately and easy to locate, or clearly stated on the packaging
                            list and marked on the casing. All machine-related documents must be in English; otherwise
                            written translations must be provided.</span></li>
                    <li class="sc-subclause"><span class="sc-subclause__id">vii.</span><span>General sales materials
                            (pictures, brochures, catalogues, videos). Product pictures must be front angle view, file
                            format TIFF / JPG / BMP, minimum 300 DPI, white or neutral professional background, without
                            tags or text. Video: minimum one full cycle in mp4 / wmv / 3gp format, within 14 days of
                            order placement but before shipment.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s5">
                <div class="sc-section__header"><span class="sc-section__num">§ 5</span>
                    <h2 class="sc-section__title">Guarantee <span
                            style="font-weight:400;font-size:15px;color:var(--st-gray);">(Machines, tools and
                            equipment)</span></h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>Supplier has a <strong>10-year
                                obligation</strong> to provide spare parts for machines purchased by us. Annual price
                            increases on spare parts are only acceptable if correlated with the Danish Net Price Index
                            (strongly related to the HCIP EU). Higher increases indicate unfair trade and are not
                            acceptable; prior prices apply until any disagreement is resolved.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">b)</span><span>Supplier has a <strong>2-year prior
                                notice obligation</strong> towards Sal-Tech in the event of machine
                            discontinuance.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s6">
                <div class="sc-section__header"><span class="sc-section__num">§ 6</span>
                    <h2 class="sc-section__title">Price Lists</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span><strong>Machines, tools, components
                                and equipment:</strong> Must be incorporated in an Excel sheet stating the valid period.
                            Upon termination of the valid period, a new price list must be forwarded automatically with
                            a new valid period stated.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">b)</span><span><strong>Spare parts:</strong> Must
                            be incorporated in an Excel sheet stating the valid period. Upon termination, a new price
                            list must be forwarded automatically. Each product's spare parts price list must contain:
                            Item number; Parts name; Manual page/position number; Price in the specified currency;
                            Discount conditions/levels.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s7">
                <div class="sc-section__header"><span class="sc-section__num">§ 7</span>
                    <h2 class="sc-section__title">Specifications, Drawings and Tools</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>Any specifications, drawings and
                            tools funded by Sal-Tech to aid Supplier in producing customised goods must be handled as
                            follows:</span></li>
                </ul>
                <ul class="sc-subclauses">
                    <li class="sc-subclause"><span class="sc-subclause__id">i.</span><span><strong>Documents and
                                specifications:</strong> Must be treated as highly classified and properly filed for the
                            next production cycle.</span></li>
                    <li class="sc-subclause"><span class="sc-subclause__id">ii.</span><span><strong>Drawings:</strong>
                            Must be treated as highly classified and properly filed for the next production cycle.
                            Sal-Tech must be informed at least 1 month beforehand of any changes in production
                            requirements, including changes in file formats needed for production.</span></li>
                    <li class="sc-subclause"><span class="sc-subclause__id">iii.</span><span><strong>Tools:</strong>
                            Must remain at Supplier's production address, kept and maintained in good condition for next
                            use.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s8">
                <div class="sc-section__header"><span class="sc-section__num">§ 8</span>
                    <h2 class="sc-section__title">Delivery and Acceptance</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>Goods shall be delivered in
                            accordance with the Incoterm noted in the Purchase Order — as EXW, CIF, FOB, DAP or others
                            based on Incoterms 2020.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">b)</span><span>To ensure efficient handling of
                            logistics-related transactions, including customs clearances and any logistic concerns, all
                            such communications must be directed to <a
                                href="mailto:logistics@sal-tech.com">logistics@sal-tech.com</a>.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">c)</span><span>The supplier accepts strict
                            liability to supply the goods to the destination specified in the order placed by
                            Sal-Tech.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">d)</span><span>The supplier is obliged to promptly
                            inform Sal-Tech of where the equipment is kept when payment is met.</span></li>
                    <li class="sc-clause">
                        <span class="sc-clause__id">e)</span>
                        <span>The title to the goods remains vested in the supplier until two conditions have been met:
                            <ul class="sc-bullets">
                                <li>Payment of the purchase price.</li>
                                <li>Receipt of delivery is communicated by Sal-Tech to the supplier.</li>
                            </ul>
                        </span>
                    </li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s9">
                <div class="sc-section__header"><span class="sc-section__num">§ 9</span>
                    <h2 class="sc-section__title">Payment</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>Sal-Tech commits to pay the full
                            purchase price, including any costs in connection with a follow-up delivery and ancillary
                            costs, within the terms set in the contract with the supplier.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">b)</span><span>Minimum payment term is set to
                            <strong>30 days</strong> following the date on which the goods are delivered, or as stated
                            in the written Purchase Order.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">c)</span><span>Sal-Tech will make payment to the
                            bank account stated in the invoice communicated by the supplier. All invoices and
                            correspondence must specify Sal-Tech's JC No. and Purchase Order reference number. No orders
                            are valid without the agreed order sum confirmed in writing.</span></li>
                </ul>
                <div class="sc-contacts">
                    <div class="sc-contact"><span class="sc-contact__label">Invoices</span><span
                            class="sc-contact__value">Submit in PDF format to <a
                                href="mailto:invoice@sal-tech.com">invoice@sal-tech.com</a></span></div>
                    <div class="sc-contact"><span class="sc-contact__label">Statements</span><span
                            class="sc-contact__value">Submit in PDF format to <a
                                href="mailto:accounts@sal-tech.com">accounts@sal-tech.com</a></span></div>
                    <div class="sc-contact"><span class="sc-contact__label">Logistics</span><span
                            class="sc-contact__value">All customs &amp; logistics queries to <a
                                href="mailto:logistics@sal-tech.com">logistics@sal-tech.com</a></span></div>
                </div>
                <ul class="sc-clauses" style="margin-top:1.25rem;">
                    <li class="sc-clause"><span class="sc-clause__id">d)</span><span>If Sal-Tech defaults in payment,
                            the supplier may not charge an interest rate higher than <strong>7% per
                                annum</strong>.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s10">
                <div class="sc-section__header"><span class="sc-section__num">§ 10</span>
                    <h2 class="sc-section__title">Time</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>Time is of the essence with regard
                            to any agreement entered into with the supplier.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">b)</span><span>All orders sent by Sal-Tech must be
                            confirmed by the supplier in writing and must include a delivery time, particularly where
                            goods are not readily in stock. Any changes or delays beyond the supplier's control must be
                            discussed with Sal-Tech as soon as possible.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">c)</span><span>Where it is proven to be the fault
                            of the supplier that goods are delivered late, Sal-Tech reserves the right to reject those
                            goods.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s11">
                <div class="sc-section__header"><span class="sc-section__num">§ 11</span>
                    <h2 class="sc-section__title">Product Liability</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>Supplier is responsible for the
                            quality of the goods. Sal-Tech reserves the right to have the item exchanged if it consists
                            of any defects.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">b)</span><span>Products must match their
                            specification and the standard deemed necessary for Sal-Tech to carry out its
                            business.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">c)</span><span>Supplier is liable to remedy any
                            faults or defects in the goods as soon as a complaint is filed by Sal-Tech.</span></li>
                    <li class="sc-clause">
                        <span class="sc-clause__id">d)</span>
                        <span>Supplier represents and warrants to Sal-Tech that:
                            <ul class="sc-subclauses">
                                <li class="sc-subclause"><span class="sc-subclause__id">i.</span><span>Supplier will
                                        deliver to Sal-Tech good, exclusive and marketable title to Products, free and
                                        clear of all liens, security interests, claims and other encumbrances.</span>
                                </li>
                                <li class="sc-subclause"><span class="sc-subclause__id">ii.</span><span>All Products
                                        shall conform to the specifications, drawings, samples and/or other descriptions
                                        furnished or approved by Buyer, shall be fit and sufficient for the purpose
                                        intended, merchantable and free from defects in design, materials and
                                        workmanship.</span></li>
                                <li class="sc-subclause"><span class="sc-subclause__id">iii.</span><span>Supplier will
                                        comply with all applicable federal, state, local or foreign laws, rules,
                                        regulations, orders or other directives in the manufacture, sale and delivery of
                                        Products. These warranties shall survive inspection, test, acceptance and
                                        payment. Sal-Tech shall have the right to assign Supplier's warranties to
                                        Sal-Tech's customers.</span></li>
                            </ul>
                        </span>
                    </li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s12">
                <div class="sc-section__header"><span class="sc-section__num">§ 12</span>
                    <h2 class="sc-section__title">Warranty and Defects</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>In the event that goods are
                            rejected by Sal-Tech's customer, Supplier's <strong>24-month guarantee</strong> becomes
                            effective in favour of the customer, promising to repair or replace the goods.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">b)</span><span>The 24-month warranty takes effect
                            from the date the product is delivered to the address specified by Sal-Tech in the order
                            placed.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">c)</span><span>Where a faulty good not
                            corresponding to what was ordered is delivered to Sal-Tech's customer, the supplier is
                            liable to cover all costs for replacing and collecting the goods from the specified
                            address.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">d)</span><span>Where a product is returned due to
                            Sal-Tech's own decision, the costs for return will be borne by Sal-Tech.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s13">
                <div class="sc-section__header"><span class="sc-section__num">§ 13</span>
                    <h2 class="sc-section__title">Product Conformity with Health, Safety and Environmental Protection
                        Legislation</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause">
                        <span class="sc-clause__id">a)</span>
                        <span>Products sold to Sal-Tech must conform with:
                            <ul class="sc-subclauses">
                                <li class="sc-subclause"><span class="sc-subclause__id">i.</span><span>CE
                                        regulations</span></li>
                                <li class="sc-subclause"><span class="sc-subclause__id">ii.</span><span>RoHS</span></li>
                                <li class="sc-subclause"><span class="sc-subclause__id">iii.</span><span>UN
                                        charters</span></li>
                                <li class="sc-subclause"><span class="sc-subclause__id">iv.</span><span>National law of
                                        the country to which the products are shipped for use</span></li>
                                <li class="sc-subclause"><span class="sc-subclause__id">v.</span><span>National law
                                        within the territory where the product is produced, with regard to production
                                        methods</span></li>
                            </ul>
                        </span>
                    </li>
                    <li class="sc-clause"><span class="sc-clause__id">b)</span><span>At Sal-Tech's request, supplier
                            will certify compliance with any directive or specific law related to RoHS, WEEE, REACH or
                            other environmental requirements, including the following instruments:</span></li>
                </ul>
                <div class="sc-badges">
                    <span class="sc-badge">EU Packaging Directive 94/62/EC</span>
                    <span class="sc-badge">Timber Regulation (EU) 995/2010</span>
                    <span class="sc-badge">Stockholm Convention 2004</span>
                    <span class="sc-badge">Montreal Protocol 1987</span>
                    <span class="sc-badge">Basel Convention 1992</span>
                    <span class="sc-badge">RoHS Directive 2011/65/EU</span>
                    <span class="sc-badge">WEEE Directive 2012/19/EU</span>
                    <span class="sc-badge">REACH Directive EC/1907/2006A</span>
                    <span class="sc-badge">Batteries Directive 2013/56/EU</span>
                </div>
                <ul class="sc-clauses" style="margin-top:1.25rem;">
                    <li class="sc-clause"><span class="sc-clause__id">c)</span><span>Supplier is fully aware of its
                            obligations under these Directives, including: not violating substance bans under RoHS;
                            demonstrating compliance with Module A of Decision 768/2008/EC; keeping Technical
                            Documentation for 10 years after last sale to Sal-Tech; affixing CE marking where
                            applicable; providing EU Declarations of Conformity; and providing Sal-Tech with information
                            about preparation for re-use and treatment upon request, free of charge.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s14">
                <div class="sc-section__header"><span class="sc-section__num">§ 14</span>
                    <h2 class="sc-section__title">Termination</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>At any time and with or without
                            cause, Sal-Tech shall have the right to terminate all or a portion of the purchase order by
                            written notice.</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">b)</span><span>Sal-Tech reserves the right to
                            cancel any order that does not correspond with the requirements in Section 4 (Documentation
                            Requirements).</span></li>
                    <li class="sc-clause"><span class="sc-clause__id">c)</span><span>Sal-Tech reserves the right to
                            cancel orders and receive refunds for completed payments if the supplier does not comply
                            with the documentation requirements of the end user country of residence.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s15">
                <div class="sc-section__header"><span class="sc-section__num">§ 15</span>
                    <h2 class="sc-section__title">Waiver</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>Sal-Tech's waiver of any breach of
                            any provision contained in these Terms and Conditions will not waive any other breach by
                            Supplier. Sal-Tech's delay or failure to enforce its rights under these Terms and Conditions
                            shall not be deemed a waiver of such rights.</span></li>
                </ul>
            </section>

            <section class="sc-section" id="sc-s16">
                <div class="sc-section__header"><span class="sc-section__num">§ 16</span>
                    <h2 class="sc-section__title">Procedures Valid in Conjunction with Our Delivery and Purchasing
                        Conditions</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>This document may contain
                            technical, confidential, proprietary or legally privileged information and is intended for
                            the addressee's use only. Any usage, disclosure, distribution, print or copying of any part
                            of this document is prohibited unless the recipient has been granted the right in writing by
                            Sal-Tech Easy Packaging. All copyright issues are owned by Sal-Tech Easy Packaging unless
                            otherwise stated.</span></li>
                </ul>
                <div class="sc-infobox">
                    If you receive this document in error, please delete it from any computer and notify the sender. If
                    you suspect the document may have been altered, please notify the sender immediately. Sal-Tech Easy
                    Packaging does not accept liability for any damage caused by software viruses. General terms
                    applicable: <a href="http://www.sal-tech.com" target="_blank" rel="noopener noreferrer"
                        style="color:inherit;font-weight:600;">www.sal-tech.com</a>
                </div>
            </section>

            <section class="sc-section" id="sc-s17">
                <div class="sc-section__header"><span class="sc-section__num">§ 17</span>
                    <h2 class="sc-section__title">Severability</h2>
                </div>
                <ul class="sc-clauses">
                    <li class="sc-clause"><span class="sc-clause__id">a)</span><span>In the event that any provision
                            hereof shall be held to be invalid or unenforceable by a tribunal or court of appropriate
                            jurisdiction, the invalid or unenforceable provision shall be deemed deleted, and the
                            remaining part of these Conditions shall remain in full force and effect.</span></li>
                </ul>
            </section>

            <div class="sc-closing">
                Supplier and Sal-Tech do hereby acknowledge and agree that the Purchase Order is placed, and these Terms
                and Conditions are made, accepted and entered into by force of law.
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <div class="sc-footnote">
        <div class="sc-wrap">
            <p><strong>Salbæk Technology Group — Supplier Terms and Conditions</strong></p>
            <p>Edition: September 2024 &nbsp;|&nbsp; Reference: PME.07.02.2024.1.E &nbsp;|&nbsp; Language: English</p>
            <p>Invoices: <a href="mailto:invoice@sal-tech.com">invoice@sal-tech.com</a> &nbsp;·&nbsp; Accounts: <a
                    href="mailto:accounts@sal-tech.com">accounts@sal-tech.com</a> &nbsp;·&nbsp; Logistics: <a
                    href="mailto:logistics@sal-tech.com">logistics@sal-tech.com</a></p>
        </div>
    </div>

</main>

<?php get_footer(); ?>