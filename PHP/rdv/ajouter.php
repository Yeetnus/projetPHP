<?php require_once "../verification.php" ?>
<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8" />
  <title>Ajouter consultation</title>
  <link rel="stylesheet" href="../../CSS/style.css">
  <link rel="icon" href="../../IMAGES/logo_cabinet.png">
</head>
<?php include "../../HTML/header.php"; ?>

<body>
  <div class="content-wrapper">
      <div class="login-box ">
        <h2 class="h2ajout">Ajouter une consultation</h2>
        <form action="#" method="post" class="formulaire">
          <label>Date & heure</label>
          <div class="user-box">
            <input type="datetime-local" name="dateheure" required="">
            
          </div>
          <div class="user-box">
            <input type="number" name="duree" min="30" max="60" step="5" required="">
            <label>Durée</label>
          </div>

          <label>Usager</label>
          <div class="user-box">
          <?php
          require_once("../../BDD/BDDusager.php");
          $BDDusa = new BDDusager();
          $records = $BDDusa->select();

          echo "<select name='usaid'>";
        
          while ($row = $records->fetch()) {
            $recordIDusa = $row["ID"];
            echo "<option value='" . $row["ID"] . "'>" . $row["Nom"] . " " . $row["Prenom"] . "</option>";
          }

          // Close the select element
          echo "</select>"; ?>
          </div>

          
          <label>Médecin</label>
          <div class="user-box">
          <?php
          require_once("../../BDD/BDDmedecin.php");
          $BDDmed = new BDDmedecin();
          $records = $BDDmed->select();

          echo "<select name='medid'>";
        
          while ($row = $records->fetch()) {
            $recordIDusa = $row["ID"];
            echo "<option value='" . $row["ID"] . "'>" . $row["Nom"] . " " . $row["Prenom"] . "</option>";
          }

          // Close the select element
          echo "</select>"; ?>
          </div>

          <button class="choice-button retour" id="retour" type="submit" name="Valider">Valider</button>
          <button class="choice-button retour" type="reset" name="Annuler">Annuler</button>
          
          <?php
          require_once("../../BDD/BDDrdv.php");
          $BDD = new BDDrdv();

          if (array_key_exists('Valider', $_POST)) {
            $duree = $_POST['duree'];
            $usaid = $_POST['usaid'];
            $dateTime = $_POST['dateheure'];
            $medid = $_POST['medid'];
            $BDD->insert($dateTime, $duree, $medid, $usaid);
            echo '<script>window.location.href="ajouter.php";</script>';
          }
          ?>
        </form>
      </div>
      <form action="../../choix.php" method="post" >
          <input id="logout" type="submit" value="Retour">
      </form> 
      <form action="../logout.php" method="post" >
          <input onclick='return confirm("Voulez-vous vraiment vous déconnecter ?")' id="logout" type="submit" value="Logout">
      </form>  
  </div>
</body>

</html>