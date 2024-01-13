<?php
    include_once "../../BDD/BDDmedecin.php";
    if (isset($_GET['recordID'])){
        $recordId = $_GET['recordID'];
        $BDD = new BDDmedecin();
        $delete = $BDD->delete($recordId);
        echo '<script>window.location.href="supprimer.php";</script>';
    }
?>