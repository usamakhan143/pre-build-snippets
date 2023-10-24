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

    if(get_pbs_fields('cart_empty_leaving_checkout_active') == 'yes') {
        add_action( 'wp_head', 'bryce_clear_cart' );
    }

    if(get_pbs_fields('return_to_shop_url_active') == 'yes') {
        add_filter( 'woocommerce_return_to_shop_redirect', 'pbs_wc_empty_cart_redirect_url' );
    }

    if(get_pbs_fields('return_to_shop_text_active') == 'yes') {
        add_filter( 'gettext', 'change_wc_return_to_shop_text', 20, 3 );
    }

    if(get_pbs_fields('wc_price_suffix_active') == 'yes') {
        add_filter( 'woocommerce_get_price_suffix', 'pbs_add_price_suffix', 99, 4 );
    }

    if(get_pbs_fields('wc_price_prefix_active') == 'yes') {
        add_filter( 'woocommerce_get_price_html', 'pbs_add_price_prefix', 99, 2 );
    }

    if(get_pbs_fields('custom_add_to_cart_btn_active') == 'yes') {
        add_filter( 'woocommerce_loop_add_to_cart_link', 'pbs_custom_view_product_button', 10, 2 );
    }
    
    if(get_pbs_fields('login_before_checkout_active') == 'yes') {
        add_filter( 'template_redirect', 'check_if_logged_in_before_wc_checkout', 10, 2 );
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
        return __('Add to cart', 'woocommerce');
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


function bryce_clear_cart() {

    if(get_pbs_fields('cart_empty_leaving_checkout_active') == 'yes') {
        if ( wc_get_page_id( 'cart' ) == get_the_ID() || wc_get_page_id( 'checkout' ) == get_the_ID() ) {
            return;
        }
        WC()->cart->empty_cart( true );
    }

}


function pbs_wc_empty_cart_redirect_url() {

    if(get_pbs_fields('return_to_shop_url_active') == 'yes') {
        $url = get_pbs_fields('return_to_shop_url'); // change this link to your need
        return esc_url( $url );
    }

}


function change_wc_return_to_shop_text( $translated_text, $text, $domain ) {

    if(get_pbs_fields('return_to_shop_text_active') == 'yes') {
        $custom_text_rts = get_pbs_fields('return_to_shop_text');
        switch ( $translated_text ) {
            case 'Return to shop' :
                $translated_text = __( $custom_text_rts, 'woocommerce' );
                break;
        }
        return $translated_text;
    }

}

  
function pbs_add_price_suffix( $html, $product, $price, $qty ){
    
    if(get_pbs_fields('wc_price_suffix_active') == 'yes') {
        $wc_suffix = get_pbs_fields('wc_suffix_price');
        $html .= ' '.$wc_suffix;
        return $html;
    }

}


function pbs_add_price_prefix( $price, $product ){
    
    if(get_pbs_fields('wc_price_prefix_active') == 'yes') {
        $wc_prefix = get_pbs_fields('wc_prefix_price');
        $price = $wc_prefix.' '. $price;
        return $price;
    }
}


/**
* @snippet Change WooCommerce ‘Add to Cart’ button to 'Custom Button'
* @compatible WC 4.3.1
*/
// Change WooCommerce 'Add To Cart' button to 'View Product'
function pbs_custom_view_product_button( $button, $product  ) {
        
    if(get_pbs_fields('custom_add_to_cart_btn_active') == 'yes') {
        // Ignore for variable products
        if( $product->is_type( 'variable' ) ) return $button;
        // Button text here
        $btn_text = get_pbs_fields('custom_add_to_cart_btn');
        $button_text = __( $btn_text, "woocommerce" );
            return '<a class="button pbs-custom-view-product-button" href="' . $product->get_permalink() . '">' . $button_text . '</a>';
    }

}


function check_if_logged_in_before_wc_checkout()
{
    $pageid = get_pbs_fields('wc_checkout_page_id'); // your checkout page id
    if(!is_user_logged_in() && is_page($pageid))
    {
        $url = add_query_arg(
            'redirect_to',
            get_permalink($pagid),
            site_url('/my-account/') // your my acount url
        );
        wp_redirect($url);
        exit;
    }
}