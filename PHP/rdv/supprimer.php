<?php require_once "../verification.php" ?>
<!DOCTYPE html>
<html>

<head>
  <title>Supprimer consultation</title>
  <link rel="stylesheet" href="../../CSS/style.css">
  <meta name="viewport" content="w  idth=device-width, initial-scale=1.0">

</head>
<header>
  <?php include "../../HTML/header.php"; ?>
</header>

<body>


  <div class="content-wrapper">
      <div class="scrollable-div choice-box">
        <h2>Supprimer une consultation</h2>
        

        <table id="myTable">
          <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Durée</th>
            <th>Médecin</th>
            <th>Usager</th>
            <th>Choix</th>
          </tr>

          <?php
          require("../../BDD/BDDrdv.php");
          $BDD = new BDDrdv();
          $records = $BDD->select();
          while ($row = $records->fetch()) {
            $recordID = $row["ID"];
            require_once("../../BDD/BDDmedecin.php");
            $BDDmed = new BDDmedecin();
            $recordNom = $BDDmed->selectNom($row["MedID"]);
            while ($medecin = $recordNom->fetch()) { $nommed = $medecin["Nom"] . " " . $medecin["Prenom"]; }
            require_once("../../BDD/BDDusager.php");
            $BDDusa = new BDDusager();
            $recordNomusa = $BDDusa->selectNom($row["UsaID"]);
            while ($usager = $recordNomusa->fetch()) { $nomusa = $usager["Nom"] . " " . $usager["Prenom"]; }
            $date = $row["DateHeureRDV"]; 
            $dateHeureObj = new DateTime($date);
            $dateRDV = $dateHeureObj->format('d-m-y');
            $heureRDV = $dateHeureObj->format('H:i'); ?>
            <tr>
              <td>
                <?php echo $dateRDV; ?>
              </td>
              <td>
                <?php echo $heureRDV; ?>
              </td>
              <td>
                <?php echo $row["DuréeRDV"]; ?>
              </td>
              <td>
                <?php echo $nommed; ?>
              </td>
              <td>
                <?php echo $nomusa; ?>
              </td>
              <td>
                <a onclick="return confirm('Souhaitez-vous vraiment supprimer cette consultation ?');"
                  href="delete-script.php?recordID=<?php echo $recordID ?>' class="delete-icon">
                  <img src="../../IMAGES/icons8-trash-50.png"></a>
              </td>
            </tr>
          <?php } ?>
        </table>
        <form>
          <a href="../../choix.php" class="choice-button retour" id="retour">
            Retour
          </a>
        </form>
      </div>
      <form action="../logout.php" method="post" >
          <input id="logout" type="submit" value="Logout">
        </form>
  </div>
</body>

</html>