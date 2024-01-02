<?php
    include('BDD.php');
    class BDDmedecin {
        private $BDD;

        public function __construct() {
            $this->BDD = BDD::getInstanceBDD();
        }

        public function insert(string $nom, string $prenom, string $civ) {
            
            try {
                $sql = "INSERT INTO medecin (Nom, Prenom, Civilite) VALUES (:nom, :prenom, :civ)";
                $stmt = $this->BDD->getBDD()->prepare($sql);
        
                // Liaison des paramètres
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':civ', $civ);
                
                // Exécution de la requête
                $stmt->execute();
                
            } catch (PDOException $e) {
                die("Erreur d'insertion dans la base de données: " . $e->getMessage());
            }
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
            $stmt = $this->BDD->getBDD()->prepare($sql);
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