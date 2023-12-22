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
    
        
         <table>
         <tr>
         <th>ID</th>
         <th>Nom</th>
         <th>Prenom</th>
         <th>Civilité</th>
         <th>Choix</th>
         </tr>
        <?php
        require("BDDmedecin.php");
        $BDD = new BDDmedecin();
        $records = $BDD->select();

        while($row = $records->fetch()) {
            $recordID = $row["ID"];?>
            <tr>
            <td><?php echo $recordID;?></td>
            <td><?php echo $row["Nom"];?></td>
            <td><?php echo$row["Prenom"];?></td>
            <td><?php echo$row["Civilite"];?></td><td><a href='delete-script.php?recordID=<?php echo $recordID?>'>Delete</a> </td>
            </tr>;
        <?php }
        ?>
    </div>
  </body>
</html>
