<?php
include '../config/config.php';

// Récupérer tous les todos
$sql = "SELECT * FROM todos";
$result = $conn->query($sql);

$todos = [];
while ($row = $result->fetch_assoc()) {
    $todos[] = $row;
}

// Retourner les données en JSON
header('Content-Type: application/json');
echo json_encode($todos);
?>
