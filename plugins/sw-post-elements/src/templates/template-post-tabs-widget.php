<?php
/**
 * View template for SWE Post Tabs Widget
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */
$settings['image_size'] = 'medium';

$sweWrap = 'swe-wrap-post swe-post-tabs-widget swe-wrap-post-list swe-wrap-tabs swe-wrapper style-1';

$sweWrapHead = 'swe-wrap-tab-head';

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
		
		<?php if ($settings['post_tabs']) { ?>
			<div class="<?php echo esc_attr($sweWrapHead); ?>">
				<button class="swe-button swe-navbar-toggle">
					<i class="fas fa-bars"></i>
				</button>
				<div class="swe-tab-head">
					<?php 
					foreach ($settings['post_tabs'] as $index => $tab) {
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
						?>
						<div <?php echo ent2ncr($this->get_render_attribute_string($attr_title)); ?>>
							<?php if ($tab == 'popular') {
								echo esc_html__('Popular', 'sw-post-elements');
							} elseif($tab == 'recent') {
								echo esc_html__('Recent', 'sw-post-elements');
							} elseif($tab == 'comments') {
								echo esc_html__('Comments', 'sw-post-elements');
							} elseif($tab == 'tags') {
								echo esc_html__('Tags', 'sw-post-elements');
							} ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="swe-wrap-tab-content">
		<?php if ($settings['post_tabs']) { 
			foreach ($settings['post_tabs'] as $index => $tab) {
				// Query for product
				$query = $args;
				$query['orderby'] = 'meta_value';
				if ($tab == 'popular') {
					$query['meta_key'] = 'swe_post_views_count';
				} elseif($tab == 'recent') {
					$query['meta_key'] = '_last_viewed';
				} elseif($tab == 'comments') {
					$query['comment_count'] = array(
						'value'   => 0,
						'compare' => '>',
					);
				} elseif($tab == 'tags') {
					$tags = swe_get_all_tags();
					$query['tag'] = $tags;
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
					<div class="posts">
						<?php if( $posts->have_posts() ) {
							while( $posts->have_posts() ){ $posts->the_post();
								swe_get_template_single_post( 'post', $settings);
							}
							wp_reset_postdata();
						} ?>
					</div>
				</div>
			<?php } 
		} ?>
	</div>
</div>
