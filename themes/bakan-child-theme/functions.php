<?php add_action( 'wp_enqueue_scripts', 'bakan_enqueue_styles' );
function bakan_enqueue_styles() {
    wp_enqueue_style( 'bakan-style', get_template_directory_uri() . '/style.css' );

}