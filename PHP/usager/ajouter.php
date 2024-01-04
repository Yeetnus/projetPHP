<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8" />
  <title>Page de test</title>
  <link rel="stylesheet" href="../../CSS/style.css">
</head>
<?php include "../../HTML/header.php"; ?>

<body>
  <div class="content-wrapper" >
    <div class="content">
      <div class="scrollable-div login-box">
        <h2>Ajouter un usager</h2>
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
          <div class="user-box">
            <input type="text" name="adresse" required="">
            <label>Adresse</label>
          </div>
          <div class="user-box">
            <input type="date" name="dateN" required="">
            <label>Date de naissance</label>
          </div>
          <div class="user-box">
            <input type="text" name="lieuN" required="">
            <label>Lieu de naissance</label>
          </div>
          <div class="user-box">
            <input type="text" name="numsecu" minlength="13" maxlength="13" required="">
            <label>Numéro de sécurité sociale</label>
          </div>
          <button class="choice-button retour" id="retour" type="submit" name="Valider">Valider</button>
          <button class="choice-button retour" type="reset" name="Annuler">Annuler</button>
          <?php
          require("../../BDD/BDDmedecin.php");
          $BDD = new BDDusager();

          if (array_key_exists('Valider', $_POST)) {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $civ = $_POST['civ'];
            $adresse = $_POST['adresse'];
            $dateN = $_POST['dateN'];
            $lieuN = $_POST['lieuN'];
            $numsecu = $_POST['numsecu'];
            $BDD->insert($nom, $prenom, $civ, $adresse, $dateN, $lieuN, $numsecu);
            echo '<script>window.location.href="ajouter.php";</script>';
          }

          ?>
        </form>
      </div>
    </div>
  </div>
</body>
</html>