<?php 
	$format = get_post_format();
	global $post;
?>
	<div id="post-<?php the_ID();?>" <?php post_class( bakan_blogcol() ); ?>>
		<div class="entry clearfix">
			<?php if( $format == '' || $format == 'image' ){ ?>
				<?php if ( get_the_post_thumbnail() ){ ?>
					<div class="entry-thumb">	
						<a class="entry-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail('large');?>				
						</a>
						<span class="entry-date">
							<span class="day"><?php echo get_the_date( 'd', $post->ID );?></span>
							<span class="month"><?php echo get_the_date( 'M', $post->ID );?></span>
						</span>
					</div>			
				<?php } ?>
				<div class="entry-content">				
					<div class="content-top clearfix">
						<div class="entry-meta">
							<span class="entry-author">
								<?php esc_html_e('Posted by:', 'bakan'); ?> <?php the_author_posts_link(); ?>
							</span>
						</div>
						<div class="entry-title">
							<h4><a href="<?php echo get_permalink($post->ID)?>"><?php the_title(); ?></a></h4>
						</div>
						<div class="entry-summary">
							<?php 												
								if ( preg_match('/<!--more(.*?)?-->/', $post->post_content, $matches) ) {
									echo wp_trim_words($post->post_content, 16, '...');
								} else {
									the_content('...');
								}		
							?>
						</div>
					</div>
					<div class="readmore clearfix"><a href="<?php echo get_permalink($post->ID)?>"><?php esc_html_e('Read More', 'bakan'); ?></a></div>
				</div>
			<?php } elseif( !$format == ''){?>
			<div class="wp-entry-thumb">	
				<?php if( $format == 'video' || $format == 'audio' ){ ?>	
					<?php echo sprintf( ( $format == 'video' ) ? '<div class="video-wrapper">%s</div>' : '%s', bakan_get_entry_content_asset( $post->ID ) ); ?>
				<?php } ?>
				
				<?php if( $format == 'gallery' ) { 
					if(preg_match_all('/\[gallery(.*?)?\]/', $post->post_content, $matches)){
						$attrs = array();
						if (count($matches[1])>0){
							foreach ($matches[1] as $m){
								$attrs[] = shortcode_parse_atts($m);
							}
						}
						$ids = '';
						if (count($attrs)> 0){
							foreach ($attrs as $attr){
								if (is_array($attr) && array_key_exists('ids', $attr)){
									$ids = $attr['ids'];
									break;
								}
							}
						}
					?>
						<div id="gallery_slider_<?php echo esc_attr( $post->ID ); ?>" class="carousel slide gallery-slider" data-interval="0">	
							<div class="carousel-inner">
								<?php
									$ids = explode(',', $ids);						
									foreach ( $ids as $i => $id ){ ?>
										<div class="item<?php echo esc_attr( ( $i== 0 ) ? ' active' : '' ); ?>">			
												<?php echo wp_get_attachment_image($id, 'full'); ?>
										</div>
									<?php }	?>
							</div>
							<a href="#gallery_slider_<?php echo esc_attr( $post->ID ); ?>" class="left carousel-control" data-slide="prev"><?php esc_html_e( 'Prev', 'bakan' ) ?></a>
							<a href="#gallery_slider_<?php echo esc_attr( $post->ID ); ?>" class="right carousel-control" data-slide="next"><?php esc_html_e( 'Next', 'bakan' ) ?></a>
						</div>
					<?php }	?>							
				<?php } ?>
			</div>
			<div class="entry-content">				
				<div class="content-top">
						<div class="entry-meta">
							<span class="entry-author">
								<?php esc_html_e('Posted by:', 'bakan'); ?> <?php the_author_posts_link(); ?>
							</span>
						</div>
						<div class="entry-title">
							<h4><a href="<?php echo get_permalink($post->ID)?>"><?php the_title(); ?></a></h4>
						</div>
						<div class="entry-summary">
						<?php the_content( '...' ); ?>
						<div class="readmore clearfix"><a href="<?php echo get_permalink($post->ID)?>"><?php esc_html_e('Read More', 'bakan'); ?></a></div>
					</div>
				 </div>
			</div>
			<?php } ?>
		</div>
	</div>