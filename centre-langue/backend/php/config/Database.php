<?php
// ============================================
//  Database.php — Connexion MySQL
//  Pattern : Singleton (une seule instance PDO)
//  Rôle    : Fournir la connexion à toute l'app
// ============================================

class Database {
    // Paramètres de connexion
    private string $host     = "localhost";
    private string $dbname   = "centrelangues";
    private string $user     = "root";
    private string $password = "";

    // Instance unique (Singleton)
    private static ?Database $instance = null;
    private ?PDO $connexion = null;

    // Constructeur privé → empêche new Database()
    private function __construct() {}

    // Point d'accès unique à l'instance
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Retourne la connexion PDO (la crée si nécessaire)
    public function getConnexion(): PDO {
        if ($this->connexion === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
                $this->connexion = new PDO($dsn, $this->user, $this->password, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                // En production : logger l'erreur, ne pas l'afficher
                http_response_code(500);
                echo json_encode(["erreur" => "Connexion échouée"]);
                exit;
            }
        }
        return $this->connexion;
    }
}
