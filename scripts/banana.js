let solution = "";
let countdown = 30;
let timerInterval; 

function fetchDataAndDisplayImage() {
  fetch("https://marcconrad.com/uob/banana/api.php")
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      solution = data.solution;

      const imageContainer = document.getElementById("imageContainer");
      imageContainer.innerHTML = ""; // Clear previous image
      const imageElement = document.createElement("img");
      imageElement.src = data.question;
      imageElement.alt = "Question Image";
      imageContainer.appendChild(imageElement);
    })
    .catch((error) => {
      console.error("Error fetching image:", error);
      alert("Failed to fetch the image. Please try again later.");
    });
}

function checkText() {
  console.log("Button triggered");
  const userInput = document.getElementById("numberInput").value.trim();

  if (userInput === "") {
    alert("Please enter some text.");
  } else {
    if (userInput == solution) {
      console.log("Text matches!");
      resetChances();
    } else {
      console.log("Text does not match!");
      alert("Incorrect answer. Please try again.");
    }
  }
}

function updateTimer() {
  countdown--;
  document.getElementById("countdown").innerText = countdown;
  if (countdown <= 0) {
    clearInterval(timerInterval);
    gameOver();
  }
}

function gameOver() {
  alert("Game Over!");
  redirectToPage("index.php");
}

function resetChances() {
  localStorage.setItem(
    "hangmanChances",
    JSON.stringify({ chances: 3, timestamp: null })
  );
  alert("Your chances have been reset! You can now play Hangman again.");
  redirectToPage("index.php");
}

function redirectToPage(url) {
  console.log(`Redirecting to: ${url}`);
  setTimeout(() => {
    window.location.href = url;
  }, 1000);
}

// Initialize the timer
function initializeTimer() {
  document.getElementById("countdown").innerText = countdown;
  clearInterval(timerInterval);
  timerInterval = setInterval(updateTimer, 1000);
}

fetchDataAndDisplayImage();
initializeTimer();
