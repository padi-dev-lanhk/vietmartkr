<?php 
/**
 * View template for SWE Woo Countdown Slider Layout2
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$sweWrap = 'swe-woo-countdown-slider-layout2 swe-wrapper';
if ($settings['layout_product']) {
	$sweWrap .= ' ' . $settings['layout_product'];
}
// default filter is latest
$args = array(
	'post_type'             => 'product',
	'post_status'           => 'publish',
	'ignore_sticky_posts'   => 1,
	'posts_per_page'        => 10,
	'order' 				=> $settings['order'],
	'orderby' 				=> $settings['orderby'],
);

$args['meta_query'] = array(
	array(
		'relation' => 'AND',
		array(
			'key'           => '_sale_price',
			'value'         => 0,
			'compare'       => '>',
			'type'          => 'numeric'
		),
		array(
			'key' 			=> '_sale_price_dates_from',
			'value' 		=> time(),
			'compare'	 	=> '<',
			'type' 			=> 'numeric'
		),
		array(
			'key' 			=> '_sale_price_dates_to',
			'value' 		=> time(),
			'compare' 		=> '>',
			'type' 			=> 'numeric'
		)
	)
);
$products = new WP_Query($args);
?>
<div class="<?php echo esc_attr($sweWrap, 'sw-woo-elements'); ?>">
	<?php if ($settings['title']) { ?>
		<div class="swe-wrap-head">
			<h2 class="swe-title"><?php echo $settings['title']; ?></h2>
			<div class="swe-desciption"><?php echo $settings['desciption']; ?></div>
			<div class="swe-desciption-sale"><?php echo $settings['desciption_sale']; ?></div>
			<div class="swe-countdown-head">
				<?php if ($settings && $settings['show_countdown_head'] == 'yes' && $settings['countdown_head'] != '') { ?>
						<h4 class="title-coundown-head"><?php echo $settings['title_head']; ?></h4>
					<?php
						$sw_date = strtotime($settings['countdown_head']);
						$date = date('m', $sw_date) . '-' . date('d', $sw_date) . '-' . date('Y', $sw_date) . '-' . date('H', $sw_date) . '-' . date('i', $sw_date) . '-' . date('s', $sw_date);
					?>
					<div class="countdown-info head">
						<div
						class="countdown"
						data-countdown="countdown"
						data-date="<?php echo esc_attr( $date ); ?>"
						data-textdays="<?php echo __('days', 'sw-woo-elements') ?>"
						data-texthours="<?php echo __('hours', 'sw-woo-elements') ?>"
						data-textmins="<?php echo __('mins', 'sw-woo-elements') ?>"
						data-textsecs="<?php echo __('secs', 'sw-woo-elements') ?>"
						></div>	
					</div> 
					<?php 
				} ?>
			</div>
		</div>
	<?php } ?>
	<ul class="products swe-slider" <?php echo $settings['slider_options']; ?>>
		<?php if( $products->have_posts() ) {
			while($products->have_posts()){ $products->the_post();
				global $product, $post;
				$sw_date_sale = '';
				$date = '';
				if ($settings && $settings['show_countdown']) {
					$sw_date_sale = get_post_meta( get_the_ID(), '_sale_price_dates_to', true );
					$date = date('m', $sw_date_sale) . '-' . date('d', $sw_date_sale) . '-' . date('Y', $sw_date_sale) . '-' . date('H', $sw_date_sale) . '-' . date('i', $sw_date_sale) . '-' . date('s', $sw_date_sale);
				} ?>

				<li <?php wc_product_class( 'item', $product ); ?>>
					<div class="products-entry item-wrap clearfix">
						<div class="item-detail">
							<div class="item-img products-thumb">
									<?php 
									do_action( 'woocommerce_before_shop_loop_item_title' );
									if ($settings && $settings['show_countdown'] == 'top') { ?>
										<div class="countdown-info top">
											<?php if ($settings['countdown_title']) {
												printf('<div class="count-title"><span>%s</span></div>', $settings['countdown_title']);
											} ?>
											<div
											class="countdown"
											data-countdown="countdown"
											data-date="<?php echo esc_attr( $date ); ?>"
											data-textdays="<?php echo __('days', 'sw-woo-elements') ?>"
											data-texthours="<?php echo __('hrs', 'sw-woo-elements') ?>"
											data-textmins="<?php echo __('mins', 'sw-woo-elements') ?>"
											data-textsecs="<?php echo __('secs', 'sw-woo-elements') ?>"
											></div>	
										</div> 
									<?php } ?>
							</div>
							<div class="item-content products-content">
								<?php	if ($settings && $settings['show_countdown'] == 'bottom') { ?>
									
									<div class="countdown-info bottom">
										<?php if ($settings['countdown_title']) {
											printf('<div class="count-title"><span>%s</span></div>', $settings['countdown_title']);
										} ?>
										<div
										class="countdown"
										data-countdown="countdown"
										data-date="<?php echo esc_attr( $date ); ?>"
										data-textdays="<?php echo __('days', 'sw-woo-elements') ?>"
										data-texthours="<?php echo __('hrs', 'sw-woo-elements') ?>"
										data-textmins="<?php echo __('mins', 'sw-woo-elements') ?>"
										data-textsecs="<?php echo __('secs', 'sw-woo-elements') ?>"
										></div>	
									</div> 
								<?php } ?>
								<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
								<?php 
									do_action( 'woocommerce_after_shop_loop_item_title' );
										if( $product->get_stock_quantity() != 0 ){ 
										$available 	 = $product->get_stock_quantity();
										$total_sales = get_post_meta( $post->ID, 'total_sales', true );
										$bar_width 	 = intval( $available ) / intval( $available + $total_sales ) * 100;
									?>
									<div class="swe-stock clearfix">
										<div class="stock-avail pull-left"><?php esc_html_e( 'Available: ', 'sw_woocommerce' ) ?><span><?php echo $available; ?></span></div>
									</div>
									<div class="sales-bar clearfix">
										<div class="sales-bar-total">
											<span style="width: <?php echo esc_attr( $bar_width . '%' ); ?>"></span>
										</div>
									</div>
									<?php } ?>
								<?php do_action( 'woocommerce_after_shop_loop_item' );
								?>

							</div>
						</div>
					</div>
				</li>

				<?php 
			}
			wp_reset_postdata();
		} ?>
	</ul>
</div>
