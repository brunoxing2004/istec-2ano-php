<?php
require_once('./templates/common.php');

output_header();
?>

<h2>Login</h2>
<form method="post" action="login_process.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>
    
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Login">
</form>

<?php
output_footer();
?>
