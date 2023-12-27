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

class Cryptlight_Elementor_Road_Map_Advanced extends Widget_Base {
	
	public function get_name() {
		return 'cryptlight_elementor_road_map_advanced';
	}
	
	public function get_title() {
		return esc_html__( 'Road Map Advanced', 'cryptlight' );
	}
	
	public function get_icon() {
		return 'eicon-time-line';
	}
	
	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_script_depends() {
		wp_enqueue_script( 'cryptlight-road-map-advanced-appear', get_theme_file_uri('/assets/libs/appear/appear.js'), array('jquery'), false, true);
		return [ 'cryptlight-elementor-road-map-advanced' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		$this->start_controls_section(
			'section_road_map_advanced',
			[
				'label' => esc_html__( 'Road Map Advanced', 'cryptlight' ),
			]
		);	
			
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'date',
				[
					'label' 		=> esc_html__( 'Date', 'cryptlight' ),
					'type' 			=> Controls_Manager::DATE_TIME,
					'default'		=> date( 'Y-m-d', current_time('timestamp')),
					'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
				]
			);

			$repeater->add_control(
				'icon',
				[
					'label' 		=> esc_html__( 'Icon Class', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__('fas fa-check', 'cryptlight' ),
				]
			);

			$repeater->add_control(
				'title',
				[
					'label' 		=> esc_html__( 'Title', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__('Concept', 'cryptlight' ),
				]
			);

			$repeater->add_control(
				'content',
				[
					'label' 		=> esc_html__( 'Items', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXTAREA,
					'default' 		=> esc_html__('Concept Generation;Team Assemble', 'cryptlight' ),
					'description' 	=> esc_html__('Items are separated by semicolons(;)', 'cryptlight' ),
				]
			);

			$repeater->add_control(
				'done',
				[
					'label' 	=> esc_html__( 'Timeline Done', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'cryptlight' ),
					'label_off' => esc_html__( 'No', 'cryptlight' ),
					'default' 	=> 'no',
				]
			);

			$repeater->add_responsive_control(
				'animation_content',
				[
					'label' => esc_html__( 'Animation Content', 'cryptlight' ),
					'type' 	=> Controls_Manager::ANIMATION,
				]
			);

			$repeater->add_control(
				'animation_duration_content',
				[
					'label' 	=> esc_html__( 'Animation Duration', 'cryptlight' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> '',
					'options' 	=> [
						'slow' 	=> esc_html__( 'Slow', 'cryptlight' ),
						'' 		=> esc_html__( 'Normal', 'cryptlight' ),
						'fast' 	=> esc_html__( 'Fast', 'cryptlight' ),
					],
					'condition' => [
						'animation_content!' => '',
					],
				]
			);

			$repeater->add_control(
				'animation_delay_content',
				[
					'label' 	=> esc_html__( 'Animation Delay', 'cryptlight' ) . ' (ms)',
					'type' 		=> Controls_Manager::NUMBER,
					'default' 	=> '',
					'min' 		=> 0,
					'step' 		=> 100,
					'condition' => [
						'animation_content!' => '',
					],
				]
			);

			$this->add_control(
				'road_map_items',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'date' 		=> esc_html__( '2021-01-01', 'cryptlight' ),
							'icon'		=> esc_html__('fas fa-check', 'cryptlight' ),
							'title' 	=> esc_html__( 'Concept', 'cryptlight' ),
							'done' 		=> 'yes',
							'content' 	=> esc_html__( 'Concept Generation;Team Assemble', 'cryptlight' ),
						],
						[
							'date' 		=> esc_html__( '2021-03-01', 'cryptlight' ),
							'icon'		=> esc_html__('fas fa-check', 'cryptlight' ),
							'title' 	=> esc_html__( 'Research', 'cryptlight' ),
							'done' 		=> 'yes',
							'content' 	=> esc_html__( 'Concept Generation;Team Assemble', 'cryptlight' ),
						],
						[
							'date' 		=> esc_html__( '2021-05-01', 'cryptlight' ),
							'icon'		=> esc_html__('fas fa-check', 'cryptlight' ),
							'title' 	=> esc_html__( 'Pre-Sale', 'cryptlight' ),
							'done' 		=> 'yes',
							'content' 	=> esc_html__( 'Concept Generation;Team Assemble', 'cryptlight' ),
						],
						[
							'date' 		=> esc_html__( '2021-07-01', 'cryptlight' ),
							'icon'		=> esc_html__('fas fa-check', 'cryptlight' ),
							'title' 	=> esc_html__( 'App beta test', 'cryptlight' ),
							'done' 		=> 'no',
							'content' 	=> esc_html__( 'Concept Generation;Team Assemble', 'cryptlight' ),
						],
						[
							'date' 		=> esc_html__( '2021-09-01', 'cryptlight' ),
							'icon'		=> esc_html__('fas fa-check', 'cryptlight' ),
							'title' 	=> esc_html__( 'Token sale', 'cryptlight' ),
							'done' 		=> 'no',
							'content' 	=> esc_html__( 'Concept Generation;Team Assemble', 'cryptlight' ),
						],
						[
							'date' 		=> esc_html__( '2021-11-01', 'cryptlight' ),
							'icon'		=> esc_html__('fas fa-check', 'cryptlight' ),
							'title' 	=> esc_html__( 'Alpha test', 'cryptlight' ),
							'done' 		=> 'no',
							'content' 	=> esc_html__( 'Concept Generation;Team Assemble', 'cryptlight' ),
						],
						[
							'date' 		=> esc_html__( '2022-01-01', 'cryptlight' ),
							'icon'		=> esc_html__('fas fa-check', 'cryptlight' ),
							'title' 	=> esc_html__( 'Benefits', 'cryptlight' ),
							'done' 		=> 'no',
							'content' 	=> esc_html__( 'Concept Generation;Team Assemble', 'cryptlight' ),
						],
						[
							'date' 		=> esc_html__( '2022-03-01', 'cryptlight' ),
							'icon'		=> esc_html__('fas fa-check', 'cryptlight' ),
							'title' 	=> esc_html__( 'Operational', 'cryptlight' ),
							'done' 		=> 'no',
							'content' 	=> esc_html__( 'Concept Generation;Team Assemble', 'cryptlight' ),
						],
						
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		/* Begin Date Style */
		$this->start_controls_section(
            'date_style',
            [
                'label' => esc_html__( 'Date', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'date_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-date .date, {{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items .timeline-info .timeline-date .date',
				]
			);

			$this->add_control(
	            'date_color',
	            [
	                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-date .date' => 'color: {{VALUE}}',
	                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items .timeline-info .timeline-date .date' => 'color: {{VALUE}}',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Date Style */

        /* Begin Icon Style */
		$this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline-done .timeline-icon .icon i, {{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items.timeline-done-mb .timeline-icon .icon i',
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
			            'icon_border_color_normal',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-icon .icon' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items .timeline-icon .icon' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-icon .icon' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items .timeline-icon .icon' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'dots_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background Dots', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-icon .icon:before' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items .timeline-icon .icon:before' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_mobile_line_color',
			            [
			                'label' 	=> esc_html__( 'Mobile Line Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items .timeline-icon .icon:after' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_icon_done',
		            [
		                'label' => esc_html__( 'Done', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'icon_border_color_done',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline-done .timeline-icon .icon' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline-done-odd .timeline-icon .icon' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline-done-even .timeline-icon .icon' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline_done_next_desktop .timeline-icon .icon' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items.timeline-done-mb .timeline-icon .icon' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items.timeline_done_next_mobile .timeline-icon .icon' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'icon_background_done',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline-done .timeline-icon .icon' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline-done-odd .timeline-icon .icon' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline-done-even .timeline-icon .icon' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline_done_next_desktop .timeline-icon .icon' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items.timeline-done-mb .timeline-icon .icon' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items.timeline_done_next_mobile .timeline-icon .icon' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

					$this->add_control(
			            'icon_color_done',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline-done .timeline-icon .icon i' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline-done-odd .timeline-icon .icon i' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline-done-even .timeline-icon .icon i' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item.timeline_done_next_desktop .timeline-icon .icon i' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items.timeline-done-mb .timeline-icon .icon i' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items.timeline_done_next_mobile .timeline-icon .icon i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

        $this->end_controls_section();
        /* End Icon Style */

        /* Begin Line Style */
		$this->start_controls_section(
            'line_style',
            [
                'label' => esc_html__( 'Line', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->start_controls_tabs( 'tabs_line_style' );

				$this->start_controls_tab(
		            'tab_line_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'line_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(odd) .timeline-item:before' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(odd) .timeline-item:last-child:after' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(even) .timeline-item:last-child:before' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(even) .timeline-item:after' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(even) .timeline-item:first-child:before' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(odd) .timeline-item:first-child:after' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items:before' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_line_done',
		            [
		                'label' => esc_html__( 'Done', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'line_background_done',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(odd) .timeline-item.timeline-done:before' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(odd) .timeline-item.timeline-done:after' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(even) .timeline-item:last-child.timeline-done-even:before' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(even) .timeline-item.timeline-done:after' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(even) .timeline-item.timeline-done:first-child:before' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row:nth-of-type(odd) .timeline-item:first-child.timeline-done-odd:after' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items.timeline-done-mb:before' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

        $this->end_controls_section();
        /* End Line Style */

        /* Begin Content Style */
		$this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__( 'Content', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_control(
				'content_style_desktop',
				[
					'label' => esc_html__( 'Only in Desktop', 'cryptlight' ),
					'type' 	=> Controls_Manager::HEADING,
				]
			);

        	$this->start_controls_tabs( 'tabs_content_style' );

				$this->start_controls_tab(
		            'tab_content_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'content_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_content_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'content_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'content_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color Hover', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content:hover' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'content_border',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content',
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
	                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'content_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content',
				]
			);

        $this->end_controls_section();
        /* End Content Style */

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
					'selector' 	=> '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content .title, {{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items .timeline-info .timeline-content .title',
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
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content .title' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items .timeline-info .timeline-content .title' => 'color: {{VALUE}}',
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
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content:hover .title' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

        $this->end_controls_section();
        /* End Content Style */

        /* Begin Text Style */
		$this->start_controls_section(
            'text_style',
            [
                'label' => esc_html__( 'Text', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'text_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content .content .text, {{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items .timeline-info .timeline-content .content .text',
				]
			);

        	$this->start_controls_tabs( 'tabs_text_style' );

				$this->start_controls_tab(
		            'tab_text_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'text_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content .content .text' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items .timeline-info .timeline-content .content .text' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_text_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'text_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced .timeline-row .timeline-item .timeline-content:hover .content .text' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'text_style_mobile',
				[
					'label' 	=> esc_html__( 'Only in Mobile', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'text_border_mobile',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-advanced .road-map-advanced-mobile .timeline-items .timeline-info .timeline-content .content .text:not(:last-child)',
	            ]
	        );

        $this->end_controls_section();
        /* End Content Style */

	}

	protected function get_array_by_scale( $args ) {
		$result 	= [];

		if ( $args && is_array( $args ) ) {
			$flag 	= 3;
			$count 	= $i = 0;

			foreach( $args as $k => $item ) {

				if ( $flag == 3 && $count > 2 ) {
					$i++;
					$flag 	= 2;
					$count 	= 0;
				}

				if ( $flag == 2 && $count > 1 ) {
					$i++;
					$flag 	= 3;
					$count 	= 0;
				}

				$result[$i][] = $item;
				$count++;
			}
		}

		return $result;
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		// Get road map array
		$args 		= $settings['road_map_items'];

		// Split $args by scale 3:2
		$road_map 	= $this->get_array_by_scale( $args );

		?>
		<?php if ( $road_map && is_array( $road_map ) ): 
			$timeline_done_odd 	= '';
			$timeline_done_even = '';
			$timeline_done_next_desktop = '';
			$timeline_done_next_mobile	= '';
		?>
		 	<div class="ova-road-map-advanced">
		 		<!-- Desktop -->
		 		<div class="road-map-advanced">
		 			<?php foreach( $road_map as $k => $items ): 
		 				$count_items 	= count( $items );
		 				$timeline_class = 'timeline-row-odd';
		 				if ( $k % 2 != 0 ) {
		 					$items = array_reverse( $items );
		 					$timeline_class = 'timeline-row-even';
		 				}
		 			?>
		 				<div class="timeline-row <?php echo esc_attr( $timeline_class ); ?>">
		 					<?php foreach( $items as $i => $item ): 
		 						$time_stamp 	= strtotime( $item['date'] );
								$month 			= date_i18n('F', $time_stamp);
								$year 			= date_i18n('Y', $time_stamp);
								$icon 			= $item['icon'];
								$title 			= $item['title'];
								$content 		= $item['content'];
								$content_args 	= array();
								if ( $content ) {
									$content_args = explode(";", $content);
								}
								$done 			= 'yes' == $item['done'] ? ' timeline-done' : '';

								/* Check timeline-done last item */
								// even item
								if ( $k % 2 == 0 && $count_items == ( $i + 1 ) ) {
									$timeline_done_even = 'yes' == $item['done'] ? ' timeline-done-even' : '';
								}

								if ( $k % 2 != 0 && $i == 0 ) {
									$timeline_done_odd = 'yes' == $item['done'] ? ' timeline-done-odd' : '';
								}

								if ( $k % 2 == 0 ) {
									if ( 'yes' == $item['done'] ) {
										$timeline_done_next_desktop = '';
									}
								}
								 if ( $k % 2 != 0 ) {
								 	if ( isset( $items[1]['done'] ) && 'yes' == $items[1]['done'] ) {
								 		$timeline_done_next_desktop = ' timeline_done_next_desktop';
								 	} else {
								 		$timeline_done_next_desktop = '';
								 	}
								 }

								//Animation Content
								$animation_content 	= $item['animation_content'];
								$duration_content 	= $item['animation_duration_content'];
								$delay_content		= $item['animation_delay_content'];

								$data_animation_content = array(
									'animation' => $animation_content,
									'duration' 	=> $duration_content,
									'delay' 	=> $delay_content,
								);
								
		 					?>
	 						<?php if ( $k % 2 != 0 && $count_items == ( $i + 1 ) ): ?>
	 							<div class="timeline-item<?php echo esc_attr( $done ); ?><?php echo esc_attr( $timeline_done_even ); ?>">
	 						<?php elseif ( $k % 2 == 0 && $i == 0 ): ?>
	 							<div class="timeline-item<?php echo esc_attr( $done ); ?><?php echo esc_attr( $timeline_done_odd ); ?>">
		 					<?php else: ?>
		 						<div class="timeline-item<?php echo esc_attr( $done ); ?><?php echo esc_attr( $timeline_done_next_desktop ); ?>">
 							<?php endif; ?>
		 							<div class="timeline-date">
		 								<h2 class="date"><?php echo esc_html( $month ) . ' ' . esc_html( $year ); ?></h2>
		 							</div>
		 							<div class="timeline-icon">
		 								<div class="icon">
		 									<i class="<?php echo esc_attr( $icon ); ?>"></i>
		 								</div>
		 							</div>
		 							<div class="timeline-content<?php if ( $animation_content ) echo ' ova-invisible'; ?>"
		 								 data-animation='<?php echo json_encode( $data_animation_content ); ?>'>
		 								<h2 class="title"><?php echo esc_html( $title ); ?></h2>
		 								<?php if ( $content_args ): ?>
		 									<ul class="content">
		 										<?php foreach( $content_args as $text ): ?>
		 											<li class="text"><?php echo esc_html( $text ); ?></li>
	 											<?php endforeach; ?>
		 									</ul>
		 								<?php endif; ?>
		 							</div>
		 						</div>
	 						<?php
	 							if ( $k % 2 == 0 ) {
									$timeline_done_next_desktop = 'yes' == $item['done'] ? ' timeline_done_next_desktop' : '';
								}
	 							endforeach;
	 						?>
		 				</div>
		 			<?php endforeach; ?>
		 		</div>
		 		<!-- End Desktop -->
		 		<!-- Mobile -->
		 		<div class="road-map-advanced-mobile">
		 			<?php foreach( $args as $mb_items ): 
		 				$mb_time_stamp 	= strtotime( $mb_items['date'] );
						$mb_month 			= date_i18n('F', $mb_time_stamp);
						$mb_year 			= date_i18n('Y', $mb_time_stamp);
						$mb_icon 			= $mb_items['icon'];
						$mb_title 			= $mb_items['title'];
						$mb_content 		= $mb_items['content'];
						$mb_content_args 	= array();
						if ( $mb_content ) {
							$mb_content_args = explode(";", $mb_content);
						}

						$mb_done 			= 'yes' == $mb_items['done'] ? ' timeline-done-mb' : '';

						if ( 'yes' == $mb_items['done'] ) {
							$timeline_done_next_mobile = '';
						}
		 			?>
		 				<div class="timeline-items<?php echo esc_attr( $mb_done ); ?><?php echo esc_attr( $timeline_done_next_mobile ); ?>">
		 					<div class="timeline-icon">
		 						<div class="icon">
		 							<i class="<?php echo esc_attr( $mb_icon ); ?>"></i>
		 						</div>
		 					</div>
		 					<div class="timeline-info">
		 						<div class="timeline-date">
		 							<h2 class="date"><?php echo esc_html( $mb_month ) . ' ' . esc_html( $mb_year ); ?></h2>
	 							</div>
		 						<div class="timeline-content">
		 							<h2 class="title"><?php echo esc_html( $mb_title ); ?></h2>
		 							<?php if ( $mb_content_args ): ?>
			 							<ul class="content">
			 								<?php foreach( $mb_content_args as $mb_text ): ?>
			 									<li class="text"><?php echo esc_html( $mb_text ); ?></li>
			 								<?php endforeach; ?>
			 							</ul>
			 						<?php endif; ?>
		 						</div>
		 					</div>
		 				</div>
		 			<?php 
		 				$timeline_done_next_mobile = 'yes' == $mb_items['done'] ? ' timeline_done_next_mobile' : '';
		 				endforeach;
		 			?>
		 		</div>
		 		<!-- End Mobile -->
		 	</div>
		<?php
		endif;
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Road_Map_Advanced() );