<?php 
namespace SWPE\Widgets;

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
        return [ 'sw-post-elements' ];
    }

    /**
     * Get Category Product
     */
    protected function get_post_categories ($select = 0) {
        $args = array(
            'taxonomy'     => 'category',
            'orderby'      => 'name',
        );
        $all_categories = get_categories( $args );

        $data = array();
        if ($select == 1) {
            $data[''] = esc_html__('Choose a Category', 'sw-post-elements');
        }
        if ($select == 2) {
            $data['all'] = esc_html__('All', 'sw-post-elements');
        }
        foreach ($all_categories as $cat) {
            $data[$cat->slug] = $cat->name;
        }
        return $data;
    }

    protected function get_post_list () {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1
        );
        $products = get_posts( $args );
        $data = [];
        foreach ($products as $product) {
            $data[$product->ID] = $product->post_title;
        }
        return $data;
    }

    protected function get_post_filter ($select = 0) {
        $data = array();
        if ($select == 1) {
            $data['all'] =  esc_html__('All', 'sw-post-elements');
        }
        $data += array(
            'latest'        => esc_html__('Latest', 'sw-post-elements'),
            'rating'        => esc_html__('Rating', 'sw-post-elements'),
            'on_sale'       => esc_html__('On Sale', 'sw-post-elements'),
            'best_selling'  => esc_html__('Best Selling', 'sw-post-elements'),
            'featured'      => esc_html__('Featured', 'sw-post-elements'),
        );
        return $data;
    }

    protected function get_order_by () {
        $data = array(
            'none'      => esc_html__('None', 'sw-post-elements'),
            'ID'        => esc_html__('ID', 'sw-post-elements'),
            'author'    => esc_html__('Author', 'sw-post-elements'),
            'title'     => esc_html__('Title', 'sw-post-elements'),
            'date'      => esc_html__('Date', 'sw-post-elements'),
            'menu_order' => esc_html__('Menu Order', 'sw-post-elements'),
            'rand'      => esc_html__('Random', 'sw-post-elements'),
            'modified'      => esc_html__('Modified', 'sw-post-elements'),
            'comment_count' => esc_html__('Comment Count', 'sw-post-elements'),
            'parent'    => esc_html__('Parent', 'sw-post-elements'),
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
            }  elseif (file_exists(WP_PLUGIN_DIR . '/sw-post-elements/' . $template)) {
                $located = WP_PLUGIN_DIR . '/sw-post-elements/' . $template;
                break;
            } else {
                $located = false;
            }
        }

        if ($located) {
            include $located;
        } else {
            throw new InvalidArgumentException(sprintf(esc_html__('Failed to load template with slug "%s" and name "%s".', 'sw-post-elements'), $tpl_slug, $tpl_name));
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
            'h1' => esc_html__('H1', 'sw-post-elements'),
            'h2' => esc_html__('H2', 'sw-post-elements'),
            'h3' => esc_html__('H3', 'sw-post-elements'),
            'h4' => esc_html__('H4', 'sw-post-elements'),
            'h5' => esc_html__('H5', 'sw-post-elements'),
            'h6' => esc_html__('H6', 'sw-post-elements'),
            'div' => esc_html__('div', 'sw-post-elements'),
            'span' => esc_html__('span', 'sw-post-elements'),
            'p' => esc_html__('p', 'sw-post-elements'),
        ];

        return $data;
    }

    protected function getOptionPosition($opt) {
        $data = [];
        switch ($opt) {
            case 'full':
            $data = [
                'left'   => [
                    'title' => esc_html__( 'Left', 'sw-post-elements' ),
                    'icon'  => 'eicon-h-align-left',
                ],
                'top'    => [
                    'title' => esc_html__( 'Top', 'sw-post-elements' ),
                    'icon'  => 'eicon-v-align-top',
                ],
                'middle' => [
                    'title' => esc_html__( 'Middle', 'sw-post-elements' ),
                    'icon'  => 'eicon-circle-o',
                ],
                'bottom' => [
                    'title' => esc_html__( 'Bottom', 'sw-post-elements' ),
                    'icon'  => 'eicon-v-align-bottom',
                ],
                'right'  => [
                    'title' => esc_html__( 'Right', 'sw-post-elements' ),
                    'icon'  => 'eicon-h-align-right',
                ]
            ];
            break;

            // Vertical
            case 'ver':
            $data = [
                'top'    => [
                    'title' => esc_html__( 'Top', 'sw-post-elements' ),
                    'icon'  => 'eicon-v-align-top',
                ],
                'middle' => [
                    'title' => esc_html__( 'Middle', 'sw-post-elements' ),
                    'icon'  => 'eicon-v-align-middle',
                ],
                'bottom' => [
                    'title' => esc_html__( 'Bottom', 'sw-post-elements' ),
                    'icon'  => 'eicon-v-align-bottom',
                ],
            ];
            break;

            // Horizontal
            case 'hor':
            $data = [
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
            ];
            break;

            // align text
            default:
            $data = [
                'left' => [
                    'title' => esc_html__( 'Left', 'sw-post-elements' ),
                    'icon'  => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'sw-post-elements' ),
                    'icon'  => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__( 'Right', 'sw-post-elements' ),
                    'icon'  => 'eicon-text-align-right',
                ],
                'justify' => [
                    'title' => esc_html__('Justify', 'sw-post-elements'),
                    'icon'  => 'eicon-text-align-justify',
                ]
            ];
            break;
        }
        return $data;
    }
}
