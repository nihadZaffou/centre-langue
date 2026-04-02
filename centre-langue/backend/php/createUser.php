<?php
session_start();

require_once __DIR__ . '/config/Database.php';   // chemin correct vers Database.php
require_once __DIR__ . '/controllers/AuthController.php'; // chemin correct vers le controller
$db = new Database();
$conn = $db->getConnection();
// Instancier le controller
$authController = new AuthController($conn);
// Lire les données JSON envoyées
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
// Vérifier que les données existent
if(!$data){
    header('Content-Type: application/json');
    echo json_encode([
        "success" => false,
        "message" => "Aucune donnée reçue"
    ]);
    exit;
}

// Appeler la méthode createUser
$response = $authController->createUser($data);

// Retour JSON
header('Content-Type: application/json');
echo $response;