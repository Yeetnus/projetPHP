<?php
include_once('../FUNC/BDD.php');
class functions_auth
{
    private $BDD;

    public function __construct()
    {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function getRoleUser(string $login,string $mdp){
        try{
            if(password_verify($mdp,$login)){
            $sql = "SELECT role FROM util where login='$login' and password='$mdp'";
            $result = $this->BDD->getBDD()->query($sql)->fetch();
            return $result;
            }
        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }

    public function isValidUser(string $login,string $mdp){
        try{
            $sql = "SELECT login,password FROM util where login='$login' and password='$mdp'";
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
            $sql = "SELECT * FROM util where login='$login' and password='$mdp'";
            $result = $this->BDD->getBDD()->query($sql)->fetch();
            return $result;
        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }
    
    public function getRole(string $login,string $mdp){
        try{
            $sql = "SELECT role FROM util where login='$login' and password='$mdp'";
            $result = $this->BDD->getBDD()->query($sql)->fetch();
            return $result;
        } catch (PDOException $e) {
            die("Erreur d'insertion dans la base de données: " . $e->getMessage());
        }
    }
}
?>