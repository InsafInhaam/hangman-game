document.addEventListener("DOMContentLoaded", () => {
  const urlParams = new URLSearchParams(window.location.search);
  const selectedLanguage = urlParams.get("language") || "html"; // Default to HTML
  const wordList = getWordList(selectedLanguage);

  if (!wordList.length) {
    alert("No words available for this language.");
    return;
  }

  const wordDisplay = document.querySelector(".word-display");
  const guessesText = document.querySelector(".guesses-text b");
  const keyboardDiv = document.querySelector(".keyboard");
  const hangmanImage = document.querySelector(".hangman-box img");
  const gameModal = document.querySelector(".game-modal");
  const playAgainBtn = gameModal.querySelector("button");

  // Initializing game variables
  let currentWord, correctLetters, wrongGuessCount;
  const maxGuesses = 6;

  let timerInterval;
  const maxTime = 60;
  let timeLeft = maxTime;

  // let score = parseInt(localStorage.getItem("hangmanScore")) || 0;
  // document.getElementById("score").innerText = score;

  const startTimer = () => {
    timeLeft = maxTime;
    document.getElementById("timer").innerText = timeLeft;

    timerInterval = setInterval(() => {
      timeLeft--;
      document.getElementById("timer").innerText = timeLeft;

      if (timeLeft <= 10) {
        document.getElementById("timer").style.color = "red";
      }

      if (timeLeft <= 0) {
        clearInterval(timerInterval);
        gameOver(false); // Game over if timer runs out
      }
    }, 1000);
  };

  const stopTimer = () => {
    clearInterval(timerInterval);
  };

  const initChances = () => {
    let chancesData = JSON.parse(localStorage.getItem("hangmanChances"));

    if (
      !chancesData ||
      !chancesData.timestamp ||
      Date.now() > chancesData.timestamp
    ) {
      // Reset chances if 24 hours have passed
      chancesData = { chances: 3, timestamp: null };
      localStorage.setItem("hangmanChances", JSON.stringify(chancesData));
    }
  };

  const updateChances = () => {
    let chancesData = JSON.parse(localStorage.getItem("hangmanChances"));
    chancesData.chances--;

    if (chancesData.chances <= 0) {
      // Set 24-hour cooldown
      chancesData.timestamp = Date.now() + 24 * 60 * 60 * 1000;
    }

    localStorage.setItem("hangmanChances", JSON.stringify(chancesData));
  };

  const checkChances = () => {
    const chancesData = JSON.parse(localStorage.getItem("hangmanChances")) || {
      chances: 3,
      timestamp: null,
    };

    if (chancesData.chances <= 0 && Date.now() < chancesData.timestamp) {
      const remainingTime = Math.ceil(
        (chancesData.timestamp - Date.now()) / 1000 / 60
      );
      document.querySelector(".game-modal").innerHTML = `
      <div class="modal-content">
          <h4>Come back in ${remainingTime} minutes or play the alternative game to reset your chances!</h4>
          <button class="play-btn" onclick="window.location.href='banana.php'">Play Alternative Game</button>
      </div>
  `;
      document.querySelector(".game-modal").classList.add("show");
      return false;
    }
    return true;
  };

  // call initchancs before anything else
  initChances();

  const resetGame = () => {
    // Ressetting game variables and UI elements
    correctLetters = [];
    wrongGuessCount = 0;
    hangmanImage.src = "images/hangman-0.svg";
    guessesText.innerText = `${wrongGuessCount} / ${maxGuesses}`;
    wordDisplay.innerHTML = currentWord
      .split("")
      .map(() => `<li class="letter"></li>`)
      .join("");
    keyboardDiv
      .querySelectorAll("button")
      .forEach((btn) => (btn.disabled = false));
    gameModal.classList.remove("show");
  };

  const getRandomWord = () => {
    if (!checkChances()) return; // Block game if no chances left

    // Selecting a random word and hint from the wordList
    const { word, hint } =
      wordList[Math.floor(Math.random() * wordList.length)];
    currentWord = word; // Making currentWord as random word
    document.querySelector(".hint-text b").innerText = hint;
    resetGame();
    startTimer();
  };

  const gameOver = (isVictory) => {
    stopTimer();

    if (!isVictory) updateChances();

    if (isVictory) {
      score = 10;
      // document.getElementById("score").innerText = score;
      // localStorage.setItem("hangmanScore", score);

      // Send updated score to the backend
      fetch(TEMPERDIR + "function/update_score.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ score: score }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (!data.success) {
            console.error("Error updating score:", data.message);
          }
        })
        .catch((err) => console.error("Error:", err));
    }

    // After game complete.. showing modal with relevant details
    const modalText = isVictory
      ? `You found the word:`
      : "The correct word was:";
    gameModal.querySelector("img").src = `images/${
      isVictory ? "victory" : "lost"
    }.gif`;
    gameModal.querySelector("h4").innerText = isVictory
      ? "Congrats!"
      : "Game Over!";
    gameModal.querySelector(
      "p"
    ).innerHTML = `${modalText} <b>${currentWord}</b>`;
    gameModal.classList.add("show");
  };

  const initGame = (button, clickedLetter) => {
    // Checking if clickedLetter is exist on the currentWord
    if (currentWord.includes(clickedLetter)) {
      // Showing all correct letters on the word display
      [...currentWord].forEach((letter, index) => {
        if (letter === clickedLetter) {
          correctLetters.push(letter);
          wordDisplay.querySelectorAll("li")[index].innerText = letter;
          wordDisplay.querySelectorAll("li")[index].classList.add("guessed");
        }
      });
    } else {
      // If clicked letter doesn't exist then update the wrongGuessCount and hangman image
      wrongGuessCount++;
      hangmanImage.src = `images/hangman-${wrongGuessCount}.svg`;
    }
    button.disabled = true; // Disabling the clicked button so user can't click again
    guessesText.innerText = `${wrongGuessCount} / ${maxGuesses}`;

    // Calling gameOver function if any of these condition meets
    if (wrongGuessCount === maxGuesses) return gameOver(false);
    if (correctLetters.length === currentWord.length) return gameOver(true);
  };

  // Creating keyboard buttons and adding event listeners
  for (let i = 97; i <= 122; i++) {
    const button = document.createElement("button");
    button.innerText = String.fromCharCode(i);
    keyboardDiv.appendChild(button);
    button.addEventListener("click", (e) =>
      initGame(e.target, String.fromCharCode(i))
    );
  }
  
  getRandomWord();
  playAgainBtn.addEventListener("click", getRandomWord);
});
