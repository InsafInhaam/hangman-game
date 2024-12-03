<?php include_once './includes/header.php'; ?>
<?php include_once './includes/navbar.php'; ?>

<style>
  /* * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: "Arial", sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  } */

  .container {
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 20px;
    max-width: 1300px;
    width: 100%;
    text-align: center;
  }

  .left-icon {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 18px;
    margin-bottom: 20px;
  }

  .left-icon a {
    text-decoration: none;
    color: #000;
  }

  h1 {
    font-size: 24px;
    color: #444;
    margin-bottom: 20px;
  }

  .textbox-container .icon {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
  }

  input[type="text"] {
    flex: 1;
    padding: 15px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s ease;
  }

  input[type="text"]:focus {
    border-color: #007bff;
    outline: none;
  }

  button {
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    padding: 5px 15px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s ease;
  }

  button:hover {
    background-color: #0056b3;
  }

  button img {
    filter: invert(100%);
  }

  #timer {
    font-size: 20px;
    color: #fff;
    background-color: #007bff;
    padding: 10px;
    border-radius: 5px;
    width: fit-content;
    margin: 0 auto;
  }

  #imageContainer {
    margin-bottom: 20px;
  }

  a i {
    font-size: 24px;
    transition: transform 0.3s ease;
  }

  a:hover i {
    transform: scale(1.1);
  }
</style>

<div class="container p-3 my-3 border">
  <div class="left-icon d-flex justify-content-center pb-3">
    <a href="./index.php"><i class="fa-solid fa-circle-left" style="color: #000000"></i></a>
    <h2>Win this game to gain your life back</h2>
  </div>
  <div id="imageContainer"></div>
  <div class="p-3 my-3 text-white">
    <h1>What number is the banana</h1>
    <div class="textbox-container">
      <div class="icon">
        <input type="text" id="numberInput" />
        <button onclick="checkText()">
          <img width="50" height="40" src="https://img.icons8.com/quill/50/enter-2.png" alt="enter-2" />
        </button>
      </div>
    </div>
  </div>
  <div id="timer">Time Left: <span id="countdown">30</span> seconds</div>
</div>

<?php include_once './includes/footer.php'; ?>