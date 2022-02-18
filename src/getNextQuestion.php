<?php


include '../conn.php';
session_start();
$code = $_SESSION['gameCode'];
if ($_SESSION['userType'] == 2) {
    mysqli_query($conn, "UPDATE GameSessions SET Question = Question +1 WHERE Code = '$code' ");
}
?>