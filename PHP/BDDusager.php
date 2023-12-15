<?php
    class BDDrdv {
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
              self::$_instance = new BDDrdv();  
            }
        
            return self::$_instance;
        }

        public function getBDD(){
            return $this->linkpdo;
        }

        public function select(){
            $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale FROM usager";
            $result = $this->getBDD()->query($sql);
            return $result;
        }

        public function selectById(int $id){
            $sql = "SELECT ID,Nom,Prenom,Civilite,Adresse,DateNaissance,LieuNaissance,NumeroSecuriteSociale FROM usager WHERE ID=$id";
            $result = $this->getBDD()->query($sql);
            return $result;
        }

        public function update(string $updated,string $updating,int $id){
            $sql = "UPDATE usager SET $updated=$updating  WHERE ID=$id ";
            $stmt = $linkpdo->prepare($sql);
            $stmt->execute();
        }

        public function delete(string $deleted){
            $sql = "DELETE FROM usager WHERE ID=$deleted";
            $linkpdo->exec($sql);
        }

    }
?>