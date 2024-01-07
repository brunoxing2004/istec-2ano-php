<?php
require_once('./database/connection.php');
require_once('./database/news.php');
require_once('./templates/common.php');
require_once('./templates/edit_form.php');

$db = getDatabaseConnection();
$articleId = $_GET['id'];
$article = getArticleById($db, $articleId);

output_header();
output_edit_form($article);
output_footer();
?>