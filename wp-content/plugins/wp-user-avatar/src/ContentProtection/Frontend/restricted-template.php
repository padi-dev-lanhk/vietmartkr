<?php
/**
 * The template for displaying restricted pages.
 *
 * @package ProfilePress
 */

if ( ! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/** @global array $args */

get_header(); ?>
<main id="site-content" class="ppress-main-container">
    <div class="ppress-container-div">
        <?php if ( ! empty($args)) {
            if ( ! apply_filters('ppress_noaccess_action_message_custom_no_wp_kses_post', false)) {
                echo wp_kses_post($args['noaccess_action_message_custom']);
            } else {
                echo $args['noaccess_action_message_custom'];
            }
        } ?>
    </div>
</main>

<?php get_footer(); ?>
