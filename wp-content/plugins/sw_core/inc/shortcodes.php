<?php 
/*
** Shortcodes
*/

/**
 * Bloginfo
 * */
function sw_bloginfo( $atts){
	extract( shortcode_atts(array(
			'show' => 'wpurl',
			'filter' => 'raw'
		), $atts)
	);
	$html = '';
	$html .= get_bloginfo($show, $filter);

	return $html;
}
add_shortcode( 'bloginfo', 'sw_bloginfo' );

function colorset($atts){
	$value = swg_options('scheme'); 
	return $value;
}	
add_shortcode( 'colorset', 'colorset' );

/*
* Get URL shortcode
*/
function get_url($atts) {
	if(is_front_page()){
		$frontpage_ID = get_option('page_on_front');
		$link =  get_site_url().'/?page_id='.$frontpage_ID ;
		return $link;
	}
	elseif(is_page()){
		$pageid = get_the_ID();
		$link = get_site_url().'/?page_id='.$pageid ;
		return $link;
	}
	else{
		$link = $_SERVER['REQUEST_URI'];
		return $link;
	}
}
add_shortcode( 'get_url', 'get_url' );

/*
 * Vertical mega menu
 *
 */

function yt_vertical_megamenu_shortcode($atts){
	extract( shortcode_atts( array(
		'menu_locate' =>'',
		'title'  =>'',
		'el_class' => '',
		'menu_item' => 9,
		'more_text' => esc_html__( 'See More', 'sw_core' ),
		'less_text' => esc_html__( 'See Less', 'sw_core' ),
		), $atts ) );
	$output = '<div class="vc_wp_custommenu wp_verticle_bakan wpb_content_element ' . $el_class . '">';
	if($title != ''){
		$output.='<div class="mega-left-title">
		<strong>'.$title.'</strong>
	</div>';
}
$output.='<div class="wrapper_vertical_menu vertical_megamenu"  data-number="' .esc_attr( $menu_item ).'" data-moretext="'.esc_attr( $more_text ).'" data-lesstext="'.esc_attr( $less_text ).'">';
ob_start();
$output .= wp_nav_menu( array( 'theme_location' => $menu_locate , 'menu_class' => 'nav vertical-megamenu' ) );
$output .= ob_get_clean();
$output .= '</div></div>';
return $output;
}
add_shortcode('ya_mega_menu','yt_vertical_megamenu_shortcode');
/*
 * Pricing Table
 * @since v1.0
 *
 */
 
/*
** main
*/
if( !function_exists('pricing_table_shortcode') ) {
	function pricing_table_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'style' => 'style1',
		), $atts ) );
		
	   return '<div class="pricing-table clearfix '.$style.'">' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode( 'pricing_table', 'pricing_table_shortcode' );
}

	
/**
 * Clean up gallery_shortcode()
 *
 * Re-create the [gallery] shortcode and use thumbnails styling from Bootstrap
 *
 * @link http://twitter.github.com/bootstrap/components.html#thumbnails
 */
function ya_gallery($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;
	if( !$post ){
		return;
	}
	if (!empty($attr['ids'])) {
		if (empty($attr['orderby'])) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	$output = apply_filters('post_gallery', '', $attr);

	if ($output != '') {
		return $output;
	}

	if (isset($attr['orderby'])) {
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if (!$attr['orderby']) {
			unset($attr['orderby']);
		}
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => '',
		'icontag'    => '',
		'captiontag' => '',
		'columns'    => 3,
		'size'       => 'medium',
		'include'    => '',
		'exclude'    => ''
		), $attr)
	);

	$id = intval($id);

	if ($order === 'RAND') {
		$orderby = 'none';
	}

	if (!empty($include)) {
		$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

		$attachments = array();
		foreach ($_attachments as $key => $val) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif (!empty($exclude)) {
		$attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
	} else {
		$attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
	}

	if (empty($attachments)) {
		return '';
	}

	if (is_feed()) {
		$output = "\n";
		foreach ($attachments as $att_id => $attachment) {
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		}
		return $output;
	}
	
	if (!wp_style_is('ya_photobox_css')){
		wp_enqueue_style('ya_photobox_css');
	}
	
	if (!wp_enqueue_script('photobox_js')){
		wp_enqueue_script('photobox_js');
	}
	
	$output = '<ul id="photobox-gallery-' . esc_attr( $instance ). '" class="thumbnails photobox-gallery gallery gallery-columns-'.esc_attr( $columns ).'">';

	$i = 0;
	$width = 100/$columns - 1;
	foreach ($attachments as $id => $attachment) {
		//$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
		$link = '<a class="thumbnail" href="' .esc_url( wp_get_attachment_url($id) ) . '">';
		$link .= wp_get_attachment_image($id, 'medium');
		$link .= '</a>';
		
		$output .= '<li style="width: '.esc_attr( $width ).'%;">' . $link;
		$output .= '</li>';
	}

	$output .= '</ul>';
	
	add_action('wp_footer', 'ya_add_script_gallery', 50);
	
	return $output;
}
add_action( 'after_setup_theme', 'ya_setup_gallery', 20 );
function ya_setup_gallery(){
	if ( current_theme_supports('bootstrap-gallery') ) {
		remove_shortcode('gallery');
		add_shortcode('gallery', 'ya_gallery');
	}
}

function ya_add_script_gallery() {
	$script = '';
	$script .= '<script type="text/javascript">
				jQuery(document).ready(function($) {
					try{
						// photobox
						$(".photobox-gallery").each(function(){
							$("#" + this.id).photobox("li a");
							// or with a fancier selector and some settings, and a callback:
							$("#" + this.id).photobox("li:first a", { thumbs:false, time:0 }, imageLoaded);
							function imageLoaded(){
								console.log("image has been loaded...");
							}
						})
					} catch(e){
						console.log( e );
					}
				});
			</script>';
	
	echo $script;
}

/*
 * Shortcode change logo footer 
 *
*/
function sw_change_logo( $atts ){
	extract(shortcode_atts(array(
	'title' => '',
	'colorset' => '',
	'post_status' => 'publish',
	'el_class' => ''
	), $atts));
	if( function_exists( 'SWG_Options' ) ) {
		$sw_logo = swg_options('sitelogo');
		$sw_colorset = swg_options('scheme');
		$site_logo = swg_options('sitelogo');
		$output   ='';
		$output  .='<div class="ya-logo">';
		$output	 .='<a  href="'.esc_url( home_url( '/' ) ).'">';
					if(swg_options('sitelogo')){
		$output	 .='<img src="'.esc_url( $sw_logo ).'" alt="logo"/>';
					}else{
						$logo = get_template_directory_uri().'/assets/img/logo-footer.png';
		$output	 .='<img src="'.esc_url( $logo ).'" alt="logo"/>';
					}
		$output	 .='</a>';
		$output  .='</div>';
		return $output; 
	}
}
add_shortcode('logo_footer','sw_change_logo');