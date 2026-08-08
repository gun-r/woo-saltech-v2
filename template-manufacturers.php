<?php
/**
 * Template Name: Manufacturers
 */
get_header();

$manufacturers = array(
    array('name' => 'E3Hallbrook', 'description' => 'Packaging and ergonomic support machines within same product range.', 'logo' => get_template_directory_uri() . '/assets/images/manufacturers/e3hallbrook-logo.png', 'url' => home_url('#'), 'products_count' => 1, 'country' => 'Europe'),
    array('name' => 'Extend Group', 'description' => 'Founded 1986, market-driven supplier of strapping, wrapping and shrink packaging solutions.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/Extend.png', 'url' => home_url('#'), 'products_count' => 36, 'country' => 'Spain'),
    array('name' => 'Hallbrook Components', 'description' => 'Enhanced spare parts made to fit original mounts on a number of different machines.', 'logo' => get_template_directory_uri() . '/assets/images/manufacturers/hallbrook-components-logo.jpg', 'url' => home_url('#'), 'products_count' => 8, 'country' => 'China'),
    array('name' => 'Mercier Corporation', 'description' => 'Leading manufacturer and supplier of quality impulse sealers and associated equipment worldwide.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/Mercier.png', 'url' => home_url('#'), 'products_count' => 40, 'country' => 'Denmark'),
    array('name' => 'Rievtech Electronic Co., Ltd', 'description' => 'Manufacturer of automation micro-control components: Micro PLC, super relay, Ethernet PLC, 4G/GSM PLC and more.', 'logo' => get_template_directory_uri() . '/assets/images/manufacturers/rievtech.png', 'url' => home_url('#'), 'products_count' => 3, 'country' => 'Switzerland'),
    array('name' => 'Taizhou Sewkey Garment Equipment Co., Ltd.', 'description' => 'Manufactures and supplies high-quality sewing machines for garment industry worldwide.', 'logo' => get_template_directory_uri() . '/assets/images/manufacturers/sewkey.png', 'url' => home_url('#'), 'products_count' => 15, 'country' => 'China'),
    array('name' => 'Transpak Equipment Corp.', 'description' => 'Independent exporter and manufacturer of strapping machines and tools.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/Transpak.png', 'url' => home_url('#'), 'products_count' => 4984, 'country' => 'USA'),
    array('name' => 'Yao Han Industries Co., Ltd.', 'description' => 'Develops and produces bag closing and sewing machines in Taiwan with local production in mainland China.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/YaoHan.avif', 'url' => home_url('#'), 'products_count' => 21, 'country' => 'Taiwan'),
    array('name' => 'YoungSun', 'description' => 'Leading manufacturer of packaging equipment and automation solutions.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/Youngsun.png', 'url' => home_url('#'), 'products_count' => 102, 'country' => 'China'),
);

$countries = array_unique(array_column($manufacturers, 'country'));
sort($countries);
?>

<style>
    .mfr-page {
        padding: 2.5rem 1.25rem;
        background: #F9FAFB;
        min-height: 100vh;
    }

    .mfr-inner {
        max-width: 1100px;
        margin: 0 auto;
    }

    .mfr-eyebrow {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: #DC2626;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }

    .mfr-eyebrow::before {
        content: '';
        width: 16px;
        height: 1.5px;
        background: #DC2626;
        flex-shrink: 0;
    }

    .mfr-title {
        font-size: clamp(20px, 4vw, 28px);
        font-weight: 700;
        color: #111;
        letter-spacing: -.02em;
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .mfr-subtitle {
        font-size: 14px;
        color: #6B7280;
        line-height: 1.65;
        max-width: 560px;
        margin-bottom: 1.75rem;
    }

    .mfr-controls {
        display: flex;
        gap: 10px;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .mfr-search {
        position: relative;
        flex: 1;
        min-width: 200px;
    }

    .mfr-search input {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        font-size: 14px;
        color: #111;
        background: #fff;
        outline: none;
        font-family: inherit;
    }

    .mfr-search input:focus {
        border-color: #DC2626;
    }

    .mfr-search svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #9CA3AF;
        pointer-events: none;
    }

    .mfr-select {
        padding: 10px 14px;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        font-size: 13px;
        color: #111;
        background: #fff;
        outline: none;
        font-family: inherit;
        cursor: pointer;
        min-width: 160px;
    }

    .mfr-select:focus {
        border-color: #DC2626;
    }

    .mfr-count {
        font-size: 12px;
        color: #9CA3AF;
        white-space: nowrap;
        padding: 10px 4px;
    }

    .mfr-count strong {
        color: #111;
    }

    .mfr-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1px;
        background: #E5E7EB;
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        overflow: hidden;
    }

    .mfr-card {
        background: #fff;
        display: flex;
        flex-direction: column;
        transition: background .18s;
    }

    .mfr-card:hover {
        background: #FAFAFA;
    }

    .mfr-card-logo {
        padding: 1.75rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100px;
        border-bottom: 1px solid #F3F4F6;
    }

    .mfr-card-logo img {
        max-height: 60px;
        max-width: 140px;
        width: auto;
        object-fit: contain;
        filter: grayscale(1);
        opacity: .6;
        display: block;
        transition: opacity .18s;
    }

    .mfr-card:hover .mfr-card-logo img {
        opacity: .9;
    }

    .mfr-card-placeholder {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #F3F4F6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        font-weight: 700;
        color: #9CA3AF;
    }

    .mfr-card-body {
        padding: 1.1rem 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .mfr-card-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #111;
        line-height: 1.35;
    }

    .mfr-card-origin {
        font-size: 12px;
        color: #6B7280;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .mfr-card-desc {
        font-size: 12px;
        color: #9CA3AF;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .mfr-card-footer {
        padding: .9rem 1.25rem;
        border-top: 1px solid #F3F4F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .mfr-card-count {
        font-size: 11px;
        color: #9CA3AF;
    }

    .mfr-card-link {
        font-size: 11px;
        font-weight: 600;
        color: #DC2626;
        display: flex;
        align-items: center;
        gap: 3px;
        text-decoration: none;
    }

    .mfr-card-link svg {
        width: 12px;
        height: 12px;
        transition: transform .15s;
    }

    .mfr-card:hover .mfr-card-link svg {
        transform: translateX(3px);
    }

    .mfr-none {
        display: none;
        text-align: center;
        padding: 4rem 2rem;
        color: #9CA3AF;
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        background: #fff;
    }

    .mfr-none svg {
        width: 40px;
        height: 40px;
        margin: 0 auto 1rem;
        display: block;
    }

    .mfr-none p {
        font-size: 14px;
    }

    .mfr-pagination {
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        flex-wrap: wrap;
    }

    .pg-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 34px;
        padding: 0 10px;
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        background: #fff;
        cursor: pointer;
        transition: all .15s;
        font-family: inherit;
    }

    .pg-btn:hover:not(:disabled) {
        background: #F9FAFB;
    }

    .pg-btn.active {
        background: #DC2626;
        border-color: #DC2626;
        color: #fff;
    }

    .pg-btn:disabled {
        opacity: .4;
        cursor: default;
    }

    .pg-dots {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        font-size: 13px;
        color: #9CA3AF;
    }

    @media (max-width: 860px) {
        .mfr-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .mfr-page {
            padding: 2rem 1rem;
        }

        .mfr-controls {
            gap: 8px;
        }

        .mfr-search {
            min-width: 100%;
        }

        .mfr-select {
            flex: 1;
            min-width: 0;
        }

        .mfr-card-logo {
            padding: 1.25rem 1rem;
            min-height: 80px;
        }

        .mfr-card-logo img {
            max-height: 44px;
            max-width: 100px;
        }

        .mfr-card-body {
            padding: .9rem 1rem;
        }

        .mfr-card-name {
            font-size: 12px;
        }

        .mfr-card-desc {
            display: none;
        }

        .mfr-card-footer {
            padding: .75rem 1rem;
        }

        .mfr-card-count {
            display: none;
        }
    }

    @media (max-width: 340px) {
        .mfr-grid {
            grid-template-columns: 1fr;
        }

        .mfr-card-desc {
            display: -webkit-box;
        }

        .mfr-card-count {
            display: block;
        }
    }
</style>

<div class="mfr-page">
    <div class="mfr-inner">

        <div class="mfr-eyebrow">Vores producenter</div>
        <h1 class="mfr-title">Udvalgte producenter &amp; fabrikanter</h1>
        <p class="mfr-subtitle">Vi samarbejder med verdensklasse producenter for at levere premium emballeringsmaskiner,
            komponenter og automatiseringsløsninger.</p>

        <div class="mfr-controls">
            <div class="mfr-search">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" id="mfr-search" placeholder="Søg efter producent...">
            </div>
            <select id="mfr-country" class="mfr-select">
                <option value="">Alle lande</option>
                <?php foreach ($countries as $c): ?>
                    <option value="<?php echo esc_attr($c); ?>"><?php echo esc_html($c); ?></option>
                <?php endforeach; ?>
            </select>
            <div class="mfr-count"><strong id="mfr-result-count"><?php echo count($manufacturers); ?></strong>
                producenter</div>
        </div>

        <div class="mfr-grid" id="mfr-grid">
            <?php foreach ($manufacturers as $m): ?>
                <div class="mfr-card" data-name="<?php echo esc_attr(strtolower($m['name'])); ?>"
                    data-country="<?php echo esc_attr($m['country']); ?>">
                    <div class="mfr-card-logo">
                        <?php if (!empty($m['logo'])): ?>
                            <img src="<?php echo esc_url($m['logo']); ?>" alt="<?php echo esc_attr($m['name']); ?>">
                        <?php else: ?>
                            <div class="mfr-card-placeholder"><?php echo esc_html(substr($m['name'], 0, 2)); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mfr-card-body">
                        <div class="mfr-card-name"><?php echo esc_html($m['name']); ?></div>
                        <div class="mfr-card-origin">
                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <?php echo esc_html($m['country']); ?>
                        </div>
                        <?php if (!empty(trim($m['description']))): ?>
                            <div class="mfr-card-desc"><?php echo esc_html($m['description']); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mfr-card-footer">
                        <span class="mfr-card-count"><?php echo number_format((int) $m['products_count']); ?>
                            produkter</span>
                        <!-- <a href="<?php //echo esc_url($m['url']); ?>" class="mfr-card-link">Se produkter
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a> -->
                        <div href="<?php echo esc_url($m['url']); ?>" class="mfr-card-link">Se produkter
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mfr-none" id="mfr-none">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <p>Ingen producenter fundet — prøv et andet søgeord.</p>
        </div>

        <div class="mfr-pagination" id="mfr-pagination"></div>

    </div>
</div>

<script>
    const ITEMS_PER_PAGE = 6;
    let currentPage = 1;
    const searchEl = document.getElementById('mfr-search');
    const countryEl = document.getElementById('mfr-country');
    const grid = document.getElementById('mfr-grid');
    const noneEl = document.getElementById('mfr-none');
    const countEl = document.getElementById('mfr-result-count');
    const pagEl = document.getElementById('mfr-pagination');

    function getFiltered() {
        const q = searchEl.value.toLowerCase().trim();
        const c = countryEl.value;
        return Array.from(grid.querySelectorAll('.mfr-card')).filter(card => {
            return (!q || card.dataset.name.includes(q)) && (!c || card.dataset.country === c);
        });
    }

    function render() {
        const all = Array.from(grid.querySelectorAll('.mfr-card'));
        const filtered = getFiltered();
        const pages = Math.ceil(filtered.length / ITEMS_PER_PAGE);
        if (currentPage > pages) currentPage = 1;
        const start = (currentPage - 1) * ITEMS_PER_PAGE;
        const visible = new Set(filtered.slice(start, start + ITEMS_PER_PAGE));
        all.forEach(c => c.style.display = visible.has(c) ? '' : 'none');
        countEl.textContent = filtered.length;
        noneEl.style.display = filtered.length ? 'none' : 'block';
        grid.style.display = filtered.length ? '' : 'none';
        renderPagination(pages);
    }

    function renderPagination(pages) {
        pagEl.innerHTML = '';
        if (pages <= 1) return;
        const prev = mkBtn('←', currentPage === 1);
        prev.addEventListener('click', () => { currentPage--; render(); });
        pagEl.appendChild(prev);
        for (let i = 1; i <= pages; i++) {
            if (pages > 7 && i > 2 && i < pages - 1 && Math.abs(i - currentPage) > 1) {
                if (pagEl.lastChild.className !== 'pg-dots') {
                    const d = document.createElement('span'); d.className = 'pg-dots'; d.textContent = '…'; pagEl.appendChild(d);
                }
                continue;
            }
            const b = mkBtn(i, false, i === currentPage);
            b.addEventListener('click', () => { currentPage = i; render(); });
            pagEl.appendChild(b);
        }
        const next = mkBtn('→', currentPage === pages);
        next.addEventListener('click', () => { currentPage++; render(); });
        pagEl.appendChild(next);
    }

    function mkBtn(label, disabled, active = false) {
        const el = document.createElement('button');
        el.className = 'pg-btn' + (active ? ' active' : '');
        el.textContent = label;
        el.disabled = disabled;
        return el;
    }

    searchEl.addEventListener('input', () => { currentPage = 1; render(); });
    countryEl.addEventListener('change', () => { currentPage = 1; render(); });
    render();
</script>

<?php get_footer(); ?>