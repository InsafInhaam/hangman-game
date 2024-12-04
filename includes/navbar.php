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
        align-items: center;
        background-color: #333;
        padding: 1rem 2rem;
        color: white;
        position: relative;
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
        display: flex;
        align-items: center;
    }

    .navbar li a:hover {
        text-decoration: underline;
    }

    .navbar li i {
        margin-right: 0.5rem;
    }

    .score-display {
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    .user-greeting {
        margin-left: auto;
        color: #fff;
        font-weight: bold;
        position: absolute;
        right: 135px;
    }

    .btn-logout {
        background-color: #e74c3c;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-logout:hover {
        background-color: #c0392b;
    }
</style>
<nav class="navbar mb-5">
    <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="index.php"><i class="fas fa-gamepad"></i> Play Hangman</a></li>
        <li class="score-display"><i class="fas fa-star"></i> Score: &nbsp; <span id="score">0</span></li>
        <li class="score-display"><i class="fas fa-heart"></i> Life Chances: &nbsp; <span id="lifeChances">3</span></li>
        <?php if (!empty($userName)): ?>
            <li class="user-greeting">Welcome, <?php echo $userName; ?>!</li>
        <?php endif; ?>
    </ul>
    <?php if (!empty($userName)): ?>
        <button class="btn-logout" onclick="logout()">Logout</button>
    <?php endif; ?>
</nav>