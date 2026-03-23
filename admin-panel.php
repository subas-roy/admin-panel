<?php
/*
 * Plugin Name:       Admin Panel
 * Plugin URI:        https://github.com/subas-roy/
 * Description:       A demo plugin to demostrate admin panel in WordPress.
 * Version:           1.0
 * Requires at least: 6.8
 * Requires PHP:      8.0
 * Author:            Subas Roy
 * Author URI:        https://github.com/subas-roy/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       admin-panel
 */

/**
 * Register a custom menu page.
 */

add_action('plugins_loaded', 'admin_panel_init_plugin');
function admin_panel_init_plugin()
{
  load_plugin_textdomain('admin-panel', false, plugin_dir_path(__FILE__) . 'i18n/');
}

function admin_panel_menu_page()
{
  add_menu_page(
    esc_html('Admin Panel', 'admin-panel'),
    esc_html('Admin Panel', 'admin-panel'),
    'manage_options',
    'admin-panel',
    'admin_panel_content',
    'dashicons-admin-site-alt2',
  );
}
add_action('admin_menu', 'admin_panel_menu_page');
function admin_panel_content()
{
  echo '<div class="wrap">';
  include plugin_dir_path(__FILE__) . 'form.php';
  echo '</div>';
}

function admin_panel_enqueue_assets($hook)
{
  if ($hook !== 'toplevel_page_admin-panel') { // Only load assets on our plugin's admin page for better performance
    return;
  }
  wp_enqueue_style('admin-panel', plugin_dir_url(__FILE__) . 'admin-style.css', [], '1.0.0', 'all');
  wp_enqueue_script('admin-panel', plugin_dir_url(__FILE__) . 'admin-script.js', ['jquery'], '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'admin_panel_enqueue_assets');

function admin_panel_save_settings()
{
  if (!wp_verify_nonce($_REQUEST['nonce'], 'admin_panel_nonce')) {
    wp_safe_redirect(admin_url('admin.php?page=admin-panel&status=unauthorized'));
  }

  if (!is_string($_REQUEST['name'])) {
    wp_safe_redirect(admin_url('admin.php?page=admin-panel&status=invalid-name'));
  }
  if (!is_email($_REQUEST['email'])) {
    wp_safe_redirect(admin_url('admin.php?page=admin-panel&status=invalid-email'));
  }
  if (!is_numeric($_REQUEST['age'])) {
    wp_safe_redirect(admin_url('admin.php?page=admin-panel&status=invalid-age'));
  }
  if (!is_string($_REQUEST['message'])) {
    wp_safe_redirect(admin_url('admin.php?page=admin-panel&status=invalid-message'));
  }

  $sanitize = [];
  $sanitize['name'] = sanitize_text_field($_REQUEST['name']);
  $sanitize['email'] = sanitize_email($_REQUEST['email']);
  $sanitize['age'] = intval($_REQUEST['age']);
  $sanitize['message'] = sanitize_textarea_field($_REQUEST['message']);

  update_option('admin_panel_settings', $sanitize);

  wp_safe_redirect(admin_url('admin.php?page=admin-panel&status=success'));
}
add_action('admin_post_save_admin_panel_settings', 'admin_panel_save_settings'); // Register the function to handle the form submission when the 'action' parameter in the form is set to 'save_admin_panel_settings'