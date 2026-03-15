<?php
// ============================================
//  Prof.php — Hérite de Utilisateur
//  Rôle : enseigner, gérer présences
// ============================================

require_once __DIR__ . '/Utilisateur.php';

class Prof extends Utilisateur {
    public function __construct() {
        parent::__construct();
    }

    public function sauvegarder(): bool {
        try {
            $this->db->beginTransaction();
            $idUtilisateur = $this->insererUtilisateur();
            $sql = "INSERT INTO Prof (idProf) VALUES (:id)";
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
                JOIN Prof p ON u.id_utilisateur = p.idProf
                WHERE p.idProf = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function tousLesProfs(): array {
        $sql = "SELECT u.id_utilisateur, u.NomUser, u.PrenomUser, u.EmailUser
                FROM Utilisateur u
                JOIN Prof p ON u.id_utilisateur = p.idProf
                ORDER BY u.NomUser";
        return $this->db->query($sql)->fetchAll();
    }
}
