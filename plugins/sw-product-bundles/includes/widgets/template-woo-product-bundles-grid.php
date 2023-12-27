<?php
/**
 * View template for SWE Tab Category Slider
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$sweWrap = 'swe-woo-products-bundles swe-woo-products-bundles-grid swe-wrapper item-' . $settings['layout_item_bundles'];

$sweWrap .= ' ' . $settings['layout'];

$itemBundlesWrap = 'item-bundles ' . $settings['style_item_bundles'];

if ($settings['layout_item_bundles'] == 'grid') {
	$itemBundlesWrap .= ' swe-row swe-col-' . $settings['item_bundles_col']['size'];
}
if ($settings['layout_item_bundles'] == 'slider') {
	$itemBundlesWrap .= ' swe-slider';
}
$sweWrapProducts = 'products product-bundles';
if ($settings['columns']) {
	$sweWrapProducts .= ' swe-row';
	if (isset( $settings['columns_mobile'] )) {
		$sweWrapProducts .= ' swe-col-' . $settings['columns_mobile']['size'];
	} else {
		$sweWrapProducts .= ' swe-col-2';
	}
	if (isset( $settings['columns_tablet'] )) {
		$sweWrapProducts .= ' swe-col-md-'. $settings['columns_tablet']['size'];
	} else {
		$sweWrapProducts .= ' swe-col-3';
	}
	$sweWrapProducts .= ' swe-col-lg-' . ($settings['columns']['size'] ? $settings['columns']['size'] : 3);
}
// default filter is latest
$args = array(
	'post_type'             => 'product',
	'post_status'           => 'publish',
	'ignore_sticky_posts'   => 1,
	'posts_per_page'        => $settings['product_number'],
	'order' 				=> $settings['order'],
	'orderby' 				=> $settings['orderby'],
);

$args['tax_query'][] = array(
	'taxonomy' => 'product_type',
	'field'    => 'name',
	'terms'    => 'bundle',
	'operator' => 'IN',	
);

if ($settings['product_cat']) {
	$term = get_term_by('slug', $settings['product_cat'], 'product_cat');
	if ($term) {
		$args['tax_query'][] = array(
			'taxonomy'	=> 'product_cat',
			'field'		=> 'term_id',
			'terms'		=> $term->term_id,
			'operator'	=> 'IN'
		);
	}
}
if (isset($settings['exclude_product_ids'])) {
	$args['post__not_in'] = $settings['exclude_product_ids'];
}

$products = new WP_Query($args);
?>

<div class="<?php echo esc_attr($sweWrap, 'sw-woo-elements'); ?>">
	<div class="swe-wrap-head">
		<?php if ($settings['title']) { ?>
			<h2 class="swe-title"><?php echo esc_html($settings['title']); ?></h2>
		<?php } ?>
	</div>
	<ul class="<?php echo esc_attr($sweWrapProducts); ?>">
		<?php if( $products->have_posts() ) {
			while($products->have_posts()){ $products->the_post();
				global $product;
				?>
				<div class="wrap-item swe-col">
					<?php if ($settings['layout'] == 'vertical' || $settings['layout'] == 'horizontal') {
						wc_get_template_part( 'content', 'product' ); ?>
						<div class="item-bundles-wrapper">
							<?php if ($settings['item_bundles_title']) { ?>
								<h4 class="title-bundles"><?php echo esc_html($settings['item_bundles_title']); ?></h4>
							<?php } ?>
							<div class="<?php echo esc_attr($itemBundlesWrap); ?>" <?php echo ent2ncr( $settings['item_slider_options'] ); ?>>
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
												<?php echo ent2ncr($bundle->get_image( 'medium' ));	?>
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
					<?php } else {
						include('layouts/grid-'. $settings['layout'] .'.php');
					} ?>
				</div>
				<?php 
			}
			wp_reset_postdata();
		} ?>
	</ul>
</div>
