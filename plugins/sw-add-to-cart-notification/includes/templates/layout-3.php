<?php 
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
if ($product_id) {
	$product = wc_get_product( $product_id );
	$qty = $_POST['quantity'];

	$allowed_html = array('b' => array(), 'span' => array());
	?>
	<div class="modal-content layout-3">
		<?php do_action( 'swatcn_woocommerce_before_content_add_to_cart' ); ?>
		<span class="close">&times;</span>
		<div class="wrap">
			<div class="wrap-middle">
				<div class="wrap-top">
					<div class="check">
						<img src="<?php echo esc_url( SWATCN_PLUGIN_URI . 'assets/images/bi_check-circle.png' ); ?>">
					</div>
					<div class="content">
						<p><?php printf( wp_kses( '<b>%s</b> has been added to your cart!', $allowed_html ), $product->get_name() ); ?></p>
						<p><?php if (WC()->cart->cart_contents_count > 1) {
							printf( wp_kses( '<b>%s items in the Cart: </b><span>%s</span>', $allowed_html ), WC()->cart->cart_contents_count, WC()->cart->get_cart_subtotal() );
						} else {
							printf( wp_kses( '<b>%s item in the Cart: </b><span>%s</span>', $allowed_html ), WC()->cart->cart_contents_count, WC()->cart->get_cart_subtotal() );
						} ?></p>
					</div>
				</div>
				<div class="wrap-bottom">
					<span class="button close"><?php echo esc_html__('Continue Shopping', 'sw-add-to-cart-notification'); ?> (<span class="countdown" data-countdown="<?php echo get_option('swatcn_countdown', '3'); ?>"><?php echo get_option('swatcn_countdown', '3'); ?></span>)</span>
					<a href="<?php echo wc_get_cart_url(); ?>" class="button viewcart"><?php echo esc_html__( 'View Cart', 'sw-add-to-cart-notification' ); ?></a>
				</div>
			</div>
		</div>
		<?php do_action( 'swatcn_woocommerce_after_content_add_to_cart' ); ?>
	</div>
<?php }
