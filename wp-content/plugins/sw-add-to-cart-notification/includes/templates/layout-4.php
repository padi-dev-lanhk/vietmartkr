<?php 
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
if ($product_id) {
	$product = wc_get_product( $product_id );
	$qty = $_POST['quantity'];

	$allowed_html = array('b' => array(), 'span' => array());
	?>
	<div class="modal-content layout-4">
		<?php do_action( 'swatcn_woocommerce_before_content_add_to_cart' ); ?>
		<span class="close">&times;</span>
		<div class="wrap">
			<div class="wrap-top">
				<p>
					<?php echo esc_html__('Successfully added to your cart.', 'sw-add-to-cart-notification'); ?>
				</p>
			</div>
			<div class="wrap-middle">
				<div class="wrap-top">
					<div class="thumbnail">
						<?php echo wp_get_attachment_image($product->get_image_id(), 'medium'); ?>
					</div>
					<div class="content">
						<h3 class="product-title"><?php echo $product->get_name(); ?></h3>
						<span class="price">
							<?php echo $product->get_price_html(); ?>
						</span>
						<p><?php printf( esc_html__('QTY: %s', 'sw-add-to-cart-notification'), $qty ); ?></p>
					</div>
				</div>
				<div class="wrap-bottom">
					<span class="button close"><?php echo esc_html__('Continue Shopping', 'sw-add-to-cart-notification'); ?> (<span class="countdown" data-countdown="<?php echo get_option('swatcn_countdown', '3'); ?>"><?php echo get_option('swatcn_countdown', '3'); ?></span>)</span>
					<a href="<?php echo wc_get_checkout_url(); ?>" class="button checkout"><?php echo esc_html__( 'Proceed to Checkout', 'sw-add-to-cart-notification' ); ?></a>
				</div>
			</div>
		</div>
		<?php do_action( 'swatcn_woocommerce_after_content_add_to_cart' ); ?>
	</div>
<?php }
