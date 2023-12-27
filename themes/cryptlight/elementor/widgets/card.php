<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cryptlight_Elementor_Card extends Widget_Base {

	public function get_name() {
		return 'cryptlight_elementor_card';
	}

	public function get_title() {
		return esc_html__( 'Card', 'cryptlight' );
	}

	public function get_icon() {
		return 'eicon-flip-box';
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
	                    'v4' => esc_html__( 'Type 4', 'cryptlight' ),
	                ],
	                'default' 	=> 'v1',
	            ]
	        );
            
			$this->add_control(
				'class_icon',
				[
					'label' 	=> esc_html__( 'Icon', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'ovaicon-page-blank', 'cryptlight' ),
					
				]
			);

	        $this->add_responsive_control(
				'icon_position',
				[
					'label' 	=> esc_html__( 'Icon Position', 'cryptlight' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' => esc_html__( 'Left', 'cryptlight' ),
							'icon' 	=> 'eicon-h-align-left',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'cryptlight' ),
							'icon' 	=> 'eicon-h-align-right',
						],
					],
					'default' 	=> 'left',
					'condition' => [
						'type' 			=> 'v2',
						'class_icon!' 	=> '',
					],
				]
			);

			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'row' 		=> 5,
					'default' 	=> esc_html__('Mobile payment make easy','cryptlight'),
				]
			);

			$this->add_control(
				'desc',
				[
					'label' 	=> esc_html__( 'Description', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXTAREA,
					'row' 		=> 5,
					'default' 	=> esc_html__('You can use a mobile device to pay with simple steps','cryptlight'),
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' => [
							'title' => esc_html__( 'Left', 'cryptlight' ),
							'icon' 	=> 'eicon-h-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'cryptlight' ),
							'icon' 	=> 'eicon-h-align-center',
						],
						'right' => [
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
						'type!' 	=> 'v4',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_background_style',
			[
				'label' 	=> esc_html__( 'Background Card', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
				],
			]
		);	

			$this->add_control(
				'background_color',
				[
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-card' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'background_color_hover',
				[
					'label' 	=> esc_html__( 'Background Hover', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-card:hover' => 'background-color : {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'card_border',
	                'selector' 	=> '{{WRAPPER}} .ova-card',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'card_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'card_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'cryptlight' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);
            $this->start_controls_tabs('icon_style');

				$this->start_controls_tab(
					'icon_normal',
					[
						'label' 	=> esc_html__( 'Normal', 'cryptlight' ),
					]
				);

					$this->add_control(
						'color_icon',
						[
							'label' 	=> esc_html__( 'Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-card .icon i' => 'color : {{VALUE}};',
								'{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-icon-box .icon i' => 'color : {{VALUE}};',
								'{{WRAPPER}} .ova-card-v3 .card-content-v3 .icon-box-v3 .icon i' => 'color : {{VALUE}};',
								'{{WRAPPER}} .ova-card-v4 .icon-box-v4 .icon i' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'bg_color_icon',
						[
							'label' 	=> esc_html__( 'Background Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-card .icon' => 'background-color : {{VALUE}};',
							],
							'condition' => [
								'type' 	=> 'v1',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'icon_bg_gradient_normal',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-icon-box .icon',
							'condition' => [
								'type' 	=> 'v2',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'icon_bg_gradient_normal_v3',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-card-v3 .card-content-v3 .icon-box-v3 .icon',
							'condition' => [
								'type' 	=> 'v3',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'icon_bg_gradient_normal_v4',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-card-v4 .icon-box-v4 .icon',
							'condition' => [
								'type' 	=> 'v4',
							],
						]
					);

					$this->add_control(
						'border_color_icon_v4',
						[
							'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-card-v4 .icon-box-v4' => 'border-color : {{VALUE}};',
							],
							'condition' => [
								'type' 	=> 'v4',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'icons_hover',
					[
						'label' 	=> esc_html__( 'Hover', 'cryptlight' ),
					]
				);
					
					$this->add_control(
						'color_icon_hover',
						[
							'label' 	=> esc_html__( 'Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-card .icon i:hover' => 'color : {{VALUE}};',
								'{{WRAPPER}} .ova-card-v2:hover .card-container-v2 .card-content-v2 .ova-card-icon-box .icon i' => 'color : {{VALUE}};',
								'{{WRAPPER}} .ova-card-v3:hover .card-content-v3 .icon-box-v3 .icon i' => 'color : {{VALUE}};',
								'{{WRAPPER}} .ova-card-v4:hover .icon-box-v4 .icon i' => 'color : {{VALUE}};',
							],
						]
					);    
				
					$this->add_control(
						'background_icon_hover',
						[
							'label' 	=> esc_html__( 'Background Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-card .icon:hover' => 'background-color : {{VALUE}};',
							],
							'condition' => [
								'type' 	=> 'v1',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'icon_bg_gradient_hover',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-card-v2:hover .card-container-v2 .card-content-v2 .ova-card-icon-box .icon',
							'condition' => [
								'type' 	=> 'v2',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'icon_bg_gradient_hover_v3',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-card-v3:hover .card-content-v3 .icon-box-v3 .icon',
							'condition' => [
								'type' 	=> 'v3',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'icon_bg_gradient_hover_v4',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-card-v4:hover .icon-box-v4 .icon',
							'condition' => [
								'type' 	=> 'v4',
							],
						]
					);

					$this->add_control(
						'border_color_icon_hover_v4',
						[
							'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
							'type' 		=> Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-card-v4:hover .icon-box-v4' => 'border-color : {{VALUE}};',
							],
							'condition' => [
								'type' 	=> 'v4',
							],
						]
					);

				$this->end_controls_tab();
		    $this->end_controls_tabs();

		    $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography',
					'selector' 	=> '{{WRAPPER}} .ova-card .align-icon .icon i',
					'condition' => [
						'type' 	=> 'v1',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography_v2',
					'selector' 	=> '{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-icon-box .icon i',
					'condition' => [
						'type' 	=> 'v2',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography_v3',
					'selector' 	=> '{{WRAPPER}} .ova-card-v3 .card-content-v3 .icon-box-v3 .icon i',
					'condition' => [
						'type' 	=> 'v3',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography_v4',
					'selector' 	=> '{{WRAPPER}} .ova-card-v4 .icon-box-v4 .icon i',
					'condition' => [
						'type' 	=> 'v4',
					],
				]
			);

			$this->add_responsive_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Size', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
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
					'default' 	=> [
						'unit' 	=> 'px',
					],
					'tablet_default' => [
						'unit' => 'px',
					],
					'mobile_default' => [
						'unit' => 'px',
					],
					
					'selectors' => [
						'{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-icon-box .icon' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-card-v3 .card-content-v3 .icon-box-v3 .icon' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-card-v4 .icon-box-v4 .icon' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'type' => [ 'v2', 'v3', 'v4'],
					],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'icon_border',
	                'selector' 	=> '{{WRAPPER}} .ova-card .icon',
	                'separator' => 'before',
	                'condition' => [
						'type' 	=> 'v1',
					],
	            ]
	        );

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'icon_border_v2',
	                'selector' 	=> '{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-icon-box .icon',
	                'separator' => 'before',
	                'condition' => [
						'type' 	=> 'v2',
					],
	            ]
	        );

	        $this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'icon_border_v3',
	                'selector' 	=> '{{WRAPPER}} .ova-card-v3 .card-content-v3 .icon-box-v3 .icon',
	                'separator' => 'before',
	                'condition' => [
						'type' 	=> 'v3',
					],
	            ]
	        );

	        $this->add_control(
	            'icon_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-card .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-icon-box .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-card-v3 .card-content-v3 .icon-box-v3 .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-card-v4 .icon-box-v4 .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'padding_icon',
				[
					'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-card .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'type' 	=> 'v1',
					],
				]
			);

			$this->add_responsive_control(
				'margin_icon',
				[
					'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-card .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-card-v3 .card-content-v3 .icon-box-v3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-card-v4 .icon-box-v4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		
		$this->end_controls_section();

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
					'selector' 	=> '{{WRAPPER}} .ova-card .title',
					'condition' => [
						'type' 	=> 'v1',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography_v2',
					'selector' 	=> '{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-content .title',
					'condition' => [
						'type' 	=> 'v2',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography_v3',
					'selector' 	=> '{{WRAPPER}} .ova-card-v3 .card-content-v3 .title',
					'condition' => [
						'type' 	=> 'v3',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography_v4',
					'selector' 	=> '{{WRAPPER}} .ova-card-v4 .title',
					'condition' => [
						'type' 	=> 'v4',
					],
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' 	=> esc_html__( 'Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-card .title' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-content .title' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-card-v3 .card-content-v3 .title' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-card-v4 .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_title',
				[
					'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-card .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-card-v3 .card-content-v3 .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-card-v4 .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'line_title_v4',
				[
					'label' 	=> esc_html__( 'Line Options', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'type' 	=> 'v4',
					],
				]
			);

				$this->add_control(
					'line_color_title_v4',
					[
						'label' 	=> esc_html__( 'Color', 'cryptlight' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-card-v4 .title:before' => 'border-color : {{VALUE}};',
						],
						'condition' => [
							'type' 	=> 'v4',
						],
					]
				);

				$this->add_responsive_control(
					'line_title_v4_width',
					[
						'label' 		=> esc_html__( 'Width', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px', '%' ],
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
						'default' 	=> [
							'unit' 	=> 'px',
						],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-card-v4 .title:before' => 'width: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'type' 	=> 'v4',
						],
					]
				);

				$this->add_responsive_control(
					'line_title_v4_height',
					[
						'label' 		=> esc_html__( 'Height', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px', '%' ],
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
						'default' 	=> [
							'unit' 	=> 'px',
						],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-card-v4 .title:before' => 'border-width: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'type' 	=> 'v4',
						],
					]
				);

				$this->add_responsive_control(
					'line_title_v4_bottom',
					[
						'label' 		=> esc_html__( 'Bottom', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px', '%' ],
						'range' => [
							'px' => [
								'min' => -1000,
								'max' => 1000,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'default' 	=> [
							'unit' 	=> 'px',
						],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-card-v4 .title:before' => 'bottom: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'type' 	=> 'v4',
						],
					]
				);

				$this->add_responsive_control(
					'line_title_v4_left',
					[
						'label' 		=> esc_html__( 'Left', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ 'px', '%' ],
						'range' => [
							'px' => [
								'min' => -1000,
								'max' => 1000,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'default' 	=> [
							'unit' 	=> 'px',
						],
						'tablet_default' => [
							'unit' => 'px',
						],
						'mobile_default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-card-v4 .title:before' => 'left: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'type' 	=> 'v4',
						],
					]
				);

				$this->add_responsive_control(
		            'line_title_v4_margin',
		            [
		                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
		                'type' 			=> Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .ova-card-v4 .title:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'type' 	=> 'v4',
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
					'selector' 	=> '{{WRAPPER}} .ova-card .desc',
					'condition' => [
						'type' 	=> 'v1',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'desc_typography_v2',
					'selector' 	=> '{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-content .description',
					'condition' => [
						'type' 	=> 'v2',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'desc_typography_v3',
					'selector' 	=> '{{WRAPPER}} .ova-card-v3 .card-content-v3 .description',
					'condition' => [
						'type' 	=> 'v3',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'desc_typography_v4',
					'selector' 	=> '{{WRAPPER}} .ova-card-v4 .description',
					'condition' => [
						'type' 	=> 'v4',
					],
				]
			);

			$this->add_control(
				'color_desc',
				[
					'label' 	=> esc_html__( 'Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-card .desc' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-content .description' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-card-v3 .card-content-v3 .description' => 'color : {{VALUE}};',
						'{{WRAPPER}} .ova-card-v4 .description' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_desc',
				[
					'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-card .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-card-v2 .card-container-v2 .card-content-v2 .ova-card-content .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-card-v3 .card-content-v3 .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .ova-card-v4 .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$type 		= $settings['type'];
		$icon 		= $settings['class_icon'];
        $title 		= $settings['title'];
		$desc 		= $settings['desc'];

		// Version 2
		$icon_position = $settings['icon_position'];

		?>
        <?php if ( 'v1' == $type ): ?>
			<div class="ova-card">
		     	<?php if ( ! empty( $icon ) ): ?>
	                <div class="align-icon">
						<div class="icon">
							<i class="<?php echo esc_attr( $icon ); ?>"></i>
						</div>
					</div>
				<?php endif ?>
				<?php if ( ! empty( $title ) ): ?>
					<div class="title">
						<?php echo esc_html( $title ); ?>
				   </div>
				<?php endif; ?>
				<?php if ( ! empty( $desc ) ): ?>
					<div class="desc">
						<?php echo esc_html( $desc ); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php elseif ( 'v2' == $type ): ?>
		 	<div class="ova-card-v2">
		 		<div class="card-container-v2">
		 			<!-- Desktop -->
		 			<div class="card-content-v2 ova-card-desktop">
		 				<?php if ( 'left' == $icon_position ): ?>
					 		<div class="ova-card-icon-box icon-left">
					 			<span class="icon">
					 				<i class="<?php echo esc_attr( $icon ); ?>"></i>
					 			</span>
					 		</div>
					 	<?php endif; ?>
				 		<div class="ova-card-content">
				 			<h2 class="title"><?php echo esc_html( $title ); ?></h2>
				 			<p class="description"><?php echo esc_html( $desc ); ?></p>
				 		</div>
				 		<?php if ( 'right' == $icon_position ): ?>
					 		<div class="ova-card-icon-box icon-right">
					 			<span class="icon">
					 				<i class="<?php echo esc_attr( $icon ); ?>"></i>
					 			</span>
					 		</div>
					 	<?php endif; ?>
		 			</div>

		 			<!-- Mobile -->
		 			<div class="card-content-v2 ova-card-mobile">
				 		<div class="ova-card-icon-box icon-left">
				 			<span class="icon">
				 				<i class="<?php echo esc_attr( $icon ); ?>"></i>
				 			</span>
				 		</div>
				 		<div class="ova-card-content">
				 			<h2 class="title"><?php echo esc_html( $title ); ?></h2>
				 			<p class="description"><?php echo esc_html( $desc ); ?></p>
				 		</div>
		 			</div>
		 		</div>
		 	</div>
		<?php elseif ( 'v3' == $type ): ?>
			<div class="ova-card-v3">
				<div class="card-content-v3">
					<div class="icon-box-v3">
						<span class="icon">
							<i class="<?php echo esc_attr( $icon ); ?>"></i>
						</span>
					</div>
					<h2 class="title"><?php echo esc_html( $title ); ?></h2>
		 			<p class="description"><?php echo esc_html( $desc ); ?></p>
				</div>
			</div>
		<?php elseif ( 'v4' == $type ): ?>
			<div class="ova-card-v4">
				<div class="icon-box-v4">
					<div class="icon">
						<i class="<?php echo esc_attr( $icon ); ?>"></i>
					</div>
				</div>
				<h2 class="title"><?php echo esc_html( $title ); ?></h2>
				<p class="description"><?php echo esc_html( $desc ); ?></p>
			</div>
		<?php
		endif;
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Card() );