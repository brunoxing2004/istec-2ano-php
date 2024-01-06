<?php
    require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/database/connection.php';

    session_start();

    $stmt = getDatabaseConnection()->prepare('SELECT * FROM users');

    $stmt->execute();
    $usersArray = $stmt->fetchAll();
?>