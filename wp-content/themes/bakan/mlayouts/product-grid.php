<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post, $product;
?>
<li <?php post_class( 'item' ); ?>>
	<div class="products-entry item-wrap clearfix 1234">
		<div class="item-detail">
			<div class="item-img products-thumb">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<div class="product-thumb-hover">
						<?php swg_label_sales(); ?>
						<?php the_post_thumbnail( 'shop_catalog' ); ?>
					</div>
				</a>
			</div>
			<div class="item-content products-content">
				<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>		
				<!-- rating  -->
				<?php 
				$rating_count = $product->get_rating_count();
				$review_count = $product->get_review_count();
				$average      = $product->get_average_rating();
				?>
				<div class="reviews-content">
					<div class="star"><?php echo sprintf( '<span style="width: %dpx"></span>', $average*12 ); ?></div>
				</div>
				<!-- Price -->
				<?php if ( $price_html = $product->get_price_html() ) : ?>
					<span class="item-price"><span><?php echo sprintf( '%s', $price_html ); ?></span></span>
				<?php endif; ?>	
				<?php swg_label_sales_off(); ?>
				<!-- Description -->
				<div class="item-description">
					<?php echo wp_trim_words( $post->post_excerpt, 15); ?>
				</div>
				<?php if( swg_options( 'mobile_addcart' ) ) : ?>
					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</li>