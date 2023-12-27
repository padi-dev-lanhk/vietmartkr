<?php get_header(); ?>
<div class="wrapper_404">
	<div class="container">
		<div class="row">
			<?php $bakan_404page = swg_options( 'page_404' ); ?>
			<?php if( $bakan_404page != '' ) : ?>
				<?php echo swg_get_the_content_by_id( $bakan_404page ); ?>
			<?php else: ?>
				<div class="content_404">
					<div class="erro-image">
						<img class="img_logo" alt="<?php echo esc_attr__( '404', 'bakan' ) ?>" src="<?php echo get_template_directory_uri(); ?>/assets/img/img-404.jpg">
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>