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
</style>
<nav class="navbar mb-5">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php">Play Hangman</a></li>
        <li class="score-display">Score: <span id="score">0</span></li>
    </ul>
</nav>