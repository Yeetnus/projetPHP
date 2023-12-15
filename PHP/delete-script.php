<?php
    include_once "BDDmedecin.php";
    if (isset($_GET['recordID'])){
        $recordId = $_GET['recordID'];
        $BDD = new BDDmedecin();
        $delete = $BDD->delete($recordId);
        if ($delete){
            echo '<script>alert("Record deleted successfully !")</script>';
            echo '<script>window.location.href="index.php";</script>';
        }
    }
?>