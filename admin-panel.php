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
  echo '<div class="wrap"><h1>' . __('Welcome to the Admin Panel', 'admin-panel') . '</h1><p>' . __('This is a demo plugin to demonstrate an admin panel in WordPress.', 'admin-panel') . '</p></div>';
}