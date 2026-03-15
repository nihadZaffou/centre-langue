<?php
// ============================================
//  AuthController.php
//  Rôle : login / logout / vérification session
// ============================================

require_once __DIR__ . '/../config/Database.php';

class AuthController {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnexion();
    }

    // POST /auth/login
    public function login(): void {
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['email']) || empty($data['motPasse'])) {
            $this->repondreJSON(400, ["message" => "Email et mot de passe requis"]);
            return;
        }

        $sql = "SELECT * FROM Utilisateur WHERE EmailUser = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $data['email']]);
        $user = $stmt->fetch();

        if ($user && password_verify($data['motPasse'], $user['MotPassUser'])) {
            session_start();
            $_SESSION['user_id']    = $user['id_utilisateur'];
            $_SESSION['user_email'] = $user['EmailUser'];
            $this->repondreJSON(200, ["message" => "Connexion réussie", "id" => $user['id_utilisateur']]);
        } else {
            $this->repondreJSON(401, ["message" => "Identifiants incorrects"]);
        }
    }

    // POST /auth/logout
    public function logout(): void {
        session_start();
        session_destroy();
        $this->repondreJSON(200, ["message" => "Déconnexion réussie"]);
    }

    private function repondreJSON(int $code, array $data): void {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
