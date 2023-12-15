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
        require("BDDusager.php");
        $BDD = new BDDusager();
        $result = $BDD->select();
/*
        if( isset($_POST['supp'])  ){
            // ceci est la requete que je veux executer après le clique 
            try{
               $req = $database->query('SELECT nom FROM teams WHERE id = 1');
               $team1 = $req->fetch();
            }catch(Exception $e){
               echo "Erreur " . $e->getMessage();
            }
               $nom = !empty($team1['nom']) ? $team1['nom']: "";
        }
*/
        echo "<table>";
        echo "<tr>";
        echo "<th>Nom</th>";
        echo "<th>Prenom</th>";
        echo "<th>Civilité</th>";
        echo "<th>Choix</th>";
        echo "</tr>";
        while($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row["Nom"] . "</td>";
            echo "<td>" . $row["Prenom"] . "</td>";
            echo "<td>" . $row["Civilite"] . "</td>";
            echo "<td> 
                <button id='supp' name='supp'><img src='../IMAGES/icons8-trash-50.png'/> </button>
            </td>";
            echo "</tr>";
        }
        echo "</table>";
        
    ?>
  </body>
</html>
