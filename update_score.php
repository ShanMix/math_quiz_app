<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$score = intval($_POST['score'] ?? 0);
$correct = intval($_POST['correct'] ?? 0);
$wrong = intval($_POST['wrong'] ?? 0);

// Calculate accuracy
$total = $correct + $wrong;
$accuracy = $total > 0 ? round(($correct / $total) * 100, 2) : 0;

include "db.php";

// Insert into quiz_history
$stmt = $conn->prepare("INSERT INTO quiz_history (user_id, score, accuracy, played_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iid", $user_id, $score, $accuracy);
if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'message' => 'Failed to save game history']);
    exit;
}
$stmt->close();

// Optional: update high_score in users table if this score is higher
$update = $conn->prepare("UPDATE users SET high_score = GREATEST(high_score, ?) WHERE id = ?");
$update->bind_param("ii", $score, $user_id);
$update->execute();
$update->close();

echo json_encode(['success' => true]);

$conn->close();
?>