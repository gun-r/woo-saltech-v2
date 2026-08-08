<?php
defined( 'ABSPATH' ) || exit;
global $product;
echo apply_filters( 'woocommerce_loop_add_to_cart_link',
    sprintf( '<a href="%s" data-quantity="%s" class="button add_to_cart_button px-4 py-2 bg-brand text-white rounded" %s>%s</a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
        isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
        esc_html( $product->add_to_cart_text() )
    ),
$product, $args );