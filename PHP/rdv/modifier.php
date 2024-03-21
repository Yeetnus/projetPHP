<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8" />
  <title>Modifier consultation</title>
  <link rel="stylesheet" href="../../CSS/style.css">
  <link rel="icon" href="../../IMAGES/logo_cabinet.png">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript" src="../../JS_client/modifier_rdv.js"></script>
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
</head>

<header>
  <?php include "../../HTML/header.php"; ?>
</header>

<body>
  <div class="content-wrapper">
    <div class="scrollable-div ">
      <form action="../logout.php" method="post">
        <input onclick='return confirm("Voulez-vous vraiment vous déconnecter ?")' id="logout" type="submit"
          value="Logout">
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
          <tr>
            <td>

            </td>
            <td>

            </td>
            <td>
              
            </td>
            <td>
              
            </td>
            <td>
              
            </td>
            <td>
              
            </td>
          </tr>
      </table>
      <button class="retour" onclick="location.href='../../choix.php'">Retour</button>
    </div>
  </div>
</body>

</html>