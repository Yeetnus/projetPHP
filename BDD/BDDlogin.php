<?php
include_once('BDD.php');
class BDDlogin {
    private $BDD;

    public function __construct() {
        $this->BDD = BDD::getInstanceBDD();
    }

    public function verification(string $login, string $mdp){
        $sql = "SELECT Login, Mdp FROM connecter where Login=:login and Mdp=:mdp";
        $stmt = $this->BDD->getBDD()->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':mdp', $mdp); 
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result){
            return true;
        } else {
            return false;
        }
    }
}
?>