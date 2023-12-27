<?php
/**
 * Custom Color
 *
 */

function bakan_adjustBrightness($hexCode, $adjustPercent) {
    $hexCode = ltrim($hexCode, '#');

    if (strlen($hexCode) == 3) {
        $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
    }

    $hexCode = array_map('hexdec', str_split($hexCode, 2));

    foreach ($hexCode as & $color) {
        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
        $adjustAmount = ceil($adjustableLimit * $adjustPercent);

        $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
    }

    return '#' . implode($hexCode);
}
 

function bakan_custom_color(){
	$color = swg_options( 'scheme_color' );
	$scheme_meta = get_post_meta( get_the_ID(), 'scheme', true );
	$scheme = ( $scheme_meta != '' && $scheme_meta != 'none' && is_page() ) ? $scheme_meta : swg_options('scheme');
	$url = "'../assets/img/$scheme'";
	if( $color == '' ) {
		switch( $scheme ){
			case 'default':
				$color = '#ff4e08';
			break;
			case 'violet':
				$color = '#6466e8';
			break;
			default:
			$color = '#ff4e08';
		}
	}

	$darken5 = bakan_adjustBrightness( $color, -0.05 );
	$darken10 = bakan_adjustBrightness( $color, -0.1 );
	$darken15 = bakan_adjustBrightness( $color, -0.15 );
	$darken20 = bakan_adjustBrightness( $color, -0.2 );
	$lighten5 = bakan_adjustBrightness( $color, 0.05 );
	$lighten10 = bakan_adjustBrightness( $color, 0.1 );
	$lighten15 = bakan_adjustBrightness( $color, 0.15 );
	$lighten20 = bakan_adjustBrightness( $color, 0.20 );

	$custom_css =" 
		:root {--color: $color; --bg_url: $url; --darken5: $darken5;--darken10: $darken10;--darken15: $darken15;--darken20: $darken20; --lighten5: $lighten5;--lighten10: $lighten10;--lighten15: $lighten15;--lighten20: $lighten20; --url: $url }
	";
	wp_add_inline_style( 'bakan-css', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'bakan_custom_color', 101 );