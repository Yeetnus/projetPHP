<?php
include_once('BDD.php');
class functions_RDV
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function selectAllRDV()
    {
        $sql = "SELECT ID,DateHeureRDV,DuréeRDV,MedID,UsaID FROM rendezvous order by DateHeureRDV";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function selectNomUsa(int $id)
    {
        $sql = "SELECT Nom FROM usager,rendezvous where UsaID=$id";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function selectNomMed(int $id)
    {
        $sql = "SELECT Nom FROM medecin,rendezvous where MedID=$id";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function selectRDVById(int $id)
    {
        $sql = "SELECT ID,DateHeureRDV,DuréeRDV, MedID, UsaID FROM rendezvous WHERE ID=$id";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function selectRDVByMedId(int $id)
    {
        $sql = "SELECT ID, DateHeureRDV, DuréeRDV, UsaID FROM rendezvous WHERE MedID=$id";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function insertRDV(string $dateheurerdv, string $duree, int $medid, int $usaid)
    {

        try {
            $sql = "INSERT INTO rendezvous (DateHeureRDV, DuréeRDV, MedID, UsaID) VALUES (:dateheurerdv, :duree, :medid, :usaid)";
            $stmt = $this->BDD->getBDD()->prepare($sql);

            $stmt->bindParam(':dateheurerdv', $dateheurerdv);
            $stmt->bindParam(':duree', $duree);
            $stmt->bindParam(':medid', $medid);
            $stmt->bindParam(':usaid', $usaid);

            $stmt->execute();

        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }

    function updateRDV($ID, $dateheurerdv, $duree, $medid, $usaid)
    {
        try {
            $sql = "UPDATE rendezvous SET DateHeureRDV = :dateheurerdv, DuréeRDV = :duree, MedID = :medid, UsaID = :usaid WHERE ID = :id";

            $stmt = $this->BDD->getBDD()->prepare($sql);

            $stmt->bindParam(':dateheurerdv', $dateheurerdv);
            $stmt->bindParam(':duree', $duree);
            $stmt->bindParam(':medid', $medid);
            $stmt->bindParam(':usaid', $usaid);
            $stmt->bindParam(':id', $ID);

            $stmt->execute();

        } catch (PDOException $e) {
            die("Erreur de modification de la base de données: " . $e->getMessage());
        }
    }

    public function deleteRDV(string $deleted)
    {
        $sql = "DELETE FROM rendezvous WHERE ID=:deleted";
        $stmt = $this->BDD->getBDD()->prepare($sql);
        $stmt->bindParam(':deleted', $deleted);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;

        }
    }

    public function medOccuped($medid, $dateheurerdv, $duree)
    {
        $records = $this->selectRDVByMedId($medid);
        if ($records != null) {
            foreach ($records as $rdv) {
                $dateHeureObj = new DateTime($dateheurerdv);
                $dateRDV = $dateHeureObj->format('d/m/Y');
                $heureRDV = $dateHeureObj->format('H:i');

                $dateHeureObj2 = new DateTime($rdv["DateHeureRDV"]);
                $dateRDV2 = $dateHeureObj2->format('d/m/Y');
                $heureRDV2 = $dateHeureObj2->format('H:i');
                if ($dateRDV == $dateRDV2) {
                    if ($heureRDV == $heureRDV2) {
                        return true;
                    }
                    if ($heureRDV < $heureRDV2) {
                        $dateHeureObj->add(new DateInterval('PT' . $duree . 'M'));
                        $heureRDV = $dateHeureObj->format('H:i');
                        if ($heureRDV > $heureRDV2) {
                            return true;
                        }
                    }
                    if ($heureRDV > $heureRDV2) {
                        $dateHeureObj2->add(new DateInterval('PT' . $rdv["DuréeRDV"] . 'M'));
                        $heureRDV2 = $dateHeureObj2->format('H:i');
                        if ($heureRDV2 > $heureRDV) {
                            return true;
                        }
                    }
                }
            }

        }
        return false;
    }
}

class functions_medecin
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function insert(string $nom, string $prenom, string $civ)
    {

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

    public function select()
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite FROM medecin";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function selectById(int $id)
    {
        $sql = "SELECT ID,Nom,Prenom,Civilite FROM medecin WHERE ID=$id";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function selectNom(int $id)
    {
        $sql = "SELECT Nom,Prenom FROM medecin WHERE ID=$id";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function update(int $id, string $nom, string $prenom, string $civilite)
    {
        $sql = "UPDATE medecin SET Nom=:nom, Prenom=:prenom, Civilite=:civilite WHERE ID=:id";
        $stmt = $this->BDD->getBDD()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':civilite', $civilite);
        $stmt->execute();
    }

    function delete(int $id)
    {
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
            echo "<script>alert('" . $e->getMessage() . "');</script>";
        }
    }
}
?>