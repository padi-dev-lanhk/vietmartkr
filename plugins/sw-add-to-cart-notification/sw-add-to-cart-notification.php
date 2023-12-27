<?php 
namespace SWATCN;
/**
* Plugin Name: SW Add To Cart Notification
* Plugin URI:  
* Description: An ultimate addon for Woocommerce.
* Author:      WPThemeGo
* Author URI:  https://wpthemego.com/
* Version:     1.0.0
* Text Domain: sw-add-to-cart-notification
* Requires PHP: 5.6
*/

use Exception;

/**
 * Plugin container.
 */
final class Plugin {
    /**
     * Version
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * Option key
     *
     * @var string
     */
    const OPTION_NAME = 'swatcn_plugin_settings';

    /**
     * Settings
     *
     * @var array
     */
    private $settings;

    /**
     * Constructor
     */
    function __construct(array $settings = []) {
    	$this->settings = $settings;

        // Define constants.
        define( 'SWATCN_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
        define('SWATCN_PLUGIN_URL', __DIR__ . '/');
        define('SWATCN_PLUGIN_URI', str_replace(['http:', 'https:'], '', plugins_url('/', __FILE__)));

        // Bind important events.
        add_action('plugins_loaded', [$this, '_install'], 10, 0);
        add_action('activate_swatcn/sw-add-to-cart-notification.php', [$this, '_activate']);
        add_action('deactivate_swatcn/sw-add-to-cart-notification.php', [$this, '_deactivate']);
    }

    /**
     * Do activation
     *
     * @internal Used as a callback.
     *
     * @see https://developer.wordpress.org/reference/functions/register_activation_hook/
     *
     * @param bool $network Whether to activate this plugin on network or a single site.
     */
    function _activate($network) {
        // Maybe do something on activation.
    }
    /**
     * Check if a plugin is installed
     *
     * @since v3.0.0
     */
    function is_plugin_installed($basename) {

        if (!function_exists('get_plugins')) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $installed_plugins = get_plugins();

        return isset($installed_plugins[$basename]);
    }

    /**
     * Do installation
     *
     * @internal Used as a callback.
     *
     * @see https://developer.wordpress.org/reference/hooks/plugins_loaded/
     */
    function _install() {
        require SWATCN_PLUGIN_URL . 'includes/class-admin-settings.php';
        require SWATCN_PLUGIN_URL . 'includes/class-add-to-cart.php';
    }

    /**
     * Do deactivation
     *
     * @internal Used as a callback.
     *
     * @see https://developer.wordpress.org/reference/functions/register_deactivation_hook/
     *
     * @param bool $network  Whether to deactivate this plugin on network or a single site.
     */
    function _deactivate($network) {
        // Maybe do something on deactivation.
    }

    /**
     * Pre-activation check
     *
     * @throws Exception
     */
    private function preActivate() {

    	if (version_compare(PHP_VERSION, '5.6', '<')) {
    		throw new Exception('This plugin requires PHP version 5.6 at least!');
    	}

    	if (version_compare($GLOBALS['wp_version'], '4.7', '<')) {
    		throw new Exception('This plugin requires WordPress version 4.7 at least!');
    	}

    	if (!class_exists('Elementor\Plugin')) {
    		throw new Exception('This plugin requires Elementor Page Builder version 2.3.2 at least. Please install and activate the latest version of Elementor Page Builder!');
    	}
    }
}

// Initialize plugin.
return new Plugin((array)get_option(Plugin::OPTION_NAME, []));
