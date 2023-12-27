<?php 
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
if ($product_id) {
	$product = wc_get_product( $product_id );
	$qty = $_POST['quantity'];
	?>
	<div class="modal-content layout-default">
		<?php do_action( 'swatcn_woocommerce_before_content_add_to_cart' ); ?>
		<span class="close">&times;</span>
		<div class="wrap">
			<div class="wrap-top">
				<p>
					<?php echo get_option('swatcn_title', esc_html__('Successfully added to your cart.', 'sw-add-to-cart-notification') ); ?>
				</p>
			</div>
			<div class="wrap-middle">
				<div class="wrap-left">
					<?php if (get_option('swatcn_thumbnail', '') != 'yes') { ?>
						<div class="thumbnail">
							<a href="<?php echo get_permalink($product_id); ?>">
								<?php echo wp_get_attachment_image($product->get_image_id(), 'medium'); ?>
							</a>
						</div>
					<?php } ?>
					<div class="content">
					<?php if (get_option('swatcn_product_name', '') != 'yes') { ?>
						<h3 class="product-title">
							<a href="<?php echo get_permalink($product_id); ?>"><?php echo $product->get_name(); ?></a>
						</h3>
					<?php } ?>
					<?php if (get_option('swatcn_price', '') != 'yes') { ?>
						<span class="price">
							<?php echo $product->get_price_html(); ?>
						</span>
					<?php } ?>
					<?php if (get_option('swatcn_quantity', '') != 'yes') { ?>
						<p><?php printf( esc_html__('QTY: %s', 'sw-add-to-cart-notification'), $qty ); ?></p>
					<?php } ?>
					</div>
				</div>
				<div class="wrap-right">
					<?php if (get_option('swatcn_btn_checkout', '') != 'yes') { ?>
					<a href="<?php echo wc_get_checkout_url(); ?>" class="button checkout"><?php echo esc_html__( 'Checkout', 'sw-add-to-cart-notification' ); ?></a>
					<?php } ?>
					<p class="text-subtotal"><?php echo esc_html__('Order subtotal', 'sw-add-to-cart-notification'); ?></p>
					<p class="subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></p>
					<p class="text-subtotal">
						<?php if ( WC()->cart->cart_contents_count >= 2 ){ ?>
							<?php printf( esc_html__('Your cart contains %s items', 'sw-add-to-cart-notification'), WC()->cart->cart_contents_count ); ?>
						<?php }else{ ?>
							<?php printf( esc_html__('Your cart contains %s item', 'sw-add-to-cart-notification'), WC()->cart->cart_contents_count ); ?>
						<?php } ?>
					</p>
					<?php if (get_option('swatcn_btn_continue_shopping', '') != 'yes') { ?>
						<span class="button close"><?php echo esc_html__( 'Continue Shopping', 'sw-add-to-cart-notification' ); ?></span>
					<?php } ?>
					<?php if (get_option('swatcn_btn_view_cart', '') != 'yes') { ?>
					<a href="<?php echo wc_get_cart_url(); ?>" class="button viewcart"><?php echo esc_html__( 'View Cart', 'sw-add-to-cart-notification' ); ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php do_action( 'swatcn_woocommerce_after_content_add_to_cart' ); ?>
	</div>
<?php }
