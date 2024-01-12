<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
  </head>
  <body>
    <div class="scrollable-div login-box" >
      <h2>Page de connexion</h2>
      <form action="login.php" method="post" class="formulaire">
        <div class="user-box">
          <input type="text" id="username" name="username" required>
          <label>Username</label>
        </div>
        <div class="user-box">
          <input type="password" id="password" name="password" required>
          <label>Password</label>
        </div>
        <input type="submit" value="Login" class="choice-button retour  ">
      </form>
      </div>
  </body>
</html>