<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: /projet/projetphp/index.php');
        exit();
    }
?>