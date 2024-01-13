<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: /projetphp/index.php');
        exit();
    }
?>