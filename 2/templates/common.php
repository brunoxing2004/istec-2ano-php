<?php function output_header() { ?>

    <head>
        <title>Super Legit News</title>    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style/style.css" rel="stylesheet">
        <link href="style/layout.css" rel="stylesheet">
        <link href="style/responsive.css" rel="stylesheet">
        <link href="style/comments.css" rel="stylesheet">
        <link href="style/forms.css" rel="stylesheet">
    </head>

    <body>
        <header>
        <h1><a href="index.php">Super Legit News</a></h1>
        <h2><a href="index.php">Where fake news are born!</a></h2>
        <div id="signup">
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        </div>
        </header>

        <nav id="menu">
            <input type="checkbox" id="hamburger"> 
            <label class="hamburger" for="hamburger"></label>
            <ul>
                <li><a href="index.php">Local</a></li>
                <li><a href="index.php">World</a></li>
                <li><a href="index.php">Politics</a></li>
                <li><a href="index.php">Sports</a></li>
                <li><a href="index.php">Science</a></li>
                <li><a href="index.php">Weather</a></li>
            </ul>
        </nav>
    </body>
<?php } ?>

<?php function output_footer() { ?>
    <body>
        <footer>
            <p>&copy; Fake News, 2022</p>
        </footer>
    </body>
<?php } ?>

<?php
    function editArticle() {
        $stmt = getDatabaseConnection()->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = :id');
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        $article = $stmt->fetch();
        return $article;
    }
?>