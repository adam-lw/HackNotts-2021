<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lobby</title>
    <link rel="stylesheet" href="../style.css">
</head>
<?php 
include 'conn.php';
session_start();
$playerID = $_SESSION['playerID'];
$gameCode = $_SESSION['gameCode'];
?>
<body>
    <!--<audio src="lounge_music.mp3"><p>If you are reading this, it is because your browser does not support the audio element.     </p></audio>-->
    <embed src="lounge_music.mp3" width="180" height="90" loop="false" autostart="false" hidden="true" />

    <div class = 'content'>
        <center><h1>Join a game</h1></center>
        <center><h2>Lobby</h1></center>
        <center>
            <div id= "lobby"></div>
        <center><br>
        <p>Waiting for others...</p>
    </div>
</body>
<script src = 'scripts.js'></script>
<script>

load_php_file('src/getLobby.php','#lobby',{code: 1});
/*
setInterval(function() {
    load_php_file('src/getLobby.php','#lobby',{code: 1});
}, 5000);
*/
setInterval(function() {
    $.ajax({
        url: "src/getLobby.php",
        method: "POST",
        data: {code: 1},
        success: function(data) {
          if (data == 'GameStarted') {
              window.location.href = "game.php";
          } else {
            $("#lobby").html(data);
          }
        }
    });
}, 5000);
</script>
</html>