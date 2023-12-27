<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cryptlight_Elementor_Team extends Widget_Base {
	
	public function get_name() {
		return 'cryptlight_elementor_team';
	}

	public function get_title() {
		return esc_html__( 'Team', 'cryptlight' );
	}

	public function get_icon() {
		return 'eicon-user-circle-o';
	}

	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_keywords() {
		return [ 'social', 'icon', 'link' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'cryptlight' ),
			]
		);

			$this->add_control(
	            'type',
	            [
	                'label' 	=> esc_html__( 'Type', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SELECT,
	                'options' 	=> [
	                    'v1' => esc_html__( 'Type 1', 'cryptlight' ),
	                    'v2' => esc_html__( 'Type 2', 'cryptlight' ),
	                    'v3' => esc_html__( 'Type 3', 'cryptlight' ),
	                ],
	                'default' 	=> 'v1',
	            ]
	        );

	     	// Add Class control
		    $this->add_control(
				'image',
				[
					'label' 	=> esc_html__( 'Image Team', 'cryptlight' ),
					'type' 		=> Controls_Manager::MEDIA,
					'dynamic' 	=> [
						'active' 	=> true,
					],
					'default' 	=> [
						'url' 	=> Utils::get_placeholder_image_src(),
					],
					'separator' => 'before'
				]
			);
				
			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Charlee Mangar', 'cryptlight' ),
				]
			);

			$this->add_control(
				'sub-title',
				[
					'label' 	=> esc_html__( 'Sub Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'CEO & CFO', 'cryptlight' ),
				]
			);

			$this->add_control(
				'link_team',
				[
					'label' 		=> esc_html__( 'Link', 'cryptlight' ),
					'type' 			=> Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'cryptlight' ),
					'show_external' => true,
					'default' => [
						'url' => '#',
					],
					'condition' 	=> [
						'type' => ['v2', 'v3'],
					],
				]
			);
            
			// list icons control
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'class_icon',
				[
					'label' 	=> esc_html__( 'Class Icon', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=>  esc_html__( 'ovaicon-twitter', 'cryptlight' ),
					
				]
			);
			 
			$repeater->add_control(
				'link',
				[
					'label' 	=> esc_html__( 'Link', 'cryptlight' ),
					'type' 		=> Controls_Manager::URL,
					'default' 	=> [
						'url' => '#',
						'is_external' => 'on',
					],
					'dynamic' => [
						'active' => true,
					],
					'placeholder' => esc_html__( 'https://your-link.com', 'cryptlight' ),
				]
			);
			$repeater->add_control(
				'list_title_icon', [
					'label' 		=> esc_html__( 'Title Icon', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'List Title Icon' , 'cryptlight' ),
					'label_block' 	=> true,
				]
			);
			
            $this->add_control(
				'icons',
				[
					'label' 	=> esc_html__( 'Social Icons', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[	
							'list_title_icon' 	=> esc_html__( 'Twitter', 'cryptlight' ),
							'class_icon' 		=> esc_html__( 'ovaicon-twitter', 'cryptlight' ),
							'link' 				=> ['url' => '#'],
						],
						[	
							'list_title_icon' 	=> esc_html__( 'Facebook', 'cryptlight' ),
							'class_icon' 		=> esc_html__( 'ovaicon-facebook-logo-1', 'cryptlight' ),
							'link' 				=> ['url' => '#'],
						],
						[	
							'list_title_icon' 	=> esc_html__( 'Linkedin', 'cryptlight' ),
							'class_icon' 		=> esc_html__( 'fab fa-linkedin-in', 'cryptlight' ),
							'link' 				=> ['url' => '#'],
						],
	
					],
					'title_field' => '{{{ list_title_icon }}}',
				]
			);

		$this->end_controls_section();

		// Tabs style
        $this->start_controls_section(
			'section_style_icon',
			[
				'label' 	=> esc_html__( 'Icons', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
				],
			]
		);

			$this->start_controls_tabs( 'tabs_icon_style' );

				$this->start_controls_tab(
					'icon_normal',
					[
						'label' => esc_html__( 'Normal', 'cryptlight' ),
					]
				);

					$this->add_control(
						'color_icon',
						[
							'label' 	=> esc_html__( 'Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .list-icon ul .item i' => 'color : {{VALUE}};',
							],
						]
					);

                    $this->add_control(
						'background_color_icon',
						[
							'label' 	=> esc_html__( 'Background Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .list-icon ul .item' => 'background-color : {{VALUE}};',
							],
							
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'icon_hover',
					[
						'label' => esc_html__( 'Hover', 'cryptlight' ),
					]
				);

					$this->add_control(
						'color_social_icons_hover',
						[
							'label' 	=> esc_html__( 'Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team .list-icon .item i:hover' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'bg_color_social_icons_hover',
						[
							'label' 	=> esc_html__( 'Background Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .list-icon ul .item:hover' => 'background-color : {{VALUE}};',
							],
						]
					);

                $this->end_controls_tab();
			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_info',
			[
				'label' 	=> esc_html__( 'Info', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
				],
			]
		);

			$this->start_controls_tabs( 'tabs_info_style' );

				$this->start_controls_tab(
					'info_normal',
					[
						'label' => esc_html__( 'Normal', 'cryptlight' ),
					]
				);

					$this->add_control(
						'background_color_info',
						[
							'label' 	=> esc_html__( 'Background Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team .info' => 'background-color : {{VALUE}};',
							],
							
						]
					);

					$this->add_control(
						'color_title',
						[
							'label' 	=> esc_html__( 'Color Title', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team .info .title' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_sub-title',
						[
							'label' => esc_html__( 'Color sub-title', 'cryptlight' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team .info .sub-title' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_rectangle',
						[
							'label' 	=> esc_html__( 'Color rectangle', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team .info .rectangle' => 'background-color : {{VALUE}};',
							],
						]
					);
					
				$this->end_controls_tab();

				$this->start_controls_tab(
					'info_hover',
					[
						'label' => esc_html__( 'Hover', 'cryptlight' ),
					]
				);
						
					$this->add_control(
						'bg_color_infor_hover',
						[
							'label' 	=> esc_html__( 'Background Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team:hover .info' => 'background-color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_title_hover',
						[
							'label' 	=> esc_html__( 'Color title', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team:hover .info .title' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'color_sub-title_hover',
						[
							'label' 	=> esc_html__( 'Color subtitle', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-team:hover .info .sub-title' => 'color : {{VALUE}};',
							],
						]
					);

				$this->end_controls_tab();
		    $this->end_controls_tabs();
		$this->end_controls_section();

		// Version 2
		$this->start_controls_section(
			'section_content_v2_style',
			[
				'label' 	=> esc_html__( 'Content', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> ['v2', 'v3']
				],
			]
		);

			$this->start_controls_tabs( 'tabs_content_v2_style' );
				
				$this->start_controls_tab(
		            'tab_content_v2_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'content_v2_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-v2' => 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-team-v3' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
			            Group_Control_Border::get_type(), [
			                'name' 		=> 'content_v2_border_normal',
			                'selector' 	=> '{{WRAPPER}} .ova-team-v2, {{WRAPPER}} .ova-team-v3',
			            ]
			        );

			        $this->add_control(
			            'content_v2_border_radius_normal',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
			                'type' 			=> Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', '%' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-team-v2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                    '{{WRAPPER}} .ova-team-v3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 		=> 'content_v2_box_shadow_normal',
							'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
							'selector' 	=> '{{WRAPPER}} .ova-team-v2, {{WRAPPER}} .ova-team-v3',
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_content_v2_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'content_v2_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-v2:hover' => 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-team-v3:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
			            Group_Control_Border::get_type(), [
			                'name' 		=> 'content_v2_border_hover',
			                'selector' 	=> '{{WRAPPER}} .ova-team-v2:hover, {{WRAPPER}} .ova-team-v3:hover',
			            ]
			        );

			        $this->add_control(
			            'content_v2_border_radius_hover',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
			                'type' 			=> Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', '%' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-team-v2:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                    '{{WRAPPER}} .ova-team-v3:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 		=> 'content_v2_box_shadow_hover',
							'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
							'selector' 	=> '{{WRAPPER}} .ova-team-v2:hover, {{WRAPPER}} .ova-team-v3:hover',
						]
					);

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'content_v2_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-v2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team-v3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'separator' 	=> 'before',
	            ]
	        );

		$this->end_controls_section();

		// Image
		$this->start_controls_section(
			'section_img_v2_style',
			[
				'label' 	=> esc_html__( 'Image', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> ['v2', 'v3'],
				],
			]
		);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'img_v3_border',
	                'selector' 	=> '{{WRAPPER}} .ova-team-v3 .avatar',
	                'separator' => 'before',
	                'condition' => [
						'type' 	=> 'v3',
					],
	            ]
	        );

	        $this->add_control(
	            'img_v3_border_color_hover',
	            [
	                'label' 	=> esc_html__( 'Border Color Hover', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-team-v3:hover .avatar' => 'border-color: {{VALUE}}',
	                ],
	                'condition' => [
						'type' 	=> 'v3',
					],
	            ]
	        );

	        $this->add_control(
	            'img_v3_background_overlay',
	            [
	                'label' 	=> esc_html__( 'Background Overlay', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-team-v3 .avatar .image:before' => 'background-color: {{VALUE}}',
	                ],
	                'condition' => [
						'type' 	=> 'v3',
					],
	            ]
	        );

	        $this->add_control(
				'background_overlay_opacity',
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
						'{{WRAPPER}} .ova-team-v3 .avatar .image:before' => 'opacity: {{SIZE}}',
					],
					'condition' => [
						'type' 	=> 'v3',
					],
				]
			);

			$this->add_control(
	            'img_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-v2 .avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team-v3 .avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team-v3 .avatar .image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'img_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-v2 .avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team-v3 .avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();

		/* Begin Title Style */
		$this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-team-v2 .title, {{WRAPPER}} .ova-team-v3 .title, {{WRAPPER}} .ova-team .info .title',
				]
			);

			$this->start_controls_tabs( 'tabs_title_style' );

				$this->start_controls_tab(
		            'tab_title_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'title_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-v2 .title' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-team-v3 .title' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-team .info .title' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_title_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'title_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-v2:hover .title' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-team-v3:hover .title' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-team:hover .info .title' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'title_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-v2 .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team-v3 .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team .info .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();

        /* Begin Sub-Title Style */
		$this->start_controls_section(
            'subtitle_style',
            [
                'label' => esc_html__( 'Sub Title', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'subtitle_typography',
					'selector' 	=> '{{WRAPPER}} .ova-team-v2 .job, {{WRAPPER}} .ova-team-v3 .job, {{WRAPPER}} .ova-team .info .sub-title',
				]
			);

			$this->start_controls_tabs( 'tabs_subtitle_style' );

				$this->start_controls_tab(
		            'tab_subtitle_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'subtitle_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-v2 .job' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-team-v3 .job' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-team .info .sub-title' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_subtitle_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'subtitle_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-v2:hover .job' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-team-v3:hover .job' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-team:hover .info .sub-title' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'subtitle_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-v2 .job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team-v3 .job' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team .info .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();

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
					'name' 		=> 'social_typography',
					'selector' 	=> '{{WRAPPER}} .ova-team-v2 .social-list .social i, {{WRAPPER}} .ova-team-v3 .social-list .social i, {{WRAPPER}} .ova-team .list-icon ul .item a i',
				]
			);

        	$this->start_controls_tabs( 'tabs_social_style' );
				
				$this->start_controls_tab(
		            'tab_social_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'social_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-v2 .social-list .social i' => 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-team-v3 .social-list .social i' => 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-team .list-icon ul .item a i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        	$this->add_control(
			            'social_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-v2 .social-list .social' => 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-team-v3 .social-list .social' => 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-team .list-icon ul .item a' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_social_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'social_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-v2 .social-list .social:hover i' => 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-team-v3 .social-list .social:hover i' => 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-team .list-icon ul .item a:hover' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        	$this->add_control(
			            'social_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-team-v2 .social-list .social:hover' => 'background-color: {{VALUE}} !important;',
			                    '{{WRAPPER}} .ova-team-v3 .social-list .social:hover' => 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-team .list-icon ul .item a:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'social_size',
				[
					'label' 	=> esc_html__( 'Size', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-team-v2 .social-list .social' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-team-v3 .social-list .social' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-team .list-icon ul .item a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'social_border',
	                'selector' 	=> '{{WRAPPER}} .ova-team-v2 .social-list .social, {{WRAPPER}} .ova-team-v3 .social-list .social, {{WRAPPER}} .ova-team .list-icon ul .item a',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'social_border_color_hover',
	            [
	                'label' 	=> esc_html__( 'Border Color Hover', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-team-v2 .social-list .social:hover' => 'border-color: {{VALUE}}',
	                    '{{WRAPPER}} .ova-team-v3 .social-list .social:hover' => 'border-color: {{VALUE}}',
	                    '{{WRAPPER}} .ova-team .list-icon ul .item a:hover' => 'border-color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_control(
	            'social_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-v2 .social-list .social' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team-v3 .social-list .social' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team .list-icon ul .item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'social_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-team-v2 .social-list .social' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team-v3 .social-list .social' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-team .list-icon ul .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

		// Get Version
		$type 	= $settings['type'];
        // Get url image
		$url 	= $settings['image']['url'];
		$alt 	= isset( $settings['image']['alt'] ) ? $settings['image']['alt'] : '';
		
		if ( empty( $url ) ) {
			return;
		}

		// Get title
		$title 		= $settings['title'];
		// Get Sub-Title
		$subtitle 	= $settings['sub-title'];

		if ( empty( $alt ) ) {
			$alt = $title ? $title : esc_html__( 'Avatar', 'cryptlight' );
		}

        // list social icons
		$icons 		= $settings['icons'];

		// Version 2
		$link_team 	= $settings['link_team']['url'];
		$target 	= ( 'on' == $settings['link_team']['is_external'] ) ? ' target="_blank"' : '';
		?>
        
        <?php if ( 'v1' == $type ): ?>
			<div class="ova-team">
				<div class="img">
					<img src="<?php echo esc_url( $url ); ?>" class="team-img" alt="<?php echo esc_attr( $alt ); ?>">
					<div class="mask"></div>
				</div>
				<div class="info">
					<?php if ( ! empty ( $title ) ): ?>
						<h2 class="title"><?php echo esc_html($title); ?></h2>
					<?php endif; ?>

					<?php if ( ! empty ( $subtitle ) ): ?>
					<p  class="sub-title">
						<?php echo esc_html( $subtitle ); ?>
					</p>
					<?php endif; ?>
					<div class="rectangle"></div>
				</div>

				<div class="list-icon" >
					<?php if ( !empty( $icons ) ) : ?>
						<ul>
							<?php 
							foreach( $icons as $icon ) { 

								$link = $icon['link']['url'];
								$is_external = $icon['link']['is_external'];
								$target = ( $is_external == 'on' ) ? ' target="_blank"' : '';

								?>
								<li class="item">
									<?php if ( ! empty( $link ) ): ?>
										<a href="<?php echo esc_url( $link );?>"<?php echo esc_attr( $target ); ?>>
											<i class="<?php echo esc_attr( $icon['class_icon'] ); ?>"></i>
										</a>
									<?php endif; ?>
								</li>
							<?php } ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		<?php elseif ( 'v2' == $type ): ?>
			<div class="ova-team-v2">
				<?php if ( $link_team ): ?>
					<a href="<?php echo esc_url( $link_team ); ?>"<?php echo $target; ?>>
				<?php endif; ?>
					<div class="avatar">
						<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
					</div>
					<h2 class="title"><?php echo esc_html( $title ); ?></h2>
					<p class="job"><?php echo esc_html( $subtitle ); ?></p>
				<?php if ( $link_team ): ?>
					</a>
				<?php endif; ?>
				<ul class="social-list">
					<?php foreach( $icons as $icon ): 
						$link 	= $icon['link']['url'];
						$target = ( 'on' == $icon['link']['is_external'] ) ? ' target="_blank"' : '';
					?>
						<li class="social">
							<?php if ( ! empty( $link ) ): ?>
								<a href="<?php echo esc_url( $link );?>"<?php echo esc_attr( $target ); ?>>
									<i class="<?php echo esc_attr( $icon['class_icon'] ); ?>"></i>
								</a>
							<?php else: ?>
								<span><i class="<?php echo esc_attr( $icon['class_icon'] ); ?>"></i></span>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php elseif ( 'v3' == $type ): ?>
			<div class="ova-team-v3">
				<?php if ( $link_team ): ?>
					<a href="<?php echo esc_url( $link_team ); ?>"<?php echo $target; ?>>
				<?php endif; ?>
					<div class="avatar">
						<div class="image">
							<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
						</div>
					</div>
					<h2 class="title"><?php echo esc_html( $title ); ?></h2>
					<p class="job"><?php echo esc_html( $subtitle ); ?></p>
				<?php if ( $link_team ): ?>
					</a>
				<?php endif; ?>
				<ul class="social-list">
					<?php foreach( $icons as $icon ): 
						$link 	= $icon['link']['url'];
						$target = ( 'on' == $icon['link']['is_external'] ) ? ' target="_blank"' : '';
					?>
						<li class="social">
							<?php if ( ! empty( $link ) ): ?>
								<a href="<?php echo esc_url( $link );?>"<?php echo esc_attr( $target ); ?>>
									<i class="<?php echo esc_attr( $icon['class_icon'] ); ?>"></i>
								</a>
							<?php else: ?>
								<span><i class="<?php echo esc_attr( $icon['class_icon'] ); ?>"></i></span>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php
		endif;
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Team() );