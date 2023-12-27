<?php
namespace SWWE;
/**
 * SWE_Elements_Category
 *
 * @author Youtech
 * @package SWE
 */
use Elementor\Plugin;

final class SWE_Elements_Category
{
    /**
     * Nope constructor
     */
    private function __construct()
    {

    }

    /**
     * Singleton
     */
    static function instance($return = false)
    {
        static $self = null;

        if (null === $self) {
            $self = new self;
            add_action('elementor/init', [$self, '_register'], 10, 0);
        }

        if ($return) {
            return $self;
        }
    }

    /**
     * Do registration
     *
     * @internal Used as a callback.
     */
    function _register() {
        $elementor = Plugin::instance();

        $elementor->elements_manager->add_category('sw-woo-elements', [
            'title' => esc_html__('SW Elements', 'sw-woo-elements'),
            'icon'  => 'eicon-elementor-circle',
        ], 5);
        $elementor->elements_manager->add_category('sw-woocommerce-elements', [
            'title' => esc_html__('SW Woo Elements', 'sw-woo-elements'),
            'icon'  => 'eicon-elementor-circle',
        ], 10);
    }
}

// Initialize.
SWE_Elements_Category::instance();
