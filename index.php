<?php
    require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/database/connection.php';
    require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/templates/common.php';
    require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/news.php';

    $db = getDatabaseConnection();
    session_start();
    output_header();
    $articles = getAllNews($db);
    output_footer();
?>