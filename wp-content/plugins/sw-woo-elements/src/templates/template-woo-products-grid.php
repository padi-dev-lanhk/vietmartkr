<?php
/**
 * View template for SWE Products grid
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$sweWrap = 'swe-woo-products-grid swe-wrapper';

$sweWrapProducts = 'products';

$sweWrapId = 'swe-wrapper-'. $settings['id_int'];

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
	$sweWrapProducts .= ' swe-col-lg-' . $settings['columns']['size'];
}

if ( is_front_page() ) {
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;   
} else {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
}

// default filter is latest
$args = array(
	'post_type'             => 'product',
	'post_status'           => 'publish',
	'ignore_sticky_posts'   => 1,
	'paged'             => $paged,
	'posts_per_page'        => $settings['product_number'],
	'order' 				=> $settings['order'],
	'orderby' 				=> $settings['orderby'],
);

if ($settings['product_cats']) {
	$args['tax_query']['relation'] = 'OR';
	foreach ($settings['product_cats'] as $index => $cat) {
		$term = get_term_by('slug', $cat, 'product_cat');
		if ($term) {
			$args['tax_query'][] = array(
				'taxonomy'	=> 'product_cat',
				'field'		=> 'term_id',
				'terms'		=> $term->term_id,
				'operator'	=> 'IN'
			);
		}
	}
}

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

if (isset($settings['exclude_product_ids'])) {
	$args['post__not_in'] = $settings['exclude_product_ids'];
} 
$products = new WP_Query($args);
?>

<div class="<?php echo esc_attr($sweWrap, 'sw-woo-elements'); ?>" id="<?php echo esc_attr($sweWrapId, 'sw-woo-elements'); ?>">
	<div class="swe-wrap-head">
		<?php if ($settings['title']) { ?>
			<h2 class="swe-title"><?php echo $settings['title']; ?></h2>
		<?php } ?>
	</div>
	<ul class="<?php echo esc_attr($sweWrapProducts, 'sw-woo-elements'); ?>">
		<?php if( $products->have_posts() ) {
			while($products->have_posts()){ $products->the_post();
				wc_get_template_part( 'content', 'product' );
				wp_reset_postdata(); 
			}
		} ?>
	</ul>
	<?php if ($settings['pagination'] == 'ajaxload') { ?>
		<div class="pagination-ajax">
			<?php swe_pagination(3, $products, '', '<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'); ?>
			<div class="scroller-status">
				<div class="infinite-scroll-request">
					<div class="pagination-loading"><span class="loading"><i class="fas fa-spinner fa-spin"></i><?php echo esc_html__('Loading...','sw-woo-elements') ?></span></div>
				</div>
				<p class="infinite-scroll-last"><?php echo esc_html__('All items loaded','sw-woo-elements'); ?></p>
				<p class="infinite-scroll-error"><?php echo esc_html__('No more page','sw-woo-elements'); ?></p>
			</div>
			<p class="view-more-button"><span><?php echo $settings['button_text']; ?></span></p>
		</div>
	<?php } elseif($settings['pagination'] == 'numeric') {
		swe_pagination(100, $products, '', '<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>');
	}
	?>
</div>
