<?php
    function getDatabaseConnection() {
        $db = new PDO('sqlite:./news.db');
        return $db;
    }
?>