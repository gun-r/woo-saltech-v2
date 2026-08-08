<style>
    .sl-section {
        padding: 3.5rem 0;
        background: #fff;
        border-top: 1px solid #E5E7EB;
        border-bottom: 1px solid #E5E7EB;
    }

    .sl-inner {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .sl-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        border: 1px solid #E5E7EB;
        border-radius: 10px;
        overflow: hidden;
    }

    .sl-cell {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2.5rem 3rem;
        border-right: 1px solid #E5E7EB;
        border-bottom: 1px solid #E5E7EB;
        background: #fff;
        transition: background .18s;
        text-decoration: none;
    }

    .sl-cell:nth-child(3n) {
        border-right: none;
    }

    .sl-cell:nth-last-child(-n+3) {
        border-bottom: none;
    }

    .sl-cell:hover {
        background: #F9FAFB;
    }

    .sl-cell img {
        max-height: 70px;
        max-width: 160px;
        width: auto;
        object-fit: contain;
        filter: grayscale(1);
        opacity: .55;
        display: block;
        transition: opacity .18s;
    }

    .sl-cell:hover img {
        opacity: .9;
    }

    /* ── TABLET: 2 columns ── */
    @media (max-width: 640px) {
        .sl-section {
            padding: 2.5rem 0;
        }

        .sl-inner {
            padding: 0 1.25rem;
        }

        .sl-grid {
            grid-template-columns: repeat(2, 1fr);
            border-radius: 8px;
        }

        .sl-cell {
            padding: 2rem 1.5rem;
        }

        /* reset 3-col rules */
        .sl-cell:nth-child(3n) {
            border-right: 1px solid #E5E7EB;
        }

        .sl-cell:nth-last-child(-n+3) {
            border-bottom: 1px solid #E5E7EB;
        }

        /* apply 2-col rules */
        .sl-cell:nth-child(2n) {
            border-right: none;
        }

        .sl-cell:nth-last-child(-n+2) {
            border-bottom: none;
        }

        .sl-cell img {
            max-height: 52px;
            max-width: 120px;
        }
    }

    /* ── MOBILE: tighter still ── */
    @media (max-width: 380px) {
        .sl-inner {
            padding: 0 1rem;
        }

        .sl-cell {
            padding: 1.5rem 1rem;
        }

        .sl-cell img {
            max-height: 40px;
            max-width: 90px;
        }
    }
</style>

<section class="sl-section">
    <div class="sl-inner">

        <div class="sl-grid">
            <?php
            $suppliers = [
                ['img' => 'saltech.png', 'alt' => 'Sal-Tech Easy Packaging', 'url' => '/product-category/sal-tech'],
                ['img' => 'Transpak.png', 'alt' => 'Transpak Equipment Corp.', 'url' => '/product-category/transpak'],
                ['img' => 'Extend.png', 'alt' => 'Extend Great International', 'url' => '/product-category/extend-great'],
                ['img' => 'Mercier.png', 'alt' => 'Mercier Corporation', 'url' => '/product-category/mercier'],
                ['img' => 'Youngsun.png', 'alt' => 'Youngsun Intelligent Equipment', 'url' => '/product-category/youngsun'],
                ['img' => 'YaoHan.avif', 'alt' => 'Yao Han Industries Co.', 'url' => '/product-category/yao-han'],
            ];
            foreach ($suppliers as $s):
                $img_url = get_template_directory_uri() . '/assets/img/suppliers/' . $s['img'];
                ?>
                <!-- <a href="<?php //echo esc_url($s['url']); ?>" class="sl-cell">
                    <img src="<?php //echo esc_url($img_url); ?>" alt="<?php //echo esc_attr($s['alt']); ?>">
                </a> -->
                <div href="<?php echo esc_url($s['url']); ?>" class="sl-cell">
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($s['alt']); ?>">
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>