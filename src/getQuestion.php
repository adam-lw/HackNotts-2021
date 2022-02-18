<?php 


include '../conn.php';
session_start();
$code = $_SESSION['gameCode'];

    
$questionNumber = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `GameSessions` WHERE Code = '$code'"))['Question'];
//$questionNumber = 1;
$question = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM Questions WHERE GameSessionID = '$code' AND Number = '$questionNumber' "));


$title = $question['Question'];
$type = $question['Type'];
$answer1 = $question['Answer1'];
$answer2 = $question['Answer2'];
$answer3 = $question['Answer3'];
$answer4 = $question['Answer4'];
$correctAnswer = $question['CorrectAnswer'];
$url = $question['URL'];

echo "<center><h1 style = 'margin-top:0'>Question $questionNumber</h1></center>
              <h3>$title</h3>";

   
   
if ($type == "TRACK") {
    
    $spotifyID = $question['SpotifyID'];
    
    echo '<center>
               <div>
               <iframe id = "iframe" style="border-radius:12px" src="https://open.spotify.com/embed/track/'.$spotifyID.'?utm_source=generator" width="100%" height="300" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" onload = "autoplay()"></iframe>
               </div>
           </center>';
    
} else {
    if ($url != "" && $type != "PLAYER") {
       echo "<center>
               <div>
               <img style = 'max-height:30vh' src='$url' alt='HTML'>
               </div>
           </center>";
    }
}
  
echo "<br>";


// ANSWERS

echo "
        <center>
            <table class='choiceBox'>
                <tbody>
                <tr>
                    <td><button class = 'btn' id = 'ans-0' onclick='checkAnswer(0, $code, $questionNumber)'>$answer1</button></td>
                    <td><button class = 'btn' id = 'ans-1' onclick='checkAnswer(1, $code, $questionNumber)'>$answer2</button></td>
                </tr>
                <tr>
                    <td><button class = 'btn' id = 'ans-2' onclick='checkAnswer(2, $code, $questionNumber)'>$answer3</button></td>
                    <td><button class = 'btn' id = 'ans-3' onclick='checkAnswer(3, $code, $questionNumber)'>$answer4</button></td>
                </tr>
                </tbody>
            </table>
        </center>

";


   // $_SESSION['correctAnswer'] = $correctAnswer;
?>