<?php
/**
 * Template Name: Suppliers
 */
get_header();

$suppliers = array(
    array('name' => 'Sal-Tech Easy Packaging DK', 'description' => 'Packaging solutions in Denmark and Europe, warehouse and distribution center.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/saltech.png', 'url' => '#', 'products_count' => 8, 'country' => '🇩🇰 Danmark', 'tags' => ['Strapping', 'Wrapping', 'Banding']),
    array('name' => 'Sal-Tech Embalaje SL.', 'description' => 'Sal-Tech\'s Spanish branch supplying packaging solutions across Spain and southern Europe.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/saltech.png', 'url' => '#', 'products_count' => 2, 'country' => '🇪🇸 Spanien', 'tags' => ['Emballering']),
    array('name' => 'Sal-Tech HKG Ltd.', 'description' => 'Purchase organisation in Hong Kong, sourcing suppliers worldwide mainly in China and near regions.', 'logo' => get_template_directory_uri() . '/assets/images/suppliers/hkg-sal-tech.png', 'url' => '#', 'products_count' => 8, 'country' => '🇭🇰 Hong Kong', 'tags' => ['Indkøb', 'Sourcing']),
    // array('name' => 'Transpak Equipment Corp.', 'description' => 'Leading manufacturer of strapping and bundling equipment for industrial packaging.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/Transpak.png', 'url' => '#', 'products_count' => 0, 'country' => '🇺🇸 USA', 'tags' => ['Strapping', 'Omsnøring']),
    // array('name' => 'Extend Great International Corporation', 'description' => 'Specialist in stretch wrapping and pallet wrapping machinery for automated lines.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/Extend.png', 'url' => '#', 'products_count' => 0, 'country' => '🇹🇼 Taiwan', 'tags' => ['Wrapping', 'Pallevikling']),
    // array('name' => 'Mercier Corporation', 'description' => 'Manufacturer of bag sealing and heat sealing equipment for food and industrial packaging.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/Mercier.png', 'url' => '#', 'products_count' => 0, 'country' => '🇹🇼 Taiwan', 'tags' => ['Bag Sealers', 'Posesvejsere']),
    // array('name' => 'Hangzhou Youngsun Intelligent Equipment Co., Ltd', 'description' => 'Intelligent strapping and automated packaging systems for high-volume operations.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/Youngsun.png', 'url' => '#', 'products_count' => 0, 'country' => '🇨🇳 Kina', 'tags' => ['Strapping', 'Automatisering']),
    // array('name' => 'Yao Han Industries Co.', 'description' => 'Specialist in banding machines for bundling products securely and efficiently.', 'logo' => get_template_directory_uri() . '/assets/img/suppliers/YaoHan.avif', 'url' => '#', 'products_count' => 0, 'country' => '🇹🇼 Taiwan', 'tags' => ['Banding', 'Banderolering']),
);
?>

<style>
    .sup-page {
        padding: 2.5rem 1.25rem;
        background: #F9FAFB;
        min-height: 100vh;
    }

    .sup-inner {
        max-width: 1100px;
        margin: 0 auto;
    }

    .sup-eyebrow {
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

    .sup-eyebrow::before {
        content: '';
        width: 16px;
        height: 1.5px;
        background: #DC2626;
        flex-shrink: 0;
    }

    .sup-title {
        font-size: clamp(20px, 4vw, 28px);
        font-weight: 700;
        color: #111;
        letter-spacing: -.02em;
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .sup-subtitle {
        font-size: 14px;
        color: #6B7280;
        line-height: 1.65;
        max-width: 560px;
        margin-bottom: 1.75rem;
    }

    .sup-search {
        position: relative;
        width: 100%;
        max-width: 400px;
        margin-bottom: 1.75rem;
    }

    .sup-search input {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        font-size: 14px;
        color: #111;
        background: #fff;
        outline: none;
        font-family: inherit;
        -webkit-appearance: none;
    }

    .sup-search input:focus {
        border-color: #DC2626;
    }

    .sup-search svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #9CA3AF;
        pointer-events: none;
    }

    .sup-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1px;
        background: #E5E7EB;
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        overflow: hidden;
    }

    .sup-card {
        background: #fff;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        transition: background .18s;
    }

    .sup-card:hover {
        background: #FAFAFA;
    }

    .sup-card-logo {
        padding: 1.75rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100px;
        border-bottom: 1px solid #F3F4F6;
    }

    .sup-card-logo img {
        max-height: 60px;
        max-width: 130px;
        width: auto;
        object-fit: contain;
        filter: grayscale(1);
        opacity: .6;
        display: block;
        transition: opacity .18s;
    }

    .sup-card:hover .sup-card-logo img {
        opacity: .9;
    }

    .sup-card-logo-placeholder {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #F3F4F6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        color: #9CA3AF;
    }

    .sup-card-body {
        padding: 1.1rem 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .sup-card-name {
        font-size: 13px;
        font-weight: 700;
        color: #111;
        line-height: 1.35;
    }

    .sup-card-origin {
        font-size: 12px;
        color: #6B7280;
    }

    .sup-card-desc {
        font-size: 12px;
        color: #9CA3AF;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .sup-card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-top: 2px;
    }

    .sup-card-tag {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #DC2626;
        background: rgba(220, 38, 38, .07);
        padding: 2px 7px;
        border-radius: 100px;
    }

    .sup-card-footer {
        padding: .9rem 1.25rem;
        border-top: 1px solid #F3F4F6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .sup-card-count {
        font-size: 11px;
        color: #9CA3AF;
        white-space: nowrap;
    }

    .sup-card-link {
        font-size: 11px;
        font-weight: 600;
        color: #DC2626;
        display: flex;
        align-items: center;
        gap: 3px;
        white-space: nowrap;
    }

    .sup-card-link svg {
        width: 12px;
        height: 12px;
        transition: transform .15s;
        flex-shrink: 0;
    }

    .sup-card:hover .sup-card-link svg {
        transform: translateX(3px);
    }

    .sup-none {
        display: none;
        text-align: center;
        padding: 4rem 2rem;
        color: #9CA3AF;
    }

    .sup-none svg {
        width: 40px;
        height: 40px;
        margin: 0 auto 1rem;
        display: block;
    }

    .sup-none p {
        font-size: 14px;
    }

    /* ── TABLET: 2 columns ── */
    @media (max-width: 860px) {
        .sup-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* ── MOBILE: 2 columns, condensed cards ── */
    @media (max-width: 480px) {
        .sup-page {
            padding: 2rem 1rem;
        }

        .sup-grid {
            grid-template-columns: 1fr 1fr;
            border-radius: 8px;
        }

        .sup-card-logo {
            padding: 1.25rem 1rem;
            min-height: 80px;
        }

        .sup-card-logo img {
            max-height: 44px;
            max-width: 100px;
        }

        .sup-card-body {
            padding: .9rem 1rem;
            gap: 5px;
        }

        .sup-card-name {
            font-size: 12px;
        }

        .sup-card-desc {
            display: none;
        }

        .sup-card-footer {
            padding: .75rem 1rem;
        }

        .sup-card-count {
            display: none;
        }
    }

    /* ── VERY SMALL: 1 column ── */
    @media (max-width: 340px) {
        .sup-grid {
            grid-template-columns: 1fr;
        }

        .sup-card-logo img {
            max-height: 52px;
            max-width: 140px;
        }

        .sup-card-desc {
            display: -webkit-box;
        }

        .sup-card-count {
            display: block;
        }
    }
</style>

<div class="sup-page">
    <div class="sup-inner">

        <div class="sup-eyebrow">Vores leverandører</div>
        <h1 class="sup-title">Udvalgte leverandører &amp; samarbejdspartnere</h1>
        <p class="sup-subtitle">Vi samarbejder med førende producenter inden for emballeringsudstyr og -materialer for
            at sikre de bedste løsninger til vores kunder.</p>

        <div class="sup-search">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" id="sup-search" placeholder="Søg efter leverandør...">
        </div>

        <div class="sup-grid" id="sup-grid">
            <?php foreach ($suppliers as $s): ?>
                <a href="<?php echo esc_url($s['url']); ?>" class="sup-card"
                    data-name="<?php echo esc_attr(strtolower($s['name'])); ?>">
                    <div class="sup-card-logo">
                        <?php if (!empty($s['logo'])): ?>
                            <img src="<?php echo esc_url($s['logo']); ?>" alt="<?php echo esc_attr($s['name']); ?>">
                        <?php else: ?>
                            <div class="sup-card-logo-placeholder"><?php echo esc_html(substr($s['name'], 0, 1)); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="sup-card-body">
                        <div class="sup-card-name"><?php echo esc_html($s['name']); ?></div>
                        <div class="sup-card-origin"><?php echo esc_html($s['country']); ?></div>
                        <?php if (!empty($s['tags'])): ?>
                            <div class="sup-card-tags">
                                <?php foreach ($s['tags'] as $tag): ?>
                                    <span class="sup-card-tag"><?php echo esc_html($tag); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty(trim($s['description']))): ?>
                            <div class="sup-card-desc"><?php echo esc_html($s['description']); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="sup-card-footer">
                        <span class="sup-card-count"><?php echo (int) $s['products_count']; ?> produkter</span>
                        <span class="sup-card-link">Se produkter
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="sup-none" id="sup-none">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <p>Ingen leverandører fundet — prøv et andet søgeord.</p>
        </div>

    </div>
</div>

<script>
    const input = document.getElementById('sup-search');
    const grid = document.getElementById('sup-grid');
    const none = document.getElementById('sup-none');
    input.addEventListener('input', () => {
        const q = input.value.toLowerCase().trim();
        let visible = 0;
        grid.querySelectorAll('.sup-card').forEach(c => {
            const match = !q || c.dataset.name.includes(q);
            c.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        grid.style.display = visible ? '' : 'none';
        none.style.display = visible ? 'none' : 'block';
    });
</script>

<?php get_footer(); ?>