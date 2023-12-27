<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$sidebar_template = ( get_post_meta( get_the_ID(), 'page_sidebar_layout', true ) != '' ) ? get_post_meta( get_the_ID(), 'page_sidebar_layout', true ) : swg_options('sidebar_product_detail');

?>

<?php get_header(); ?>

<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
	<div class="bakan_breadcrumbs">
		<div class="container">
			<?php
				if (!is_front_page() ) {
					if (function_exists('bakan_breadcrumb')){
						bakan_breadcrumb('<div class="breadcrumbs theme-clearfix">', '</div>');
					} 
				} 
			?>
		</div>
	</div>
<?php endif; ?>

<?php
	if ( $sidebar_template == 'full') :
		get_template_part( 'woocommerce/content-single-product-full-width' );
	else :
		get_template_part( 'woocommerce/content-single-product' );
	endif;
?>

<?php get_footer(); ?>