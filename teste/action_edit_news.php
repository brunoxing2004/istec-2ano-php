<?php
require_once('database/connection.php');
require_once('database/news.php');

$db = getDatabaseConnection();

// Verificar se os dados do formulário foram submetidos (usando POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $articleId = $_POST['id'];
    $title = $_POST['title'];
    $introduction = $_POST['introduction'];
    $fulltext = $_POST['fulltext'];

    // Atualizar os dados na base de dados
    updateNews($db, $articleId, $title, $introduction, $fulltext);

    // Redirecionar para a página do artigo
    header("Location: article.php?id=$articleId");
    exit();
}

// Se chegou até aqui sem submissão do formulário, redirecionar para a página inicial
header("Location: index.php");
exit();
?>