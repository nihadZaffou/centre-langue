<?php
// ============================================
//  Directeur.php — Hérite de Utilisateur
//  Rôle : supervise le centre
// ============================================

require_once __DIR__ . '/Utilisateur.php';

class Directeur extends Utilisateur {
    public function __construct() {
        parent::__construct();
    }

    public function sauvegarder(): bool {
        try {
            $this->db->beginTransaction();
            $idUtilisateur = $this->insererUtilisateur();
            $sql = "INSERT INTO Directeur (idDirecteur) VALUES (:id)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $idUtilisateur]);
            $this->id = $idUtilisateur;
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function trouverParId(int $id): ?array {
        $sql = "SELECT u.* FROM Utilisateur u
                JOIN Directeur d ON u.id_utilisateur = d.idDirecteur
                WHERE d.idDirecteur = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }
}
