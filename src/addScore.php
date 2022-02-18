<?php 

include '../conn.php';
session_start();

$playerID = $_SESSION['playerID'];
$code = $_POST['code'];
$index = $_POST['answer'];
$qnum = $_POST['question'];

if ($index != -1) {
    $question = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM Questions WHERE GameSessionID = '$code' AND Number = '$qnum' "));
    $answers = [$question['Answer1'], $question['Answer2'],$question['Answer3'],$question['Answer4']];
    $correct = $question['CorrectAnswer'];
    
    if ($answers[$index] == $correct) {
        mysqli_query($conn, "UPDATE Players SET Score = Score+100 WHERE GameSessionID = '$code' AND ID = '$playerID'");
    }
}
?>