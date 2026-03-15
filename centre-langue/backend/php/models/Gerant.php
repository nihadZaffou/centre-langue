<?php
// ============================================
//  Gerant.php — Hérite de Utilisateur
//  Rôle : publier annonces, valider attestations
// ============================================

require_once __DIR__ . '/Utilisateur.php';

class Gerant extends Utilisateur {
    public function __construct() {
        parent::__construct();
    }

    public function sauvegarder(): bool {
        try {
            $this->db->beginTransaction();
            $idUtilisateur = $this->insererUtilisateur();
            $sql = "INSERT INTO Gerant (idGerant) VALUES (:id)";
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
                JOIN Gerant g ON u.id_utilisateur = g.idGerant
                WHERE g.idGerant = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }
}
