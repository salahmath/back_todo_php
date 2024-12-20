<?php
include '../config/config.php';
$id = $_GET['id'];

// Récupérer tous les user
$sql = "SELECT * FROM users where id=$id";
$result = $conn->query(query: $sql);

$user = [];
while ($row = $result->fetch_assoc()) {
    $user[] = $row;
}

// Retourner les données en JSON
header('Content-Type: application/json');
echo json_encode($user);
?>
