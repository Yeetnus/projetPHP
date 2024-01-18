<?php
    include_once('BDD.php');
    class BDDmedecin {
        private $BDD;

        public function __construct() {
            $this->BDD = BDD::getInstanceBDD();
        }

        public function insert(string $nom, string $prenom, string $civ) {
            
            try {
                $sql = "INSERT INTO medecin (Nom, Prenom, Civilite) VALUES (:nom, :prenom, :civ)";
                $stmt = $this->BDD->getBDD()->prepare($sql);
        
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':civ', $civ);
                
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

        public function selectNom(int $id){
            $sql = "SELECT Nom,Prenom FROM medecin WHERE ID=$id";
            $result = $this->BDD->getBDD()->query($sql);
            return $result;
        }

        public function update(int $id, string $nom, string $prenom, string $civilite){
            $sql = "UPDATE medecin SET Nom=:nom, Prenom=:prenom, Civilite=:civilite WHERE ID=:id";
            $stmt = $this->BDD->getBDD()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':civilite', $civilite);
            $stmt->execute();
        }
        
        function delete($id) {
            try {
                $this->BDD->getBDD()->beginTransaction();
        
                $stmt = $this->BDD->getBDD()->prepare("SELECT COUNT(*) FROM rendezvous WHERE MedID = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $count = $stmt->fetchColumn();
        
                if ($count > 0) {
                    throw new Exception('Il y a des rendez-vous attribués à ce médecin. Impossible de supprimer le médecin.');
                }
        
                $stmt = $this->BDD->getBDD()->prepare("DELETE FROM medecin WHERE ID = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
        
                $this->BDD->getBDD()->commit();
                return true;
            } catch (PDOException $e) {
                $this->BDD->getBDD()->rollBack();
                throw $e;
            } catch (Exception $e) {
                echo "<script>alert('".$e->getMessage()."');</script>";
            }
        }

        public function getAllHeures(){
            $query = $this->BDD->getBDD()->query('SELECT m.Nom, m.Prenom, SUM(r.DuréeRDV) as TotalDuree FROM medecin m INNER JOIN rendezvous r ON m.ID = r.MedID GROUP BY m.ID');

            $result = array();

            while ($row = $query->fetch()) {
                $result[] = array(
                    'Nom' => $row['Nom'],
                    'Prenom' => $row['Prenom'],
                    'TotalDuree' => $row['TotalDuree']
                );
            }

            return $result;
        }
    }
?>