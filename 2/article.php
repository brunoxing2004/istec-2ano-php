<?php
    require_once './database/connection.php';
    require_once './database/comments.php';
    require_once './templates/common.php';
    require_once './news.php';
    
    session_start();
    output_header();
    if (isset($_SESSION['username'])) {
        fullArticle();
    }
    comments();
    output_footer();
?>