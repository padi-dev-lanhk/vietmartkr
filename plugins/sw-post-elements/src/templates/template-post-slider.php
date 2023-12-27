<?php 
/**
 * View template for SWE Post Grid widget
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */
global $wp_query;
$sweWrap = 'swe-wrap-post swe-wrap-post-grid swe-wrapper ';
if ($settings['layout_style']) {
	$sweWrap .= ' ' . $settings['layout_style'];
}

$sweWrapId = 'swe-wrapper-'. $settings['id_int'];

$sweWrapPosts = 'posts swe-slider';

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
} ?>

<div class="<?php echo esc_attr($sweWrap); ?>"  id="<?php echo esc_attr($sweWrapId); ?>">
	<div class="<?php echo esc_attr($sweWrapPosts); ?>" <?php echo ent2ncr($settings['slider_options']); ?>>
		<?php $posts = new WP_Query($args); ?>
		<?php if( $posts->have_posts() ) {
			while($posts->have_posts()){ $posts->the_post();
				swe_get_template_single_post( 'post', $settings);
			}
			wp_reset_postdata();
		} ?>
	</div>
</div>
