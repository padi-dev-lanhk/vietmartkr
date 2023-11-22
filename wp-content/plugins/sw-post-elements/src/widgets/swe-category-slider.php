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

/**
 * SWE_Category_Slider
 *
 * @author Youtech
 * @package SWE
 */

final class SWE_Category_Slider extends SWE_Widget_Base {
    /**
     * @return string
     */
    function get_name() {
        return 'swe-category-slider';
    }

    /**
     * @return string
     */
    function get_title() {
        return esc_html__('SWE Category Slider', 'sw-post-elements');
    }

    /**
     * @return string
     */
    function get_icon() {
        return 'eicon-archive-title';
    }

    public function get_style_depends() {
        return ['slick'];
    }

    /**
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'slick', 'swe-script' ];
    }

    /**
     * Register controls
     */
    public function register_controls() {

        /**
        * Content Settings
        */
        $this->start_controls_section( 'content_settings', [
            'label' => esc_html__( 'Settings', 'sw-post-elements' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control( 'category', [
            'label' => esc_html__('Category', 'sw-post-elements'),
            'type' => Controls_Manager::SELECT,
            'label_block' => true,
            'options' => $this->get_post_categories(1),
        ]);

        $repeater->add_control( 'image', [
            'label' => esc_html__('Image', 'sw-post-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => []
        ]);

        $this->add_control('content', [
            'label' => esc_html__('Content', 'sw-post-elements'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ category }}}',
        ]);

        $this->add_control( 'show_count', [
            'label' => esc_html__( 'Show Count', 'sw-post-elements' ),
            'description' => esc_html__('Display count of category', 'sw-post-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'show_image', [
            'label' => esc_html__( 'Show Image', 'sw-post-elements' ),
            'description' => esc_html__('Display thumbnail of category', 'sw-post-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);


        $this->add_group_control( Group_Control_Image_Size::get_type(), [
            'name' => 'image',
            'default' => 'large',
            'separator' => 'none',
            'condition' => [
                'show_image' => 'yes'
            ]
        ]);


        $this->add_control( 'show_description', [
            'label' => esc_html__( 'Show Description', 'sw-post-elements' ),
            'description' => esc_html__('Display description of category', 'sw-post-elements'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => '',
        ]);

        $this->add_control('layout_style', [
            'label' => esc_html__( 'Layout style', 'sw-post-elements' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'style-1' => esc_html__('Style 1', 'sw-post-elements'),
                'style-2' => esc_html__('Style 2', 'sw-post-elements'),
                'style-3' => esc_html__('Style 3', 'sw-post-elements'),
            ],
            'default' => 'style-1'
        ]);

        $this->end_controls_section();

        /**
        * Slider Config
        */
        $this->start_controls_section( 'slider_config', [
            'label' => esc_html__( 'Slider Config', 'sw-post-elements' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('slides_to_show', [
            'label' => esc_html__( 'Slides To Show', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 8,
                ],
            ],
            'default' => [
                'size' => 4,
            ],
        ]);

        $this->add_control('slides_to_show_tablet', [
            'label' => esc_html__( 'Slides To Show on Tablet', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 8,
                ],
            ],
            'default' => [
                'size' => 3,
            ],
        ]);

        $this->add_control('slides_to_show_mobile', [
            'label' => esc_html__( 'Slides To Show on Mobile', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 8,
                ],
            ],
            'default' => [
                'size' => 3,
            ],
        ]);

        $this->add_control('slides_to_rows', [
            'label' => esc_html__( 'Slides To Rows', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 3,
                ],
            ],
            'default' => [
                'size' => 1,
            ],
        ]);

        $this->add_control('slides_to_rows_tablet', [
            'label' => esc_html__( 'Slides To Rows on Tablet', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 3,
                ],
            ],
            'default' => [
                'size' => 1,
            ],
        ]);

        $this->add_control('slides_to_rows_mobile', [
            'label' => esc_html__( 'Slides To Rows on Mobile', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 3,
                ],
            ],
            'default' => [
                'size' => 1,
            ],
        ]);

        $this->add_control('slides_to_scroll', [
            'label' => esc_html__( 'Slides To Scroll', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Space Items', 'sw-post-elements' ),
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

        $this->add_control( 'arrows', [
            'label' => esc_html__( 'Arrows', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'arrows_tablet', [
            'label' => esc_html__( 'Arrows on Tablet', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'arrows_mobile', [
            'label' => esc_html__( 'Arrows on Mobile', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'dots', [
            'label' => esc_html__( 'Dots', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'dots_tablet', [
            'label' => esc_html__( 'Dots on Tablet', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'dots_mobile', [
            'label' => esc_html__( 'Dots on Mobile', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'pause_on_hover', [
            'label' => esc_html__( 'Pause On Hover', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'autoplay', [
            'label' => esc_html__( 'Autoplay', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control('autoplay_speed', [
            'label' => esc_html__( 'Autoplay Speed', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Loop', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control( 'lazyload', [
            'label' => esc_html__( 'Lazy Load', 'sw-post-elements' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'ondemand' => esc_html__('Ondemand', 'sw-post-elements'),
                'progressive' => esc_html__('Progressive', 'sw-post-elements')
            ],
            'default' => 'progressive',
        ]);

        $this->end_controls_section();

        /**
        * Style tab content
        */
        $this->start_controls_section( 'section_style_wrap_item', [
            'label' => esc_html__( 'Items', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control( 'wrap_item_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'wrap_item_border',
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-wrap-item',
        ]);

        $this->add_control( 'wrap_item_border_radius', [
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
                '{{WRAPPER}} .swe-wrap-item' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->start_controls_tabs( 'wrap_item_tabs' );
        $this->start_controls_tab( 'wrap_item_normal', [
            'label' => esc_html__( 'Normal', 'sw-post-elements' ),
        ]);

        $this->add_control( 'wrap_item_background', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-item' => 'background: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab( 'wrap_item_hover', [
            'label' => esc_html__( 'Hover', 'sw-post-elements' ),
        ]);

        $this->add_control( 'wrap_item_background_hover', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-item:hover' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_item_border_hover', [
            'label' => esc_html__( 'Border Color', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Image', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_image' => 'yes'
            ]
        ]);

        $this->add_responsive_control('wrap_image_width', [
            'label' => esc_html__( 'Width', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Fix Image', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'sw-post-elements' ),
            'label_off' => esc_html__( 'No', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'no',
        ]);

        $this->add_responsive_control('wrap_image_height', [
            'label' => esc_html__( 'Height', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-wrap-image',
        ]);

        $this->add_control( 'wrap_image_border_radius', [
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

        $this->start_controls_tabs( 'wrap_image_tabs' );
        $this->start_controls_tab( 'wrap_image_normal', [
            'label' => esc_html__( 'Normal', 'sw-post-elements' ),
        ]);

        $this->add_control( 'wrap_image_background', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-image' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_image_opacity', [
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

        $this->start_controls_tab( 'wrap_image_hover', [
            'label' => esc_html__( 'Hover', 'sw-post-elements' ),
        ]);

        $this->add_control( 'wrap_image_background_hover', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-item:hover .swe-wrap-image' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_image_opacity_hover', [
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

        $this->end_controls_section();
        
        /**
        * Style wrap content
        */
        $this->start_controls_section( 'section_style_wrap_content', [
            'label' => esc_html__( 'Content', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control( 'wrap_content_align', [
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
                '{{WRAPPER}} .swe-wrap-content' => '{{VALUE}}',
            ],
            'selectors_dictionary' => [
                'left'   => 'align-items: flex-start;',
                'right'   => 'align-items: flex-end;',
                'center'   => 'align-items: center;',
            ],
        ]);

        $this->add_responsive_control( 'wrap_content_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'wrap_title_heading', [
            'label' => esc_html__( 'Title', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'wrap_title_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .swe-title, {{WRAPPER}} .swe-title a',
        ]);

        $this->add_control( 'wrap_title_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-title a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_title_color_hover', [
            'label' => esc_html__( 'Color hover', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-title a:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('wrap_title_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'wrap_description_heading', [
            'label' => esc_html__( 'Description', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'wrap_description_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .swe-description',
        ]);

        $this->add_control( 'wrap_description_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-description' => 'color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_section();


        /**
        * Style Arrows and dots
        */
        $this->start_controls_section( 'section_style_arrows_and_dots', [
            'label' => esc_html__( 'Arrows & dots', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'section_style_arrows', [
            'label' => esc_html__( 'Arrows', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
        ]);

        $this->add_responsive_control('slider_arrows_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Block', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Size', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Normal', 'sw-post-elements' ),
        ]);

        $this->add_control( 'slider_arrows_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-slider .swe-slider-btn' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'slider_arrows_bg', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-slider .swe-slider-btn' => 'background: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab( 'slider_arrows_hover', [
            'label' => esc_html__( 'Hover', 'sw-post-elements' ),
        ]);

        $this->add_control( 'slider_arrows_color_hover', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-slider .swe-slider-btn:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'slider_arrows_bg_hover', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-slider .swe-slider-btn:hover' => 'background: {{VALUE}};',
            ],
        ]);
        
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control('slider_arrows_border_radius', [
            'label' => esc_html__( 'Border radius', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Dots', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->add_responsive_control('slider_dots_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Normal', 'sw-post-elements' ),
        ]);

        $this->add_control( 'slider_dots_bg', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .slick-dots li' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('slider_dots_block', [
            'label' => esc_html__( 'Block', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Hover & Active', 'sw-post-elements' ),
        ]);

        $this->add_control( 'slider_dots_bg_hover', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .slick-dots li:hover, {{WRAPPER}} .slick-dots li.slick-active' => 'background: {{VALUE}};',
            ],
        ]);
        
        $this->add_responsive_control('slider_dots_active_width', [
            'label' => esc_html__( 'Width active', 'sw-post-elements' ),
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
            'label' => esc_html__( 'Border radius', 'sw-post-elements' ),
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
            'data-slides_to_show_tablet'   => $settings[ 'slides_to_show' ] ? $settings[ 'slides_to_show_tablet' ]['size'] : 2,
            'data-slides_to_show_mobile'   => $settings[ 'slides_to_show' ] ? $settings[ 'slides_to_show_mobile' ]['size'] : 2,

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

        $this->getViewTemplate('template', 'category-slider', $settings);
    }
}

ElementorPlugin::instance()->widgets_manager->register(new SWE_Category_Slider());
