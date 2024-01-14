<?php require_once 'verification.php' ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8" />
  <title>Statistiques</title>
  <link rel="icon" href="../IMAGES/logo_cabinet.png">
  <link rel="stylesheet" href="../CSS/style.css">
</head>
<?php include "../HTML/header.php"; ?>
    <body>
    <div class="content-wrapper" >
      <div class="scrollable-div login-box">
        <h2>Différentes statistiques du cabinet</h2>
        <?php 
            require("../BDD/BDDusager.php") ;
            $BDDusager = new BDDusager();
            $rslt25H = $BDDusager->getMoins25H();
            $rslt25_50H = $BDDusager->getEntre25Et50H();
            $rslt50H = $BDDusager->getPlus50H();
            $rslt25F = $BDDusager->getMoins25F();
            $rslt25_50F = $BDDusager->getEntre25Et50F();
            $rslt50F = $BDDusager->getPlus50F();
        ?>
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
      <td><?php echo $rslt25H?></td>
      <td><?php echo $rslt25F?></td>
    </tr>
    <tr>
      <td>Entre 25 et 50 ans</td>
      <td><?php echo $rslt25_50H?></td>
      <td><?php echo $rslt25_50F?></td>
    </tr>
    <tr>
      <td>Plus de 50 ans</td>
      <td><?php echo $rslt50H?></td>
      <td><?php echo $rslt50F?></td>
    </tr>
 </tbody>
</table>
<br>
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
          foreach ($medecins as $medecin) {
         ?>
            <tr>
              <td>
                <?php echo $medecin["Nom"]; ?>
              </td>
              <td>
                <?php echo $medecin["Prenom"]; ?>
              </td>
              <td>
                <?php echo $medecin["TotalDuree"]; ?>
              </td>
            </tr>
          <?php } ?>
        </table>
        <form>
      </div>
  </div>
    </body>
</html>