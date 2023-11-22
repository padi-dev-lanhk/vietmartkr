<?php
/**
 * Plugin Name: SW Core
 * Plugin URI: http://www.smartaddons.com
 * Description: A plugin developed for many shortcode in theme
 * Version: 1.0.2
 * Author: Smartaddons
 * Author URI: http://www.smartaddons.com
 * This Widget help you to show images of product as a beauty reponsive slider
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

if( !function_exists( 'is_plugin_active' ) ){
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

/* define plugin path */
if ( ! defined( 'SWPATH' ) ) {
	define( 'SWPATH', plugin_dir_path( __FILE__ ) );
}

/* define plugin URL */
if ( ! defined( 'SWURL' ) ) {
	define( 'SWURL', plugins_url(). '/sw_core' );
}

/* define plugin URL */
if ( ! defined( 'SWG_OPTIONS_URL' ) ) {
	define( 'SWG_OPTIONS_URL', SWURL . '/inc' );
}

/* define plugin URL */
if ( ! defined( 'SWG_OPTIONS_DIR' ) ) {
	define( 'SWG_OPTIONS_DIR', SWPATH . 'inc' );
}

if( !class_exists( 'Mobile_Detect' ) ) {
	require_once( SWPATH . 'inc/mobile-detect.php' );
}

function sw_core_construct(){	
	
	/* define options */
	if ( !defined( 'ICL_LANGUAGE_CODE' ) && !defined('SWG_THEME') ){
		define( 'SWG_THEME', 'bakan_theme' );
	}else{
		define( 'SWG_THEME', 'bakan_theme'.ICL_LANGUAGE_CODE );
	}
	
	/*
	** Require file
	*/
	
	require_once( SWPATH . 'inc/inc.php' );
	require_once( SWPATH . 'sw_plugins/sw-plugins.php' );
	
	if( class_exists( 'Vc_Manager' ) ){
		require_once ( SWPATH . '/visual-map.php' );
	}
	
	/*
	** Load text domain
	*/
	load_plugin_textdomain( 'sw_core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	
	/*
	** Call action and filter
	*/

	add_filter('widget_text', 'do_shortcode');
	add_action( 'wp_enqueue_scripts', 'Sw_AddScript', 20 );
	add_action( 'wp_enqueue_scripts', 'Sw_Custom_AddScript', 200 );
}

add_action( 'plugins_loaded', 'sw_core_construct', 20 );

function Sw_AddScript(){
	wp_register_style('ya_photobox_css', SWURL . '/css/photobox.css', array(), null);	
	wp_register_style('fancybox_css', SWURL . '/css/jquery.fancybox.css', array(), null);
	wp_register_style('shortcode_css', SWURL . '/css/shortcodes.css', array(), null);
	wp_register_script('photobox_js', SWURL . '/js/photobox.js', array(), null, true);
	wp_register_script('fancybox', SWURL . '/js/jquery.fancybox.pack.js', array(), null, true);
	wp_enqueue_style( 'fancybox_css' );
	wp_enqueue_style( 'shortcode_css' );
	wp_enqueue_script( 'fancybox' );
}

function Sw_Custom_AddScript(){
	wp_dequeue_style('fontawesome');
	wp_dequeue_style('slick_slider_css');
	wp_dequeue_style('fontawesome_css');
	wp_dequeue_style('shortcode_css');
	wp_dequeue_style('yith-wcwl-font-awesome');
	wp_dequeue_style('tabcontent_styles');	
}

/***********************
Sw Text block
************************/
function bakan_text_blog( $atts ){
	extract( shortcode_atts( array(
		'title'		=> '',
		'title2'	=> '',
		'description'	=> '',
		'images'	=> '',
		'images2'	=> '',
		'readmore'	=> '',
		'links'	    => '',
		'style'	    => '',
	), $atts )
);
ob_start();	?>
<div class="bakan-text-block clearfix <?php echo $style; ?>">
	<div class="content-info">
		<div class="image"><?php echo wp_get_attachment_image( $images, 'full' ); ?></div>
		<div class="content-bot">
			<?php if( $title != '' ) : ?>
				<h3><a href="<?php echo $links; ?>"><?php echo $title; ?></a></h3>
			<?php endif; ?>
			<p><?php echo $description; ?></p>
		</div>
	</div>
</div>
<?php 
$output = ob_get_clean();
return $output;
}
add_shortcode('sw_text_blog','bakan_text_blog');