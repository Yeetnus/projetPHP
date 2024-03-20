<?php require_once "PHP/verification.php" ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Page d'accueil</title>
  <link rel="stylesheet" href="CSS/stylechoix.css">
  <link rel="icon" href="IMAGES/logo_cabinet.png">
  
</head>

<body>  
  <div class="global-box">
    <h2>Où souhaitez-vous aller ?</h2>
    <div class="container">
      <div id="medecin" class="box">
        <a href="PHP/medecin/supprimer.php" class="choice-button">
          Supprimer un médecin
        </a><br>
        <a href="PHP/medecin/ajouter.php" class="choice-button">
          Ajouter un médecin
        </a><br>
        <a href="PHP/medecin/modifier.php" class="choice-button">
          Modifier un médecin
        </a>
      </div>

      <div id="usager" class="box">
        <a href="PHP/usager/supprimer.php" class="choice-button">
          Supprimer un usager
        </a><br>
        <a href="PHP/usager/ajouter.php" class="choice-button">
          Ajouter un usager
        </a><br>
        <a href="PHP/usager/modifier.php" class="choice-button">
          Modifier un usager
        </a>
      </div>

      <div id="rdv" class="box">
        <a href="PHP/rdv/supprimer.php" class="choice-button">
          Supprimer un rendez-vous
        </a><br>
        <a href="PHP/rdv/ajouter.php" class="choice-button">
          Ajouter un rendez-vous
        </a><br>
        <a href="PHP/rdv/modifier.php" class="choice-button">
          Modifier un rendez-vous
        </a>
      </div>

      <div id="stats" class="box">
        <a href="PHP/stats.php" class="choice-button">
          Statistiques
        </a>
      </div>
    </div>
    <form action="PHP/logout.php" method="post">
      <input onclick='return confirm("Voulez-vous vraiment vous déconnecter ?")' id="logout" type="submit"
        value="Logout">
    </form>
</body>

</html>