<?php
    require_once './database/connection.php';

    session_start();

    $stmt = getDatabaseConnection()->prepare('SELECT * FROM users');

    $stmt->execute();
    $usersArray = $stmt->fetchAll();
?>