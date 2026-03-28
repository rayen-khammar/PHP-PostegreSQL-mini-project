<?php
class ConnexionBD {
    private static $_dbname = "StudentsManagerDB";
    private static $_user = "postgres";
    private static $_pwd = "root";
    private static $_host = "localhost";
    private static $_port = 5432;
    private static $_bdd = null;
    
    private function __construct() {
        $dbs="pgsql:host=" . self::$_host . ";port=".self::$_port.";dbname=" . self::$_dbname;
        try{
            self::$_bdd=new PDO($dbs,self::$_user,self::$_pwd,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false]);
    } catch(PDOException $e){
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
    
    }
    public static function getINSTANCE() {
        if(self::$_bdd==null) {
            new ConnexionBD();
        }
        return self::$_bdd;
    }
}








