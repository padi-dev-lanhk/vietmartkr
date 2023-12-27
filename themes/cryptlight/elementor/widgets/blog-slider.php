<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cryptlight_Elementor_Blog_Slider extends Widget_Base {
	
	public function get_name() {
		return 'cryptlight_elementor_blog_slider';
	}

	public function get_title() {
		return esc_html__( 'Blog Slider', 'cryptlight' );
	}

	public function get_icon() {
		return 'eicon-post-slider';
	}

	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_script_depends() {
		wp_enqueue_style( 'owl-carousel', get_theme_file_uri('/assets/libs/carousel/assets/owl.carousel.min.css') );
		wp_enqueue_script( 'owl-carousel', get_theme_file_uri('/assets/libs/carousel/owl.carousel.min.js'), array('jquery'), false, true );
		return [ 'cryptlight-elementor-blog-slider' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		$this->start_controls_section(
			'section_blog',
			[
				'label' => esc_html__( 'Blog', 'cryptlight' ),
			]
		);	
			
			$args = array(
	           'orderby' 	=> 'name',
	           'order'   	=> 'ASC'
	       	);
		
			$categories 	= get_categories( $args );
			$category_all 	= array( 'all' => 'All');
			$category_data 	= array();

			if ( $categories ) {
				foreach ( $categories as $cate ) {
					$category_data[$cate->slug] = $cate->cat_name;
				}
			} else {
				$category_data[""] = esc_html__( 'Categories not Found', 'cryptlight' );
			}

			$this->add_control(
				'category',
				[
					'label'   => esc_html__( 'Category', 'cryptlight' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => array_merge( $category_all, $category_data )
				]
			);

			$this->add_control(
				'total_posts',
				[
					'label'   => esc_html__( 'Total Number Of Posts', 'cryptlight' ),
					'type'    => Controls_Manager::NUMBER,
					'min'     => 1,
					'default' => 8,
				]
			);

			$this->add_control(
				'order_by',
				[
					'label'   => esc_html__( 'Order By', 'cryptlight' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'date',
					'options' => [
						'date' 	=> esc_html__( 'Date', 'cryptlight' ),
						'title' => esc_html__( 'Title', 'cryptlight' ),
						'ID'	=> esc_html__( 'ID', 'cryptlight' ),					
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label'   => esc_html__( 'Order', 'cryptlight' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'DESC',
					'options' => [
						'DESC' => esc_html__( 'Descending', 'cryptlight' ),
						'ASC'  => esc_html__( 'Ascending', 'cryptlight' ),
						
					],

				]
			);

			$this->add_control(
				'text_readmore',
				[
					'label' 	=> esc_html__( 'Text Read More', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__('Read More', 'cryptlight'),
				]
			);

			$this->add_control(
				'show_date',
				[
					'label' 		=> esc_html__( 'Show Date', 'cryptlight' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' 	=> esc_html__( 'Hide', 'cryptlight' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'show_comment',
				[
					'label' 		=> esc_html__( 'Show Comment', 'cryptlight' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' 	=> esc_html__( 'Hide', 'cryptlight' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'show_content',
				[
					'label' 		=> esc_html__( 'Show Content', 'cryptlight' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' 	=> esc_html__( 'Hide', 'cryptlight' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
				]
			);

			$this->add_control(
				'content_limit',
				[
					'label' 	=> esc_html__( 'Content Limit', 'cryptlight' ),
					'type' 		=> Controls_Manager::NUMBER,
					'default' 	=> esc_html__('11', 'cryptlight'),
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => esc_html__( 'Additional Options', 'cryptlight' ),
			]
		);

			$this->add_control(
				'margin_items',
				[
					'label'   => esc_html__( 'Margin Right Items', 'cryptlight' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 30,
				]
				
			);

			$this->add_control(
				'item_number',
				[
					'label'       => esc_html__( 'Item Number', 'cryptlight' ),
					'type'        => Controls_Manager::NUMBER,
					'default'     => 3,
				]
			);

			$this->add_control(
				'slides_to_scroll',
				[
					'label'       => esc_html__( 'Slides to Scroll', 'cryptlight' ),
					'type'        => Controls_Manager::NUMBER,
					'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'cryptlight' ),
					'default'     => 1,
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'   => esc_html__( 'Pause on Hover', 'cryptlight' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'cryptlight' ),
						'no'  => esc_html__( 'No', 'cryptlight' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'infinite',
				[
					'label'   => esc_html__( 'Infinite Loop', 'cryptlight' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'cryptlight' ),
						'no'  => esc_html__( 'No', 'cryptlight' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'   => esc_html__( 'Autoplay', 'cryptlight' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'cryptlight' ),
						'no'  => esc_html__( 'No', 'cryptlight' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => esc_html__( 'Autoplay Speed', 'cryptlight' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 3000,
					'step'      => 500,
					'condition' => [
						'autoplay' => 'yes',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'smartspeed',
				[
					'label'   => esc_html__( 'Smart Speed', 'cryptlight' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 500,
				]
			);

			$this->add_control(
				'dot_control',
				[
					'label'   => esc_html__( 'Show Dots', 'cryptlight' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'cryptlight' ),
						'no'  => esc_html__( 'No', 'cryptlight' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'nav_control',
				[
					'label'   => esc_html__( 'Show Nav', 'cryptlight' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'options' => [
						'yes' => esc_html__( 'Yes', 'cryptlight' ),
						'no'  => esc_html__( 'No', 'cryptlight' ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
	            'nav_position',
	            [
	                'label' 	=> esc_html__( 'Position', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SELECT,
	                'options' 	=> [
	                    'nav_v1' => esc_html__( 'Type 1', 'cryptlight' ),
	                    'nav_v2' => esc_html__( 'Type 2', 'cryptlight' ),
	                ],
	                'default' 	=> 'nav_v1',
	                'condition' => [
						'nav_control' => 'yes',
					],
	            ]
	        );

			$this->add_control(
				'nav_left',
				[
					'label'       	=> esc_html__( 'Icon Left', 'cryptlight' ),
					'type'        	=> Controls_Manager::TEXT,
					'default'     	=> esc_html__( 'iconly-Arrow-Left-2 icli', 'cryptlight' ),
					'condition' 	=> [
						'nav_control' => 'yes',
					],
				]
			);

			$this->add_control(
				'nav_right',
				[
					'label'       	=> esc_html__( 'Icon Right', 'cryptlight' ),
					'type'        	=> Controls_Manager::TEXT,
					'default'     	=> esc_html__( 'iconly-Arrow-Right-2 icli', 'cryptlight' ),
					'condition' 	=> [
						'nav_control' => 'yes',
					],
				]
			);

		$this->end_controls_section();

		/* Begin Blog Slider Style */
		$this->start_controls_section(
            'blog_slide_style',
            [
                'label' => esc_html__( 'Blog Slider', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_control(
				'blog_slide_background',
				[
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage' => 'background-color: {{VALUE}};',
					],
				]
			);

        $this->end_controls_section();
        /* End Slider Style */

		/* Begin Item Style */
		$this->start_controls_section(
            'item_style',
            [
                'label' => esc_html__( 'Item', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_control(
				'item_background',
				[
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'item_border',
	                'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item',
	            ]
	        );

			$this->add_control(
	            'item_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'item_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'item_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'item_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item',
				]
			);

        $this->end_controls_section();
        /* End Item Style */

		/* Begin Image Style */
		$this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__( 'Image', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_control(
				'image_size',
				[
					'label' 	=> esc_html__( 'Custom Size', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Yes', 'cryptlight' ),
					'label_off' => esc_html__( 'No', 'cryptlight' ),
					'default' 	=> 'no',
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
						'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-media img' => 'width: {{SIZE}}{{UNIT}} !important;',
					],
					'condition' => [
						'image_size' => 'yes',
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
						'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-media img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
					],
					'condition' => [
						'image_size' => 'yes',
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
						'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-media img' => 'height: {{SIZE}}{{UNIT}} !important;',
					],
					'condition' => [
						'image_size' => 'yes',
					],
				]
			);

        $this->end_controls_section();
        /* End Image Style */

        /* Begin Content Style */
		$this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__( 'Content', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_responsive_control(
	            'content_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-title',
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
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-title' => 'color: {{VALUE}}',
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
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item:hover .blog-slider-wrapper .wrap-article .ova-post-content .post-title' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'title_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Title Style */

        /* Begin Meta Style */
		$this->start_controls_section(
            'meta_style',
            [
                'label' => esc_html__( 'Meta', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'meta_border',
	                'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta',
	                'separator' => 'before',
	            ]
	        );

        	$this->add_responsive_control(
	            'meta_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        	$this->add_responsive_control(
	            'meta_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

			$this->add_control(
				'icon_options',
				[
					'label' 	=> esc_html__( 'Icon Style', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' 		=> 'icon_typography',
						'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-date i, {{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-comment i',
					]
				);

				$this->add_control(
		            'icon_color',
		            [
		                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
		                'type' 		=> Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-date i' => 'color: {{VALUE}}',
		                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-comment i' => 'color: {{VALUE}}',
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
		                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-date i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-comment i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

		    $this->add_control(
				'text_options',
				[
					'label' 	=> esc_html__( 'Text Style', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' 		=> 'text_typography',
						'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-date .date, {{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-comment a',
					]
				);

				$this->add_control(
		            'text_color',
		            [
		                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
		                'type' 		=> Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-date .date' => 'color: {{VALUE}}',
		                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-comment a' => 'color: {{VALUE}}',
		                ],
		            ]
		        );

		        $this->add_control(
		            'comment_color_hover',
		            [
		                'label' 	=> esc_html__( 'Comment Color Hover', 'cryptlight' ),
		                'type' 		=> Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-comment a:hover' => 'color: {{VALUE}}',
		                ],
		            ]
		        );

		        $this->add_responsive_control(
		            'date_margin',
		            [
		                'label' 		=> esc_html__( 'Date Margin', 'cryptlight' ),
		                'type' 			=> Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%', 'em' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-meta .post-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

        $this->end_controls_section();
        /* End Meta Style */

        /* Begin Description Style */
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
					'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-content',
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
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-content' => 'color: {{VALUE}}',
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
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item:hover .blog-slider-wrapper .wrap-article .ova-post-content .post-content' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'description_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Description Style */

        /* Begin Button Style */
		$this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'button_typography',
					'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-readmore .btn-readmore',
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
			            'button_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-readmore .btn-readmore' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'button_background_normal',
							'label' 	=> esc_html__( 'Background', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-readmore .btn-readmore',
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
			            'button_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-readmore .btn-readmore:hover' => 'color: {{VALUE}};',
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
							'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-readmore .btn-readmore:hover',
						]
					);

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'button_border',
	                'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-readmore .btn-readmore',
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
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-readmore .btn-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'button_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-readmore .btn-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'button_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-readmore .btn-readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'button_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-stage-outer .owl-stage .owl-item .blog-slider-wrapper .wrap-article .ova-post-content .post-readmore .btn-readmore',
				]
			);

        $this->end_controls_section();
        /* End Button Style */

		/* Begin Nav_v1 Style */
		$this->start_controls_section(
            'nav_v1_style',
            [
                'label' => esc_html__( 'Nav', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
                'condition' => [
                	'nav_position' => 'nav_v1',
                ],
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'nav_v1_typography',
					'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav button i',
				]
			);

			$this->add_responsive_control(
				'nav_v1_size',
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
						'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav button' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_nav_v1_style' );

				$this->start_controls_tab(
		            'tab_nav_v1_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'nav_v1_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav button i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'nav_v1_bg_gradient_normal',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav button',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_nav_v1_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'nav_v1_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav button:hover i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'nav_v1_bg_gradient_hover',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav button:hover',
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'nav_v1_border',
	                'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav button',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'nav_v1_border_color_hover',
	            [
	                'label' 	=> esc_html__( 'Border Color Hover', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav button:hover' => 'border-color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_control(
	            'nav_v1_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'nav_v1_top',
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
							'min' => -1000,
							'max' => 1000,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'size_units' 	=> [ 'px', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
					],
				]
			);

	        $this->add_responsive_control(
	            'nav_v1_margin_prev',
	            [
	                'label' 		=> esc_html__( 'Margin Prev', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav button.owl-prev' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'nav_v1_margin_next',
	            [
	                'label' 		=> esc_html__( 'Margin Next', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v1 .owl-nav button.owl-next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Nav_v1 Style */

        /* Begin Nav_v2 Style */
		$this->start_controls_section(
            'nav_v2_style',
            [
                'label' => esc_html__( 'Nav', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
                'condition' => [
                	'nav_position' => 'nav_v2',
                ],
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'nav_v2_typography',
					'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button i',
				]
			);

			$this->add_responsive_control(
				'nav_v2_size',
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
						'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_nav_v2_style' );

				$this->start_controls_tab(
		            'tab_nav_v2_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'nav_v2_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'nav_v2_bg_gradient_normal',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button',
						]
					);

					$this->add_control(
						'nav_v2_opacity_normal',
						[
							'label' 		=> esc_html__( 'Opacity', 'cryptlight' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'min' 	=> 0,
									'max' 	=> 1,
									'step' 	=> 0.1,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button' => 'opacity: {{SIZE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_nav_v2_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'nav_v2_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button:hover i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'nav_v2_bg_gradient_hover',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button:hover',
						]
					);

					$this->add_control(
						'nav_v2_opacity_hover',
						[
							'label' 		=> esc_html__( 'Opacity', 'cryptlight' ),
							'type' 			=> Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'min' 	=> 0,
									'max' 	=> 1,
									'step' 	=> 0.1,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button:hover' => 'opacity: {{SIZE}}',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'nav_v2_border',
	                'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'nav_v2_border_color_hover',
	            [
	                'label' 	=> esc_html__( 'Border Color Hover', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button:hover' => 'border-color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_control(
	            'nav_v2_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'nav_v2_margin_prev',
	            [
	                'label' 		=> esc_html__( 'Margin Prev', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav button.owl-prev' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'nav_v2_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel.nav_v2 .owl-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* End Nav_v2 Style */

        /* Begin Dots Style */
		$this->start_controls_section(
            'dots_style',
            [
                'label' => esc_html__( 'Dots', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

			$this->start_controls_tabs( 'tabs_dots_style' );
				
				$this->start_controls_tab(
		            'tab_dots_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'dots_bg_gradient_normal',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-dots .owl-dot span',
						]
					);

					$this->add_responsive_control(
						'dots_width',
						[
							'label' 	=> esc_html__( 'Width', 'cryptlight' ),
							'type' 		=> Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'size_units' 	=> [ 'px' ],
							'selectors' 	=> [
								'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-dots .owl-dot span' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_responsive_control(
						'dots_height',
						[
							'label' 	=> esc_html__( 'Height', 'cryptlight' ),
							'type' 		=> Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'size_units' 	=> [ 'px' ],
							'selectors' 	=> [
								'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-dots .owl-dot span' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_control(
			            'dots_border_radius',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
			                'type' 			=> Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', '%' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-dots .owl-dot span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_dots_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'dots_bg_gradient_hover',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-dots .owl-dot span:hover',
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_dots_active',
		            [
		                'label' => esc_html__( 'Active', 'cryptlight' ),
		            ]
		        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'dots_bg_gradient_active',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-dots .owl-dot.active span',
						]
					);

					$this->add_responsive_control(
						'dots_width_active',
						[
							'label' 	=> esc_html__( 'Width', 'cryptlight' ),
							'type' 		=> Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'size_units' 	=> [ 'px' ],
							'selectors' 	=> [
								'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-dots .owl-dot.active span' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_responsive_control(
						'dots_height_active',
						[
							'label' 	=> esc_html__( 'Height', 'cryptlight' ),
							'type' 		=> Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'size_units' 	=> [ 'px' ],
							'selectors' 	=> [
								'{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-dots .owl-dot.active span' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_control(
			            'dots_border_radius_active',
			            [
			                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
			                'type' 			=> Controls_Manager::DIMENSIONS,
			                'size_units' 	=> [ 'px', '%' ],
			                'selectors' 	=> [
			                    '{{WRAPPER}} .ova-blog-slide .ova-wrapper-blog.owl-carousel .owl-dots .owl-dot.active span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

        $this->end_controls_section();
        /* End Dots Style */
	}

	protected function get_blog_data() {
		$settings = $this->get_settings();

		$category 		= $settings['category'];
		$total_posts 	= $settings['total_posts'];
		$order_by 		= $settings['order_by'];
		$order 			= $settings['order'];

		$args = [];

		if ( $category == 'all' ) {
			$args = [
				'post_type' 		=> 'post',
				'posts_per_page' 	=> $total_posts,
				'orderby'			=> $order_by,
				'order' 			=> $order,
			];
		} else {
			$args = [
				'post_type' 		=> 'post', 
				'category_name'		=> $category,
				'posts_per_page' 	=> $total_posts,
				'orderby'			=> $order_by,
				'order' 			=> $order,
			];
		}

		$blogs = new \WP_Query( $args );

		return $blogs;
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$readmore 		= $settings['text_readmore'];
		$show_date 		= $settings['show_date'];
		$show_comment 	= $settings['show_comment'];
		$show_content 	= $settings['show_content'];
		$content_limit 	= $settings['content_limit'];

		// Additional Options
		$data_options['items']              = $settings['item_number'];
		$data_options['slideBy']            = $settings['slides_to_scroll'];
		$data_options['margin']             = $settings['margin_items'];
		$data_options['autoplayHoverPause'] = $settings['pause_on_hover'] === 'yes' ? true : false;
		$data_options['loop']               = $settings['infinite'] === 'yes' ? true : false;
		$data_options['autoplay']           = $settings['autoplay'] === 'yes' ? true : false;
		$data_options['autoplayTimeout']    = $settings['autoplay_speed'];
		$data_options['smartSpeed']         = $settings['smartspeed'];
		$data_options['dots']               = $settings['dot_control'] === 'yes' ? true : false;
		$data_options['nav']               	= $settings['nav_control'] === 'yes' ? true : false;
		$data_options['nav_left']           = $settings['nav_left'] ? $settings['nav_left'] : 'iconly-Arrow-Left-2 icli';
		$data_options['nav_right']          = $settings['nav_right'] ? $settings['nav_right'] : 'iconly-Arrow-Right-2 icli';

		$nav_position = $settings['nav_position'];

		// Get blog data
		$blogs 		= $this->get_blog_data();

		?>

		<div class="ova-blog-slide">
			<div class="ova-wrapper-blog owl-carousel owl-theme <?php echo esc_attr( $nav_position ); ?>" data-options="<?php echo esc_attr( json_encode( $data_options ) ); ?>">
				<?php if ( $blogs->have_posts() ) : while( $blogs->have_posts() ) : $blogs->the_post(); ?>
					<article class="blog-slider-wrapper">
						<div class="wrap-article">
						<?php 
									$link = get_field('link_newspaper');
									if( $link ): ?>
										<div class="link-newspaper">
											<a class="button link-post-news" target="_blank" href="<?php echo esc_url( $link ); ?>"></a>
										</div>
								<?php endif; ?>
							<div class="ova-post-media">
								<a href="<?php echo get_the_permalink() ?>" title="<?php echo get_the_title(); ?>">
									<?php
										if ( has_post_thumbnail()  && ! post_password_required() || has_post_format( 'image') ) {
											the_post_thumbnail( apply_filters( 'ova_blog_thumbnail_size','full' ), array('class'=> 'blog-slider-img-responsive' ));
										} else {
										?>
											<img src="<?php echo esc_url(Utils::get_placeholder_image_src()); ?>" alt="">
										<?php
										}
									?>
								</a>
							</div>
							<div class="ova-post-content">
								<?php 
									$image = get_field('logo_news');
									if( !empty( $image ) ): ?>
										<div class="logo-newspaper">
											<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
										</div>
								<?php endif; ?>
								<div class="post-title">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<h2 class="post-title"><?php the_title(); ?></h2>
							    	</a>
								</div>
								
								<div class="post-meta">
									<?php if ( 'yes' == $show_date ): ?>
										<div class="post-date">
											<i class="iconly-Time-Circle icli"></i>
											<span class="date"><?php the_time( get_option( 'date_format' ));?></span>
										</div>
									<?php endif; ?>
									<?php if ( 'yes' == $show_comment ): ?>
										<div class="post-comment">
											<i class="iconly-More-Circle icli"></i>
								            <?php comments_popup_link(
								            	esc_html__(' 0', 'cryptlight'), 
								            	esc_html__(' 1 Comment', 'cryptlight'), 
								            	' % Comment',
								            	'',
						                  		esc_html__( 'Comment off', 'cryptlight' )
								            ); ?>
										</div>
									<?php endif; ?>
								</div>
								<?php if ( 'yes' == $show_content ): ?>
									<div class="post-content">
										<?php echo wp_trim_words( get_the_content(), $content_limit, esc_html__( '...', 'cryptlight' ) ); ?>
									</div>
								<?php endif; ?>
								<?php if ( $readmore ): ?>
									<div class="post-readmore">
										<a class="btn-readmore" href="<?php the_permalink(); ?>">
								    		<?php echo esc_html( $readmore ) ?>
								    	</a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
			</div>
		</div>
		 	
		<?php
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Blog_Slider() );