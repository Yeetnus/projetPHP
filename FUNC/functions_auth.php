<?php
require_once __DIR__.'/BDDlogin.php';
class functions_auth
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function getRoleUser(string $login,string $mdp){
        try{
            $sql = "SELECT role FROM user_auth_v2 where login='$login' and mdp='$mdp'";
            $result = $this->BDD->getBDD()->query($sql)->fetch();
            return $result;
        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }

    public function isValidUser(string $login,string $mdp){
        try{
            $sql = "SELECT login,mdp FROM user_auth_v2 where login='$login' and mdp='$mdp'";
            $result = $this->BDD->getBDD()->query($sql)->fetch();
            if($result){
                return true;
            }
            return false;
        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }

    public function getUser(string $login,string $mdp){
        try{
            $sql = "SELECT * FROM user_auth_v2 where login='$login' and mdp='$mdp'";
            $result = $this->BDD->getBDD()->query($sql)->fetch();
            return $result;
        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }

    public function getRole(string $login,string $mdp){
        try{
            $sql = "SELECT role FROM user_auth_v2 where login='$login' and mdp='$mdp'";
            $result = $this->BDD->getBDD()->query($sql)->fetch();
            return $result;
        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }
}
?>