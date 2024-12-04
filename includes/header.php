<?php
session_start();

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : 'http';
$host = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];
$fullUrl = "$protocol://$host$requestUri";

$baseUrl = parse_url($fullUrl, PHP_URL_PATH);
$TEMPERDIR = "http://localhost/hangman-game/";

if (!$baseUrl == '/hangman-game/login.php'):
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Language Quiz</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="style.css">

    <script>
        var TEMPERDIR = "http://localhost/hangman-game/" 
    </script>

    <?php if ($baseUrl == '/hangman-game/hangman.php'): ?>
        <script src="scripts/wordlist.js" defer></script>
        <script src="scripts/script.js" defer></script>
    <?php endif; ?>
    <?php if ($baseUrl == '/hangman-game/banana.php'): ?>
        <script src="scripts/banana.js" defer></script>
    <?php endif; ?>

</head>

<body>