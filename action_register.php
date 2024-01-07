<?php
require_once './database/connection.php';
session_start(); // sessão do user

// verifica se foi recebido post, caso contrário, erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // lê o POST recebido
    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];
    $submittedName = $_POST['name'];

    // hash da password com bcrypt
    $hashedPassword = password_hash($submittedPassword, PASSWORD_BCRYPT);

    // inserção de novo user na bd
    $db = getDatabaseConnection(); // connection.php
    $query = "INSERT INTO users (username, password, name) VALUES (:username, :password, :name)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $submittedUsername);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':name', $submittedName);

    if ($stmt->execute()) {
        // registo com sucesso
        echo 'User registered successfully';
    } else {
        // falha com echo
        echo 'Error registering user';
    }
} else {
    // sem post, vai para o index
    header('Location: index.php');
    exit;
}
?>
