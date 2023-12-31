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
	get_template_part( 'header' );
?>
<div class="container">
	<div id="contents" role="main">
	
		<?php
			/**
			 * woocommerce_before_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			 global $post;
			do_action('woocommerce_before_main_content');
		?>
		 <?php
			/**
			 * Hook: woocommerce_archive_description.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
			?>
		<div class="products-wrapper">	
		
			<?php if ( have_posts() ) : ?>
				<?php do_action('woocommerce_message'); ?>
				<?php 					
					woocommerce_product_loop_start();					
					if( swg_woocommerce_version_check( '3.3' ) ){
						echo apply_filters( 'bakan_custom_category', $html = '' );
					}else{
						woocommerce_product_subcategories(); 
					}
					woocommerce_product_loop_end(); 
				?>
				<div class="product-nav-wrapper clearfix">
					<div class="filter-product"><i class="fa fa-sliders" aria-hidden="true"></i> <?php echo esc_html__('Filter','bakan'); ?></div>
					<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>
					<div class="filter-mobile clearfix">
						<?php if (is_active_sidebar('filter-mobile')) {?>
							<?php dynamic_sidebar('filter-mobile'); ?>
						<?php }?>
					</div>
				</div>
				
				<div class="clear"></div>
				<ul class="products-loop grid clearfix" id="product_listing">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'mlayouts/product', 'grid' ); ?>					
					<?php endwhile; // end of the loop. ?>
				</ul>
				<div class="clear"></div>
				<?php do_action( 'woocommerce_after_shop_loop' ); ?>
			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<?php wc_get_template( 'loop/no-products-found.php' ); ?>

			<?php endif; ?>
		</div>
		<?php
			/**
			 * woocommerce_after_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action('woocommerce_after_main_content');
		?>
	</div>
</div>
<?php get_footer(); ?>