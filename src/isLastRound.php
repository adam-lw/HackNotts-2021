<?php

include '../conn.php';
session_start();


$code = $_SESSION['gameCode'];
$qnum = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM GameSessions WHERE Code = '$code' "))['Question'];
$rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Questions WHERE GameSessionID = '$code'"));

if ($qnum == $rows+1) { // $rows
    mysqli_query($conn, "UDPATE GameSessions SET State = '0' WHERE Code = '$code' ");
    echo 1;
} else {
    echo 0;
}

?>