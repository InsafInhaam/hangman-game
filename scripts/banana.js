let solution = "";
let countdown = 30;
let timerInterval; // Declare timerInterval globally

function fetchDataAndDisplayImage() {
  fetch("https://marcconrad.com/uob/banana/api.php")
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      const imageUrl = data.question;
      solution = data.solution;

      const imageElement = document.createElement("img");
      imageElement.src = imageUrl;

      document.getElementById("imageContainer").appendChild(imageElement);
    })
    .catch((error) => {
      console.error("Error fetching image:", error);
    });
}

function checkText() {
  console.log("button triggered");
  const userInput = document.getElementById("numberInput").value.trim();

  if (userInput === "") {
    alert("Please enter some text.");
  } else {
    if (userInput == solution) {
      // alert("Text matches!");
      console.log("Text matches!");
    //   refillHeartInUser();
    resetChances()
    } else {
      console.log("Text does not match!");
    //   redirectToIndexPage();
    }
  }
}

function updateTimer() {
  countdown--;
  document.getElementById("countdown").innerText = countdown;
  if (countdown <= 0) {
    clearInterval(timerInterval);
    gameOver();
    redirectToIndexPage();
  }
}

function gameOver() {
  alert("Game Over!");
  redirectToIndexPage();
}

const resetChances = () => {
  localStorage.setItem(
    "hangmanChances",
    JSON.stringify({ chances: 3, timestamp: null })
  );
  alert("Your chances have been reset! You can now play Hangman again.");
};


// function refillHeartInUser() {
//   $.post(
//     "http://localhost/tomato-API-game/functions/refillHeartHandler.php",
//     (response) => {
//       // response from PHP back-end
//       console.log(response);
//       redirectToGamePage();
//     }
//   );
// }

// function redirectToIndexPage() {
//   console.log("redirectindexPage");
//   setTimeout(() => {
//     window.location.href = "http://localhost/tomato-API-game/index.php";
//   }, 1000); // Delay in milliseconds before redirection (adjust as needed)
// }

// function redirectToGamePage() {
//   console.log("redirectToGamePage");
//   setTimeout(() => {
//     window.location.href = "http://localhost/tomato-API-game/game.php";
//   }, 1000); // Delay in milliseconds before redirection (adjust as needed)
// }

// Add timer
updateTimer(); // Call updateTimer() initially
timerInterval = setInterval(updateTimer, 1000); // Start timerInterval

fetchDataAndDisplayImage();