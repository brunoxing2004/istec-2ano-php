<?php
    require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/database/connection.php';
    require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/database/comments.php';
    require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/templates/common.php';
    require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/news.php';
    
    session_start();
    output_header();
    if (isset($_SESSION['username'])) {
        fullArticle();
    }
    comments();
    output_footer();
?>