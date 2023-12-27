<?php 
if ( !class_exists( 'WooCommerce' ) ) { 
	return false;
}
global $woocommerce; ?>
<div class="bakan-minicart-mobile">
	<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'bakan' ); ?>">
	<span class="icon-menu"></span>
	<?php echo '<span class="minicart-number">'.$woocommerce->cart->cart_contents_count.'</span>'; ?>
	<span class="menu-text"><?php echo esc_html__( 'Cart', 'bakan' ); ?></span>
	</a>
</div>