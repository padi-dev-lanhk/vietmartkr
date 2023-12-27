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
 * SWE_Testimonial
 *
 * @author Youtech
 * @package SWE
 */

final class SWE_Testimonial extends SWE_Widget_Base {
    /**
     * @return string
     */
    function get_name() {
        return 'swe-testimonial';
    }

    /**
     * @return string
     */
    function get_title() {
        return esc_html__('SWE Testimonial', 'sw-post-elements');
    }

    /**
     * @return string
     */
    function get_icon() {
        return 'eicon-testimonial-carousel';
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
     * @return array Widget scripts dependencies.
     */
    protected function register_controls() {

        $this->start_controls_section('content_settings', [
            'label' => esc_html__('Content Settings', 'sw-post-elements')
        ]);
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control( 'avatar', [
            'label' => esc_html__('Author Avatar', 'sw-post-elements'),
            'type' => Controls_Manager::MEDIA,
            'default' => []
        ]);

        $repeater->add_control( 'author_name', [
            'label' => esc_html__('Author Name', 'sw-post-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
        ]);

        $repeater->add_control('author_desc', [
            'label' => esc_html__('Author Description', 'sw-post-elements'),
            'type' => Controls_Manager::TEXT,
        ]);
        
        $repeater->add_control( 'testimonial_content', [
            'label' => esc_html__('Testimonial Content', 'sw-post-elements'),
            'type' => Controls_Manager::TEXTAREA,
        ]);
        
        $repeater->add_control('star', [
            'label' => esc_html__('Star', 'sw-post-elements'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 5,
                ]
            ],
        ]);

        $this->add_control('content', [
            'label' => esc_html__('Content', 'sw-post-elements'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ author_name }}}',
            'default' => [
                [
                    'author_name' => esc_html__('John Doe', 'sw-post-elements'),
                    'author_desc' => esc_html__('Designer', 'sw-post-elements'),
                    'testimonial_content' => esc_html__('Lorem ipsum, dolor sit amet consectetur adipisicing, elit. Repudiandae nemo sit nostrum laborum explicabo commodi harum neque deserunt.', 'sw-post-elements')
                ],
                [
                    'author_name' => esc_html__('Samppa Nori', 'sw-post-elements'),
                    'author_desc' => esc_html__('Developer', 'sw-post-elements'),
                    'testimonial_content' => esc_html__('Lorem ipsum, dolor sit amet consectetur adipisicing, elit. Repudiandae nemo sit nostrum laborum explicabo commodi harum neque deserunt.', 'sw-post-elements')
                ],
                [
                    'author_name' => esc_html__('Estavan Lykos', 'sw-post-elements'),
                    'author_desc' => esc_html__('Enginer', 'sw-post-elements'),
                    'testimonial_content' => esc_html__('Lorem ipsum, dolor sit amet consectetur adipisicing, elit. Repudiandae nemo sit nostrum laborum explicabo commodi harum neque deserunt.', 'sw-post-elements')
                ],
            ],

        ]);

        $this->add_control('show_quotation', [
            'label' => esc_html__('Enable Quotation Icon', 'sw-post-elements'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'true',
            'default' => 'false',
            'separator' => 'before',
        ]);

        $this->add_control('style', [
            'label' => esc_html__('Style', 'sw-post-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => 'default',
            'options' => [
                'default' => esc_html__('Default', 'sw-post-elements'),
                'style-1' => esc_html__('Style 1', 'sw-post-elements'),
                'style-2' => esc_html__('Style 2', 'sw-post-elements'),
                'style-3' => esc_html__('Style 3', 'sw-post-elements'),
            ],
            'description' => esc_html__('style of testimonial.', 'sw-post-elements'),
        ]);

        $this->add_control('show_avatar', [
            'label' => esc_html__('Show user avatar', 'sw-post-elements'),
            'description' => esc_html__('', 'sw-post-elements'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'true',
            'default' => 'false',
        ]);

        $this->add_control('show_desc', [
            'label' => esc_html__('Show user description', 'sw-post-elements'),
            'description' => esc_html__('', 'sw-post-elements'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'true',
            'default' => 'false',
        ]);

        $this->add_control('show_star', [
            'label' => esc_html__('Show Star', 'sw-post-elements'),
            'description' => esc_html__('', 'sw-post-elements'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'true',
            'default' => 'false',
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
        * Style Items
        */
        $this->start_controls_section( 'section_style_items', [
            'label' => esc_html__( 'Items', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control( 'wrap_items_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        /**
        * Style Content
        */
        $this->start_controls_section( 'section_style_content', [
            'label' => esc_html__( 'Content', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('wrap_content_width', [
            'label' => esc_html__( 'Width', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-content' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control( 'wrap_content_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name' => 'box_shadow',
            'label' => esc_html__( 'Box Shadow', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-content',
        ]);

        $this->add_responsive_control('wrap_content_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .style-3 .swe-content' => 'margin-bottom: 0px;margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);


        $this->add_control( 'wrap_quote_heading', [
            'label' => esc_html__( 'Quote', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
        ]);

        $this->add_responsive_control('wrap_quote_size', [
            'label' => esc_html__( 'Size', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-content .swe-quote' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'wrap_quote_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-content .swe-quote' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('wrap_quote_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-content .swe-quote' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'wrap_content_text_heading', [
            'label' => esc_html__( 'Content text', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'wrap_content_text_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .swe-content .swe-text',
        ]);

        $this->add_control( 'wrap_content_text_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-content .swe-text' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('wrap_content_text_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-content .swe-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'wrap_rate_heading', [
            'label' => esc_html__( 'Star', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
        ]);

        $this->add_responsive_control('wrap_rate_size', [
            'label' => esc_html__( 'Size', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-content .swe-rate' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'wrap_rate_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-content .swe-rate' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('wrap_rate_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-content .swe-rate i ~ i' => 'margin-left: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();




        /**
        * Style Author
        */
        $this->start_controls_section( 'section_style_author', [
            'label' => esc_html__( 'Author', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control( 'wrap_avatar_heading', [
            'label' => esc_html__( 'Avatar', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
        ]);

        $this->add_responsive_control('wrap_avatar_width', [
            'label' => esc_html__( 'Width', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-avatar' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
            ],
        ]);

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'wrap_avatar_border',
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .swe-avatar',
        ]);



        $this->add_responsive_control('wrap_avatar_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-avatar' => 'margin-right: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .style-1 .swe-avatar' => 'margin-right: 0;margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control( 'wrap_name_heading', [
            'label' => esc_html__( 'Author Name', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'wrap_name_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .swe-author .swe-name',
        ]);

        $this->add_control( 'wrap_name_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-author .swe-name' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('wrap_name_space', [
            'label' => esc_html__( 'Space', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors'  => [
                '{{WRAPPER}} .swe-author .swe-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);




        $this->add_control( 'wrap_desc_heading', [
            'label' => esc_html__( 'Author Description', 'sw-post-elements' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before'
        ]);

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name' => 'wrap_desc_typography',
            'scheme' => Typography::TYPOGRAPHY_1,
            'selector' => '{{WRAPPER}} .swe-author .swe-description',
        ]);

        $this->add_control( 'wrap_desc_color', [
            'label' => esc_html__( 'Color', 'sw-post-elements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-author .swe-description' => 'color: {{VALUE}};',
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
		
		$this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'slider_dots_border',
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
            'selector' => '{{WRAPPER}} .slick-dots li',
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
		
		$this->add_group_control( Group_Control_Border::get_type(), [
            'name' => 'slider_dots_border_active',
            'label' => esc_html__( 'Border', 'sw-post-elements' ),
			'selector' => '{{WRAPPER}} .slick-dots li:hover, {{WRAPPER}} .slick-dots li.slick-active',
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

        $this->getViewTemplate('template', 'testimonial', $settings);
    }
}

ElementorPlugin::instance()->widgets_manager->register(new SWE_Testimonial());
