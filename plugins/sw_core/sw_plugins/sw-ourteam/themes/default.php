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
<div id="<?php echo esc_attr( $widget_id ) ?>" class="responsive-slider sw-ourteam-slider default loading clearfix" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-rtl="<?php echo ( is_rtl() || $ya_direction == 'rtl' )? 'true' : 'false';?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
	<?php if( $title != '' ){?>
		<div class="block-title">
			<h3><?php echo $title; ?></h3>
			<p><?php echo $description; ?></p>
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
			$facebook = get_post_meta( $post->ID, 'facebook', true );	
			$twitter = get_post_meta( $post->ID, 'twitter', true );
			$gplus = get_post_meta( $post->ID, 'gplus', true );
			$linkedin = get_post_meta( $post->ID, 'linkedin', true );
			$team_info = get_post_meta( $post->ID, 'team_info', true );
			if( $i % $item_row == 0 ){
		?>
			<div class="item">
		<?php } ?>
				<div class="item-wrap">			
					<?php if(has_post_thumbnail()){ ?>
						<div class="item-img item-height">
							<div class="item-img-info">				
								<?php the_post_thumbnail(); ?>								
							</div>
							<ul class="social">
								<?php if( $facebook != '' ){ ?>
									<li><a href="<?php echo esc_html( $facebook ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<?php } ?>
								<?php if( $twitter != '' ){ ?>
									<li><a href="<?php echo esc_html( $twitter ); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<?php } ?>
								<?php if( $linkedin != '' ){ ?>
									<li><a href="<?php echo esc_html( $linkedin ); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<?php } ?>
								<?php if( $gplus != '' ){ ?>
									<li><a href="<?php echo esc_html( $gplus ); ?>"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>			
					<div class="item-content">
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