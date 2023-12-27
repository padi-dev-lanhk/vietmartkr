<?php 
function swg_import_files() { 
	return array(
		array(
			'import_file_name'          => 'Home Page 1',
			'page_title'				=> 'Home',
			'header_title' 				   => 'Header_1',
			'footer_title' 				   => 'Footer_1',
			'site_url'					   => 'http://demo.wpthemego.com/themes/sw_bakan',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/demo-content.xml',
			'local_import_page_file'       => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/demo-content-page.xml',
			'local_import_pagemenu_file'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/demo-content-pagemenu.xml',
			'local_import_template_homepage' => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/demo-content-homepage-templates.xml',
			'local_import_template_all_homepages' => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/demo-content-all-templates.xml',	
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
			'local_import_revslider'  	=> array( 
				'slider1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/slider-home1.zip'
			),
			'local_import_options'        => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/theme_options.txt',
					'option_name' => 'bakan_theme',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   /* menu location => menu name for that location */
				'vertical_menu' => 'Vertical Menu',
				'mobile_menu' => 'Mobile Menu'
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-1/1.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 5-10 minutes', 'bakan' ),
			'preview_url'                  => esc_url( 'http://demo.wpthemego.com/themes/sw_bakan/' ),
		),
		array(
			'import_file_name'          => 'Home Page 2',
			'page_title'				=> 'Home Page 2',
			'header_title' 				   => 'Header_2',
			'footer_title' 				   => 'Footer_2',
			'site_url'					   => 'https://demo.wpthemego.com/themes/sw_bakan/demo2',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/demo-content.xml',
			'local_import_page_file'       => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/demo-content-page.xml',
			'local_import_pagemenu_file'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/demo-content-pagemenu.xml',
			'local_import_template_homepage' => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/demo-content-homepage-templates.xml',
			'local_import_template_all_homepages' => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/demo-content-all-templates.xml',	
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/widgets.json',
			'local_import_revslider'  	=> array( 
				'slider2' => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/slider-home2.zip'
			),
			'local_import_options'        => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/theme_options.txt',
					'option_name' => 'bakan_theme',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   /* menu location => menu name for that location */
				'vertical_menu' => 'Vertical Menu',
				'mobile_menu' => 'Mobile Menu'
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-2/2.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 5-10 minutes', 'bakan' ),
			'preview_url'                  => esc_url( 'https://demo.wpthemego.com/themes/sw_bakan/demo2/' ),
		),
		array(
			'import_file_name'          => 'Home Page 3',
			'page_title'				=> 'Home Page 3',
			'header_title' 				   => 'Header_3',
			'footer_title' 				   => 'Footer_3',
			'site_url'					   => 'https://demo.wpthemego.com/themes/sw_bakan/demo3',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/demo-content.xml',
			'local_import_page_file'       => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/demo-content-page.xml',
			'local_import_pagemenu_file'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/demo-content-pagemenu.xml',
			'local_import_template_homepage' => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/demo-content-homepage-templates.xml',
			'local_import_template_all_homepages' => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/demo-content-all-templates.xml',	
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/widgets.json',
			'local_import_revslider'  	=> array( 
				'slider3' => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/slider-home3.zip'
			),
			'local_import_options'        => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/theme_options.txt',
					'option_name' => 'bakan_theme',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   /* menu location => menu name for that location */
				'vertical_menu' => 'Vertical Menu',
				'mobile_menu' => 'Mobile Menu'
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-3/3.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 5-10 minutes', 'bakan' ),
			'preview_url'                  => esc_url( 'https://demo.wpthemego.com/themes/sw_bakan/demo3/' ),
		),
		array(
			'import_file_name'          => 'Home Page 4',
			'page_title'				=> 'Home Page 4',
			'header_title' 				   => 'Header_4',
			'footer_title' 				   => 'Footer_4',
			'site_url'					   => 'https://demo.wpthemego.com/themes/sw_bakan/demo4',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/demo-content.xml',
			'local_import_page_file'       => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/demo-content-page.xml',
			'local_import_pagemenu_file'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/demo-content-pagemenu.xml',
			'local_import_template_homepage' => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/demo-content-homepage-templates.xml',
			'local_import_template_all_homepages' => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/demo-content-all-templates.xml',	
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/widgets.json',
			'local_import_revslider'  	=> array( 
				'slider4' => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/slider-home4.zip'
			),
			'local_import_options'        => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/theme_options.txt',
					'option_name' => 'bakan_theme',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   /* menu location => menu name for that location */
				'vertical_menu' => 'Vertical Menu',
				'mobile_menu' => 'Mobile Menu'
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-4/4.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 5-10 minutes', 'bakan' ),
			'preview_url'                  => esc_url( 'https://demo.wpthemego.com/themes/sw_bakan/demo4/' ),
		),
		array(
			'import_file_name'          => 'Home Page 5',
			'page_title'				=> 'Home Page 5',
			'header_title' 				   => 'Header_5',
			'footer_title' 				   => 'Footer_5',
			'site_url'					   => 'https://demo.wpthemego.com/themes/sw_bakan/demo5',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/demo-content.xml',
			'local_import_page_file'       => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/demo-content-page.xml',
			'local_import_pagemenu_file'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/demo-content-pagemenu.xml',
			'local_import_template_homepage' => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/demo-content-homepage-templates.xml',
			'local_import_template_all_homepages' => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/demo-content-all-templates.xml',	
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/widgets.json',
			'local_import_revslider'  	=> array( 
				'slider5' => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/slider-home5.zip'
			),
			'local_import_options'        => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/theme_options.txt',
					'option_name' => 'bakan_theme',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   /* menu location => menu name for that location */
				'vertical_menu' => 'Vertical Menu',
				'mobile_menu' => 'Mobile Menu'
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-5/5.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 5-10 minutes', 'bakan' ),
			'preview_url'                  => esc_url( 'https://demo.wpthemego.com/themes/sw_bakan/demo5/' ),
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'swg_import_files' );