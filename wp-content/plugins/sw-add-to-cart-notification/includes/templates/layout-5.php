<?php 
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
if ($product_id) {
	$product = wc_get_product( $product_id );
	$qty = $_POST['quantity'];
	?>
	<div class="modal-content layout-5">
		<?php do_action( 'swatcn_woocommerce_before_content_add_to_cart' ); ?>
		<span class="close">&times;</span>
		<div class="wrap">
			<div class="wrap-top">
				<p>
					<?php echo get_option('swatcn_title', esc_html__('Thêm vào giỏ hàng thành công.', 'sw-add-to-cart-notification') ); ?>
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
					<p class="text-subtotal">
						<?php if (WC()->cart->cart_contents_count > 1) {
							printf( esc_html__( 'There are %s items in your cart', 'sw-add-to-cart-notification' ), WC()->cart->cart_contents_count );
						} else {
							printf( esc_html__( 'There are %s item in your cart', 'sw-add-to-cart-notification' ), WC()->cart->cart_contents_count );
						} ?>
					</p>
					<div class="subtotal"><b class="text-subtotal"><?php echo esc_html__( 'Subtotal:', 'sw-add-to-cart-notification' ); ?></b><b><?php echo WC()->cart->get_cart_subtotal(); ?></b></div>
					<?php if (get_option('swatcn_btn_continue_shopping', '') != 'yes') { ?>
						<span class="button close"><?php echo esc_html__( 'Continue Shopping', 'sw-add-to-cart-notification' ); ?></span>
					<?php } ?>
					<?php if (get_option('swatcn_btn_view_cart', '') != 'yes') { ?>
						<a href="<?php echo wc_get_cart_url(); ?>" class="button viewcart"><?php echo esc_html__( 'View Cart', 'sw-add-to-cart-notification' ); ?></a>
					<?php } ?>
					<?php if (get_option('swatcn_btn_checkout', '') != 'yes') { ?>
						<a href="<?php echo wc_get_checkout_url(); ?>" class="button checkout"><?php echo esc_html__( 'Checkout', 'sw-add-to-cart-notification' ); ?></a>
					<?php } ?>
				</div>
			</div>
			<div class="wrap-bottom">
				<?php 

				$related = wc_get_related_products( $product_id, 4 );

				$productCount = 4;

				$args = apply_filters(
					'woocommerce_related_products_args',
					array(
						'post_type'           => 'product',
						'ignore_sticky_posts' => 1,
						'no_found_rows'       => 1,
						'posts_per_page'      => $productCount,
						'post__in'            => $related,
						'post__not_in'        => array( $product->get_id() ),
					)
				);

				$products = new WP_Query( $args );


				if ( $products->have_posts() ) : ?>

					<section class="related products">

						<?php
						$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

						if ( $heading ) :
							?>
							<h2><?php echo esc_html__( 'You may also like', 'sw-add-to-cart-notification' ); ?></h2>
						<?php endif; ?>
						<div class="wrap">
							<?php
							while ( $products->have_posts() ) :
								$products->the_post();
								global $product;
								?>
								<div class="product">
									<div class="thumbnail">
										<a href="<?php echo get_permalink($product->ID); ?>"><?php echo wp_get_attachment_image($product->get_image_id(), 'medium'); ?></a>
									</div>
									<h3 class="product-title"><a href="<?php echo get_permalink($product->ID); ?>"><?php echo $product->get_name(); ?></a></h3>
									<span class="price">
										<?php echo $product->get_price_html(); ?>
									</span>
								</div>
							<?php endwhile; // end of the loop. ?>
						</div>
					</section>
					<?php
				endif;
				wp_reset_postdata();
				?>
			</div>
		</div>
		<?php do_action( 'swatcn_woocommerce_after_content_add_to_cart' ); ?>
	</div>
<?php }
