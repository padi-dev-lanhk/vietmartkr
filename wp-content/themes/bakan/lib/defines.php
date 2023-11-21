<?php
$lib_dir = trailingslashit( str_replace( '\\', '/', get_template_directory() . '/lib/' ) );

if( !defined('BAKAN_DIR') ){
	define( 'BAKAN_DIR', $lib_dir );
}

if( !defined('BAKAN_URL') ){
	define( 'BAKAN_URL', trailingslashit( get_template_directory_uri() ) . 'lib' );
}

if (!isset($content_width)) { $content_width = 940; }

define("BAKAN_PRODUCT_TYPE","product");
define("BAKAN_PRODUCT_DETAIL_TYPE","product_detail");

if ( !defined('SWG_THEME') ){
	define( 'SWG_THEME', 'bakan_theme' );
}

require_once( get_template_directory().'/lib/options.php' );

if( class_exists( 'SWG_Options' ) ) :
	function bakan_Options_Setup(){
		global $swg_options, $options, $options_args;

		$options = array();
		$options[] = array(
			'title' => esc_html__('General', 'bakan'),
			'desc' => wp_kses( __('<p class="description">The theme allows to build your own styles right out of the backend without any coding knowledge. Upload new logo and favicon or get their URL.</p>', 'bakan'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bakan for default.
			'icon' => BAKAN_URL.'/admin/img/glyphicons/glyphicons_019_cogwheel.png',
			//Lets leave this as a bakan section, no options just some intro text set above.
			'fields' => array(	

				array(
					'id' => 'sitelogo',
					'type' => 'upload',
					'title' => esc_html__('Logo Image', 'bakan'),
					'sub_desc' => esc_html__( 'Use the Upload button to upload the new logo and get URL of the logo', 'bakan' ),
					'std' => get_template_directory_uri().'/assets/img/logo-default.png'
				),

				array(
					'id' => 'favicon',
					'type' => 'upload',
					'title' => esc_html__('Favicon', 'bakan'),
					'sub_desc' => esc_html__( 'Use the Upload button to upload the custom favicon', 'bakan' ),
					'std' => ''
				),

				array(
					'id' => 'tax_select',
					'type' => 'multi_select_taxonomy',
					'title' => esc_html__('Select Taxonomy', 'bakan'),
					'sub_desc' => esc_html__( 'Select taxonomy to show custom term metabox', 'bakan' ),
				),

				array(
					'id' => 'title_length',
					'type' => 'text',
					'title' => esc_html__('Title Length Of Item Listing Page', 'bakan'),
					'sub_desc' => esc_html__( 'Choose title length if you want to trim word, leave 0 to not trim word', 'bakan' ),
					'std' => 0
				),

				array(
					'id' => 'page_404',
					'type' => 'pages_select',
					'title' => esc_html__('404 Page Content', 'bakan'),
					'sub_desc' => esc_html__('Select page 404 content', 'bakan'),
					'std' => ''
				),
			)		
		);

		$options[] = array(
			'title' => esc_html__('Schemes', 'bakan'),
			'desc' => wp_kses( __('<p class="description">Custom color scheme for theme. Unlimited color that you can choose.</p>', 'bakan'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bakan for default.
			'icon' => BAKAN_URL.'/admin/img/glyphicons/glyphicons_163_iphone.png',
			//Lets leave this as a bakan section, no options just some intro text set above.
			'fields' => array(
				array(
					'id' => 'scheme',
					'type' => 'radio_img',
					'title' => esc_html__('Color Scheme', 'bakan'),
					'sub_desc' => esc_html__( 'Select one of 2 predefined schemes', 'bakan' ),
					'desc' => '',
					'options' => array(
						'default' => array('title' => 'Default', 'img' => get_template_directory_uri().'/assets/img/default.png'),
						), //Must provide key => value(array:title|img) pairs for radio options
					'std' => 'default'
				),
				
				array(
					'id' => 'custom_color',
					'title' => esc_html__( 'Enable Custom Color', 'bakan' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( 'Check this field to enable custom color and when you update your theme, custom color will not lose.', 'bakan' ),
					'desc' => '',
					'std' => '0'
				),
				
				array(
					'id' => 'scheme_color',
					'type' => 'color',
					'title' => esc_html__('Color', 'bakan'),
					'sub_desc' => esc_html__('Select main custom color.', 'bakan'),
					'std' => ''
				),

			)
		);

		$options[] = array(
			'title' => esc_html__('Layout', 'bakan'),
			'desc' => wp_kses( __('<p class="description">WpThemeGo Framework comes with a layout setting that allows you to build any number of stunning layouts and apply theme to your entries.</p>', 'bakan'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bakan for default.
			'icon' => BAKAN_URL.'/admin/img/glyphicons/glyphicons_319_sort.png',
			//Lets leave this as a bakan section, no options just some intro text set above.
			'fields' => array(
				array(
					'id' => 'layout',
					'type' => 'select',
					'title' => esc_html__('Box Layout', 'bakan'),
					'sub_desc' => esc_html__( 'Select Layout Box or Wide, Sidebar', 'bakan' ),
					'options' => array(
						'full' => esc_html__( 'Wide', 'bakan' ),
						'wide' => esc_html__( 'Wide 1400', 'bakan' ),
						'boxed' => esc_html__( 'Boxed', 'bakan' ),
					),
					'std' => 'full'
				),
				
				array(
					'id' => 'layout_width',
					'type' => 'number',
					'title' => esc_html__('Layout Width', 'bakan'),
					'sub_desc' => esc_html__( 'Select Layout width content', 'bakan' ),				
					'std' => 1170
				),
				
				array(
					'id' => 'bg_box_img',
					'type' => 'upload',
					'title' => esc_html__('Background Box Image', 'bakan'),
					'sub_desc' => '',
					'std' => ''
				),
				array(
					'id' => 'sidebar_left_expand',
					'type' => 'select',
					'title' => esc_html__('Left Sidebar Expand', 'bakan'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12', 
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '3',
					'sub_desc' => esc_html__( 'Select width of left sidebar.', 'bakan' ),
				),

				array(
					'id' => 'sidebar_right_expand',
					'type' => 'select',
					'title' => esc_html__('Right Sidebar Expand', 'bakan'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12',
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '3',
					'sub_desc' => esc_html__( 'Select width of right sidebar medium desktop.', 'bakan' ),
				),
				array(
					'id' => 'sidebar_left_expand_md',
					'type' => 'select',
					'title' => esc_html__('Left Sidebar Medium Desktop Expand', 'bakan'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12',
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '4',
					'sub_desc' => esc_html__( 'Select width of left sidebar medium desktop.', 'bakan' ),
				),
				array(
					'id' => 'sidebar_right_expand_md',
					'type' => 'select',
					'title' => esc_html__('Right Sidebar Medium Desktop Expand', 'bakan'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12',
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '4',
					'sub_desc' => esc_html__( 'Select width of right sidebar.', 'bakan' ),
				),
				array(
					'id' => 'sidebar_left_expand_sm',
					'type' => 'select',
					'title' => esc_html__('Left Sidebar Tablet Expand', 'bakan'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12',
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '4',
					'sub_desc' => esc_html__( 'Select width of left sidebar tablet.', 'bakan' ),
				),
				array(
					'id' => 'sidebar_right_expand_sm',
					'type' => 'select',
					'title' => esc_html__('Right Sidebar Tablet Expand', 'bakan'),
					'options' => array(
						'2' => '2/12',
						'3' => '3/12',
						'4' => '4/12',
						'5' => '5/12',
						'6' => '6/12',
						'7' => '7/12',
						'8' => '8/12',
						'9' => '9/12',
						'10' => '10/12',
						'11' => '11/12',
						'12' => '12/12'
					),
					'std' => '4',
					'sub_desc' => esc_html__( 'Select width of right sidebar tablet.', 'bakan' ),
				),				
			)
		);
/*
$options[] = array(
	'title' => esc_html__('Mobile Layout', 'bakan'),
	'desc' => wp_kses( __('<p class="description">WpThemeGo Framework comes with a mobile setting home page layout.</p>', 'bakan'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bakan for default.
	'icon' => BAKAN_URL.'/admin/img/glyphicons/glyphicons_163_iphone.png',
			//Lets leave this as a bakan section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'mobile_enable',
			'type' => 'checkbox',
			'title' => esc_html__('Enable Mobile Layout', 'bakan'),
			'sub_desc' => '',
			'desc' => '',
							'std' => '1'// 1 = on | 0 = off
						),

		array(
			'id' => 'mobile_logo',
			'type' => 'upload',
			'title' => esc_html__('Logo Mobile Image', 'bakan'),
			'sub_desc' => esc_html__( 'Use the Upload button to upload the new mobile logo', 'bakan' ),
			'std' => get_template_directory_uri().'/assets/img/logo-mobile.png'
		),

		array(
			'id' => 'mobile_logo_account',
			'type' => 'upload',
			'title' => esc_html__('Logo Mobile My Account Page', 'bakan'),
			'sub_desc' => esc_html__( 'Use the Upload button to upload the new mobile logo in my account page', 'bakan' ),
			'std' => get_template_directory_uri().'/assets/img/icon-myaccount.png'
		),

		array(
			'id' => 'sticky_mobile',
			'type' => 'checkbox',
			'title' => esc_html__('Sticky Mobile', 'bakan'),
			'sub_desc' => '',
			'desc' => '',
							'std' => '0'// 1 = on | 0 = off
						),

		array(
			'id' => 'mobile_content',
			'type' => 'pages_select',
			'title' => esc_html__('Mobile Layout Content', 'bakan'),
			'sub_desc' => esc_html__('Select content index for this mobile layout', 'bakan'),
			'std' => ''
		),

		array(
			'id' => 'mobile_header_style',
			'type' => 'select',
			'title' => esc_html__('Header Mobile Style', 'bakan'),
			'sub_desc' => esc_html__('Select header mobile style', 'bakan'),
			'options' => array(
				'mstyle1'  => esc_html__( 'Style 1', 'bakan' ),
			),
			'std' => 'style1'
		),

		array(
			'id' => 'mobile_footer_style',
			'type' => 'select',
			'title' => esc_html__('Footer Mobile Style', 'bakan'),
			'sub_desc' => esc_html__('Select footer mobile style', 'bakan'),
			'options' => array(
				'mstyle1'  => esc_html__( 'Style 1', 'bakan' ),
			),
			'std' => 'style1'
		),

		array(
			'id' => 'mobile_addcart',
			'type' => 'checkbox',
			'title' => esc_html__('Enable Add To Cart Button', 'bakan'),
			'sub_desc' => esc_html__( 'Enable Add To Cart Button on product listing', 'bakan' ),
			'desc' => '',
						'std' => '0'// 1 = on | 0 = off
					),

		array(
			'id' => 'mobile_header_inside',
			'type' => 'checkbox',
			'title' => esc_html__('Enable Header Other Pages', 'bakan'),
			'sub_desc' => esc_html__( 'Enable header in other pages which are different with homepage', 'bakan' ),
			'desc' => '',
						'std' => '0'// 1 = on | 0 = off
					),

		array(
			'id' => 'mobile_jquery',
			'type' => 'checkbox',
			'title' => esc_html__('Include Jquery Revolution', 'bakan'),
			'sub_desc' => esc_html__( 'Enable jquery revolution slider on mobile layout.', 'bakan' ),
			'desc' => '',
						'std' => '0'// 1 = on | 0 = off
					),
	)
);
*/
$options[] = array(
	'title' => esc_html__('Header', 'bakan'),
	'desc' => wp_kses( __('<p class="description">WpThemeGo Framework comes with a header and footer setting that allows you to build style header.</p>', 'bakan'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bakan for default.
	'icon' => BAKAN_URL.'/admin/img/glyphicons/glyphicons_336_read_it_later.png',
			//Lets leave this as a bakan section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'header_style',
			'type' => 'select',
			'title' => esc_html__('Header Style', 'bakan'),
			'sub_desc' => esc_html__('Select Header style', 'bakan'),
			'options' => array(
				'style1'  => esc_html__( 'Header Style 1', 'bakan' ),
			),
			'std' => 'style1'
		),

		array(
			'id' => 'disable_search',
			'title' => esc_html__( 'Disable Search', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Check this to disable search on header', 'bakan' ),
			'desc' => '',
			'std' => '0'
		),

		array(
			'id' => 'disable_cart',
			'title' => esc_html__( 'Disable Cart', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Check this to disable cart on header', 'bakan' ),
			'desc' => '',
			'std' => '0'
		),

		array(
			'id' => 'disable_boxsidebar',
			'title' => esc_html__( 'Disable Box Sdebar On Pages', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Check this to disable box sidebar on pages', 'bakan' ),
			'desc' => '',
			'std' => '0'
		),

	)
);
$options[] = array(
	'title' => esc_html__('Navbar Options', 'bakan'),
	'desc' => wp_kses( __('<p class="description">If you got a big site with a lot of sub menus we recommend using a mega menu. Just select the dropbox to display a menu as mega menu or dropdown menu.</p>', 'bakan'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bakan for default.
	'icon' => BAKAN_URL.'/admin/img/glyphicons/glyphicons_157_show_lines.png',
			//Lets leave this as a bakan section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'info_typon1',
			'type' => 'info',
			'title' => esc_html__( 'Navbar Menu General Config', 'bakan' ),
			'desc' => '',
			'class' => 'bakan-opt-info'
		),

		array(
			'id' => 'menu_type',
			'type' => 'select',
			'title' => esc_html__('Menu Type', 'bakan'),
			'options' => array( 
				'dropdown' => esc_html__( 'Dropdown Menu', 'bakan' ), 
				'mega' => esc_html__( 'Mega Menu', 'bakan' ) 
			),
			'std' => 'mega'
		),	

		array(
			'id' => 'menu_location',
			'type' => 'menu_location_multi_select',
			'title' => esc_html__('Mega Menu Location', 'bakan'),
			'sub_desc' => esc_html__( 'Select theme location to active mega menu.', 'bakan' ),
			'std' => 'primary_menu'
		),		

		array(
			'id' => 'more_menu',
			'type' => 'checkbox',
			'title' => esc_html__('Active More Menu', 'bakan'),
			'sub_desc' => esc_html__('Active more menu if your primary menu is too long', 'bakan'),
			'desc' => '',
						'std' => '0'// 1 = on | 0 = off
					),

		array(
			'id' => 'menu_event',
			'type' => 'select',
			'title' => esc_html__('Menu Event', 'bakan'),
			'options' => array( 
				'' 		=> esc_html__( 'Hover Event', 'bakan' ), 
				'click' => esc_html__( 'Click Event', 'bakan' ) 
			),
			'std' => ''
		),

		array(
			'id' => 'menu_number_item',
			'type' => 'text',
			'title' => esc_html__( 'Number Item Vertical', 'bakan' ),
			'sub_desc' => esc_html__( 'Number item vertical to show', 'bakan' ),
			'std' => 8
		),	

		array(
			'id' => 'menu_title_text',
			'type' => 'text',
			'title' => esc_html__('Vertical Title Text', 'bakan'),
			'sub_desc' => esc_html__( 'Change title text on vertical menu', 'bakan' ),
			'std' => ''
		),

		array(
			'id' => 'menu_more_text',
			'type' => 'text',
			'title' => esc_html__('Vertical More Text', 'bakan'),
			'sub_desc' => esc_html__( 'Change more text on vertical menu', 'bakan' ),
			'std' => ''
		),
		
		array(
			'id' => 'menu_less_text',
			'type' => 'text',
			'title' => esc_html__('Vertical Less Text', 'bakan'),
			'sub_desc' => esc_html__( 'Change less text on vertical menu', 'bakan' ),
			'std' => ''
		),

		array(
			'id' => 'info_typon2',
			'type' => 'info',
			'title' => esc_html__( 'Responsive Menu Config', 'bakan' ),
			'desc' => '',
			'class' => 'bakan-opt-info'
		),

		array(
			'id' => 'mobile_menu',
			'type' => 'menu_location_multi_select',
			'title' => esc_html__('Mobile & Responsive Menu Location', 'bakan'),
			'sub_desc' => esc_html__( 'Select theme location to active mobile menu.', 'bakan' ),
			'std' => 'primary_menu'
		),

		array(
			'id' => 'mobile_menu_title',
			'type' => 'text',
			'title' => esc_html__('Mobile Menu Title', 'bakan'),
			'sub_desc' => esc_html__( 'Change title heading of menu responsive. If there are many menu, each title separated by commas.', 'bakan' ),
			'std' => ''
		),

	)
);
$options[] = array(
	'title' => esc_html__('Blog Options', 'bakan'),
	'desc' => wp_kses( __('<p class="description">Select layout in blog listing page.</p>', 'bakan'), array( 'p' => array( 'class' => array() ) ) ),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it bakan for default.
	'icon' => BAKAN_URL.'/admin/img/glyphicons/glyphicons_071_book.png',
		//Lets leave this as a bakan section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'sidebar_blog',
			'type' => 'select',
			'title' => esc_html__('Sidebar Blog Layout', 'bakan'),
			'options' => array(
				'full' 	=> esc_html__( 'Full Layout', 'bakan' ),		
				'left'	=> esc_html__( 'Left Sidebar', 'bakan' ),
				'right' => esc_html__( 'Right Sidebar', 'bakan' ),
			),
			'std' => 'left',
			'sub_desc' => esc_html__( 'Select style sidebar blog', 'bakan' ),
		),
		array(
			'id' => 'blog_layout',
			'type' => 'select',
			'title' => esc_html__('Layout blog', 'bakan'),
			'options' => array(
				'list'	=>  esc_html__( 'List Layout', 'bakan' ),
				'list2'	=>  esc_html__( 'List Layout2', 'bakan' ),
				'grid' 	=>  esc_html__( 'Grid Layout', 'bakan' )								
			),
			'std' => 'list',
			'sub_desc' => esc_html__( 'Select style layout blog', 'bakan' ),
		),
		array(
			'id' => 'blog_column',
			'type' => 'select',
			'title' => esc_html__('Blog column', 'bakan'),
			'options' => array(								
				'2' =>  esc_html__( '2 Columns', 'bakan' ),
				'3' =>  esc_html__( '3 Columns', 'bakan' ),
				'4' =>  esc_html__( '4 Columns', 'bakan' )								
			),
			'std' => '2',
			'sub_desc' => esc_html__( 'Select style number column blog', 'bakan' ),
		),
	)
);	
$options[] = array(
	'title' => esc_html__('Product Options', 'bakan'),
	'desc' => wp_kses( __('<p class="description">Select layout in product listing page.</p>', 'bakan'), array( 'p' => array( 'class' => array() ) ) ),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it bakan for default.
	'icon' => BAKAN_URL.'/admin/img/glyphicons/glyphicons_202_shopping_cart.png',
		//Lets leave this as a bakan section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'info_typo1',
			'type' => 'info',
			'title' => esc_html__( 'Product Categories Config', 'bakan' ),
			'desc' => '',
			'class' => 'bakan-opt-info'
		),

		array(
			'id' => 'product_colcat_large',
			'type' => 'select',
			'title' => esc_html__('Product Category Listing column Desktop', 'bakan'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',							
			),
			'std' => '4',
			'sub_desc' => esc_html__( 'Select number of column on Desktop Screen', 'bakan' ),
		),

		array(
			'id' => 'product_colcat_medium',
			'type' => 'select',
			'title' => esc_html__('Product Listing Category column Medium Desktop', 'bakan'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',	
				'5' => '5',
				'6' => '6',
			),
			'std' => '3',
			'sub_desc' => esc_html__( 'Select number of column on Medium Desktop Screen', 'bakan' ),
		),

		array(
			'id' => 'product_colcat_sm',
			'type' => 'select',
			'title' => esc_html__('Product Listing Category column Tablet', 'bakan'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',	
				'5' => '5',
				'6' => '6'
			),
			'std' => '2',
			'sub_desc' => esc_html__( 'Select number of column on Tablet Screen', 'bakan' ),
		),

		array(
			'id' => 'info_typo1',
			'type' => 'info',
			'title' => esc_html__( 'Product General Config', 'bakan' ),
			'desc' => '',
			'class' => 'bakan-opt-info'
		),

		array(
			'id' => 'product_loadmore',
			'title' => esc_html__( 'Enable load more product listing', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off load more in product listing', 'bakan' ),
			'std' => '1'
			),
			
		array(
			'id' => 'product_loadmore_style',
			'title' => esc_html__( 'Select style load more ajax', 'bakan' ),
			'type' => 'select',
			'options' => array(
				'0' => esc_html__( 'Click', 'bakan' ),
				'1' => esc_html__( 'Scroll', 'bakan' )					
				),
			'std' => '0',
			'sub_desc' => esc_html__( 'Select style for ajax load more in product listing', 'bakan' ),
			),
		
		array(
			'id' => 'layout_product',
			'title' => esc_html__( 'Select Layout List/Grid For Product Listing', 'bakan' ),
			'type' => 'select',
			'sub_desc' => '',
			'options' => array(
				'' 			=> esc_html__( 'Default', 'bakan' ),
				'list' 	=> esc_html__( 'Layout List', 'bakan' ),
				'grid' 	=> esc_html__( 'Layout Grid', 'bakan' ),
				),
			'std' => '',
			),
		
		array(
			'id' => 'product_categories',
			'title' => esc_html__( 'Shop Categories', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off shop categories breadcumb', 'bakan' ),
			'std' => '1'
		),

		array(
			'id' => 'product_banner',
			'title' => esc_html__( 'Select Banner', 'bakan' ),
			'type' => 'select',
			'sub_desc' => '',
			'options' => array(
				'' 			=> esc_html__( 'Use Banner', 'bakan' ),
				'listing' 	=> esc_html__( 'Use Category Product Image', 'bakan' ),
			),
			'std' => '',
		),

		array(
			'id' => 'product_listing_banner',
			'type' => 'upload',
			'title' => esc_html__('Listing Banner Product', 'bakan'),
			'sub_desc' => esc_html__( 'Use the Upload button to upload banner product listing', 'bakan' ),
			'std' => get_template_directory_uri().'/assets/img/listing-banner.jpg'
		),

		array(
				'id' => 'link_banner_shop',
				'type' => 'text',
				'title' => esc_html__('Link Of Banner Product', 'bakan'),
				'sub_desc' => esc_html__( 'Use the link for the banner product listing', 'bakan' ),
				'std' => '',
				),
		
		array(
			'id' => 'product_col_large',
			'type' => 'select',
			'title' => esc_html__('Product Listing column Desktop', 'bakan'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',							
			),
			'std' => '3',
			'sub_desc' => esc_html__( 'Select number of column on Desktop Screen', 'bakan' ),
		),

		array(
			'id' => 'product_col_medium',
			'type' => 'select',
			'title' => esc_html__('Product Listing column Medium Desktop', 'bakan'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',	
				'5' => '5',
				'6' => '6',
			),
			'std' => '2',
			'sub_desc' => esc_html__( 'Select number of column on Medium Desktop Screen', 'bakan' ),
		),

		array(
			'id' => 'product_col_sm',
			'type' => 'select',
			'title' => esc_html__('Product Listing column Tablet', 'bakan'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',	
				'5' => '5',
				'6' => '6'
			),
			'std' => '2',
			'sub_desc' => esc_html__( 'Select number of column on Tablet Screen', 'bakan' ),
		),

		array(
			'id' => 'sidebar_product',
			'type' => 'select',
			'title' => esc_html__('Sidebar Product Layout', 'bakan'),
			'options' => array(
				''		=> esc_html__( 'Select Layout', 'bakan' ),
				'left'	=> esc_html__( 'Left Sidebar', 'bakan' ),
				'full' 	=> esc_html__( 'Full Layout', 'bakan' ),		
				'right' => esc_html__( 'Right Sidebar', 'bakan' )
			),
			'std' => 'left',
			'sub_desc' => esc_html__( 'Select style sidebar product', 'bakan' ),
		),

		array(
			'id' => 'product_quickview',
			'title' => esc_html__( 'Quickview', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off Product Quickview', 'bakan' ),
			'std' => '1'
		),

		array(
			'id' => 'product_listing_countdown',
			'title' => esc_html__( 'Enable Countdown', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off Product Countdown on product listing', 'bakan' ),
			'std' => '1'
		),

		array(
			'id' => 'product_soldout',
			'title' => esc_html__( 'Product Sold Out', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off product sold out label', 'bakan' ),
			'std' => '1'
		),


		array(
			'id' => 'product_number',
			'type' => 'text',
			'title' => esc_html__('Product Listing Number', 'bakan'),
			'sub_desc' => esc_html__( 'Show number of product in listing product page.', 'bakan' ),
			'std' => 12
		),

		array(
			'id' => 'newproduct_time',
			'title' => esc_html__( 'New Product', 'bakan' ),
			'type' => 'number',
			'sub_desc' => '',
			'desc' => esc_html__( 'Set day for the new product label from the date publish product.', 'bakan' ),
			'std' => '1'
		),

		array(
			'id' => 'info_typo1',
			'type' => 'info',
			'title' => esc_html__( 'Product Single Config', 'bakan' ),
			'desc' => '',
			'class' => 'bakan-opt-info'
		),

		array(
			'id' => 'sidebar_product_detail',
			'type' => 'select',
			'title' => esc_html__('Sidebar Product Single Layout', 'bakan'),
			'options' => array(
				'left'	=> esc_html__( 'Left Sidebar', 'bakan' ),
				'full' 	=> esc_html__( 'Full Layout', 'bakan' ),		
				'right' => esc_html__( 'Right Sidebar', 'bakan' )
			),
			'std' => 'left',
			'sub_desc' => esc_html__( 'Select style sidebar product single', 'bakan' ),
		),

		array(
			'id' => 'sticky_sidebar',
			'type' => 'checkbox',
			'title' => esc_html__('Active sticky Sidebar', 'bakan'),
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off product sticky sidebar', 'bakan' ),
			'std' => '0'// 1 = on | 0 = off
			),

		array(
			'id' => 'product_single_thumbnail',
			'type' => 'select',
			'title' => esc_html__('Product Thumbnail Position', 'bakan'),
			'options' => array(
				'bottom'	=> esc_html__( 'Bottom', 'bakan' ),
				'left' 		=> esc_html__( 'Left', 'bakan' ),	
				'right' 	=> esc_html__( 'Right', 'bakan' ),	
				'top' 		=> esc_html__( 'Top', 'bakan' ),					
			),
			'std' => 'bottom',
			'sub_desc' => esc_html__( 'Select style for product single thumbnail', 'bakan' ),
		),		


		array(
			'id' => 'product_zoom',
			'title' => esc_html__( 'Product Zoom', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off image zoom when hover on single product', 'bakan' ),
			'std' => '1'
		),

		array(
			'id' => 'product_brand',
			'title' => esc_html__( 'Enable Product Brand Image', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off product brand image show on single product.', 'bakan' ),
			'std' => '1'
		),

		array(
			'id' => 'product_single_countdown',
			'title' => esc_html__( 'Enable Countdown Single', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off Product Countdown on product single', 'bakan' ),
			'std' => '1'
		),

		array(
			'id' => 'product_single_buynow',
			'title' => esc_html__( 'Enable Buy Now Button', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => esc_html__( 'Turn On/Off buy now button on product single and quickview', 'bakan' ),
			'std' => '1'
		),
		
		array(
			'id' => 'info_typo1',
			'type' => 'info',
			'title' => esc_html__( 'Config For Product Categories Widget', 'bakan' ),
			'desc' => '',
			'class' => 'bakan-opt-info'
		),
		
		array(
			'id' => 'product_categories_accordion',
			'title' => esc_html__( 'Enable accordion for widget categories', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => '',
			'desc' => '',
			'std' => '1'
		),
				
		array(
			'id' => 'product_number_item',
			'type' => 'text',
			'title' => esc_html__( 'Category Number Item Show', 'bakan' ),
			'sub_desc' => esc_html__( 'Choose to number of item category that you want to show, leave 0 to show all category', 'bakan' ),
			'std' => 8
		),	

		array(
			'id' => 'product_more_text',
			'type' => 'text',
			'title' => esc_html__( 'Category More Text', 'bakan' ),
			'sub_desc' => esc_html__( 'Change more text on category product', 'bakan' ),
			'std' => ''
		),

		array(
			'id' => 'product_less_text',
			'type' => 'text',
			'title' => esc_html__( 'Category Less Text', 'bakan' ),
			'sub_desc' => esc_html__( 'Change less text on category product', 'bakan' ),
			'std' => ''
		)	
	)
);		
$options[] = array(
	'title' => esc_html__('Typography', 'bakan'),
	'desc' => wp_kses( __('<p class="description">Change the font style of your blog, custom with Google Font.</p>', 'bakan'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bakan for default.
	'icon' => BAKAN_URL.'/admin/img/glyphicons/glyphicons_151_edit.png',
			//Lets leave this as a bakan section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'info_typo1',
			'type' => 'info',
			'title' => esc_html__( 'Global Typography', 'bakan' ),
			'desc' => '',
			'class' => 'bakan-opt-info'
		),

		array(
			'id' => 'google_webfonts',
			'type' => 'google_webfonts',
			'title' => esc_html__('Use Google Webfont', 'bakan'),
			'sub_desc' => esc_html__( 'Insert font style that you actually need on your webpage.', 'bakan' ), 
			'std' => ''
		),

		array(
			'id' => 'webfonts_weight',
			'type' => 'multi_select',
			'sub_desc' => esc_html__( 'For weight, see Google Fonts to custom for each font style.', 'bakan' ),
			'title' => esc_html__('Webfont Weight', 'bakan'),
			'options' => array(
				'100' => '100',
				'200' => '200',
				'300' => '300',
				'400' => '400',
				'500' => '500',
				'600' => '600',
				'700' => '700',
				'800' => '800',
				'900' => '900'
			),
			'std' => ''
		),

		array(
			'id' => 'info_typo2',
			'type' => 'info',
			'title' => esc_html__( 'Header Tag Typography', 'bakan' ),
			'desc' => '',
			'class' => 'bakan-opt-info'
		),

		array(
			'id' => 'header_tag_font',
			'type' => 'google_webfonts',
			'title' => esc_html__('Header Tag Font', 'bakan'),
			'sub_desc' => esc_html__( 'Select custom font for header tag ( h1...h6 )', 'bakan' ), 
			'std' => ''
		),

		array(
			'id' => 'info_typo2',
			'type' => 'info',
			'title' => esc_html__( 'Main Menu Typography', 'bakan' ),
			'desc' => '',
			'class' => 'bakan-opt-info'
		),

		array(
			'id' => 'menu_font',
			'type' => 'google_webfonts',
			'title' => esc_html__('Main Menu Font', 'bakan'),
			'sub_desc' => esc_html__( 'Select custom font for main menu', 'bakan' ), 
			'std' => ''
		),

		array(
			'id' => 'info_typo2',
			'type' => 'info',
			'title' => esc_html__( 'Custom Typography', 'bakan' ),
			'desc' => '',
			'class' => 'bakan-opt-info'
		),

		array(
			'id' => 'custom_font',
			'type' => 'google_webfonts',
			'title' => esc_html__('Custom Font', 'bakan'),
			'sub_desc' => esc_html__( 'Select custom font for custom class', 'bakan' ), 
			'std' => ''
		),

		array(
			'id' => 'custom_font_class',
			'title' => esc_html__( 'Custom Font Class', 'bakan' ),
			'type' => 'text',
			'sub_desc' => esc_html__( 'Put custom class to this field. Each class separated by commas.', 'bakan' ),
			'desc' => '',
			'std' => '',
		),

	)
);

$options[] = array(
	'title' => __('Social', 'bakan'),
	'desc' => wp_kses( __('<p class="description">This feature allow to you link to your social.</p>', 'bakan'), array( 'p' => array( 'class' => array() ) ) ),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
	'icon' => BAKAN_URL.'/admin/img/glyphicons/glyphicons_222_share.png',
		//Lets leave this as a blank section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'social-share-fb',
			'title' => esc_html__( 'Facebook', 'bakan' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		),
		array(
			'id' => 'social-share-tw',
			'title' => esc_html__( 'Twitter', 'bakan' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		),
		array(
			'id' => 'social-share-tumblr',
			'title' => esc_html__( 'Tumblr', 'bakan' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		),
		array(
			'id' => 'social-share-in',
			'title' => esc_html__( 'Linkedin', 'bakan' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		),
		array(
			'id' => 'social-share-instagram',
			'title' => esc_html__( 'Instagram', 'bakan' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		),
		array(
			'id' => 'social-share-pi',
			'title' => esc_html__( 'Pinterest', 'bakan' ),
			'type' => 'text',
			'sub_desc' => '',
			'desc' => '',
			'std' => '',
		)

	)
);

$options[] = array(
	'title' => esc_html__('Advanced', 'bakan'),
	'desc' => wp_kses( __('<p class="description">Custom advanced with Cpanel, Widget advanced, Developer mode </p>', 'bakan'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it bakan for default.
	'icon' => BAKAN_URL.'/admin/img/glyphicons/glyphicons_083_random.png',
			//Lets leave this as a bakan section, no options just some intro text set above.
	'fields' => array(
		array(
			'id' => 'show_cpanel',
			'title' => esc_html__( 'Show cPanel', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Turn on/off Cpanel', 'bakan' ),
			'desc' => '',
			'std' => ''
		),

		array(
			'id' => 'widget-advanced',
			'title' => esc_html__('Widget Advanced', 'bakan'),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Turn on/off Widget Advanced', 'bakan' ),
			'desc' => '',
			'std' => '1'
		),					

		array(
			'id' => 'social_share',
			'title' => esc_html__( 'Social Share', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Turn on/off social share', 'bakan' ),
			'desc' => '',
			'std' => '1'
		),

		array(
			'id' => 'breadcrumb_active',
			'title' => esc_html__( 'Turn Off Breadcrumb', 'bakan' ),
			'type' => 'checkbox',
			'sub_desc' => esc_html__( 'Turn off breadcumb on all page', 'bakan' ),
			'desc' => '',
			'std' => '0'
		),

		array(
			'id' => 'back_active',
			'type' => 'checkbox',
			'title' => esc_html__('Back to top', 'bakan'),
			'sub_desc' => '',
			'desc' => '',
						'std' => '1'// 1 = on | 0 = off
			),	
		array(
		'id' => 'direction',
		'type' => 'select',
		'title' => esc_html__('Direction', 'bakan'),
		'options' => array( 'ltr' => 'Left to Right', 'rtl' => 'Right to Left' ),
		'std' => 'ltr'
		),

	)
);

$options_args = array();

	//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$options_args['opt_name'] = SWG_THEME;

	//Custom menu title for options page - default is "Options"
$options_args['menu_title'] = esc_html__('Theme Options', 'bakan');

	//Custom Page Title for options page - default is "Options"
$options_args['page_title'] = esc_html__('Bakan Options ', 'bakan');

	//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "bakan_theme_options"
$options_args['page_slug'] = 'bakan_theme_options';

	//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
$options_args['page_type'] = 'submenu';

	//custom page location - default 100 - must be unique or will override other items
$options_args['page_position'] = 27;
$swg_options = new SWG_Options( $options, $options_args );

return $options;
}
add_action( 'init', 'bakan_Options_Setup', 0 );
endif; 


/*
** Define widget
*/
function bakan_widget_setup_args(){
	$bakan_widget_areas = array(
		
		array(
			'name' => esc_html__('Sidebar Left Blog', 'bakan'),
			'id'   => 'left-blog',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		array(
			'name' => esc_html__('Sidebar Right Blog', 'bakan'),
			'id'   => 'right-blog',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),

		array(
			'name' => esc_html__('Sidebar Above Product', 'bakan'),
			'id'   => 'above-product',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		
		array(
			'name' => esc_html__('Shop Categories', 'bakan'),
			'id'   => 'shop-categories',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),

		array(
			'name' => esc_html__('Sidebar Left Product', 'bakan'),
			'id'   => 'left-product',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		
		array(
			'name' => esc_html__('Sidebar Right Product', 'bakan'),
			'id'   => 'right-product',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		
		array(
			'name' => esc_html__('Sidebar Left Detail Product', 'bakan'),
			'id'   => 'left-product-detail',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		
		array(
			'name' => esc_html__('Sidebar Right Detail Product', 'bakan'),
			'id'   => 'right-product-detail',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="block-title-widget"><h2><span>',
			'after_title' => '</span></h2></div>'
		),
		
		array(
			'name' => esc_html__('Sidebar Bottom Detail Product Sidebar', 'bakan'),
			'id'   => 'bottom-detail-product',
			'before_widget' => '<div class="widget %1$s %2$s" data-scroll-reveal="enter bottom move 20px wait 0.2s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),

		array(
			'name' => esc_html__('Sidebar Bottom Detail Product Full', 'bakan'),
			'id'   => 'bottom-detail-product2',
			'before_widget' => '<div class="widget %1$s %2$s" data-scroll-reveal="enter bottom move 20px wait 0.2s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		
		array(
				'name' => esc_html__('Bottom Detail Product Mobile', 'bakan'),
				'id'   => 'bottom-detail-product-mobile',
				'before_widget' => '<div id="%1$s" class="widget %1$s %2$s" data-scroll-reveal="enter bottom move 20px wait 0.2s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
		array(
			'name' => esc_html__('Filter Mobile', 'bakan'),
			'id'   => 'filter-mobile',
			'before_widget' => '<div id="%1$s" class="widget %1$s %2$s" data-scroll-reveal="enter bottom move 20px wait 0.2s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Widget Search', 'bakan'),
			'id'   => 'search',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		),
		array(
			'name' => esc_html__('Widget Mobile Top', 'bakan'),
			'id'   => 'top-mobile',
			'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>'
		)
	);
return apply_filters( 'bakan_widget_register', $bakan_widget_areas );
}