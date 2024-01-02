<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>Page de test</title>
    <link rel="stylesheet" href="../../CSS/style.css">
</head>
  <?php include "../../HTML/header.php"; ?>

<body>

<div class="scrollable-div login-box">
    <h2>Ajouter un médecin</h2>
    <form action="#" method="post" class="formulaire">
      <div class="user-box">
        <input type="text" name="nom" required="">
        <label>Nom</label>
      </div>
      <div class="user-box">
        <input type="text" name="prenom" required="">
        <label>Prénom</label>
      </div>
      <div class="user-box">
        <input type="text" name="civ" required="">
        <label>Civlité</label>
      </div>
      <button type="submit" name="Valider">Valider</button>
      <?php
        require("../../BDD/BDDmedecin.php");
        $BDD = new BDDmedecin();

        if(array_key_exists('Valider', $_POST)) { 
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $civ = $_POST['civ'];
            $BDD->insert($nom, $prenom, $civ);
            echo '<script>window.location.href="ajouter.php";</script>';
        } 
                
        ?>
    </form>
  </div>
    
</body>

</html>