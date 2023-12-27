<?php 
/*
	* Name: WC Vendor Hook
	* Develop: SmartAddons
*/

/*
** Wrapper for dashboard
*/
add_action( 'wcvendors_before_dashboard', 'bakan_wrapper_before_vendor_dashboard' );
add_action( 'wcvendors_after_dashboard', 'bakan_wrapper_after_vendor_dashboard' );
function bakan_wrapper_before_vendor_dashboard(){
	echo '<div class="vendor-dashboard-wrapper">';
}

function bakan_wrapper_after_vendor_dashboard(){
	echo '</div>';
}

add_action( 'wp', 'bakan_wcvendor_hook' );
function bakan_wcvendor_hook(){
	$wc_prd_vendor_options 	= get_option( 'wc_prd_vendor_options' ); 
	$pro_store_header		= ( isset( $wc_prd_vendor_options[ 'vendor_store_header_type' ] ) ) ? $wc_prd_vendor_options[ 'vendor_store_header_type' ] : ''; 
	if( 'pro' !== $pro_store_header ) {
		remove_action( 'woocommerce_before_main_content', array( 'WCV_Vendor_Shop', 'shop_description' ), 30 );
		add_action( 'woocommerce_archive_description', array( 'WCV_Vendor_Shop', 'shop_description' ), 10 );
	}else{
		if( WCV_Vendors::is_vendor_page() ) {
			add_action( 'woocommerce_before_main_content', 'bakan_vendor_breadcrumb', 9 );
			remove_action( 'woocommerce_before_main_content', 'bakan_banner_listing', 10 );
		}
	}
	if( WCV_Vendors::is_vendor_page() ) {
		add_action( 'woocommerce_before_main_content', 'bakan_vendor_breadcrumb', 9 );
	}
}

function bakan_vendor_breadcrumb(){
?>
	<div class="bakan_breadcrumbs">
		<div class="container">
			<?php
				if (!is_front_page() ) {
					if (function_exists('bakan_breadcrumb')){
						bakan_breadcrumb('<div class="breadcrumbs theme-clearfix">', '</div>');
					} 
				} 
			?>
		</div>
	</div>
<?php 
}


remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9 );
add_action( 'woocommerce_single_product_summary', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 55 );
add_action( 'woocommerce_single_product_summary', 'bakan_soldby_wrapper_start', 51 );
add_action( 'woocommerce_single_product_summary', 'bakan_soldby_wrapper_end', 56 );
function bakan_soldby_wrapper_start(){
	echo '<div class="wc-soldby-start">';
}

function bakan_soldby_wrapper_end(){
	echo '</div>';
}


/*
** Add wrapper sold by
*/
add_filter( 'wcvendors_sold_by_in_loop', 'bakan_custom_soldby' );
function bakan_custom_soldby( $sold_by_label ){
	return '<span>' . $sold_by_label . '</span>';
}