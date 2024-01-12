<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        print_r("ok");
        header('Location: /projetphp/index.php');
        exit();
    }
?>