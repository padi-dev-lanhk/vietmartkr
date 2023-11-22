<?php 
/*
* get name asset type
*/
if (!function_exists('get_name_filter')) {
	function get_name_filter($slug) {
		switch ($slug) {
			case 'latest':
			return esc_html__('Latest', 'sw-post-elements');
			break;
			case 'rating':
			return esc_html__('Rating', 'sw-post-elements');
			break;
			case 'on_sale':
			return esc_html__('On Sale', 'sw-post-elements');
			break;
			case 'best_selling':
			return esc_html__('Best Selling', 'sw-post-elements');
			break;
			case 'featured':
			return esc_html__('Featured', 'sw-post-elements');
			break;
			default:
			return esc_html__('All', 'sw-post-elements');
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
		?>
		<div class="swe-pagination clearfix">
			<?php echo paginate_links($args); ?>
		</div>
		<?php 
		wp_reset_query();
	}
}

/**
 * SWE Added Cart Fragments
 * @return array custom cart fragments of theme after updateFragments worked.
*/
if (!function_exists('swe_set_post_recently_viewed')) {
	function swe_set_post_recently_viewed($postID) {
		if (get_post_type( $postID ) == 'post' )
			update_post_meta( $postID, '_last_viewed', current_time('mysql') );
	}
}

if ( !function_exists('swe_call_set_post_viewed') ) {
	function swe_call_set_post_viewed($postID) {
		if (!is_single()) {
			return;
		}
		if ( empty($postID) ) {
			global $post;
			$postID = $post->ID;    
		}

		swe_set_post_recently_viewed($postID);
	}
	add_action( 'wp_head', 'swe_call_set_post_viewed');
}

if (!function_exists('swe_get_template_single_post')) {
	function swe_get_template_single_post($file, $settings) {
		$located = '';
		if ($file) {
			$located = WP_PLUGIN_DIR . '/sw-post-elements/src/templates/single-post/' . $file . '.php';
		} else {
			$located = WP_PLUGIN_DIR . '/sw-post-elements/src/templates/single-post/post.php';
		}
		include $located;
	}
}

if (!function_exists('get_first_video_embed')) {
	function get_first_video_embed($post_id) {
		$content = apply_filters('the_content', get_post_field('post_content', $post_id));
		$iframes = get_media_embedded_in_content( $content, 'iframe' );
		return $video_post_iframe = $iframes[0];
	}
}

if (!function_exists('get_first_gallery_embed')) {
	function get_first_gallery_embed($post_id) {
		$content = apply_filters('the_content', get_post_field('post_content', $post_id));
		$figures = get_media_embedded_in_content( $content, 'figure' );
		return $figures;
	}
}

// Set Post views for Popular
if (!function_exists('swe_set_post_views')) {
	function swe_set_post_views($postID) {
		$count_key = 'swe_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
	//To keep the count accurate, lets get rid of prefetching
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
}

if (!function_exists('swe_track_post_views')) {
	function swe_track_post_views ($post_id) {
		if ( !is_single() ) return;
		if ( empty ( $post_id) ) {
			global $post;
			$post_id = $post->ID;    
		}
		swe_set_post_views($post_id);
	}
	add_action( 'wp_head', 'swe_track_post_views');
}

if (!function_exists('swe_get_post_views')) {
	function swe_get_post_views($postID){
		$count_key = 'swe_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0 View";
		}
		return $count.' Views';
	}
}

// Get all tags
if (!function_exists('swe_get_all_tags')) {
	function swe_get_all_tags() {
		$tags = get_tags();
		$listTag = '';
		foreach ($tags as $tag) { 
			$listTag .= $tag->name . ',';
		}
		return $listTag;
	}
}
