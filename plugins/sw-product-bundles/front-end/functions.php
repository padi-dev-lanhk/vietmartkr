<?php 

if( !class_exists('SWPB_Product_Bundles_functions')  ){
	class SWPB_Product_Bundles_functions {
		public function get_woo_categories ($select = 0) {
			$args = array(
				'taxonomy'     => 'product_cat',
				'orderby'      => 'name',
			);
			$all_categories = get_categories( $args );

			$data = array();
			if ($select == 1) {
				$data[''] = __('Choose a Category', 'sw-woo-elements');
			}
			if ($select == 2) {
				$data['all'] = __('All', 'sw-woo-elements');
			}
			foreach ($all_categories as $cat) {
				$data[$cat->slug] = $cat->name;
			}
			return $data;
		}
		public function get_order_by () {
			$data = array(
				'none'          => __('None', 'sw-woo-elements'),
				'ID'            => __('ID', 'sw-woo-elements'),
				'author'        => __('Author', 'sw-woo-elements'),
				'title'         => __('Title', 'sw-woo-elements'),
				'date'          => __('Date', 'sw-woo-elements'),
				'menu_order'    => __('Menu Order', 'sw-woo-elements'),
				'rand'          => __('Random', 'sw-woo-elements'),
				'modified'      => __('Modified', 'sw-woo-elements'),
				'comment_count' => __('Comment Count', 'sw-woo-elements'),
				'parent'        => __('Parent', 'sw-woo-elements'),
			);
			return $data;
		}

		public function get_woo_products () {
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => -1
			);
			$products = get_posts( $args );
			$data = [];
			foreach ($products as $product) {
				$data[$product->ID] = $product->post_title;
			}
			return $data;
		}

	    public function getOptionPosition($opt) {
	        $data = [];
	        switch ($opt) {
	            case 'full':
	            $data = [
	                'left'   => [
	                    'title' => __( 'Left', 'sw-woo-elements' ),
	                    'icon'  => 'eicon-h-align-left',
	                ],
	                'top'    => [
	                    'title' => __( 'Top', 'sw-woo-elements' ),
	                    'icon'  => 'eicon-v-align-top',
	                ],
	                'middle' => [
	                    'title' => __( 'Middle', 'sw-woo-elements' ),
	                    'icon'  => 'eicon-circle-o',
	                ],
	                'bottom' => [
	                    'title' => __( 'Bottom', 'sw-woo-elements' ),
	                    'icon'  => 'eicon-v-align-bottom',
	                ],
	                'right'  => [
	                    'title' => __( 'Right', 'sw-woo-elements' ),
	                    'icon'  => 'eicon-h-align-right',
	                ]
	            ];
	            break;

	            // Vertical
	            case 'ver':
	            $data = [
	                'top'    => [
	                    'title' => __( 'Top', 'sw-woo-elements' ),
	                    'icon'  => 'eicon-v-align-top',
	                ],
	                'middle' => [
	                    'title' => __( 'Middle', 'sw-woo-elements' ),
	                    'icon'  => 'eicon-v-align-middle',
	                ],
	                'bottom' => [
	                    'title' => __( 'Bottom', 'sw-woo-elements' ),
	                    'icon'  => 'eicon-v-align-bottom',
	                ],
	            ];
	            break;

	            // Horizontal
	            case 'hor':
	            $data = [
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
	            ];
	            break;

	            // align text
	            default:
	            $data = [
	                'left' => [
	                    'title' => __( 'Left', 'sw-woo-elements' ),
	                    'icon'  => 'eicon-text-align-left',
	                ],
	                'center' => [
	                    'title' => __( 'Center', 'sw-woo-elements' ),
	                    'icon'  => 'eicon-text-align-center',
	                ],
	                'right' => [
	                    'title' => __( 'Right', 'sw-woo-elements' ),
	                    'icon'  => 'eicon-text-align-right',
	                ],
	                'justify' => [
	                    'title' => __('Justify', 'sw-woo-elements'),
	                    'icon'  => 'eicon-text-align-justify',
	                ]
	            ];
	            break;
	        }
	        return $data;
	    }
	}
}

if (!function_exists('SWPB_Product_Bundles_functions')) {
	function SWPB_Product_Bundles_functions() {
		return new SWPB_Product_Bundles_functions();
	}
}
