<?php 
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.1
 */
 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$shop_categories  = swg_options( 'product_categories' );
	if( $shop_categories && bakan_sidebar_product() == 'left' || $shop_categories && bakan_sidebar_product() == 'right' ){
		$class = 'style1';
	}else{
		$class = '';
	}
?>
<?php get_header(); ?>

<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
	<div class="bakan_breadcrumbs <?php echo esc_attr( $class ); ?>">
		<div class="container">
			<?php
				if (!is_front_page() ) {
					if (function_exists('bakan_breadcrumb')){
						bakan_breadcrumb('<div class="breadcrumbs theme-clearfix">', '</div>');
					} 
				} 
			?>
		</div>
		<?php if( $shop_categories && bakan_sidebar_product() == 'left' || $shop_categories && bakan_sidebar_product() == 'right' ){
			if ( is_active_sidebar('shop-categories') ) {
			?>
			<div class="shop-categories-above">
				<div class="wrap-content container">            
					<?php dynamic_sidebar('shop-categories'); ?>
				</div>
			</div>
			<?php
		} }?>
	</div>
<?php endif; ?>
<div class="container archives">
	<div class="row sidebar-row">
	
	<!-- Left Sidebar -->
	<?php 	
	if ( is_active_sidebar('left-product') && bakan_sidebar_product() != 'right' && bakan_sidebar_product() != 'full' && bakan_sidebar_product() != '' ):
		$bakan_left_span_class = 'col-lg-'.swg_options('sidebar_left_expand');
		$bakan_left_span_class .= ' col-md-'.swg_options('sidebar_left_expand_md');
		$bakan_left_span_class .= ' col-sm-'.swg_options('sidebar_left_expand_sm');
	?>
	<aside id="left" class="sidebar <?php echo esc_attr($bakan_left_span_class); ?>">
		<?php dynamic_sidebar('left-product'); ?>
	</aside>	
	<?php endif; ?>
	
	<div id="contents" <?php bakan_content_product(); ?> role="main">
		<?php
			/**
			 * woocommerce_before_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			 global $post;
			do_action( 'woocommerce_before_main_content' );
		?>
		
		<!--  Shop Title -->
		<!-- Description --> 
		<?php do_action( 'woocommerce_archive_description' ); ?>
				
		<div class="products-wrapper">	
					
			<?php if ( have_posts() ) : ?>
				<?php do_action('woocommerce_message'); ?>
				
				<?php 					
								
					if( swg_woocommerce_version_check( '3.3' ) ){
						echo apply_filters( 'bakan_custom_category', $html = '' );
					}else{
						woocommerce_product_subcategories(); 
					}
					woocommerce_product_loop_end(); 
				?>
				<?php if( bakan_sidebar_product() == 'full' ){ ?>
						<?php
							/**
							 * woocommerce_before_shop_loop hook
							 *
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
						?>

				<?php } else { 
				
					/**
					 * woocommerce_before_shop_loop hook
					 *
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );

				} ?>

		
				<?php woocommerce_product_loop_start(); ?>				
										
					<?php while ( have_posts() ) : the_post(); ?>
		
					<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>
				<div class="clear"></div>			
				<?php
					/**
					 * woocommerce_after_shop_loop hook
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				?>
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
	
	<!-- Right Sidebar -->
	<?php if ( is_active_sidebar('right-product') && bakan_sidebar_product() != 'left' && bakan_sidebar_product() != 'full' && bakan_sidebar_product() != ''):
		$bakan_right_span_class = 'col-lg-'.swg_options('sidebar_right_expand');
		$bakan_right_span_class .= ' col-md-'.swg_options('sidebar_right_expand_md');
		$bakan_right_span_class .= ' col-sm-'.swg_options('sidebar_right_expand_sm');
	?>
	<aside id="right" class="sidebar <?php echo esc_attr($bakan_right_span_class); ?>">
		<?php dynamic_sidebar('right-product'); ?>
	</aside>
	<?php endif; ?>

	</div>
	<?php do_action( 'swg_bottom_detail_content' ); ?>
</div>
<?php get_footer(); ?>