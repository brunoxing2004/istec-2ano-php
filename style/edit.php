<?php
// templates/edit.php

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