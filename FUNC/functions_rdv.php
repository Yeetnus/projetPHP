<?php
include_once('BDD.php');
class functions_rdv
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function getCountId ($id)
    {
        $sql = "SELECT count($id) FROM consultation";
        $result = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selectAllRDV()
    {
        $sql = "SELECT c.id_consult,c.date_consult,c.heure_consult,c.duree_consult,m.nom as nomMed,u.nom as nomUsager FROM consultation c, medecin m,usager u where m.id_medecin=c.id_medecin and u.id_usager=c.id_usager order by date_consult,heure_consult";
        $result = $this->BDD->getBDD()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selectNomUsa(int $id)
    {
        $sql = "SELECT Nom FROM usager,consultation where id_usager=$id";
        $result = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selectNomMed(int $id)
    {
        $sql = "SELECT Nom FROM medecin,consultation where id_medecin=$id";
        $result = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function selectRDVById(int $id)
    {
        $sql = "SELECT id_consult,date_consult,heure_consult,Duree_consult, id_medecin, id_usager FROM consultation WHERE id_consult=$id";
        $result = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        if($result!=null){
            return $result;
        }
    }

    public function selectRDVByMedId(int $id)
    {
        $sql = "SELECT id_consult, date_consult,heure_consult, duree_consult, id_usager FROM consultation WHERE id_medecin=$id";
        $result = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function insertRDV(string $daterdv,string $heurerdv, string $duree, int $medid, int $usaid)
    {

        try {
            $sql = "INSERT INTO consultation (date_consult,heure_consult, duree_consult, id_medecin, id_usager) VALUES (:daterdv,:heurerdv, :duree, :medid, :usaid)";
            $stmt = $this->BDD->getBDD()->prepare($sql);

            $stmt->bindParam(':daterdv', $daterdv);
            $stmt->bindParam(':heurerdv', $heurerdv);
            $stmt->bindParam(':duree', $duree);
            $stmt->bindParam(':medid', $medid);
            $stmt->bindParam(':usaid', $usaid);

            $stmt->execute();

        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }

    function updateRDV(int $ID, array $data)
    {
        try {
            $sql = "UPDATE consultation SET date_consult = :daterdv,heure_consult=:heurerdv, duree_consult = :duree, id_medecin = :medid, id_usager = :usaid WHERE id_consult = :id";

            $stmt = $this->BDD->getBDD()->prepare($sql);

            $stmt->bindParam(':daterdv', $data['date_consult']);
            $stmt->bindParam(':heurerdv', $data['heure_consult']);
            $stmt->bindParam(':duree', $data['duree_consult']);
            $stmt->bindParam(':medid', $data['id_medecin']);
            $stmt->bindParam(':usaid', $data['id_usager']);
            $stmt->bindParam(':id', $ID);

            $stmt->execute();

        } catch (PDOException $e) {
            die("Erreur de modification de la base de données: " . $e->getMessage());
        }
    }

    public function deleteRDV(string $deleted)
    {
        $sql = "DELETE FROM consultation WHERE id_consult=:deleted";
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
?>