<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Cryptlight_Elementor_Card_Image extends Widget_Base {

	
	public function get_name() {
		return 'cryptlight_elementor_card_image';
	}

	
	public function get_title() {
		return esc_html__( 'Card Image', 'cryptlight' );
	}

	
	public function get_icon() {
		return 'eicon-info-box';
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
				'image',
				[
					'label' 	=> esc_html__( 'Image', 'cryptlight' ),
					'type' 		=> Controls_Manager::MEDIA,
					'dynamic' 	=> [
						'active' 	=> true,
					],
					'default' 	=> [
						'url' 	=> Elementor\Utils::get_placeholder_image_src(),
					],
					'separator' => 'before'
				]
			);
			$repeater->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__('Mobile payment make easy','cryptlight'),
				]
			);

			$repeater->add_control(
				'desc',
				[
					'label' 	=> esc_html__( 'Description', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXTAREA,
					'row' 		=> 5,
					'default' 	=> esc_html__("There's no need to sign up, you can use a mobile device to pay with the most simple steps",'cryptlight'),
				]
			);

			$this->add_control(
	            'items',
	            [
	                'type' 		=> Controls_Manager::REPEATER,
	                'fields' 	=> $repeater->get_controls(),
	                'default' 	=> [
	                    [	
	                    	'image' => [ 'url' => Elementor\Utils::get_placeholder_image_src(), ],
	                        'title' => esc_html__( 'Timestamp server','cryptlight' ),
	                        'desc' 	=> esc_html__( 'The timestamp server is top notch','cryptlight' ),
	                    ],
	                    [	
	                    	'image' => [ 'url' => Elementor\Utils::get_placeholder_image_src(), ],
	                        'title' => esc_html__( 'Reclaiming disk space','cryptlight' ),
	                        'desc' 	=> esc_html__( 'Remove old transactions','cryptlight' ),
	                    ],
	                    [	
	                    	'image' => [ 'url' => Elementor\Utils::get_placeholder_image_src(), ],
	                        'title' => esc_html__( 'Simplified payment verification','cryptlight' ),
	                        'desc' 	=> esc_html__( 'verify payment without running a full node','cryptlight' ),
	                    ],
	                    [	
	                    	'image' => [ 'url' => Elementor\Utils::get_placeholder_image_src(), ],
	                        'title' => esc_html__( 'Combining and splitting value','cryptlight' ),
	                        'desc' 	=> esc_html__( 'Make a separate transaction','cryptlight' ),
	                    ],
	                ],
	                'title_field' => '{{{ title }}}',
	            ]
	        );

	        $this->add_control(
	            'column',
	            [
	                'label' 	=> esc_html__( 'Column', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SELECT,
	                'options' 	=> [
	                    'column1' => esc_html__( '1', 'cryptlight' ),
	                    'column2' => esc_html__( '2', 'cryptlight' ),
	                    'column3' => esc_html__( '3', 'cryptlight' ),
	                ],
	                'default' 	=> 'column2',
	            ]
	        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_card_image_style',
			[
				'label' => esc_html__( 'Content', 'cryptlight' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);	

			$this->start_controls_tabs( 'tabs_card_image_style' );
				
				$this->start_controls_tab(
		            'tab_card_image_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'card_background_image_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-card-image .card-image-content' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_card_image_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'card_image_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-card-image .card-image-content:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
				'card_image_space_between',
				[
					'label' 	=> esc_html__( 'Space Between', 'cryptlight' ),
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
							'max' => 500,
						],
					],
					'size_units' 	=> [ 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-card-image' => 'grid-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'card_image_border',
	                'selector' 	=> '{{WRAPPER}} .ova-card-image .card-image-content',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'card_image_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-card-image .card-image-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_responsive_control(
				'card_image_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-card-image .card-image-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
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
							'max' => 500,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ '%', 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-card-image .card-image-content .card-image' 	=> 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_image_style' );
				
				$this->start_controls_tab(
		            'tab_image_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'image_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-card-image .card-image-content .card-image' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_image_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'image_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-card-image .card-image-content:hover .card-image' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'image_border',
	                'selector' 	=> '{{WRAPPER}} .ova-card-image .card-image-content .card-image',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'image_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-card-image .card-image-content .card-image' 		=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-card-image .card-image-content .card-image img' 	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_responsive_control(
				'image_padding',
				[
					'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-card-image .card-image-content .card-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
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
			                    '{{WRAPPER}} .ova-card-image .card-image-content .title' => 'color: {{VALUE}};',
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
			                    '{{WRAPPER}} .ova-card-image .card-image-content:hover .title' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-card-image .card-image-content .title',
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-card-image .card-image-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();


		$this->start_controls_section(
			'section_desc_style',
			[
				'label' => esc_html__( 'Description', 'cryptlight' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs( 'tabs_desc_style' );
				
				$this->start_controls_tab(
		            'tab_desc_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'desc_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-card-image .card-image-content .desc' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_desc_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'desc_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-card-image .card-image-content:hover .desc' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'desc_typography',
					'selector' 	=> '{{WRAPPER}} .ova-card-image .card-image-content .desc',
				]
			);

			$this->add_responsive_control(
				'desc_margin',
				[
					'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-card-image .card-image-content .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$items 		= $settings['items'];
		$column 	= $settings['column'];
        
		?>

		<?php if ( $items ): ?>
             
			<div class="ova-card-image <?php echo esc_html( $column ); ?>">
			 	<?php foreach( $items as $item ):
			 		$url 	= $item['image']['url'];
			 		$title 	= $item['title'];
			 		$desc 	= $item['desc'];
			 	?>
			 		<div class="card-image-content">
					    <div class="card-image">
					    	<img src="<?php echo esc_url( $url );?>">
					    </div>
						
						<?php if ( ! empty( $title ) ): ?>
							<div class="title">
								<?php echo esc_html( $title ); ?>
						   	</div>
						<?php endif ?>

						<?php if ( ! empty( $desc ) ): ?>
							<div class="desc">
								<?php echo esc_html( $desc ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
		    </div>
		<?php
		endif;
	}


}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Card_Image() );