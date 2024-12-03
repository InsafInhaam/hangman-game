<?php
session_start();
require 'db/config.php'; // Adjust the path to your config file

// Check if user is logged in
$userName = '';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch the user's name from the database
    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($name);
    if ($stmt->fetch()) {
        $userName = htmlspecialchars($name); // Sanitize output
    }
    $stmt->close();
}
?>

<style>
    .navbar {
        display: flex;
        justify-content: space-between;
        background-color: #333;
        padding: 1rem;
        color: white;
    }

    .navbar ul {
        list-style: none;
        display: flex;
        gap: 2rem;
        margin: 0;
        padding: 0;
    }

    .navbar li a {
        color: white;
        text-decoration: none;
    }

    .score-display {
        font-weight: bold;
    }

    .user-greeting {
        margin-left: auto;
        color: #fff;
        font-weight: bold;
        position: absolute;
        right: 20px;
    }
</style>
<nav class="navbar mb-5">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php">Play Hangman</a></li>
        <li class="score-display">Score: <span id="score">0</span></li>
        <?php if (!empty($userName)): ?>
            <li class="user-greeting">Welcome, <?php echo $userName; ?>!</li>
        <?php endif; ?>
    </ul>
</nav>