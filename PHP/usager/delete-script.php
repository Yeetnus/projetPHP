<?php
    include_once "../../BDD/BDDusager.php";
    if (isset($_GET['recordID'])){
        $recordId = $_GET['recordID'];
        $BDD = new BDDusager();
        $delete = $BDD->delete($recordId);
        if ($delete){
            echo '<script>window.location.href="../PHP/usager/supprimer.php";</script>';
        }
    }
?>