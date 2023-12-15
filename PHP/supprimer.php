<!DOCTYPE html>
<html>
  <head>
    <title>Supprimer</title>
    <style>
      table,
      th,
      td {
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;
      }
    </style>
  </head>
  <body>
    <?php
        require("fonctions.php");
        $BDD =BDD::getInstanceBDD();
        $result = $BDD->select("usager");
        echo "<table>";
        echo "<tr>";
        echo "<th>Nom</th>";
        echo "<th>Prenom</th>";
        echo "<th>Civilite</th>";
        echo "</tr>";
        while($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row["Nom"] . "</td>";
            echo "<td>" . $row["Prenom"] . "</td>";
            echo "<td>" . $row["Civilite"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
  </body>
</html>
