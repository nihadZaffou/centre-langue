<?php
// ============================================
//  index.php — Routeur principal (Front Controller)
//  Toutes les requêtes passent ici
//  Pattern : Front Controller
// ============================================

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

// Récupérer l'URL et la méthode HTTP
$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Décomposer l'URL : /etudiants/5 → ['etudiants', '5']
$parts = explode('/', trim($uri, '/'));
$ressource = $parts[0] ?? '';
$id        = isset($parts[1]) ? (int)$parts[1] : null;
$action    = $parts[2] ?? null;

// ---- Routing ----
switch ($ressource) {

    case 'etudiants':
        require_once __DIR__ . '/controllers/EtudiantController.php';
        $ctrl = new EtudiantController();
        if ($method === 'GET'  && !$id)     $ctrl->index();
        if ($method === 'GET'  && $id)      $ctrl->show($id);
        if ($method === 'POST' && !$id)     $ctrl->store();
        if ($method === 'PUT'  && $action === 'payer') $ctrl->marquerPaye($id);
        break;

    case 'auth':
        require_once __DIR__ . '/controllers/AuthController.php';
        $ctrl = new AuthController();
        if ($method === 'POST' && $id === 'login')  $ctrl->login();
        if ($method === 'POST' && $id === 'logout') $ctrl->logout();
        break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Route non trouvée"]);
        break;
}
