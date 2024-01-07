<?php
require_once './database/connection.php';
require_once './news.php';

session_start(); // sessão cookies

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $articleId = $_POST['article_id'];
        $title = $_POST['title'];
        $introduction = $_POST['introduction'];
        $fulltext = $_POST['fulltext'];

        updateArticle($db, $articleId, $title, $introduction, $fulltext);

        header("Location: article.php?id=$articleId");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}
?>
