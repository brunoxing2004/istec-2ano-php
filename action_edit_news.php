<?php
require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/database/connection.php';
require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/news.php';

// action_edit_article.php
session_start(); // Start the session

// Check if a user is not logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the main page
    header('Location: index.php'); // Replace with your main page
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
        header("Location: error_page.php");
        exit;
    }
}
?>
