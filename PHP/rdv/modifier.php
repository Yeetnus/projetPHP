<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Page de test</title>
    <link rel="stylesheet" href="../../CSS/style.css">
</head>
<header>
    <?php include "../../HTML/header.php"; ?>
</header>

<body>


    <div class="content-wrapper">
            <div class="scrollable-div choice-box">
                <h2>Page de suppression de médecin</h2>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher par patient...">

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
                        $medecin=$BDD->selectNomMed($row["MedID"]);
                        $usager=$BDD->selectNomUsa($row["UsaID"]);
                        
                            $recordID = $row["ID"];
                            $date = $row["DateHeureRDV"]; 
                            $dateHeureObj = new DateTime($date);
                            $dateRDV = $dateHeureObj->format('d-m-y');
                            $heureRDV = $dateHeureObj->format('H:i');
                            ?>
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
                                    <?php echo ($BDD->selectNomMed($row["MedID"])->fetch())["Nom"]; ?>
                                </td>
                                <td>
                                    <?php echo $nomUsa; ?>
                                </td>
                                <td>
                                    <a href='modification.php?recordID=<?php echo $recordID ?>' class="delete-icon">
                                        <img src="../../IMAGES/update-icon-50.png"></a>
                                </td>
                            </tr>
                        <?php } ?>
                </table>

                <form>
                    <a href="../../choix.html" class="choice-button retour" id="retour">
                        Retour
                    </a>
                </form>

            </div>
            <form action="../logout.php" method="post" >
          <input id="logout" type="submit" value="Logout">
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

        function masquer_div(id) {
            var date, heure, duree,usager,medecin;
            date = document.getElementById("date-formulaire");
            heure = document.getElementById("heure-formulaire");
            duree = document.getElementById("duree-formulaire");
            usager = document.getElementById("usager-formulaire");
            medecin = document.getElementById("medecin-formulaire");

            if (document.getElementById(id).style.display == 'block') {
                document.getElementById(id).style.display = 'none';

            }
            else {
                document.getElementById(id).style.display = 'block';
            }
        }

        function resetInput() {
            document.getElementById("nom-formulaire").value = "";
        }

        function saveValues() {
            localStorage.setItem("date", date);
        }
    </script>
</body>

</html>