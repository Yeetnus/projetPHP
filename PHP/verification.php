<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: /projet/projetPHP/index.php');
    exit();
}