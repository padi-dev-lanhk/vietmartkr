<?php 
/*
** Name: Functions
** Brand functions and includes
*/

require( PBRPATH . '/includes/element/sw-brand-element.php' );
require( PBRPATH . '/includes/taxonomy/sw-brand-taxonomy.php' );
require( PBRPATH . '/includes/widgets/sw-brand-widget.php' );
require( PBRPATH . '/includes/widgets/sw-brand-filter-widget.php' );

/*
** Register Widgets
*/
function sw_brand_widgets(){
	register_widget( 'sw_brand_widget' );	
	register_widget( 'sw_brand_filter_widget' );	
}
add_action( 'widgets_init', 'sw_brand_widgets' );


/*
** Function Override
*/
function swbr_override_check( $path, $file ){
	$paths = '';

	if( locate_template( 'sw_product_brand/'.$path . '/' . $file . '.php' ) ){
		$paths = locate_template( 'sw_product_brand/'.$path . '/' . $file . '.php' );		
	}else{
		$paths = SPBTHEME . '/' . $path . '/' . $file . '.php';
	}
	return $paths;
}


?>