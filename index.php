<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spotify Quiz Game</title>
</head>
<?php 
include 'conn.php';
?>
<body>
    <div class = 'content'>
    <center><h1>Spotify Quiz</h1></center>
    <center><button onclick="join()">Join Game</button></center>
    <center><button onclick="create_new()">New Game</button></center><br>
  </div>
</body>
<script src = 'scripts.js'></script>
</html>