<?php
// action_register.php
session_start(); // Inicia a sessão

// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados submetidos no formulário
    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];

    // Validação básica (substitua por sua lógica de validação)
    if (strlen($submittedUsername) < 4 || strlen($submittedPassword) < 6) {
        // Exibe uma mensagem de erro se os dados não atenderem aos critérios
        echo 'Nome de usuário deve ter pelo menos 4 caracteres e senha deve ter pelo menos 6 caracteres.';
    } else {
        // Processo de registro bem-sucedido
        // Salve os dados do usuário no banco de dados ou em algum armazenamento permanente

        // Use a função password_hash para criar um hash seguro da senha
        $hashedPassword = password_hash($submittedPassword, PASSWORD_BCRYPT);

        // Por exemplo, você pode usar um arquivo simples para armazenar os dados (não é a melhor prática, apenas para exemplo)
        $userData = sprintf("Username: %s, Hashed Password: %s", $submittedUsername, $hashedPassword);
        file_put_contents('user_data.txt', $userData . PHP_EOL, FILE_APPEND);

        // Redireciona para a página de login ou qualquer outra página desejada
        header("Location: login.php");
        exit;
    }
} else {
    // Se o formulário não foi enviado via POST, redirecione para uma página de erro ou outro local apropriado
    header('Location: index.php');
    exit;
}
?>
