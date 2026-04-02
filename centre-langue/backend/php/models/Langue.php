<?php
class Langue {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($NomLangue) {
        $stmt = $this->conn->prepare("INSERT INTO Langue (NomLangue) VALUES (?)");
        $stmt->bind_param("s", $NomLangue);
        if($stmt->execute()) {
            return ["success" => true, "id" => $this->conn->insert_id];
        }
        return ["success" => false, "error" => $this->conn->error];
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM Langue");
        return $result->fetch_all(MYSQLI_ASSOC);

        //fetch_all(MYSQLI_ASSOC) → retourne directement un tableau PHP associatif. Plus besoin de boucler manuellement.
    }

    public function update($id, $NomLangue) {
        $stmt = $this->conn->prepare("UPDATE Langue SET NomLangue = ? WHERE idLangue = ?");
        $stmt->bind_param("si", $NomLangue, $id);
        if($stmt->execute()) {
            return ["success" => true];
        }
        return ["success" => false, "error" => $this->conn->error];
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM Langue WHERE idLangue = ?");
        $stmt->bind_param("i", $id);
        if($stmt->execute()) {
            return ["success" => true];
        }
        return ["success" => false, "error" => $this->conn->error];
    }
}
?>