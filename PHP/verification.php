<?php
session_start();
if (!isset($_SESSION['session'])) {
    header('Location: /projet/projetPHP/index.php');
    exit();
}