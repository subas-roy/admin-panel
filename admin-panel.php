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
function admin_panel_menu_page()
{
  add_menu_page(
    __('Admin Panel', 'admin-panel'),
    __('Admin Panel', 'admin-panel'),
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

function admin_panel_save_settings() // This function will handle the form submission when the form is submitted. It will be triggered by the 'admin_post_save_admin_panel_settings' action.
{
  error_log('================================');
  error_log(print_r($_REQUEST, true));
  error_log('================================');
}

add_action('admin_post_save_admin_panel_settings', 'admin_panel_save_settings'); // Register the function to handle the form submission when the 'action' parameter in the form is set to 'save_admin_panel_settings'