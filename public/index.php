<!DOCTYPE html>

<?php 
require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    '7249a07e4e44452391554dc3a503277d', // client id
    'c15369e5b8704e15ba83cf3c33a28a29', // secret
    'http://localhost/'
);

$api = new SpotifyWebAPI\SpotifyWebAPI();

if (isset($_GET['code'])) {
    $session->requestAccessToken($_GET['code']);
    $api->setAccessToken($session->getAccessToken());

    print_r($api->me());
} else {
    $options = [
        'scope' => [
            'user-read-email',
            'user-library-read',
            'user-follow-read'
        ],
    ];

    header('Location: ' . $session->getAuthorizeUrl($options));
    die();
}

// tracks
echo "<h1> Get 5 Recent Saved Tracks </h1>";
$tracks = $api->getMySavedTracks([
    'limit' => 5,
]);

foreach ($tracks->items as $track) {
    $track = $track->track;
    echo '<a href="' . $track->external_urls->spotify . '">' . $track->name . '</a> <br>';
    // ID: '.$track->id.'
}

$example_track_id = $track->id;

/* get my top
echo "<h1> Top 5 From Saved Tracks </h1>";
$tracks = $api->getMyTop("artists",[
    'limit' => 5,
]);

echo $tracks;
//print_r($tracks);

foreach ($tracks->items as $track) {
    $track = $track->track;
    echo '<a href="' . $track->external_urls->spotify . '">' . $track->name . '</a> <br>';
    // ID: '.$track->id.'
}
*/

// albums
echo "<h1> Get 5 Recent Saved Albums </h1>";
$albums = $api->getMySavedAlbums([
    'limit' => 5,
]);

foreach ($albums->items as $album) {
    $album = $album->album;
    echo '<a href="' . $album->external_urls->spotify . '">' . $album->name . '</a> <br>';
}

// artists
echo "<h1> Get 5 From Followed Artists </h1>";

$artists = $api->getUserFollowedArtists([
    'limit' => 5,
]);


foreach ($artists->artists->items as $artist) {
   // $artist = $artist->artist;
//    print_r($artist);

    echo '<a href="' . $artist->external_urls->spotify . '">' . $artist->name . '</a> <br>';
}

?>

<html>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>


<button onclick = 'start_song()'>start song</button>
<hr>


<p><b>spotify embed</b></p>
<iframe id = 'iframe' style="border-radius:12px" src="https://open.spotify.com/embed/track/<?php echo $example_track_id ?>?utm_source=generator" width="100%" height="380" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" onload = 'autoplay()'></iframe>
</html>

<script>
	
function start_song() {
document.querySelector('[title="Play"]').click()

}

function autoplay() {
	console.log("working")
    var t = setTimeout(function(){
        var button = document.querySelector('[title="Play"]') || false;
        if (button) {
            console.log('Click', button)
            button.click()
        }
    }, 999)
}
document.addEventListener('DOMContentLoaded', (event) => {
    autoplay()
})
</script>