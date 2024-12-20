<?php
session_start();
header("Content-Type: application/json");

include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $email = $data['email'];
    $password = $data['password'];

    if (empty($email) || empty($password)) {
        echo json_encode(["message" => "Tous les champs sont obligatoires."]);
        exit();
    }

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $email;
            echo json_encode(["message" => "Connexion réussie.", "userId" =>  $user['id']]);
        } else {
            echo json_encode(["message" => "Mot de passe incorrect."]);
        }
    } else {
        echo json_encode(["message" => "Utilisateur non trouvé."]);
    }

    $stmt->close();
}
$conn->close();
?>
