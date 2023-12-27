<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cryptlight_Elementor_Canvas_Menu extends Widget_Base {

	public function get_name() {
		return 'cryptlight_elementor_menu_canvas';
	}

	public function get_title() {
		return esc_html__( 'Menu Canvas', 'cryptlight' );
	}

	public function get_icon() {
		return 'eicon-menu-bar';
	}

	public function get_categories() {
		return [ 'hf' ];
	}

	public function get_script_depends() {
		return [ 'cryptlight-elementor-menu-canvas' ];
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


			$menus = \wp_get_nav_menus();
			$list_menu = array();
			foreach ($menus as $menu) {
				$list_menu[$menu->slug] = $menu->name;
			}

			$this->add_control(
				'menu_slug',
				[
					'label' => esc_html__( 'Select Menu', 'cryptlight' ),
					'type' => Controls_Manager::SELECT,
					'options' => $list_menu,
					'default' => '',
					'prefix_class' => 'elementor-view-',
				]
			);

			$this->add_control(
				'menu_dir',
				[
					'label' => esc_html__( 'Menu Direction', 'cryptlight' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'dir_left' => [
							'title' => esc_html__( 'Left', 'cryptlight' ),
							'icon' => 'fa fa-align-right',
						],
						'dir_right' => [
							'title' => esc_html__( 'Right', 'cryptlight' ),
							'icon' => 'fa fa-align-left',
						],
					],
					'default' => 'dir_left'
				]
			);
			
		$this->end_controls_section();	


		/* Parent Menu Section *******************************/
		/***********************************************/
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Style', 'cryptlight' ),
			]
		);
			
			
			
			$this->add_control(
				'btn_color',
				[
					'label' => esc_html__( 'Button', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .menu-toggle:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .menu-toggle span:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .menu-toggle:after' => 'background-color: {{VALUE}};',
					],
					'scheme' => [
						'type' => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_3,
					],
					
				]
			);

			$this->add_control(
				'bg_color',
				[
					'label' => esc_html__( 'Menu Background', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .container-menu' => 'background-color: {{VALUE}};',
					],
					'scheme' => [
						'type' => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_3,
					],
					'separator' => 'before'
					
				]
			);


			$this->add_control(
				'text_color',
				[
					'label' => esc_html__( 'Link', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} ul li a' => 'color: {{VALUE}};',
					],
					'scheme' => [
						'type' => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_3,
					],
					
				]
			);

			$this->add_control(
				'text_color_hover',
				[
					'label' => esc_html__( 'Link Hover', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} ul li a:hover' => 'color: {{VALUE}};',
					]
					
				]
			);

			$this->add_control(
				'text_color_active',
				[
					'label' => esc_html__( 'Link Active', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} ul li.current-menu-item  a' => 'color: {{VALUE}};',
					]
					
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'typography',
					'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
					'selector'	=> '{{WRAPPER}} ul li a'
				]
			);

			

		$this->end_controls_section();
		
	}

	
	protected function render() {
		
		$settings = $this->get_settings();
		
		?>

		<nav class="menu-canvas">
            <button class="menu-toggle">
            	<span></span>
            </button>
            <nav class="container-menu <?php echo  esc_attr( $settings['menu_dir'] ); ?>">
	            <div class="close-menu">
	            	<i class="ovaicon-cancel"></i>
	            </div>
				<?php
					wp_nav_menu( [
						'theme_location'  => $settings['menu_slug'],
						'container_class' => 'primary-navigation',
						'menu'              => $settings['menu_slug'],

					] );
				?>
			</nav>
			<div class="site-overlay"></div>
        </nav>
		

	<?php }
	
}


$widgets_manager->register_widget_type( new Cryptlight_Elementor_Canvas_Menu() );


