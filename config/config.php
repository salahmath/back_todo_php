<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS,DELETE,PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$host = 'localhost';
$dbname = 'todo-php';
$user = 'root'; // Votre utilisateur MySQL
$password = ''; // Votre mot de passe MySQL

// Créer une connexion
$conn = new mysqli($host, $user, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die('Erreur de connexion : ' . $conn->connect_error);
}
?>
