<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Cryptlight_Elementor_Button extends Widget_Base {

	
	public function get_name() {
		return 'cryptlight_elementor_button';
	}

	
	public function get_title() {
		return esc_html__( 'Button', 'cryptlight' );
	}

	
	public function get_icon() {
		return 'eicon-button';
	}

	
	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		/* Begin Content */
		$this->start_controls_section(
			'section_content',
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
					'default' 	=> esc_html__( 'Button', 'cryptlight' ),
				]
			);

			$this->add_control(
	            'link',
	            [
	                'label' 		=> esc_html__( 'Link', 'cryptlight' ),
	                'type' 			=> Controls_Manager::URL,
	                'placeholder' 	=> esc_html__( 'https://your-link.com', 'cryptlight' ),
	                'default' => [
	                    'url' => '#',
	                ],
	                'dynamic' => [
	                    'active' => true,
	                ],
	            ]
	        );

	        $this->add_control(
				'icon',
				[
					'label' 	=> esc_html__( 'Icon Class', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> '',
				]
			);

			$this->add_control(
	            'icon_type',
	            [
	                'label' 	=> esc_html__( 'Type', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SELECT,
	                'options' 	=> [
	                    'before' 	=> esc_html__( 'Before', 'cryptlight' ),
	                    'after' 	=> esc_html__( 'After', 'cryptlight' ),
	                ],
	                'default' 	=> 'before',
	                'condition' => [
	                	'icon!' => '',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'button_alignment',
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
	                    '{{WRAPPER}} .ova-button' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End Content */

		/* Begin Button Style */
		$this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->start_controls_tabs( 'tabs_button_style' );
				
				$this->start_controls_tab(
		            'tab_button_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'button_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-button .url-button' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'button_bg_gradient_normal',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-button .url-button',
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_button_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'button_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-button .url-button:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'button_bg_gradient_hover',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-button .url-button:hover',
						]
					);

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'button_border',
	                'selector' 	=> '{{WRAPPER}} .ova-button .url-button',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'button_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-button .url-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'button_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-button .url-button',
				]
			);

		$this->end_controls_section();
        /* End Button Style */

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
			                    '{{WRAPPER}} .ova-button .url-button' => 'color: {{VALUE}}',
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
			                    '{{WRAPPER}} .ova-button:hover .url-button' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-button .url-button',
				]
			);

			$this->add_responsive_control(
	            'title_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-button .url-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-button .url-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 		=> 'text_shadow',
					'label' 	=> esc_html__( 'Text Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-button .url-button',
				]
			);

        $this->end_controls_section();
        /* End Title Style */

        /* Begin Icon Style */
		$this->start_controls_section(
            'icon_style',
            [
                'label' 	=> esc_html__( 'Icon', 'cryptlight' ),
                'tab' 		=> Controls_Manager::TAB_STYLE,
                'condition' => [
                	'icon!' => '',
                ],
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
			                    '{{WRAPPER}} .ova-button .url-button i' => 'color: {{VALUE}}',
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
			                    '{{WRAPPER}} .ova-button:hover .url-button i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_typography',
					'selector' 	=> '{{WRAPPER}} .ova-button .url-button i',
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'icon_border',
	                'selector' 	=> '{{WRAPPER}} .ova-button .url-button i',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'icon_border_color_hover',
	            [
	                'label' 	=> esc_html__( 'Border Color Hover', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-button:hover .url-button i' => 'border-color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_control(
	            'icon_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-button .url-button i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_responsive_control(
	            'icon_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-button .url-button i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	                    '{{WRAPPER}} .ova-button .url-button i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Icon Style */
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$title 		= $settings['title'];
		$link 		= $settings['link']['url'];
		$icon 		= $settings['icon'];
		$icon_type	= $settings['icon_type'];

		$tg_blank 	= '';
		if ( $settings['link']['is_external'] == 'on' ) {
			$tg_blank = 'target="_blank"';
		}

		?>

		<div class="ova-button">
			<?php if ( $link ): ?>
				<a href="<?php echo esc_url( $link ); ?>" class="url-button" <?php echo ''.$tg_blank; ?>>
					<?php if ( $icon ): ?>
						<?php if ( 'before' == $icon_type ): ?>
							<i class="before <?php echo ''.esc_attr( $icon ); ?>"></i>
						<?php endif; ?>

						<?php echo esc_html( $title ); ?>

						<?php if ( 'after' == $icon_type ): ?>
							<i class="after <?php echo ''.esc_attr( $icon ); ?>"></i>
						<?php endif; ?>
					<?php else: ?>
						<?php echo esc_html( $title ); ?>
					<?php endif; ?>
				</a>
			<?php else: ?>
				<?php if ( $icon ): ?>
					<?php if ( 'before' == $icon_type ): ?>
						<i class="before <?php echo ''.esc_attr( $icon ); ?>"></i>
					<?php endif; ?>

					<span class="url-button"><?php echo esc_html( $title ); ?></span>

					<?php if ( 'after' == $icon_type ): ?>
						<i class="after <?php echo ''.esc_attr( $icon ); ?>"></i>
					<?php endif; ?>
				<?php else: ?>
					<span class="url-button"><?php echo esc_html( $title ); ?></span>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		 	
		<?php
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Button() );