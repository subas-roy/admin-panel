<?php
$settings = get_option('admin_panel_settings', []); // Retrieve the saved settings from the database, or return an empty array if no settings are found
$status = $_GET['status'] ?? ''; // Get the 'status' parameter from the URL query string, or set it to an empty string if it's not present
// echo $status;
?>
<h1><?php esc_html_e('Admin Panel Settings', 'admin-panel'); ?></h1>

<?php if ($status === 'success') : ?>
  <div><p><?php esc_html_e('Settings saved successfully!', 'admin-panel'); ?></p></div>
<?php endif; ?>

<form id="admin-panel-form" method="post" action="<?php echo admin_url('admin-post.php') ?>">
  <input type="text" name="name" value="<?php echo $settings['name'] ?? '' ?>" placeholder="<?php esc_attr_e('Your Name', 'admin-panel'); ?>">
  <input type="email" name="email" value="<?php echo $settings['email'] ?? '' ?>" placeholder="<?php esc_attr_e('Your Email', 'admin-panel'); ?>">
  <input type="number" name="age" value="<?php echo $settings['age'] ?? '' ?>" placeholder="<?php esc_attr_e('Your Age', 'admin-panel'); ?>">
  <textarea name="message" placeholder="<?php esc_attr_e('Write your message', 'admin-panel'); ?>" rows="5" cols="30"><?php echo $settings['message'] ?? '' ?></textarea>
  <input type="hidden" name="action" value="save_admin_panel_settings">
  <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('admin_panel_nonce'); ?>">
  <input type="submit" name="secure_form_submit" value="<?php esc_attr_e('Submit', 'admin-panel'); ?>">
</form>