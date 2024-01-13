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
                // Start transaction
                $this->BDD->getBDD()->beginTransaction();
        
                // Check if there are any RendezVous linked to the Medecin
                $stmt = $this->BDD->getBDD()->prepare("SELECT COUNT(*) FROM RendezVous WHERE MedID = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $count = $stmt->fetchColumn();
        
                if ($count > 0) {
                    // Throw an exception if there are any RendezVous linked to the Medecin
                    throw new Exception('Il y a des rendez-vous attribués à ce médecin. Impossible de supprimer le médecin.');
                }
        
                // Delete the Medecin
                $stmt = $this->BDD->getBDD()->prepare("DELETE FROM Medecin WHERE ID = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
        
                // Commit transaction
                $this->BDD->getBDD()->commit();
                return true;
            } catch (PDOException $e) {
                // Rollback transaction if something went wrong
                $this->BDD->getBDD()->rollBack();
                throw $e;
            } catch (Exception $e) {
                // Throw an alert if there are any RendezVous linked to the Medecin
                echo "<script>alert('".$e->getMessage()."');</script>";
            }
        }

        public function getAllHeures(){
            $query = $this->BDD->getBDD()->query('SELECT m.Nom, m.Prenom, SUM(r.DuréeRDV) as TotalDuree FROM Medecin m INNER JOIN RendezVous r ON m.ID = r.MedID GROUP BY m.ID');

            // Créer un tableau pour stocker les résultats
            $result = array();

            // Parcourir les résultats et les ajouter au tableau
            while ($row = $query->fetch()) {
                $result[] = array(
                    'Nom' => $row['Nom'],
                    'Prenom' => $row['Prenom'],
                    'TotalDuree' => $row['TotalDuree']
                );
            }

            // Retourner le tableau des résultats
            return $result;
        }
    }
?>