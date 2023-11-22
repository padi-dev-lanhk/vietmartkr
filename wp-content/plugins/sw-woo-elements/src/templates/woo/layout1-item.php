

<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version    3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $post;
// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

?>
<li <?php post_class( bakan_product_attribute() ); ?> >
	<div class="products-entry item-wrap2 clearfix">
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
				<div class="item-button">
					<?php
					if ( class_exists( 'YITH_WCWL' ) ){
					echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
					} ?>
					<?php if ( class_exists( 'YITH_WOOCOMPARE' ) ){ 
					?>
					<a href="javascript:void(0)" class="compare button"  title="<?php esc_html_e( 'Add to Compare', 'sw-woo-elements' ) ?>" data-product_id="<?php echo esc_attr($post->ID); ?>" rel="nofollow"> <?php esc_html('compare','sw-woo-elements'); ?></a>
					<?php } ?>
					<?php echo bakan_quickview(); ?>
				</div>
			</div>
			<div class="item-content products-content">
				<?php
				/**
				 * woocommerce_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * 
				 * @hooked woocommerce_template_loop_price - 10
				 * @hooked woocommerce_template_loop_rating - 15
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
				
				/**
				 * woocommerce_after_shop_loop_item hook
				 *
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				woocommerce_template_loop_add_to_cart();
					
				?>
			</div>
		</div>
	</div>
</li>