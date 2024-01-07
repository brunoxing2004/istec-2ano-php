<?php
require_once('./database/connection.php');
require_once('./database/news.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleId = $_POST['id'];
    $newTitle = $_POST['title'];
    $newFulltext = $_POST['fulltext'];

    // Atualizar os dados do artigo
    updateArticle($db, $articleId, $newTitle, $newFulltext);

    // Redirecionar de volta para a página do artigo após a atualização
    header("Location: article.php?id=$articleId");
    exit;
} else {
    // Se não for uma solicitação POST, redirecione para a página inicial
    header("Location: index.php");
    exit;
}
?>
