<?php
require_once('BDD.php');
class functions_medecin
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function insert_medecin(string $nom, string $prenom, string $civ)
{
    try {
        $sql = "INSERT INTO medecin (nom, prenom, civilite) VALUES (:nom, :prenom, :civ)";
        $stmt = $this->BDD->getBDD()->prepare($sql);

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':civ', $civ);

        $stmt->execute();

        // Get the ID of the last inserted row
        $lastId = $this->BDD->getBDD()->lastInsertId();

        // Fetch the inserted row
        $sql = "SELECT * FROM medecin WHERE id_medecin = :id";
        $stmt = $this->BDD->getBDD()->prepare($sql);
        $stmt->bindParam(':id', $lastId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;

    } catch (PDOException $e) {
        die("Erreur d'insertion dans la base de données: " . $e->getMessage());
    }
}

    public function getCountId(int $id) 
    {
        $sql = "SELECT count(id_medecin) FROM medecin WHERE id_medecin = :id";
        $stmt = $this->BDD->getBDD()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    public function select_all_medecin()
    {
        $sql = "SELECT * FROM medecin";
        $result = $this->BDD->getBDD()->query($sql)->fetchALL(PDO::FETCH_ASSOC);
       
        return $result;
    }

    public function select_medecin_By_Id(int $id)
    {
        $sql = "SELECT * FROM medecin WHERE id_medecin=$id";
        $result = $this->BDD->getBDD()->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    

    public function selectNom(int $id)
    {
        $sql = "SELECT nom, prenom FROM medecin WHERE id_medecin=$id";
        $result = $this->BDD->getBDD()->query($sql);
        return $result;
    }

    public function update_medecin(int $id, array $data)
    {
        $get = $this->select_medecin_By_Id($id);
        
        foreach ($get as $key => $value) {
            if (!isset($data[$key])) {
                $data[$key] = $value;
            }
        }

        $sql = "UPDATE medecin SET nom=:nom, prenom=:prenom, civilite=:civilite WHERE id_medecin=:id";
        $stmt = $this->BDD->getBDD()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':civilite', $data['civilite']);
        $stmt->execute();
    
        $updatedData = $this->select_medecin_By_Id($id);
    
        return $updatedData;
    }

    function delete_medecin(int $id)
    {
        try {
            $this->BDD->getBDD()->beginTransaction();

            $stmt = $this->BDD->getBDD()->prepare("SELECT COUNT(*) FROM consultation WHERE id_medecin = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                throw new Exception('Il y a des rendez-vous attribués à ce médecin. Impossible de supprimer le médecin.');
            }

            $med = $this->select_medecin_By_Id($id);

            $stmt = $this->BDD->getBDD()->prepare("DELETE FROM medecin WHERE id_medecin = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $this->BDD->getBDD()->commit();
            return $med;
        } catch (PDOException $e) {
            $this->BDD->getBDD()->rollBack();
            throw $e;
        } 
    }
}