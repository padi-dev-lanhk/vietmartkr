<?php
/**
 * Enqueue scripts and stylesheets
 *
 */

function bakan_scripts() {	
	$scheme_meta = get_post_meta( get_the_ID(), 'scheme', true );
	$scheme = ( $scheme_meta != '' && $scheme_meta != 'none' ) ? $scheme_meta : swg_options('scheme');
	$bakan_direction = swg_options('direction');
	
	$app_css 	= get_template_directory_uri() . '/css/app-default.css';
	$mobile_css = get_template_directory_uri() . '/css/mobile-default.css';
	if ( $scheme ){
		$mobile_css = get_template_directory_uri() . '/css/mobile-'.$scheme.'.css';		
	} 
	
	wp_dequeue_style('fontawesome');
	wp_deregister_style( 'dokan-fontawesome' );
	wp_deregister_style( 'yith-wcwl-font-awesome' );
	
	/* enqueue script & style */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), null);	
	wp_enqueue_style('datetimepicker-css', get_template_directory_uri() . '/css/bootstrap-datetimepicker.min.css', array(), null);	
	wp_enqueue_style('fontawesome1', get_template_directory_uri() . '/css/font-awesome.min.css', array(), null);	
	wp_enqueue_style('bakan-css', $app_css, array(), null);
	wp_enqueue_script('loadimage', get_template_directory_uri() . '/js/load-image.min.js', array('jquery'), null, true);
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, true);
	wp_enqueue_script('datetimepicker-script', get_template_directory_uri() . '/js/bootstrap-datetimepicker.min.js', array('jquery'), null, true);
	wp_enqueue_script('slick-slider',get_template_directory_uri().'/js/slick.min.js',array(),null,true);
	wp_enqueue_script('nav-bar', get_template_directory_uri() . '/js/jquery.nav.js', array('jquery'), null, true);
	
	if( is_rtl() || $bakan_direction == 'rtl' ){
		wp_enqueue_style('rtl-css', get_template_directory_uri() . '/css/rtl.css', array(), null);
	}
	wp_enqueue_style('bakan-responsive', get_template_directory_uri() . '/css/app-responsive.css', array(), null);
	
	/* Load style.css from child theme */
	if (is_child_theme()) {
		wp_enqueue_style('bakan-child', get_stylesheet_uri(), false, null);
	}
	
	if( !wp_script_is( 'jquery-cookie' ) ){
		wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.min.js', array('jquery'), null, true);
	}

	if ( ( is_single() || is_page() ) && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}	
	
	if( is_archive() && swg_options( 'blog_layout' ) === 'grid' ){
		$output = "jQuery(window).load(function () {
			jQuery('body').find('.blog-content-grid').isotope({
				layoutMode: 'masonry'
			});
		});";
		wp_enqueue_script('isotope_script', get_template_directory_uri() . '/js/isotope.js', array(), null, true);
		wp_add_inline_script( 'isotope_script', $output );
	}
	
	if ( !is_admin() ){
		
		$translation_text = array(
			'cart_text' 		 => esc_html__( 'Thêm vào giỏ hàng', 'bakan' ),
			'compare_text' 	 => esc_html__( 'Add To Compare', 'bakan' ),
			'wishlist_text'  => esc_html__( 'Yêu thích', 'bakan' ),
			'quickview_text' => esc_html__( 'Xem nhanh', 'bakan' ),
			'ajax_url' => admin_url( 'admin-ajax.php', 'relative' ), 
			'redirect' => get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ),
			'message' => esc_html__( 'Please enter your usename and password', 'bakan' ),
		);
		
		wp_localize_script( 'bakan-custom-js', 'custom_text', $translation_text );
		wp_enqueue_script( 'bakan-custom-js', get_template_directory_uri() . '/js/main.js', array(), null, true );
	}
	
	$overflow_text = array(
		'more_text' => esc_html__( 'More...', 'bakan' ),
		'more_menu'	=> swg_options( 'more_menu' )
	);
	wp_register_script('menu-overflow', get_template_directory_uri() . '/js/menu-overflow.js', array(), null, true);
	wp_localize_script( 'menu-overflow', 'menu_text', $overflow_text );
	wp_enqueue_script( 'menu-overflow' );
	
	/*
	** QuickView
	*/
	if( class_exists( 'WooCommerce' ) ) {
		global $woocommerce;
		$assets_path          = str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/';
		$frontend_script_path = $assets_path . 'js/frontend/';
		$wc_ajax_url 					= WC_AJAX::get_endpoint( "%%endpoint%%" );
		$admin_url 						= admin_url('admin-ajax.php');	
		$bakan_dest_folder = ( function_exists( 'sw_wooswatches_construct' ) ) ? 'woocommerce' : 'woocommerce_select';
		$woocommerce_params = array(
			'ajax'  => array(
				'url'	=> $admin_url
			)
		);
		$_wpUtilSettings = array(
			'ajax_url'     => $woocommerce->ajax_url(),
			'wc_ajax_url'  => 	$wc_ajax_url
		);
		$wc_add_to_cart_variation_params = array(
			'i18n_no_matching_variations_text' => esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'bakan' ),
			'i18n_make_a_selection_text'       => esc_attr__( 'Please select some product options before adding this product to your cart.', 'bakan' ),
			'i18n_unavailable_text'            => esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'bakan' ),
		);
		
		$quickview_text = array(			
			'ajax_url' => WC_AJAX::get_endpoint( "%%endpoint%%" ), 			
			'wp_embed' => esc_url ( home_url('/') . 'wp-includes/js/wp-embed.min.js' ),
			'underscore' =>  esc_url ( home_url('/') . 'wp-includes/js/underscore.min.js' ),
			'wp_util' =>  esc_url ( home_url('/') . 'wp-includes/js/wp-util.min.js' ),
			'add_to_cart' => esc_url( $frontend_script_path . 'add-to-cart.min.js' ),
			'woocommerce' => esc_url( $frontend_script_path . 'woocommerce.min.js' ),
			'wc_quantity_increment' => esc_url( get_template_directory_uri() . '/js/wc-quantity-increment-view.min.js' ),
			'add_to_cart_variable' => esc_url( get_template_directory_uri() . '/js/'. $bakan_dest_folder .'/add-to-cart-variation.min.js' ),
			'wpUtilSettings' => json_encode( $_wpUtilSettings ),
			'woocommerce_params' => json_encode( $woocommerce_params ),
			
			'wc_add_to_cart_variation_params' => json_encode( $wc_add_to_cart_variation_params )
		);
		wp_register_script('sw-quickview', get_template_directory_uri() . '/js/quickview.js', array(), null, true);
		wp_localize_script( 'sw-quickview', 'quickview_param', $quickview_text );
		wp_enqueue_script( 'sw-quickview' );
		
		wp_enqueue_script('wc-quantity', get_template_directory_uri() . '/js/wc-quantity-increment.min.js', array('jquery'), null, true);
		if( class_exists( 'WeDevs_Dokan' ) && dokan_get_option( 'dashboard', 'dokan_pages', 0 ) == get_the_ID() ){
			wp_dequeue_script('wc-quantity');
		}
	}
	
	/*
	** Dequeue and enqueue css, js mobile
	*/
	if( bakan_mobile_check() ) :
		if( is_front_page() || is_home() ) :
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		endif;
		if( !swg_options( 'mobile_jquery' ) ){
			wp_dequeue_script( 'tp-tools' );
			wp_dequeue_script( 'revmin' );
		}
		wp_dequeue_style( 'jquery-colorbox' );
		wp_dequeue_style( 'colorbox' );
		wp_dequeue_script( 'jquery-colorbox' );
		wp_dequeue_script( 'bakan-megamenu' );
		wp_dequeue_script( 'moneyjs' );
		wp_dequeue_script( 'accountingjs' );
		wp_dequeue_script( 'wc-currency-converter' );
		wp_dequeue_script( 'yith-woocompare-main' );
		wp_enqueue_style('bakan-mobile', $mobile_css, array(), null);
	endif;
	
	/*
	** Dequeue some css and jquery mobile responsive
	*/
	
	global $sw_detect;
	if( !empty( $sw_detect ) && $sw_detect->isMobile() && !$sw_detect->isTablet() ){
		wp_dequeue_style( 'jquery-colorbox' );
		wp_dequeue_style( 'colorbox' );
		wp_dequeue_script( 'jquery-colorbox' );
		wp_dequeue_script( 'bakan-megamenu' );
		wp_dequeue_script( 'yith-woocompare-main' );
	}
}
add_action('wp_enqueue_scripts', 'bakan_scripts', 10);
