<?php 
namespace SWPE;

/**
 * Plugin Name: SW Post Elements
 * Plugin URI: https://codecanyon.net/item/post-elements-plugin-elementor-addon-for-blog-newspaper-magazine/33994050
 * Description: A powerful Elementor addon for any blog, news, newspaper, or magazine WordPress website. It will help to showcase the blog posts, images, and post categories beautifully with different styles.
 * Author:      WpThemeGo
 * Author URI:  https://wpthemego.com/
 * Version:     1.0.3
 * Text Domain: sw-post-elements
 * Requires PHP: 5.6
 */

use Exception;

/**
 * Plugin container.
 */
final class Plugin
{
    /**
     * Version
     *
     * @var string
     */
    const VERSION = '1.0.1';

    /**
     * Option key
     *
     * @var string
     */
    const OPTION_NAME = 'swe_plugin_settings';

    /**
     * Settings
     *
     * @var array
     */
    private $settings;

    /**
     * Constructor
     */
    function __construct(array $settings = [])
    {
    	$this->settings = $settings;

        // Define constants.
    	define('SWPE_PLUGIN_URL', __DIR__ . '/');
    	define('SWPE_PLUGIN_URI', str_replace(['http:', 'https:'], '', plugins_url('/', __FILE__)));

        // Bind important events.
    	add_action('plugins_loaded', [$this, '_install'], 10, 0);
    	add_action('activate_swe/sw-post-elements.php', [$this, '_activate']);
    	add_action('deactivate_swe/sw-post-elements.php', [$this, '_deactivate']);
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

    	if(!did_action('elementor/loaded')) {
    		add_action('admin_notices', function() {
    			if (!current_user_can('activate_plugins')) {
    				return;
    			}

    			$elementor = 'elementor/elementor.php';

    			if ($this->is_plugin_installed($elementor)) {
    				$activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor);

    				$message = sprintf(esc_html__('%1$sSw Post Elements%2$s requires %1$sElementor%2$s plugin to be active. Please activate Elementor to continue.', 'sw-post-elements'), "<b>", "</b>");

    				$button_text = esc_html__('Activate Elementor', 'sw-post-elements');
    			} else {
    				$activation_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');

    				$message = sprintf(esc_html__('%1$sSw Post Elements%2$s requires %1$sElementor%2$s plugin to be installed and activated. Please install Elementor to continue.', 'sw-post-elements'), '<b>', '</b>');
    				$button_text = esc_html__('Install Elementor', 'sw-post-elements');
    			}
    			$button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';

    			printf('<div class="error"><p>%1$s</p>%2$s</div>', esc_html($message), ent2ncr($button) );
    		}, 10, 0);
    	}

        // Make sure translation is available.
        load_textdomain( 'sw-post-elements', SWPE_PLUGIN_URL.'languages/sw-post-elements-'.determine_locale().'.mo' );
        load_plugin_textdomain('sw-post-elements', false, SWPE_PLUGIN_URL.'languages');

        require SWPE_PLUGIN_URL . 'lib/class-swe-functions.php';
        require SWPE_PLUGIN_URL . 'lib/class-swe-elements-category.php';
        require SWPE_PLUGIN_URL . 'lib/class-swe-widgets-manager.php';
        require SWPE_PLUGIN_URL . 'lib/class-swe-assets-manager.php';
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
    }

    /**
     * Pre-activation check
     *
     * @throws Exception
     */
    private function preActivate() {
    	if (version_compare(PHP_VERSION, '5.6', '<')) {
    		throw new Exception(esc_html__('This plugin requires PHP version 5.6 at least!', 'sw-post-elements'));
    	}

    	if (version_compare($GLOBALS['wp_version'], '4.7', '<')) {
    		throw new Exception(esc_html__('This plugin requires WordPress version 4.7 at least!', 'sw-post-elements'));
    	}

    	if (!class_exists('Elementor\Plugin')) {
    		throw new Exception(esc_html__('This plugin requires Elementor Page Builder version 2.3.2 at least. Please install and activate the latest version of Elementor Page Builder!', 'sw-post-elements'));
    	}
    }
}

// Initialize plugin.
return new Plugin((array)get_option(Plugin::OPTION_NAME, []));
