<?php
// ============================================
//  Etudiant.php — Hérite de Utilisateur
//  Correspond aux tables Utilisateur + Etudiant
//  OO : héritage, override méthodes abstraites
// ============================================

require_once __DIR__ . '/Utilisateur.php';

class Etudiant extends Utilisateur {
    // Attributs spécifiques à Etudiant
    private ?string $parentNom    = null;
    private ?string $parentPrenom = null;
    private ?string $parentTel    = null;
    private bool    $paye         = false;
    private bool    $admis        = false;

    public function __construct() {
        parent::__construct(); // appel constructeur mère
    }

    // ---- Getters / Setters spécifiques ----
    public function isPaye(): bool          { return $this->paye; }
    public function isAdmis(): bool         { return $this->admis; }
    public function setParentNom(string $n): void   { $this->parentNom = $n; }
    public function setParentPrenom(string $p): void { $this->parentPrenom = $p; }
    public function setParentTel(string $t): void   { $this->parentTel = $t; }
    public function setPaye(bool $p): void  { $this->paye = $p; }
    public function setAdmis(bool $a): void { $this->admis = $a; }

    // ---- Implémentation méthode abstraite : créer un étudiant ----
    public function sauvegarder(): bool {
        try {
            $this->db->beginTransaction();

            // 1. Insérer dans Utilisateur (classe mère)
            $idUtilisateur = $this->insererUtilisateur();

            // 2. Insérer dans Etudiant avec le même id
            $sql = "INSERT INTO Etudiant (idEtudiant, ParentNom, ParentPrenom, ParentTel, Paye, Admis)
                    VALUES (:id, :parentNom, :parentPrenom, :parentTel, :paye, :admis)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id'           => $idUtilisateur,
                ':parentNom'    => $this->parentNom,
                ':parentPrenom' => $this->parentPrenom,
                ':parentTel'    => $this->parentTel,
                ':paye'         => (int) $this->paye,
                ':admis'        => (int) $this->admis,
            ]);

            $this->id = $idUtilisateur;
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    // ---- Trouver un étudiant par son id (JOIN) ----
    public function trouverParId(int $id): ?array {
        $sql = "SELECT u.*, e.ParentNom, e.ParentPrenom, e.ParentTel, e.Paye, e.Admis
                FROM Utilisateur u
                JOIN Etudiant e ON u.id_utilisateur = e.idEtudiant
                WHERE e.idEtudiant = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    // ---- Lister tous les étudiants ----
    public function tousLesEtudiants(): array {
        $sql = "SELECT u.id_utilisateur, u.NomUser, u.PrenomUser, u.EmailUser,
                       e.Paye, e.Admis
                FROM Utilisateur u
                JOIN Etudiant e ON u.id_utilisateur = e.idEtudiant
                ORDER BY u.NomUser";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // ---- Marquer comme payé ----
    public function marquerPaye(int $id): bool {
        $sql = "UPDATE Etudiant SET Paye = 1 WHERE idEtudiant = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
