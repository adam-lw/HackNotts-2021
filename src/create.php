<?php 

session_start();

include '../conn.php';

//if (!isset($_SESSION['gameCode'])) {

$key = rand(100000,999999);

$sql = mysqli_query($conn, "INSERT INTO GameSessions(Code, Question, CountDown,  State) VALUES ('$key',0, 0, 1)");

$_SESSION['gameCode'] = $key;
$_SESSION['userType'] = 2;
//check_query($conn, $sql);

/*
} else {
    $key = $_SESSION['gameCode'];
}
*/
echo $key;
?>