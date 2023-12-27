<?php 
namespace SWWE\Widgets;

use Elementor\Frontend;
use Elementor\Widget_Base;
use InvalidArgumentException;

/**
 * SWE_Widget_Base
 *
 * @author Youtech
 * @package SWE
 */
abstract class SWE_Widget_Base extends Widget_Base {
    /**
     * @return array
     */
    public function get_categories() {
        return [ 'sw-woo-elements' ];
    }

    /**
     * Get Category Product
     */
    protected function get_woo_categories ($select = 0) {
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

    protected function get_woo_products () {
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

    protected function get_woo_filter ($select = 0) {
        $data = array();
        if ($select == 1) {
            $data['all'] =  __('All', 'sw-woo-elements');
        }
        $data += array(
            'latest'        => __('Latest', 'sw-woo-elements'),
            'rating'        => __('Rating', 'sw-woo-elements'),
            'on_sale'       => __('On Sale', 'sw-woo-elements'),
            'best_selling'  => __('Best Selling', 'sw-woo-elements'),
            'featured'      => __('Featured', 'sw-woo-elements'),
            'recommend'     => __('Recommend', 'sw-woo-elements'),
        );
        return $data;
    }

    protected function get_order_by () {
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

    /**
     * Get view template
     *
     * @param string $tpl_name
     */
    protected function getViewTemplate($tpl_slug, $tpl_name, $settings = []) {
        $located   = '';
        $templates = [];

        if (! $settings) {
            $settings = $this->get_settings_for_display();
        }

        if ($tpl_name) {
            $templates[] = 'swe/templates/' . $tpl_slug . '-' . $tpl_name . '.php';
            $templates[] = 'src/templates/' . $tpl_slug . '-' . $tpl_name . '.php';
        }

        foreach ($templates as $template) {
            if (file_exists(get_template_directory() . '/' . $template)) {
                $located = get_template_directory() . '/' . $template;
                break;
            }  elseif (file_exists(WP_PLUGIN_DIR . '/sw-woo-elements/' . $template)) {
                $located = WP_PLUGIN_DIR . '/sw-woo-elements/' . $template;
                break;
            } else {
                $located = false;
            }
        }

        if ($located) {
            include $located;
        } else {
            throw new InvalidArgumentException(sprintf(__('Failed to load template with slug "%s" and name "%s".', 'sw-woo-elements'), $tpl_slug, $tpl_name));
        }
    }

    /**
     * Get HTML Tag
     *
     * @param string $post_type is post type
     *
     * @return array $results List post data.
     */
    protected function getHtmlTag() {
        $data = [
            'h1' => __('H1', 'sw-woo-elements'),
            'h2' => __('H2', 'sw-woo-elements'),
            'h3' => __('H3', 'sw-woo-elements'),
            'h4' => __('H4', 'sw-woo-elements'),
            'h5' => __('H5', 'sw-woo-elements'),
            'h6' => __('H6', 'sw-woo-elements'),
            'div' => __('div', 'sw-woo-elements'),
            'span' => __('span', 'sw-woo-elements'),
            'p' => __('p', 'sw-woo-elements'),
        ];

        return $data;
    }

    protected function getOptionPosition($opt) {
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
