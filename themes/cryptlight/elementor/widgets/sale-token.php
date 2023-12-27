<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Cryptlight_Elementor_Sale_Token extends Widget_Base {

	
	public function get_name() {
		return 'cryptlight_elementor_sale-token';
	}

	
	public function get_title() {
		return esc_html__( 'Sale Token', 'cryptlight' );
	}

	
	public function get_icon() {
		return 'eicon-calendar';
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
	                ],
	                'default' 	=> 'v1',
	            ]
	        );

			$this->add_control(
				'date',
				[
					'label' => esc_html__( 'Date', 'cryptlight' ),
					'type' => Controls_Manager::TEXT,
					'row' => 5,
					'default' => esc_html__('Jan 15 - Feb 15','cryptlight'),
				]
			);

			$this->add_control(
				'bonus',
				[
					'label' => esc_html__( 'Bonus', 'cryptlight' ),
					'type' => Controls_Manager::TEXTAREA,
					'row' => 5,
					'default' => esc_html__('67% Bonus','cryptlight'),
				]
			);
			$this->add_control(
				'price',
				[
					'label' => esc_html__( 'Price', 'cryptlight' ),
					'type' => Controls_Manager::TEXTAREA,
					'row' => 5,
					'default' => esc_html__('$0.9009/token','cryptlight'),
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' => esc_html__( 'Alignment', 'cryptlight' ),
					'type' => Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
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
						'type' 	=> 'v1',
					],
				]
			);

			$this->add_responsive_control(
				'align_v2',
				[
					'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
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
						'{{WRAPPER}} .ova-sale-token-v2' => 'text-align: {{VALUE}};',
					],
					'separator' => 'before',
					'condition' => [
						'type' 	=> 'v2',
					],
				]
			);

		$this->end_controls_section();

	
		$this->start_controls_section(
			'section_date_style',
			[
				'label' 	=> esc_html__( 'Date', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'date_typography',
					'selector' => '{{WRAPPER}} .ova-sale-token .date',
				]
			);

			$this->add_control(
				'color_date',
				[
					'label' => esc_html__( 'Color', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-sale-token .date' => 'color : {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'margin_date',
				[
					'label' => esc_html__( 'Margin', 'cryptlight' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-sale-token .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();


        $this->start_controls_section(
			'section_line_style',
			[
				'label' 	=> esc_html__( 'Line', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
				],
			]
		);

		

			$this->add_control(
				'color_line',
				[
					'label' => esc_html__( 'Color', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-sale-token .date' => 'border-bottom-color : {{VALUE}};',
					],
				]
			);
			

        $this->end_controls_section();


		$this->start_controls_section(
			'section_bonus_style',
			[
				'label' 	=> esc_html__( 'Bonus', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'bonus_typography',
					'selector' => '{{WRAPPER}} .ova-sale-token .bonus',
				]
			);

			$this->add_control(
				'color_bonus',
				[
					'label' => esc_html__( 'Color', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-sale-token .bonus' => 'color : {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'margin_bonus',
				[
					'label' => esc_html__( 'Margin', 'cryptlight' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-sale-token .bonus' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


		$this->end_controls_section();

        $this->start_controls_section(
			'section_price_style',
			[
				'label' 	=> esc_html__( 'Price', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'price_typography',
					'selector' => '{{WRAPPER}} .ova-sale-token .price',
				]
			);

			$this->add_control(
				'color_price',
				[
					'label' => esc_html__( 'Color', 'cryptlight' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-sale-token .price' => 'color : {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'margin_price',
				[
					'label' => esc_html__( 'Margin', 'cryptlight' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-sale-token .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_background_style',
			[
				'label' 	=> esc_html__( 'Background', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v1',
				],
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Color', 'cryptlight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-sale-token' => 'background-color : {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bg_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'cryptlight' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-sale-token:hover' => 'background-color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Version 2 style
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

		        	$this->add_control(
			            'content_v2_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-sale-token-v2' => 'background-color: {{VALUE}};',
			                ],
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
			                    '{{WRAPPER}} .ova-sale-token-v2:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'content_v2_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-sale-token-v2:hover' => 'border-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'content_v2_border',
	                'selector' 	=> '{{WRAPPER}} .ova-sale-token-v2',
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
	                    '{{WRAPPER}} .ova-sale-token-v2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-sale-token-v2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-sale-token-v2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_date_v2_style',
			[
				'label' 	=> esc_html__( 'Date', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v2',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'date_v2_typography',
					'selector' 	=> '{{WRAPPER}} .ova-sale-token-v2 .date h2',
				]
			);

			$this->start_controls_tabs( 'tabs_date_v2_style' );

				$this->start_controls_tab(
		            'tab_date_v2_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'date_v2_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-sale-token-v2 .date h2' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'date_v2_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-sale-token-v2 .date' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_date_v2_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'date_v2_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-sale-token-v2:hover .date h2' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'date_v2_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-sale-token-v2:hover .date' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'date_v2_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-sale-token-v2 .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'date_v2_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-sale-token-v2 .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_bonus_v2_style',
			[
				'label' 	=> esc_html__( 'Bonus', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v2',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'bonus_v2_typography',
					'selector' 	=> '{{WRAPPER}} .ova-sale-token-v2 .content .bonus',
				]
			);

			$this->start_controls_tabs( 'tabs_bonus_v2_style' );

				$this->start_controls_tab(
		            'tab_bonus_v2_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'bonus_v2_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-sale-token-v2 .content .bonus' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_bonus_v2_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'bonus_v2_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-sale-token-v2:hover .content .bonus' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'bonus_v2_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-sale-token-v2 .content .bonus' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'bonus_v2_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-sale-token-v2 .content .bonus' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price_v2_style',
			[
				'label' 	=> esc_html__( 'Price', 'cryptlight' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v2',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'price_v2_typography',
					'selector' 	=> '{{WRAPPER}} .ova-sale-token-v2 .content .price',
				]
			);

			$this->start_controls_tabs( 'tabs_price_v2_style' );

				$this->start_controls_tab(
		            'tab_price_v2_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'price_v2_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-sale-token-v2 .content .price' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_price_v2_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'price_v2_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-sale-token-v2:hover .content .price' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'price_v2_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-sale-token-v2 .content .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'price_v2_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-sale-token-v2 .content .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();
        $date 	= $settings['date'];
		$bonus 	= $settings['bonus'];
		$price 	= $settings['price'];
		$type 	= $settings['type'];
		?>
        <?php if ( 'v1' == $type ): ?>
		 	<div class="ova-sale-token">
				<?php if ( ! empty( $date ) ): ?>
					<div class="date">
						<?php echo esc_html( $date ); ?>
				   </div>
				<?php endif; ?>
				<?php if ( ! empty( $bonus ) ): ?>
					<div class="bonus">
						<?php echo esc_html( $bonus ); ?>
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $price ) ): ?>
					<div class="price">
						<?php echo esc_html( $price ); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php elseif ( 'v2' == $type ): ?>
			<div class="ova-sale-token-v2">
				<?php if ( !empty( $date ) ): ?>
					<div class="date">
						<h2><?php echo esc_html( $date ); ?></h2>
				   </div>
				<?php endif; ?>
				<div class="content">
					<?php if ( ! empty( $bonus ) ): ?>
						<h2 class="bonus"><?php echo esc_html( $bonus ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $price ) ): ?>
						<p class="price"><?php echo esc_html( $price ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php
		endif;
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Sale_Token() );