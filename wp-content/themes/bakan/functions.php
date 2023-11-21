<?php 

use ElementorPro\Modules\ThemeBuilder\Module;
use ElementorPro\Modules\ThemeBuilder\Classes\Theme_Support;

/**
 * Variables
 */

//require_once ( get_template_directory().'/lib/activation.php' );

require_once ( get_template_directory().'/lib/plugin-requirement.php' );
require_once ( get_template_directory().'/lib/import/sw-import.php' );

require_once ( get_template_directory().'/lib/defines.php' );
require_once ( get_template_directory().'/lib/sidebars.php' );
require_once ( get_template_directory().'/lib/mobile-layout.php' );
require_once ( get_template_directory().'/lib/utils.php' );			// Utility functions
require_once ( get_template_directory().'/lib/init.php' );			// Initial theme setup and constants
require_once ( get_template_directory().'/lib/cleanup.php' );		// Cleanup
require_once ( get_template_directory().'/lib/nav.php' );			// Custom nav modifications
require_once ( get_template_directory().'/lib/custom-color.php' );		// Scripts and stylesheets
require_once ( get_template_directory().'/lib/scripts.php' );		// Scripts and stylesheets

if( class_exists( 'WooCommerce' ) ){
	require_once ( get_template_directory().'/lib/woocommerce-hook.php' );	// Utility functions
	
	if( class_exists( 'WC_Vendors' ) ) :
		require_once ( get_template_directory().'/lib/wc-vendor-hook.php' );			/** WC Vendor **/
	endif;
	
	if( class_exists( 'WeDevs_Dokan' ) ) :
		require_once ( get_template_directory().'/lib/dokan-vendor-hook.php' );			/** Dokan Vendor **/
	endif;
	
	if( class_exists( 'WCMp' ) ) :
		require_once ( get_template_directory().'/lib/wc-marketplace-hook.php' );			/** WC MarketPlace Vendor **/
	endif;
}



add_action( 'elementor/theme/register_locations', 'custom_location_action' );
function custom_location_action( $location_manager ){
	$core_locations = $location_manager->get_core_locations();
	$overwrite_header_location = false;
	$overwrite_footer_location = false;

	foreach ( $core_locations as $location => $settings ) {
		if ( ! $location_manager->get_location( $location ) ) {
			if ( 'header' === $location ) {
				$overwrite_header_location = true;
			} elseif ( 'footer' === $location ) {
				$overwrite_footer_location = true;
			}
			$location_manager->register_core_location( $location, [
				'overwrite' => true,
			] );
		}
	}
	if ( $overwrite_header_location || $overwrite_footer_location ) {
		if( !bakan_mobile_check() ){
			$theme_builder_module = Module::instance();

			$conditions_manager = $theme_builder_module->get_conditions_manager();

			$headers = $conditions_manager->get_documents_for_location( 'header' );
			$footers = $conditions_manager->get_documents_for_location( 'footer' );
			
			$support = new Theme_Support();
			
			if ( ! empty( $headers ) || ! empty( $footers ) ) {
				add_action( 'get_header', [ $support, 'get_header' ] );
				add_action( 'get_footer', [ $support, 'get_footer' ] );
			}
		}
	}	
}
remove_action( 'wp_body_open', 'wp_admin_bar_render', 0 );

add_action( 'elementor/editor/after_enqueue_styles', 'bakan_custom_style_elementor_backend' );
function bakan_custom_style_elementor_backend(){
	wp_enqueue_style('bakan-elementor-editor', get_template_directory_uri() . '/css/bakan-elementor-editor.css', array(), null);
}
function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );

/**
* Support SVG
**/
function bakan_businessplus_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'bakan_businessplus_mime_types');
add_filter('mime_types', 'bakan_businessplus_mime_types');

add_action("woocommerce_order_item_meta_end", "email_order_custom_field", 999, 4);

function email_order_custom_field($item_id, $item, $order, $plain_text)
{
    $address = get_field('statuscode', $item->get_product_id());

    echo ($address) ?
        '<div>Address: ' . $address . '</div>'
        :
        '<div>Address: No address found!</div>';
};