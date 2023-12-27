<?php 
/*
** Register Sidebar and Widgets
*/
function bakan_widgets_init() {
	
	// Sidebars
	global $bakan_widget_areas;
	$bakan_widget_areas = bakan_widget_setup_args();
	if ( count($bakan_widget_areas) ){
		foreach( $bakan_widget_areas as $sidebar ){
			$sidebar_params = apply_filters('bakan_sidebar_params', $sidebar);
			register_sidebar($sidebar_params);
		}
	}
}
add_action('widgets_init', 'bakan_widgets_init');