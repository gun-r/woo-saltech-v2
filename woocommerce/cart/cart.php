<?php
/**
 * Cart Page - WooCommerce Template Override
 * Location: wp-content/themes/chris-tailwind-woo/woocommerce/cart/cart.php
 *
 * Shows original price vs tier-discounted price per line item.
 *
 * @package chris-tailwind-woo
 * @version 10.8.0
 */

defined( 'ABSPATH' ) || exit;

// ── Helper: get tier info for a product+qty ───────────────────────────────────
function stpp_get_tier_info( $product, $qty ) {
    $product_id    = $product->get_parent_id() ?: $product->get_id();
    $regular_price = (float) $product->get_regular_price();
    $current_price = (float) $product->get_price();
    $has_discount  = $current_price < $regular_price && $current_price > 0;
    $tier_label    = '';

    if ( $has_discount ) {
        $tiers = get_post_meta( $product_id, '_stpp_tiers', true );
        if ( is_array( $tiers ) ) {
            usort( $tiers, fn($a,$b) => $b['qty'] <=> $a['qty'] );
            foreach ( $tiers as $tier ) {
                if ( $qty >= (int) $tier['qty'] ) {
                    $tier_label = $tier['qty'] . '+ stk.';
                    break;
                }
            }
        }
    }

    return [
        'regular'      => $regular_price,
        'current'      => $current_price,
        'has_discount' => $has_discount,
        'tier_label'   => $tier_label,
    ];
}

do_action( 'woocommerce_before_cart' );
?>

<div class="stpp-cart-wrap">

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php do_action( 'woocommerce_before_cart_table' ); ?>

    <table class="stpp-cart-table" cellspacing="0">
        <thead>
            <tr>
                <th class="col-remove"></th>
                <th class="col-thumb"></th>
                <th class="col-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                <th class="col-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                <th class="col-qty"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                <th class="col-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

            <?php
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                $visible    = apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key );

                if ( ! ( $_product instanceof WC_Product ) || ! $_product->exists() || $cart_item['quantity'] <= 0 || ! $visible ) continue;

                $qty       = (int) $cart_item['quantity'];
                $tier      = stpp_get_tier_info( $_product, $qty );
                $row_class = apply_filters( 'woocommerce_cart_item_class', 'woocommerce-cart-form__cart-item', $cart_item, $cart_item_key );
                ?>

                <tr class="<?php echo esc_attr( $row_class ); ?>">

                    <!-- Remove -->
                    <td class="col-remove">
                        <?php
                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                                '<a href="%s" class="stpp-remove-item" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </a>',
                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                esc_attr__( 'Remove this item', 'woocommerce' ),
                                esc_attr( $product_id ),
                                esc_attr( $cart_item_key ),
                                esc_attr( $_product->get_sku() )
                            ),
                            $cart_item_key
                        );
                        ?>
                    </td>

                    <!-- Thumbnail -->
                    <td class="col-thumb">
                        <?php
                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'thumbnail', [ 'class' => 'stpp-thumb-img' ] ), $cart_item, $cart_item_key );
                        $permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        if ( $permalink ) echo '<a href="' . esc_url( $permalink ) . '">' . $thumbnail . '</a>';
                        else echo $thumbnail;
                        ?>
                    </td>

                    <!-- Product name -->
                    <td class="col-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                        <?php
                        $permalink    = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                        $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                        if ( $permalink ) echo '<a href="' . esc_url( $permalink ) . '" class="stpp-product-link">' . wp_kses_post( $product_name ) . '</a>';
                        else echo wp_kses_post( $product_name );
                        ?>
                        <?php if ( $_product->get_sku() ) : ?>
                            <div class="stpp-sku">SKU: <?php echo esc_html( $_product->get_sku() ); ?></div>
                        <?php endif; ?>
                        <?php do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key ); ?>
                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                        <?php if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) : ?>
                            <p class="backorder_notification"><?php esc_html_e( 'Available on backorder', 'woocommerce' ); ?></p>
                        <?php endif; ?>
                    </td>

                    <!-- Unit price -->
                    <td class="col-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                        <?php if ( $tier['has_discount'] ) : ?>
                            <div class="stpp-price-original"><?php echo wc_price( $tier['regular'] ); ?></div>
                            <div class="stpp-price-tier"><?php echo wc_price( $tier['current'] ); ?></div>
                            <?php if ( $tier['tier_label'] ) : ?>
                                <div class="stpp-tier-badge">
                                    <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    <?php echo esc_html( $tier['tier_label'] ); ?> price
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php endif; ?>
                    </td>

                    <!-- Quantity -->
                    <td class="col-qty" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                        <?php
                        if ( $_product->is_sold_individually() ) {
                            $min_quantity = 1;
                            $max_quantity = 1;
                        } else {
                            $min_quantity = 0;
                            $max_quantity = $_product->get_max_purchase_quantity();
                        }
                        $product_quantity = woocommerce_quantity_input(
                            [
                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                'input_value'  => $cart_item['quantity'],
                                'max_value'    => $max_quantity,
                                'min_value'    => $min_quantity,
                                'product_name' => $_product->get_name(),
                            ],
                            $_product,
                            false
                        );
                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        ?>
                    </td>

                    <!-- Line subtotal -->
                    <td class="col-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                        <?php if ( $tier['has_discount'] ) :
                            $line_regular  = $tier['regular'] * $qty;
                            $line_current  = $tier['current'] * $qty;
                            $savings       = $line_regular - $line_current;
                            ?>
                            <div class="stpp-price-original"><?php echo wc_price( $line_regular ); ?></div>
                            <div class="stpp-price-tier"><?php echo wc_price( $line_current ); ?></div>
                            <div class="stpp-savings">Spar <?php echo wc_price( $savings ); ?></div>
                        <?php else : ?>
                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php endif; ?>
                    </td>

                </tr>

            <?php endforeach; ?>

            <?php do_action( 'woocommerce_cart_contents' ); ?>

            <!-- Actions row -->
            <tr>
                <td colspan="6" class="col-actions">
                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                    <button type="submit" class="button stpp-update-btn" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        <?php esc_html_e( 'Update cart', 'woocommerce' ); ?>
                    </button>
                    <?php do_action( 'woocommerce_cart_actions' ); ?>
                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                </td>
            </tr>

            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
        </tbody>
    </table>

    <?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
    <?php do_action( 'woocommerce_cart_collaterals' ); ?>
</div>

</div><!-- /.stpp-cart-wrap -->

<?php do_action( 'woocommerce_after_cart' ); ?>

<style>
/* ── Cart table layout ─────────────────────────────────── */
.stpp-cart-wrap { font-family: inherit; }

.stpp-cart-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    margin-bottom: 24px;
}

.stpp-cart-table thead tr {
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
}

.stpp-cart-table thead th {
    padding: 12px 16px;
    text-align: left;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: #6b7280;
}

.stpp-cart-table tbody tr {
    border-bottom: 1px solid #f3f4f6;
    transition: background .15s;
}

.stpp-cart-table tbody tr:last-child { border-bottom: none; }
.stpp-cart-table tbody tr:hover { background: #fafafa; }

.stpp-cart-table td {
    padding: 16px;
    vertical-align: middle;
    font-size: 14px;
    color: #374151;
}

/* ── Columns ───────────────────────────────────────────── */
.col-remove { width: 40px; text-align: center; }
.col-thumb  { width: 80px; }
.col-price, .col-subtotal { text-align: right; }
.col-qty    { text-align: center; }
.col-actions { padding: 12px 16px; background: #f9fafb; border-top: 1px solid #e5e7eb; text-align: right; }

/* ── Product thumbnail ─────────────────────────────────── */
.stpp-thumb-img {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    display: block;
}

/* ── Product name ──────────────────────────────────────── */
.stpp-product-link {
    font-size: 14px;
    font-weight: 500;
    color: #111827;
    text-decoration: none;
}
.stpp-product-link:hover { color: #dc2626; }

.stpp-sku {
    font-size: 11px;
    color: #9ca3af;
    margin-top: 2px;
}

/* ── Pricing states ────────────────────────────────────── */
.stpp-price-original {
    text-decoration: line-through;
    color: #9ca3af;
    font-size: 12px;
    line-height: 1.4;
}

.stpp-price-tier {
    color: #15803d;
    font-weight: 600;
    font-size: 15px;
    line-height: 1.4;
}

.stpp-savings {
    font-size: 11px;
    color: #16a34a;
    font-weight: 500;
    margin-top: 2px;
}

/* ── Tier badge ────────────────────────────────────────── */
.stpp-tier-badge {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    margin-top: 4px;
    font-size: 10px;
    font-weight: 600;
    background: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
    padding: 2px 7px;
    border-radius: 20px;
}

/* ── Remove button ─────────────────────────────────────── */
.stpp-remove-item {
    color: #d1d5db;
    transition: color .15s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.stpp-remove-item:hover { color: #dc2626; }

/* ── Update cart button ────────────────────────────────── */
.stpp-update-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #374151;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: background .15s;
}
.stpp-update-btn:hover { background: #1f2937; }

/* ── Quantity input ────────────────────────────────────── */
.stpp-cart-table .quantity input {
    text-align: center;
    width: 60px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 6px 8px;
    font-size: 14px;
}
</style>
