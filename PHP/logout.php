<?php
    session_start();
    
    // Détruire la session et les variables de session
    session_destroy();
    unset($_SESSION['username']);

    // Rediriger vers la page de connexion
    header("Location: /projet/projetphp/index.php");
?>