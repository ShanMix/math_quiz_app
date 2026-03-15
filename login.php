<?php
session_start();
header('Content-Type: application/json');

include "db.php";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode([
        "success" => false,
        "message" => "Fill all fields"
    ]);
    exit;
}

// Query user
$stmt = $conn->prepare("SELECT id, password_hash, high_score FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo json_encode([
        "success" => false,
        "message" => "User not found"
    ]);
    exit;
}

$user = $result->fetch_assoc();
$stmt->close();

// Verify password
$password_hash = hash('sha256', $password);
if($user['password_hash'] === $password_hash){
    
    // Save in session
    $_SESSION['user_id'] = $user['id'];   
    $_SESSION['username'] = $username; 

    // Insert into login_history
    $insert = $conn->prepare("INSERT INTO login_history (user_id) VALUES (?)");
    $insert->bind_param("i", $user['id']);
    $insert->execute();
    $insert->close();

    // Get user's recent games for dashboard
    $recent_stmt = $conn->prepare("SELECT score, accuracy, played_at FROM quiz_history WHERE user_id = ? ORDER BY played_at DESC LIMIT 1");
    $recent_stmt->bind_param("i", $user['id']);
    $recent_stmt->execute();
    $recent_result = $recent_stmt->get_result();
    $recent_game = $recent_result->fetch_assoc();
    $recent_stmt->close();

    echo json_encode([
        "success" => true,
        "id" => $user['id'],
        "username" => $username,
        "high_score" => $user['high_score'],
        "recent_game" => $recent_game
    ]);
    exit;
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid credentials"
    ]);
    exit;
}

$conn->close();
?>