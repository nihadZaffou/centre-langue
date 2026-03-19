<?php
class Langue{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function create($NomLangue){
        $sql="INSERT INTO Langue (NomLangue) VALUES 
        ('$NomLangue')";
        return $this->conn->query($sql);
    }
    public function getAll(){
        $sql="SELECT * FROM Langue";
        return $this->conn->query($sql);
    }
    public function update($id,$NomLangue){
       $sql = "UPDATE Langue SET NomLangue='$NomLangue' WHERE idLangue=$id";
        return $this->conn->query($sql);
    }
    public function delete($id){
        $sql="DELETE FROM Langue where idLangue=$id";
        return $this->conn->query($sql);
    }
}
?>