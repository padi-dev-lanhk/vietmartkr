<?php

if (!is_single()) {
	return;
}
$sweWrap = 'swe-wrap-post swe-wrap-post-recently-viewed swe-wrapper ';
if ($settings['layout_style']) {
	$sweWrap .= ' ' . $settings['layout_style'];
}

$sweWrapId = 'swe-wrapper-'. $settings['id_int'];

$sweWrapPosts = 'posts swe-slider';
global $post;
$args=array(
	'post__not_in' => array($post->ID),
	'posts_per_page' => $settings['post_number'],
	'ignore_sticky_posts'=>1,
	'meta_key' => '_last_viewed',
	'orderby' => 'meta_value',
	'order' => $settings['order']
);

if (isset($settings['exclude_post_ids'])) {
	$args['post__not_in'] = $settings['exclude_post_ids'];
}



$posts = new WP_Query($args);

if( $posts->have_posts() ) { ?>
	<div class="<?php echo esc_attr($sweWrap); ?>" id="<?php echo esc_attr($sweWrapId); ?>">
		<?php if ($settings['title']) { ?>
			<div class="swe-wrap-head">
				<h2 class="swe-title"><?php echo esc_html($settings['title']); ?></h2>
			</div>
		<?php } ?>
		<div class="<?php echo esc_attr($sweWrapPosts); ?>" <?php echo ent2ncr($settings['slider_options']); ?>>
			<?php while($posts->have_posts()){ $posts->the_post();
				
				swe_get_template_single_post( 'post', $settings);
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
	<?php 
}
