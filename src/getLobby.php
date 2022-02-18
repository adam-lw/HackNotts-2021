<?php 

include '../conn.php';
session_start();

$gameCode = $_POST['code'];
if ($gameCode == 1) {
    $gameCode = $_SESSION['gameCode'];
} 

$gameSession = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM GameSessions WHERE Code = '$gameCode' "));

if (isset($gameSession['State']) and $gameSession['State']==2) {

    echo "GameStarted";

} else {

    echo "<table><tbody>";

    $players =  mysqli_query($conn, "SELECT * FROM Players WHERE GameSessionID = '$gameCode' ");

    while($player = mysqli_fetch_array($players)) {
        $name = $player['PlayerName'];
        echo "<tr><td><p style='margin: 0; padding: 0; font-weight: normal;'>$name</p></td></tr>";

    }

    echo "</tbody></table>";

}

?>