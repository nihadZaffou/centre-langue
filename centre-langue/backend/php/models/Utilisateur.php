<?php
require_once __DIR__ . '/../config/Database.php';
class Utilisateur {
    //la connex a la bd en memoire objet mysqli
    private $conn;
    public $idUser;
    public $NomUser;
    public $PrenomUser;
    public $DateNaissanceUser;
    public $EmailUser;
    public $AdresseUser;
    public $PhotoUser;
    public $MotpassUser;
    public $DateCreationUser;
    public $RoleUser;

    //donne la conex bd a l'objet cree
    public function __construct($db){
        $this->conn = $db;
    }
public function create($data){
    //random_bytes(4)=32 bits de hasard non lisible
    //bin2hex Convertit les bytes en texte lisible 
    $password = bin2hex(random_bytes(4));
    //PASSWORD_DEFAULT=algo utilise pour hashe
    $MotpassUser = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->conn->prepare(
        "INSERT INTO Utilisateur 
        (NomUser, PrenomUser, EmailUser, DateNaissanceUser, AdresseUser, PhotoUser, MotPassUser, RoleUser, DateCreationUser) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())"
    );
    $stmt->bind_param(
        "ssssssss",
        $data['NomUser'],
        $data['PrenomUser'],
        $data['EmailUser'],
        $data['DateNaissanceUser'],
        $data['AdresseUser'],
        $data['PhotoUser'],
        $MotpassUser,
        $data['RoleUser']
    );
    if($stmt->execute()){
        $this->idUser = $this->conn->insert_id;
        return [
            "idUser" => $this->idUser,
            "password" => $password
        ];
    }

    return false;
}
    public function getUserByEmail($email){
        $sql="SELECT * FROM Utilisateur WHERE EmailUser=?";
        $stmt=$this->conn->prepare($sql);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result=$stmt->get_result();
        if($result->num_rows>0){
        $row=$result->fetch_assoc();
        //transforme en tableau
        // Remplir les attributs de l'objet pour utiliser apres
        $this->idUser = $row['id_utilisateur'];
        $this->NomUser = $row['NomUser'];
        $this->PrenomUser = $row['PrenomUser'];
        $this->DateNaissanceUser = $row['DateNaissanceUser'];
        $this->EmailUser = $row['EmailUser'];
        $this->AdresseUser = $row['AdresseUser'];
        $this->PhotoUser = $row['PhotoUser'];
        $this->MotpassUser = $row['MotPassUser'];
        $this->DateCreationUser = $row['DateCreationUser'];
        $this->RoleUser = $row['RoleUser'];
            return $this;
        }else{
            return false;
        }

    }


// Récupérer le profil par id
public function getProfil($idUser) {
    $stmt = $this->conn->prepare(
        "SELECT id_utilisateur, NomUser, PrenomUser, EmailUser, 
         DateNaissanceUser, AdresseUser, PhotoUser, RoleUser, DateCreationUser
         FROM Utilisateur WHERE id_utilisateur = ?"
    );
    $stmt->bind_param("i", $idUser);
    $stmt->execute();
    //Les données sont copiées du serveur MySQL → vers PHP (mémoire)
    $result = $stmt->get_result();
    //le résultat reste dans le serveur MySQL->donne moi Un objet résultat php (mysqli_result)
    return $result->fetch_assoc();
    //transforme la ligne SQL en tableau associatif
}

// Changer le mot de passe
public function updatePassword($idUser, $newPassword) {
    //PASSWORD_DEFAULT=algo utilise pour hashe 
    $hash = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $this->conn->prepare(
        "UPDATE Utilisateur SET MotPassUser = ? WHERE id_utilisateur = ?"
    );
    $stmt->bind_param("si", $hash, $idUser);
    if($stmt->execute()) {
        return ["success" => true];
    }
    return ["success" => false, "error" => $this->conn->error];
}
}//SQL → récupérer ligne → transformer en objet → retourner objet
/* Après la connexion réussie, on crée une session PHP.
PHP stocke un identifiant unique (session id) côté serveur et envoie un cookie au navigateur.
À chaque requête suivante, le navigateur renvoie ce cookie, et PHP peut retrouver la session 
et savoir quel utilisateur est connecté.*/
?>