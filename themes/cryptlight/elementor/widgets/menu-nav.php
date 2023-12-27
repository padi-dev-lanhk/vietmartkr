<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cryptlight_Elementor_Menu_Nav extends Widget_Base {

	public function get_name() {
		return 'cryptlight_elementor_menu_nav';
	}

	public function get_title() {
		return esc_html__( 'Menu', 'cryptlight' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return [ 'hf' ];
	}
	

	protected function _register_controls() {


		/* Global Section *******************************/
		/***********************************************/
		$this->start_controls_section(
			'section_menu_type',
			[
				'label' => esc_html__( 'Global', 'cryptlight' ),
			]
		);


			$menus 		= \wp_get_nav_menus();
			$list_menu 	= array();
			foreach ($menus as $menu) {
				$list_menu[$menu->slug] = $menu->name;
			}

			$this->add_control(
				'menu_slug',
				[
					'label' 		=> esc_html__( 'Select Menu', 'cryptlight' ),
					'type' 			=> Controls_Manager::SELECT,
					'options' 		=> $list_menu,
					'default' 		=> '',
					'prefix_class' 	=> 'elementor-view-',
				]
			);
			
			
		$this->end_controls_section();	


		/* Parent Menu Section *******************************/
		/***********************************************/
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Parent Menu', 'cryptlight' ),
			]
		);
		

			$this->add_control(
				'link_color',
				[
					'label' 	=> esc_html__( 'Link', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} ul.menu > li > a' => 'color: {{VALUE}};',
					],
					'scheme' 	=> [
						'type' 	=> \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_3,
					],
					'separator' => 'before'
				]
			);

			$this->add_control(
				'link_color_hover',
				[
					'label' 	=> esc_html__( 'Link Hover', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} ul.menu > li > a:hover' => 'color: {{VALUE}};',
					]
					
				]
			);

			$this->add_control(
				'link_color_active',
				[
					'label' 	=> esc_html__( 'Link Active', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} ul.menu > li.current-menu-item > a' => 'color: {{VALUE}};',
					]
					
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'menu_typography',
					'scheme' 	=> \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
					'selector'	=> '{{WRAPPER}} ul li a'
				]
			);

		$this->end_controls_section();


		/* Sub Menu Section *******************************/
		/***********************************************/
		$this->start_controls_section(
			'section_submenu_content',
			[
				'label' => esc_html__( 'Sub Menu', 'cryptlight' ),
			]
		);	


			$this->add_control(
				'submenu_bg_color',
				[
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} ul.sub-menu' => 'background-color: {{VALUE}};',
					]
					
				]
			);

			$this->add_control(
				'submenu_bg_item_hover_color',
				[
					'label' 	=> esc_html__( 'Background Item Hover', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} ul.sub-menu li a:hover' => 'background-color: {{VALUE}};',
					],
					'separator' => 'after'
					
				]
			);

			$this->add_control(
				'submenu_link_color',
				[
					'label' 	=> esc_html__( 'Link', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} ul.sub-menu li a' => 'color: {{VALUE}};',
					]
					
				]
			);

			$this->add_control(
				'submenu_link_color_hover',
				[
					'label' 	=> esc_html__( 'Link Hover', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} ul.sub-menu li a:hover' => 'color: {{VALUE}};',
					]
					
				]
			);

			$this->add_control(
				'submenu_link_color_active',
				[
					'label' 	=> esc_html__( 'Link Active', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} ul.sub-menu li.current-menu-item > a' => 'color: {{VALUE}};',
					]
					
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'submenu_typography',
					'scheme' 	=> \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
					'selector'	=> '{{WRAPPER}} ul.sub-menu li a'
				]
			);


		$this->end_controls_section();

		/* Begin Menu Style */
		$this->start_controls_section(
            'menu_style',
            [
                'label' => esc_html__( 'Menu', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_responsive_control(
	            'divider-align',
	            [
	                'label' 	=> esc_html__( 'Layout', 'cryptlight' ),
	                'type' 		=> Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'inline-block' 	=> [
	                        'title' 	=> esc_html__( 'Default', 'cryptlight' ),
	                        'icon' 		=> 'eicon-editor-list-ul',
	                    ],
	                    'block' 		=> [
	                        'title' 	=> esc_html__( 'Inline', 'cryptlight' ),
	                        'icon' 		=> 'eicon-ellipsis-h',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .main-navigation .primary-navigation .menu > li' => 'display: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_control(
	            'menu_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
	                'type' 		=> Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'left' 	=> [
	                        'title' => esc_html__( 'Left', 'cryptlight' ),
	                        'icon' 	=> 'eicon-text-align-left',
	                    ],
	                    'center' 	=> [
	                        'title' => esc_html__( 'Center', 'cryptlight' ),
	                        'icon' 	=> 'eicon-text-align-center',
	                    ],
	                    'right' 	=> [
	                        'title' => esc_html__( 'Right', 'cryptlight' ),
	                        'icon' 	=> 'eicon-text-align-right',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .main-navigation .primary-navigation .menu' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

			$this->add_responsive_control(
	            'menu_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .main-navigation .primary-navigation .menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Menu Style */

        /* Begin Menu Style */
		$this->start_controls_section(
            'item_style',
            [
                'label' => esc_html__( 'Item', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_responsive_control(
	            'item_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .main-navigation .primary-navigation .menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Menu Style */
		
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		
		$settings = $this->get_settings();
		
		?>

		<nav class="main-navigation">
            <button class="menu-toggle">
            	<span>
            		<?php echo esc_html__( 'Menu', 'cryptlight' ); ?>
            	</span>
            </button>
			<?php
				wp_nav_menu( [
					'theme_location'  => $settings['menu_slug'],
					'container_class' => 'primary-navigation',
					'menu'              => $settings['menu_slug'],
				] );
			?>
        </nav>
		

	<?php }



	
}


$widgets_manager->register_widget_type( new Cryptlight_Elementor_Menu_Nav() );


