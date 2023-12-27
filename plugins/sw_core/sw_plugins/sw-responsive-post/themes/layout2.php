<?php 
	/**
		** Theme: Responsive Slider
		** Author: Smartaddons
		** Version: 1.0
	**/
	
	$default = array(
			'category' => $category, 
			'orderby' => $orderby,
			'order' => $order, 
			'numberposts' => $numberposts,
	);
	$list = get_posts($default);
	do_action( 'before' ); 
	$id = 'sw_reponsive_post_slider_'.rand().time();
	if ( count($list) > 0 ){
?>
<div class="clear"></div>
<div id="<?php echo esc_attr( $id ) ?>" class="responsive-post-style3">
	<div class="box-title"><?php echo ( $title2 != '' ) ? '<h3>'. esc_html( $title2 ) .'</h3>' : ''; ?></div>
	<div class="slider-container">
		<?php foreach ($list as $post){ 
			if($post->post_content != Null) { ?>
			<div class="item clearfix">
				<div class="entry-content">
					<div class="entry-cat"><a href="<?php echo esc_url( get_category_link( $category ) );?>"><?php echo get_cat_name( $category );?></a></div>
					<h4><a href="<?php echo get_permalink($post->ID)?>"><?php echo $post->post_title;?></a></h4>
				</div>
			</div>
			<?php } ?>
		<?php }?>
	</div>
</div>
<?php } ?>