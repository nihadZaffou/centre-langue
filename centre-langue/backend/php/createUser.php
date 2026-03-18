<?php
header('Content-Type: application/json');
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/controllers/AuthController.php';

// Lire JSON raw
$input = json_decode(file_get_contents('php://input'), true);

// Utiliser $input au lieu de $_POST
$data = [
    'NomUser'          => $input['NomUser'] ?? '',
    'PrenomUser'       => $input['PrenomUser'] ?? '',
    'EmailUser'        => $input['EmailUser'] ?? '',
    'DateNaissanceUser'=> $input['DateNaissanceUser'] ?? '',
    'AdresseUser'      => $input['AdresseUser'] ?? '',
    'PhotoUser'        => $input['PhotoUser'] ?? '',
    'RoleUser'         => $input['RoleUser'] ?? '',
    'NomParent'        => $input['NomParent'] ?? '',
    'PrenomParent'     => $input['PrenomParent'] ?? '',
    'TelParent'        => $input['TelParent'] ?? '',
    'Paye'             => $input['Paye'] ?? 0,
    'Admis'            => $input['Admis'] ?? 0,
    'Specialite'       => $input['Specialite'] ?? ''
];

$controller = new AuthController($conn);
echo $controller->createUser($data);
?>