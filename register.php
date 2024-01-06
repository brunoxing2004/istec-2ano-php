
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Super Legit News</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="register.css" rel="stylesheet">
    <link href="layout.css" rel="stylesheet">
    <link href="responsive.css" rel="stylesheet">
    <link href="comments.css" rel="stylesheet">
    <link href="forms.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <h1><a href="index.html">Super Legit News</a></h1>
      <h2><a href="index.html">Where fake news are born!</a></h2>
      <div id="signup">
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
      </div>
    </header>
      <!-- just for the hamburguer menu in responsive layout -->
      <input type="checkbox" id="hamburger"> 
      <label class="hamburger" for="hamburger"></label>
      <nav id="menu">
      <ul>
        <li><a href="index.html">Local</a></li>
        <li><a href="index.html">World</a></li>
        <li><a href="index.html">Politics</a></li>
        <li><a href="index.html">Sports</a></li>
        <li><a href="index.html">Science</a></li>
        <li><a href="index.html">Weather</a></li>
      </ul>
    </nav>
    <section id="register">
      <h1>Register</h1>
      <form>
        <label>
          Username <input type="text" name="username">
        </label>
        <label>
          E-mail <input type="email" name="email">
        </label>
        <label>
          Password <input type="password" name="password">
        </label>
        <button formaction="#" formmethod="post">Register</button>
      </form>
    </section>
    <footer>
      <p>&copy; Fake News, 2022</p>
    </footer>
  </body>
</html>