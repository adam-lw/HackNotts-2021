<!DOCTYPE html>
<?php 

include 'conn.php';
session_start(); 
$code = $_SESSION['gameCode']; 
$numberQuestions = 10; // Number of questions to generate
$numPlayers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Players WHERE GameSessionID = '$code'")); // Placeholder number of players in the game

$players = mysqli_query($conn, "SELECT * FROM Players WHERE GameSessionID = '$code'");
$playerIDList = [];
$playerNameList = [];

$counter = 0;
while ($player = mysqli_fetch_array($players)) {
    // add player ID to playerList
    array_push($playerIDList, $player['ID']);
    array_push($playerNameList, $player['PlayerName']);
    $counter++;
}
//print_r($playerList);

// Question list
$questionList[0] = "Recently, which of these artists has <player> listened to the most?";
$questionList[1] = "Who is the biggest <artist> fan?";
$questionList[2] = "Recently who has listened to <track> by <artist> the most?"; 
$questionList[3] = "Which of these songs has <player> listened to the most?";
$questionList[4] = "Who is the biggest <genre> fan?";
$questionList[5] = "Which of these is <player>'s favourite genre?";

//print_r($questionList);


$outArray = [[]]; // Output array of questions, answers and other data for the DB

$bannedQuestions = []; // Questions get banned for 3 turns after they appear to avoid repeated questions
$recentQuestions = []; 

//Generate random table for selecting player targets 
$turnsPerPlayer = $numberQuestions / $numPlayers;
$extraTurns = $numberQuestions % $numPlayers;
$randTable = []; 
for ($i = 0; $i<$numPlayers; $i++) {
    for($j = 0; $j < $turnsPerPlayer; $j++) {
        array_push($randTable, $playerIDList[$i]);
    }
}
for ($i = 0; $i<$extraTurns; $i++) {
    array_push($randTable, $randTable[array_rand($randTable, 1)]);
}
shuffle($randTable);



// GENERATE QUESTIONS
//for ($i = 0; $i < $numberQuestions; $i++) {
$inserted = 0;
$count = 0;
$validQuestions = [];
    
/*
    //Select a random question which isn't banned
    foreach ($questionList as &$val) {
        if (!in_array($val, $bannedQuestions)) { // Check that a question isn't banned
            array_push($validQuestions, $val);
        }
    }
*/

while ($inserted < $numberQuestions and $count < 1000) {

    $count = $count + 1;
    $qnum = array_rand($questionList, 1); // Select a random question
    $tempQuestion = $questionList[$qnum];

    // Adjust banned questions list
    array_push($recentQuestions, $qnum);
    if(count($recentQuestions)==3) {
        array_shift($recentQuestions);
    }

    // Determine player target
    $target = array_pop($randTable); // Gets the target player's id
    $targetKey = array_search($target, $playerIDList); // TargetKey is $target converted into its key value in playerIDList
    
    //Replace marker for player
    $tempQuestion = str_replace("<player>", $playerNameList[$targetKey], $tempQuestion);
    

    //Calculate answers
    switch($qnum) { // Depending on the question chosen, run some different code
        case 0: // "Recently, which of these artists has <player> listened to the most?";
        //DONE
        
            $artists = mysqli_query($conn, "SELECT * FROM Artists WHERE GameSessionID = '$code' AND PlayerID = '$target' ");
       
            if (mysqli_num_rows($artists)>15) {
                
                $topArtistNames = [];
                $urls = [];
                
                while ($artist = mysqli_fetch_array($artists)) {
                    array_push($topArtistNames, $artist['ArtistName']);
                    array_push($urls, $artist['URL']);
                }
                echo "<pre>".print_r($topArtistNames,true)."</pre>";
                
                
                $correctAnswer = $topArtistNames[0]; 
                     
                $ans[0] = $topArtistNames[0];
                $ans[1] = $topArtistNames[rand(11,15)];
                $ans[2] = $topArtistNames[rand(6,10)];
                $ans[3] = $topArtistNames[rand(1,5)];
                shuffle($ans);
                            
                $a1 = $ans[0];
                $a2 = $ans[1];
                $a3 = $ans[2];
                $a4 = $ans[3];
                
                // insertQuestion($n, $t, $q1, $a1, $a2, $a3, $a4, $correct, $url)
                insertQuestion($conn, $code, $inserted+1, "ARTIST", $tempQuestion, $a1, $a2, $a3, $a4, $correctAnswer, $urls[0], "");
                $inserted = $inserted + 1;
            
            }
            break;
            
        case 1: // "Who is the biggest <artist> fan?";
            $artists = mysqli_query($conn, "SELECT * FROM Artists WHERE GameSessionID = '$code' AND PlayerID = '$target' ");
            
            if (mysqli_num_rows($artists)>3 && count($playerNameList) > 3) {
                $topArtistNames = [];
                $urls = [];
                
                while ($artist = mysqli_fetch_array($artists)) {
                    array_push($topArtistNames, $artist['ArtistName']);
                    array_push($urls, $artist['URL']);
                }
                echo "<pre>".print_r($topArtistNames,true)."</pre>";
                
                $artistID = rand(0,5);
                $artistName = $topArtistNames[$artistID];
    
                $tempQuestion = str_replace("<artist>", $artistName, $tempQuestion);
                
                $correctAnswer = $playerNameList[$targetKey]; 
                shuffle($playerNameList);
                            
                $a1 = $playerNameList[0];
                $a2 = $playerNameList[1];
                $a3 = $playerNameList[2];
                $a4 = $playerNameList[3];
                
                // insertQuestion($n, $t, $q1, $a1, $a2, $a3, $a4, $correct, $url)
                insertQuestion($conn, $code, $inserted+1, "ARTIST", $tempQuestion, $a1, $a2, $a3, $a4, $correctAnswer, $urls[0], "");
                $inserted = $inserted + 1;
            
            }
            
            break;
    

        case 2: // "Recently who has listened to <track> by <artist> the most?"; 
        // DONE
            $tracks = mysqli_query($conn, "SELECT * FROM Tracks WHERE GameSessionID = '$code' AND PlayerID = '$target' ");
       
            if (mysqli_num_rows($tracks)>3 && count($playerNameList) > 3) {
                $topTrackNames = [];
                $topTrackArtists = [];
                $urls = [];
                $topTrackIDs = [];
                
                while ($track = mysqli_fetch_array($tracks)) {
                    array_push($topTrackNames, $track['TrackName']);
                    array_push($topTrackArtists, $track['ArtistName']);
                    array_push($topTrackIDs, $track['SpotifyID']);
                    array_push($urls, $track['URL']);
                }
                echo "<pre>".print_r($topTrackNames,true)."</pre>";
                
                //$trackID = rand(0,5);
                $trackName = $topTrackNames[0];
                $trackArtist = $topTrackArtists[0];
                
                $tempQuestion = str_replace("<track>", $trackName, $tempQuestion);
                $tempQuestion = str_replace("<artist>", $trackArtist, $tempQuestion);
                
                $correctAnswer = $playerNameList[$targetKey]; 
                            
                $a1 = $playerNameList[0];
                $a2 = $playerNameList[1];
                $a3 = $playerNameList[2];
                $a4 = $playerNameList[3];
                
                // insertQuestion($n, $t, $q1, $a1, $a2, $a3, $a4, $correct, $url)
                insertQuestion($conn, $code, $inserted+1, "TRACK", $tempQuestion, $a1, $a2, $a3, $a4, $correctAnswer, $urls[0], $topTrackIDs[0]);
                $inserted = $inserted + 1;
            }
    
    
            
            break;
        case 3: // "Which of these songs has <player> listened to the most?";
            $tracks = mysqli_query($conn, "SELECT * FROM Tracks WHERE GameSessionID = '$code' AND PlayerID = '$target' ");
            
            if (mysqli_num_rows($tracks)>15) {
                $topTrackNames = [];
                $topTrackIDs = [];
                $urls = [];
                while ($track = mysqli_fetch_array($tracks)) {
                    array_push($topTrackNames, $track['TrackName']);
                    array_push($topTrackIDs, $track['SpotifyID']);
                    array_push($urls, $track['URL']);
                }
                echo "<pre>".print_r($topTrackNames,true)."</pre>";
                
                
                $correctAnswer = $topTrackNames[0]; 
                     
                $ans[0] = $topTrackNames[0];
                $ans[1] = $topTrackNames[rand(11,15)];
                $ans[2] = $topTrackNames[rand(6,10)];
                $ans[3] = $topTrackNames[rand(1,5)];
                shuffle($ans);
                            
                $a1 = $ans[0];
                $a2 = $ans[1];
                $a3 = $ans[2];
                $a4 = $ans[3];
                
                // insertQuestion($n, $t, $q1, $a1, $a2, $a3, $a4, $correct, $url)
                insertQuestion($conn, $code, $inserted+1, "TRACK", $tempQuestion, $a1, $a2, $a3, $a4, $correctAnswer, $urls[0], $topTrackIDs[0]);
                $inserted = $inserted + 1;
            }
            break; 
        case 4: //  "Who is the biggest <genre> fan?";

            break; 
        case 5:// "Which of these is <player>'s favourite genre?";
        
            break;





    }

}

function insertQuestion($conn, $code, $n, $t, $q1, $a1, $a2, $a3, $a4, $correct, $url, $spotifyID) {
    
    echo $code;
    $query = mysqli_query($conn, "INSERT INTO Questions(GameSessionID, Number, Type, Question, Answer1, Answer2, Answer3, Answer4, CorrectAnswer, URL, SpotifyID) 
                         VALUES ('$code', '$n', '$t', '$q1', '$a1', '$a2', '$a3', '$a4', '$correct', '$url','$spotifyID');
    ");
    check_query($conn, $query);
}



?>
