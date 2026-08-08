<?php
defined('ABSPATH') || exit;

global $product;

$attribute_keys = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="variations_form cart"
    action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
    method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>"
    data-product_variations="<?php echo $variations_attr; ?>">

    <?php do_action('woocommerce_before_variations_form'); ?>

    <?php if (empty($available_variations) && false !== $available_variations): ?>
        <p class="stock out-of-stock">
            <?php esc_html_e('This product is currently out of stock and unavailable.', 'woocommerce'); ?>
        </p>
    <?php else: ?>
        <table class="variations" cellspacing="0" role="presentation">
            <tbody>
                <?php foreach ($attributes as $attribute_name => $options): ?>
                    <tr>
                        <th class="label">
                            <label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>">
                                <?php echo wc_attribute_label($attribute_name); ?>
                            </label>
                        </th>
                        <td class="value">
                            <?php
                            wc_dropdown_variation_attribute_options([
                                'options' => $options,
                                'attribute' => $attribute_name,
                                'product' => $product,
                            ]);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php do_action('woocommerce_after_variations_table'); ?>

        <div class="single_variation_wrap">
            <?php
            do_action('woocommerce_before_single_variation');
            do_action('woocommerce_single_variation');
            add_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
            do_action('woocommerce_after_single_variation');
            ?>
        </div>
    <?php endif; ?>

    <?php do_action('woocommerce_after_variations_form'); ?>
</form>

<style>
    .qty {
        @apply w-20 rounded-lg border border-gray-300 px-3 py-2 text-center focus:outline-none focus:ring-1 focus:ring-blue-500;
    }

    .single_add_to_cart_button {
        @apply bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200;
    }

    .wp-block-woocommerce-cart,
    .wp-block-woocommerce-checkout,
    .eb-fullwidth-content-wrapper {
        width: 1200px !important;
        margin: 2rem auto !important;
    }

    .wc-block-cart__submit-container,
    button.wc-block-components-button.wp-element-button.wc-block-components-checkout-place-order-button.contained {
        background: #1f1fc9;
        color: #f9f9f9;
        border-radius: 5px;
    }

    /* Variable Product Variations Styling */
    .variations select {
        width: 100%;
        padding: 0.625rem 2.5rem 0.625rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        background-color: white;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-position: right 0.75rem center;
        background-repeat: no-repeat;
        background-size: 1.25rem;
        cursor: pointer;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .variations select:focus {
        outline: none;
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
    }

    .variations th.label {
        padding-right: 1rem;
        font-weight: 600;
        font-size: 0.875rem;
        color: #111827;
        vertical-align: middle;
    }

    .variations td.value {
        padding-bottom: 0.75rem;
    }

    .woocommerce-variation-add-to-cart {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1rem;
        margin-top: 1rem;
    }

    .woocommerce-variation-add-to-cart .quantity {
        display: flex;
        align-items: center;
    }

    .woocommerce-variation-add-to-cart .quantity label {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }

    .woocommerce-variation-add-to-cart .quantity .qty-controls {
        display: flex;
        align-items: center;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        overflow: hidden;
        background-color: white;
    }

    .woocommerce-variation-add-to-cart .quantity .qty-controls.disabled {
        opacity: 0.5;
        pointer-events: none;
    }

    .woocommerce-variation-add-to-cart .quantity button.qty-btn {
        padding: 0.5rem 0.75rem;
        color: #4b5563;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .woocommerce-variation-add-to-cart .quantity button.qty-btn:hover {
        background-color: #f3f4f6;
        color: #111827;
    }

    .woocommerce-variation-add-to-cart .quantity button.qty-btn.minus {
        border-right: 1px solid #d1d5db;
    }

    .woocommerce-variation-add-to-cart .quantity button.qty-btn.plus {
        border-left: 1px solid #d1d5db;
    }

    .woocommerce-variation-add-to-cart .quantity input.qty {
        width: 3.5rem;
        padding: 0.5rem;
        text-align: center;
        border: none;
        font-size: 0.875rem;
        font-weight: 500;
        color: #111827;
        background: white;
    }

    .woocommerce-variation-add-to-cart .quantity input.qty:focus {
        outline: none;
    }

    .woocommerce-variation-add-to-cart .quantity input[type="number"]::-webkit-inner-spin-button,
    .woocommerce-variation-add-to-cart .quantity input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .woocommerce-variation-add-to-cart .quantity input[type="number"] {
        -moz-appearance: textfield;
    }

    .woocommerce-variation-add-to-cart .single_add_to_cart_button {
        flex: 1;
        display: inline-flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 0.5rem !important;
        background-color: #4CAF50 !important;
        color: white !important;
        font-weight: 500 !important;
        padding: 0.5rem 1.5rem !important;
        border: none !important;
        border-radius: 0.375rem !important;
        cursor: pointer !important;
        transition: background-color 0.2s !important;
        font-size: 0.875rem !important;
    }

    .woocommerce-variation-add-to-cart .single_add_to_cart_button:hover:not(:disabled) {
        background-color: #409142 !important;
    }

    .woocommerce-variation-add-to-cart .single_add_to_cart_button:disabled,
    .woocommerce-variation-add-to-cart .single_add_to_cart_button.disabled {
        background-color: #d1d5db !important;
        color: #6b7280 !important;
        cursor: not-allowed !important;
    }

    .woocommerce-variation-add-to-cart .single_add_to_cart_button svg {
        flex-shrink: 0;
        width: 1rem;
        height: 1rem;
    }

    .woocommerce-variation-add-to-cart .single_add_to_cart_button span {
        display: inline-block;
    }

    @media (min-width: 640px) {
        .woocommerce-variation-add-to-cart .single_add_to_cart_button {
            flex: initial;
        }
    }

    .stock.out-of-stock {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        background-color: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #991b1b;
    }

    .stock.out-of-stock::before {
        content: '';
        display: inline-block;
        width: 1.25rem;
        height: 1.25rem;
        flex-shrink: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23991b1b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'/%3E%3C/svg%3E");
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    /* ── Total price line shown under variation price ── */
    .wc-qty-total-price {
        flex-basis: 100%;
        width: 100%;
        order: 99;

        font-size: 0.8rem;
        color: #6b7280;

        margin-top: -0.25rem;
        margin-bottom: 0.5rem;
    }

    .wc-qty-total-price strong {
        color: #15803d;
        font-weight: 700;
    }

    .single_variation .woocommerce-variation-price,
    .single_variation .price,
    .woocommerce-variation-price {
        display: none !important;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        const $form = $('.variations_form');
        const $mainPrice = $('.text-2xl.font-bold.text-green-900');
        const $addToCartBtn = $('.single_add_to_cart_button');
        const defaultPrice = $mainPrice.html();

        // Track the current variation's unit price (raw number)
        let currentUnitPrice = null;
        let $totalLine = $('#wc-qty-total');

        // ── Format as Danish Krone ──
        function formatDKK(amount) {
            return 'DKK ' + amount.toLocaleString('da-DK', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // ── Recalculate and display total whenever qty changes ──
        function recalcTotal() {
            if (currentUnitPrice === null) {
                $totalLine.html('');
                return;
            }
            const qty = parseInt($('.woocommerce-variation-add-to-cart input.qty').val()) || 1;
            if (qty <= 1) {
                $totalLine.html(''); // no need to show "total" when qty is 1
                return;
            }
            const total = currentUnitPrice * qty;
            $totalLine.html('Total for ' + qty + ': <strong>' + formatDKK(total) + '</strong>');
        }

        function disableAddToCart() {
            $addToCartBtn.prop('disabled', true).addClass('disabled wc-variation-selection-needed');
            $('.qty-controls').addClass('disabled');
        }

        function enableAddToCart() {
            $addToCartBtn.prop('disabled', false).removeClass('disabled wc-variation-selection-needed');
            $('.qty-controls').removeClass('disabled');
        }

        function updatePrice(variation) {
            if (variation && variation.display_price !== undefined) {
                currentUnitPrice = parseFloat(variation.display_price);
                if (variation.price_html) {
                    $mainPrice.html(variation.price_html);
                } else {
                    $mainPrice.html(formatDKK(currentUnitPrice));
                }
            } else {
                currentUnitPrice = null;
                $mainPrice.html(defaultPrice);
            }
            recalcTotal();
        }

        function checkVariationsSelected() {
            let allSelected = true;
            $form.find('select[name^="attribute_"]').each(function () {
                if (!$(this).val()) { allSelected = false; return false; }
            });
            return allSelected;
        }

        function initQuantityButtons() {
            const $qtyInput = $('.woocommerce-variation-add-to-cart .quantity input.qty');

            if ($qtyInput.length && !$qtyInput.parent().hasClass('qty-controls')) {
                $qtyInput.wrap('<div class="qty-controls disabled"></div>');
                const $wrapper = $qtyInput.parent();
                if (!$('#wc-qty-total').length) {
                    $('.woocommerce-variation-add-to-cart').append(
                        '<p id="wc-qty-total" class="wc-qty-total-price"></p>'
                    );
                }

                $totalLine = $('#wc-qty-total');

                const $minusBtn = $('<button type="button" class="qty-btn minus"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg></button>');
                const $plusBtn = $('<button type="button" class="qty-btn plus"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg></button>');

                $wrapper.prepend($minusBtn);
                $wrapper.append($plusBtn);

                $minusBtn.on('click', function (e) {
                    e.preventDefault();
                    if (!$wrapper.hasClass('disabled')) {
                        const cur = parseInt($qtyInput.val()) || 1;
                        const min = parseInt($qtyInput.attr('min')) || 1;
                        if (cur > min) { $qtyInput.val(cur - 1).trigger('change'); }
                    }
                });

                $plusBtn.on('click', function (e) {
                    e.preventDefault();
                    if (!$wrapper.hasClass('disabled')) {
                        const cur = parseInt($qtyInput.val()) || 1;
                        const max = parseInt($qtyInput.attr('max')) || 999999;
                        if (cur < max) { $qtyInput.val(cur + 1).trigger('change'); }
                    }
                });

                if (!$addToCartBtn.find('svg').length) {
                    const btnText = $addToCartBtn.text();
                    $addToCartBtn.html('<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg><span>' + btnText + '</span>');
                }
            }

            // Listen for qty changes (typed or via buttons)
            $(document).off('change.qtyrecalc', '.woocommerce-variation-add-to-cart input.qty')
                .on('change.qtyrecalc', '.woocommerce-variation-add-to-cart input.qty', recalcTotal);
        }

        $form.on('found_variation', function (event, variation) {
            updatePrice(variation);
            if (variation.is_in_stock) { enableAddToCart(); } else { disableAddToCart(); }
        });

        $form.on('reset_data hide_variation', function () {
            currentUnitPrice = null;
            $mainPrice.html(defaultPrice);
            $totalLine.html('');
            disableAddToCart();
        });

        $form.on('change', 'select[name^="attribute_"]', function () {
            if (!checkVariationsSelected()) { disableAddToCart(); }
        });

        setTimeout(function () {
            initQuantityButtons();
            if (!checkVariationsSelected()) { disableAddToCart(); }
        }, 100);

        $form.wc_variation_form();
    });
</script>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>