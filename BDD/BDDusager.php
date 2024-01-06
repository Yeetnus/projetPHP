<?php
include_once('BDD.php');
class BDDusager
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function select()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale FROM usager";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function selectById(int $id)
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale FROM usager WHERE ID=$id";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function insert(string $nom, string $prenom, string $civilite, string $adresse, DateTime $dateN, string $lieuN, string $numsecu, int $medid)
    {
        try {
            $sql = "INSERT INTO usager (Nom, Prenom, Civilite, Adresse, DateNaissance, LieuNaissance, NumeroSecuriteSociale, MedID) VALUES (:nom, :prenom, :civ, :adresse, :dateN, :lieuN, :numsecu, :medid)";
            $stmt = $this->BDD->getBDD()->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':civ', $civilite);
            $stmt->bindParam(':adresse', $adresse);
            $date_string = $dateN->format('Y-m-d');
            $stmt->bindParam(':dateN', $date_string);
            $stmt->bindParam(':lieuN', $lieuN);
            $stmt->bindParam(':numsecu', $numsecu);
            $stmt->bindParam(':medid', $medid);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }

    public function update(int $id, string $nom, string $prenom, string $civilite, string $adresse, DateTime $dateN, string $lieuN, string $numsecu, int $medid)
    {
        $sql = "UPDATE usager SET Nom=:nom,Prenom=:prenom,Civilite=:civ,Adresse=:adresse,DateNaissance=:dateN,LieuNaissance=:lieuN,NumeroSecuriteSociale=:numsecu, MedID=:medid WHERE ID=:id";
        $stmt = $this->BDD->getBDD()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':civilite', $civilite);
        $stmt->bindParam(':adresse', $adresse);
        //$date_object = DateTime::createFromFormat('Y-m-d', $dateN);
        //$date_sql = $date_object->format('Y-m-d');
        $stmt->bindParam(':dateN', $dateN);
        $stmt->bindParam(':lieuN', $lieuN);
        $stmt->bindParam(':numsecu', $numsecu);
        $stmt->bindParam(':medid', $medid);
        $stmt->execute();
    }

    public function delete(string $deleted)
    {
        $sql = "DELETE FROM usager WHERE ID=$deleted";
        $this->BDD->getBDD()->exec($sql);
    }

    public function getMoins25()
    {
        $sql = "SELECT count(*) FROM usager WHERE YEAR(DATEDIFF(NOW(), DateNaissance))<25";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function getEntre25Et50()
    {
        $sql = "SELECT count(*) FROM usager WHERE YEAR(DATEDIFF(NOW(), DateNaissance))>25 AND YEAR(DATEDIFF(NOW(), DateNaissance))<50";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function getPlus50()
    {
        $sql = "SELECT count(*) FROM usager WHERE YEAR(DATEDIFF(NOW(), DateNaissance))>50";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }
}
?>