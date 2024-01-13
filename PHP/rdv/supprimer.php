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
    <div class="content">
      <div class="scrollable-div choice-box">
        <h2>Supprimer une consultation</h2>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher par noms...">

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
      <script>
        function myFunction() {
          // Declare variables
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("myTable");
          tr = table.getElementsByTagName("tr");

          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        };

      </script>
    </div>
  </div>
</body>

</html>