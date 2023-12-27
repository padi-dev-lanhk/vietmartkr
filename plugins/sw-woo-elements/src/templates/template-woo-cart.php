<?php 
if ( !class_exists( 'WooCommerce' ) ) { 
	return false;
}
if(!WC()->cart ){
	return;
}
$sweWrap = 'swe-woo-cart swe-wrapper';
if ($settings['layout_style']) {
	$sweWrap .= ' ' . $settings['layout_style'];
}
$cart_count = WC()->cart->get_cart_contents_count();
$cart_total = WC()->cart->get_cart_total();

global $woocommerce;
?>

<div class="<?php echo esc_attr($sweWrap, 'sw-woo-elements'); ?>">
	<input type="checkbox" id="woo-cart-<?php echo esc_attr($settings['id_int'], 'sw-woo-elements'); ?>" class="input-toggle">
	<div class="woo-cart-open">
		<div class="swe-wrap-cart-head <?php echo esc_attr($settings['position_icon'], 'sw-woo-elements'); ?>">
			<div class="swe-cart-icon <?php echo $settings['show_image_icon'] == 'yes' ? 'cart-image-icon' : ''; ?>">
				<?php if ($settings['show_image_icon'] != 'yes') {
					\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
				} else {
						$imageIcon = $settings['image_icon']['url'] ? $settings['image_icon']['url'] : SWWE_PLUGIN_URI . 'assets/img/no-image.png';
						echo '<div class="image-icon"><span>';
						printf('<img class="img-logo" src="%s" alt="Cart icon" />', $imageIcon);
						$settings['image_icon_hover']['url'] && printf('<img class="img-logo-hover" src="%s" alt="Cart icon" />', $settings['image_icon_hover']['url']);
						echo '</span></div>';
				}
				if ($settings['show_count'] == 'yes') {
					printf('<span class="swe-cart-count">%s</span>', $cart_count);
				} ?>
			</div>
			<?php if ($settings['show_subtotal']) { ?>
				<div class="swe-cart-subtotal">
					<?php 
					if ($settings['text_cart'] != '') {
						printf('<span class="text">%s</span>', $settings['text_cart']);
					}
					printf('<span class="swe-cart-total">%s</span>', $cart_total);
					?>
				</div>
			<?php } ?>
		</div>
	</div>
	<label for="woo-cart-<?php echo esc_attr($settings['id_int'], 'sw-woo-elements'); ?>" class="woo-cart-mask woo-cart-close"></label>
	<div class="swe-wrap-cart-content">
		<div class="swe-wrap-cart-top">
			<?php printf('<h4 class="cart-title">%s</h4>', __('Shopping Cart', 'sw-woo-elements'), $cart_count); ?>
			<div class="swe-close"><?php echo __('Close', 'sw-woo-elements'); ?><i class="fas fa-times"></i></div>
		</div>
		<div class="swe-wrap-cart-bottom">
			<?php woocommerce_mini_cart(); ?>
		</div>
	</div>
</div>
