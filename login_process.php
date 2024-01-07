<?php
require_once('./database/connection.php');

function checkCredentials($username, $password) {
    $db = getDatabaseConnection();

    if (!$db) {
        // Se a conexão com o banco de dados falhar, trate o erro aqui
        die("Erro na conexão com o banco de dados.");
    }

    try {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true; // Credenciais corretas
        } else {
            return false; // Credenciais incorretas
        }
    } catch (PDOException $e) {
        // Log ou tratar erro na execução da consulta
        die("Erro na execução da consulta: " . $e->getMessage());
    }
}

// Verificar se os dados do formulário foram submetidos (usando POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar as credenciais
    if (checkCredentials($username, $password)) {
        // Credenciais corretas - redirecionar para a página principal ou outra página desejada
        header("Location: index.php");
        exit();
    } else {
        // Credenciais incorretas - exibir uma mensagem de erro ou redirecionar para a página de login
        echo "Credenciais incorretas. Por favor, tente novamente.";
        exit();
    }
}

// Se chegou até aqui sem submissão do formulário, redirecionar para a página inicial
header("Location: index.php");
exit();
?>
