<?php

session_start();
require_once('./templates/common.php');
require_once('./templates/register.php');
require_once('./database/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    $db = getDatabaseConnection();

    // Verifique se o usuário já existe
    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        // Exiba uma mensagem de erro se o usuário já existir
        echo "Usuário já existe. Escolha outro nome de usuário.";
    } else {
        // Insira o novo usuário no banco de dados
        $stmt = $db->prepare('INSERT INTO users (username, password, name) VALUES (:username, SHA1(:password), :name)');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        // Inicie a sessão e armazene o nome do usuário
        session_start();
        $_SESSION['username'] = $username;

        // Redirecione para a página de login após o registro bem-sucedido
        header("Location: index.php");
        exit();
    }
}

// Redirecione para a página de registro em caso de acesso direto
header("Location: register.php");
exit();
?>
