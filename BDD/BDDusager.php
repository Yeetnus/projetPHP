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
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID FROM usager";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function selectById(int $id)
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale, MedID FROM usager WHERE ID=$id";
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
        $stmt->bindParam(':civ', $civilite);
        $stmt->bindParam(':adresse', $adresse);
        $date_string = $dateN->format('Y-m-d');
        $stmt->bindParam(':dateN', $date_string);
        $stmt->bindParam(':lieuN', $lieuN);
        $stmt->bindParam(':numsecu', $numsecu);
        $stmt->bindParam(':medid', $medid);
        $stmt->execute();
    }

    public function delete(string $deleted){
        $sql = "DELETE FROM usager WHERE id=:deleted";
    
        try {
            $stmt = $this->BDD->getBDD()->prepare($sql);
    
            // bind the values
            $stmt->bindParam(':deleted', $deleted);
    
            // execute the query
            $stmt->execute();
    
            // check if the query succeeded
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getMoins25H()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID FROM usager";
        $records = $this->BDD->getBDD()->query($sql);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Civilite"] == "M" && $age<25) {
                $result++;
            }
        }
        return $result;
    }

    public function getEntre25Et50H()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID FROM usager";
        $records = $this->BDD->getBDD()->query($sql);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Civilite"] == "M" && $age>=25 && $age<=50) {
                $result++;
            }
        }
        return $result;
    }

    public function getPlus50H()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID FROM usager";
        $records = $this->BDD->getBDD()->query($sql);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Civilite"] == "M" && $age>50) {
                $result++;
            }
        }
        return $result;
    }

    public function getMoins25F()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID FROM usager";
        $records = $this->BDD->getBDD()->query($sql);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Civilite"] == "MME" && $age<25) {
                $result++;
            }
        }
        return $result;
    }

    public function getEntre25Et50F()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID FROM usager";
        $records = $this->BDD->getBDD()->query($sql);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Civilite"] == "MME" && $age>=25 && $age<=50) {
                $result++;
            }
        }
        return $result;
    }

    public function getPlus50F()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID FROM usager";
        $records = $this->BDD->getBDD()->query($sql);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Civilite"] == "MME" && $age>50) {
                $result++;
            }
        }
        return $result;
    }
}
?>