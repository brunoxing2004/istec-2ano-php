<?php
  require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/templates/common.php';
  session_start();
  output_header();
?>

<form action="action_login.php" method="post">
  <label>
    Username <input type="text" name="username">
  </label>
  <label>
    Password <input type="password" name="password">
  </label>
  <input formaction="#" type="submit" value="Login">
</form>

<?php
  output_footer();
?>