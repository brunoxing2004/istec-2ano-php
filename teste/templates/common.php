<?php
function output_header() {
    session_start();
    echo '<!DOCTYPE html>
    <html lang="en-US">
      <head>
        <title>Super Legit News</title>    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet">
        <link href="layout.css" rel="stylesheet">
        <link href="responsive.css" rel="stylesheet">
        <link href="comments.css" rel="stylesheet">
        <link href="forms.css" rel="stylesheet">
      </head>
      <body>
        <header>
          <h1><a href="index.php">Super Legit News</a></h1>
          <h2><a href="index.php">Where fake news are born!</a></h2>
          <div id="signup">';

    // Verificar se o usuário está autenticado
    if (isset($_SESSION['username'])) {
        echo '<a href="logout.php">Logout</a>';
    } else {
        echo '<a href="register.php">Register</a>
              <a href="login.php">Login</a>';
    }

    echo '</div>
        </header>

        <input type="checkbox" id="hamburger"> 
        <label class="hamburger" for="hamburger"></label>
        <nav id="menu">
          <ul>
            <li><a href="index.php">Local</a></li>
            <li><a href="index.php">World</a></li>
            <li><a href="index.php">Politics</a></li>
            <li><a href="index.php">Sports</a></li>
            <li><a href="index.php">Science</a></li>
            <li><a href="index.php">Weather</a></li>
          </ul>
        </nav>';
}

function output_footer($tags) {
    echo '<div class="footer">';
    // Supondo que $tags seja um array com as tags do artigo
    foreach ($tags as $tag) {
        echo '<span class="tag">' . $tag . '</span>';
    }
    echo '</div>';
}
?>
