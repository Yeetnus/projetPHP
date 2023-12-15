<?php
include('BDD.php');
    class BDDrdv {
        private $BDD;

        public function __construct() {
            $this->BDD = BDD::getInstanceBDD();
        }

        public function select(){
            $sql = "SELECT ID,DateHeureRDV,DuréeRDV FROM rendezvous";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function selectById(int $id){
            $sql = "SELECT ID,DateHeureRDV,DuréeRDV FROM rendezvous WHERE ID=$id";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function update(string $updated,string $updating,int $id){
            $sql = "UPDATE rendezvous SET $updated=$updating  WHERE ID=$id ";
            $stmt = BDD->getBDD()->prepare($sql);
            $stmt->execute();
        }

        public function delete(string $deleted){
            $sql = "DELETE FROM rendezvous WHERE ID=$deleted";
            BDD->getBDD()->exec($sql);
        }

    }
?>