<?php
/**
 * View template for SWE Tab Category Slider
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$sweWrap = 'swe-wrap-post swe-post-tab-slider swe-wrap-tabs swe-wrapper';
if ($settings['tabs_style']) {
	$sweWrap .= ' ' . $settings['tabs_style'];
}
if ($settings['layout_style']) {
	$sweWrap .= ' ' . $settings['layout_style'];
}

$sweWrapHead = 'swe-wrap-tab-head';
if ($settings['tabs_button']) {
	$sweWrapHead .= ' tabs-button ' . $settings['tabs_button'];
}

// default filter is latest
$args = array(
	'post_type'             => 'post',
	'post_status'           => 'publish',
	'ignore_sticky_posts'   => 1,
	'posts_per_page'        => $settings['post_number'],
	'order' 				=> $settings['order'],
	'orderby' 				=> $settings['orderby'],
);

if (isset($settings['exclude_post_ids'])) {
	$args['post__not_in'] = $settings['exclude_post_ids'];
} ?>

<div class="<?php echo esc_attr($sweWrap); ?>">
	<div class="swe-wrap-head">
		<?php if ($settings['title']) { ?>
			<h2 class="swe-title"><?php echo esc_html($settings['title']); ?></h2>
		<?php } ?>
		<?php if ($settings['post_cats']) { ?>
			<div class="<?php echo esc_attr($sweWrapHead); ?>">
				<button class="swe-button swe-navbar-toggle">
					<i class="fas fa-bars"></i>
				</button>
				<div class="swe-tab-head">
					<?php 
					foreach ($settings['post_cats'] as $index => $cat) {
						// attribute for title
						$tab_count = $index + 1;
						$attr_title = 'attribute_title' . $tab_count;
						$this->add_render_attribute( $attr_title, [
							'id' => 'swe-tab-title-' . $settings['id_int'] . $tab_count,
							'class' => [ 'swe-tab-title' ],
							'aria-selected' => 1 === $tab_count ? 'true' : 'false',
							'data-tab' => $tab_count,
							'role' => 'tab',
							'tabindex' => 1 === $tab_count ? '0' : '-1',
							'aria-controls' => 'swe-tab-content-' . $settings['id_int'] . $tab_count,
							'aria-expanded' => 'false',
						]);
						$term = get_term_by('slug', $cat, 'category'); ?>
						<div <?php echo ent2ncr($this->get_render_attribute_string($attr_title)); ?>>

							<?php if ($cat != 'all') {
								echo esc_html($term->name);
							} else {
								echo esc_html__('All', 'sw-post-elements');
							} ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="swe-wrap-tab-content">
		<?php if ($settings['post_cats']) { 
			foreach ($settings['post_cats'] as $index => $cat) {
				// Query for product
				$term = get_term_by('slug', $cat, 'category');
				$query = $args;
				if ($cat != 'all') {
					$query['tax_query'][] = array(
						'taxonomy'	=> 'category',
						'field'		=> 'term_id',
						'terms'		=> $term->term_id,
						'operator'	=> 'IN'
					);
				}

				$posts = new WP_Query($query);

				// attribute for content
				$tab_count = $index + 1;
				$attr_content = 'attribute_content' . $tab_count;
				$this->add_render_attribute( $attr_content, [
					'id' => 'swe-tab-content-' . $settings['id_int'] . $tab_count,
					'class' => [ 'swe-tab-content' ],
					'aria-selected' => 1 === $tab_count ? 'true' : 'false',
				]); ?>

				<div <?php echo ent2ncr($this->get_render_attribute_string($attr_content)); ?>>
					<div class="posts swe-slider" <?php echo ent2ncr($settings['slider_options']); ?>>
						<?php if( $posts->have_posts() ) {
							while( $posts->have_posts() ){ $posts->the_post();
								swe_get_template_single_post( 'post', $settings);
							}
							wp_reset_postdata();
						} ?>
					</div>
				</div>
			<?php } 
		} else {
			$query = $args;
			$posts = new WP_Query($query);
			?>
			<div class="posts swe-slider" <?php echo ent2ncr($settings['slider_options']); ?>>
				<?php if( $posts->have_posts() ) {
					while($posts->have_posts()){ $posts->the_post();
						swe_get_template_single_post( 'post', $settings);
					}
					wp_reset_postdata();
				} ?>
			</div>
		<?php } ?>
	</div>
</div>
