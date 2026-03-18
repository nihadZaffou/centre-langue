<?php
class Directeur {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create($idUser){
        $sql = "INSERT INTO Directeur (idUser) VALUES ($idUser)";
        return $this->conn->query($sql);
    }
}
?>