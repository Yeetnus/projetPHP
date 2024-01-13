<?php
    include_once "../../BDD/BDDrdv.php";
    if (isset($_GET['recordID'])){
        $recordId = $_GET['recordID'];
        $BDD = new BDDrdv();
        $delete = $BDD->delete($recordId);
        echo '<script>window.location.href="supprimer.php";</script>';
    }
?>