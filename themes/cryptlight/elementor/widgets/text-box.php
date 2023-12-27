<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cryptlight_Elementor_Text_Box extends Widget_Base {

	public function get_name() {
		return 'cryptlight_elementor_text_box';
	}

	public function get_title() {
		return esc_html__( 'Text Box', 'cryptlight' );
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
			'section_text_box',
			[
				'label' => esc_html__( 'Text Box', 'cryptlight' ),
			]
		);	
			
			// Add Class control
			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( '28%', 'cryptlight' ),
				]
			);

			$this->add_control(
				'description',
				[
					'label' 	=> esc_html__( 'Description', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Mobile ad Platform', 'cryptlight' ),
				]
			);

			$this->add_responsive_control(
	            'text_box_alignment',
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
	                    '{{WRAPPER}}' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

		$this->end_controls_section();

		/* Begin Dot Style */
		$this->start_controls_section(
            'dot_style',
            [
                'label' => esc_html__( 'Dot', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->start_controls_tabs( 'tabs_dot_style' );
				
				$this->start_controls_tab(
		            'tab_dot_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'dot_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-text-box .ova-box-container .ova-box .dot' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_dot_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'dot_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-text-box:hover .ova-box-container .ova-box .dot' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'size',
				[
					'label' => esc_html__( 'Size', 'cryptlight' ),
					'type' 	=> Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 1000,
							'step' 	=> 5,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-text-box .ova-box-container .ova-box .dot' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'dot_border',
	                'selector' 	=> '{{WRAPPER}} .ova-text-box .ova-box-container .ova-box .dot',
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
	                    '{{WRAPPER}} .ova-text-box .ova-box-container .ova-box .dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-text-box .ova-box-container .ova-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End Dot Style */

		/* Begin Title Style */
		$this->start_controls_section(
            'title_style',
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
	                    '{{WRAPPER}} .ova-text-box .ova-box-container .ova-box-content .title' => 'color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-text-box .ova-box-container .ova-box-content .title',
				]
			);

			$this->add_responsive_control(
	            'title_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-text-box .ova-box-container .ova-box-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End Title Style */

		/* Begin Description Style */
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
	                    '{{WRAPPER}} .ova-text-box .ova-box-container .ova-box-content .description' => 'color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_typography',
					'selector' 	=> '{{WRAPPER}} .ova-text-box .ova-box-container .ova-box-content .description',
				]
			);

			$this->add_responsive_control(
	            'description_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-text-box .ova-box-container .ova-box-content .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
		/* End Title Style */
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$title 		= $settings['title'];
		$desc 		= $settings['description'];

		?>

		<div class="ova-text-box">
			<div class="ova-box-container">
				<div class="ova-box">
					<div class="dot"></div>
				</div>
				<div class="ova-box-content">
					<h2 class="title"><?php echo esc_html( $title ); ?></h2>
					<p class="description"><?php echo esc_html( $desc ); ?></p>
				</div>
			</div>
		</div>
		 	
		<?php
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Text_Box() );