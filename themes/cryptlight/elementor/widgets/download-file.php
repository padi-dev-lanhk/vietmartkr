<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cryptlight_Elementor_Download_File extends Widget_Base {
	
	public function get_name() {
		return 'cryptlight_elementor_download_file';
	}
	
	public function get_title() {
		return esc_html__( 'Download File', 'cryptlight' );
	}
	
	public function get_icon() {
		return 'eicon-file-download';
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
			'section_download_file',
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
	                ],
	                'default' 	=> 'v1',
	            ]
	        );

			$this->add_control(
				'image',
				[
					'label' 	=> esc_html__( 'Choose Image', 'cryptlight' ),
					'type' 		=> Controls_Manager::MEDIA,
					'default' 	=> [
						'url' 	=> Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'title',
				[
					'label' 		=> esc_html__( 'Title', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'White paper', 'cryptlight' ),
					'placeholder'	=> esc_html__( 'Type your title here', 'cryptlight' ),
				]
			);

			$this->add_control(
				'description',
				[
					'label' 		=> esc_html__( 'Description', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( '-2021-', 'cryptlight' ),
					'placeholder'	=> esc_html__( 'Type your description here', 'cryptlight' ),
				]
			);

			$this->add_control(
				'icon_class',
				[
					'label' 		=> esc_html__( 'Icon Class', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( 'iconly-Download icbo', 'cryptlight' ),
				]
			);

			$this->add_control(
				'download_link',
				[
					'label' 		=> esc_html__( 'Link', 'cryptlight' ),
					'type' 			=> Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'https://your-link.com', 'cryptlight' ),
					'default' => [
						'url' => '#',
					],
				]
			);

			$this->add_control(
				'text_language',
				[
					'label' 		=> esc_html__( 'Language Text', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__( '(English)', 'cryptlight' ),
				]
			);

		$this->end_controls_section();

		/* Begin Image Style */
		$this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__( 'Image', 'cryptlight' ),
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
						'{{WRAPPER}} .ova-download-file .ova-img img' => 'width: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-download-file .ova-img img' => 'max-width: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .ova-download-file .ova-img img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

	        $this->add_control(
	            'image_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-download-file .ova-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_control(
	            'image_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-download-file .ova-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'image_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-download-file .ova-img img',
				]
			);

			$this->add_control(
				'image_before',
				[
					'label' 	=> esc_html__( 'Before Options', 'plugin-name' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_control(
					'show_before',
					[
						'label' 	=> esc_html__( 'Show Before', 'cryptlight' ),
						'type' 		=> Controls_Manager::SWITCHER,
						'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
						'label_off' => esc_html__( 'Hide', 'cryptlight' ),
						'default' 	=> 'yes',
					]
				);

				$this->add_responsive_control(
					'before_width',
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
							'{{WRAPPER}} .ova-download-file .ova-img.show-before:before' => 'width: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
							'show_before' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'before_height',
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
						],
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-download-file .ova-img.show-before:before' => 'height: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
							'show_before' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'before_top',
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
								'min' => -500,
								'max' => 500,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-download-file .ova-img.show-before:before' => 'top: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
							'show_before' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'before_left',
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
								'min' => -500,
								'max' => 500,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-download-file .ova-img.show-before:before' => 'left: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
							'show_before' => 'yes',
						],
					]
				);

				$this->add_control(
		            'before_background',
		            [
		                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
		                'type' 		=> Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .ova-download-file .ova-img.show-before:before' => 'background-color: {{VALUE}};',
		                ],
		                'condition' => [
							'show_before' => 'yes',
						],
		            ]
		        );

		        $this->add_control(
		            'before_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
		                'type' 			=> Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .ova-download-file .ova-img.show-before:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' 	=> [
							'show_before' => 'yes',
						],
		            ]
		        );

		    $this->add_control(
				'image_after',
				[
					'label' 	=> esc_html__( 'After Options', 'plugin-name' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_control(
					'show_after',
					[
						'label' 	=> esc_html__( 'Show After', 'cryptlight' ),
						'type' 		=> Controls_Manager::SWITCHER,
						'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
						'label_off' => esc_html__( 'Hide', 'cryptlight' ),
						'default' 	=> 'yes',
					]
				);

				$this->add_responsive_control(
					'after_width',
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
							'{{WRAPPER}} .ova-download-file .ova-img.show-after:after' => 'width: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
							'show_after' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'after_height',
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
						],
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-download-file .ova-img.show-after:after' => 'height: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
							'show_after' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'after_bottom',
					[
						'label' 	=> esc_html__( 'Bottom', 'cryptlight' ),
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
								'min' => -500,
								'max' => 500,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-download-file .ova-img.show-after:after' => 'bottom: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
							'show_after' => 'yes',
						],
					]
				);

				$this->add_responsive_control(
					'after_left',
					[
						'label' 	=> esc_html__( 'Right', 'cryptlight' ),
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
								'min' => -500,
								'max' => 500,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-download-file .ova-img.show-after:after' => 'right: {{SIZE}}{{UNIT}};',
						],
						'condition' 	=> [
							'show_after' => 'yes',
						],
					]
				);

				$this->add_control(
		            'after_background',
		            [
		                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
		                'type' 		=> Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .ova-download-file .ova-img.show-after:after' => 'background-color: {{VALUE}};',
		                ],
		                'condition' => [
							'show_after' => 'yes',
						],
		            ]
		        );

		        $this->add_control(
		            'after_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
		                'type' 			=> Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .ova-download-file .ova-img.show-after:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' 	=> [
							'show_after' => 'yes',
						],
		            ]
		        );

        $this->end_controls_section();
		/* End Image Style */

		/* Begin Title Section Style */
		$this->start_controls_section(
            'title_section_style',
            [
                'label' => esc_html__( 'Title', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-download-file .title',
				]
			);

			$this->add_control(
	            'title_color',
	            [
	                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-download-file .title' => 'color: {{VALUE}}',
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
	                    '{{WRAPPER}} .ova-download-file .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End Title Section Style */

		/* Begin Description Section Style */
		$this->start_controls_section(
            'description_section_style',
            [
                'label' => esc_html__( 'Description', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .ova-download-file .description',
				]
			);

			$this->add_control(
	            'description_color',
	            [
	                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-download-file .description' => 'color: {{VALUE}}',
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
	                    '{{WRAPPER}} .ova-download-file .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End Title Section Style */

		/* Begin Button Icon Section Style */
		$this->start_controls_section(
            'btn_icon_section_style',
            [
                'label' => esc_html__( 'Button Icon', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'btn_icon_typography',
					'selector' 	=> '{{WRAPPER}} .ova-download-file .icon-btn a i',
				]
			);

        	$this->start_controls_tabs( 'tabs_btn_icon_style' );
				
				$this->start_controls_tab(
		            'tab_btn_icon_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'btn_icon_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-download-file .icon-btn a' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'btn_icon_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-download-file .icon-btn a i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_btn_icon_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'btn_icon_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-download-file .icon-btn a:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'btn_icon_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-download-file .icon-btn a:hover i' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'btn_icon_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-download-file .icon-btn a:hover' => 'border-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'btn_icon_border',
	                'selector' 	=> '{{WRAPPER}} .ova-download-file .icon-btn a',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'btn_icon_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-download-file .icon-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_control(
	            'btn_icon_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-download-file .icon-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'btn_icon_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-download-file .icon-btn a',
				]
			);

        $this->end_controls_section();
		/* End Button Icon Section Style */


		/* Begin Language Section Style */
		$this->start_controls_section(
            'language_section_style',
            [
                'label' => esc_html__( 'Language Text', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'language_typography',
					'selector' 	=> '{{WRAPPER}} .ova-download-file .text-language',
				]
			);

			$this->add_control(
	            'language_color',
	            [
	                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-download-file .text-language' => 'color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'language_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-download-file .text-language' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End Language Section Style */
	}

	// Render Template Here
	protected function render() {

		$settings 		= $this->get_settings();

		$type 			= $settings['type'];
		$image_url 		= $settings['image']['url'];
		$alt 			= isset( $settings['image']['alt'] ) ? $settings['image']['alt'] : esc_html( 'image', 'cryptlight' );

		if ( ! $alt ) {
			$alt = $settings['title'] ? $settings['title'] : esc_html( 'image', 'cryptlight' );
		}
		
		$title 			= $settings['title'];
		$description 	= $settings['description'];
		$icon_class 	= $settings['icon_class'];
		$download_link 	= $settings['download_link']['url'];
		$text_language 	= $settings['text_language'];
		$show_before 	= 'yes' == $settings['show_before'] ? ' show-before' : '';
		$show_after		= 'yes' == $settings['show_after'] ? ' show-after' : '';
		?>

		<div class="ova-download-file">
			<?php if ( $image_url ): ?>
				<div class="ova-img<?php echo esc_attr( $show_before ); ?><?php echo esc_attr( $show_after ); ?>">
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
				</div>
			<?php endif; ?>
			<?php if ( $title ): ?>
				<h2 class="title"><?php echo esc_html( $title ); ?></h2>
			<?php endif; ?>
			<?php if ( $description ): ?>
				<p class="description"><?php echo esc_html( $description ); ?></p>
			<?php endif; ?>
			<?php if ( $icon_class ): ?>
				<div class="icon-btn">
					<a href="<?php echo esc_url( $download_link ); ?>" download>
						<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
					</a>
				</div>
			<?php endif; ?>
			<?php if ( $text_language ): ?>
				<p class="text-language"><?php echo esc_html( $text_language ); ?></p>
			<?php endif; ?>
		</div>
		 	
		<?php
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Download_File() );