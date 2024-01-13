<?php
include('BDD.php');
    class BDDrdv {
        private $BDD;

        public function __construct() {
            $this->BDD = BDD::getInstanceBDD();
        }

        public function select(){
            $sql = "SELECT ID,DateHeureRDV,DuréeRDV,MedID,UsaID FROM rendezvous";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function selectNomUsa(int $id){
            $sql = "SELECT Nom FROM usager,rendezvous where UsaID=$id";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function selectNomMed(int $id){
            $sql = "SELECT Nom FROM medecin,rendezvous where MedID=$id";
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
            $sql = "DELETE FROM rendezvous WHERE ID=:deleted";
            $stmt = $this->BDD->getBDD()->prepare($sql);
            $stmt->bindParam(':deleted', $deleted);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            
            }
        }

    }
?>