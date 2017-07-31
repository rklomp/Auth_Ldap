<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
      <title>Logout</title>
  </head>
  <body>
    <?php if ($logged_in): ?>
      <p><?php echo $username; ?> has been logged out.</p>
      <p>Thanks for visiting <?php echo $name; ?></p>
    <?php else: ?>
      <p>You need to <?php echo anchor('/auth/login', 'login', ''); ?> before you log out...</p>
    <?php endif; ?>
  </body>
</html>
