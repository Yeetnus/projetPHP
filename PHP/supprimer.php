<!DOCTYPE html>
<html>
  <head>
    <title>Supprimer</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
      table, th, td {
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;
      }
    </style>
  </head>
  <body>
  <div class="choice-box">
    
  <h2>Page de suppression de médecin</h2>
    <?php
        require("BDDmedecin.php");
        $BDD = new BDDmedecin();
        $records = $BDD->select();

        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nom</th>";
        echo "<th>Prenom</th>";
        echo "<th>Civilité</th>";
        echo "<th>Choix</th>";
        echo "</tr>";
        while($row = $records->fetch()) {
            $recordID = $row["ID"];
            echo "<tr>";
            echo "<td>" . $recordID . "</td>";
            echo "<td>" . $row["Nom"] . "</td>";
            echo "<td>" . $row["Prenom"] . "</td>";
            echo "<td>" . $row["Civilite"] . "</td>";
            echo "<td><a href='delete-script.php?recordID=<?php echo $recordID?>'>Delete</a> </td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
    </div>
  </body>
</html>
