<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="CSS/styleindex.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="IMAGES/logo_cabinet.png">
  <title>Connexion</title>
</head>

<body>
  <div class="login-box">
    <h2>Page de connexion</h2>
    <form action="login.php" method="post">
      <div class="user-box">
        <input type="text" id="username" name="username" required>
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" id="password" name="password" required>
        <label>Password</label>
      </div>
      <?php if (isset($_GET['error'])): ?>
        <p class="error-message" style="color: red;">Le nom d'utilisateur ou le mot de passe est incorrect.</p>
      <?php endif; ?>
      <input name="Login" type="submit" value="Login" class="choice-button retour">
    </form>
  </div>
</body>

</html>