<?php
// comments.php
function output_comments($comments) {
    echo '<section id="comments">
            <h2>Comments</h2>';
    foreach ($comments as $comment) {
        echo '<div class="comment">
                <span class="author">' . $comment['username'] . '</span>
                <span class="date">' . date('F j, Y H:i', $comment['published']) . '</span>
                <p>' . $comment['text'] . '</p>
              </div>';
    }
    echo '</section>';
}
?>