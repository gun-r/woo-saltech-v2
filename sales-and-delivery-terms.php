<?php
/**
 * Template Name:  Sales and Delivery Terms
 *
 * Custom page template for the Sal-Tech Sales and Delivery Terms page.
 *
 * @package SalTech
 */

get_header(); ?>

<style>
    /* ─── Design System ─── */
    :root {
        --st-black: #111111;
        --st-gray: #4B5563;
        --st-gray-2: #6B7280;
        --st-border: #E5E7EB;
        --st-red: #DC2626;
        --st-red-h: #B91C1C;
        --st-white: #FFFFFF;
        --st-light: #F9FAFB;
        --st-radius: 8px;
        --st-max: 960px;
        /* narrower for legal readability */
        --st-gap: clamp(2.5rem, 5vw, 4.5rem);
        --ff: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
    }

    .st-page {
        font-family: var(--ff);
        color: var(--st-black);
        background: var(--st-white);
        line-height: 1.75;
        overflow-x: hidden;
        font-size: 16px;
    }

    .st-page *,
    .st-page *::before,
    .st-page *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .st-page a {
        color: var(--st-red);
        text-decoration: none;
    }

    .st-page a:hover {
        color: var(--st-red-h);
        text-decoration: underline;
    }

    .st-wrap {
        max-width: var(--st-max);
        margin: 0 auto;
        padding: 0 clamp(1.25rem, 4vw, 2.5rem);
    }

    /* ─── HEADER BAND ─── */
    .st-doc-header {
        background: var(--st-light);
        color: var(--st-black);
        padding: clamp(2rem, 8vw, 1rem) 0 clamp(1.5rem, 6vw, 2rem);
        border-bottom: 3px solid var(--st-red);
    }

    .st-doc-header__eyebrow {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .6rem;
    }

    .st-doc-header__title {
        font-size: clamp(22px, 4vw, 36px);
        font-weight: 700;
        line-height: 1.15;
        color: var(--st-black);
        margin-bottom: 1.25rem;
    }

    .st-doc-header__meta {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem 2rem;
        font-size: 14px;
        color: #9CA3AF;
    }

    .st-doc-header__meta span {
        display: flex;
        align-items: center;
        gap: .4rem;
    }

    .st-doc-header__meta svg {
        width: 14px;
        height: 14px;
        stroke: #9CA3AF;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
    }

    /* ─── TOC ─── */
    .st-toc-wrap {
        background: var(--st-white);
        border-bottom: 1px solid var(--st-border);
        padding: 2rem 0;
    }

    .st-toc {
        background: var(--st-white);
        border: 1px solid var(--st-border);
        border-radius: var(--st-radius);
        overflow: hidden;
    }

    .st-toc__head {
        display: flex;
        align-items: center;
        gap: .6rem;
        padding: .9rem 1.25rem;
        border-bottom: 1px solid var(--st-border);
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--st-black);
        background: var(--st-light);
    }

    .st-toc__head svg {
        width: 15px;
        height: 15px;
        stroke: var(--st-red);
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .st-toc__grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 0;
    }

    .st-toc__item {
        display: flex;
        align-items: center;
        gap: .6rem;
        padding: .6rem 1.25rem;
        font-size: 14px;
        color: var(--st-gray);
        text-decoration: none;
        border-bottom: 1px solid var(--st-border);
        transition: background .15s, color .15s;
    }

    .st-toc__item:hover {
        background: #FEF2F2;
        color: var(--st-red);
        text-decoration: none;
    }

    .st-toc__num {
        font-size: 11px;
        font-weight: 700;
        color: var(--st-red);
        background: #FEE2E2;
        border-radius: 4px;
        padding: 1px 6px;
        flex-shrink: 0;
        font-variant-numeric: tabular-nums;
    }

    /* ─── DOCUMENT BODY ─── */
    .st-doc-body {
        background: var(--st-light);
        padding: var(--st-gap) 0 clamp(3rem, 6vw, 5rem);
    }

    /* Section */
    .st-section {
        margin-bottom: 3rem;
        padding-bottom: 3rem;
        border-bottom: 1px solid var(--st-border);
        scroll-margin-top: 80px;
    }

    .st-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .st-section__heading {
        display: flex;
        align-items: baseline;
        gap: .85rem;
        margin-bottom: 1.25rem;
    }

    .st-section__num {
        font-size: 11px;
        font-weight: 700;
        color: var(--st-red);
        background: #FEE2E2;
        border-radius: 4px;
        padding: 3px 8px;
        flex-shrink: 0;
        letter-spacing: .04em;
        text-transform: uppercase;
        line-height: 1.4;
    }

    .st-section__title {
        font-size: 18px;
        font-weight: 700;
        color: var(--st-black);
        line-height: 1.25;
    }

    /* Clauses */
    .st-clause {
        display: grid;
        grid-template-columns: 28px 1fr;
        gap: .5rem;
        margin-bottom: .85rem;
        font-size: 15px;
        color: var(--st-gray);
        line-height: 1.75;
        align-items: baseline;
    }

    .st-clause:last-child {
        margin-bottom: 0;
    }

    .st-clause__ref {
        font-size: 13px;
        font-weight: 700;
        color: var(--st-black);
        flex-shrink: 0;
        padding-top: .05rem;
    }

    .st-clause__text {}

    .st-clause--sub {
        grid-template-columns: 44px 1fr;
        margin-top: .35rem;
        margin-left: 28px;
    }

    .st-clause--sub .st-clause__ref {
        font-size: 12px;
        color: var(--st-gray-2);
        font-weight: 600;
    }

    /* Jurisdiction list */
    .st-jur-list {
        list-style: none;
        margin-top: .75rem;
        margin-left: 28px;
    }

    .st-jur-list li {
        font-size: 15px;
        color: var(--st-gray);
        padding: .45rem 0;
        border-bottom: 1px solid var(--st-border);
        display: flex;
        align-items: baseline;
        gap: .6rem;
    }

    .st-jur-list li:last-child {
        border-bottom: none;
    }

    .st-jur-list li::before {
        content: '—';
        color: var(--st-red);
        font-weight: 700;
        flex-shrink: 0;
    }

    /* ─── FOOTER STRIP ─── */
    .st-doc-footer {
        background: var(--st-white);
        border-top: 1px solid var(--st-border);
        padding: 2rem 0;
    }

    .st-doc-footer__inner {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        font-size: 13px;
        color: var(--st-gray-2);
    }

    .st-doc-footer__ref {
        font-weight: 600;
        color: var(--st-black);
    }

    .st-doc-footer__btn {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        font-size: 13px;
        font-weight: 600;
        padding: .55rem 1.1rem;
        border-radius: 6px;
        text-decoration: none;
        border: 1px solid var(--st-border);
        color: var(--st-black);
        background: var(--st-white);
        cursor: pointer;
        transition: border-color .2s, color .2s;
    }

    .st-doc-footer__btn:hover {
        border-color: var(--st-red);
        color: var(--st-red);
        text-decoration: none;
    }

    .st-doc-footer__btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    /* ─── PRINT ─── */
    @media print {

        .st-toc-wrap,
        .st-doc-footer {
            display: none;
        }

        .st-doc-header {
            background: #fff;
            color: #000;
            border-bottom: 2px solid #000;
        }

        .st-doc-header__title {
            color: #000;
        }

        .st-section {
            page-break-inside: avoid;
        }
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 600px) {
        .st-toc__grid {
            grid-template-columns: 1fr;
        }

        .st-doc-footer__inner {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<main class="st-page">

    <!-- ══ DOCUMENT HEADER ══ -->
    <header class="st-doc-header">
        <div class="st-wrap">
            <p class="st-doc-header__eyebrow">Salbæk Technology Group</p>
            <h1 class="st-doc-header__title">Sales and Delivery Terms</h1>
            <div class="st-doc-header__meta">
                <span>
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    Edition: January 2024
                </span>
                <span>
                    <svg viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                    </svg>
                    Ref: PME.07.01.2024.01.A
                </span>
                <span>
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="2" y1="12" x2="22" y2="12" />
                        <path
                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                    </svg>
                    English — International
                </span>
            </div>
        </div>
    </header>

    <!-- ══ TABLE OF CONTENTS ══ -->
    <div class="st-toc-wrap">
        <div class="st-wrap">
            <div class="st-toc">
                <div class="st-toc__head">
                    <svg viewBox="0 0 24 24">
                        <line x1="8" y1="6" x2="21" y2="6" />
                        <line x1="8" y1="12" x2="21" y2="12" />
                        <line x1="8" y1="18" x2="21" y2="18" />
                        <line x1="3" y1="6" x2="3.01" y2="6" />
                        <line x1="3" y1="12" x2="3.01" y2="12" />
                        <line x1="3" y1="18" x2="3.01" y2="18" />
                    </svg>
                    Table of Contents
                </div>
                <div class="st-toc__grid">
                    <?php
                    $sections = [
                        1 => 'General',
                        2 => 'Delivery and Acceptance',
                        3 => 'Sample / Loan',
                        4 => 'Retention of Title',
                        5 => 'Prices',
                        6 => 'Payment Terms',
                        7 => 'Special Payment Terms',
                        8 => 'Limitations of Liability',
                        9 => 'Warranty',
                        10 => 'Product Liability',
                        11 => 'Climatic Conditions for Storage',
                        12 => 'Return of Goods',
                        13 => 'Preparation / Installation',
                        14 => 'Telephone Service',
                        15 => 'Complaints',
                        16 => 'Hourly Rate',
                        17 => 'Travel',
                        18 => 'Intellectual Property Rights',
                        19 => 'Confidential Information',
                        20 => 'Ban on Resale for Illegal Purposes',
                        21 => 'Force Majeure and Cancellation',
                        22 => 'Global Compact',
                        23 => 'Partial Invalidity',
                        24 => 'Third Party Claims',
                        25 => 'Governing Law',
                        26 => 'Jurisdiction',
                        27 => 'Other Conditions',
                    ];
                    foreach ($sections as $num => $title):
                        ?>
                        <a href="#section-<?php echo $num; ?>" class="st-toc__item">
                            <span class="st-toc__num">
                                <?php echo $num; ?>
                            </span>
                            <?php echo esc_html($title); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ══ DOCUMENT BODY ══ -->
    <div class="st-doc-body">
        <div class="st-wrap">

            <!-- 1. GENERAL -->
            <div class="st-section" id="section-1">
                <div class="st-section__heading">
                    <span class="st-section__num"> 1</span>
                    <h2 class="st-section__title">General</h2>
                </div>
                <div class="st-clause">
                    <span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">The company name "Sal-Tech", (hereinafter referred to as "we", "us") used
                        in this document covers all companies, subsidiaries or branches within Salbæk Technology Group,
                        including, but not limited to Sal-Tech Easy Packaging v/G. Salbæk (CVR Nr. DK 18429098),
                        Sal-Tech HKG Limited (Registration Nr. HK 1553382), Sal-Tech Embalaje SL (CIF Nr. B01970045) and
                        Sal-Tech Easy Packaging LLC (Reg nr. 35-2776554).</p>
                </div>
                <div class="st-clause">
                    <span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Sal-Tech reserves the right for any order. Orders, agreements, contracts
                        are only considered as such if confirmed by us in writing. Modifications on those will only be
                        binding for us, if confirmed in writing.</p>
                </div>
                <div class="st-clause">
                    <span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">Any contract or agreement is made with one and cannot be challenged with
                        another Sal-Tech company, other than whom the contract was made with and order confirmed same,
                        unless this is agreed and signed in writing. If orders run on one or more Sal-Tech companies
                        this must be specified in written contract foundation.</p>
                </div>
            </div>

            <!-- 2. DELIVERY AND ACCEPTANCE -->
            <div class="st-section" id="section-2">
                <div class="st-section__heading">
                    <span class="st-section__num"> 2</span>
                    <h2 class="st-section__title">Delivery and Acceptance</h2>
                </div>
                <div class="st-clause">
                    <span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">EXW Denmark Sal-Tech Easy Packaging v/G. Salbæk, EXW Hong Kong Sal-Tech
                        HKG Limited, EXW Spain Sal-Tech Embalaje SL, EXW USA Sal-Tech Easy Packaging LLC and/or direct
                        from third party supplier. Under EC criteria Incoterms 2020 or as specified in the order/offer
                        basis.</p>
                </div>
                <div class="st-clause">
                    <span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Delivery time according to written order confirmation, confirming e-mail
                        and/or for orders below 7,500 DKK / 1,000 USD / EUR spoken by phone in cases of known trade
                        relations.</p>
                </div>
                <div class="st-clause">
                    <span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">If no order confirmation or confirming email/spoken confirmation has been
                        given in revert to an order, then it is the responsibility of the purchaser to secure order
                        validation within 7 days from order, else the order is to be regarded as discharged.</p>
                </div>
                <div class="st-clause">
                    <span class="st-clause__ref">d)</span>
                    <p class="st-clause__text">Order Confirmation issued by Sal-Tech is the acceptance of purchase order
                        — the written or verbal order by buyer to purchase from Sal-Tech any products and/or services.
                    </p>
                </div>
                <div class="st-clause st-clause--sub">
                    <span class="st-clause__ref">I.</span>
                    <p class="st-clause__text">Any discrepancy between the buyer's intention and the order confirmation
                        shall be clarified by the buyer in writing within 3 days but before order has been dispatched to
                        prevent possible litigation.</p>
                </div>
                <div class="st-clause">
                    <span class="st-clause__ref">e)</span>
                    <p class="st-clause__text">We reserve the right to cancel or reject any order and refund any
                        prepayment received on web shops for orders that are technically unsound, where delivery time is
                        shorter than practically possible, and alike.</p>
                </div>
                <div class="st-clause">
                    <span class="st-clause__ref">f)</span>
                    <p class="st-clause__text">If damages happen during transport, these must be stated on receiving
                        goods and noted on the letter of transport. Claims must be filed directly with the
                        Transportation Company, as this is beyond the responsibility of Sal-Tech and is a matter between
                        the receiving customer and the transport company in question. Sal-Tech will assist as best we
                        can, without obligation.</p>
                </div>
                <div class="st-clause">
                    <span class="st-clause__ref">g)</span>
                    <p class="st-clause__text">In case delivery is delayed at the request of the customer, the costs
                        incurred by storage will be charged to them. Storage pricing will be ½% of the invoice amount
                        for each month, or its proportional part depending on the time of storage.</p>
                </div>
            </div>

            <!-- 3. SAMPLE/LOAN -->
            <div class="st-section" id="section-3">
                <div class="st-section__heading">
                    <span class="st-section__num"> 3</span>
                    <h2 class="st-section__title">Sample / Loan</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Sample sent/borrowing goods must be agreed prior to the order being
                        placed, which must be in writing and expressly stated in the invoice.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">The buyer accounts for all costs which may be associated with freight
                        charges, including any ancillary costs.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">Sample sent/borrowing is solely for testing purposes, but once the goods
                        are used by the buyer for the purpose of their actual production/use, then the purchase price is
                        due to Sal-Tech thereof.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">d)</span>
                    <p class="st-clause__text">Exceeding the date fixed for the return of the sample will entail that
                        the purchase price for the goods is due within 8 days, unless otherwise agreed.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">e)</span>
                    <p class="st-clause__text">All consumables used by the buyer in the sample/loan period are to be
                        paid to Sal-Tech (consumables in batch credited).</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">f)</span>
                    <p class="st-clause__text">Any service, cleaning, re-packaging, repair, testing or similar of
                        returned sample/loan machines will be at the cost of the borrower and invoiced after said
                        refurbishment work has been carried out by Sal-Tech.</p>
                </div>
            </div>

            <!-- 4. RETENTION OF TITLE -->
            <div class="st-section" id="section-4">
                <div class="st-section__heading">
                    <span class="st-section__num"> 4</span>
                    <h2 class="st-section__title">Retention of Title of Goods</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">The title to the goods remains vested in Sal-Tech until two conditions
                        have been met:</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">I.</span>
                    <p class="st-clause__text">Payment of the purchase price.</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">II.</span>
                    <p class="st-clause__text">Receipt of delivery is communicated to us.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">The purchaser is obliged to promptly inform where the equipment is kept,
                        in the same condition as received upon delivery, if payment is not met.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">Leased equipment must be securely labeled as having ownership of
                        Sal-Tech.</p>
                </div>
            </div>

            <!-- 5. PRICES -->
            <div class="st-section" id="section-5">
                <div class="st-section__heading">
                    <span class="st-section__num"> 5</span>
                    <h2 class="st-section__title">Prices</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">All prices are stated in USD, EUR or DKK excluding VAT, customs cleared
                        into Denmark, Hong Kong, Spain and USA but excluding any environmental or other taxes that may
                        apply.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Errors in price lists and so on — we reserve the right to change without
                        notice.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">All prices stated are exclusive of delivery and made Ex Works (Incoterms
                        2020).</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">d)</span>
                    <p class="st-clause__text">The buyer is responsible for any surplus charges related to the sale of
                        goods, including but not limited to: VAT, customs charges, environmental taxes or any other
                        ancillary charges which may apply for the delivery of the goods to take place, unless otherwise
                        agreed.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">e)</span>
                    <p class="st-clause__text">Sal-Tech reserves the right to correct or amend any errors in pricing
                        without being legally bound by any agreement.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">f)</span>
                    <p class="st-clause__text">In case of currency fluctuations greater than 3%, we reserve the right to
                        change prices without prior notice.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">g)</span>
                    <p class="st-clause__text">Sal-Tech reserves the right to increase prices, if delivery takes place 1
                        month or more after order confirmation, unless otherwise confirmed in writing.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">h)</span>
                    <p class="st-clause__text">In case of shipment excess surcharge, these can be added to the final
                        invoice if such circumstances affect our productivity and cost level.</p>
                </div>
            </div>

            <!-- 6. PAYMENT TERMS -->
            <div class="st-section" id="section-6">
                <div class="st-section__heading">
                    <span class="st-section__num"> 6</span>
                    <h2 class="st-section__title">Payment Terms</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Standard materials and equipment below 50,000 DKK / 10,000 USD / 8,000
                        EUR invoice total: Net 8 days from date of invoice, provided your company has applied and been
                        approved for a set credit line and period.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Payment must be effected in due time, failing which interest will be
                        charged at the rate of 2.0% per calendar month.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">Equipment over 50,000 DKK / 10,000 USD / 8,000 EUR: Net cash on delivery
                        or, in some cases, only against partial or full payment in advance — typically non-stock
                        machines and machines above this threshold. We reserve the right for any order or as per stated
                        terms in the order confirmation.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">d)</span>
                    <p class="st-clause__text">Sample/loan of equipment only by appointment.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">e)</span>
                    <p class="st-clause__text">Special materials and materials not normally in stock: 50% on order and
                        50% net 14 days from date of invoice.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">f)</span>
                    <p class="st-clause__text">Orders placed online through an STG web shop by customers who have not
                        applied for a credit line, and where the order is below 1,500 DKK / 200 USD / 160 EUR, we
                        reserve the right to discharge if not prepaid directly based on the Pro Forma Invoice generated
                        by the web shop system.</p>
                </div>
            </div>

            <!-- 7. SPECIAL PAYMENT TERMS -->
            <div class="st-section" id="section-7">
                <div class="st-section__heading">
                    <span class="st-section__num"> 7</span>
                    <h2 class="st-section__title">Special Payment Terms of Price, Rebate and Financing Agreements</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">If awarded a price and/or discount agreement, payment terms are generally
                        net cash advance or immediately upon delivery.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">In case a customer wishes a finance agreement, this can only be made when
                        the customer has demonstrated a timely payment pattern over a number of invoices and over a
                        period of time.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">It is also required that the customer uses a purchase requisition system
                        to deliver written orders by email with a reference number applied, and undertakes to keep us
                        updated about communication lines, as well as significant changes in accounts/budgets that may
                        impact our assessment of creditworthiness. We reserve the right to require price adjustment,
                        fees and interest where there are significant changes in payment times, and to override
                        agreements in specific cases.</p>
                </div>
            </div>

            <!-- 8. LIMITATIONS OF LIABILITY -->
            <div class="st-section" id="section-8">
                <div class="st-section__heading">
                    <span class="st-section__num"> 8</span>
                    <h2 class="st-section__title">Limitations of Liability</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Sal-Tech reserves the right to reject any order if we honestly believe
                        that having the goods delivered will prove to be burdensome, including but not limited to the
                        transportation deadline being too short, creditworthiness of the buyer, or force majeure
                        reasons.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Sal-Tech will not be held liable for any damage done to the goods during
                        the shipment/transportation period.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">In the event that the Carrier or Freight Forwarder are proven to be
                        liable for any damage/delay/loss of goods whilst the goods were still in their custody, then the
                        party liable for assigning that role to them will have to remedy, if sought, the
                        damage/delay/loss of the goods.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">d)</span>
                    <p class="st-clause__text">Without in any way being obliged to do so, Sal-Tech will assist the buyer
                        in remedying any loss/damage/delay done to the goods during the shipment/transportation period.
                    </p>
                </div>
            </div>

            <!-- 9. WARRANTY -->
            <div class="st-section" id="section-9">
                <div class="st-section__heading">
                    <span class="st-section__num"> 9</span>
                    <h2 class="st-section__title">Warranty</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">If it can be proven by the buyer that the goods delivered to them are, or
                        have become defective within a 1-year time frame of being delivered, then the buyer retains the
                        right to have them repaired, free of charge, by Sal-Tech.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Warranty does not cover labour or components exchanged due to mishandling
                        of the goods, including but not limited to: rough handling or excessive use, fault in operation,
                        use of non-original spare parts or materials not delivered by Sal-Tech, faults in fixed
                        installations, faulty fuses, or lack of necessary cleaning, maintenance, education,
                        certification and training.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">Warranty claims must follow item number, machine number and delivery
                        Invoice No.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">d)</span>
                    <p class="st-clause__text">Any ancillary charges incurred for the purpose of repair of goods at the
                        buyer's address must be borne by the buyer, including but not limited to driving hours, mileage
                        costs and other possible travel costs associated.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">e)</span>
                    <p class="st-clause__text">Machines submitted to one of our repair facilities will be repaired free
                        of charge, except for costs in connection with shipment/transportation of the goods to and from
                        our workshop.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">f)</span>
                    <p class="st-clause__text">For guaranteed work done at the buyer's place of business or at our
                        workshop, it must be clearly stated on the service report that the part(s) are accepted for
                        exchange under guarantee; else the parts and labour for exchange will be charged as wear parts.
                    </p>
                </div>
            </div>

            <!-- 10. PRODUCT LIABILITY -->
            <div class="st-section" id="section-10">
                <div class="st-section__heading">
                    <span class="st-section__num"> 10</span>
                    <h2 class="st-section__title">Product Liability</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Sal-Tech is responsible for injury if it is proved that the damage was
                        caused by negligence on the part of Sal-Tech or others for whom Sal-Tech is responsible.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Sal-Tech is not liable during the warranty period for damage that the
                        product may cause.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">Sal-Tech's product liability shall never exceed Sal-Tech's insurance
                        coverage. Sal-Tech is never liable for damage to real or personal property, including loss of
                        profits, loss of earnings or other indirect losses.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">d)</span>
                    <p class="st-clause__text">If a third party makes a claim against either Sal-Tech or the buyer, each
                        party must promptly notify the other.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">e)</span>
                    <p class="st-clause__text">Sal-Tech and the Purchaser shall be mutually obliged to allow themselves
                        to be summoned to a court or arbitral tribunal examining claims for damages lodged against one
                        of them on the basis of damage or loss allegedly caused by the material supplied.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">f)</span>
                    <p class="st-clause__text">The relationship between Sal-Tech and the buyer shall be treated in
                        accordance with the clauses concerning jurisdiction and applicable law.</p>
                </div>
            </div>

            <!-- 11. CLIMATIC CONDITIONS -->
            <div class="st-section" id="section-11">
                <div class="st-section__heading">
                    <span class="st-section__num"> 11</span>
                    <h2 class="st-section__title">Climatic Conditions for Storage</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">It is assumed by default, unless otherwise agreed in writing, that the
                        equipment and packaging are stored in a temperature range between 5 and 30°C, maximum humidity
                        less than 80% RH, and heat variations with up to 5°C change per hour.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">If materials are stored incorrectly, storage begins to break down the raw
                        material composition, which can result in friction changes, smell and colour changes.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">It is therefore important that the materials are stored according to the
                        following guidelines:</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">I.</span>
                    <p class="st-clause__text">Products must be protected from prolonged exposure to light (sunlight and
                        direct radiation from other sources).</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">II.</span>
                    <p class="st-clause__text">Products must be protected from external factors including but not
                        limited to wind, rain, dust and other weather conditions, unless expressly agreed at the time of
                        purchase.</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">III.</span>
                    <p class="st-clause__text">Products should be stored between +5°C and +25°C.</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">IV.</span>
                    <p class="st-clause__text">Products should not be stored in close proximity to heaters, heat
                        radiation or heat sources.</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">V.</span>
                    <p class="st-clause__text">Stacking should be avoided.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">d)</span>
                    <p class="st-clause__text">For materials, products must be acclimatised prior to use — meaning
                        storage for 24–48 hours in production facilities or a similar climate.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">e)</span>
                    <p class="st-clause__text">The outer packaging must not be removed until shortly before use.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">f)</span>
                    <p class="st-clause__text">Unused items must again be wrapped in light-tight packaging.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">g)</span>
                    <p class="st-clause__text">Traceability: information such as order number, serial number, dimensions
                        and roll number on label rolls or cartons should not be removed before processing. This
                        information is important for any queries regarding delivery.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">h)</span>
                    <p class="st-clause__text">Durability:</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">I.</span>
                    <p class="st-clause__text">Machining of plastic film to be made within one (1) year after
                        production.</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">II.</span>
                    <p class="st-clause__text">Depending on the additive added: release agent, UV stabilisers or
                        anti-static.</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">III.</span>
                    <p class="st-clause__text">For plastic film that has been treated with pressure, a shorter shelf
                        life may be necessary.</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">IV.</span>
                    <p class="st-clause__text">All film rolls should be stored upright standing.</p>
                </div>
            </div>

            <!-- 12. RETURN OF GOODS -->
            <div class="st-section" id="section-12">
                <div class="st-section__heading">
                    <span class="st-section__num"> 12</span>
                    <h2 class="st-section__title">Return of Goods</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Equipment and materials are sold without the right of return.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">In the event of agreed return, only 90% of the invoice amount will be
                        credited, unless otherwise agreed in writing and/or applied on our invoice.</p>
                </div>
            </div>

            <!-- 13. PREPARATION/INSTALLATION -->
            <div class="st-section" id="section-13">
                <div class="st-section__heading">
                    <span class="st-section__num"> 13</span>
                    <h2 class="st-section__title">Preparation / Installation</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Sal-Tech provides optional service to install/prepare certain machinery
                        or equipment. In the event that Sal-Tech performs provisioning and installation, the buyer will
                        be billed contracted hours used at our hourly rate for service work.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Provided that provisioning and installation occurs within a period of
                        days' gap, then those days/hours will be billed, unless otherwise agreed.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">The buyer shall be responsible for supplying lifting and transport
                        equipment necessary for installation, and any necessary additional staff, unless otherwise
                        agreed.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">d)</span>
                    <p class="st-clause__text">Unless otherwise agreed, we invoice per hour and per kilometre, with a
                        minimum charge of 50 km for any services supplied from the starting point of where our
                        technician(s) are based to their return to that same base.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">e)</span>
                    <p class="st-clause__text">The buyer accounts for costs associated with travel and driving, such as
                        bridge fares, airline tickets, hotel, meals, etc., which will be billed at cost plus a 15%
                        handling fee.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">f)</span>
                    <p class="st-clause__text">Machines, tools and materials are not sold for use to solve specific
                        demands unless these demands have been specifically agreed in writing between Sal-Tech and the
                        customer.</p>
                </div>
            </div>

            <!-- 14. TELEPHONE SERVICE -->
            <div class="st-section" id="section-14">
                <div class="st-section__heading">
                    <span class="st-section__num"> 14</span>
                    <h2 class="st-section__title">Telephone Service</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Sal-Tech assumes that the buyer can solve common technical and
                        operational issues, yet the buyer may call in for advice and will be billed based on our regular
                        hourly rate for services provided, comprising a minimum of 5 minutes where the minimum billing
                        accounts for 30 minutes.</p>
                </div>
            </div>

            <!-- 15. COMPLAINTS -->
            <div class="st-section" id="section-15">
                <div class="st-section__heading">
                    <span class="st-section__num"> 15</span>
                    <h2 class="st-section__title">Complaints</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Complaints must be promptly communicated to Sal-Tech in writing within 5
                        days of delivery/order confirmation of the product and/or service.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Any complaint lodged in a timely manner does not suspend any payment due,
                        unless otherwise agreed in writing by Sal-Tech.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">Sal-Tech will do its utmost to reach an amicable settlement with the
                        buyer in the event of a complaint being lodged.</p>
                </div>
            </div>

            <!-- 16. HOURLY RATE -->
            <div class="st-section" id="section-16">
                <div class="st-section__heading">
                    <span class="st-section__num"> 16</span>
                    <h2 class="st-section__title">Hourly Rate</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">The then-current hourly rate for service work and driving hours forms the
                        basis for billing. Service work and driving hours shall be billed on an hourly basis where the
                        minimum billing accounts for 1 hour with subsequent division into half hours per commenced
                        device.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">The regular hourly rate shall apply to hours between 06:00 and 18:00, and
                        to a maximum of 7.5 hours per day.</p>
                </div>
            </div>

            <!-- 17. TRAVEL -->
            <div class="st-section" id="section-17">
                <div class="st-section__heading">
                    <span class="st-section__num"> 17</span>
                    <h2 class="st-section__title">Travel</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Unless otherwise agreed, we invoice per hour and per kilometre at the
                        then-current rate set by Sal-Tech.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">The minimum charge is 50 km. Costs associated with travel and driving,
                        such as bridge fares, airline tickets, hotel, meals, etc., will be billed at cost plus a 15%
                        handling fee.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">Driving costs commence from our technician's starting point, returning to
                        same, with distribution in relation to other services performed on the same trip.</p>
                </div>
            </div>

            <!-- 18. INTELLECTUAL PROPERTY -->
            <div class="st-section" id="section-18">
                <div class="st-section__heading">
                    <span class="st-section__num"> 18</span>
                    <h2 class="st-section__title">Intellectual Property Rights</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">All intellectual property rights are reserved with Sal-Tech, including
                        but not limited to: copyright, patents, texts, trademarks, illustrations, photos, graphics,
                        files, designs and arrangements.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Sal-Tech's website is protected by copyright and all contents therein.
                    </p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">Where a product is delivered with embedded software, the buyer retains
                        only a non-exclusive software licence limited to the purposes set out in the relevant product
                        specification. The buyer acquires no rights to the source code of the software.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">d)</span>
                    <p class="st-clause__text">Delivered manuals and drawings may not be copied or distributed without
                        our written consent.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">e)</span>
                    <p class="st-clause__text">Translations are always Sal-Tech's property and copyright protected.</p>
                </div>
            </div>

            <!-- 19. CONFIDENTIAL INFORMATION -->
            <div class="st-section" id="section-19">
                <div class="st-section__heading">
                    <span class="st-section__num"> 19</span>
                    <h2 class="st-section__title">Confidential Information</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Any information that is not publicly available, including drawings and
                        technical documents handed over by Sal-Tech to Buyer ("Confidential Information"), shall remain
                        Sal-Tech's property and must be treated as confidential by the Buyer.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Confidential Information shall not, without Sal-Tech's written consent,
                        be copied, reproduced or transferred to third parties, or used for any purpose other than that
                        for which the transfer was intended.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">Confidential Information shall be returned on demand to Sal-Tech.</p>
                </div>
            </div>

            <!-- 20. BAN ON RESALE -->
            <div class="st-section" id="section-20">
                <div class="st-section__heading">
                    <span class="st-section__num"> 20</span>
                    <h2 class="st-section__title">Ban on Resale for Illegal Purposes</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Sal-Tech's products are manufactured for civilian use. Sal-Tech's
                        products must not be used for or resold for any purpose connected with chemical, biological or
                        nuclear weapons or missiles capable of delivering such weapons.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Sal-Tech's products may not be sold to individuals, companies or any
                        other organisation where there is knowledge or suspicion that they are related to any terrorist
                        or drug activity.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">Sal-Tech's products may be subject to legal regulations and restrictions,
                        and may be subject to restrictions on sales to countries/customers covered by export and import
                        bans.</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">I.</span>
                    <p class="st-clause__text">Such restrictions must be observed for the resale of Sal-Tech's products
                        to these countries/customers.</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">II.</span>
                    <p class="st-clause__text">Sal-Tech's products may not be resold if there is any doubt or suspicion
                        that the products can be used for the above purposes.</p>
                </div>
                <div class="st-clause st-clause--sub"><span class="st-clause__ref">III.</span>
                    <p class="st-clause__text">If the buyer knows or suspects that the above conditions have been
                        violated, the buyer shall promptly notify Sal-Tech accordingly.</p>
                </div>
            </div>

            <!-- 21. FORCE MAJEURE -->
            <div class="st-section" id="section-21">
                <div class="st-section__heading">
                    <span class="st-section__num"> 21</span>
                    <h2 class="st-section__title">Force Majeure and Cancellation</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Sal-Tech reserves the right to cancel any order due to circumstances
                        beyond Sal-Tech's reasonable control, such as: public health emergency, riots, civil commotion,
                        war, terrorism, fire, government regulations, strikes, lockouts, slow-down, lack of transport,
                        shortages, disease, or delay in or failure of deliveries from suppliers, accidents in product
                        testing, and/or lack of energy supply.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Sal-Tech shall not be liable for any failure or delay in performance of
                        any obligations if such failure or delay is due to a public health emergency or other cause
                        beyond its reasonable control, including but not limited to restrictions imposed by governments,
                        local authorities, relevant companies or other entities, infection or quarantine, or any
                        restrictions affecting transport, logistics or production.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">c)</span>
                    <p class="st-clause__text">All buyer powers are suspended or terminated in the circumstances
                        described in §21(a) and §21(b). The buyer may neither seek damages nor make a claim against
                        Sal-Tech in case of cancellation or delayed delivery arising from such circumstances.</p>
                </div>
            </div>

            <!-- 22. GLOBAL COMPACT -->
            <div class="st-section" id="section-22">
                <div class="st-section__heading">
                    <span class="st-section__num"> 22</span>
                    <h2 class="st-section__title">Global Compact</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">Sal-Tech supports the UN Global Compact initiative and undertakes to
                        comply with the 10 principles concerning human rights, labour rights, environment and
                        anti-corruption. Sal-Tech therefore also calls upon the Buyer to meet these basic principles.
                        For further information: <a href="http://www.unglobalcompact.org" target="_blank"
                            rel="noopener noreferrer">www.unglobalcompact.org</a>.</p>
                </div>
            </div>

            <!-- 23. PARTIAL INVALIDITY -->
            <div class="st-section" id="section-23">
                <div class="st-section__heading">
                    <span class="st-section__num"> 23</span>
                    <h2 class="st-section__title">Partial Invalidity</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">If one or more provisions of Sal-Tech's Terms and Conditions are void
                        and/or unenforceable, then the remaining provisions retain their validity and remain unimpaired.
                    </p>
                </div>
            </div>

            <!-- 24. THIRD PARTY CLAIMS -->
            <div class="st-section" id="section-24">
                <div class="st-section__heading">
                    <span class="st-section__num"> 24</span>
                    <h2 class="st-section__title">Third Party Claims</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">If a third party makes a claim against either Sal-Tech or the buyer, each
                        party must promptly notify the other. Sal-Tech and the Purchaser shall be mutually obliged to
                        allow themselves to be summoned to a court or arbitral tribunal examining claims for damages
                        lodged against one of them on the basis of damage or loss allegedly caused by the material
                        supplied. The relationship between Sal-Tech and the buyer shall be treated in accordance with
                        25 and 26.</p>
                </div>
            </div>

            <!-- 25. GOVERNING LAW -->
            <div class="st-section" id="section-25">
                <div class="st-section__heading">
                    <span class="st-section__num"> 25</span>
                    <h2 class="st-section__title">Governing Law</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">This agreement is governed by and shall be construed in accordance with
                        the Laws of Denmark/EU or for each branch entity as listed below:</p>
                </div>
                <ul class="st-jur-list">
                    <li>Sal-Tech Easy Packaging v/G. Salbæk — Denmark / EU</li>
                    <li>Sal-Tech HKG Limited (Reg. Nr. HK 1553382) — Hong Kong, China</li>
                    <li>Sal-Tech Embalaje SL (CIF Nr. B01970045) — Spain / EU</li>
                    <li>Sal-Tech Easy Packaging LLC (Reg. nr. 35-2776554) — USA</li>
                </ul>
            </div>

            <!-- 26. JURISDICTION -->
            <div class="st-section" id="section-26">
                <div class="st-section__heading">
                    <span class="st-section__num"> 26</span>
                    <h2 class="st-section__title">Jurisdiction</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">"Sal-Tech" is entitled to use the following Courts with non-exclusive
                        jurisdiction to adjudicate any dispute arising under or in connection with the agreement, unless
                        otherwise agreed by the parties in writing:</p>
                </div>
                <ul class="st-jur-list">
                    <li>Sal-Tech Easy Packaging v/G. Salbæk (CVR Nr. DK 18429098) — Sønderborg Court, Denmark</li>
                    <li>Sal-Tech HKG Limited (Reg. Nr. HK 1553382) — Hong Kong Court, China</li>
                    <li>Sal-Tech Embalaje SL (CIF Nr. B01970045) — Málaga Court, Spain</li>
                    <li>Sal-Tech Easy Packaging LLC (Reg. nr. 35-2776554) — Chicago Court, USA</li>
                </ul>
            </div>

            <!-- 27. OTHER CONDITIONS -->
            <div class="st-section" id="section-27">
                <div class="st-section__heading">
                    <span class="st-section__num"> 27</span>
                    <h2 class="st-section__title">Other Conditions</h2>
                </div>
                <div class="st-clause"><span class="st-clause__ref">a)</span>
                    <p class="st-clause__text">INCOTERMS 2020 and the present terms will form the basis for any
                        agreement between Sal-Tech and the Buyer for any conditions not mentioned above.</p>
                </div>
                <div class="st-clause"><span class="st-clause__ref">b)</span>
                    <p class="st-clause__text">Any Order Confirmation, Pro Forma Invoice or Invoice issued will
                        immediately supersede all previous communications — including but not limited to emails and
                        telephone conversations — in respect of said order, unless specifically incorporated into said
                        order foundation document.</p>
                </div>
                <!-- <div class="st-note">
                    <strong>Note:</strong> These terms supersede all earlier versions. Always refer to the latest
                    edition reference (PME.07.01.2024.01.A) when referencing this document in correspondence.
                </div> -->
            </div>

        </div><!-- /.st-wrap -->
    </div><!-- /.st-doc-body -->

    <!-- ══ DOCUMENT FOOTER ══ -->
    <footer class="st-doc-footer">
        <div class="st-wrap">
            <div class="st-doc-footer__inner">
                <div>
                    <span class="st-doc-footer__ref">Salbæk Technology Group</span><br>
                    Edition: January 2024 &nbsp;·&nbsp; Ref: PME.07.01.2024.01.A &nbsp;·&nbsp; English
                </div>
                <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="st-doc-footer__btn">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        Kontakt os
                    </a>
                </div>
            </div>
        </div>
    </footer>

</main>

<?php get_footer(); ?>