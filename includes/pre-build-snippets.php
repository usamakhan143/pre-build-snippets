<?php

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

add_filter( 'woocommerce_product_add_to_cart_text', 'add_to_cart_button_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'add_to_cart_button_text' );


