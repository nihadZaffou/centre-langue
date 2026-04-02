<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "centrelangues";
    public $conn;

    public function getConnection(){
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbName);
        if($this->conn->connect_error){
            die("Connexion echouée: ".$this->conn->connect_error);
        }
        return $this->conn;
    }
}