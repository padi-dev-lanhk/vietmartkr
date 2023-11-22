<?php
/**
 * View template for SWE Related And Upsells Slider
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

if( !is_singular( 'product' ) ){
	return;
}
global $product;

$sweWrap = 'swe-related-and-upsells swe-woo-tab-slider swe-wrap-tabs swe-wrapper';
$sweWrapHead = 'swe-wrap-tab-head';
$args = [];
$related = '';
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

$upsells = $product->get_upsell_ids();
?>

<div class="<?php echo esc_attr($sweWrap, 'sw-woo-elements'); ?>">
	<div class="swe-wrap-head">
		<?php if ($settings['tabs']) { ?>
			<div class="<?php echo esc_attr($sweWrapHead, 'sw-woo-elements'); ?>">
				<div class="swe-tab-head">
					<?php foreach ($settings['tabs'] as $index => $tab) {
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
						]); ?>
						<?php if ($tab == 'related') { ?>
							<div <?php echo $this->get_render_attribute_string($attr_title); ?>>
								<?php echo $settings['text_related'] ? $settings['text_related'] : __('Related Products', 'sw-woo-elements'); ?>
							</div>
						<?php } else if($tab == 'upsells' && count($upsells) != 0) { ?>
							<div <?php echo $this->get_render_attribute_string($attr_title); ?>>
								<?php echo $settings['text_upsells'] ? $settings['text_upsells'] : __('Upsell Products', 'sw-woo-elements'); ?>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="swe-wrap-tab-content">
		<?php if ($settings['tabs']) { 
			foreach ($settings['tabs'] as $index => $tab) {
				if ($tab == 'upsells') {
					$upsells = $product->get_upsell_ids();

					$args = array(
						'post_type' => 'product',
						'post__in'   => $upsells,
						'post_status' => 'publish',
						'showposts' => $settings['product_number'],
						'order' => $settings['order'],
						'orderby' => $settings['orderby'],
					);
				}

				$products = new WP_Query($args);

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
		} ?>
	</div>
</div>
