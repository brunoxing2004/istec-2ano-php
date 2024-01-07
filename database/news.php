<?php
require_once('database/connection.php');

function getArticleById($db, $articleId) {
    try {
        $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = :id');
        $stmt->bindParam(':id', $articleId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao obter artigo: " . $e->getMessage());
    }
}

function getAllNews($db) {
    try {
        $stmt = $db->query('SELECT news.*, users.*, COUNT(comments.id) AS comments
                           FROM news
                           JOIN users USING (username)
                           LEFT JOIN comments ON comments.news_id = news.id
                           GROUP BY news.id, users.username
                           ORDER BY published DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao obter todas as notícias: " . $e->getMessage());
    }
}

function updateArticle($db, $articleId, $newTitle, $newContent) {
    try {
        $stmt = $db->prepare('UPDATE news SET title = :title, fulltext = :content WHERE id = :id');
        $stmt->bindParam(':id', $articleId);
        $stmt->bindParam(':title', $newTitle);
        $stmt->bindParam(':content', $newContent);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Erro ao atualizar artigo: " . $e->getMessage());
    }
}

?>