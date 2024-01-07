<?php
require_once('./database/connection.php');
require_once('./database/news.php');
require_once('./database/comments.php');
require_once('./templates/common.php');
require_once('./templates/news.php');

$db = getDatabaseConnection();
$articleId = $_GET['id'];

// Processar o envio do formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adicione aqui a lógica para atualizar o artigo no banco de dados
    // Certifique-se de validar e filtrar os dados do formulário

    $newTitle = $_POST['title']; // Substitua 'title' pelo nome do campo no seu formulário
    $newContent = $_POST['content']; // Substitua 'content' pelo nome do campo no seu formulário

    // Adicione a lógica para atualizar o artigo no banco de dados
    updateArticle($db, $articleId, $newTitle, $newContent);

    // Redirecione para a página de visualização do artigo após a atualização
    header("Location: article.php?id={$articleId}");
    exit;
}

// Obter informações do artigo
$article = getArticleById($db, $articleId);

if (!$article) {
    // Adicione uma verificação para o caso em que o artigo não é encontrado
    echo "Artigo não encontrado.";
    exit;
}

// Obter comentários para o artigo
$comments = getCommentsByNewsId($db, $articleId);

output_header();
output_edit_form($article);
output_comments($comments);
output_footer(); // Certifique-se de que esta função seja chamada apenas uma vez
?>