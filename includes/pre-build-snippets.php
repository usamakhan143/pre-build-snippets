<?php

add_action('init', 'showData');
function showData()
{
    echo get_s_field('test_field');
    $slides = get_s_field( 'crb_repeater_fields' );
    echo '<ul>';
    foreach ( $slides as $slide ) {
        echo '<li>';
        echo '<h2>' . $slide['find_text'] . $slide['replace_text'] . '</h2>';
        echo '</li>';
    }
    echo '</ul>';
}