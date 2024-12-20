<?php
include '../config/config.php';
$id = $_GET['id'];

// Supprimer le todo
$sql = "DELETE FROM todos WHERE id=$id";
$result = $conn->query($sql);
$todo = $result->fetch_assoc();

if ($conn->query($sql)) {
    echo json_encode(['message' => $todo+' supprimé avec succès']);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Erreur lors de la suppression du todo']);
}
?>
