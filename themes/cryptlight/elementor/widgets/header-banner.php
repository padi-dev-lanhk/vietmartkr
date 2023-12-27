<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Cryptlight_Elementor_Header_Banner extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cryptlight_elementor_header_banner';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Header Banner', 'cryptlight' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-archive-title';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'hf' ];
	}

	

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'cryptlight' ),
			]
		);

			
			$this->add_control(
				'header_boxed_content',
				[
					'label'        => __( 'Display Boxed Content', 'cryptlight' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no'
				]
			);

			$this->add_control(
				'header_bg_source',
				[
					'label'        => __( 'Display Background by Feature Image in Post/Page', 'cryptlight' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no'
				]
			);


			// Background Color
			$this->add_control(
				'cover_color',
				[
					'label' => __( 'Background Cover Color', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'default' => 'rgba(0,0,0,0.51)',
					'description' => __( 'You can add background image in Advanced Tab', 'cryptlight' ),
					'selectors' => [
						'{{WRAPPER}} .cover_color' => 'background-color: {{VALUE}};',
					],
					'scheme' => [
						'type' => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_3,
					],
					'separator' => 'after'
				]
			);

			// Title
			$this->add_control(
				'show_title',
				[
					'label'        => __( 'Show Title', 'cryptlight' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'selector'	=> '{{WRAPPER}} .header_banner_el .header_title',
				]
			);
			
			$this->add_control(
				'title_color',
				[
					'label' => __( 'Title Color', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#343434',
					'selectors' => [
						'{{WRAPPER}} .header_banner_el .header_title' => 'color: {{VALUE}};',
					],
					'scheme' => [
						'type' => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_3,
					]
				]
			);

			$this->add_responsive_control(
				'title_padding',
				[
					'label' => __( 'Title Padding', 'cryptlight' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .header_banner_el .header_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'title_tag',
				[
					'label' => __( 'Choose Title Format', 'cryptlight' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'h1' => __('H1', 'cryptlight'),
						'h2' => __('H2', 'cryptlight'),
						'h3' => __('H3', 'cryptlight'),
						'h4' => __('H4', 'cryptlight'),
						'h5' => __('H5', 'cryptlight'),
						'h6' => __('H6', 'cryptlight'),
						'div' => __('DIV', 'cryptlight'),
					],
					'default' => 'h1'
				]
			);

			

			

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'header_title',
					'label' => __( 'Title Typo', 'cryptlight' ),
					'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
					'selector'	=> '{{WRAPPER}} .header_banner_el .header_title',

				]
			);


			// Breadcrumbs
			$this->add_control(
				'show_breadcrumbs',
				[
					'label'        => __( 'Show Breadcrumbs', 'cryptlight' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'selector'	=> '{{WRAPPER}} .header_breadcrumbs',
					'separator' => 'before'
				]
			);
			
			$this->add_control(
				'breadcrumbs_color',
				[
					'label' => __( 'Breadcrumbs Color', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#343434',
					'selectors' => [
						'{{WRAPPER}} .header_banner_el ul.breadcrumb li' => 'color: {{VALUE}};',
						'{{WRAPPER}} .header_banner_el ul.breadcrumb li a' => 'color: {{VALUE}};',
						'{{WRAPPER}} .header_banner_el ul.breadcrumb a' => 'color: {{VALUE}};',
						'{{WRAPPER}} .header_banner_el ul.breadcrumb li .separator i' => 'color: {{VALUE}};',
					],
					'scheme' => [
						'type' => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_3,
					]
				]
			);

			$this->add_control(
				'breadcrumbs_color_hover',
				[
					'label' => __( 'Breadcrumbs Color hover', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#343434',
					'selectors' => [
						'{{WRAPPER}} .header_banner_el ul.breadcrumb li a:hover' => 'color: {{VALUE}};',
					],
					'scheme' => [
						'type' => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_3,
					]
				]
			);

			

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'header_breadcrumbs_typo',
					'label' => __( 'Breadcrumbs Typography', 'cryptlight' ),
					'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
					'selector'	=> '{{WRAPPER}} .header_banner_el ul.breadcrumb li',
					
				]
			);

			$this->add_responsive_control(
				'breadcrumbs_padding',
				[
					'label' => __( 'Breadcrumbs Padding', 'cryptlight' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .header_banner_el .header_breadcrumbs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			


			// Style
			$this->add_responsive_control(
				'align',
				[
					'label' => __( 'Alignment', 'cryptlight' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'cryptlight' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'cryptlight' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'cryptlight' ),
							'icon' => 'fa fa-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
					'default'	=> 'center',
					'separator' => 'before'
				]
			);
			

			$this->add_control(
				'class',
				[
					'label' => __( 'Class', 'cryptlight' ),
					'type' => Controls_Manager::TEXT,
				]
			);

		$this->end_controls_section();

		
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

		$class_bg = $attr_style = '';
		if( $settings['header_bg_source'] == 'yes' ){
			$current_id = cryptlight_get_current_id();
			$header_bg_source =  get_the_post_thumbnail_url( $current_id, 'full' );	
			$class_bg = 'bg_feature_img';
			$attr_style = 'style="background: url( '.$header_bg_source.' )" ';
		}

		 ?>
		 	<!-- Display when you choose background per Post -->
		 	<div class="wrap_header_banner <?php echo esc_attr($class_bg).' '.$settings['align']; ?> " <?php echo esc_attr( $attr_style ); ?> >

		 		<?php if( $settings['header_boxed_content'] == 'yes' ){ ?><div class="row_site"><div class="container_site"><?php } ?>
			 	
				 	<div class="cover_color"></div>

					<div class="header_banner_el <?php echo esc_attr( $settings['class'] ); ?>">
						
						<?php if( $settings['show_title'] == 'yes' ){ ?>
							
							<?php add_filter( 'cryptlight_show_singular_title', '__return_false' ); ?>

							<?php $title_tag = $settings['title_tag']; ?>
							<<?php echo esc_html( $title_tag ); ?> class=" header_title">
								<?php echo get_template_part( 'template-parts/parts/breadcrumbs_title' ); ?>
							</<?php echo esc_html( $title_tag ); ?>>
								
						<?php } ?>


						<?php if( $settings['show_breadcrumbs'] == 'yes' ){ ?>
							<div class="header_breadcrumbs">
								<?php echo get_template_part( 'template-parts/parts/breadcrumbs' ); ?>
							</div>
						<?php } ?>

					</div>

				<?php if( $settings['header_boxed_content'] == 'yes' ){ ?> </div></div> <?php } ?>

			</div>
		<?php
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Header_Banner() );