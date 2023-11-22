<?php
/**
 * View template for SWE Testimonial widget
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$sweWrap = 'swe-wrap-testimonial-layout1 swe-wrapper';
$sweWrapContent = 'swe-slider';
if($settings['style']) {
	$sweWrap .= ' ' . $settings['style'];
}
?>
<div class="<?php echo esc_attr($sweWrap); ?>">
	<div class="<?php echo esc_attr($sweWrapContent); ?>" <?php echo ent2ncr($settings['slider_options']); ?>>
		<?php foreach ($settings['content'] as $content) { ?>
			<div class="item">
				<div class="swe-testimonial-item">
					<div class="swe-content">
						<?php if ( $settings['show_desc'] ) { ?>
							<?php if ($content['author_desc']) { ?>
								<div class="swe-description"><?php echo esc_html($content['author_desc']); ?></div>
							<?php } ?>
						<?php } ?>
						<?php if ( $settings['show_quotation'] ) { ?>
						<div class="swe-quote">
							<i class="fas fa-quote-left"></i>
						</div>
						<?php } ?>
						<div class="swe-text"><?php echo esc_html($content['testimonial_content']); ?></div>
						<div class="swe-author">
							<div class="swe-author-info">
								<?php if ($content['author_name']) { ?>
									<div class="swe-name"><?php echo esc_html($content['author_name']); ?></div>
								<?php } ?>
							</div>
						</div>
						<?php if ( $settings['show_star'] ) { ?>
							<div class="swe-rate">
								<?php for ($i=1; $i <= 5; $i++) {
									if ($i <= $content['star']['size']) { ?>
										<i class="fas fa-star"></i>
									<?php } else { ?>
										<i class="far fa-star"></i>
									<?php }
								} ?>
							</div>
						<?php } ?>
					</div>
					<div class="swe-author">
						<?php if ( $settings['show_avatar'] ) { ?>
						<div class="swe-avatar">
							<?php if ($content['avatar']['id']) {
								echo wp_get_attachment_image($content['avatar']['id'], 'medium');
							} else { ?>
								<img src="<?php echo esc_url(SWPE_PLUGIN_URI . 'assets/img/banner-placeholder.png'); ?>" alt="">
							<?php } ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
