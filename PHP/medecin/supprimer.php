<?php require_once "../verification.php" ?>
<!DOCTYPE html>
<html>

<head>
  <title>Supprimer médecin</title>
  <link rel="stylesheet" href="../../CSS/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../IMAGES/logo_cabinet.png">
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
</head>

<header>
  <?php include "../../HTML/header.php"; ?>
</header>

<body>
  <div class="content-wrapper">
    <div class="scrollable-div">
      <form action="../logout.php" method="post">
        <input onclick='return confirm("Voulez-vous vraiment vous déconnecter ?")' id="logout" type="submit"
          value="Logout">
      </form>
      <h2 class="h2page">Sélectionnez le médecin que vous souhaitez supprimer</h2>
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
      <button class="retour" onclick="location.href='../../choix.php'">Retour</button>
    </div>
  </div>
</body>

</html>