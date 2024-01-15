<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Modifier consultation</title>
    <link rel="stylesheet" href="../../CSS/style.css">
  <link rel="icon" href="../../IMAGES/logo_cabinet.png">
</head>
<header>
    <?php include "../../HTML/header.php"; ?>
</header>

<body>


    <div class="content-wrapper">
    
            <div class="scrollable-div ">
                <form action="../logout.php" method="post" >
                    <input id="logout" type="submit" value="Logout">
                </form>
                <h2 class="h2page">Sélectionnez la consultation que vous souhaitez modifier</h2>
                <input type="text" id="myInput" onkeyup="recherche()" placeholder="Rechercher par date...">

                <table id="myTable">
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Durée</th>
                        <th>Médecin</th>
                        <th>Patient</th>
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
                      $dateRDV = $dateHeureObj->format('d/m/Y');
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
                                    <a href='modification.php?recordID=<?php echo $recordID ?>' class="delete-icon">
                                        <img src="../../IMAGES/update-icon-50.png"></a>
                                </td>
                            </tr>
                        <?php } ?>
                </table>
                <button class="retour" onclick="location.href='../../choix.php'">Retour</button>
            </div>
    </div>
    <script>
        function recherche() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

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
</body>

</html>