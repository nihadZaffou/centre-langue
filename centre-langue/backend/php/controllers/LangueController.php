<?php
require_once __DIR__ . '/../models/Langue.php';

class LangueController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        if(empty($data['NomLangue'])){
            return json_encode(["success" => false, "message" => "Nom de langue obligatoire"]);
        }

        $langue = new Langue($this->conn);
        $result = $langue->create($data['NomLangue']);

        if($result){
            return json_encode(["success" => true, "message" => "Langue créée avec succès"]);
        }
        return json_encode(["success" => false, "message" => "Erreur création langue : " . $this->conn->error]);
    }

    public function getAll() {
        $langue = new Langue($this->conn);
        $result = $langue->getAll();

        if(!$result){
            return json_encode(["success" => false, "message" => "Erreur récupération langues"]);
        }

        $langues = [];
        while($row = $result->fetch_assoc()){
            $langues[] = $row;
        }

        return json_encode(["success" => true, "data" => $langues]);
    }

    public function update($data) {
        if(empty($data['idLangue']) || empty($data['NomLangue'])){
            return json_encode(["success" => false, "message" => "ID et Nom obligatoires"]);
        }

        $langue = new Langue($this->conn);
        $result = $langue->update($data['idLangue'], $data['NomLangue']);

        if($result){
            return json_encode(["success" => true, "message" => "Langue modifiée avec succès"]);
        }
        return json_encode(["success" => false, "message" => "Erreur modification : " . $this->conn->error]);
    }

    public function delete($data) {
        if(empty($data['idLangue'])){
            return json_encode(["success" => false, "message" => "ID obligatoire"]);
        }

        $langue = new Langue($this->conn);
        $result = $langue->delete($data['idLangue']);

        if($result){
            return json_encode(["success" => true, "message" => "Langue supprime avec succes"]);
        }
        return json_encode(["success" => false, "message" => "Erreur suppression : " . $this->conn->error]);
    }
}
?>