<?php
/**
 * View template for SWE Woo Categories Slider Layout1
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$sweWrap2 = 'swe-woo-categories-slider-layout2 swe-wrapper';
if ($settings['layout_style']) {
	$sweWrap2 .= ' ' . $settings['layout_style'];
}

?>

<div class="<?php echo esc_attr($sweWrap2); ?>">
	<div class="swe-wrap-head">
		<?php if ($settings['title']) { ?>
			<h3 class="swe-title"><?php echo $settings['title']; ?></h3>
		<?php } ?>
	</div>
	<div class="swe-slider" <?php echo $settings['slider_options']; ?>>
		<?php 
		if ($settings['product_cats']) {
			foreach ($settings['product_cats'] as $index => $slugCat) {
				$cat = get_term_by('slug', $slugCat, 'product_cat');
				$termchildren = get_terms('product_cat',array('child_of' => $cat->term_id, 'number' => $settings['number_child']));
				?>
				<div class="swe-item">
					<div class="swe-wrap-item">
						<div class="swe-wrap-image">
							<a href="<?php echo get_category_link($cat->term_id); ?>">
								<?php 
								if ($settings['show_image']) {
									$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
									if ($thumbnail_id && $thumbnail_id != '0') {
										echo wp_get_attachment_image($thumbnail_id, 'full');
									} else {
										$no_image = SWWE_PLUGIN_URI . 'assets/img/no-image.png';
										printf('<img src="%s" alt="%s" />', $no_image, $cat->name);
									}
								}
								?>
							</a>
						</div>
						<?php
						if( count( $termchildren ) > 0 ){ ?>
							<div class="swe-wrap-child-cat">
								<ul>
								<?php foreach ( $termchildren as $child ) {
									?>
										<li>
												<?php printf('<a href="%s">%s</a>', get_category_link($child->term_id), $child->name); ?>
												<?php if ($settings['show_product_count']) { ?><span class="product-count"><?php echo $child->count; ?><?php echo esc_html__(' items ','sw-woo-elements'); ?></span><?php } ?>
										</li>
								<?php 
										} ?>
									<li class="view-all"><a href="<?php echo esc_url( get_category_link($cat->term_id) );?>"><?php echo esc_html__('View All','sw-woo-elements'); ?></a></li>
								</div>
								</ul>
							<?php } ?>
							
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