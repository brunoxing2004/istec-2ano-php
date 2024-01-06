<?php
    function getDatabaseConnection() {
        $db = new PDO('sqlite:/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/database/news.db');
        return $db;
    }
?>