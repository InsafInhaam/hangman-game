<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Register</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: "Arial", sans-serif;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      width: 100%;
      max-width: 400px;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      text-align: center;
    }

    h1 {
      margin-bottom: 20px;
    }

    input[type="email"],
    input[type="password"],
    input[type="text"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
    }

    button:hover {
      background-color: #0056b3;
    }

    .link {
      margin-top: 10px;
      display: block;
      color: #007bff;
      text-decoration: none;
    }

    .link:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <div class="container" id="loginContainer">
    <h1>Login</h1>
    <input type="email" id="loginEmail" placeholder="Email" required>
    <input type="password" id="loginPassword" placeholder="Password" required>
    <button onclick="login()">Login</button>
    <a href="#" class="link" onclick="toggleForms()">Don't have an account? Register</a>
    <p id="loginMessage"></p>
  </div>

  <div class="container" id="registerContainer" style="display: none;">
    <h1>Register</h1>
    <input type="text" id="registerName" placeholder="Name" required>
    <input type="email" id="registerEmail" placeholder="Email" required>
    <input type="password" id="registerPassword" placeholder="Password" required>
    <button onclick="register()">Register</button>
    <a href="#" class="link" onclick="toggleForms()">Already have an account? Login</a>
    <p id="registerMessage"></p>
  </div>

  <script>
    function toggleForms() {
      document.getElementById("loginContainer").style.display = document.getElementById("loginContainer").style.display === "none" ? "block" : "none";
      document.getElementById("registerContainer").style.display = document.getElementById("registerContainer").style.display === "none" ? "block" : "none";
    }

    function register() {
      const name = document.getElementById("registerName").value;
      const email = document.getElementById("registerEmail").value;
      const password = document.getElementById("registerPassword").value;

      fetch("function/auth.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `action=register&name=${name}&email=${email}&password=${password}`,
      })
        .then(response => response.json())
        .then(data => {
          document.getElementById("registerMessage").textContent = data.message;
        });
    }

    function login() {
      const email = document.getElementById("loginEmail").value;
      const password = document.getElementById("loginPassword").value;

      fetch("function/auth.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `action=login&email=${email}&password=${password}`,
      })
        .then(response => response.json())
        .then(data => {
          document.getElementById("loginMessage").textContent = data.message;
          window.location.href = "index.php"; // Redirect to protected page
        });
    }
  </script>

<?php include_once './includes/footer.php'; ?>
