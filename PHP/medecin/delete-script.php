<?php
    include_once "../../BDD/BDDmedecin.php";
    if (isset($_GET['recordID'])){
        $recordId = $_GET['recordID'];
        $BDD = new BDDmedecin();
        $delete = $BDD->delete($recordId);
        if ($delete){
            echo '<script>window.location.href="../PHP/medecin/supprimer.php";</script>';
        }
    }
?>