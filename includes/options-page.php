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
        Field::make( 'checkbox', 'cart_remove_active', __( 'Delete Cart Items on Checkout Page' ) ),
        // ->set_html( '<h2>Lorem ipsum</h2><p>Quisque mattis ligula.</p>' ),\\
        Field::make( 'html', 'crb_information_text' )
    ->set_html( '<img src="' . PRE_BUILD_SNIPPETS_URL . 'assets/cart-remove.png" width="400"/>')
    ]);  
}

add_action( 'after_setup_theme', 'crb_load_pbs' );
function crb_load_pbs() {
    \Carbon_Fields\Carbon_Fields::boot();
}

