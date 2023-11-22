<?php
/**
 * Plugin Name: SW Demo
 * Plugin URI: http://www.smartaddons.com
 * Description: This plugin demo layout WordPress
 * Version: 1.0.0
 * Author: Smartaddons
 * Author URI: http://www.smartaddons.com
 * This plugin demo layout WordPress
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
/* define plugin URL */
if ( ! defined( 'MBURL' ) ) {
	define( 'MBURL', plugins_url(). '/sw_demo' );
}
require_once( plugin_dir_path( __FILE__ ) . '/demo-options.php' );
if( !class_exists( 'Mobile_Detect' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . '/mobile-detect.php' );
}

function sw_placeholder_img_demo_src(){
	return MBURL . '/images/placehold.png' ;
}

add_action( 'template_redirect', 'demo_template_include' );
function demo_template_include(){
	if( isset( $_GET['direction'] ) ){
		 wp_redirect( home_url( '/' ) );
        die;
	}
}

class Sw_demo{
	function __construct(){
		global  $sw_detect;
		add_action( "admin_menu", array( $this, "sw_add_theme_menu_item" ) );
		add_action( "admin_init", array( $this, "sw_display_theme_panel_fields" ) );
		add_action( "admin_enqueue_scripts", array( $this, "sw_demo_script" ) );
		add_action('wp_enqueue_scripts', array( $this, 'sw_scripts_demo' ), 110);		
		add_action( 'admin_init', array( $this  , 'sw_demo_init' ) );
		add_action( 'save_post', array( $this  , 'sw_demo_save_meta' ), 10, 1 );
		add_action( 'wp_footer', array( $this  ,'custom_script' ), 1000 );
	}
	
	function sw_demo_script(){
		wp_enqueue_style( 'demo-option', plugins_url( 'css/admin/style.css', __FILE__ ),array(), null, true );
	}
	
	function sw_scripts_demo(){
		global $sw_detect;
		if( get_option('sw_mdemo') && !( !empty( $sw_detect ) && $sw_detect->isMobile() && !$sw_detect->isTablet() ) ) : 
			wp_enqueue_script('nicescroll', MBURL . '/js/CustomScrollbar.min.js', array('jquery'), null, true);
			wp_enqueue_style('demo_style_mobile', MBURL . '/css/style-mobile.css', array(), null);
		endif;
		wp_enqueue_style('demo_style', MBURL . '/css/style.css', array(), null);
	}
	
	function sw_add_theme_menu_item() {
		add_menu_page(
        esc_html__( "SW Demo", 'sw_demo' ),
				esc_html__( "SW Demo", 'sw_demo' ),
        'manage_options',
        'sw-demo',
				array( $this, "sw_theme_settings_page" ),
        'dashicons-admin-generic',
        1000
    );
		// add_submenu_page( "tools.php", esc_html__( "SW Demo", 'sw_demo' ), esc_html__( "SW Demo", 'sw_demo' ), "manage_options", "sw-demo", array( $this, "sw_theme_settings_page" ) );
	}
	
	function get_value( $option_id ){
		$options = get_option( 'sw_demo' );
		if( $option_id == 'right' ){
			return isset( $options[$option_id] ) ? $options[$option_id] : 0;
		}
		if( in_array( $option_id, array( 'thumbnail_event', 'tf_url', 'mobile_text', 'bt_text', 'support_url', 'guide_url' ) ) ){
			return isset( $options[$option_id] ) ? $options[$option_id] : '';
		}else{
			return isset( $options[$option_id] ) ? $options[$option_id] : array();
		}
	}
	
	function sw_theme_settings_page() {
		$thumb_vals  = $this->get_value( 'thumbnail_id' );
		$large_vals  = $this->get_value( 'imagefull_id' );
		$link_vals 	 = $this->get_value( 'demo_link' );
		$title_vals  = $this->get_value( 'demo_title' );
		$mobile_vals = $this->get_value( 'demo_mobile' );
		$new_vals 	 = $this->get_value( 'demo_new' );
?>
				<div class="setting-demo-panel">
				<h1><?php esc_html_e( 'Theme Panel', 'sw_demo' ) ?></h1>
				<form method="post" action="options.php">
					<div class="setting-demo-bottom">
						<p class="submit"><button type="button" id="setting_more" class="setting_more">Add More</button></p>
						<?php submit_button(); ?>          
					</div>
					<?php settings_fields("section"); ?>
					<div id="setting_demo">
					<div class="setting-wrapper">
						<ul class="clearfix">
							<li class="label"><?php esc_html_e( 'Enable Mobile Layout', 'sw_demo' ) ?></li>
							<li class="setting-content"><input type="checkbox" name="sw_mdemo" value="1" <?php checked(1, get_option('sw_mdemo'), true); ?> /> </li>
						</ul>
					</div>						
					<div class="setting-demo-bottom">
						<?php submit_button(); ?>          
					</div>
				</form>
			</div>
			<script type="text/javascript"> 
				(function($) {
					"use strict";									
					function sw_upload_image( tar_parent ){
						// Only show the "remove image" button when needed
						if ( ! tar_parent.find( '.thumbnail' ).val() ) {
							tar_parent.find( '.remove_image_button' ).hide();
						}

						// Uploading files
						var file_frame;

						tar_parent.find( '.upload_image_button' ).on( 'click', function( event ) {

							event.preventDefault();

							// If the media frame already exists, reopen it.
							if ( file_frame ) {
								file_frame.open();
								return;
							}

							// Create the media frame.
							file_frame = wp.media.frames.downloadable_file = wp.media({
								title: '<?php _e( "Choose an image", 'sw_woocommerce' ); ?>',
								button: {
									text: '<?php _e( "Use image", 'sw_woocommerce' ); ?>'
								},
								multiple: false
							});

							// When an image is selected, run a callback.
							file_frame.on( 'select', function() {
								var attachment = file_frame.state().get( 'selection' ).first().toJSON();
								console.log( attachment );
								tar_parent.find( '.thumbnail' ).val( attachment.id );
								tar_parent.find( '.product-thumbnail > img' ).attr( 'src', attachment.sizes.thumbnail.url );
								tar_parent.find( '.remove_image_button' ).show();
							});

							// Finally, open the modal.
							file_frame.open();
						});

						tar_parent.find( '.remove_image_button' ).on( 'click', function() {
							tar_parent.find( '.product-thumbnail > img' ).attr( 'src', '<?php echo esc_js( sw_placeholder_img_demo_src() ); ?>' );
							tar_parent.find( '.thumbnail' ).val( '' );
							tar_parent.find( '.remove_image_button' ).hide();
							return false;
						});
					}
					$( '.setting-remove' ).on( 'click', function(){
						var target = $(this).data('id');
						$(target).remove();
					});
					$( '.form-upload' ).each( function(){
						sw_upload_image( $(this) );
					});
					$( '.checkbox-mobile' ).each( function(){
						var textbox = $(this).find( 'input[type="hidden"]' );
						$(this).find( 'input[type="checkbox"]' ).on( 'click', function(){
							var value = ( $(this).is(':checked') ) ? 1 : 0;
							 textbox.val( value ); 
						});
					});
				})(jQuery);
			</script>
		<?php
	}

	function sw_display_theme_panel_fields() {
		add_settings_section("section", "SW Demo", null, "theme-options");	
		global $sw_options;
		register_setting( "section", "sw_mdemo" );
		register_setting( "section", "sw_demo_editor" );
		register_setting( "section", "sw_demo_editor_bottom" );
		register_setting( "section", "sw_demo", array() );
	}	
	
	function sw_sanitize(){
		
	}	
	
	function sw_demo_init(){
		add_meta_box( __( 'Config Demo', 'sw_demo' ), __( 'Config Demo', 'sw_demo' ), array( $this, 'demo_detail' ), 'page', 'normal', 'low' );
	}
	function demo_detail(){
		global $post;
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'sw_demo_save_meta', 'sw_sw_demo_plugin_nonce' );
		$page_mobile_enable = get_post_meta( $post->ID, 'page_mobile_enable', true );
		$page_mobile_header = get_post_meta( $post->ID, 'page_mobile_header', true );
		$page_mobile_footer = get_post_meta( $post->ID, 'page_mobile_footer', true ); 
		$page_mobile_qrcode = get_post_meta( $post->ID, 'page_mobile_qrcode', true ); 
		$values = array(
				''  => esc_html__( 'Select Style', 'sw_demo' ),
				'mstyle1'  => esc_html__( 'Style 1', 'sw_demo' ),
				'mstyle2'  => esc_html__( 'Style 2', 'sw_demo' ),
				'mstyle3'  => esc_html__( 'Style 3', 'sw_demo' ),
		);
		$check = ( $page_mobile_enable == 'yes' ) ? 'checked' : '';
	?>	
		<p><label><b><?php esc_html_e('Enable Mobile Layout for this page', 'sw_demo'); ?>:</b></label><br/>
			<input type="checkbox" name="page_mobile_enable" value="yes" <?php echo esc_attr( $check ) ?>/>
		<p>
			<label><b><?php esc_html_e('Select Header Mobile', 'sw_demo'); ?>:</b></label><br/>
			<select id="page_mobile_header"	name="page_mobile_header">
				<?php
				$option ='';
				foreach ($values as $key => $value) :
					$option .= '<option value="' . $key . '" ';
					if ($key == $page_mobile_header){
						$option .= 'selected="selected"';
					}
					$option .=  '>'.$value.'</option>';
				endforeach;
				echo $option;
				?>
			</select>
		</p>
		
		<p>
			<label><b><?php esc_html_e('Select Footer Mobile', 'sw_demo'); ?>:</b></label><br/>
			<select id="page_mobile_footer"	name="page_mobile_footer">
				<?php
				$option ='';
				foreach ($values as $key => $value) :
					$option .= '<option value="' . $key . '" ';
					if ($key == $page_mobile_footer){
						$option .= 'selected="selected"';
					}
					$option .=  '>'.$value.'</option>';
				endforeach;
				echo $option;
				?>
			</select>
		</p>
	<?php 
	}
	function sw_demo_save_meta(){
		global $post;
		if ( ! isset( $_POST['sw_sw_demo_plugin_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( $_POST['sw_sw_demo_plugin_nonce'], 'sw_demo_save_meta' ) ) {
			return;
		}
		$list_meta = array( 'page_mobile_enable', 'page_mobile_header', 'page_mobile_footer', 'page_mobile_qrcode' );
		foreach( $list_meta as $meta ){ 
			if( isset( $_POST[$meta] ) ){
				update_post_meta( $post->ID, $meta, $_POST[$meta] );
			}else{
				delete_post_meta( $post->ID, $meta );
			}
		}
	}
	
	function custom_script(){
		ob_start();
?>
	<script>!function(n){n("#cpanel").collapse(),n("#cpanel-reset").on("click",function(e){if(document.cookie&&""!=document.cookie)for(var l=document.cookie.split(";"),a=0;a<l.length;a++){var i=l[a].split("=");i[0]=i[0].replace(/^ /,""),0===i[0].indexOf(cpanel_name)&&n.cookie(i[0],1,{path:"/",expires:-1})}location.reload()}),n("#cpanel-form").on("submit",function(e){var l=n(this),a=(l.data(),l.serializeArray()),i=l.find("input:checkbox");return n.each(i,function(){if(!n(this).is(":checked")){name=n(this).attr("name"),name=name.replace(/([^\[]*)\[(.*)\]/g,"$1_$2");var e=new Date;e.setTime(e.getTime()+3e4),n.cookie(name,0,{path:"/",expires:e})}}),n.each(a,function(){var e=this.name,l=this.value;0===e.indexOf(cpanel_name+"[")&&(e=e.replace(/([^\[]*)\[(.*)\]/g,"$1_$2"),n.cookie(e,l,{path:"/",expires:7}))}),location.reload(),!1});var e="";n("#lang_sel ul > li > ul li a").on("click",function(){e=n(this).html(),n("#lang_sel ul > li > a.lang_sel_sel").html(e),$a=n.cookie("lang_select_emarket",e,{expires:1,path:"/"})}),n.cookie("lang_select_emarket")&&0<n.cookie("lang_select_emarket").length&&n("#lang_sel ul > li > a.lang_sel_sel").html(n.cookie("lang_select_emarket")),n("#lang_sel ul > li.icl-ar").click(function(){n("#lang_sel ul > li.icl-en").removeClass("active"),n(this).addClass("active"),n.cookie("emarket_lang_en",1,{path:"/",expires:1})}),n("#lang_sel ul > li.icl-en").click(function(){n("#lang_sel ul > li.icl-ar").removeClass("active"),n(this).addClass("active"),n.cookie("emarket_lang_en",0,{path:"/",expires:-1})}),null==n.cookie("emarket_lang_en")?(n("#lang_sel ul > li.icl-en").addClass("active"),n("#lang_sel ul > li.icl-ar").removeClass("active")):(n("#lang_sel ul > li.icl-en").removeClass("active"),n("#lang_sel ul > li.icl-ar").addClass("active")),n(".emarket-logo").on("click",function(){n.cookie("emarket_header_style",null,{path:"/"}),n.cookie("emarket_footer_style",null,{path:"/"})})}(jQuery);</script>
<?php 
		$content = ob_get_clean();
		echo $content;
	}	
}

new Sw_demo();
