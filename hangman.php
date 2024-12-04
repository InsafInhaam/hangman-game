<?php include_once './includes/header.php'; ?>
<?php include_once './includes/navbar.php'; ?>

<div class="hangman">
    <div class="game-modal">
        <div class="content">
            <img src="#" alt="gif">
            <h4>Game Over!</h4>
            <p>The correct word was: <b>rainbow</b></p>
            <button class="play-again">Play Again</button>
        </div>
    </div>
    <div class="container">
        <div class="hangman-box">
            <img src="#" draggable="false" alt="hangman-img">
            <h1>Hangman Game</h1>
        </div>
        <div class="game-box">
            <div>
                <h2>
                    Answer the quiz for <span class="text-capitalize"><?php echo $_GET['language']; ?></span> questions.
                </h2>
                <br>
                <div class="timer">
                    <b>Time Left: </b><span id="timer">60</span> seconds
                </div>
            </div>
            <br><br>
            <ul class="word-display"></ul>
            <h4 class="hint-text">Hint: <b></b></h4>
            <h4 class="guesses-text">Incorrect guesses: <b></b></h4>
            <div class="keyboard"></div>
        </div>
    </div>
</div>

<?php include_once './includes/footer.php'; ?>