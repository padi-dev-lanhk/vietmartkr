<?php 
	/* Display footer or not */
	if( !get_post_meta( get_the_ID(), 'page_footer_hide', true ) ) :
		bakan_footer_check();
	endif; ?>
</div>
<div class="menu-mobile"></div>
</div>
<?php wp_footer(); ?>

</body>
</html>