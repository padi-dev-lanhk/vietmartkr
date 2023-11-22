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
<div id="<?php echo esc_attr( $id ) ?>" class="responsive-post-slider6 responsive-slider loading clearfix" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
	<?php if( $title2 != '' ){?>
		<div class="box-title clearfix">
			<div class="des"><?php echo $description; ?></div>
			<h3><?php echo ( $title2 != '' ) ? $title2 : $term_name; ?></h3>
		</div>
	<?php } ?> 
	<div class="resp-slider-container">
		<div class="slider responsive">
			<?php foreach ($list as $post){ ?>
			<?php if($post->post_content != Null) { ?>
			<div class="item widget-pformat-detail">								
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
						<div class="entry-date"><a href="<?php echo get_permalink($post->ID)?>"><?php echo get_the_date( '', $post->ID );?></a></div>	
					</div>
					<div class="entry-content">
						<h4><a href="<?php echo get_permalink($post->ID)?>"><?php echo $post->post_title;?></a></h4>
						<div class="description">
							<?php 										
								$content = self::ya_trim_words($post->post_content, $length, '...');							
								echo $content;
							?>
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