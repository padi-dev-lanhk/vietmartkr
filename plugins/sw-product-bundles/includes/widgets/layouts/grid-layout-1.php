<?php 
global $post, $product;
?>
<div class="item-image-bundle products-thumb-big products-thumb">
	<a href="<?php echo get_permalink( $product->get_id() ); ?>" title="<?php echo esc_html($product->get_title()); ?>">
		<img src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" />
	</a>
</div>
<div class="item-content-bundle">
	<div class="box-content clearfix">
		<div class="box-title">
			<h3><a href="<?php echo get_permalink( $product->get_id() ); ?>" title="<?php echo esc_html($product->get_title()); ?>"><?php echo esc_html($product->get_title()); ?></a></h3>
		</div>
	</div>
	<?php if ( $price_html = $product->get_price_html() ){ ?>
		<div class="item-price">
			<span>
				<?php echo ent2ncr( $price_html ); ?>
			</span>
		</div>
	<?php } ?>
	<div class="box-description">
		<?php the_excerpt(); ?>
	</div>
	<div class="item-bundles-wrapper">
		<?php if ($settings['item_bundles_title']) { ?>
			<h4 class="title-bundles"><?php echo esc_html($settings['item_bundles_title']); ?></h4>
		<?php } ?>
		<div class="<?php echo esc_attr($itemBundlesWrap); ?>" <?php echo ent2ncr($settings['item_slider_options']); ?>>
			<?php $bundles = apply_filters( 'swpb/load/bundle', $product->get_id() );
			$index = 0;
			foreach ( $bundles as $key => $value )  {
				if ($settings['number_items'] != NULL && $settings['number_items']['size'] == $index ) {
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
							<a href="<?php echo esc_url( $product_url ); ?>" title="<?php echo esc_html( $value['title'] );?>">
								<?php echo ent2ncr($bundle->get_image( 'medium' ));	?>
							</a>
						</div>
						<div class="boxinfo-wrapper">
							<div class="title-wrapper">
								<a href="<?php echo esc_url( $product_url ); ?>"><?php echo esc_html( $value['title'] );?></a>
							</div>
							<div class="price-wrapper"><?php echo ent2ncr($bundle->get_price_html()); ?></div>
						</div>
					</div>
				</div>
				<?php 
				$index++;
			}
			?>
		</div>
	</div>
	<div class="bundle-add-to-cart">
		<a href="?add-to-cart=<?php echo esc_attr($product->get_id()); ?>" data-quantity="1" class="button product_type_bundle add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" aria-label="Add “<?php echo esc_attr($product->get_title()); ?>” to your cart" rel="nofollow"><?php echo esc_html__('Thêm vào giỏ hàng', 'woocommerce'); ?></a>
	</div>
	<div class="bundle-meta">
		<div class="meta-author">
			<?php echo esc_html__('Sold by: ', 'sw_product_bundles') . get_the_author_meta('nickname'); ?>
		</div>
		<div class="meta-categories">
			<?php echo get_the_term_list( $product->get_id(), 'product_cat', 'Categories: ' ); ?>
		</div>
	</div>
</div>
