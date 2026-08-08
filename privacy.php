<?php
/**
 * Template Name: Privacy Policy
 *
 * Custom page template for the Sal-Tech Easy Packaging "Privacy Policy" page.
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
        --st-radius: 8px;
        --st-max: 960px;
        --st-gap: clamp(2.5rem, 5vw, 4.5rem);
        --ff: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
    }

    .sp-page {
        font-family: var(--ff);
        color: var(--st-black);
        background: var(--st-white);
        line-height: 1.7;
        overflow-x: hidden;
        font-size: 16px;
    }

    .sp-page *,
    .sp-page *::before,
    .sp-page *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .sp-page a {
        color: var(--st-red);
        text-decoration: none;
    }

    .sp-page a:hover {
        color: var(--st-red-h);
        text-decoration: underline;
    }

    .sp-wrap {
        max-width: var(--st-max);
        margin: 0 auto;
        padding: 0 clamp(1.25rem, 4vw, 2.5rem);
    }

    /* ─── HERO ─── */
    .sp-hero {
        background: var(--st-light);
        color: var(--st-black);
        padding: clamp(2rem, 8vw, 1rem) 0 clamp(1.5rem, 6vw, 2rem);
        border-bottom: 3px solid var(--st-red);
    }

    .sp-hero__eyebrow {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .65rem;
    }

    .sp-hero__title {
        font-size: clamp(22px, 4vw, 34px);
        font-weight: 700;
        line-height: 1.15;
        color: var(--st-black);
        margin-bottom: .75rem;
    }

    .sp-hero__sub {
        font-size: 14px;
        color: #9CA3AF;
        max-width: 600px;
    }

    .sp-hero__sub a {
        color: #D1D5DB;
    }

    .sp-hero__sub a:hover {
        color: var(--st-white);
    }

    /* ─── ENTITY LIST ─── */
    .sp-entities {
        background: var(--st-white);
        border-bottom: 1px solid var(--st-border);
        padding: 2rem 0;
    }

    .sp-entities__head {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: var(--st-gray);
        margin-bottom: 1rem;
    }

    .sp-entities__grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: .75rem;
    }

    .sp-entity {
        background: var(--st-white);
        border: 1px solid var(--st-border);
        border-radius: var(--st-radius);
        padding: .85rem 1.1rem;
    }

    .sp-entity__num {
        font-size: 11px;
        font-weight: 700;
        color: var(--st-red);
        letter-spacing: .08em;
        margin-bottom: .25rem;
    }

    .sp-entity__name {
        font-size: 13px;
        font-weight: 600;
        color: var(--st-black);
        margin-bottom: .15rem;
    }

    .sp-entity__detail {
        font-size: 12px;
        color: var(--st-gray);
    }

    /* ─── TABLE OF CONTENTS ─── */
    .sp-toc {
        padding: 2rem 0;
        background: var(--st-light);
        border-bottom: 1px solid var(--st-border);
    }

    .sp-toc__head {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: var(--st-gray);
        margin-bottom: 1rem;
    }

    .sp-toc__list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: .3rem .75rem;
        list-style: none;
    }

    .sp-toc__list li a {
        font-size: 13px;
        color: var(--st-gray);
        display: flex;
        align-items: baseline;
        gap: .4rem;
        padding: .2rem 0;
        transition: color .15s;
        text-decoration: none;
    }

    .sp-toc__list li a:hover {
        color: var(--st-red);
        text-decoration: none;
    }

    .sp-toc__list li a::before {
        content: '→';
        font-size: 11px;
        color: var(--st-red);
        flex-shrink: 0;
    }

    /* ─── CONTENT ─── */
    .sp-content {
        padding: var(--st-gap) 0 clamp(4rem, 8vw, 7rem);
        background: var(--st-white);
    }

    .sp-section {
        padding-bottom: 2.75rem;
        margin-bottom: 2.75rem;
        border-bottom: 1px solid var(--st-border);
        scroll-margin-top: 1.5rem;
    }

    .sp-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .sp-section__header {
        display: flex;
        align-items: baseline;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }

    .sp-section__title {
        font-size: 18px;
        font-weight: 700;
        color: var(--st-black);
        line-height: 1.2;
    }

    /* Body text */
    .sp-body {
        font-size: 15px;
        color: var(--st-gray);
        line-height: 1.8;
        margin-bottom: 1rem;
    }

    .sp-body:last-child {
        margin-bottom: 0;
    }

    /* Bullet list */
    .sp-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: .6rem;
        margin: .75rem 0;
    }

    .sp-list li {
        display: grid;
        grid-template-columns: 18px 1fr;
        gap: .5rem;
        align-items: baseline;
        font-size: 15px;
        color: var(--st-gray);
        line-height: 1.7;
    }

    .sp-list li::before {
        content: '•';
        color: var(--st-red);
        font-weight: 700;
        font-size: 14px;
    }

    /* Lettered sub-clauses */
    .sp-clauses {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: .85rem;
        margin-top: .5rem;
    }

    .sp-clause {
        display: grid;
        grid-template-columns: 28px 1fr;
        gap: .5rem;
        align-items: baseline;
        font-size: 15px;
        color: var(--st-gray);
        line-height: 1.75;
    }

    .sp-clause__id {
        font-size: 13px;
        font-weight: 700;
        color: var(--st-black);
        flex-shrink: 0;
    }

    /* GDPR rights cards */
    .sp-rights {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1rem;
        margin-top: 1.25rem;
    }

    .sp-right {
        background: var(--st-light);
        border: 1px solid var(--st-border);
        border-radius: var(--st-radius);
        padding: 1.25rem 1.25rem;
        transition: border-color .2s;
    }

    .sp-right:hover {
        border-color: var(--st-red);
    }

    .sp-right__title {
        font-size: 14px;
        font-weight: 700;
        color: var(--st-black);
        margin-bottom: .4rem;
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .sp-right__title::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--st-red);
        flex-shrink: 0;
    }

    .sp-right__body {
        font-size: 13px;
        color: var(--st-gray);
        line-height: 1.65;
    }

    /* Cookie types */
    .sp-cookies {
        display: flex;
        flex-direction: column;
        gap: .65rem;
        margin-top: .75rem;
    }

    .sp-cookie {
        display: grid;
        grid-template-columns: 28px 1fr;
        gap: .5rem;
        align-items: baseline;
        font-size: 15px;
        color: var(--st-gray);
        line-height: 1.7;
    }

    .sp-cookie__id {
        font-size: 13px;
        font-weight: 700;
        color: var(--st-black);
    }

    /* Info box */
    .sp-infobox {
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

    /* ─── FOOTER NOTE ─── */
    .sp-footnote {
        background: var(--st-white);
        border-top: 1px solid var(--st-border);
        padding: 2rem 0;
        text-align: center;
    }

    .sp-footnote p {
        font-size: 13px;
        color: var(--st-gray);
        max-width: 640px;
        margin: 0 auto .4rem;
    }

    .sp-footnote p:last-child {
        margin-bottom: 0;
    }

    .sp-footnote strong {
        color: var(--st-black);
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 600px) {
        .sp-clause {
            grid-template-columns: 24px 1fr;
            font-size: 14px;
        }

        .sp-list li {
            font-size: 14px;
        }

        .sp-section__title {
            font-size: 16px;
        }

        .sp-rights {
            grid-template-columns: 1fr;
        }
    }
</style>

<main class="sp-page">

    <!-- ══ HERO ══ -->
    <section class="sp-hero">
        <div class="sp-wrap">
            <p class="sp-hero__eyebrow">Juridisk dokument</p>
            <h1 class="sp-hero__title">Privatlivspolitik for Salbæk Technology Group</h1>
            <p class="sp-hero__sub">
                Spørgsmål vedrørende denne politik kan rettes til <a
                    href="mailto:support@sal-tech.com">support@sal-tech.com</a>.<br>
                Denne politik gælder for online aktiviteter på sal-tech.dk, .com, .es og .de.
            </p>
        </div>
    </section>

    <!-- ══ ENTITIES ══ -->
    <div class="sp-entities">
        <div class="sp-wrap">
            <p class="sp-entities__head">Dækkede enheder — Salbæk Technology Group</p>
            <div class="sp-entities__grid">
                <div class="sp-entity">
                    <div class="sp-entity__num">1.</div>
                    <div class="sp-entity__name">Sal-Tech Easy Packaging v/G. Salbæk</div>
                    <div class="sp-entity__detail">CVR Nr. DK 18429098 — Sønderborg, Danmark</div>
                </div>
                <div class="sp-entity">
                    <div class="sp-entity__num">2.</div>
                    <div class="sp-entity__name">Sal-Tech HKG Limited</div>
                    <div class="sp-entity__detail">Reg. Nr. HK 1553382 — Hong Kong</div>
                </div>
                <div class="sp-entity">
                    <div class="sp-entity__num">3.</div>
                    <div class="sp-entity__name">Sal-Tech Embalaje SL</div>
                    <div class="sp-entity__detail">CIF Nr. B01970045 — Málaga, Spanien</div>
                </div>
                <div class="sp-entity">
                    <div class="sp-entity__num">4.</div>
                    <div class="sp-entity__name">Sal-Tech Easy Packaging LLC</div>
                    <div class="sp-entity__detail">Reg. nr. 35-2776554 — Chicago, U.S.A.</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══ TABLE OF CONTENTS ══ -->
    <nav class="sp-toc" aria-label="Indholdsfortegnelse">
        <div class="sp-wrap">
            <p class="sp-toc__head">Indholdsfortegnelse</p>
            <ul class="sp-toc__list">
                <li><a href="#sp-s1">Samtykke</a></li>
                <li><a href="#sp-s2">Oplysninger vi indsamler</a></li>
                <li><a href="#sp-s3">Hvordan vi bruger dine oplysninger</a></li>
                <li><a href="#sp-s4">Overførsel af data</a></li>
                <li><a href="#sp-s5">Videregivelse af data</a></li>
                <li><a href="#sp-s6">Sikkerhed af data</a></li>
                <li><a href="#sp-s7">Logfiler</a></li>
                <li><a href="#sp-s8">Cookies og web-beacons</a></li>
                <li><a href="#sp-s9">Annonceringspartnere</a></li>
                <li><a href="#sp-s10">Tredjeparters privatlivspolitikker</a></li>
                <li><a href="#sp-s11">GDPR-rettigheder</a></li>
                <li><a href="#sp-s12">Opbevaringsperiode</a></li>
                <li><a href="#sp-s13">Ændringer i denne politik</a></li>
                <li><a href="#sp-s14">Adskillelighed</a></li>
                <li><a href="#sp-s15">Jurisdiktion</a></li>
                <li><a href="#sp-s16">Børns information</a></li>
            </ul>
        </div>
    </nav>

    <!-- ══ DOCUMENT BODY ══ -->
    <div class="sp-content">
        <div class="sp-wrap">

            <!-- Samtykke -->
            <section class="sp-section" id="sp-s1">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Samtykke</h2>
                </div>
                <p class="sp-body">
                    Vi bruger dine data til at levere og forbedre vores tjenester. Ved at bruge vores hjemmeside giver
                    du hermed samtykke til vores privatlivspolitik og accepterer dens vilkår.
                </p>
            </section>

            <!-- Oplysninger vi indsamler -->
            <section class="sp-section" id="sp-s2">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Oplysninger vi indsamler</h2>
                </div>
                <p class="sp-body">
                    De personlige oplysninger, som du bliver bedt om at give, og årsagerne hertil, vil blive gjort klart
                    for dig på det tidspunkt, hvor vi anmoder om dem. Dette kan omfatte, men er ikke begrænset til:
                </p>
                <ul class="sp-list">
                    <li>E-mailadresse</li>
                    <li>Fornavn og efternavn</li>
                    <li>Telefonnummer</li>
                    <li>Adresse, stat, provins, postnummer og by</li>
                </ul>
                <p class="sp-body">
                    Hvis du kontakter os direkte, kan vi modtage yderligere oplysninger om dig — herunder navn,
                    e-mailadresse, telefonnummer, indholdet af beskeden og/eller vedhæftede filer, samt enhver anden
                    information du måtte vælge at give.
                </p>
                <div class="sp-infobox">
                    <strong>Betalingsdata:</strong> Vi gemmer aldrig dine betalingsoplysninger (kreditkort,
                    betalingskort osv.) uden dit samtykke. Hvis du benytter en sikret tredjepartsbetalingsgateway som
                    PayPal eller Skrill, er vi fritaget for ethvert ansvar i forbindelse med denne betaling og data gemt
                    af den pågældende gateway.
                </div>
            </section>

            <!-- Hvordan vi bruger dine oplysninger -->
            <section class="sp-section" id="sp-s3">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Hvordan vi bruger dine oplysninger</h2>
                </div>
                <p class="sp-body">Vi bruger de oplysninger, vi indsamler, på følgende måder:</p>
                <ul class="sp-list">
                    <li>Levere, drive og vedligeholde vores hjemmeside</li>
                    <li>Forbedre, personliggøre og udvide vores hjemmeside</li>
                    <li>Forstå og analysere, hvordan du bruger vores hjemmeside</li>
                    <li>Udvikle nye produkter, tjenester, funktioner og funktionalitet</li>
                    <li>Kommunikere med dig, enten direkte eller via en af vores partnere — herunder til kundeservice,
                        opdateringer og markedsføring</li>
                    <li>Sende dig e-mails</li>
                    <li>Finde og forebygge svindel</li>
                </ul>
            </section>

            <!-- Overførsel af data -->
            <section class="sp-section" id="sp-s4">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Overførsel af data</h2>
                </div>
                <ul class="sp-clauses">
                    <li class="sp-clause">
                        <span class="sp-clause__id">a.</span>
                        <span>Dine oplysninger, herunder personlige data, kan overføres til og vedligeholdes på
                            computere placeret uden for din stat, provins, land eller statslig jurisdiktion, hvor
                            databeskyttelseslovene kan afvige.</span>
                    </li>
                    <li class="sp-clause">
                        <span class="sp-clause__id">b.</span>
                        <span>Hvis du befinder dig uden for Danmark og vælger at give os oplysninger, bedes du bemærke,
                            at vi overfører data til det pågældende land og kan behandle dem der.</span>
                    </li>
                    <li class="sp-clause">
                        <span class="sp-clause__id">c.</span>
                        <span>Dit samtykke til denne fortrolighedspolitik, efterfulgt af din indsendelse af sådanne
                            oplysninger, repræsenterer din accept af denne overførsel.</span>
                    </li>
                    <li class="sp-clause">
                        <span class="sp-clause__id">d.</span>
                        <span>Sal-Tech vil tage alle nødvendige skridt for at sikre, at dine data behandles sikkert og i
                            overensstemmelse med denne politik. Ingen overførsel af personlige data vil finde sted til
                            en organisation eller et land, medmindre der er tilstrækkelig kontrol på plads.</span>
                    </li>
                </ul>
            </section>

            <!-- Videregivelse af data -->
            <section class="sp-section" id="sp-s5">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Videregivelse af data</h2>
                </div>
                <p class="sp-body">Sal-Tech kan videregive dine personoplysninger i god tro, hvis det er nødvendigt:</p>
                <ul class="sp-clauses">
                    <li class="sp-clause"><span class="sp-clause__id">a.</span><span>For at overholde en juridisk
                            forpligtelse</span></li>
                    <li class="sp-clause"><span class="sp-clause__id">b.</span><span>For at beskytte og forsvare
                            Sal-Techs rettigheder eller ejendom</span></li>
                    <li class="sp-clause"><span class="sp-clause__id">c.</span><span>For at forhindre eller undersøge
                            mulige forseelser i forbindelse med tjenesten</span></li>
                    <li class="sp-clause"><span class="sp-clause__id">d.</span><span>For at beskytte den personlige
                            sikkerhed for brugere af tjenesten eller offentligheden</span></li>
                    <li class="sp-clause"><span class="sp-clause__id">e.</span><span>For at beskytte mod juridisk
                            ansvar</span></li>
                </ul>
            </section>

            <!-- Sikkerhed -->
            <section class="sp-section" id="sp-s6">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Sikkerhed af data</h2>
                </div>
                <ul class="sp-clauses">
                    <li class="sp-clause">
                        <span class="sp-clause__id">a.</span>
                        <span>Sikkerheden af dine data er vigtig for os. Ingen metode til transmission over internettet
                            eller elektronisk lagring er dog 100% sikker. Selvom vi bestræber os på at bruge kommercielt
                            acceptable midler til at beskytte dine personlige data, kan vi ikke garantere absolut
                            sikkerhed.</span>
                    </li>
                    <li class="sp-clause">
                        <span class="sp-clause__id">b.</span>
                        <span>I tilfælde af et tredjepartshack eller krænkelse af fortrolighedsbestemmelser fra
                            tredjeparter i forhold til dine personlige data, der er gemt på vores servere, vil vi
                            informere dig herom hurtigst muligt.</span>
                    </li>
                </ul>
            </section>

            <!-- Logfiler -->
            <section class="sp-section" id="sp-s7">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Logfiler</h2>
                </div>
                <p class="sp-body">
                    Sal-Tech følger standardproceduren for brug af logfiler. Disse filer registrerer besøgende, når de
                    besøger hjemmesider. Oplysninger indsamlet via logfiler omfatter IP-adresser, browsertype,
                    internetudbyder (ISP), dato- og tidsstempel, henvisnings-/afslutningssider og muligvis antallet af
                    klik. Disse data er ikke knyttet til personligt identificerbare oplysninger og anvendes til at
                    analysere tendenser, administrere hjemmesiden, spore brugernes bevægelser og indsamle demografiske
                    oplysninger.
                </p>
            </section>

            <!-- Cookies -->
            <section class="sp-section" id="sp-s8">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Cookies og web-beacons</h2>
                </div>
                <p class="sp-body">
                    Som enhver anden hjemmeside anvender sal-tech.com cookies. Cookies er filer med en lille mængde
                    data, som kan indeholde en anonym unik identifikator. De sendes til din browser fra en hjemmeside og
                    gemmes på din enhed med det formål at huske præferencer og besøgte sider.
                </p>
                <p class="sp-body">
                    Sporingsteknologier — herunder beacons, tags og scripts — bruges ligeledes til at optimere
                    brugeroplevelsen. Du kan instruere din browser til at afvise alle cookies, men visse dele af vores
                    service kan muligvis ikke fungere korrekt herefter.
                </p>
                <p class="sp-body">Eksempler på cookies vi anvender:</p>
                <ul class="sp-cookies">
                    <li class="sp-cookie"><span class="sp-cookie__id">a.</span><span><strong>Sessionscookies:</strong>
                            Anvendes til at drive vores tjeneste.</span></li>
                    <li class="sp-cookie"><span class="sp-cookie__id">b.</span><span><strong>Præferencecookies:</strong>
                            Anvendes til at huske dine præferencer og indstillinger.</span></li>
                    <li class="sp-cookie"><span class="sp-cookie__id">c.</span><span><strong>Sikkerhedscookies:</strong>
                            Anvendes til sikkerhedsformål.</span></li>
                </ul>
            </section>

            <!-- Annonceringspartnere -->
            <section class="sp-section" id="sp-s9">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Annonceringspartneres privatlivspolitikker</h2>
                </div>
                <p class="sp-body">
                    Tredjeparts annonceservere eller annoncenetværk kan anvende teknologier som cookies, JavaScript
                    eller web-beacons i annoncer og links vist på sal-tech.com. De modtager automatisk din IP-adresse,
                    når dette sker. Disse teknologier bruges til at måle effektiviteten af reklamekampagner og/eller
                    tilpasse det reklameindhold, du ser.
                </p>
                <p class="sp-body">
                    Sal-Tech har ingen adgang til eller kontrol over de cookies, der anvendes af tredjeparts annoncører.
                </p>
            </section>

            <!-- Tredjeparter -->
            <section class="sp-section" id="sp-s10">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Tredjeparters privatlivspolitikker</h2>
                </div>
                <p class="sp-body">
                    Sal-tech.com's privatlivspolitik gælder ikke for andre annoncører eller hjemmesider. Vi råder dig
                    til at konsultere de respektive privatlivspolitikker for tredjeparts annonceservere for mere
                    detaljerede oplysninger, herunder praksis og vejledning om at fravælge visse muligheder.
                </p>
                <p class="sp-body">
                    Du kan deaktivere cookies via dine individuelle browserindstillinger. Detaljeret vejledning herom
                    kan findes på de respektive browseres hjemmesider.
                </p>
            </section>

            <!-- GDPR -->
            <section class="sp-section" id="sp-s11">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">GDPR — Databeskyttelsesrettigheder</h2>
                </div>
                <p class="sp-body">Vi vil gerne sikre os, at du er fuldt ud klar over alle dine
                    databeskyttelsesrettigheder. Enhver bruger er berettiget til følgende:</p>
                <div class="sp-rights">
                    <div class="sp-right">
                        <div class="sp-right__title">Ret til indsigt</div>
                        <div class="sp-right__body">Du har ret til at anmode om kopier af dine personoplysninger. Et
                            mindre gebyr kan opkræves for denne service.</div>
                    </div>
                    <div class="sp-right">
                        <div class="sp-right__title">Ret til berigtigelse</div>
                        <div class="sp-right__body">Du har ret til at anmode om rettelse af unøjagtige eller
                            ufuldstændige oplysninger.</div>
                    </div>
                    <div class="sp-right">
                        <div class="sp-right__title">Ret til sletning</div>
                        <div class="sp-right__body">Du har ret til at anmode om sletning af dine personoplysninger under
                            visse betingelser.</div>
                    </div>
                    <div class="sp-right">
                        <div class="sp-right__title">Ret til begrænsning</div>
                        <div class="sp-right__body">Du har ret til at anmode om begrænsning af behandlingen af dine
                            personoplysninger under visse betingelser.</div>
                    </div>
                    <div class="sp-right">
                        <div class="sp-right__title">Ret til indsigelse</div>
                        <div class="sp-right__body">Du har ret til at gøre indsigelse mod vores behandling af dine
                            personoplysninger under visse betingelser.</div>
                    </div>
                    <div class="sp-right">
                        <div class="sp-right__title">Ret til dataportabilitet</div>
                        <div class="sp-right__body">Du har ret til at anmode om overførsel af dine data til en anden
                            organisation eller direkte til dig under visse betingelser.</div>
                    </div>
                </div>
                <div class="sp-infobox" style="margin-top:1.5rem;">
                    Hvis du fremsætter en anmodning, har vi <strong>én måned</strong> til at svare. Kontakt os venligst
                    på <a href="mailto:support@sal-tech.com"
                        style="color:inherit;font-weight:600;">support@sal-tech.com</a> for at udøve dine rettigheder.
                </div>
            </section>

            <!-- Opbevaringsperiode -->
            <section class="sp-section" id="sp-s12">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Opbevaringsperiode for personoplysninger</h2>
                </div>
                <p class="sp-body">Medmindre andet er angivet, opbevarer vi kun dine personlige data, så længe det er
                    nødvendigt:</p>
                <ul class="sp-list">
                    <li>For at levere de tjenester, du har anmodet om</li>
                    <li>For at overholde gældende love, herunder skattemyndigheders krav</li>
                    <li>For at støtte et krav eller forsvar i retten</li>
                </ul>
            </section>

            <!-- Ændringer -->
            <section class="sp-section" id="sp-s13">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Ændringer i denne politik</h2>
                </div>
                <ul class="sp-clauses">
                    <li class="sp-clause"><span class="sp-clause__id">a.</span><span>Vi kan opdatere vores
                            privatlivspolitik fra tid til anden. Vi vil underrette dig om eventuelle ændringer ved at
                            offentliggøre den nye privatlivspolitik på denne side.</span></li>
                    <li class="sp-clause"><span class="sp-clause__id">b.</span><span>Du vil modtage besked via e-mail
                            og/eller en fremtrædende meddelelse på vores tjeneste, inden ændringen træder i kraft, og
                            ikrafttrædelsesdatoen vil blive opdateret øverst i politikken.</span></li>
                    <li class="sp-clause"><span class="sp-clause__id">c.</span><span>Vi råder dig til at gennemgå denne
                            politik med jævne mellemrum for at holde dig opdateret.</span></li>
                    <li class="sp-clause"><span class="sp-clause__id">d.</span><span>Ændringer til denne
                            privatlivspolitik træder i kraft, når de offentliggøres på denne side.</span></li>
                </ul>
            </section>

            <!-- Adskillelighed -->
            <section class="sp-section" id="sp-s14">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Adskillelighed</h2>
                </div>
                <ul class="sp-clauses">
                    <li class="sp-clause">
                        <span class="sp-clause__id">a.</span>
                        <span>Hvis en eller flere bestemmelser i Sal-Techs vilkår og betingelser er ugyldige og/eller
                            ikke kan håndhæves, forbliver de resterende bestemmelsers gyldighed i dette dokument
                            ubesværet.</span>
                    </li>
                </ul>
            </section>

            <!-- Jurisdiktion -->
            <section class="sp-section" id="sp-s15">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Jurisdiktion</h2>
                </div>
                <p class="sp-body">
                    Retten i Sønderborg, Danmark har ikke-eksklusiv jurisdiktion til at pådømme enhver tvist, der opstår
                    i henhold til eller i forbindelse med aftalen, medmindre andet er aftalt af parterne skriftligt.
                </p>
            </section>

            <!-- Børns information -->
            <section class="sp-section" id="sp-s16">
                <div class="sp-section__header">
                    <h2 class="sp-section__title">Børns information</h2>
                </div>
                <p class="sp-body">
                    En af vores prioriteter er at beskytte børn, mens de bruger internettet. Vi opfordrer forældre og
                    værger til at observere, deltage i og/eller overvåge og guide deres børns onlineaktivitet.
                </p>
                <p class="sp-body">
                    Sal-tech.com, .es, .de og .dk indsamler ikke bevidst nogen personlig identificerbar information fra
                    børn under 13 år. Hvis du mener, at dit barn har givet denne type information på vores hjemmeside,
                    opfordrer vi dig til at kontakte os straks, så vi kan fjerne sådanne oplysninger fra vores registre.
                </p>
                <div class="sp-infobox">
                    Kontakt os på <a href="mailto:support@sal-tech.com"
                        style="color:inherit;font-weight:600;">support@sal-tech.com</a> ved mistanke om, at et barn
                    under 13 år har afgivet personoplysninger på vores hjemmeside.
                </div>
            </section>

        </div>
    </div>

    <!-- ══ FOOTER NOTE ══ -->
    <div class="sp-footnote">
        <div class="sp-wrap">
            <p><strong>Salbæk Technology Group — Privatlivspolitik</strong></p>
            <p>Gælder for: sal-tech.dk &nbsp;|&nbsp; sal-tech.com &nbsp;|&nbsp; sal-tech.es &nbsp;|&nbsp; sal-tech.de
            </p>
            <p>Spørgsmål: <a href="mailto:support@sal-tech.com">support@sal-tech.com</a></p>
        </div>
    </div>

</main>

<?php get_footer(); ?>