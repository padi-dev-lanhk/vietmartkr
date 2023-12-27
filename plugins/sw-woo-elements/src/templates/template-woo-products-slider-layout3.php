<?php
/**
 * View template for SWE Tab Category Slider
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$sweWrap = 'swe-woo-products-slider-layout3 swe-wrapper';
if ($settings['layout_style']) {
	$sweWrap .= ' ' . $settings['layout_style'];
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

// if filter is rating
if( $settings['filter'] == 'rating' ){
	$args['orderby'] = $settings['orderby'] . ' meta_value_num';
	$args['meta_key'] = '_wc_average_rating';
	// if filter is bestsales
} elseif( $settings['filter'] == 'best_selling' ){
	$args['orderby'] = $settings['orderby'] . ' meta_value_num';
	$args['meta_key'] = 'total_sales';
	// if filter is featured
} elseif( $settings['filter'] == 'featured' ){
	$args['tax_query'][] = array(
		'taxonomy' => 'product_visibility',
		'field'    => 'name',
		'terms'    => 'featured',
		'operator' => 'IN',
	);
} elseif( $settings['filter'] == 'recommend' ){
	
	$args['meta_key'] = 'recommend_product';
	$args['meta_value'] = '1';
	
}elseif($settings['filter'] == 'on_sale') {
	$args['meta_query'] = array(
		array(
			'relation' => 'OR',
			array(
				'key'           => '_sale_price',
				'value'         => 0,
				'compare'       => '>',
				'type'          => 'numeric'
			),
			array(
				'key'           => '_min_variation_sale_price',
				'value'         => 0,
				'compare'       => '>',
				'type'          => 'numeric'
			)
		)
	);
}

if ($settings['product_cats']) {
	$args['tax_query']['relation'] = 'OR';
	foreach ($settings['product_cats'] as $index => $cat) {
		$term = get_term_by('slug', $cat, 'product_cat');
		if( $term ) :
			$args['tax_query'][] = array(
				'taxonomy'	=> 'product_cat',
				'field'		=> 'term_id',
				'terms'		=> $term->term_id,
				'operator'	=> 'IN'
			);
		endif;
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
			<h2 class="swe-title"><?php echo $settings['title']; ?></h2>
		<?php } ?>
	</div>
	<ul class="products swe-slider" <?php echo $settings['slider_options']; ?>>
		<?php if( $products->have_posts() ) {
			while($products->have_posts()){ $products->the_post(); 
				global $product, $post; ?>
				<li <?php post_class( bakan_product_attribute() ); ?> >
					<div class="products-entry item-wrap4 clearfix">
						<div class="item-detail">
							<div class="item-img products-thumb">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php 
									$id = get_the_ID();
									if ( has_post_thumbnail() ){
										echo get_the_post_thumbnail( $post->ID, 'shop_catalog', array( 'alt' => $post->post_title ) ) ? get_the_post_thumbnail( $post->ID, 'shop_catalog', array( 'alt' => $post->post_title ) ): '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';		
									}else{
										echo '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';
									}
									?>
								</a>
							</div>
							<div class="item-content products-content">
								<?php
								/**
								 * woocommerce_shop_loop_item_title hook
								 *
								 * @hooked woocommerce_template_loop_product_title - 10
								 */
								do_action( 'woocommerce_shop_loop_item_title' );
								do_action( 'woocommerce_after_shop_loop_item_title' );
									
								?>
							</div>
						</div>
					</div>
				</li>
			<?php }
			wp_reset_postdata();
		} ?>
	</ul>
</div>
