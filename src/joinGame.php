<?php 

include '../conn.php';
session_start();

$code = $_POST['code'];
$name = $_POST['name'];

$gameSessions = mysqli_query($conn, "SELECT * FROM GameSessions");
$check = false;

// check if game exists with code...
while ($gameSession = mysqli_fetch_array($gameSessions)) {
    $gameCode = $gameSession['Code'];
    $gameState = $gameSession['State'];

    if ($code == $gameCode && $gameState == 1) {
        $check = true;
        break;
    }
}

$_SESSION['gameCode'] = $gameCode;

// if true, insert player into game
if ($check) {

    // check if game exists with code...
    mysqli_query($conn, "REPLACE INTO Players(GameSessionID, PlayerName, Score) VALUES('$code', '$name',0) ");
    $_SESSION['playerID'] = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(ID) FROM Players"))['MAX(ID)'];
    header('Location: ../api.php');
} else {
    $_SESSION['error'] = 1;
    header('Location: ../join.php');
}

?>