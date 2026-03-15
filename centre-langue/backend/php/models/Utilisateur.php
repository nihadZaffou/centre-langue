<?php
// ============================================
//  Utilisateur.php — Classe MÈRE abstraite
//  Correspond à la table Utilisateur (SQL)
//  Toutes les classes héritent de celle-ci
//  OO : classe abstraite, héritage, encapsulation
// ============================================

require_once __DIR__ . '/../config/Database.php';

abstract class Utilisateur {
    // Attributs protégés → accessibles aux classes filles
    protected ?int    $id        = null;
    protected string  $nom;
    protected string  $prenom;
    protected ?string $cin       = null;
    protected ?string $dateNaissance = null;
    protected ?string $telephone = null;
    protected string  $email;
    protected ?string $adresse   = null;
    protected ?string $photo     = null;
    protected string  $motPasse;

    protected PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnexion();
    }

    // ---- Getters ----
    public function getId(): ?int       { return $this->id; }
    public function getNom(): string    { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getEmail(): string  { return $this->email; }

    // ---- Setters ----
    public function setNom(string $nom): void       { $this->nom = $nom; }
    public function setPrenom(string $prenom): void { $this->prenom = $prenom; }
    public function setEmail(string $email): void   { $this->email = $email; }
    public function setMotPasse(string $mp): void   { $this->motPasse = password_hash($mp, PASSWORD_BCRYPT); }

    // ---- Méthodes abstraites (chaque classe fille DOIT les implémenter) ----
    abstract public function sauvegarder(): bool;
    abstract public function trouverParId(int $id): ?array;

    // ---- Méthode commune : insérer dans Utilisateur ----
    protected function insererUtilisateur(): int {
        $sql = "INSERT INTO Utilisateur 
                (NomUser, PrenomUser, CinUser, DateNaissanceUser, TelephoneUser,
                 EmailUser, AdresseUser, PhotoUser, MotPassUser)
                VALUES (:nom, :prenom, :cin, :dateNaissance, :tel,
                        :email, :adresse, :photo, :motPasse)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom'           => $this->nom,
            ':prenom'        => $this->prenom,
            ':cin'           => $this->cin,
            ':dateNaissance' => $this->dateNaissance,
            ':tel'           => $this->telephone,
            ':email'         => $this->email,
            ':adresse'       => $this->adresse,
            ':photo'         => $this->photo,
            ':motPasse'      => $this->motPasse,
        ]);
        return (int) $this->db->lastInsertId();
    }
}
