<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lobby</title>
    <link rel="stylesheet" href="../style.css">
</head>
<?php 
    include 'conn.php';
    session_start();
    /*
    if (isset($_SESSION['error'])) {
        echo "wrong code";
        unset($_SESSION['error']);
    }
    */
    $_SESSION['userType'] = 1;
?>
<body>
    <div class = 'content'>
    <center><h1>Join a game</h1></center>
    <form method = 'post' action = 'src/joinGame.php'>
        <center>
        <table>
        <tbody>
            <tr>
                <td>
                    <label for="name">Username: </label>
                </td>
                <td>
                    <input type="text" name="name" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="code">Code: </label>
                </td>
                <td>
                    <input type="text" name="code" required/>
                </td>
            </tr>
        </tbody>
        </table>
        </center><br>
        <center><table><tbody>
            <tr>
                <td>
                    <button onclick="go_back()">Back</button>
                </td>
                <td>
                    <button type="submit">Join</button>
                </td>
            <tr>
        </tbody></table></center>
    </form>
  </div>
</body>
<script src = 'scripts.js'></script>
<script>
    function go_back() {
        window.location.href = "index.php";
    }
</script>
</html>