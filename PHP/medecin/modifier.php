<?php require_once "../verification.php" ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Modifier médecin</title>
    <link rel="stylesheet" href="../../CSS/style.css">
  <link rel="icon" href="../../IMAGES/logo_cabinet.png">
</head>
<header>
    <?php include "../../HTML/header.php"; ?>
</header>

<body>


    <div class="content-wrapper">
            <div class="scrollable-div choice-box">
                <h2>Sélectionnez le médecin que vous souhaitez modifier</h2>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher par noms...">

                <table id="myTable">
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Civilité</th>
                        <th>Choix</th>
                    </tr>

                    <?php
                    require("../../BDD/BDDmedecin.php");
                    $BDD = new BDDmedecin();
                    $records = $BDD->select();
                    while ($row = $records->fetch()) {
                        $recordID = $row["ID"];
                        $nom = $row["Nom"]; ?>
                        <tr>
                            <td>
                                <?php echo $row["Nom"]; ?>
                            </td>
                            <td>
                                <?php echo $row["Prenom"]; ?>
                            </td>
                            <td>
                                <?php echo $row["Civilite"]; ?>
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
            var nom, prenom, civ;
            nom = document.getElementById("nom-formulaire");
            prenom = document.getElementById("prenom-formulaire");
            civ = document.getElementById("civ-formulaire");

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

        function saveValues(nom) {
            localStorage.setItem("name", nom);
        }
    </script>
</body>

</html>