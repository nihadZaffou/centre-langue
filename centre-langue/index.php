<?php
session_set_cookie_params([
    'path' => '/',   
    //Le cookie est valide pour toutes les pages du site.      
    'domain' => 'localhost',
    'secure' => false,
    'httponly' => true
]);
session_start();
require_once __DIR__ . '/backend/php/config/Database.php';
require_once __DIR__ . '/backend/php/controllers/AuthController.php';
$db = new Database();
$conn = $db->getConnection();
$route = $_GET['route'] ?? '';
switch($route){
    case 'login':
        $controller = new AuthController($conn);
        echo $controller->login($_POST['email'], $_POST['password']);
        break;
    case 'createUser':
        $controller = new AuthController($conn);
        echo $controller->createUser($_POST);
        break;
    case 'logout':
        $controller = new AuthController($conn);
        $controller->logout();
        break;
//-----------------------------Langue-----------------------
case 'createLangue':
    require_once 'controllers/LangueController.php';
    $controller = new LangueController($conn);
    echo $controller->create($_POST);
    break;

case 'getAllLangues':
    require_once 'controllers/LangueController.php';
    $controller = new LangueController($conn);
    echo $controller->getAll();
    break;

case 'updateLangue':
    require_once 'controllers/LangueController.php';
    $controller = new LangueController($conn);
    echo $controller->update($_POST);
    break;

case 'deleteLangue':
    require_once 'controllers/LangueController.php';
    $controller = new LangueController($conn);
    echo $controller->delete($_POST);
    break;
    default:
        echo json_encode(["success" => false, "message" => "Route inconnue: " . $route]);
        break;
}
