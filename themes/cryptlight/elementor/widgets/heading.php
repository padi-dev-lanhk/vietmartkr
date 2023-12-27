<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Cryptlight_Elementor_Heading extends Widget_Base {

	
	public function get_name() {
		return 'cryptlight_elementor_heading';
	}

	public function get_title() {
		return esc_html__( 'Heading', 'cryptlight' );
	}

	public function get_icon() {
		return 'eicon-t-letter';
	}

	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		/* Begin section heading */
		$this->start_controls_section(
			'section_heading',
			[
				'label' => esc_html__( 'Heading', 'cryptlight' ),
			]
		);	
			
			
			// Add Class control
			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Add Your Heading', 'cryptlight' ),
				]
			);

			$this->add_control(
				'bg_title',
				[
					'label' 	=> esc_html__( 'Background Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'no',
				]
			);

			$this->add_control(
				'bg_text',
				[
					'label' 	=> esc_html__( 'Text', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Add Your Heading', 'cryptlight' ),
					'condition' => [
						'bg_title' => 'yes',
					],
				]
			);

			$this->add_control(
				'description',
				[
					'label' 	=> esc_html__( 'Description', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXTAREA,
					'default' 	=> esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'cryptlight' ),
				]
			);

			$this->add_control(
				'link',
				[
					'label' 	=> esc_html__( 'Link', 'cryptlight' ),
					'type' 		=> Controls_Manager::URL,
					'dynamic' 	=> [
						'active' => true,
					],
					'default' 	=> [
						'url' 	=> '',
					],
					'separator' => 'before',
				]
			);

			$this->add_control(
				'header_size',
				[
					'label' 	=> esc_html__( 'HTML Tag', 'cryptlight' ),
					'type' 		=> Controls_Manager::SELECT,
					'options' 	=> [
						'h1' 	=> 'H1',
						'h2' 	=> 'H2',
						'h3' 	=> 'H3',
						'h4' 	=> 'H4',
						'h5' 	=> 'H5',
						'h6' 	=> 'H6',
						'div' 	=> 'div',
						'span' 	=> 'span',
						'p' 	=> 'p',
					],
					'default' 	=> 'h2',
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' => esc_html__( 'Left', 'cryptlight' ),
							'icon' 	=> 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'cryptlight' ),
							'icon' 	=> 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'cryptlight' ),
							'icon' 	=> 'eicon-text-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'Justified', 'cryptlight' ),
							'icon' 	=> 'eicon-text-align-justify',
						],
					],
					'default' 	=> '',
					'selectors' => [
						'{{WRAPPER}} .ova-heading' 				=> 'text-align: {{VALUE}};',
						'{{WRAPPER}} .ova-heading-description' 	=> 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'show_line',
				[
					'label' 	=> esc_html__( 'Line', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'yes',
				]
			);

			$this->add_control(
				'type_line',
				[
					'label' 	=> esc_html__( 'Type', 'cryptlight' ),
					'type' 		=> Controls_Manager::SELECT,
					'options' 	=> [
						'ova_before' 	=> esc_html__( 'Before', 'cryptlight' ),
						'ova_after' 	=> esc_html__( 'After', 'cryptlight' ),
						'ova_top' 		=> esc_html__( 'Top', 'cryptlight' ),
						'ova_botton' 	=> esc_html__( 'Buttom', 'cryptlight' ),
						'ova_both' 		=> esc_html__( 'Both', 'cryptlight' ),
					],
					'default' 	=> 'ova_before',
					'condition' => [
						'show_line' => 'yes',
					],
				]
			);

		$this->end_controls_section();
		/* End section heading */

		/* Begin title Style */
		$this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
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
			                    '{{WRAPPER}} .ova-heading' 	=> 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading a' 	=> 'color: {{VALUE}};',
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
			                    '{{WRAPPER}} .ova-heading:hover' 	=> 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading:hover a' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'heading_linear_gradient',
				[
					'label' 	=> esc_html__( 'Linear Gradient', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'no',
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 		=> 'heading_bg_gradient_normal',
					'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
					'types' 	=> [ 'gradient' ],
					'selector' 	=> '{{WRAPPER}} .ova-heading.heading-linear-gradient',
					'condition' => [
						'heading_linear_gradient' => 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-heading',
				]
			);

			$this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 		=> 'text_shadow',
					'label' 	=> esc_html__( 'Text Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-heading',
				]
			);

        $this->end_controls_section();
		/* End title style */

		/* Begin background title Style */
		$this->start_controls_section(
            'bg_title_style',
            [
                'label' 	=> esc_html__( 'Background Title', 'cryptlight' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
                'condition' => [
                	'bg_title' 	=> 'yes',
                	'bg_text!' 	=> '',
                ],
            ]
        );

        	$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 		=> 'bg_title_gradient_normal',
					'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
					'types' 	=> [ 'gradient' ],
					'selector' 	=> '{{WRAPPER}} .ova-heading-bg-title',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'bg_title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-heading-bg-title',
				]
			);

			$this->add_responsive_control(
				'bg_title_top',
				[
					'label' 		=> esc_html__( 'Top', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> -1000,
							'max' 	=> 1000,
							'step' 	=> 5,
						],
						'%' => [
							'min' 	=> -100,
							'max' 	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-heading-bg-title' => 'top: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'bg_title_left',
				[
					'label' 		=> esc_html__( 'Left', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> -1000,
							'max' 	=> 1000,
							'step' 	=> 5,
						],
						'%' => [
							'min' 	=> -100,
							'max' 	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-heading-bg-title' => 'left: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
	            'bg_title_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-heading-bg-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_control(
				'bg_title_opacity',
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
						'{{WRAPPER}} .ova-heading-bg-title' => 'opacity: {{SIZE}}',
					],
				]
			);

        $this->end_controls_section();
		/* End background title style */

		/* Begin line Style */
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
			            'line_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-heading .ova_before' 			=> 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading .ova_both_before' 	=> 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading .ova_both_after' 		=> 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading .ova_after' 			=> 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading.ova_top:before' 		=> 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading.ova_botton:before' 	=> 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_line_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'line_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-heading:hover .ova_before' 			=> 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading:hover .ova_both_before' 		=> 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading:hover .ova_after' 			=> 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading:hover .ova_both_after' 		=> 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading:hover.ova_top:before' 		=> 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-heading:hover.ova_botton:before' 		=> 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'line_border',
	                'selector' 	=> '{{WRAPPER}} .ova-heading.ova_top:before, {{WRAPPER}} .ova-heading.ova_botton:before',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'line_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-heading.ova_top:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-heading.ova_botton:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'line_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-heading .ova_before' 			=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-heading .ova_after' 			=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-heading.ova_top:before' 		=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-heading.ova_botton:before' 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' 	=> [
	                	'type_line!' => 'ova_both'
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'line_margin_before',
	            [
	                'label' 		=> esc_html__( 'Margin Before', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-heading .ova_both_before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' 	=> [
	                	'type_line' => 'ova_both'
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'line_margin_after',
	            [
	                'label' 		=> esc_html__( 'Margin After', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-heading .ova_both_after' 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' 	=> [
	                	'type_line' => 'ova_both'
	                ],
	            ]
	        );

	        $this->add_control(
				'line_left',
				[
					'label' 		=> esc_html__( 'Left', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 5,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-heading.ova_top:before' 		=> 'left: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-heading.ova_botton:before' 	=> 'left: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'type_line' => [ 'ova_top', 'ova_botton' ],
					],
				]
			);

			$this->add_control(
				'line_top',
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
						'{{WRAPPER}} .ova-heading.ova_top:before' => 'top: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'type_line' => [ 'ova_top' ],
					],
				]
			);

			$this->add_control(
				'line_bottom',
				[
					'label' 		=> esc_html__( 'Bottom', 'cryptlight' ),
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
						'{{WRAPPER}} .ova-heading.ova_botton:before' => 'bottom: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'type_line' => [ 'ova_botton' ],
					],
				]
			);

	        $this->add_responsive_control(
				'line_width',
				[
					'label' 		=> esc_html__( 'Width', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 5,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-heading .ova_before' 			=> 'width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-heading .ova_after' 			=> 'width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-heading .ova_both_before' 	=> 'width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-heading .ova_both_after' 		=> 'width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-heading.ova_top:before' 		=> 'width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-heading.ova_botton:before' 	=> 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'line_height',
				[
					'label' 		=> esc_html__( 'Height', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 100,
							'step' 	=> 5,
						],
						'%' => [
							'min' 	=> 0,
							'max' 	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-heading .ova_before' 			=> 'height: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-heading .ova_after' 			=> 'height: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-heading .ova_both_before' 	=> 'height: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-heading .ova_both_after' 		=> 'height: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-heading.ova_top:before' 		=> 'height: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .ova-heading.ova_botton:before' 	=> 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
	            'linbe_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-heading .ova_both_before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-heading .ova_both_after' 	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' 	=> [
	                	'type_line' => 'ova_both'
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End line style */

		/* Begin description Style */
		$this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );
				
        	$this->add_control(
	            'description_color',
	            [
	                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-heading-description' => 'color: {{VALUE}};',
	                ],
	            ]
	        );

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .ova-heading-description',
				]
			);

			$this->add_responsive_control(
	            'description_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-heading-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'description_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-heading-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 		=> 'text_shadow_description',
					'label' 	=> esc_html__( 'Text Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-heading-description',
				]
			);

        $this->end_controls_section();
		/* End description style */
		
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$title 		= $settings['title'];
		$des 		= $settings['description'];
		$link 		= $settings['link']['url'];

		$tg_blank 	= '';
		if ( $settings['link']['is_external'] == 'on' ) {
			$tg_blank = 'target="_blank"';
		}

		$size		= $settings['header_size'];
		$show_line 	= $settings['show_line'];
		$type_line 	= '';
		if ( 'yes' == $show_line ) {
			$type_line 	= $settings['type_line'];
		}

		$heading_linear_gradient = $settings['heading_linear_gradient'];
		$linear_gradient 		 = '';
		if ( 'yes' == $heading_linear_gradient ) {
			$linear_gradient 	= ' heading-linear-gradient';
		}

		$bg_title = $settings['bg_title'];
		$bg_text  = $settings['bg_text'];


		?>
		<div class="ova-heading-content">
			<<?php echo esc_html( $size ); ?> class="ova-heading<?php echo esc_attr( $linear_gradient ); ?> <?php echo esc_html( $type_line ); ?>">

				<?php if ( 'ova_before' == $type_line ): ?>
					<span class="<?php echo esc_html( $type_line ); ?>"></span>
				<?php endif; ?>

				<?php if ( 'ova_both' == $type_line ): ?>
					<span class="<?php echo esc_attr( $type_line ) . '_before'; ?>"></span>
				<?php endif; ?>

				<?php if ( $link ): ?>
					<a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $title ); ?></a>
				<?php else: echo esc_html( $title ); ?>
				<?php endif; ?>

				<?php if ( 'ova_both' == $type_line ): ?>
					<span class="<?php echo esc_attr( $type_line ) . '_after'; ?>"></span>
				<?php endif; ?>

				<?php if ( 'ova_after' == $type_line ): ?>
					<span class="<?php echo esc_html( $type_line ); ?>"></span>
				<?php endif; ?>

			</<?php echo esc_html( $size ); ?>>

			<?php if ( 'yes' == $bg_title && ! empty( $bg_text ) ): ?>
				<div class="ova-heading-bg-title"><?php echo esc_html( $bg_text ); ?></div>
			<?php endif; ?>

			<?php if ( $des ): ?>
					<p class="ova-heading-description"><?php echo esc_html( $des ); ?></p>
			<?php endif; ?>
		</div>
		 	
		<?php
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Heading() );