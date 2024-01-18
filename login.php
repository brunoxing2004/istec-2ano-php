<?php
include 'config.php';

session_start();
$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $query = $db->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user !== false && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['client_id'] = $user['client_id'];

            if ($_SESSION['user_type'] == 'admin') {
                header("Location: admin_dashboard.php");
            } elseif ($_SESSION['user_type'] == 'cliente') {
                header("Location: client_dashboard.php");
            } else {
                echo "Unknown user type.";
            }
            exit;
        } else {
            $error_message = "Login failed. Check your credentials.";
        }
    } catch (PDOException $e) {
        echo "SQL Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <?php
    if (isset($error_message)) {
        echo '<p class="error-message">' . $error_message . '</p>';
    }
    ?>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>

    <button onclick="window.location.href='index.php'">Back</button>
</div>

</body>
</html>
