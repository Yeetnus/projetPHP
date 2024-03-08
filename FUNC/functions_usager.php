<?php
include_once('BDD.php');
class functions_usager
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function select_all_usager()
    {
        $sql = "SELECT id_usager, nom, prenom, civilite, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu FROM usager";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function select_usager_By_Id(int $id)
    {
        $sql = "SELECT id_usager, nom, prenom, civilite, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu FROM usager WHERE id_usager=$id";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function insert_usager(string $nom, string $prenom, string $civilite, string $sexe, string $adresse, string $code_postal, string $ville, DateTime $dateN, string $lieuN, string $numsecu)
    {
        try {
            $sql = "INSERT INTO usager (nom, prenom, civilite, sexe, adresse, code_postal, ville, date_nais, lieu_nais, num_secu) VALUES (:nom, :prenom, :civilite, :sexe, :adresse, :code_postal, :ville, :date_nais, :lieu_nais, :num_secu)";
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
            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }

    public function update_usager(int $id, string $nom, string $prenom, string $civilite, string $sexe, string $adresse, string $code_postal, string $ville, DateTime $dateN, string $lieuN, string $numsecu)
    {
        $sql = "UPDATE usager SET nom=:nom, prenom=:prenom, civilite=:civ, sexe=:sexe, adresse=:adresse, code_postal=:code_postal, ville=:ville, date_nais=:date_nais, lieu_nais=:lieu_nais, num_secu=:num_secu WHERE id_usager=:id";
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
?>