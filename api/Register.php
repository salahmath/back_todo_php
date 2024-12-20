<?php
session_start();
header("Content-Type: application/json");

include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $username = $data['username'];
    $password = $data['password'];
    $email = $data['email'];

    if (empty($username) || empty($password) || empty($email)) {
        echo json_encode(["message" => "Tous les champs sont obligatoires."]);
        exit();
    }

    // Vérifier si l'email existe déjà dans la base de données
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($emailExists);
    $stmt->fetch();
    $stmt->close();

    if ($emailExists > 0) {
        echo json_encode(["message" => "L'email est déjà utilisé."]);
        exit();
    }

    // Hash du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);
    
    if ($stmt->execute()) {
        $userId = $conn->insert_id;

        // Réponse avec les informations de l'utilisateur
        echo json_encode([
            "error" => false,
            "message" => "Inscription réussie.",
            "user" => [
                "id" => $userId,
                "username" => $username,
                "email" => $email
            ]
        ]);
    } else {
        echo json_encode(["message" => "Erreur inconnue lors de l'inscription."]);
    }

    $stmt->close();
}
$conn->close();
?>
