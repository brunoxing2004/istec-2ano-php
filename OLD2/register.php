<?php
include 'config.php';

session_start();
$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtenha os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $userType = $_POST['user_type']; // Obtém o tipo de usuário do campo de seleção

    try {
        // Encriptar a senha usando password_hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Execute a instrução SQL de inserção
        $insertQuery = $db->prepare("INSERT INTO users (username, password, email, user_type) VALUES (:username, :password, :email, :user_type)");

        $insertQuery->bindParam(':username', $username);
        $insertQuery->bindParam(':password', $hashedPassword);
        $insertQuery->bindParam(':email', $email);
        $insertQuery->bindParam(':user_type', $userType);

        $result = $insertQuery->execute();

        if ($result === false) {
            throw new Exception("Erro ao inserir o registro: " . print_r($insertQuery->errorInfo(), true));
        }

        echo "Registro inserido com sucesso!";
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style_register.css">
</head>
<body>

<div class="container">
    <h2>Registration Form</h2>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="user_type">User Type:</label>
        <select id="user_type" name="user_type" required>
            <option value="cliente">Cliente</option>
            <option value="admin">Admin</option>
        </select>

        <input type="submit" value="Register">
    </form>

    <button class="back-button" onclick="window.location.href='index.php'">Back to Login</button>
</div>

</body>
</html>
