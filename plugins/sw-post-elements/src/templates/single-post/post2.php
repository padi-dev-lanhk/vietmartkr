<div class="post">
	<div class="swe-wrap-item">
		<?php if ( $settings['show_image'] == 'yes' ) { ?>
			<div class="swe-wrap-image">
				<?php swe_get_template_single_post( 'media', $settings ); ?>
			</div>
		<?php } ?>
		<div class="swe-wrap-content">
			<?php 
			if ($settings['show_author'] == 'yes' || $settings['show_date'] == 'yes' || $settings['show_cats'] == 'yes') { ?>
				<ul class="post-info">
					<?php if ($settings['show_date'] == 'yes') { ?>
						<li class="post-date">
							<?php if($settings['show_info_icon'] == 'yes'){ ?>
								<i class="fas fa-clock"></i>
							<?php } ?>
							<?php echo get_the_date(); ?>
						</li>
					<?php } ?>
					<?php if ($settings['show_author'] == 'yes') { ?>
						<li class="post-author">
							<?php if($settings['show_info_icon'] == 'yes'){ ?>
								<i class="fas fa-user"></i>
							<?php } else {
								echo esc_html__('Post by: ', 'sw-post-elements');
							} ?>
							<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>">
								<?php the_author(); ?>
							</a>
						</li>
					<?php }
					if ($settings['show_cats'] == 'yes') { ?>
						<li class="post-cats">
							<?php if($settings['show_info_icon'] == 'yes'){ ?>
								<i class="fas fa-folder-open"></i>
							<?php } else {
								echo esc_html__('Post in ', 'sw-post-elements'); 
							} ?>
							<?php echo get_the_term_list( get_the_ID(), 'category', '', ', ', '' ); ?>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
			<h3 class="swe-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
			<?php if ($settings['show_excerpt'] == 'yes') { ?>
				<div class="swe-description"><?php echo get_the_excerpt(); ?></div>
			<?php }
			if ($settings['show_readmore'] == 'yes') { ?>
				<a href="<?php echo get_the_permalink(); ?>" class="swe-button"><?php echo esc_html($settings['readmore_text']); ?></a>
			<?php } ?>
		</div>
	</div>
</div>
