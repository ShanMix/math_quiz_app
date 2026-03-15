<?php
include "db.php";

$user_id = 2; 
$score = 80;
$correct = 8;
$wrong = 2;
$accuracy = 80;

$sql = "INSERT INTO quiz_history 
        (user_id, score, correct_answers, wrong_answers, accuracy)
        VALUES 
        ('$user_id', '$score', '$correct', '$wrong', '$accuracy')";

if ($conn->query($sql) === TRUE) {
    echo "Score saved!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
