<?php
/**
 * View template for SWE Woo Categories Slider Layout1
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$sweWrap1 = 'swe-woo-categories-slider-layout1 swe-wrapper';
if ($settings['layout_style']) {
	$sweWrap1 .= ' ' . $settings['layout_style'];
}

$image_class = ! empty( $settings['hover_animation'] ) ? 'elementor-animation-' . $settings['hover_animation'] : '';
?>

<div class="<?php echo esc_attr($sweWrap1); ?>">
	<div class="swe-wrap-head">
		<?php if ($settings['title']) { ?>
			<h3 class="swe-title"><?php echo $settings['title']; ?></h3>
		<?php } ?>
	</div>
	<?php if ($settings['show_banner']) { ?> 
	<div class="swe-wraps-image">
		<div class="swe-wrap-image">
			<?php if ($settings['image']['id']) { ?>
				<a href="<?php echo ! empty( $settings['link']['url'] )? $settings['link']['url'] : '#'; ?>"><?php echo wp_get_attachment_image($settings['image']['id'], $settings['image_size'], false, ['class' => $image_class] ); ?></a>
		</div>
		<?php } ?>
		<?php if ($settings['image2']['id']) { ?>
		<div class="swe-wrap-image image2">
			<a href="<?php echo ! empty( $settings['link']['url'] )? $settings['link']['url'] : '#'; ?>">
			<?php 
				 echo wp_get_attachment_image($settings['image2']['id'], $settings['image_size'], false, ['class' => $image_class] );
			?>
			</a>
		</div>
		<?php } ?>
		<?php if ($settings['image3']['id']) { ?>
			<div class="swe-wrap-image image3">
				<a href="<?php echo ! empty( $settings['link']['url'] )? $settings['link']['url'] : '#'; ?>">
					<?php  echo wp_get_attachment_image($settings['image3']['id'], $settings['image_size'], false, ['class' => $image_class] ); ?>
				</a>
			</div>
		<?php } ?>
	<?php } ?>
	</div>
		<?php if ($settings['product_cats']) {
			foreach ($settings['product_cats'] as $index => $slugCat) {
				?>
				<div class="swe-slider" <?php echo $settings['slider_options']; ?>>
				<?php
				$cat = get_term_by('slug', $slugCat, 'product_cat');
				$termchildren = get_terms('product_cat',array('child_of' => $cat->term_id));
					if( count( $termchildren ) > 0 ){
						foreach ( $termchildren as $child ) {
				?>
				<div class="swe-item">
					<div class="swe-wrap-item">
						<div class="swe-wrap-image">
							<a href="<?php echo get_category_link($child->term_id); ?>">
								<?php 
								if ($settings['show_image']) {
									$thumbnail_id = get_term_meta( $child->term_id, 'thumbnail_id', true );
									if ($thumbnail_id && $thumbnail_id != '0') {
										echo wp_get_attachment_image($thumbnail_id, 'medium','', array( 'alt'=> $child->name ));
									} else {
										$no_image = SWWE_PLUGIN_URI . 'assets/img/no-image.png';
										printf('<img src="%s" alt="%s" />', $no_image, $child->name);
									}
								}
								?>
							</a>
						</div>
						<div class="swe-wrap-content">
							<?php printf('<h3 class="swe-title-cat"><a href="%s">%s</a></h3>', get_category_link($child->term_id), $child->name); ?>
							<?php if ($settings['show_product_count']) { ?><div class="product-count"><?php echo $child->count; ?><?php echo esc_html__(' items ','sw-woo-elements'); ?></div><?php } ?>
							<?php if ($settings['show_description'] == 'yes' && $child->description != '') {
								printf('<div class="swe-description">%s</div>', $child->description);
							} ?>
						</div>
					</div>
				</div>
				<?php 
						}
					}?>
				</div>
				<div class="view-all"><a href="<?php echo esc_url( get_category_link($cat->term_id) );?>"><?php echo esc_html__('View All Categories','sw-woo-elements'); ?></a></div>
			<?php }
		} ?>
</div>
