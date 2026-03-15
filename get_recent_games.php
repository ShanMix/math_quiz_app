<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

include "db.php"; // your database connection

// Fetch last 3 games from quiz_history for this user
$stmt = $conn->prepare("SELECT score, accuracy, played_at FROM quiz_history WHERE user_id = ? ORDER BY played_at DESC LIMIT 3");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$games = [];
while ($row = $result->fetch_assoc()) {
    $games[] = [
        'score' => $row['score'],
        'accuracy' => $row['accuracy'] . '%',   // assuming accuracy is stored as number (e.g., 80)
        'date' => date('M d, H:i', strtotime($row['played_at']))
    ];
}

echo json_encode(['success' => true, 'games' => $games]);

$stmt->close();
$conn->close();
?>