<?php
  //require_once './templates/common.php';
  session_start();
  output_header();
?>

<html lang="en-US">
  <head>
    <title>Super Legit News</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/style.css" rel="stylesheet">
    <link href="./style/register.css" rel="stylesheet">
    <link href="./style/layout.css" rel="stylesheet">
    <link href="./style/responsive.css" rel="stylesheet">
    <link href="./style/comments.css" rel="stylesheet">
    <link href="./style/forms.css" rel="stylesheet">
  </head>
  <body>
    </nav>
    <section id="register">
      <h1>Register</h1>
      <form action="action_login.php" method="post">
        <label>
          Username <input type="text" name="username">
        </label>
        <label>
          Password <input type="password" name="password">
        </label>
        <input formaction="" type="submit" value="Login">
      </form>
    </section>
    <?php
    output_footer();
    ?>
  </body>
</html>