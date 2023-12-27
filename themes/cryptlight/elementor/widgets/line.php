<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cryptlight_Elementor_Line extends Widget_Base {

	public function get_name() {
		return 'cryptlight_elementor_line';
	}
	
	public function get_title() {
		return esc_html__( 'Line', 'cryptlight' );
	}
	
	public function get_icon() {
		return 'eicon-divider';
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
			'section_line',
			[
				'label' => esc_html__( 'Line', 'cryptlight' ),
			]
		);	
			
			// Add Class control
			$this->add_responsive_control(
				'line_width',
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
					'default' => [
						'unit' 	=> '%',
					],
					'tablet_default' => [
						'unit' => '%',
					],
					'mobile_default' => [
						'unit' => '%',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-line .line-container' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
	            'line_alignment',
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
	                    '{{WRAPPER}} .ova-line' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

		$this->end_controls_section();

		/* Begin Section Line Style */
		$this->start_controls_section(
            'line_style',
            [
                'label' => esc_html__( 'Line', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' 		=> 'line_background',
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'types' 	=> [ 'classic', 'gradient' ],
					'exclude' 	=> [ 'image' ],
					'selector' 	=> '{{WRAPPER}} .ova-line .line-container',
				]
			);

			$this->add_responsive_control(
				'line_weight',
				[
					'label' 		=> esc_html__( 'Weight', 'cryptlight' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 2000,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-line .line-container' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
	            'line_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-line .line-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-line .line-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Section Line Style */
	}

	// Render Template Here
	protected function render() {

		$settings = $this->get_settings();

		?>

		<div class="ova-line">
			<div class="line-container"></div>
		</div>
		 	
		<?php
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Line() );