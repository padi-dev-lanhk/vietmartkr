<?php
/**
 * Wordpress Less
*/

if($wp_config = @file_get_contents(ABSPATH."wp-config.php") ){
	if( !preg_match_all("/WP_MEMORY_LIMIT/", $wp_config, $output_array) ) {
		$wp_config = str_replace("\$table_prefix", "define('WP_MEMORY_LIMIT', '256M');\n\$table_prefix", $wp_config);
		@file_put_contents(ABSPATH."wp-config.php", $wp_config);
	}
}

function recurse_copy($src,$dst) {
	$dir = opendir($src);
	@mkdir($dst);
	while(false !== ( $file = readdir($dir)) ) {
		if (( $file != '.' ) && ( $file != '..' )) {
			if ( is_dir($src . '/' . $file) ) {
				recurse_copy($src . '/' . $file,$dst . '/' . $file);
			}
			else {
				copy($src . '/' . $file,$dst . '/' . $file);
			}
		}
	}
	closedir($dir);
}

add_action( 'wp', 'sw_less_construct', 20 );
function sw_less_construct(){
	if( function_exists( 'swg_options' ) ) :	
	require_once ( SWG_OPTIONS_DIR .'/lessphp/3rdparty/lessc.inc.php' );
			
	$custom_color =  swg_options('custom_color');
	$color 		  =  swg_options('scheme_color');
	$bd_color 	  =  swg_options('scheme_body');
	$bdr_color 	  =  swg_options('scheme_border');
	
	$path = get_template_directory().'/css';
	
	define( 'LESS_PATH', get_template_directory().'/assets/less' );
	define( 'CSS__PATH', $path );
	
	$scheme_meta = get_post_meta( get_the_ID(), 'scheme', true );
	$scheme = ( $scheme_meta != '' && $scheme_meta != 'none' ) ? $scheme_meta : swg_options('scheme');
	$ya_direction = swg_options( 'direction' );
	$scheme_vars = get_template_directory().'/templates/presets/default.php';
	$output_cssf = CSS__PATH.'/app-default.css';
	

	if ( file_exists($scheme_vars) ){
			include $scheme_vars;
			if( $color != '' ){
				$less_variables['color'] = $color;
			}
			if(  $bd_color != '' ) {
				$less_variables['body-color'] = $bd_color;
			}
			if(  $bdr_color != '' ){
				$less_variables['border-color'] = $bdr_color;
			}
			
			try {
				// less variables by theme_mod
				// $less_variables['sidebar-width'] = swg_options()->sidebar_collapse_width.'px';
				
				$less = new lessc();
				
				
				$less->setImportDir( array(LESS_PATH.'/app/', LESS_PATH.'/bootstrap/') );
				
				$less->setVariables($less_variables);
				
				$cache = $less->cachedCompile(LESS_PATH.'/app.less');
				file_put_contents($output_cssf, $cache["compiled"]);
				
				/* RTL Language */
				$rtl_cache = $less->cachedCompile(LESS_PATH.'/app/rtl.less');
				file_put_contents(CSS__PATH.'/rtl.css', $rtl_cache["compiled"]);
				
				$responsive_cache = $less->cachedCompile(LESS_PATH.'/app-responsive.less');
				file_put_contents(CSS__PATH.'/app-responsive.css', $responsive_cache["compiled"]);
				
				/* Mobile */
				$mobile_cache = $less->cachedCompile(LESS_PATH.'/mobile.less');
				file_put_contents(CSS__PATH.'/mobile.css', $mobile_cache["compiled"]);		
				
			} catch (Exception $e){
				exit;
			}
	}
	endif;
}
