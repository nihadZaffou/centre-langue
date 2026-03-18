<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "centrelangues"; // vérifie le nom exact

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

echo "Connexion réussie !<br>";

// Vérifier la base utilisée
$result = $conn->query("SELECT DATABASE() as dbname");
$row = $result->fetch_assoc();
echo "Base connectée : " . $row['dbname'] . "<br>";

// Vérifier si la table Utilisateur existe
$result2 = $conn->query("SHOW TABLES LIKE 'Utilisateur'");
if($result2->num_rows > 0){
    echo "Table Utilisateur trouvée !";
} else {
    echo "Table Utilisateur NON trouvée !";
}
?>