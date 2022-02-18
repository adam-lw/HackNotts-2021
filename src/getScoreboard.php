<?php
 
include '../conn.php';
session_start();
 
$gameCode = $_POST['code'];
if ($gameCode == 1) {
   $gameCode = $_SESSION['gameCode'];
}
 
$gameSession = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM GameSessions WHERE Code = '$gameCode' "));
 
if ($gameSession['State']==1) {
 
   echo "Game hasn't started yet";
 
} else {
 
   echo "<table><tbody>";
 
   $players =  mysqli_query($conn, "SELECT * FROM Players WHERE GameSessionID = '$gameCode' ORDER BY Score DESC");
 
   $place = 0;
   while($player = mysqli_fetch_array($players)) {
 
       $place = $place + 1;
 
       $score = $player['Score'];
       $name = $player['PlayerName'];
       echo "<tr><td>$place.</td><td>$name</td><td>$score</td></tr>";
 
   }
 
   echo "</tbody></table>";
 
}
 
?>
 
 
