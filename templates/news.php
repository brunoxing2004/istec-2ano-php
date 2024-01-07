<?php
// news.php
function output_article_list($articles) {
    echo '<section id="news">';
    foreach ($articles as $article) {
        output_article($article);
    }
    echo '</section>';
}

function output_article($article) {
    $date = date('F j', $article['published']);
    $tags = explode(',', $article['tags']);

    echo '<article>
            <header>
              <h1><a href="article.php?id=' . $article['id'] . '">' . $article['title'] . '</a></h1>
            </header>
            <p>' . $article['introduction'] . '</p>
            <footer>
              <span class="author">' . $article['username'] . '</span>
              <span class="tags">' . output_tags($tags) . '</span>
              <span class="date">' . $date . '</span>
              <a class="comments" href="article.php?id=' . $article['id'] . '#comments">' . $article['comments'] . '</a>
            </footer>
          </article>';
}

function output_tags($tags) {
    $tagLinks = array_map(function ($tag) {
        return '<a href="index.php#' . $tag . '">#' . $tag . '</a>';
    }, $tags);

    return implode(' ', $tagLinks);
}
function output_edit_form($article) {
    echo '<h2>Edit Article</h2>';
    echo '<form method="post" action="">';
    echo '<label for="title">Title:</label>';
    echo '<input type="text" name="title" value="' . htmlspecialchars($article['title']) . '"><br>';
    echo '<label for="tags">Tags:</label>';
    echo '<input type="text" name="tags" value="' . htmlspecialchars($article['tags']) . '"><br>';
    echo '<label for="introduction">Introduction:</label>';
    echo '<textarea name="introduction">' . htmlspecialchars($article['introduction']) . '</textarea><br>';
    echo '<label for="fulltext">Full Text:</label>';
    echo '<textarea name="fulltext">' . htmlspecialchars($article['fulltext']) . '</textarea><br>';
    echo '<input type="submit" value="Save Changes">';
    echo '</form>';
}
?>