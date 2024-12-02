<?php
require '../db/config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['score'])) {
    $score = (int) $data['score'];

    $stmt = $conn->prepare(("SELECT score FROM users WHERE id = ?"));
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentScore = $row['score'];

        $newScore = $currentScore + $score;

        $updateStmt = $conn->prepare("UPDATE users SET score = ? WHERE id = ?");
        $updateStmt->bind_param("ii", $newScore, $user_id);

        if ($updateStmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Score updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update score']);
        }

        $updateStmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, 'message' => 'Score not provided']);
}

$conn->close();
?>