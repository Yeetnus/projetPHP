<?php require_once 'verification.php' ?>
<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8" />
  <title>Statistiques</title>
  <link rel="icon" href="../IMAGES/logo_cabinet.png">
  <link rel="stylesheet" href="../CSS/style.css">
</head>

<header>
<?php include "../HTML/header.php"; ?>
</header>

<body>
  <div class="content-wrapper">
    <div class="scrollable-div">
      <form action="../logout.php" method="post">
        <input onclick='return confirm("Voulez-vous vraiment vous déconnecter ?")' id="logout" type="submit"
          value="Logout">
      </form>
      <h2 class="h2page">Différentes statistiques du cabinet</h2>
      <?php
      require("../BDD/BDDusager.php");
      $BDDusager = new BDDusager();
      ?>
      <h3 class="h2page">Répartition des usagers selon leur sexe et leur âge</h3>
      <table>
        <thead>
          <tr>
            <th>Tranche d'âge</th>
            <th>Nombre Hommes</th>
            <th>Nombre Femmes</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Moins de 25 ans</td>
            <td>
              <?php echo $BDDusager->getMoins25H() ?>
            </td>
            <td>
              <?php echo $BDDusager->getMoins25F() ?>
            </td>
          </tr>
          <tr>
            <td>Entre 25 et 50 ans</td>
            <td>
              <?php echo $BDDusager->getEntre25Et50H() ?>
            </td>
            <td>
              <?php echo $BDDusager->getEntre25Et50F() ?>
            </td>
          </tr>
          <tr>
            <td>Plus de 50 ans</td>
            <td>
              <?php echo $BDDusager->getPlus50H() ?>
            </td>
            <td>
              <?php echo $BDDusager->getPlus50F() ?>
            </td>
          </tr>
        </tbody>
      </table>
      <br>
      <br>
      <h3 class="h2page">Durée totale des consultations effectuées par chaque médecin (en heure)</h3>
      <table id="myTable">
        <tr>
          <th>Nom</th>
          <th>Prenom</th>
          <th>Durée</th>
        </tr>

        <?php
        require("../BDD/BDDmedecin.php");
        $BDD = new BDDmedecin();
        $medecins = $BDD->getAllHeures();
        while ($row = $medecins->fetch()) {
          ?>
          <tr>
            <td>
              <?php echo $row["Nom"]; ?>
            </td>
            <td>
              <?php echo $row["Prenom"]; ?>
            </td>
            <td>
              <?php echo $row["TotalDuree"]; ?>
            </td>
          </tr>
        <?php } ?>
      </table>
      <form>
    </div>
  </div>
</body>

</html>