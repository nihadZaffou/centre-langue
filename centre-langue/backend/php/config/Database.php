<?php

$host="localhost";
$user="root";
$password="";
$database="centrelangues";

$conn=new mysqli($host,$user,$password,$database);

if($conn->connect_error){
    die("Connexion echouée: ".$conn->connect_error);
}

?>