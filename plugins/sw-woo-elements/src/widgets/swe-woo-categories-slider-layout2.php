<?php 
namespace SWWE\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Plugin as ElementorPlugin;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;

/**
 * SWE_Woo_Categories_Slider
 *
 * @author Youtech
 * @package SWE
 */

if (class_exists('WooCommerce')) {
    final class SWE_Woo_Categories_Slider_Layout2 extends SWE_Widget_Base {
        /**
         * @return string
         */
        function get_name() {
            return 'swe-woo-categories-slider-layout2';
        }

        /**
         * @return string
         */
        function get_title() {
            return esc_html__('SWE Woo Categories Slider Layout2', 'sw-woo-elements');
        }

        /**
         * @return array
         */
        public function get_categories() {
            return [ 'sw-woocommerce-elements' ];
        }

        /**
         * @return string
         */
        function get_icon() {
            return 'eicon-product-categories';
        }

        public function get_style_depends() {
            return ['slick'];
        }

        /**
         * @return array Widget scripts dependencies.
         */
        public function get_script_depends() {
            return [ 'slick', 'swwe-script' ];
        }

        /**
         * Register controls
         */
        public function register_controls() {

            /**
            * Content Settings
            */
            $this->start_controls_section( 'content_settings', [
                'label' => __( 'Settings', 'sw-woo-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]);
			
			$this->add_control( 'title', [
                'label' => esc_html__('Title', 'sw-woo-elements'),
                'description' => esc_html__('', 'sw-woo-elements'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Categories Name', 'sw-woo-elements' ),
            ]);
			
            $this->add_control( 'product_cats', [
                'label' => __( 'Categories', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => $this->get_woo_categories(0),
            ]);

            $this->add_control( 'show_image', [
                'label' => __( 'Show Image', 'sw-woo-elements' ),
                'description' => __('Display thumbnail of product Child category', 'sw-woo-elements'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]);
			
			$this->add_control( 'show_product_count', [
                'label' => __( 'Show Product Count', 'sw-woo-elements' ),
                'description' => __('Display Product Count of Child Category', 'sw-woo-elements'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]);
			
            // $this->add_group_control( Group_Control_Image_Size::get_type(), [
            //     'name' => 'thumbnail',
            //     'exclude' => [ 'custom' ],
            //     'include' => [],
            //     'default' => 'medium',
            // ]);

            $this->add_control( 'show_description', [
                'label' => __( 'Show Description', 'sw-woo-elements' ),
                'description' => __('Display description of product category', 'sw-woo-elements'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => '',
            ]);
			
			 $this->add_control('number_child', [
                'label' => __( 'Number Child', 'sw-woo-elements' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 5,
            ]);
			
            $this->add_control('layout_style', [
                'label' => __( 'Layout style', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style-1' => __('Style 1', 'sw-woo-elements'),
                    'style-2' => __('Style 2', 'sw-woo-elements'),
                    'style-3' => __('Style 3', 'sw-woo-elements'),
                ],
                'default' => 'style-1'
            ]);

            $this->end_controls_section();
		
            /**
            * Slider Config
            */
            $this->start_controls_section( 'slider_config', [
                'label' => __( 'Slider Config', 'sw-woo-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_responsive_control('slides_to_show', [
                'label' => __( 'Slides To Show', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 8,
                    ],
                ],
                'desktop_default' => [
                    'size' => 4,
                ],
                'tablet_default' => [
                    'size' => 3,
                ],
                'mobile_default' => [
                    'size' => 2,
                ],
            ]);

            $this->add_responsive_control('slides_to_rows', [
                'label' => __( 'Slides To Rows', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 3,
                    ],
                ],
                'desktop_default' => [
                    'size' => 1,
                ],
            ]);

            $this->add_control('slides_to_scroll', [
                'label' => __( 'Slides To Scroll', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 8,
                    ],
                ],
                'default' => [
                    'size' => 1
                ]
            ]);

            $this->add_responsive_control('slides_space', [
                'label' => __( 'Space Items', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slider .slick-list' => 'margin: 0 calc(-{{SIZE}}px/2);',
                    '{{WRAPPER}} .slick-slider .slick-slide' => 'margin: 0 calc({{SIZE}}px/2);',
                ],
            ]);

            $this->add_responsive_control( 'arrows', [
                'label' => __( 'Arrows', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]);

            $this->add_responsive_control( 'dots', [
                'label' => __( 'Dots', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]);

            $this->add_control( 'pause_on_hover', [
                'label' => __( 'Pause On Hover', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]);

            $this->add_control( 'autoplay', [
                'label' => __( 'Autoplay', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]);

            $this->add_control('autoplay_speed', [
                'label' => __( 'Autoplay Speed', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 3
                ]
            ]);

            $this->add_control( 'infinite', [
                'label' => __( 'Loop', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]);

            $this->add_control( 'lazyload', [
                'label' => __( 'Lazy Load', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ondemand' => __('Ondemand', 'sw-woo-elements'),
                    'progressive' => __('Progressive', 'sw-woo-elements')
                ],
                'default' => 'progressive',
            ]);

            $this->end_controls_section();

            /**
            * Style tab content
            */
			
            /**
            * Style wrap title
            */
            $this->start_controls_section( 'section_style_wrap_title', [
                'label' => __( 'Title', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'title!' => ''
                ]
            ]);

            $this->add_responsive_control( 'wrap_title_position', [
                'label'                => __( 'Position', 'sw-woo-elements' ),
                'type'                 => Controls_Manager::CHOOSE,
                'label_block'          => false,
                'options'              => $this->getOptionPosition('hor'),
                'selectors'            => [
                    '{{WRAPPER}} .swe-wrap-head' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left'   => 'justify-content: flex-start;',
                    'center' => 'justify-content: center;',
                    'right'  => 'justify-content: flex-end;',
                ],
            ]);

            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_title_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .swe-title',
            ]);

            $this->add_control( 'wrap_title_color', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-head .swe-title' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_title_bg', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-head .swe-title' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_group_control( Group_Control_Border::get_type(), [
                'name' => 'wrap_title_border',
                'label' => __( 'Border', 'sw-woo-elements' ),
                'selector' => '{{WRAPPER}} .swe-wrap-head .swe-title',
            ]);

            $this->add_control( 'wrap_title_border_radius', [
                'label'     => __( 'Border Radius', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-head .swe-title' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->add_responsive_control( 'wrap_title_padding', [
                'label'      => __( 'Padding', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-head .swe-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

            $this->add_responsive_control( 'wrap_title_margin', [
                'label'      => __( 'Margin', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-head .swe-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

            $this->end_controls_section();
			
            $this->start_controls_section( 'section_style_wrap_item', [
                'label' => __( 'Items', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control( 'wrap_item_padding', [
                'label'      => __( 'Padding', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

            $this->add_group_control( Group_Control_Border::get_type(), [
                'name' => 'wrap_item_border',
                'label' => __( 'Border', 'sw-woo-elements' ),
                'selector' => '{{WRAPPER}} .swe-wrap-item',
            ]);

            $this->add_control( 'wrap_item_border_radius', [
                'label'     => __( 'Border Radius', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-item' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->start_controls_tabs( 'wrap_item_tabs' );
            $this->start_controls_tab( 'wrap_item_normal', [
                'label' => __( 'Normal', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_item_background', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-item' => 'background: {{VALUE}};',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab( 'wrap_item_hover', [
                'label' => __( 'Hover', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_item_background_hover', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-item:hover' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_item_border_hover', [
                'label' => __( 'Border Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]);
            
            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->end_controls_section();
            
            /**
            * Style wrap title
            */
            $this->start_controls_section( 'section_style_wrap_image', [
                'label' => __( 'Image', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image' => 'yes'
                ]
            ]);

            $this->add_responsive_control('wrap_image_width', [
                'label' => __( 'Width', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-image' => 'width: {{SIZE}}{{UNIT}};flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->add_control( 'wrap_image_fix', [
                'label' => __( 'Fix Image', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'sw-woo-elements' ),
                'label_off' => __( 'No', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]);

            $this->add_responsive_control('wrap_image_height', [
                'label' => __( 'Height', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-image' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .swe-wrap-image img' => 'height: 100%;object-fit: cover;width: 100%;',
                ],
                'condition' => [
                    'wrap_image_fix' => 'yes'
                ]
            ]);

            $this->add_group_control( Group_Control_Border::get_type(), [
                'name' => 'wrap_image_border',
                'label' => __( 'Border', 'sw-woo-elements' ),
                'selector' => '{{WRAPPER}} .swe-wrap-image',
            ]);

            $this->add_control( 'wrap_image_border_radius', [
                'label'     => __( 'Border Radius', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-image' => 'overflow: hidden;border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]);
			
            $this->start_controls_tabs( 'wrap_image_tabs' );
            $this->start_controls_tab( 'wrap_image_normal', [
                'label' => __( 'Normal', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_image_background', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-image' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_image_opacity', [
                'label'     => __( 'Opacity', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'  => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-image img' => 'opacity: {{SIZE}};',
                ],
            ]);
			
			$this->add_responsive_control( 'wrap_title_padding_image', [
                'label'      => __( 'Padding', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-item .swe-wrap-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

            $this->add_responsive_control( 'wrap_title_margin_image', [
                'label'      => __( 'Margin', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-item .swe-wrap-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);
			
            $this->end_controls_tab();

            $this->start_controls_tab( 'wrap_image_hover', [
                'label' => __( 'Hover', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_image_background_hover', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-item:hover .swe-wrap-image' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_image_opacity_hover', [
                'label'     => __( 'Opacity', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'  => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-item:hover .swe-wrap-image img' => 'opacity: {{SIZE}};',
                ],
            ]);
			
            $this->end_controls_tab();
            $this->end_controls_tabs();






            $this->end_controls_section();
            
            /**
            * Style wrap content
            */
            $this->start_controls_section( 'section_style_wrap_content', [
                'label' => __( 'Content', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]);

            $this->add_responsive_control( 'wrap_content_align', [
                'label'                => __( 'Align', 'sw-woo-elements' ),
                'type'                 => Controls_Manager::CHOOSE,
                'label_block'          => false,
                'options'              => [
                    'left'   => [
                        'title' => __( 'Left', 'sw-woo-elements' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'sw-woo-elements' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'sw-woo-elements' ),
                        'icon'  => 'eicon-h-align-right',
                    ]
                ],
                'selectors'            => [
                    '{{WRAPPER}} .swe-wrap-content' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left'   => 'align-items: flex-start;',
                    'right'   => 'align-items: flex-end;',
                    'center'   => 'align-items: center;',
                ],
            ]);

            $this->add_responsive_control( 'wrap_content_padding', [
                'label'      => __( 'Padding', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

            $this->end_controls_section();
            
            /**
            * Style wrap title
            */
            $this->start_controls_section( 'section_style_wrap_title_child_cat', [
                'label' => __( 'Title Child Cat & Description', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]);
			
			 $this->add_control( 'wrap_title_heading_cat', [
                'label' => __( 'Title Cat Parrent', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
            ]);
			
			 $this->start_controls_tabs( 'wrap_cat_tabs' );
			 $this->start_controls_tab( 'wrap_cat_normal', [
					'label' => __( 'Normal', 'sw-woo-elements' ),
				]);
            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_title_typography_cat',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .swe-wrap-content .swe-title a',
            ]);

            $this->add_control( 'wrap_title_color_cat', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-content .swe-title a' => 'color: {{VALUE}};',
                ],
            ]);
			
			$this->add_control( 'wrap_cat_background', [
                'label' => __( 'Background Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-content .swe-title a' => 'background: {{VALUE}};',
                ],
            ]);
			$this->end_controls_tab();
			
			$this->start_controls_tab( 'wrap_cat_hover', [
                'label' => __( 'Hover', 'sw-woo-elements' ),
            ]);
			
			
            $this->add_control( 'wrap_title_cat_color_hover', [
                'label' => __( 'Color hover', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-content .swe-title a:hover' => 'color: {{VALUE}};',
                ],
            ]);
			
            $this->add_control( 'wrap_cat_background_hover', [
                'label' => __( 'Background Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-content .swe-title a:hover' => 'background: {{VALUE}};',
                ],
            ]);
            
			$this->add_control( 'wrap_cat_border_hover', [
                'label' => __( 'Border Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-content .swe-title a:hover' => 'border-color: {{VALUE}};',
                ],
            ]);
			
            $this->end_controls_tab();
			$this->end_controls_tabs();
			
			$this->add_group_control( Group_Control_Border::get_type(), [
                'name' => 'wrap_cat_border',
                'label' => __( 'Border', 'sw-woo-elements' ),
                'selector' => '{{WRAPPER}} .swe-wrap-content .swe-title a',
            ]);

            $this->add_control( 'wrap_cat_border_radius', [
                'label'     => __( 'Border Radius', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-content .swe-title a' => 'overflow: hidden;border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]);
			
            $this->add_responsive_control( 'wrap_title_padding_cat', [
                'label'      => __( 'Padding', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-content .swe-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);
	

            $this->add_control( 'wrap_title_heading_child_cat', [
                'label' => __( 'Title Child Cat', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
            ]);

            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_title_typography_child_cat',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .swe-wrap-child-cat ul li a',
            ]);

            $this->add_control( 'wrap_title_color_child_cat', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-child-cat ul li a' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_title_child_cat_color_hover', [
                'label' => __( 'Color hover', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-child-cat ul li a:hover' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_responsive_control( 'wrap_title_padding_child_cat', [
                'label'      => __( 'Padding', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-child-cat ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

            $this->add_responsive_control( 'wrap_title_margin_child_cat', [
                'label'      => __( 'Margin', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-child-cat ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

            $this->add_control( 'wrap_description_heading', [
                'label' => __( 'Description', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]);

            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_description_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .swe-description',
            ]);

            $this->add_control( 'wrap_description_color', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-description' => 'color: {{VALUE}};',
                ],
            ]);

            $this->end_controls_section();
			
			$this->start_controls_section( 'section_style_wrap_product_count', [
                'label' => __( 'Product Count', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]);

            $this->add_control( 'wrap_title_heading_product_count', [
                'label' => __( 'Title', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
            ]);

            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_title_typography_product_count',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .product-count',
            ]);

            $this->add_control( 'wrap_title_color_product_count', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-count' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_title_product_count_color_hover', [
                'label' => __( 'Color hover', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-count:hover' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_responsive_control( 'wrap_title_padding_product_count', [
                'label'      => __( 'Padding', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-content .product-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

            $this->add_responsive_control( 'wrap_title_margin_product_count', [
                'label'      => __( 'Margin', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-content .product-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);
			
			 $this->end_controls_section();

            /**
            * Style Arrows and dots
            */
            $this->start_controls_section( 'section_style_arrows_and_dots', [
                'label' => __( 'Arrows & dots', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]);

            $this->add_control( 'section_style_arrows', [
                'label' => __( 'Arrows', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
            ]);

            $this->add_responsive_control('slider_arrows_space', [
                'label' => __( 'Space', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-slider .swe-slider-btn.prev-item' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .swe-slider .swe-slider-btn.next-item' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->add_responsive_control('slider_arrows_block', [
                'label' => __( 'Block', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-slider .swe-slider-btn' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->add_responsive_control('slider_arrows_size', [
                'label' => __( 'Size', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-slider .swe-slider-btn' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->start_controls_tabs( 'slider_arrows_tabs' );

            $this->start_controls_tab( 'slider_arrows_normal', [
                'label' => __( 'Normal', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'slider_arrows_color', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-slider .swe-slider-btn' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'slider_arrows_bg', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-slider .swe-slider-btn' => 'background: {{VALUE}};',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab( 'slider_arrows_hover', [
                'label' => __( 'Hover', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'slider_arrows_color_hover', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-slider .swe-slider-btn:hover' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'slider_arrows_bg_hover', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-slider .swe-slider-btn:hover' => 'background: {{VALUE}};',
                ],
            ]);
            
            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_responsive_control('slider_arrows_border_radius', [
                'label' => __( 'Border radius', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-slider .swe-slider-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->add_control( 'section_style_dots', [
                'label' => __( 'Dots', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]);

            $this->add_responsive_control('slider_dots_space', [
                'label' => __( 'Space', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->start_controls_tabs( 'slider_dots_tabs' );

            $this->start_controls_tab( 'slider_dots_normal', [
                'label' => __( 'Normal', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'slider_dots_bg', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_responsive_control('slider_dots_block', [
                'label' => __( 'Block', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots li' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab( 'slider_dots_hover', [
                'label' => __( 'Hover & Active', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'slider_dots_bg_hover', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li:hover, {{WRAPPER}} .slick-dots li.slick-active' => 'background: {{VALUE}};',
                ],
            ]);
            
            $this->add_responsive_control('slider_dots_active_width', [
                'label' => __( 'Width active', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots li.slick-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_responsive_control('slider_dots_border_radius', [
                'label' => __( 'Border radius', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots li' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->end_controls_section();
        }

        /**
         * Render
         */
        protected function render() {
            $settings = $this->get_settings_for_display();
            $id_int = substr( $this->get_id_int(), 0, 3 );
            $settings['id_int'] = $id_int;

            $this->add_render_attribute( 'slider_options', [
                'data-slides_to_show'   => $settings[ 'slides_to_show' ] ? $settings[ 'slides_to_show' ]['size'] : 2,
                'data-slides_to_show_tablet'   => isset($settings[ 'slides_to_show_tablet' ]) ? $settings[ 'slides_to_show_tablet' ]['size'] : 2,
                'data-slides_to_show_mobile'   => isset($settings[ 'slides_to_show_mobile' ]) ? $settings[ 'slides_to_show_mobile' ]['size'] : 2,

                'data-slides_to_rows'   => $settings[ 'slides_to_rows' ] ? $settings[ 'slides_to_rows' ]['size'] : 1,
                'data-slides_to_rows_tablet'   => isset($settings[ 'slides_to_rows_tablet' ]) ? $settings[ 'slides_to_rows_tablet' ]['size'] : 1,
                'data-slides_to_rows_mobile'   => isset($settings[ 'slides_to_rows_mobile' ]) ? $settings[ 'slides_to_rows_mobile' ]['size'] : 1,

                'data-slides_to_scroll'   => $settings[ 'slides_to_scroll' ] ? $settings[ 'slides_to_scroll' ]['size'] : 1,

                'data-arrows' => $settings[ 'arrows' ],
                'data-arrows_tablet' => $settings[ 'arrows_tablet' ],
                'data-arrows_mobile' => $settings[ 'arrows_mobile' ],

                'data-dots'   => $settings[ 'dots' ],
                'data-dots_tablet'   => $settings[ 'dots_tablet' ],
                'data-dots_mobile'   => $settings[ 'dots_mobile' ],

                'data-pause_on_hover'   => $settings[ 'pause_on_hover' ],
                'data-autoplay'   => $settings[ 'autoplay' ],
                'data-autoplay_speed'   => $settings[ 'autoplay_speed' ] ? $settings[ 'autoplay_speed' ]['size'] : 3,
                'data-infinite'   => $settings[ 'infinite' ],
                'data-lazyload' => $settings['lazyload'],

            ]);

            $settings['slider_options'] = $this->get_render_attribute_string('slider_options');

            $this->getViewTemplate('template', 'woo-categories-slider-layout2', $settings);
        }
    }

    ElementorPlugin::instance()->widgets_manager->register(new SWE_Woo_Categories_Slider_Layout2());
}
