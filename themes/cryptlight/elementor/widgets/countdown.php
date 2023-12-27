<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Cryptlight_Elementor_CountDown extends Widget_Base {

	
	public function get_name() {
		return 'cryptlight_elementor_countdown';
	}

	public function get_title() {
		return esc_html__( 'Countdown', 'cryptlight' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}
	
	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_script_depends() {
		wp_enqueue_script( 'plugin', get_theme_file_uri('/assets/libs/countdown/jquery.plugin.js'), array('jquery'), false, true);
		wp_enqueue_script( 'countdown', get_theme_file_uri('/assets/libs/countdown/jquery.countdown.min.js'), array('jquery'), false, true);
		return [ 'cryptlight-elementor-countdown' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		$this->start_controls_section(
			'section_countdown',
			[
				'label' => esc_html__( 'Countdown', 'cryptlight' ),
			]
		);	
			
			$this->add_control(
				'countdown_type',
				[
					'label' 	=> esc_html__( 'Type', 'cryptlight' ),
					'type' 		=> Controls_Manager::SELECT,
					'options' 	=> [
						'due_date' 	=> esc_html__( 'Due Date', 'cryptlight' ),
						'evergreen' => esc_html__( 'Evergreen Timer', 'cryptlight' ),
					],
					'default' => 'due_date',
				]
			);

			$this->add_control(
				'due_date',
				[
					'label' 		=> esc_html__( 'Due Date', 'cryptlight' ),
					'type' 			=> Controls_Manager::DATE_TIME,
					'default' 		=> gmdate( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
					'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
					'condition' 	=> [
						'countdown_type' => 'due_date',
					],
				]
			);

			$this->add_control(
				'countdown_format',
				[
					'label' 	=> esc_html__( 'Format', 'cryptlight' ),
					'type' 		=> Controls_Manager::SELECT,
					'options' 	=> [
						'DHMS' 	=> esc_html__( 'Show', 'cryptlight' ),
						'dhms' 	=> esc_html__( 'Hide', 'cryptlight' ),
					],
					'default' 	=> 'DHMS',
					'description' => esc_html__( 'Show/Hide if time = 0.', 'cryptlight' ),
				]
			);

			$this->add_control(
				'evergreen_counter_hours',
				[
					'label' 		=> esc_html__( 'Hours', 'cryptlight' ),
					'type' 			=> Controls_Manager::NUMBER,
					'default' 		=> 69,
					'placeholder' 	=> esc_html__( 'Hours', 'cryptlight' ),
					'condition' 	=> [
						'countdown_type' => 'evergreen',
					],
				]
			);

			$this->add_control(
				'evergreen_counter_minutes',
				[
					'label' 		=> esc_html__( 'Minutes', 'cryptlight' ),
					'type' 			=> Controls_Manager::NUMBER,
					'default' 		=> 96,
					'placeholder' 	=> esc_html__( 'Minutes', 'cryptlight' ),
					'condition' 	=> [
						'countdown_type' => 'evergreen',
					],
				]
			);

			$this->add_control(
				'show_days',
				[
					'label' 	=> esc_html__( 'Days', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'yes',
				]
			);

			$this->add_control(
				'show_hours',
				[
					'label' 	=> esc_html__( 'Hours', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'yes',
				]
			);

			$this->add_control(
				'show_minutes',
				[
					'label' 	=> esc_html__( 'Minutes', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'yes',
				]
			);

			$this->add_control(
				'show_seconds',
				[
					'label' 	=> esc_html__( 'Seconds', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'yes',
				]
			);

			$this->add_control(
				'show_labels',
				[
					'label' 	=> esc_html__( 'Show Label', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'yes',
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
	            'label_align',
	            [
	                'label' 	=> esc_html__( 'Layout', 'cryptlight' ),
	                'type' 		=> Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'top' 	=> [
	                        'title' => esc_html__( 'Top', 'cryptlight' ),
	                        'icon' 	=> 'eicon-v-align-top',
	                    ],
	                    'bottom' => [
	                        'title' => esc_html__( 'Bottom', 'cryptlight' ),
	                        'icon' 	=> 'eicon-v-align-bottom',
	                    ],
	                ],
	            ]
	        );

			$this->add_control(
				'custom_labels',
				[
					'label' 	=> esc_html__( 'Custom Label', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'condition' => [
						'show_labels!' => '',
					],
				]
			);

			$this->add_control(
				'label_day',
				[
					'label' 		=> esc_html__( 'Day', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'Day', 'cryptlight' ),
					'placeholder' 	=> esc_html__( 'Day', 'cryptlight' ),
					'condition' 	=> [
						'show_labels!' 		=> '',
						'custom_labels!' 	=> '',
						'show_days' 		=> 'yes',
					],
				]
			);

			$this->add_control(
				'label_days',
				[
					'label' 		=> esc_html__( 'Days', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'Days', 'cryptlight' ),
					'placeholder' 	=> esc_html__( 'Days', 'cryptlight' ),
					'condition' 	=> [
						'show_labels!' 		=> '',
						'custom_labels!' 	=> '',
						'show_days' 		=> 'yes',
					],
				]
			);

			$this->add_control(
				'label_hour',
				[
					'label' 		=> esc_html__( 'Hour', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'Hour', 'cryptlight' ),
					'placeholder' 	=> esc_html__( 'Hour', 'cryptlight' ),
					'condition' 	=> [
						'show_labels!' 		=> '',
						'custom_labels!' 	=> '',
						'show_hours' 		=> 'yes',
					],
				]
			);

			$this->add_control(
				'label_hours',
				[
					'label' 		=> esc_html__( 'Hours', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'Hours', 'cryptlight' ),
					'placeholder' 	=> esc_html__( 'Hours', 'cryptlight' ),
					'condition' 	=> [
						'show_labels!' 		=> '',
						'custom_labels!' 	=> '',
						'show_hours' 		=> 'yes',
					],
				]
			);

			$this->add_control(
				'label_minute',
				[
					'label' 		=> esc_html__( 'Minute', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'Minute', 'cryptlight' ),
					'placeholder' 	=> esc_html__( 'Minute', 'cryptlight' ),
					'condition' 	=> [
						'show_labels!' 		=> '',
						'custom_labels!' 	=> '',
						'show_minutes' 		=> 'yes',
					],
				]
			);

			$this->add_control(
				'label_minutes',
				[
					'label' 		=> esc_html__( 'Minutes', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'Minutes', 'cryptlight' ),
					'placeholder' 	=> esc_html__( 'Minutes', 'cryptlight' ),
					'condition' 	=> [
						'show_labels!' 		=> '',
						'custom_labels!' 	=> '',
						'show_minutes' 		=> 'yes',
					],
				]
			);

			$this->add_control(
				'label_second',
				[
					'label' 		=> esc_html__( 'Second', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'Second', 'cryptlight' ),
					'placeholder' 	=> esc_html__( 'Second', 'cryptlight' ),
					'condition' 	=> [
						'show_labels!' 		=> '',
						'custom_labels!' 	=> '',
						'show_seconds' 		=> 'yes',
					],
				]
			);

			$this->add_control(
				'label_seconds',
				[
					'label' 		=> esc_html__( 'Seconds', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'Seconds', 'cryptlight' ),
					'placeholder' 	=> esc_html__( 'Seconds', 'cryptlight' ),
					'condition' 	=> [
						'show_labels!' 		=> '',
						'custom_labels!' 	=> '',
						'show_seconds' 		=> 'yes',
					],
				]
			);

			$this->add_control(
				'expire_actions',
				[
					'label' 	=> esc_html__( 'Actions After Expire', 'cryptlight' ),
					'type' 		=> Controls_Manager::SELECT,
					'options' 	=> [
						'nothing' 	=> esc_html__( 'Nothing', 'cryptlight' ),
						'hide' 		=> esc_html__( 'Hide', 'cryptlight' ),
						'redirect' 	=> esc_html__( 'Redirect', 'cryptlight' ),
						'message' 	=> esc_html__( 'Show Message', 'cryptlight' ),
					],
				]
			);

			$this->add_control(
				'message_after_expire',
				[
					'label' 	=> esc_html__( 'Message', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXTAREA,
					'separator' => 'before',
					'dynamic' 	=> [
						'active' => true,
					],
					'default'	=> esc_html__( 'Countdown timeout', 'cryptlight' ),
					'condition' => [
						'expire_actions' => 'message',
					],
				]
			);

			$this->add_control(
				'expire_redirect_url',
				[
					'label' 	=> esc_html__( 'Redirect URL', 'cryptlight' ),
					'type' 		=> Controls_Manager::URL,
					'separator' => 'before',
					'options' 	=> false,
					'dynamic' 	=> [
						'active' => true,
					],
					'condition' => [
						'expire_actions' => 'redirect',
					],
				]
			);

			$this->add_control(
				'show_title',
				[
					'label' 	=> esc_html__( 'Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'no',
				]
			);

			$this->add_control(
				'countdown_title',
				[
					'label' 	=> esc_html__( 'Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Add Your Title', 'cryptlight' ),
					'condition' => [
						'show_title' => 'yes',
					],
				]
			);

		$this->end_controls_section();

		/* Begin Content Style */
		$this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 		=> 'content_background',
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'types' 	=> [ 'classic', 'gradient' ],
					'exclude' 	=> [ 'image' ],
					'selector' 	=> '{{WRAPPER}} .ova-warp-countdown .ova-content-countdown',
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'content_border',
	                'selector' 	=> '{{WRAPPER}} .ova-warp-countdown .ova-content-countdown',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'content_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-content-countdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-warp-countdown .ova-content-countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_control(
				'show_content_before',
				[
					'label' 	=> esc_html__( 'Before', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'no',
					'separator' => 'before',
				]
			);

			$this->add_control(
				'content_before_options',
				[
					'label' 	=> esc_html__( 'Before Options', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'condition' => [
						'show_content_before' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'content_before_width',
				[
					'label' 		=> esc_html__( 'Width', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
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
						'{{WRAPPER}} .ova-warp-countdown .countdown-before:before' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'show_content_before' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'content_before_height',
				[
					'label' 		=> esc_html__( 'Height', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
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
						'{{WRAPPER}} .ova-warp-countdown .countdown-before:before' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'show_content_before' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'content_before_top',
				[
					'label' 		=> esc_html__( 'Top', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'range' => [
						'px' => [
							'min' => -2000,
							'max' => 2000,
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
						'{{WRAPPER}} .ova-warp-countdown .countdown-before:before' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'show_content_before' => 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 		=> 'content_before_background',
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'types' 	=> [ 'classic', 'gradient' ],
					'exclude' 	=> [ 'image' ],
					'selector' 	=> '{{WRAPPER}} .ova-warp-countdown .countdown-before:before',
					'condition' => [
						'show_content_before' => 'yes',
					],
				]
			);

			$this->add_control(
				'content_after_options',
				[
					'label' 	=> esc_html__( 'After Options', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'show_content_before' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'content_after_width',
				[
					'label' 		=> esc_html__( 'Width', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
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
						'{{WRAPPER}} .ova-warp-countdown .countdown-before:after' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'show_content_before' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'content_after_height',
				[
					'label' 		=> esc_html__( 'Height', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
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
						'{{WRAPPER}} .ova-warp-countdown .countdown-before:after' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'show_content_before' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'content_after_bottom',
				[
					'label' 		=> esc_html__( 'Bottom', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ '%', 'px' ],
					'range' => [
						'px' => [
							'min' => -2000,
							'max' => 2000,
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
						'{{WRAPPER}} .ova-warp-countdown .countdown-before:after' => 'bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'show_content_before' => 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 		=> 'content_after_background',
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'types' 	=> [ 'classic', 'gradient' ],
					'exclude' 	=> [ 'image' ],
					'selector' 	=> '{{WRAPPER}} .ova-warp-countdown .countdown-before:after',
					'condition' => [
						'show_content_before' => 'yes',
					],
				]
			);

        $this->end_controls_section();

		/* Begin Boxes Style */
		$this->start_controls_section(
            'boxes_style',
            [
                'label' => esc_html__( 'Boxes', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );
        	$this->start_controls_tabs( 'tabs_boxes_style' );
				
				$this->start_controls_tab(
		            'tab_boxes_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'boxes_background',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .ova-number' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'boxes_color',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .ova-number' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_boxes_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'boxes_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item:hover .ova-number' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'boxes_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item:hover .ova-number' 		=> 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item:hover .countdown-label' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();


	        $this->add_responsive_control(
				'boxes_width',
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
							'max' => 2000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ '%', 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .ova-number' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'boxes_height',
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
							'max' => 2000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ '%', 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .ova-number' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'box_spacing',
				[
					'label' 	=> esc_html__( 'Space Between', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
	            'boxes_alignment',
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
	                    '{{WRAPPER}} .ova-warp-countdown' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'boxes_typography',
					'selector' 	=> '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .ova-number',
				]
			);

	        $this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'boxes_border',
	                'selector' 	=> '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .ova-number',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'boxes_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .ova-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'boxes_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .ova-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End Boxes Style */

		/* Begin Labels Style */
		$this->start_controls_section(
            'labels_style',
            [
                'label' => esc_html__( 'Labels', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_control(
	            'labels_color',
	            [
	                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .countdown-label' => 'color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'labels_typography',
					'selector' 	=> '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .countdown-label',
				]
			);

	        $this->add_responsive_control(
	            'labels_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .countdown-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'labels_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown .ova-countdown-item .countdown-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End Labels Style */

		/* Begin Message Style */
		$this->start_controls_section(
            'message_style',
            [
                'label' => esc_html__( 'Message', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_control(
	            'message_background',
	            [
	                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-message' => 'background-color: {{VALUE}};',
	                ],
	            ]
	        );

			$this->add_control(
	            'message_color',
	            [
	                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-message' => 'color: {{VALUE}};',
	                ],
	            ]
	        );

			$this->add_control(
	            'message_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
	                'type' 		=> Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'left' 	=> [
	                        'title' => __( 'Left', 'cryptlight' ),
	                        'icon' 	=> 'eicon-text-align-left',
	                    ],
	                    'right' 	=> [
	                        'title' => __( 'Right', 'cryptlight' ),
	                        'icon' 	=> 'eicon-text-align-right',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-message' => 'float: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'message_width',
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
						'{{WRAPPER}} .ova-warp-countdown .ova-message' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

	        $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'message_typography',
					'selector' 	=> '{{WRAPPER}} .ova-warp-countdown .ova-message',
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'message_border',
	                'selector' 	=> '{{WRAPPER}} .ova-warp-countdown .ova-message',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'message_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-message' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'message_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-message' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'message_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End Message Style */

		/* Begin title style */
		$this->start_controls_section(
			'countdown_title_style',
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
						'{{WRAPPER}} .ova-warp-countdown .ova-countdown-title' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
	            'countdown_title_alignment',
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
	                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown-title' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-warp-countdown .ova-countdown-title',
				]
			);

			$this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-warp-countdown .ova-countdown-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End title style */
	}

	private function get_evergreen_interval( $settings ) {
		$hours 		= empty( $settings['evergreen_counter_hours'] ) 	? 0 : ( $settings['evergreen_counter_hours'] * HOUR_IN_SECONDS );
		$minutes 	= empty( $settings['evergreen_counter_minutes'] ) 	? 0 : ( $settings['evergreen_counter_minutes'] * MINUTE_IN_SECONDS );
		$evergreen_interval = $hours + $minutes;

		return $evergreen_interval;
	}

	private function get_format( $settings ) {
		$format 		= $settings['countdown_format'];
		$show_day 		= $settings['show_days'];
		$show_hours 	= $settings['show_hours'];
		$show_minutes 	= $settings['show_minutes'];
		$show_seconds 	= $settings['show_seconds'];

		if ( 'yes' != $show_day ) {
			$format = str_replace( array( 'd', 'D' ) , '', $format );
		}

		if ( 'yes' != $show_hours ) {
			$format = str_replace( array( 'h', 'H' ) , '', $format );
		}

		if ( 'yes' != $show_minutes ) {
			$format = str_replace( array( 'm', 'M' ) , '', $format );
		}

		if ( 'yes' != $show_seconds ) {
			$format = str_replace( array( 's', 'S' ) , '', $format );
		}

		return $format;
	}

	private function get_labels( $settings ) {
		$labels = array();

		$label_day 		= $settings['label_day'] 		? $settings['label_day'] 		: 'Day';
		$label_days 	= $settings['label_days'] 		? $settings['label_days'] 		: 'Days';
		$label_hour 	= $settings['label_hour'] 		? $settings['label_hour'] 		: 'Hour';
		$label_hours 	= $settings['label_hours'] 		? $settings['label_hours'] 		: 'Hours';
		$label_minute 	= $settings['label_minute'] 	? $settings['label_minute'] 	: 'Minute';
		$label_minutes 	= $settings['label_minutes'] 	? $settings['label_minutes'] 	: 'Minutes';
		$label_second 	= $settings['label_second'] 	? $settings['label_second'] 	: 'Second';
		$label_seconds 	= $settings['label_seconds'] 	? $settings['label_seconds'] 	: 'Seconds';

		$labels = array(
			'label' 	=> array( 'Year', 'Month', 'Week', $label_day, $label_hour, $label_minute, $label_second ),
			'labels' 	=> array( 'Years', 'Months', 'Weeks', $label_days, $label_hours, $label_minutes, $label_seconds ),
		);
		
		return $labels;
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$type 		= $settings['countdown_type'];
		$due_date 	= $settings['due_date'];
		
		$time_now 	= current_time('timestamp', 1 );

		if ( 'evergreen' == $type ) {
			$due_date = $this->get_evergreen_interval( $settings ) + $time_now;
		} else {
			// Handle timezone ( Set GMT time )
			$gmt 		= get_gmt_from_date( $due_date . ':00' );
			$due_date 	= strtotime( $gmt );
		}

		$format 		= $this->get_format( $settings );
		$show_labels 	= $settings['show_labels'];

		$time_countdow 	= $due_date - $time_now;
		$redirect = false;
		if ( $time_countdow <= 0 && ! is_admin() ) {
			$redirect = true;
		}

		// Expire
		$expire_actions = $settings['expire_actions'];
		$message 		= $settings['message_after_expire'];
		$url	 		= $settings['expire_redirect_url']['url'];

		// Custom labels
		$label_align 	= $settings['label_align'];
		$custom_labels 	= $settings['custom_labels'];
		$labels 		= array();
		if ( $custom_labels && $custom_labels == 'yes' ) {
			$labels = $this->get_labels( $settings );
		}

		// Title
		$show_title 	= $settings['show_title'];
		$title 			= $settings['countdown_title'];

		// Content Before
		$content_before = $settings['show_content_before'];
		$before_class 	= '';
		if ( 'yes' == $content_before ) {
			$before_class = ' countdown-before';
		}

		?>
		<div class="ova-warp-countdown">
			<div class="ova-content-countdown<?php echo esc_attr( $before_class ); ?>">
				<?php if ( 'yes' == $show_title ): ?>
					<h2 class="ova-countdown-title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<div class="ova-countdown" 
					 data-time='<?php echo esc_attr( $due_date ); ?>'
					 data-format='<?php echo esc_attr( $format ); ?>'
					 data-show-lable='<?php echo esc_attr( $show_labels ); ?>'
					 data-message='<?php echo esc_attr( $message ); ?>'
					 data-url='<?php echo esc_url( $url ); ?>'
					 data-expire='<?php echo esc_html( $expire_actions ); ?>'
					 data-redirect='<?php echo esc_attr( $redirect ); ?>'
					 data-labels='<?php echo json_encode( $labels ); ?>'
					 data-label-align='<?php echo esc_html( $label_align ); ?>'>
				</div>

			<?php

			if ( $time_countdow <= 0 ) {
				if ( 'message' == $expire_actions ) {
					echo '<div class="ova-message">' . $message . '</div>';
				}
			}
			?>
			</div>
		</div>
		<?php
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_CountDown() );