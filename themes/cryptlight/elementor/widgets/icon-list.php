<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Cryptlight_Elementor_Icon_List extends Widget_Base {

	
	public function get_name() {
		return 'cryptlight_elementor_icon_list';
	}

	public function get_title() {
		return esc_html__( 'Icon List', 'cryptlight' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
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
			'section_icon_list',
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
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Class Icon', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'fas fa-check', 'cryptlight' ),
				]
			);

			$repeater->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__('ICO CRYPTO', 'cryptlight' ),
				]
			);

			$this->add_control(
				'items',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'title' 	=> esc_html__( 'White Paper', 'cryptlight' ),
							'icon' 		=> esc_html__( 'fas fa-check', 'cryptlight' ),
						],
						[
							'title' 	=> esc_html__( 'Terms Of Coin Sale', 'cryptlight' ),
							'icon' 		=> esc_html__( 'fas fa-check', 'cryptlight' ),
						],
						[
							'title' 	=> esc_html__( 'Privaci & Policy', 'cryptlight' ),
							'icon' 		=> esc_html__( 'fas fa-check', 'cryptlight' ),
						],
						[
							'title' 	=> esc_html__( 'One Pager', 'cryptlight' ),
							'icon' 		=> esc_html__( 'fas fa-check', 'cryptlight' ),
						],
					],
					'title_field' => '{{{ title }}}',
					'condition' => [
						'type' 	=> 'v1',
					],
				]
			);

			$this->add_control(
	            'column',
	            [
	                'label' 	=> esc_html__( 'Column', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SELECT,
	                'options' 	=> [
	                    'column1' => esc_html__( '1', 'cryptlight' ),
	                    'column2' => esc_html__( '2', 'cryptlight' ),
	                    'column3' => esc_html__( '3', 'cryptlight' ),
	                ],
	                'default' 	=> 'column2',
	                'condition' => [
						'type' 	=> 'v1',
					],
	            ]
	        );

	        // Version 2
	        $repeater_v2 = new \Elementor\Repeater();

			$repeater_v2->add_control(
				'icon_v2',
				[
					'label' 	=> esc_html__( 'Class Icon', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'fas fa-check', 'cryptlight' ),
				]
			);

			$this->add_control(
				'items_v2',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater_v2->get_controls(),
					'default' 	=> [
						[
							'icon_v2' 		=> esc_html__( 'ovaicomoon-bitcoin', 'cryptlight' ),
						],
						[
							'icon_v2' 		=> esc_html__( 'ovaicomoon-binance-coin', 'cryptlight' ),
						],
						[
							'icon_v2' 		=> esc_html__( 'ovaicomoon-paypal', 'cryptlight' ),
						],
						[
							'icon_v2' 		=> esc_html__( 'ovaicomoon-kyber-network', 'cryptlight' ),
						],
					],
					'condition' => [
						'type' 	=> 'v2',
					],
				]
			);

			$this->add_control(
				'icon_before_v2',
				[
					'label' 	=> esc_html__( 'Before', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'no',
					'condition' => [
						'type' 	=> 'v2',
					],
				]
			);

			// Version 3
			$this->add_control(
	            'column_v3',
	            [
	                'label' 	=> esc_html__( 'Column', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SELECT,
	                'options' 	=> [
	                    'column1' => esc_html__( '1', 'cryptlight' ),
	                    'column2' => esc_html__( '2', 'cryptlight' ),
	                    'column3' => esc_html__( '3', 'cryptlight' ),
	                    'column4' => esc_html__( '4', 'cryptlight' ),
	                ],
	                'default' 	=> 'column2',
	                'condition' => [
						'type' 	=> 'v3',
					],
	            ]
	        );

			$repeater_v3 = new \Elementor\Repeater();

			$repeater_v3->add_control(
				'icon_v3',
				[
					'label' 	=> esc_html__( 'Class Icon', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'fas fa-check', 'cryptlight' ),
				]
			);

			$repeater->add_control(
				'title_v3',
				[
					'label' 	=> esc_html__( 'Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__('Add Your Heading Text Here', 'cryptlight' ),
				]
			);

			$repeater->add_control(
				'description_v3',
				[
					'label' 	=> esc_html__( 'Description', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__('Add Your Description Text Here', 'cryptlight' ),
				]
			);

			$this->add_control(
				'items_v3',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater_v3->get_controls(),
					'default' 	=> [
						[
							'icon_v3' 			=> esc_html__( 'ovaicomoon-shopping-cart', 'cryptlight' ),
							'title_v3' 			=> esc_html__( 'Online Buy & Sell', 'cryptlight' ),
							'description_v3' 	=> esc_html__( 'Lorem Ipsum is simply dummy text of the printing and.', 'cryptlight' ),
						],
						[
							'icon_v3' 			=> esc_html__( 'ovaicomoon-wallet-3', 'cryptlight' ),
							'title_v3' 			=> esc_html__( 'Manage your Wallet', 'cryptlight' ),
							'description_v3' 	=> esc_html__( 'Lorem Ipsum is simply dummy text of the printing and.', 'cryptlight' ),
						],
						[
							'icon_v3' 			=> esc_html__( 'ovaicomoon-people', 'cryptlight' ),
							'title_v3' 			=> esc_html__( 'Stay with Friend', 'cryptlight' ),
							'description_v3' 	=> esc_html__( 'Lorem Ipsum is simply dummy text of the printing and.', 'cryptlight' ),
						],
						[
							'icon_v3' 			=> esc_html__( 'ovaicomoon-receipt-disscount', 'cryptlight' ),
							'title_v3' 			=> esc_html__( 'Reward & Bonus', 'cryptlight' ),
							'description_v3' 	=> esc_html__( 'Lorem Ipsum is simply dummy text of the printing and.', 'cryptlight' ),
						],
					],
					'title_field' 	=> '{{{ title_v3 }}}',
					'condition' 	=> [
						'type' 		=> 'v3',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_list_style',
			[
				'label' 	=> esc_html__( 'Items', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
				],
			]
		);

			$this->add_responsive_control(
				'icon_space_between',
				[
					'label' 	=> esc_html__( 'Row Gap', 'cryptlight' ),
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
							'max' => 100,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-list .content-icon-list' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_column_gap',
				[
					'label' 	=> esc_html__( 'Column Gap', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-list .content-icon-list' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' 	=> esc_html__( 'Icon', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
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
			            'icon_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list .content-icon-list .item i' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list .content-icon-list .item i' => 'color: {{VALUE}};',
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
			            'icon_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list .content-icon-list .item i:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list .content-icon-list .item i:hover' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography',
					'selector' 	=> '{{WRAPPER}} .ova-icon-list .content-icon-list .item i',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' 	=> esc_html__( 'Title', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-icon-list .content-icon-list .item .title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' 	=> esc_html__( 'Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-icon-list .content-icon-list .item .title' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_title',
				[
					'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-list .content-icon-list .item .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-icon-list .content-icon-list .item .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

        // Section Style Version 2
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

			$this->add_responsive_control(
	            'content_v2_alignment',
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
	                    '{{WRAPPER}} .ova-icon-list-v2' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 		=> 'content_v2_background',
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'types' 	=> [ 'classic', 'gradient' ],
					'exclude' 	=> [ 'image' ],
					'selector' 	=> '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2',
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'content_v2_border',
	                'selector' 	=> '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'content_v2_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'content_v2_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_control(
				'content_v2_before_options',
				[
					'label' 	=> esc_html__( 'Before', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'icon_before_v2' => 'yes',
					],
				]
			);

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 		=> 'content_v2_before_background',
						'label' 	=> esc_html__( 'Background', 'cryptlight' ),
						'types' 	=> [ 'gradient' ],
						'exclude' 	=> [ 'image' ],
						'selector' 	=> '{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:before',
						'condition' => [
							'icon_before_v2' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'content_v2_before_width',
					[
						'label' 		=> esc_html__( 'Width', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						
						'selectors' => [
							'{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:before' => 'width: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_before_v2' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'content_v2_before_height',
					[
						'label' 		=> esc_html__( 'Height', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						
						'selectors' => [
							'{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:before' => 'height: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_before_v2' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'content_v2_before_top',
					[
						'label' 		=> esc_html__( 'Top', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						
						'selectors' => [
							'{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:before' => 'top: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_before_v2' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'content_v2_before_left',
					[
						'label' 		=> esc_html__( 'Left', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						
						'selectors' => [
							'{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:before' => 'Left: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_before_v2' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
		            'content_v2_before_margin',
		            [
		                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
		                'type' 			=> Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' 	=> [
							'icon_before_v2' => 'yes',
						],
		            ]
		        );

			$this->add_control(
				'content_v2_after_options',
				[
					'label' 	=> esc_html__( 'After', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'icon_before_v2' => 'yes',
					],
				]
			);

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' 		=> 'content_v2_after_background',
						'label' 	=> esc_html__( 'Background', 'cryptlight' ),
						'types' 	=> [ 'gradient' ],
						'exclude' 	=> [ 'image' ],
						'selector' 	=> '{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:after',
						'condition' => [
							'icon_before_v2' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'content_v2_after_width',
					[
						'label' 		=> esc_html__( 'Width', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						
						'selectors' => [
							'{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:after' => 'width: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_before_v2' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'content_v2_after_height',
					[
						'label' 		=> esc_html__( 'Height', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						
						'selectors' => [
							'{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:after' => 'height: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_before_v2' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'content_v2_after_bottom',
					[
						'label' 		=> esc_html__( 'Bottom', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						
						'selectors' => [
							'{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:after' => 'bottom: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_before_v2' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'content_v2_after_left',
					[
						'label' 		=> esc_html__( 'Left', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						
						'selectors' => [
							'{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:after' => 'Left: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_before_v2' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
		            'content_v2_after_margin',
		            [
		                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
		                'type' 			=> Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .ova-icon-list-v2 .icon-before-v2:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' 	=> [
							'icon_before_v2' => 'yes',
						],
		            ]
		        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_items_v2_style',
			[
				'label' 	=> esc_html__( 'Items', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v2',
				],
			]
		);

			$this->start_controls_tabs( 'tabs_items_v2_style' );
				
				$this->start_controls_tab(
		            'tab_items_v2_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'items_v2_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2 .content-icon-v2 .icon-item-v2 i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'items_v2_background_normal',
							'label' 	=> esc_html__( 'Background', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2 .content-icon-v2 .icon-item-v2',
						]
					);

				$this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_items_v2_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'items_v2_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2 .content-icon-v2 .icon-item-v2:hover i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        	$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'items_v2_background_hover',
							'label' 	=> esc_html__( 'Background', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2 .content-icon-v2 .icon-item-v2:hover',
						]
					);

		        $this->end_controls_tab();
		    $this->end_controls_tabs();

		    $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'items_v2_typography',
					'selector' 	=> '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2 .content-icon-v2 .icon-item-v2 i',
				]
			);

		    $this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'items_v2_border',
	                'selector' 	=> '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2 .content-icon-v2 .icon-item-v2',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'items_v2_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2 .content-icon-v2 .icon-item-v2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'items_v2_spacing',
				[
					'label' 	=> esc_html__( 'Spacing', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'min' => 0,
							'max' => 1000,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2 .content-icon-v2 .icon-item-v2:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
	            'items_v2_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2 .content-icon-v2 .icon-item-v2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_responsive_control(
	            'items_v2_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-icon-list-v2 .ova-icon-container-v2 .content-icon-v2 .icon-item-v2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();

		// Version3 Style
		// Items Style
		$this->start_controls_section(
			'section_items_v3_style',
			[
				'label' 	=> esc_html__( 'Items', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v3',
				],
			]
		);

			$this->add_responsive_control(
				'items_v3_row_gap',
				[
					'label' 	=> esc_html__( 'Row Gap', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'items_v3_column_gap',
				[
					'label' 	=> esc_html__( 'Column Gap', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3' => 'grid-column-gap: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		// End Items Style

		// Icon Style
		$this->start_controls_section(
			'section_icon_v3_style',
			[
				'label' 	=> esc_html__( 'Icon', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v3',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_v3_typography',
					'selector' 	=> '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .icon i',
				]
			);

			$this->start_controls_tabs( 'tabs_icon_v3_style' );
				
				$this->start_controls_tab(
		            'tab_icon_v3_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'icon_v3_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .icon i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'icon_v3_bg_gradient_normal',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .icon',
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_icon_v3_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'icon_v3_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3:hover .icon i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'icon_v3_bg_gradient_hover',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3:hover .icon',
						]
					);

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'icon_v3_width',
				[
					'label' 	=> esc_html__( 'Size', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 2000,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .icon' => 'width: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'icon_v3_border',
	                'selector' 	=> '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .icon',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'icon_v3_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'icon_v3_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .icon',
				]
			);

			$this->add_responsive_control(
	            'icon_v3_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		// End Icon Style

		// Title Style
		$this->start_controls_section(
			'section_title_v3_style',
			[
				'label' 	=> esc_html__( 'Title', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v3',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_v3_typography',
					'selector' 	=> '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .content .title',
				]
			);

			$this->start_controls_tabs( 'tabs_title_v3_style' );
				
				$this->start_controls_tab(
		            'tab_title_v3_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'title_v3_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .content .title' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_title_v3_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'title_v3_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3:hover .content .title' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'title_v3_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		// End Title Style

		// Description Style
		$this->start_controls_section(
			'section_description_v3_style',
			[
				'label' 	=> esc_html__( 'Description', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v3',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_v3_typography',
					'selector' 	=> '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .content .description',
				]
			);

			$this->start_controls_tabs( 'tabs_description_v3_style' );
				
				$this->start_controls_tab(
		            'tab_description_v3_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'description_v3_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .content .description' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_description_v3_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'description_v3_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3:hover .content .description' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'description_v3_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-icon-list-v3 .icon-list-wrapper-v3 .container-v3 .items-v3 .content .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		// End Title Style
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$type 		= $settings['type'];

		// Version 1
		$items 		= $settings['items'];
		$column 	= $settings['column'];

		// Version 2
		$items_v2 	= $settings['items_v2'];
		$class_v2 	= '';
		$before_v2 	= $settings['icon_before_v2'];
		if ( 'yes' == $before_v2 ) {
			$class_v2 = ' icon-before-v2';
		}

		// Version 3
		$items_v3 	= $settings['items_v3'];
		$column_v3 	= $settings['column_v3'];

		?>
		<?php if ( 'v1' == $type ): ?>
			<?php if ( $items ): ?>
				<div class="ova-icon-list">
					<div class="content-icon-list <?php echo esc_attr( $column ); ?>">
						<?php foreach( $items as $item ): ?>
							<div class="item">
								<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
								<h3 class="title"><?php echo esc_html( $item['title'] ); ?></h3>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php elseif ( 'v2' == $type ): ?>
			<?php if ( $items_v2 ): ?>
				<div class="ova-icon-list-v2">
					<div class="ova-icon-container-v2<?php echo esc_attr( $class_v2 ); ?>">
						<div class="content-icon-v2">
							<?php foreach( $items_v2 as $item_v2 ): ?>
								<div class="icon-item-v2">
									<i class="<?php echo esc_attr( $item_v2['icon_v2'] ); ?>"></i>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php elseif ( 'v3' == $type ): ?>
			<?php if ( $items_v3 ): ?>
				<div class="ova-icon-list-v3">
					<div class="icon-list-wrapper-v3">
						<div class="container-v3 <?php echo esc_attr( $column_v3 ); ?>">
							<?php foreach( $items_v3 as $item_v3 ): ?>
								<div class="items-v3">
									<div class="icon">
										<i class="<?php echo esc_attr( $item_v3['icon_v3'] ); ?>"></i>
									</div>
									<div class="content">
										<h2 class="title"><?php echo esc_html( $item_v3['title_v3'] ); ?></h2>
										<p class="description"><?php echo esc_html( $item_v3['description_v3'] ); ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php
		endif;
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Icon_List() );