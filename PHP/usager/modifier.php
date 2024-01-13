<?php require_once "../verification.php" ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Modifier usager</title>
    <link rel="stylesheet" href="../../CSS/style.css">
</head>
<header>
    <?php include "../../HTML/header.php"; ?>
</header>

<body>


    <div class="content-wrapper">
            <div class="scrollable-div choice-box">
                <h2>Modifier un usager</h2>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher par noms...">

                <table id="myTable">
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Civilité</th>
                    <th>Adresse</th>
                    <th>Date de naissance</th>
                    <th>Lieu de naissance</th>
                    <th>Numéro de sécurité sociale</th>
                    <th>Choix</th>
                </tr>

                <?php
                require("../../BDD/BDDusager.php");
                $BDD = new BDDusager();
                $records = $BDD->select();
                while ($row = $records->fetch()) {
                    $recordID = $row["ID"]; ?>
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
                        <?php echo $row["Adresse"]; ?>
                    </td>
                    <td>
                        <?php echo $row["DateNaissance"]; ?>
                    </td>
                    <td>
                        <?php echo $row["LieuNaissance"]; ?>
                    </td>
                    <td>
                        <?php echo $row["NumeroSecuriteSociale"]; ?>
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