<?php
require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/database/connection.php';
require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/templates/common.php';
require_once '/mnt/c/Users/nvamo/Desktop/EXERCISE IV/SQLite database/news.php';

session_start();

// Check if a user is not logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the main page
    header('Location: index.php'); // Replace with your main page
    exit;
} else {
    $articleId = $_GET['id'];

    $article = editArticle($articleId);

    if($article) {
        $title = $article['title'];
        $introduction = $article['introduction'];
        $fulltext = $article['fulltext'];
    } else {
        echo "Article not found!";
        exit;
    }
}

output_header();
?>
    
<form action="action_edit_news.php" method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?php echo $title; ?>" required>
    <br>

    <label for="introduction">Introduction:</label>
    <textarea name="introduction" id="introduction" rows="4" required><?php echo $introduction; ?></textarea>
    <br>

    <label for="fulltext">Full Text:</label>
    <textarea name="fulltext" id="fulltext" rows="8" required><?php echo $fulltext; ?></textarea>
    <br>

    <input type="hidden" name="article_id" value="<?php echo $articleId; ?>">

    <input type="submit" value="Save Changes">
</form>

<?php
    output_footer();
?>