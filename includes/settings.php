<?php
/**
 * Settings page for CopyBlocker Pro.
 *
 * @package CopyBlocker_Pro
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add settings page to admin menu
function copyblocker_pro_menu() {
    add_options_page(
        __('CopyBlocker Pro Settings', 'copyblocker-pro'),
        __('CopyBlocker Pro', 'copyblocker-pro'),
        'manage_options',
        'copyblocker-pro',
        'copyblocker_pro_settings_page'
    );
}
add_action('admin_menu', 'copyblocker_pro_menu');

// Register settings
function copyblocker_pro_register_settings() {
    $settings = [
        'copyblocker_pro_disable_selection',
        'copyblocker_pro_block_copy',
        'copyblocker_pro_block_select_all',
        'copyblocker_pro_block_dev_tools',
        'copyblocker_pro_block_context_menu',
    ];
    foreach ($settings as $setting) {
        register_setting('copyblocker_pro_settings_group', $setting, [
            'sanitize_callback' => 'absint',
            'default' => 0,
        ]);
    }
}
add_action('admin_init', 'copyblocker_pro_register_settings');

// Settings page content
function copyblocker_pro_settings_page() {
    // Check for settings updated
    $status_message = '';
    if (isset($_GET['settings-updated']) && $_GET['settings-updated'] === 'true') {
        $status_message = '<div class="notice notice-success is-dismissible"><p>' . esc_html__('Settings saved successfully!', 'copyblocker-pro') . '</p></div>';
    }
    ?>
    <div class="wrap copyblocker-pro-wrap">
        <h1><?php echo esc_html__('CopyBlocker Pro', 'copyblocker-pro'); ?></h1>
        <?php echo $status_message; ?>
        <form method="post" action="options.php">
            <?php
            settings_fields('copyblocker_pro_settings_group');
            do_settings_sections('copyblocker_pro_settings_group');
            ?>
            <div class="settings-grid">
                <div class="setting-item">
                    <label class="checkbox-label">
                        <input type="checkbox" name="copyblocker_pro_disable_selection" value="1" <?php checked(1, get_option('copyblocker_pro_disable_selection', 0)); ?>>
                        <?php echo esc_html__('Disable Text Selection', 'copyblocker-pro'); ?>
                        <span class="tooltip">?</span>
                        <span class="tooltip-text"><?php echo esc_html__('Prevents users from selecting text on your website.', 'copyblocker-pro'); ?></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label class="checkbox-label">
                        <input type="checkbox" name="copyblocker_pro_block_copy" value="1" <?php checked(1, get_option('copyblocker_pro_block_copy', 0)); ?>>
                        <?php echo esc_html__('Block Copy (Ctrl+C / Cmd+C)', 'copyblocker-pro'); ?>
                        <span class="tooltip">?</span>
                        <span class="tooltip-text"><?php echo esc_html__('Disables copying text using keyboard shortcuts.', 'copyblocker-pro'); ?></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label class="checkbox-label">
                        <input type="checkbox" name="copyblocker_pro_block_select_all" value="1" <?php checked(1, get_option('copyblocker_pro_block_select_all', 0)); ?>>
                        <?php echo esc_html__('Block Select All (Ctrl+A / Cmd+A)', 'copyblocker-pro'); ?>
                        <span class="tooltip">?</span>
                        <span class="tooltip-text"><?php echo esc_html__('Prevents selecting all content with keyboard shortcuts.', 'copyblocker-pro'); ?></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label class="checkbox-label">
                        <input type="checkbox" name="copyblocker_pro_block_dev_tools" value="1" <?php checked(1, get_option('copyblocker_pro_block_dev_tools', 0)); ?>>
                        <?php echo esc_html__('Block Developer Tools (Ctrl+Shift+I / Cmd+Opt+I)', 'copyblocker-pro'); ?>
                        <span class="tooltip">?</span>
                        <span class="tooltip-text"><?php echo esc_html__('Attempts to block access to browser developer tools.', 'copyblocker-pro'); ?></span>
                    </label>
                </div>
                <div class="setting-item">
                    <label class="checkbox-label">
                        <input type="checkbox" name="copyblocker_pro_block_context_menu" value="1" <?php checked(1, get_option('copyblocker_pro_block_context_menu', 0)); ?>>
                        <?php echo esc_html__('Block Right-Click Context Menu', 'copyblocker-pro'); ?>
                        <span class="tooltip">?</span>
                        <span class="tooltip-text"><?php echo esc_html__('Disables the right-click menu for copying or inspecting.', 'copyblocker-pro'); ?></span>
                    </label>
                </div>
            </div>
            <?php submit_button(esc_html__('Save Settings', 'copyblocker-pro'), 'primary', 'submit', false); ?>
        </form>
        <div class="copyblocker-pro-support">
            <p><?php echo esc_html__('Enjoying CopyBlocker Pro? Support the developer with a coffee!', 'copyblocker-pro'); ?></p>
            <a href="https://buymeacoffee.com/5adat" target="_blank" rel="noopener noreferrer" class="coffee-button copyblocker-pro-bmc-button">
                <?php echo esc_html__('Buy Me a Coffee', 'copyblocker-pro'); ?>
            </a>
        </div>
    </div>
    <?php
}

// Enqueue admin styles
function copyblocker_pro_admin_styles($hook) {
    if ($hook !== 'settings_page_copyblocker-pro') {
        return;
    }
    wp_enqueue_style('copyblocker-pro-admin', plugins_url('assets/css/admin.css', dirname(__FILE__)), [], '1.0.0');
    wp_enqueue_style('copyblocker-pro-font', plugins_url('assets/css/fonts.css', dirname(__FILE__)), [], '1.0.0');
}
add_action('admin_enqueue_scripts', 'copyblocker_pro_admin_styles');
?>