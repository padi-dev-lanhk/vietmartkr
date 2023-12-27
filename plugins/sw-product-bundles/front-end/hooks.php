<?php 

if (!function_exists('swpb_bundle_before_main_content_rendering')) {
	function swpb_bundle_before_main_content_rendering() {

		$layout = get_option('swpb_product_bundles_single_product_layout');
		$cols = get_option('swpb_product_bundles_single_product_column');
		$style = get_option('swpb_product_bundles_single_product_style');
		if (isset($_GET['swpb_layout'])) {
			$layout = $_GET['swpb_layout'];
		}
		if (isset($_GET['swpb_cols'])) {
			$cols = $_GET['swpb_cols'];
		}
		if (isset($_GET['swpb_style'])) {
			$style = $_GET['swpb_style'];
		}
		if ($layout == 'slider') {
			wp_enqueue_script('slick');
			wp_enqueue_script('swpb');
			echo ent2ncr( '<div class="swpb-bundled-products slider '.$style.' swe-slider" data-slides_to_show="'. $cols .'" data-slides_to_show_tablet="3" data-slides_to_show_mobile="2" data-slides_to_rows="1" data-slides_to_rows_tablet="1" data-slides_to_rows_mobile="1" data-arrows="yes" data-arrows_tablet="" data-arrows_mobile="" data-dots="" data-dots_tablet="" data-dots_mobile="" data-autoplay="">' );
		} elseif($layout == 'list') {
			echo ent2ncr( '<div class="swpb-bundled-products list '.$style.' swe-row swe-col-1">' );
		} else {
			echo ent2ncr( '<div class="swpb-bundled-products grid '.$style.' swe-row swe-col-'. $cols .'">' );
		}
	}
}
add_action('swpb/bundle/before/main/content/rendering', 'swpb_bundle_before_main_content_rendering', 15);

if (!function_exists('swpb_bundle_after_main_content_rendering')) {
	function swpb_bundle_after_main_content_rendering() {
		$allowed_html = array('div' => array('class' => array()));
		echo wp_kses( '</div>', $allowed_html );
	}
}

add_action('swpb/bundle/after/main/content/rendering', 'swpb_bundle_after_main_content_rendering', 15);

if (!function_exists('swpb_render_product_bundles_for_item_product')) {
	function swpb_render_product_bundles_for_item_product() {
		$title = get_option( 'swpb_product_bundles_shop_product_title' );
		$display = get_option( 'swpb_product_bundles_shop_product_display' );

		$cols = get_option('swpb_product_bundles_shop_product_column');

		$swpbWrap = 'swpb-item-product-bundles swe-row swe-col-' . $cols;
		
		global $product;
		if ($display == 'hidden' || $product->get_type() != 'bundle') {
			return;
		}

		global $product;

		$bundles = apply_filters( 'swpb/load/bundle', $product->get_id() );
		if (count($bundles) > 0) {
			
			?>
			<div class="swpb-wrap-product-bundles">
				<?php 
				if ($title) { ?>
					<h5><?php echo esc_html($title); ?></h5>
				<?php } ?>
				<div class="<?php echo esc_attr($swpbWrap); ?>">
					<?php 
					$index = 0;
					foreach ( $bundles as $key => $value )  {
						if ( $index == $cols ) {
							break;
						}
						$bundle = wc_get_product( $key ); 
						$product_url = "";
						if ( get_post_type( $key ) == 'product_variation' ) {
							$product_url = get_the_permalink( wp_get_post_parent_id( $key ) );
						} else {
							$product_url = get_the_permalink( $key );
						}
						?>
						<div class="item-thumbnail-product swe-col">
							<div class="item-thumbnail-wrap">
								<div class="thumbnail-wrapper">
									<a href="<?php echo esc_url( $product_url ); ?>" title="<?php echo esc_html( $value['title'] );?>"><?php echo ent2ncr( $bundle->get_image( 'medium' ) ); ?></a>
								</div>
								<div class="boxinfo-wrapper">
									<div class="title-wrapper">
										<a href="<?php echo esc_url( $product_url ); ?>"><?php echo esc_html( $value['title'] );?></a>
									</div>
									<div class="price-wrapper"><?php echo ent2ncr( $bundle->get_price_html() );?></div>
								</div>
							</div>
						</div>
						<?php 
						$index++;
					} 
					?>
				</div>
			</div>
			<?php 
		}
		
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'swpb_render_product_bundles_for_item_product', 30 );

add_filter( 'woocommerce_loop_add_to_cart_link', 'swpb_custom_view_product_button', 10, 2 );
function swpb_custom_view_product_button( $button, $product ) {
	if( !$product->is_type( 'bundle' ) ) return $button;
	if ( $product ) { ?>
		<a href="?add-to-cart=<?php echo esc_attr( $product->get_id() ); ?>" data-quantity="1" class="button product_type_bundle add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" aria-label="Add “<?php echo esc_html( $product->get_title() ); ?>” to your cart" rel="nofollow"><?php echo esc_html__('Thêm vào giỏ hàng', 'woocommerce'); ?></a>
		<?php
	}
}