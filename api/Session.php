<?php
session_start();
include '../config/config.php';

header("Content-Type: application/json");

if (isset($_SESSION['user_id'])) {
    echo json_encode(["loggedIn" => true, "username" => $_SESSION['username']]);
} else {
    echo json_encode(["loggedIn" => false]);
}
?>