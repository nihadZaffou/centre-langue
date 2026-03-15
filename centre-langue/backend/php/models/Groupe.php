<?php
// ============================================
//  Groupe.php — Gestion des groupes
//  Un groupe appartient à un Niveau
// ============================================

require_once __DIR__ . '/../config/Database.php';

class Groupe {
    private ?int    $id       = null;
    private string  $nom;
    private int     $capacite;
    private int     $idNiveau;
    private PDO     $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnexion();
    }

    public function setNom(string $nom): void         { $this->nom = $nom; }
    public function setCapacite(int $cap): void       { $this->capacite = $cap; }
    public function setIdNiveau(int $idNiveau): void  { $this->idNiveau = $idNiveau; }
    public function getId(): ?int                     { return $this->id; }

    public function sauvegarder(): bool {
        $sql = "INSERT INTO Groupe (NomGroupe, Capacite, idNiveau)
                VALUES (:nom, :capacite, :idNiveau)";
        $stmt = $this->db->prepare($sql);
        $ok = $stmt->execute([
            ':nom'      => $this->nom,
            ':capacite' => $this->capacite,
            ':idNiveau' => $this->idNiveau,
        ]);
        if ($ok) $this->id = (int) $this->db->lastInsertId();
        return $ok;
    }

    public function trouverParId(int $id): ?array {
        $sql = "SELECT g.*, n.NomNiveau, l.NomLangue
                FROM Groupe g
                JOIN Niveau n ON g.idNiveau = n.idNiveau
                JOIN Langue l ON n.idLangue = l.idLangue
                WHERE g.idGroupe = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function tousLesGroupes(): array {
        $sql = "SELECT g.*, n.NomNiveau, l.NomLangue
                FROM Groupe g
                JOIN Niveau n ON g.idNiveau = n.idNiveau
                JOIN Langue l ON n.idLangue = l.idLangue
                ORDER BY g.NomGroupe";
        return $this->db->query($sql)->fetchAll();
    }
}
