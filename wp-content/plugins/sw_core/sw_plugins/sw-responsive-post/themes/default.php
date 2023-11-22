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
<div id="<?php echo esc_attr( $id ) ?>" class="responsive-post-slider responsive-slider clearfix loading" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
	<div class="resp-slider-container">
		<?php if( $title2 != '' ){?>
		<div class="box-title">
			<h3><?php echo ( $title2 != '' ) ? $title2 : $term_name; ?></h3>
		</div>
		<?php } ?> 
		<div class="slider responsive">
			<?php foreach ($list as $post){ ?>
			<?php if($post->post_content != Null) { ?>
			<div class="item widget-pformat-detail">
				<div class="item-inner">								
					<div class="item-detail">
						<div class="img_over">
							<a href="<?php echo get_permalink($post->ID)?>" >
								<?php 
								if ( has_post_thumbnail( $post->ID ) ){
									echo get_the_post_thumbnail( $post->ID, array( 230, 110) ) ? get_the_post_thumbnail( $post->ID, array( 230, 110) ): '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';		
								}else{
									echo '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.'large'.'.png" alt="No thumb">';
								}
								?>
							</a>
						</div>
						<div class="entry-content">
							<div class="item-title">
								<h4><a href="<?php echo get_permalink($post->ID)?>"><?php echo $post->post_title;?></a></h4>
							</div>		
							<div class="description1">
								<?php 										
									$content = self::ya_trim_words($post->post_content, 10, '...');									
									echo $content;
								?>
							</div>
							<div class="entry-date"><a href="<?php echo get_permalink($post->ID)?>"><?php echo get_the_date( '', $post->ID );?></a></div>												
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php }?>
		</div>
	</div>
</div>
<?php } ?>