<?php
require '../db/config.php'; 

session_start();
$user_id = $_SESSION['user_id']; // Assume session has the user ID

if (isset($user_id)) {
    $stmt = $conn->prepare("SELECT score FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode(['score' => $row['score']]);
    } else {
        echo json_encode(['score' => 0]);
    }
    $stmt->close();
} else {
    echo json_encode(['score' => 0]);
}

$conn->close();
?>
