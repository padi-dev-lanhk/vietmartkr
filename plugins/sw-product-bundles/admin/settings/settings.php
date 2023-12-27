<?php 

add_filter( 'woocommerce_settings_tabs_array', 'swpb_add_product_bundles', 100 );
function swpb_add_product_bundles( $settings_tab ) {
	$settings_tab['swpb_product_bundles'] = __( 'SW Product Bundles', 'text-domain' );
	return $settings_tab;
}

add_action( 'woocommerce_settings_tabs_swpb_product_bundles', 'swpb_product_bundles_settings' );

function swpb_product_bundles_settings() {
    woocommerce_admin_fields( get_swpb_product_bundles_settings() );
}

add_action( 'woocommerce_update_options_swpb_product_bundles', 'swpb_update_options_product_bundles_settings' );

function swpb_update_options_product_bundles_settings() {
    woocommerce_update_options( get_swpb_product_bundles_settings() );
}

function get_swpb_product_bundles_settings() {
    
    $settings = array(
        
        array(
            'id'   => 'swpb_product_bundles_settings_single_product_title',
            'desc' => 'Product Bundles in Single Product page',
            'type' => 'title',
            'name' => 'Single Product',
        ),
        
        array(
            'id'   => 'swpb_product_bundles_single_product_title',
            'desc' => '',
            'type' => 'text',
            'name' => 'Head Title',
            'default' => 'Buy this bundle and get sale off',
        ),
        
        array(
            'id'   => 'swpb_product_bundles_single_product_layout',
            'type' => 'select',
            'name' => 'Layout',
            'options' => [
                'list' => 'List',
            	'grid' => 'Grid',
                'slider' => 'Slider',
            ],
            'default' => 'grid',
        ),
        
        array(
            'id'   => 'swpb_product_bundles_single_product_style',
            'type' => 'select',
            'name' => 'Style',
            'options' => [
                'default' => 'Default',
                'style-2' => 'Style 2',
                'style-3' => 'Style 3 (for grid and slider)',
            ],
            'default' => 'default',
        ),
        
        array(
            'id'   => 'swpb_product_bundles_single_product_column',
            'desc' => '',
            'type' => 'select',
            'name' => 'Columns of Row',
            'options' => [
            	'1' => '1',
            	'2' => '2',
            	'3' => '3',
            	'4' => '4',
            	'5' => '5',
            	'6' => '6',
            ],
            'default' => '4',
        ),
        
        array(
            'title'           => __( 'Enable', 'woocommerce' ),
            'desc'            => __( 'Show Thumbnail', 'woocommerce' ),
            'id'              => 'swpb_product_bundles_single_product_show_thumbnail',
            'default'         => 'yes',
            'type'            => 'checkbox',
            'checkboxgroup'   => 'start',
        ),
        
        array(
            'title'           => __( 'Enable', 'woocommerce' ),
            'desc'            => __( 'Show Category', 'woocommerce' ),
            'id'              => 'swpb_product_bundles_single_product_show_category',
            'default'         => 'no',
            'type'            => 'checkbox',
            'checkboxgroup'   => '',
        ),

        array(
            'desc'            => __( 'Show Price', 'woocommerce' ),
            'id'              => 'swpb_product_bundles_single_product_show_price',
            'default'         => 'yes',
            'type'            => 'checkbox',
            'checkboxgroup'   => '',
        ),

        array(
            'desc'            => __( 'Show Stock', 'woocommerce' ),
            'id'              => 'swpb_product_bundles_single_product_show_stock',
            'default'         => 'no',
            'type'            => 'checkbox',
            'checkboxgroup'   => 'end',
        ),

        array(
            'type' => 'sectionend',
            'id'   => 'swpb_product_bundles',
        ),

        array(
            'id'   => 'swpb_product_bundles_settings_shop_product_title',
            'desc' => 'Product Bundles in Shop Product page',
            'type' => 'title',
            'name' => 'Shop Product',
        ),
        
         array(
            'id'   => 'swpb_product_bundles_shop_product_title',
            'desc' => '',
            'type' => 'text',
            'name' => 'Head Title',
            'default' => '',
        ),

        array(
            'id'   => 'swpb_product_bundles_shop_product_display',
            'type' => 'select',
            'name' => 'Display',
            'options' => [
                'show' => 'Show',
                'hidden' => 'Hidden',
            ],
            'default' => 'show',
        ),

        array(
            'id'   => 'swpb_product_bundles_shop_product_column',
            'desc' => '',
            'type' => 'select',
            'name' => 'Columns of Row',
            'options' => [
            	'1' => '1',
            	'2' => '2',
            	'3' => '3',
            	'4' => '4',
            	'5' => '5',
            	'6' => '6',
            ],
            'default' => '3',
        ),
        
        array(
            'id'   => 'swpb_product_bundles',
            'type' => 'sectionend',
        ),
    );
    
    return apply_filters( 'filter_swpb_product_bundles_settings', $settings );
}
