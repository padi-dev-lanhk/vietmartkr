<?php 

namespace SWATCN;

/**
 * Settings Add to cart
 */
class SettingAddToCart {
	
	function __construct() {
		add_filter( 'woocommerce_settings_tabs_array', [$this, 'swatcn_add_to_cart'], 100 );
		add_action( 'woocommerce_settings_tabs_swatcn_add_to_cart', [$this, 'swatcn_add_to_cart_settings'] );

		add_action( 'woocommerce_update_options_swatcn_add_to_cart', [$this, 'swatcn_update_options_add_to_cart_settings'] );
	}
	function swatcn_add_to_cart( $settings_tab ) {
		$settings_tab['swatcn_add_to_cart'] = esc_html__( 'Add To Cart Notification', 'sw-add-to-cart-notification' );
		return $settings_tab;
	}
	function swatcn_add_to_cart_settings() {
		woocommerce_admin_fields( $this->get_swatcn_add_to_cart_settings() );
	}
	function swatcn_update_options_add_to_cart_settings() {
		woocommerce_update_options( $this->get_swatcn_add_to_cart_settings() );
	}
	function get_swatcn_add_to_cart_settings() {

		$settings = array(

			array(
				'id'   => 'swatcn_title_top',
				'type' => 'title',
				'name' => esc_html__('Add to cart Notification', 'sw-add-to-cart-notification'),
			),

			array(
				'id'   => 'swatcn_layout',
				'name' => esc_html__('Layout', 'sw-add-to-cart-notification'),
				'type' => 'select',
				'options' => [
					'layout-default' => esc_html__('Default', 'sw-add-to-cart-notification'),
					'layout-2' => esc_html__('Layout 2', 'sw-add-to-cart-notification'),
					'layout-3' => esc_html__('Layout 3', 'sw-add-to-cart-notification'),
					'layout-4' => esc_html__('Layout 4', 'sw-add-to-cart-notification'),
					'layout-5' => esc_html__('Layout 5', 'sw-add-to-cart-notification'),
				],
				'default' => 'layout-default'
			),



			array(
				'id'   => 'swatcn_countdown',
				'name' => esc_html__('Time countdown', 'sw-add-to-cart-notification'),
				'type' => 'number',
				'default' => esc_html__('3', 'sw-add-to-cart-notification'),
				'desc' => esc_html__('The notification will close when the time reaches 0.', 'sw-add-to-cart-notification')
			),

			array(
				'id'   => 'swatcn_title',
				'name' => esc_html__('Title', 'sw-add-to-cart-notification'),
				'type' => 'text',
				'default' => esc_html__('Thêm vào giỏ hàng thành công.', 'sw-add-to-cart-notification'),
				'desc' => esc_html__('Title when you successfully added product', 'sw-add-to-cart-notification')
			),

			array(
				'id'   => 'swatcn_thumbnail',
				'name' => esc_html__('Hidden Thumbnail', 'sw-add-to-cart-notification'),
				'type' => 'checkbox',
				'default' => '',
				'desc' => esc_html__('Hide thumbnail if you check', 'sw-add-to-cart-notification'),
			),

			array(
				'id'   => 'swatcn_product_name',
				'name' => esc_html__('Hidden Product Name', 'sw-add-to-cart-notification'),
				'type' => 'checkbox',
				'desc' => esc_html__('Hide product name if you check', 'sw-add-to-cart-notification'),
				'default' => ''
			),

			array(
				'id'   => 'swatcn_price',
				'name' => esc_html__('Hidden Price', 'sw-add-to-cart-notification'),
				'type' => 'checkbox',
				'desc' => esc_html__('Hide price if you check', 'sw-add-to-cart-notification'),
				'default' => ''
			),

			array(
				'id'   => 'swatcn_quantity',
				'name' => esc_html__('Hidden quantity', 'sw-add-to-cart-notification'),
				'type' => 'checkbox',
				'desc' => esc_html__('Hide quantity if you check', 'sw-add-to-cart-notification'),
				'default' => ''
			),

			array(
				'id'   => 'swatcn_btn_view_cart',
				'name' => esc_html__('Hidden Button View Cart', 'sw-add-to-cart-notification'),
				'type' => 'checkbox',
				'desc' => esc_html__('Hide button view cart if you check', 'sw-add-to-cart-notification'),
				'default' => ''
			),

			array(
				'id'   => 'swatcn_btn_checkout',
				'name' => esc_html__('Hidden Button Checkout', 'sw-add-to-cart-notification'),
				'type' => 'checkbox',
				'desc' => esc_html__('Hide button checkout if you check', 'sw-add-to-cart-notification'),
				'default' => ''
			),

			array(
				'id'   => 'swatcn_btn_continue_shopping',
				'name' => esc_html__('Hidden Button Continue Shopping', 'sw-add-to-cart-notification'),
				'type' => 'checkbox',
				'desc' => esc_html__('Hide button continue shopping if you check', 'sw-add-to-cart-notification'),
				'default' => ''
			),

			array(
				'id'   => 'swatcn_add_to_cart',
				'type' => 'sectionend',
			),


		);

return apply_filters( 'filter_swatcn_add_to_cart_settings', $settings );
}

}

return new SettingAddToCart();
