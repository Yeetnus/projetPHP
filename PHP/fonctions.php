<?php
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adr = $_POST['adr'];
$lieuN = $_POST['lieuN'];
$dateN = $_POST['dateN'];
$civ = $_POST['civ'];
    class BDD {
        public function linkBDD(){
            $linkpdo = new PDO(
                'mysql:host=localhost;dbname=projetr301;charset=utf8',
                'carnet', 'iut'
            );
        }

        public function select(string $table){
            $sql = "SELECT * FROM "'$table';
            string $res;
            $result = $linkpdo->query($sql);
            while($row = $result->fetch()) {
                echo "nom: " . $row["nom"]. " - prenom: " . $row["prenom"]. " - adresse: " . $row["adresse"]. " - code postal: " . $row["code_postal"]. "  -ville: " . $row["ville"]. " - telephone: " . $row["telephone"]. "<br>";
            }
            return res
        }

        public function update(string $table,string $updated,string $updating){
            $sql = "UPDATE "'$table'" SET "'$updated'"="'$updating'"  WHERE nom='aaaaaaaaaa' ";
            $stmt = $linkpdo->prepare($sql);
            $stmt->execute();
        }

        public function delete(string $table,string $deleted,string $row){
            $sql = "DELETE FROM "'$table'" WHERE "'$row'"="'$deleted';
            $linkpdo->exec($sql);
        }
    }
?>