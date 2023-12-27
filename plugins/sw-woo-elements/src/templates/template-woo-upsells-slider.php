<?php 
/**
 * View template for SWE Woo Related Slider
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

if( !is_singular( 'product' ) ){
	return ;
}
global $product;

$sweWrap = 'swe-woo-upsells-slider swe-wrapper';

$upsells = $product->get_upsell_ids();

if( count($upsells) == 0 || is_archive() ) return ;	

$args = array(
	'post_type' => 'product',
	'post__in'   => $upsells,
	'post_status' => 'publish',
	'showposts' => $settings['product_number'],
	'order' => $settings['order'],
	'orderby' => $settings['orderby'],
);

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
