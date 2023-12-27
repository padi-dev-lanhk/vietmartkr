<?php 
namespace SWWE;

/**
 * SWE_Assets_Manager
 *
 * @author Youtech
 * @package SWE
 */
final class SWE_Assets_Manager {
    /**
     * Nope constructor
     */
    private function __construct() {}

    /**
     * Singleton
     */
    static function instance($return = false) {
        static $self = null;

        if (null === $self) {
            $self = new self;
            add_action('admin_enqueue_scripts', [$self, '_loadAdminAssets']);
            add_action('elementor/editor/footer', [$self, '_printEditorTemplates']);
            add_action('elementor/preview/enqueue_styles', [$self, '_previewStyles']);
            add_action('elementor/editor/before_enqueue_scripts', [$self, '_beforeEnqueueEditorScripts'], 11, 0);
            add_action('elementor/frontend/before_enqueue_scripts', [$self, '_beforeEnqueueFrontendScripts'], 10, 0);
            add_action('elementor/frontend/after_register_styles', [$self, '_afterRegisterFrontendStyles'], 10, 0);
            add_action('elementor/frontend/after_enqueue_styles', [$self, '_afterEnqueueFrontendStyles'], 10, 0);
            add_action('elementor/frontend/after_register_scripts', [$self, '_afterRegisterFrontendScripts'], 10, 0);
            add_action('elementor/frontend/after_register_scripts', [$self, '_add_ajax_url'], 10, 0);
            add_action('elementor/editor/after_enqueue_styles', [$self, '_afterEnqueueEditorStyles'], 10, 0);
            add_action('elementor/editor/after_register_scripts', [$self, '_afterRegisterEditorScripts'], 10, 0);
            global $wp_customize;
            if ( !isset( $wp_customize ) ) {
                add_action('wp_enqueue_scripts', [$self, '_load_elementor_css_in_head']);
            }
        }

        if ($return) {
            return $self;
        }
    }

    /**
     * Load Elementor styles on all pages in the head to avoid CSS files being loaded in the footer
     */
    function _load_elementor_css_in_head(){}


    /**
     * Register and enqueue admin assets
     *
     * @internal Used as a callback.
     */
    function _loadAdminAssets($hook_suffix) {}

    /**
     * @internal Used as a callback
     */
    function _previewStyles() {}

    /**
     * Load JS Templates
     *
     * @internal Used as a callback
     */
    function _printEditorTemplates() {}


    /**
     * Register frontend stylesheets
     *
     * @internal Used as a callback.
     */
    function _afterRegisterFrontendStyles() {}

    /**
     * Register frontend scripts
     *
     * @internal Used as a callback.
     */
    function _afterRegisterFrontendScripts() {
        wp_register_script('swwe-script', SWWE_PLUGIN_URI.'assets/js/script.js', ['jquery-core'], Plugin::VERSION, true);
        wp_register_script('slick', SWWE_PLUGIN_URI.'assets/vendor/slick/slick.min.js', ['jquery-core'], Plugin::VERSION, true);
        wp_register_script('countdown', SWWE_PLUGIN_URI.'assets/vendor/countdown/countdown.js', ['jquery-core'], Plugin::VERSION, true);
        wp_register_script('infinite', SWWE_PLUGIN_URI.'assets/vendor/infinite-scroll/infinite-scroll.pkgd.min.js', ['jquery-core'], '3.0.5', true);
    }

    function _add_ajax_url() {}

    /**
     * @internal Used as a callback
     */
    function _afterRegisterEditorScripts() {
        $this->_afterRegisterFrontendScripts();
    }

    /**
     * Enqueue frontend stylesheets
     *
     * @internal Used as a callback.
     */
    function _afterEnqueueFrontendStyles() {
        wp_register_style('slick', SWWE_PLUGIN_URI . 'assets/vendor/slick/slick.css', [], Plugin::VERSION);
        wp_enqueue_style('swwe-style', SWWE_PLUGIN_URI . 'assets/scss/style.css', [], Plugin::VERSION);
        wp_enqueue_style('font-awesome-5-all', SWWE_PLUGIN_URI . 'assets/vendor/font-awesome/css/all.min.css', [], Plugin::VERSION);
    }

    /**
     * @internal Used as a callback.
     */
    function _afterEnqueueEditorStyles() {
        $this->_afterEnqueueFrontendStyles();
    }

    /**
     * Enqueue frontend dev scripts
     *
     * @ignore For dev purpose only. Will be removed later.
     * @internal Used as a callback.
     */
    function _beforeEnqueueFrontendScripts() {}

    /**
     * @internal Used as a callback.
     */
    function _beforeEnqueueEditorScripts() {}
}

// Initialize.
SWE_Assets_Manager::instance();
