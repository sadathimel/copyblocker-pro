<?php
/**
 * Uninstall script for CopyBlocker Pro.
 *
 * @package CopyBlocker_Pro
 */

// Prevent direct access
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete plugin options
function copyblocker_pro_cleanup() {
    $options = [
        'copyblocker_pro_disable_selection',
        'copyblocker_pro_block_copy',
        'copyblocker_pro_block_select_all',
        'copyblocker_pro_block_dev_tools',
        'copyblocker_pro_block_context_menu',
    ];
    foreach ($options as $option) {
        delete_option($option);
    }
}

// Handle multisite
if (is_multisite()) {
    global $wpdb;
    $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
    foreach ($blog_ids as $blog_id) {
        switch_to_blog($blog_id);
        copyblocker_pro_cleanup();
        restore_current_blog();
    }
} else {
    copyblocker_pro_cleanup();
}
?>