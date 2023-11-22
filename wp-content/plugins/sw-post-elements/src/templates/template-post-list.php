<?php 
/**
 * View template for SWE Post List widget
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$settings['image_size'] = 'medium';

global $wp_query;

$sweWrap = 'swe-wrap-post swe-wrap-post-list swe-wrapper ';

$sweWrapId = 'swe-wrapper-'. $settings['id_int'];

$sweWrapPosts = 'posts ';

if ( is_front_page() ) {
	$paged = (get_query_var('page')) ? get_query_var('page') : 1;   
} else {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
}

// default filter is latest
$args = array(
	'post_type'             => 'post',
	'post_status'           => 'publish',
	'ignore_sticky_posts'   => 1,
	'paged'             => $paged,
	'posts_per_page'        => $settings['post_number'],
	'order' 				=> $settings['order'],
	'orderby' 				=> $settings['orderby'],
);

if (isset($settings['exclude_post_ids'])) {
	$args['post__not_in'] = $settings['exclude_post_ids'];
}

if ($settings['post_cats']) {
	$arrId = [];
	foreach ($settings['post_cats'] as $index => $cat) {
		$term = get_term_by('slug', $cat, 'category');
		$arrId[] = $term->term_id;
	}
	$args['category__in'] = $arrId;
}
?>

<div class="<?php echo esc_attr($sweWrap); ?>"  id="<?php echo esc_attr($sweWrapId); ?>">
	<div class="<?php echo esc_attr($sweWrapPosts); ?>">
		<?php $posts = new WP_Query($args); ?>
		<?php if( $posts->have_posts() ) {
			while($posts->have_posts()){ $posts->the_post();
				swe_get_template_single_post( 'post', $settings);
			}
			wp_reset_postdata();
		} ?>
	</div>
	<?php if ($settings['pagination'] == 'ajaxload') { ?>
		<div class="pagination-ajax">
			<?php swe_pagination(3, $posts, '', '<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'); ?>
			<div class="scroller-status">
				<div class="infinite-scroll-request">
					<div class="pagination-loading"><span class="loading"><i class="fas fa-spinner fa-spin"></i><?php echo esc_html__('Loading...','sw-post-elements') ?></span></div>
				</div>
				<p class="infinite-scroll-last"><?php echo esc_html__('All items loaded','sw-post-elements'); ?></p>
				<p class="infinite-scroll-error"><?php echo esc_html__('No more page','sw-post-elements'); ?></p>
			</div>
			<p class="view-more-button"><span><?php echo esc_html($settings['button_text']); ?></span></p>
		</div>
	<?php } 
	if($settings['pagination'] == 'numeric') {
		swe_pagination(100, $posts, '', '<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>');
	} ?>
</div>
