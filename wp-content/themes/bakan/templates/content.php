<?php get_header(); ?>
<?php 
	$bakan_sidebar_template =( swg_options('sidebar_blog') ) ? swg_options('sidebar_blog') : 'right';
	if( is_category() || is_tag() ){
			if( get_term_meta( get_queried_object()->term_id, 'term_layout', true != '0' ) ){
				$bakan_blog_styles = ( get_term_meta( get_queried_object()->term_id, 'term_layout', true ) != '' ) ? get_term_meta( get_queried_object()->term_id, 'term_layout', true ) : swg_options('blog_layout');
			}else{
				$bakan_blog_styles = ( swg_options('blog_layout') ) ? swg_options('blog_layout') : 'list';
			}
	}else{
		$bakan_blog_styles = ( swg_options('blog_layout') ) ? swg_options('blog_layout') : 'list';
	}
	
?>

<div class="bakan_breadcrumbs">
	<div class="container">
		<?php
			if (!is_front_page() ) {
				if (function_exists('bakan_breadcrumb')){
					bakan_breadcrumb('<div class="breadcrumbs theme-clearfix">', '</div>');
				} 
			} 
		?>
		<div class="listing-title">			
			<h1><span><?php bakan_title(); ?></span></h1>				
		</div>
	</div>
</div>

<div class="container">
	<div class="row sidebar-row">
		<!-- Left Sidebar -->
		<?php if ( is_active_sidebar('left-blog') && bakan_sidebar_template() == 'left' ):
			$bakan_left_span_class = ( swg_options('sidebar_left_expand') ) ? 'col-lg-'.swg_options('sidebar_left_expand') : 'col-lg-3';
			$bakan_left_span_class .= ( swg_options('sidebar_left_expand_md') ) ? ' col-md-'.swg_options('sidebar_left_expand_md') : ' col-md-3';
			$bakan_left_span_class .= ( swg_options('sidebar_left_expand_sm') ) ? ' col-sm-'.swg_options('sidebar_left_expand_sm') : ' col-sm-4';
		?>
		<aside id="left" class="sidebar <?php echo esc_attr($bakan_left_span_class); ?>">
			<?php dynamic_sidebar('left-blog'); ?>
		</aside>
		<?php endif; ?>
		
		<div class="category-contents <?php bakan_content_blog(); ?>">
			<!-- No Result -->
			<?php if (!have_posts()) : ?>
			<?php get_template_part('templates/no-results'); ?>
			<?php endif; ?>			
			
			<?php 
				$bakan_blogclass = 'blog-content blog-content-'. $bakan_blog_styles;
				if( $bakan_blog_styles == 'grid' ){
					$bakan_blogclass .= ' row';
				}
			?>
			<div class="<?php echo esc_attr( $bakan_blogclass ); ?>">
			<?php 			
				while( have_posts() ) : the_post();
					get_template_part( 'templates/content', $bakan_blog_styles );
				endwhile;
			?>
			<?php get_template_part('templates/pagination'); ?>
			</div>
			<div class="clearfix"></div>
		</div>
		
		<!-- Right Sidebar -->
		<?php if ( is_active_sidebar('right-blog') &&bakan_sidebar_template() == 'right' ):
			$bakan_right_span_class = ( swg_options('sidebar_right_expand') ) ? 'col-lg-'.swg_options('sidebar_right_expand') : 'col-lg-3';
			$bakan_right_span_class .= ( swg_options('sidebar_right_expand_md') ) ? ' col-md-'.swg_options('sidebar_right_expand_md') : ' col-md-3';
			$bakan_right_span_class .= ( swg_options('sidebar_right_expand_sm') ) ? ' col-sm-'.swg_options('sidebar_right_expand_sm') : ' col-sm-4';
		?>
		<aside id="right" class="sidebar <?php echo esc_attr($bakan_right_span_class); ?>">
			<?php dynamic_sidebar('right-blog'); ?>
		</aside>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>