<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'create_options_page_pbs' );
function create_options_page_pbs() {
    Container::make( 'theme_options', __( 'Pre Build Snippets' ) )
    ->set_icon('dashicons-media-code')
    ->add_fields([
        Field::make( 'checkbox', 'add_to_cart_button_text_active', __( 'Change Add to cart button text' ) ),
        Field::make( 'text', 'add_to_cart_button_text', 'Add to Cart Button Text' )
        ->set_conditional_logic( array(
                array(
                    'field' => 'add_to_cart_button_text_active',
                    'value' => true,
                )
        ))
        ->set_attribute('placeholder', 'Enter Custom Text for Add to cart Button')
    
    ])
    ->add_fields([
        Field::make( 'checkbox', 'cart_remove_active', __( 'Delete cart items on the checkout page' ) ),
        // ->set_html( '<h2>Lorem ipsum</h2><p>Quisque mattis ligula.</p>' ),\\
        Field::make( 'html', 'crb_information_text' )
    ->set_html( '<img src="' . PRE_BUILD_SNIPPETS_URL . 'assets/cart-remove.png" width="400"/>')
    ])
    ->add_fields([
        Field::make( 'checkbox', 'cart_empty_leaving_checkout_active', __( 'Empty the cart after leaving the checkout without making a purchase' ) ),
    ])
    ->add_fields([
        Field::make( 'checkbox', 'return_to_shop_url_active', __( 'Change "Return to Shop" URL' ) ),
        Field::make( 'text', 'return_to_shop_url', 'Change Return to Shop URL' )
        ->set_conditional_logic( array(
                array(
                    'field' => 'return_to_shop_url_active',
                    'value' => true,
                )
        ))
        ->set_attribute('placeholder', 'Enter Custom URL')
        ->set_help_text('https://domain.com'),
        // ->set_html( '<h2>Lorem ipsum</h2><p>Quisque mattis ligula.</p>' ),\\
        Field::make( 'html', 'return_to_shop_url_information_text' )
    ->set_html( '<img src="' . PRE_BUILD_SNIPPETS_URL . 'assets/return-to-shop.png" width="300"/>')
    ])
    ->add_fields([
        Field::make( 'checkbox', 'return_to_shop_text_active', __( 'Change "Return to Shop" Text' ) ),
        Field::make( 'text', 'return_to_shop_text', 'Change Return to Shop Button Text' )
        ->set_conditional_logic( array(
                array(
                    'field' => 'return_to_shop_text_active',
                    'value' => true,
                )
        ))
        ->set_attribute('placeholder', 'Enter Custom Text')
        ->set_help_text('E.g. Back to Home'),
        // ->set_html( '<h2>Lorem ipsum</h2><p>Quisque mattis ligula.</p>' ),\\
        Field::make( 'html', 'return_to_shop_text_information_text' )
    ->set_html( '<img src="' . PRE_BUILD_SNIPPETS_URL . 'assets/return-to-shop-text.png" width="300"/>')
    ]);  
}

add_action( 'after_setup_theme', 'crb_load_pbs' );
function crb_load_pbs() {
    \Carbon_Fields\Carbon_Fields::boot();
}

