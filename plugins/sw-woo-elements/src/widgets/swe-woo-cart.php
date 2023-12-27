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
 * SWE_Banner
 *
 * @author Youtech
 * @package SWE
 */

if (class_exists('WooCommerce')) {
    final class SWE_Woo_Cart extends SWE_Widget_Base {
        /**
         * @return string
         */
        function get_name() {
            return 'swe-woo-cart';
        }

        /**
         * @return string
         */
        function get_title() {
            return esc_html__('SWE Woo Cart', 'sw-woo-elements');
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
            return 'eicon-cart-medium';
        }

        /**
         * @return array Widget scripts dependencies.
         */
        public function get_script_depends() {
            return [ 'swwe-script' ];
        }

        /**
         * Register controls
         */

        public function register_controls() {

            /**
            * Content Settings
            */
            $this->start_controls_section( 'content_settings', [
                'label' => __( 'Content Settings', 'sw-woo-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_control( 'show_image_icon', [
                'label' => __( 'Show Image Icon', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => '',
            ]);

            $this->add_control('icon', [
                'label' => esc_html__('Icon', 'sw-woo-elements'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-shopping-cart',
                    'library' => 'solid',
                ],
                'condition' => [
                    'show_image_icon!' => 'yes'
                ]
            ]);

            $this->start_controls_tabs( 'image_icon_tabs', [
                'condition' => [
                    'show_image_icon' => 'yes'
                ]
            ] );

            $this->start_controls_tab( 'image_icon_tab_normal', [ 'label' => __( 'Normal', 'sw-woo-elements' ) ] );

            $this->add_control('image_icon', [
                'label' => esc_html__('Image Icon', 'sw-woo-elements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'show_image_icon' => 'yes'
                ]
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab( 'image_icon_tab_hover', [ 'label' => __( 'Hover', 'sw-woo-elements' ) ] );

            $this->add_control('image_icon_hover', [
                'label' => esc_html__('Image Icon', 'sw-woo-elements'),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'show_image_icon' => 'yes'
                ]
            ]);
            $this->end_controls_tab();

            $this->end_controls_tabs();


            $this->add_control('layout_style', [
                'label' => __( 'Layout style', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'cart-hover' => __('Cart Hover', 'sw-woo-elements'),
                    'cart-canvas' => __('Cart Canvas', 'sw-woo-elements'),
                ],
                'default' => 'cart-hover'
            ]);

            $this->add_control( 'show_count', [
                'label' => __( 'Show Count Items', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]);

            $this->add_control( 'show_subtotal', [
                'label' => __( 'Show Subtotal', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]);

            $this->add_control('text_cart', [
                'label' => esc_html__('Text Subtotal', 'sw-woo-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => __('My Cart:', 'sw-woo-elements'),
                'condition' => [
                    'show_subtotal' => 'yes'
                ]
            ]);

            $this->add_control('position_icon', [
                'label' => __( 'Position Icon', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'icon-left' => __('Left', 'sw-woo-elements'),
                    'icon-right' => __('Right', 'sw-woo-elements'),
                ],
                'default' => 'icon-left',
                'condition' => [
                    'show_subtotal' => 'yes'
                ]
            ]);

            $this->add_control( 'position_content', [
                'label' => __( 'Position Content', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'right' => __('Right', 'sw-woo-elements'),
                    'left' => __('Left', 'sw-woo-elements'),
                ],
                'selectors'            => [
                    '{{WRAPPER}} .swe-woo-cart.cart-hover .swe-wrap-cart-content' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'right'   => 'left:auto;right:0;',
                    'left'   => 'right:auto;left:0;',
                ],
                'default' => 'right',
                'condition' => [
                    'layout_style' => 'cart-hover'
                ]
            ]);

            $this->end_controls_section();

            /**
            * Style for Icon Cart
            */
            $this->start_controls_section( 'section_style_icon', [
                'label' => __( 'Icon Cart', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                "condition" => [
                    'show_image_icon!' => 'yes'
                ]
            ] );

            $this->add_control( 'wrap_icon_style', [
                'label' => __( 'Icon', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
                // 'separator' => 'before',
            ]);

            $this->add_control( 'wrap_icon_block', [
                'label'     => __( 'Block', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->add_control( 'wrap_icon_size', [
                'label'     => __( 'Size', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->add_group_control( Group_Control_Border::get_type(), [
                'name' => 'wrap_icon_border',
                'label' => __( 'Border', 'sw-woo-elements' ),
                'selector' => '{{WRAPPER}} .swe-cart-icon',
            ]);

            $this->add_control( 'wrap_icon_border_radius', [
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
                    '{{WRAPPER}} .swe-cart-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->start_controls_tabs( 'wrap_icon_tabs' );

            $this->start_controls_tab( 'wrap_icon_normal', [
                'label' => __( 'Normal', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_icon_color', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-icon' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_icon_bg', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-icon' => 'background: {{VALUE}};',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab( 'wrap_icon_hover', [
                'label' => __( 'Hover', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_icon_color_hover', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-woo-cart:hover .swe-cart-icon' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_icon_bg_hover', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-woo-cart:hover .swe-cart-icon' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_icon_border_hover', [
                'label' => __( 'Border Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-woo-cart:hover .swe-cart-icon' => 'border-color: {{VALUE}};',
                ],
            ]);

            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->end_controls_section();

            /**
            * Style for Image Icon Cart
            */
            $this->start_controls_section( 'section_style_image_icon', [
                'label' => __( 'Image Icon Cart', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                "condition" => [
                    'show_image_icon' => 'yes'
                ]
            ]);

            $this->add_control( 'wrap_image_size', [
                'label'     => __( 'Size', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-icon .image-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->add_group_control( Group_Control_Border::get_type(), [
                'name' => 'wrap_image_border',
                'label' => __( 'Border', 'sw-woo-elements' ),
                'selector' => '{{WRAPPER}} .swe-cart-icon .image-icon img',
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
                    '{{WRAPPER}} .swe-cart-icon .image-icon img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->start_controls_tabs( 'wrap_image_tabs' );

            $this->start_controls_tab( 'wrap_image_normal', [
                'label' => __( 'Normal', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_image_bg', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-icon .image-icon img' => 'background: {{VALUE}};',
                ],
            ]);

            $this->end_controls_tab();

            $this->start_controls_tab( 'wrap_image_hover', [
                'label' => __( 'Hover', 'sw-woo-elements' ),
            ]);

            $this->add_control( 'wrap_image_bg_hover', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-woo-cart:hover .swe-cart-icon .image-icon img' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_image_border_hover', [
                'label' => __( 'Border Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-woo-cart:hover .swe-cart-icon .image-icon img' => 'border-color: {{VALUE}};',
                ],
            ]);

            $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->end_controls_section();

            /**
            * Style for Count Items
            */
            $this->start_controls_section( 'section_style_count_items', [
                'label' => __( 'Count Items', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ] );

            $this->add_control( 'wrap_count_position', [
                'label' => __( 'Position', 'sw-woo-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('Default', 'sw-woo-elements'),
                    'top-right' => __('Top right', 'sw-woo-elements'),
                    'top-left' => __('Top left', 'sw-woo-elements'),
                    'bottom-right' => __('Bottom right', 'sw-woo-elements'),
                    'bottom-left' => __('Bottom left', 'sw-woo-elements'),
                    'center' => __('Center center', 'sw-woo-elements')
                ],
                'selectors'            => [
                    '{{WRAPPER}} .swe-cart-icon .swe-cart-count' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'top-right'   => 'top: 0;left: 100%;',
                    'top-left'   => 'top: 0;left: 0%;',
                    'bottom-right'   => 'top: 100%;left: 100%;',
                    'bottom-left'   => 'top: 100%;left: 0;',
                    'center'   => 'top: 50%;left: 50%;',
                ],
                'default' => ''
            ]);


            $this->add_control( 'wrap_count_items_block', [
                'label'     => __( 'Block', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-icon .swe-cart-count' => 'min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->add_control( 'wrap_count_items_size', [
                'label'     => __( 'Size', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-icon .swe-cart-count' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->add_control( 'wrap_count_items_color', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-icon .swe-cart-count' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_count_items_bg', [
                'label' => __( 'Background', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-icon .swe-cart-count' => 'background: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_count_border_radius', [
                'label'     => __( 'Border Radius', 'sw-woo-elements' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units'     => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-icon .swe-cart-count' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->end_controls_section();

            /**
            * Style for Subtotal
            */
            $this->start_controls_section( 'section_style_subtotal', [
                'label' => __( 'Subtotal', 'sw-woo-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ] );

            $this->add_control( 'wrap_subtotal_space', [
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
                    '{{WRAPPER}} .icon-right .swe-cart-subtotal' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .icon-left .swe-cart-subtotal' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]);

            $this->add_control( 'wrap_text_style', [
                'label' => __( 'Text Subtotal', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]);

            $this->add_control( 'wrap_text_block', [
                'label' => __( 'Display Block', 'sw-woo-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'sw-woo-elements' ),
                'label_off' => __( 'Hide', 'sw-woo-elements' ),
                'return_value' => 'yes',
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-subtotal .text' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'yes'   => 'display:block;margin-right:0px;',
                ],
            ]);

            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_text_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .swe-cart-subtotal .text',
            ]);

            $this->add_control( 'wrap_text_color', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-subtotal .text' => 'color: {{VALUE}};',
                ],
            ]);

            $this->add_control( 'wrap_price_style', [
                'label' => __( 'Price', 'sw-woo-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]);

            $this->add_group_control( Group_Control_Typography::get_type(), [
                'name' => 'wrap_price_typography',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .swe-cart-subtotal',
            ]);

            $this->add_control( 'wrap_price_color', [
                'label' => __( 'Color', 'sw-woo-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swe-cart-subtotal' => 'color: {{VALUE}};',
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

            $this->getViewTemplate('template', 'woo-cart', $settings);
        }
    }

    ElementorPlugin::instance()->widgets_manager->register(new SWE_Woo_Cart());
}
