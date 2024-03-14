<?php
require_once('BDD.php');
class functions_usager
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function select_all_usager()
    {
        $sql = "SELECT id_usager, nom, prenom, civilite, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin FROM usager";
        $result = $this->BDD->getBDD()->query($sql)->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }

    public function select_usager_By_Id(int $id)
    {
        $sql = "SELECT id_usager, nom, prenom, civilite, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin FROM usager WHERE id_usager=$id";
        $result = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getCountId(int $id) 
    {
        $sql = "SELECT count(id_usager) FROM usager WHERE id_usager = :id";
        $stmt = $this->BDD->getBDD()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function insert_usager(array $data)
    {
        try {
            $sql = "INSERT INTO usager (civilite, nom, prenom, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu, id_medecin) VALUES (:civilite, :nom, :prenom, :sexe, :adresse, :code_postal, :ville, :date_nais, :lieu_nais, :num_secu, :id_medecin)";
            $stmt = $this->BDD->getBDD()->prepare($sql);
            $stmt->bindParam(':civilite', $data['civilite']);
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':prenom', $data['prenom']);
            $stmt->bindParam(':sexe', $data['sexe']);
            $stmt->bindParam(':adresse', $data['adresse']);
            $stmt->bindParam(':code_postal', $data['code_postal']);
            $stmt->bindParam(':ville', $data['ville']);
            $stmt->bindParam(':date_nais', $data['date_nais']);
            $stmt->bindParam(':lieu_nais', $data['lieu_nais']);
            $stmt->bindParam(':num_secu', $data['num_secu']);
            $stmt->bindParam(':id_medecin', $data['id_medecin']);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }

    public function update_usager(int $id, string $nom, string $prenom, string $civilite, string $sexe, string $adresse, string $code_postal, string $ville, DateTime $dateN, string $lieuN, string $numsecu)
    {
        $sql = "UPDATE usager SET nom=:nom, prenom=:prenom, civilite=:civ, sexe=:sexe, adresse=:adresse, code_postal=:code_postal, ville=:ville, date_nais=:date_nais, lieu_nais=:lieu_nais, num_secu=:num_secu, id_medecin=:id_medecin WHERE id_usager=:id";
        $stmt = $this->BDD->getBDD()->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':civ', $civilite);
        $stmt->bindParam(':sexe', $sexe);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':code_postal', $code_postal);
        $stmt->bindParam(':ville', $ville);
        $date_string = $dateN->format('Y-m-d');
        $stmt->bindParam(':date_nais', $date_string);
        $stmt->bindParam(':lieu_nais', $lieuN);
        $stmt->bindParam(':num_secu', $numsecu);
        $stmt->bindParam(':id_medecin', $id_medecin);
        $stmt->execute();
    }

    public function delete_usager(string $deleted)
    {
        $sqlrdv = "DELETE FROM consultation WHERE id_usager=:deleted";
        $sql = "DELETE FROM usager WHERE id_usager=:deleted";

        try {
            $stmtrdv = $this->BDD->getBDD()->prepare($sqlrdv);
            $stmtrdv->bindParam(':deleted', $deleted);
            $stmtrdv->execute();

            $stmt = $this->BDD->getBDD()->prepare($sql);
            $stmt->bindParam(':deleted', $deleted);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression : " . $e->getMessage();
            return false;
        }
    }
}