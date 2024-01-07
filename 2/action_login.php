<?php
require_once './database/connection.php';
session_start();// sessão do user

// verifica se foi recebido post, caso contrário, erro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // lê o POST recebido
    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];

    // validar user na db
    $db = getDatabaseConnection(); // connection.php
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $submittedUsername);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // password_verify para desencriptar
        if (password_verify($submittedPassword, $user['password'])) {
            // sucesso na auth
            $_SESSION['username'] = $submittedUsername; // coloca user no cookie de sessão

            // debug e redirect
            //$previousPage = $_SERVER['HTTP_REFERER'];
            //header("Location: index.php");
            exit;
        } else {
            // falha hash diferente
            echo 'Invalid username or password';

            //debug, não essencial
            //ini_set('display_errors', 1);
            //ini_set('display_startup_errors', 1);
            //error_reporting(E_ALL);
        }
    } else {
        // user não existe
        echo 'Invalid username or password';
        //debug de random redirect
        //ini_set('display_errors', 1);
        //ini_set('display_startup_errors', 1);
        //error_reporting(E_ALL);
    }
} else {
    // sem post, vai para o index
    header('Location: index.php');
    exit;
}
?>
