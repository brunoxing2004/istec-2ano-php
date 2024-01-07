<?php
require_once('templates/common.php');

output_header();
?>

<h2>Register</h2>
<form method="post" action="register_process.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <label for="name">Name:</label>
    <input type="text" name="name" required><br>

    <input type="submit" value="Register">
</form>

<?php
output_footer();
?>
