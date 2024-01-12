<?php require_once "PHP/verification.php" ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Page d'accueil</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>

<body>
  <div class="flip-box scrollable-div">
    
    <div class="flip-boxH2">
    <h2>Où souhaitez-vous aller ?</h2>
    </div>
    <div class="flip" >
      <div class="front" style="background-image: url(IMAGES/médecin.jpg)">
        <h1 class="text-shadow">Médecin</h1>
      </div>
      <div class="back">
        <form class="flip-form">
          <a href="PHP/medecin/supprimer.php" class="choice-button">
            Supprimer un médecin
          </a>
        </form>
        <form class="flip-form">
          <a href="PHP/medecin/modifier.php" class="choice-button">
            Modifier un médecin
          </a>
        </form>
        <form class="flip-form">
          <a href="PHP/medecin/ajouter.php" class="choice-button">
            Ajouter un médecin
          </a>
        </form>
        
      </div>
    </div>

    <div class="flip">
      <div class="front" style="background-image: url(IMAGES/patient.webp)">
        <h1 class="text-shadow">Usager</hi>
      </div>
      <div class="back">
        <form class="flip-form">
          <a href="PHP/usager/supprimer.php" class="choice-button">
            Supprimer un usager
          </a>
        </form>
        <form class="flip-form">
          <a href="PHP/usager/modifier.php" class="choice-button">
            Modifier un usager
          </a>
        </form>
        <form class="flip-form">
          <a href="PHP/usager/ajouter.php" class="choice-button">
            Ajouter un usager
          </a>
        </form>
      </div>
    </div>

    <div class="flip">
      <div class="front" style="background-image: url(IMAGES/rendez-vous.avif)">
        <h1 class="text-shadow">Rendez-vous</hi>
      </div>
      <div class="back">
        <form class="flip-form">
          <a href="PHP/rdv/supprimer.php" class="choice-button">
            Supprimer un rendez-vous
          </a>
        </form>
        <form class="flip-form">
          <a href="PHP/rdv/modifier.php" class="choice-button">
            Modifier un rendez-vous
          </a>
        </form>
        <form class="flip-form">
          <a href="PHP/rdv/ajouter.php" class="choice-button">
            Ajouter un rendez-vous
          </a>
        </form>
      </div>
    </div>
  </div>
  <form action="PHP/logout.php" method="post">
    <input type="submit" value="Logout">
</form>
</body>

</html>