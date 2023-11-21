<?php
/***** Active Plugin ********/
require_once( get_template_directory().'/lib/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'bakan_register_required_plugins' );
function bakan_register_required_plugins() {
    $plugins = array(
		array(
            'name'               => esc_html__( 'WooCommerce', 'bakan' ), 
            'slug'               => 'woocommerce', 
            'required'           => true, 
			'version'			 => '7.2'
        ),

        array(
            'name'               => esc_html__( 'Revslider', 'bakan' ), 
            'slug'               => 'revslider', 
            'source'             => esc_url('https://demo.wpthemego.com/modules/revslider.zip'),   
            'required'           => true,
            'version'            => '6.6.8'
        ),
		
		array(
            'name'               => esc_html__( 'Elementor', 'bakan' ), 
            'slug'               => 'elementor',
            'required'           => true,
        ),
		
		array(
            'name'               => esc_html__( 'Elementor Pro', 'bakan' ), 
            'slug'               => 'elementor-pro', 
            'source'             => esc_url('https://demo.wpthemego.com/modules/elementor-pro.zip'),  
            'required'           => true, 
            'version'            => '3.9.2'
        ),  

       	array(
            'name'     			 => esc_html__( 'SW Core', 'bakan' ),
            'slug'      		 => 'sw_core',
			'source'         	 => esc_url( get_template_directory_uri() . '/lib/plugins/sw_core.zip' ), 
            'required'  		 => true,   
			'version'			 => '1.0.2'
		),
 	
		array(
            'name'     			 => esc_html__( 'SW Woo Elements', 'bakan' ),
            'slug'      		 => 'sw-woo-elements',
			'source'         	 => esc_url( get_template_directory_uri() . '/lib/plugins/sw-woo-elements.zip' ), 
            'required'  		 => true,
			'version'			 => '1.0.4'
        ),
		
		array(
            'name'     			 => esc_html__( 'SW Add To Cart Notification', 'bakan' ),
            'slug'      		 => 'sw-add-to-cart-notification',
			'source'         	 => esc_url( get_template_directory_uri() . '/lib/plugins/sw-add-to-cart-notification.zip' ), 
            'required'  		 => true,
			'version'			 => '1.0.0'
        ),
		
		array(
            'name'     			 => esc_html__( 'SW Post Elements', 'bakan' ),
            'slug'      		 => 'sw-post-elements',
			'source'         	 => esc_url( get_template_directory_uri() . '/lib/plugins/sw-post-elements.zip' ), 
            'required'  		 => true,
			'version'			 => '1.0.3'
        ),
		
		array(
            'name'     			 => esc_html__( 'SW Ajax Woocommerce Search', 'bakan' ),
            'slug'      		 => 'sw_ajax_woocommerce_search',
			'source'         	 => esc_url( get_template_directory_uri() . '/lib/plugins/sw_ajax_woocommerce_search.zip' ), 
            'required'  		 => true,
			'version'			 => '1.3.0'
        ),
		
		array(
            'name'     			 => esc_html__( 'Sw Woocommerce Swatches', 'bakan' ),
            'slug'      		 => 'sw_wooswatches',
			'source'         	 => esc_url( get_template_directory_uri() . '/lib/plugins/sw_wooswatches.zip' ), 
            'required'  		 => true,
			'version'			 => '1.0.19'
        ),
		
		array(
            'name'     			 => esc_html__( 'Sw Product Bundles', 'bakan' ),
            'slug'      		 => 'sw-product-bundles',
			'source'         	 => esc_url( get_template_directory_uri() . '/lib/plugins/sw-product-bundles.zip' ), 
            'required'  		 => true,
			'version'			 => '2.2.3'
        ),
		
        array(
            'name'               => esc_html__( 'Sw Product Brand', 'bakan' ),
            'slug'               => 'sw_product_brand',
            'source'             => esc_url( get_template_directory_uri() . '/lib/plugins/sw_product_brand.zip' ), 
            'required'           => true,
            'version'            => '1.0.9'
        ),

		array(
            'name'               => esc_html__( 'One Click Install', 'bakan' ), 
            'slug'               => 'one-click-demo-import', 
            'source'             => esc_url('https://demo.wpthemego.com/modules/one-click-demo-import.zip' ), 
            'required'           => true,
            'version'            => '9.9.10'
        ),

		array(
            'name'      		 => esc_html__( 'MailChimp for WordPress Lite', 'bakan' ),
            'slug'     			 => 'mailchimp-for-wp',
            'required' 			 => false,
        ),
		array(
            'name'      		 => esc_html__( 'Contact Form 7', 'bakan' ),
            'slug'     			 => 'contact-form-7',
            'required' 			 => false,
        ),
		array(
            'name'     			 => esc_html__( 'YITH Woocommerce Wishlist', 'bakan' ),
            'slug'      		 => 'yith-woocommerce-wishlist',
            'required' 			 => false,
        ),
		array(
		  'name'      			 => esc_html__( 'YITH Woocommerce Compare', 'bakan' ),
		  'slug'      			 => 'yith-woocommerce-compare',
		  'required'			 => false
		  ),
    );		
    $config = array();

    tgmpa( $plugins, $config );

}
add_action( 'vc_before_init', 'bakan_vcSetAsTheme' );
function bakan_vcSetAsTheme() {
    vc_set_as_theme();
}