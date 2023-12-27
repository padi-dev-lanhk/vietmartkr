<?php 
namespace SWBE\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Plugin as ElementorPlugin;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;

/**
 * SWE_Woo_Category_Tab_Slider
 *
 * @author Youtech
 * @package SWE
 */

if (class_exists('WooCommerce')) {
    final class SWE_Woo_Product_Bundles_Grid extends Widget_Base {

        /**
         * @return string
         */
        function get_name() {
            return 'swe-woo-product-bundles-grid';
        }

        /**
         * @return string
         */
        function get_title() {
            return esc_html__('SWE Woo Product Bundles Grid', 'sw-woo-elements');
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
            return 'eicon-products';
        }

        public function get_style_depends() {
            return ['slick', 'swpb_slick_slider_css'];
        }

        /**
         * @return array Widget scripts dependencies.
         */
        public function get_script_depends() {
            return [ 'slick', 'swpb' ];
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
                'default'     => __( 'Woo Product Bundles Grid', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'layout', [
                'label' => esc_html__('Layout', 'sw-woo-elements'),
                'description' => esc_html__('', 'sw-woo-elements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'vertical' => __('Vertical (default)', 'sw-woo-elements'),
                    'horizontal' => __('Horizontal (default)', 'sw-woo-elements'),
                    'layout-1' => __('Custom 1', 'sw-woo-elements'),
                    'layout-2' => __('Custom 2', 'sw-woo-elements'),
                ],
                'default'     => 'vertical',
            ]);

            $this->add_control('width_main_product', [
                'label' => __( 'Width main product', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 50
                ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-woo-products-bundles ul.products .wrap-item li.product' => 'min-width: {{SIZE}}%;max-width: {{SIZE}}%;',
                ],
                'condition' => [
                    'layout' => 'horizontal'
                ]
            ]);

            $this->end_controls_section();

            /**
            * Query
            */
            $this->start_controls_section( 'section_query', [
                'label' => __( 'Query', 'sw-woo-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_control( 'product_cat', [
                'label' => __( 'Category', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'multiple' => true,
                'label_block' => true,
                'options' => \SWPB_Product_Bundles_functions()->get_woo_categories(2),
                'default' => 'all'
            ]);

            $this->add_control( 'product_number', [
                'label' => __( 'Product Number', 'sw-woo-elements' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'default' => 6,
            ]);

            $this->add_control( 'exclude_product_ids', [
                'label' => __( 'Exclude product IDs', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => \SWPB_Product_Bundles_functions()->get_woo_products(),
            ]);

            $this->add_control( 'orderby', [
                'label' => __( 'Order By', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => \SWPB_Product_Bundles_functions()->get_order_by(),
                'default' => 'none',
            ]);

            $this->add_control( 'order', [
                'label' => __( 'Order', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'DESC' => __('DESC', 'sw-woo-elements'),
                    'ASC' => __('ASC', 'sw-woo-elements'),
                ],
                'default' => 'DESC',
            ]);

            $this->end_controls_section();


            /**
            * Config Grid
            */
            $this->start_controls_section( 'grid_config', [
                'label' => __( 'Grid Config', 'sw-woo-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_responsive_control('columns', [
                'label' => __( 'Columns for row', 'sw-woo-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 8,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 3,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 1,
                    'unit' => 'px',
                ],
            ]);

            $this->add_responsive_control('grid_space_items', [
                'label' => __( 'Space Items', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.products' => 'margin: 0 calc(-{{SIZE}}px/2);',
                    '{{WRAPPER}} ul.products .wrap-item' => 'padding: 0 calc({{SIZE}}px/2);',
                ],
            ]);

            $this->add_responsive_control('grid_space', [
                'label' => __( 'Space Bottom', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.products .wrap-item' => 'margin-bottom: {{SIZE}}px;',
                ],
            ]);

            $this->end_controls_section();

            /**
            * Config Item Bundles
            */
            $this->start_controls_section('config', [
                'label' => __( 'Config Item Bundles', 'sw-woo-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_control( 'item_bundles_title', [
                'label' => esc_html__('Head Title', 'sw-woo-elements'),
                'description' => esc_html__('', 'sw-woo-elements'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Bundle includes:', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'layout_item_bundles', [
                'label' => __( 'Layout Item Bundles', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'slider' => __('Slider', 'sw-woo-elements'),
                    'grid' => __('Grid', 'sw-woo-elements')
                ],
                'default' => 'grid',
            ]);

            $this->add_control( 'style_item_bundles', [
                'label' => __( 'Style Item Bundles', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'normal' => __('Normal', 'sw-woo-elements'),
                    'overlay' => __('Overlay', 'sw-woo-elements')
                ],
                'default' => 'normal',
            ]);

            
            $this->add_control( 'limit_items', [
                'label' => __( 'Limit Items', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'sw-woo-elements' ),
                'label_off' => __( 'No', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]);

            $this->add_control( 'number_items', [
                'label' => __( 'Number Items', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 8,
                    ],
                ],
                'default' => [
                    'size' => 3
                ],
                'condition' => [
                    'limit_items' => 'yes'
                ]
            ]);

            $this->add_control( 'item_bundles_col', [
                'label' => __( 'Item Bundles Col', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 6,
                    ],
                ],
                'default' => [
                    'size' => 3
                ],
                'condition' => [
                    'layout_item_bundles' => 'grid'
                ]
            ]);

            $this->add_responsive_control('item_slides_to_show', [
                'label' => __( 'Slides To Show', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 8,
                    ],
                ],
                'desktop_default' => [
                    'size' => 2,
                ],
                'tablet_default' => [
                    'size' => 2,
                ],
                'mobile_default' => [
                    'size' => 1,
                ],
                'condition' => [
                    'layout_item_bundles' => 'slider'
                ]
            ]);

            $this->add_responsive_control('item_slides_to_rows', [
                'label' => __( 'Slides To Rows', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 3,
                    ],
                ],
                'desktop_default' => [
                    'size' => 2,
                ],
                'condition' => [
                    'layout_item_bundles' => 'slider'
                ]
            ]);

            $this->add_responsive_control( 'item_arrows', [
                'label' => __( 'Arrows', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'layout_item_bundles' => 'slider'
                ]
            ]);

            $this->add_responsive_control('item_space', [
                'label' => __( 'Space Items', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'desktop_default' => [
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swe-woo-products-bundles .item-bundles' => '--padding-swe-col: calc({{SIZE}}px / 2);--margin-swe-col: calc(-{{SIZE}}px / 2);',
                ],
            ]);

            $this->end_controls_section();

            /**
            * Style wrap head
            */
            $this->start_controls_section( 'section_style_wrap_head', [
                'label' => __( 'Heading', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ] );

            $this->add_control( 'wrap_head_width', [
                'label'     => __( 'Width', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px'  => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .style-2 .swe-wrap-head' => 'min-width: {{SIZE}}%;flex: 0 0 {{SIZE}}%;',
                ],
                'condition' => [
                    'tabs_style' => 'style-2'
                ]
            ]);

            $this->add_control( 'wrap_head_bg', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-head' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_responsive_control( 'wrap_head_padding', [
                'label'      => __( 'Padding', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-wrap-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]);

            $this->add_group_control( Group_Control_Border::get_type(), [
                'name' => 'wrap_head_border',
                'label' => __( 'Border', 'sw-woo-elements' ),
                'selector' => '{{WRAPPER}} .swe-wrap-head',
            ]);

            $this->add_control( 'wrap_head_border_radius', [
                'label'     => __( 'Border Radius', 'sw-woo-elements' ),
                'type'      => Controls_Manager::DIMENSIONS,
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
                    '{{WRAPPER}} .swe-wrap-head' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

            $this->add_responsive_control( 'wrap_head_space', [
                'label'     => __( 'Space', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-wrap-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .style-2 .swe-wrap-head' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->end_controls_section();

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
                    '{{WRAPPER}} .swe-wrap-head' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left'   => 'justify-content: flex-start;',
                    'center'   => 'justify-content: center;',
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

            /**
            * Style wrap item bundles
            */
            $this->start_controls_section( 'section_style_wrap_item_bundles', [
                'label' => __( 'Item Bundles', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'title!' => ''
                ]
            ]);

            $this->add_responsive_control( 'wrap_item_bundles_position', [
                'label'                => __( 'Position', 'sw-woo-elements' ),
                'type'                 => Controls_Manager::CHOOSE,
                'label_block'          => false,
                'options'              => \SWPB_Product_Bundles_functions()->getOptionPosition('hor'),
                'selectors'            => [
                    '{{WRAPPER}} .item-bundles .boxinfo-wrapper' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left'   => 'text-align: left;',
                    'center' => 'text-align: center;',
                    'right'  => 'text-align: right;',
                ],
            ]);

            $this->add_control( 'wrap_item_bundles_bg', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-bundles .boxinfo-wrapper' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_group_control( Group_Control_Border::get_type(), [
                'name' => 'wrap_item_bundles_border',
                'label' => __( 'Border', 'sw-woo-elements' ),
                'selector' => '{{WRAPPER}} .item-bundles .boxinfo-wrapper',
            ]);

            $this->add_responsive_control( 'wrap_item_bundles_padding', [
                'label'      => __( 'Padding', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .item-bundles .boxinfo-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);

            $this->add_control( 'section_style_wrap_item_bundles_head_title', [
                'label' => __( 'Head Title', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'item_bundles_title!' => ''
                ]
            ]);

            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_item_bundles_head_title_typography',
                'scheme' => Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .title-bundles',
                'fields_options' => [
                    'font_weight' => ['default' => 400],
                ],
                'condition' => [
                    'item_bundles_title!' => ''
                ]
            ]);

            $this->add_control( 'wrap_item_bundles_head_title_color', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-bundles' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'item_bundles_title!' => ''
                ]
            ]);

            $this->add_responsive_control( 'wrap_item_bundles_head_title_space', [
                'label'     => __( 'Space', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .title-bundles' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'item_bundles_title!' => ''
                ]
            ]);


            $this->add_control( 'section_style_wrap_item_bundles_title', [
                'label' => __( 'Title', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]);

            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_item_bundles_title_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .item-bundles .title-wrapper a',
                'fields_options' => [
                    'font_weight' => ['default' => 400],
                ],
            ]);

            $this->add_control( 'wrap_item_bundles_title_color', [
                'label' => __( 'Title Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-bundles .title-wrapper a' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_item_bundles_title_color_hover', [
                'label' => __( 'Title Color Hover', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-bundles .title-wrapper a:hover' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'section_style_wrap_item_bundles_price', [
                'label' => __( 'Price', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]);

            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_item_bundles_price_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .item-bundles .price-wrapper *',
                'fields_options' => [
                    'font_weight' => ['default' => 400],
                ],
            ]);

            $this->add_control( 'wrap_item_bundles_price_color', [
                'label' => __( 'Price Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .item-bundles .price-wrapper *' => 'color: {{VALUE}};',
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

            $this->add_render_attribute( 'item_slider_options', [
                'data-slides_to_show'   => $settings[ 'item_slides_to_show' ] ? $settings[ 'item_slides_to_show' ]['size'] : 3,
                'data-slides_to_show_tablet'   => isset($settings[ 'item_slides_to_show_tablet' ]) ? $settings[ 'item_slides_to_show_tablet' ]['size'] : 2,
                'data-slides_to_show_mobile'   => isset($settings[ 'item_slides_to_show_mobile' ]) ? $settings[ 'item_slides_to_show_mobile' ]['size'] : 1,

                'data-slides_to_rows'   => $settings[ 'item_slides_to_rows' ] ? $settings[ 'item_slides_to_rows' ]['size'] : 1,
                'data-slides_to_rows_tablet'   => isset($settings[ 'item_slides_to_rows_tablet' ]) ? $settings[ 'item_slides_to_rows_tablet' ]['size'] : 1,
                'data-slides_to_rows_mobile'   => isset($settings[ 'item_slides_to_rows_mobile' ]) ? $settings[ 'item_slides_to_rows_mobile' ]['size'] : 1,

                'data-arrows' => $settings[ 'item_arrows' ],
                'data-arrows_tablet' => isset($settings[ 'item_arrows_tablet' ]),
                'data-arrows_mobile' => isset($settings[ 'item_arrows_mobile' ]),

                'data-dots'   => false,
                'data-dots_tablet'   => false,
                'data-dots_mobile'   => false,

                'data-autoplay'   => 'yes',
                'data-infinite'   => 'yes',
            ]);

            $settings['item_slider_options'] = $this->get_render_attribute_string('item_slider_options');
            
            include( 'template-woo-product-bundles-grid.php' );  
        }
    }

    ElementorPlugin::instance()->widgets_manager->register(new SWE_Woo_Product_Bundles_Grid());
}
