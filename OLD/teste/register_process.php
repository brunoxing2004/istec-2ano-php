<?php
require_once('./database/connection.php');

function validateRegistrationData($username, $password, $name) {
    // Adicione validações adicionais conforme necessário
    if (empty($username) || empty($password) || empty($name)) {
        return false;
    }

    return true;
}

function registerUser($username, $password, $name) {
    $db = getDatabaseConnection();

    if (!$db) {
        // Trate o erro se a conexão com o banco de dados falhar
        die("Erro na conexão com o banco de dados.");
    }

    try {
        // Verifique se o usuário já existe
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Usuário já existe
            return false;
        }

        // Hash da senha
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Inserir novo usuário
        $stmt = $db->prepare('INSERT INTO users (username, password, name) VALUES (:username, :password, :name)');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        return true; // Registro bem-sucedido
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
    $name = $_POST['name'];

    // Validar dados de registro
    if (validateRegistrationData($username, $password, $name)) {
        // Registrar usuário
        if (registerUser($username, $password, $name)) {
            // Registro bem-sucedido - redirecionar para a página principal ou outra página desejada
            header("Location: index.php");
            exit();
        } else {
            // Usuário já existe - exibir mensagem de erro ou redirecionar para a página de registro
            echo "Erro: Usuário já existe. Por favor, escolha outro nome de usuário.";
            exit();
        }
    } else {
        // Dados de registro inválidos - exibir mensagem de erro ou redirecionar para a página de registro
        echo "Erro: Preencha todos os campos corretamente.";
        exit();
    }
}

// Se chegou até aqui sem submissão do formulário, redirecionar para a página inicial
header("Location: index.php");
exit();
?>
