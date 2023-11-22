<?php 
/*
** Require files
*/

require_once( SWPATH . 'inc/options/options.php' );
require_once( SWPATH . 'inc/shortcodes.php' );
require_once( SWPATH . 'inc/maintaince/maintaince-function.php' );
require_once( SWPATH . 'inc/widgets/widgets.php' );
require_once( SWPATH . 'inc/lessphp/less.php' );
require_once( SWPATH . 'inc/metabox.php' );


function swg_options( $opt_name, $default = null ){
	$options = get_option( SWG_THEME );
	if ( !is_admin() &&  isset( $options['show_cpanel'] ) && $options['show_cpanel'] ){
		$cookie_opt_name = SWG_THEME.'_' . $opt_name;
		if ( array_key_exists( $cookie_opt_name, $_COOKIE ) ){
			return $_COOKIE[$cookie_opt_name];
		}
	}
	if( is_array( $options ) ){
		if ( array_key_exists( $opt_name, $options ) ){
			return $options[$opt_name];
		}
	}
	return $default;
}

add_filter( 'SWG_Options_sections_'. SWG_THEME, 'sw_custom_section' );
function sw_custom_section( $sections ){
	$sections[] = array(
		'title' => esc_html__('Maintaincece Mode', 'sw_core'),
		'desc' => wp_kses( __('<p class="description">Enable and config for Maintaincece mode.</p>', 'sw_core'), array( 'p' => array( 'class' => array() ) ) ),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it flashmart for default.
		'icon' => SWG_OPTIONS_URL.'/options/img/glyphicons/glyphicons_136_computer_locked.png',
		//Lets leave this as a flashmart section, no options just some intro text set above.
		'fields' => array(
				array(
					'id' => 'maintaince_enable',
					'title' => esc_html__( 'Enable Maintaincece Mode', 'sw_core' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( 'Turn on/off Maintaince mode on this website', 'sw_core' ),
					'desc' => '',
					'std' => '0'
				),
				
				array(
					'id' => 'maintaince_background',
					'title' => esc_html__( 'Maintaince Background', 'sw_core' ),
					'type' => 'upload',
					'sub_desc' => esc_html__( 'Choose maintance background image', 'sw_core' ),
					'desc' => '',
					'std' => get_template_directory_uri().'/assets/img/maintaince/bg-main.jpg'
				),
				
				array(
					'id' => 'maintaince_content',
					'title' => esc_html__( 'Maintaince Content', 'sw_core' ),
					'type' => 'editor',
					'sub_desc' => esc_html__( 'Change text of maintaince mode', 'sw_core' ),
					'desc' => '',
					'std' => ''
				),
				
				array(
					'id' => 'maintaince_date',
					'title' => esc_html__( 'Maintaince Date', 'sw_core' ),
					'type' => 'date',
					'sub_desc' => esc_html__( 'Put date to this field to show countdown date on maintaince mode.', 'sw_core' ),
					'desc' => '',
					'placeholder' => 'mm/dd/yy',
					'std' => ''
				),
				
				array(
					'id' => 'maintaince_form',
					'title' => esc_html__( 'Maintaince Form', 'sw_core' ),
					'type' => 'text',
					'sub_desc' => esc_html__( 'Put shortcode form to this field and it will be shown on maintaince mode frontend.', 'sw_core' ),
					'desc' => '',
					'std' => ''
				),
				
			)
	);
	return $sections;
}

/*
** Social Link
*/
if( !function_exists( 'swg_social_link' ) ) {
	function swg_social_link(){
		$fb_link = swg_options('social-share-fb');
		$tw_link = swg_options('social-share-tw');
		$tb_link = swg_options('social-share-tumblr');
		$li_link = swg_options('social-share-in');
		$gg_link = swg_options('social-share-go');
		$pt_link = swg_options('social-share-pi');
		$it_link = swg_options('social-share-instagram');

		$html = '';
		if( $fb_link != '' || $tw_link != '' || $tb_link != '' || $li_link != '' || $gg_link != '' || $pt_link != '' ):
		$html .= '<div class="bakan-socials"><ul>';
			if( $fb_link != '' ):
				$html .= '<li><a href="'. esc_url( $fb_link ) .'" title="'. esc_attr__( 'Facebook', 'sw_core' ) .'"><i class="fa fa-facebook"></i></a></li>';
			endif;
			
			if( $tw_link != '' ):
				$html .= '<li><a href="'. esc_url( $tw_link ) .'" title="'. esc_attr__( 'Twitter', 'sw_core' ) .'"><i class="fa fa-twitter"></i></a></li>';
			endif;
			
			if( $tb_link != '' ):
				$html .= '<li><a href="'. esc_url( $tb_link ) .'" title="'. esc_attr__( 'Tumblr', 'sw_core' ) .'"><i class="fa fa-tumblr"></i></a></li>';
			endif;
			
			if( $li_link != '' ):
				$html .= '<li><a href="'. esc_url( $li_link ) .'" title="'. esc_attr__( 'Linkedin', 'sw_core' ) .'"><i class="fa fa-linkedin"></i></a></li>';
			endif;
			
			if( $it_link != '' ):
				$html .= '<li><a href="'. esc_url( $it_link ) .'" title="'. esc_attr__( 'Instagram', 'sw_core' ) .'"><i class="fa fa-instagram"></i></a></li>';
			endif;
			
			if( $gg_link != '' ):
				$html .= '<li><a href="'. esc_url( $gg_link ) .'" title="'. esc_attr__( 'Google+', 'sw_core' ) .'"><i class="fa fa-google-plus"></i></a></li>';
			endif;
			
			if( $pt_link != '' ):
				$html .= '<li><a href="'. esc_url( $pt_link ) .'" title="'. esc_attr__( 'Pinterest', 'sw_core' ) .'"><i class="fa fa-pinterest"></i></a></li>';
			endif;
		$html .= '</ul></div>';
		endif;
		echo wp_kses( $html, array( 'div' => array( 'class' => array() ), 'ul' => array(), 'li' => array(), 'a' => array( 'href' => array(), 'class' => array(), 'title' => array() ), 'i' => array( 'class' => array() ) ) );
	}
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_get_items_count' ) ) {
  function yith_wcwl_get_items_count() {
    ob_start();
    ?>
      <a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>">
        <span class="yith-wcwl-items-count">
          <i class="yith-wcwl-icon icon icon-heart"></i><span class="count-wishlist"><?php echo esc_html( yith_wcwl_count_all_products() ); ?></span>
        </span>
      </a>
    <?php
    return ob_get_clean();
  }

  add_shortcode( 'yith_wcwl_items_count', 'yith_wcwl_get_items_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ) {
  function yith_wcwl_ajax_update_count() {
    wp_send_json( array(
      'count' => yith_wcwl_count_all_products()
    ) );
  }

  add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
  add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_enqueue_custom_script' ) ) {
  function yith_wcwl_enqueue_custom_script() {
    wp_add_inline_script(
      'jquery-yith-wcwl',
      "
        jQuery( function( $ ) {
          $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
            $.get( yith_wcwl_l10n.ajax_url, {
              action: 'yith_wcwl_update_wishlist_count'
            }, function( data ) {
              $('.yith-wcwl-items-count').children('.count-wishlist').html( data.count );
            } );
          } );
        } );
      "
    );
  }

  add_action( 'wp_enqueue_scripts', 'yith_wcwl_enqueue_custom_script', 20 );
}

