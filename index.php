<?php
    require_once './database/connection.php';
    require_once './templates/common.php';
    require_once './news.php';

    $db = getDatabaseConnection();
    session_start();
    output_header();
    $articles = getAllNews($db);
    output_footer();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>