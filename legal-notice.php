<?php
/**
 * Template Name: Legal Notice
 *
 * Custom page template for the Sal-Tech "Legal Notice" page.
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

    .sl-page {
        font-family: var(--ff);
        color: var(--st-black);
        background: var(--st-white);
        line-height: 1.7;
        overflow-x: hidden;
        font-size: 16px;
    }

    .sl-page *,
    .sl-page *::before,
    .sl-page *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .sl-page a {
        color: var(--st-red);
        text-decoration: none;
    }

    .sl-page a:hover {
        color: var(--st-red-h);
        text-decoration: underline;
    }

    .sl-wrap {
        max-width: var(--st-max);
        margin: 0 auto;
        padding: 0 clamp(1.25rem, 4vw, 2.5rem);
    }

    /* ─── HERO ─── */
    .sl-hero {
        background: var(--st-light);
        color: var(--st-black);
        padding: clamp(2rem, 8vw, 1rem) 0 clamp(1.5rem, 6vw, 2rem);
        border-bottom: 3px solid var(--st-red);
    }

    .sl-hero__eyebrow {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: var(--st-red);
        margin-bottom: .65rem;
    }

    .sl-hero__title {
        font-size: clamp(22px, 4vw, 34px);
        font-weight: 700;
        line-height: 1.15;
        color: var(--st-black);
        margin-bottom: .75rem;
    }

    .sl-hero__meta {
        font-size: 13px;
        color: #9CA3AF;
        display: flex;
        flex-wrap: wrap;
        gap: .4rem 1.5rem;
    }

    .sl-hero__meta span {
        display: flex;
        align-items: center;
        gap: .4rem;
    }

    .sl-hero__meta strong {
        color: #D1D5DB;
    }

    /* ─── ENTITIES ─── */
    .sl-entities {
        background: var(--st-white);
        border-bottom: 1px solid var(--st-border);
        padding: 2rem 0;
    }

    .sl-entities__head {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: var(--st-gray);
        margin-bottom: 1rem;
    }

    .sl-entities__grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: .75rem;
    }

    .sl-entity {
        background: var(--st-white);
        border: 1px solid var(--st-border);
        border-radius: var(--st-radius);
        padding: .85rem 1.1rem;
    }

    .sl-entity__num {
        font-size: 11px;
        font-weight: 700;
        color: var(--st-red);
        letter-spacing: .08em;
        margin-bottom: .25rem;
    }

    .sl-entity__name {
        font-size: 13px;
        font-weight: 600;
        color: var(--st-black);
        margin-bottom: .15rem;
    }

    .sl-entity__detail {
        font-size: 12px;
        color: var(--st-gray);
    }

    /* ─── TABLE OF CONTENTS ─── */
    .sl-toc {
        padding: 2rem 0;
        background: var(--st-light);
        border-bottom: 1px solid var(--st-border);
    }

    .sl-toc__head {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .12em;
        color: var(--st-gray);
        margin-bottom: 1rem;
    }

    .sl-toc__list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: .3rem .75rem;
        list-style: none;
    }

    .sl-toc__list li a {
        font-size: 13px;
        color: var(--st-gray);
        display: flex;
        align-items: baseline;
        gap: .45rem;
        padding: .22rem 0;
        transition: color .15s;
        text-decoration: none;
    }

    .sl-toc__list li a:hover {
        color: var(--st-red);
        text-decoration: none;
    }

    .sl-toc__list li a span {
        font-size: 11px;
        font-weight: 700;
        color: var(--st-red);
        flex-shrink: 0;
        min-width: 20px;
    }

    /* ─── DOCUMENT BODY ─── */
    .sl-content {
        padding: var(--st-gap) 0 clamp(4rem, 8vw, 7rem);
        background: var(--st-white);
    }

    .sl-section {
        padding-bottom: 2.75rem;
        margin-bottom: 2.75rem;
        border-bottom: 1px solid var(--st-border);
        scroll-margin-top: 1.5rem;
    }

    .sl-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .sl-section__header {
        display: flex;
        align-items: baseline;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }

    .sl-section__num {
        font-size: 12px;
        font-weight: 700;
        color: var(--st-red);
        letter-spacing: .1em;
        text-transform: uppercase;
        min-width: 36px;
        flex-shrink: 0;
    }

    .sl-section__title {
        font-size: 18px;
        font-weight: 700;
        color: var(--st-black);
        line-height: 1.2;
    }

    /* Clauses */
    .sl-clauses {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: .9rem;
    }

    .sl-clause {
        display: grid;
        grid-template-columns: 42px 1fr;
        gap: .5rem;
        align-items: baseline;
        font-size: 15px;
        color: var(--st-gray);
        line-height: 1.78;
    }

    .sl-clause__id {
        font-size: 13px;
        font-weight: 700;
        color: var(--st-black);
        flex-shrink: 0;
        padding-top: .05em;
    }

    /* Sub-clauses (4.3.x) */
    .sl-subclauses {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: .65rem;
        margin-top: .75rem;
        padding-left: 1rem;
        border-left: 2px solid var(--st-border);
    }

    .sl-subclause {
        display: grid;
        grid-template-columns: 52px 1fr;
        gap: .5rem;
        align-items: baseline;
        font-size: 14px;
        color: var(--st-gray);
        line-height: 1.7;
    }

    .sl-subclause__id {
        font-size: 12px;
        font-weight: 700;
        color: var(--st-gray);
    }

    /* Prohibition list (visual callout) */
    .sl-prohibitions {
        display: flex;
        flex-direction: column;
        gap: .6rem;
        margin-top: .85rem;
    }

    .sl-prohibition {
        display: flex;
        align-items: baseline;
        gap: .75rem;
        background: var(--st-light);
        border: 1px solid var(--st-border);
        border-left: 3px solid var(--st-red);
        border-radius: var(--st-radius);
        padding: .8rem 1rem;
        font-size: 14px;
        color: var(--st-gray);
        line-height: 1.65;
    }

    .sl-prohibition__id {
        font-size: 12px;
        font-weight: 700;
        color: var(--st-red);
        flex-shrink: 0;
        min-width: 38px;
    }

    /* Info box */
    .sl-infobox {
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

    /* Jurisdiction table */
    .sl-jur-list {
        display: flex;
        flex-direction: column;
        gap: .5rem;
        margin-top: .75rem;
    }

    .sl-jur-item {
        font-size: 14px;
        color: var(--st-gray);
        line-height: 1.65;
        padding: .6rem 1rem;
        background: var(--st-light);
        border-radius: 6px;
        border: 1px solid var(--st-border);
    }

    .sl-jur-item strong {
        color: var(--st-black);
        font-weight: 600;
    }

    /* ─── FOOTER NOTE ─── */
    .sl-footnote {
        background: var(--st-white);
        border-top: 1px solid var(--st-border);
        padding: 2rem 0;
        text-align: center;
    }

    .sl-footnote p {
        font-size: 13px;
        color: var(--st-gray);
        max-width: 640px;
        margin: 0 auto .4rem;
    }

    .sl-footnote strong {
        color: var(--st-black);
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 600px) {
        .sl-clause {
            grid-template-columns: 36px 1fr;
            font-size: 14px;
        }

        .sl-subclause {
            grid-template-columns: 44px 1fr;
        }

        .sl-section__title {
            font-size: 16px;
        }

        .sl-hero__meta {
            flex-direction: column;
            gap: .3rem;
        }
    }
</style>

<main class="sl-page">

    <!-- ══ HERO ══ -->
    <section class="sl-hero">
        <div class="sl-wrap">
            <p class="sl-hero__eyebrow">Juridisk dokument</p>
            <h1 class="sl-hero__title">Retlig Meddelelse<br>Salbæk Technology Group</h1>
            <div class="sl-hero__meta">
                <span><strong>Udarbejdet af:</strong> RCL</span>
                <span><strong>Godkendt af:</strong> GUS</span>
                <span><strong>Dato:</strong> 13.02.2024</span>
            </div>
        </div>
    </section>

    <!-- ══ ENTITIES ══ -->
    <div class="sl-entities">
        <div class="sl-wrap">
            <p class="sl-entities__head">Salbæk Technology Group — Dækkede enheder</p>
            <div class="sl-entities__grid">
                <div class="sl-entity">
                    <div class="sl-entity__num">DK</div>
                    <div class="sl-entity__name">Sal-Tech Easy Packaging v/G. Salbæk</div>
                    <div class="sl-entity__detail">CVR Nr. DK 18429098</div>
                </div>
                <div class="sl-entity">
                    <div class="sl-entity__num">HK</div>
                    <div class="sl-entity__name">Sal-Tech HKG Limited</div>
                    <div class="sl-entity__detail">Registreringsnr. HK 1553382</div>
                </div>
                <div class="sl-entity">
                    <div class="sl-entity__num">ES</div>
                    <div class="sl-entity__name">Sal-Tech Embalaje SL</div>
                    <div class="sl-entity__detail">CIF Nr. B01970045</div>
                </div>
                <div class="sl-entity">
                    <div class="sl-entity__num">USA</div>
                    <div class="sl-entity__name">Sal-Tech Easy Packaging LLC</div>
                    <div class="sl-entity__detail">Reg. nr. 35-2776554</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══ TABLE OF CONTENTS ══ -->
    <nav class="sl-toc" aria-label="Indholdsfortegnelse">
        <div class="sl-wrap">
            <p class="sl-toc__head">Indholdsfortegnelse</p>
            <ul class="sl-toc__list">
                <li><a href="#sl-s1"><span>1.</span> Generelt</a></li>
                <li><a href="#sl-s2"><span>2.</span> Betingelser for adgang og brug</a></li>
                <li><a href="#sl-s3"><span>3.</span> Uautoriseret brug</a></li>
                <li><a href="#sl-s4"><span>4.</span> Intellektuel ejendomsret</a></li>
                <li><a href="#sl-s5"><span>5.</span> Fortrolige oplysninger</a></li>
                <li><a href="#sl-s6"><span>6.</span> Søveriabilitet</a></li>
                <li><a href="#sl-s7"><span>7.</span> Jurisdiktion</a></li>
                <li><a href="#sl-s8"><span>8.</span> Klager</a></li>
            </ul>
        </div>
    </nav>

    <!-- ══ DOCUMENT BODY ══ -->
    <div class="sl-content">
        <div class="sl-wrap">

            <!-- 1. Generelt -->
            <section class="sl-section" id="sl-s1">
                <div class="sl-section__header">
                    <span class="sl-section__num"> 1</span>
                    <h2 class="sl-section__title">Generelt</h2>
                </div>
                <ul class="sl-clauses">
                    <li class="sl-clause">
                        <span class="sl-clause__id">1.1</span>
                        <span>Hos Salbæk Technology Group (herefter "Sal-Tech", "vi", "os"), via sine websteder
                            sal-tech.dk, .com, .es og .de, gives BRUGEREN ("du") oplysninger om sine tjenester og
                            aktiviteter. Sal-Tech omfatter alle selskaber, datterselskaber eller filialer inden for
                            Salbæk Technology Group som angivet ovenfor.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">1.2</span>
                        <span>Disse generelle betingelser i denne juridiske meddelelse er udelukkende beregnet til at
                            regulere din brug af Sal-Tech's websted og alle relaterede websteder, der ejes af Sal-Tech
                            Easy Packaging. Disse juridiske betingelser dikterer brugen af Sal-Tech's hjemmesider, og du
                            forventes at læse og acceptere brugsbetingelserne.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">1.3</span>
                        <span>Adgang til og brug af dette websted forudsætter din fuldstændige og ubetingede accept af
                            og gyldigheden af hvert enkelt af de juridiske vilkår og betingelser, der er anført
                            heri.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">1.4</span>
                        <span>Du forpligter dig til ikke at bruge webstedet og dets tjenester til at udføre aktiviteter,
                            der er i strid med loven, eller til andre uautoriserede formål, der ikke er anført
                            heri.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">1.5</span>
                        <span>Du rådes til regelmæssigt at kontrollere eventuelle opdateringer af vilkårene og
                            betingelserne for ændringer eller tilføjelser.</span>
                    </li>
                </ul>
            </section>

            <!-- 2. Adgang og brug -->
            <section class="sl-section" id="sl-s2">
                <div class="sl-section__header">
                    <span class="sl-section__num"> 2</span>
                    <h2 class="sl-section__title">Betingelser for adgang og brug</h2>
                </div>
                <ul class="sl-clauses">
                    <li class="sl-clause">
                        <span class="sl-clause__id">2.1</span>
                        <span>Begrænset ansvar for Sal-Tech: Du som bruger forstår og accepterer fuldt ud, at når du
                            bruger vores websted, gør du det efter eget skøn og på egen risiko. Vi er på ingen måde
                            ansvarlige for, at hjemmesiden på et tidspunkt er utilgængelig som følge af vedligeholdelse
                            eller andre formål. Vi forbeholder os ret til at foretage ændringer i indholdet, priserne og
                            andre aspekter af hensyn til ændringer.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">2.2</span>
                        <span>Garanti: Sal-Tech kan ikke holdes juridisk ansvarlig for indhold på vores hjemmeside, som
                            kan krænke tredjemands rettigheder, uden at vi i god tro er klar over, at denne krænkelse
                            har fundet sted. Vi kan ikke holdes ansvarlige for eventuelle skader forårsaget af
                            unøjagtigheder eller fejl i indholdet på vores websted.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">2.3</span>
                        <span>Brugen af Sal-Tech's websted forpligter dig ikke til at tilmelde dig nyhedsbreve,
                            abonnementer eller købe produkter/tjenester. Ønsker du at gøre dette, skal du udfylde en
                            simpel formular og acceptere de generelle vilkår og betingelser heri.</span>
                    </li>
                </ul>
            </section>

            <!-- 3. Uautoriseret brug -->
            <section class="sl-section" id="sl-s3">
                <div class="sl-section__header">
                    <span class="sl-section__num"> 3</span>
                    <h2 class="sl-section__title">Uautoriseret brug af Sal-Tech's websted</h2>
                </div>
                <ul class="sl-clauses">
                    <li class="sl-clause">
                        <span class="sl-clause__id">3.1</span>
                        <span>Enhver brug af hjemmesiden, der ikke er beregnet til køb af vores produkter eller
                            tjenester, udgør uautoriseret og ulovlig brug, hvilket gør dig skyldig i en lovbestemt
                            og/eller strafferetlig overtrædelse og/eller ansvarlig for civilretlige skader.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">3.2</span>
                        <span>Det er forbudt at sende massive e-mails (spamming) og sende overdimensionerede
                            meddelelser, der forårsager blokering af netværksservere (mail bombing).</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">3.3</span>
                        <span>Adgangs- og brugsbetingelserne for dette websted er strengt reguleret af gældende
                            lovgivning og princippet om god tro. Enhver handling i strid med loven — herunder krænkelse
                            af tredjeparters ret til privatlivets fred, databeskyttelse og intellektuel ejendomsret — er
                            fuldstændig forbudt.</span>
                    </li>
                </ul>
            </section>

            <!-- 4. Intellektuel ejendomsret -->
            <section class="sl-section" id="sl-s4">
                <div class="sl-section__header">
                    <span class="sl-section__num"> 4</span>
                    <h2 class="sl-section__title">Intellektuel ejendomsret</h2>
                </div>
                <ul class="sl-clauses">
                    <li class="sl-clause">
                        <span class="sl-clause__id">4.1</span>
                        <span>Alle intellektuelle ejendomsrettigheder er forbeholdt Sal-Tech, herunder men ikke
                            begrænset til ophavsret, patenter, tekster, varemærker, illustrationer, fotos, grafik,
                            filer, design og arrangementer.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">4.2</span>
                        <span>Sal-Tech's hjemmeside er beskyttet af ophavsret og alt indhold heri. Hjemmesidernes
                            indhold, programmering og design er fuldt ud ophavsretligt beskyttet. Reproduktioner,
                            distributioner eller transformationer, der kan krænke vores intellektuelle ejendomsret, er
                            forbudt.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">4.3</span>
                        <span>Du accepterer udtrykkeligt, at du ikke må:</span>
                    </li>
                </ul>

                <!-- Prohibition list -->
                <div class="sl-prohibitions">
                    <div class="sl-prohibition">
                        <span class="sl-prohibition__id">4.3.1</span>
                        <span>Reproducere eller bruge Sal-Tech's intellektuelle ejendom — enten i trykt eller
                            elektronisk form — i strid med vores intellektuelle ejendomsrettigheder eller tilknyttede
                            tredjeparters rettigheder.</span>
                    </div>
                    <div class="sl-prohibition">
                        <span class="sl-prohibition__id">4.3.2</span>
                        <span>Kommercielt at udnytte, reproducere, distribuere, overføre, vise, offentliggøre eller
                            udsende nogen intellektuel ejendom på webstedet uden vores forudgående skriftlige samtykke
                            eller, i tilfælde af tredjepartsindhold, rettighedshaveren af den pågældende intellektuelle
                            ejendom.</span>
                    </div>
                    <div class="sl-prohibition">
                        <span class="sl-prohibition__id">4.3.3</span>
                        <span>Gøre krav på ejerskab af intellektuel ejendom på webstedet, hverken helt eller
                            delvist.</span>
                    </div>
                    <div class="sl-prohibition">
                        <span class="sl-prohibition__id">4.3.4</span>
                        <span>Ændre webstedsindholdet med henblik på at genindsætte det på andre websteder.</span>
                    </div>
                    <div class="sl-prohibition">
                        <span class="sl-prohibition__id">4.3.5</span>
                        <span>Ændre eller fjerne varemærker eller ophavsrettigheder fra webstedsindholdet.</span>
                    </div>
                    <div class="sl-prohibition">
                        <span class="sl-prohibition__id">4.3.6</span>
                        <span>Kopiere, lagre eller på anden måde indarbejde webstedsindhold eller intellektuelle
                            ejendomsrettigheder i et andet websted, et elektronisk genindvindingssystem, en publikation
                            eller lignende.</span>
                    </div>
                </div>

                <ul class="sl-clauses" style="margin-top:1.25rem;">
                    <li class="sl-clause">
                        <span class="sl-clause__id">4.4</span>
                        <span>Sal-Tech er et registreret varemærke. Ekstern brug af Sal-Tech's navn og logo er
                            fuldstændig forbudt, medmindre Sal-Tech udtrykkeligt tillader dette. Alle rettigheder
                            forbeholdes.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">4.5</span>
                        <span>Køberen af Sal-Tech's produkter opnår ingen rettigheder i form af licens, patent,
                            ophavsret, varemærke eller anden intellektuel ejendomsret i forbindelse med det pågældende
                            produkt. Køberen opnår ingen rettigheder til softwarens kildekode.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">4.6</span>
                        <span>Leverede manualer og tegninger må ikke kopieres eller distribueres uden vores skriftlige
                            samtykke.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">4.7</span>
                        <span>Oversættelser er altid Sal-Tech's ejendom og ophavsretligt beskyttet.</span>
                    </li>
                </ul>
            </section>

            <!-- 5. Fortrolige oplysninger -->
            <section class="sl-section" id="sl-s5">
                <div class="sl-section__header">
                    <span class="sl-section__num"> 5</span>
                    <h2 class="sl-section__title">Fortrolige oplysninger</h2>
                </div>
                <ul class="sl-clauses">
                    <li class="sl-clause">
                        <span class="sl-clause__id">5.1</span>
                        <span>Alle oplysninger, der ikke er offentligt tilgængelige — herunder tegninger og tekniske
                            dokumenter, som Sal-Tech overdrager til køber ("fortrolige oplysninger") — forbliver
                            Sal-Tech's ejendom og skal behandles som en forretningshemmelighed af køber.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">5.2</span>
                        <span>Fortrolige oplysninger må ikke uden Sal-Tech's skriftlige samtykke kopieres, reproduceres
                            eller overdrages til tredjemand, eller anvendes til andre formål end dem, der var hensigten
                            med overdragelsen.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">5.3</span>
                        <span>Fortrolige oplysninger skal på forlangende tilbageleveres til Sal-Tech.</span>
                    </li>
                </ul>
            </section>

            <!-- 6. Søveriabilitet -->
            <section class="sl-section" id="sl-s6">
                <div class="sl-section__header">
                    <span class="sl-section__num"> 6</span>
                    <h2 class="sl-section__title">Søveriabilitet</h2>
                </div>
                <ul class="sl-clauses">
                    <li class="sl-clause">
                        <span class="sl-clause__id">6.1</span>
                        <span>Hvis en eller flere bestemmelser i Sal-Tech's vilkår og betingelser er ugyldige og/eller
                            ikke kan håndhæves, forbliver de resterende bestemmelsers gyldighed i dette dokument
                            uændret.</span>
                    </li>
                </ul>
            </section>

            <!-- 7. Jurisdiktion -->
            <section class="sl-section" id="sl-s7">
                <div class="sl-section__header">
                    <span class="sl-section__num"> 7</span>
                    <h2 class="sl-section__title">Jurisdiktion</h2>
                </div>
                <ul class="sl-clauses">
                    <li class="sl-clause">
                        <span class="sl-clause__id">7.1</span>
                        <span>Retten i Sønderborg, Danmark, har ikke-eksklusiv kompetence til at afgøre enhver tvist,
                            der opstår i henhold til eller i forbindelse med aftalen, medmindre andet er skriftligt
                            aftalt mellem parterne.</span>
                    </li>
                </ul>
                <div class="sl-jur-list">
                    <div class="sl-jur-item"><strong>Primær jurisdiktion:</strong> Retten i Sønderborg, Danmark</div>
                    <div class="sl-jur-item"><strong>Gældende hjemmesider:</strong> sal-tech.dk &nbsp;·&nbsp;
                        sal-tech.com &nbsp;·&nbsp; sal-tech.es &nbsp;·&nbsp; sal-tech.de</div>
                </div>
            </section>

            <!-- 8. Klager -->
            <section class="sl-section" id="sl-s8">
                <div class="sl-section__header">
                    <span class="sl-section__num"> 8</span>
                    <h2 class="sl-section__title">Klager</h2>
                </div>
                <ul class="sl-clauses">
                    <li class="sl-clause">
                        <span class="sl-clause__id">8.1</span>
                        <span>Reklamationer skal omgående meddeles Sal-Tech skriftligt inden for 5 dage efter
                            levering/ordrebekræftelse af produktet og/eller tjenesteydelsen.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">8.2</span>
                        <span>En eventuel reklamation suspenderer ikke en eventuel forfalden betaling, medmindre andet
                            er skriftligt aftalt med Sal-Tech.</span>
                    </li>
                    <li class="sl-clause">
                        <span class="sl-clause__id">8.3</span>
                        <span>Sal-Tech vil gøre sit yderste for at nå frem til en mindelig løsning med køberen, hvis der
                            modtages en klage.</span>
                    </li>
                </ul>
                <div class="sl-infobox">
                    Klager skal fremsendes skriftligt til <a href="mailto:support@sal-tech.com"
                        style="color:inherit;font-weight:600;">support@sal-tech.com</a> inden for den fastsatte frist på
                    5 dage fra levering eller ordrebekræftelse.
                </div>
            </section>

        </div>
    </div>

    <!-- ══ FOOTER NOTE ══ -->
    <div class="sl-footnote">
        <div class="sl-wrap">
            <p><strong>Salbæk Technology Group — Retlig Meddelelse</strong></p>
            <p>Udarbejdet af: RCL &nbsp;|&nbsp; Godkendt af: GUS &nbsp;|&nbsp; Dato: 13.02.2024</p>
            <p>Gælder for: sal-tech.dk &nbsp;·&nbsp; sal-tech.com &nbsp;·&nbsp; sal-tech.es &nbsp;·&nbsp; sal-tech.de
            </p>
        </div>
    </div>

</main>

<?php get_footer(); ?>