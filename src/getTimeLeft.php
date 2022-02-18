<?php 


include '../conn.php';
session_start();
$code = $_SESSION['gameCode'];
//$code = '111111';
$time = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `GameSessions` WHERE Code = '$code'"))['CountDown'];
echo $time;

if ($_SESSION['userType'] == 2) {
    mysqli_query($conn, "UPDATE GameSessions SET CountDown = CountDown-1 WHERE Code = '$code'");
}
?>