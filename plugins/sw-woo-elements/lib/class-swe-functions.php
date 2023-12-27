<?php 
/*
* get name asset type
*/
if (!function_exists('get_name_filter')) {
	function get_name_filter($slug) {
		switch ($slug) {
			case 'latest':
			return __('Latest', 'sw-woo-elements');
			break;
			case 'rating':
			return __('Rating', 'sw-woo-elements');
			break;
			case 'on_sale':
			return __('On Sale', 'sw-woo-elements');
			break;
			case 'best_selling':
			return __('Best Selling', 'sw-woo-elements');
			break;
			case 'featured':
			return __('Featured', 'sw-woo-elements');
			break;
			default:
			return __('All', 'sw-woo-elements');
			break;
		}
	}
}

/*
** Get timezone offset for countdown
*/
if (!function_exists('swe_timezone_offset')) {
	function swe_timezone_offset( $countdowntime ){
		$timeOffset = 0;	
		if( get_option( 'timezone_string' ) != '' ) :
			$timezone = get_option( 'timezone_string' );
			$dateTimeZone = new DateTimeZone( $timezone );
			$dateTime = new DateTime( "now", $dateTimeZone );
			$timeOffset = $dateTimeZone->getOffset( $dateTime );
		else :
			$dateTime = get_option( 'gmt_offset' );
			$dateTime = intval( $dateTime );
			$timeOffset = $dateTime * 3600;
		endif;

		$offset =  ( $timeOffset < 0 ) ? '-' . gmdate( "H:i", abs( $timeOffset ) ) : '+' . gmdate( "H:i", $timeOffset );
		$date = date( 'Y/m/d H:i:s', $countdowntime );
		$date1 = new DateTime( $date );
		$cd_date =  $date1->format('Y-m-d H:i:s') . $offset;

		return strtotime( $cd_date ); 
	}
}

if (!function_exists('swe_get_woo_content')) {
	function swe_get_woo_content($select = 1, $settings = []) {
		if ($select == 1) {
			include SWWE_PLUGIN_URL . 'src/templates/woo/content-product.php';
		} else {
			wc_get_template_part( 'content', 'product' );
		}
	}
}

/**
 * SWE Added Cart Fragments
 * @return array custom cart fragments of theme after updateFragments worked.
*/
if (!function_exists("swe_added_cart_fragments")) {
	function swe_added_cart_fragments($fragments) {
		ob_start();
		$cart = WC()->instance()->cart;
		$fragments['cart_count'] = $cart->get_cart_contents_count();
		$fragments['span.swe-cart-count'] = '<span class="swe-cart-count">' . $cart->get_cart_contents_count() . '</span>';
		$fragments['span.swe-cart-total'] = '<span class="swe-cart-total">' . $cart->get_cart_total() . '</span>';
		ob_start();
		?>
		<div class="swe-wrap-cart-bottom"><?php echo woocommerce_mini_cart(); ?></div>
		<?php 
		$fragments['.swe-wrap-cart-bottom'] = ob_get_clean();
		return $fragments;
	}
	add_filter('woocommerce_add_to_cart_fragments', 'swe_added_cart_fragments');
}

/**
 * SWE Pagination 
 */
if (!function_exists('swe_pagination')) {
	function swe_pagination($range = 2, $current_query = '', $pages = '', $prev_icon = '<i class="fas fa-chevron-left"></i>', $next_icon = '<i class="fas fa-chevron-right"></i>', $end_size = 2) {
		$showitems = ($range * 2) + 1;

		if ($current_query == '') {
			global $paged;
			if (empty($paged)) $paged = 1;
		} else {
			$paged = $current_query->query_vars['paged'];
		}

		if ($pages == '') {
			if ($current_query == '') {
				global $wp_query;
				$pages = $wp_query->max_num_pages;
				if (!$pages) {
					$pages = 1;
				}
			} else {
				$pages = $current_query->max_num_pages;
			}
		}
		$allow_html = array(
			"i" => array(
				"class" => array()
			)
		);

		$args = array(
			'base' => get_pagenum_link(1) . '%_%',
			'format' => '/page/%#%',
			'current' => $paged,
			'total' => $pages,
			'end_size'     => $end_size,
			'mid_size'  => $range,
			'prev_text'    => $prev_icon,
			'next_text'    => $next_icon,
		);

		printf('<div class="swe-pagination clearfix">%s</div>', paginate_links($args));
		wp_reset_query();
		// wp_reset_postdata(); 
		// echo "";
		// echo paginate_links();
		// echo "</div>";
	}
}
