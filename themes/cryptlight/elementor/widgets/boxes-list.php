<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cryptlight_Elementor_Boxes_List extends Widget_Base {
	
	public function get_name() {
		return 'cryptlight_elementor_boxes_list';
	}
	
	public function get_title() {
		return esc_html__( 'Boxes List', 'cryptlight' );
	}
	
	public function get_icon() {
		return 'eicon-lightbox';
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
			
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'from',
				[
					'label' 		=> esc_html__( 'From', 'cryptlight' ),
					'type' 			=> Controls_Manager::DATE_TIME,
					'default'		=> date( 'Y-m-d', current_time('timestamp')),
					'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
				]
			);

			$repeater->add_control(
				'to',
				[
					'label' 		=> esc_html__( 'To', 'cryptlight' ),
					'type' 			=> Controls_Manager::DATE_TIME,
					'default'		=> date( 'Y-m-d', current_time('timestamp')),
					'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
				]
			);

			$repeater->add_control(
				'title',
				[
					'label' 		=> esc_html__( 'Title', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__('Add Your Title', 'cryptlight' ),
				]
			);

			$repeater->add_control(
				'description',
				[
					'label' 		=> esc_html__( 'Description', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXTAREA,
					'default' 		=> esc_html__('Add Your Description', 'cryptlight' ),
				]
			);

			$this->add_control(
				'boxes_items',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'from' 			=> esc_html__( '2021-03-15', 'cryptlight' ),
							'to' 			=> esc_html__( '2021-09-15', 'cryptlight' ),
							'title' 		=> esc_html__('67% bonus', 'cryptlight' ),
							'description' 	=> esc_html__('$0.9009/token', 'cryptlight' ),
						],
						[
							'from' 			=> esc_html__( '2021-03-15', 'cryptlight' ),
							'to' 			=> esc_html__( '2021-09-15', 'cryptlight' ),
							'title' 		=> esc_html__('67% bonus', 'cryptlight' ),
							'description' 	=> esc_html__('$0.9009/token', 'cryptlight' ),
						],
						[
							'from' 			=> esc_html__( '2021-03-15', 'cryptlight' ),
							'to' 			=> esc_html__( '2021-09-15', 'cryptlight' ),
							'title' 		=> esc_html__('67% bonus', 'cryptlight' ),
							'description' 	=> esc_html__('$0.9009/token', 'cryptlight' ),
						],
						[
							'from' 			=> esc_html__( '2021-03-15', 'cryptlight' ),
							'to' 			=> esc_html__( '2021-09-15', 'cryptlight' ),
							'title' 		=> esc_html__('67% bonus', 'cryptlight' ),
							'description' 	=> esc_html__('$0.9009/token', 'cryptlight' ),
						],
						[
							'from' 			=> esc_html__( '2021-03-15', 'cryptlight' ),
							'to' 			=> esc_html__( '2021-09-15', 'cryptlight' ),
							'title' 		=> esc_html__('67% bonus', 'cryptlight' ),
							'description' 	=> esc_html__('$0.9009/token', 'cryptlight' ),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

			$this->add_control(
				'seperate',
				[
					'label' 		=> esc_html__( 'Seperate Date', 'cryptlight' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> esc_html__(' - ', 'cryptlight' ),
				]
			);

		$this->end_controls_section();

		/* Style Setting */
		// Boxes
		$this->start_controls_section(
            'boxes_style',
            [
                'label' => esc_html__( 'Boxes', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
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
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item' => 'text-align: {{VALUE}}',
	                ],
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
			            'boxes_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item' => 'background-color: {{VALUE}};',
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
			                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'boxes_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item:hover' => 'border-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'boxes_border',
	                'selector' 	=> '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item',
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
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'boxed_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'boxes_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'boxes_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item',
				]
			);

		$this->end_controls_section();
        // End Boxes Style

		// Date Style
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
					'selector' 	=> '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-date span',
				]
			);

			$this->start_controls_tabs( 'tabs_date_style' );
				
				$this->start_controls_tab(
		            'tab_date_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'date_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-date span' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        	$this->add_control(
			            'date_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-date' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_date_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'date_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item:hover .box-date span' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        	$this->add_control(
			            'date_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item:hover .box-date' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'date_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'date_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		// End Date Style

		// Title Style
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
					'selector' 	=> '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-content .title',
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
			                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-content .title' => 'color: {{VALUE}};',
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
			                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item:hover .box-content .title' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-content .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		// End Title Style

		// Description Style
        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__( 'Description', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-content .description',
				]
			);

			$this->start_controls_tabs( 'tabs_description_style' );
				
				$this->start_controls_tab(
		            'tab_description_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'description_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-content .description' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_description_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'description_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item:hover .box-content .description' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'description_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-content .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .item .box-content .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		// End Description Style

		// Dot Style
        $this->start_controls_section(
            'dot_style',
            [
                'label' => esc_html__( 'Dot', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 		=> 'dot_background',
					'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
					'types' 	=> [ 'gradient' ],
					'selector' 	=> '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .dot',
				]
			);

			$this->add_responsive_control(
				'size',
				[
					'label' 	=> esc_html__( 'Size', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-boxes-list .boxes-wrapper .dot' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'dot_border',
	                'selector' 	=> '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .dot',
	                'separator' => 'before',
	            ]
	        );

			$this->add_control(
	            'dot_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'dot_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-boxes-list .boxes-wrapper .dot' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		// End Dot Style
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$boxes 		= $settings['boxes_items'];
		$seperate 	= $settings['seperate'];

		?>
		<?php if ( $boxes && is_array( $boxes ) ): 
			$count = count( $boxes ) - 1;
		?>
		 	<div class="ova-boxes-list">
		 		<div class="boxes-wrapper">
		 			<?php foreach( $boxes as $k => $items ): 
		 				$from_timestamp = strtotime( $items['from'] );
		 				$from_month 	= date('M', $from_timestamp);
						$from_day 		= date('d', $from_timestamp);

						$to_timestamp 	= strtotime( $items['to'] );
		 				$to_month 		= date('M', $to_timestamp);
						$to_day 		= date('d', $to_timestamp);
		 			?>
		 				<?php if ( $k < $count ): ?>
		 					<div class="item">
		 						<div class="box-date">
		 							<span class="from-date"><?php echo esc_html( $from_month ) . ' ' . esc_html( $from_day ); ?></span>
		 							<span class="seperate"><?php echo esc_html( $seperate ); ?></span>
		 							<span class="to-date"><?php echo esc_html( $to_month ) . ' ' . esc_html( $to_day ); ?></span>
		 						</div>
		 						<div class="box-content">
		 							<h2 class="title"><?php echo esc_html( $items['title'] ); ?></h2>
		 							<p class="description"><?php echo esc_html( $items['description'] ); ?></p>
		 						</div>
		 					</div>
		 					<div class="dot"></div>
		 				<?php else: ?>
		 					<div class="item">
		 						<div class="box-date">
		 							<span class="from-date"><?php echo esc_html( $from_month ) . ' ' . esc_html( $from_day ); ?></span>
		 							<span class="seperate"><?php echo esc_html( $seperate ); ?></span>
		 							<span class="to-date"><?php echo esc_html( $to_month ) . ' ' . esc_html( $to_day ); ?></span>
		 						</div>
		 						<div class="box-content">
		 							<h2 class="title"><?php echo esc_html( $items['title'] ); ?></h2>
		 							<p class="description"><?php echo esc_html( $items['description'] ); ?></p>
		 						</div>
		 					</div>
		 				<?php endif; ?>
		 			<?php endforeach; ?>
		 		</div>
		 	</div>
		<?php
		endif;
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Boxes_List() );