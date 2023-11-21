<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="searchform" method="get" role="search">
	<div>
		<label for="s" class="screen-reader-text"><?php esc_html_e( 'Search for', 'bakan' ) ?>:</label>
		<input type="text" name="s" value="<?php if (is_search()) { echo get_search_query(); } ?>" placeholder="<?php esc_attr_e( 'Search', 'bakan' ) ?>">
		<input type="submit" value="<?php esc_attr_e( 'Search', 'bakan' ) ?>">
	</div>
</form>