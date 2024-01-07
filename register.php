<?php
require_once './templates/common.php';
session_start();

// Incluir o código de registro
require_once 'action_register.php';

output_header();
?>

<form action="action_register.php" method="post">
    <label>
        Username <input type="text" name="username">
    </label>
    <label>
        Password <input type="password" name="password">
    </label>
    <input type="submit" value="Register">
</form>

<?php
output_footer();
?>
