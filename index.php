<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
  </head>
  <body>
    <div class="login-box" >
      <form action="login.php" method="post">
        <div class="user-box">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="user-box">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" value="Login">
      </form>
      </div>
  </body>
</html>