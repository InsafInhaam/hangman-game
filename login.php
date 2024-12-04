<?php include_once './includes/header.php'; ?>

<style>
  body {
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

  .alert {
    display: none;
    /* Initially hidden */
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    text-align: center;
  }

  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }

  .alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }
</style>

<div class="container" id="loginContainer">
  <h1>Login</h1>
  <p id="loginMessage"></p>
  <input type="email" id="loginEmail" placeholder="Email" required>
  <input type="password" id="loginPassword" placeholder="Password" required>
  <button onclick="login()">Login</button>
  <a href="#" class="link" onclick="toggleForms()">Don't have an account? Register</a>
</div>

<div class="container" id="registerContainer" style="display: none;">
  <h1>Register</h1>
  <p id="registerMessage"></p>
  <input type="text" id="registerName" placeholder="Name" required>
  <input type="email" id="registerEmail" placeholder="Email" required>
  <input type="password" id="registerPassword" placeholder="Password" required>
  <button onclick="register()">Register</button>
  <a href="#" class="link" onclick="toggleForms()">Already have an account? Login</a>
</div>

<script>
  function toggleForms() {
    document.getElementById("loginContainer").style.display =
      document.getElementById("loginContainer").style.display === "none"
        ? "block"
        : "none";
    document.getElementById("registerContainer").style.display =
      document.getElementById("registerContainer").style.display === "none"
        ? "block"
        : "none";
  }

  function showMessage(element, message, type = "danger") {
    element.textContent = message;
    element.className = `alert alert-${type}`; // Set class based on type
    element.style.display = "block"; // Show the message

    // Hide the message after 3 seconds
    setTimeout(() => {
      element.style.display = "none";
    }, 3000);
  }

  function register() {
    const name = document.getElementById("registerName").value.trim();
    const email = document.getElementById("registerEmail").value.trim();
    const password = document.getElementById("registerPassword").value.trim();
    const messageEl = document.getElementById("registerMessage");

    messageEl.style.display = "none"; // Hide message initially

    if (!name || !email || !password) {
      showMessage(messageEl, "All fields are required!", "danger");
      return;
    }

    if (!validateEmail(email)) {
      showMessage(messageEl, "Please enter a valid email address!", "danger");
      return;
    }

    if (password.length < 6) {
      showMessage(messageEl, "Password must be at least 6 characters!", "danger");
      return;
    }

    fetch("function/auth.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `action=register&name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`,
    })
      .then(response => response.json())
      .then(data => {
        showMessage(messageEl, data.message, data.status ? "success" : "danger");
      })
      .catch(error => {
        console.error("Error:", error);
        showMessage(messageEl, "An error occurred. Please try again.", "danger");
      });
  }

  function login() {
    const email = document.getElementById("loginEmail").value.trim();
    const password = document.getElementById("loginPassword").value.trim();
    const messageEl = document.getElementById("loginMessage");

    messageEl.style.display = "none"; // Hide message initially

    if (!email || !password) {
      showMessage(messageEl, "All fields are required!", "danger");
      return;
    }

    if (!validateEmail(email)) {
      showMessage(messageEl, "Please enter a valid email address!", "danger");
      return;
    }

    fetch("function/auth.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `action=login&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`,
    })
      .then(response => response.json())
      .then(data => {
        showMessage(messageEl, data.message, data.status ? "success" : "danger");
        if (data.status) {
          // setTimeout(() => {
            window.location.href = "index.php";
          // }, 1500); // Redirect after 1.5 seconds
        }
      })
      .catch(error => {
        console.error("Error:", error);
        showMessage(messageEl, "An error occurred. Please try again.", "danger");
      });
  }

  function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }
</script>

<?php include_once './includes/footer.php'; ?>