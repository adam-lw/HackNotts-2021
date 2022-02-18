<?php 

include '../conn.php';
session_start();
$code = $_SESSION['gameCode'];
$num_users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Players WHERE GameSessionID = '$code'"));
echo $num_users;

?>