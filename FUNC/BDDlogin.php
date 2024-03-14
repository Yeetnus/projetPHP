<?php
class BDD
{
    private static $_instance = null;
    private $linkpdo;

    private function __construct()
    {
        $this->linkpdo = new PDO(
            "mysql:host=localhost;dbname=userprojetr401;charset=utf8",
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

}
?>