<?php
/**
 * View template for SWE Tab Category Slider
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$sweWrap = 'swe-woo-products-bundles swe-woo-products-bundles-slider swe-wrapper';

$sweWrap .= ' ' . $settings['layout'];

$itemBundlesWrap = 'item-bundles grid ' . $settings['style_item_bundles'];

if ($settings['item_bundles_col']) {
	$itemBundlesWrap .= ' swe-row';
	if (isset( $settings['item_bundles_col_mobile'] )) {
		$itemBundlesWrap .= ' swe-col-' . $settings['item_bundles_col_mobile']['size'];
	} else {
		$itemBundlesWrap .= ' swe-col-2';
	}
	if (isset( $settings['item_bundles_col_tablet'] )) {
		$itemBundlesWrap .= ' swe-col-md-'. $settings['item_bundles_col_tablet']['size'];
	} else {
		$itemBundlesWrap .= ' swe-col-3';
	}
	$itemBundlesWrap .= ' swe-col-lg-' . $settings['item_bundles_col']['size'];
}

$sweWrapProducts = 'products product-bundles swe-slider';

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
	<ul class="<?php echo esc_attr($sweWrapProducts); ?>" <?php echo ent2ncr( $settings['slider_options']); ?>>
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
							<div class="<?php echo esc_attr($itemBundlesWrap); ?>">
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
												<div class="price-wrapper"><?php echo ent2ncr($bundle->get_price_html());?></div>
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
						include('layouts/slider-'. $settings['layout'] .'.php');
					} ?>
				</div>
				<?php 
			}
			wp_reset_postdata();
		} ?>
	</ul>
</div>
