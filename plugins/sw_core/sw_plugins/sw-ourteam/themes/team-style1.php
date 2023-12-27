<?php 
	$ya_direction = false;
	$default = array(
		'post_type' => 'team',
		'orderby' => $orderby,
		'order' => $order,
		'post_status' => 'publish',
		'showposts' => $numberposts
	);
	$widget_id = 'sw_testimonial'.rand().time();
	$list = new WP_Query( $default );
?>
<div id="<?php echo esc_attr( $widget_id ) ?>" class="responsive-slider sw-ourteam-slider2 loading clearfix" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-rtl="<?php echo ( is_rtl() || $ya_direction == 'rtl' )? 'true' : 'false';?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-dots="true">
	<?php if( $title != '' ){?>
		<div class="block-title">
			<h3><?php echo $title; ?></h3>
		</div>
	<?php } ?> 
	<?php 
		if ( $list -> have_posts() ){
	?>
	<div class="resp-slider-container">
		<div class="slider responsive">
		<?php 
			$count_items = 0;
			$numb = ( $list->found_posts > 0 ) ? $list->found_posts : count( $list->posts );
			$count_items = ( $numberposts >= $numb ) ? $numb : $numberposts;
			$i = 0;
			while($list->have_posts()): $list->the_post();
			global  $post;
			$team_info = get_post_meta( $post->ID, 'team_info', true );
			if( $i % $item_row == 0 ){
		?>
			<div class="item">
		<?php } ?>
				<div class="item-wrap">			
				<?php if(has_post_thumbnail()){ ?>
					<div class="item-img">			
						<?php the_post_thumbnail( 'thumbnail' ); ?>
					</div>
				<?php } ?>					
					<div class="item-content">
						<div class="item-desc">
							<?php 
								if ( preg_match('/<!--more(.*?)?-->/', $post->post_content, $matches) ) {
									$content = explode($matches[0], $post->post_content, 2);
									$content = $content[0];
								} else {
									$content = self::ya_trim_words($post->post_content, $length, ' ');
								}
								echo esc_html( $content );
							?>
						</div>
						<h3><?php the_title(); ?></h3>
						<?php if( $team_info != '' ){ ?>
						<div class="team-info"><?php echo esc_html( $team_info ); ?></div>
						<?php } ?>
					</div>				
				</div>
			<?php if( ( $i+1 ) % $item_row == 0 || ( $i+1 ) == $count_items ){?> </div><?php } ?>
			<?php $i++; endwhile; wp_reset_postdata();?>
		</div>
	</div>
	<?php }	?>
</div>