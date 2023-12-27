<?php
/**
 * View template for SWE Tab Category Slider
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */
$sweWrap = 'swe-woo-tab-slider swe-wrap-tabs swe-wrapper';
if ($settings['tabs_style']) {
	$sweWrap .= ' ' . $settings['tabs_style'];
}
$sweWrapHead = 'swe-wrap-tab-head';
if ($settings['tabs_button']) {
	$sweWrapHead .= ' tabs-button ' . $settings['tabs_button'];
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
} ?>

<div class="<?php echo esc_attr($sweWrap, 'sw-woo-elements'); ?>">
	<div class="swe-wrap-head">
		<?php if ($settings['title']) { ?>
			<h2 class="swe-title"><?php echo $settings['title']; ?></h2>
		<?php } ?>
		<?php if ($settings['product_cats']) { ?>
			<div class="<?php echo esc_attr($sweWrapHead, 'sw-woo-elements'); ?>">
				<button class="swe-button swe-navbar-toggle">
					<i class="fas fa-bars"></i>
				</button>
				<div class="swe-tab-head">
					<?php 
					foreach ($settings['product_cats'] as $index => $cat) {
						// attribute for title
						$tab_count = $index + 1;
						$attr_title = 'attribute_title' . $tab_count;
						$this->add_render_attribute( $attr_title, [
							'id' => 'swe-tab-title-' . $settings['id_int'] . $tab_count,
							'class' => [ 'swe-tab-title' ],
							'aria-selected' => 1 === $tab_count ? 'true' : 'false',
							'data-tab' => $tab_count,
							'role' => 'tab',
							'tabindex' => 1 === $tab_count ? '0' : '-1',
							'aria-controls' => 'swe-tab-content-' . $settings['id_int'] . $tab_count,
							'aria-expanded' => 'false',
						]);
						$term = get_term_by('slug', $cat, 'product_cat'); ?>
						<div <?php echo $this->get_render_attribute_string($attr_title); ?>>

							<?php if ($cat != 'all') {
								echo $term->name;
							} else {
								echo __('All', 'sw-woo-elements');
							} ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="swe-wrap-tab-content">
		<?php if ($settings['product_cats']) { 
			foreach ($settings['product_cats'] as $index => $cat) {
				// Query for product
				$term = get_term_by('slug', $cat, 'product_cat');
				$query = $args;
				if ($cat != 'all') {
					$query['tax_query'][] = array(
						'taxonomy'	=> 'product_cat',
						'field'		=> 'term_id',
						'terms'		=> $term->term_id,
						'operator'	=> 'IN'
					);
				}

				$products = new WP_Query($query);

				// attribute for content
				$tab_count = $index + 1;
				$attr_content = 'attribute_content' . $tab_count;
				$this->add_render_attribute( $attr_content, [
					'id' => 'swe-tab-content-' . $settings['id_int'] . $tab_count,
					'class' => [ 'swe-tab-content' ],
					'aria-selected' => 1 === $tab_count ? 'true' : 'false',
				]); ?>

				<div <?php echo $this->get_render_attribute_string($attr_content); ?>>
					<ul class="products swe-slider" <?php echo $settings['slider_options']; ?>>
						<?php if( $products->have_posts() ) {
							while($products->have_posts()){ $products->the_post();
								wc_get_template_part( 'content', 'product' );
							}
							wp_reset_postdata();
						} ?>
					</ul>
				</div>
			<?php } 
		} else {
			$query = $args;
			$products = new WP_Query($query);
			?>
			<ul class="products swe-slider" <?php echo $settings['slider_options']; ?>>
				<?php if( $products->have_posts() ) {
					while($products->have_posts()){ $products->the_post();
						wc_get_template_part( 'content', 'product' );
					}
					wp_reset_postdata();
				} ?>
			</ul>
		<?php } ?>
	</div>
</div>
