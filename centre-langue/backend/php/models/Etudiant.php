<?php
class Etudiant {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }
public function create($idUser, $data) {
    $sql = "INSERT INTO Etudiant (idUser, ParentNom, ParentPrenom, ParentTel, Paye, Admis) 
            VALUES ($idUser, '$data[NomParent]', '$data[PrenomParent]', '$data[TelParent]', $data[Paye], $data[Admis])";

    return $this->conn->query($sql);
}
}
?>
