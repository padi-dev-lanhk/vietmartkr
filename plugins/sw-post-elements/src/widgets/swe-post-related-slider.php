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
 * SWE_Post_Related_Slider
 *
 * @author Youtech
 * @package SWE
 */

final class SWE_Post_Related_Slider extends SWE_Widget_Base {
    /**
     * @return string
     */
    function get_name() {
        return 'swe-post-related-slider';
    }

    /**
     * @return string
     */
    function get_title() {
        return esc_html__('SWE Post Related Slider', 'sw-post-elements');
    }

    /**
     * @return string
     */
    function get_icon() {
        return 'eicon-posts-carousel';
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
            'label' => esc_html__( 'Content Settings', 'sw-post-elements' ),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control( 'title', [
            'label' => esc_html__('Title', 'sw-post-elements'),
            'description' => esc_html__('', 'sw-post-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default'     => esc_html__( 'Related Posts', 'sw-post-elements' ),
        ]);

        $this->add_control('layout_style', [
            'label' => esc_html__( 'Layout Style', 'sw-post-elements' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__('Default', 'sw-post-elements'),
                'image-left' => esc_html__('Image Left', 'sw-post-elements'),
                'content-overlay' => esc_html__('Content Overlay', 'sw-post-elements'),
            ],
            'default' => ''
        ]);

        $this->add_control('post_format_media', [
            'label' => esc_html__( 'Post Format Media', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'sw-post-elements' ),
            'label_off' => esc_html__( 'Hide', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'no',
        ]);

        $this->add_control( 'show_image', [
            'label' => esc_html__( 'Show Image', 'sw-post-elements' ),
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

        $this->add_control( 'related_posts', [
            'label' => esc_html__( 'Related Posts by', 'sw-post-elements' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'category' => esc_html__('Category', 'sw-post-elements'),
                'tags' => esc_html__('Tags', 'sw-post-elements'),
            ],
            'default' => 'category'
        ]);

        $this->add_control( 'post_number', [
            'label' => esc_html__( 'Post Number', 'sw-post-elements' ),
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
        * Style wrap head
        */
        $this->start_controls_section( 'section_style_wrap_head', [
            'label' => esc_html__( 'Heading', 'sw-post-elements' ),
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
        * Style wrap title
        */
        $this->start_controls_section( 'section_style_wrap_title', [
            'label' => esc_html__( 'Title', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
                'title!' => ''
            ]
        ]);

        $this->add_responsive_control( 'wrap_title_position', [
            'label'                => esc_html__( 'Position', 'sw-post-elements' ),
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
                '{{WRAPPER}} .swe-wrap-head' => '{{VALUE}}',
            ],
            'selectors_dictionary' => [
                'left'   => 'justify-content: flex-start;',
                'center'   => 'justify-content: center;',
                'right'  => 'justify-content: flex-end;',
            ],
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'wrap_title_head_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .swe-wrap-head .swe-title',
        ]);

        $this->add_control( 'wrap_title_head_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-head .swe-title' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_title_head_bg', [
            'label' => esc_html__( 'Background', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-wrap-head .swe-title' => 'background: {{VALUE}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'wrap_title_head_border',
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-wrap-head .swe-title',
        ]);

        $this->add_control( 'wrap_title_head_border_radius', [
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
                '{{WRAPPER}} .swe-wrap-head .swe-title' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control( 'wrap_title_head_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-head .swe-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control( 'wrap_title_head_margin', [
            'label'      => esc_html__( 'Margin', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-head .swe-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_control( 'wrap_post_image_fix', [
            'label' => esc_html__( 'Fix Image', 'sw-post-elements' ),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'sw-post-elements' ),
            'label_off' => esc_html__( 'No', 'sw-post-elements' ),
            'return_value' => 'yes',
            'default' => 'no',
        ]);

        $this->add_responsive_control('wrap_post_image_height', [
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
                'wrap_post_image_fix' => 'yes'
            ]
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
            'selector' => '{{WRAPPER}} .swe-title, {{WRAPPER}} .swe-title a',
        ]);

        $this->add_control( 'wrap_post_title_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-title a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control( 'wrap_post_title_color_hover', [
            'label' => esc_html__( 'Color hover', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-title a:hover' => 'color: {{VALUE}};',
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
                '{{WRAPPER}} .swe-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
            'data-slides_to_show_tablet'   => $settings[ 'slides_to_show_tablet' ] ? $settings[ 'slides_to_show_tablet' ]['size'] : 2,
            'data-slides_to_show_mobile'   => $settings[ 'slides_to_show_mobile' ] ? $settings[ 'slides_to_show_mobile' ]['size'] : 2,

            'data-slides_to_rows'   => $settings[ 'slides_to_rows' ] ? $settings[ 'slides_to_rows' ]['size'] : 1,
            'data-slides_to_rows_tablet'   => $settings[ 'slides_to_rows_tablet' ] ? $settings[ 'slides_to_rows_tablet' ]['size'] : 1,
            'data-slides_to_rows_mobile'   => $settings[ 'slides_to_rows_mobile' ] ? $settings[ 'slides_to_rows_mobile' ]['size'] : 1,

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

        $this->getViewTemplate('template', 'post-related-slider', $settings);
    }
}

ElementorPlugin::instance()->widgets_manager->register(new SWE_Post_Related_Slider());
