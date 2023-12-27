<?php 
/**
 * View template for SWE Woo Related Slider
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */
if( !is_singular( 'product' ) ){
	return;
}
$sweWrap = 'swe-woo-related-slider swe-wrapper';

$related = array();
global $post;
if( function_exists( 'wc_get_related_products' ) ){
	$related = wc_get_related_products( get_the_ID(), $settings['product_number'] );
} else {
	$related = $product->get_related($settings['product_number']);
}

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            	=> 'product',
	'ignore_sticky_posts'  	=> 1,
	'order' 				=> $settings['order'],
	'orderby' 				=> $settings['orderby'],
	'posts_per_page'       	=> $settings['product_number'],
	'post__in'             	=> $related,
) );

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
} elseif($settings['filter'] == 'on_sale') {
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

$args['tax_query']['relation'] = 'AND';

$product_visibility_terms  = wc_get_product_visibility_term_ids();
if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
	$product_visibility_not_in[] = $product_visibility_terms['outofstock'];
}

if ( ! empty( $product_visibility_not_in ) ) {
	$args['tax_query'][] = array(
		'taxonomy' => 'product_visibility',
		'field'    => 'term_taxonomy_id',
		'terms'    => $product_visibility_not_in,
		'operator' => 'NOT IN',
	);
}

$products = new WP_Query( $args );
?>

<div class="<?php echo esc_attr($sweWrap, 'sw-woo-elements'); ?>">
	<?php if ($settings['title']) { ?>
		<div class="swe-wrap-head">
			<h2 class="swe-title"><?php echo $settings['title']; ?></h2>
		</div>
	<?php } ?>
	<ul class="products swe-slider" <?php echo $settings['slider_options']; ?>>
		<?php if( $products->have_posts() ) {
			while($products->have_posts()){ $products->the_post();
				wc_get_template_part( 'content', 'product' );
			}
			wp_reset_postdata();
		} ?>
	</ul>
</div>
