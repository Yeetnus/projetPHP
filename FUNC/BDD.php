<?php
class BDD
{
    private static $_instance = null;
    private $linkpdo;

    private function __construct()
    {
        $this->linkpdo = new PDO(
            "mysql:host=localhost;dbname=fonctionsprojetr401;charset=utf8",
            "root",
            ""
        );
    }

    public static function getInstanceBDD()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new BDD();
        }

        return self::$_instance;
    }

    public function getBDD()
    {
        return $this->linkpdo;
    }

    public function isAdmin(string $login,string $mdp){
        try{
            $sql = "SELECT login,password,role FROM util where login='$login' and mdp='$mdp' and role='admin'";
            $result = $this->getBDD()->query($sql)->fetch();
            if($result){
                return true;
            }
            return false;
        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }

}
?>