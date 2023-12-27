<?php 

add_filter( 'wcmp_sold_by_text_after_products_shop_page', 'bakan_custom_filter_soldby' );
add_filter( 'wcmp_styles_to_keep', 'bakan_wcmp_keep_style' );
function bakan_wcmp_keep_style(){
	return  array('admin-bar', 'select2', 'dashicons', 'qtip_css', 'bakan-googlefonts', 'bakan-css', 'sw_tools_plugin');
}
function bakan_custom_filter_soldby(){
	return false;
}

add_action( 'woocommerce_before_shop_loop_item_title', 'bakan_custom_action_soldby', 11 );
function bakan_custom_action_soldby(){
	global $post;
	if ('Enable' === get_wcmp_vendor_settings('sold_by_catalog', 'general') ) {
		$vendor = get_wcmp_product_vendors($post->ID);
		if ($vendor) {
			$sold_by_text = apply_filters('wcmp_sold_by_text', esc_html__('Sold By', 'bakan'), $post->ID);
			echo '<a class="by-vendor-name-link" style="display: block;" href="' . $vendor->permalink . '">' . $sold_by_text . ' <span>' . $vendor->user_data->display_name . '</span></a>';
			do_action('after_sold_by_text_shop_page', $vendor);
		}
	}
}