<?php
/**
 * View template for SWE Woo Categories Slider
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$sweWrap = 'swe-woo-categories-slider swe-wrapper';
if ($settings['layout_style']) {
	$sweWrap .= ' ' . $settings['layout_style'];
}
$image_class = ! empty( $settings['hover_animation'] ) ? 'elementor-animation-' . $settings['hover_animation'] : '';
?>

<div class="<?php echo esc_attr($sweWrap); ?>">
	<div class="swe-slider" <?php echo $settings['slider_options']; ?>>
		<?php 
		if ($settings['product_cats']) {
			foreach ($settings['product_cats'] as $index => $slugCat) {
				$cat = get_term_by('slug', $slugCat, 'product_cat');
				?>
				<div class="swe-item">
					<div class="swe-wrap-item">
						<div class="swe-wrap-image <?php echo $image_class; ?>">
							<a href="<?php echo get_category_link($cat->term_id); ?>">
								<?php 
								if ($settings['show_image']) {
									$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
									if ($thumbnail_id && $thumbnail_id != '0') {
										echo wp_get_attachment_image($thumbnail_id, 'medium');
									} else {
										$no_image = SWWE_PLUGIN_URI . 'assets/img/no-image.png';
										printf('<img src="%s" alt="%s" />', $no_image, $cat->name);
									}
								}
								?>
							</a>
						</div>
						<div class="swe-wrap-content">
							<?php printf('<h3 class="swe-title"><a href="%s">%s</a></h3>', get_category_link($cat->term_id), $cat->name); ?>
							<?php if ($settings['show_description'] == 'yes' && $cat->description != '') {
								printf('<div class="swe-description">%s</div>', $cat->description);
							} ?>
						</div>
					</div>
				</div>
				<?php 
			}
		} ?>
	</div>
</div>
