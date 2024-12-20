<?php
include '../config/config.php';

// Récupérer les données envoyées par PUT
$data = json_decode(file_get_contents("php://input"), true);

// Vérification des données reçues
if (!isset($data['id']) || !isset($data['title']) || empty($data['title'])) {
    echo json_encode(['message' => 'ID et titre sont requis']);
    exit();
}

$id = $data['id'];
$title = $data['title'];

// Utiliser une requête préparée pour éviter les injections SQL
$sql = "UPDATE todos SET title = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $title, $id); // "si" : string, integer

// Exécuter la requête
if ($stmt->execute()) {
    echo json_encode(['message' => 'Todo mis à jour avec succès']);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(['message' => 'Erreur lors de la mise à jour du todo']);
}

// Fermer la déclaration et la connexion
$stmt->close();
$conn->close();
?>
