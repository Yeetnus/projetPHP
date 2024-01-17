<?php require_once '../verification.php' ?>
<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8" />
  <title>Ajouter médecin</title>
  <link rel="stylesheet" href="../../CSS/style.css">
  <link rel="icon" href="../../IMAGES/logo_cabinet.png">
</head>
<?php include "../../HTML/header.php"; ?>

<body>
  <div class="content-wrapper" >
    <form action="../logout.php" method="post" >
          <input onclick='return confirm("Voulez-vous vraiment vous déconnecter ?")' id="logout" type="submit" value="Logout">
        </form>
      <div class="login-box">
        
        <h2 class="h2page">Ajouter un médecin</h2>
        <form action="#" method="post" class="formulaire">
          <div class="user-box">
            <input type="text" name="nom" required="">
            <label>Nom</label>
          </div>
          <div class="user-box">
            <input type="text" name="prenom" required="">
            <label>Prénom</label>
          </div>
          <div class="user-box">
            <input type="text" name="civ" required="">
            <label>Civlité</label>
          </div>
          <button class="retour" type="submit" name="Valider">Valider</button>
          <button class="retour" type="reset" name="Annuler" onclick="location.href='../../choix.php'">Annuler</button>
          <?php
          require("../../BDD/BDDmedecin.php");
          $BDD = new BDDmedecin();

          if (array_key_exists('Valider', $_POST)) {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $civ = $_POST['civ'];
            $BDD->insert($nom, $prenom, $civ);
            echo '<script>window.location.href="ajouter.php";</script>';
          }

          ?>
        </form>
      </div>
  </div>
</body>
</html>