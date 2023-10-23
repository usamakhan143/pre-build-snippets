<?php

add_action('wp', 'run_filter');
function run_filter() {

    if(get_pbs_fields('add_to_cart_button_text_active') == 'yes') {
        add_filter( 'woocommerce_product_add_to_cart_text', 'add_to_cart_button_text' );
        add_filter( 'woocommerce_product_single_add_to_cart_text', 'add_to_cart_button_text' );
    }

    if(get_pbs_fields('cart_remove_active') == 'yes') {
        add_filter( 'woocommerce_cart_item_name', 'delete_cart_items_from_checkout_page', 10, 3 );
    }

}

function add_to_cart_button_text()
{
    if(get_pbs_fields('add_to_cart_button_text_active') == 'yes') {
        if(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
            $add_to_cart_text = get_pbs_fields('add_to_cart_button_text');
            return __( $add_to_cart_text, 'woocommerce' );
        }
        
        else {
            return 'WooCommerce plugin should be installed before use this feature.';
        }
    }
    else {
        return __('Add to cart', 'woocommerce' );
    }
}


/**
 * Allows to remove products in checkout page.
 * 
 * @param string $product_name 
 * @param array $cart_item 
 * @param string $cart_item_key 
 * @return string
 */
function delete_cart_items_from_checkout_page($product_name, $cart_item, $cart_item_key) {
    
    if(get_pbs_fields('cart_remove_active') == 'yes') {
        if ( is_checkout() ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            $remove_link = apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">×</a>',
                esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                __( 'Remove this item', 'woocommerce' ),
                esc_attr( $product_id ),
                esc_attr( $_product->get_sku() )
            ), $cart_item_key );

            return '<span>' . $remove_link . '</span> <span>' . $product_name . '</span>';
        }
    }
    return $product_name;
}