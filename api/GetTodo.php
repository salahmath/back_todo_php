<?php
include '../config/config.php';
$id = $_GET['id'];

// Récupérer tous les todos
$sql = "SELECT * FROM todos where id=$id";
$result = $conn->query($sql);

$todos = [];
while ($row = $result->fetch_assoc()) {
    $todos[] = $row;
}

// Retourner les données en JSON
header('Content-Type: application/json');
echo json_encode($todos);
?>
