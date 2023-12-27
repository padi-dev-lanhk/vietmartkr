<?php 


$sweWrap = 'swe-woo-recent-viewed swe-wrapper';

$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array(); // @codingStandardsIgnoreLine
if( !is_singular( 'product' ) ){
	return ;
}
global $product;

$args = array(
	'posts_per_page' => $settings['product_number'],
	'no_found_rows'  => 1,
	'post_status'    => 'publish',
	'post_type'      => 'product',
	'post__in'       => $viewed_products,
	'orderby'        => 'post__in',
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
