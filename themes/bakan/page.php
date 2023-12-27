<?php get_header(); ?>
<?php 
	$bakan_sidebar_template	= get_post_meta( get_the_ID(), 'page_sidebar_layout', true );
	$bakan_sidebar 			= get_post_meta( get_the_ID(), 'page_sidebar_template', true );
?>
	<?php if ( !is_front_page() ) { ?>
	<div class="bakan_breadcrumbs">
		<div class="container">
			<?php				
				if ( function_exists( 'bakan_breadcrumb' ) ){
					bakan_breadcrumb( '<div class="breadcrumbs theme-clearfix">', '</div>' );
				} 
			?>
			<div class="listing-title">			
				<h1><span><?php bakan_title(); ?></span></h1>				
			</div>
		</div>
	</div>	
	<?php } ?>
	
	<div class="container">
		<div class="row">
		<?php 
			if ( is_active_sidebar( $bakan_sidebar ) && $bakan_sidebar_template != 'right' && $bakan_sidebar_template !='full' ):
			$bakan_left_span_class = 'col-lg-'.swg_options('sidebar_left_expand');
			$bakan_left_span_class .= ' col-md-'.swg_options('sidebar_left_expand_md');
			$bakan_left_span_class .= ' col-sm-'.swg_options('sidebar_left_expand_sm');
		?>
			<aside id="left" class="sidebar <?php echo esc_attr( $bakan_left_span_class ); ?>">
				<?php dynamic_sidebar( $bakan_sidebar ); ?>
			</aside>
		<?php endif; ?>
		
			<div id="contents" role="main" class="main-page <?php bakan_content_page(); ?>">
				<?php
				get_template_part('templates/content', 'page')
				?>
			</div>
			<?php 
			if ( is_active_sidebar( $bakan_sidebar ) && $bakan_sidebar_template != 'left' && $bakan_sidebar_template !='full' ):
				$bakan_left_span_class = 'col-lg-'.swg_options('sidebar_left_expand');
				$bakan_left_span_class .= ' col-md-'.swg_options('sidebar_left_expand_md');
				$bakan_left_span_class .= ' col-sm-'.swg_options('sidebar_left_expand_sm');
			?>
				<aside id="right" class="sidebar <?php echo esc_attr($bakan_left_span_class); ?>">
					<?php dynamic_sidebar( $bakan_sidebar ); ?>
				</aside>
			<?php endif; ?>
		</div>		
	</div>
<?php get_footer(); ?>