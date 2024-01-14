<?php
    session_start();

    include("BDD/BDDlogin.php");
    $BDD = new BDDlogin();

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $records = $BDD->verification($username, $password);
    $errors = "";
    if ($records) {
        $_SESSION['username'] = $username;
        header("Location: choix.php");
    } else {
        header("Location: index.php?error=true");
    }
?>