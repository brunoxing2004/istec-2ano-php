<?php
function registerUser($db, $username, $password, $name) {
    try {
        $stmt = $db->prepare('INSERT INTO users (username, password, name) VALUES (?, ?, ?)');
        $stmt->execute([$username, $password, $name]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function loginUser($db, $username, $password) {
    // Adicione a lógica para verificar as credenciais e iniciar a sessão
    // Use password_verify para verificar a senha
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
