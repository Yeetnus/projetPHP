<?php
include_once('BDD.php');
class BDDmedecin
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
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

            if ($row["Civilite"] == "M" && $age < 25) {
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

            if ($row["Civilite"] == "M" && $age >= 25 && $age <= 50) {
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

            if ($row["Civilite"] == "M" && $age > 50) {
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

            if ($row["Civilite"] == "MME" && $age < 25) {
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

            if ($row["Civilite"] == "MME" && $age >= 25 && $age <= 50) {
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

            if ($row["Civilite"] == "MME" && $age > 50) {
                $result++;
            }
        }
        return $result;
    }

    public function getAllHeures()
    {
        $sql = "SELECT m.Nom, m.Prenom, SUM(r.DuréeRDV)/60 as TotalDuree FROM medecin m, rendezvous r WHERE m.ID = r.MedID GROUP BY m.ID";
        $result = $this->BDD->getBDD()->query($sql);

        return $result;
    }
}