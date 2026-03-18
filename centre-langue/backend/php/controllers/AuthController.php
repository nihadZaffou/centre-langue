<?php
require_once __DIR__ . '/../models/Utilisateur.php'; 
class AuthController{
    private $conn;
    public function __construct($db){
        $this->conn=$db;
    }
public function login($email, $password){
    if(empty($email) || empty($password)){
        return json_encode([
            "success" => false,
            "message" => "Email ou mot de passe manquant"
        ]);
    }
    $user = new Utilisateur($this->conn);
    // Cas 1 — email introuvable
    if(!$user->getUserByEmail($email)){
        return json_encode([
            "success" => false,
            "message" => "Aucun compte trouvé avec cet email"
        ]);
    }
    if(!password_verify($password, $user->MotpassUser)){
        return json_encode([
            "success" => false,
            "message" => "Mot de passe incorrect"
        ]);
    }
    // Cas 3 — succès
    $_SESSION['user_id']    = $user->idUser;
    $_SESSION['user_email'] = $user->EmailUser;
    $_SESSION['user_role']  = $user->RoleUser;
    return json_encode([
        "success" => true,
        "message" => "Connexion réussie",
        "user" => [
            "idUser"    => $user->idUser,
            "NomUser"   => $user->NomUser,
            "PrenomUser"=> $user->PrenomUser,
            "RoleUser"  => $user->RoleUser,
            "EmailUser" => $user->EmailUser
        ]
    ]);
}
public function logout(){
    session_destroy();
    header("Location: /centre-langue/centre-langue/frontend/html/login.php");
    exit();
}
   
   public function createUser($data){
    $userModel = new Utilisateur($this->conn);
    $result = $userModel->create($data);
    if(!$result){
        return json_encode([
            "success" => false,
            "message" => "Erreur création utilisateur"
        ]);
    }
    $idUser = $result['idUser'];
    $password = $result['password'];
    $roleCreated = false;
   if($data['RoleUser'] === "etudiant"){
    require_once __DIR__ . '/../models/Etudiant.php';
    $etudiant = new Etudiant($this->conn);
    $roleCreated = $etudiant->create($idUser, $data);
}
elseif($data['RoleUser'] === "gerant"){
    require_once __DIR__ . '/../models/Gerant.php';
    $gerant = new Gerant($this->conn);
    $roleCreated = $gerant->create($idUser);  // ← juste idUser, pas $data
}
elseif($data['RoleUser'] === "directeur"){
    require_once __DIR__ . '/../models/Directeur.php';
    $directeur = new Directeur($this->conn);
    $roleCreated = $directeur->create($idUser);  // ← juste idUser, pas $data
}
elseif($data['RoleUser'] === "prof"){
    require_once __DIR__ . '/../models/Prof.php';
    $prof = new Prof($this->conn);
    $roleCreated = $prof->create($idUser, $data);  // ← $data ajouté
}
    if(!$roleCreated){
        return json_encode([
            "success" => false,
            "message" => "Utilisateur créé mais rôle échoué",
            "debug_role" => $data['RoleUser'],
            "debug_idUser" => $idUser,
            "sql_error" => $this->conn->error  // ← affiche dans Postman aussi
        ]);
    }

    return json_encode([
        "success" => true,
        "message" => "Utilisateur et rôle créés avec succès",
        "password" => $password
    ]);
}
}