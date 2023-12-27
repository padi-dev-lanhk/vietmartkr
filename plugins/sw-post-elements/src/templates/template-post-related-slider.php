<?php

if (!is_single()) {
	return;
}

$sweWrap = 'swe-wrap-post swe-wrap-post-related swe-wrapper ';
if ($settings['layout_style']) {
	$sweWrap .= ' ' . $settings['layout_style'];
}

$sweWrapId = 'swe-wrapper-'. $settings['id_int'];

$sweWrapPosts = 'posts swe-slider';
global $post;
$args=array(
	'post__not_in' => array($post->ID),
	'posts_per_page' => $settings['post_number'],
	'ignore_sticky_posts'=>1
);
$posts = new wp_query( $args );
if ($settings['related_posts'] == 'category') {
	$categories = get_the_category($post->ID);
	$category_ids = array();
	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	$args['category__in'] = $category_ids;
}
if ($settings['related_posts'] == 'tags') {
	$tags = wp_get_post_tags($post->ID);
	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		$args['tag__in'] = $tag_ids;
	}
}
$posts = new WP_Query($args);
?>
<div class="<?php echo esc_attr($sweWrap); ?>" id="<?php echo esc_attr($sweWrapId); ?>">
	<?php if ($settings['title']) { ?>
		<div class="swe-wrap-head">
			<h2 class="swe-title"><?php echo esc_html($settings['title']); ?></h2>
		</div>
	<?php } ?>
	<div class="<?php echo esc_attr($sweWrapPosts); ?>" <?php echo ent2ncr($settings['slider_options']); ?>>
		<?php if( $posts->have_posts() ) {
			while($posts->have_posts()){ $posts->the_post();
				swe_get_template_single_post( 'post', $settings);
			}
			wp_reset_postdata();
		} ?>
	</div>
</div>
