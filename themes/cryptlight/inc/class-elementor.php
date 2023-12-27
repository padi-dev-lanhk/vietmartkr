<?php

class Cryptlight_Elementor {
	
	function __construct() {
            
		// Register Header Footer Category in Pane
	    add_action( 'elementor/elements/categories_registered', array( $this, 'cryptlight_add_category' ) );

	    add_action( 'elementor/frontend/after_register_scripts', array( $this, 'cryptlight_enqueue_scripts' ) );
		
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'cryptlight_include_widgets' ) );
		
		add_filter( 'elementor/controls/animations/additional_animations', array( $this, 'cryptlight_add_animations'), 10 , 0 );
		
		add_action( 'elementor/element/tabs/section_tabs_style/before_section_start', array( $this, 'cryptlight_tabs_custom' ), 10, 2 );

		add_action( 'elementor/element/accordion/section_title_style/before_section_start', array( $this, 'cryptlight_accordion_custom' ), 10, 2 );

		add_action( 'elementor/element/toggle/section_toggle_style/before_section_start', array( $this, 'cryptlight_toggle_custom' ), 10, 2 );

		add_action( 'elementor/element/social-icons/section_social_hover/after_section_end', array( $this, 'cryptlight_social_icons_custom' ), 10, 2 );
	}

	
	function cryptlight_add_category(  ) {

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'hf',
	        [
	            'title' => __( 'Header Footer', 'cryptlight' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	    \Elementor\Plugin::instance()->elements_manager->add_category(
	        'cryptlight',
	        [
	            'title' => __( 'Cryptlight', 'cryptlight' ),
	            'icon' => 'fa fa-plug',
	        ]
	    );

	}

	function cryptlight_enqueue_scripts(){
        
        $files = glob(get_theme_file_path('/assets/js/elementor/*.js'));
        
        foreach ($files as $file) {
            $file_name = wp_basename($file);
            $handle    = str_replace(".js", '', $file_name);
            $src       = get_theme_file_uri('/assets/js/elementor/' . $file_name);
            if (file_exists($file)) {
                wp_register_script( 'cryptlight-elementor-' . $handle, $src, ['jquery'], false, true );
            }
        }


	}

	function cryptlight_include_widgets( $widgets_manager ) {
        $files = glob(get_theme_file_path('elementor/widgets/*.php'));
        foreach ($files as $file) {
            $file = get_theme_file_path('elementor/widgets/' . wp_basename($file));
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }

    function cryptlight_add_animations(){
    	$animations = array(
            'Cryptlight' => array(
                'ova-move-up' 		=> esc_html__('Move Up', 'cryptlight'),
                'ova-move-down' 	=> esc_html__( 'Move Down', 'cryptlight' ),
                'ova-move-left'     => esc_html__('Move Left', 'cryptlight'),
                'ova-move-right'    => esc_html__('Move Right', 'cryptlight'),
                'ova-scale-up'      => esc_html__('Scale Up', 'cryptlight'),
                'ova-flip'          => esc_html__('Flip', 'cryptlight'),
                'ova-helix'         => esc_html__('Helix', 'cryptlight'),
                'ova-popup'			=> esc_html__( 'PopUp','cryptlight' )
            ),
        );

        return $animations;
    }

    function cryptlight_tabs_custom( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_tabs',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Tabs', 'cryptlight' ),
			]
		);

			$element->add_responsive_control(
	            'ova_tabs_display',
	            [
	                'label' 	=> esc_html__( 'Display', 'cryptlight' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'inline-block' => [
	                        'title' => esc_html__( 'Inline Block', 'cryptlight' ),
	                        'icon' 	=> 'eicon-v-align-top',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-desktop-title' => 'display: {{VALUE}}',
	                ],
	            ]
	        );

	        $element->add_responsive_control(
	            'ova_tabs_wrapper_display',
	            [
	                'label' 	=> esc_html__( 'Display Wrapper', 'cryptlight' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'block' => [
	                        'title' => esc_html__( 'Block', 'cryptlight' ),
	                        'icon' 	=> 'eicon-h-align-stretch',
	                    ],
	                    'flex' => [
	                        'title' => esc_html__( 'Flex', 'cryptlight' ),
	                        'icon' 	=> 'eicon-h-align-center',
	                    ],
	                    'none' => [
	                        'title' => esc_html__( 'None', 'cryptlight' ),
	                        'icon' 	=> 'eicon-v-align-middle',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper' => 'display: {{VALUE}}',
	                ],
	            ]
	        );

	        $element->add_responsive_control(
	            'ova_tabs_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
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
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title' => 'text-align: {{VALUE}}',
	                ],
	                'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
	            ]
	        );

			$element->add_control(
				'ova_tabs_title_desktop',
				[
					'label' 	=> esc_html__( 'Desktop', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
	                	'ova_tabs_display' => 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_bg',
				[
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title' => 'background-color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'ova_tabs_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title',
					'condition' => [
		                'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_bg_active',
				[
					'label' 	=> esc_html__( 'Background Active', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'ova_tabs_box_shadow_active',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title.elementor-active',
					'condition' => [
		                'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_bg_hover',
				[
					'label' 	=> esc_html__( 'Background Hover', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_color_desktop',
				[
					'label' 	=> esc_html__( 'Color Title Desktop', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title' => 'color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_color_desktop_active',
				[
					'label' 	=> esc_html__( 'Color Title Desktop Active', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title.elementor-active' => 'color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_color_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title:hover' => 'color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_title_mobile',
				[
					'label' 	=> esc_html__( 'Mobile', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
	                	'ova_tabs_display' => 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_bg_mobile',
				[
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title' => 'background-color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'ova_tabs_box_shadow_mobile',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title',
					'condition' => [
		                'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_bg_active_mobile',
				[
					'label' 	=> esc_html__( 'Background Active', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title.elementor-active' => 'background-color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'ova_tabs_box_shadow_active_mobile',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title.elementor-active',
					'condition' => [
		                'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_bg_hover_mobile',
				[
					'label' 	=> esc_html__( 'Background Hover', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_color_mobile',
				[
					'label' 	=> esc_html__( 'Color Title Mobile', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title' => 'color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_color_mobile_active',
				[
					'label' 	=> esc_html__( 'Color Title Mobile Active', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title.elementor-active' => 'color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_group_control(
	            \Elementor\Group_Control_Border::get_type(), [
	                'name' 		=> 'ova_tabs_border',
	                'selector' 	=> '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title',
	                'separator' => 'before',
	                'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
	            ]
	        );

	        $element->add_control(
				'ova_tabs_boder_desktop',
				[
					'label' 	=> esc_html__( 'Border Desktop', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
	                	'ova_tabs_display' => 'inline-block',
	                ],
				]
			);

	        $element->add_control(
				'ova_tabs_color_active',
				[
					'label' 	=> esc_html__( 'Border Color Active', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title.elementor-active' 				=> 'border-color: {{VALUE}};',
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title.elementor-active' 	=> 'border-color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_control(
				'ova_tabs_border_color_hover',
				[
					'label' 	=> esc_html__( 'Border Color Hover', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title:hover' => 'border-color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

			$element->add_responsive_control(
	            'ova_tabs_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
	            ]
	        );

	        $element->add_responsive_control(
	            'ova_tabs_first_border_radius',
	            [
	                'label' 		=> esc_html__( 'First Border Radius', 'cryptlight' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title.elementor-tab-desktop-title:first-child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
	            ]
	        );

	        $element->add_responsive_control(
	            'ova_tabs_last_border_radius',
	            [
	                'label' 		=> esc_html__( 'Last Border Radius', 'cryptlight' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title.elementor-tab-desktop-title:last-child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
	            ]
	        );

	        $element->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'ova_tabs_display' => 'inline-block',
	                ],
	            ]
	        );

	        $element->add_responsive_control(
	            'title_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-wrapper .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'ova_tabs_display' => 'inline-block',
	                ],
	            ]
	        );

	        $element->add_control(
				'ova_tabs_boder_mobile',
				[
					'label' 	=> esc_html__( 'Border Mobile', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
	                	'ova_tabs_display' => 'inline-block',
	                ],
				]
			);

			$element->add_group_control(
	            \Elementor\Group_Control_Border::get_type(), [
	                'name' 		=> 'ova_tabs_border_mobile',
	                'selector' 	=> '{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title',
	                'separator' => 'before',
	                'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
	            ]
	        );

			$element->add_control(
				'ova_tabs_border_color_active_mobile',
				[
					'label' 	=> esc_html__( 'Border Color Active Mobile', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title.elementor-active' => 'border-color: {{VALUE}};',
					],
					'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
				]
			);

	        $element->add_responsive_control(
	            'ova_tabs_border_radius_btn_mobile',
	            [
	                'label' 		=> esc_html__( 'Border Radius Mobile', 'cryptlight' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'ova_tabs_display' 	=> 'inline-block',
	                ],
	            ]
	        );

	        $element->add_responsive_control(
	            'ova-title_padding_mobile',
	            [
	                'label' 		=> esc_html__( 'Padding Mobile', 'cryptlight' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'ova_tabs_display' => 'inline-block',
	                ],
	            ]
	        );

	        $element->add_responsive_control(
	            'ova-title_margin_mobile',
	            [
	                'label' 		=> esc_html__( 'Margin Mobile', 'cryptlight' ),
	                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                	'ova_tabs_display' => 'inline-block',
	                ],
	            ]
	        );

	        $element->add_control(
				'ova_tabs_content',
				[
					'label' 	=> esc_html__( 'Content', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
	                	'ova_tabs_display' => 'inline-block',
	                ],
				]
			);

				$element->add_responsive_control(
		            'content_padding',
		            [
		                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper > .elementor-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
		                	'ova_tabs_display' => 'inline-block',
		                ],
		            ]
		        );

		    $element->add_control(
				'ova_tabs_icon',
				[
					'label' 	=> esc_html__( 'Icon', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
	                	'ova_tabs_display' => 'inline-block',
	                ],
				]
			);

				$element->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' 		=> 'icon_typography',
						'selector' 	=> '{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title:before',
						'condition' => [
		                	'ova_tabs_display' => 'inline-block',
		                ],
					]
				);

				$element->add_control(
		            'icon_color',
		            [
		                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title:before' => 'color: {{VALUE}};',
		                ],
		                'condition' => [
		                	'ova_tabs_display' => 'inline-block',
		                ],
		            ]
		        );

		        $element->add_control(
		            'icon_color_hover',
		            [
		                'label' 	=> esc_html__( 'Color Hover', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title:hover:before' => 'color: {{VALUE}};',
		                ],
		                'condition' => [
		                	'ova_tabs_display' => 'inline-block',
		                ],
		            ]
		        );

		        $element->add_responsive_control(
					'icon_right',
					[
						'label' 	=> esc_html__( 'Right', 'cryptlight' ),
						'type' 		=>  \Elementor\Controls_Manager::SLIDER,
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
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title:before' => 'right: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
		                	'ova_tabs_display' => 'inline-block',
		                ],
					]
				);

				$element->add_responsive_control(
					'icon_top',
					[
						'label' 	=> esc_html__( 'Top', 'cryptlight' ),
						'type' 		=>  \Elementor\Controls_Manager::SLIDER,
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
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-tabs .elementor-tabs-content-wrapper .elementor-tab-mobile-title:before' => 'top: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
		                	'ova_tabs_display' => 'inline-block',
		                ],
					]
				);

		$element->end_controls_section();
	}

    function cryptlight_accordion_custom( $element, $args ) {
    	/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_accordion',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Accordion', 'cryptlight' ),
			]
		);

			$element->add_responsive_control(
	            'ova_accordion_display',
	            [
	                'label' 	=> esc_html__( 'Display', 'cryptlight' ),
	                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'list-item' => [
	                        'title' => esc_html__( 'List-item', 'cryptlight' ),
	                        'icon' 	=> 'eicon-editor-list-ul',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'display: {{VALUE}}',
	                ],
	            ]
	        );

			// Accordion item options
	        $element->add_control(
				'accordion_item_options',
				[
					'label' 	=> esc_html__( 'Item Options', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'ova_accordion_display!' => '',
					],
				]
			);

				$element->add_group_control(
		            \Elementor\Group_Control_Border::get_type(), [
		                'name' 		=> 'accordion_item_border',
		                'selector' 	=> '{{WRAPPER}} .elementor-accordion .elementor-accordion-item',
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_responsive_control(
		            'accordion_item_margin',
		            [
		                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

	        $element->add_control(
				'marker_options',
				[
					'label' 	=> esc_html__( 'Marker Options', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'ova_accordion_display!' => '',
					],
				]
			);

				$element->add_control(
		            'marker_color',
		            [
		                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title::marker' => 'color: {{VALUE}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

				$element->add_responsive_control(
					'item_width',
					[
						'label' 	=> esc_html__( 'Width', 'cryptlight' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
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
						'size_units' 	=> [ '%', 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title::marker' => 'font-size: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'ova_accordion_display!' => '',
						],
					]
				);

				$element->add_control(
		            'marker_background_normal',
		            [
		                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}}.accordion-title-before .elementor-accordion .elementor-accordion-item .elementor-tab-title .elementor-accordion-title:before' => 'background-color: {{VALUE}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_control(
		            'marker_border_color_normal',
		            [
		                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}}.accordion-title-before .elementor-accordion .elementor-accordion-item .elementor-tab-title .elementor-accordion-title:before' => 'border-color: {{VALUE}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_control(
		            'marker_background_active',
		            [
		                'label' 	=> esc_html__( 'Background Active', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}}.accordion-title-before .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active .elementor-accordion-title:before' => 'background-color: {{VALUE}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_control(
		            'marker_border_color_active',
		            [
		                'label' 	=> esc_html__( 'Border Color Active', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}}.accordion-title-before .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active .elementor-accordion-title:before' => 'border-color: {{VALUE}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

				$element->add_responsive_control(
					'marker_top',
					[
						'label' 	=> esc_html__( 'Top', 'cryptlight' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
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
						],
						'size_units' 	=> [ 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}}.accordion-title-before .elementor-accordion .elementor-accordion-item .elementor-tab-title .elementor-accordion-title:before' => 'top: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'ova_accordion_display!' => '',
						],
					]
				);

				$element->add_responsive_control(
					'marker_left',
					[
						'label' 	=> esc_html__( 'Left', 'cryptlight' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
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
						],
						'size_units' 	=> [ 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}}.accordion-title-before .elementor-accordion .elementor-accordion-item .elementor-tab-title .elementor-accordion-title:before' => 'left: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'ova_accordion_display!' => '',
						],
					]
				);

			// Title options
			$element->add_control(
				'title_options',
				[
					'label' 	=> esc_html__( 'Title Options', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'ova_accordion_display!' => '',
					],
				]
			);

				$element->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' 		=> 'title_background_gradient',
						'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
						'types' 	=> [ 'classic', 'gradient' ],
						'exclude' 	=> [ 'image' ],
						'selector' 	=> '{{WRAPPER}} .elementor-accordion .elementor-tab-title',
						'condition' => [
							'ova_accordion_display!' => '',
						],
					]
				);

				$element->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' 		=> 'title_background_gradient_active',
						'label' 	=> esc_html__( 'Background Gradient Active', 'cryptlight' ),
						'types' 	=> [ 'classic', 'gradient' ],
						'exclude' 	=> [ 'image' ],
						'selector' 	=> '{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active',
						'condition' => [
							'ova_accordion_display!' => '',
						],
						'separator' => 'before',
					]
				);

				$element->add_control(
		            'title_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

		        $element->add_control(
		            'title_border_radius_active',
		            [
		                'label' 		=> esc_html__( 'Border Radius Active', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

				$element->add_responsive_control(
		            'title_margin',
		            [
		                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

			// Icon options
		    $element->add_control(
				'icon_options',
				[
					'label' 	=> esc_html__( 'Icon Options', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'ova_accordion_display!' => '',
					],
				]
			);

		    	$element->add_responsive_control(
		            'icon_display',
		            [
		                'label' 	=> esc_html__( 'Display', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
		                'options' 	=> [
		                    'flex' => [
		                        'title' => esc_html__( 'Center', 'cryptlight' ),
		                        'icon' 	=> 'eicon-h-align-center',
		                    ],
		                ],
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'display: {{VALUE}};align-items: center;justify-content: center;position: relative;',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' 		=> 'icon_typography',
						'selector' 	=> '{{WRAPPER}} .elementor-accordion .elementor-tab-title i',
						'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
					]
				);

				$element->add_responsive_control(
					'icon_top',
					[
						'label' 	=> esc_html__( 'Top', 'cryptlight' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
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
						],
						'size_units' 	=> [ 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'top: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
					]
				);

				$element->add_responsive_control(
					'icon_right',
					[
						'label' 	=> esc_html__( 'Right', 'cryptlight' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
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
						],
						'size_units' 	=> [ 'px' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'right: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
					]
				);


		    	$element->add_responsive_control(
					'icon_width',
					[
						'label' 	=> esc_html__( 'Width', 'cryptlight' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
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
							'{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
					]
				);

		        $element->add_control(
		            'icon_background',
		            [
		                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'background-color: {{VALUE}};',
		                ],
		                'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_control(
		            'icon_active_background',
		            [
		                'label' 	=> esc_html__( 'Active Background ', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active i' => 'background-color: {{VALUE}};',
		                ],
		                'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_responsive_control(
		            'icon_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-title i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'icon_display!' => '',
							'ova_accordion_display!' => '',
						],
		            ]
		        );


		    // Content options
	        $element->add_control(
				'content_options',
				[
					'label' 	=> esc_html__( 'Content Options', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'ova_accordion_display!' => '',
					],
				]
			);

		        $element->add_control(
		            'content_border_radius_active',
		            [
		                'label' 		=> esc_html__( 'Border Radius Active', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-content.elementor-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

				$element->add_group_control(
		            \Elementor\Group_Control_Border::get_type(), [
		                'name' 		=> 'accordion_content_border',
		                'selector' 	=> '{{WRAPPER}} .elementor-accordion .elementor-tab-content',
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_responsive_control(
		            'content_margin',
		            [
		                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_responsive_control(
		            'item_content_padding',
		            [
		                'label' 		=> esc_html__( 'Item Padding', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_responsive_control(
		            'item_content_margin',
		            [
		                'label' 		=> esc_html__( 'Item Margin', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-accordion .elementor-tab-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'ova_accordion_display!' => '',
						],
		            ]
		        );

		        $element->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'content_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'cryptlight' ),
						'selector' => '{{WRAPPER}} .elementor-accordion .elementor-tab-content',
					]
				);

		$element->end_controls_section();
    }

    function cryptlight_toggle_custom( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_toggle',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Toggle', 'cryptlight' ),
			]
		);


			// Title options
			$element->add_control(
				'ova_title_toggle_options',
				[
					'label' 	=> esc_html__( 'Content Options', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$element->add_group_control(
		            \Elementor\Group_Control_Border::get_type(), [
		                'name' 		=> 'toggle_title_border',
		                'selector' 	=> '{{WRAPPER}} .elementor-toggle .elementor-toggle-item .elementor-tab-title',
		                'separator' => 'before',
		            ]
		        );

		    // Title options
			$element->add_control(
				'ova_title_toggle_active_options',
				[
					'label' 	=> esc_html__( 'Title Active', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$element->add_group_control(
		            \Elementor\Group_Control_Border::get_type(), [
		                'name' 		=> 'toggle_title_active_border',
		                'selector' 	=> '{{WRAPPER}} .elementor-toggle .elementor-toggle-item .elementor-tab-title.elementor-active',
		                'separator' => 'before',
		            ]
		        );

			// Content options
			$element->add_control(
				'ova_content_toggle_options',
				[
					'label' 	=> esc_html__( 'Content Options', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$element->add_group_control(
		            \Elementor\Group_Control_Border::get_type(), [
		                'name' 		=> 'toggle_content_border',
		                'selector' 	=> '{{WRAPPER}} .elementor-toggle .elementor-toggle-item .elementor-tab-content',
		                'separator' => 'before',
		            ]
		        );

	        // Icon options
			$element->add_control(
				'icon_options',
				[
					'label' 	=> esc_html__( 'Icon Options', 'cryptlight' ),
					'type' 		=> \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$element->add_responsive_control(
		            'icon_display',
		            [
		                'label' 	=> esc_html__( 'Display', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::CHOOSE,
		                'options' 	=> [
		                    'flex' => [
		                        'title' => esc_html__( 'Center', 'cryptlight' ),
		                        'icon' 	=> 'eicon-h-align-center',
		                    ],
		                ],
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-toggle .elementor-toggle-item .elementor-tab-title .elementor-toggle-icon .elementor-toggle-icon-closed i' => 'display: {{VALUE}};align-items: center;justify-content: center;',
		                    '{{WRAPPER}} .elementor-toggle .elementor-toggle-item .elementor-tab-title .elementor-toggle-icon .elementor-toggle-icon-opened i' => 'display: {{VALUE}};align-items: center;justify-content: center;',
		                ],
		            ]
		        );

		        $element->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' 		=> 'icon_typography',
						'selector' 	=> '{{WRAPPER}} .elementor-toggle .elementor-toggle-item .elementor-tab-title .elementor-toggle-icon i',
						'condition' => [
							'icon_display!' => '',
						],
					]
				);

		    	$element->add_responsive_control(
					'icon_width',
					[
						'label' 	=> esc_html__( 'Width', 'cryptlight' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
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
							'{{WRAPPER}} .elementor-toggle .elementor-toggle-item .elementor-tab-title .elementor-toggle-icon i' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',

						],
						'condition' => [
							'icon_display!' => '',
						],
					]
				);

		        $element->add_control(
		            'icon_background',
		            [
		                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-toggle .elementor-toggle-item .elementor-tab-title .elementor-toggle-icon .elementor-toggle-icon-closed i' => 'background-color: {{VALUE}};',
		                ],
		                'condition' => [
							'icon_display!' => '',
						],
		            ]
		        );

		        $element->add_control(
		            'icon_active_background',
		            [
		                'label' 	=> esc_html__( 'Active Background ', 'cryptlight' ),
		                'type' 		=> \Elementor\Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .elementor-toggle .elementor-toggle-item .elementor-tab-title .elementor-toggle-icon .elementor-toggle-icon-opened i' => 'background-color: {{VALUE}};',
		                ],
		                'condition' => [
							'icon_display!' => '',
						],
		            ]
		        );

		        $element->add_responsive_control(
		            'icon_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-toggle .elementor-toggle-item .elementor-tab-title .elementor-toggle-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		                'condition' => [
							'icon_display!' => '',
						],
		            ]
		        );

				$element->add_responsive_control(
		            'icon_margin',
		            [
		                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
		                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .elementor-toggle .elementor-toggle-item .elementor-tab-title .elementor-toggle-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

		$element->end_controls_section();
	}

	function cryptlight_social_icons_custom ( $element, $args ) {
		/** @var \Elementor\Element_Base $element */
		$element->start_controls_section(
			'ova_social_icons',
			[
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				'label' => esc_html__( 'Ova Social Icon', 'cryptlight' ),
			]
		);

			$element->add_control(
	            'social_icons_bg_hover',
	            [
	                'label' 	=> esc_html__( 'Background Hover', 'cryptlight' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-social-icons-wrapper .elementor-grid-item .elementor-social-icon:hover' => 'background-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $element->add_control(
	            'social_icons_color_hover',
	            [
	                'label' 	=> esc_html__( 'Color Hover', 'cryptlight' ),
	                'type' 		=> \Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .elementor-social-icons-wrapper .elementor-grid-item .elementor-social-icon:hover i' => 'color: {{VALUE}};',
	                ],
	            ]
	        );

		$element->end_controls_section();
	}

}

return new Cryptlight_Elementor();





