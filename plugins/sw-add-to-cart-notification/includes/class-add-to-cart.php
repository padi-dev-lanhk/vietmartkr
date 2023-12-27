<?php 
namespace SWATCN;

/**
 * Class Add To Cart
 */
class AddToCart {
	
	function __construct()
	{
		add_action( 'wp_enqueue_scripts', [$this, 'load_scripts'] );

		add_action('wp_footer', [$this, 'sw_add_to_cart_html']);
		add_filter('woocommerce_add_to_cart_fragments', [$this, 'sw_add_to_cart_message']);

		add_action('wp_ajax_sw_add_single_product_to_cart', [$this, 'sw_add_single_product_to_cart']);
		add_action('wp_ajax_nopriv_sw_add_single_product_to_cart', [$this, 'sw_add_single_product_to_cart']);
	}

	/**
	 * Load Script
	 */

	function load_scripts(){
		wp_register_style( 'swatcn-style', SWATCN_PLUGIN_URI . 'assets/css/style.css' );
		wp_enqueue_style( 'swatcn-style' );

		wp_register_script( 'swatcn-script', SWATCN_PLUGIN_URI . "assets/js/script.js", 'jquery', 1.0, true );
		wp_enqueue_script( 'swatcn-script' );
	}

	function swatcn_get_template($layout='') {
		$url = '';

		if ($_POST['layout']) {
			$layout = $_POST['layout'];
		}

		if ($layout != '') {
			$url = SWATCN_PLUGIN_URL . 'includes/templates/'. $layout .'.php';
		} else {
			$url = SWATCN_PLUGIN_URL . 'includes/templates/layout-default.php';
		}
		include $url;
	}

	/**
	 * Add to Cart Message
	 * Display add to cart message after product added to cart by using ajax add to cart.
	 * @return html add to cart message.
	 */
	function sw_add_to_cart_message($fragments)
	{
		ob_start();
		if (get_option('woocommerce_cart_redirect_after_add') != 'yes') {
			?>
			<div id="sw-add-to-cart-message" class="sw-modal">
				<?php $this->swatcn_get_template(get_option('swatcn_layout', 'layout-default')); ?>
				<div class="mark"></div>
			</div>
			<?php
		}
		$fragments['sw_add_to_cart_message'] = ob_get_clean();
		return $fragments;
	}

	function sw_add_to_cart_html() {
		if ( isset($_GET['atcn_layout']) ) {
			$layout = $_GET['atcn_layout'];
			echo '<input type="hidden" id="atcn_layout" name="zyx" value="'. $layout .'" />';
		}
		echo '<div id="sw-add-to-cart-message"></div>';
	}

	/**
	 * Zoo Add Single Product To Cart
	 */

	function sw_add_single_product_to_cart() {
		$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
		$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
		$variation_id = absint($_POST['variation_id']);
		$variations = $_POST['variations'];
		$cart_item_data = $_POST['cart_item_data'];
		$passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
		$product_status = get_post_status($product_id);
		if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variations, $cart_item_data) && 'publish' === $product_status) {
			do_action('woocommerce_ajax_added_to_cart', $product_id);
			if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
				wc_add_to_cart_message(array($product_id => $quantity), true);
			}
			WC_AJAX :: get_refreshed_fragments();
		} else {
			$data = array(
				'error' => true,
				'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
			echo wp_send_json($data);
		}
		wp_die();
	}

}
return new AddToCart();
