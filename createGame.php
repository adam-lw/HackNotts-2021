<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lobby</title>
    <link rel="stylesheet" href="../style.css">
</head>
<?php 
    include 'conn.php';
?>
<body>
    <embed src="lounge_music.mp3" width="180" height="90" loop="false" autostart="false" hidden="true" />
    <div class = 'content'>
        <center><h1>Host a game</h1></center>
        <center><h3>Game code: <p id="code">none</p></h3></center>
        <center><form><input id = 'name' placeholder ='name' required><br><br></form><button onclick = 'add_myself()'>Add myself</button></center>
        <center><h2>Lobby</h1></center>
        <center>
        <div id ='lobby'>Waiting...</div>
        </center><br>
        <center><table><tbody>
            <tr>
                <td>
                    <button onclick="go_back()">Back</button>
                </td>
                <td>
                    <button onclick="start_game()">Start</button>
                </td>
            <tr>
        </tbody></table></center>
    </div>
</body>
<script src = 'scripts.js'></script>
<script>

load_php_file('src/create.php','#code',null);
code = 1

setInterval(function() {
    code = $('#code').html();
    console.log(code)

    $.ajax({
        url: "src/getLobby.php",
        method: "POST",
        data: {code: code},
        success: function(data) {
          if (data == 'GameStarted') {
              window.location.href = "game.php";
          } else {
            $("#lobby").html(data);
          }
        }
    });

    //load_php_file('src/getLobby.php','#lobby',{code: code});
}, 5000);


function add_myself() {
    name = $('#name').val()
    code = $('#code').html()
    if (name != null && name != "") {
        load_php_file('src/joinGame.php',null,{code: code, name: name});
        load_php_file('src/getLobby.php','#lobby',{code: code});
        window.open('api.php', '_blank').focus();
    }
    
}

function go_back() {
        window.location.href = "index.php";
}
</script>
</html>

