<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Cryptlight_Elementor_Road_Map extends Widget_Base {

	
	public function get_name() {
		return 'cryptlight_elementor_road_map';
	}

	public function get_title() {
		return esc_html__( 'Road Map', 'cryptlight' );
	}

	public function get_icon() {
		return 'eicon-time-line';
	}

	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_script_depends() {
		wp_enqueue_script( 'cryptlight-road-map-appear', get_theme_file_uri('/assets/libs/appear/appear.js'), array('jquery'), false, true);
		return [ 'cryptlight-elementor-road-map' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		/* Begin section road map */
		$this->start_controls_section(
			'section_road_map',
			[
				'label' => esc_html__( 'Road Map', 'cryptlight' ),
			]
		);	
			
			$this->add_control(
	            'type',
	            [
	                'label' 	=> esc_html__( 'Type', 'cryptlight' ),
	                'type' 		=> Controls_Manager::SELECT,
	                'options' 	=> [
	                    'v1' => esc_html__( 'Type 1', 'cryptlight' ),
	                    'v2' => esc_html__( 'Type 2', 'cryptlight' ),
	                    'v3' => esc_html__( 'Type 3', 'cryptlight' ),
	                    'v4' => esc_html__( 'Type 4', 'cryptlight' ),
	                    'v5' => esc_html__( 'Type 5', 'cryptlight' ),
	                    'v6' => esc_html__( 'Type 6', 'cryptlight' ),
	                ],
	                'default' 	=> 'v1',
	            ]
	        );
			// Version 1
	        $repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'date',
					[
						'label' 		=> esc_html__( 'Date', 'cryptlight' ),
						'type' 			=> Controls_Manager::DATE_TIME,
						'default'		=> date( 'Y-m-d h:i', current_time('timestamp')),
						'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
					]
				);

				$repeater->add_control(
					'content',
					[
						'label' 		=> esc_html__( 'Content', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXTAREA,
						'default' 		=> esc_html__('In this time period, our Intelligent and talent founders had a concept of creating our ICO to call for investment', 'cryptlight' ),
					]
				);

				$repeater->add_control(
					'timeline_done',
					[
						'label' 	=> esc_html__( 'Timeline Done', 'cryptlight' ),
						'type' 		=> Controls_Manager::SWITCHER,
						'label_on' 	=> esc_html__( 'Yes', 'cryptlight' ),
						'label_off' => esc_html__( 'No', 'cryptlight' ),
						'default' 	=> 'yes',
					]
				);

				$repeater->add_responsive_control(
					'animation_content',
					[
						'label' => esc_html__( 'Animation Content', 'cryptlight' ),
						'type' 	=> Controls_Manager::ANIMATION,
					]
				);

				$repeater->add_control(
					'animation_duration_content',
					[
						'label' 	=> esc_html__( 'Animation Duration', 'cryptlight' ),
						'type' 		=> Controls_Manager::SELECT,
						'default' 	=> '',
						'options' 	=> [
							'slow' 	=> esc_html__( 'Slow', 'cryptlight' ),
							'' 		=> esc_html__( 'Normal', 'cryptlight' ),
							'fast' 	=> esc_html__( 'Fast', 'cryptlight' ),
						],
						'condition' => [
							'animation_content!' => '',
						],
					]
				);

				$repeater->add_control(
					'animation_delay_content',
					[
						'label' 	=> esc_html__( 'Animation Delay', 'cryptlight' ) . ' (ms)',
						'type' 		=> Controls_Manager::NUMBER,
						'default' 	=> '',
						'min' 		=> 0,
						'step' 		=> 100,
						'condition' => [
							'animation_content!' => '',
						],
					]
				);

			$this->add_control(
				'road_map_items',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'date' 				=> esc_html__( '2021-03-01', 'cryptlight' ),
							'content' 			=> esc_html__('In this time period, our Intelligent and talent founders had a concept.', 'cryptlight' ),
							'timeline_done' 	=> 'yes',
						],
						[
							'date' 			=> esc_html__( '2021-05-01', 'cryptlight' ),
							'content' 		=> esc_html__('In this time period, our Intelligent and talent founders had a concept of.', 'cryptlight' ),
							'timeline_done' => 'yes',
						],
						[
							'date' 			=> esc_html__( '2021-07-01', 'cryptlight' ),
							'content' 		=> esc_html__('In this time period, our Intelligent and talent founders had a concept.', 'cryptlight' ),
							'timeline_done' => 'no',
						],
						[
							'date' 			=> esc_html__( '2021-09-01', 'cryptlight' ),
							'content' 		=> esc_html__('In this time period, our Intelligent and talent founders had a concept of.', 'cryptlight' ),
							'timeline_done' => 'no',
						],
						[
							'date' 			=> esc_html__( '2021-11-01', 'cryptlight' ),
							'content' 		=> esc_html__('In this time period, our Intelligent and talent founders had a concept.', 'cryptlight' ),
							'timeline_done' => 'no',
						],
						[
							'date' 			=> esc_html__( '2021-01-01', 'cryptlight' ),
							'content' 		=> esc_html__('In this time period, our Intelligent and talent founders had a concept of.', 'cryptlight' ),
							'timeline_done' => 'no',
						],
					],
					'condition'	=> [
						'type' => 'v1',
					],
				]
			);
			
			$this->add_control(
				'show_item_1',
				[
					'label' 	=> esc_html__( 'Show Item 1', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'yes',
					'condition'	=> [
						'type' => 'v2',
					],
				]
			);

			// Item 1
			$repeater_1 = new \Elementor\Repeater();

				$repeater_1->add_control(
					'date_1',
					[
						'label' 		=> esc_html__( 'Date', 'cryptlight' ),
						'type' 			=> Controls_Manager::DATE_TIME,
						'default'		=> date( 'Y-m-d h:i', current_time('timestamp')),
						'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
					]
				);

				$repeater_1->add_control(
					'title_1',
					[
						'label' 	=> esc_html__( 'Title', 'cryptlight' ),
						'type' 		=> Controls_Manager::TEXT,
						'default' 	=> esc_html__( 'Concept', 'cryptlight' ),
					]
				);

				$repeater_1->add_control(
					'content_1',
					[
						'label' 		=> esc_html__( 'Content', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXTAREA,
						'description' 	=> esc_html__( 'Separated by commas(,)', 'cryptlight' ),
						'default' 		=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
					]
				);

				$repeater_1->add_control(
					'timeline_done_1',
					[
						'label' 	=> esc_html__( 'Timeline Done', 'cryptlight' ),
						'type' 		=> Controls_Manager::SWITCHER,
						'label_on' 	=> esc_html__( 'Yes', 'cryptlight' ),
						'label_off' => esc_html__( 'No', 'cryptlight' ),
						'default' 	=> 'yes',
					]
				);

				$repeater_1->add_responsive_control(
					'animation_date_1',
					[
						'label' => esc_html__( 'Animation Date', 'cryptlight' ),
						'type' 	=> Controls_Manager::ANIMATION,
					]
				);

				$repeater_1->add_control(
					'animation_duration_date_1',
					[
						'label' 	=> esc_html__( 'Animation Duration', 'cryptlight' ),
						'type' 		=> Controls_Manager::SELECT,
						'default' 	=> '',
						'options' 	=> [
							'slow' 	=> esc_html__( 'Slow', 'cryptlight' ),
							'' 		=> esc_html__( 'Normal', 'cryptlight' ),
							'fast' 	=> esc_html__( 'Fast', 'cryptlight' ),
						],
						'condition' => [
							'animation_date_1!' => '',
						],
					]
				);

				$repeater_1->add_control(
					'animation_delay_date_1',
					[
						'label' 	=> esc_html__( 'Animation Delay', 'cryptlight' ) . ' (ms)',
						'type' 		=> Controls_Manager::NUMBER,
						'default' 	=> '',
						'min' 		=> 0,
						'step' 		=> 100,
						'condition' => [
							'animation_date_1!' => '',
						],
					]
				);

				$repeater_1->add_responsive_control(
					'animation_content_1',
					[
						'label' => esc_html__( 'Animation Content', 'cryptlight' ),
						'type' 	=> Controls_Manager::ANIMATION,
					]
				);

				$repeater_1->add_control(
					'animation_duration_content_1',
					[
						'label' 	=> esc_html__( 'Animation Duration', 'cryptlight' ),
						'type' 		=> Controls_Manager::SELECT,
						'default' 	=> '',
						'options' 	=> [
							'slow' 	=> esc_html__( 'Slow', 'cryptlight' ),
							'' 		=> esc_html__( 'Normal', 'cryptlight' ),
							'fast' 	=> esc_html__( 'Fast', 'cryptlight' ),
						],
						'condition' => [
							'animation_content_1!' => '',
						],
					]
				);

				$repeater_1->add_control(
					'animation_delay_content_1',
					[
						'label' 	=> esc_html__( 'Animation Delay', 'cryptlight' ) . ' (ms)',
						'type' 		=> Controls_Manager::NUMBER,
						'default' 	=> '',
						'min' 		=> 0,
						'step' 		=> 100,
						'condition' => [
							'animation_content_1!' => '',
						],
					]
				);

			$this->add_control(
				'road_map_items_1',
				[
					'label' 	=> esc_html__( 'Items 1', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater_1->get_controls(),
					'default' 	=> [
						[
							'date_1' 			=> esc_html__( '2021-01-01', 'cryptlight' ),
							'title_1' 			=> esc_html__( 'Concept', 'cryptlight' ),
							'content_1' 		=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_1' 	=> 'yes',
						],
						[
							'date_1' 			=> esc_html__( '2021-03-01', 'cryptlight' ),
							'title_1' 			=> esc_html__( 'Research', 'cryptlight' ),
							'content_1' 		=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_1' 	=> 'yes',
						],
						[
							'date_1' 			=> esc_html__( '2021-05-01', 'cryptlight' ),
							'title_1' 			=> esc_html__( 'Pre-Sale', 'cryptlight' ),
							'content_1' 		=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_1' 	=> 'yes',
						],
					],
					'title_field' 	=> '{{{ title_1 }}}',
					'condition'		=> [
						'type' => 'v2',
					],
				]
			);

			$this->add_control(
				'show_item_2',
				[
					'label' 	=> esc_html__( 'Show Item 2', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'yes',
					'condition'	=> [
						'type' => 'v2',
					],
				]
			);

			// Item 2
			$repeater_2 = new \Elementor\Repeater();

				$repeater_2->add_control(
					'date_2',
					[
						'label' 		=> esc_html__( 'Date', 'cryptlight' ),
						'type' 			=> Controls_Manager::DATE_TIME,
						'default'		=> date( 'Y-m-d h:i', current_time('timestamp')),
						'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
					]
				);

				$repeater_2->add_control(
					'title_2',
					[
						'label' 	=> esc_html__( 'Title', 'cryptlight' ),
						'type' 		=> Controls_Manager::TEXT,
						'default' 	=> esc_html__( 'App beta test', 'cryptlight' ),
					]
				);

				$repeater_2->add_control(
					'content_2',
					[
						'label' 		=> esc_html__( 'Content', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXTAREA,
						'description' 	=> esc_html__( 'Separated by commas(,)', 'cryptlight' ),
						'default' 		=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
					]
				);

				$repeater_2->add_control(
					'timeline_done_2',
					[
						'label' 	=> esc_html__( 'Timeline Done', 'cryptlight' ),
						'type' 		=> Controls_Manager::SWITCHER,
						'label_on' 	=> esc_html__( 'Yes', 'cryptlight' ),
						'label_off' => esc_html__( 'No', 'cryptlight' ),
						'default' 	=> 'yes',
					]
				);

				$repeater_2->add_responsive_control(
					'animation_date_2',
					[
						'label' => esc_html__( 'Animation Date', 'cryptlight' ),
						'type' 	=> Controls_Manager::ANIMATION,
					]
				);

				$repeater_2->add_control(
					'animation_duration_date_2',
					[
						'label' 	=> esc_html__( 'Animation Duration', 'cryptlight' ),
						'type' 		=> Controls_Manager::SELECT,
						'default' 	=> '',
						'options' 	=> [
							'slow' 	=> esc_html__( 'Slow', 'cryptlight' ),
							'' 		=> esc_html__( 'Normal', 'cryptlight' ),
							'fast' 	=> esc_html__( 'Fast', 'cryptlight' ),
						],
						'condition' => [
							'animation_date_2!' => '',
						],
					]
				);

				$repeater_2->add_control(
					'animation_delay_date_2',
					[
						'label' 	=> esc_html__( 'Animation Delay', 'cryptlight' ) . ' (ms)',
						'type' 		=> Controls_Manager::NUMBER,
						'default' 	=> '',
						'min' 		=> 0,
						'step' 		=> 100,
						'condition' => [
							'animation_date_2!' => '',
						],
					]
				);

				$repeater_2->add_responsive_control(
					'animation_content_2',
					[
						'label' => esc_html__( 'Animation Content', 'cryptlight' ),
						'type' 	=> Controls_Manager::ANIMATION,
					]
				);

				$repeater_2->add_control(
					'animation_duration_content_2',
					[
						'label' 	=> esc_html__( 'Animation Duration', 'cryptlight' ),
						'type' 		=> Controls_Manager::SELECT,
						'default' 	=> '',
						'options' 	=> [
							'slow' 	=> esc_html__( 'Slow', 'cryptlight' ),
							'' 		=> esc_html__( 'Normal', 'cryptlight' ),
							'fast' 	=> esc_html__( 'Fast', 'cryptlight' ),
						],
						'condition' => [
							'animation_content_2!' => '',
						],
					]
				);

				$repeater_2->add_control(
					'animation_delay_content_2',
					[
						'label' 	=> esc_html__( 'Animation Delay', 'cryptlight' ) . ' (ms)',
						'type' 		=> Controls_Manager::NUMBER,
						'default' 	=> '',
						'min' 		=> 0,
						'step' 		=> 100,
						'condition' => [
							'animation_content_2!' => '',
						],
					]
				);

			$this->add_control(
				'road_map_items_2',
				[
					'label' 	=> esc_html__( 'Items 2', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater_2->get_controls(),
					'default' 	=> [
						[
							'date_2' 			=> esc_html__( '2021-07-01', 'cryptlight' ),
							'title_2' 			=> esc_html__( 'App beta test', 'cryptlight' ),
							'content_2' 		=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_2' 	=> 'yes',
						],
						[
							'date_2' 			=> esc_html__( '2021-09-01', 'cryptlight' ),
							'title_2' 			=> esc_html__( 'Token sale', 'cryptlight' ),
							'content_2' 		=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_2' 	=> 'no',
						],
					],
					'title_field' 	=> '{{{ title_2 }}}',
					'condition'		=> [
						'type' => 'v2',
					],
				]
			);

			$this->add_control(
				'show_item_3',
				[
					'label' 	=> esc_html__( 'Show Item 3', 'cryptlight' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'label_on' 	=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' => esc_html__( 'Hide', 'cryptlight' ),
					'default' 	=> 'yes',
					'condition'	=> [
						'type' => 'v2',
					],
				]
			);

			// Item 3
			$repeater_3 = new \Elementor\Repeater();

				$repeater_3->add_control(
					'date_3',
					[
						'label' 		=> esc_html__( 'Date', 'cryptlight' ),
						'type' 			=> Controls_Manager::DATE_TIME,
						'default'		=> date( 'Y-m-d h:i', current_time('timestamp')),
						'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
					]
				);

				$repeater_3->add_control(
					'title_3',
					[
						'label' 	=> esc_html__( 'Title', 'cryptlight' ),
						'type' 		=> Controls_Manager::TEXT,
						'default' 	=> esc_html__( 'Alpha test', 'cryptlight' ),
					]
				);

				$repeater_3->add_control(
					'content_3',
					[
						'label' 		=> esc_html__( 'Content', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXTAREA,
						'description' 	=> esc_html__( 'Separated by commas(,)', 'cryptlight' ),
						'default' 		=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
					]
				);

				$repeater_3->add_control(
					'timeline_done_3',
					[
						'label' 	=> esc_html__( 'Timeline Done', 'cryptlight' ),
						'type' 		=> Controls_Manager::SWITCHER,
						'label_on' 	=> esc_html__( 'Yes', 'cryptlight' ),
						'label_off' => esc_html__( 'No', 'cryptlight' ),
						'default' 	=> 'yes',
					]
				);

				$repeater_3->add_responsive_control(
					'animation_date_3',
					[
						'label' => esc_html__( 'Animation Date', 'cryptlight' ),
						'type' 	=> Controls_Manager::ANIMATION,
					]
				);

				$repeater_3->add_control(
					'animation_duration_date_3',
					[
						'label' 	=> esc_html__( 'Animation Duration', 'cryptlight' ),
						'type' 		=> Controls_Manager::SELECT,
						'default' 	=> '',
						'options' 	=> [
							'slow' 	=> esc_html__( 'Slow', 'cryptlight' ),
							'' 		=> esc_html__( 'Normal', 'cryptlight' ),
							'fast' 	=> esc_html__( 'Fast', 'cryptlight' ),
						],
						'condition' => [
							'animation_date_3!' => '',
						],
					]
				);

				$repeater_3->add_control(
					'animation_delay_date_3',
					[
						'label' 	=> esc_html__( 'Animation Delay', 'cryptlight' ) . ' (ms)',
						'type' 		=> Controls_Manager::NUMBER,
						'default' 	=> '',
						'min' 		=> 0,
						'step' 		=> 100,
						'condition' => [
							'animation_date_3!' => '',
						],
					]
				);

				$repeater_3->add_responsive_control(
					'animation_content_3',
					[
						'label' => esc_html__( 'Animation Content', 'cryptlight' ),
						'type' 	=> Controls_Manager::ANIMATION,
					]
				);

				$repeater_3->add_control(
					'animation_duration_content_3',
					[
						'label' 	=> esc_html__( 'Animation Duration', 'cryptlight' ),
						'type' 		=> Controls_Manager::SELECT,
						'default' 	=> '',
						'options' 	=> [
							'slow' 	=> esc_html__( 'Slow', 'cryptlight' ),
							'' 		=> esc_html__( 'Normal', 'cryptlight' ),
							'fast' 	=> esc_html__( 'Fast', 'cryptlight' ),
						],
						'condition' => [
							'animation_content_3!' => '',
						],
					]
				);

				$repeater_3->add_control(
					'animation_delay_content_3',
					[
						'label' 	=> esc_html__( 'Animation Delay', 'cryptlight' ) . ' (ms)',
						'type' 		=> Controls_Manager::NUMBER,
						'default' 	=> '',
						'min' 		=> 0,
						'step' 		=> 100,
						'condition' => [
							'animation_content_3!' => '',
						],
					]
				);

			$this->add_control(
				'road_map_items_3',
				[
					'label' 	=> esc_html__( 'Items 3', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater_3->get_controls(),
					'default' 	=> [
						[
							'date_3' 			=> esc_html__( '2021-11-01', 'cryptlight' ),
							'title_3' 			=> esc_html__( 'Alpha test', 'cryptlight' ),
							'content_3' 		=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_3' 	=> 'no',
						],
						[
							'date_3' 			=> esc_html__( '2022-01-01', 'cryptlight' ),
							'title_3' 			=> esc_html__( 'Benefits', 'cryptlight' ),
							'content_3' 		=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_3' 	=> 'no',
						],
						[
							'date_3' 			=> esc_html__( '2022-03-01', 'cryptlight' ),
							'title_3' 			=> esc_html__( 'Operational', 'cryptlight' ),
							'content_3' 		=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_3' 	=> 'no',
						],
					],
					'title_field' 	=> '{{{ title_3 }}}',
					'condition'		=> [
						'type' => 'v2',
					],
				]
			);

			// Version 3
			// Add Class control
			$repeater_v3 = new \Elementor\Repeater();

				$repeater_v3->add_control(
					'icon_v3',
					[
						'label' 	=> esc_html__( 'Class Icon', 'cryptlight' ),
						'type' 		=> Controls_Manager::TEXT,
						'default' 	=> esc_html__( 'fas fa-check', 'cryptlight' ),
					]
				);

				$repeater_v3->add_control(
					'number_v3',
					[
						'label' 	=> esc_html__( 'Number', 'cryptlight' ),
						'type' 		=> Controls_Manager::TEXT,
						'default' 	=> esc_html__( '01.', 'cryptlight' ),
					]
				);

				$repeater_v3->add_control(
					'title_v3',
					[
						'label' 	=> esc_html__( 'Title', 'cryptlight' ),
						'type' 		=> Controls_Manager::TEXT,
						'default' 	=> esc_html__('Add Your Title', 'cryptlight' ),
					]
				);

				$repeater_v3->add_control(
					'description_v3',
					[
						'label' 	=> esc_html__( 'Description', 'cryptlight' ),
						'type' 		=> Controls_Manager::TEXT,
						'default' 	=> esc_html__('Add Your Description', 'cryptlight' ),
					]
				);

				$repeater_v3->add_responsive_control(
					'animation_content_v3',
					[
						'label' => esc_html__( 'Animation Content', 'cryptlight' ),
						'type' 	=> Controls_Manager::ANIMATION,
					]
				);

				$repeater_v3->add_control(
					'animation_duration_content_v3',
					[
						'label' 	=> esc_html__( 'Animation Duration', 'cryptlight' ),
						'type' 		=> Controls_Manager::SELECT,
						'default' 	=> '',
						'options' 	=> [
							'slow' 	=> esc_html__( 'Slow', 'cryptlight' ),
							'' 		=> esc_html__( 'Normal', 'cryptlight' ),
							'fast' 	=> esc_html__( 'Fast', 'cryptlight' ),
						],
						'condition' => [
							'animation_content_v3!' => '',
						],
					]
				);

				$repeater_v3->add_control(
					'animation_delay_content_v3',
					[
						'label' 	=> esc_html__( 'Animation Delay', 'cryptlight' ) . ' (ms)',
						'type' 		=> Controls_Manager::NUMBER,
						'default' 	=> '',
						'min' 		=> 0,
						'step' 		=> 100,
						'condition' => [
							'animation_content_v3!' => '',
						],
					]
				);

			$this->add_control(
				'items_v3',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater_v3->get_controls(),
					'default' 	=> [
						[
							'icon_v3' 			=> esc_html__( 'ovaicomoon-cellphone', 'cryptlight' ),
							'number_v3' 		=> esc_html__( '01.', 'cryptlight' ),
							'title_v3' 			=> esc_html__( 'Mobie payment made easy', 'cryptlight' ),
							'description_v3' 	=> esc_html__( 'You can use a mobile device to pay with simple steps', 'cryptlight' ),
						],
						[
							'icon_v3' 			=> esc_html__( 'ovaicomoon-wallet', 'cryptlight' ),
							'number_v3' 		=> esc_html__( '02.', 'cryptlight' ),
							'title_v3' 			=> esc_html__( 'No transaction free', 'cryptlight' ),
							'description_v3' 	=> esc_html__( 'You can use a mobile device to pay with simple steps', 'cryptlight' ),
						],
						[
							'icon_v3' 			=> esc_html__( 'iconly-Shield-Done icbo', 'cryptlight' ),
							'number_v3' 		=> esc_html__( '03.', 'cryptlight' ),
							'title_v3' 			=> esc_html__( 'Protect the identity', 'cryptlight' ),
							'description_v3' 	=> esc_html__( 'You can use a mobile device to pay with simple steps', 'cryptlight' ),
						],
						[
							'icon_v3' 			=> esc_html__( 'iconly-Filter icbo', 'cryptlight' ),
							'number_v3' 		=> esc_html__( '04.', 'cryptlight' ),
							'title_v3' 			=> esc_html__( 'Security & control over money', 'cryptlight' ),
							'description_v3' 	=> esc_html__( 'You can use a mobile device to pay with simple steps', 'cryptlight' ),
						],
					],
					'title_field' => '{{{ title_v3 }}}',
					'condition' => [
						'type' 	=> 'v3',
					],
				]
			);

			// Version 4
			$repeater_v4 = new \Elementor\Repeater();

				$repeater_v4->add_control(
					'date_v4_from',
					[
						'label' 		=> esc_html__( 'From', 'cryptlight' ),
						'type' 			=> Controls_Manager::DATE_TIME,
						'default'		=> date( 'Y-m-d', current_time('timestamp')),
						'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
					]
				);

				$repeater_v4->add_control(
					'date_v4_to',
					[
						'label' 		=> esc_html__( 'To', 'cryptlight' ),
						'type' 			=> Controls_Manager::DATE_TIME,
						'default'		=> date( 'Y-m-d', current_time('timestamp')),
						'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
					]
				);

				$repeater_v4->add_control(
					'title_v4',
					[
						'label' 		=> esc_html__( 'Title', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXT,
						'default' 		=> esc_html__('67%', 'cryptlight' ),
					]
				);

				$repeater_v4->add_control(
					'text_v4',
					[
						'label' 		=> esc_html__( 'Text', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXT,
						'default' 		=> esc_html__('Discount', 'cryptlight' ),
					]
				);

			$this->add_control(
				'items_v4',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater_v4->get_controls(),
					'default' 	=> [
						[
							'date_v4_from' 	=> esc_html__( '2021-01-16', 'cryptlight' ),
							'date_v4_to' 	=> esc_html__( '2021-02-15', 'cryptlight' ),
							'title_v4' 		=> esc_html__( '67%', 'cryptlight' ),
							'text_v4' 		=> esc_html__( 'Discount', 'cryptlight' ),
						],
						[
							'date_v4_from' 	=> esc_html__( '2021-03-16', 'cryptlight' ),
							'date_v4_to' 	=> esc_html__( '2021-04-15', 'cryptlight' ),
							'title_v4' 		=> esc_html__( '50%', 'cryptlight' ),
							'text_v4' 		=> esc_html__( 'Discount', 'cryptlight' ),
						],
						[
							'date_v4_from' 	=> esc_html__( '2021-05-16', 'cryptlight' ),
							'date_v4_to' 	=> esc_html__( '2021-06-15', 'cryptlight' ),
							'title_v4' 		=> esc_html__( '40%', 'cryptlight' ),
							'text_v4' 		=> esc_html__( 'Discount', 'cryptlight' ),
						],
						[
							'date_v4_from' 	=> esc_html__( '2021-07-16', 'cryptlight' ),
							'date_v4_to' 	=> esc_html__( '2021-09-15', 'cryptlight' ),
							'title_v4' 		=> esc_html__( '20%', 'cryptlight' ),
							'text_v4' 		=> esc_html__( 'Discount', 'cryptlight' ),
						],
						[
							'date_v4_from' 	=> esc_html__( '2021-10-16', 'cryptlight' ),
							'date_v4_to' 	=> esc_html__( '2021-12-15', 'cryptlight' ),
							'title_v4' 		=> esc_html__( '15%', 'cryptlight' ),
							'text_v4' 		=> esc_html__( 'Discount', 'cryptlight' ),
						],
					],
					'condition'	=> [
						'type' => 'v4',
					],
				]
			);

			$this->add_control(
				'seperate_v4',
				[
					'label' 	=> esc_html__( 'Seperate', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( ' - ', 'cryptlight' ),
					'condition' => [
						'type' 	=> 'v4',
					],
				]
			);

			// Version 5
			$repeater_v5 = new \Elementor\Repeater();

				$repeater_v5->add_control(
					'date_v5_from',
					[
						'label' 		=> esc_html__( 'From', 'cryptlight' ),
						'type' 			=> Controls_Manager::DATE_TIME,
						'default'		=> date( 'Y-m-d', current_time('timestamp')),
						'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
					]
				);

				$repeater_v5->add_control(
					'date_v5_to',
					[
						'label' 		=> esc_html__( 'To', 'cryptlight' ),
						'type' 			=> Controls_Manager::DATE_TIME,
						'default'		=> date( 'Y-m-d', current_time('timestamp')),
						'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
					]
				);

				$repeater_v5->add_control(
					'title_v5',
					[
						'label' 		=> esc_html__( 'Title', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXT,
						'default' 		=> esc_html__('67%', 'cryptlight' ),
					]
				);

				$repeater_v5->add_control(
					'text_v5',
					[
						'label' 		=> esc_html__( 'Text', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXT,
						'default' 		=> esc_html__('Discount', 'cryptlight' ),
					]
				);

			$this->add_control(
				'items_v5',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater_v4->get_controls(),
					'default' 	=> [
						[
							'date_v5_from' 	=> esc_html__( '2021-01-16', 'cryptlight' ),
							'date_v5_to' 	=> esc_html__( '2021-02-15', 'cryptlight' ),
							'title_v5' 		=> esc_html__( '67%', 'cryptlight' ),
							'text_v5' 		=> esc_html__( 'Discount', 'cryptlight' ),
						],
						[
							'date_v5_from' 	=> esc_html__( '2021-03-16', 'cryptlight' ),
							'date_v5_to' 	=> esc_html__( '2021-04-15', 'cryptlight' ),
							'title_v5' 		=> esc_html__( '50%', 'cryptlight' ),
							'text_v5' 		=> esc_html__( 'Discount', 'cryptlight' ),
						],
						[
							'date_v5_from' 	=> esc_html__( '2021-05-16', 'cryptlight' ),
							'date_v5_to' 	=> esc_html__( '2021-06-15', 'cryptlight' ),
							'title_v5' 		=> esc_html__( '40%', 'cryptlight' ),
							'text_v5' 		=> esc_html__( 'Discount', 'cryptlight' ),
						],
						[
							'date_v5_from' 	=> esc_html__( '2021-07-16', 'cryptlight' ),
							'date_v5_to' 	=> esc_html__( '2021-09-15', 'cryptlight' ),
							'title_v5' 		=> esc_html__( '20%', 'cryptlight' ),
							'text_v5' 		=> esc_html__( 'Discount', 'cryptlight' ),
						],
						[
							'date_v5_from' 	=> esc_html__( '2021-10-16', 'cryptlight' ),
							'date_v5_to' 	=> esc_html__( '2021-12-15', 'cryptlight' ),
							'title_v5' 		=> esc_html__( '15%', 'cryptlight' ),
							'text_v5' 		=> esc_html__( 'Discount', 'cryptlight' ),
						],
					],
					'condition'	=> [
						'type' => 'v5',
					],
				]
			);

			$this->add_control(
				'seperate_v5',
				[
					'label' 	=> esc_html__( 'Seperate', 'cryptlight' ),
					'type' 		=> Controls_Manager::TEXT,
					'default' 	=> esc_html__( ' - ', 'cryptlight' ),
					'condition' => [
						'type' 	=> 'v5',
					],
				]
			);

			$this->add_responsive_control(
	            'item_v5_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
	                'type' 		=> Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'flex-start' 	=> [
	                        'title' 	=> esc_html__( 'Left', 'cryptlight' ),
	                        'icon' 		=> 'eicon-h-align-left',
	                    ],
	                    'center' 		=> [
	                        'title' 	=> esc_html__( 'Center', 'cryptlight' ),
	                        'icon' 		=> 'eicon-h-align-center',
	                    ],
	                    'flex-end' 		=> [
	                        'title' 	=> esc_html__( 'Right', 'cryptlight' ),
	                        'icon' 		=> 'eicon-h-align-right',
	                    ],
	                    'space-between' => [
	                        'title' 	=> esc_html__( 'Between', 'cryptlight' ),
	                        'icon' 		=> 'eicon-h-align-stretch',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container' => 'justify-content: {{VALUE}}',
	                ],
	                'condition' => [
	                	'type' 	=> 'v5',
	                ]
	            ]
	        );

	        			// Version 1
	        $repeater_v6 = new \Elementor\Repeater();

				$repeater_v6->add_control(
					'date_v6',
					[
						'label' 		=> esc_html__( 'Date', 'cryptlight' ),
						'type' 			=> Controls_Manager::DATE_TIME,
						'default'		=> date( 'Y-m-d h:i', current_time('timestamp')),
						'description' 	=> sprintf( esc_html__( 'Date set according to your timezone: %s.', 'cryptlight' ), Utils::get_timezone_string() ),
					]
				);

				$repeater_v6->add_control(
					'content_v6',
					[
						'label' 		=> esc_html__( 'Content', 'cryptlight' ),
						'type' 			=> Controls_Manager::TEXTAREA,
						'default' 		=> esc_html__('In this time period, our Intelligent and talent founders had a concept of creating our ICO to call for investment', 'cryptlight' ),
					]
				);

				$repeater_v6->add_control(
					'timeline_done_v6',
					[
						'label' 	=> esc_html__( 'Timeline Done', 'cryptlight' ),
						'type' 		=> Controls_Manager::SWITCHER,
						'label_on' 	=> esc_html__( 'Yes', 'cryptlight' ),
						'label_off' => esc_html__( 'No', 'cryptlight' ),
						'default' 	=> 'yes',
					]
				);

				$repeater_v6->add_responsive_control(
					'animation_content_v6',
					[
						'label' => esc_html__( 'Animation Content', 'cryptlight' ),
						'type' 	=> Controls_Manager::ANIMATION,
					]
				);

				$repeater_v6->add_control(
					'animation_duration_content_v6',
					[
						'label' 	=> esc_html__( 'Animation Duration', 'cryptlight' ),
						'type' 		=> Controls_Manager::SELECT,
						'default' 	=> '',
						'options' 	=> [
							'slow' 	=> esc_html__( 'Slow', 'cryptlight' ),
							'' 		=> esc_html__( 'Normal', 'cryptlight' ),
							'fast' 	=> esc_html__( 'Fast', 'cryptlight' ),
						],
						'condition' => [
							'animation_content_v6!' => '',
						],
					]
				);

				$repeater_v6->add_control(
					'animation_delay_content_v6',
					[
						'label' 	=> esc_html__( 'Animation Delay', 'cryptlight' ) . ' (ms)',
						'type' 		=> Controls_Manager::NUMBER,
						'default' 	=> '',
						'min' 		=> 0,
						'step' 		=> 100,
						'condition' => [
							'animation_content_v6!' => '',
						],
					]
				);

			$this->add_control(
				'items_v6',
				[
					'label' 	=> esc_html__( 'Items', 'cryptlight' ),
					'type' 		=> Controls_Manager::REPEATER,
					'fields' 	=> $repeater_v6->get_controls(),
					'default' 	=> [
						[
							'date_v6' 				=> esc_html__( '2021-03-01', 'cryptlight' ),
							'content_v6' 			=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_v6' 		=> 'yes',
						],
						[
							'date_v6' 				=> esc_html__( '2021-05-01', 'cryptlight' ),
							'content_v6' 			=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_v6' 		=> 'yes',
						],
						[
							'date_v6' 				=> esc_html__( '2021-07-01', 'cryptlight' ),
							'content_v6' 			=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_v6' 		=> 'yes',
						],
						[
							'date_v6' 				=> esc_html__( '2021-09-01', 'cryptlight' ),
							'content_v6' 			=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_v6' 		=> 'no',
						],
						[
							'date_v6' 				=> esc_html__( '2021-11-01', 'cryptlight' ),
							'content_v6' 			=> esc_html__('Concept Generation,Team Assemble', 'cryptlight' ),
							'timeline_done_v6' 		=> 'no',
						],
					],
					'condition'	=> [
						'type' => 'v6',
					],
				]
			);

		$this->end_controls_section();
		/* End section road map */

		/* Begin section date style */
		$this->start_controls_section(
			'date_style',
			[
				'label' 	=> esc_html__( 'Date', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> ['v1', 'v2'],
				],
			]
		);

			$this->add_control(
				'date_color',
				[
					'label' 	=> esc_html__( 'Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left .timeline-info .content-info .date' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right .timeline-info .content-info .date' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-date .date' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'date_color_not_done',
				[
					'label' 	=> esc_html__( 'Color Not Done', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left.timeline-not-done .timeline-info .content-info .date' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right.timeline-not-done .timeline-info .content-info .date' => 'color: {{VALUE}};',
					],
					'condition' => [
						'type' => 'v1',
					],
				]
			);

			$this->add_control(
				'border_color',
				[
					'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row:nth-of-type(odd):before' 	=> 'border-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row:nth-of-type(odd):after' 	=> 'border-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row:nth-of-type(even):before' => 'border-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row:nth-of-type(even):after' 	=> 'border-color: {{VALUE}};',
					],
					'condition' => [
						'type!' => 'v1',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'date_typography_v1',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left .timeline-info .content-info .date',
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'date_typography_v2',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-date .date',
					'condition' => [
	                    'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_control(
				'line_color',
				[
					'label' 	=> esc_html__( 'Line Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-date .date' => 'border-color: {{VALUE}};',
					],
					'condition' => [
	                    'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_control(
				'line_color_not_done',
				[
					'label' 	=> esc_html__( 'Line Color Not Done', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item.timeline-not-done .timeline-date .date' => 'border-color: {{VALUE}};',
					],
					'condition' => [
	                    'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_responsive_control(
				'line_width',
				[
					'label' 	=> esc_html__( 'Line Width', 'cryptlight' ),
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
							'max' => 2000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ '%', 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-date .date .date-before' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
	                    'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_responsive_control(
				'line_height',
				[
					'label' 	=> esc_html__( 'Line Height', 'cryptlight' ),
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
							'max' => 2000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' 	=> [ '%', 'px' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-date .date .date-before' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
	                    'type' 	=> 'v2',
	                ],
				]
			);

		$this->end_controls_section();
		/* End section date style */

		/* Begin section icon style */
		$this->start_controls_section(
			'icon_style',
			[
				'label' 	=> esc_html__( 'Icon', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> ['v1', 'v2'],
				],
			]
		);

			$this->add_control(
				'icon_color',
				[
					'label' 	=> esc_html__( 'Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left .timeline-info:after' 	=> 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right .timeline-info:after' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-date .date:after' 	=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_bg',
				[
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left .timeline-info:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right .timeline-info:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-date .date:before' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_not_done_bg',
				[
					'label' 	=> esc_html__( 'Background Not Done', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-not-done .timeline-info:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item.timeline-not-done .timeline-date .date:before' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'icon_not_done_bg_in',
				[
					'label' 	=> esc_html__( 'Background Not Done In', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left.timeline-not-done .timeline-info:after' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right.timeline-not-done .timeline-info:after' => 'background-color: {{VALUE}};',
					],
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'icon_not_done_border_v1',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-not-done .timeline-info:before',
	                'separator' => 'before',
	                'condition' => [
	                	'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'icon_not_done_border_v2_berfore',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item.timeline-not-done .timeline-date .date:before',
	                'separator' => 'before',
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );

	        $this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'icon_not_done_border_v2_after',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item.timeline-not-done .timeline-date .date:after',
	                'separator' => 'before',
	                'condition' => [
	                	'type' 	=> 'v2',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section icon style */

		/* Begin section icon version 3 style */
		$this->start_controls_section(
			'icon_v3_style',
			[
				'label' 	=> esc_html__( 'Icon', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> ['v3'],
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'icon_v3_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon .icon i, {{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon .icon i',
				]
			);

			$this->start_controls_tabs( 'tabs_icon_style' );

				$this->start_controls_tab(
		            'tab_icon_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'icon_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon .icon i' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon .icon i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'icon_bg_gradient_normal',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon .icon, {{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon .icon',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_icon_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'icon_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon .icon:hover i' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon .icon:hover i' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'icon_bg_gradient_hover',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'classic', 'gradient' ],
							'exclude' 	=> [ 'image' ],
							'selector' 	=> '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon .icon:hover, {{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon .icon:hover',
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'icon_v3_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon .icon, {{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon .icon',
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'icon_v3_border',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon .icon, {{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon .icon',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'icon_v3_border_color_hover',
	            [
	                'label' 	=> esc_html__( 'Border Color Hover', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon .icon:hover' => 'border-color: {{VALUE}}',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon .icon:hover' => 'border-color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_control(
	            'icon_v3_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'icon_v3_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon .icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon .icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'icon_v3_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_control(
				'line_options',
				[
					'label' 	=> esc_html__( 'Line Options', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'line_v3_border',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-icon:before, {{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-icon:before',
	                'separator' => 'before',
	            ]
	        );

		$this->end_controls_section();
		/* End section icon version 3 style */

		/* Begin section content style */
		$this->start_controls_section(
			'content_style',
			[
				'label' 	=> esc_html__( 'Content', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> ['v1', 'v2'],
				],
			]
		);

			$this->add_responsive_control(
	            'content_alignment_v2',
	            [
	                'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
	                'type' 		=> Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'left' 	=> [
	                        'title' => esc_html__( 'Left', 'cryptlight' ),
	                        'icon' 	=> 'eicon-text-align-left',
	                    ],
	                    'center' 	=> [
	                        'title' => esc_html__( 'Center', 'cryptlight' ),
	                        'icon' 	=> 'eicon-text-align-center',
	                    ],
	                    'right' 	=> [
	                        'title' => esc_html__( 'Right', 'cryptlight' ),
	                        'icon' 	=> 'eicon-text-align-right',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-info' => 'text-align: {{VALUE}}',
	                ],
	                'condition' => [
					'type' 	=> 'v2',
				],
	            ]
	        );

			$this->add_control(
				'content_color',
				[
					'label' 	=> esc_html__( 'Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left .timeline-info .timeline-content .content' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right .timeline-info .timeline-content .content' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-info .timeline-content li' 	=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'content_color_not_done',
				[
					'label' 	=> esc_html__( 'Color Not Done', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left.timeline-not-done .timeline-info .content-info .timeline-content .content' => 'color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right.timeline-not-done .timeline-info .content-info .timeline-content .content' => 'color: {{VALUE}};',
					],
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_control(
				'content_line_color',
				[
					'label' 	=> esc_html__( 'Line Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left:before' 	=> 'border-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right:before' 	=> 'border-color: {{VALUE}};',
					],
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_control(
				'content_line_color_not_done',
				[
					'label' 	=> esc_html__( 'Line Color Not Done', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left.timeline-not-done:before' 	=> 'border-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right.timeline-not-done:before' => 'border-color: {{VALUE}};',
					],
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'content_typography_v1',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left .timeline-info .timeline-content .content',
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'content_typography_v2',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-info .timeline-content li',
					'condition' => [
	                    'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_control(
				'content_bg',
				[
					'label' 	=> esc_html__( 'Background', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left .timeline-info .content-info' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right .timeline-info .content-info' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-info' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'content_bg_not_done',
				[
					'label' 	=> esc_html__( 'Background Not Done', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left.timeline-not-done .timeline-info .content-info' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right.timeline-not-done .timeline-info .content-info' => 'background-color: {{VALUE}};',
					],
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_control(
				'content_border_left_option',
				[
					'label' 	=> esc_html__( 'Border Right Option', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'content_border_left',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left .timeline-info .content-info',
	                'separator' => 'before',
	                'condition' => [
	                    'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_control(
				'content_left_color_not_done',
				[
					'label' 	=> esc_html__( 'Color Right Not Done', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left.timeline-not-done .timeline-info .content-info' => 'border-color: {{VALUE}};',
					],
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

	        $this->add_control(
	            'content_border_radius_left',
	            [
	                'label' 		=> esc_html__( 'Border Right Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left .timeline-info .content-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                    'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_control(
				'content_border_right_option',
				[
					'label' 	=> esc_html__( 'Border Left Option', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'content_border_right',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right .timeline-info .content-info',
	                'separator' => 'before',
	                'condition' => [
	                    'type' 	=> 'v1',
	                ],
	            ]
	        );

	        $this->add_control(
				'content_right_color_not_done',
				[
					'label' 	=> esc_html__( 'Color Left Not Done', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right.timeline-not-done .timeline-info .content-info' => 'border-color: {{VALUE}};',
					],
					'condition' => [
	                    'type' 	=> 'v1',
	                ],
				]
			);

	        $this->add_control(
	            'content_border_radius_right',
	            [
	                'label' 		=> esc_html__( 'Border Left Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right .timeline-info .content-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                    'type' 	=> 'v1',
	                ],
	            ]
	        );

			$this->add_control(
				'title_color',
				[
					'label' 	=> esc_html__( 'Title Color', 'cryptlight' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-info .timeline-title' => 'color: {{VALUE}};',
					],
					'condition' => [
	                	'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography_v2',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-info .timeline-title',
					'condition' => [
	                    'type' 	=> 'v2',
	                ],
				]
			);

			$this->add_responsive_control(
	            'title_margin',
	            [
	                'label' 		=> esc_html__( 'Title Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-info .timeline-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                    'type' 	=> 'v2',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'content_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition' => [
	                    'type' 	=> 'v2',
	                ],
	            ]
	        );

			$this->add_responsive_control(
	            'content_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left .timeline-info .content-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right .timeline-info .content-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'content_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-left .timeline-info .content-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v1 .road-map-wrapper .timeline-column .timeline-item-right .timeline-info .content-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
				'item_spacing',
				[
					'label' 	=> esc_html__( 'Space Between Item', 'cryptlight' ),
					'type' 		=> Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-road-map-v2 .road-map-wrapper .timeline-row .timeline-items .item .timeline-item .timeline-info .timeline-content li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
	                    'type' 	=> 'v2',
	                ],
				]
			);

		$this->end_controls_section();
		/* End section content style */

		/* Begin section item version 3 style */
		$this->start_controls_section(
			'items_v3_style',
			[
				'label' 	=> esc_html__( 'Items', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v3',
				],
			]
		);

			$this->start_controls_tabs( 'tabs_items_style' );
				
				$this->start_controls_tab(
		            'tab_items_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'items_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item' => 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_items_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'items_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item:hover' => 'background-color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'items_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'items_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'items_border',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item, {{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'items_border_color_hover',
	            [
	                'label' 	=> esc_html__( 'Border Color Hover', 'cryptlight' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item:hover' => 'border-color: {{VALUE}}',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item:hover' => 'border-color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_control(
	            'items_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'items_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
	                'type' 		=> Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'left' 	=> [
	                        'title' => esc_html__( 'Left', 'cryptlight' ),
	                        'icon' 	=> 'eicon-text-align-left',
	                    ],
	                    'center' 	=> [
	                        'title' => esc_html__( 'Center', 'cryptlight' ),
	                        'icon' 	=> 'eicon-text-align-center',
	                    ],
	                    'right' 	=> [
	                        'title' => esc_html__( 'Right', 'cryptlight' ),
	                        'icon' 	=> 'eicon-text-align-right',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item' => 'text-align: {{VALUE}}',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section item version 3 style */

		/* Begin section number version 3 style */
		$this->start_controls_section(
			'number_v3_style',
			[
				'label' 	=> esc_html__( 'Number', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v3',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'number_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item .number span, {{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item .number span',
				]
			);

			$this->start_controls_tabs( 'tabs_number_style' );
				
				$this->start_controls_tab(
		            'tab_number_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'number_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item .number span' => 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item .number span' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_number_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'number_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item:hover .number span' => 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item:hover .number span' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'number_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item .number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item .number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section number version 3 style */

		/* Begin section title version 3 style */
		$this->start_controls_section(
			'title_v3_style',
			[
				'label' 	=> esc_html__( 'Title', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v3',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_v3_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item .title, {{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item .title',
				]
			);

			$this->start_controls_tabs( 'tabs_title_v3_style' );
				
				$this->start_controls_tab(
		            'tab_title_v3_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'title_v3_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item .title' => 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item .title' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_title_v3_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'title_v3_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item:hover .title' => 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item:hover .title' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'title_v3_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section title version 3 style */

		/* Begin section description version 3 style */
		$this->start_controls_section(
			'description_v3_style',
			[
				'label' 	=> esc_html__( 'Description', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v3',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'description_v3_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item .description, {{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item .description',
				]
			);

			$this->start_controls_tabs( 'tabs_description_v3_style' );
				
				$this->start_controls_tab(
		            'tab_description_v3_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'description_v3_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item .description' => 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item .description' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_description_v3_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'description_v3_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item:hover .description' => 'color: {{VALUE}};',
			                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item:hover .description' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_responsive_control(
	            'description_v3_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.desktop .road-map-content .road-map-item .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                    '{{WRAPPER}} .ova-road-map-v3 .road-map-wrapper .road-map-container.mobile .road-map-content .road-map-item .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section description version 3 style */

		/* Begin section items version 4 style */
		$this->start_controls_section(
			'items_v4_style',
			[
				'label' 	=> esc_html__( 'Items', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v4',
				],
			]
		);

			$this->add_control(
				'item_v4_before_desktop',
				[
					'label' 	=> esc_html__( 'Item Before Desktop', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_group_control(
		            Group_Control_Border::get_type(), [
		                'name' 		=> 'item_v4_border',
		                'selector' 	=> '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container:before',
		                'separator' => 'before',
		            ]
		        );

				$this->add_responsive_control(
					'itme_v4_before_left',
					[
						'label' 		=> esc_html__( 'Left', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
						'default' 	=> [
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container:before' => 'left: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'item_v4_before_top',
					[
						'label' 		=> esc_html__( 'Top', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
						'default' 	=> [
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container:before' => 'top: {{SIZE}}{{UNIT}};',
						],
					]
				);

			$this->add_control(
				'item_v4_before_mobile',
				[
					'label' 	=> esc_html__( 'Item Before Mobile', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_control(
		            'item_v4_before_background_mobile',
		            [
		                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
		                'type' 		=> Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:before' => 'background-color: {{VALUE}};',
		                ],
		            ]
		        );

		        $this->add_group_control(
		            Group_Control_Border::get_type(), [
		                'name' 		=> 'item_v4_before_border_mobile',
		                'selector' 	=> '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:before',
		                'separator' => 'before',
		            ]
		        );

		        $this->add_control(
		            'item_v4_before_border_radius_mobile',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
		                'type' 			=> Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

				$this->add_responsive_control(
					'item_v4_before_width_mobile',
					[
						'label' 		=> esc_html__( 'Width', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
						'default' 	=> [
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:before' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'item_v4_before_height_mobile',
					[
						'label' 		=> esc_html__( 'Height', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
						'default' 	=> [
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:before' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'item_v4_before_left_mobile',
					[
						'label' 		=> esc_html__( 'Left', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
						'default' 	=> [
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:before' => 'left: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'item_v4_before_bottom_mobile',
					[
						'label' 		=> esc_html__( 'Bottom', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
						'default' 	=> [
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:before' => 'bottom: {{SIZE}}{{UNIT}};',
						],
					]
				);

		$this->end_controls_section();
		/* End section items version 4 style */

		/* Begin section date version 4 style */
		$this->start_controls_section(
			'date_v4_style',
			[
				'label' 	=> esc_html__( 'Date', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v4',
				],
			]
		);

			$this->start_controls_tabs( 'tabs_date_v4_style' );
				
				$this->start_controls_tab(
		            'tab_date_v4_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'date_v4_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date span' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        	$this->add_control(
			            'date_v4_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_date_v4_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'date_v4_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:hover .date span' => 'color: {{VALUE}};',
			                ],
			            ]
			        );

		        	$this->add_control(
			            'date_v4_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:hover .date' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'date_v4_border',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'date_v4_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'date_v4_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'date_v4_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'date_v4_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date',
				]
			);

			$this->add_control(
				'date_v4_before',
				[
					'label' 	=> esc_html__( 'Before Options', 'cryptlight' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

				$this->add_control(
		            'date_v4_before_background',
		            [
		                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
		                'type' 		=> Controls_Manager::COLOR,
		                'selectors' => [
		                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date:before' => 'background-color: {{VALUE}};',
		                ],
		            ]
		        );

		        $this->add_group_control(
		            Group_Control_Border::get_type(), [
		                'name' 		=> 'date_v4_before_border',
		                'selector' 	=> '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date:before',
		                'separator' => 'before',
		            ]
		        );

		        $this->add_control(
		            'date_v4_before_border_radius',
		            [
		                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
		                'type' 			=> Controls_Manager::DIMENSIONS,
		                'size_units' 	=> [ 'px', '%' ],
		                'selectors' 	=> [
		                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

				$this->add_responsive_control(
					'date_v4_before_width',
					[
						'label' 		=> esc_html__( 'Width', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
						'default' 	=> [
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date:before' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'date_v4_before_height',
					[
						'label' 		=> esc_html__( 'Height', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
						'default' 	=> [
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date:before' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'date_v4_before_left',
					[
						'label' 		=> esc_html__( 'Left', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
						'default' 	=> [
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date:before' => 'left: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'date_v4_before_bottom',
					[
						'label' 		=> esc_html__( 'Bottom', 'cryptlight' ),
						'type' 			=> Controls_Manager::SLIDER,
						'size_units' 	=> [ '%', 'px' ],
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
						'default' 	=> [
							'unit' 	=> '%',
						],
						'tablet_default' => [
							'unit' => '%',
						],
						'mobile_default' => [
							'unit' => '%',
						],
						'selectors' => [
							'{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .date:before' => 'bottom: {{SIZE}}{{UNIT}};',
						],
					]
				);

		$this->end_controls_section();
		/* End section date version 4 style */

		/* Begin section title version 4 style */
		$this->start_controls_section(
			'title_v4_style',
			[
				'label' 	=> esc_html__( 'Title', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v4',
				],
			]
		);

			$this->add_control(
				'title_v4_linear_gradient',
				[
					'label' 		=> esc_html__( 'Linear Gradient', 'cryptlight' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on' 		=> esc_html__( 'Show', 'cryptlight' ),
					'label_off' 	=> esc_html__( 'Hide', 'cryptlight' ),
					'default' 		=> 'no',
					'description' 	=> esc_html__( 'Title background linear Gradient', 'cryptlight' ),
				]
			);

			$this->start_controls_tabs( 'tabs_title_v4_style' );

				$this->start_controls_tab(
		            'tab_title_v4_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'title_v4_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .content .title' => 'color: {{VALUE}}',
			                ],
			                'condition' => [
								'title_v4_linear_gradient!' => 'yes',
							],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'title_v4_linear_gradient_normal',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .content .title.ova-text-linear-gradient',
							'condition' => [
								'title_v4_linear_gradient' => 'yes',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_title_v4_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'title_v4_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:hover .content .title' => 'color: {{VALUE}}',
			                ],
			                'condition' => [
								'title_v4_linear_gradient!' => 'yes',
							],
			            ]
			        );

			        $this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' 		=> 'title_v4_linear_gradient_hover',
							'label' 	=> esc_html__( 'Background Gradient', 'cryptlight' ),
							'types' 	=> [ 'gradient' ],
							'selector' 	=> '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:hover .content .title.ova-text-linear-gradient',
							'condition' => [
								'title_v4_linear_gradient' => 'yes',
							],
						]
					);

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_v4_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .content .title',
				]
			);

	        $this->add_responsive_control(
	            'title_v4_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section title version 4 style */

		/* Begin section text version 4 style */
		$this->start_controls_section(
			'text_v4_style',
			[
				'label' 	=> esc_html__( 'Text', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v4',
				],
			]
		);

			$this->start_controls_tabs( 'tabs_text_v4_style' );

				$this->start_controls_tab(
		            'tab_text_v4_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'text_v4_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .content .text' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_text_v4_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'text_v4_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item:hover .content .text' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'text_v4_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .content .text',
				]
			);

	        $this->add_responsive_control(
	            'text_v4_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v4 .road-map-wrapper .road-map-container .item .content .text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section text version 4 style */

		/* Begin section content version 5 style */
		$this->start_controls_section(
			'content_v5_style',
			[
				'label' 	=> esc_html__( 'Content', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v5',
				],
			]
		);

			$this->add_responsive_control(
	            'content_v5_alignment',
	            [
	                'label' 	=> esc_html__( 'Alignment', 'cryptlight' ),
	                'type' 		=> Controls_Manager::CHOOSE,
	                'options' 	=> [
	                    'left' 	=> [
	                        'title' => esc_html__( 'Left', 'cryptlight' ),
	                        'icon' 	=> 'eicon-h-align-left',
	                    ],
	                    'center' 	=> [
	                        'title' => esc_html__( 'Center', 'cryptlight' ),
	                        'icon' 	=> 'eicon-h-align-center',
	                    ],
	                    'right' 	=> [
	                        'title' => esc_html__( 'Right', 'cryptlight' ),
	                        'icon' 	=> 'eicon-h-align-right',
	                    ],
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item' => 'text-align: {{VALUE}}',
	                ],
	            ]
	        );

			$this->start_controls_tabs( 'tabs_content_v5_style' );
				
				$this->start_controls_tab(
		            'tab_content_v5_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'content_v5_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_content_v5_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

		        	$this->add_control(
			            'content_v5_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item:hover' => 'background-color: {{VALUE}};',
			                ],
			            ]
			        );

			        $this->add_control(
			            'content_v5_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item:hover' => 'border-color: {{VALUE}};',
			                ],
			            ]
			        );

		        $this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'content_v5_border',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'content_v5_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'content_v5_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'content_v5_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'content_v5_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item',
				]
			);

		$this->end_controls_section();
		/* End section content version 5 style */

		/* Begin section title version 5 style */
		$this->start_controls_section(
			'title_v5_style',
			[
				'label' 	=> esc_html__( 'Title', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v5',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_v5_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item .content .title',
				]
			);

			$this->start_controls_tabs( 'tabs_title_v5_style' );

				$this->start_controls_tab(
		            'tab_title_v5_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'title_v5_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item .content .title' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_title_v5_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'title_v5_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item:hover .content .title' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'title_v5_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section title version 5 style */

		/* Begin section text version 5 style */
		$this->start_controls_section(
			'text_v5_style',
			[
				'label' 	=> esc_html__( 'Text', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v5',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'text_v5_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item .content .text',
				]
			);

			$this->start_controls_tabs( 'tabs_text_v5_style' );

				$this->start_controls_tab(
		            'tab_text_v5_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'text_v5_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item .content .text' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_text_v5_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'text_v5_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item:hover .content .text' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'text_v5_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item .content .text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section text version 5 style */

		/* Begin section date version 5 style */
		$this->start_controls_section(
			'date_v5_style',
			[
				'label' 	=> esc_html__( 'Date', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v5',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'date_v5_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item .date span',
				]
			);

			$this->start_controls_tabs( 'tabs_date_v5_style' );

				$this->start_controls_tab(
		            'tab_date_v5_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'date_v5_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item .date span' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_date_v5_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'date_v5_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item:hover .date span' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'date_v5_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v5 .road-map-wrapper .road-map-container .item .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section date version 5 style */

		/* Begin section date version 6 style */
		$this->start_controls_section(
			'date_v6_style',
			[
				'label' 	=> esc_html__( 'Date', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v6',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'date_v6_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .date, {{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .content-wrapper .date',
				]
			);

			$this->start_controls_tabs( 'tabs_date_v6_style' );

				$this->start_controls_tab(
		            'tab_date_v6_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'date_v6_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .date' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .content-wrapper .date' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_date_v6_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'date_v6_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item:hover .date' => 'color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper:hover .content-wrapper .date' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

		$this->end_controls_section();
		/* End section date version 6 style */

		/* Begin section date version 6 style */
		$this->start_controls_section(
			'dot_v6_style',
			[
				'label' 	=> esc_html__( 'Dot', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v6',
				],
			]
		);

			$this->start_controls_tabs( 'tabs_dot_v6_style' );

				$this->start_controls_tab(
		            'tab_dot_v6_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'dot_v6_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .timeline .border-dot .dot' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .timeline .border-dot .dot' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'dot_v6_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .timeline .border-dot' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .timeline .border-dot' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'dot_v6_border_color_normal',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .timeline .border-dot' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .timeline .border-dot' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_dot_v6_active',
		            [
		                'label' => esc_html__( 'Active', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'dot_v6_color_active',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item.done .timeline .border-dot .dot' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item.done .item-wrapper .timeline .border-dot .dot' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'dot_v6_background_active',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item.done .timeline .border-dot' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item.done .item-wrapper .timeline .border-dot' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'dot_v6_border_color_active',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item.done .timeline .border-dot' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item.done .item-wrapper .timeline .border-dot' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

			    $this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_dot_v6_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'dot_v6_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item:hover .timeline .border-dot .dot' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper:hover .timeline .border-dot .dot' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'dot_v6_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item:hover .timeline .border-dot' => 'background-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper:hover .timeline .border-dot' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'dot_v6_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item:hover .timeline .border-dot' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper:hover .timeline .border-dot' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

		$this->end_controls_section();
		/* End section dot version 6 style */

		/* Begin section line version 6 style */
		$this->start_controls_section(
			'line_v6_style',
			[
				'label' 	=> esc_html__( 'Line', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v6',
				],
			]
		);

			$this->start_controls_tabs( 'tabs_line_v6_style' );

				$this->start_controls_tab(
		            'tab_line_v6_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'line_v6_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .timeline:before' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .timeline .border-dot:before' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item.item-left .item-wrapper:before' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item.item-right .item-wrapper:before' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_line_v6_active',
		            [
		                'label' => esc_html__( 'Active', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'line_v6_color_active',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item.done .timeline:before' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item.item-left.done .item-wrapper:before' => 'border-color: {{VALUE}}',
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item.item-right.done .item-wrapper:before' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

			    $this->end_controls_tab();
			$this->end_controls_tabs();

		$this->end_controls_section();
		/* End section line version 6 style */

		/* Begin section content version 6 style */
		$this->start_controls_section(
			'content_v6_style',
			[
				'label' 	=> esc_html__( 'Content Desktop', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v6',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'content_v6_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .content-wrapper .content .content-item',
				]
			);

			$this->start_controls_tabs( 'tabs_content_v6_desktop_style' );

				$this->start_controls_tab(
		            'tab_content_v6_desktop_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'content_v6_desktop_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .content-wrapper .content .content-item' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'content_v6_desktop_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .content-wrapper .content' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_content_v6_desktop_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'content_v6_desktop_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item:hover .content-wrapper .content .content-item' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'content_v6_desktop_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item:hover .content-wrapper .content' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'content_v6_desktop_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item:hover .content-wrapper .content' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'content_v6_desktop_border',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .content-wrapper .content',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'content_v6_desktop_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .content-wrapper .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'content_v6_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .content-wrapper .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'content_v6_desktop_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.desktop .item .content-wrapper .content',
				]
			);

		$this->end_controls_section();
		/* End section content version 6 style */

		/* Begin section content version 6 style */
		$this->start_controls_section(
			'content_v6_mobile_style',
			[
				'label' 	=> esc_html__( 'Content Mobile', 'cryptlight' ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'type' 	=> 'v6',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'content_v6_mobile_typography',
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .content-wrapper .content .content-item',
				]
			);

			$this->start_controls_tabs( 'tabs_content_v6_mobile_style' );

				$this->start_controls_tab(
		            'tab_content_v6_mobile_normal',
		            [
		                'label' => esc_html__( 'Normal', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'content_v6_mobile_color_normal',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .content-wrapper .content .content-item' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'content_v6_mobile_background_normal',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .content-wrapper' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
		            'tab_content_v6_mobile_hover',
		            [
		                'label' => esc_html__( 'Hover', 'cryptlight' ),
		            ]
		        );

					$this->add_control(
			            'content_v6_mobile_color_hover',
			            [
			                'label' 	=> esc_html__( 'Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper:hover .content-wrapper .content .content-item' => 'color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'content_v6_mobile_background_hover',
			            [
			                'label' 	=> esc_html__( 'Background', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper:hover .content-wrapper' => 'background-color: {{VALUE}}',
			                ],
			            ]
			        );

			        $this->add_control(
			            'content_v6_mobile_border_color_hover',
			            [
			                'label' 	=> esc_html__( 'Border Color', 'cryptlight' ),
			                'type' 		=> Controls_Manager::COLOR,
			                'selectors' => [
			                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper:hover .content-wrapper' => 'border-color: {{VALUE}}',
			                ],
			            ]
			        );

				$this->end_controls_tab();
			$this->end_controls_tabs();

	        $this->add_responsive_control(
	            'content_v6_mobile_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'content_v6_mobile_box_shadow',
					'label' 	=> esc_html__( 'Box Shadow', 'cryptlight' ),
					'selector' 	=> '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .content-wrapper',
				]
			);


			$this->add_group_control(
	            Group_Control_Border::get_type(), [
	                'name' 		=> 'content_v6_mobile_border',
	                'selector' 	=> '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .content-wrapper',
	                'separator' => 'before',
	            ]
	        );

	        $this->add_control(
	            'content_v6_mobile_border_radius',
	            [
	                'label' 		=> esc_html__( 'Border Radius', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'content_v6_mobile_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'cryptlight' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-road-map-v6 .road-map-wrapper .road-map-container.mobile .item .item-wrapper .content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* End section content version 6 style */
	}

	// Render Template Here
	protected function render() {

		$settings 	= $this->get_settings();

		$type 		= $settings['type'];

		// version 1
		$road_map 	= $settings['road_map_items'];

		// version 2
		$show_item_1 	= $settings['show_item_1'];
		$road_map_1 	= $settings['road_map_items_1'];

		$show_item_2 	= $settings['show_item_2'];
		$road_map_2 	= $settings['road_map_items_2'];

		$show_item_3 	= $settings['show_item_3'];
		$road_map_3 	= $settings['road_map_items_3'];

		// Version 3
		$items_v3 		= $settings['items_v3'];

		// Version 4
		$items_v4 		= $settings['items_v4'];
		$seperate_v4 	= $settings['seperate_v4'] ? $settings['seperate_v4'] : ' - ';
		$class_v4_lg	= '';
		$title_v4_lg 	= $settings['title_v4_linear_gradient'];
		if ( 'yes' == $title_v4_lg ) {
			$class_v4_lg = ' ova-text-linear-gradient';
		}

		// Version 5
		$items_v5 		= $settings['items_v5'];
		$seperate_v5 	= $settings['seperate_v5'] ? $settings['seperate_v5'] : ' - ';

		// Version 6
		$items_v6 		= $settings['items_v6'];
	
		?>

		<div class="ova-road-map-<?php echo esc_html( $type ); ?>">
			<div class="road-map-wrapper">
				<?php if ( 'v1' == $type ): ?>
					<?php if ( ! empty( $road_map ) ): ?>
					<div class="timeline-column">
						<?php foreach ( $road_map as $k => $items ): 
							$time_stamp 	= strtotime( $items['date'] );
							$month 			= date_i18n('F', $time_stamp);
							$year 			= date_i18n('Y', $time_stamp);
							$content 		= $items['content'];
							$timeline_done 	= $items['timeline_done'];
							$timeline_check = 'timeline-not-done';
							if ( 'yes' == $timeline_done ) {
								$timeline_check = '';
							}

							//Animation Content
							$animation_content 	= $items['animation_content'];
							$duration_content 	= $items['animation_duration_content'];
							$delay_content		= $items['animation_delay_content'];

							$data_animation_content = array(
								'animation' => $animation_content,
								'duration' 	=> $duration_content,
								'delay' 	=> $delay_content,
							);
						?>
							<?php if ( $k % 2 == 0 ): ?>
								<div class="timeline-item-left <?php echo esc_html( $timeline_check ); ?>">
									<div class="timeline-info">
										<div 
											class="content-info<?php if ( $animation_content ) echo ' ova-invisible'; ?>" 
											data-animation='<?php echo json_encode( $data_animation_content ); ?>'>

											<div class="date"><?php echo esc_html( $month . ' ' . $year ); ?></div>
											<div class="timeline-content">
												<p class="content"><?php echo esc_html( $content ); ?></p>
											</div>
										</div>
									</div>
								</div>
							<?php else: ?>
								<div class="timeline-item-right <?php echo esc_html( $timeline_check ); ?>">
									<div class="timeline-info">
										<div 
											class="content-info<?php if ( $animation_content ) echo ' ova-invisible'; ?>" 
											data-animation='<?php echo json_encode( $data_animation_content ); ?>'>

											<div class="date"><?php echo esc_html( $month . ' ' . $year ); ?></div>
											<div class="timeline-content">
												<p class="content"><?php echo esc_html( $content ); ?></p>
											</div>
										</div>
									</div>
								</div>
					<?php  endif; endforeach; endif; ?>
					</div>
				<?php elseif ( 'v2' == $type ): ?>
					<?php if ( ! empty( $road_map_1 ) && 'yes' == $show_item_1 ): ?>
						<div class="timeline-row">
							<div class="timeline-items">
								<?php foreach ( $road_map_1 as $items ):
									$time_stamp 	= strtotime( $items['date_1'] );
									$month 			= date_i18n('M', $time_stamp);
									$year 			= date_i18n('Y', $time_stamp);
									$title 			= $items['title_1'];
									$content 		= $items['content_1'];
									$content_args 	= array();
									if ( $content ) {
										$content_args = explode(",", $content);
									}
									$timeline_done 	= $items['timeline_done_1'];
									$timeline_check = 'timeline-not-done';
									if ( 'yes' == $timeline_done ) {
										$timeline_check = '';
									}

									// Animation Date
									$animation_date = $items['animation_date_1'];
									$duration_date 	= $items['animation_duration_date_1'];
									$delay_date		= $items['animation_delay_date_1'];

									$data_animation_date = array(
										'animation' => $animation_date,
										'duration' 	=> $duration_date,
										'delay' 	=> $delay_date,
									);

									//Animation Content
									$animation_content 	= $items['animation_content_1'];
									$duration_content 	= $items['animation_duration_content_1'];
									$delay_content		= $items['animation_delay_content_1'];

									$data_animation_content = array(
										'animation' => $animation_content,
										'duration' 	=> $duration_content,
										'delay' 	=> $delay_content,
									);
								?>
								<div class="item">
									<div class="timeline-item <?php echo esc_html( $timeline_check ); ?>">
										<div 
											class="timeline-date <?php if ( $animation_date ) echo 'ova-invisible'; ?>" 
											data-animation='<?php echo json_encode( $data_animation_date ); ?>'>
											<span class="date"><?php echo esc_html( $month . ' ' . $year ); ?></span>
										</div>
										<div 
											class="timeline-info <?php if ( $animation_content ) echo 'ova-invisible'; ?>" 
											data-animation='<?php echo json_encode( $data_animation_content ); ?>'>
											<h3 class="timeline-title"><?php echo esc_html( $title ); ?></h3>
											<ul class="timeline-content">
												<?php if ( $content_args ): ?>
													<?php foreach ( $content_args as $value ): ?>
														<li><?php echo esc_html( trim( $value ) ); ?></li>
												<?php endforeach; endif; ?>
											</ul>
										</div>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div><!-- timeline-row -->
					<?php endif; ?>

					<?php if ( ! empty( $road_map_2 ) && 'yes' == $show_item_2 ): ?>
						<div class="timeline-row">
							<div class="timeline-items">
								<?php foreach ( $road_map_2 as $items ):
									$time_stamp 	= strtotime( $items['date_2'] );
									$month 			= date_i18n('M', $time_stamp);
									$year 			= date_i18n('Y', $time_stamp);
									$title 			= $items['title_2'];
									$content 		= $items['content_2'];
									$content_args 	= array();
									if ( $content ) {
										$content_args = explode(",", $content);
									}
									$timeline_done 	= $items['timeline_done_2'];
									$timeline_check = 'timeline-not-done';
									if ( 'yes' == $timeline_done ) {
										$timeline_check = '';
									}

									// Animation Date
									$animation_date = $items['animation_date_2'];
									$duration_date 	= $items['animation_duration_date_2'];
									$delay_date		= $items['animation_delay_date_2'];

									$data_animation_date = array(
										'animation' => $animation_date,
										'duration' 	=> $duration_date,
										'delay' 	=> $delay_date,
									);

									//Animation Content
									$animation_content 	= $items['animation_content_2'];
									$duration_content 	= $items['animation_duration_content_2'];
									$delay_content		= $items['animation_delay_content_2'];

									$data_animation_content = array(
										'animation' => $animation_content,
										'duration' 	=> $duration_content,
										'delay' 	=> $delay_content,
									);
								?>
								<div class="item">
									<div class="timeline-item <?php echo esc_html( $timeline_check ); ?>">
										<div 
											class="timeline-date <?php if ( $animation_date ) echo 'ova-invisible'; ?>" 
											data-animation='<?php echo json_encode( $data_animation_date ); ?>'>
											<span class="date"><?php echo esc_html( $month . ' ' . $year ); ?></span>
										</div>
										<div 
											class="timeline-info <?php if ( $animation_content ) echo 'ova-invisible'; ?>" 
											data-animation='<?php echo json_encode( $data_animation_content ); ?>'>
											<h3 class="timeline-title"><?php echo esc_html( $title ); ?></h3>
											<ul class="timeline-content">
												<?php if ( $content_args ): ?>
													<?php foreach ( $content_args as $value ): ?>
														<li><?php echo esc_html( trim( $value ) ); ?></li>
												<?php endforeach; endif; ?>
											</ul>
										</div>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div><!-- timeline-row -->
					<?php endif; ?>

					<?php if ( ! empty( $road_map_3 ) && 'yes' == $show_item_3 ): ?>
						<div class="timeline-row">
							<div class="timeline-items">
								<?php foreach ( $road_map_3 as $items ):
									$time_stamp 	= strtotime( $items['date_3'] );
									$month 			= date_i18n('M', $time_stamp);
									$year 			= date_i18n('Y', $time_stamp);
									$title 			= $items['title_3'];
									$content 		= $items['content_3'];
									$content_args 	= array();
									if ( $content ) {
										$content_args = explode(",", $content);
									}
									$timeline_done 	= $items['timeline_done_3'];
									$timeline_check = 'timeline-not-done';
									if ( 'yes' == $timeline_done ) {
										$timeline_check = '';
									}

									// Animation Date
									$animation_date = $items['animation_date_3'];
									$duration_date 	= $items['animation_duration_date_3'];
									$delay_date		= $items['animation_delay_date_3'];

									$data_animation_date = array(
										'animation' => $animation_date,
										'duration' 	=> $duration_date,
										'delay' 	=> $delay_date,
									);

									//Animation Content
									$animation_content 	= $items['animation_content_3'];
									$duration_content 	= $items['animation_duration_content_3'];
									$delay_content		= $items['animation_delay_content_3'];

									$data_animation_content = array(
										'animation' => $animation_content,
										'duration' 	=> $duration_content,
										'delay' 	=> $delay_content,
									);
								?>
								<div class="item">
									<div class="timeline-item <?php echo esc_html( $timeline_check ); ?>">
										<div 
											class="timeline-date <?php if ( $animation_date ) echo 'ova-invisible'; ?>" 
											data-animation='<?php echo json_encode( $data_animation_date ); ?>'>
											<span class="date"><?php echo esc_html( $month . ' ' . $year ); ?></span>
										</div>
										<div 
											class="timeline-info <?php if ( $animation_content ) echo 'ova-invisible'; ?>" 
											data-animation='<?php echo json_encode( $data_animation_content ); ?>'>
											<h3 class="timeline-title"><?php echo esc_html( $title ); ?></h3>
											<ul class="timeline-content">
												<?php if ( $content_args ): ?>
													<?php foreach ( $content_args as $value ): ?>
														<li><?php echo esc_html( trim( $value ) ); ?></li>
												<?php endforeach; endif; ?>
											</ul>
										</div>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div><!-- timeline-row -->
					<?php endif; ?>
				<?php elseif ( 'v3' == $type ): ?>
					<?php if ( $items_v3 ): ?>
						<!-- Desktop -->
						<div class="road-map-container desktop">
							<div class="road-map-icon">
								<?php foreach( $items_v3 as $item_icon_v3 ): ?>
									<div class="icon">
										<i class="<?php echo esc_attr( $item_icon_v3['icon_v3'] ); ?>"></i>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="road-map-content">
								<?php foreach( $items_v3 as $item_content_v3 ):
									//Animation Content
									$animation_content 	= $item_content_v3['animation_content_v3'];
									$duration_content 	= $item_content_v3['animation_duration_content_v3'];
									$delay_content		= $item_content_v3['animation_delay_content_v3'];

									$data_animation_content = array(
										'animation' => $animation_content,
										'duration' 	=> $duration_content,
										'delay' 	=> $delay_content,
									);
								?>
									<div class="road-map-item<?php if ( $animation_content ) echo ' ova-invisible'; ?>" 
										 data-animation='<?php echo json_encode( $data_animation_content ); ?>'>
										<div class="number">
											<span><?php echo esc_html( $item_content_v3['number_v3'] ); ?></span>
										</div>
										<h2 class="title"><?php echo esc_html( $item_content_v3['title_v3'] ); ?></h2>
										<p class="description"><?php echo esc_html( $item_content_v3['description_v3'] ); ?></p>
									</div>
								<?php endforeach; ?>
							</div>
						</div><!-- End Desktop -->

						<!-- Mobile -->
						<div class="road-map-container mobile">
							<?php foreach( $items_v3 as $item_mobile_v3 ): ?>
								<div class="road-map-content">
									<div class="road-map-icon">
										<div class="icon">
											<i class="<?php echo esc_attr( $item_mobile_v3['icon_v3'] ); ?>"></i>
										</div>
									</div>
									<div class="road-map-item">
										<div class="number">
											<span><?php echo esc_html( $item_mobile_v3['number_v3'] ); ?></span>
										</div>
										<h2 class="title"><?php echo esc_html( $item_mobile_v3['title_v3'] ); ?></h2>
										<p class="description"><?php echo esc_html( $item_mobile_v3['description_v3'] ); ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				<?php elseif ( 'v4' == $type ): ?>
					<?php if ( $items_v4 ): ?>
						<!-- Desktop -->
						<div class="road-map-container">
							<?php foreach( $items_v4 as $item_v4 ): 
								$time_stamp_from 	= strtotime( $item_v4['date_v4_from'] );
								$month_from 		= date_i18n('M', $time_stamp_from);
								$day_from 			= date_i18n('d', $time_stamp_from);

								$time_stamp_to 		= strtotime( $item_v4['date_v4_to'] );
								$month_to 			= date_i18n('M', $time_stamp_to);
								$day_to 			= date_i18n('d', $time_stamp_to);
							?>
								<div class="item">
									<div class="date">
										<span class="date_form"><?php echo esc_html( $month_from . ' ' . $day_from ); ?></span>
										<span class="seperate"><?php echo esc_html( $seperate_v4 ); ?></span>
										<span class="date_to"><?php echo esc_html( $month_to . ' ' . $day_to ); ?></span>
									</div>
									<div class="content">
										<span class="title<?php echo esc_html( $class_v4_lg ); ?>"><?php echo esc_html( $item_v4['title_v4'] ); ?></span>
										<span class="text"><?php echo esc_html( $item_v4['text_v4'] ); ?></span>
									</div>
								</div>
							<?php endforeach; ?>
						</div><!-- End Desktop -->
					<?php endif; ?>
				<?php elseif ( 'v5' == $type ): ?>
					<div class="road-map-container">
						<?php foreach( $items_v5 as $item_v5 ): 
							$time_stamp_from 	= strtotime( $item_v5['date_v5_from'] );
							$month_from 		= date_i18n('M', $time_stamp_from);
							$day_from 			= date_i18n('d', $time_stamp_from);

							$time_stamp_to 		= strtotime( $item_v5['date_v5_to'] );
							$month_to 			= date_i18n('M', $time_stamp_to);
							$day_to 			= date_i18n('d', $time_stamp_to);
						?>
							<div class="item">
								<div class="content">
									<span class="title"><?php echo esc_html( $item_v5['title_v5'] ); ?></span>
									<span class="text"><?php echo esc_html( $item_v5['text_v5'] ); ?></span>
								</div>
								<div class="date">
									<span class="date_form"><?php echo esc_html( $month_from . ' ' . $day_from ); ?></span>
									<span class="seperate"><?php echo esc_html( $seperate_v5 ); ?></span>
									<span class="date_to"><?php echo esc_html( $month_to . ' ' . $day_to ); ?></span>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php elseif ( 'v6' == $type ): ?>
					<!-- Desktop -->
					<div class="road-map-container desktop">
						<?php foreach( $items_v6 as $k_v6 => $item_v6 ): 
							$time_stamp = strtotime( $item_v6['date_v6'] );
							$month 		= date_i18n('F', $time_stamp);
							$year 		= date_i18n('Y', $time_stamp);
							$done 		= ( 'yes' == $item_v6['timeline_done_v6'] ) ? ' done' : '';
							$content 	= $item_v6['content_v6'];
							$content_args 	= array();
							if ( $content ) {
								$content_args = explode(",", $content);
							}

							// Animation Date
							$animation_content_v6 	= $item_v6['animation_content_v6'];
							$duration_content_v6 	= $item_v6['animation_duration_content_v6'];
							$delay_content_v6		= $item_v6['animation_delay_content_v6'];

							$data_animation_content_v6 = array(
								'animation' => $animation_content_v6,
								'duration' 	=> $duration_content_v6,
								'delay' 	=> $delay_content_v6,
							);

						?>

						<?php if ( $k_v6 % 2 == 0 ): ?>
							<div class="item item-bottom<?php echo esc_attr( $done ); ?>">
								<div class="date">
									<span class="month"><?php echo esc_html( $month ); ?></span>
									<span class="year"><?php echo esc_html( $year ); ?></span>
								</div>
								<div class="timeline">
									<div class="border-dot">
										<span class="dot"></span>
									</div>
								</div>
								<div class="content-wrapper">
									<ul class="content<?php if ( $animation_content_v6 ) echo ' ova-invisible'; ?>" 
										data-animation='<?php echo json_encode( $data_animation_content_v6 ); ?>'>
										<?php if ( $content_args ): ?>
											<?php foreach ( $content_args as $value ): ?>
												<li class="content-item"><?php echo esc_html( trim( $value ) ); ?></li>
										<?php endforeach; endif; ?>
									</ul>
								</div>
							</div>
						<?php else: ?>
							<div class="item item-top<?php echo esc_attr( $done ); ?>">
								<div class="content-wrapper">
									<ul class="content<?php if ( $animation_content_v6 ) echo ' ova-invisible'; ?>" 
										data-animation='<?php echo json_encode( $data_animation_content_v6 ); ?>'>
										<?php if ( $content_args ): ?>
											<?php foreach ( $content_args as $value ): ?>
												<li class="content-item"><?php echo esc_html( trim( $value ) ); ?></li>
										<?php endforeach; endif; ?>
									</ul>
								</div>
								<div class="timeline">
									<div class="border-dot">
										<span class="dot"></span>
									</div>
								</div>
								<div class="date">
									<span class="month"><?php echo esc_html( $month ); ?></span>
									<span class="year"><?php echo esc_html( $year ); ?></span>
								</div>
							</div>
						<?php endif; ?>
							
						<?php endforeach; ?>
					</div>

					<!-- Mobile -->
					<div class="road-map-container mobile">
						<?php foreach( $items_v6 as $k_v6_mobile => $item_v6_mobile ): 
							$time_stamp = strtotime( $item_v6_mobile['date_v6'] );
							$month 		= date_i18n('F', $time_stamp);
							$year 		= date_i18n('Y', $time_stamp);
							$done 		= ( 'yes' == $item_v6_mobile['timeline_done_v6'] ) ? ' done' : '';
							$content 	= $item_v6_mobile['content_v6'];
							$content_args 	= array();
							if ( $content ) {
								$content_args = explode(",", $content);
							}
						?>
							<div class="item<?php echo esc_attr( $done ); ?>">
								<div class="item-wrapper">
									<div class="timeline">
										<div class="border-dot">
											<span class="dot"></span>
										</div>
									</div>
									<div class="content-wrapper">
										<div class="date">
											<span class="month"><?php echo esc_html( $month ); ?></span>
											<span class="year"><?php echo esc_html( $year ); ?></span>
										</div>
										<ul class="content">
											<?php if ( $content_args ): ?>
												<?php foreach ( $content_args as $value ): ?>
													<li class="content-item"><?php echo esc_html( trim( $value ) ); ?></li>
											<?php endforeach; endif; ?>
										</ul>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div><!-- road-map-wrapper -->
		</div><!-- ova-road-map -->
		 	
		<?php
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Road_Map() );