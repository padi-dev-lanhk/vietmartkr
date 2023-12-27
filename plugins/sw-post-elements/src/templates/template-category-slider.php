<?php
/**
 * View template for SWE Category Slider
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$sweWrap = 'swe-category-slider swe-wrapper';
if ($settings['layout_style']) {
	$sweWrap .= ' ' . $settings['layout_style'];
}
?>

<div class="<?php echo esc_attr($sweWrap); ?>">
	<div class="swe-slider" <?php echo ent2ncr($settings['slider_options']); ?>>
		<?php foreach ($settings['content'] as $content) {
			$cat = get_term_by('slug', $content['category'], 'category');
			?>
			<div class="swe-item">
				<div class="swe-wrap-item">
					<div class="swe-wrap-image">
						<a href="<?php echo get_category_link($cat->term_id); ?>">
							<?php if ($settings['show_image']) {
								if ($content['image']['id']) {
									echo wp_get_attachment_image($content['image']['id'], $settings['image_size']);
								} else {
									$no_image = SWPE_PLUGIN_URI . 'assets/img/no-image.png';
									printf( '<img src="%s" alt="%s" />', esc_url($no_image), esc_html($cat->name) );
								}
							} ?>
						</a>
					</div>
					<div class="swe-wrap-content">
						<h3 class="swe-title">
							<a href="<?php echo get_category_link($cat->term_id); ?>">
								<?php echo esc_html($cat->name); ?>
								<?php if($settings['show_count'] === 'yes'){ ?>
									<span>(<?php echo esc_html($cat->count); ?>)</span>
								<?php } ?>
							</a>
						</h3>
						<?php if ($settings['show_description'] == 'yes' && $cat->description != '') { ?>
							<div class="swe-description"><?php echo esc_html($cat->description); ?></div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
