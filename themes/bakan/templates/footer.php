<?php 	
	$bakan_page_footer   	 = ( get_post_meta( get_the_ID(), 'page_footer_style', true ) != '' ) ? get_post_meta( get_the_ID(), 'page_footer_style', true ) : swg_options( 'footer_style' );
	$bakan_copyright_footer = get_post_meta( get_the_ID(), 'copyright_footer_style', true );
	$bakan_copyright_footer  = ( get_post_meta( get_the_ID(), 'copyright_footer_style', true ) != '' ) ? get_post_meta( get_the_ID(), 'copyright_footer_style', true ) : swg_options('copyright_style');
?>
<footer id="footer" class="footer default theme-clearfix">
	<!-- Content footer -->
	<div class="container">
		<?php 
			if( $bakan_page_footer != '' ) :
				echo swg_get_the_content_by_id( $bakan_page_footer ); 
			endif;
		?>
	</div>
	<div class="footer-copyright <?php echo esc_attr( $bakan_copyright_footer ); ?>">
		<div class="container">
			<!-- Copyright text -->
			<div class="copyright-text">
				<p>&copy;<?php echo date_i18n('Y') .' '. esc_html__('WordPress Theme SW Bakan. All Rights Reserved. Designed by ','bakan'); ?><a class="mysite" href="<?php echo esc_url( 'http://wpthemego.com/' ); ?>"><?php esc_html_e('WPThemeGo.Com','bakan');?></a>.</p>
			</div>
		</div>
	</div>
</footer>