<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version    3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="container">
	<div class="row sidebar-row">
		
		<div id="contents-detail" <?php bakan_content_product_detail(); ?> role="main">
			<?php
				/**
				 * woocommerce_before_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action('woocommerce_before_main_content');
			?>
			<div class="single-product single-full-width clearfix">
			
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/**
						 * woocommerce_before_single_product hook
						 *
						 * @hooked woocommerce_show_messages - 10
						 */
						 do_action( 'woocommerce_before_single_product' );
						global $product;
						if ( post_password_required() ) {
							echo get_the_password_form();
							return;
						}
					?>
					<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="product_detail row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 clear_xs">							
								<div class="slider_img_productd">
									<!-- woocommerce_show_product_images -->
									<?php
										/**
										 * woocommerce_show_product_images hook
										 *
										 * @hooked woocommerce_show_product_sale_flash - 10
										 * @hooked woocommerce_show_product_images - 20
										 */
										do_action( 'woocommerce_before_single_product_summary' );
									?>
								</div>				
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 clear_xs">
								<div class="content_product_detail 123">
									<!-- woocommerce_template_single_title - 5 -->
									<!-- woocommerce_template_single_rating - 10 -->
									<!-- woocommerce_template_single_price - 20 -->
									<!-- woocommerce_template_single_excerpt - 30 -->
									<!-- woocommerce_template_single_add_to_cart 40 -->
									<?php
										/**
										 * woocommerce_single_product_summary hook
										 *
										 * @hooked woocommerce_template_single_title - 5
										 * @hooked woocommerce_template_single_price - 10
										 * @hooked woocommerce_template_single_excerpt - 20
										 * @hooked woocommerce_template_single_add_to_cart - 30
										 * @hooked woocommerce_template_single_meta - 40
										 * @hooked woocommerce_template_single_sharing - 50
										 */
										do_action( 'woocommerce_single_product_summary' );
									?>				
								</div>
							</div>
							<?php if( swg_woocommerce_vendor_check() ) :?>
							<div class="vendor col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
								<div class="content_vendor_info">
									<!-- woocommerce_show_vendor_info -->
									<?php
										/**
										 * woocommerce_single_product_summary hook
										 *
										 */
										do_action('vendor_single_product');
									?>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>		
						
					<?php do_action( 'woocommerce_after_single_product' ); ?>

				<?php endwhile; // end of the loop. ?>
			
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

</div>
<div class="tabs tab-full-width clearfix">
	<div class="container">
		<div class="wrap-content">
		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
		</div>
	</div>
</div>

<?php if( bakan_sidebar_product() == 'full' && is_active_sidebar('bottom-detail-product2') ){ ?>
	<div class="bottom-single-product-fullwidth clearfix">
		<div class="container">
			<?php dynamic_sidebar('bottom-detail-product2'); ?>
		</div>
	</div>
<?php } ?>