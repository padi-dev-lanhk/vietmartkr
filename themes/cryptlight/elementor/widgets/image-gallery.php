<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Cryptlight_Elementor_Image_Gallery extends Widget_Base {

	
	public function get_name() {
		return 'cryptlight_elementor_image_gallery';
	}

	
	public function get_title() {
		return esc_html__( 'Image Gallery', 'cryptlight' );
	}

	
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	
	public function get_categories() {
		return [ 'cryptlight' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'cryptlight' ),
			]
		);	
			
			$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'image',
					[
						'label' 	=> esc_html__( 'Choose Image', 'cryptlight' ),
						'type' 		=> Controls_Manager::MEDIA,
						'dynamic' 	=> [
							'active' => true,
						],
						'default' 	=> [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_control(
					'link',
					[
						'label' 		=> esc_html__( 'Link', 'cryptlight' ),
						'type' 			=> Controls_Manager::URL,
						'dynamic' 		=> [
							'active' 	=> true,
						],
						'show_label' 	=> false,
					]
				);

			$this->add_control(
	            'image_gallery',
	            [
	                'type' 		=> Controls_Manager::REPEATER,
	                'fields' 	=> $repeater->get_controls(),
	                'default' 	=> [
	                    [
	                        'image' => [ 'url' => Utils::get_placeholder_image_src() ],
	                        'link'	=> [ 'url' =>  esc_html__( '#', 'cryptlight' ) ],
	                    ],
	                    [
	                        'image' => [ 'url' => Utils::get_placeholder_image_src() ],
	                        'link'	=> [ 'url' =>  esc_html__( '#', 'cryptlight' ) ],
	                    ],
	                    [
	                        'image' => [ 'url' => Utils::get_placeholder_image_src() ],
	                        'link'	=> [ 'url' =>  esc_html__( '#', 'cryptlight' ) ],
	                    ],
	                    [
	                        'image' => [ 'url' => Utils::get_placeholder_image_src() ],
	                        'link'	=> [ 'url' =>  esc_html__( '#', 'cryptlight' ) ],
	                    ],
	                ],
	            ]
	        );

	        $gallery_columns = range( 1, 5 );
			$gallery_columns = array_combine( $gallery_columns, $gallery_columns );

			$this->add_control(
				'gallery_columns',
				[
					'label' 	=> esc_html__( 'Columns', 'cryptlight' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 4,
					'options' 	=> $gallery_columns,
				]
			);

		$this->end_controls_section();

		/* Begin Gallery Style */
		$this->start_controls_section(
            'gallery_style',
            [
                'label' => esc_html__( 'Gallery', 'cryptlight' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_control(
				'gallery_spacing',
				[
					'label' => esc_html__( 'Spacing', 'cryptlight' ),
					'type' => Controls_Manager::SLIDER,
					'show_label' => false,
					'range' => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-image-gallery ' => 'grid-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

        $this->end_controls_section();
        /* End Gallery Style */
	}

	// Render Template Here
	protected function render() {

		$settings 			= $this->get_settings();

		$image_gallery 		= $settings['image_gallery'];
		$gallery_columns 	= $settings['gallery_columns'];

		if ( ! empty( $image_gallery ) ):
		?>
			<div class="ova-image-gallery column-<?php echo esc_html( $gallery_columns ); ?>">
				<?php foreach( $image_gallery as $items ):
					$url 			= $items['image']['url'];
					$alt 			= isset( $items['image']['alt'] ) ? $items['image']['alt'] : '';
					$link 			= $items['link']['url'];
					$is_external 	= $items['link']['is_external'];
					$tg_blank 		= '';
					if ( $is_external == 'on' ) {
						$tg_blank = 'target="blank"';
					}
				?>
					<div class="gallery-item">
						<?php if ( $link ): ?>
							<a href="<?php echo esc_url( $link ); ?>">
								<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_html( $alt ); ?>">
							</a>
						<?php else: ?>
							<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_html( $alt ); ?>">
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php
		endif;
	}

	
}
$widgets_manager->register_widget_type( new Cryptlight_Elementor_Image_Gallery() );