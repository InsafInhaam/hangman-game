<?php

$servername = "localhost"; // Hostname, usually "localhost"
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "banana-game";   // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
