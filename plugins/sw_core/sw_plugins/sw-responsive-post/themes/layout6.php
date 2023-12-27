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
<div id="<?php echo esc_attr( $id ) ?>" class="responsive-post-slider5 clearfix">
	<?php if( $title2 != '' ){?>
	<div class="box-title clearfix">
		<div class="fontd-title pull-left"><?php echo ( $title2 != '' ) ? $title2 : $term_name; ?></div>
		<a class="readmore pull-right" href="<?php echo esc_url( get_category_link( $category ) );?>"><span><?php esc_html_e('View our magazines', 'sw_core')?></span></a>
	</div>
	<?php } ?> 
	<div class="slider-content clearfix">
		<?php foreach ($list as $post){ ?>
		<?php if($post->post_content != Null) { ?>
		<div class="item pull-left">								
			<div class="item-detail">
				<div class="img_over">
					<a href="<?php echo get_permalink($post->ID)?>" >
					<?php 
					if ( has_post_thumbnail( $post->ID ) ){
						echo get_the_post_thumbnail( $post->ID, 'full' ) ? get_the_post_thumbnail( $post->ID, 'full' ): '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';		
					}else{
						echo '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';
					} ?>								
					</a>
				</div>
				<div class="entry-content">
					<div class="entry-date"><a href="<?php echo get_permalink($post->ID)?>"><?php echo get_the_date( '', $post->ID );?></a></div>
					<div class="fontd-title"><a href="<?php echo get_permalink($post->ID)?>"><?php echo $post->post_title;?></a></div>
					<div class="description">
						<?php 										
							$content = self::ya_trim_words($post->post_content, $length, '...');							
							echo $content;
						?>
					</div>
					<a class="readmore" href="<?php echo get_permalink($post->ID)?>"><?php esc_html_e('Read more', 'sw_core')?></a>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php }?>
	</div>
</div>
<?php } ?>