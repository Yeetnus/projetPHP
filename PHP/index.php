<?php
session_start();
$error = '';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'my_database');

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sécurisation des données saisies par l'utilisateur
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Recherche de l'utilisateur dans la base de données
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    // Vérification si l'utilisateur existe
    if ($result->num_rows > 0) {
        // Vérification du mot de passe
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Si le mot de passe est correct, créer une session et rediriger l'utilisateur
            $_SESSION['username'] = $username;
            header('Location: welcome.php');
        } else {
            $error = 'Le mot de passe est incorrect.';
        }
    } else {
        $error = 'Le nom d\'utilisateur est incorrect.';
    }

    // Fermeture de la connexion
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page de connexion</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <h2>Connexion</h2>
    <form method="post" action="">
        <div><label>Nom d'utilisateur:</label> <input type="text" name="username" required></div>
        <div><label>Mot de passe:</label> <input type="password" name="password" required></div>
        <div><input type="submit" name="login" value="Se connecter"></div>
    </form>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
</body>
</html>