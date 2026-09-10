<?php 
class Database{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbName= "medicaredb";

    public $conn;

    public function __construct(){

    $ds = 'mysql:host =' . $this->host.';dbname=' . $this->dbName.';charset=utf8';

    //options 
    $option = array(
        PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
    );
    try{
        $this->conn = new PDO($ds, $this->user, $this->pass, $option);
       return $this->conn;
    }catch(PDOException $e){
        echo $e->getMessage();
     
    }

    }
    
}

?>