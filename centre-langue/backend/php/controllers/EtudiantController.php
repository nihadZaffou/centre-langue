<?php
// ============================================
//  EtudiantController.php
//  Rôle : reçoit requête HTTP → appelle Model → retourne JSON
//  OO   : classe, méthodes, séparation des responsabilités
// ============================================

require_once __DIR__ . '/../models/Etudiant.php';

class EtudiantController {
    private Etudiant $model;

    public function __construct() {
        $this->model = new Etudiant();
    }

    // GET /etudiants → liste tous les étudiants
    public function index(): void {
        $etudiants = $this->model->tousLesEtudiants();
        $this->repondreJSON(200, $etudiants);
    }

    // GET /etudiants/{id} → un étudiant
    public function show(int $id): void {
        $etudiant = $this->model->trouverParId($id);
        if ($etudiant) {
            $this->repondreJSON(200, $etudiant);
        } else {
            $this->repondreJSON(404, ["message" => "Étudiant non trouvé"]);
        }
    }

    // POST /etudiants → créer un étudiant
    public function store(): void {
        $data = json_decode(file_get_contents("php://input"), true);

        // Validation basique
        if (empty($data['nom']) || empty($data['email']) || empty($data['motPasse'])) {
            $this->repondreJSON(400, ["message" => "Champs obligatoires manquants"]);
            return;
        }

        $this->model->setNom($data['nom']);
        $this->model->setPrenom($data['prenom'] ?? '');
        $this->model->setEmail($data['email']);
        $this->model->setMotPasse($data['motPasse']);

        if (!empty($data['parentNom']))    $this->model->setParentNom($data['parentNom']);
        if (!empty($data['parentPrenom'])) $this->model->setParentPrenom($data['parentPrenom']);
        if (!empty($data['parentTel']))    $this->model->setParentTel($data['parentTel']);

        if ($this->model->sauvegarder()) {
            $this->repondreJSON(201, ["message" => "Étudiant créé avec succès"]);
        } else {
            $this->repondreJSON(500, ["message" => "Erreur lors de la création"]);
        }
    }

    // PUT /etudiants/{id}/payer → marquer payé
    public function marquerPaye(int $id): void {
        if ($this->model->marquerPaye($id)) {
            $this->repondreJSON(200, ["message" => "Paiement enregistré"]);
        } else {
            $this->repondreJSON(500, ["message" => "Erreur"]);
        }
    }

    // Méthode utilitaire : formater la réponse JSON
    private function repondreJSON(int $code, array $data): void {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
