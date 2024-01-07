<?php
require_once('database/connection.php');
require_once('database/news.php');
require_once('templates/common.php');
require_once('templates/news.php');

$db = getDatabaseConnection();
$articleId = $_GET['id'];

// Obter informações do artigo
$article = getArticleById($db, $articleId);

// Verificar se o artigo existe
if (!$article) {
    echo "Artigo não encontrado.";
    exit;
}

// Processar o envio do formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lógica para atualizar o artigo no banco de dados
    $newTitle = $_POST['title'];
    $newTags = $_POST['tags'];
    $newIntroduction = $_POST['introduction'];
    $newFullText = $_POST['fulltext'];

    // Adicione aqui a lógica para validar e filtrar os dados do formulário

    // Lógica para atualizar o artigo
    $success = updateArticle($db, $articleId, $newTitle, $newTags, $newIntroduction, $newFullText);

    if ($success) {
        echo "Artigo atualizado com sucesso!";
        // Redirecionar para a página do artigo após a edição
        header("Location: article.php?id={$articleId}");
        exit;
    } else {
        echo "Erro ao atualizar o artigo.";
    }
}

output_header();
output_edit_form($article);
output_footer();
?>