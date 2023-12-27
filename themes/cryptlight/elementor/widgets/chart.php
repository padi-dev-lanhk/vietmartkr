<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Cryptlight_Elementor_Chart extends Widget_Base {

	
	public function get_name() {
		return 'cryptlight_elementor_chart';
	}

	
	public function get_title() {
		return esc_html__( 'Chart', 'cryptlight' );
	}

	
	public function get_icon() {
		return 'eicon-circle-o';
	}

	
	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_script_depends() {
		wp_enqueue_script( 'chart', get_theme_file_uri('/assets/libs/chart/chart.min.js'), array('jquery'), false, true);
		return [ 'cryptlight-elementor-chart' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		/* Begin section charts */
		$this->start_controls_section(
			'section_charts',
			[
				'label' => esc_html__( 'Charts', 'cryptlight' ),
			]
		);	

			$this->add_control(
	            'type',
	            [
	                'label' 	=> esc_html__( 'Type', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SELECT,
	                'options' 	=> [
	                    'doughnut' 	=> esc_html__( 'Doughnut', 'cryptlight' ),
	                    'pie' 		=> esc_html__( 'Pie', 'cryptlight' ),
	                ],
	                'default' 	=> 'doughnut',
	            ]
	        );

	        $this->add_control(
	            'chart_id',
	            [
	                'label' 		=> esc_html__( 'Chart ID', 'cryptlight' ),
	                'type' 			=> Controls_Manager::TEXT,
	                'default' 		=> 'chart_unique_id',
	                'description' 	=> esc_html__( 'Add unique ID for chart.', 'cryptlight' ),
	            ]
	        );

	        $this->add_control(
	            'chart_radius',
	            [
	                'label' 	=> esc_html__( 'Chart Radius', 'cryptlight' ),
	                'type' 		=> Controls_Manager::NUMBER,
	                'min' 		=> 0,
	                'max' 		=> 100,
	                'step' 		=> 5,
	                'default' 	=> 70,
	                'condition' => [
	                	'type' => 'doughnut',
	                ],
	            ]
	        );

	        $this->add_control(
	            'chart_border_width',
	            [
	                'label' 	=> esc_html__( 'Chart Border Width', 'cryptlight' ),
	                'type' 		=> Controls_Manager::NUMBER,
	                'min' 		=> 0,
	                'max' 		=> 100,
	                'step' 		=> 1,
	                'default' 	=> 0,
	            ]
	        );

	        $this->add_control(
	            'border_color',
	            [
	                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'condition' => [
	                	'chart_border_width!' => 0,
	                ],
	            ]
	        );

	        $this->add_control(
	            'border_color_hover',
	            [
	                'label' 	=> esc_html__( 'Border Color Hover', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'condition' => [
	                	'chart_border_width!' => 0,
	                ],
	            ]
	        );

	        $this->add_control(
				'chart_canvas',
				[
					'label' 	=> esc_html__( 'Canvas', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'no',
					'condition' => [
	                	'type' 	=> 'doughnut',
	                ],
				]
			);

			$this->add_control(
	            'canvas_size',
	            [
	                'label' 	=> esc_html__( 'Canvas Size', 'cryptlight' ),
	                'type' 		=> Controls_Manager::NUMBER,
	                'min' 		=> 0,
	                'max' 		=> 1000,
	                'step' 		=> 5,
	                'default' 	=> 100,
	                'condition' => [
	                	'chart_canvas' => 'yes',
	                ],
	            ]
	        );

	        $this->add_control(
	            'canvas_background',
	            [
	                'label' 	=> esc_html__( 'Canvas Background', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'condition' => [
	                	'chart_canvas' => 'yes',
	                ],
	            ]
	        );

	        $repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'label',
					[
						'label' 	=> esc_html__( 'Label', 'cryptlight' ),
						'type' 		=> Controls_Manager::TEXT,
						'default'	=> esc_html__( 'Marketing', 'cryptlight' ),
					]
				);

				$repeater->add_control(
					'percent',
					[
						'label' 	=> esc_html__( 'Percent', 'cryptlight' ),
						'type' 		=> Controls_Manager::NUMBER,
						'step' 		=> 5,
						'default' 	=> 10,
					]
				);

				$repeater->add_control(
		            'color',
		            [
		                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
		                'type' 		=> Controls_Manager::COLOR,
		            ]
		        );

			$this->add_control(
				'charts',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'label' 	=> esc_html__( 'Contingency', 'cryptlight' ),
							'percent' 	=> 5,
							'color' 	=> '#3D88FB',
						],
						[
							'label' 	=> esc_html__( 'Partner/Investor', 'cryptlight' ),
							'percent' 	=> 5,
							'color' 	=> '#5637C8',
						],
						[
							'label' 	=> esc_html__( 'Legal & Regulation', 'cryptlight' ),
							'percent' 	=> 10,
							'color' 	=> '#00D89E',
						],
						[
							'label' 	=> esc_html__( 'Business Development', 'cryptlight' ),
							'percent' 	=> 10,
							'color' 	=> '#ACDF35',
						],
						[
							'label' 	=> esc_html__( 'Operational', 'cryptlight' ),
							'percent' 	=> 10,
							'color' 	=> '#9116CD',
						],
						[
							'label' 	=> esc_html__( 'Product Develoment', 'cryptlight' ),
							'percent' 	=> 40,
							'color' 	=> '#FC3352',
						],
						[
							'label' 	=> esc_html__( 'Marketing', 'cryptlight' ),
							'percent' 	=> 20,
							'color' 	=> '#FF9B5C',
						],
					],
					'title_field' => '{{{ label }}}',
				]
			);

		$this->end_controls_section();
		/* End section chart */

		/* Begin section chart style */
		$this->start_controls_section(
			'charts_style',
			[
				'label' => esc_html__( 'Charts', 'cryptlight' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	

			$this->add_responsive_control(
				'align',
				[
					'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'flex-start' => [
							'title' 	=> esc_html__( 'Left', 'cryptlight' ),
							'icon' 		=> 'eicon-text-align-left',
						],
						'center' 	=> [
							'title' 	=> esc_html__( 'Center', 'cryptlight' ),
							'icon' 		=> 'eicon-text-align-center',
						],
						'flex-end' 	=> [
							'title' 	=> esc_html__( 'Right', 'cryptlight' ),
							'icon' 		=> 'eicon-text-align-right',
						],
					],
					'default' 	=> 'flex-start',
					'selectors' => [
						'{{WRAPPER}} .ova-chart' => 'justify-content: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'width',
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
						'{{WRAPPER}} .ova-chart .chart-content' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		/* End section chart style */
		
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$type 			= $settings['type'];
		$radius 		= $settings['chart_radius'];
		$id 			= $settings['chart_id'];
		$canvas 		= $settings['chart_canvas'];
		$size 			= $settings['canvas_size'];
		$border 		= $settings['chart_border_width'];
		$border_color	= $settings['border_color'];
		$bd_color_hover = $settings['border_color_hover'];
		$canvas_bg 		= $settings['canvas_background'];

		if ( 'pie' == $type ) {
			$radius = 0;
		}

		$data_chart = $data_title = $data_percent = $data_color = array();
		$charts 	= $settings['charts'];

		if ( ! empty( $charts ) && is_array( $charts ) ) {

			foreach ( $charts as $items ) {
				array_push( $data_title , $items['label'] );
				array_push( $data_percent , $items['percent'] );
				array_push( $data_color , $items['color'] );
			}

			$data_chart = array(
				'label' 	=> $data_title,
				'percent' 	=> $data_percent,
				'color' 	=> $data_color,
			);
		}

		?>

		<div class="ova-chart" 
			data-chart-radius="<?php echo esc_attr( $radius ); ?>"
			data-chart='<?php echo json_encode( $data_chart ); ?>'
			data-id="<?php echo esc_html( $id ); ?>" 
			data-border="<?php echo esc_attr( $border ); ?>" 
			data-border-color="<?php echo esc_attr( $border_color ); ?>" 
			data-border-color-hover="<?php echo esc_attr( $bd_color_hover ); ?>" 
			data-canvas="<?php echo esc_attr( $canvas ); ?>" 
			data-canvas-size="<?php echo esc_attr( $size ); ?>" 
			data-canvas-bg="<?php echo esc_attr( $canvas_bg ); ?>">

			<div class="chart-content">
				<canvas id="<?php echo esc_html( $id ); ?>"></canvas>
			</div>
		</div>

		<!-- Js Chart -->
		<?php echo '<script type="text/javascript"> var id ="' . esc_html( $id ) . '";</script>';  ?>
		<script type="text/javascript">

			if ( typeof chart_ids == 'undefined' ) {
				var chart_ids = [];
			} else {
				if ( typeof id !== 'undefined' ) {
					chart_ids = jQuery.grep(chart_ids, function(value) {
        				return value != id;
      				});
				}
			}
		</script>
		 	
		<?php
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Chart() );