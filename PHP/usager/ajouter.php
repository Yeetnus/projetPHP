<?php require_once "../verification.php" ?>
<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8" />
  <title>Ajouter usager</title>
  <link rel="stylesheet" href="../../CSS/style.css">
  <link rel="icon" href="../../IMAGES/logo_cabinet.png">
</head>
<?php include "../../HTML/header.php"; ?>

<body>
  <div class="content-wrapper">
  <form action="../logout.php" method="post" >
          <input onclick='return confirm("Voulez-vous vraiment vous déconnecter ?")' id="logout" type="submit" value="Logout">
      </form>  
      <div class="login-box login-box-scrollable">
        <h2 class="h2page">Ajouter un usager</h2>
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
          <label>Date de naissance</label>
          <div class="user-box">
            <input type="date" name="dateN" required>
            
          </div>
          <div class="user-box">
            <input type="text" name="lieuN" required="">
            <label>Lieu de naissance</label>
          </div>
          <div class="user-box">
            <input type="text" name="numsecu" minlength="13" maxlength="13" required="">
            <label>Numéro de sécurité sociale</label>
          </div>
          <div>
          <label>Médecin référent</label>
          <?php
          require("../../BDD/BDDmedecin.php");
          $BDDmed = new BDDmedecin();
          $records = $BDDmed->select();

          echo "<select name='medid'>";
        
          while ($row = $records->fetch()) {
            $recordID = $row["ID"];
            echo "<option value='" . $row["ID"] . "'>" . $row["Nom"] . " " . $row["Prenom"] . "</option>";
          }

          // Close the select element
          echo "</select>"; ?>
          </div>
          <br>
          <div style="margin: 0 auto; text-align: center;">
          <button class="choice-button retour" id="retour" type="submit" name="Valider">Valider</button>
          <button class="choice-button retour" type="reset" name="Annuler" onclick="location.href='../../choix.php'">Annuler</button>
          <br>
          </div>
          <?php
          require("../../BDD/BDDusager.php");
          $BDD = new BDDusager();

          if (array_key_exists('Valider', $_POST)) {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $civ = $_POST['civ'];
            $adresse = $_POST['adresse'];
            $lieuN = $_POST['lieuN'];
            $numsecu = $_POST['numsecu'];
            $date = $_POST['dateN'];
            $dateN = new DateTime($date);
            $medid = $_POST['medid'];
            $BDD->insert($nom, $prenom, $civ, $adresse, $dateN, $lieuN, $numsecu, $medid);
            echo '<script>window.location.href="ajouter.php";</script>';
          }
          ?>
        </form>
      </div>
  </div>
  </div>
</body>

</html>