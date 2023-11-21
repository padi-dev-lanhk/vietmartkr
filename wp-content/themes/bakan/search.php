<?php get_header(); ?>

<div class="bakan_breadcrumbs">
	<div class="container">		
		<?php
			if (!is_front_page() ) {
				if (function_exists('bakan_breadcrumb')){
					bakan_breadcrumb('<div class="breadcrumbs theme-clearfix">', '</div>');
				} 
			} 
		?>
	</div>
</div>

<div class="container">
	<div class="listing-title">			
		<h1><span><?php bakan_title(); ?></span></h1>				
	</div>
	<?php
		$bakan_post_type = isset( $_GET['search_posttype'] ) ? $_GET['search_posttype'] : '';
		if( ( $bakan_post_type != '' ) &&  locate_template( 'templates/search-' . $bakan_post_type . '.php' ) ){
			get_template_part( 'templates/search', $bakan_post_type );
		}else{ 
			if( have_posts() ){
		?>
			<div class="blog-content content-search">
		<?php 
			while (have_posts()) : the_post(); 
			global $post;
			$post_format = get_post_format();
		?>
			<div id="post-<?php the_ID();?>" <?php post_class( 'theme-clearfix' ); ?>>
				<div class="entry clearfix">
					<?php if (get_the_post_thumbnail()){?>
					<div class="entry-thumb pull-left">
						<a class="entry-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">			
							<?php the_post_thumbnail("thumbnail")?>
						</a>
					</div>
					<?php }?>
					<div class="entry-content">
						<div class="entry-meta">
							<span class="entry-date"><i class="icon icon-calendar"></i><a href="<?php echo get_permalink($post->ID)?>"><?php echo get_the_date( '', $post->ID );?></a></span>
							<span class="entry-author">
								<i class="icon icon-user"></i><?php esc_html_e('by', 'bakan'); ?> <?php the_author_posts_link(); ?>
							</span>
							<?php
								$categories = get_the_category();
								$separator = '';
								$output = '';
								if ( ! empty( $categories ) ) {
							?>
							<span class="entry-cate">
								<i class="icon icon-folder"></i>
								<?php 
									foreach( $categories as $category ) {
										$output .= '<span><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'bakan' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></span>' . $separator;
									}
									echo trim( $output, $separator );
								?>
							</span>
								<?php }?>
						</div>
						<div class="title-blog">
							<h3>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?> </a>
							</h3>
						</div>
						<div class="entry-description">
							<?php 														
								if ( preg_match('/<!--more(.*?)?-->/', $post->post_content, $matches) ) {
									echo wp_trim_words($post->post_content, 30, '...');
								} else {
									echo wp_trim_words($post->post_content, 25, '...');
								}		
							?>
						</div>
						<div class="bl_read_more"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Read more','bakan')?></a></div>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'bakan' ).'</span>', 'after' => '</div>' , 'link_before' => '<span>', 'link_after'  => '</span>' ) ); ?>
					</div>
				</div>
			</div>			
		<?php endwhile; ?>
		<?php get_template_part('templates/pagination'); ?>
		</div>
	<?php
		}else{
				get_template_part('templates/no-results');
			}
		}
	?>
</div>
<?php get_footer(); ?>