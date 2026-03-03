<?php
$settings = get_option('admin_panel_settings', []); // Retrieve the saved settings from the database, or return an empty array if no settings are found
$status = $_GET['status'] ?? ''; // Get the 'status' parameter from the URL query string, or set it to an empty string if it's not present
// echo $status;
?>
<h1>Admin Panel Settings</h1>

<?php if ($status === 'success') {
  echo '<div><p>Settings saved successfully!</p></div>';
} ?>

<form id="admin-panel-form" method="post" action="<?php echo admin_url('admin-post.php') ?>">
  <input type="text" name="name" value="<?php echo $settings['name'] ?? '' ?>" placeholder="Your Name">
  <input type="email" name="email" value="<?php echo $settings['email'] ?? '' ?>" placeholder="Your Email">
  <input type="number" name="age" value="<?php echo $settings['age'] ?? '' ?>" placeholder="Your Age">
  <textarea name="message" placeholder="Write your message" rows="5"
    cols="30"><?php echo $settings['message'] ?? '' ?></textarea>
  <input type="hidden" name="action" value="save_admin_panel_settings">
  <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('admin_panel_nonce'); ?>">
  <input type="submit" name="secure_form_submit" value="Submit">
</form>