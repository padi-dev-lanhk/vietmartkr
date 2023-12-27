<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Cryptlight_Elementor_Progress extends Widget_Base {

	
	public function get_name() {
		return 'cryptlight_elementor_progress';
	}

	public function get_title() {
		return esc_html__( 'Progress', 'cryptlight' );
	}

	public function get_icon() {
		return 'eicon-skill-bar';
	}

	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_script_depends() {
		wp_enqueue_script( 'cryptlight-progress-appear', get_theme_file_uri('/assets/libs/appear/appear.js'), array('jquery'), false, true);
		return [ 'cryptlight-elementor-progress' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		/* Begin progress */
		$this->start_controls_section(
			'section_progress',
			[
				'label' => esc_html__( 'Progress', 'cryptlight' ),
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
	                ],
	                'default' 	=> 'v1',
	            ]
	        );

			$this->add_control(
				'title',
				[
					'label' 		=> esc_html__( 'Title', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> esc_html__( 'Enter your title', 'cryptlight' ),
					'default' 		=> esc_html__( 'My Skill', 'cryptlight' ),
					'label_block' 	=> true,
					'condition'		=> [
						'type' 		=> 'v1',
					],
					'separator' 	=> 'before',
				]
			);

			$this->add_control(
				'title_left',
				[
					'label' 		=> esc_html__( 'Title Left', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> esc_html__( 'Enter your title', 'cryptlight' ),
					'default' 		=> esc_html__( 'Raised - ', 'cryptlight' ),
					'label_block' 	=> true,
					'condition'		=> [
						'type' 		=> 'v2',
					],
					'separator' 	=> 'before',
				]
			);

			$this->add_control(
				'sub_title_left',
				[
					'label' 		=> esc_html__( 'Sub-Title Left', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> esc_html__( 'Enter your title', 'cryptlight' ),
					'default' 		=> esc_html__( '1,450 Tokens', 'cryptlight' ),
					'label_block' 	=> true,
					'condition'		=> [
						'type' 		=> 'v2',
					],
				]
			);

			$this->add_control(
				'title_right',
				[
					'label' 		=> esc_html__( 'Title Right', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> esc_html__( 'Enter your title', 'cryptlight' ),
					'default' 		=> esc_html__( 'Target - ', 'cryptlight' ),
					'label_block' 	=> true,
					'condition'		=> [
						'type' 		=> 'v2',
					],
					'separator' 	=> 'before',
				]
			);

			$this->add_control(
				'sub_title_right',
				[
					'label' 		=> esc_html__( 'Sub-Title Right', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> esc_html__( 'Enter your title', 'cryptlight' ),
					'default' 		=> esc_html__( '150,000 Tokens', 'cryptlight' ),
					'label_block' 	=> true,
					'condition'		=> [
						'type' 		=> 'v2',
					],
				]
			);

			$this->add_control(
	            'show_title',
	            [
	                'label' 	=> esc_html__( 'Show Title', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SWITCHER,
	                'default' 	=> 'yes',
	                'separator' => 'after',
	            ]
	        );
			
			$this->add_control(
				'percent',
				[
					'label' 	=> esc_html__( 'Percent', 'cryptlight' ),
					'type' 		=> Controls_Manager::NUMBER,
					'min' 		=> 0,
					'max' 		=> 100,
					'step' 		=> 5,
					'default' 	=> 60,
				]
			);

			$this->add_control(
	            'show_percent',
	            [
	                'label' 	=> esc_html__( 'Show Percent', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SWITCHER,
	                'default' 	=> 'yes',
	                'condition'	=> [
						'type' 	=> 'v1',
					],
	            ]
	        );

	        $this->add_control(
	            'show_point',
	            [
	                'label' 	=> esc_html__( 'Show Point', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SWITCHER,
	                'default' 	=> 'yes',
	                'condition'	=> [
						'type' 	=> 'v2',
					],
	            ]
	        );

	        $this->add_control(
	            'show_notes',
	            [
	                'label' 	=> esc_html__( 'Show Notes', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SWITCHER,
	                'default' 	=> 'no',
	                'separator' => 'before',
	            ]
	        );

			$repeater = new \Elementor\Repeater();

	        $repeater->add_control(
	            'item_text',
	            [
	                'label' => esc_html__( 'Text', 'cryptlight' ),
	                'type' 	=> Controls_Manager::TEXT,
	            ]
	        );

	        $repeater->add_control(
	            'item_color',
	            [
	                'label' 	=> esc_html__( 'Item Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} {{CURRENT_ITEM}} .note-text' => 'color: {{VALUE}} !important',
	                ],
	            ]
	        );

	        $repeater->add_control(
	            'item_left',
	            [
	                'label' => esc_html__( 'Left', 'cryptlight' ),
	                'type' 	=> Controls_Manager::NUMBER,
	                'min' 	=> 5,
					'max' 	=> 100,
					'step' 	=> 5,
	            ]
	        );

			$this->add_control(
	            'notes',
	            [
	                'type' 		=> Controls_Manager::REPEATER,
	                'fields' 	=> $repeater->get_controls(),
	                'default' 	=> [
	                    [
	                        'item_text' 	=> esc_html__( 'Pre Sale', 'cryptlight' ),
	                    ],
	                    [
	                        'item_text' 	=> esc_html__( 'Soft Cap', 'cryptlight' ),
	                    ],
	                    [
	                        'item_text' 	=> esc_html__( 'Bonus', 'cryptlight' ),
	                    ],
	                ],
	                'title_field' => '{{{ item_text }}}',
	                'condition'	  => [
	                	'show_notes' => 'yes',
	                	'type'		 => 'v1',
	                ],
	            ]
	        );

	        $repeater_v2 = new \Elementor\Repeater();

	        $repeater_v2->add_control(
	            'item_text_v2',
	            [
	                'label' => esc_html__( 'Text', 'cryptlight' ),
	                'type' 	=> Controls_Manager::TEXT,
	            ]
	        );

	        $repeater->add_control(
	            'item_color_v2',
	            [
	                'label' 	=> esc_html__( 'Item Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-notes-v2 {{CURRENT_ITEM}} .note-text-v2' => 'color: {{VALUE}} !important',
	                ],
	            ]
	        );

	        $repeater->add_responsive_control(
	            'item_left_v2',
	            [
	                'label' 		=> esc_html__( 'Left', 'cryptlight' ),
	                'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-notes-v2 {{CURRENT_ITEM}}' => 'margin-left: {{SIZE}}{{UNIT}};',
					],
	            ]
	        );

			$this->add_control(
	            'notes_v2',
	            [
	                'type' 		=> Controls_Manager::REPEATER,
	                'fields' 	=> $repeater->get_controls(),
	                'default' 	=> [
	                    [
	                        'item_text_v2' 	=> esc_html__( 'Soft cap', 'cryptlight' ),
	                    ],
	                    [
	                        'item_text_v2' 	=> esc_html__( 'Crowdsale', 'cryptlight' ),
	                    ],
	                    [
	                        'item_text_v2' 	=> esc_html__( 'Hard cap', 'cryptlight' ),
	                    ],
	                ],
	                'title_field' => '{{{ item_text_v2 }}}',
	                'condition'	  => [
	                	'show_notes' => 'yes',
	                	'type'		 => 'v2',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End progress */

		/* Begin progress style */
		$this->start_controls_section(
			'section_progress_style',
			[
				'label' => esc_html__( 'Progress Bar', 'cryptlight' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'progress_bg',
				[
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'progress_height',
				[
					'label' 	=> esc_html__( 'Height', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view' => 'height: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'progress_width',
				[
					'label' 	=> esc_html__( 'Width', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'unit' 	=> '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 2000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ '%', 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-progress .ova-percent-view' 				=> 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-progress .ova-percent-view .ova-notes' 	=> 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .ova-progress-v2 .ova-progress-container' 		=> 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
	            'title_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment List', 'cryptlight' ),
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
	                'default' 	=> 'left',
	                'selectors' => [
	                    '{{WRAPPER}} .ova-progress' => 'text-align: {{VALUE}}',
	                    '{{WRAPPER}} .ova-progress .ova-percent-view' => 'float: {{VALUE}}',
	                ],
	                'condition' => [
	                	'type' => 'v1',
	                ],
	            ]
	        );

	        $this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'progress_border',
	                'selector' 	=> '{{WRAPPER}} .ova-progress .ova-percent-view',
	                'separator' => 'before',
	                'condition' => [
	                	'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'progress_border_v2',
	                'selector' 	=> '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2',
	                'separator' => 'before',
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );

	        $this->add_control(
	            'progress_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress .ova-percent-view' 				=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-progress .ova-percent-view .ova-percent' 	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_control(
	            'progress_border_radius_v2',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2' 				=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .ova-percent-v2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End progress style */

		/* Begin percent style */
		$this->start_controls_section(
			'section_percent_style',
			[
				'label' => esc_html__( 'Percent', 'cryptlight' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'percent_bg',
				[
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view .ova-percent' => 'background: {{VALUE}};',
					],
					'condition' => [
	                	'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_control(
				'percent_linear_gradient',
				[
					'label' 	=> esc_html__( 'Linear Gradient', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'condition' => [
	                	'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 		=> 'background',
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'types' 	=> [ 'classic', 'gradient' ],
					'exclude' 	=> [ 'image' ],
					'selector' 	=> '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .ova-percent-v2',
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_control(
				'point_options',
				[
					'label' 	=> esc_html__( 'Point Options', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'point_size',
				[
					'label' 		=> esc_html__( 'Size', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 1,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'default' 	=> [
						'unit' 	=> 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .percent-point .point' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_responsive_control(
				'point_top',
				[
					'label' 		=> esc_html__( 'Top', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> -100,
							'max' 	=> 100,
							'step' 	=> 5,
						],
						'%' => [
							'min' 	=> -100,
							'max' 	=> 100,
						],
					],
					'default' 	=> [
						'unit' 	=> 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .percent-point .point' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'point_border_v2',
	                'selector' 	=> '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .percent-point .point',
	                'separator' => 'before',
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );

	        $this->add_control(
	            'point_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .percent-point .point' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );

	        $this->add_control(
				'point_bg',
				[
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .percent-point .point' => 'background: {{VALUE}};',
					],
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
				]
			);

		$this->end_controls_section();
		/* End percent style */

		/* Begin title style */
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'cryptlight' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ctyl-progress-title' => 'color: {{VALUE}};',
					],
					'condition' => [
	                	'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-progress .ctyl-progress-title',
					'condition' => [
	                	'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress .ctyl-progress-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'title_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress .ctyl-progress-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_control(
				'title_color_v2',
				[
					'label' 	=> esc_html__( 'Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress-v2 .ova-progress-container .progress-title .progress-title-left .text' 	=> 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-progress-v2 .ova-progress-container .progress-title .progress-title-right .text' 	=> 'color: {{VALUE}};',
					],
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_v2_typography',
					'selector' 	=> '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .progress-title .progress-title-left .text, .ova-progress-v2 .ova-progress-container .progress-title .progress-title-right .text',
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_control(
				'sub_title_options',
				[
					'label' 	=> esc_html__( 'Sub Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_control(
				'sub_title_color_v2',
				[
					'label' 	=> esc_html__( 'Sub Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress-v2 .ova-progress-container .progress-title .progress-title-left .sub-text' 	=> 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-progress-v2 .ova-progress-container .progress-title .progress-title-right .sub-text' 	=> 'color: {{VALUE}};',
					],
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'sub_title_v2_typography',
					'selector' 	=> '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .progress-title .progress-title-left .sub-text, .ova-progress-v2 .ova-progress-container .progress-title .progress-title-right .sub-text',
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
	                'separator' => 'after',
				]
			);

			$this->add_responsive_control(
	            'title_v2_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .progress-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'title_v2_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .progress-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );


		$this->end_controls_section();
		/* End title style */

		/* Begin percentage style */
		$this->start_controls_section(
			'section_percentage_style',
			[
				'label' => esc_html__( 'Percentage', 'cryptlight' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
				'condition' => [
                	'type' 	=> 'v1',
                ],
			]
		);

			$this->add_control(
				'percentage_color',
				[
					'label' 	=> esc_html__( 'Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view .percentage' => 'color: {{VALUE}};',
					],
					'condition' => [
	                	'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'percentage_typography',
					'selector' 	=> '{{WRAPPER}} .ova-progress .ova-percent-view .percentage',
					'condition' => [
	                	'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_responsive_control(
				'percentage_top',
				[
					'label' 		=> esc_html__( 'Top', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> -100,
							'max' 	=> 100,
							'step' 	=> 5,
						],
						'%' => [
							'min' 	=> -100,
							'max' 	=> 100,
						],
					],
					'default' 	=> [
						'unit' 	=> 'px',
						'size' 	=> -30,
					],
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view .percentage' => 'top: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
	                	'type' 	=> 'v1',
	                ],
				]
			);

		$this->end_controls_section();
		/* End percentage style */

		/* Begin notes style */
		$this->start_controls_section(
			'section_note_style',
			[
				'label' => esc_html__( 'Notes', 'cryptlight' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
	            'note_color',
	            [
	                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-progress .ova-percent-view .ova-notes .note-text' => 'color: {{VALUE}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_control(
	            'line_note_color',
	            [
	                'label' 	=> esc_html__( 'Line Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-progress .ova-percent-view .ova-notes .item-note:before' => 'border-color: {{VALUE}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'note_top',
				[
					'label' 		=> esc_html__( 'Top', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> -100,
							'max' 	=> 100,
							'step' 	=> 5,
						],
						'%' => [
							'min' 	=> -100,
							'max' 	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-progress .ova-percent-view .ova-notes .item-note:before' => 'top: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
	                	'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'note_typography',
					'selector' 	=> '{{WRAPPER}} .ova-progress .ova-percent-view .ova-notes .note-text',
					'condition' => [
	                	'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_responsive_control(
	            'note_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress .ova-percent-view .ova-notes' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'note_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress .ova-percent-view .ova-notes' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'note_item_margin',
	            [
	                'label' 		=> esc_html__( 'Margin Item', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress .ova-percent-view .ova-notes .item-note' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v1',
	                ],
	            ]
	        );

	        // Version 2
	        $this->add_control(
	            'note_v2_color',
	            [
	                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .ova-notes-v2 .item-note-v2 .note-text-v2' => 'color: {{VALUE}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );

	        $this->add_control(
	            'line_note_v2_color',
	            [
	                'label' 	=> esc_html__( 'Line Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .ova-notes-v2 .item-note-v2:before' => 'border-color: {{VALUE}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'note_v2_top',
				[
					'label' 		=> esc_html__( 'Top', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> -100,
							'max' 	=> 100,
							'step' 	=> 5,
						],
						'%' => [
							'min' 	=> -100,
							'max' 	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .ova-notes-v2 .item-note-v2:before' => 'top: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'note_v2_typography',
					'selector' 	=> '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .ova-notes-v2 .item-note-v2 .note-text-v2',
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_responsive_control(
	            'note_v2_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .ova-notes-v2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'note_v2_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-progress-v2 .ova-progress-container .ova-pervent-view-v2 .ova-notes-v2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End notes style */

		
	}

	// Render Template Here
	protected function render() {

		$settings 			= $this->get_settings();

		$type 				= $settings['type'];
		$title 				= $settings['title'];
		$show_title 		= $settings['show_title'];
		$percent 			= $settings['percent'];
		$show_percent 		= $settings['show_percent'];
		$percent_bg 		= $settings['percent_bg'];
		$linear_gradient 	= $settings['percent_linear_gradient'];
		$bg 				= '';
		if ( $percent_bg && $linear_gradient ) {
			$bg = 'style="background: linear-gradient(270deg, '. $percent_bg .' 0%, '. $linear_gradient .' 100%);"';
		}

		$notes 				= $settings['notes'];
		$show_notes 		= $settings['show_notes'];

		// Version 2
		$show_point			= $settings['show_point'];
		$notes_v2 			= $settings['notes_v2'];
		$title_left 		= $settings['title_left'];
		$title_right 		= $settings['title_right'];
		$sub_title_left 	= $settings['sub_title_left'];
		$sub_title_right 	= $settings['sub_title_right'];

		?>

		<?php if ( 'v1' == $type ): ?>
			<div class="ova-progress">
				<?php if ( $show_title == 'yes' ): ?>
					<p class="ctyl-progress-title"><?php echo esc_html( $title ); ?></p>
				<?php endif; ?>
				<div class="ova-percent-view">
					<div class="ova-percent" data-percent="<?php echo esc_html( $percent ); ?>" <?php echo ''.$bg; ?>></div>
					<span class="percentage" data-show-percent="<?php echo esc_html( $show_percent ); ?>"><?php echo esc_attr( $percent ); ?>%</span>

					<?php if ( $show_notes == 'yes' && ! empty( $notes ) ): ?>
					<div class="ova-notes">
						<?php foreach( $notes as $items ):
							$left 	= $items['item_left'];
							$style 	= '';
							if ( ! empty( $left ) ) {
								$style 	= 'style="margin-left: '. $left .'%;"';
							}
						?>
							<div class="item-note elementor-repeater-item-<?php echo esc_attr( $items['_id'] ); ?>" <?php echo ''.$style; ?>>
								<span class="note-text"><?php echo esc_html( $items['item_text'] ); ?></span>
							</div>
						<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php else: ?>
			<div class="ova-progress-v2">
				<div class="ova-progress-container">
					<?php if ( 'yes' == $show_title ): ?>
						<div class="progress-title">
							<div class="progress-title-left">
								<span class="text"><?php echo esc_html( $title_left ); ?></span>
								<span class="sub-text"><?php echo esc_html( $sub_title_left ); ?></span>
							</div>
							<div class="progress-title-right">
								<span class="text"><?php echo esc_html( $title_right ); ?></span>
								<span class="sub-text"><?php echo esc_html( $sub_title_right ); ?></span>
							</div>
						</div>
					<?php endif; ?>
					<div class="ova-pervent-view-v2">
						<div class="ova-percent-v2" data-percent="<?php echo esc_attr( $percent ); ?>"></div>
						<div class="percent-point" data-point="<?php echo esc_attr( $show_point ); ?>">
							<span class="point"></span>
						</div>

						<?php if ( $show_notes == 'yes' && ! empty( $notes_v2 ) ): ?>
							<div class="ova-notes-v2">
								<?php foreach( $notes_v2 as $items_v2 ):
								?>
									<div class="item-note-v2 elementor-repeater-item-<?php echo esc_attr( $items_v2['_id'] ); ?>">
										<span class="note-text-v2"><?php echo esc_html( $items_v2['item_text_v2'] ); ?></span>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php
		endif;
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Progress() );