<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'create_options_page_pbs' );
function create_options_page_pbs() {
    Container::make( 'theme_options', __( 'Pre Build Snippets' ) )
    ->set_icon('dashicons-media-code');
        
}

add_action( 'after_setup_theme', 'crb_load_pbs' );
function crb_load_pbs() {
    \Carbon_Fields\Carbon_Fields::boot();
}

