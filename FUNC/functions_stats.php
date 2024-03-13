<?php
include_once('BDD.php');
class functions_stats
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function getMoins25H()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,Code_postal,ville,Sexe,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID FROM usager";
        $records = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Sexe"] == "M" && $age < 25) {
                $result++;
            }
        }
        return $result;
    }

    public function getEntre25Et50H()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,Code_postal,ville,Sexe,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID FROM usager";
        $records = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Sexe"] == "M" && $age >= 25 && $age <= 50) {
                $result++;
            }
        }
        return $result;
    }

    public function getPlus50H()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,Code_postal,ville,Sexe,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID  FROM usager";
        $records = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Sexe"] == "M" && $age > 50) {
                $result++;
            }
        }
        return $result;
    }

    public function getMoins25F()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,Code_postal,ville,Sexe,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID  FROM usager";
        $records = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Sexe"] == "F" && $age < 25) {
                $result++;
            }
        }
        return $result;
    }

    public function getEntre25Et50F()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,Code_postal,ville,Sexe,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID  FROM usager";
        $records = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Sexe"] == "F" && $age >= 25 && $age <= 50) {
                $result++;
            }
        }
        return $result;
    }

    public function getPlus50F()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,Code_postal,ville,Sexe,DateNaissance,LieuNaissance,NumeroSecuriteSociale,MedID  FROM usager";
        $records = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        $result = 0;
        $today = date('Y-m-d');
        while ($row = $records->fetch()) {
            $diff = date_diff(date_create($row["DateNaissance"]), date_create($today));
            $age = $diff->format('%y');

            if ($row["Sexe"] == "F" && $age > 50) {
                $result++;
            }
        }
        return $result;
    }

    public function getAllHeures()
    {
        $sql = "SELECT m.Nom, m.Prenom, SUM(r.Duree_RDV)/60 as Total_Duree FROM medecin m, rendezvous r WHERE m.ID = r.MedID GROUP BY m.ID";
        $result = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}