<?php
    include('BDD.php');
    class BDDmedecin {
        private $BDD;

        public function __construct() {
            $this->BDD = BDD::getInstanceBDD();
        }

        public function insert(int $id,string $nom, string $prenom, string $civ){
            $sql = "INSERT INTO medecin WHERE ID=$id ";
            $stmt = BDD->getBDD()->prepare($sql);
            $stmt->execute();
        }

        public function select(){
            $sql = "SELECT ID,Nom,Prenom,Civilite FROM medecin";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function selectById(int $id){
            $sql = "SELECT ID,Nom,Prenom,Civilite FROM medecin WHERE ID=$id";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function update(string $updated,string $updating,int $id){
            $sql = "UPDATE medecin SET $updated=$updating  WHERE ID=$id ";
            $stmt = BDD->getBDD()->prepare($sql);
            $stmt->execute();
        }
        
        public function delete(string $deleted){
            $sql = "DELETE FROM medecin WHERE id='$deleted'";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function getAllHeures(int $id){
            $sql = "SELECT medecin,sum(DuréeRDV) FROM medecin WHERE ID=$id";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }
    }
?>