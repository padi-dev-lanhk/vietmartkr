<?php
	if(defined('CRYPTLIGHT_URL') 	== false) 	define('CRYPTLIGHT_URL', get_template_directory());
	if(defined('CRYPTLIGHT_URI') 	== false) 	define('CRYPTLIGHT_URI', get_template_directory_uri());

	load_theme_textdomain( 'cryptlight', CRYPTLIGHT_URL . '/languages' );

	// Main Feature
	require_once( CRYPTLIGHT_URL.'/inc/class-main.php' );

	// Functions
	require_once( CRYPTLIGHT_URL.'/inc/functions.php' );

	// Hooks
	require_once( CRYPTLIGHT_URL.'/inc/class-hook.php' );

	// Widget
	require_once (CRYPTLIGHT_URL.'/inc/class-widgets.php');
	

	// Elementor
	if (defined('ELEMENTOR_VERSION')) {
		require_once (CRYPTLIGHT_URL.'/inc/class-elementor.php');
	}
	
	
	
	
	/* Customize */
	if( current_user_can('customize') ){
	    require_once CRYPTLIGHT_URL.'/customize/custom-control/google-font.php';
	    require_once CRYPTLIGHT_URL.'/customize/custom-control/heading.php';
	    require_once CRYPTLIGHT_URL.'/inc/class-customize.php';
	}
    
   
	require_once ( CRYPTLIGHT_URL.'/install-resource/active-plugins.php' );