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
 * SWE_Woo_Upsells_Slider
 *
 * @author Youtech
 * @package SWE
 */

if ( class_exists('WooCommerce') ) {
    final class SWE_Woo_Products_Gird extends SWE_Widget_Base {
        /**
         * @return string
         */
        function get_name() {
            return 'swe-woo-products-grid';
        }

        /**
         * @return string
         */
        function get_title() {
            return esc_html__('SWE Woo Products Grid', 'sw-woo-elements');
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

        /**
         * @return array
         */
        public function get_style_depends() {
            return ['font-awesome-5'];
        }

        /**
         * @return array Widget scripts dependencies.
         */
        public function get_script_depends() {
            return [ 'infinite', 'swwe-script'];
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
                'default'     => __( 'SWE Woo Products Grid', 'sw-woo-elements' ),
            ]);

            $this->end_controls_section();

            /**
            * Query
            */
            $this->start_controls_section( 'section_query', [
                'label' => __( 'Query', 'sw-woo-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_control( 'product_cats', [
                'label' => __( 'Categories', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'label_block' => true,
                'options' => $this->get_woo_categories(),
            ]);

            $this->add_control( 'filter', [
                'label' => __( 'Filter', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_woo_filter(1),
                'default' => 'all',
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
                'options' => $this->get_woo_products(),
            ]);

            $this->add_control( 'orderby', [
                'label' => __( 'Order By', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_order_by(),
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
                    'size' => 4,
                ],
                'tablet_default' => [
                    'size' => 3,
                ],
                'mobile_default' => [
                    'size' => 2,
                ],
            ]);

            $this->add_control('pagination', [
                'label' => __( 'Pagination', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __('None', 'sw-woo-elements'),
                    'numeric' => __('Numeric', 'sw-woo-elements'),
                    'ajaxload' => __('Button load more', 'sw-woo-elements'),
                ],
                'default' => 'none'
            ]);

            $this->add_control('button_text', [
                'label' => __( 'Button Text', 'sw-woo-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('Load More', 'sw-woo-elements'),
                'condition' => [
                    'pagination' => 'ajaxload'
                ]
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
                    '{{WRAPPER}} ul.products li.product' => 'padding: 0 calc({{SIZE}}px/2);',
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
                    '{{WRAPPER}} ul.products li.product' => 'margin-bottom: {{SIZE}}px;',
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
            * Style button load more
            */
            $this->start_controls_section( 'section_style_wrap_button_load_more', [
                'label' => __( 'Button Load More', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pagination' => 'ajaxload'
                ]
            ]);

            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_btn_loadmore_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pagination-ajax > *',
            ]);

            $this->add_group_control( Group_Control_Border::get_type(), [
                'name' => 'wrap_btn_loadmore_border',
                'label' => __( 'Border', 'sw-woo-elements' ),
                'selector' => '{{WRAPPER}} .pagination-ajax > *',
            ]);

            $this->add_responsive_control('wrap_btn_loadmore_border_radius', [
                'label' => __( 'Border radius', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ '%', 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .pagination-ajax > *' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->start_controls_tabs( 'wrap_btn_loadmore_tabs' );
            $this->start_controls_tab( 'wrap_btn_loadmore_normal', [
                'label' => __( 'Normal', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_btn_loadmore_color', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-ajax > *' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_btn_loadmore_background', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-ajax > *' => 'background: {{VALUE}};',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab( 'wrap_btn_loadmore_hover', [
                'label' => __( 'Hover', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_btn_loadmore_color_hover', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-ajax .view-more-button:hover' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_btn_loadmore_background_hover', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-ajax .view-more-button:hover' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_btn_loadmore_border_hover', [
                'label' => __( 'Border Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pagination-ajax .view-more-button:hover' => 'border-color: {{VALUE}};',
                ],
            ]);

            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_responsive_control( 'wrap_btn_loadmore_padding', [
                'label'      => __( 'Padding', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .pagination-ajax > *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]);

            $this->add_responsive_control('wrap_btn_loadmore_space', [
                'label' => __( 'Space', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pagination-ajax' => 'margin-top: {{SIZE}}px;',
                ],
            ]);

            $this->end_controls_section();

            /**
            * Style pagination
            */
            $this->start_controls_section( 'section_style_wrap_pagination', [
                'label' => __( 'Pagination Numeric', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pagination' => 'numeric'
                ]
            ]);

            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_pagination_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .swe-pagination .page-numbers',
            ]);

            $this->add_group_control( Group_Control_Border::get_type(), [
                'name' => 'wrap_pagination_border',
                'label' => __( 'Border', 'sw-woo-elements' ),
                'selector' => '{{WRAPPER}} .swe-pagination .page-numbers',
            ]);

            $this->add_responsive_control('wrap_pagination_border_radius', [
                'label' => __( 'Border radius', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ '%', 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-pagination .page-numbers' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->start_controls_tabs( 'wrap_pagination_tabs' );
            $this->start_controls_tab( 'wrap_pagination_normal', [
                'label' => __( 'Normal', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_pagination_color', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-pagination .page-numbers' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_pagination_background', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-pagination .page-numbers' => 'background: {{VALUE}};',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab( 'wrap_pagination_hover', [
                'label' => __( 'Hover', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_pagination_color_hover', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-pagination .page-numbers:not(.dots):hover, {{WRAPPER}} .swe-pagination .page-numbers.current' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_pagination_background_hover', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-pagination .page-numbers:not(.dots):hover, {{WRAPPER}} .swe-pagination .page-numbers.current' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_pagination_border_hover', [
                'label' => __( 'Border Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-pagination .page-numbers:not(.dots):hover, {{WRAPPER}} .swe-pagination .page-numbers.current' => 'border-color: {{VALUE}};',
                ],
            ]);

            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_responsive_control( 'wrap_pagination_padding', [
                'label'      => __( 'Padding', 'sw-woo-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .swe-pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]);

            $this->add_responsive_control('wrap_pagination_space_items', [
                'label' => __( 'Space Items', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swe-pagination .page-numbers ~ .page-numbers' => 'margin-left: {{SIZE}}px;',
                ],
            ]);

            $this->add_responsive_control('wrap_pagination_space', [
                'label' => __( 'Space', 'sw-woo-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swe-pagination' => 'margin-top: {{SIZE}}px;',
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

            $this->getViewTemplate('template', 'woo-products-grid', $settings);
        }
    }

    ElementorPlugin::instance()->widgets_manager->register(new SWE_Woo_Products_Gird());
}
