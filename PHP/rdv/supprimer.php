<!DOCTYPE html>
<html>

<head>
  <title>Supprimer</title>
  <link rel="stylesheet" href="../../CSS/style.css">
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

<header>
  <?php include "../../HTML/header.php"; ?>
</header>

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
      require("../BDD/BDDmedecin.php");
      $BDD = new BDDmedecin();
      $records = $BDD->select();
      while ($row = $records->fetch()) {
        $recordID = $row["ID"]; ?>
        <tr>
          <td>
            <?php echo $recordID; ?>
          </td>
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
            <a href='delete-script.php?recordID=<?php echo $recordID ?>' class="delete-icon">
              <img src="../IMAGES/icons8-trash-50.png"></a>
          </td>
        </tr>;
      <?php } ?>
    </table>
    <form>
      <a href="index.php" class="choice-button" id="retour">
        Retour
      </a>
    </form>
  </div>
</body>

</html>