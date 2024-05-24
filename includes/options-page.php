<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'create_options_page_pbs');
function create_options_page_pbs()
{
    Container::make('theme_options', __('Pre Build Snippets'))
        ->set_icon('dashicons-media-code')
        ->add_fields([
            Field::make('checkbox', 'add_to_cart_button_text_active', __('Change WooCommerce Add to cart button text')),
            Field::make('text', 'add_to_cart_button_text', 'Add to Cart Button Text')
                ->set_conditional_logic(array(
                    array(
                        'field' => 'add_to_cart_button_text_active',
                        'value' => true,
                    )
                ))
                ->set_attribute('placeholder', 'Enter Custom Text for Add to cart Button')

        ])
        ->add_fields([
            Field::make('checkbox', 'cart_remove_active', __('Delete WooCommerce cart items on the checkout page')),
            // ->set_html( '<h2>Lorem ipsum</h2><p>Quisque mattis ligula.</p>' ),\\
            Field::make('html', 'crb_information_text')
                ->set_html('<img src="' . PRE_BUILD_SNIPPETS_URL . 'assets/images/cart-remove.png" width="300"/>')
        ])
        ->add_fields([
            Field::make('checkbox', 'cart_empty_leaving_checkout_active', __('Empty the WooCommerce cart after leaving the checkout without making a purchase')),
        ])
        ->add_fields([
            Field::make('checkbox', 'return_to_shop_url_active', __('Change WooCommerce "Return to Shop" URL')),
            Field::make('text', 'return_to_shop_url', 'Change Return to Shop URL')
                ->set_conditional_logic(array(
                    array(
                        'field' => 'return_to_shop_url_active',
                        'value' => true,
                    )
                ))
                ->set_attribute('placeholder', 'Enter Custom URL')
                ->set_help_text('https://domain.com'),
            // ->set_html( '<h2>Lorem ipsum</h2><p>Quisque mattis ligula.</p>' ),\\
            Field::make('html', 'return_to_shop_url_information_text')
                ->set_html('<img src="' . PRE_BUILD_SNIPPETS_URL . 'assets/images/return-to-shop.png" width="300"/>')
        ])
        ->add_fields([
            Field::make('checkbox', 'return_to_shop_text_active', __('Change WooCommerce "Return to Shop" Text')),
            Field::make('text', 'return_to_shop_text', 'Change Return to Shop Button Text')
                ->set_conditional_logic(array(
                    array(
                        'field' => 'return_to_shop_text_active',
                        'value' => true,
                    )
                ))
                ->set_attribute('placeholder', 'Enter Custom Text')
                ->set_help_text('E.g. Back to Home'),
            // ->set_html( '<h2>Lorem ipsum</h2><p>Quisque mattis ligula.</p>' ),\\
            Field::make('html', 'return_to_shop_text_information_text')
                ->set_html('<img src="' . PRE_BUILD_SNIPPETS_URL . 'assets/images/return-to-shop-text.png" width="300"/>')
        ])
        ->add_fields([
            Field::make('checkbox', 'wc_price_suffix_active', __('Add Suffix to WooCommerce Price')),
            Field::make('text', 'wc_suffix_price', 'Suffix')
                ->set_conditional_logic(array(
                    array(
                        'field' => 'wc_price_suffix_active',
                        'value' => true,
                    )
                ))
                ->set_attribute('placeholder', 'Enter Suffix Text')
                ->set_help_text('E.g. $20 per day, The "per day" is a suffix')
        ])
        ->add_fields([
            Field::make('checkbox', 'wc_price_prefix_active', __('Add Prefix to WooCommerce Price')),
            Field::make('text', 'wc_prefix_price', 'Prefix')
                ->set_conditional_logic(array(
                    array(
                        'field' => 'wc_price_prefix_active',
                        'value' => true,
                    )
                ))
                ->set_attribute('placeholder', 'Enter Prefix Text')
                ->set_help_text('E.g. Starting from $20, The "Starting from" is a Prefix')
        ])
        ->add_fields([
            Field::make('checkbox', 'custom_add_to_cart_btn_active', __('Create a custom button on the WooCommerce catalog page that can navigate you to the single product page')),
            Field::make('text', 'custom_add_to_cart_btn', 'Button Text')
                ->set_conditional_logic(array(
                    array(
                        'field' => 'custom_add_to_cart_btn_active',
                        'value' => true,
                    )
                ))
                ->set_attribute('placeholder', 'Enter Custom Text')
        ])
        ->add_fields([
            Field::make('checkbox', 'login_before_checkout_active', __('Login before WooCommerce checkout')),
            Field::make('text', 'wc_checkout_page_id', 'WooCommerce Checkout Page ID')
                ->set_conditional_logic(array(
                    array(
                        'field' => 'login_before_checkout_active',
                        'value' => true,
                    )
                ))
                ->set_attribute('placeholder', 'Enter your WooCommerce Checkout Page ID')
        ])
        ->add_fields([
            Field::make('checkbox', 'yith_booking_checkout_css_active', __('Checkout CSS when Yith Booking Enabled')),
            Field::make('html', 'yith_booking_checkout_css_information_text')
                ->set_html('<img src="' . PRE_BUILD_SNIPPETS_URL . 'assets/images/yith-booking-checkout-css.png" width="300"/>')
            // ->set_help_text('If Yith Booking is enable use this css to fix the checkout order details section')
        ])
        ->add_fields([
            Field::make('checkbox', 'tm_extraprooption_css_active', __('TM Extra Product Option CSS on single product page')),
            Field::make('html', 'tm_extraprooption_css_information_text')
                ->set_html('<img src="' . PRE_BUILD_SNIPPETS_URL . 'assets/images/tm-extraprooption-css.png" width="300"/>')
        ]);
}

add_action('after_setup_theme', 'crb_load_pbs');
function crb_load_pbs()
{
    \Carbon_Fields\Carbon_Fields::boot();
}
