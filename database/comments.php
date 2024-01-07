<?php
    require_once './database/connection.php';

    function comments() {
        // COMMENTS INFO
        $stmt = getDatabaseConnection()->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
        $stmt->execute(array($_GET['id']));
        $comments = $stmt->fetchAll();

        // COMMMENTS
            if ($comments) {
                echo '<h3>Comments</h3>';
                foreach ($comments as $comment) {
                    echo '<p>Comment by: ' . $comment['username'] . '<br>' .$comment['text'] . '</p>';
                }
            } else {
                echo '<p>No comments</p>';
            }
    }
?>