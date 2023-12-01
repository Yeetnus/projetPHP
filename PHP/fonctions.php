<?php
    class BDD {
        private static $_instance = null;
        private $linkpdo;

        private function __construct(){
            $this->linkpdo = new PDO(
                "mysql:host=localhost;dbname=projetr301;charset=utf8",
                "root"
            );
        }

        public static function getInstanceBDD() {
 
            if(is_null(self::$_instance)) {
              self::$_instance = new BDD();  
            }
        
            return self::$_instance;
        }

        public function getBDD(){
            return $this->linkpdo;
        }

        public function select(string $table){
            $sql = "SELECT nom,prenom FROM usager";
            $result = $this->getBDD()->query($sql);
            while($row = $result->fetch()) {
                echo "nom: " . $row["nom"]. " - prenom: " . $row["prenom"]. "<br>";
            }
            return $result;
        }
        /*
        public function update(string $table,string $updated,string $updating){
            $sql = "UPDATE "'$table'" SET "'$updated'"="'$updating'"  WHERE nom='aaaaaaaaaa' ";
            $stmt = $linkpdo->prepare($sql);
            $stmt->execute();
        }

        public function delete(string $table,string $deleted,string $row){
            $sql = "DELETE FROM "'$table'" WHERE "'$row'"="'$deleted';
            $linkpdo->exec($sql);
        }
        */
    }
?>