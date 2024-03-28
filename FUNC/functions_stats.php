<?php
include_once('BDD.php');
class functions_stats
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function getStatsUsager()
    {
        $sql = "SELECT civilite, CASE 
            WHEN TIMESTAMPDIFF(YEAR, date_nais, CURDATE()) < 25 THEN 'Moins de 25 ans'
            WHEN TIMESTAMPDIFF(YEAR, date_nais, CURDATE()) BETWEEN 25 AND 50 THEN 'Entre 25 et 50 ans'
            ELSE 'Plus de 50 ans' 
            END AS age_group, COUNT(*) AS count
            FROM usager
            GROUP BY civilite, age_group";
        $records = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $records;
    }

    public function getStatsMedecins()
    {
        $sql = "SELECT m.Nom, m.Prenom, SUM(r.Duree_RDV)/60 as Total_Duree FROM medecin m, rendezvous r WHERE m.ID = r.MedID GROUP BY m.ID";
        $result = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}