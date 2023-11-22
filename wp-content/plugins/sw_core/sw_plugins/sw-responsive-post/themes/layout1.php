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
<div id="<?php echo esc_attr( $id ) ?>" class="responsive-post-style2">
	<div class="box-title"><?php echo ( $title2 != '' ) ? '<h3>'. esc_html( $title2 ) .'</h3>' : ''; ?></div>
	<div class="slider-container">
		<?php foreach ($list as $post){ 
			if($post->post_content != Null) { ?>
			<div class="item clearfix">							
				<div class="img_over pull-left">
					<a href="<?php echo get_permalink($post->ID)?>" >
					<?php 
					if ( has_post_thumbnail( $post->ID ) ){
						echo get_the_post_thumbnail( $post->ID, 'thumbnail' ) ? get_the_post_thumbnail( $post->ID, 'thumbnail' ): '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';		
					}else{
						echo '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';
					} ?></a>
				</div>
				<div class="entry-content">
					<div class="entry-date"><a href="<?php echo get_permalink($post->ID)?>"><?php echo get_the_date( '', $post->ID );?></a></div>
					<h4><a href="<?php echo get_permalink($post->ID)?>"><?php echo $post->post_title;?></a></h4>
				</div>
			</div>
			<?php } ?>
		<?php }?>
	</div>
</div>
<?php } ?>