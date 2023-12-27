<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cryptlight_Elementor_Details extends Widget_Base {
	
	public function get_name() {
		return 'cryptlight_elementor_details';
	}

	public function get_title() {
		return esc_html__( 'Details', 'cryptlight' );
	}
	
	public function get_icon() {
		return 'eicon-kit-details';
	}
	
	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Details', 'cryptlight' ),
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

			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'row' 		=> 5,
					'default' 	=> esc_html__('Munber of tokens for sale','cryptlight'),
				]
			);

			$this->add_control(
				'desc',
				[
					'label' 	=> esc_html__( 'Description', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXTAREA,
					'row' 		=> 5,
					'default' 	=> esc_html__('900.0000 ICC (9%)','cryptlight'),
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 		=> [
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
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
					'default'	=> 'left',
					'separator' => 'before',
					'condition' => [
						'type' 	=> 'v1',
					],
				]
			);

			$this->add_responsive_control(
				'content_v2_align',
				[
					'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'flex-start' 	=> [
							'title' 	=> esc_html__( 'Left', 'cryptlight' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', 'cryptlight' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'flex-end' 		=> [
							'title' 	=> esc_html__( 'Right', 'cryptlight' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-details-v2 .details-wrapper' => 'align-items: {{VALUE}};',
					],
					'separator' => 'before',
					'condition' => [
						'type' 	=> 'v2',
					],
				]
			);

			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'title',
					[
						'label' 	=> esc_html__( 'Title', 'cryptlight' ),
						'type' 		=> Controls_Manager::TEXT,
						'default' 	=> esc_html__( 'Add Your Title', 'cryptlight' ),
					]
				);

				$repeater->add_control(
					'description',
					[
						'label' 	=> esc_html__( 'Description', 'cryptlight' ),
						'type' 		=> Controls_Manager::TEXTAREA,
						'default' 	=> esc_html__( 'Add Your Description', 'cryptlight' ),
					]
				);

				$repeater->add_control(
					'before_color',
					[
						'label' => esc_html__( 'Background', 'cryptlight' ),
						'type' 	=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}.item:before' => 'background-color: {{VALUE}}'
						],
					]
				);

			$this->add_control(
				'items_v3',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'title' 		=> esc_html__( '28%', 'cryptlight' ),
							'description' 	=> esc_html__( 'Mobile ad Platform', 'cryptlight' ),
						],
						[
							'title' 		=> esc_html__( '18%', 'cryptlight' ),
							'description' 	=> esc_html__( 'Marketing & General', 'cryptlight' ),
						],
						[
							'title' 		=> esc_html__( '22%', 'cryptlight' ),
							'description' 	=> esc_html__( 'Reward Program', 'cryptlight' ),
						],
						[
							'title' 		=> esc_html__( '25%', 'cryptlight' ),
							'description' 	=> esc_html__( 'Promotion/Marketing', 'cryptlight' ),
						],
						[
							'title' 		=> esc_html__( '10%', 'cryptlight' ),
							'description' 	=> esc_html__( 'Team & Advisor', 'cryptlight' ),
						],
					],
					'title_field' 	=> '{{{ title }}}',
					'condition'		=> [
						'type' => 'v3',
					],
				]
			);

            $this->add_control(
	            'column',
	            [
	                'label' 	=> esc_html__( 'Column', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SELECT,
	                'options' 	=> [
	                    'column1' => esc_html__( 'Column 1', 'cryptlight' ),
	                    'column2' => esc_html__( 'Column 2', 'cryptlight' ),
	                    'column3' => esc_html__( 'Column 3', 'cryptlight' ),
	                    'column4' => esc_html__( 'Column 4', 'cryptlight' ),
	                    'column5' => esc_html__( 'Column 5', 'cryptlight' ),
	                ],
	                'default' 	=> 'column2',
	                'condition' => [
	                	'type' 	=> 'v3',
	                ],
	            ]
	        );

		$this->end_controls_section();

		/* Begin section content style */
		$this->start_controls_section(
			'section_content_style',
			[
				'label' 	=> esc_html__( 'Content', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
				],
			]
		);

			$this->add_control(
				'content_linear_gradient',
				[
					'label' 	=> esc_html__( 'Linear Gradient', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'cryptlight' ),
					'label_off' => esc_html__( 'No', 'cryptlight' ),
					'default' 	=> 'yes',
				]
			);

			$this->add_control(
				'line_linear_gradient',
				[
					'label' 	=> esc_html__( 'Line', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'cryptlight' ),
					'label_off' => esc_html__( 'No', 'cryptlight' ),
					'default' 	=> 'no',
					'condition' => [
			            'content_linear_gradient' => 'yes',
			        ],
				]
			);

			$this->start_controls_tabs( 'tabs_linear_gradient_style' );
				
				$this->start_controls_tab(
		            'tab_linear_gradient_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'details_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-details' => 'background-color: {{VALUE}};',
			                ],
			                'condition' => [
								'content_linear_gradient!' 	=> 'yes',
							],
			            ]
			        );

		        	$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'linear_gradient_background_normal',
							'label' 	=> esc_html__( 'Background', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-details.linear-gradient-active',
							'condition' => [
								'line_linear_gradient!' 	=> 'yes',
								'content_linear_gradient' 	=> 'yes',
							],
						]
					);

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'line_linear_gradient_background_normal',
							'label' 	=> esc_html__( 'Background', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-details.ova-linear-gradient:before',
							'condition' => [
								'line_linear_gradient' => 'yes',
							],
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_linear_gradient_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'details_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-details:hover' => 'background-color: {{VALUE}};',
			                ],
			                'condition' => [
								'content_linear_gradient!' 	=> 'yes',
							],
			            ]
			        );

			        $this->add_control(
			            'details_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-details:hover' => 'border-color: {{VALUE}};',
			                ],
			                'condition' => [
								'content_linear_gradient!' 	=> 'yes',
							],
			            ]
			        );

		        	$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'linear_gradient_background_hover',
							'label' 	=> esc_html__( 'Background', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-details.linear-gradient-active:hover',
							'condition' => [
								'line_linear_gradient!' 	=> 'yes',
								'content_linear_gradient' 	=> 'yes',
							],
						]
					);

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'line_linear_gradient_background_hover',
							'label' 	=> esc_html__( 'Background', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-details.ova-linear-gradient:hover:before',
							'condition' => [
								'line_linear_gradient' => 'yes',
							],
						]
					);

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'details_border',
	                'selector' 	=> '{{WRAPPER}} .ova-details',
	                'separator' => 'before',
	                'condition' => [
						'content_linear_gradient!' 	=> 'yes',
					],
	            ]
	        );

	        $this->add_control(
	            'details_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
						'content_linear_gradient!' 	=> 'yes',
					],
	            ]
	        );

			$this->add_responsive_control(
	            'content_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_control(
				'line_option',
				[
					'label' 	=> esc_html__( 'Line Option', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
		            	'line_linear_gradient' => 'yes',
		            ],
				]
			);

				$this->add_responsive_control(
					'line_width',
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
								'max' => 500,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'size_units' 	=> [ '%', 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-details.ova-linear-gradient:before' => 'width: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
			            	'line_linear_gradient' => 'yes',
			            ],
					]
				);

				$this->add_responsive_control(
					'line_height',
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
								'max' => 500,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'size_units' 	=> [ '%', 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-details.ova-linear-gradient:before' => 'height: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
			            	'line_linear_gradient' => 'yes',
			            ],
					]
				);

				$this->add_responsive_control(
					'line_top',
					[
						'label' 	=> esc_html__( 'Top', 'cryptlight' ),
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
								'max' => 500,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'size_units' 	=> [ '%', 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-details.ova-linear-gradient:before' => 'top: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
			            	'line_linear_gradient' => 'yes',
			            ],
					]
				);

				$this->add_responsive_control(
					'line_left',
					[
						'label' 	=> esc_html__( 'Left', 'cryptlight' ),
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
								'max' => 500,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'size_units' 	=> [ '%', 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-details.ova-linear-gradient:before' => 'left: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
			            	'line_linear_gradient' => 'yes',
			            ],
					]
				);

				$this->add_group_control(
		            Group_Control_Border::get_type(), [
		                'name' 		=> 'line_border',
		                'selector' 	=> '{{WRAPPER}} .ova-details.ova-linear-gradient:before',
		                'separator' => 'before',
		                'condition' => [
			            	'line_linear_gradient' => 'yes',
			            ],
		            ]
		        );

		        $this->add_control(
		            'line_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
		                'type' 			=> Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .ova-details.ova-linear-gradient:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' 	=> [
			            	'line_linear_gradient' => 'yes',
			            ],
		            ]
		        );

		$this->end_controls_section();
		/* End section content style */

		/* Begin section content version 2 style */
		$this->start_controls_section(
			'section_content_v2_style',
			[
				'label' 	=> esc_html__( 'Content', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v2',
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

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'content_v2_background_normal',
							'label' 	=> esc_html__( 'Background', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-details-v2 .details-wrapper',
						]
					);

					$this->add_group_control(
			            Group_Control_Border::get_type(), [
			                'name' 		=> 'content_v2_border_normal',
			                'selector' 	=> '{{WRAPPER}} .ova-details-v2 .details-wrapper',
			            ]
			        );

			        $this->add_control(
			            'content_v2_border_radius_normal',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
			                'type' 			=> Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', '%' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-details-v2 .details-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 		=> 'content_v2_box_shadow_normal',
							'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
							'selector' 	=> '{{WRAPPER}} .ova-details-v2 .details-wrapper',
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_content_v2_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'content_v2_background_hover',
							'label' 	=> esc_html__( 'Background', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-details-v2 .details-wrapper:hover',
						]
					);

					$this->add_group_control(
			            Group_Control_Border::get_type(), [
			                'name' 		=> 'content_v2_border_hover',
			                'selector' 	=> '{{WRAPPER}} .ova-details-v2 .details-wrapper:hover',
			            ]
			        );

			        $this->add_control(
			            'content_v2_border_radius_hover',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
			                'type' 			=> Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', '%' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-details-v2 .details-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 		=> 'content_v2_box_shadow_hover',
							'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
							'selector' 	=> '{{WRAPPER}} .ova-details-v2 .details-wrapper:hover',
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
	                    '{{WRAPPER}} .ova-details-v2 .details-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'content_v2_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-details-v2 .details-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section content version 2 style */

		/* Begin section content version 3 style */
		$this->start_controls_section(
			'section_content_v3_style',
			[
				'label' 	=> esc_html__( 'Content', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v3',
				],
			]
		);

			$this->add_responsive_control(
				'align_content_v3',
				[
					'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 		=> [
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
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
	            'content_v3_background',
	            [
	                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-details-v3 .details-wrapper .item' => 'background-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'item_v3_column_gap',
				[
					'label' 	=> esc_html__( 'Column Gap', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-details-v3 .details-wrapper' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'item_v3_row_gap',
				[
					'label' 	=> esc_html__( 'Row Gap', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-details-v3 .details-wrapper' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'content_v3_border',
	                'selector' 	=> '{{WRAPPER}} .ova-details-v3 .details-wrapper .item',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'content_v3_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-details-v3 .details-wrapper .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'content_v3_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-details-v3 .details-wrapper .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'content_v3_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-details-v3 .details-wrapper .item',
				]
			);

		$this->end_controls_section();
		/* End section content version 3 style */

		/* Begin section content version 3 style */
		$this->start_controls_section(
			'section_line_v3_style',
			[
				'label' 	=> esc_html__( 'Line', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v3',
				],
			]
		);

			$this->add_responsive_control(
				'line_v3_width',
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
					],
					'size_units' 	=> [ 'px', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-details-v3 .details-wrapper .item:before' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
	            'line_v3_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-details-v3 .details-wrapper .item:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section content version 3 style */
	
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'cryptlight' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-details .title, {{WRAPPER}} .ova-details-v2 .details-wrapper .title, {{WRAPPER}} .ova-details-v3 .details-wrapper .item .title',
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
						'color_title_normal',
						[
							'label' 	=> esc_html__( 'Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-details .title' => 'color: {{VALUE}};',
								'{{WRAPPER}} .ova-details-v2 .details-wrapper .title' => 'color: {{VALUE}};',
								'{{WRAPPER}} .ova-details-v3 .details-wrapper .item .title' => 'color: {{VALUE}};',
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
						'color_title_hover',
						[
							'label' 	=> esc_html__( 'Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-details:hover .title' => 'color: {{VALUE}};',
								'{{WRAPPER}} .ova-details-v2 .details-wrapper:hover .title' => 'color: {{VALUE}};',
								'{{WRAPPER}} .ova-details-v3 .details-wrapper .item:hover .title' => 'color: {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'margin_title',
				[
					'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-details .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-details-v2 .details-wrapper .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-details-v3 .details-wrapper .item .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();


		$this->start_controls_section(
			'section_desc_style',
			[
				'label' => esc_html__( 'Description', 'cryptlight' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'desc_typography',
					'selector' 	=> '{{WRAPPER}} .ova-details .desc, {{WRAPPER}} .ova-details-v2 .details-wrapper .description, {{WRAPPER}} .ova-details-v3 .details-wrapper .item .description',
				]
			);

			$this->start_controls_tabs( 'tabs_desc_style' );
				
				$this->start_controls_tab(
		            'tab_desc_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
						'color_desc_normal',
						[
							'label' 	=> esc_html__( 'Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-details .desc' => 'color: {{VALUE}};',
								'{{WRAPPER}} .ova-details-v2 .details-wrapper .description' => 'color: {{VALUE}};',
								'{{WRAPPER}} .ova-details-v3 .details-wrapper .item .description' => 'color: {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_desc_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
						'color_desc_hover',
						[
							'label' 	=> esc_html__( 'Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-details:hover .desc' => 'color: {{VALUE}};',
								'{{WRAPPER}} .ova-details-v2 .details-wrapper:hover .description' => 'color: {{VALUE}};',
								'{{WRAPPER}} .ova-details-v3 .details-wrapper .item:hover .description' => 'color: {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'margin_desc',
				[
					'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-details .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-details-v2 .details-wrapper .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-details-v3 .details-wrapper .item .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

	}

	// Render Template Here
	protected function render() {

		$settings 				= $this->get_settings();
		$type 					= $settings['type'];
        $title 					= $settings['title'];
		$desc 					= $settings['desc'];
		$linear_gradient 		= $settings['content_linear_gradient'];
		$line_linear_gradient 	= $settings['line_linear_gradient'];
		$bg_class 				= '';

		if ( 'yes' == $linear_gradient ) {
			$bg_class = 'linear-gradient-active';

			if ( 'yes' == $line_linear_gradient ) {
				$bg_class = 'ova-linear-gradient';
			}
		}

		// Version 3
		$items_v3 	= $settings['items_v3'];
		$column 	= $settings['column'];

		?>
		<?php if ( 'v1' == $type ): ?>
			<div class="ova-details<?php echo esc_attr( $bg_class ) ? ' '.esc_attr( $bg_class ) : ''; ?>">
				<?php if (!empty($title)) : ?>
					<div class="title">
						<?php echo esc_html($title) ?>
				   </div>
				<?php endif ?>
				<?php if (!empty($desc)) : ?>
					<div class="desc">
						<?php echo esc_html($desc) ?>
					</div>
				<?php endif ?>
			</div>
		<?php elseif ( 'v2' == $type ): ?>
		 	<div class="ova-details-v2">
		 		<div class="details-wrapper">
		 			<h2 class="title"><?php echo esc_html( $title ); ?></h2>
		 			<p class="description"><?php echo esc_html( $desc ); ?></p>
		 		</div>
		 	</div>
		<?php elseif ( 'v3' == $type ): ?>
			<?php if ( $items_v3 && is_array( $items_v3 ) ): ?>
				<div class="ova-details-v3">
					<div class="details-wrapper <?php echo esc_attr( $column ); ?>">
						<?php foreach( $items_v3 as $items ): ?>
							<div class="item elementor-repeater-item-<?php echo esc_attr( $items['_id'] ); ?>">
								<h2 class="title"><?php echo esc_html( $items['title'] ); ?></h2>
								<p class="description"><?php echo esc_html( $items['description'] ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php
		endif;
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Details() );