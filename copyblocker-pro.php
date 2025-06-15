<?php
/**
 * Plugin Name: CopyBlocker Pro
 * Plugin URI: https://github.com/sadathimel/copyblocker-pro
 * Description: A retro-styled plugin to disable text selection, copying, pasting, and inspecting on your WordPress site.
 * Version: 1.0.1
 * Author: sadathimel
 * Author URI: https://github.com/sadathimel
 * Author Email: sadathossen.cse@gmail.com
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: copyblocker-pro
 * Domain Path: /languages
 *
 * @package CopyBlocker_Pro
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include settings
require_once plugin_dir_path(__FILE__) . 'includes/settings.php';

// Enqueue frontend scripts and styles
function copyblocker_pro_enqueue_scripts() {
    $settings = [
        'disable_selection' => get_option('copyblocker_pro_disable_selection', 0),
        'block_copy' => get_option('copyblocker_pro_block_copy', 0),
        'block_select_all' => get_option('copyblocker_pro_block_select_all', 0),
        'block_dev_tools' => get_option('copyblocker_pro_block_dev_tools', 0),
        'block_context_menu' => get_option('copyblocker_pro_block_context_menu', 0),
        'copy_alert' => __('Copying is disabled!', 'copyblocker-pro'),
        'dev_tools_alert' => __('Developer tools are disabled!', 'copyblocker-pro'),
    ];

    if (array_sum(array_slice($settings, 0, 5))) {
        wp_enqueue_style('copyblocker-pro-frontend', plugins_url('assets/css/frontend.css', __FILE__), [], '1.0.1');
        wp_enqueue_script('copyblocker-pro-content', plugins_url('assets/js/content.js', __FILE__), [], '1.0.1', true);
        wp_localize_script('copyblocker-pro-content', 'copyblocker_pro', $settings);
    }
}
add_action('wp_enqueue_scripts', 'copyblocker_pro_enqueue_scripts');
?>