<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Game on</title>
    <link rel="stylesheet" href="../style.css">
</head>
<?php 
include 'conn.php';
session_start();
$playerID = $_SESSION['playerID'];
$gameCode = $_SESSION['gameCode'];
//echo "USER TYPE: ".$_SESSION['userType'];
?>
<body>
    <!-- CONTAINER FOR QUESTION: loaded via AJAX -->
    <div class = 'content'>
        <div id = 'timer'></div>
        <div id = 'question-container'></div>
    </div>
    <!--<button onclick ='test()'>remove this</button>-->
</body>
<script src = 'scripts.js'></script>
<script>


/*
function test() {
    load_php_file('src/addScore.php', null, { answer: savedAnswer, code: savedCode, question:savedQuestion })
    window.location.href = 'roundScore.php';
}
*/
function nextQuestion() {

     $.ajax({
        url: "src/isLastRound.php",
        method: "POST",
        data: {code: 1},
        success: function(data) {
            
          load_php_file("src/getQuestion.php", '#question-container', null);
          //load_php_file('src/nextQuestion.php',null,null);
          console.log("nextQuestion: "+data);
          /*
          if (data == 0) {
              console.log("REDIRECT");
              window.location.href = 'roundScore.php';
             
          } else */
          if (data == 1) {
             window.location.href = 'finalScores.php';
              
          }
        }
    });
       
}


nextQuestion();


let savedAnswer = -1;
let savedCode = "";
let savedQuestion = "";

setInterval(function() {
    
    $.ajax({
        url: "src/getTimeLeft.php",
        method: "POST",
        data: {code: 1},
        success: function(data) {
            console.log("time: "+data);
            
            $('#timer').html("<p>"+data+"</p>");
            if (data <= 0) {
              console.log(savedAnswer)
              load_php_file('src/addScore.php', null, { answer: savedAnswer, code: savedCode, question:savedQuestion })
              //load_php_file('src/nextQuestion.php',null,null);
              window.location.href = 'roundScore.php';
              //nextQuestion();
             
            };


              //load_php_file("src/getTimeLeft.php", '#timer', null);
              // update_timer(data)
          
        }
    });

    // call function every second
}, 1000);

function checkAnswer(answer, code, question) {
    savedAnswer = answer;
    savedCode = code;
    savedQuestion = question;
    console.log(answer)
    console.log(code)
    console.log(question)
    $('.btn').css("background-color","#6667AB");
    $('#ans-'+answer).css("background-color","#4b4c80");
    
}

</script>
</html>