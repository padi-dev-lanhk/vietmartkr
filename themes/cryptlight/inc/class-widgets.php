<?php if (!defined( 'ABSPATH' )) exit;

if( !class_exists('Cryptlight_Widgets') ){
	
	class Cryptlight_Widgets {

		function __construct(){

			/**
			 * Regsiter Widget
			 */
			add_action( 'widgets_init', array( $this, 'cryptlight_register_widgets' ) );

		}
		

		function cryptlight_register_widgets() {
		  
		  $args_blog = array(
		    'name' => esc_html__( 'Main Sidebar', 'cryptlight'),
		    'id' => "main-sidebar",
		    'description' => esc_html__( 'Main Sidebar', 'cryptlight' ),
		    'class' => '',
		    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    'after_widget' => "</div>",
		    'before_title' => '<h4 class="widget-title">',
		    'after_title' => "</h4>",
		  );
		  register_sidebar( $args_blog );

		  if( cryptlight_is_woo_active() ){
		    $args_woo = array(
		      'name' => esc_html__( 'WooCommerce Sidebar', 'cryptlight'),
		      'id' => "woo-sidebar",
		      'description' => esc_html__( 'WooCommerce Sidebar', 'cryptlight' ),
		      'class' => '',
		      'before_widget' => '<div id="%1$s" class="widget woo_widget %2$s">',
		      'after_widget' => "</div>",
		      'before_title' => '<h4 class="widget-title">',
		      'after_title' => "</h4>",
		    );
		    register_sidebar( $args_woo );
		  }
		  

		}


	}
}

return new Cryptlight_Widgets();