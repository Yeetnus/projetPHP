<?php
    session_start();

    // Connexion à la base de données
    include("BDD/BDDlogin.php");
    $BDD = new BDDlogin();

    // Récupération des données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Recherche de l'utilisateur dans la base de données
    
    $records = $BDD->verification($_POST["username"], $_POST["password"]);

    if ($records) {
        // Redirection vers la page d'accueil
        header("Location: choix.html");
    } else {
        // Le mot de passe est incorrect
        echo "The password you entered is incorrect.";
    }
    

?>