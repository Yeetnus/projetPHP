<?php
    include('BDD.php');
    class BDDusager {
        private $BDD;

        public function __construct() {
            $this->BDD = BDD::getInstanceBDD();
        }

        public function select(){
            $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale FROM usager";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function selectById(int $id){
            $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale FROM usager WHERE ID=$id";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function update(string $updated,string $updating,int $id){
            $sql = "UPDATE usager SET $updated=$updating  WHERE ID=$id ";
            $stmt = BDD->getBDD()->prepare($sql);
            $stmt->execute();
        }

        public function delete(string $deleted){
            $sql = "DELETE FROM usager WHERE ID=$deleted";
            BDD->getBDD()->exec($sql);
        }

        public function getMoins25(){
            $sql = "SELECT count(*) FROM usager WHERE YEAR(DATEDIFF(NOW(), DateNaissance))<25";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function getEntre25Et50(){
            $sql = "SELECT count(*) FROM usager WHERE YEAR(DATEDIFF(NOW(), DateNaissance))>25 AND YEAR(DATEDIFF(NOW(), DateNaissance))<50";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function getPlus50(){
            $sql = "SELECT count(*) FROM usager WHERE YEAR(DATEDIFF(NOW(), DateNaissance))>50";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }
    }
?>