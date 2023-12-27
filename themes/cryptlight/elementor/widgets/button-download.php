<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Cryptlight_Elementor_Button_Download extends Widget_Base {

	
	public function get_name() {
		return 'cryptlight_elementor_button_download';
	}
	
	public function get_title() {
		return esc_html__( 'Button Download', 'cryptlight' );
	}
	
	public function get_icon() {
		return 'eicon-download-button';
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
			'section_button_download',
			[
				'label' => esc_html__( 'Content', 'cryptlight' ),
			]
		);			
			
			// Add Class control
			$this->add_control(
				'title',
				[
					'label' 	=> esc_html__( 'Title', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'Dowload', 'cryptlight' ),
				]
			);

			$this->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Icon', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> 'fas fa-caret-down',
				]
			);

	        $this->add_control(
	            'button_download_alignment',
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
	                'default' 	=> 'left',
	                'selectors' => [
	                    '{{WRAPPER}} .ova-button-download' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );


			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'language',
				[
					'label' 	=> esc_html__( 'Language', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'English', 'cryptlight' ),
				]
			);

			$repeater->add_control(
	            'link',
	            [
	                'label' 		=> esc_html__( 'Link', 'cryptlight' ),
	                'type' 			=> Controls_Manager::URL,
	                'placeholder' 	=> esc_html__( 'https://your-link.com', 'cryptlight' ),
	                'default' => [
	                    'url' => '#',
	                ],
	                'dynamic' => [
	                    'active' => false,
	                ],
	            ]
	        );

			$this->add_control(
				'items',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'language' 	=> esc_html__( 'English', 'cryptlight' ),
							'link' 		=> [ 'url' =>  esc_html__( '#', 'cryptlight' ) ],
						],
						[
							'language' 	=> esc_html__( 'French', 'cryptlight' ),
							'link' 		=> [ 'url' =>  esc_html__( '#', 'cryptlight' ) ],
						],
						[
							'language' 	=> esc_html__( 'German', 'cryptlight' ),
							'link' 		=> [ 'url' =>  esc_html__( '#', 'cryptlight' ) ],
						],
					],
					'title_field' => '{{{ language }}}',
				]
			);

		$this->end_controls_section();

		/* Begin Content Style */
		$this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__( 'Content', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
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
			                    '{{WRAPPER}} .ova-button-download .button-content .title-icon' => 'background-color: {{VALUE}}',
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
			                    '{{WRAPPER}} .ova-button-download .button-content:hover .title-icon' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'content_border',
	                'selector' 	=> '{{WRAPPER}} .ova-button-download .button-content .title-icon',
	                'separator' => 'before',
	            ]
	        );

	        $this->start_controls_tabs( 'tabs_content_border_radius_style' );

				$this->start_controls_tab(
		            'tab_content_border_radius_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );
			        $this->add_control(
			            'content_border_radius_normal',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
			                'type' 			=> Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', '%' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-button-download .button-content .title-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		       	$this->start_controls_tab(
		            'tab_content_border_radius_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

			        $this->add_control(
			            'content_border_radius_hover',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
			                'type' 			=> Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', '%' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-button-download .button-content:hover .title-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'content_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-button-download .button-content .title-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
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
			                    '{{WRAPPER}} .ova-button-download .button-content .title-icon .title' => 'color: {{VALUE}}',
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
			                    '{{WRAPPER}} .ova-button-download .button-content:hover .title-icon .title' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-button-download .button-content .title-icon .title',
				]
			);

			$this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-button-download .button-content .title-icon .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-button-download .button-content .title-icon .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Title Style */

        /* Begin Icon Style */
		$this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__( 'Icon', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
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
			            'icon_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-button-download .button-content .title-icon i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_icon_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'icon_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-button-download .button-content:hover .title-icon i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography',
					'selector' 	=> '{{WRAPPER}} .ova-button-download .button-content .title-icon i',
				]
			);

			$this->add_responsive_control(
	            'icon_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-button-download .button-content .title-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'icon_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-button-download .button-content .title-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Icon Style */

        /* Begin Items Style */
		$this->start_controls_section(
            'item_style',
            [
                'label' => esc_html__( 'Items', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

	        $this->start_controls_tabs( 'tabs_item_style' );

				$this->start_controls_tab(
		            'tab_item_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'item_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-button-download .button-content .dropdown-items' 	=> 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

					$this->add_control(
			            'item_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-button-download .button-content .dropdown-items ul .language-item a' 		=> 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-button-download .button-content .dropdown-items ul .language-item span' 	=> 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_item_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'item_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-button-download .button-content .dropdown-items ul .language-item a:hover' 	=> 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-button-download .button-content .dropdown-items ul .language-item span:hover' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'item_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-button-download .button-content .dropdown-items ul .language-item a:hover' 	=> 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-button-download .button-content .dropdown-items ul .language-item span:hover' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'item_border',
	                'selector' 	=> '{{WRAPPER}} .ova-button-download .button-content .dropdown-items ul .language-item',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'item_typography',
					'selector' 	=> '{{WRAPPER}} .ova-button-download .button-content .dropdown-items ul .language-item a, .ova-button-download .button-content .dropdown-items ul .language-item span',
				]
			);

			$this->add_responsive_control(
	            'item_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-button-download .button-content .dropdown-items ul .language-item a' 		=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-button-download .button-content .dropdown-items ul .language-item span' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
        /* End Items Style */
		
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();
		$title 		= $settings['title'];
		$icon 		= $settings['icon'];
		$items 		= $settings['items'];

		?>

			<div class="ova-button-download">
				<div class="button-content">
					<div class="title-icon">
						<h3 class="title"><?php echo esc_html( $title ); ?></h3>
						<i class="<?php echo esc_html( $icon ); ?>"></i>
					</div>
					<?php if ( $items ): ?>
						<div class="dropdown-items">
							<ul>
								<?php foreach( $items as $item ): 
									$language 	= $item['language'];
									$link 		= $item['link']['url'];
								?>
									<li class="language-item">
										<?php if ( $link ): ?>
											<a href="<?php echo esc_url( $link ); ?>" download><?php echo esc_html( $language ); ?></a>
										<?php else: ?>
											<span><?php echo esc_html( $language ); ?></span>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div>
			</div>
		 	
		<?php
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Button_Download() );