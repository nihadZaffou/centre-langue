<?php
class Prof {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create($idUser, $data){
        $specialite = $this->conn->real_escape_string($data['Specialite'] ?? '');
        $sql = "INSERT INTO Prof (idUser, Specialite) VALUES ($idUser, '$specialite')";
        return $this->conn->query($sql);
    }
}
?>