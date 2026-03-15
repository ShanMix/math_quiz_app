<?php
session_start();

$host = "localhost";
$db = "math_quiz_app";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(["success" => false, "message" => "Fill all fields"]);
    exit;
}


$check = $conn->prepare("SELECT id FROM users WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Username already exists"]);
    exit;
}
$check->close();

$password_hash = hash("sha256", $password);


$stmt = $conn->prepare("INSERT INTO users (username, password_hash, high_score) VALUES (?, ?, 0)");
$stmt->bind_param("ss", $username, $password_hash);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Registration failed"]);
}

$stmt->close();
$conn->close();
?>
