<?php
require_once('database/connection.php');

function getCommentsByNewsId($db, $articleId) {
    try {
        $stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = :id');
        $stmt->bindParam(':id', $articleId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao obter comentários: " . $e->getMessage());
    }
}

function comments($articleId) {
    // Obtenha a conexão com o banco de dados aqui
    $db = getDatabaseConnection();

    // COMMENTS INFO
    $stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
    $stmt->execute(array($articleId));
    $comments = $stmt->fetchAll();

    // COMMENTS
    if ($comments) {
        echo '<h3>Comments</h3>';
        foreach ($comments as $comment) {
            echo '<p>Comment by: ' . $comment['username'] . '<br>' . $comment['text'] . '</p>';
        }
    } else {
        echo '<p>No comments</p>';
    }
}

// Chame a função com o ID do artigo
comments($_GET['id']);
?>