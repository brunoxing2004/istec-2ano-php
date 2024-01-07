<?php
    function getDatabaseConnection() {
        $db = new PDO('sqlite:./database/news.db');
        return $db;
    }
?>