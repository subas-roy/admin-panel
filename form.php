<h1>Admin Panel Settings</h1>
<form id="admin-panel-form" method="post" action="<?php echo admin_url('admin-post.php') ?>">
  <input type="text" name="name" placeholder="Your Name">
  <input type="email" name="email" placeholder="Your Email">
  <input type="number" name="age" placeholder="Your Age">
  <textarea name="message" placeholder="Write your message" rows="5" cols="30"></textarea>
  <input type="hidden" name="action" value="save_admin_panel_settings">
  <input type="submit" name="secure_form_submit" value="Submit">
</form>