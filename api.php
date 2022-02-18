<!DOCTYPE html>

<?php 


include 'conn.php';
require 'vendor/autoload.php';
session_start();

$session = new SpotifyWebAPI\Session(
    '7249a07e4e44452391554dc3a503277d', // client id
    'c15369e5b8704e15ba83cf3c33a28a29', // secret
    'https://ewansamuelross.com/api.php/'
);

$api = new SpotifyWebAPI\SpotifyWebAPI();
$code = $_SESSION['gameCode'];
$playerID = $_SESSION['playerID'];

$numArtists = 20;
//$numAlbums = 10;
$numSongs = 20;

if (isset($_GET['code'])) {
    $session->requestAccessToken($_GET['code']);
    $api->setAccessToken($session->getAccessToken());

} else {
    $options = [
        'scope' => [
            'user-read-email',
            'user-top-read',
            'user-read-recently-played',
            'playlist-read-private',
            'user-library-read',
            'user-follow-read',
        ],
    ];

    header('Location: ' . $session->getAuthorizeUrl($options));
    die();
}



// ------------------ FIND TOP X ARTISTS FOR A USER ----------------------

// echo "<p> Get 5 top artists </p>";
$topartists = $api->getMyTop('artists', [
    'limit' => $numArtists, // X
    'time_range' => 'short_term', // short_term, medium_term or long_term
]);


//echo "<pre>".print_r($topartists,true)."</pre>";
foreach ($topartists->items as $artist) {
    $tempid = $artist->id;
    $tempname = $artist->name;
    $tempurl = $artist->images[0]->url;
    $query = mysqli_query($conn, "REPLACE INTO Artists(GameSessionID, PlayerID, ArtistName, URL) VALUES('$code', '$playerID', '$tempname', '$tempurl')");
    //check_query($conn, $query);
}



// ------------------------------------------------------------------------

// ------------------ FIND TOP X SONGS FOR A USER -----------------------

$topsongs = $api->getMyTop('tracks', [
    'limit' => $numSongs, // X
    'time_range' => 'short_term',
]);


foreach ($topsongs->items as $song) {
    $tempid = $song->id;
    $tempname = $song->name;
    $tempurl = $song->album->images[0]->url;
    $tempartist = $song->artists[0]->name;
    mysqli_query($conn, "REPLACE INTO Tracks(GameSessionID, PlayerID, SpotifyID, TrackName, ArtistName, URL) VALUES('$code', '$playerID', '$tempid', '$tempname', '$tempartist', '$tempurl')");
    //check_query($conn, $query);
}

// ------------------ FIND TOP X ALBUMS FOR A USER -----------------------
/*
$albums = $api->getMySavedAlbums([
    'limit' => $numAlbums,
]);

foreach ($albums->items as $album) {
    $album = $album->album;
    $tempname = $album->name;
    $tempurl = $album->images[0]->url;
    mysqli_query($conn, "REPLACE INTO Albums(GameSessionID, PlayerID, AlbumName, URL) VALUES('$code', '$playerID', '$tempname', '$tempurl')");
    //check_query($conn, $query);
}
*/



?>

<html>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="../style.css">
</head>


<?php 

if ($_SESSION['userType']==1) {
 
?>

<body>
    <div class = 'content'>
    <center><h1>Spotify Connected</h1></center>
    <center><button type = 'button' onclick="join_lobby()">Join Lobby</button></center>
  </div>
</body>

<script>

function join_lobby() {
    console.log("called lobby()");
    window.location.replace("https://ewansamuelross.com/lobby.php");
}

</script>

<?php 
} else {
?>

<body>
    <div class = 'content'>
    <center><h1>Spotify Connected</h1></center>
    <center><button type = 'button' onclick="window.close()">Close</button></center>

  </div>
</body>

<?php
}
?>
</html>


