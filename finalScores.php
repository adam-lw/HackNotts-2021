<!DOCTYPE html>
<html>
<head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <link rel="stylesheet" href="../style.css">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Spotify Quiz Game</title>
</head>
<?php
//include 'conn.php';
?>
<body>
   <div class = 'content'>
   <center><h1>Final Scores</h1></center>
   <center><div id="scoreboard"></div></center><br>
   <center><button onclick="play_again()">Play Again</button></center>
   </div>
</body>
<script src = 'scripts.js'></script>
<script>
   load_php_file('src/getScoreboard.php','#scoreboard',{code: 1});
   function play_again() {
        window.location.href = "index.php";
}

</script>
</html>
 
 
