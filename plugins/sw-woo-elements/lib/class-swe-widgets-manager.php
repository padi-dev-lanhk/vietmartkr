<?php 
namespace SWWE;

use DirectoryIterator;
use Elementor\Widget_Base;
use Elementor\Widgets_Manager;
use Elementor\Controls_Manager;

/**
 * SWE_Widgets_Manager
 *
 * @author Youtech
 * @package SWE
 */
final class SWE_Widgets_Manager {
    /**
     * Plugin settings
     */
    private $settings;

    /**
     * Nope constructor
     */
    private function __construct() {

    }

    /**
     * Singleton
     */
    static function instance($return = false) {

        static $self = null;

        if (null === $self) {
            $self = new self;
            add_action('elementor/widgets/widgets_registered', [$self, '_registerWidgets']);
        }

        if ($return) {
            return $self;
        }
    }

    /**
     * Register widgets
     *
     * @internal Used as a callback.
     */
    function _registerWidgets(Widgets_Manager $widget_manager) {
        if (!class_exists('SWE\SWE_Widget_Base')) {
            require SWWE_PLUGIN_URL . 'lib/class-swe-widget-base.php';
        }
        // require_once SWWE_PLUGIN_URL . 'src/widgets/swe-banner.php';

        $filesPlugin = new DirectoryIterator(SWWE_PLUGIN_URL . 'src/widgets');

        foreach ($filesPlugin as $file) {
            $filename = $file->getFilename();
            if (strpos($filename, '.php') !== false) {
                require_once SWWE_PLUGIN_URL . 'src/widgets/' . $filename;
            }
        }
    }

    /**
     * Get classname from filename
     *
     * @param string $filename
     *
     * @return string
     */
    private function getWidgetClassName($filename) {
        $_filename = trim(str_replace(['class', '-', '.php'], ['', ' ', ''], $filename));
        $arrName = explode(" ", $_filename);
        $arrName[0] = strtoupper($arrName[0]);
        return sprintf('%s\Widgets\%s', __NAMESPACE__, str_replace(' ', '_', ucwords(implode(' ', $arrName))));
    }
}

// Initialize.
SWE_Widgets_Manager::instance();
