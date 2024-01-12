<?php
    session_start();

    include("BDD/BDDlogin.php");
    $BDD = new BDDlogin();

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $records = $BDD->verification($_POST["username"], $_POST["password"]);

    if ($records) {
        $_SESSION['username'] = $username;
        header("Location: choix.php");
    } else {
        echo "The password you entered is incorrect.";
    }
?>