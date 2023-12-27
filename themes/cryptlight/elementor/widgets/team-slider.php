<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cryptlight_Elementor_Team_Slider extends Widget_Base {

	public function get_name() {
		return 'cryptlight_elementor_team_slider';
	}

	public function get_title() {
		return esc_html__( 'Team Slider', 'cryptlight' );
	}

	public function get_icon() {
		return 'eicon-user-circle-o';
	}

	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_script_depends() {
		wp_enqueue_style( 'owl-carousel', get_theme_file_uri('/assets/libs/carousel/assets/owl.carousel.min.css') );
		wp_enqueue_script( 'owl-carousel', get_theme_file_uri('/assets/libs/carousel/owl.carousel.min.js'), array('jquery'), false, true );
		return [ 'cryptlight-elementor-team-slider' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		$this->start_controls_section(
			'section_team_slider',
			[
				'label' => esc_html__( 'Team Slider', 'cryptlight' ),
			]
		);	
			
			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'avatar',
					[
						'label' 	=> esc_html__( 'Choose Avatar', 'plugin-domain' ),
						'type' 		=> Controls_Manager::MEDIA,
						'default' 	=> [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_control(
					'name',
					[
						'label' 		=> esc_html__( 'Name', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXT,
						'default' 		=> esc_html__('Add Your Name', 'cryptlight' ),
					]
				);

				$repeater->add_control(
					'job',
					[
						'label' 		=> esc_html__( 'Job Title', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXTAREA,
						'default' 		=> esc_html__('Add Your Job Title', 'cryptlight' ),
					]
				);

				$repeater->add_control(
					'description',
					[
						'label' 		=> esc_html__( 'Job Description', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXTAREA,
						'default' 		=> esc_html__('Add Your Job Description', 'cryptlight' ),
					]
				);

				$repeater->add_control(
					'icon_1',
					[
						'label' 		=> esc_html__( 'Icon 1', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXT,
						'default' 		=> esc_html__('ovaicon-facebook-logo-1', 'cryptlight' ),
					]
				);

				$repeater->add_control(
					'link_1',
					[
						'label' 		=> esc_html__( 'Link 1', 'cryptlight' ),
						'type' 			=> Controls_Manager::URL,
						'placeholder' 	=> esc_html__( 'https://your-link.com', 'cryptlight' ),
						'show_external' => true,
						'default' 		=> [
							'url' 		=> '#',
						],
					]
				);

				$repeater->add_control(
					'icon_2',
					[
						'label' 		=> esc_html__( 'Icon 2', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXT,
						'default' 		=> esc_html__('ovaicon-twitter', 'cryptlight' ),
					]
				);

				$repeater->add_control(
					'link_2',
					[
						'label' 		=> esc_html__( 'Link 2', 'cryptlight' ),
						'type' 			=> Controls_Manager::URL,
						'placeholder' 	=> esc_html__( 'https://your-link.com', 'cryptlight' ),
						'show_external' => true,
						'default' 		=> [
							'url' 		=> '#',
						],
					]
				);

				$repeater->add_control(
					'icon_3',
					[
						'label' 		=> esc_html__( 'Icon 3', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXT,
						'default' 		=> esc_html__('fab fa-linkedin-in', 'cryptlight' ),
					]
				);

				$repeater->add_control(
					'link_3',
					[
						'label' 		=> esc_html__( 'Link 3', 'cryptlight' ),
						'type' 			=> Controls_Manager::URL,
						'placeholder' 	=> esc_html__( 'https://your-link.com', 'cryptlight' ),
						'show_external' => true,
						'default' 		=> [
							'url' 		=> '#',
						],
					]
				);

			$this->add_control(
				'team_slider_items',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'avatar' 		=> [ 'url' => Utils::get_placeholder_image_src() ],
							'name' 			=> esc_html__('Lewandowsky', 'cryptlight' ),
							'job' 			=> esc_html__('Co-founder & COO', 'cryptlight' ),
							'description' 	=> esc_html__('Lorem Ipsum is simply dummy text of the printing and', 'cryptlight' ),
							'icon_1' 		=> esc_html__('ovaicon-facebook-logo-1', 'cryptlight' ),
							'link_1' 		=> [ 'url' => '#' ],
							'icon_2' 		=> esc_html__('ovaicon-twitter', 'cryptlight' ),
							'link_2' 		=> [ 'url' => '#' ],
							'icon_3' 		=> esc_html__('fab fa-linkedin-in', 'cryptlight' ),
							'link_3' 		=> [ 'url' => '#' ],
						],
						[
							'avatar' 		=> [ 'url' => Utils::get_placeholder_image_src() ],
							'name' 			=> esc_html__('Esther Howard', 'cryptlight' ),
							'job' 			=> esc_html__('Co-founder & COO', 'cryptlight' ),
							'description' 	=> esc_html__('Lorem Ipsum is simply dummy text of the printing and', 'cryptlight' ),
							'icon_1' 		=> esc_html__('ovaicon-facebook-logo-1', 'cryptlight' ),
							'link_1' 		=> [ 'url' => '#' ],
							'icon_2' 		=> esc_html__('ovaicon-twitter', 'cryptlight' ),
							'link_2' 		=> [ 'url' => '#' ],
							'icon_3' 		=> esc_html__('fab fa-linkedin-in', 'cryptlight' ),
							'link_3' 		=> [ 'url' => '#' ],
						],
						[
							'avatar' 		=> [ 'url' => Utils::get_placeholder_image_src() ],
							'name' 			=> esc_html__('Darrell Steward', 'cryptlight' ),
							'job' 			=> esc_html__('Co-founder & COO', 'cryptlight' ),
							'description' 	=> esc_html__('Lorem Ipsum is simply dummy text of the printing and', 'cryptlight' ),
							'icon_1' 		=> esc_html__('ovaicon-facebook-logo-1', 'cryptlight' ),
							'link_1' 		=> [ 'url' => '#' ],
							'icon_2' 		=> esc_html__('ovaicon-twitter', 'cryptlight' ),
							'link_2' 		=> [ 'url' => '#' ],
							'icon_3' 		=> esc_html__('fab fa-linkedin-in', 'cryptlight' ),
							'link_3' 		=> [ 'url' => '#' ],
						],
						[
							'avatar' 		=> [ 'url' => Utils::get_placeholder_image_src() ],
							'name' 			=> esc_html__('Ralph Edwards', 'cryptlight' ),
							'job' 			=> esc_html__('Co-founder & COO', 'cryptlight' ),
							'description' 	=> esc_html__('Lorem Ipsum is simply dummy text of the printing and', 'cryptlight' ),
							'icon_1' 		=> esc_html__('ovaicon-facebook-logo-1', 'cryptlight' ),
							'link_1' 		=> [ 'url' => '#' ],
							'icon_2' 		=> esc_html__('ovaicon-twitter', 'cryptlight' ),
							'link_2' 		=> [ 'url' => '#' ],
							'icon_3' 		=> esc_html__('fab fa-linkedin-in', 'cryptlight' ),
							'link_3' 		=> [ 'url' => '#' ],
						],
						[
							'avatar' 		=> [ 'url' => Utils::get_placeholder_image_src() ],
							'name' 			=> esc_html__('Theresa Webb', 'cryptlight' ),
							'job' 			=> esc_html__('Co-founder & COO', 'cryptlight' ),
							'description' 	=> esc_html__('Lorem Ipsum is simply dummy text of the printing and', 'cryptlight' ),
							'icon_1' 		=> esc_html__('ovaicon-facebook-logo-1', 'cryptlight' ),
							'link_1' 		=> [ 'url' => '#' ],
							'icon_2' 		=> esc_html__('ovaicon-twitter', 'cryptlight' ),
							'link_2' 		=> [ 'url' => '#' ],
							'icon_3' 		=> esc_html__('fab fa-linkedin-in', 'cryptlight' ),
							'link_3' 		=> [ 'url' => '#' ],
						],
						[
							'avatar' 		=> [ 'url' => Utils::get_placeholder_image_src() ],
							'name' 			=> esc_html__('Esther Howard', 'cryptlight' ),
							'job' 			=> esc_html__('Co-founder & COO', 'cryptlight' ),
							'description' 	=> esc_html__('Lorem Ipsum is simply dummy text of the printing and', 'cryptlight' ),
							'icon_1' 		=> esc_html__('ovaicon-facebook-logo-1', 'cryptlight' ),
							'link_1' 		=> [ 'url' => '#' ],
							'icon_2' 		=> esc_html__('ovaicon-twitter', 'cryptlight' ),
							'link_2' 		=> [ 'url' => '#' ],
							'icon_3' 		=> esc_html__('fab fa-linkedin-in', 'cryptlight' ),
							'link_3' 		=> [ 'url' => '#' ],
						],
						[
							'avatar' 		=> [ 'url' => Utils::get_placeholder_image_src() ],
							'name' 			=> esc_html__('Darrell Steward', 'cryptlight' ),
							'job' 			=> esc_html__('Co-founder & COO', 'cryptlight' ),
							'description' 	=> esc_html__('Lorem Ipsum is simply dummy text of the printing and', 'cryptlight' ),
							'icon_1' 		=> esc_html__('ovaicon-facebook-logo-1', 'cryptlight' ),
							'link_1' 		=> [ 'url' => '#' ],
							'icon_2' 		=> esc_html__('ovaicon-twitter', 'cryptlight' ),
							'link_2' 		=> [ 'url' => '#' ],
							'icon_3' 		=> esc_html__('fab fa-linkedin-in', 'cryptlight' ),
							'link_3' 		=> [ 'url' => '#' ],
						],
						[
							'avatar' 		=> [ 'url' => Utils::get_placeholder_image_src() ],
							'name' 			=> esc_html__('Ralph Edwards', 'cryptlight' ),
							'job' 			=> esc_html__('Co-founder & COO', 'cryptlight' ),
							'description' 	=> esc_html__('Lorem Ipsum is simply dummy text of the printing and', 'cryptlight' ),
							'icon_1' 		=> esc_html__('ovaicon-facebook-logo-1', 'cryptlight' ),
							'link_1' 		=> [ 'url' => '#' ],
							'icon_2' 		=> esc_html__('ovaicon-twitter', 'cryptlight' ),
							'link_2' 		=> [ 'url' => '#' ],
							'icon_3' 		=> esc_html__('fab fa-linkedin-in', 'cryptlight' ),
							'link_3' 		=> [ 'url' => '#' ],
						],
					],
					'title_field' => '{{{ name }}}',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'cryptlight' ),
			]
		);

			$this->add_control(
				'margin_items',
				[
					'label'   => esc_html__( 'Margin Right Items', 'cryptlight' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 30,
				]
				
			);

			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'cryptlight' ),
					'type'        => Controls_Manager::NUMBER,
					'default'     => 4,
				]
			);

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'cryptlight' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'cryptlight' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'cryptlight' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'cryptlight' ),
						'no'  => esc_html__( 'No', 'cryptlight' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'cryptlight' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
					'options' => [
						'yes' => esc_html__( 'Yes', 'cryptlight' ),
						'no'  => esc_html__( 'No', 'cryptlight' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'cryptlight' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'cryptlight' ),
						'no'  => esc_html__( 'No', 'cryptlight' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'cryptlight' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 3000,
					'step'      => 500,
					'condition' => [
						'autoplay' => 'yes',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => esc_html__( 'Smart Speed', 'cryptlight' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'nav_control',
				[
					'label'   => esc_html__( 'Show Nav', 'cryptlight' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'cryptlight' ),
						'no'  => esc_html__( 'No', 'cryptlight' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'nav_left',
				[
					'label'       	=> esc_html__( 'Icon Left', 'cryptlight' ),
					'type'        	=> Controls_Manager::TEXT,
					'default'     	=> esc_html__( 'iconly-Arrow-Left-2 icli', 'cryptlight' ),
					'condition' 	=> [
						'nav_control' => 'yes',
					],
				]
			);

			$this->add_control(
				'nav_right',
				[
					'label'       	=> esc_html__( 'Icon Right', 'cryptlight' ),
					'type'        	=> Controls_Manager::TEXT,
					'default'     	=> esc_html__( 'iconly-Arrow-Right-2 icli', 'cryptlight' ),
					'condition' 	=> [
						'nav_control' => 'yes',
					],
				]
			);

		$this->end_controls_section();

		/* Begin Items Style */
		$this->start_controls_section(
            'items_style',
            [
                'label' => esc_html__( 'Items', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_responsive_control(
	            'items_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
	                'type' 		=> Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'left' 	=> [
	                        'title' => esc_html__( 'Left', 'cryptlight' ),
	                        'icon' 	=> 'eicon-h-align-left',
	                    ],
	                    'center' 	=> [
	                        'title' => esc_html__( 'Center', 'cryptlight' ),
	                        'icon' 	=> 'eicon-h-align-center',
	                    ],
	                    'right' 	=> [
	                        'title' => esc_html__( 'Right', 'cryptlight' ),
	                        'icon' 	=> 'eicon-h-align-right',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

        	$this->start_controls_tabs( 'tabs_items_style' );
				
				$this->start_controls_tab(
		            'tab_items_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'button_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_items_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'items_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'items_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items:hover' => 'border-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'items_border',
	                'selector' 	=> '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'items_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'items_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'items_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items',
				]
			);

        $this->end_controls_section();
        /* End Items Style */

        /* Begin Avatar Style */
		$this->start_controls_section(
            'avatar_style',
            [
                'label' => esc_html__( 'Avatar', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_responsive_control(
				'image_width',
				[
					'label' 	=> esc_html__( 'Width', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'unit' 	=> 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
						'vw' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ 'px', '%', 'vw' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .avatar' => 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .avatar img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'image_max_width',
				[
					'label' 	=> esc_html__( 'Max Width', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'unit' 	=> 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
						'vw' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ 'px', '%', 'vw' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .avatar' => 'max-width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .avatar img' => 'max-width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'image_height',
				[
					'label' 	=> esc_html__( 'Height', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'unit' 	=> 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
						'vh' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ 'px', '%', 'vh' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .avatar' => 'height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .avatar img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
	            'items_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Avatar Style */

        /* Begin Name Style */
		$this->start_controls_section(
            'name_style',
            [
                'label' => esc_html__( 'Name', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'name_typography',
					'selector' 	=> '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .name',
				]
			);

			$this->start_controls_tabs( 'tabs_name_style' );

				$this->start_controls_tab(
		            'tab_name_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'name_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .name' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_name_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'name_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items:hover .name' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'name_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Name Style */

        /* Begin Job Style */
		$this->start_controls_section(
            'job_style',
            [
                'label' => esc_html__( 'Job', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'job_typography',
					'selector' 	=> '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .job',
				]
			);

			$this->start_controls_tabs( 'tabs_job_style' );

				$this->start_controls_tab(
		            'tab_job_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'job_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .job' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_job_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'job_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items:hover .job' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'job_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Name Style */

		/* Begin Description Style */
		$this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_control(
				'excerpt',
				[
					'label' 		=> esc_html__( 'Excerpt', 'cryptlight' ),
					'type' 			=> Controls_Manager::NUMBER,
					'min' 			=> 0,
					'max' 			=> 500,
					'step' 			=> 5,
					'description' 	=> esc_html__( 'Job Description Summary', 'cryptlight' ),
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .description',
				]
			);

			$this->start_controls_tabs( 'tabs_description_style' );

				$this->start_controls_tab(
		            'tab_description_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'description_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .description' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_description_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'description_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items:hover .description' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'description_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Description Style */

        /* Begin Social Style */
		$this->start_controls_section(
            'social_style',
            [
                'label' => esc_html__( 'Social', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography',
					'selector' 	=> '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .social a i',
				]
			);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' 	=> esc_html__( 'Size', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .social a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_icon_style' );

				$this->start_controls_tab(
		            'tab_icon_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'icon_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .social a i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .social a' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_icon_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'icon_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items:hover .social a i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items:hover .social a:hover' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items:hover .social a:hover' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'icon_border',
	                'selector' 	=> '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .social a',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'icon_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .social a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'icon_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-stage-outer .owl-stage .owl-item .items .social a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Social Style */

        /* Begin Nav Style */
		$this->start_controls_section(
            'nav_style',
            [
                'label' => esc_html__( 'Nav', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'nav_typography',
					'selector' 	=> '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button i',
				]
			);

			$this->add_responsive_control(
				'nav_size',
				[
					'label' 	=> esc_html__( 'Size', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_nav_style' );

				$this->start_controls_tab(
		            'tab_nav_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'nav_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'nav_background_normal',
							'label' 	=> esc_html__( 'Background', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button',
						]
					);

					$this->add_control(
						'nav_opacity_normal',
						[
							'label' 		=> esc_html__( 'Opacity', 'cryptlight' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'min' 	=> 0,
									'max' 	=> 1,
									'step' 	=> 0.1,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button' => 'opacity: {{SIZE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_nav_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'nav_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button:hover i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'nav_background_hover',
							'label' 	=> esc_html__( 'Background', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button:hover',
						]
					);

					$this->add_control(
			            'nav_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color Hover', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button:hover' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

					$this->add_control(
						'nav_opacity_hover',
						[
							'label' 		=> esc_html__( 'Opacity', 'cryptlight' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'min' 	=> 0,
									'max' 	=> 1,
									'step' 	=> 0.1,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button:hover' => 'opacity: {{SIZE}}',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'nav_border',
	                'selector' 	=> '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'nav_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'nav_margin_prev',
	            [
	                'label' 		=> esc_html__( 'Margin Prev', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button.owl-prev' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'nav_margin_next',
	            [
	                'label' 		=> esc_html__( 'Margin Next', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav button.owl-next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'nav_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-slider .team-slider-wrapper.owl-carousel .owl-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Nav_v1 Style */
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$items 		= $settings['team_slider_items'];

		$excerpt 	= $settings['excerpt'];

		$data_options['items']              = $settings['item_number'];
		$data_options['slideBy']            = $settings['slides_to_scroll'];
		$data_options['margin']             = $settings['margin_items'];
		$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['loop']               = $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay']           = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplayTimeout']    = $settings['autoplay_speed'];
		$data_options['smartSpeed']         = $settings['smartspeed'];
		$data_options['nav']                = $settings['nav_control'] === 'yes' ? true : false;
		$data_options['nav_left']           = $settings['nav_left'];
		$data_options['nav_right']          = $settings['nav_right'];

		?>

		<?php if ( $items && is_array( $items ) ): ?>
		 	<div class="ova-team-slider">
		 		<div class="team-slider-wrapper owl-carousel owl-theme" data-options="<?php echo esc_attr( json_encode( $data_options ) ); ?>">
		 			<?php foreach ( $items as $item ): 
		 				$avatar_url = $item['avatar']['url'];
		 				$alt 		= isset( $item['avatar']['alt'] ) ? $item['avatar']['alt'] : esc_html__( 'Avatar', 'cryptlight' );
		 			?>
		 				<div class="items">
		 					<div class="avatar">
		 						<img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_html( $alt ); ?>">
		 					</div>
		 					<!-- Name -->
		 					<?php if ( $item['name'] ): ?>
		 						<h2 class="name"><?php echo esc_html( $item['name'] ); ?></h2>
		 					<?php endif; ?>

		 					<!-- Job -->
		 					<?php if ( $item['job'] ): ?>
		 						<h3 class="job"><?php echo esc_html( $item['job'] ); ?></h2>
	 						<?php endif; ?>

	 						<!-- Description -->
	 						<?php if ( $item['description'] ): ?>
	 							<?php if ( $excerpt ): ?>
	 								<p class="description"><?php echo wp_trim_words( esc_html( $item['description'] ), $excerpt, esc_html__( '...', 'cryptlight' ) ); ?></p>
	 							<?php else: ?>
	 								<p class="description"><?php echo esc_html( $item['description'] ); ?></p>
	 							<?php endif; ?>
	 						<?php endif; ?>

	 						<!-- Social -->
	 						<?php if ( $item['icon_1'] || $item['icon_2'] || $item['icon_3'] ): ?>
	 							<div class="social">
	 								<!-- Icon 1 -->
	 								<?php if ( $item['icon_1'] ): 
	 									$target_1 = ( 'on' == $item['link_1']['is_external'] ) ? ' target="_blank"' : '';
	 								?>
 										<a href="<?php echo esc_url( $item['link_1']['url'] ); ?>"<?php echo $target_1; ?>>
 											<i class="<?php echo esc_attr( $item['icon_1'] ); ?>"></i>
 										</a>
	 								<?php endif; ?>

	 								<!-- Icon 2 -->
	 								<?php if ( $item['icon_2'] ): 
	 									$target_2 = ( 'on' == $item['link_2']['is_external'] ) ? ' target="_blank"' : '';
	 								?>
 										<a href="<?php echo esc_url( $item['link_2']['url'] ); ?>"<?php echo $target_2; ?>>
 											<i class="<?php echo esc_attr( $item['icon_2'] ); ?>"></i>
 										</a>
	 								<?php endif; ?>

	 								<!-- Icon 3 -->
	 								<?php if ( $item['icon_3'] ): 
	 									$target_3 = ( 'on' == $item['link_3']['is_external'] ) ? ' target="_blank"' : '';
	 								?>
 										<a href="<?php echo esc_url( $item['link_3']['url'] ); ?>"<?php echo $target_3; ?>>
 											<i class="<?php echo esc_attr( $item['icon_3'] ); ?>"></i>
 										</a>
	 								<?php endif; ?>
	 							</div>
 							<?php endif; ?>
		 				</div>
		 			<?php endforeach; ?>
		 		</div>
		 	</div>
		<?php
		endif;
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Team_Slider() );