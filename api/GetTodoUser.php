<?php
include '../config/config.php';

$userId = $_GET['userId'];

// Récupérer tous les todos
$sql = "SELECT * FROM todos where  userId=$userId";
$result = $conn->query($sql);

$todos = [];
while ($row = $result->fetch_assoc()) {
    $todos[] = $row;
}

// Retourner les données en JSON
header('Content-Type: application/json');
echo json_encode($todos);
?>
