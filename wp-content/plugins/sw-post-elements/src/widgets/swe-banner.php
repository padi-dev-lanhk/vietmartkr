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
 * SWE_Banner
 *
 * @author Youtech
 * @package SWE
 */

final class SWE_Banner extends SWE_Widget_Base {
    /**
     * @return string
     */
    function get_name() {
        return 'swe-banner';
    }

    /**
     * @return string
     */
    function get_title() {
        return esc_html__('SWE Banner', 'sw-post-elements');
    }

    /**
     * @return string
     */
    function get_icon() {
        return 'eicon-image-bold';
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

        $this->add_control('title', [
            'label' => esc_html__('Title', 'sw-post-elements'),
            'description' => esc_html__('', 'sw-post-elements'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'default'     => esc_html__( 'Banner Heading', 'sw-post-elements' ),
        ]);

        $this->add_control( 'image', [
            'label' => esc_html__( 'Image', 'sw-post-elements' ),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => Utils::get_placeholder_image_src(),
            ],
        ]);

        $this->add_group_control( Group_Control_Image_Size::get_type(), [
            'name' => 'image',
            'default' => 'large',
            'separator' => 'none',
        ]);

        $this->add_control('effect', [
            'label' => esc_html__('Effect', 'sw-post-elements'),
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'condition' => [
                'image[url]!' => ''
            ],
            'options' => [
                '' => esc_html__('None', 'sw-post-elements'),
                'lily' => esc_html__('Lily', 'sw-post-elements'),
                'sadie' => esc_html__('Sadie', 'sw-post-elements'),
                'roxy' => esc_html__('Roxy', 'sw-post-elements'),
                'bubba' => esc_html__('Bubba', 'sw-post-elements'),
                'romeo' => esc_html__('Romeo', 'sw-post-elements'),
                'layla' => esc_html__('Layla', 'sw-post-elements'),
                'honey' => esc_html__('Honey', 'sw-post-elements'),
                'oscar' => esc_html__('Oscar', 'sw-post-elements'),
                'marley' => esc_html__('Marley', 'sw-post-elements'),
                'ruby' => esc_html__('Ruby', 'sw-post-elements'),
                'milo' => esc_html__('Milo', 'sw-post-elements'),
                'dexter' => esc_html__('Dexter', 'sw-post-elements'),
                'sarah' => esc_html__('Sarah', 'sw-post-elements'),
                'zoe' => esc_html__('Zoe', 'sw-post-elements'),
                'chico' => esc_html__('Chico', 'sw-post-elements'),
            ]
        ]);

        $this->add_control( 'banner_background', [
            'label'     => esc_html__( 'Background color', 'sw-post-elements' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}' => 'background-color: {{VALUE}}'
            ]
        ] );

        $this->add_control('description', [
            'label' => esc_html__('Description', 'sw-post-elements'),
            'description' => esc_html__('', 'sw-post-elements'),
            'type' => Controls_Manager::TEXTAREA,
            'default'    => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sw-post-elements' ),
        ]);

        $this->add_control( 'button_text', [
            'label'   => esc_html__( 'Button Text', 'sw-post-elements' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'Click Here', 'sw-post-elements' ),
        ] );

        $this->add_control('link', [
            'label' => esc_html__('Link', 'sw-post-elements'),
            'type' => Controls_Manager::URL,
        ]);

        $this->add_control('title_tag', [
            'label'     => esc_html__('Title tag', 'sw-post-elements'),
            'type'      => Controls_Manager::SELECT,
            'options'   => $this->getHtmlTag(),
            'default'   => 'h2'
        ]);

        $this->end_controls_section();

        /**
        * Content Position
        */
        $this->start_controls_section(
            'content_position',
            [
                'label' => esc_html__( 'Content Position', 'sw-post-elements' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control( 'content_max_width', [
            'label'          => esc_html__( 'Content Width', 'sw-post-elements' ),
            'type'           => Controls_Manager::SLIDER,
            'range'          => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
                '%'  => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'size_units'     => [ '%', 'px' ],
            'default'        => [
                'size' => '100',
                'unit' => '%',
            ],
            'tablet_default' => [
                'unit' => '%',
            ],
            'mobile_default' => [
                'unit' => '%',
            ],
            'selectors'      => [
                '{{WRAPPER}} .swe-wrap-content > div' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ] );

        $this->add_responsive_control( 'horizontal_position', [
            'label'                => esc_html__( 'Horizontal Position', 'sw-post-elements' ),
            'type'                 => Controls_Manager::CHOOSE,
            'label_block'          => false,
            'options'              => $this->getOptionPosition('hor'),
            'selectors'            => [
                '{{WRAPPER}} .swe-wrap-content' => '{{VALUE}}',
            ],
            'selectors_dictionary' => [
                'left'   => 'justify-content: flex-start;',
                'center' => 'justify-content: center;',
                'right'  => 'justify-content: flex-end;',
            ],
        ] );

        $this->add_responsive_control( 'vertical_position', [
            'label'                => esc_html__( 'Vertical Position', 'sw-post-elements' ),
            'type'                 => Controls_Manager::CHOOSE,
            'label_block'          => false,
            'options'              => $this->getOptionPosition('ver'),
            'selectors'            => [
                '{{WRAPPER}} .swe-wrap-content' => '{{VALUE}}',
            ],
            'selectors_dictionary' => [
                'top'    => 'align-items: flex-start',
                'middle' => 'align-items: center',
                'bottom' => 'align-items: flex-end',
            ],
        ] );

        $this->add_responsive_control( 'text_align', [
            'label'       => esc_html__( 'Text Align', 'sw-post-elements' ),
            'type'        => Controls_Manager::CHOOSE,
            'label_block' => false,
            'options'     => $this->getOptionPosition(''),
            'selectors'   => [
                '{{WRAPPER}} .swe-wrap-content' => 'text-align: {{VALUE}}',
            ],
        ] );
        
        $this->end_controls_section();

        /**
        * Style Content Banner
        */
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'sw-post-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control( 'banner_margin', [
            'label'      => esc_html__( 'Margin', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-content > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ] );
        
        $this->add_responsive_control( 'banner_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-wrap-content > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ] );

        $this->add_control(
            'align_divider',
            [
                'type'       => Controls_Manager::DIVIDER,
                'style'      => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'banner_border',
                'label' => esc_html__( 'Border', 'sw-post-elements' ),
                'selector' => '{{WRAPPER}} .swe-wrap-content > div',
            ]
        );

        $this->add_control( 'banner_border_radius', [
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
                '{{WRAPPER}} .swe-wrap-content > div' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
        ] );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .swe-wrap-content > div',
            ]
        );

        $this->end_controls_section();

        /**
        * Background Overlay
        */
        $this->start_controls_section(
            'section_background_overlay',
            [
                'label' => esc_html__( 'Background Overlay', 'sw-post-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control( 'background_overlay', [
            'label'       => esc_html__( 'Background Overlay', 'sw-post-elements' ),
            'type'        => Controls_Manager::SWITCHER,
            'return_value' => 'true'
        ] );

        $this->start_controls_tabs( 'tabs_background_overlay', [
            'condition' => [
                'background_overlay' => 'true',
            ],
        ] );

        $this->start_controls_tab(
            'tab_background_overlay_normal',
            [
                'label' => esc_html__( 'Normal', 'sw-post-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_overlay_normal',
                'selector' => '{{WRAPPER}} .swe-bg-overlay',
            ]
        );

        $this->add_control(
            'background_overlay_opacity',
            [
                'label' => esc_html__( 'Opacity (%)', 'sw-post-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swe-bg-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_background_overlay_hover',
            [
                'label' => esc_html__( 'Hover', 'sw-post-elements' )
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_overlay_hover',
                'selector' => '{{WRAPPER}}:hover .swe-bg-overlay',
            ]
        );

        $this->add_control(
            'background_overlay_hover_opacity',
            [
                'label' => esc_html__( 'Opacity (%)', 'sw-post-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}:hover .swe-bg-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'background_overlay_hover_transition',
            [
                'label' => esc_html__( 'Transition Duration', 'sw-post-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.3,
                ],
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} .swe-bg-overlay' => 'transition: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /**
        * Style for title
        */
        $this->start_controls_section('title_style', [
            'label' => esc_html__('Title', 'sw-post-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('title_color', [
            'label' => esc_html__('Color', 'sw-post-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-title' => 'color: {{VALUE}};'
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .swe-title',
                'scheme' => Typography::TYPOGRAPHY_1,
            ]
        );
        $this->add_control('title_space', [
            'label' => esc_html__('Space', 'sw-post-elements'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .swe-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);
        $this->end_controls_section();

        /**
        * Style for description
        */
        $this->start_controls_section('description_style', [
            'label' => esc_html__('Description', 'sw-post-elements'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('description_color', [
            'label' => esc_html__('Color', 'sw-post-elements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-description p' => 'color: {{VALUE}};'
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .swe-description p',
                'scheme' => Typography::TYPOGRAPHY_1,
            ]
        );
        $this->add_control('description_space', [
            'label' => esc_html__('Space', 'sw-post-elements'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .swe-description p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]);
        $this->end_controls_section();

        /**
        * Style for button
        */
        $this->start_controls_section( 'section_style_button', [
            'label' => esc_html__( 'Button', 'sw-post-elements' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'button_typography',
            'selector' => '{{WRAPPER}} .swe-button',
            'scheme'   => Typography::TYPOGRAPHY_4,
        ] );

        $this->add_responsive_control( 'button_padding', [
            'label'      => esc_html__( 'Padding', 'sw-post-elements' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .swe-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ] );
        
        $this->start_controls_tabs( 'button_tabs', [
            'separator' => 'before',
        ] );

        $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'sw-post-elements' ) ] );

        $this->add_control( 'button_text_color', [
            'label'     => esc_html__( 'Text Color', 'sw-post-elements' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-button' => 'color: {{VALUE}};',
            ],
        ] );

        $this->add_control( 'button_background_color', [
            'label'     => esc_html__( 'Background Color', 'sw-post-elements' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-button' => 'background-color: {{VALUE}};',
            ],
        ] );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__( 'Border', 'sw-post-elements' ),
                'selector' => '{{WRAPPER}} .swe-button',
            ]
        );
        
        $this->add_control( 'button_border_radius', [
            'label'     => esc_html__( 'Border Radius', 'sw-post-elements' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} .swe-button' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ] );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover', [ 'label' => esc_html__( 'Hover', 'sw-post-elements' ) ] );

        $this->add_control( 'button_hover_text_color', [
            'label'     => esc_html__( 'Text Color', 'sw-post-elements' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-button:hover' => 'color: {{VALUE}};',
            ],
        ] );

        $this->add_control( 'button_hover_background_color', [
            'label'     => esc_html__( 'Background Color', 'sw-post-elements' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-button:hover' => 'background-color: {{VALUE}};',
            ],
        ] );

        $this->add_control( 'button_hover_border_color', [
            'label'     => esc_html__( 'Border Color', 'sw-post-elements' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .swe-button:hover' => 'border-color: {{VALUE}};',
            ],
        ] );

        $this->add_control( 'button_transition', [
            'label' => esc_html__( 'Transition (s)', 'sw-post-elements' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
                'size' => .3,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .swe-button' => 'transition: {{SIZE}}s;',
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

        $this->getViewTemplate('template', 'banner', $settings);
    }
}

ElementorPlugin::instance()->widgets_manager->register(new SWE_Banner());
