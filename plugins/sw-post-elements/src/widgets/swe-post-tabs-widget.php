<?php 
namespace SWPE\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Plugin as ElementorPlugin;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;

/**
 * SWE_Post_Tabs_Widget
 *
 * @author Youtech
 * @package SWE
 */

final class SWE_Post_Tabs_Widget extends SWE_Widget_Base {
    /**
     * @return string
     */
    function get_name() {
        return 'swe-post-tabs-widget';
    }

    /**
     * @return string
     */
    function get_title() {
        return esc_html__('SWE Post Tabs Widget', 'sw-post-elements');
    }

    /**
     * @return string
     */
    function get_icon() {
        return 'eicon-tabs';
    }

    public function get_style_depends() {
        return ['slick'];
    }

    /**
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'swe-script' ];
    }

    /**
     * Register controls
     */
    public function register_controls() {

        /**
        * Content Settings
        */
        $this->start_controls_section( 'content_post_settings', [
            'label' => esc_html__( 'Content Post', 'sw-post-elements' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('post_format_media', [
            'label' => esc_html__( 'Post Format Media', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'no',
            'condition' => [
                'super_title' => 'yes'
            ]
        ]);

        $this->add_control( 'show_image', [
            'label' => esc_html__( 'Show Image', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'show_author', [
            'label' => esc_html__( 'Show Post Author', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'show_date', [
            'label' => esc_html__( 'Show Post Date', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'show_cats', [
            'label' => esc_html__( 'Show Post Categories', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'show_excerpt', [
            'label' => esc_html__( 'Show Excerpt', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'excerpt_lines', [
            'label' => esc_html__( 'Excerpt Lines', 'sw-post-elements' ),
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 20,
            'default' => 3,
            'selectors' => [
                '{{WRAPPER}} .swe-description' => 'overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: {{VALUE}};-webkit-box-orient: vertical;'
            ],
            'condition' => [
                'show_excerpt' => 'yes'
            ]
        ]);

        $this->add_control( 'show_readmore', [
            'label' => esc_html__( 'Show Read More', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control('readmore_text', [
            'label' => esc_html__( 'Read More Text', 'sw-post-elements' ),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Read More', 'sw-post-elements'),
            'condition' => [
                'show_readmore' => 'yes'
            ]
        ]);

        $this->add_control( 'show_info_icon', [
            'label' => esc_html__( 'Show Info Icon', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->end_controls_section();

        /**
        * Query
        */
        $this->start_controls_section( 'section_query', [
            'label' => esc_html__( 'Query', 'sw-post-elements' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'post_tabs', [
            'label' => esc_html__( 'Categories', 'sw-post-elements' ),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'label_block' => true,
            'options' => [
                'popular' => esc_html__('Popular', 'sw-post-elements'),
                'recent' => esc_html__('Recent', 'sw-post-elements'),
                'comments' => esc_html__('Comments', 'sw-post-elements'),
                'tags' => esc_html__('Tags', 'sw-post-elements')
            ],
        ]);

        $this->add_control( 'post_number', [
            'label' => esc_html__( 'post Number', 'sw-post-elements' ),
            'type' => Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 20,
            'default' => 6,
        ]);

        $this->add_control( 'exclude_post_ids', [
            'label' => esc_html__( 'Exclude post IDs', 'sw-post-elements' ),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'label_block' => true,
            'options' => $this->get_post_list(),
        ]);

        $this->add_control( 'orderby', [
            'label' => esc_html__( 'Order By', 'sw-post-elements' ),
            'type' => Controls_Manager::SELECT,
            'options' => $this->get_order_by(),
            'default' => 'none',
        ]);

        $this->add_control( 'order', [
            'label' => esc_html__( 'Order', 'sw-post-elements' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'DESC' => esc_html__('DESC', 'sw-post-elements'),
                'ASC' => esc_html__('ASC', 'sw-post-elements'),
            ],
            'default' => 'DESC',
        ]);

        $this->end_controls_section();

        /**
        * Style wrap head
        */
        $this->start_controls_section( 'section_style_wrap_head', [
            'label' => esc_html__( 'Head', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'wrap_head_width', [
            'label'     => esc_html__( 'Width', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-head' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control( 'wrap_head_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'separator' => 'after',
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'wrap_head_border',
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-wrap-head',
        ]);

        $this->add_control( 'wrap_head_border_radius', [
            'label'     => esc_html__( 'Border Radius', 'sw-post-elements' ),
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
            'label'     => esc_html__( 'Space', 'sw-post-elements' ),
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
        * Style tab item
        */
        $this->start_controls_section( 'section_style_tab_item', [
            'label' => esc_html__( 'Tab Items', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control( 'tab_item_position', [
            'label'                => esc_html__( 'Position', 'sw-post-elements' ),
            'type'                 => Controls_Manager::CHOOSE,
            'label_block'          => false,
            'options'              => $this->getOptionPosition('hor'),
            'selectors'            => [
                '{{WRAPPER}} .swe-wrap-tab-head' => '{{VALUE}}',
            ],
            'selectors_dictionary' => [
                'left'   => 'justify-content: flex-start;',
                'center' => 'justify-content: center;',
                'right'  => 'justify-content: flex-end;',
            ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'tab_item_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .swe-wrap-tab-head .swe-tab-title',
        ]);

        $this->start_controls_tabs( 'tab_item_tabs' );

        $this->start_controls_tab( 'tab_item_normal', [
            'label' => esc_html__( 'Normal', 'sw-post-elements' ),
        ]);

        $this->add_control( 'tab_item_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-tab-title' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'tab_item_bg', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-tab-title' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'tab_item_border',
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-wrap-tab-head .swe-tab-title',
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab( 'tab_item_hover', [
            'label' => esc_html__( 'Hover', 'sw-post-elements' ),
        ]);

        $this->add_control( 'tab_item_color_hover', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-tab-title:hover, {{WRAPPER}} .swe-wrap-tab-head .swe-tab-title.active' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'tab_item_bg_hover', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-tab-title:hover, {{WRAPPER}} .swe-wrap-tab-head .swe-tab-title.active' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'tab_item_border_hover', [
            'label' => esc_html__( 'Border Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-tab-title:hover, {{WRAPPER}} .swe-wrap-tab-head .swe-tab-title.active' => 'border-color: {{VALUE}};',
            ],
        ]);
        
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control( 'tab_item_border_radius', [
            'label'     => esc_html__( 'Border Radius', 'sw-post-elements' ),
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
                '{{WRAPPER}} .swe-wrap-tab-head .swe-tab-title' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control( 'tab_item_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('tab_item_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-tabs.style-1 .swe-wrap-tab-head .swe-tab-title + .swe-tab-title' => 'margin-left: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .swe-wrap-tabs.style-2 .swe-wrap-tab-head .swe-tab-title + .swe-tab-title' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'tab_button', [
            'label' => esc_html__( 'Tabs Button', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->add_responsive_control( 'tab_button_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('tab_button_size', [
            'label' => esc_html__( 'Size', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-button' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->start_controls_tabs( 'tab_button_tabs' );

        $this->start_controls_tab( 'tab_button_normal', [
            'label' => esc_html__( 'Normal', 'sw-post-elements' ),
        ]);

        $this->add_control( 'tab_button_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-button' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'tab_button_bg', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-button' => 'background: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab( 'tab_button_hover', [
            'label' => esc_html__( 'Hover', 'sw-post-elements' ),
        ]);

        $this->add_control( 'tab_button_color_hover', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-button:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'tab_button_bg_hover', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-tab-head .swe-button:hover' => 'background: {{VALUE}};',
            ],
        ]);
        
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();

        /**
        * Style tab content
        */
        $this->start_controls_section( 'section_style_tab_content', [
            'label' => esc_html__( 'Tab Content', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control( 'tab_content_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'tab_content_border',
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-wrap-tab-content',
        ]);

        $this->add_control( 'tab_content_border_radius', [
            'label'     => esc_html__( 'Border Radius', 'sw-post-elements' ),
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
                '{{WRAPPER}} .swe-wrap-tab-content' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();


        /**
        * Style wrap post items
        */
        $this->start_controls_section( 'section_style_wrap_post_items', [
            'label' => esc_html__( 'Post Items', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control( 'wrap_post_items_align', [
            'label'                => esc_html__( 'Align', 'sw-post-elements' ),
            'type'                 => Controls_Manager::CHOOSE,
            'label_block'          => false,
            'options'              => [
                'left'   => [
                    'title' => esc_html__( 'Left', 'sw-post-elements' ),
                    'icon'  => 'eicon-h-align-left',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'sw-post-elements' ),
                    'icon'  => 'eicon-h-align-center',
                ],
                'right'  => [
                    'title' => esc_html__( 'Right', 'sw-post-elements' ),
                    'icon'  => 'eicon-h-align-right',
                ]
            ],
            'selectors'            => [
                '{{WRAPPER}} .swe-wrap-item' => 'text-align: {{VALUE}}',
            ],
        ]);

        $this->add_responsive_control( 'wrap_post_items_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'wrap_post_items_border',
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-wrap-item',
        ]);

        $this->add_control( 'wrap_post_items_border_radius', [
            'label'     => esc_html__( 'Border Radius', 'sw-post-elements' ),
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
                '{{WRAPPER}} .swe-wrap-item' => 'overflow: hidden;border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->start_controls_tabs( 'wrap_post_items_tabs' );
        $this->start_controls_tab( 'wrap_post_items_normal', [
            'label' => esc_html__( 'Normal', 'sw-post-elements' ),
        ]);

        $this->add_control( 'wrap_post_items_background', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-item' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name' => 'wrap_post_items_box_shadow',
            'label' => esc_html__( 'Box Shadow', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-wrap-item',
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab( 'wrap_post_items_hover', [
            'label' => esc_html__( 'Hover', 'sw-post-elements' ),
        ]);

        $this->add_control( 'wrap_post_items_background_hover', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-item:hover' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name' => 'wrap_post_items_box_shadow_hover',
            'label' => esc_html__( 'Box Shadow', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-wrap-item:hover',
        ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_control( 'wrap_post_items_text_heading', [
            'label' => esc_html__( 'Content text', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
        ]);

        $this->add_responsive_control( 'wrap_post_items_text_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        /**
        * Style wrap Image
        */
        $this->start_controls_section( 'section_style_wrap_post_image', [
            'label' => esc_html__( 'Post Image', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('wrap_post_image_width', [
            'label' => esc_html__( 'Width', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 50,
                    'max' => 300,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-item .swe-wrap-image' => 'min-width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'wrap_post_image_border',
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-wrap-image',
        ]);

        $this->add_control( 'wrap_post_image_border_radius', [
            'label'     => esc_html__( 'Border Radius', 'sw-post-elements' ),
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

        $this->start_controls_tabs( 'wrap_post_image_tabs' );
        $this->start_controls_tab( 'wrap_post_image_normal', [
            'label' => esc_html__( 'Normal', 'sw-post-elements' ),
        ]);

        $this->add_control( 'wrap_post_image_background', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-image' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_post_image_opacity', [
            'label'     => esc_html__( 'Opacity', 'sw-post-elements' ),
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

        $this->end_controls_tab();

        $this->start_controls_tab( 'wrap_post_image_hover', [
            'label' => esc_html__( 'Hover', 'sw-post-elements' ),
        ]);

        $this->add_control( 'wrap_post_image_background_hover', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-item:hover .swe-wrap-image' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_post_image_opacity_hover', [
            'label'     => esc_html__( 'Opacity', 'sw-post-elements' ),
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

        $this->add_responsive_control('wrap_post_image_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-item .swe-wrap-image' => 'margin-right: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        /**
        * Style wrap post content
        */
        $this->start_controls_section( 'section_style_wrap_post_content', [
            'label' => esc_html__( 'Post Content', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'wrap_post_title_text_heading', [
            'label' => esc_html__( 'Title', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'wrap_post_title_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .post .swe-title, {{WRAPPER}} .post .swe-title a',
        ]);

        $this->add_control( 'wrap_post_title_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .post .swe-title a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_post_title_color_hover', [
            'label' => esc_html__( 'Color hover', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .post .swe-title a:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('wrap_post_title_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .post .swe-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'wrap_post_info_text_heading', [
            'label' => esc_html__( 'Info', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
        ]);

        $this->start_controls_tabs( 'wrap_post_info_tabs' );
        $this->start_controls_tab( 'wrap_post_info_normal', [
            'label' => esc_html__( 'Normal', 'sw-post-elements' ),
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'wrap_post_info_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .post-info',
        ]);

        $this->add_control( 'wrap_post_info_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .post-info' => 'color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab( 'wrap_post_info_link_normal', [
            'label' => esc_html__( 'Link', 'sw-post-elements' ),
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'wrap_post_info_link_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .post-info a',
        ]);

        $this->add_control( 'wrap_post_info_link_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .post-info a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab( 'wrap_post_info_hover', [
            'label' => esc_html__( 'Hover', 'sw-post-elements' ),
        ]);

        $this->add_control( 'wrap_post_info_color_hover', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .post-info a:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control('wrap_post_info_space_items', [
            'label' => esc_html__( 'Space Items', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .post-info li ~ li' => 'margin-left: {{SIZE}}px;',
            ],
        ]);

        $this->add_responsive_control('wrap_post_info_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .post-info' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'wrap_post_description_text_heading', [
            'label' => esc_html__( 'Description', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'wrap_post_description_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .swe-description',
        ]);

        $this->add_control( 'wrap_post_description_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-description' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('wrap_post_description_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'wrap_post_readmore_text_heading', [
            'label' => esc_html__( 'Read More', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'wrap_post_readmore_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .swe-button',
        ]);

        $this->add_responsive_control( 'wrap_post_readmore_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'wrap_post_readmore_border',
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-button',
        ]);

        $this->add_control( 'wrap_post_readmore_border_radius', [
            'label'     => esc_html__( 'Border Radius', 'sw-post-elements' ),
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
                '{{WRAPPER}} .swe-button' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->start_controls_tabs( 'wrap_post_readmore_tabs' );
        $this->start_controls_tab( 'wrap_post_readmore_normal', [
            'label' => esc_html__( 'Normal', 'sw-post-elements' ),
        ]);

        $this->add_control( 'wrap_post_readmore_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-button' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_post_readmore_bg', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-button' => 'background: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab( 'wrap_post_readmore_hover', [
            'label' => esc_html__( 'Hover', 'sw-post-elements' ),
        ]);

        $this->add_control( 'wrap_post_readmore_color_hover', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-button:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_post_readmore_bg_hover', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-button:hover' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_post_readmore_border_hover', [
            'label' => esc_html__( 'Border color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-button:hover' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    /**
     * Render
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id_int = substr( $this->get_id_int(), 0, 3 );
        $settings['id_int'] = $id_int;

        $this->getViewTemplate('template', 'post-tabs-widget', $settings);
    }
}

ElementorPlugin::instance()->widgets_manager->register(new SWE_Post_Tabs_Widget());
