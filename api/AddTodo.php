<?php
include '../config/config.php';

// Récupérer les données envoyées par POST
$data = json_decode(file_get_contents("php://input"), true);
$title = $data['title'];
$userId = $data['userId']; // Récupérer l'userId

// Vérifier si le titre est vide
if (empty($title)) {
    echo json_encode(['message' => 'Le titre de la tâche ne peut pas être vide.']);
    exit();
}

// Vérifier si l'userId est valide
if (empty($userId)) {
    echo json_encode(['message' => 'Utilisateur non connecté.']);
    exit();
}

// Insérer dans la base de données avec l'`userId`
$sql = "INSERT INTO todos (title, userId) VALUES ('$title', '$userId')";
if ($conn->query($sql)) {
    echo json_encode(['id' => $conn->insert_id, 'title' => $title, 'is_completed' => false,'userId' => $userId,]);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Erreur lors de l\'ajout du todo']);
}
?>
