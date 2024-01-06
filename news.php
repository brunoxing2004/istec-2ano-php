<?php
    require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/database/connection.php'; 
?>

<?php function getAllNews() { ?>
            
<section id="news">
    <article>

<?php
    $stmt = getDatabaseConnection()->prepare('SELECT news.*, users.*, COUNT(comments.id) AS comments
    FROM news JOIN
        users USING (username) LEFT JOIN
        comments ON comments.news_id = news.id
    GROUP BY news.id, users.username
    ORDER BY published DESC');

    $stmt->execute();
    $newsArray = $stmt->fetchAll();

    foreach ($newsArray as $news) {
        echo "<head>";
        echo '<h1>' . $news['title'] . '</h1>';
        echo "</head>";

        echo '<p>' . $news['fulltext'] . '</p>';

        echo '<span class="author">' . $news['name'] . '</span>';

        echo "<footer>";
        echo '<span class="author">' . $news['name'] . '</span>';

        $tags = explode(',', $news['tags']);
        foreach ($tags as $tags) {
            echo '<span class="tags">' . $tags . '</span>';
        }

        $date = date('F j', $news['published']);
        echo '<span class="date">' . $date . '</span>';
        echo '<span class="comments"><a href="article.php?id=' . $news['id'] . '">' . $news['comments'] . '</a></span>';
        echo "</footer>";
    }
?>
<?php } ?>

    </article>
</section>

<?php
    function fullArticle(){
        session_start();
        if (!isset($_SESSION['username'])) {
            // If not logged in, redirect to the main page
            header('Location: index.php'); // Replace with your main page
            exit;
        } else {
        // ARTICLE INFO
        $stmt = getDatabaseConnection()->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = :id');
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        $article = $stmt->fetch();

        // ARTICLE
        echo '<h2>' . $article['title'] . '</h2>';
        echo '<p>' . $article['fulltext'] . '</p>';
        echo '<a href="index.php">Main</a> | <a href="edit_article.php?id=' . $article['id'] . '">Edit article</a> ';
        }
    }
?>

<?php
    $db = getDatabaseConnection();
    function updateArticle($db, $articleId, $title, $introduction, $fulltext) {
        $stmt = $db->prepare('UPDATE news SET title = :title, introduction = :introduction, fulltext = :fulltext WHERE id = :id');
        
        $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':introduction', $introduction);
        $stmt->bindParam(':fulltext', $fulltext);

        $stmt->execute();

        $stmt->closeCursor();
}
?>