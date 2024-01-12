<?php require_once "../verification.php" ?>
<!DOCTYPE html>
<html>

<head>
  <title>Supprimer</title>
  <link rel="stylesheet" href="../../CSS/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<header>
  <?php include "../../HTML/header.php"; ?>
</header>

<body>


  <div class="content-wrapper">
    <div class="content">
      <div class="scrollable-div choice-box">
        <h2>Page de suppression de médecin</h2>
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
                <a onclick="return confirm('Souhaitez-vous vraiment supprimer ce médecin ?');"
                  href='delete-script.php?recordID=<?php echo $recordID ?>' class="delete-icon">
                  <img src="../../IMAGES/icons8-trash-50.png"></a>
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